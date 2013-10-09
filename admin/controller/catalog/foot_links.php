<?php    
class ControllerCatalogManufacturer extends Controller { 
	private $error = array();
  
  	public function index() {
		$this->load->language('catalog/footer_links');
		$this->document->title = $this->language->get('heading_title');
		
		$from = "";
		if(isset($_POST['from']))
			$from = $_POST['from'];
			
		if($from == 'insert')
			$this->insert();
		elseif($from ==  'delete')
			$this->delete();
		elseif($from ==  'edit')
			$this->edit();
		elseif($from ==  'update')
			$this->update();
	
		
		$this->getList();
	}
  
  	public function insert() {
		
		$url = $_POST['url'];
		$title = $_POST['title'];
		$sort = $_POST['sort'];
		
		$sql = "INSERT INTO footer_links VALUES(NULL, '".$url."', '".$title."', '".$sort."');";
		$res = mysql_query($sql);
	}

	public function delete() {
		
		$id = $_POST['id'];
		
		$sql = "DELETE FROM footer_links WHERE id='".$id."';";
		$res = mysql_query($sql);
	}
	
	public function edit(){
		
		$id = $_POST['id'];
		$url = $_POST['url'];
		$title = $_POST['title'];
		$sort = $_POST['sort'];
		
		$this->data['action'] = "update";
		$this->data['uid'] = $id;
		$this->data['uurl'] = $url;
		$this->data['utitle'] = $title;
		$this->data['usort'] = $sort;	
	}
	
	public function update(){
		
		$id = $_POST['id'];
		$url = $_POST['url'];
		$title = $_POST['title'];
		$sort = $_POST['sort'];
		
		$sql = "UPDATE footer_links SET url='".$url."', title='".$title."', sort='".$sort."' WHERE id='".$id."';";
		mysql_query($sql);
	} 
    
  	private function getList() {
		
		$this->document->breadcrumbs = array();

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->document->breadcrumbs[] = array(
       		'href'      => HTTPS_SERVER . 'index.php?route=catalog/footer_links&token=' . $this->session->data['token'] . $url,
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);
							
		$this->data['insert'] = $this->url->https('catalog/footer_links/insert');
		//$this->data['delete'] = $this->url->https('catalog/footer_links/delete');
		
		$this->data['insert'] = HTTPS_SERVER . 'index.php?route=catalog/footer_links/insert&token=' . $this->session->data['token'];
		$this->data['delete'] = HTTPS_SERVER . 'index.php?route=catalog/footer_links/delete&token=' . $this->session->data['token'];	
		
		$this->data['links'] = array();		
		$sql = "SELECT * FROM footer_links ORDER BY sort;";
		$result = mysql_query($sql);
		while($info = mysql_fetch_array($result)){
			$this->data['links'][] = array(
				'id' => $info['id'],
				'url' => $info['url'],
				'sort' => $info['sort'],
				'title' => $info['title']
			);
		}
		
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_sort_order'] = $this->language->get('column_sort_order');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
 		
 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}
		
		$this->template = 'catalog/footer_list.tpl';
		$this->children = array(
			'common/header',	
			'common/footer'	
		);
		
		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}
}
?>