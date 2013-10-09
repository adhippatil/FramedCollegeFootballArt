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
	private $error = array(); 
	
	public function index() {   
		$this->load->language('module/googleanalytics');

		$this->document->title = $this->language->get('heading_title');
		
		$this->load->model('setting/setting');
						
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) {
			$this->model_setting_setting->editSetting('googleanalytics', $this->request->post);		
				
			$this->cache->delete('product');
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->redirect(HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token']);
		}
				
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_account_id'] = $this->language->get('entry_account_id');
		$this->data['entry_version_status'] = $this->language->get('entry_version_status');
		$this->data['entry_author'] = $this->language->get('entry_author');
		
		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');

                if (isset($this->error['warning'])) {
                       $this->data['error_warning'] = $this->error['warning'];
                } else {
                       $this->data['error_warning'] = '';
		}

  		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);
		
   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=module/googleanalytics&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
		
		$this->data['action'] = HTTPS_SERVER . 'index.php?route=module/googleanalytics&token=' . $this->session->data['token'];
		
		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'];
		
		if (isset($this->request->post['googleanalytics_account_id'])) {
			$this->data['googleanalytics_account_id'] = $this->request->post['googleanalytics_account_id'];
		} else {
			$this->data['googleanalytics_account_id'] = $this->config->get('googleanalytics_account_id');
		}

		if (isset($this->request->post['googleanalytics_status'])) {
			$this->data['googleanalytics_status'] = htmlspecialchars($this->request->post['googleanalytics_status']);
		} else {
			$this->data['googleanalytics_status'] = htmlspecialchars_decode($this->config->get('googleanalytics_status'));
		}			
				
		$this->id       = 'content';
		$this->template = 'module/googleanalytics.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
		
		$this->response->setOutput($this->render(TRUE));
	}
	
	private function validate() {
		if (!$this->user->hasPermission('modify', 'module/googleanalytics')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		//Only check values when the status is enabled, we don't want to bother then if they are just trying to disable it 
		if ($this->request->post['googleanalytics_status'] == 1) {

			//Validate that code is there
			if($this->request->post['googleanalytics_account_id'] == ""){
				$this->error['warning'] = "Please enter your Google Analytics Account ID.";
			}
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}	
	}
}
?>
