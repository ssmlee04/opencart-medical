<?php
class ModelCatalogPurchase extends Model {

	// '2014-09-27 03:16'
	function getPurchase($purchase_id) {

		return $this->db->query("SELECT * FROM oc_purchase WHERE purchase_id = '" . (int)$purchase_id . "'")->row;
	}

	// '2014-09-27 03:16'
	function getPurchaseProducts($purchase_id) {

		return $this->db->query("SELECT * FROM oc_purchase_product pp LEFT JOIN oc_product p ON p.product_id = pp.product_id LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND purchase_id = '" . (int)$purchase_id . "'")->rows;
	}

	function getPurchases($data) {

		$sql = "SELECT * FROM oc_purchase p "; 

		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_purchased'])) {
			$sql .= " AND date_purchased = '" . $this->db->escape($data['filter_date_purchased']) . "'";	
		}

		if (isset($data['filter_date_added'])) {
			$sql .= " AND date_added = '" . $this->db->escape($data['filter_date_added']) . "'";	
		}

		if (isset($data['filter_total_min'])) {
			$sql .= " AND total >= '" . (int)$data['filter_total_min']. "'";	
		}

		if (isset($data['filter_total_max'])) {
			$sql .= " AND total <= '" . (int)$data['filter_total_max']. "'";	
		}

		$sort_data = array(
			'p.total',
			'p.store_id',
			'p.user_id',
			'p.date_added', 
			'p.status',
			'p.sort_order'
		);	

		// if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		// 	$sql .= " ORDER BY " . $data['sort'];	
		// } else {
		// 	$sql .= " ORDER BY p.purchase_id ";	
		// }

		$sql .= " ORDER BY p.date_added DESC";
		// if (isset($data['order']) && ($data['order'] == 'DESC')) {
		// 	$sql .= " DESC";
		// } else {
		// 	$sql .= " ASC";
		// }

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}				

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}	

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}	

		return $this->db->query($sql)->rows;
	}

	function getTotalPurchases($data) {

		$sql = "SELECT count(*) as total FROM oc_purchase p "; 

		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_purchased'])) {
			$sql .= " AND date_purchased = '" . $this->db->escape($data['filter_date_purchased']) . "'";	
		}

		if (isset($data['filter_date_added'])) {
			$sql .= " AND date_added = '" . $this->db->escape($data['filter_date_added']) . "'";	
		}

		if (isset($data['filter_total_min'])) {
			$sql .= " AND total >= '" . (int)$data['filter_total_min']. "'";	
		}

		if (isset($data['filter_total_max'])) {
			$sql .= " AND total <= '" . (int)$data['filter_total_max']. "'";	
		}

		$sort_data = array(
			'p.total',
			'p.store_id',
			'p.user_id',
			'p.date_added', 
			'p.status',
			'p.sort_order'
		);	

		// if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		// 	$sql .= " ORDER BY " . $data['sort'];	
		// } else {
		// 	$sql .= " ORDER BY p.purchase_id ";	
		// }

		// if (isset($data['order']) && ($data['order'] == 'DESC')) {
		// 	$sql .= " DESC";
		// } else {
		// 	$sql .= " ASC";
		// }

		// if (isset($data['start']) || isset($data['limit'])) {
		// 	if ($data['start'] < 0) {
		// 		$data['start'] = 0;
		// 	}				

		// 	if ($data['limit'] < 1) {
		// 		$data['limit'] = 20;
		// 	}	

		// 	$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		// }	

		return $this->db->query($sql)->row['total'];
	}

	// '2014-09-27 03:16'
	public function addPurchase($data) {

		$this->db->query("INSERT INTO `" . DB_PREFIX . "purchase` SET store_id = '" . (int)$data['store_id'] . "', user_id = '" . (int)$data['user_id'] . "', purchase_status_id = '" . (int)$data['purchase_status_id'] . "', date_purchased = '" . $this->db->escape($data['date_purchased']) . "', date_added = NOW(), date_modified = NOW()");

		$purchase_id = $this->db->getLastId();

		$this->editPurchase($purchase_id, $data);

	}

	// '2014-09-27 03:16'
	public function editPurchase($purchase_id, $data) {

		$store_id = isset($data['store_id']) ? $data['store_id'] : 0;

		$user_id = isset($data['user_id']) ? $data['user_id'] : 0;

		// Restock products before subtracting the stock later on ****
		$purchase_query_prev = $this->db->query("SELECT * FROM `" . DB_PREFIX . "purchase` WHERE purchase_status_id > '0' AND purchase_id = '" . (int)$purchase_id . "'");
// $this->load->out($purchase_query_prev);
		// if (!$purchase_query_prev->num_rows && !isset($data['purchase_product'])) {
		// 	// delete me 
		// 	$this->db->query("DELETE FROM " . DB_PREFIX . "purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'"); 
		// 	$this->db->query("DELETE FROM " . DB_PREFIX . "purchase WHERE purchase_id = '" . (int)$purchase_id . "'"); 
		// 	return true;
		// }

		$store_id_prev = $purchase_query_prev->row['store_id'];

		$user_id_prev = $purchase_query_prev->row['user_id'];


		if (!$store_id_prev ) return false;
		if (!$store_id && $data['purchase_product']) return false;
		if (!$user_id && $data['purchase_product']) return false;

		$purchase_products_prev = $this->db->query("SELECT * FROM oc_purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'");

		$canproceed = true;

		if ($store_id_prev != $store_id) {
			// calculate quantity this way

			// foreach ($data['purchase_product'] as $key => $value_new) {

			// 	if (!$value_new['product_id']) return false;

			// 	if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id')");

			// 	if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id_prev')");

			// 	$found = false;
			// 	$store_product = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '" .$value_new['product_id'] . "'");

				foreach ($purchase_products_prev->rows as $key2 => $value_old) { 
					
					if (!$value_old['product_id']) return false;

					// if ($value_old['product_id'] == $value_new['product_id']) {
						
						$store_product = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '" .$value_old['product_id'] . "'");

						if ($store_product->row['quantity'] - $value_old['quantity'] <0) {
							$canproceed = false;
						}
					// }
				}
			// }

		} else {
			// calculate quantity

			foreach ($data['purchase_product'] as $key => $value_new) {

				if (!$value_new['product_id']) return false;

				if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id')");

				if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id_prev')");

				$found = false;

				$store_product = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '" .$value_new['product_id'] . "'");

				foreach ($purchase_products_prev->rows as $key2 => $value_old) { 
					
					if (!$value_old['product_id']) return false;

					if ($value_old['product_id'] == $value_new['product_id']) {
						
						$found = true;

						if ($store_product->row['quantity'] - $value_old['quantity'] + $value_new['quantity'] <0) {
							$canproceed = false;
						}
					}
				}
			}
		}


		if (!$canproceed) return false;

		// restock 
		// if ($data['purchase_product']) {
		// 	foreach ($data['purchase_product'] as $key => $value) {

		// 		$product_idt = $value['product_id'];
				
		// 		$quantityt = $value['quantity'];
				
		// 		$qq = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '$product_idt'");
		// 		if (!$qq->num_rows) {
		// 			return false;
		// 		}
		// 		if ($qq->row['quantity'] < $quantityt) {
		// 			return false;
		// 		}
		// 	}
		// } 

		// if ($purchase_query_prev->num_rows) {
			
			// $product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'");

			// '2014-09-08 21:04'
		//restock
		
			foreach($purchase_products_prev->rows as $product) {
			// foreach($product_query->rows as $product) {

				// if ($store_id && $product['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$product['product_id']. "', '$store_id')");
				// if ($store_id_prev && $product['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$product['product_id']. "', '$store_id_prev')");
				$this->db->query("UPDATE `" . DB_PREFIX . "product_to_store` SET quantity = (quantity - " . (int)$product['quantity'] . ") WHERE product_id = '" . (int)$product['product_id'] . "' AND store_id = '$store_id_prev'");
			}
		// }


		$this->db->query("DELETE FROM " . DB_PREFIX . "purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'"); 

		$grandtotal = 0;

		if (isset($data['purchase_product'])) {
			foreach ($data['purchase_product'] as $purchase_product) {

				$total = (int)$purchase_product['quantity'] * (float)$purchase_product['cost'];

				$grandtotal = $grandtotal + $total;
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "purchase_product SET purchase_id = '" . (int)$purchase_id . "', product_id = '" . (int)$purchase_product['product_id'] . "',  quantity = '" . (int)$purchase_product['quantity'] . "', cost = '" . (float)$purchase_product['cost'] . "', total = '" . $total . "'");

				$purchase_product_id = $this->db->getLastId();

				$this->db->query("INSERT INTO oc_product_to_store (quantity, product_id, store_id) VALUES ('" . (int)$purchase_product['quantity'] . "', '" . (int)$purchase_product['product_id'] . "', '$store_id') ON DUPLICATE KEY UPDATE quantity = (quantity + " . (int)$purchase_product['quantity'] . ")");
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "purchase` SET total = '$grandtotal'
			, purchase_status_id = '" . (int)$data['purchase_status_id'] . "'
			, date_purchased = '" . $this->db->escape($data['date_purchased']) . "'
			, image1 = '" . $this->db->escape($data['image1']) . "'
			, image2 = '" . $this->db->escape($data['image2']) . "'
			, image3 = '" . $this->db->escape($data['image3']) . "'
			, date_modified = NOW(), store_id = '" . (int)$store_id . "', user_id = '" . (int)$user_id . "' WHERE purchase_id = '" . (int)$purchase_id . "'");

			return true;
		} else {
			
			$this->db->query("DELETE FROM oc_purchase WHERE purchase_id = '$purchase_id'");

			return true;
		}

		
	}

	// '2014-09-27 03:17'
	public function deletePurchase($purchase_id, $remove_from_db = false) {

		return $this->editPurchase($purchase_id, null);

		// $purchase = $this->db->query("SELECT * FROM oc_purchase WHERE purchase_id = '" . (int)$purchase_id . "'");

		// if (!$purchase) return false;

		// $store_id = $purchase->row['store_id'];

		// $products = $this->getPurchaseProducts($purchase_id); 

		// $this->cart->clear();

		// foreach ($products as $product) {
		// 	$this->cart->add($product['product_id'], $product['quantity'], '', '');
		// }

		// if (!$this->cart->hasStock($store_id)) {
		// 	$this->cart->clear();			
		// 	return false;
		// }

		// $this->cart->clear();
		
		// $this->editPurchase($purchase_id, null);

		// $this->db->query("DELETE FROM `" . DB_PREFIX . "purchase` WHERE purchase_id = '" . (int)$purchase_id . "'");

		// $this->db->query("DELETE FROM " . DB_PREFIX . "purchase_product WHERE purchase_id = '" . (int)$purchase_id . "'");


		// return true;

	}

}	
?>