<?php    
class ControllerCommonPermission extends Controller {    
	public function check() {
		if (isset($this->request->get['route'])) {
			$route = $this->request->get['route'];
		  
			$part = explode('/', $route);
			
			$ignore = array(
				'common/home',
				'catalog/footer_links',
				'common/login',
				'common/logout',
				'common/permission',
				'common/filemanager',
				'error/error_403',
				'error/error_404'		
			);
			
			if (!in_array(@$part[0] . '/' . @$part[1], $ignore)) {
				if (!$this->user->hasPermission('access', @$part[0] . '/' . @$part[1])) {
					return $this->forward('error/permission');
				}
			}
		}
	}
}
?>