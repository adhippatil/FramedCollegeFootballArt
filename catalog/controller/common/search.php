<?php  
class ControllerCommonSearch extends Controller {
	protected function index() { 	
		$this->language->load('common/search');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
    	
		$this->data['text_keywords'] = $this->language->get('text_keywords');
    	$this->data['text_advanced'] = $this->language->get('text_advanced');
		
		$this->data['entry_search'] = $this->language->get('entry_search');
    	
		$this->data['button_search'] = $this->language->get('button_search');
    	
		if (isset($this->request->get['keyword'])) {
			$this->data['keyword'] = $this->request->get['keyword'];
		} else {
			$this->data['keyword'] = '';
		}
		
		$this->data['advanced'] = $this->url->http('product/search');
		
		$this->id       = 'search';
		$this->template = $this->config->get('config_template') . 'common/search.tpl';

    	$this->render();
  	}
}
?>