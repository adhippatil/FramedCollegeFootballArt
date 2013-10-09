<?php  
class ControllerModuleCategory extends Controller {
	protected $category_id = 0;
	protected $path = array();
	
	protected function index() {
		$this->language->load('module/category');
		
    	$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->load->model('catalog/category');
		$this->load->model('tool/seo_url');
		
		if (isset($this->request->get['path'])) {
			$this->path = explode('_', $this->request->get['path']);
			
			$this->category_id = end($this->path);
		}
		
		$this->data['category'] = $this->getCategories(0);
		$this->data['categories'] = $this->getCategoryList(0);
												
		$this->id = 'category';

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/category.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/category.tpl';
		} else {
			$this->template = 'default/template/module/category.tpl';
		}
		
		$this->render();
  	}
	
	protected function getCategories($parent_id, $current_path = '') {
		$category_id = array_shift($this->path);
		
		$output = '';
		
		$results = $this->model_catalog_category->getCategories($parent_id);
		
		if ($results) { 
			$output .= '<ul>';
    	}
		
		foreach ($results as $result) {	
			if (!$current_path) {
				$new_path = $result['category_id'];
			} else {
				$new_path = $result['category_id'];
			}
			
			$output .= '<li class="id_'.$result['category_id'].'">';
			
			if($result['category_id'] == 100){
				$output .= "<img src='/catalog/view/theme/football/images/icon_tag.png' id='sale-tag' />";
			}
			
			$children = '';
			
			if ($category_id == $result['category_id']) {
				$children = $this->getCategories($result['category_id'], $new_path);
			}
			
			if ($this->category_id == $result['category_id']) {
				$output .= '<a href="' . $this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path)  . '"><b>' . $result['name'] . '</b></a>';
			} else {
				$output .= '<a href="' . $this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path)  . '">' . $result['name'] . '</a>';
			}
			
        	$output .= $children;
        
        	$output .= '</li>'; 
		}
 
		if ($results) {
			$output .= '</ul>';
		}
		
		return $output;
	}
	
	protected function getCategories_array($parent_id, $current_path = '') {
		
		$output = array();
		
		$results = $this->model_catalog_category->getCategories($parent_id, 'alpha');
		
		foreach ($results as $result) {	
		
			$new_path = $result['category_id'];
			
			if($result['parent_id'] != '0'){
				$output[] = array(
					'name'	=> $result['name'],
					'menu_text'	=> $result['menu_text'],
					'href'	=>$this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $new_path)
				);
			}
		
		}
		
		return $output;
	}	
	
	protected function getCategoryList($parent_id, $level = 1){
		
		
		$output = '<ul class="level_'.$level.'">';		
		$results = $this->model_catalog_category->getCategories($parent_id);
		$level++;
			
		foreach($results as $result){	
			
			$output .= '<li id="id_'.$result['category_id'].'">';
			
			if($result['category_id'] == 100){
				$output .= "<img src='/catalog/view/theme/football/images/icon_tag.png' id='sale-tag' />";
			}
			
			$output .= '<a href="'.$this->model_tool_seo_url->rewrite(HTTP_SERVER . 'index.php?route=product/category&amp;path=' . $result['category_id']).'">' . ($result['menu_text'] ? $result['menu_text'] : $result['name']) . '</a>';
			
			if($level <= 2){
				$subCats = $this->model_catalog_category->getCategories($result['category_id']);	
				if($subCats){ $output .= $this->getCategoryList($result['category_id'], $level); }
			}
			
			$output .= '</li>';
			
		}
		
		$output .= '</ul>';		
		return $output;
	}
}
?>