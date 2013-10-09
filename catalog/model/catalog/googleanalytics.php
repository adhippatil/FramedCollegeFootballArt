<?php
/*
 * Google Analytics PRO OpenCart Module
 * Author:		www.opencartstore.com
 * Version:		1.4.9.3
 * Support:		www.opencartstore.com/support
 * Email:		info@opencartstore.com
 * About:		Adds ecommerce tracking to your Google Analytics tracking.
 */

class ModelCatalogGoogleAnalytics extends Model {
	public function getCategoryName ($product_id) {
		$query = $this->db->query("SELECT " . DB_PREFIX . "category_description.name FROM " . DB_PREFIX . "category_description LEFT JOIN " . DB_PREFIX . "product_to_category ON " . DB_PREFIX . "product_to_category.category_id = " . DB_PREFIX . "category_description.category_id WHERE " . DB_PREFIX . "product_to_category.product_id = '" . (int)$product_id ."'");
		return $query->row;
	}
	
	public function getOrderDetails($orderId) {
		$query = $this->db->query("SELECT payment_city, payment_zone, payment_country, total FROM `" . DB_PREFIX . "order` WHERE order_id = '". (int)$orderId ."'");
		return $query->row;
	}
	
	public function getProductDetails($orderId, $productId) {
		$query = $this->db->query("SELECT name, model, price, tax, quantity FROM " . DB_PREFIX . "order_product WHERE order_id = '". (int)$orderId ."' AND product_id = '" . (int)$productId . "'");
		return $query->row;
	}
}

?>