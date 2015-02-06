<?php    
class ControllerSaleCustomer extends Controller { 
	private $error = array();

	// public function clear() {

	// 	$this->db->query("DELETE FROM oc_customer_transaction");
	// 	$this->db->query("DELETE FROM oc_customer_history");
	// 	$this->db->query("DELETE FROM oc_customer_image");
	// 	$this->db->query("DELETE FROM oc_customer_reward");
	// 	$this->db->query("DELETE FROM oc_customer_treatment_usage");
	// 	$this->db->query("DELETE FROM oc_customer_lending");
	// 	$this->db->query("DELETE FROM oc_order_product");
	// 	$this->db->query("DELETE FROM oc_order_total");
	// 	$this->db->query("DELETE FROM oc_purchase");
	// 	$this->db->query("DELETE FROM oc_purchase_product");
	// 	$this->db->query("DELETE FROM oc_order");
	// 	$this->db->query("DELETE FROM oc_order_history");
	// 	$this->db->query("DELETE FROM oc_product_to_store");
	//  $this->db->query("DELETE FROM oc_customer_group");
	//  $this->db->query("DELETE FROM oc_customer_group_description");
	//  $this->db->query("DELETE FROM oc_customer");
	//  $this->db->query("DELETE FROM oc_user WHERE user_id > 1");
	// }

	public function index() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		$this->data['if_search'] = true;

		$this->getList();
		
	}

	public function insert() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		$this->data['is_insert'] = true;

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$customer_id = $this->model_sale_customer->addCustomer($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			// if (isset($this->request->get['filter_name'])) {
			// 	$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			// }

			// if (isset($this->request->get['filter_email'])) {
			// 	$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			// }

			// if (isset($this->request->get['filter_customer_group_id'])) {
			// 	$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			// }

			// if (isset($this->request->get['filter_status'])) {
			// 	$url .= '&filter_status=' . $this->request->get['filter_status'];
			// }

			// if (isset($this->request->get['filter_approved'])) {
			// 	$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			// }

			// if (isset($this->request->get['filter_ip'])) {
			// 	$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			// }

			// if (isset($this->request->get['filter_date_added'])) {
			// 	$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			// }

			// if (isset($this->request->get['sort'])) {
			// 	$url .= '&sort=' . $this->request->get['sort'];
			// }

			// if (isset($this->request->get['order'])) {
			// 	$url .= '&order=' . $this->request->get['order'];
			// }_

			// if (isset($this->request->get['page'])) {
			// 	$url .= '&page=' . $this->request->get['page'];
			// }

			if (isset($customer_id)) {
				$url .= '&filter_customer_id=' . $customer_id;
			}

			$this->redirect($this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		$this->data['is_insert'] = false;

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer->editCustomer($this->request->get['filter_customer_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

	
			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_customer_id'])) {
				$url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			// if (isset($this->request->get['filter_customer_id'])) {
			// 	$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
			// }

			$this->redirect($this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $customer_id) {
				$this->model_sale_customer->deleteCustomer($customer_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}	

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['filter_ssn'])) {
				$url .= '&filter_ssn=' . $this->request->get['filter_ssn'];
			}

			$this->redirect($this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function approve() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		if (!$this->user->hasPermission('modify', 'sale/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		} elseif (isset($this->request->post['selected'])) {
			$approved = 0;

			foreach ($this->request->post['selected'] as $customer_id) {
				$customer_info = $this->model_sale_customer->getCustomer($customer_id);

				if ($customer_info && !$customer_info['approved']) {
					$this->model_sale_customer->approve($customer_id);

					$approved++;
				}
			} 

			$this->session->data['success'] = sprintf($this->language->get('text_approved'), $approved);	

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_email'])) {
				$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_customer_group_id'])) {
				$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['filter_approved'])) {
				$url .= '&filter_approved=' . $this->request->get['filter_approved'];
			}

			if (isset($this->request->get['filter_ip'])) {
				$url .= '&filter_ip=' . $this->request->get['filter_ip'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}	

			$this->redirect($this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));			
		}

		$this->getList();
	} 

	public function all() {

		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		$this->data['if_search'] = false;
		$this->data['if_display'] = true;
		$this->data['is_all'] = true;

		unset($this->request->get['filter_name']);
		unset($this->request->get['filter_ssn']);
		unset($this->request->get['filter_email']);
		unset($this->request->get['filter_customer_group_id']);
		unset($this->request->get['filter_status']);
		unset($this->request->get['filter_approved']);
		unset($this->request->get['filter_date_added']);

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$filter_customer_id = $this->request->get['filter_customer_id'];
		} else {
			$filter_customer_id = null;
		}

		if (isset($this->request->get['filter_ssn'])) {
			$filter_ssn = $this->request->get['filter_ssn'];
		} else {
			$filter_ssn = null;
		}


		if (isset($this->request->get['filter_dob'])) {
			$filter_dob = $this->request->get['filter_dob'];
		} else {
			$filter_dob = null;
		}

		if (isset($this->request->get['filter_mobile'])) {
			$filter_mobile = $this->request->get['filter_mobile'];
		} else {
			$filter_mobile = null;
		}

		if (isset($this->request->get['filter_telephone'])) {
			$filter_telephone = $this->request->get['filter_telephone'];
		} else {
			$filter_telephone = null;
		}

		// if (isset($this->request->get['filter_email'])) {
		// 	$filter_email = $this->request->get['filter_email'];
		// } else {
		// 	$filter_email = null;
		// }

		// if (isset($this->request->get['filter_customer_group_id'])) {
		// 	$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		// } else {
		// 	$filter_customer_group_id = null;
		// }

		// if (isset($this->request->get['filter_status'])) {
		// 	$filter_status = $this->request->get['filter_status'];
		// } else {
		// 	$filter_status = null;
		// }

		// if (isset($this->request->get['filter_approved'])) {
		// 	$filter_approved = $this->request->get['filter_approved'];
		// } else {
		// 	$filter_approved = null;
		// }

		// if (isset($this->request->get['filter_ip'])) {
		// 	$filter_ip = $this->request->get['filter_ip'];
		// } else {
		// 	$filter_ip = null;
		// }

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}	


		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'name'; 
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_ssn'])) {
			$url .= '&filter_ssn=' . urlencode(html_entity_decode($this->request->get['filter_ssn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}	

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_dob'])) {
			$url .= '&filter_dob=' . $this->request->get['filter_dob'];
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . $this->request->get['filter_telephone'];
		}

		if (isset($this->request->get['filter_mobile'])) {
			$url .= '&filter_mobile=' . $this->request->get['filter_mobile'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['approve'] = $this->url->link('sale/customer/approve', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['insert'] = $this->url->link('sale/customer/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('sale/customer/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['customers'] = array();

		$data = array(
			'filter_name'              => $filter_name, 
			'filter_customer_id'              => $filter_customer_id, 
			'filter_ssn'               => $filter_ssn, 
			// 'filter_email'             => $filter_email, 
			// 'filter_customer_group_id' => $filter_customer_group_id, 
			'filter_dob' => $filter_dob, 
			'filter_mobile' => $filter_mobile, 
			'filter_telephone' => $filter_telephone, 
			// 'filter_status'            => $filter_status, 
			// 'filter_approved'          => $filter_approved, 
			// 'filter_date_added'        => $filter_date_added,
			// 'filter_ip'                => $filter_ip,
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                    => $this->config->get('config_admin_limit')
		);

		$customer_total = $this->model_sale_customer->getTotalCustomers($data);

		$results = $this->model_sale_customer->getCustomers($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&filter_customer_id=' . $result['customer_id'] . $url, 'SSL')
			);

			$fullname = array();

			$fullname[] = array(
				'text' => $result['fullname'], 
				'href' => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&filter_customer_id=' . $result['customer_id'] . $url, 'SSL')
			);

			$query3 = $this->db->query("SELECT * FROM oc_customer_transaction WHERE status =2 AND customer_id = '" . (int)$result['customer_id'] ."' ORDER BY date_modified DESC LIMIT 1");

			$last_doctor = '';
			$last_beauty = '';
			$last_consultant = '';
			$last_outsource = '';
			$last_visit = '';

			if ($query3->num_rows) {

				$last_visit = $query3->row['date_modified'];

				$outsource_id = $query3->row['outsource_id'];

				if ($outsource_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$outsource_id'");

					$last_outsource = $result2->row['fullname'];
				}

				$consultant_id = $query3->row['consultant_id'];
				if ($consultant_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$consultant_id'");
					$last_consultant = $result2->row['fullname'];
				}

				$beauty_id = $query3->row['beauty_id'];
				if ($beauty_id > 0) { 
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$beauty_id'");
					$last_beauty = $result2->row['fullname'];
				}

				$doctor_id = $query3->row['doctor_id'];
				if ($doctor_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$doctor_id'");
					$last_doctor = $result2->row['fullname'];
				}
			}

			$dobs = explode('-', $result['dob']);
			$dob = ((int)$dobs[0]) . '-' . $dobs[1] . '-' . $dobs[2];

			// $dobs = explode('-', $result['dob']);
			// $dob = ((int)$dobs[0] - 1911) . '-' . $dobs[1] . '-' . $dobs[2];

			$this->data['customers'][] = array(
				'customer_id'    => $result['customer_id'],
				'fullname'           => $fullname,
				'dob'          => $dob,
				'mobile'          => $result['mobile'],
				'email'          => $result['email'],
				// 'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'       => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'ip'             => $result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),
				'action'         => $action,
				'last_visit' => explode(' ', $last_visit)[0],
				'last_outsource' => $last_outsource,
				'last_consultant' => $last_consultant,
				'last_beauty' => $last_beauty,
				'last_doctor' => $last_doctor,
			);
		}	

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');	
		$this->data['text_select'] = $this->language->get('text_select');	
		$this->data['text_default'] = $this->language->get('text_default');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_search_customer'] = $this->language->get('text_search_customer');
		$this->data['text_all_customers'] = $this->language->get('text_all_customers');
		$this->data['text_update_comment_success'] = $this->language->get('text_update_comment_success');

		$this->data['column_customer_id'] = $this->language->get('column_customer_id');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_customer_group'] = $this->language->get('column_customer_group');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_approved'] = $this->language->get('column_approved');
		$this->data['column_ip'] = $this->language->get('column_ip');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_login'] = $this->language->get('column_login');
		$this->data['column_action'] = $this->language->get('column_action');		
		$this->data['column_ssn'] = $this->language->get('column_ssn');		
		$this->data['column_mobile'] = $this->language->get('column_mobile');		
		$this->data['column_telephone'] = $this->language->get('column_telephone');		
		$this->data['column_dob'] = $this->language->get('column_dob');		
		$this->data['column_doctor'] = $this->language->get('column_doctor');		
		$this->data['column_consultant'] = $this->language->get('column_consultant');		
		$this->data['column_beauty'] = $this->language->get('column_beauty');		
		$this->data['column_outsource'] = $this->language->get('column_outsource');		
		$this->data['column_date_last_visit'] = $this->language->get('column_date_last_visit');		

		$this->data['button_approve'] = $this->language->get('button_approve');
		$this->data['button_insert'] = $this->language->get('button_insert');
		$this->data['button_delete'] = $this->language->get('button_delete');
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$this->data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} 

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_ssn'])) {
			$url .= '&filter_ssn=' . urlencode(html_entity_decode($this->request->get['filter_ssn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}	

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
		$this->data['sort_email'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, 'SSL');
		$this->data['sort_customer_group'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
		$this->data['sort_approved'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=c.approved' . $url, 'SSL');
		$this->data['sort_ip'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=c.ip' . $url, 'SSL');
		$this->data['sort_date_added'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_ssn'])) {
			$url .= '&filter_ssn=' . urlencode(html_entity_decode($this->request->get['filter_ssn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}

		if (isset($this->request->get['filter_ip'])) {
			$url .= '&filter_ip=' . $this->request->get['filter_ip'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $customer_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');


		if (isset($this->data['is_all'])) $pagination->url = $this->url->link('sale/customer/all', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_customer_id'] = $filter_customer_id;
		$this->data['filter_ssn'] = $filter_ssn;
		$this->data['filter_dob'] = $filter_dob;
		$this->data['filter_telephone'] = $filter_telephone;
		$this->data['filter_mobile'] = $filter_mobile;
		// $this->data['filter_email'] = $filter_email;
		// $this->data['filter_customer_group_id'] = $filter_customer_group_id;
		// $this->data['filter_status'] = $filter_status;
		// $this->data['filter_approved'] = $filter_approved;
		// $this->data['filter_ip'] = $filter_ip;
		// $this->data['filter_date_added'] = $filter_date_added;

		$this->load->model('sale/customer_group');

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'sale/customer_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {

		$this->load->model('sale/customer_group');
		$this->load->model('sale/customer');

		$this->data['heading_title'] = $this->language->get('heading_title');
		
		$this->data['text_sex_female'] = $this->language->get('text_sex_female');
		$this->data['text_sex_male'] = $this->language->get('text_sex_male');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_wait'] = $this->language->get('text_wait');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
		$this->data['text_reminder'] = $this->language->get('text_reminder');
		$this->data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');

		$this->data['column_ip'] = $this->language->get('column_ip');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['entry_last_outsource'] = $this->language->get('entry_last_outsource');
		$this->data['entry_last_doctor'] = $this->language->get('entry_last_doctor');
		$this->data['entry_last_consultant'] = $this->language->get('entry_last_consultant');
		$this->data['entry_last_beauty'] = $this->language->get('entry_last_beauty');
		$this->data['entry_last_visit'] = $this->language->get('entry_last_visit');
		$this->data['entry_borrowfrom'] = $this->language->get('entry_borrowfrom');
		
		// $this->data['entry_firstname'] = $this->language->get('entry_firstname');
		// $this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_sex'] = $this->language->get('entry_sex');
		$this->data['entry_lastname'] = $this->language->get('entry_name');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_mobile'] = $this->language->get('entry_mobile');
		$this->data['entry_password'] = $this->language->get('entry_password');
		$this->data['entry_confirm'] = $this->language->get('entry_confirm');
		$this->data['entry_newsletter'] = $this->language->get('entry_newsletter');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_company_id'] = $this->language->get('entry_company_id');
		$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_default'] = $this->language->get('entry_default');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_amount'] = $this->language->get('entry_amount');
		$this->data['entry_unit_used'] = $this->language->get('entry_unit_used');
		$this->data['entry_unit'] = $this->language->get('entry_unit');
		$this->data['entry_points'] = $this->language->get('entry_points');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_lendto'] = $this->language->get('entry_lendto');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_fb_id'] = $this->language->get('entry_fb_id');
		$this->data['entry_line_id'] = $this->language->get('entry_line_id');
		$this->data['entry_dob'] = $this->language->get('entry_dob');
		$this->data['entry_counselor_id'] = $this->language->get('entry_counselor_id');
		$this->data['entry_nickname'] = $this->language->get('entry_nickname');
		$this->data['entry_ssn'] = $this->language->get('entry_ssn');
		$this->data['entry_outsource'] = $this->language->get('entry_outsource');
		$this->data['entry_location'] = $this->language->get('entry_location');
		$this->data['entry_counselor_id'] = $this->language->get('entry_counselor_id');
		$this->data['entry_misc'] = $this->language->get('entry_misc');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_treatment_status'] = $this->language->get('entry_treatment_status');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_address'] = $this->language->get('button_add_address');
		$this->data['button_add_history'] = $this->language->get('button_add_history');
		$this->data['button_add_transaction'] = $this->language->get('button_add_transaction');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_add_transaction2'] = $this->language->get('button_add_transaction2');
		$this->data['button_add_reward'] = $this->language->get('button_add_reward');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_lendto'] = $this->language->get('button_lendto');
		$this->data['button_borrowfrom'] = $this->language->get('button_borrowfrom');
		$this->data['button_display_2image'] = $this->language->get('button_display_2image');
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_edit_basic'] = $this->language->get('button_edit_basic');

		$this->data['tab_order'] = $this->language->get('tab_order');
		$this->data['tab_image'] = $this->language->get('tab_image');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_address'] = $this->language->get('tab_address');
		$this->data['tab_history'] = $this->language->get('tab_history');
		$this->data['tab_transaction'] = $this->language->get('tab_transaction');
		$this->data['tab_reward'] = $this->language->get('tab_reward');
		$this->data['tab_ip'] = $this->language->get('tab_ip');
		$this->data['tab_lendto'] = $this->language->get('tab_lendto');
		$this->data['tab_payment'] = $this->language->get('tab_payment');
		$this->data['tab_product'] = $this->language->get('tab_product');

		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_unit_used'] = $this->language->get('column_unit_used');
		$this->data['entry_beauty'] = $this->language->get('entry_beauty');
		$this->data['entry_consultant'] = $this->language->get('entry_consultant');
		$this->data['entry_outsource'] = $this->language->get('entry_outsource');
		$this->data['entry_doctor'] = $this->language->get('entry_doctor');
		$this->data['text_transaction_unoccured'] = $this->language->get('text_transaction_unoccured');
		$this->data['text_transaction_appointed'] = $this->language->get('text_transaction_appointed');
		$this->data['text_transaction_finished'] = $this->language->get('text_transaction_finished');

		$this->data['token'] = $this->session->data['token'];
		

		// if (isset($this->request->get['filter_customer_id'])) {
		// 	$this->data['customer_id'] = $this->request->get['filter_customer_id'];
		// } else {
		// 	$this->data['customer_id'] = 0;
		// }

		if (isset($this->request->get['filter_customer_id'])) {
			$this->data['filter_customer_id'] = $this->request->get['filter_customer_id'];
		} else {
			$this->data['filter_customer_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$this->data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$this->data['success'] = '';
		}

		if (isset($this->session->data['error'])) {
			$this->data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} 

		if (isset($this->error['dob'])) {
			$this->data['error_dob'] = $this->error['dob'];
		} else {
			$this->data['error_dob'] = '';
		}

		if (isset($this->error['ssn'])) {
			$this->data['error_ssn'] = $this->error['ssn'];
		} else {
			$this->data['error_ssn'] = '';
		}

		// if (isset($this->error['firstname'])) {
		// 	$this->data['error_firstname'] = $this->error['firstname'];
		// } else {
		// 	$this->data['error_firstname'] = '';
		// }

		if (isset($this->error['lastname'])) {
			$this->data['error_lastname'] = $this->error['lastname'];
		} else {
			$this->data['error_lastname'] = '';
		}

		if (isset($this->error['email'])) {
			$this->data['error_email'] = $this->error['email'];
		} else {
			$this->data['error_email'] = '';
		}

		if (isset($this->error['telephone'])) {
			$this->data['error_telephone'] = $this->error['telephone'];
		} else {
			$this->data['error_telephone'] = '';
		}

		if (isset($this->error['mobile'])) {
			$this->data['error_mobile'] = $this->error['mobile'];
		} else {
			$this->data['error_mobile'] = '';
		}

		if (isset($this->error['password'])) {
			$this->data['error_password'] = $this->error['password'];
		} else {
			$this->data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$this->data['error_confirm'] = $this->error['confirm'];
		} else {
			$this->data['error_confirm'] = '';
		}

		if (isset($this->error['address_firstname'])) {
			$this->data['error_address_firstname'] = $this->error['address_firstname'];
		} else {
			$this->data['error_address_firstname'] = '';
		}

		if (isset($this->error['address_lastname'])) {
			$this->data['error_address_lastname'] = $this->error['address_lastname'];
		} else {
			$this->data['error_address_lastname'] = '';
		}

		if (isset($this->error['address_tax_id'])) {
			$this->data['error_address_tax_id'] = $this->error['address_tax_id'];
		} else {
			$this->data['error_address_tax_id'] = '';
		}

		if (isset($this->error['address_address_1'])) {
			$this->data['error_address_address_1'] = $this->error['address_address_1'];
		} else {
			$this->data['error_address_address_1'] = '';
		}

		if (isset($this->error['address_city'])) {
			$this->data['error_address_city'] = $this->error['address_city'];
		} else {
			$this->data['error_address_city'] = '';
		}

		if (isset($this->error['address_postcode'])) {
			$this->data['error_address_postcode'] = $this->error['address_postcode'];
		} else {
			$this->data['error_address_postcode'] = '';
		}

		if (isset($this->error['address_country'])) {
			$this->data['error_address_country'] = $this->error['address_country'];
		} else {
			$this->data['error_address_country'] = '';
		}

		if (isset($this->error['address_zone'])) {
			$this->data['error_address_zone'] = $this->error['address_zone'];
		} else {
			$this->data['error_address_zone'] = '';
		}

		if (isset($this->error['store'])) {
			$this->data['error_store'] = $this->error['store'];
		} else {
			$this->data['error_store'] = '';
		}

		if (isset($this->error['sex'])) {
			$this->data['error_sex'] = $this->error['sex'];
		} else {
			$this->data['error_sex'] = '';
		}


		// // Images
		// if (isset($this->request->post['customer_image'])) {
		// 	$customer_images = $this->request->post['customer_image'];
		// } elseif (isset($this->request->get['filter_customer_id'])) {
		// 	$tempdata = array(
		// 		'customer_id' => $this->request->get['filter_customer_id']
		// 	);	
		// 	$customer_images = $this->model_sale_customer->getCustomerImages($tempdata);
		// } else {
		// 	$customer_images = array();
		// }


		// $this->data['customer_images'] = array();

		// foreach ($customer_images as $customer_image) {
		// 	if ($customer_image['image'] && file_exists(DIR_IMAGE . $customer_image['image'])) {
		// 		$image = $customer_image['image'];
		// 	} else {
		// 		$image = 'no_image.jpg';
		// 	}

		// 	$this->data['customer_images'][] = array(
		// 		'image'      => $image,
		// 		'customer_transaction_id'      => $customer_image['customer_transaction_id'],
		// 		'date_added'      =>  explode(' ' ,$customer_image['date_added'])[0],
		// 		'thumb'      => $this->model_tool_image->resize($image, 100, 100),
		// 		'sort_order' => $customer_image['sort_order']
		// 	);
		// }

		$url = '';

		if (isset($this->request->get['filter_mobile'])) {
			$url .= '&filter_mobile=' . urlencode(html_entity_decode($this->request->get['filter_mobile'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_telephone'])) {
			$url .= '&filter_telephone=' . urlencode(html_entity_decode($this->request->get['filter_telephone'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_dob'])) {
			$url .= '&filter_dob=' . urlencode(html_entity_decode($this->request->get['filter_dob'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_ssn'])) {
			$url .= '&filter_ssn=' . urlencode(html_entity_decode($this->request->get['filter_ssn'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_approved'])) {
			$url .= '&filter_approved=' . $this->request->get['filter_approved'];
		}	

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (!isset($this->request->get['filter_customer_id'])) {
			$this->data['action'] = $this->url->link('sale/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . $url, 'SSL');
		}

		$this->data['neworder'] = $this->url->link('sale/order/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['cancel'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');
		// $this->data['cancel'] = $this->url->link('sale/customer/update&customer_id=' . $this->request->get['filter_customer_id'], 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['filter_customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customer_info = $this->model_sale_customer->getCustomer($this->request->get['filter_customer_id']);
		}

		// if (isset($this->request->post['firstname'])) {
		// 	$this->data['firstname'] = $this->request->post['firstname'];
		// } elseif (!empty($customer_info)) { 
		// 	$this->data['firstname'] = $customer_info['firstname'];
		// } else {
		// 	$this->data['firstname'] = '';
		// }

		if (isset($this->request->post['lastname'])) {
			$this->data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($customer_info)) {
			$this->data['lastname'] = $customer_info['lastname'];
		} else {
			$this->data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$this->data['email'] = $this->request->post['email'];
		} elseif (!empty($customer_info)) {
			$this->data['email'] = $customer_info['email'];
		} else {
			$this->data['email'] = '';
		}

		if (isset($this->request->post['telephone'])) {
			$this->data['telephone'] = $this->request->post['telephone'];
		} elseif (!empty($customer_info)) {
			$this->data['telephone'] = $customer_info['telephone'];
		} else {
			$this->data['telephone'] = '';
		}

		if (isset($this->request->post['mobile'])) {
			$this->data['mobile'] = $this->request->post['mobile'];
		} elseif (!empty($customer_info)) {
			$this->data['mobile'] = $customer_info['mobile'];
		} else {
			$this->data['mobile'] = '';
		}

		if (isset($this->request->post['dob'])) {
			$this->data['dob'] = $this->request->post['dob'];
		} elseif (!empty($customer_info)) {
			
			$indexofdash = strpos($customer_info['dob'], "-"); 
			$year = (int)substr($customer_info['dob'], 0, $indexofdash) - 1911; 
			$rest = substr($customer_info['dob'], $indexofdash);
			$this->data['dob'] = $this->db->escape($year . $rest);
			
		} else {
			$this->data['dob'] = '';
		}

		if (isset($this->request->post['ssn'])) {
			$this->data['ssn'] = $this->request->post['ssn'];
		} elseif (!empty($customer_info)) {
			$this->data['ssn'] = $customer_info['ssn'];
		} else {
			$this->data['ssn'] = '';
		}

		if (isset($this->request->post['line_id'])) {
			$this->data['line_id'] = $this->request->post['line_id'];
		} elseif (!empty($customer_info)) {
			$this->data['line_id'] = $customer_info['line_id'];
		} else {
			$this->data['line_id'] = '';
		}

		if (isset($this->request->post['counselor_id'])) {
			$this->data['counselor_id'] = $this->request->post['counselor_id'];
		} elseif (!empty($customer_info)) {
			$this->data['counselor_id'] = $customer_info['counselor_id'];
		} else {
			$this->data['counselor_id'] = '';
		}

		if (isset($this->request->post['location'])) {
			$this->data['location'] = $this->request->post['location'];
		} elseif (!empty($customer_info)) {
			$this->data['location'] = $customer_info['location'];
		} else {
			$this->data['location'] = '';
		}

		if (isset($this->request->post['fb_id'])) {
			$this->data['fb_id'] = $this->request->post['fb_id'];
		} elseif (!empty($customer_info)) {
			$this->data['fb_id'] = $customer_info['fb_id'];
		} else {
			$this->data['fb_id'] = '';
		}

		if (isset($this->request->post['misc'])) {
			$this->data['misc'] = $this->request->post['misc'];
		} elseif (!empty($customer_info)) {
			$this->data['misc'] = $customer_info['misc'];
		} else {
			$this->data['misc'] = '';
		}

		if (isset($this->request->post['outsource'])) {
			$this->data['outsource'] = $this->request->post['outsource'];
		} elseif (!empty($customer_info)) {
			$this->data['outsource'] = $customer_info['outsource'];
		} else {
			$this->data['outsource'] = '';
		}

		if (isset($this->request->post['nickname'])) {
			$this->data['nickname'] = $this->request->post['nickname'];
		} elseif (!empty($customer_info)) {
			$this->data['nickname'] = $customer_info['nickname'];
		} else {
			$this->data['nickname'] = '';
		}

		if (isset($this->request->post['ssn'])) {
			$this->data['ssn'] = $this->request->post['ssn'];
		} elseif (!empty($customer_info)) {
			$this->data['ssn'] = $customer_info['ssn'];
		} else {
			$this->data['ssn'] = '';
		}

		if (isset($this->request->post['newsletter'])) {
			$this->data['newsletter'] = $this->request->post['newsletter'];
		} elseif (!empty($customer_info)) {
			$this->data['newsletter'] = $customer_info['newsletter'];
		} else {
			$this->data['newsletter'] = '';
		}

		$this->load->model('tool/image'); 

		if (isset($this->request->post['avatarimage'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['avatarimage'], 100, 100);
			$this->data['image'] = $this->request->post['avatarimage'];
			
		} elseif (!empty($customer_info)) {
			$this->data['thumb'] = $this->model_tool_image->resize($customer_info['image'], 100, 100);
			$this->data['image'] = $customer_info['image'];
		} else {
			$this->data['image'] = '';
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		if (isset($this->request->post['sex'])) {
			$this->data['sex'] = $this->request->post['sex'];
		} elseif (!empty($customer_info)) {
			$this->data['sex'] = $customer_info['sex'];
		} else {
			$this->data['sex'] = '';
		}

		if (isset($this->request->post['store'])) {
			$this->data['store'] = $this->request->post['store'];
		} elseif (!empty($customer_info)) {
			$this->data['store'] = $customer_info['store_id'];
		} else {
			$this->data['store'] = '';
		}

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title') . ' (' .$this->data['lastname'] . ')',
			'href'      => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();


		$query21 = $this->db->query("SELECT * FROM oc_treatment_status WHERE ismain = 1");

		$this->data['treatmentstatuses'] = $query21->rows;

		$this->load->model('catalog/product');
		$this->data['totalproducts'] = $this->model_catalog_product->getProducts();




	
		$last_doctor = '';
		$last_beauty = '';
		$last_consultant = '';
		$last_outsource = '';
		$last_visit = '';

		if (isset($this->request->get['filter_customer_id'])){
			$query3 = $this->db->query("SELECT * FROM oc_customer_transaction WHERE status =2 AND customer_id = '" . (int)$this->request->get['filter_customer_id'] ."' ORDER BY date_modified DESC LIMIT 1");


			if ($query3->num_rows) {

				$last_visit = $query3->row['date_modified'];

				$outsource_id = $query3->row['outsource_id'];

				if ($outsource_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$outsource_id'");

					$last_outsource = $result2->row['fullname'];
				}

				$consultant_id = $query3->row['consultant_id'];
				if ($consultant_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$consultant_id'");
					$last_consultant = $result2->row['fullname'];
				}

				$beauty_id = $query3->row['beauty_id'];
				if ($beauty_id > 0) { 
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$beauty_id'");
					$last_beauty = $result2->row['fullname'];
				}

				$doctor_id = $query3->row['doctor_id'];
				if ($doctor_id > 0) {
					$result2 = $this->db->query("SELECT * FROM oc_user WHERE user_id = '$doctor_id'");
					$last_doctor = $result2->row['fullname'];
				}
			}
		}

		$this->data['last_visit'] = explode(' ',$last_visit)[0];
		$this->data['last_doctor'] = $last_doctor;
		$this->data['last_consultant'] = $last_consultant;
		$this->data['last_beauty'] = $last_beauty;
		$this->data['last_outsource'] = $last_outsource;
		

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['customer_group_id'])) {
			$this->data['customer_group_id'] = $this->request->post['customer_group_id'];
		} elseif (!empty($customer_info)) {
			$this->data['customer_group_id'] = $customer_info['customer_group_id'];
		} else {
			$this->data['customer_group_id'] = $this->config->get('config_customer_group_id');
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($customer_info)) {
			$this->data['status'] = $customer_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		if (isset($this->request->post['password'])) {
			$this->data['password'] = $this->request->post['password'];
		} else {
			$this->data['password'] = '';
		}

		if (isset($this->request->post['confirm'])) { 
			$this->data['confirm'] = $this->request->post['confirm'];
		} else {
			$this->data['confirm'] = '';
		}

		$this->load->model('localisation/country');

		$this->data['countries'] = $this->model_localisation_country->getCountries();

		if (isset($this->request->post['address'])) { 
			$this->data['address'] = $this->request->post['address'];
		} elseif (isset($this->request->get['filter_customer_id'])) {
			foreach ($this->model_sale_customer->getAddresses($this->request->get['filter_customer_id']) as $key => $value) {
				$this->data['address'] = $value;
			}
		} else {
			$this->data['address'] = array(
				'address_1' => '',
				'address_2' => '',
				'city' => '',
				'postcode' => ''
			);
		}

		if (isset($this->request->post['address_id'])) {
			$this->data['address_id'] = $this->request->post['address_id'];
		} elseif (!empty($customer_info)) {
			$this->data['address_id'] = $customer_info['address_id'];
		} else {
			$this->data['address_id'] = '';
		}

		
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		// if (!empty($customer_info)) {
		// 	$results = $this->model_sale_customer->getIpsByCustomerId($this->request->get['filter_customer_id']);

		// 	foreach ($results as $result) {
		// 		$ban_ip_total = $this->model_sale_customer->getTotalBanIpsByIp($result['ip']);

		// 		$this->data['ips'][] = array(
		// 			'ip'         => $result['ip'],
		// 			'total'      => $this->model_sale_customer->getTotalCustomersByIp($result['ip']),
		// 			'date_added' => date('d/m/y', strtotime($result['date_added'])),
		// 			'filter_ip'  => $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . '&filter_ip=' . $result['ip'], 'SSL'),
		// 			'ban_ip'     => $ban_ip_total
		// 		);
		// 	}
		// }			
		$this->data['token'] = $this->session->data['token'];
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');

		$this->template = 'sale/customer_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validateDate($date, $format = 'Y-m-d')
	{
		$minguodate = strpos($date, '-');
		if ($minguodate == 3) $date = '0' . $date;
		else if  ($minguodate == 2) $date = '00' . $date;
		
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'sale/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->validateDate($this->request->post['dob'])) {
			$this->error['dob'] = $this->language->get('error_dob');
		}

		// if (utf8_strlen($this->request->post['ssn']) < 10) {
		// 	$this->error['ssn'] = $this->language->get('error_ssn');
		// }

		// if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
		// 	$this->error['firstname'] = $this->language->get('error_firstname');
		// }

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		// if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
		// 	$this->error['email'] = $this->language->get('error_email');
		// }

		// $customer_info = $this->model_sale_customer->getCustomerByEmail($this->request->post['email']);

		// if (!isset($this->request->get['filter_customer_id'])) {
		// 	if ($customer_info) {
		// 		$this->error['warning'] = $this->language->get('error_exists');
		// 	}
		// } else {
		// 	if ($customer_info && ($this->request->get['filter_customer_id'] != $customer_info['customer_id'])) {
		// 		$this->error['warning'] = $this->language->get('error_exists');
		// 	}
		// }

		// '2014-09-27 22:27'
		if (empty($this->request->post['store'])) {
			$this->error['store'] = $this->language->get('error_store');
		}

		// if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
		// 	$this->error['telephone'] = $this->language->get('error_telephone');
		// }

		// if ((utf8_strlen($this->request->post['mobile']) < 3) || (utf8_strlen($this->request->post['mobile']) > 32)) {
		// 	$this->error['mobile'] = $this->language->get('error_mobile');
		// }

		if (isset($this->request->post['address'])) {
			//foreach ($this->request->post['address'] as $key => $value) {
			$value = $this->request->post['address'];
			{
				// if ((utf8_strlen($value['firstname']) < 1) || (utf8_strlen($value['firstname']) > 32)) {
				// 	$this->error['address_firstname'] = $this->language->get('error_firstname');
				// }

				// if ((utf8_strlen($value['lastname']) < 1) || (utf8_strlen($value['lastname']) > 32)) {
				// 	$this->error['address_lastname'] = $this->language->get('error_lastname');
				// }	

				// if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
				// 	$this->error['address_address_1'] = $this->language->get('error_address_1');
				// }

				// if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
				// 	$this->error['address_city'] = $this->language->get('error_city');
				// } 

				// $this->load->model('localisation/country');

				// $country_info = $this->model_localisation_country->getCountry($value['country_id']);

				// if ($country_info) {
				// 	if ($country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2) || (utf8_strlen($value['postcode']) > 10)) {
				// 		$this->error['address_postcode'] = $this->language->get('error_postcode');
				// 	}

				// 	// VAT Validation
				// 	$this->load->helper('vat');

				// 	if ($this->config->get('config_vat') && $value['tax_id'] && (vat_validation($country_info['iso_code_2'], $value['tax_id']) == 'invalid')) {
				// 		$this->error['address_tax_id'] = $this->language->get('error_vat');
				// 	}
				// }

				// if ($value['country_id'] == '') {
				// 	$this->error['address_country'] = $this->language->get('error_country');
				// }

				// if (!isset($value['zone_id']) || $value['zone_id'] == '') {
				// 	$this->error['address_zone'] = $this->language->get('error_zone');
				// }	
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'sale/customer')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}  
	}

	public function login() {
		$json = array();

		if (isset($this->request->get['filter_customer_id'])) {
			$customer_id = $this->request->get['filter_customer_id'];
		} else {
			$customer_id = 0;
		}

		$this->load->model('sale/customer');

		$customer_info = $this->model_sale_customer->getCustomer($customer_id);

		if ($customer_info) {
			$token = md5(mt_rand());

			$this->model_sale_customer->editToken($customer_id, $token);

			if (isset($this->request->get['store_id'])) {
				$store_id = $this->request->get['store_id'];
			} else {
				$store_id = 0;
			}

			$this->load->model('setting/store');

			$store_info = $this->model_setting_store->getStore($store_id);

			if ($store_info) {
				$this->redirect($store_info['url'] . 'index.php?route=account/login&token=' . $token);
			} else { 
				$this->redirect(HTTP_CATALOG . 'index.php?route=account/login&token=' . $token);
			}
		} else {
			$this->language->load('error/not_found');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->data['heading_title'] = $this->language->get('heading_title');

			$this->data['text_not_found'] = $this->language->get('text_not_found');

			$this->data['breadcrumbs'] = array();

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => false
			);

			$this->data['breadcrumbs'][] = array(
				'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL'),
				'separator' => ' :: '
			);

			$this->template = 'error/not_found.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);

			$this->response->setOutput($this->render());
		}
	}

	public function payments() {

		$payments = array();
		$balance = 0;
		$total_cash = 0;
		$total_payment = 0;
		$total_visa = 0;
		$total_expense = 0;	

		if (!$this->user->hasPermission('access', 'sale/payment')) { 

			$this->data['error_warning'] = $this->language->get('error_permission');

			$this->template = 'sale/error.tpl';		

			$this->response->setOutput($this->render());

			return false;
		}


		$this->language->load('sale/customer');
		$this->data['text_total_visa'] = $this->language->get('text_total_visa');
		$this->data['text_total_cash'] = $this->language->get('text_total_cash');
		$this->data['text_total_payment'] = $this->language->get('text_total_payment');
		$this->data['text_remaining_balance'] = $this->language->get('text_remaining_balance');
		$this->data['text_total_expense'] = $this->language->get('text_total_expense');
	

		if (isset($this->request->get['filter_customer_id'])) {

			$this->load->model('sale/order');
			
			$data = array('filter_customer_id' => $this->request->get['filter_customer_id']);
			$orders = $this->model_sale_order->getOrders($data);
	
			foreach ($orders as $order) {

				if ((float)$order['total'] >= 0) {
					$payments[] = array(
						'order_id' => $order['order_id'],
						'message' => $this->language->get('text_order_total'),
						'date_added' => $order['date_added'],
						'amount' => -$order['total']
					);
					$total_expense += (float)$order['total'];
				}

				if ((float)$order['payment_final'] > 0) {
					$payments[] = array(
						'order_id' => $order['order_id'],
						'message' => $this->language->get('text_payment_final'),
						'date_added' => $order['date_added'],
						'amount' => $order['payment_final']
					);
					$total_cash += (float)$order['payment_final'];
				}

				if ((float)$order['payment_cash'] > 0) {
					$payments[] = array(
						'order_id' => $order['order_id'],
						'message' => $this->language->get('text_payment_cash'),
						'date_added' => $order['date_added'],
						'amount' => $order['payment_cash']
					);
					$total_cash += (float)$order['payment_cash'];
				}

				if ((float)$order['payment_visa'] > 0) {

					$payments[] = array(
						'order_id' => $order['order_id'],
						'message' => $this->language->get('text_payment_visa'),
						'date_added' => $order['date_added'],
						'amount' => $order['payment_visa']
					);
					$total_visa += (float)$order['payment_visa'];
				}

				$balance += $order['payment_balance'];
				
			}
		}

		$this->data['balance'] = $balance;
		$this->data['total_expense'] = $total_expense;
		$this->data['total_cash'] = $total_cash;
		$this->data['total_visa'] = $total_visa;
		$this->data['total_payment'] = $total_visa + $total_cash;
		$this->data['payments'] = $payments;

		$this->template = 'sale/customer_payment.tpl';		
		$this->response->setOutput($this->render());

	}

	public function images() {
		
		$this->language->load('sale/customer');
		$this->load->model('catalog/product');
		$this->load->model('sale/customer');

		if (isset($this->request->get['filter_customer_id'])) {
			$filter_customer_id = $this->request->get['filter_customer_id'];
		} else {
			$filter_customer_id = null;
		}  

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  


		$this->data['token'] = $this->session->data['token'];
		$this->data['text_treatment'] = $this->language->get('text_treatment');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_wait'] = $this->language->get('text_wait');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_add_ban_ip'] = $this->language->get('text_add_ban_ip');
		$this->data['text_reminder'] = $this->language->get('text_reminder');
		$this->data['text_remove_ban_ip'] = $this->language->get('text_remove_ban_ip');
		$this->data['text_update_comment_success'] = $this->language->get('text_update_comment_success');
		$this->data['text_set_today'] = $this->language->get('text_set_today');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_update_comment'] = $this->language->get('button_update_comment');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_date_added'] = $this->language->get('entry_date_added');
		$this->data['entry_remove'] = $this->language->get('entry_remove');
		$this->data['entry_date_processed'] = $this->language->get('entry_date_processed');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			$data = array();

			// Images
			if (isset($filter_customer_id)) $data['filter_customer_id'] = $filter_customer_id; 
			if (isset($this->request->post['filter_treatment'])) $data['filter_treatment'] = $this->request->post['filter_treatment']; 
			if (isset($this->request->post['filter_date_added_start'])) $data['filter_date_added_start'] = $this->request->post['filter_date_added_start']; 

			
			if (isset($this->request->post['filter_date_added_end'])) $data['filter_date_added_end'] = $this->request->post['filter_date_added_end']; 
			if (isset($this->request->post['filter_name'])) $data['filter_name'] = $this->request->post['filter_name']; 


			$customer_images = $this->model_sale_customer->getCustomerImages($data, ($page - 1) * 20, 20);
			$images_total = $this->model_sale_customer->getTotalCustomerImages($data);
		} else {
			$customer_images = array();
			$images_total = 0;
		}

		$this->data['customer_images'] = array();
		$this->load->model('tool/image');
		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		foreach ($customer_images as $customer_image) {
			if ($customer_image['image'] && file_exists(DIR_IMAGE . $customer_image['image'])) {
				$image = $customer_image['image'];
			} else {
				$image = 'no_image.jpg';
			}

			$product_name = '';
			if ($customer_image['product_id']) {
				$product = $this->model_catalog_product->getProduct($customer_image['product_id']);
				if ($product) {
					$product_name = $product['name'];
				}
			}

			$this->data['customer_images'][] = array(
				'image'      => $image,
				'comment'      => $customer_image['comment'],
				'product_name'      => $product_name,
				'customer_image_id'      => $customer_image['customer_image_id'],
				'customer_transaction_id'      => $customer_image['customer_transaction_id'],
				'date_processed'      =>  explode(' ' ,$customer_image['date_processed'])[0],
				'date_added'      =>  explode(' ' ,$customer_image['date_added'])[0],
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'bigimage'      => $this->model_tool_image->resize($image, 800, 800),
				'sort_order' => $customer_image['sort_order']
			);
		}	

		$url = '';

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_treatment'])) {
			$url .= '&filter_treatment=' . urlencode(html_entity_decode($this->request->get['filter_treatment'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$url .= '&filter_date_added_start=' . urlencode(html_entity_decode($this->request->get['filter_date_added_start'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_added_end'])) {
			$url .= '&filter_date_added_end=' . urlencode(html_entity_decode($this->request->get['filter_date_added_end'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $images_total;
		$pagination->page = $page;
		$pagination->limit = 20;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/images', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();


		$this->template = 'sale/customer_images.tpl';		

		$this->response->setOutput($this->render());
	}

	public function history() {
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if (!$this->user->hasPermission('access', 'sale/history')) { 

			$this->data['error_warning'] = $this->language->get('error_permission');

			$this->template = 'sale/error.tpl';		

			$this->response->setOutput($this->render());

			return false;
		}


		if (isset($this->request->post['reminder']) && $this->request->post['reminder'] == 'true') {
			$reminder = 1;
		} else {
			$reminder = 0;
		}
		
		$reminder_date = (isset($this->request->post['reminder_date']) ? $this->request->post['reminder_date'] : null); 

		$filter_user_id = (isset($this->request->post['filter_user_id']) ? $this->request->post['filter_user_id'] : null); 

		$filter_customer_id = (isset($this->request->get['filter_customer_id']) ? $this->request->get['filter_customer_id'] : null);  

		if (isset($this->request->get['candelete'])) {
			$candelete = $this->request->get['candelete'];
		} else {
			$candelete = true;	
		}

		if (isset($this->request->get['filter_reminder_date_start'])) {
			$filter_reminder_date_start = $this->request->get['filter_reminder_date_start'];
		} else {
			$filter_reminder_date_start = null;	
		}

		if (isset($this->request->get['filter_reminder_date_end'])) {
			$filter_reminder_date_end = $this->request->get['filter_reminder_date_end'];
		} else {
			$filter_reminder_date_end = null;	
		}
		
		$this->data['success'] = '';
		$this->data['error_warning'] = '';

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->user->hasPermission('modify', 'sale/customer')) { 

			// post
			if (isset($this->request->post['comment'])) {

				

				if (utf8_strlen($this->request->post['comment']) == 0) {
					$this->data['error_warning'] = '';
				} else if (!$this->validateDate($reminder_date) && $reminder) {
					$this->data['error_warning'] = $this->language->get('text_date_incorrect');
				} else {

					if (!$this->user->hasPermission('modify', 'sale/history')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}

					$data = array(
						'user_id' => $this->user->getId(),
						'comment' => $this->request->post['comment'],
						'reminder' => $reminder,
						'reminder_date' => $this->request->post['reminder_date'],
					);
					$this->model_sale_customer->addHistory($this->request->get['filter_customer_id'], $data);
					$this->data['success'] = $this->language->get('text_success');
				}
			} 
		}
		// if (isset($this->request->post['comment']) && utf8_strlen($this->request->post['comment']) == 0) {
		// 	$this->data['error_warning'] = '';
		// } else if (isset($this->request->post['comment']) && utf8_strlen($this->request->post['comment']) < 5) {
		// 	$this->data['error_warning'] = $this->language->get('text_comment_is_short');
		// } else if (!$this->validateDate($reminder_date) && $reminder=='checked') {
		// 	$this->data['error_warning'] = $this->language->get('text_date_incorrect');
		// } else if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
		// 	$this->data['error_warning'] = $this->language->get('error_permission');
		// } else if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
		// 	if (isset($this->request->post['comment'])) {
		// 		$data = array(
		// 			'user_id' => $this->user->getId(),
		// 			'comment' => $this->request->post['comment'],
		// 			'reminder' => $reminder,
		// 			'reminder_date' => $this->request->post['reminder_date'],
		// 		);
		// 		$this->model_sale_customer->addHistory($this->request->get['filter_customer_id'], $data);
		// 		$this->data['success'] = $this->language->get('text_success');
		// 	} else {
		// 		$this->data['success'] = '';
		// 	}
		
		// } else {
		// 	$this->data['success'] = '.';
		// }



		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['button_remove'] = $this->language->get('button_remove');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_reminder_date'] = $this->language->get('column_reminder_date');
		$this->data['column_comment'] = $this->language->get('column_comment');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_treatment'] = $this->language->get('column_treatment');
		$this->data['column_reply'] = $this->language->get('column_reply');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['histories'] = array();

		$data = array(
			'filter_user_id' => $filter_user_id,
			'filter_reminder_date_start' => $filter_reminder_date_start,
			'filter_reminder_date_end' => $filter_reminder_date_end,
			'filter_customer_id' => $filter_customer_id
		);

		$results = $this->model_sale_customer->getHistories($data, ($page - 1) * 20, 20);

		foreach ($results as $result) {
			$this->data['histories'][] = array(
				'customer_history_id'     => $result['customer_history_id'],
				'if_treatment'     => $result['if_treatment'],
				'title'     => $result['title'],
				'comment'     => $result['comment'],
				'reply'     => $result['reply'],
				// 'ufirstname'     => $result['ufirstname'],
				// 'ulastname'     => $result['ulastname'],
				'ufullname'     => $result['ufullname'],
				'cfullname'     => $result['cfullname'],
				'reminder_date'     => ($result['reminder_date'] == '0000-00-00' ? '' : $result['reminder_date']),
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$data = array(
			'filter_user_id' => $filter_user_id,
			'filter_reminder_date_start' => $filter_reminder_date_start,
			'filter_reminder_date_end' => $filter_reminder_date_end,
			'filter_customer_id' => $filter_customer_id
		);
		$transaction_total = $this->model_sale_customer->getTotalHistories($data);

		$url = '';
		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 20; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/history', 'token=' . $this->session->data['token'] . $url . '&candelete=false&page={page}', 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['pagination'] = $pagination->render();
		$this->data['candelete'] = $candelete;

		$this->template = 'sale/customer_history.tpl';		

		$this->response->setOutput($this->render());
	}

	// '2014-10-08 13:15'
	public function messages() {

		$this->load->model('sale/customer');
		$this->load->language('sale/customer');

		$filter_reply = (isset($this->request->get['filter_reply']) ? $this->request->get['filter_reply'] : '');
		$filter_customer_id = (isset($this->request->get['filter_customer_id']) ? $this->request->get['filter_customer_id'] : '');
		$filter_reminder_status_id = (isset($this->request->get['filter_reminder_status_id']) ? $this->request->get['filter_reminder_status_id'] : '');
		$filter_customer_history_id = (isset($this->request->get['filter_customer_history_id']) ? $this->request->get['filter_customer_history_id'] : '');
		
		$reply = (isset($this->request->post['reply']) ? $this->request->post['reply'] : null);
		$customer_history_id = (isset($this->request->post['customer_history_id']) ? $this->request->post['customer_history_id'] : 0);
		$reminder_status_id = (isset($this->request->post['reminder_status_id']) ? $this->request->post['reminder_status_id'] : null);

		$user_id = $this->user->getId();

		$this->data['column_title'] = $this->language->get('column_title');
		$this->data['column_mobile'] = $this->language->get('column_mobile');
		$this->data['column_telephone'] = $this->language->get('column_telephone');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_message'] = $this->language->get('column_message');
		$this->data['button_record_history'] = $this->language->get('button_record_history');
		$this->data['text_latest_message'] = $this->language->get('text_latest_message');
		$this->data['text_change_status_success'] = $this->language->get('text_change_status_success');
		$this->data['text_latest_messages'] = $this->language->get('text_latest_messages');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
				
		$this->load->model('sale/history');

		if ($this->request->server['REQUEST_METHOD'] == 'POST' && $this->user->hasPermission('modify', 'sale/customer')) {
			
			if (($reminder_status_id || $reply) && $customer_history_id) {
				if ($this->model_sale_customer->updatehistory($user_id, $reminder_status_id, $customer_history_id, $reply)) {
					$json['success'] = $this->language->get('text_success');
				} else {
					$json['error'] = $this->language->get('text_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}
		} else {
			$json['success'] = $this->language->get('text_success');
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$data = array(
			'filter_user_id' => $this->user->getId(),
			'filter_reminder_status' => 0,
			'filter_reminder_date_end' => date("Y-m-d")
		);
		if ($filter_reminder_status_id) $data['filter_reminder_status_id'] = $filter_reminder_status_id;
		if ($filter_reply) $data['filter_reply'] = $filter_reply;

		$this->load->model('user/user');
		$this->data['messages'] = $this->model_sale_customer->getHistories($data);
		$this->data['reminder_classes'] = $this->model_user_user->getReminderActions();

		// $this->data['lendings'] = array();

		// $results = $this->model_sale_customer->getLendings($this->request->get['filter_customer_id'], ($page - 1) * 10, 10);

		// foreach ($results as $result) {

		// 	$product_descriptions = $this->model_catalog_product->getProductDescriptions($result['product_id']);
		// 	$product_unit = $this->model_catalog_product->getProductUnit($result['product_id']);
		// 	$product_description = $product_descriptions[(int)$this->config->get('config_language_id')]['name'];

		// 	$this->data['lendings'][] = array(
		// 		'customer_lending_id'     => $result['customer_lending_id'],
		// 		'borrower_id'     => $result['borrower_id'],
		// 		'lender_id'     => $result['lender_id'],
		// 		'user_id'     => $result['user_id'],
		// 		'product_id'     => $result['product_id'],
		// 		'quantity'     => $result['quantity'],
		// 		'subquantity'     => $result['subquantity'],
		// 		'ufirstname'     => $result['ufirstname'],
		// 		'ulastname'     => $result['ulastname'],
		// 		'lenderfirstname'     => $result['lenderfirstname'],
		// 		'lenderlastname'     => $result['lenderlastname'],
		// 		'borrowerfirstname'     => $result['borrowerfirstname'],
		// 		'borrowerlastname'     => $result['borrowerlastname'],
		// 		'product_name'     => $product_description,
		// 		'unit'     => $product_unit,
		// 		'date_added'     => $result['date_added']
		// 	);
		// }
		// 
		// $lendings_total = $this->model_sale_customer->getTotalLendings($this->request->get['filter_customer_id']);

		$pagination = new Pagination();
		$pagination->total = 0;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$href = 'page={page}&token=' . $this->session->data['token'];
		if ($filter_customer_id) $href .= '&filter_customer_id=' . $this->request->get['filter_customer_id']; 
		$pagination->url = $this->url->link('sale/customer/history', $href, 'SSL');
		$this->data['pagination'] = $pagination->render();
		$this->data['token'] = $this->session->data['token'];

		$this->template = 'sale/customer_messages.tpl';		

		$this->response->setOutput($this->render());
	}


	public function lendings() {

		if (!$this->user->hasPermission('access', 'sale/lending')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}


		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		$lendto_product_id = (isset($this->request->post['lendto_product_id']) ? $this->request->post['lendto_product_id'] : null); 
		$lendto_customer_id = (isset($this->request->post['lendto_customer_id']) ? $this->request->post['lendto_customer_id'] : null); 
		$lendto_quantity = (isset($this->request->post['lendto_quantity']) ? $this->request->post['lendto_quantity'] : null); 
	
		$user_id = $this->user->getId();
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_unit_quantity'] = $this->language->get('column_unit_quantity');
		$this->data['column_unit'] = $this->language->get('column_unit');
		$this->data['column_borrower'] = $this->language->get('column_borrower');
		$this->data['column_lender'] = $this->language->get('column_lender');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			
			if ($lendto_quantity && $lendto_customer_id && $lendto_product_id && $this->request->get['filter_customer_id']) {

				$this->load->model('catalog/product');
				$product = $this->model_catalog_product->getProduct($lendto_product_id);
				$lendto_quantity = round($lendto_quantity / $product['value']);

				if (!$this->user->hasPermission('modify', 'sale/lending')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}

				else if ($this->request->get['filter_customer_id'] == $lendto_customer_id) {
					$this->data['error_warning'] = $this->language->get('text_error_self');
				} else if ($this->model_sale_customer->addLending($this->request->get['filter_customer_id'], $lendto_customer_id, $lendto_product_id, $lendto_quantity)) {
					$this->data['success'] = $this->language->get('text_success');
				} else {
					$this->data['error_warning'] = $this->language->get('text_error_lending');
				}
			}

		} else {
			$this->data['success'] = '';
		}

		$this->load->model('catalog/product');
		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_reminder_date'] = $this->language->get('column_reminder_date');
		$this->data['column_comment'] = $this->language->get('column_comment');
		$this->data['column_user'] = $this->language->get('column_user');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['lendings'] = array();

		$results = $this->model_sale_customer->getLendings($this->request->get['filter_customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {

			$product_descriptions = $this->model_catalog_product->getProductDescriptions($result['product_id']);
			$unit = $this->model_catalog_product->getProductUnit($result['product_id']);
			$product_description = $product_descriptions[(int)$this->config->get('config_language_id')]['name'];

			$this->data['results'][] = array(
				'customer_lending_id'     => $result['customer_lending_id'],
				'borrower_id'     => $result['borrower_id'],
				'lender_id'     => $result['lender_id'],
				'user_id'     => $result['user_id'],
				'product_id'     => $result['product_id'],
				'quantity'     => $result['quantity'],
				'subquantity'     => $result['subquantity'],
				'ufirstname'     => $result['ufirstname'],
				'ulastname'     => $result['ulastname'],
				'lenderfirstname'     => $result['lenderfirstname'],
				'lenderlastname'     => $result['lenderlastname'],
				'borrowerfirstname'     => $result['borrowerfirstname'],
				'borrowerlastname'     => $result['borrowerlastname'],
				'product_name'     => $product_description,
				'unit'     => $unit['unit'],
				'value'     => $unit['value'],
				'date_added'     => explode(' ', $result['date_added'])[0]
			);
		}

		$lendings_total = $this->model_sale_customer->getTotalLendings($this->request->get['filter_customer_id']);

		$url = '';
		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}
		$pagination = new Pagination();
		$pagination->total = $lendings_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/lendings', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/customer_borrow.tpl';		

		$this->response->setOutput($this->render());
	}


	public function borrows() {

		if (!$this->user->hasPermission('access', 'sale/lending')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}

		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		$borrowfrom_product_id = (isset($this->request->post['borrowfrom_product_id']) ? $this->request->post['borrowfrom_product_id'] : null); 
		$borrowfrom_customer_id = (isset($this->request->post['borrowfrom_customer_id']) ? $this->request->post['borrowfrom_customer_id'] : null); 
		$borrowfrom_quantity = (isset($this->request->post['borrowfrom_quantity']) ? $this->request->post['borrowfrom_quantity'] : null); 
	
		$user_id = $this->user->getId();
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_unit_quantity'] = $this->language->get('column_unit_quantity');
		$this->data['column_unit'] = $this->language->get('column_unit');
		$this->data['column_borrower'] = $this->language->get('column_borrower');
		$this->data['column_lender'] = $this->language->get('column_lender');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['button_remove'] = $this->language->get('button_remove');

		if (!$borrowfrom_product_id || !$borrowfrom_customer_id || !$borrowfrom_quantity) {
			$this->data['error_warning'] = '';
		} else if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			
			$this->load->model('catalog/product');
				$product = $this->model_catalog_product->getProduct($borrowfrom_product_id);
				$borrowfrom_quantity = round($borrowfrom_quantity / $product['value']);
				if (!$this->user->hasPermission('modify', 'sale/lending')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}


			else if ($this->request->get['filter_customer_id'] == $borrowfrom_customer_id) {
				$this->data['error_warning'] = $this->language->get('text_error_self');
			} else if ($this->model_sale_customer->addLending($borrowfrom_customer_id, $this->request->get['filter_customer_id'], $borrowfrom_product_id, $borrowfrom_quantity)) {
				$this->data['success'] = $this->language->get('text_success');
			} else {
				$this->data['error_warning'] = $this->language->get('text_error_lending');
			}
		} else {
			$this->data['success'] = '.';
		}

		$this->load->model('catalog/product');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['button_borrowfrom'] = $this->language->get('button_borrowfrom');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_reminder_date'] = $this->language->get('column_reminder_date');
		$this->data['column_comment'] = $this->language->get('column_comment');
		$this->data['column_user'] = $this->language->get('column_user');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['results'] = array();

		$results = $this->model_sale_customer->getBorrows($this->request->get['filter_customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {

			$product_descriptions = $this->model_catalog_product->getProductDescriptions($result['product_id']);
			$unit = $this->model_catalog_product->getProductUnit($result['product_id']);
			$product_description = $product_descriptions[(int)$this->config->get('config_language_id')]['name'];

			$this->data['results'][] = array(
				'customer_lending_id'     => $result['customer_lending_id'],
				'borrower_id'     => $result['borrower_id'],
				'lender_id'     => $result['lender_id'],
				'user_id'     => $result['user_id'],
				'product_id'     => $result['product_id'],
				'quantity'     => $result['quantity'],
				'subquantity'     => $result['subquantity'],
				'ufirstname'     => $result['ufirstname'],
				'ulastname'     => $result['ulastname'],
				'lenderfirstname'     => $result['lenderfirstname'],
				'lenderlastname'     => $result['lenderlastname'],
				'borrowerfirstname'     => $result['borrowerfirstname'],
				'borrowerlastname'     => $result['borrowerlastname'],
				'product_name'     => $product_description,
				'value'     => $unit['value'],
				'unit'     => $unit['unit'],
				'date_added'     => explode(' ', $result['date_added'])[0]
			);
		}

		$lendings_total = $this->model_sale_customer->getTotalBorrows($this->request->get['filter_customer_id']);

		$url = '';
		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		$pagination = new Pagination();
		$pagination->total = $lendings_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/borrows', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/customer_borrow.tpl';		

		$this->response->setOutput($this->render());
	}


	public function deletecustomerlending() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_lending_id'])) { 		

				$this->load->model('sale/customer');	
		
				if ($this->model_sale_customer->deleteCustomerLending($this->request->post['customer_lending_id'])) {
					$json['success'] = $this->language->get('text_delete_lending_success');
				} else {
					$json['error'] = $this->language->get('text_delete_lending_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function deletecustomerhistory() {

		$json = array(); 

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_history_id'])) { 		

				$this->load->model('sale/customer');	
		
				if ($this->model_sale_customer->deleteCustomerHistory($this->request->post['customer_history_id'])) {
					$json['success'] = $this->language->get('text_delete_history_success');
				} else {
					$json['error'] = $this->language->get('text_delete_history_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}

	// Chandler '2014-11-03 14:50'
	public function editgrouptransaction() {

		$json = array();
		$data = array();
		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['product_id']) && isset($this->request->post['status'])) { 		

				$this->load->model('sale/customer');	
				
				if (!$this->user->hasPermission('modify', 'catalog/product')) { 

					$json['error'] = $this->language->get('error_permission');


				}

				// if (isset( $this->request->post['status'])) $data['status'] = $this->request->post['status'];
				// if (isset( $this->request->post['product_id'])) $data['product_id'] = $this->request->post['product_id'];
				// if (isset( $this->request->post['customer_id'])) $data['customer_id'] = $this->request->post['customer_id'];
				// if (isset( $this->request->post['comment'])) $data['comment'] = $this->request->post['comment'];
				// if (isset( $this->request->post['doctor_id'])) $data['doctor_id'] = $this->request->post['doctor_id'];
				// if (isset( $this->request->post['consultant_id'])) $data['consultant_id'] = $this->request->post['consultant_id'];
				// if (isset( $this->request->post['outsource_id'])) $data['outsource_id'] = $this->request->post['outsource_id'];
				// if (isset( $this->request->post['beauty_id'])) $data['beauty_id'] = $this->request->post['beauty_id'];
				// if (isset( $this->request->post['unitspend'])) $data['unitspend'] = $this->request->post['unitspend'];
				// if (isset( $this->request->post['unitspend'])) $data['unitspend'] = $this->request->post['unitspend'];

// $json['success'] = 123; $this->response->setOutput(json_encode($json)); return;

				else if ($this->model_sale_customer->editgrouptransaction($this->request->post)) {
					$json['success'] = $this->language->get('text_edit_transaction_success');
				} else {
					$json['error'] = $this->language->get('text_edit_transaction_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}


		$this->response->setOutput(json_encode($json));

	}

	public function groupedittransaction(){

		$json = array();

		$data = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_transaction_id']) && isset($this->request->post['status'])) { 		

				$query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE customer_transaction_id = '" . (int)$this->request->post['customer_transaction_id']  . "'");
				$treatment_usage_id = $query->row['treatment_usage_id'];
				$query = $this->db->query("SELECT * FROM oc_customer_transaction WHERE treatment_usage_id = '$treatment_usage_id'");


				$this->load->model('sale/customer');	
				
				if (isset( $this->request->post['status'])) $data['status'] = $this->request->post['status'];
				if (isset( $this->request->post['comment'])) $data['comment'] = $this->request->post['comment'];
				if (isset( $this->request->post['doctor_id'])) $data['doctor_id'] = $this->request->post['doctor_id'];
				if (isset( $this->request->post['consultant_id'])) $data['consultant_id'] = $this->request->post['consultant_id'];
				if (isset( $this->request->post['outsource_id'])) $data['outsource_id'] = $this->request->post['outsource_id'];
				if (isset( $this->request->post['beauty_id'])) $data['beauty_id'] = $this->request->post['beauty_id'];

				if ($data['status'] == -1) {
					$data['comment'] = '';
					$data['customer_treatment_usage_id'] = 0;
					$data['doctor_id'] = 0;
					$data['consultant_id'] = 0;
					$data['outsource_id'] = 0;
					$data['beauty_id'] = 0;
				}

				$if_remind = true;
				foreach ($query->rows as $result) {
					
					$customer_transaction_id = $result['customer_transaction_id'];

					if ($this->model_sale_customer->edittransaction($customer_transaction_id, $data, $if_remind)) {
						$json['success'] = $this->language->get('text_edit_transaction_success');
					} else {
						$json['error'] = $this->language->get('text_edit_transaction_error');
					}

					$if_remind = false;
				}
				// if ($this->model_sale_customer->edittransaction($this->request->post['customer_transaction_id'], $data)) {
				// 	$json['success'] = $this->language->get('text_edit_transaction_success');
				// } else {
				// 	$json['error'] = $this->language->get('text_edit_transaction_error');
				// }

			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}


	// '2014-09-30 22:35'
	public function edittransaction() {

		$json = array();

		$data = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_transaction_id']) && isset($this->request->post['status'])) { 		

				$this->load->model('sale/customer');	
				
				if (isset( $this->request->post['status'])) $data['status'] = $this->request->post['status'];
				if (isset( $this->request->post['comment'])) $data['comment'] = $this->request->post['comment'];
				if (isset( $this->request->post['doctor_id'])) $data['doctor_id'] = $this->request->post['doctor_id'];
				if (isset( $this->request->post['consultant_id'])) $data['consultant_id'] = $this->request->post['consultant_id'];
				if (isset( $this->request->post['outsource_id'])) $data['outsource_id'] = $this->request->post['outsource_id'];
				if (isset( $this->request->post['beauty_id'])) $data['beauty_id'] = $this->request->post['beauty_id'];


				// $transaction = $this->model_sale_customer->getTransaction($this->request->post['customer_transaction_id']);

				// if (!$transaction) {
				// 	$json['error'] = $this->language->get('text_edit_transaction_error');
				// } else if ($transaction['status'] == 2) {
				// 	$json['error'] = $this->language->get('text_transaction_finished_error');
				// } else if ($transaction['status'] == 10) {
				// 	$json['error'] = $this->language->get('text_transaction_lended_error');
				if ($this->model_sale_customer->edittransaction($this->request->post['customer_transaction_id'], $data)) {
					$json['success'] = $this->language->get('text_edit_transaction_success');
				} else {
					$json['error'] = $this->language->get('text_edit_transaction_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}	

	public function editevent() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_event_id']) && isset($this->request->post['date_start']) && isset($this->request->post['date_end'])) { 		

				$this->load->model('sale/customer');	
		
				if (!$this->user->hasPermission('modify', 'sale/appointment')) { 

					$json['error'] = $this->language->get('error_permission');
				} else if ($this->model_sale_customer->editevent($this->request->post['customer_event_id'], $this->request->post)) {
					$json['success'] = $this->language->get('text_edit_event_success');
				} else {
					$json['error'] = $this->language->get('text_edit_event_error');
				}
			} else {
				$json['error'] = $this->language->get('text_record_event_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		// $this->load->out($json, false);

		$this->response->setOutput(json_encode($json));
	}

	// '2014-10-14 12:11'
	public function recordevent() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['title'])) { 		

				$this->load->model('sale/customer');	
		
				if (!$this->user->hasPermission('modify', 'sale/appointment')) { 
					$json['error'] = $this->language->get('error_permission');
				} else if ($this->model_sale_customer->recordevent($this->request->post['customer_id'], $this->request->post)) {
					$json['success'] = $this->language->get('text_record_event_success');
				} else {
					$json['error'] = $this->language->get('text_record_event_error');
				}
			} else {
				$json['error'] = $this->language->get('text_record_event_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}


	// '2014-10-14 12:11'
	public function deleteevent() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_event_id'])) { 		

				$this->load->model('sale/customer');	
			
				if (!$this->user->hasPermission('modify', 'sale/appointment')) { 
					$json['error'] = $this->language->get('error_permission');
				} else if ($this->model_sale_customer->deleteevent($this->request->post['customer_event_id'])) {
					$json['success'] = $this->language->get('text_delete_event_success');
				} else {
					$json['error'] = $this->language->get('text_delete_event_error');
				}
			} else {
				$json['error'] = $this->language->get('text_delete_event_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}


	public function deletetransaction() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_transaction_id'])) { 		

				$this->load->model('sale/customer');	
			
			if (!$this->user->hasPermission('modify', 'catalog/product')) { 

						$this->data['error'] = $this->language->get('error_permission');
					}
				else if ($this->model_sale_customer->deletetransaction($this->request->post['customer_transaction_id'])) {
					$json['success'] = $this->language->get('text_delete_transaction_success');
				} else {
					$json['error'] = $this->language->get('text_delete_transaction_error');
				}
			} else {
				$json['error'] = $this->language->get('text_error');
			}

		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}

	public function deleteimage() {

		$json = array();
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_image_id']))
			$this->model_sale_customer->deleteCustomerImage($this->request->post['customer_image_id']);

			$json['success'] = $this->language->get('text_delete_image_success');
			$this->response->setOutput(json_encode($json));
		} else {

			$json['error'] = $this->language->get('text_delete_image_error');
			$this->response->setOutput(json_encode($json));
		}

	}

	public function editimage() {

		$json = array();
		$this->language->load('sale/customer');
		$this->load->model('sale/customer');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			$data = array();
			
			$data['date_added'] = date("Y-m-d H:i:s");
			if (isset($this->request->post['image'])) $data['image'] = $this->request->post['image'];
			if (isset($this->request->post['customer_image_id'])) $data['customer_image_id'] = $this->request->post['customer_image_id'];
			if (isset($this->request->post['customer_transaction_id'])) $data['customer_transaction_id'] = $this->request->post['customer_transaction_id'];
			if (isset($this->request->post['date_processed'])) $data['date_processed'] = $this->request->post['date_processed'];
			if (isset($this->request->post['comment'])) $data['comment'] = $this->request->post['comment'];
	// $this->load->out($this->request->post);	
			if (!$data['customer_image_id']) {
				$json['error'] = 'error1';
			} else if  ($this->model_sale_customer->editCustomerImage($data['customer_image_id'], $data)) {
				$json['success'] = $data['customer_image_id'];
			} else {
				$json['error'] = 'error2';
			}
		} else {
			$json['error'] = 'error3';
		}

		$this->response->setOutput(json_encode($json));
	}


	// '2014-10-06 14:34'
	public function recordimage() {

		$json = array();
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			$data = array();
			
			$data['date_added'] = date("Y-m-d H:i:s");
			if (isset($this->request->post['image'])) $data['image'] = $this->request->post['image'];
			if (isset($this->request->post['customer_transaction_id'])) $data['customer_transaction_id'] = $this->request->post['customer_transaction_id'];
			
			if ($customer_image_id = $this->model_sale_customer->insertCustomerImage($this->request->post['customer_id'], $data)) {
				$json['success'] = $this->language->get('text_record_image_success');
			} else {
				$json['error'] = $this->language->get('text_record_image_error');
			}
		} else {
			$json['error'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));
	}


	// '2014-10-06 14:34'
	public function updateimagecomment() {

		$json = array();
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			$data = array(
				'comment' => $this->request->post['comment']
			);
		
			$customer_image_id = $this->model_sale_customer->editCustomerImage($this->request->post['customer_image_id'], $data);
			
			$json['success'] = $customer_image_id;
			$this->response->setOutput(json_encode($json));
		} else {

			$json['error'] = 'error';
			$this->response->setOutput(json_encode($json));
		}
	}


	// '2014-10-06 13:46'
	public function transaction() {

		if (!$this->user->hasPermission('access', 'catalog/product')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}

		$this->language->load('sale/customer');

		$this->load->model('sale/customer');
		// $this->data['customer_id'] = (isset($this->request->get['filter_customer_id']) ? $this->request->get['filter_customer_id'] : 0);
		// $this->data['filter_customer_id'] = (isset($this->request->get['filter_customer_id']) ? $this->request->get['filter_customer_id'] : null);
// $this->load->test($this->request->get);
		// $reminder = (isset($this->request->post['reminder']) ? $this->request->post['reminder'] : null); 
		// $reminder_date = (isset($this->request->post['reminder_date']) ? $this->request->post['reminder_date'] : null); 
		$filter_user_id = (isset($this->request->get['filter_user_id']) ? $this->request->get['filter_user_id'] : null); 
		$filter_customer_id = (isset($this->request->get['filter_customer_id']) ? $this->request->get['filter_customer_id'] : null);  
		$filter_product_type_id = (isset($this->request->get['filter_product_type_id']) ? $this->request->get['filter_product_type_id'] : null);  


// $this->load->out($this->request->get, false);

		$unitspend = (isset($this->request->post['unitspend']) ? $this->request->post['unitspend'] : null); 
		$product_id = (isset($this->request->post['product_id']) ? $this->request->post['product_id'] : null); 
	
		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			// update information
			if (isset($this->request->post['product_id']) && isset($this->request->post['unitspend']) && isset($this->request->post['customer_id'])) {

				if (!$this->user->hasPermission('modify', 'catalog/product')) { 

						$this->data['error_warning'] = $this->language->get('error_permission');

						$this->template = 'sale/error.tpl';		

						$this->response->setOutput($this->render());

						return false;
					}

				// pure get
				if ($this->model_sale_customer->addTransaction2($this->request->post['customer_id'], $this->request->post['product_id'], $this->request->post['unitspend'])) {
					$this->data['success'] = $this->language->get('text_success');
				} else {
					$this->data['error_warning'] = $this->language->get('text_cannot_use_inventory');
				}
			} else if (isset($this->request->get['show_group'])) {
				// pure get
				$this->data['success'] = '';	
			} else {
				// pure get
				$this->data['success'] = '';
			}

		} else {
			$this->data['error_warning'] = $this->language->get('error_permission');
		}

		$this->data['text_service_not_rendered'] = $this->language->get('text_service_not_rendered');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_balance'] = $this->language->get('text_balance');
		$this->data['text_success'] = $this->language->get('text_success');
		$this->data['text_appointment'] = $this->language->get('text_appointment');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_error'] = $this->language->get('text_error');
		$this->data['text_cannot_use_inventory'] = $this->language->get('text_cannot_use_inventory');
		$this->data['text_appointment_start'] = $this->language->get('text_appointment_start');
		$this->data['text_appointment_end'] = $this->language->get('text_appointment_end');
		
		$this->data['column_unit_used'] = $this->language->get('column_unit_used');
		$this->data['column_date_processed'] = $this->language->get('column_date_processed');
		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
		$this->data['column_date_purchased'] = $this->language->get('column_date_purchased');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_product'] = $this->language->get('column_product_usage');
		$this->data['column_unit_quantity'] = $this->language->get('column_unit_quantity');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_unit'] = $this->language->get('column_unit');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_amount'] = $this->language->get('column_amount');
		$this->data['column_delete'] = $this->language->get('column_delete');
		$this->data['column_total_units'] = $this->language->get('column_total_units');
		$this->data['text_transaction_unoccured'] = $this->language->get('text_transaction_unoccured');
		$this->data['text_transaction_finished'] = $this->language->get('text_transaction_finished');
		$this->data['text_transaction_appointed'] = $this->language->get('text_transaction_appointed');
		$this->data['text_lendedout'] = $this->language->get('text_lendedout');
		$this->data['text_borrowed'] = $this->language->get('text_borrowed');

		$this->data['entry_beauty'] = $this->language->get('entry_beauty');
		$this->data['entry_doctor'] = $this->language->get('entry_doctor');
		$this->data['entry_outsource'] = $this->language->get('entry_outsource');
		$this->data['entry_consultant'] = $this->language->get('entry_consultant');
		$this->data['entry_treatment_status'] = $this->language->get('entry_treatment_status');

		$this->data['button_change_status'] = $this->language->get('button_change_status');
		$this->data['button_add_picture'] = $this->language->get('button_add_picture');
		$this->data['button_view_picture'] = $this->language->get('button_view_picture');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->load->model('user/user');
		
		$this->data['beautys'] = $this->model_user_user->getUsers(array('filter_user_group_id' => 5));
		$this->data['doctors'] = $this->model_user_user->getUsers(array('filter_user_group_id' => 2));
		$this->data['consultants'] = $this->model_user_user->getUsers(array('filter_user_group_id' => 3));
		$this->data['outsource'] = $this->model_user_user->getUsers(array('filter_user_group_id' => 4));

		$this->data['transactions'] = array();

		$data = array();

		$data['filter_treatment_status'] = 0;
		if (isset($this->request->get['filter_treatment_status'])) $data['filter_treatment_status'] = $this->request->get['filter_treatment_status'];
		$filter_treatment_status = $data['filter_treatment_status'];
		if (isset($this->request->get['filter_customer_id'])) $data['filter_customer_id'] = $this->request->get['filter_customer_id'];
		if (isset($this->request->get['filter_customer_name'])) $data['filter_customer_name'] = $this->request->get['filter_customer_name'];
		if (isset($this->request->get['filter_product_name'])) $data['filter_product_name'] = $this->request->get['filter_product_name'];
		if (isset($this->request->get['filter_product_type_id'])) $data['filter_product_type_id'] = $this->request->get['filter_product_type_id'];
		if (isset($this->request->get['filter_ssn'])) $data['filter_ssn'] = $this->request->get['filter_ssn'];
		// $data['filter_product_type_id'] = 2;
		$data['filter_group_usage'] = 1;

		$data['filter_ismain'] = 0;
		$results = $this->model_sale_customer->getTransactions($data, ($page - 1) * 10, 10);

		$data = array();
		// if (isset($this->request->get['filter_treatment_status'])) $data['filter_treatment_status'] = $this->request->get['filter_treatment_status'];
		if (isset($this->request->get['filter_customer_id'])) $data['filter_customer_id'] = $this->request->get['filter_customer_id'];
		if (isset($this->request->get['filter_customer_name'])) $data['filter_customer_name'] = $this->request->get['filter_customer_name'];
		// if (isset($this->request->get['filter_product_name'])) $data['filter_product_name'] = $this->request->get['filter_product_name'];
		if (isset($this->request->get['filter_ssn'])) $data['filter_ssn'] = $this->request->get['filter_ssn'];
		if (isset($this->request->get['filter_product_type_id'])) $data['filter_product_type_id'] = $this->request->get['filter_product_type_id'];
		// $data['filter_product_type_id'] = 2;
		// $data['filter_group_usage'] = 1;
		$totalresults = $this->model_sale_customer->getTransactions($data, 0, 999999);

		$this->load->model('catalog/product');

		$groupresults = array();


		if ($results)
		foreach ($results as $result) {

			$product_id = $result['product_id'];

			$product = $this->model_catalog_product->getProduct($product_id);
			
			$unit = $this->model_catalog_product->getProductUnit($product_id);
		
			$tempdata = array(); 
			if ($filter_customer_id) $tempdata['customer_id'] = $filter_customer_id;
			$tempdata['filter_customer_transaction_id'] = $result['customer_transaction_id'];

			$treatment_images_before = $this->model_sale_customer->getCustomerImages($tempdata);

			$treatment_images = array();

			$this->load->model('tool/image');

			foreach ($treatment_images_before as $image) {

				$thumb = $this->model_tool_image->resize($image['image'], 40, 40);
				$largeimage = $this->model_tool_image->resize($image['image'], 800, 800);

				$treatment_images[] = array(
					'href' => $largeimage,
					'thumb' => $thumb,
					'image' => $image['image']
				);
			}

			$this->data['transactions'][] = array(
				// 'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'customer_lending_id' => $result['customer_lending_id'],
				'doctor_id' => $result['doctor_id'],
				'bonus_beauty_fixed' => ($result['bonus_beauty_fixed']>0 ? $result['bonus_beauty_fixed'] : ''),
				'bonus_consultant_fixed' => ($result['bonus_consultant_fixed']>0 ? $result['bonus_consultant_fixed'] : ''),
				'bonus_doctor_fixed' => ($result['bonus_doctor_fixed']>0 ? $result['bonus_doctor_fixed'] : ''),
				'bonus_outsource_fixed' => ($result['bonus_outsource_fixed']>0 ? $result['bonus_outsource_fixed'] : ''),
				'consultant_id' => $result['consultant_id'],
				'beauty_id' => $result['beauty_id'],
				'outsource_id' => $result['outsource_id'],
				'fullname' => $result['fullname'],
				'product_name' => $product['name'],
				'subquantity' => ( $filter_treatment_status == 9 ? -1 : 1) * $result['subquantity'],
				'customer_transaction_id' => $result['customer_transaction_id'],
				'quantity' => ( $filter_treatment_status == 9 ? -1 : 1) * $result['quantity'],
				'value' => $unit['value'],
				'unit' => $unit['unit'],
				'ismain' => $result['ismain'],
				'treatment_images' => $treatment_images,
				'type' => $result['type'],
				'status' => $result['status'],
				'product_which' => $result['product_which'],
				'product_total_which' => $result['product_total_which'],
				'comment' => $result['comment'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified'  => date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'canmodify' => (time() - strtotime($result['date_modified']) < 50000) || $result['status'] <> 2
			);
		}

		if ($totalresults)
		foreach ($totalresults as $result) {

			if ($result['status'] < 0) continue;

			$product_id = $result['product_id'];

			$product = $this->model_catalog_product->getProduct($product_id);
			
			$unit = $this->model_catalog_product->getProductUnit($product_id);
			
			$groupresults[$product_id]['name'] = $product['name'];
			$groupresults[$product_id]['product_id'] = $product['product_id'];
			$groupresults[$product_id]['subquantity'] = (isset($groupresults[$product_id]['subquantity']) ? $groupresults[$product_id]['subquantity'] + $result['subquantity'] : $result['subquantity']);
			$groupresults[$product_id]['quantity'] = (isset($groupresults[$product_id]['quantity']) ? $groupresults[$product_id]['quantity'] + $result['quantity'] : $result['quantity']);
			$groupresults[$product_id]['unit'] = $unit['unit'];
			$groupresults[$product_id]['value'] = $unit['value'];
		}


		$this->data['grouptransactions'] = $groupresults;
		$this->data['show_group'] = (isset($this->request->get['show_group']) ? $this->request->get['show_group'] : 0);


		$data = array();
		if (isset($this->request->get['filter_treatment_status'])) $data['filter_treatment_status'] = $this->request->get['filter_treatment_status'];
		if (isset($this->request->get['filter_customer_id'])) $data['customer_id'] = $this->request->get['filter_customer_id'];
		if (isset($this->request->get['filter_customer_name'])) $data['filter_customer_name'] = $this->request->get['filter_customer_name'];
		if (isset($this->request->get['filter_product_name'])) $data['filter_product_name'] = $this->request->get['filter_product_name'];
		if (isset($this->request->get['filter_ssn'])) $data['filter_ssn'] = $this->request->get['filter_ssn'];
		if (isset($this->request->get['filter_product_type_id'])) $data['filter_product_type_id'] = $this->request->get['filter_product_type_id'];
		// $data['filter_product_type_id'] = 2;
		$data['filter_ismain'] = 0;
		$data['filter_group_usage'] = 1;
		$transaction_total = $this->model_sale_customer->getTotalTransactions($data);

		$url = '';
		if (isset($this->request->get['filter_product_type_id'])) $url .= '&filter_product_type_id=' . $this->request->get['filter_product_type_id'];
		if (isset($this->request->get['filter_treatment_status'])) $url .= '&filter_treatment_status=' . $this->request->get['filter_treatment_status'];
		if (isset($this->request->get['filter_customer_id'])) $url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		if (isset($this->request->get['filter_customer_name'])) $url .= '&filter_customer_name=' . $this->request->get['filter_customer_name'];
		if (isset($this->request->get['filter_product_name'])) $url .= '&filter_product_name=' . $this->request->get['filter_product_name'];
		if (isset($this->request->get['filter_ssn'])) $url .= '&filter_ssn=' . $this->request->get['filter_ssn'];
		if (isset($this->request->get['is_insert'])) $url .= '&is_insert=' . $this->request->get['is_insert'];
		$url .= '&filter_ismain=0&show_group=1';
		// if (isset($this->request->get['filter_customer_id'])) $data['customer_id'] = $this->request->get['filter_customer_id'];
		// if (isset($this->request->get['filter_customer_name'])) $data['filter_customer_name'] = $this->request->get['filter_customer_name'];
		// if (isset($this->request->get['filter_product_name'])) $data['filter_product_name'] = $this->request->get['filter_product_name'];
		// if (isset($this->request->get['filter_ssn'])) $data['filter_ssn'] = $this->request->get['filter_ssn'];

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');


		$pagination->url = $this->url->link('sale/customer/transaction', 'token=' . $this->session->data['token'] . '&page={page}' . $url, 'SSL');

		$this->data['filter_product_type_id'] = $filter_product_type_id;
		$this->data['filter_customer_id'] = $filter_customer_id;
		$this->data['pagination'] = $pagination->render();
		$this->data['token'] = $this->session->data['token'];
		$this->data['is_insert'] = (isset($this->request->get['is_insert']) ? $this->request->get['is_insert'] : true);
		
		$this->template = 'sale/customer_transaction.tpl';		

		$this->response->setOutput($this->render());
	}

	// public function borrow() {
	// 	$this->language->load('sale/customer');

	// 	$this->load->model('sale/customer');

	// 	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
	// 		if (!$this->request->post['product_id'] && !$this->request->post['unitspend']) {
	// 			$this->data['error_warning'] = '';
	// 		} elseif ($this->model_sale_customer->addTransaction2($this->request->get['filter_customer_id'], $this->request->post['product_id'], $this->request->post['unitspend'])) {
	// 			$this->data['success'] = $this->language->get('text_success');
	// 		} else {
	// 			$this->data['error_warning'] = $this->language->get('text_cannot_use_inventory');
	// 		}
	// 	} else {
	// 		$this->data['error_warning'] = $this->language->get('text_error');
	// 	}

	// 	if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
	// 		$this->data['error_warning'] = $this->language->get('error_permission');
	// 	} 	


	// 	$this->data['text_service_not_rendered'] = $this->language->get('text_service_not_rendered');
	// 	$this->data['text_no_results'] = $this->language->get('text_no_results');
	// 	$this->data['text_balance'] = $this->language->get('text_balance');
	// 	$this->data['text_success'] = $this->language->get('text_success');
	// 	$this->data['text_error'] = $this->language->get('text_error');
	// 	$this->data['text_cannot_use_inventory'] = $this->language->get('text_cannot_use_inventory');

	// 	$this->data['column_date_added'] = $this->language->get('column_date_added');
	// 	$this->data['column_product'] = $this->language->get('column_product');
	// 	$this->data['column_description'] = $this->language->get('column_description');
	// 	$this->data['column_product'] = $this->language->get('column_product');
	// 	$this->data['column_unit_quantity'] = $this->language->get('column_unit_quantity');
	// 	$this->data['column_unit'] = $this->language->get('column_unit');
	// 	$this->data['column_quantity'] = $this->language->get('column_quantity');
	// 	$this->data['column_amount'] = $this->language->get('column_amount');
	// 	$this->data['column_delete'] = $this->language->get('column_delete');
	// 	$this->data['column_total_units'] = $this->language->get('column_total_units');
	// 	$this->data['text_transaction_unoccured'] = $this->language->get('text_transaction_unoccured');
	// 	$this->data['text_transaction_appointed'] = $this->language->get('text_transaction_appointed');
	// 	$this->data['text_transaction_finished'] = $this->language->get('text_transaction_finished');

	// 	if (isset($this->request->get['page'])) {
	// 		$page = $this->request->get['page'];
	// 	} else {
	// 		$page = 1;
	// 	}  

	// 	$this->data['transactions'] = array();

	// 	$data = array(
	// 		'customer_id' => $this->request->get['filter_customer_id']
	// 	);
	// 	$results = $this->model_sale_customer->getTransactions($data, ($page - 1) * 10, 10);

	// 	$this->load->model('catalog/product');

	// 	$groupresults = array();

	// 	foreach ($results as $result) {

	// 		$product_id = $result['product_id'];

	// 		$product = $this->model_catalog_product->getProduct($product_id);
			
	// 		$unit = $this->model_catalog_product->getProductUnit($product_id);

	// 		$this->data['transactions'][] = array(
	// 			'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
	// 			'product_name' => $product['name'],
	// 			'subquantity' => $result['subquantity'],
	// 			'product_which' => $result['product_which'],
	// 			'product_total_which' => $result['product_total_which'],
	// 			'comment' => $result['comment'],
	// 			'customer_transaction_id' => $result['customer_transaction_id'],
	// 			'quantity' => $result['quantity'],
	// 			'ismain' => $result['ismain'],
	// 			'unit' => $unit,
	// 			'type' => $result['type'],
	// 			'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
	// 		);

	// 		$groupresults[$product_id]['name'] = $product['name'];
	// 		$groupresults[$product_id]['subquantity'] = (isset($groupresults[$product_id]['subquantity']) ? $groupresults[$product_id]['subquantity'] + $result['subquantity'] : $result['subquantity']);
	// 		$groupresults[$product_id]['quantity'] = (isset($groupresults[$product_id]['quantity']) ? $groupresults[$product_id]['quantity'] + $result['quantity'] : $result['quantity']);
	// 		$groupresults[$product_id]['unit'] = $unit;
	// 	}

	// 	$this->data['grouptransactions'] = $groupresults;

	// 	$this->data['balance'] = $this->currency->format($this->model_sale_customer->getTransactionTotal($this->request->get['filter_customer_id']), $this->config->get('config_currency'));


	// 	$data = array(
	// 		'customer_id' => $this->request->get['filter_customer_id']
	// 	);
	// 	$transaction_total = count($results); 

	// 	$pagination = new Pagination();
	// 	$pagination->total = $transaction_total;
	// 	$pagination->page = $page;
	// 	$pagination->limit = 10; 
	// 	$pagination->text = $this->language->get('text_pagination');
	// 	$pagination->url = $this->url->link('sale/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['filter_customer_id'] . '&page={page}', 'SSL');

	// 	$this->data['pagination'] = $pagination->render();
	// 	$this->data['token'] = $this->session->data['token'];

	// 	$this->template = 'sale/customer_borrow.tpl';		

	// 	$this->response->setOutput($this->render());
	// }


	// public function reward() {
	// 	$this->language->load('sale/customer');

	// 	$this->load->model('sale/customer');

	// 	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
	// 		$this->model_sale_customer->addReward($this->request->get['filter_customer_id'], $this->request->post['description'], $this->request->post['points']);

	// 		$this->data['success'] = $this->language->get('text_success');
	// 	} else {
	// 		$this->data['success'] = '';
	// 	}

	// 	if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
	// 		$this->data['error_warning'] = $this->language->get('error_permission');
	// 	} else {
	// 		$this->data['error_warning'] = '';
	// 	}	

	// 	$this->data['text_no_results'] = $this->language->get('text_no_results');
	// 	$this->data['text_balance'] = $this->language->get('text_balance');

	// 	$this->data['column_date_added'] = $this->language->get('column_date_added');
	// 	$this->data['column_description'] = $this->language->get('column_description');
	// 	$this->data['column_points'] = $this->language->get('column_points');

	// 	if (isset($this->request->get['page'])) {
	// 		$page = $this->request->get['page'];
	// 	} else {
	// 		$page = 1;
	// 	}  

	// 	$this->data['rewards'] = array();

	// 	$results = $this->model_sale_customer->getRewards($this->request->get['filter_customer_id'], ($page - 1) * 10, 10);

	// 	foreach ($results as $result) {
	// 		$this->data['rewards'][] = array(
	// 			'points'      => $result['points'],
	// 			'description' => $result['description'],
	// 			'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
	// 		);
	// 	}

	// 	$this->data['balance'] = $this->model_sale_customer->getRewardTotal($this->request->get['filter_customer_id']);

	// 	$reward_total = $this->model_sale_customer->getTotalRewards($this->request->get['filter_customer_id']);

	// 	$pagination = new Pagination();
	// 	$pagination->total = $reward_total;
	// 	$pagination->page = $page;
	// 	$pagination->limit = 10; 
	// 	$pagination->text = $this->language->get('text_pagination');
	// 	$pagination->url = $this->url->link('sale/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['filter_customer_id'] . '&page={page}', 'SSL');

	// 	$this->data['pagination'] = $pagination->render();

	// 	$this->template = 'sale/customer_reward.tpl';		

	// 	$this->response->setOutput($this->render());
	// }

	// public function addBanIP() {
	// 	$this->language->load('sale/customer');

	// 	$json = array();

	// 	if (isset($this->request->post['ip'])) { 
	// 		if (!$this->user->hasPermission('modify', 'sale/customer')) {
	// 			$json['error'] = $this->language->get('error_permission');
	// 		} else {
	// 			$this->load->model('sale/customer');

	// 			$this->model_sale_customer->addBanIP($this->request->post['ip']);

	// 			$json['success'] = $this->language->get('text_success');
	// 		}
	// 	}

	// 	$this->response->setOutput(json_encode($json));
	// }

	// public function removeBanIP() {
	// 	$this->language->load('sale/customer');

	// 	$json = array();

	// 	if (isset($this->request->post['ip'])) { 
	// 		if (!$this->user->hasPermission('modify', 'sale/customer')) {
	// 			$json['error'] = $this->language->get('error_permission');
	// 		} else {
	// 			$this->load->model('sale/customer');

	// 			$this->model_sale_customer->removeBanIP($this->request->post['ip']);

	// 			$json['success'] = $this->language->get('text_success');
	// 		}
	// 	}

	// 	$this->response->setOutput(json_encode($json));
	// }

	public function autocomplete() {

		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('sale/customer');

			$data = array(
				'filter_name' => $this->request->get['filter_name'],
				'start'       => 0,
				'limit'       => 20
			);
			$results = $this->model_sale_customer->getCustomers($data);
// $this->load->out($results);
			foreach ($results as $result) {
				// $address = '';
				// foreach ($this->model_sale_customer->getAddresses($result['customer_id']) as $key => $value) {
				// 	$address = $value;
				// }
				// $addresses = $this->model_sale_customer->getAddress($result['address_id']);

				$json[] = array(
					'customer_id'       => $result['customer_id'], 
					'dob' => $result['dob'],
					'store_id' => $result['store_id'],
					'customer_group_id' => $result['customer_group_id'],
					// 'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					// 'customer_group'    => $result['customer_group'],
					'firstname'         => $result['firstname'],
					'fullname'          => $result['fullname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
					'mobile'               => $result['mobile'],
					'ssn'               => $result['ssn']
					// 'address_id'           =>  $result['address_id'],
					// 'address'           => $address
				);					
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[] = $value['lastname'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->setOutput(json_encode($json));
	}		

	public function country() {
		$json = array();

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);

		if ($country_info) {
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']		
			);
		}

		$this->response->setOutput(json_encode($json));
	}

	public function address() {
		$json = array();

		if (!empty($this->request->get['address_id'])) {
			$this->load->model('sale/customer');

			$json = $this->model_sale_customer->getAddress($this->request->get['address_id']);
		}

		$this->response->setOutput(json_encode($json));		
	}
}
?>