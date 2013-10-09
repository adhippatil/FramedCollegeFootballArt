<?php
class ModelTotalGiftVoucher extends Model {
	public function getTotal(&$total_data, &$total, &$taxes) {
		if (isset($this->session->data['gift_voucher']) && $this->config->get('gift_voucher_status')) {
			$this->load->model('checkout/gift_voucher');
			$this->load->language('module/gift_voucher');
			
			$coupon_applied = false;
			$gift_voucher_ids = array();
			$new_balance = null;
			
			foreach ($this->session->data['gift_voucher'] as $gift_voucher_code) {
				
				$gift_voucher = $this->model_checkout_gift_voucher->getGiftVoucher($gift_voucher_code);
							
				if ($gift_voucher && !in_array($gift_voucher['gift_voucher_id'],$gift_voucher_ids)) {
					
					$gift_voucher_ids[] = $gift_voucher['gift_voucher_id'];					
					
					// If there is already a coupon being used, apply it before applying the gift voucher
					if (isset($this->session->data['coupon']) && $coupon_applied == false) { 
						$this->load->model('checkout/coupon');
					 
						$coupon = $this->model_checkout_coupon->getCoupon($this->session->data['coupon']);
					
						if ($coupon) {
							$discount_total = 0;
							
							if (!$coupon['product']) {
								$coupon_total = $this->cart->getSubTotal();
							} else {
								$coupon_total = 0;
							
								foreach ($this->cart->getProducts() as $product) {
									if (in_array($product['product_id'], $coupon['product'])) {
										$coupon_total += $product['total'];
									}
								}					
							}
							
							if ($coupon['type'] == 'F') {
								$coupon['discount'] = min($coupon['discount'], $coupon_total);
							}
							
							foreach ($this->cart->getProducts() as $product) {
								$discount = 0;
								
								if (!$coupon['product']) {
									$status = TRUE;
								} else {
									if (in_array($product['product_id'], $coupon['product'])) {
										$status = TRUE;
									} else {
										$status = FALSE;
									}
								}
								
								if ($status) {
									if ($coupon['type'] == 'F') {
										$discount = $coupon['discount'] * ($product['total'] / $coupon_total);
									} elseif ($coupon['type'] == 'P') {
										$discount = $product['total'] / 100 * $coupon['discount'];
									}
							
									
								}
								
								$discount_total += $discount;
							}
							
							if ($coupon['shipping'] && isset($this->session->data['shipping_method'])) {
								
								
								$discount_total += $this->session->data['shipping_method']['cost'];				
							}				
			      			
							$coupon_total = $discount_total;
							
							$coupon_applied = true;
						} 
					}
					
					if ($new_balance == null) {
						$new_balance = $this->cart->getSubtotal();
					}
					
					if (isset($coupon_total) && $coupon_total <= $this->cart->getSubTotal()) {
						$discount_total = $new_balance - $coupon_total;
					} else {
						$discount_total = $new_balance;
					}
																		
					if ($gift_voucher['shipping'] && isset($this->session->data['shipping_method'])) {
						
						$discount_total += $this->session->data['shipping_method']['cost'];				
					}

					if ($gift_voucher['tax'] && $this->cart->getTaxes()) {
						foreach ($taxes as $tax) {
							$discount_total += $tax;
						}					
					}
					
					if($gift_voucher['product_exceptions']){
						
						$clearance_product_total = 0;
						foreach ($this->cart->getProducts() as $product) {
							
							if (in_array($product['product_id'], $gift_voucher['product_exceptions'])) {
								$clearance_product_total += $product['total'];
							}
						}	
													
						$discount_total -= $clearance_product_total;
					}
					
					
					if ($discount_total > $gift_voucher['balance']) {
						$discount_total = $gift_voucher['balance'];
					}					
										
					$balance_remaining = $gift_voucher['balance'] - $discount_total;

					if (!isset($this->session->data['gift_voucher_amount'])) { $this->session->data['gift_voucher_amount'] = array(); }
					$this->session->data['gift_voucher_amount'][$gift_voucher['gift_voucher_id']] = $discount_total;
					
					$total_data[] = array(
	        			'title'      => $this->language->get('text_gift_voucher_total'),
		    			'text'       => '-' . $this->currency->format($discount_total),
	        			'value'      => - $discount_total,
						'sort_order' => $this->config->get('gift_voucher_sort_order')
	      			);
	      			
					$total -= $discount_total;
					
					$new_balance -= $discount_total;
					
					if ($new_balance <= 0) { break; }
				}
			} 
		}
	}
}
?>