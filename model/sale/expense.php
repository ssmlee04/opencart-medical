<?php
class ModelSaleExpense extends Model {

	// '2014-09-27 03:16'
	function getExpense($expense_id) {

		return $this->db->query("SELECT * FROM oc_expense WHERE expense_id = '" . (int)$expense_id . "'")->row;
	}

	function getExpenses($data) {

		$sql = "SELECT * FROM oc_expense p "; 

		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_expensed'])) {
			$sql .= " AND date_expensed = '" . $this->db->escape($data['filter_date_expensed']) . "'";	
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
		// 	$sql .= " ORDER BY p.expense_id ";	
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

	function getTotalExpenses($data) {

		$sql = "SELECT count(*) as total FROM oc_expense p "; 

		//$sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'"; 
		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_expensed'])) {
			$sql .= " AND date_expensed = '" . $this->db->escape($data['filter_date_expensed']) . "'";	
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
		// 	$sql .= " ORDER BY p.expense_id ";	
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
	public function addExpense($data) {

		$this->db->query("INSERT INTO `" . DB_PREFIX . "expense` SET store_id = '" . (int)$data['store_id'] . "', user_id = '" . (int)$data['user_id'] . "', expense_status_id = '" . (int)$data['expense_status_id'] . "', date_expensed = '" . $this->db->escape($data['date_expensed']) . "', date_added = NOW(), date_modified = NOW()");

		$expense_id = $this->db->getLastId();

		$this->editExpense($expense_id, $data);

	}

	// '2014-09-27 03:16'
	public function editExpense($expense_id, $data) {

		$store_id = isset($data['store_id']) ? $data['store_id'] : 0;

		$user_id = isset($data['user_id']) ? $data['user_id'] : 0;

		// Restock products before subtracting the stock later on ****
		$expense_query_prev = $this->db->query("SELECT * FROM `" . DB_PREFIX . "expense` WHERE expense_status_id > '0' AND expense_id = '" . (int)$expense_id . "'");
// $this->load->out($expense_query_prev);
		// if (!$expense_query_prev->num_rows && !isset($data['expense_product'])) {
		// 	// delete me 
		// 	$this->db->query("DELETE FROM " . DB_PREFIX . "expense_product WHERE expense_id = '" . (int)$expense_id . "'"); 
		// 	$this->db->query("DELETE FROM " . DB_PREFIX . "expense WHERE expense_id = '" . (int)$expense_id . "'"); 
		// 	return true;
		// }

		$store_id_prev = $expense_query_prev->row['store_id'];

		$user_id_prev = $expense_query_prev->row['user_id'];


		if (!$store_id_prev ) return false;
		if (!$store_id && $data['expense_product']) return false;
		if (!$user_id && $data['expense_product']) return false;

		$expense_products_prev = $this->db->query("SELECT * FROM oc_expense_product WHERE expense_id = '" . (int)$expense_id . "'");

		$canproceed = true;

		if ($store_id_prev != $store_id) {
			// calculate quantity this way

			// foreach ($data['expense_product'] as $key => $value_new) {

			// 	if (!$value_new['product_id']) return false;

			// 	if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id')");

			// 	if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id_prev')");

			// 	$found = false;
			// 	$store_product = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '" .$value_new['product_id'] . "'");

				foreach ($expense_products_prev->rows as $key2 => $value_old) { 
					
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

			foreach ($data['expense_product'] as $key => $value_new) {

				if (!$value_new['product_id']) return false;

				if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id')");

				if ($value_new['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$value_new['product_id']. "', '$store_id_prev')");

				$found = false;

				$store_product = $this->db->query("SELECT * FROM oc_product_to_store WHERE store_id = '$store_id_prev' AND product_id = '" .$value_new['product_id'] . "'");

				foreach ($expense_products_prev->rows as $key2 => $value_old) { 
					
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
		// if ($data['expense_product']) {
		// 	foreach ($data['expense_product'] as $key => $value) {

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

		// if ($expense_query_prev->num_rows) {
			
			// $product_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "expense_product WHERE expense_id = '" . (int)$expense_id . "'");

			// '2014-09-08 21:04'
		//restock
		
			foreach($expense_products_prev->rows as $product) {
			// foreach($product_query->rows as $product) {

				// if ($store_id && $product['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$product['product_id']. "', '$store_id')");
				// if ($store_id_prev && $product['product_id']) $this->db->query("INSERT IGNORE INTO oc_product_to_store (product_id, store_id) VALUES ('". (int)$product['product_id']. "', '$store_id_prev')");
				$this->db->query("UPDATE `" . DB_PREFIX . "product_to_store` SET quantity = (quantity - " . (int)$product['quantity'] . ") WHERE product_id = '" . (int)$product['product_id'] . "' AND store_id = '$store_id_prev'");
			}
		// }


		$this->db->query("DELETE FROM " . DB_PREFIX . "expense_product WHERE expense_id = '" . (int)$expense_id . "'"); 

		$grandtotal = 0;

		if (isset($data['expense_product'])) {
			foreach ($data['expense_product'] as $expense_product) {

				$total = (int)$expense_product['quantity'] * (float)$expense_product['cost'];

				$grandtotal = $grandtotal + $total;
				
				$this->db->query("INSERT INTO " . DB_PREFIX . "expense_product SET expense_id = '" . (int)$expense_id . "', product_id = '" . (int)$expense_product['product_id'] . "',  quantity = '" . (int)$expense_product['quantity'] . "', cost = '" . (float)$expense_product['cost'] . "', total = '" . $total . "'");

				$expense_product_id = $this->db->getLastId();

				$this->db->query("INSERT INTO oc_product_to_store (quantity, product_id, store_id) VALUES ('" . (int)$expense_product['quantity'] . "', '" . (int)$expense_product['product_id'] . "', '$store_id') ON DUPLICATE KEY UPDATE quantity = (quantity + " . (int)$expense_product['quantity'] . ")");
			}

			$this->db->query("UPDATE `" . DB_PREFIX . "expense` SET total = '$grandtotal'
			, expense_status_id = '" . (int)$data['expense_status_id'] . "'
			, date_expensed = '" . $this->db->escape($data['date_expensed']) . "'
			, image1 = '" . $this->db->escape($data['image1']) . "'
			, image2 = '" . $this->db->escape($data['image2']) . "'
			, image3 = '" . $this->db->escape($data['image3']) . "'
			, date_modified = NOW(), store_id = '" . (int)$store_id . "', user_id = '" . (int)$user_id . "' WHERE expense_id = '" . (int)$expense_id . "'");

			return true;
		} else {
			
			$this->db->query("DELETE FROM oc_expense WHERE expense_id = '$expense_id'");

			return true;
		}

		
	}

	// '2014-09-27 03:17'
	public function deleteExpense($expense_id, $remove_from_db = false) {

		return $this->editExpense($expense_id, null);

		// $expense = $this->db->query("SELECT * FROM oc_expense WHERE expense_id = '" . (int)$expense_id . "'");

		// if (!$expense) return false;

		// $store_id = $expense->row['store_id'];

		// $products = $this->getExpenseProducts($expense_id); 

		// $this->cart->clear();

		// foreach ($products as $product) {
		// 	$this->cart->add($product['product_id'], $product['quantity'], '', '');
		// }

		// if (!$this->cart->hasStock($store_id)) {
		// 	$this->cart->clear();			
		// 	return false;
		// }

		// $this->cart->clear();
		
		// $this->editExpense($expense_id, null);

		// $this->db->query("DELETE FROM `" . DB_PREFIX . "expense` WHERE expense_id = '" . (int)$expense_id . "'");

		// $this->db->query("DELETE FROM " . DB_PREFIX . "expense_product WHERE expense_id = '" . (int)$expense_id . "'");


		// return true;

	}

}	
?>