<?php 
class ControllerPaymentAuthNetAim extends Controller {
	private $error = array(); 

	public function index() {
		$this->load->language('payment/authnetaim');

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
			
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->load->model('setting/setting');
			
			$this->model_setting_setting->editSetting('authnetaim', $this->request->post);				
			
			$this->session->data['success'] = $this->language->get('text_success');

			$this->redirect($this->url->https('extension/payment'));
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_all_zones'] = $this->language->get('text_all_zones');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_auth_capture'] = $this->language->get('text_auth_capture');
		$this->data['text_auth_only'] = $this->language->get('text_auth_only');

		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$this->data['entry_order_status'] = $this->language->get('entry_order_status');
		$this->data['entry_merchant'] = $this->language->get('entry_merchant');
		$this->data['entry_key'] = $this->language->get('entry_key');
		$this->data['entry_type'] = $this->language->get('entry_type');
		$this->data['entry_mail'] = $this->language->get('entry_mail');
		$this->data['entry_test'] = $this->language->get('entry_test');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

		$this->data['tab_general'] = $this->language->get('tab_general');

		if (isset($this->error['warning'])) {$this->data['error_warning'] = $this->error['warning'];}
		if (isset($this->error['merchant'])) {$this->data['error_merchant'] = $this->error['merchant'];}
		if (isset($this->error['key'])) {$this->data['error_key'] = $this->error['key'];}

  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => $this->url->https('common/home'),
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => $this->url->https('extension/payment'),
       		'text'      => $this->language->get('text_payment'),
      		'separator' => ' :: '
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => $this->url->https('payment/authnetaim'),
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
				
		$this->data['action'] = $this->url->https('payment/authnetaim');
		
		$this->data['cancel'] = $this->url->https('extension/payment');
		
		if (isset($this->request->post['authnetaim_status'])) {
			$this->data['authnetaim_status'] = $this->request->post['authnetaim_status'];
		} else {
			$this->data['authnetaim_status'] = $this->config->get('authnetaim_status');
		}
		
		if (isset($this->request->post['authnetaim_geo_zone_id'])) {
			$this->data['authnetaim_geo_zone_id'] = $this->request->post['authnetaim_geo_zone_id'];
		} else {
			$this->data['authnetaim_geo_zone_id'] = $this->config->get('authnetaim_geo_zone_id'); 
		} 

		if (isset($this->request->post['authnetaim_order_status_id'])) {
			$this->data['authnetaim_order_status_id'] = $this->request->post['authnetaim_order_status_id'];
		} else {
			$this->data['authnetaim_order_status_id'] = $this->config->get('authnetaim_order_status_id'); 
		} 

		$this->load->model('localisation/order_status');
		
		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
		
		if (isset($this->request->post['authnetaim_merchant'])) {
			$this->data['authnetaim_merchant'] = $this->request->post['authnetaim_merchant'];
		} else {
			$this->data['authnetaim_merchant'] = $this->config->get('authnetaim_merchant');
		}

		if (isset($this->request->post['authnetaim_key'])) {
			$this->data['authnetaim_key'] = $this->request->post['authnetaim_key'];
		} else {
			$this->data['authnetaim_key'] = $this->config->get('authnetaim_key');
		}

		if (isset($this->request->post['authnetaim_type'])) {
			$this->data['authnetaim_type'] = $this->request->post['authnetaim_type'];
		} else {
			$this->data['authnetaim_type'] = $this->config->get('authnetaim_type');
		}
		
		if (isset($this->request->post['authnetaim_mail'])) {
			$this->data['authnetaim_mail'] = $this->request->post['authnetaim_mail'];
		} else {
			$this->data['authnetaim_mail'] = $this->config->get('authnetaim_mail');
		}
		
		if (isset($this->request->post['authnetaim_test'])) {
			$this->data['authnetaim_test'] = $this->request->post['authnetaim_test'];
		} else {
			$this->data['authnetaim_test'] = $this->config->get('authnetaim_test');
		}
		
		if (isset($this->request->post['authnetaim_sort_order'])) {
			$this->data['authnetaim_sort_order'] = $this->request->post['authnetaim_sort_order'];
		} else {
			$this->data['authnetaim_sort_order'] = $this->config->get('authnetaim_sort_order');
		}
		
		$this->load->model('localisation/geo_zone');
										
		$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		$this->id       = 'content';
		$this->template = 'payment/authnetaim.tpl';
		//Q: pre-1.3.3 Backwards compatibility check
        if ($this->config->get('config_guest_checkout')) {
            $this->children = array(
                'common/header',
                'common/menu',
                'common/footer'
            );
            $this->response->setOutput($this->render(TRUE));
        } else {
            $this->layout   = 'common/layout';
            $this->render();
        }
	}

	private function validate() {
		if (!$this->user->hasPermission('modify', 'payment/authnetaim')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!@$this->request->post['authnetaim_merchant']) {
			$this->error['merchant'] = $this->language->get('error_merchant');
		}

		if (!@$this->request->post['authnetaim_key']) {
			$this->error['key'] = $this->language->get('error_key');
		}
		
		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>