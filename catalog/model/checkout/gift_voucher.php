<?php
class ModelCheckoutGiftVoucher extends Model {
	public function getGiftVoucher($gift_voucher) {
		
		$gift_voucher_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gift_voucher WHERE UPPER(code) = UPPER('" . $this->db->escape($gift_voucher) . "') AND balance > 0 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");
			
		if ($gift_voucher_query->num_rows) {
			
			$num_products = $this->cart->countProducts();
			$product_data = $this->checkClearance();
			
			$gift_voucher_data = array(
				'gift_voucher_id'     => $gift_voucher_query->row['gift_voucher_id'],
				'code'          => $gift_voucher_query->row['code'],
				'order_id'      => $gift_voucher_query->row['order_id'],
				'balance'       => $gift_voucher_query->row['balance'],
				'shipping'      => $gift_voucher_query->row['shipping'],
				'tax'     	    => $gift_voucher_query->row['tax'],
				'date_start'    => $gift_voucher_query->row['date_start'],
				'date_end'      => $gift_voucher_query->row['date_end'],
				'status'        => $gift_voucher_query->row['status'],
				'date_added'    => $gift_voucher_query->row['date_added'],
				'product_exceptions'	=>	$product_data,
			);
			
			if($num_products == count($product_data)){
				return false;
			} else {
				return $gift_voucher_data;
			}
		} else {
			return false;
		}
	}
	
	public function checkGiftVoucher($gift_voucher) {
		
		$gift_voucher_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gift_voucher WHERE UPPER(code) = UPPER('" . $this->db->escape($gift_voucher) . "') AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) AND status = '1'");
			
		if ($gift_voucher_query->num_rows) {
			
			$num_products = $this->cart->countProducts();
			$product_data = $this->checkClearance();
			
			$gift_voucher_data = array(
				'gift_voucher_id'     => $gift_voucher_query->row['gift_voucher_id'],
				'code'          => $gift_voucher_query->row['code'],
				'order_id'      => $gift_voucher_query->row['order_id'],
				'balance'       => $gift_voucher_query->row['balance'],
				'shipping'      => $gift_voucher_query->row['shipping'],
				'tax'     	    => $gift_voucher_query->row['tax'],
				'date_start'    => $gift_voucher_query->row['date_start'],
				'date_end'      => $gift_voucher_query->row['date_end'],
				'status'        => $gift_voucher_query->row['status'],
				'date_added'    => $gift_voucher_query->row['date_added'],
				'product_exceptions'	=>	$product_data,
			);
			
			if($num_products == count($product_data)){
				return false;
			} else {
				return $gift_voucher_data;
			}
		} else {
			return false;
		}
	}
	
	public function reduceGiftVoucherBalance($gift_voucher_id, $amount) {
		
		if ($gift_voucher_id && $amount > 0) {
			$query = $this->db->query("SELECT balance FROM " . DB_PREFIX . "gift_voucher WHERE gift_voucher_id = '" . (int)$gift_voucher_id . "'");
			
			$balance = $query->row['balance'];
			
			if ($amount > $balance) {
				$new_balance = 0;
			} else {
				$new_balance = $balance - $amount;
			}
						
			$this->db->query("UPDATE " . DB_PREFIX . "gift_voucher SET balance = '" . (float)$new_balance . "' WHERE gift_voucher_id = '" . (int)$gift_voucher_id . "'");
		} 
	}	
	
	
	private function checkClearance(){
		
		$voucher_product_data = array();
		
		foreach ($this->cart->getProducts() as $product) {
			$product_category_data = array();	
			$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_to_category WHERE product_id = '" . (int)$product['product_id'] . "'");
	
			foreach ($query->rows as $result) {
				$product_category_data[] = $result['category_id'];						
			}
			
			if(in_array(100, $product_category_data)){
				$voucher_product_data[] = $product['product_id'];
			}
		}
		
		return $voucher_product_data;	
		
	}
}
?>