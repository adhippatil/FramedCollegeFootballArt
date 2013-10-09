<?php
class ModelSaleGiftVoucher extends Model {
	public function addGiftVoucher($data) {
      	$this->db->query("INSERT INTO " . DB_PREFIX . "gift_voucher SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($data['code']) . "', balance = '" . (float)$data['balance'] . "', shipping = '" . (int)$data['shipping'] . "', tax = '" . (int)$data['tax'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

      	return $this->db->getLastId();
    }
	
	public function editGiftVoucher($gift_voucher_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "gift_voucher SET order_id = '" . (int)$data['order_id'] . "', code = '" . $this->db->escape($data['code']) . "', balance = '" . (float)$data['balance'] . "', shipping = '" . (int)$data['shipping'] . "', tax = '" . (int)$data['tax'] . "', date_start = '" . $this->db->escape($data['date_start']) . "', date_end = '" . $this->db->escape($data['date_end']) . "', status = '" . (int)$data['status'] . "' WHERE gift_voucher_id = '" . (int)$gift_voucher_id . "'");

	}
	
	public function deleteGiftVoucher($gift_voucher_id) {
      	$this->db->query("DELETE FROM " . DB_PREFIX . "gift_voucher WHERE gift_voucher_id = '" . (int)$gift_voucher_id . "'");
	}
	
	public function getGiftVoucher($gift_voucher_id) {
      	$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "gift_voucher WHERE gift_voucher_id = '" . (int)$gift_voucher_id . "'");
		
		return $query->row;
	}
	
	public function getIssuedGiftVouchersForOrder($order_id) {
		$gift_vouchers = array();
		
      	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gift_voucher WHERE order_id = '" . (int)$order_id . "'");
		
      	foreach ($query->rows as $result) {
      		$gift_vouchers[] = array(
      			'gift_voucher_id' 	=> $result['gift_voucher_id'],
      			'code' 				=> $result['code'],
      			'balance'			=> $result['balance']
      		);
      	}
		return $gift_vouchers;
	}
	
	public function getUsedGiftVouchersForOrder($order_id) {
		$gift_vouchers = array();
		
      	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gift_voucher gv LEFT JOIN " . DB_PREFIX . "gift_voucher_history gvh ON (gv.gift_voucher_id = gvh.gift_voucher_id) WHERE gvh.order_id = '" . (int)$order_id . "' AND gvh.status = '1'");
		
      	foreach ($query->rows as $result) {
      		$gift_vouchers[] = array(
      			'gift_voucher_id' 	=> $result['gift_voucher_id'],
      			'code' 				=> $result['code'],
      			'amount' 			=> $result['amount'],
      			'balance'			=> $result['balance']
      		);
      	}
		return $gift_vouchers;
	}
	
	public function getGiftVouchers($data = array()) {
		$sql = "SELECT gv.gift_voucher_id, gv.order_id, gv.code, gv.balance, gv.shipping, gv.tax, gv.date_start, gv.date_end, gv.status FROM " . DB_PREFIX . "gift_voucher gv";
		
		$sort_data = array(
			'gv.order_id',
			'gv.code',
			'gv.balance',
			'gv.shipping',
			'gv.tax',
			'gv.date_start',
			'gv.date_end',
			'gv.status'
		);	
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY gv.order_id";	
		}
			
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}			

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	
			
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}		
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}
	
	public function getGiftVoucherProducts() {
		$gift_voucher_product_data = array();
		
		$query = $this->db->query("SELECT product_id FROM " . DB_PREFIX . "gift_voucher_product");
		
		foreach ($query->rows as $result) {
			$gift_voucher_product_data[] = $result['product_id'];
		}
		
		return $gift_voucher_product_data;
	}
	
	public function getTotalGiftVouchers() {
      	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "gift_voucher");
		
		return $query->row['total'];
	}		
}
?>