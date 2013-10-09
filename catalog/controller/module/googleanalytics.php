<?php
/*
 * Google Analytics PRO OpenCart Module
 * Author:		www.opencartstore.com
 * Version:		1.4.9.3
 * Support:		www.opencartstore.com/support
 * Email:		info@opencartstore.com
 * About:		Adds ecommerce tracking to your Google Analytics tracking.
 */

class ControllerModuleGoogleAnalytics extends Controller {
	private $_tracking_code = '';
	private $_account_id = '';
	
	public function index() { 
		$this->template = $this->config->get('config_template') . '/template/module/googleanalytics.tpl';
		$this->id       = 'googleanalytics';
		$this->_account_id = $this->config->get('googleanalytics_account_id');
		
		// Build header code needed regardless of ecommerce tracking or not
		$this->_tracking_code = $this->_build_header_code();
		
		$this->load->model('catalog/googleanalytics');
		$this->load->model('account/address');
		
		// Check if we are at the checkout/confirm page for logged in users or the checkout/guest_step_3 
		// for guests checking out and copy order data into our own session variables for later use
		if (isset($this->request->get['route']) && $this->request->get['route'] == 'checkout/confirm') {
			$this->_copy_order_data();
		} elseif (isset($this->request->get['route']) && $this->request->get['route'] == 'checkout/guest_step_3') {
			$this->_copy_order_data();
		}
		
		// Check if we are at the success page
		if(isset($this->request->get['route']) && $this->request->get['route'] == 'checkout/success' && isset($this->session->data['ga'])){	
			$order_details = $this->model_catalog_googleanalytics->getOrderDetails($this->session->data['ga']['order_id']);
			
			// Build the javascript data structure for the tracking code
			$ecommerce_code = "_gaq.push(['_addTrans'," .
							  "'" . $this->session->data['ga']['order_id'] . "'," .
							  "'" . HTTP_SERVER . "'," .
							  "'" . $order_details['total'] . "'," .
							  "'0'," .
							  "'0'," .
							  "'" . $order_details['payment_city'] . "'," .
							  "'" . $order_details['payment_zone'] . "'," .
							  "'" . $order_details['payment_country'] . "'" .
							  "]);";
			
			// Cycle through each product in cart
			foreach ($this->session->data['ga']['products'] as $product) {
				// Get category name (string) that the product resides in
				$category_name = $this->_get_category_name($product['product_id']);
			
				// Get product order details
				$product_details = $this->model_catalog_googleanalytics->getProductDetails($this->session->data['ga']['order_id'], $product['product_id']);
				
				// Calculate total price including tax
				$product_total =  $this->_calculate_price_with_tax($product_details['price'], $product_details['tax']);
				
				$ecommerce_code .= 	"_gaq.push(['_addItem'," .
									"'" . $this->session->data['ga']['order_id'] . "'," .
									"'" . $product_details['model'] . "'," .
									"'" . $product_details['name'] . "'," .
									"'" . $category_name . "'," .
									"'" . $product_total . "'," .
									"'" . $product_details['quantity'] . "'" .
									"]);";
			}
			
			$ecommerce_code .= 	"_gaq.push(['_trackTrans']);";
			
			$this->_tracking_code .= $ecommerce_code;
			
			unset($this->session->data['ga']);
		}
		
		$this->_tracking_code .= $this->_build_footer_code();
		
		$this->_write_tracking_code();
		
		$this->render();
	}
	
	
	/*
	 * Copy order data stored in session variables to our own variables
	 * @access private
	 * @return void
	 */
	private function _copy_order_data () {
		unset($this->session->data['ga']);
		$this->session->data['ga']['products'] = $this->cart->getProducts();
		$this->session->data['ga']['order_id'] = $this->session->data['order_id'];
	}
	
	/*
	 * Builds standard header code of google tracking
	 * @access private
	 * @return string
	 */ 
	private function _build_header_code () {
		$code = "<script type='text/javascript'>\n" .
				"var _gaq = _gaq || [];\n" .
				"_gaq.push(['_setAccount', '$this->_account_id']);\n" .
				"_gaq.push(['_trackPageview']);\n";
		
		return $code;
	}
	
	/*
	 * Return the category name (string) that the product id resides in
	 * or '0' if the product is uncategorised.
	 * @access private
	 * @param int
	 * @return string
	 */ 
	private function _get_category_name ($product_id) {
		$this->load->model('catalog/googleanalytics');
		
		// Find the category name via the product id
		$tmp = $this->model_catalog_googleanalytics->getCategoryName($product_id);
				
		if (is_array($tmp)) {
			$category_name = $tmp['name'];
		} else {
			$category_name = '0';
		}
		
		return $category_name;
	}
	
	/*
	 * Return the price including tax calculations
	 * @access private
	 * @param float
	 * @param float
	 * @return float
	 */ 
	private function _calculate_price_with_tax ($price, $tax) {
		if ($tax == 0) {
			return $price;
		} else {
			return (float)($price + $price * ($tax / 100));
		}
	}
	
	/*
	 * Builds standard footer code of google tracking
	 * @access private
	 * @return string
	 */
	private function _build_footer_code () {
		$code = "(function() {\n" .
				"var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;\n" .
				"ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';\n" .
				"var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);\n" .
				"})();\n" .
				"</script>";
		
		return $code;
	}
	
	/*
	 * Writes the tracking code to the tpl file 
	 * @access private
	 * @return void
	 */
	
	private function _write_tracking_code (){
		$fp = fopen(DIR_TEMPLATE . $this->template, "w");
		fwrite($fp, $this->_tracking_code);
		fclose($fp);
	}
}
?>
