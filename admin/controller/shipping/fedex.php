<?php
//-----------------------------------------
// Author: Qphoria@gmail.com
// Web: http://www.theqdomain.com/
//-----------------------------------------
class ControllerShippingFedex extends Controller {
	private $error = array(); 
	
	public function index() {
		if (!isset($this->session->data['token'])) {
			$this->session->data['token'] = 0;
		}		
		$this->data['token'] = $this->session->data['token'];
	
		$this->load->language('shipping/fedex');

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('fedex', $this->request->post);		
					
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect((((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/shipping'));
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		
		$this->data['text_d_PRIORITYOVERNIGHT'] = $this->language->get('text_d_PRIORITYOVERNIGHT');
		$this->data['text_d_STANDARDOVERNIGHT'] = $this->language->get('text_d_STANDARDOVERNIGHT');
		$this->data['text_d_FIRSTOVERNIGHT'] = $this->language->get('text_d_FIRSTOVERNIGHT');
		$this->data['text_d_FEDEX2DAY'] = $this->language->get('text_d_FEDEX2DAY');
		$this->data['text_d_FEDEXEXPRESSSAVER'] = $this->language->get('text_d_FEDEXEXPRESSSAVER');
		$this->data['text_d_INTERNATIONALPRIORITY'] = $this->language->get('text_d_INTERNATIONALPRIORITY');
		$this->data['text_d_INTERNATIONALECONOMY'] = $this->language->get('text_d_INTERNATIONALECONOMY');
		$this->data['text_d_INTERNATIONALFIRST'] = $this->language->get('text_d_INTERNATIONALFIRST');
		$this->data['text_d_FEDEX1DAYFREIGHT'] = $this->language->get('text_d_FEDEX1DAYFREIGHT');
		$this->data['text_d_FEDEX2DAYFREIGHT'] = $this->language->get('text_d_FEDEX2DAYFREIGHT');
		$this->data['text_d_FEDEX3DAYFREIGHT'] = $this->language->get('text_d_FEDEX3DAYFREIGHT');
		$this->data['text_d_FEDEXGROUND'] = $this->language->get('text_d_FEDEXGROUND');
		$this->data['text_d_GROUNDHOMEDELIVERY'] = $this->language->get('text_d_GROUNDHOMEDELIVERY');
		
		
		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_tax'] = $this->language->get('entry_tax');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');	
		
		$this->data['entry_meter'] = $this->language->get('entry_meter');
		$this->data['entry_dropoff'] = $this->language->get('entry_dropoff');
		$this->data['entry_packaging'] = $this->language->get('entry_packaging');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_account'] = $this->language->get('entry_account');
		$this->data['entry_dropoff'] = $this->language->get('entry_dropoff');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_d_services'] = $this->language->get('entry_d_services');
		$this->data['entry_test'] = $this->language->get('entry_test');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_list'] = $this->language->get('entry_list');
		$this->data['entry_box_weight'] = $this->language->get('entry_box_weight');
		$this->data['entry_debug'] = $this->language->get('entry_debug');
		
		$this->data['help_list'] = $this->language->get('help_list');
		$this->data['help_zone'] = $this->language->get('help_zone');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

		if (isset($this->error['warning'])) {$this->data['error_warning'] = $this->error['warning'];}
		if (isset($this->error['account'])) {$this->data['error_account'] = $this->error['account'];}
		if (isset($this->error['postcode'])) {$this->data['error_postcode'] = $this->error['postcode'];}
		if (isset($this->error['meter'])) {$this->data['error_meter'] = $this->error['meter'];}


  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=common/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/shipping'),
       		'text'      => $this->language->get('text_shipping'),
      		'separator' => ' :: '
   		);
		
   		$this->document->breadcrumbs[] = array(
       		'href'      => (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=shipping/fedex'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=shipping/fedex');
		
		$this->data['cancel'] = (((HTTPS_SERVER) ? HTTPS_SERVER : HTTP_SERVER) . 'index.php?token=' . $this->session->data['token'] . '&route=extension/shipping');
		
		$this->data['pickup'] = array();
		  
		$this->data['pickup'][] = array(
			'code' => 'REGULARPICKUP',
			'text' => $this->language->get('text_rdp')
		);

		$this->data['pickup'][] = array(
			'code' => 'REQUESTCOURIER',
			'text' => $this->language->get('text_rqc')
		);

		$this->data['pickup'][] = array(
			'code' => 'DROPBOX',
			'text' => $this->language->get('text_drb')
		);

		$this->data['pickup'][] = array(
			'code' => 'BUSINESSSERVICE',
			'text' => $this->language->get('text_bs')
		);

		$this->data['pickup'][] = array(
			'code' => 'CENTER',
			'text' => $this->language->get('text_ctr')
		);
		
		$this->data['pickup'][] = array(
			'code' => 'STATION',
			'text' => $this->language->get('text_stn')
		);
		
		if (isset($this->request->post['fedex_pickup'])) {
			$this->data['fedex_pickup'] = $this->request->post['fedex_pickup'];
		} else {
			$this->data['fedex_pickup'] = $this->config->get('fedex_pickup');
		}
		
		$this->data['packaging'] = array();
		  
		$this->data['packaging'][] = array(
			'code' => 'YOURPACKAGING',
			'text' => $this->language->get('text_YOURPACKAGING')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEXBOX',
			'text' => $this->language->get('text_FEDEXBOX')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEXENVELOPE',
			'text' => $this->language->get('text_FEDEXENVELOPE')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEXPAK',
			'text' => $this->language->get('text_FEDEXPAK')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEXTUBE',
			'text' => $this->language->get('text_FEDEXTUBE')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEX10KBOX',
			'text' => $this->language->get('text_FEDEX10KBOX')
		);
		
		$this->data['packaging'][] = array(
			'code' => 'FEDEX25KBOX',
			'text' => $this->language->get('text_FEDEX25KBOX')
		);

		if (isset($this->request->post['fedex_package'])) {
			$this->data['fedex_package'] = $this->request->post['fedex_package'];
		} else {
			$this->data['fedex_package'] = $this->config->get('fedex_package');
		}
		
		$this->data['d_services'][] = 'PRIORITYOVERNIGHT';
		$this->data['d_services'][] = 'STANDARDOVERNIGHT';
		$this->data['d_services'][] = 'FIRSTOVERNIGHT';
		$this->data['d_services'][] = 'FEDEX2DAY';
		$this->data['d_services'][] = 'FEDEXEXPRESSSAVER';
		$this->data['d_services'][] = 'INTERNATIONALPRIORITY';
		$this->data['d_services'][] = 'INTERNATIONALECONOMY';
		$this->data['d_services'][] = 'INTERNATIONALFIRST';
		$this->data['d_services'][] = 'FEDEX1DAYFREIGHT';
		$this->data['d_services'][] = 'FEDEX2DAYFREIGHT';
		$this->data['d_services'][] = 'FEDEX3DAYFREIGHT';
		$this->data['d_services'][] = 'FEDEXGROUND';
		$this->data['d_services'][] = 'GROUNDHOMEDELIVERY';
			
		foreach ($this->data['d_services'] as $serv) {	
			if (isset($this->request->post['fedex_d_'.$serv])) {
				$this->data['fedex_d_'.$serv] = $this->request->post['fedex_d_'.$serv];
			} else {
				$this->data['fedex_d_'.$serv] = $this->config->get('fedex_d_'.$serv);
			}
		}
		
		$this->load->model('localisation/country');
		$this->data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['fedex_box_weight'])) {
			$this->data['fedex_box_weight'] = $this->request->post['fedex_box_weight'];
		} else {
			$this->data['fedex_box_weight'] = $this->config->get('fedex_box_weight');
		}
		
		if (isset($this->request->post['fedex_cost'])) {
			$this->data['fedex_cost'] = $this->request->post['fedex_cost'];
		} else {
			$this->data['fedex_cost'] = $this->config->get('fedex_cost');
		}

		if (isset($this->request->post['fedex_tax_class_id'])) {
			$this->data['fedex_tax_class_id'] = $this->request->post['fedex_tax_class_id'];
		} else {
			$this->data['fedex_tax_class_id'] = $this->config->get('fedex_tax_class_id');
		}

		if (isset($this->request->post['fedex_geo_zone_id'])) {
			$this->data['fedex_geo_zone_id'] = $this->request->post['fedex_geo_zone_id'];
		} else {
			$this->data['fedex_geo_zone_id'] = $this->config->get('fedex_geo_zone_id');
		}
		
		if (isset($this->request->post['fedex_status'])) {
			$this->data['fedex_status'] = $this->request->post['fedex_status'];
		} else {
			$this->data['fedex_status'] = $this->config->get('fedex_status');
		}
		
		if (isset($this->request->post['fedex_sort_order'])) {
			$this->data['fedex_sort_order'] = $this->request->post['fedex_sort_order'];
		} else {
			$this->data['fedex_sort_order'] = $this->config->get('fedex_sort_order');
		}
		
		if (isset($this->request->post['fedex_account'])) {
			$this->data['fedex_account'] = $this->request->post['fedex_account'];
		} else {
			$this->data['fedex_account'] = $this->config->get('fedex_account');
		}	
		
		if (isset($this->request->post['fedex_meter'])) {
			$this->data['fedex_meter'] = $this->request->post['fedex_meter'];
		} else {
			$this->data['fedex_meter'] = $this->config->get('fedex_meter');
		}
		
		if (isset($this->request->post['fedex_postcode'])) {
			$this->data['fedex_postcode'] = $this->request->post['fedex_postcode'];
		} else {
			$this->data['fedex_postcode'] = $this->config->get('fedex_postcode');
		}
		
		if (isset($this->request->post['fedex_city'])) {
			$this->data['fedex_city'] = $this->request->post['fedex_city'];
		} else {
			$this->data['fedex_city'] = $this->config->get('fedex_city');
		}
		
		if (isset($this->request->post['fedex_country_id'])) {
			$this->data['fedex_country_id'] = $this->request->post['fedex_country_id'];
		} else {
			$this->data['fedex_country_id'] = $this->config->get('fedex_country_id');
		}
		
		if (isset($this->request->post['fedex_zone_id'])) {
			$this->data['fedex_zone_id'] = $this->request->post['fedex_zone_id'];
		} else {
			$this->data['fedex_zone_id'] = $this->config->get('fedex_zone_id');
		}
		
		if (isset($this->request->post['fedex_test'])) {
			$this->data['fedex_test'] = $this->request->post['fedex_test'];
		} else {
			$this->data['fedex_test'] = $this->config->get('fedex_test');
		}
		
		if (isset($this->request->post['fedex_debug'])) {
			$this->data['fedex_debug'] = $this->request->post['fedex_debug'];
		} else {
			$this->data['fedex_debug'] = $this->config->get('fedex_debug');
		}
		
		if (isset($this->request->post['fedex_list'])) {
			$this->data['fedex_list'] = $this->request->post['fedex_list'];
		} else {
			$this->data['fedex_list'] = $this->config->get('fedex_list');
		}
		
		if (isset($this->request->post['fedex_length'])) {
			$this->data['fedex_length'] = $this->request->post['fedex_length'];
		} else {
			$this->data['fedex_length'] = $this->config->get('fedex_length');
		}
		
		if (isset($this->request->post['fedex_width'])) {
			$this->data['fedex_width'] = $this->request->post['fedex_width'];
		} else {
			$this->data['fedex_width'] = $this->config->get('fedex_width');
		}
		
		if (isset($this->request->post['fedex_height'])) {
			$this->data['fedex_height'] = $this->request->post['fedex_height'];
		} else {
			$this->data['fedex_height'] = $this->config->get('fedex_height');
		}
		
		$this->load->model('localisation/tax_class');
		
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
		
		$this->load->model('localisation/geo_zone');
		
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
								
		$this->id       = 'content';
		$this->template = 'shipping/fedex.tpl';
		if (file_exists(DIR_SYSTEM . 'engine/action.php')) { //v1.4.0
            $this->children = array(
                'common/header',
                'common/footer'
            );
            $this->response->setOutput($this->render(TRUE));
        } elseif ($this->config->get('config_guest_checkout') != null) { //v1.3.4
            $this->children = array(
                'common/header',
                'common/menu',
                'common/footer'
            );
            $this->response->setOutput($this->render(TRUE));
        } else { //v1.3.2 or less
            $this->layout   = 'common/layout';
            $this->render();
        }
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'shipping/fedex')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->request->post['fedex_postcode']) {
			//$this->error['postcode'] = $this->language->get('error_postcode');
		}
		
		if (!$this->request->post['fedex_account']) {
			$this->error['account'] = $this->language->get('error_account');
		}
		
		if (!$this->request->post['fedex_meter']) {
			$this->error['meter'] = $this->language->get('error_meter');
		}
				
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
	
	public function zone() {
		$output = '';
		
		$this->load->model('localisation/zone');
		
		$results = $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']);
		
		foreach ($results as $result) {
			$output .= '<option value="' . $result['zone_id'] . '"';

			if (isset($this->request->get['zone_id']) && ($this->request->get['zone_id'] == $result['zone_id'])) {
				$output .= ' selected="selected"';
			}

			$output .= '>' . $result['name'] . '</option>';
		}

		if (!$results) {
			$output .= '<option value="0">' . $this->language->get('text_none') . '</option>';
		}

		$this->response->setOutput($output, $this->config->get('config_compression'));
	}
}
?>