<?php
class ModelSaleCustomer extends Model {
	
	public function addCustomer($data) {
			// , password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "'
		// $this->db->query("INSERT INTO " . DB_PREFIX . "customer SET firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', mobile = '" . $this->db->escape($data['mobile']) . "', newsletter = '" . (int)$data['newsletter'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', salt = '" . $this->db->escape($salt = substr(md5(uniqid(rand(), true)), 0, 9)) . "'
		// 	, status = '" . (int)$data['status'] . "', date_added = NOW()");

		// $customer_id = $this->db->getLastId();

		// if (isset($data['address'])) {
		// 	$address = $data['address'];
		// 	// foreach ($data['address'] as $address) {
		// 		$this->db->query("INSERT INTO " . DB_PREFIX . "address SET customer_id = '" . (int)$customer_id . "', firstname = '" . $this->db->escape($address['firstname']) . "', lastname = '" . $this->db->escape($address['lastname']) . "', company = '" . $this->db->escape($address['company']) . "', company_id = '" . $this->db->escape($address['company_id']) . "', tax_id = '" . $this->db->escape($address['tax_id']) . "', address_1 = '" . $this->db->escape($address['address_1']) . "', address_2 = '" . $this->db->escape($address['address_2']) . "', city = '" . $this->db->escape($address['city']) . "', postcode = '" . $this->db->escape($address['postcode']) . "', country_id = '" . (int)$address['country_id'] . "', zone_id = '" . (int)$address['zone_id'] . "'");

		// 		if (isset($address['default'])) {
		// 			$address_id = $this->db->getLastId();

		// 			$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . $address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
		// 		}
		// 	// }
		// }

		$this->db->query("INSERT INTO oc_customer SET date_added = NOW()");

		$customer_id = $this->db->getLastId();

		$this->editCustomer($customer_id, $data);

		return $customer_id;

	}

	public function editCustomer($customer_id, $data) {

		// if ($data['dob']) {
		// 	$data['dob'] = 
		// }

		$sql = "UPDATE " . DB_PREFIX . "customer SET 
			firstname = '" . $this->db->escape($data['firstname']) . "'
			, lastname = '" . $this->db->escape($data['lastname']) . "'
			, fullname = '" . $this->db->escape($data['lastname']) . $this->db->escape($data['firstname']) . "'
			, email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "'
			, mobile = '" . $this->db->escape($data['mobile']) . "'
			, dob = '" . $this->db->escape($data['dob']) . "'
			, ssn = '" . $this->db->escape($data['ssn']) . "'
			, image = '" . $this->db->escape($data['avatarimage']) . "'
			, store_id = '" . (int)$data['store'] . "'
			, nickname = '" . $this->db->escape($data['nickname']) . "'
			, line_id = '" . $this->db->escape($data['line_id']) . "'
			, fb_id = '" . $this->db->escape($data['fb_id']) . "'
			, customer_group_id = '" . (int)$data['customer_group_id'] . "'
			, status = '1' 
			WHERE customer_id = '" . (int)$customer_id . "'";
			// , outsource = '" . (int)$data['outsource'] . "'

		$this->db->query($sql);
			// , newsletter = '" . (int)$data['newsletter'] . "'

	

		// edit customer images
		// $this->db->query("DELETE FROM " . DB_PREFIX . "customer_image WHERE customer_id = '" . (int)$customer_id . "'");	

		// if (isset($data['customer_image'])) {
		// 	foreach ($data['customer_image'] as $customer_image) {
				
		// 		$this->insertCustomerImage($customer_id, $customer_image);
		// 	}
		// }

		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		if (isset($data['address'])) {
			$address = $data['address'];
			// foreach ($data['address'] as $address) {
			
					// address_id = '" . (int)$address['address_id'] . "'
					// , firstname = '" . $this->db->escape($address['firstname']) . "'
					// , lastname = '" . $this->db->escape($address['lastname']) . "'
					// , company = '" . $this->db->escape($address['company']) . "'
					// , company_id = '" . $this->db->escape($address['company_id']) . "'
					// , tax_id = '" . $this->db->escape($address['tax_id']) . "'
			//, zone_id = '" . (int)$address['zone_id'] . "'"
				$this->db->query("INSERT INTO " . DB_PREFIX . "address SET 
					 customer_id = '" . (int)$customer_id . "'
					, address_1 = '" . $this->db->escape($address['address_1']) . "'
					, address_2 = '" . $this->db->escape($address['address_2']) . "'
					, city = '" . $this->db->escape($address['city']) . "'
					, postcode = '" . $this->db->escape($address['postcode']) . "'");
					// , country_id = '" . (int)$address['country_id'] . "'");

				// if (isset($address['default'])) {
					$address_id = $this->db->getLastId();

					$this->db->query("UPDATE " . DB_PREFIX . "customer SET address_id = '" . (int)$address_id . "' WHERE customer_id = '" . (int)$customer_id . "'");
				// }
			// }
		}
	}

	// '2014-10-06 14:45'
	public function deleteCustomerImage($customer_image_id) {
		if (isset($customer_image_id)) {
			$this->db->query("DELETE FROM oc_customer_image WHERE customer_image_id = '" . (int)$customer_image_id . "'");

		}
	}

	public function editCustomerImageComment($id, $data) {

		$sql = "UPDATE oc_customer_image SET comment = '" . $this->db->escape($data['comment']) . "' WHERE customer_image_id = '$id'";

		$query = $this->db->query($sql);

		return ($this->db->countAffected() > 0 ? $this->db->getLastId() : 0);
	}

	public function editCustomerImage($customer_image_id, $data) {

		if (!$customer_image_id) return false;

		$sql = "UPDATE oc_customer_image SET date_added = NOW()";

		if (isset($data['customer_transaction_id'])) {
			$query = $this->db->query("SELECT * FROM oc_customer_image WHERE customer_transaction_id = '" . (int)$data['customer_transaction_id'] . "'");
			if ($query->num_rows > 3) return false;
		}

		if (isset($data['comment']))  {
			$sql .= ", comment = '" . $this->db->escape($data['comment']) . "'";
		}

		if (isset($data['image']))  {
			$sql .= ", image = '" . $this->db->escape($data['image']) . "'";
		}

		if (isset($data['date_processed']))  {
			$sql .= ", date_processed = '" . $this->db->escape($data['date_processed']) . "'";
		}

		if (isset($data['customer_transaction_id']))  {
			$sql .= ", customer_transaction_id = '" . $this->db->escape($data['customer_transaction_id']) . "'";
		}

		$sql .= " WHERE customer_image_id = '" . (int)$customer_image_id . "'";	
		

		$this->load->out($sql, false);
		$query = $this->db->query($sql);

		return $this->db->countAffected();
		// return ($this->db->countAffected() > 0 ? $this->db->getLastId() : 0);
	}

	// '2014-10-06 14:46'
	public function insertCustomerImage($customer_id, $data) {

		$sql = "INSERT INTO oc_customer_image SET 
		customer_id = '" . (int)$customer_id . "'
		, date_added = '" . $this->db->escape($data['date_added']) . "'
		, image = '" . $this->db->escape($data['image']) . "'";

		if (isset($data['customer_transaction_id'])) {
			$query = $this->db->query("SELECT * FROM oc_customer_image WHERE customer_transaction_id = '" . (int)$data['customer_transaction_id'] . "'");
			if ($query->num_rows >= $this->config->get('config_treatment_image_limit')) return false;
		}

		if (isset($data['customer_transaction_id']))  {

			$query2 = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '". $data['customer_transaction_id'] . "'");

			$product_id = $query2->row['product_id'];

			$sql .= ", customer_transaction_id = '" . $this->db->escape($data['customer_transaction_id']) . "'
					, product_id = '" .(int)$product_id . "'";
		}

		$query = $this->db->query($sql);

		return ($this->db->countAffected() > 0 ? $this->db->getLastId() : 0);
	}

	public function editToken($customer_id, $token) {
		$this->db->query("UPDATE " . DB_PREFIX . "customer SET token = '" . $this->db->escape($token) . "' WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function deleteCustomer($customer_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");
	}

	public function getCustomer($customer_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE customer_id = '" . (int)$customer_id . "'");

		return $query->row;
	}

	public function getCustomerByEmail($email) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "customer WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}

	public function getCustomers($data = array()) {
		$sql = "SELECT *, c.fullname AS cfullname, cgd.name AS customer_group FROM " . DB_PREFIX . "customer c LEFT JOIN " . DB_PREFIX . "customer_group_description cgd ON (c.customer_group_id = cgd.customer_group_id) WHERE cgd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$implode = array();

		if (!empty($data['filter_mobile'])) {
			$implode[] = "mobile LIKE '%" . $this->db->escape($data['filter_mobile']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$implode[] = "telephone LIKE '%" . $this->db->escape($data['filter_telephone']) . "%'";
		}

		if (!empty($data['filter_dob'])) {
			$implode[] = "dob = '" . $this->db->escape($data['filter_dob']) . "'";
		}
		
		if (!empty($data['filter_name'])) {
			$implode[] = "c.fullname LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_customer_id'])) {
			$implode[] = "c.customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}	

		if (!empty($data['filter_email'])) {
			$implode[] = "c.email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "c.newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}	

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "c.customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}	

		if (!empty($data['filter_ip'])) {
			$implode[] = "c.customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}	

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "c.status = '" . (int)$data['filter_status'] . "'";
		}	

		if (isset($data['filter_ssn']) && !is_null($data['filter_ssn'])) {
			$implode[] = "ssn LIKE '%" . $this->db->escape($data['filter_ssn']) . "%'";
		}	

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "c.approved = '" . (int)$data['filter_approved'] . "'";
		}	

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(c.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " AND " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'name',
			'c.email',
			'customer_group',
			'c.status',
			'c.approved',
			'c.ip',
			'c.date_added'
		);	

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];	
		} else {
			$sql .= " ORDER BY name";	
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

	public function approve($customer_id) {
		$customer_info = $this->getCustomer($customer_id);

		if ($customer_info) {
			$this->db->query("UPDATE " . DB_PREFIX . "customer SET approved = '1' WHERE customer_id = '" . (int)$customer_id . "'");

			$this->language->load('mail/customer');

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			if ($store_info) {
				$store_name = $store_info['name'];
				$store_url = $store_info['url'] . 'index.php?route=account/login';
			} else {
				$store_name = $this->config->get('config_name');
				$store_url = HTTP_CATALOG . 'index.php?route=account/login';
			}

			$message  = sprintf($this->language->get('text_approve_welcome'), $store_name) . "\n\n";
			$message .= $this->language->get('text_approve_login') . "\n";
			$message .= $store_url . "\n\n";
			$message .= $this->language->get('text_approve_services') . "\n\n";
			$message .= $this->language->get('text_approve_thanks') . "\n";
			$message .= $store_name;

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->hostname = $this->config->get('config_smtp_host');
			$mail->username = $this->config->get('config_smtp_username');
			$mail->password = $this->config->get('config_smtp_password');
			$mail->port = $this->config->get('config_smtp_port');
			$mail->timeout = $this->config->get('config_smtp_timeout');							
			$mail->setTo($customer_info['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender($store_name);
			$mail->setSubject(html_entity_decode(sprintf($this->language->get('text_approve_subject'), $store_name), ENT_QUOTES, 'UTF-8'));
			$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			$mail->send();
		}		
	}

	public function getAddress($address_id) {
		$address_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "address WHERE address_id = '" . (int)$address_id . "'");

		if ($address_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$address_query->row['country_id'] . "'");

			if ($country_query->num_rows) {
				$country = $country_query->row['name'];
				$iso_code_2 = $country_query->row['iso_code_2'];
				$iso_code_3 = $country_query->row['iso_code_3'];
				$address_format = $country_query->row['address_format'];
			} else {
				$country = '';
				$iso_code_2 = '';
				$iso_code_3 = '';	
				$address_format = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$address_query->row['zone_id'] . "'");

			if ($zone_query->num_rows) {
				$zone = $zone_query->row['name'];
				$zone_code = $zone_query->row['code'];
			} else {
				$zone = '';
				$zone_code = '';
			}		

			return array(
				'address_id'     => $address_query->row['address_id'],
				'customer_id'    => $address_query->row['customer_id'],
				'firstname'      => $address_query->row['firstname'],
				'lastname'       => $address_query->row['lastname'],
				'company'        => $address_query->row['company'],
				'company_id'     => $address_query->row['company_id'],
				'tax_id'         => $address_query->row['tax_id'],
				'address_1'      => $address_query->row['address_1'],
				'address_2'      => $address_query->row['address_2'],
				'postcode'       => $address_query->row['postcode'],
				'city'           => $address_query->row['city'],
				'zone_id'        => $address_query->row['zone_id'],
				'zone'           => $zone,
				'zone_code'      => $zone_code,
				'country_id'     => $address_query->row['country_id'],
				'country'        => $country,	
				'iso_code_2'     => $iso_code_2,
				'iso_code_3'     => $iso_code_3,
				'address_format' => $address_format
			);
		}
	}

	public function getAddresses($customer_id) {
		$address_data = array();

		$query = $this->db->query("SELECT address_id FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

		foreach ($query->rows as $result) {
			$address_info = $this->getAddress($result['address_id']);

			if ($address_info) {
				$address_data[$result['address_id']] = $address_info;
			}
		}		

		return $address_data;
	}	

	// '2014-10-03 10:48'
	public function getTotalCustomers($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer";

		$implode = array();

		if (!empty($data['filter_mobile'])) {
			$implode[] = "mobile LIKE '%" . $this->db->escape($data['filter_mobile']) . "%'";
		}

		if (!empty($data['filter_telephone'])) {
			$implode[] = "telephone LIKE '%" . $this->db->escape($data['filter_telephone']) . "%'";
		}

		if (!empty($data['filter_dob'])) {
			$implode[] = "dob = '" . $this->db->escape($data['filter_dob']) . "'";
		}

		if (!empty($data['filter_name'])) {
			$implode[] = "fullname LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_customer_id'])) {
			$implode[] = "customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}	

		if (!empty($data['filter_email'])) {
			$implode[] = "email LIKE '" . $this->db->escape($data['filter_email']) . "%'";
		}

		if (isset($data['filter_newsletter']) && !is_null($data['filter_newsletter'])) {
			$implode[] = "newsletter = '" . (int)$data['filter_newsletter'] . "'";
		}

		if (!empty($data['filter_customer_group_id'])) {
			$implode[] = "customer_group_id = '" . (int)$data['filter_customer_group_id'] . "'";
		}	

		if (!empty($data['filter_ip'])) {
			$implode[] = "customer_id IN (SELECT customer_id FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($data['filter_ip']) . "')";
		}	

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$implode[] = "status = '" . (int)$data['filter_status'] . "'";
		}			

		if (isset($data['filter_approved']) && !is_null($data['filter_approved'])) {
			$implode[] = "approved = '" . (int)$data['filter_approved'] . "'";
		}

		if (isset($data['filter_ssn']) && !is_null($data['filter_ssn'])) {
			$implode[] = "ssn LIKE '%" . $this->db->escape($data['filter_ssn']) . "%'";
		}			

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	// public function getTotalCustomersAwaitingApproval() {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE status = '0' OR approved = '0'");

	// 	return $query->row['total'];
	// }

	// public function getTotalAddressesByCustomerId($customer_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE customer_id = '" . (int)$customer_id . "'");

	// 	return $query->row['total'];
	// }

	// public function getTotalAddressesByCountryId($country_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE country_id = '" . (int)$country_id . "'");

	// 	return $query->row['total'];
	// }	

	// public function getTotalAddressesByZoneId($zone_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "address WHERE zone_id = '" . (int)$zone_id . "'");

	// 	return $query->row['total'];
	// }

	public function getTotalCustomersByCustomerGroupId($customer_group_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer WHERE customer_group_id = '" . (int)$customer_group_id . "'");

		return $query->row['total'];
	}

	// '2014-10-03 10:48'
	// '2014-10-06 16:51'
	public function addHistory($customer_id, $data) {


		// $comment, $user_id = 0, $reminder=null, $reminder_date=null, $if_treatment = false, $customer_transaction_id = '') {

		// $subsql = ($reminder ? " reminder = 1, reminder_date = '$reminder_date', user_id = " . (int)$user_id . ', ' : '');

		// $subsql .= ($if_treatment ? " if_treatment = 1, " : '');

		// $subsql .= ($customer_transaction_id ? " customer_transaction_id = '" . (int)$customer_transaction_id . "', " : '');

		$sql = "INSERT INTO oc_customer_history SET customer_id = '" . (int)$customer_id . "' , date_added = NOW()";

		if (isset($data['comment'])) {
			$sql .= ", comment = '" . $this->db->escape($data['comment']) . "'"; 
		}

		if (!empty($data['reminder']) && ($data['reminder'] == true)) {
			$sql .= ", reminder = '1', reminder_date = '" . $this->db->escape(strip_tags($data['reminder_date'])) . "'"; 
		}

		if (isset($data['user_id'])) {
			$sql .= ", user_id = '" . (int)$data['user_id'] . "'"; 
		}

		if (isset($data['customer_transaction_id'])) {
			$sql .= ", customer_transaction_id = '" . (int)$data['customer_transaction_id'] . "'"; 
		}

		if (isset($data['product_id'])) {
			$sql .= ", product_id = '" . (int)$data['product_id'] . "'"; 
		}

		if (isset($data['if_treatment'])) {
			$sql .= ", if_treatment = '1'"; 
		}

		$this->db->query($sql);
	}	

	public function getBorrows($customer_id, $start = 0, $limit = 10) { 
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$query = $this->db->query("SELECT cl.*, u.firstname as ufirstname, u.lastname as ulastname,
		c1.firstname as borrowerfirstname, c1.lastname as borrowerlastname,
		c2.firstname as lenderfirstname, c2.lastname as lenderlastname FROM oc_customer_lending cl 
			LEFT JOIN oc_user u ON u.user_id = cl.user_id 
			LEFT JOIN oc_customer c1 ON c1.customer_id = cl.borrower_id 
			LEFT JOIN oc_customer c2 ON c2.customer_id = cl.lender_id 
			-- LEFT JOIN oc_product p ON p.product_id = cl.product_id 
			-- LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id 
			WHERE cl.borrower_id = '" . (int)$customer_id . "' ORDER BY cl.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getLendings($customer_id, $start = 0, $limit = 10) { 
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$query = $this->db->query("SELECT cl.*, /*pd.name as product_name,*/ u.firstname as ufirstname, u.lastname as ulastname,
		c1.firstname as borrowerfirstname, c1.lastname as borrowerlastname,
		c2.firstname as lenderfirstname, c2.lastname as lenderlastname FROM oc_customer_lending cl 
			LEFT JOIN oc_user u ON u.user_id = cl.user_id 
			LEFT JOIN oc_customer c1 ON c1.customer_id = cl.borrower_id 
			LEFT JOIN oc_customer c2 ON c2.customer_id = cl.lender_id 
			-- LEFT JOIN oc_product p ON p.product_id = cl.product_id 
			-- LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id 
			WHERE /*pd.language_id = '" . (int)$this->config->get('config_language_id') ."' AND*/ cl.lender_id = '" . (int)$customer_id . "' ORDER BY cl.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	// '2014-10-14 12:13'
	public function recordevent($customer_id, $data) {

		$sql  = "INSERT INTO oc_customer_event SET date_added = NOW(), customer_id = " . (int)$customer_id;

		if (isset($data['title'])) $sql .= ", title='" . $data['title'] . "'"; 
		if (isset($data['end'])) $sql .= ", date_end='" . $data['end'] ."'";
		if (isset($data['start'])) $sql .= ", date_start='" . $data['start'] . "'";

		$this->db->query($sql);

		return $this->db->countAffected();
	}

	public function deleteevent($customer_event_id) {

		$sql = "DELETE FROM oc_customer_event WHERE customer_event_id = " . (int)$customer_event_id;

		$this->db->query($sql);

		return $this->db->countAffected();
	}

	// '2014-10-14 11:16'
	public function getEvents($data) {

		$sql = "SELECT * FROM oc_customer_event WHERE 1=1";

		if (isset($data['filter_date_start'])) {
			$sql .= " AND date_start = '" . $this->db->escape($data['filter_date_start']) . "' ";
		}

		if (isset($data['filter_date_end'])) {
			$sql .= " AND date_end = '" . $this->db->escape($data['filter_date_end']) . "' ";
		}

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND customer_id = '" . (int)$data['filter_customer_id'] . "' ";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	// '2014-09-30 16:14'
	public function getHistories($data, $start = 0, $limit = 10) { 
		

		$sql = "SELECT ch.*
		, u.firstname as ufirstname
		, u.lastname as ulastname
		, u.fullname as ufullname
		, u.store_id
		, c.firstname as cfirstname
		, c.lastname as clastname
		, c.fullname as cfullname
		 FROM " . DB_PREFIX . "customer_history ch LEFT JOIN oc_user u ON u.user_id = ch.user_id LEFT JOIN oc_customer c ON c.customer_id = ch.customer_id WHERE 1=1 ";  

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ch.customer_id = '" . (int)$data['filter_customer_id'] . "' ";
		}

		if (isset($data['filter_reminder'])) {
			$sql .= " AND ch.reminder = '" . (int)$data['filter_reminder'] . "' ";
		}

		if (isset($data['filter_user_id'])) {
			$sql .= " AND ch.user_id = '" . (int)$data['filter_user_id'] . "' ";
		}

		if (isset($data['filter_reminder_date_start'])) {
			$sql .= " AND ch.reminder_date >= '" . $this->db->escape($data['filter_reminder_date_start']) . "' ";
		}

		if (isset($data['filter_reminder_date_end'])) {
			$sql .= " AND ch.reminder_date <= '" . $this->db->escape($data['filter_reminder_date_end']) . "' ";
		}

		if (isset($data['filter_reminder_status'])) {
			$sql .= " AND ch.reminder_status = '" . (int)$data['filter_reminder_status'] . "' ";
		}

		if (isset($data['filter_customer_name'])) {
			$sql .= " AND c.fullname LIKE '%" . $this->db->escape($data['filter_customer_name']) . "%'";
		}

		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$sql .= " ORDER BY ch.date_added DESC ";

		$sql .= " LIMIT " . (int)$start . "," . (int)$limit;

		$query = $this->db->query($sql);

		return $query->rows;
	}	

	// '2014-09-30 16:44'
	public function getTotalHistories($data) {

		$sql = "SELECT count(*) as total FROM " . DB_PREFIX . "customer_history ch LEFT JOIN oc_user u ON u.user_id = ch.user_id LEFT JOIN oc_customer c ON c.customer_id = ch.customer_id WHERE 1=1 ";  

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ch.customer_id = '" . (int)$data['filter_customer_id'] . "' ";
		}

		if (isset($data['filter_reminder'])) {
			$sql .= " AND ch.reminder = '" . (int)$data['filter_reminder'] . "' ";
		}

		if (isset($data['filter_user_id'])) {
			$sql .= " AND ch.user_id = '" . (int)$data['filter_user_id'] . "' ";
		}

		if (isset($data['filter_reminder_date_start'])) {
			$sql .= " AND ch.reminder_date >= '" . $this->db->escape($data['filter_reminder_date_start']) . "' ";
		}

		if (isset($data['filter_reminder_date_end'])) {
			$sql .= " AND ch.reminder_date <= '" . $this->db->escape($data['filter_reminder_date_end']) . "' ";
		}

		if (isset($data['filter_reminder_status'])) {
			$sql .= " AND ch.reminder_status = '" . (int)$data['filter_reminder_status'] . "' ";
		}

		if (isset($data['filter_customer_name'])) {
			$sql .= " AND c.fullname LIKE '%" . $this->db->escape($data['filter_customer_name']) . "%'";
		}

		$sql .= " ORDER BY ch.date_added DESC";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}	

	// '2014-10-03 10:47'
	public function getTotalLendings($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_lending WHERE lender_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}	

	public function getTotalBorrows($customer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_lending WHERE borrower_id = '" . (int)$customer_id . "'");

		return $query->row['total'];
	}	


	// '2014-10-03 10:47'
	public function addLending($customer_id, $lendto_customer_id, $lendto_product_id, $lendto_subquantity) {

		$query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_id = '" . (int)$customer_id . "' AND status < 0 AND product_id = '$lendto_product_id' AND customer_lending_id = 0");

		if ($query->num_rows < $lendto_subquantity) return false;

		$this->load->model('catalog/product');
		
		$product = $this->model_catalog_product->getProduct($lendto_product_id);

		$unit_quantity = $product['unit_quantity'];
		// $price = $product['price'];
		// $subquantity = $product['subquantity'];

		$user_id = $this->user->getId();

		$quantity = 1 / $unit_quantity;

		// $query = $this->db->query("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id LEFT JOIN oc_unit_class_description ucd ON ucd.unit_class_id = p.unit_class_id AND pd.language_id = ucd.language_id WHERE p.product_id = '$product_id' AND ucd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		// $unit_quantity = $query->row['unit_quantity'];

		// $unit_class_id = $query->row['unit_class_id'];

		// $quantity = (float)$subquantity / (float)$unit_quantity;


		$lendto_quantity = $lendto_subquantity / $unit_quantity;

		$this->db->query("INSERT INTO oc_customer_lending SET 
			lender_id='" . (int)$customer_id . "', 
			product_id='" . (int)$lendto_product_id . "'
			, user_id = $user_id
			, quantity='" . $lendto_quantity . "', 
			subquantity='" . (int)$lendto_subquantity . "', 
			borrower_id='" . (int)$lendto_customer_id . "', date_added = NOW()");

		$customer_lending_id = $this->db->getLastId();

		

		$count = 0;
		foreach ($query->rows as $row) {

			if ($count >= $lendto_subquantity) continue;
			
			$customer_transaction_id = $row['customer_transaction_id'];

			// 10 = borrow out 

			$q = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '$customer_transaction_id'");

			$amount = -$q->row['amount'];
			
			$bonus_doctor = $q->row['bonus_doctor'];
			$bonus_consultant = $q->row['bonus_consultant'];
			$bonus_outsource = $q->row['bonus_outsource'];
			$bonus_percent_doctor = $q->row['bonus_percent_doctor'];
			$bonus_percent_consultant = $q->row['bonus_percent_consultant'];
			$bonus_percent_outsource = $q->row['bonus_percent_outsource'];
			$product_type_id = $q->row['product_type_id'];
			$unit_class_id = $q->row['unit_class_id'];
			
			$this->db->query("UPDATE oc_customer_transaction SET 
				customer_lending_id = '$customer_lending_id'
				, unit_class_id = '$unit_class_id'
				, status=10 
				, consultant_id = 0
				
				, doctor_id = 0
				, beauty_id = 0
				, outsource_id = 0
				, date_added = NOW(), date_modified = NOW() 
				WHERE customer_transaction_id = '$customer_transaction_id'");
			
			$sql = "INSERT INTO oc_customer_transaction SET status=-1
				, customer_lending_id = '$customer_lending_id'
				, product_id='$lendto_product_id'
				, quantity='-$quantity'
				, subquantity = -1
				, user_id = $user_id
				, product_type_id = '" . (int)$product_type_id . "'
				, customer_id = '" . (int)$lendto_customer_id . "'
				, bonus_outsource = '" . (float)$bonus_outsource . "'
				, bonus_consultant = '" . (float)$bonus_consultant . "'
				, bonus_doctor = '" . (float)$bonus_doctor . "'
				, bonus_percent_doctor = '" . (int)$bonus_percent_doctor . "'
				, bonus_percent_consultant = '" . (int)$bonus_percent_consultant . "'
				, bonus_percent_outsource = '" . (int)$bonus_percent_outsource . "'
				, unit_class_id = '" . (int)$unit_class_id . "'
				, amount = '" . -(float)$amount . "'
				, date_added = NOW(), date_modified = NOW()";

			$this->db->query($sql);

			$count++;
		}

		$this->db->query("INSERT INTO oc_customer_transaction SET 
			ismain = 0
			, status = 9 
			, customer_lending_id = '$customer_lending_id'
			, product_type_id='$product_type_id'
			, user_id = $user_id
			, product_id='$lendto_product_id'
			, amount = '" . (float)$amount . "'
			, quantity='$lendto_quantity', subquantity=$lendto_subquantity, customer_id = '" . (int)$lendto_customer_id . "', date_added = NOW()");
		// $count = 0;
		// foreach ($query->rows as $row) {
		// 	if ($count > $lendto_subquantity) continue;

		// 	$customer_transaction_id = $row['customer_transaction_id'];
		// 	$count++;
		// }

		// $this->db->query("INSERT INTO oc_customer_lending SET 
		// 	lender_id='" . (int)$customer_id . "', 
		// 	product_id='" . (int)$lendto_product_id . "', 
		// 	subquantity='" . (int)$lendto_subquantity . "', 
		// 	borrower_id='" . (int)$lendto_customer_id . "', date_added = NOW()");

		// $customer_lending_id = $this->db->getLastId();

		// if ($this->addTransaction2($customer_id, $lendto_product_id, $lendto_subquantity, $customer_lending_id, $lendto_customer_id)) {
		// 	$this->addTransaction3($lendto_customer_id, $lendto_product_id, $lendto_subquantity, $customer_lending_id, $customer_id);
			
		// 	return true;
		// }	

		return true;
	}

	// '2014-10-03 10:47'
	public function hasInventory($customer_id, $product_id, $subquantity) {

		$this->load->model('sale/customer');

		$results = $this->model_sale_customer->getTransactionsGroupById($customer_id);

		$hasInventory = false;
		foreach ($results as $result) {
			if ($result['product_id'] == $product_id && $result['status'] >= 0) {
				if ($result['subquantity'] >= $subquantity) {
					$hasInventory = true;
				}
			}
		}

		return $hasInventory;
	}

	// minus transaction
	public function addTransaction2($customer_id, $product_id, $subquantity, $customer_lending_id = 0, $lender_id = 0, $status = 0, $amount = 0) {
		
		if ($product_id <= 0) return false;
		
		if ($subquantity <= 0) return false;

		if ($customer_id <= 0) return false;

		$this->load->model('sale/customer');

		if (!$this->hasInventory($customer_id, $product_id, $subquantity)) return false;

		$this->load->language('sale/history');

		$user_id = $this->user->getId();

		$order_id = 0;

		$query = $this->db->query("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id LEFT JOIN oc_unit_class_description ucd ON ucd.unit_class_id = p.unit_class_id AND pd.language_id = ucd.language_id WHERE p.product_id = '$product_id' AND ucd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		$product_type_id = $query->row['product_type_id'];
		$unit_quantity = $query->row['unit_quantity'];
		$unit_class_id = $query->row['unit_class_id'];
		$bonus_percent_doctor = $query->row['bonus_percent_doctor'];
		$bonus_percent_consultant = $query->row['bonus_percent_consultant'];
		$bonus_percent_outsource = $query->row['bonus_percent_outsource'];


		if ($product_type_id != 2) return false;

		$quantity = (float)$subquantity / (float)$unit_quantity;

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET 
			bonus_percent_doctor = '" . (int)$bonus_percent_doctor . "', 
			bonus_percent_consultant = '" . (int)$bonus_percent_consultant . "', 
			bonus_percent_outsource = '" . (int)$bonus_percent_outsource . "', 
			customer_id = '" . (int)$customer_id . "', 
			product_type_id = '" . (int)$product_type_id . "', 
			status = '" . (int)$status . "', 
			customer_lending_id = '" . (int)$customer_lending_id . "', 
			lender_id = '" . (int)$lender_id . "', 
			product_id = '" . (int)$product_id . "', 
			subquantity = '" . -(int)$subquantity . "'
			, order_id = '" . (int)$order_id . "'
			, user_id = '" . (int)$user_id . "'
			, quantity = '" . -(float)$quantity . "'
			, unit_class_id = '" . (int)$unit_class_id . "'
			, amount = '" . (float)$amount . "'
			, date_added = NOW()");

		$customer_transaction_id = $this->db->getLastId();

		$reminder = $query->row['reminder']; 

		if ($reminder && !$customer_lending_id) {

			$reminder_days = $query->row['reminder_days'];

			$reminder_date = date('Y-m-d', strtotime("+" . $reminder_days . " days"));

			$text_treatment_reminder = sprintf($this->language->get('text_treatment_reminder'), $reminder_days, $query->row['name']);

			//$comment, $user_id = 0, $reminder=null, $reminder_date=null
			$this->addHistory($customer_id, $text_treatment_reminder, $user_id, 1, $reminder_date, 1, $customer_transaction_id);
		}

		return $this->db->countAffected();

	}


	// // plus transaction
	// public function addTransaction3($customer_id, $product_id, $subquantity, $customer_lending_id = 0, $lender_id = 0) {
		
	// 	if ($product_id <= 0) return false;
		
	// 	if ($subquantity <= 0) return false;

	// 	if ($customer_id <= 0) return false;

	// 	$this->load->model('sale/customer');

	// 	$this->load->language('sale/history');

	// 	$user_id = $this->user->getId();

	// 	$order_id = 0;

	// 	$query = $this->db->query("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id LEFT JOIN oc_unit_class_description ucd ON ucd.unit_class_id = p.unit_class_id AND pd.language_id = ucd.language_id WHERE p.product_id = '$product_id' AND ucd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

	// 	$unit_quantity = $query->row['unit_quantity'];

	// 	$unit_class_id = $query->row['unit_class_id'];

	// 	$quantity = (float)$subquantity / (float)$unit_quantity;

	// 	$amount = 0;

	// 	$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET 
	// 		customer_id = '" . (int)$customer_id . "', 
	// 		customer_lending_id = '" . (int)$customer_lending_id . "', 
	// 		lender_id = '" . (int)$lender_id . "', 
	// 		product_id = '" . (int)$product_id . "', 
	// 		subquantity = '" . (int)$subquantity . "', order_id = '" . (int)$order_id . "', quantity = '" . (float)$quantity . "', unit_class_id = '" . (int)$unit_class_id . "', amount = '" . (float)$amount . "', type = '2', date_added = NOW()");

	// 	$customer_transaction_id = $this->db->getLastId();

	// 	return $this->db->countAffected();

	// }


	// '2014-10-03 10:47'
	// '2014-10-08 09:14'only add new transaction
	public function addTransaction($customer_id, $description = '', $orderamount = '', $order_id = 0) {
			
		// '2014-09-09 11:29'
		$customer_info = $this->getCustomer($customer_id);
		$user_id = $this->user->getId();

		$this->load->model('sale/order');
		$this->load->model('catalog/product');
		
		$order_product_info = $this->model_sale_order->getOrderProducts($order_id);

		if ($customer_info && $order_product_info) { 

			$this->db->query("DELETE FROM oc_customer_transaction WHERE order_id = '$order_id' AND customer_id = '$customer_id'");

			foreach ($order_product_info as $product_info) {

				$product_id = $product_info['product_id'];

				$product = $this->model_catalog_product->getProduct($product_id);

				$product_type_id = $product['product_type_id'];
				$quantity = $product_info['quantity'];
				$bonus_percent_beauty = $product['bonus_percent_beauty'];
				$bonus_percent_doctor = $product['bonus_percent_doctor'];
				$bonus_percent_consultant = $product['bonus_percent_consultant'];
				$bonus_percent_outsource = $product['bonus_percent_outsource'];
				$unit_class_id = $product_info['unit_class_id'];
				$subquantity = $product_info['subquantity'] * $quantity;
				$price = $product_info['price'];
				$amount = $price * $quantity; 

				// $this->load->out($amount, false);

				$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET 
					quantity = '" . (int)$quantity . "', customer_id = '" . (int)$customer_id . "'
					, product_id = '" . (int)$product_id . "'
					, user_id = '" . (int)$user_id . "'
					, product_type_id = '" . (int)$product_type_id . "'
					, subquantity = '" . (int)$subquantity . "'
					, order_id = '" . (int)$order_id . "'
					, unit_class_id = '" . (int)$unit_class_id . "'
					, amount = '" . (float)$amount . "'
					,ismain=1
					, date_added = NOW(), date_modified= NOW()");

				// add treatment appointments
				if ($product_type_id == 2) {

					$temp = 1 / $product_info['subquantity']; 
					$eachamount = $amount / $subquantity;

					for ($i = 0; $i < $subquantity; $i++) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET 
							status = -1, 
							user_id = '" . (int)$user_id . "', 
							amount = '" . - (float)$eachamount . "', 
							bonus_percent_outsource = '" .  (int)$bonus_percent_outsource . "', 
							bonus_percent_consultant = '" .  (int)$bonus_percent_consultant . "', 
							bonus_percent_doctor = '" .  (int)$bonus_percent_doctor . "', 
							bonus_percent_beauty = '" .  (int)$bonus_percent_beauty . "', 
							bonus_doctor = '" .  (int)$bonus_percent_doctor * (float)($eachamount/100) . "', 
							bonus_consultant = '" .  (int)$bonus_percent_consultant  * (float)($eachamount/100) . "', 
							bonus_outsource = '" .  (int)$bonus_percent_outsource  * (float)($eachamount/100) . "', 
							bonus_beauty = '" .  (int)$bonus_percent_beauty  * (float)($eachamount/100) . "', 
							
							quantity = '" . -$temp . "'
							,product_total_which = '" . $subquantity . "'
							,product_which = '" . ($i + 1) . "'
							,customer_id = '" . (int)$customer_id . "'
							,product_id = '" . (int)$product_id . "'
						 , product_type_id = '" . (int)$product_type_id . "'
						 , subquantity = '" . -1 . "',  order_id = '" . (int)$order_id . "'
						 , unit_class_id = '" . (int)$unit_class_id . "'
						 , date_modified = NOW(), date_added = NOW()");						
					}
				} else {
					//use up

					

						$this->db->query("INSERT INTO " . DB_PREFIX . "customer_transaction SET 
							status = 2, 
							user_id = '" . (int)$user_id . "', 
							amount = '" . - (float)$amount . "', 
							bonus_percent_outsource = '" .  (int)$bonus_percent_outsource . "', 
							bonus_percent_consultant = '" .  (int)$bonus_percent_consultant . "', 
							bonus_percent_doctor = '" .  (int)$bonus_percent_doctor . "', 
							bonus_percent_beauty = '" .  (int)$bonus_percent_beauty . "', 
							bonus_doctor = '" .  (int)$bonus_percent_doctor * (float)($amount/100) . "', 
							bonus_consultant = '" .  (int)$bonus_percent_consultant  * (float)($amount/100) . "', 
							bonus_outsource = '" .  (int)$bonus_percent_outsource  * (float)($amount/100) . "', 
							bonus_beauty = '" .  (int)$bonus_percent_beauty  * (float)($amount/100) . "', 
							
							quantity = '" . -(int)$quantity . "'
							, subquantity = '" . -(int)$subquantity . "'
							,product_total_which = '" . $subquantity . "'
							,customer_id = '" . (int)$customer_id . "'
							,product_id = '" . (int)$product_id . "'
						 , product_type_id = '" . (int)$product_type_id . "'
						 ,  order_id = '" . (int)$order_id . "'
						 , unit_class_id = '" . (int)$unit_class_id . "'
						 , date_modified = NOW(), date_added = NOW()");		

						 $customer_transaction_id = $this->db->getLastId();	

						 $this->remindProduct($customer_transaction_id);
					

				}

			}


			// $this->language->load('mail/customer');

			// if ($customer_info['store_id']) {
			// 	$this->load->model('setting/store');

			// 	$store_info = $this->model_setting_store->getStore($customer_info['store_id']);

			// 	if ($store_info) {
			// 		$store_name = $store_info['name'];
			// 	} else {
			// 		$store_name = $this->config->get('config_name');
			// 	}	
			// } else {
			// 	$store_name = $this->config->get('config_name');
			// }

			// $message  = sprintf($this->language->get('text_transaction_received'), $this->currency->format($amount, $this->config->get('config_currency'))) . "\n\n";
			// $message .= sprintf($this->language->get('text_transaction_total'), $this->currency->format($this->getTransactionTotal($customer_id)));

			// $mail = new Mail();
			// $mail->protocol = $this->config->get('config_mail_protocol');
			// $mail->parameter = $this->config->get('config_mail_parameter');
			// $mail->hostname = $this->config->get('config_smtp_host');
			// $mail->username = $this->config->get('config_smtp_username');
			// $mail->password = $this->config->get('config_smtp_password');
			// $mail->port = $this->config->get('config_smtp_port');
			// $mail->timeout = $this->config->get('config_smtp_timeout');
			// $mail->setTo($customer_info['email']);
			// $mail->setFrom($this->config->get('config_email'));
			// $mail->setSender($store_name);
			// $mail->setSubject(html_entity_decode(sprintf($this->language->get('text_transaction_subject'), $this->config->get('config_name')), ENT_QUOTES, 'UTF-8'));
			// $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
			// $mail->send();
		}
	}

	// '2014-10-03 10:47'
	// public function deleteTransaction($order_id) {
	// 	$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");

	// }

	// '2014-10-03 10:47'
	public function deleteCustomerLending($customer_lending_id) {

		$query = $this->db->query("SELECT * FROM oc_customer_lending WHERE customer_lending_id = '" . (int)$customer_lending_id . "'");

		if (!$query->num_rows) return false;

		$query2 = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_lending_id = '$customer_lending_id'");

		$candelete = true;
		foreach ($query2->rows as $row) {
			if ($row['status'] > 0) {
				if ($row['status'] != 10 && $row['status'] != 9) {
					$candelete = false;
				}
			}
		}
		$borrower_id = $query->row['borrower_id'];
		$lender_id = $query->row['lender_id'];

		if ($candelete) {
		// if ($this->hasInventory($borrower_id, $product_id, $subquantity)) {

			$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '$borrower_id' AND customer_lending_id = '" . (int)$customer_lending_id . "'");
			$this->db->query("UPDATE " . DB_PREFIX . "customer_transaction SET status = 0, customer_lending_id=0, status=-1 WHERE customer_id = '$lender_id' AND customer_lending_id = '" . (int)$customer_lending_id . "'");
			$this->db->query("DELETE FROM " . DB_PREFIX . "customer_lending WHERE customer_lending_id = '" . (int)$customer_lending_id . "'");

			return true;		
		} else {
			return false;
		}	

	}

	// '2014-10-03 10:47'
	public function deleteCustomerHistory($customer_history_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_history WHERE customer_history_id = '" . (int)$customer_history_id . "'");

		return $this->db->countAffected();

	}

	public function editgrouptransaction($data) {

		

		$this->load->model('catalog/product');

		$unitspend = (isset($data['unitspend']) ? $data['unitspend'] : 0);
		$product_id = (isset($data['product_id']) ? $data['product_id'] : 0);
		$customer_id = (isset($data['customer_id']) ? $data['customer_id'] : 0);
		if (!$product_id) return false;
		if (!$customer_id) return false;

		$product = $this->model_catalog_product->getProduct($product_id);

		$value = $product['value']; 

		if ($value > $unitspend) {
			return false;
		}

		$number_unit_used = (int)round($unitspend / $value);

		$remaining = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_id = '" . (int)$customer_id . "' AND product_id = '" . (int)$product_id . "' AND status < 0 LIMIT 0, $number_unit_used");

		if ($remaining->num_rows < $number_unit_used) {
			return false;
		} else {

			$user_id = $this->user->getId();
			$this->db->query("INSERT INTO oc_customer_treatment_usage (user_id, customer_id, subquantity) VALUES ('$user_id', '$customer_id', '$number_unit_used')");
			$customer_treatment_usage_id = $this->db->getLastId();

			$data['customer_treatment_usage_id'] = $customer_treatment_usage_id;
			foreach ($remaining->rows as $result) {
			
				$this->edittransaction($result['customer_transaction_id'], $data);
			}
			return true;
		}
	}

	// Chandler '2014-11-03 23:02'
	public function editevent($customer_event_id, $data) {

		$sql  = "UPDATE oc_customer_event SET date_added = NOW()";
		
		$sql .= (isset($data['date_start']) ? " , date_start = '" . $data['date_start'] . "'" : '');
		$sql .= (isset($data['date_end']) ? " , date_end = '" . $data['date_end'] . "'" : '');
	
		$sql .= " WHERE customer_event_id = '" . (int)$customer_event_id . "'";

// $this->load->out($sql);
		$this->db->query($sql);

		return $this->db->countAffected();

	}

	public function edittransaction($customer_transaction_id, $data) {

		// update message
		$this->db->query("UPDATE oc_customer_transaction SET date_modified = NOW(), comment = '" . $this->db->escape($data['comment']) . "' WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "'");

		$affected1 = $this->db->countAffected();

		// $query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '$customer_transaction_id'");
		// if(!$query->num_rows) return false;
		// if($query->row['status'] == 10) return false;
		// if($query->row['status'] == 2) return false;

		// update status
		$sql  = "UPDATE oc_customer_transaction SET date_modified = NOW()";
		
		$sql .= (isset($data['status']) && $data['status'] != 'x' ? " , status = '" . $data['status'] . "'" : '');
		$sql .= (isset($data['customer_treatment_usage_id']) ? " , treatment_usage_id = '" . $data['customer_treatment_usage_id'] . "'" : '');

		if (isset($data['status']) && $data['status'] == 2) {
			$sql .= (isset($data['doctor_id']) ? " , doctor_id = '" . $data['doctor_id'] . "'" : '');
			$sql .= (isset($data['consultant_id']) ? " , consultant_id = '" . $data['consultant_id'] . "'" : '');
			$sql .= (isset($data['outsource_id']) ? " , outsource_id = '" . $data['outsource_id'] . "'" : '');
			$sql .= (isset($data['beauty_id']) ? " , beauty_id = '" . $data['beauty_id'] . "'" : '');
			
		}
	
		$sql .= " WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "' AND quantity < 0";

		$this->db->query($sql);

		$affected2 = $this->db->countAffected();

		$this->remindProduct($customer_transaction_id);

		return $affected1 || $affected2; 
	}

	// '2014-10-03 10:47' not good
	public function remindProduct($customer_transaction_id) {

		$query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "'");

		$customer_id = $query->row['customer_id'];
		$product_id = $query->row['product_id'];
		$status = $query->row['status'];
		$comment = $query->row['comment'];

		// '2014-10-03 11:34' no need to remind
		if ($status <= 0 && $status >= 10) return false;

		$this->load->model('catalog/product');

		$product = $this->model_catalog_product->getProduct($product_id);

		$reminder = $product['reminder'];
		$product_type_id = $product['product_type_id'];
		$product_name = $product['name'];

		$reminder_days = $product['reminder_days'];

		$user_id = $this->user->getId();

		$this->language->load('sale/history');

		// $comment = sprintf($this->language->get('text_treatment_reminder'), $reminder_days, $product_name);
		$comment = $this->language->get('text_treatment_reminder');

		$title = $product_name;

		if ($reminder) {
			$this->db->query("DELETE FROM oc_customer_history WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "'");
			$this->db->query("INSERT INTO oc_customer_history (customer_transaction_id, if_treatment, title, comment, customer_id, user_id, reminder, reminder_date, date_added, date_modified, product_id) VALUES ($customer_transaction_id, 1, '$title', '$comment', '$customer_id', '$user_id', '$reminder', DATE_ADD(NOW(),  INTERVAL $reminder_days DAY), NOW(), NOW(), $product_id)");
			
		}
	}

	// '2014-10-07 09:20'
	public function deletetransaction($customer_transaction_id) {

		$this->db->query("DELETE FROM oc_customer_history WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "'");
		
		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_transaction WHERE customer_transaction_id = '" . (int)$customer_transaction_id . "'");

		return $this->db->countAffected();
	}

	// '2014-09-28 11:14' track customer stock
	public function getTransactionsGroupById($customer_id) {

		$query = $this->db->query("SELECT product_id, sum(quantity) as quantity, customer_id, sum(subquantity) as subquantity FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "' GROUP BY product_id");

		return $query->rows;
	}

	public function getTransaction($customer_transaction_id) {
		
		$query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '$customer_transaction_id'");

		return $query->row;
	}

	// '2014-09-29 22:00'
	public function getTransactions($data, $start = 0, $limit = 10) {

		$sql = "SELECT ct.*, pd.name as product_name, c.fullname FROM oc_customer_transaction ct LEFT JOIN oc_customer c ON c.customer_id = ct.customer_id LEFT JOIN oc_product p ON p.product_id = ct.product_id LEFT JOIN oc_product_description pd ON pd.product_id = p.product_id  WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') ."' ";
	
		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ct.customer_id = '" . (int)$data['filter_customer_id'] . "' ";
		}

		if (isset($data['filter_product_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_product_name']) . "%'"; 
		}

		if (isset($data['filter_customer_name'])) {
			$sql .= " AND c.fullname LIKE '%" . $this->db->escape($data['filter_customer_name']) . "%'";
		}	

		if (isset($data['filter_ismain'])) {
			$sql .= " AND ct.ismain = '" . (int)$data['filter_ismain'] . "' ";
		}

		if (isset($data['filter_product_type_id'])) {
			$sql .= " AND ct.product_type_id = '" . (int)$data['filter_product_type_id'] . "' ";
		}

		if (!empty($data['filter_treatment_status'])) {
			$sql .= " AND ct.status = '" . (int)$data['filter_treatment_status'] . "' ";
		}

		if (isset($data['filter_ssn'])) {
			$sql .= " AND c.ssn = '" . $this->db->escape($data['filter_ssn']) . "' ";
		}

		if (isset($data['filter_unused'])) {
			$sql .= " AND ct.status >= 0 ";
		}

		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}	

		$sql .= " ORDER BY ct.date_modified DESC, ct.customer_transaction_id LIMIT " . (int)$start . "," . (int)$limit; 

		$query = $this->db->query($sql);

		return $query->rows;
	}

	// '2014-10-03 10:46'
	public function getTotalTransactions($data) {

		$sql = "SELECT count(*) as total FROM oc_customer_transaction ct LEFT JOIN oc_customer c ON c.customer_id = ct.customer_id LEFT JOIN oc_product p ON p.product_id = ct.product_id LEFT JOIN oc_product_description pd ON pd.product_id = p.product_id  WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') ."' ";
		
		if (isset($data['customer_id'])) {
			$sql .= " AND ct.customer_id = '" . (int)$data['customer_id'] . "' ";
		}

		if (isset($data['filter_product_name'])) {
			$sql .= " AND pd.name LIKE '%" . $this->db->escape($data['filter_product_name']) . "%'"; 
		}

		if (isset($data['filter_customer_name'])) {
			$sql .= " AND c.fullname LIKE '%" . $this->db->escape($data['filter_customer_name']) . "%'";
		}

		if (isset($data['filter_product_type_id'])) {
			$sql .= " AND ct.product_type_id = '" . (int)$data['filter_product_type_id'] . "' ";
		}
		
		if (isset($data['filter_ismain'])) {
			$sql .= " AND ct.ismain = '" . (int)$data['filter_ismain'] . "' ";
		}

		if (!empty($data['filter_treatment_status'])) {
			$sql .= " AND ct.status = '" . (int)$data['filter_treatment_status'] . "' ";
		}

		if (isset($data['filter_ssn'])) {
			$sql .= " AND c.ssn = '" . $this->db->escape($data['filter_ssn']) . "' ";
		}

		if (isset($data['filter_unused'])) {
			$sql .= " AND ct.status >= 0 ";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	// public function getTransactionTotal($customer_id) {
	// 	$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "customer_transaction WHERE customer_id = '" . (int)$customer_id . "'");

	// 	return $query->row['total'];
	// }

	// public function getTotalTransactionsByOrderId($order_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_transaction WHERE order_id = '" . (int)$order_id . "'");

	// 	return $query->row['total'];
	// }	

	// public function addReward($customer_id, $description = '', $points = '', $order_id = 0) {
	// 	$customer_info = $this->getCustomer($customer_id);

	// 	if ($customer_info) { 
	// 		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_reward SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', points = '" . (int)$points . "', description = '" . $this->db->escape($description) . "', date_added = NOW()");

	// 		$this->language->load('mail/customer');

	// 		if ($order_id) {
	// 			$this->load->model('sale/order');

	// 			$order_info = $this->model_sale_order->getOrder($order_id);

	// 			if ($order_info) {
	// 				$store_name = $order_info['store_name'];
	// 			} else {
	// 				$store_name = $this->config->get('config_name');
	// 			}	
	// 		} else {
	// 			$store_name = $this->config->get('config_name');
	// 		}		

	// 		$message  = sprintf($this->language->get('text_reward_received'), $points) . "\n\n";
	// 		$message .= sprintf($this->language->get('text_reward_total'), $this->getRewardTotal($customer_id));

	// 		$mail = new Mail();
	// 		$mail->protocol = $this->config->get('config_mail_protocol');
	// 		$mail->parameter = $this->config->get('config_mail_parameter');
	// 		$mail->hostname = $this->config->get('config_smtp_host');
	// 		$mail->username = $this->config->get('config_smtp_username');
	// 		$mail->password = $this->config->get('config_smtp_password');
	// 		$mail->port = $this->config->get('config_smtp_port');
	// 		$mail->timeout = $this->config->get('config_smtp_timeout');
	// 		$mail->setTo($customer_info['email']);
	// 		$mail->setFrom($this->config->get('config_email'));
	// 		$mail->setSender($store_name);
	// 		$mail->setSubject(html_entity_decode(sprintf($this->language->get('text_reward_subject'), $store_name), ENT_QUOTES, 'UTF-8'));
	// 		$mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
	// 		$mail->send();
	// 	}
	// }

	// public function deleteReward($order_id) {
	// 	$this->db->query("DELETE FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "'");
	// }

	// public function getRewards($customer_id, $start = 0, $limit = 10) {
	// 	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "' ORDER BY date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

	// 	return $query->rows;
	// }

	// public function getTotalRewards($customer_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

	// 	return $query->row['total'];
	// }

	// public function getRewardTotal($customer_id) {
	// 	$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "customer_reward WHERE customer_id = '" . (int)$customer_id . "'");

	// 	return $query->row['total'];
	// }		

	// public function getTotalCustomerRewardsByOrderId($order_id) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_reward WHERE order_id = '" . (int)$order_id . "'");

	// 	return $query->row['total'];
	// }

	// public function getIpsByCustomerId($customer_id) {
	// 	$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_ip WHERE customer_id = '" . (int)$customer_id . "'");

	// 	return $query->rows;
	// }	

	// public function getTotalCustomersByIp($ip) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_ip WHERE ip = '" . $this->db->escape($ip) . "'");

	// 	return $query->row['total'];
	// }

	// public function addBanIp($ip) {
	// 	$this->db->query("INSERT INTO `" . DB_PREFIX . "customer_ban_ip` SET `ip` = '" . $this->db->escape($ip) . "'");
	// }

	// public function removeBanIp($ip) {
	// 	$this->db->query("DELETE FROM `" . DB_PREFIX . "customer_ban_ip` WHERE `ip` = '" . $this->db->escape($ip) . "'");
	// }

	// public function getTotalBanIpsByIp($ip) {
	// 	$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_ban_ip` WHERE `ip` = '" . $this->db->escape($ip) . "'");

	// 	return $query->row['total'];
	// }	

	// '2014-10-03 10:46'
	public function getCustomerImages($data, $start = 0, $limit = 10) {

		$sql = "SELECT * FROM oc_customer_image ci WHERE 1=1  ";

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ci.customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}

		if (isset($data['product_id'])) {
			$sql .= " AND ci.product_id = '" . (int)$data['product_id'] . "'";
		}

		if (isset($data['filter_customer_transaction_id'])) {
			$sql .= " AND ci.customer_transaction_id = '" . (int)$data['filter_customer_transaction_id'] . "'";
		}

		if (isset($data['filter_date_added_start'])) {
			$sql .= " AND ci.date_added >= '" . $this->db->escape($data['filter_date_added_start']) . "'";
		}

		if (isset($data['filter_date_added_end'])) {
			$sql .= " AND ci.date_added <= '" . $this->db->escape($data['filter_date_added_end']) . "'";
		}

		if (isset($data['filter_treatment'])) {
			$sql .= " AND ci.date_added < '" . (int)$data['filter_treatment'] . "'";
		}


		$sql .= " ORDER BY ci.date_added DESC";

		if ($start || $limit) {
			if ($start < 0) {
				$start = 0;
			}			

			if ($limit < 1) {
				$limit = 20;
			}	

			$sql .= " LIMIT " . (int)$start . "," . (int)$limit;
		}		

		$query = $this->db->query($sql);

		return $query->rows;
	}

	//'2014-09-22 15:25'
	public function getCustomerReminders($data) {

		$sql = "SELECT ch.*, u.firstname as ufirstname, u.lastname as ulastname, u.store_id, u.fullname as ufullname, c.firstname as cfirstname, c.lastname as clastname, c.fullname as cfullname, c.telephone, c.mobile FROM oc_customer_history ch LEFT JOIN oc_user u ON u.user_id = ch.user_id LEFT JOIN oc_customer c ON c.customer_id = ch.customer_id ";

		$sql .= " WHERE reminder = 1 "; 

		if (isset($data['filter_reminder_status'])) {
			$sql .= " AND reminder_status = '" . (int)$data['filter_reminder_status'] . "'";
		} 

		if (isset($data['filter_product_id'])) {
			$sql .= " AND product_id = '" . (int)$data['filter_product_id'] . "'";
		} 

		if (isset($data['filter_treatment'])) {
			$sql .= " AND if_treatment = '" . (int)$data['filter_treatment'] . "'";
		} 

		if (isset($data['filter_comment'])) {
			$sql .= " AND comment LIKE '%" . $this->db->escape($data['filter_comment']) . "%'";
		}

		if (isset($data['filter_date_end'])) {
			$sql .= " AND reminder_date <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		if (isset($data['filter_date_start'])) {
			$sql .= " AND reminder_date >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (isset($data['filter_user_id'])) {
			$sql .= " AND ch.user_id = '" . (int)$data['filter_user_id'] . "'"; 
		}

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ch.customer_id = '" . (int)$data['filter_customer_id'] . "'"; 
		}
		

		$sql .= " ORDER BY date_added DESC";

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

	//'2014-09-22 15:25'
	public function getTotalCustomerReminders($data) {

		$sql = "SELECT count(*) as total FROM oc_customer_history ch LEFT JOIN oc_user u ON u.user_id = ch.user_id LEFT JOIN oc_customer c ON c.customer_id = ch.customer_id ";

		$sql .= " WHERE reminder = 1 "; 

		if (isset($data['filter_reminder_status'])) {
			$sql .= " AND reminder_status = '" . (int)$data['filter_reminder_status'] . "'";
		} 

		if (isset($data['filter_product_id'])) {
			$sql .= " AND product_id = '" . (int)$data['filter_product_id'] . "'";
		} 

		if (isset($data['filter_treatment'])) {
			$sql .= " AND if_treatment = '" . (int)$data['filter_treatment'] . "'";
		} 

		if (isset($data['filter_comment'])) {
			$sql .= " AND comment LIKE '%" . $this->db->escape($data['filter_comment']) . "%'";
		}

		if (isset($data['filter_date_end'])) {
			$sql .= " AND reminder_date <= '" . $this->db->escape($data['filter_date_end']) . "'";
		}

		if (isset($data['filter_date_start'])) {
			$sql .= " AND reminder_date >= '" . $this->db->escape($data['filter_date_start']) . "'";
		}

		if (isset($data['filter_user_id'])) {
			$sql .= " AND ch.user_id = '" . (int)$data['filter_user_id'] . "'"; 
		}

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ch.customer_id = '" . (int)$data['filter_customer_id'] . "'"; 
		}
		
		$query = $this->db->query($sql);

		return $query->row['total'];
	}


	// '2014-10-03 10:46'
	public function getTotalCustomerImages($data) {

		$sql = "SELECT count(*) as total FROM oc_customer_image ci WHERE 1=1  ";

		if (isset($data['filter_customer_id'])) {
			$sql .= " AND ci.customer_id = '" . (int)$data['filter_customer_id'] . "'";
		}

		if (isset($data['product_id'])) {
			$sql .= " AND ci.product_id = '" . (int)$data['product_id'] . "'";
		}

		if (isset($data['filter_customer_transaction_id'])) {
			$sql .= " AND ci.customer_transaction_id = '" . (int)$data['filter_customer_transaction_id'] . "'";
		}

		if (isset($data['filter_date_added_start'])) {
			$sql .= " AND ci.date_added >= '" . $this->db->escape($data['filter_date_added_start']) . "'";
		}

		if (isset($data['filter_date_added_end'])) {
			$sql .= " AND ci.date_added <= '" . $this->db->escape($data['filter_date_added_end']) . "'";
		}

		if (isset($data['filter_treatment'])) {
			$sql .= " AND ci.date_added < '" . (int)$data['filter_treatment'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	function updatehistory($user_id, $reminder_status_id, $customer_history_id, $reply){

		$query = $this->db->query("SELECT * FROM oc_reminder_status WHERE reminder_status_id = '$reminder_status_id'");

		$days = $query->row['additional_days'];

		$target = $query->row['reminder_change_status_id'];

		if ($reminder_status_id == 6) $days = 30;
		if ($reminder_status_id == 5) $days = 14;
		if ($reminder_status_id == 4) $days = 5;
		if ($reminder_status_id == 3) $days = 3;

		// if ($reminder_status_id > 0) 
			// $sql = "UPDATE oc_customer_history SET reminder_date = DATE_ADD(NOW(), INTERVAL $days DAY), reminder_status = '$reminder_status_id', reminded_already='1', reply='" . $this->db->escape($reply) . "', date_modified = NOW() WHERE customer_history_id = $customer_history_id AND user_id = $user_id";

		// else 
			$sql = "UPDATE oc_customer_history SET reminder_date = DATE_ADD(NOW(), INTERVAL $days DAY), reminder_status = '$target', reminded_already='1', reply='" . $this->db->escape($reply) . "', date_modified = NOW() WHERE customer_history_id = $customer_history_id AND user_id = $user_id";

		$this->db->query($sql);

		return $this->db->countAffected();
	}




}
?>