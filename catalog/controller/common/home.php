<?php  
class ControllerCommonHome extends Controller {
	public function index() {
		$this->language->load('common/home');
		
		$this->document->title = $this->config->get('config_title');
		$this->document->description = $this->config->get('config_meta_description');
		
		$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_name'));
		
		$this->load->model('setting/store');
		
		if (!$this->config->get('config_store_id')) {
			$this->data['welcome'] = html_entity_decode($this->config->get('config_description_' . $this->config->get('config_language_id')), ENT_QUOTES, 'UTF-8');
		} else {
			$store_info = $this->model_setting_store->getStore($this->config->get('config_store_id'));
			
			if ($store_info) {
				$this->data['welcome'] = html_entity_decode($store_info['description'], ENT_QUOTES, 'UTF-8');
			} else {
				$this->data['welcome'] = '';
			}
		}
						
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/home.tpl';
		} else {
			$this->template = 'default/template/common/home.tpl';
		}
		
		$this->children = array();
		
		$this->load->model('checkout/extension');
		
		$module_data = $this->model_checkout_extension->getExtensionsByPosition('module', 'home');
		
		$this->data['modules'] = $module_data;
		
		foreach ($module_data as $result) {
			$this->children[] = 'module/' . $result['code'];
		}		
		
		
		
		///////////////////////	
		$this->load->model('catalog/product');
	
		if (isset($this->request->get['product_id'])) {
			$product_id = $this->request->get['product_id'];
		} else {
			$product_id = 0;
		}
		///////////////////////
		
		//$this->data['heading_title'] = sprintf($this->language->get('heading_title'), $this->config->get('config_store'));
		//$this->data['welcome'] = html_entity_decode($this->config->get('config_welcome_' . $this->language->getId()));
		
		$this->data['text_latest'] = $this->language->get('text_latest');
		$this->data['action'] = HTTP_SERVER . 'index.php?route=checkout/cart';
		
		$this->load->model('catalog/product');
		$this->load->model('catalog/category');
		$this->load->model('catalog/review');
		$this->load->model('tool/seo_url');
		$this->load->helper('image');
		
		$this->data['products'] = array();

		foreach ($this->model_catalog_product->getLatestProducts(8) as $result) {
			
			// Q: Get Product Options	
					$this->data['text_options'] = $this->language->get('text_options');
					$product_option_info = array();
					
					$options = $this->model_catalog_product->getProductOptions($result['product_id']);
				
					foreach ($options as $option) { 
						$option_value_data = array();
						
						foreach ($option['option_value'] as $option_value) {
							$option_value_data[] = array(
            					'option_value_id' => $option_value['product_option_value_id'],
            					'name'            => $option_value['name'],
            					'price'           => (float)$option_value['price'] ? $this->currency->format($this->tax->calculate($option_value['price'], $result['tax_class_id'], $this->config->get('config_tax'))) : FALSE,
            					'prefix'          => $option_value['prefix']
          					);
						}
						
						$product_option_info[] = array(
          					'option_id'    => $option['product_option_id'],
          					'name'         => $option['name'],
          					'option_value' => $option_value_data
						);
					}//			
			
					
			if ($result['image']) {
				$image = $result['image'];
			} else {
				$image = 'no_image.jpg';
			}
			
			$rating = $this->model_catalog_review->getAverageRating($result['product_id']);	
			
			$special = FALSE;
			
			$discount = $this->model_catalog_product->getProductDiscount($result['product_id']);
			
			if ($discount) {
				$price = $this->currency->format($this->tax->calculate($discount, $result['tax_class_id'], $this->config->get('config_tax')));
			} else {
				$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
			
				$special = $this->model_catalog_product->getProductSpecial($result['product_id']);
			
				if ($special) {
					$special = $this->currency->format($this->tax->calculate($special, $result['tax_class_id'], $this->config->get('config_tax')));
				}						
			}
				
          	$this->data['products'][] = array(
            	'name'    => $result['name'],
				'id'   	  => $result['product_id'],
				'model'   => $result['model'],
            	'rating'  => $rating,
				'stars'   => sprintf($this->language->get('text_stars'), $rating),
				'thumb'   => image_resize($image, $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height')),
            	'price'   => $price,
				'special' => $special,
				'href'    => $this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/product&product_id=' . $result['product_id']),
				'options' => $product_option_info //Q: Product Options
          	);
		}

		if (!$this->config->get('config_customer_price')) {
			$this->data['display_price'] = TRUE;
		} elseif ($this->customer->isLogged()) {
			$this->data['display_price'] = TRUE;
		} else {
			$this->data['display_price'] = FALSE;
		}
		
		$this->data['blog'] = $this->getBlogEntries();
				
		$this->children[] = 'common/column_right';
		$this->children[] =	'common/column_left';
		$this->children[] =	'common/footer';
		$this->children[] =	'common/header';
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
	
	private function getBlogEntries(){

		$rss_url = "http://framedcollegefootballart.com/blogentries.php";
		
		// GET RSS FEED
		$RSS_XML = $this->getRSS($rss_url);
		// CONVERT XML FEED TO ARRAY
		//$items = $this->RSStoARRAY($RSS_XML);
		
		return $RSS_XML;	
	}
	
	private function getRSS($posturl){
			
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $posturl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$response = curl_exec($ch);
		
		return $response;
	}
	
	private function RSStoARRAY($RSS_XML){
	
		// CONVERT XML FEED INTO ARRAY
		$xml = simplexml_load_string($RSS_XML);
		$json = json_encode($xml);
		$items = json_decode($json,TRUE);
		$items = $items["channel"]["item"];
		
		return $items;
	}
}
?>