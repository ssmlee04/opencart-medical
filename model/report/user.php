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


	public function getBonusesGroupbyTreatmentNEW($data) {

		$sql = "SELECT ct.*, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct";
// sum(subquantity) as subquantity, sum(amount) as amount, sum(total_amount) as total_amount, 
		$sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		$sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		$sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		$sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		$sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		$sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";

		// $sql .= " WHERE ct.status = 2 "; 

		// if (!empty($data['filter_date_start'])) {
		// 	$sql .= " AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		// }
		// if (!empty($data['filter_date_end'])) {
		// 	$sql .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		// }

		$sql .= " WHERE 1=1 "; 
		$xx = '1=1';
		$yy = '1=0';

		// if (!empty($data['filter_date_start']) && !empty($data['filter_date_end'])) {
		// 	$yy = "(DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'
		// 	AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "' AND total_amount > 0)";
		// 	$xx = " (ct.status = 2 AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		// 	$xx .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		// 	$xx .= " AND total_amount = 0 )";
		// }

		$sql .= " AND ($xx OR $yy) ";
		// $sql .= " AND ct.treatment_usage_id > 0 "; 
		// $sql .= " GROUP BY ct.treatment_usage_id";
		// $this->load->test($sql, false);

		// $sql .= " GROUP BY ct.treatment_usage_id";

		// $this->load->test($sql);

		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getrest($data) {

		$sql = "SELECT ct.*, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct";

		$sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		$sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		$sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		$sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		$sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		$sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";

		// $sql .= " WHERE ct.status = 2 "; 

		// if (!empty($data['filter_date_start'])) {
		// 	$sql .= " AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		// }
		// if (!empty($data['filter_date_end'])) {
		// 	$sql .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		// }	
		if (!empty($data['filter_date_start']) && !empty($data['filter_date_end'])) {
			$yy = "(DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'
			AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "' AND total_amount > 0)";
			// $xx = " (ct.status = 2 AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
			// $xx .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
			// $xx .= " AND total_amount = 0 )";
		}

		$sql .= " WHERE ct.treatment_usage_id = 0 AND $yy"; 

		$query = $this->db->query($sql);

		return $query->rows;
	}


	public function getBonusesGroupbyTreatment($data) {

		$sql = "SELECT ct.*, sum(subquantity) as subquantity, sum(amount) as amount, sum(total_amount) as total_amount, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct";

		$sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		$sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		$sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		$sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		$sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		$sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";

		// $sql .= " WHERE ct.status = 2 "; 

		// if (!empty($data['filter_date_start'])) {
		// 	$sql .= " AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		// }
		// if (!empty($data['filter_date_end'])) {
		// 	$sql .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		// }

		$sql .= " WHERE 1=1 "; 
		$xx = '1=0';
		$yy = '1=0';

		if (!empty($data['filter_date_start']) && !empty($data['filter_date_end'])) {
			$yy = "(DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'
			AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "' AND total_amount > 0)";
			$xx = " (ct.status = 2 AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
			$xx .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
			$xx .= " AND total_amount = 0 )";
		}

		$sql .= " AND ($xx OR $yy) ";
		// $sql .= " AND ct.treatment_usage_id > 0 "; 
		$sql .= " GROUP BY ct.treatment_usage_id";
		// $this->load->test($sql, false);

		// $sql .= " GROUP BY ct.treatment_usage_id";

		// $this->load->test($sql);

		$query = $this->db->query($sql);

		return $query->rows;
	}


	// '2014-10-15 14:10'
	public function getBonuses($data = array(), $start = 0, $limit = 10) { 
		
		$sql = "SELECT * "; 

		if (isset($data['filter_group_usage'])) {
			$sql .= " , sum(subquantity) as subquantity"; 
			$sql .= " , sum(bonus_doctor) as bonus_doctor"; 
			$sql .= " , sum(bonus_consultant) as bonus_consultant"; 
			$sql .= " , sum(bonus_outsource) as bonus_outsource"; 
			$sql .= " , sum(bonus_beauty) as bonus_beauty"; 
		}

		// if (isset($data['filter_doctor_id'])) {
		// 	$sql .= " sum(bonus_doctor) as total, doctor_id as user_id";
		// } 
		// else if (isset($data['filter_consultant_id'])) {
		// 	$sql .= " sum(bonus_consultant) as total, consultant_id as user_id";
		// } 
		// else if (isset($data['filter_beauty_id'])) {
		// 	$sql .= " sum(bonus_beauty) as total, beauty_id as user_id";
		// } 
		// else if (isset($data['filter_outsource_id'])) {
		// 	$sql .= " sum(bonus_outsource) as total, outsource_id as user_id";
		// }

		// sum(bonus_doctor) as total_bonus_doctor
		// ,sum(bonus_beauty) as total_bonus_beauty
		// ,sum(bonus_consultant) as total_bonus_consultant
		// ,sum(bonus_outsource) as total_bonus_outsource
		$sql .= " FROM oc_customer_transaction WHERE status = 2 "; 

		if (!empty($data['filter_date_start'])) {
			$sql .= " AND DATE(date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}
		if (!empty($data['filter_date_end'])) {
			$sql .= " AND DATE(date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}
		

		if (!empty($data['filter_doctor_id'])) {
			$sql .= " AND doctor_id = '" . (int)$data['filter_doctor_id'] . "'";
		} 
		else if (!empty($data['filter_consultant_id'])) {
			$sql .= " AND consultant_id = '" . (int)$data['filter_consultant_id'] . "'";
		} 
		else if (!empty($data['filter_beauty_id'])) {
			$sql .= " AND beauty_id = '" . (int)$data['filter_beauty_id'] . "'";
		} 
		else if (!empty($data['filter_outsource_id'])) {
			$sql .= " AND outsource_id = '" . (int)$data['filter_outsource_id'] . "'";
		} 
				

		// if (isset($data['filter_consultant_id'])) {
		// 	$sql .= " GROUP BY consultant_id ORDER BY consultant_id DESC";
		// } 
		// else if (isset($data['filter_doctor_id'])) {
		// 	$sql .= " GROUP BY doctor_id ORDER BY doctor_id DESC";
		// }
		// else if (isset($data['filter_outsource_id'])) {
		// 	$sql .= " GROUP BY outsource_id ORDER BY outsource_id DESC";
		// }
		// else if (isset($data['filter_beauty_id'])) {
		// 	$sql .= " GROUP BY beauty_id ORDER BY beauty_id DESC";
		// }
// $this->load->test($sql);;

		if (isset($data['filter_group_usage'])) {
			$sql .= " AND treatment_usage_id > 0 GROUP BY treatment_usage_id"; 
		}

		// if ($start < 0) {
		// 	$start = 0;
		// }

		// if ($limit < 1) {
		// 	$limit = 10;
		// }
// $this->load->test($sql);
		$query = $this->db->query($sql);
	
		return $query->rows;
	}


	
}
?>