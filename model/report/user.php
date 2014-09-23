<?php
class ModelReportUser extends Model {

	// public function getTotalReminders($data, $reminder_status) {

	// 	$sql = "SELECT COUNT(user_id) as total FROM oc_customer_history o WHERE o.user_id > 0"; 
		
	// 	if (!empty($data['filter_reminder_status_id'])) {
	// 		$sql .= " AND o.reminder_status = '" . (int)$data['filter_reminder_status_id'] . "'";
	// 	} else {
	// 		$sql .= " AND o.reminder_status > '0'";
	// 	}
				
	// 	if (!empty($data['filter_date_start'])) {
	// 		$sql .= " AND DATE(o.reminder_date) >= '" . $this->db->escape($data['filter_date_start']) . "'";
	// 	}

	// 	if (!empty($data['filter_date_end'])) {
	// 		$sql .= " AND DATE(o.reminder_date) <= '" . $this->db->escape($data['filter_date_end']) . "'";
	// 	}
		
	// 	$sql .= " AND reminder_status = " . (int)$reminder_status . " GROUP BY o.user_id ORDER BY o.user_id DESC";
			
	// 	$query = $this->db->query($sql);
	
	// 	return $query->rows;
	// }

	public function getReminders($data = array()) {

		$sql = "SELECT o.*, rs.name as rname, c.firstname as cfirstname, c.lastname as clastname, u.username, u.firstname, u.lastname, u.user_group_id, ug.name FROM oc_customer_history o LEFT JOIN oc_reminder_status rs ON o.reminder_status = rs.reminder_status_id LEFT JOIN oc_customer c ON c.customer_id = o.customer_id LEFT JOIN oc_user u ON o.user_id = u.user_id LEFT JOIN oc_user_group ug ON u.user_group_id = ug.user_group_id WHERE o.user_id > 0 "; 
		
		if (isset($data['filter_reminder_status_id'])) {
			$sql .= " AND o.reminder_status = '" . (int)$data['filter_reminder_status_id'] . "'";
		} else {
			$sql .= " AND o.reminder_status >= '0'";
		}
				
		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.reminder_date) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.reminder_date) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		
		$sql .= " ORDER BY o.user_id DESC";
			
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getUsers($data = array()) { 
		
		//$sql = "SELECT tmp.customer_id, tmp.customer, tmp.email, tmp.customer_group, tmp.status, COUNT(tmp.order_id) AS orders, SUM(tmp.products) AS products, SUM(tmp.total) AS total FROM (SELECT o.order_id, c.customer_id, CONCAT(o.firstname, ' ', o.lastname) AS customer, o.email, cgd.name AS customer_group, c.status, (SELECT SUM(op.quantity) FROM `" . DB_PREFIX . "order_product` op WHERE op.order_id = o.order_id GROUP BY op.order_id) AS products, o.total FROM `" . DB_PREFIX . "order` o LEFT JOIN `" . DB_PREFIX . "customer` c ON (o.customer_id = c.customer_id) LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE o.customer_id > 0 AND cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$sql = "SELECT COUNT(*) as total, o.user_id, u.username, u.firstname, u.lastname, u.user_group_id, ug.name FROM oc_customer_history o LEFT JOIN oc_user u ON o.user_id = u.user_id LEFT JOIN oc_user_group ug ON u.user_group_id = ug.user_group_id WHERE o.user_id > 0"; 
		
		if (isset($data['filter_reminder_status_id'])) {
			$sql .= " AND o.reminder_status = '" . (int)$data['filter_reminder_status_id'] . "'";
		} else {
			$sql .= " AND o.reminder_status >= '0'";
		}
				
		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.reminder_date) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.reminder_date) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		
		$sql .= " GROUP BY o.user_id ORDER BY o.user_id DESC";
				
		// if (isset($data['start']) || isset($data['limit'])) {
		// 	if ($data['start'] < 0) {
		// 		$data['start'] = 0;
		// 	}			

		// 	if ($data['limit'] < 1) {
		// 		$data['limit'] = 20;
		// 	}	
			
		// 	$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		// }

		// $this->load->out($sql);
			
		$query = $this->db->query($sql);
	
		return $query->rows;
	}

	public function getTotalUsers($data = array()) {
		$sql = "SELECT COUNT(DISTINCT o.user_id) AS total FROM `" . DB_PREFIX . "customer_history` o LEFT JOIN oc_user u ON o.user_id = u.user_id WHERE o.user_id > '0'";
		
		// if (!empty($data['filter_reminder_status_id'])) {
		// 	$sql .= " AND o.reminder_status = '" . (int)$data['filter_reminder_status_id'] . "'";
		// } else {
		// 	$sql .= " AND o.reminder_status > '0'";
		// }
						
		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(o.reminder_date) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(o.reminder_date) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
						
		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
}
?>