<?php
/*
 * @copyright Copyright (c) 2011 Shilovsky Andrej (an911@ukr.net)
 */
class ControllerModuleAdvancedSearch extends Controller {
	public function index() {

            $this->language->load('module/advancedsearch');
            $url = '';

            if (isset($this->request->get['keyword'])) {
                    $url .= '&keyword=' . $this->request->get['keyword'];
            }

            if (isset($this->request->get['category_id'])) {
                    $url .= '&category_id=' . $this->request->get['category_id'];
            }

            if (isset($this->request->get['description'])) {
                    $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['model'])) {
                    $url .= '&model=' . $this->request->get['model'];
            }

            if (isset($this->request->get['sort'])) {
                    $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                    $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                    $url .= '&page=' . $this->request->get['page'];
            }

   

            $this->data['heading_title'] = $this->language->get('heading_title');

            $this->data['text_critea'] = $this->language->get('text_critea');
            $this->data['text_search'] = $this->language->get('text_search');
            $this->data['text_keyword'] = $this->language->get('text_keyword');
            $this->data['text_category'] = $this->language->get('text_category');
            $this->data['text_empty'] = $this->language->get('text_empty');
            $this->data['text_sort'] = $this->language->get('text_sort');
            $this->data['text_price'] = $this->language->get('text_price');
            $this->data['text_pricemin'] = $this->language->get('text_pricemin');
            $this->data['text_pricemax'] = $this->language->get('text_pricemax');
            $this->data['text_manufacturer'] = $this->language->get('text_manufacturer');


            $this->data['entry_search'] = $this->language->get('entry_search');
            $this->data['entry_description'] = $this->language->get('entry_description');
            $this->data['entry_model'] = $this->language->get('entry_model');
            $this->data['entry_category'] = $this->language->get('entry_category');
            $this->data['entry_manufacture'] = $this->language->get('entry_manufacture');

            $this->data['button_search'] = $this->language->get('button_search');

            if (isset($this->request->get['page'])) {
                    $page = $this->request->get['page'];
            } else {
                    $page = 1;
            }

            if (isset($this->request->get['sort'])) {
                    $sort = $this->request->get['sort'];
            } else {
                    $sort = 'p.sort_order';
            }

            if (isset($this->request->get['order'])) {
                    $order = $this->request->get['order'];
            } else {
                    $order = 'ASC';
            }

            if (isset($this->request->get['keyword'])) {
                    $this->data['keyword'] = $this->request->get['keyword'];
            } else {
                    $this->data['keyword'] = '';
            }

            if (isset($this->request->get['category_id'])) {
                    $this->data['category_id'] = $this->request->get['category_id'];
            } else {
                    $this->data['category_id'] = '';
            }

           if (isset($this->request->get['manufacturer_id'])) {
                    $this->data['manufacturer_id'] = $this->request->get['manufacturer_id'];
            } else {
                    $this->data['manufacturer_id'] = '';
            }

            if (isset($this->request->get['pricemin']) && $this->request->get['pricemin'] != "min price") {
                    $this->data['pricemin'] = $this->request->get['pricemin'];
            } else {
                    $this->data['pricemin'] = '';
            }

            if (isset($this->request->get['pricemax']) && $this->request->get['pricemax'] != "max price") {
                    $this->data['pricemax'] = $this->request->get['pricemax'];
            } else {
                    $this->data['pricemax'] = '';
            }

            $this->load->model('catalog/category');

            $this->data['categories'] = $this->getCategories(0);


            $this->load->model('catalog/manufacturer');
            $this->data['manufacturers'] = array();

            $results = $this->model_catalog_manufacturer->getManufacturers();

            foreach ($results as $result) {
                    $this->data['manufacturers'][] = array(
                            'manufacturer_id' => $result['manufacturer_id'],
                            'name'            => $result['name']
                    );
            }




            if (isset($this->request->get['description'])) {
                    $this->data['description'] = $this->request->get['description'];
            } else {
                    $this->data['description'] = '';
            }

            if (isset($this->request->get['model'])) {
                    $this->data['model'] = $this->request->get['model'];
            } else {
                    $this->data['model'] = '';
            }

            $this->id = 'advancedsearch';

            if ($this->config->get('advancedsearch_position') == 'home') {
                    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/advancedsearch_home.tpl')) {
                            $this->template = $this->config->get('config_template') . '/template/module/advancedsearch_home.tpl';
                    } else {
                            $this->template = 'default/template/module/advancedsearch_home.tpl';
                    }
            } else {
                    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/advancedsearch.tpl')) {
                            $this->template = $this->config->get('config_template') . '/template/module/advancedsearch.tpl';
                    } else {
                            $this->template = 'default/template/module/advancedsearch.tpl';
                    }
            }

            $this->render();
  	}

	private function getCategories($parent_id, $level = 0) {
		$level++;

		$data = array();

		$results = $this->model_catalog_category->getCategories($parent_id);

		foreach ($results as $result) {
			$data[] = array(
				'category_id' => $result['category_id'],
				'name'        => str_repeat('&nbsp;&nbsp;&nbsp;', $level) . $result['name']
			);

			$children = $this->getCategories($result['category_id'], $level);

			if ($children) {
			  $data = array_merge($data, $children);
			}
		}

		return $data;
	}	
}
?>