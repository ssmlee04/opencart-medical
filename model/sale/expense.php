<?php
class ModelSaleExpense extends Model {

	// '2014-09-27 03:16'
	function getExpense($expense_id) {

		return $this->db->query("SELECT * FROM oc_expense WHERE id = '" . (int)$expense_id . "'")->row;
	}

	function getTotalExpenses($data) {

		$sql = "SELECT * FROM oc_expense p "; 

		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_expensed_start'])) {
			$sql .= " AND date_expensed >= '" . $this->db->escape($data['filter_date_expensed_start']) . "'";	
		}

		if (isset($data['filter_date_expensed_end'])) {
			$sql .= " AND date_expensed <= '" . $this->db->escape($data['filter_date_expensed_end']) . "'";	
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

		return $this->db->query($sql)->num_rows;
	}

	function getExpenses($data) {

		$sql = "SELECT * FROM oc_expense p "; 

		$sql .= " WHERE 1=1 "; 

		if (isset($data['filter_store'])) {
			$sql .= " AND store_id = '" . (int)$data['filter_store'] . "'";	
		}

		if (isset($data['filter_user'])) {
			$sql .= " AND user_id = '" . (int)$data['filter_user']. "'";	
		}

		if (isset($data['filter_date_expensed_start'])) {
			$sql .= " AND date_expensed >= '" . $this->db->escape($data['filter_date_expensed_start']) . "'";	
		}

		if (isset($data['filter_date_expensed_end'])) {
			$sql .= " AND date_expensed <= '" . $this->db->escape($data['filter_date_expensed_end']) . "'";	
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

		// $this->load->test($sql)
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


	// '2014-09-27 03:16'
	public function addExpense($data) {
// $this->load->Test($data);
		$query = $this->db->query("INSERT INTO `" . DB_PREFIX . "expense` SET 
			message = '" . $this->db->escape($data['message']) . "', 
			store_id = '" . (int)$data['store_id'] . "', 
			user_id = '" . (int)$data['user_id'] . "', 
			total = '" . (float)$data['total'] . "', 
			date_expensed = '" . $this->db->escape($data['date_expensed']) . "', 
			date_added = NOW(), 
			date_modified = NOW()");

		return $this->db->countAffected();
	}

	// '2014-09-27 03:16'
	public function editExpense($expense_id, $data) {
		
		$sql = "UPDATE `" . DB_PREFIX . "expense` SET "; 
		
		if (isset($data['message'])) $sql .= "message = '" . $this->db->escape($data['message']) . "',"; 
		if (isset($data['date_expensed'])) $sql .= "date_expensed = '" . $this->db->escape($data['date_expensed']) . "',"; 
		// if (isset($data['date_added'])) $sql .= "date_added = '" . $this->db->escape($data['date_added']) . "',"; 
		if (isset($data['store_id'])) $sql .= "store_id = '" . (int)$data['store_id'] . "',"; 
		if (isset($data['user_id'])) $sql .= "user_id = '" . (int)$data['user_id'] . "',"; 
		if (isset($data['total'])) $sql .= "total = '" . (float)$data['total'] . "',"; 

		$sql .= " date_modified = NOW() WHERE id = '" . (int)$expense_id . "'";

		$query = $this->db->query($sql);

		return $this->db->countAffected();
	}

	// '2014-09-27 03:17'
	public function deleteExpense($expense_id, $remove_from_db = false) {

		$query = $this->db->query("DELETE FROM oc_expense WHERE id = '" . (int)$expense_id . "' ");

		return $this->db->countAffected();
	}

}	
?>