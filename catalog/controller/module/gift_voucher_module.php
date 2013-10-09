<?php  
class ControllerModuleGiftVoucherModule extends Controller {
	protected function index() {
		$this->language->load('module/gift_voucher');	
		
		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_check_balance'] = $this->language->get('text_check_balance');
		$this->data['text_captcha'] = $this->language->get('text_captcha');
		$this->data['button_go'] = $this->language->get('button_go');
		
		if (isset($this->request->post['gift_voucher_code'])) {
			$this->data['gift_voucher_code'] = $this->request->post['gift_voucher_code'];
		} else {
			$this->data['gift_voucher_code'] = '';
		}
		
		if ($this->data['gift_voucher_code']) { 
			$this->load->model('checkout/gift_voucher'); 
			
			$result = $this->model_checkout_gift_voucher->checkGiftVoucher($this->data['gift_voucher_code']);
			
			if ($result) {
				$this->session->data['gift_voucher_attempts'] = 0;
				$this->data['results'] = sprintf($this->language->get('text_balance_results'), $this->currency->format($result['balance']));
			} else {
				if (!isset($this->session->data['gift_voucher_attempts'])) { $this->session->data['gift_voucher_attempts'] = 0; }
				$this->data['results'] = $this->language->get('error_voucher_invalid');
				$this->session->data['gift_voucher_attempts']++;
			}			
		} else {
			$this->data['results'] = '';
		}

		if (isset($this->session->data['gift_voucher_attempts']) && $this->session->data['gift_voucher_attempts'] >= 3) {
			$this->data['show_captcha'] = true;
		} else {
			$this->data['show_captcha'] = false;
		}
		
		if ($this->data['show_captcha']) {
			if (isset($this->session->data['gift_voucher_captcha']) && isset($this->request->post['captcha']) && $this->session->data['gift_voucher_captcha'] != $this->request->post['captcha']) {
				$this->data['results'] = $this->language->get('error_voucher_captcha');
			}
		}
		
		$this->id = 'gift_voucher_module';
		
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/gift_voucher.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/gift_voucher.tpl';
		} else {
			$this->template = 'default/template/module/gift_voucher.tpl';
		}
		
		$this->render(); 
	}
	
	public function captcha() {
		$this->load->library('captcha');
		
		$captcha = new Captcha();
		
		$this->session->data['gift_voucher_captcha'] = $captcha->getCode();
		
		$captcha->showImage();
	}
	
	
	public function checkClearance(){
		
		$voucher_product_data = array();
							
		$product_allowed = array();
		
		foreach ($this->cart->getProducts() as $product) {
			$product_category_data = array();	
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product['product_id'] . "'");
	
			foreach ($query->rows as $result) {
				$product_category_data[] = $result['category_id'];						
			}
			
			if(!in_array(100, $product_category_data)){
				$product_allowed[] = $product['product_id'];
				$voucher_product_data[] = $product['product_id'];
			}
		}
		
		if(!$product_allowed){
			$status = FALSE;
		}
		
	}
}
?>