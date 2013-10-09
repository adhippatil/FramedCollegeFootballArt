<?php
//-----------------------------------------
// Author: Qphoria@gmail.com
// Web: http://www.theqdomain.com/
//-----------------------------------------
class ModelShippingFedex extends Model {

	private $_weight = '0.00';
	private $_wunit = 'lb';

	public function getQuote() {

        if ($this->config->get('fedex_status')) {
			// Get Address Data (Shipping)
	        $address = array();
	        if (method_exists($this->customer, 'getAddress')) { // v1.3.2 Normal Checkout
        		$address = $this->customer->getAddress($this->session->data['shipping_address_id']);
        		$address['zone_code'] = $address['code'];
			} else {
        		if (isset($this->session->data['shipping_address_id']) && $this->session->data['shipping_address_id']) { // v1.3.4+ Normal checkout
        			$this->load->model('account/address');
        			$address = $this->model_account_address->getAddress($this->session->data['shipping_address_id']);
				} else { //v1.3.4+ Guest checkout
					if (isset($this->session->data['guest']) && is_array($this->session->data['guest'])) {
						$address = $this->session->data['guest'];
					} else { // Get passed params (1.3.4 Guest Checkout only)
						$arg_list = func_get_args();
						if (isset($arg_list[0])) {
							$this->load->model('localisation/country');
							$country_data 		= $this->model_localisation_country->getCountry($arg_list[0]);
						}
						if (isset($arg_list[1])) {
							$this->load->model('localisation/zone');
							$zone_data			= $this->model_localisation_zone->getZone($arg_list[1]);
						}
						$address = array_merge($country_data, $zone_data);
						$address['postcode'] 	= $arg_list[2];
						$address['zone_code'] 	= (isset($zone_data['code'])) ? $zone_data['code'] : '';
						$address['zone_id'] 	= (isset($zone_data['zone_id'])) ? $zone_data['zone_id'] : '0';
						$address['city'] 		= (isset($zone_data['city'])) ? $zone_data['city'] : '';
					}
				}
			}
			$country_id	= (isset($address['country_id'])) ? $address['country_id'] : 0;
			$zone_id 	= (isset($address['zone_id'])) ? $address['zone_id'] : 0;
			$postcode 	= (isset($address['postcode'])) ? $address['postcode'] : '';
			//

			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('fedex_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

      		if (!$this->config->get('fedex_geo_zone_id')) {
        		$status = TRUE;
      		} elseif ($query->num_rows) {
        		$status = TRUE;
      		} else {
        		$status = FALSE;
      		}
		} else {
			$status = FALSE;
		}

		$method_data = array();

		if ($status) {
			$this->load->language('shipping/fedex');

			restore_error_handler();
			require_once("fedex_lib.php");

			// List all Servics
			$fedexService['PRIORITYOVERNIGHT']     = $this->language->get('text_PRIORITYOVERNIGHT');
			$fedexService['STANDARDOVERNIGHT']     = $this->language->get('text_STANDARDOVERNIGHT');
			$fedexService['FIRSTOVERNIGHT']        = $this->language->get('text_FIRSTOVERNIGHT');
			$fedexService['FEDEX2DAY']             = $this->language->get('text_FEDEX2DAY');
			$fedexService['FEDEXEXPRESSSAVER']     = $this->language->get('text_FEDEXEXPRESSSAVER');
			$fedexService['FEDEX1DAYFREIGHT']      = $this->language->get('text_FEDEX1DAYFREIGHT');
			$fedexService['FEDEX2DAYFREIGHT']      = $this->language->get('text_FEDEX2DAYFREIGHT');
			$fedexService['FEDEX3DAYFREIGHT']      = $this->language->get('text_FEDEX3DAYFREIGHT');
			$fedexService['FEDEXGROUND']           = $this->language->get('text_FEDEXGROUND');
			$fedexService['GROUNDHOMEDELIVERY']    = $this->language->get('text_GROUNDHOMEDELIVERY');
			$fedexService['INTERNATIONALPRIORITY'] = $this->language->get('text_INTERNATIONALPRIORITY');
			$fedexService['INTERNATIONALECONOMY']  = $this->language->get('text_INTERNATIONALECONOMY');
			$fedexService['INTERNATIONALFIRST']    = $this->language->get('text_INTERNATIONALFIRST');

			// Origin Info
			$this->load->model('localisation/country');
            $country_info = $this->model_localisation_country->getCountry($this->config->get('config_country_id'));
            $origin_country_info = $this->model_localisation_country->getCountry($this->config->get('fedex_country_id'));
            $this->load->model('localisation/zone');
             if (method_exists($this->model_localisation_zone, 'getZone')) { // v1.3.4 and newer
            	$origin_zone_info = $this->model_localisation_zone->getZone($this->config->get('fedex_zone_id'));
			} else { // v1.3.2 and older
				$zone_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone WHERE zone_id = '" . (int)$zone_id . "'");
				$origin_zone_info = $zone_query->row;
			}
			$origin_country = ($origin_country_info['iso_code_2']) ? $origin_country_info['iso_code_2'] : $country_info['iso_code_2'];
            $origin_zone = (isset($origin_zone_info['code'])) ? $origin_zone_info['code'] : '';
            $origin_city = ($this->config->get('fedex_city')) ? $this->config->get('fedex_city') : '';
			$origin_postcode = str_replace(array(' ', '-'), '', $this->config->get('fedex_postcode'));

			// Destination Info
			$dest_country = $address['iso_code_2'];
			$dest_zone = $address['zone_code'];
			$dest_city = $address['city'];
			$dest_postcode = str_replace(array(' ', '-'), '', $address['postcode']);

			// Get 5-digit zipcode for "US" address
            if ($dest_country == 'US') {
                if ($dest_postcode == '') {
					return $this->retError($this->language->get('error_zip_required'));
				}
				$dest_postcode = substr($dest_postcode, 0, 5);
            }

			// Weight & Measurements
			$locale_unit = (in_array($dest_country, array('US','PR','GU'))) ? 'lb' : 'kg';
			$weight_unit = (in_array($dest_country, array('US','PR','GU'))) ? 'LBS' : 'KGS';
			$dim_unit = (in_array($dest_country, array('US','PR','GU'))) ? 'IN' : 'CM';
			if ($locale_unit == 'lb') { //min lb = 0.5
				$shipping_weight = ($this->cart->getWeight() < '0.5') ? '0.5' : $this->cart->getWeight();
			} else { //min kg = 1.0
				$shipping_weight = ($this->cart->getWeight() < '1.0') ? '1.0' : $this->cart->getWeight();
			}
			
			if (file_exists(DIR_SYSTEM . 'library/length.php')) { // v1.4.4 and newer
				$shipping_weight = str_replace(',','',$this->weight->convert($shipping_weight, $this->config->get('config_weight_class'), $locale_unit));
			} else { // v1.4.0 and older
				$results = $this->db->query("select weight_class_id from " . DB_PREFIX . "weight_class where unit = '" . $locale_unit . "'");
				$shipping_weight = str_replace(',','',$this->weight->convert($shipping_weight, $this->config->get('config_weight_class_id'), $results->row['weight_class_id']));
			}

			$this->_weight = $shipping_weight;
			$this->_wunit = $locale_unit;

			// Setup Fedex class
			$fedex = new Fedex;
			if ($this->config->get('fedex_test')) {
			    $fedex->setServer("https://gatewaybeta.fedex.com/GatewayDC");
			} else {
			    $fedex->setServer("https://gateway.fedex.com/GatewayDC");
			}
			$fedex->setAccountNumber($this->config->get('fedex_account'));
			$fedex->setMeterNumber($this->config->get('fedex_meter'));
			$fedex->setDropoffType($this->config->get('fedex_pickup'));
			$fedex->setPackaging($this->config->get('fedex_package'));
			$fedex->setWeightUnits($weight_unit);
			$fedex->setWeight($shipping_weight);
			if ($origin_country == 'US' || $origin_country == 'CA') {
			    $fedex->setOriginStateOrProvinceCode($origin_zone);
			} else {
				$fedex->setOriginStateOrProvinceCode('');
			}

			if ($origin_country == $dest_country) {
				$fedex->setListRate($this->config->get('fedex_list'));
			} else { // No list rates for int'l shipping
				$fedex->setListRate(FALSE);
			}

			$fedex->setOriginCity($origin_city);
			$fedex->setOriginPostalCode($origin_postcode);
			$fedex->setOriginCountryCode($origin_country);
			if ($dest_country == 'US' || $dest_country == 'CA') {
			    $fedex->setDestStateOrProvinceCode($dest_zone);
			} else {
				$fedex->setDestStateOrProvinceCode('');
			}
			$fedex->setDestCity($dest_city);
			$fedex->setDestPostalCode($dest_postcode);
			$fedex->setDestCountryCode($dest_country);
			$fedex->setPayorType("SENDER");

			//Dimensions
			$fedex->setLength((int)$this->config->get('fedex_length'));
			$fedex->setWidth((int)$this->config->get('fedex_width'));
			$fedex->setHeight((int)$this->config->get('fedex_height'));
			$fedex->setDimUnit($dim_unit);
			$max_box_weight = $this->config->get('fedex_box_weight');
			$fedex->setMaxWeight($max_box_weight);

			$fedex->setDebug($this->config->get('fedex_debug'), $this->config->get('config_email'));

			$prices = array();
			foreach($fedexService as $service=>$serviceName) {

				if (!$this->config->get('fedex_d_' . $service)) { continue; }

			    $fedex->setService($service, $serviceName);

			    if ($service == 'FEDEXGROUND' || $service == 'GROUNDHOMEDELIVERY') {
					$fedex->setCarrierCode("FDXG");
				} else {
					$fedex->setCarrierCode("FDXE");
				}

			    $results = $fedex->getPrice();

			    if (isset($results)) {
				    if (isset($results->description)) {
			    		$error = $this->retError($results->description);
					}
					if (isset($results->service)) {
			    		$prices[] = $results;
					}
				}

			}

			$rates = array();
			foreach ($prices as $price) {
				$rates[] = @array($price->service => $price->rate);
				$currencycode = ($price->currencycode) ? $price->currencycode : 'XXX';
			}

			// Returns error message
			if (empty($rates)) {
				if (isset($error)) {
					return $this->retError($error['quote']['fedex']['text']);
				} else {
					return $this->retError($this->language->get('error_no_rates'));
				}
			}

			$quote_data = array();
			$i=0;
			foreach ($rates as $rate) {
				foreach ($rate as $key=>$value) {

					// Add extra cost
					if (strpos($this->config->get('fedex_cost'), '%') !==false) { // use percent of subtotal
						//$cost = str_replace('%', '', $this->config->get('fedex_cost')) / 100;
						$value += $value * (rtrim($this->config->get('fedex_cost'),'%')/100);
					} else { // flat fee
						$value += (float)$this->config->get('fedex_cost');
					}
		            

					// Convert from FedEx returned currency code to currently selected currency code
					if (!$this->currency->has($currencycode)) {
    					return $this->retError($this->language->get('error_currency') . ': ' . $currencycode);
					}
					
					
					//$value *= ($this->currency->getValue($this->currency->getCode()) / $this->currency->getValue($currencycode));
					$value = $this->currency->convert($value, $currencycode, $this->config->get('config_currency'));

		            $quote_data['fedex_'.$i] = array(
		                'id'    		=> 'fedex.fedex_'. $i,
		                'title' 		=> $key,
		                'cost'  		=> $value,
		                'tax_class_id'  => $this->config->get('fedex_tax_class_id'),
		                //'text'  		=> $this->currency->format($this->tax->calculate($value, $this->config->get('fedex_tax_class_id'), $this->config->get('config_tax')))
						'text'    		=> $this->currency->format($this->tax->calculate($value, $this->config->get('fedex_tax_class_id'), $this->config->get('config_tax')), $this->currency->getCode())
		            );

	        	}
	        	$i++;
			}

      		$method_data = array(
        		'id'         => 'fedex',
        		'title'      => $this->language->get('text_title') . ' ('. $this->_weight . $this->_wunit . ')',
        		'quote'      => $quote_data,
				'sort_order' => $this->config->get('fedex_sort_order'),
        		'error'      => FALSE
      		);
		}

		return $method_data;
	}

	function retError($error="unknown error") {

    	$quote_data = array();

      	$quote_data['fedex'] = array(
        	'id'           => 'fedex.fedex',
        	'title'        => $this->language->get('text_title'),
			'cost'         => NULL,
         	'tax_class_id' => NULL,
			'text'         => $error
      	);

    	$method_data = array(
		  'id'           => 'fedex',
		  'title'        => $this->language->get('text_title') . ' ('. $this->_weight . $this->_wunit . ')',
		  'quote'        => $quote_data,
		  'sort_order'   => $this->config->get('fedex_sort_order'),
		  'tax_class_id' => $this->config->get('fedex_tax_class_id'),
		  'error'        => $error
		);
		return $method_data;
	}
}
?>