<?php
#############################################################################
#	Version 1.2011.11.06
#  	Original developed to OpenCart 1.5.1 by  Joel Correia, web: www.joelcorreia.com email: email@joelcorreia.com
#
#############################################################################
class ControllerModuleproductsimporter extends Controller {
	private $error = array();

	public function index()
	{

		$this->load->language('module/products_importer');

		$this->document->setTitle = $this->language->get('heading_title');

		$this->load->model('setting/setting');

		$this->data['observations'] = "";

		$this->load->model('localisation/tax_class');
		$this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

    	$this->load->model('catalog/category');
		$this->data['categories'] = $this->model_catalog_category->getCategories(0);

		$this->data['text_none'] =  $this->language->get('text_none');
		$this->data['default_category_title'] =  $this->language->get('default_category_title');
		$this->data['default_tax_title'] =  $this->language->get('default_tax_title');
		$this->data['default_product_title'] =  $this->language->get('default_product_title');
		$this->data['default_image_download_title'] =  $this->language->get('default_image_download_title');
		$this->data['update_products_if_model_text_equal'] =  $this->language->get('update_products_if_model_text_equal');

		$this->data['text_csv_file_example_link'] =  $this->language->get('text_csv_file_example_link');
		$this->data['text_csv_head_example'] =  $this->language->get('text_csv_head_example');
		$this->data['text_csv_row_example'] =  $this->language->get('text_csv_row_example');
		$this->data['text_csv_example_title'] =  $this->language->get('text_csv_example_title');

		$this->data['text_product_row_options'] =  $this->language->get('text_product_row_options');
		$this->data['text_settings'] =  $this->language->get('text_settings');
		$this->data['text_delimiter'] =  $this->language->get('text_delimiter');
		$this->data['text_enclosure'] =  $this->language->get('text_enclosure');
		$this->data['text_escape'] =  $this->language->get('text_escape');
		$this->data['text_execute'] =  $this->language->get('text_execute');

		$this->data['text_import_or_sincronize_title'] =  $this->language->get('text_import_or_sincronize_title');
		$this->data['text_export_title'] =  $this->language->get('text_export_title');
		$this->data['text_download_csv_title'] =  $this->language->get('text_download_csv_title');
		$this->data['text_download_csv_observations'] =  $this->language->get('text_download_csv_observations');

		$this->load->model('catalog/product');
		$this->data['products'] = $this->model_catalog_product->getProducts(0);

		$this->data['product_id'] =  0;
		$this->data['tax_class_id'] =  0;
		$this->data['category_id'] =  0;


		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate()))
		{
			$this->model_setting_setting->editSetting('products_importer', $this->request->post);
			$this->load->model('catalog/category');


			if (isset($this->request->post['tax_class_id']))
				$this->data['tax_class_id'] = $this->request->post['tax_class_id'];

			if (isset($this->request->post['category_id']))
				$this->data['category_id'] = $this->request->post['category_id'];

			if (isset($this->request->post['product_id']))
				$this->data['product_id'] = $this->request->post['product_id'];

			if (isset($this->request->post['update_products']))
				$update_products = true;
			else
				$update_products = false;

				$target_path = DIR_IMAGE;
				$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path))
				{
					$handle = fopen($target_path, "r");
					$seconds_rows = false;
					$number_of_cvs_products = -1;
					$number_of_new_products = 0;
					$number_of_update_products = 0;

					$delimiter = ',';
					$enclosure = '"';
					$escape = '\\';

					if (isset($this->request->post['delimiter']))
				 		$delimiter = $this->request->post['delimiter'];

				 	if (isset($this->request->post['enclosure']))
				 		$enclosure = $this->request->post['enclosure'];

				 	if (isset($this->request->post['escape']))
				 		$escape = $this->request->post['escape'];


					while (($produto_csv0 = fgetcsv($handle, 1000,$delimiter[0],$enclosure[0],$escape[0])) !== FALSE)
					{
						$number_of_cvs_products++;
						if($seconds_rows)
						{
							$name0 = utf8_encode($produto_csv0[0]);
							$quantity0 = $produto_csv0[1];
							$price0 = $produto_csv0[2];
							$image_url0 = urldecode($produto_csv0[3]);
							$product_description0 = utf8_encode($produto_csv0[4]);
							$sku0 = utf8_encode($produto_csv0[5]);
							$upc0 = utf8_encode($produto_csv0[6]);
							$weight0 = $produto_csv0[7];
							$category_name0 = $produto_csv0[8];

							//manufacturer_id
							//$this->load->model('catalog/manufacturer');
							//$this->data['categories'] = $this->model_catalog_manufacturer->getManufacturers(0);

							$query_product_exists0 = $this->db->query("SELECT IFNULL(product_id,0) product_id FROM " . DB_PREFIX . "product WHERE model = '" . mysql_real_escape_string($name0) . "' LIMIT 1 UNION SELECT 0");
							$product_id0 = $query_product_exists0->row['product_id'];
							if($product_id0>0 && $update_products)
							{
								$number_of_update_products++;
								$data_new_product0 = $this->model_catalog_product->getProduct($product_id0);
							}
							else
							{
								$number_of_new_products++;
								$data_new_product0 = $this->model_catalog_product->getProduct($this->data['product_id']);
							}

							//category
							$query_category_exists0 = $this->db->query("SELECT IFNULL(category_id,0) category_id FROM " . DB_PREFIX . "category_description WHERE name = '" . mysql_real_escape_string($category_name0) . "' LIMIT 1 UNION SELECT 0");
							$category_id0 = $query_category_exists0->row['category_id'];
							$data_new_product0['product_category'] = ($category_id0>0) ? array($category_id0) : array($this->data['category_id']);


							$data_new_product0['model'] = $name0;
							if($quantity0!='')
								$data_new_product0['quantity'] = $quantity0;
							if($price0!='')
								$data_new_product0['price'] = $price0;
							if($sku0!='')
								$data_new_product0['sku'] = $sku0;
							if($upc0!='')
								$data_new_product0['upc'] = $upc0;
							if($weight0!='')
								$data_new_product0['weight'] = $weight0;

							$this->load->model('localisation/language');
							$this->data['languages'] = $this->model_localisation_language->getLanguages();

							foreach ($this->data['languages'] as $language)
							{
								$product_meta_keyword0 = $product_description0;
								$product_meta_description0 = $product_description0;

								if($product_id0>0 && $update_products)
								{
									$results0 = $this->db->query("SELECT IFNULL(description,'') description,IFNULL(meta_keyword,'') meta_keyword,IFNULL(meta_description,'') meta_description  FROM " . DB_PREFIX . "product_description WHERE product_id = " . mysql_real_escape_string($product_id0) . " AND language_id=" . mysql_real_escape_string($language['language_id']) . " UNION SELECT '','','' LIMIT 1");

									$product_description0 = $results0->row['description'];
									$product_meta_keyword0 = $results0->row['meta_keyword'];
									$product_meta_description0 = $results0->row['meta_description'];
								}
								else
								{
									if($product_description0=='') //required field in case of new product
									{
										$product_description0 = $name0;
										$product_meta_keyword0 = $name0;
										$product_meta_description0 = $name0;
									}
								}

								$data_new_product0['product_description'][$language['language_id']] =
								array(
									'name'             => $name0,
									'description'      => $product_description0,
									'meta_keyword'     => $product_meta_keyword0,
									'meta_description' => $product_meta_description0
								);
							}

							$data_new_product0['product_tag'] = array($name0);
							$data_new_product0['tax_class_id'] = $this->data['tax_class_id'];
							$data_new_product0['product_store'] = array(0);


							$image_name0 = basename($image_url0);
							if (!file_exists(DIR_IMAGE . $image_name0))
							{
								if($this->request->post['image_download'] == 'allow_url_fopen')
								{
									file_put_contents(DIR_IMAGE . $image_name0 , file_get_contents($image_url0));
								}
								else
								{
									$ch = curl_init(file_get_contents($image_url0));
									$fp = fopen(DIR_IMAGE . $image_name0, 'wb');
									curl_setopt($ch, CURLOPT_FILE, $fp);
									curl_setopt($ch, CURLOPT_HEADER, 0);
									curl_exec($ch);
									curl_close($ch);
									fclose($fp);
								}
							}
							//else
							//	$image_name0 = 'no_image.jpg';
							if($image_name0!='')
							{
								$data_new_product0['image'] =  $image_name0;

								$data_new_product0['product_image'] = array(
											'image'   =>  $image_name0
								);
							}

							if(strlen($data_new_product0['model']) > 0)
							{
								if($product_id0>0 && $update_products)
								{
									$this->model_catalog_product->editProduct($product_id0, $data_new_product0);
								}
								else
								{
									$this->model_catalog_product->addProduct($data_new_product0);
								}
							}
						}
						$seconds_rows = true;
					}
					fclose($handle);
					unlink($target_path);

					$this->data['observations']  = sprintf($this->language->get('number_of_product_imported'), $number_of_cvs_products,$number_of_new_products,$number_of_update_products);
				}
				else
				{
				     $this->data['observations'] = $this->language->get('error_upload_cvs');
				}

			$this->session->data['success'] = $this->language->get('text_success') . $this->data['observations'];
			
			$redirect = HTTPS_SERVER . 'index.php?route=module/products_importer&token=' . $this->session->data['token'];
			$this->redirect($redirect, 'SSL');
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');

		$this->data['text_choose_file_upload'] = $this->language->get('text_choose_file_upload');
		$this->data['text_upload_file'] = $this->language->get('text_upload_file');

		$this->data['entry_version_status'] = $this->language->get('entry_version_status');
		$this->data['entry_author'] = $this->language->get('entry_author');
		$this->data['entry_help'] = $this->language->get('entry_help');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
        $this->data['button_add_module'] = $this->language->get('button_add_module');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['tab_general'] = $this->language->get('tab_general');

 		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}
		if (isset($this->error['sort_order'])) {
			$this->data['error_sort_order'] = $this->error['sort_order'];
		} else {
			$this->data['error_sort_order'] = '';
		}
		if (isset($this->error['code'])) {
			$this->data['error_code'] = $this->error['code'];
		} else {
			$this->data['error_code'] = '';
		}

        $this->data['breadcrumbs'] = array();

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=common/home&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_home'),
      		'separator' => FALSE
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=extension/module&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('text_module'),
      		'separator' => ' :: '
   		);

   		$this->data['breadcrumbs'][] = array(
       		'href'      => HTTPS_SERVER .'index.php?route=module/products_importer&token=' . $this->session->data['token'],
       		'text'      => $this->language->get('heading_title'),
      		'separator' => ' :: '
   		);

		$this->data['action'] = HTTPS_SERVER . 'index.php?route=module/products_importer&token=' . $this->session->data['token'];

		$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/module&token=' . $this->session->data['token'];

		$this->data['export_csv'] = HTTPS_SERVER . 'index.php?route=module/products_importer/download&token=' . $this->session->data['token'];

		$this->data['modules'] = array();

		if (isset($this->request->post['products_importer_module'])) {
			$this->data['modules'] = $this->request->post['products_importer_module'];
		} elseif ($this->config->get('products_importer_module')) {
			$this->data['modules'] = $this->config->get('products_importer_module');
		}


        //$this->load->model('design/layout');

		//$this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'module/products_importer.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
	}

	private function validate() {

		if (!$this->user->hasPermission('modify', 'module/products_importer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function download() {
		if ($this->validate()) {

			// set appropriate memory and timeout limits
			//ini_set("memory_limit","128M");
			//set_time_limit( 1800 );

			// send the categories, products and options as a spreadsheet file
			//$this->load->model('tool/export');
			//$this->model_tool_export->download();

			$csv_file = 'NAME,CATEGORY,MODEL,QUANTITY,PRICE,IMAGE_URL,DESCRIPTION,';

			$query = $this->db->query("SELECT model,quantity,price,sku,image,width,weight,description,name, IFNULL((SELECT name FROM " . DB_PREFIX . "category_description WHERE " . DB_PREFIX . "category_description.category_id=" . DB_PREFIX . "product_to_category.category_id LIMIT 1),'') category FROM " . DB_PREFIX . "product," . DB_PREFIX . "product_description," . DB_PREFIX . "product_to_category WHERE " . DB_PREFIX . "product.product_id=" . DB_PREFIX . "product_description.product_id AND " . DB_PREFIX . "product_to_category.product_id=" . DB_PREFIX . "product.product_id ORDER BY category");
			
			foreach ($query->rows as $result) {
				
				$csv_file =sprintf(
					"%s\n%s,%s,%s,%s%s,%s,%s,%s",
					$csv_file,
					str_replace(","," ",$result['name']),
					$result['category'],
					$result['model'],
					$result['quantity'],
					$result['price'],
					str_replace('admin/index.php?route=','',''),
					$result['image'],
					str_replace("&nbsp;", " ", str_replace(","," ",str_replace("\r",'',strip_tags(str_replace("\n",'',$this->unhtmlentities($result['description']))))))
				);
				
			}

			$this->response->addHeader('Content-Type: text/txt;');
			$this->response->addHeader(sprintf('Content-Disposition: attachment; filename=cvsfile%s.csv',date("Ymd")));
			$this->response->setOutput($csv_file);

		} else {

			// return a permission error page
			return $this->forward('error/permission');
		}
	}
	
	function unhtmlentities($string){
		
		// replace numeric entities
		$string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
		$string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
		// replace literal entities
		$trans_tbl = get_html_translation_table(HTML_ENTITIES);
		$trans_tbl = array_flip($trans_tbl);
		return strtr($string, $trans_tbl);
	}

}
?>