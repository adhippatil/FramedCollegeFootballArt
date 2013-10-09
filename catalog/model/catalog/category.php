<?php
class ModelCatalogCategory extends Model {
	public function getCategory($category_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.category_id = '" . (int)$category_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");
		
		return $query->row;
	}
	
	public function getCategories($parent_id = 0, $sort = '') {


		if($sort == 'alpha') {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c, " . DB_PREFIX . "category_description cd WHERE c.category_id = cd.category_id AND c.status = '1' AND c.sort_order <> '-1' ORDER BY cd.name");

			$category_data = $query->rows;

		} else {
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_description cd ON (c.category_id = cd.category_id) LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' AND c.sort_order <> '-1' ORDER BY c.sort_order, LCASE(cd.name)");

			$category_data = $query->rows;

		}

		return $category_data;
	}
				
	public function getTotalCategoriesByCategoryId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "category c LEFT JOIN " . DB_PREFIX . "category_to_store c2s ON (c.category_id = c2s.category_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1' AND c.sort_order <> '-1'");
		
		return $query->row['total'];
	}
	
	public function getCategoriesList() {

		$category_data = array();
		
		$query = $this->db->query("SELECT cd.name, c.category_id FROM category_description cd, category c WHERE c.category_id=cd.category_id AND c.parent_id<>0 ORDER BY cd.name;");
		foreach($query->rows as $q){
			$category_data[] = array(
				'name'	=> $q['name'],
				'id'	=> $q['category_id']
			);	
		}

		return $category_data;
	}
}
?>