<?php
class ModelUserUser extends Model {
	public function addUser($data) {

		$this->db->query("INSERT INTO oc_user (date_added) VALUES (NOW())");

		$user_id = $this->db->getLastId();
		//$this->db->query("INSERT INTO `" . DB_PREFIX . "user` SET store_permission = '" . $this->db->escape($store_permission) . "', username = '" . $this->db->escape($data['username']) . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$this->editUser($user_id, $data);
	}

	public function editUser($user_id, $data) {
		
		$default_store_id = (int)$this->db->escape($data['defaultstore']);

		if (empty($data['store'])) $data['store'] = array();

		if (!in_array($default_store_id, $data['store'])) array_push($data['store'], $default_store_id);

		$store_permission = '[' . implode(',', $data['store']) . ']'; 

		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET store_permission = '" . $this->db->escape($store_permission) . "', username = '" . $this->db->escape($data['username']) . "', store_id = '" . (int)$this->db->escape($data['defaultstore']) . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', user_group_id = '" . (int)$data['user_group_id'] . "', status = '" . (int)$data['status'] . "' WHERE user_id = '" . (int)$user_id . "'");

		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE user_id = '" . (int)$user_id . "'");
		}
	}

	public function editPassword($user_id, $password) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "', password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($password)))) . "', code = '' WHERE user_id = '" . (int)$user_id . "'");
	}

	public function editCode($email, $code) {
		$this->db->query("UPDATE `" . DB_PREFIX . "user` SET code = '" . $this->db->escape($code) . "' WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
	}

	public function deleteUser($user_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'");
	}

	public function getUser($user_id) {

		$sql = "SELECT * FROM `" . DB_PREFIX . "user` WHERE user_id = '" . (int)$user_id . "'";

		$query = $this->db->query($sql);

		return $query->row;
	}

	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE username = '" . $this->db->escape($username) . "'");

		return $query->row;
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "user` WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "user`";

		$sort_data = array(
			'username',
			'status',
			'date_added'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY username";	
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

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user`");

		return $query->row['total'];
	}

	//'2014-09-22 15:25'
	public function getReminderMessages($data) {

		$sql = "SELECT ch.*, u.firstname as ufirstname, u.lastname as ulastname, u.store_id, c.firstname as cfirstname, c.lastname as clastname FROM oc_customer_history ch LEFT JOIN oc_user u ON u.user_id = ch.user_id LEFT JOIN oc_customer c ON c.customer_id = ch.customer_id ";

		$sql .= " WHERE reminder = 1 "; 

		if (isset($data['filter_reminder_status'])) {
			$sql .= " AND reminder_status = '" . (int)$data['filter_reminder_status'] . "'";
		} 

		if (isset($data['filter_treatment'])) {
			$sql .= " AND if_treatment = '" . (int)$data['filter_treatment'] . "'";
		} 

		if (isset($data['filter_user_id'])) {
			$sql .= " AND ch.user_id = '" . (int)$data['filter_user_id'] . "'"; 
		}

		$sql .= " ORDER BY date_added DESC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	// '2014-09-22 15:25'
	public function getReminderActions() {
		return $this->db->query("SELECT * FROM oc_reminder_status rc WHERE language_id = '" .  (int)$this->config->get('config_language_id') ."'")->rows;
	}

	public function getTotalUsersByGroupId($user_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE user_group_id = '" . (int)$user_group_id . "'");

		return $query->row['total'];
	}

	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "user` WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}	
}
?>