<?php  
class ControllerCommonFooter extends Controller {
	protected function index() {
		$this->language->load('common/footer');
		
		$this->data['text_powered_by'] = sprintf($this->language->get('text_powered_by'), $this->config->get('config_name'), date('Y', time()));
		
		$this->id = 'footer';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/footer.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/common/footer.tpl';
		} else {
			$this->template = 'default/template/common/footer.tpl';
		}
		
			
		
		$this->load->model('catalog/category');
		$this->load->model('tool/seo_url');
		
		$this->data['categories'] = array();
		$results = $this->model_catalog_category->getCategoriesList();
		foreach($results as $result){
			$this->data['categories'][] = array(
				'name'		=> str_replace("University", "", $result['name']),
				'href'		=> $this->model_tool_seo_url->rewrite(HTTP_SERVER .'index.php?route=product/category&path=' . $result['id'])
			);	
		}
		
		
		
		if (isset($this->request->get['manufacturer_id'])) {
			$this->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
		} else {
			$this->data['manufacturer_id'] = 0;
		}
		
		$this->load->model('catalog/manufacturer');
		 
		$this->data['manufacturers'] = array();
		
		$results = $this->model_catalog_manufacturer->getManufacturers();
		
		foreach ($results as $result) {
			$this->data['manufacturers'][] = array(
				'manufacturer_id' => $result['manufacturer_id'],
				'name'            => $result['name'],
				'href'            => $this->model_tool_seo_url->rewrite(HTTP_SERVER .'index.php?route=product/manufacturer&manufacturer_id=' . $result['manufacturer_id'])
			);
		}
		
		
		
		
		if ($this->config->get('google_analytics_status')) {
			$this->data['google_analytics'] = html_entity_decode($this->config->get('google_analytics_code'), ENT_QUOTES, 'UTF-8');
		} else {
			$this->data['google_analytics'] = '';
		}
		
		$this->render();
	}
	
	
	protected function getCategories($parent_id) {
		
		//$category_id = array_shift($this->path);
		
		$output = '';
		
		$results = $this->model_catalog_category->getCategories($parent_id);
		
		if ($results) { 
			$output .= '<ul>';
    	}
		
		foreach ($results as $result) {	
			if (!$current_path) {
				$new_path = $result['category_id'];
			} else {
				$new_path = $current_path . '_' . $result['category_id'];
			}
			
			$output .= '<li>';
			
			$children = '';
			
			if ($category_id == $result['category_id']) {
				$children = $this->getCategories($result['category_id'], $new_path);
			}
			
			if ($this->category_id == $result['category_id']) {
				$output .= '<a href="' . $this->model_tool_seo_url->rewrite($this->url->http('product/category&path=' . $new_path))  . '"><b>' . $result['name'] . '</b></a>';
			} else {
				$output .= '<a href="' . $this->model_tool_seo_url->rewrite($this->url->http('product/category&path=' . $new_path))  . '">' . $result['name'] . '</a>';
			}
			
        	$output .= $children;
        
        	$output .= '</li>'; 
		}
 
		if ($results) {
			$output .= '</ul>';
		}
		
		$output = "test";
		
		return $output;
	}
}
?>