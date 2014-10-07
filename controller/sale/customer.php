<?php    
class ControllerSaleCustomer extends Controller { 
	private $error = array();

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

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer->addCustomer($this->request->post);

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

			$this->redirect($this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/customer');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

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

		if (isset($this->request->get['filter_ssn'])) {
			$filter_ssn = $this->request->get['filter_ssn'];
		} else {
			$filter_ssn = null;
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = null;
		}

		if (isset($this->request->get['filter_customer_group_id'])) {
			$filter_customer_group_id = $this->request->get['filter_customer_group_id'];
		} else {
			$filter_customer_group_id = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['filter_approved'])) {
			$filter_approved = $this->request->get['filter_approved'];
		} else {
			$filter_approved = null;
		}

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
		$this->data['insert'] = $this->url->link('sale/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$this->data['delete'] = $this->url->link('sale/customer/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['customers'] = array();

		$data = array(
			'filter_name'              => $filter_name, 
			'filter_ssn'               => $filter_ssn, 
			'filter_email'             => $filter_email, 
			'filter_customer_group_id' => $filter_customer_group_id, 
			'filter_status'            => $filter_status, 
			'filter_approved'          => $filter_approved, 
			'filter_date_added'        => $filter_date_added,
			'filter_ip'                => $filter_ip,
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
				'href' => $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
			);

			$this->data['customers'][] = array(
				'customer_id'    => $result['customer_id'],
				'name'           => $result['name'],
				'email'          => $result['email'],
				'customer_group' => $result['customer_group'],
				'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'approved'       => ($result['approved'] ? $this->language->get('text_yes') : $this->language->get('text_no')),
				'ip'             => $result['ip'],
				'date_added'     => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'selected'       => isset($this->request->post['selected']) && in_array($result['customer_id'], $this->request->post['selected']),
				'action'         => $action
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

		$url = '';

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

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_ssn'] = $filter_ssn;
		$this->data['filter_email'] = $filter_email;
		$this->data['filter_customer_group_id'] = $filter_customer_group_id;
		$this->data['filter_status'] = $filter_status;
		$this->data['filter_approved'] = $filter_approved;
		$this->data['filter_ip'] = $filter_ip;
		$this->data['filter_date_added'] = $filter_date_added;

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
		$this->data['text_remaining_balance'] = $this->language->get('text_remaining_balance');
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

		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
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

		$this->data['tab_image'] = $this->language->get('tab_image');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_address'] = $this->language->get('tab_address');
		$this->data['tab_history'] = $this->language->get('tab_history');
		$this->data['tab_transaction'] = $this->language->get('tab_transaction');
		$this->data['tab_reward'] = $this->language->get('tab_reward');
		$this->data['tab_ip'] = $this->language->get('tab_ip');
		$this->data['tab_lendto'] = $this->language->get('tab_lendto');
		$this->data['tab_payment'] = $this->language->get('tab_payment');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['customer_id'])) {
			$this->data['customer_id'] = $this->request->get['customer_id'];
		} else {
			$this->data['customer_id'] = 0;
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['dob'])) {
			$this->data['error_dob'] = $this->error['dob'];
		} else {
			$this->data['error_dob'] = '';
		}

		if (isset($this->error['firstname'])) {
			$this->data['error_firstname'] = $this->error['firstname'];
		} else {
			$this->data['error_firstname'] = '';
		}

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

		// // Images
		// if (isset($this->request->post['customer_image'])) {
		// 	$customer_images = $this->request->post['customer_image'];
		// } elseif (isset($this->request->get['customer_id'])) {
		// 	$tempdata = array(
		// 		'customer_id' => $this->request->get['customer_id']
		// 	);	
		// 	$customer_images = $this->model_sale_customer->getCustomerImages($tempdata);
		// } else {
		// 	$customer_images = array();
		// }


		// $this->data['customer_images'] = array();
		// $this->load->model('tool/image');

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

		if (!isset($this->request->get['customer_id'])) {
			$this->data['action'] = $this->url->link('sale/customer/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('sale/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$customer_info = $this->model_sale_customer->getCustomer($this->request->get['customer_id']);
		}

		if (isset($this->request->post['firstname'])) {
			$this->data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($customer_info)) { 
			$this->data['firstname'] = $customer_info['firstname'];
		} else {
			$this->data['firstname'] = '';
		}

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

		if (isset($this->request->post['dob'])) {
			$this->data['dob'] = $this->request->post['dob'];
		} elseif (!empty($customer_info)) {
			$this->data['dob'] = $customer_info['dob'];
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


		if (isset($this->request->post['fax'])) {
			$this->data['fax'] = $this->request->post['fax'];
		} elseif (!empty($customer_info)) {
			$this->data['fax'] = $customer_info['fax'];
		} else {
			$this->data['fax'] = '';
		}


		if (isset($this->request->post['newsletter'])) {
			$this->data['newsletter'] = $this->request->post['newsletter'];
		} elseif (!empty($customer_info)) {
			$this->data['newsletter'] = $customer_info['newsletter'];
		} else {
			$this->data['newsletter'] = '';
		}

		$this->load->model('tool/image'); 

		if (isset($this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($customer_info)) {
			$this->data['thumb'] = $this->model_tool_image->resize($customer_info['image'], 100, 100);
			$this->data['image'] = $customer_info['image'];
		} else {
			$this->data['image'] = '';
			$this->data['thumb'] = '';
		}

		if (isset($this->request->post['store'])) {
			$this->data['store'] = $this->request->post['store'];
		} elseif (!empty($customer_info)) {
			$this->data['store'] = $customer_info['store_id'];
		} else {
			$this->data['store'] = '';
		}

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();



		

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
		} elseif (isset($this->request->get['customer_id'])) {
			foreach ($this->model_sale_customer->getAddresses($this->request->get['customer_id']) as $key => $value) {
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

		$payments = array();
		$balance = 0;
		if (isset($this->request->get['customer_id'])) {

			$this->load->model('sale/order');
			
			$data = array('filter_customer_id' => $this->request->get['customer_id']);
			$orders = $this->model_sale_order->getOrders($data);
			

			foreach ($orders as $order) {

				if ((float)$order['total'] >= 0)
				$payments[] = array(
					'order_id' => $order['order_id'],
					'message' => $this->language->get('text_order_total'),
					'date_added' => $order['date_added'],
					'amount' => -$order['total']
				);

				if ((float)$order['payment_final'] > 0)
				$payments[] = array(
					'order_id' => $order['order_id'],
					'message' => $this->language->get('text_payment_final'),
					'date_added' => $order['date_added'],
					'amount' => $order['payment_final']
				);

				if ((float)$order['payment_cash'] > 0)
				$payments[] = array(
					'order_id' => $order['order_id'],
					'message' => $this->language->get('text_payment_cash'),
					'date_added' => $order['date_added'],
					'amount' => $order['payment_cash']
				);

				if ((float)$order['payment_visa'] > 0)
				$payments[] = array(
					'order_id' => $order['order_id'],
					'message' => $this->language->get('text_payment_visa'),
					'date_added' => $order['date_added'],
					'amount' => $order['payment_visa']
				);

				$balance += $order['payment_balance'];
				
			}
		}

		$this->data['balance'] = $balance;
		$this->data['payments'] = $payments;


		// if (!empty($customer_info)) {
		// 	$results = $this->model_sale_customer->getIpsByCustomerId($this->request->get['customer_id']);

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

		if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}

		$customer_info = $this->model_sale_customer->getCustomerByEmail($this->request->post['email']);

		if (!isset($this->request->get['customer_id'])) {
			if ($customer_info) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		} else {
			if ($customer_info && ($this->request->get['customer_id'] != $customer_info['customer_id'])) {
				$this->error['warning'] = $this->language->get('error_exists');
			}
		}

		// '2014-09-27 22:27'
		if (empty($this->request->post['store'])) {
			$this->error['store'] = $this->language->get('error_store');
		}

		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}

		// if ($this->request->post['password'] || (!isset($this->request->get['customer_id']))) {
		// 	if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
		// 		$this->error['password'] = $this->language->get('error_password');
		// 	}

		// 	if ($this->request->post['password'] != $this->request->post['confirm']) {
		// 		$this->error['confirm'] = $this->language->get('error_confirm');
		// 	}
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

				if ((utf8_strlen($value['address_1']) < 3) || (utf8_strlen($value['address_1']) > 128)) {
					$this->error['address_address_1'] = $this->language->get('error_address_1');
				}

				if ((utf8_strlen($value['city']) < 2) || (utf8_strlen($value['city']) > 128)) {
					$this->error['address_city'] = $this->language->get('error_city');
				} 

				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($value['country_id']);

				if ($country_info) {
					if ($country_info['postcode_required'] && (utf8_strlen($value['postcode']) < 2) || (utf8_strlen($value['postcode']) > 10)) {
						$this->error['address_postcode'] = $this->language->get('error_postcode');
					}

					// VAT Validation
					$this->load->helper('vat');

					if ($this->config->get('config_vat') && $value['tax_id'] && (vat_validation($country_info['iso_code_2'], $value['tax_id']) == 'invalid')) {
						$this->error['address_tax_id'] = $this->language->get('error_vat');
					}
				}

				if ($value['country_id'] == '') {
					$this->error['address_country'] = $this->language->get('error_country');
				}

				if (!isset($value['zone_id']) || $value['zone_id'] == '') {
					$this->error['address_zone'] = $this->language->get('error_zone');
				}	
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

		if (isset($this->request->get['customer_id'])) {
			$customer_id = $this->request->get['customer_id'];
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

	public function images() {
		$this->language->load('sale/customer');
		$this->load->model('sale/customer');
		$this->data['customer_id'] = $this->request->get['customer_id'];

		$this->data['token'] = $this->session->data['token'];
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

		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['entry_image'] = $this->language->get('entry_image');

		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			$customer_id = (isset($this->request->get['customer_id']) ? $this->request->get['customer_id'] : null); 

			// Images
			if (isset($customer_id)) {
			$data = array(
				'customer_id' => $customer_id
			);	
			$customer_images = $this->model_sale_customer->getCustomerImages($data);
		} else {
			$customer_images = array();
		}

		$this->data['customer_images'] = array();
		$this->load->model('tool/image');

		foreach ($customer_images as $customer_image) {
			if ($customer_image['image'] && file_exists(DIR_IMAGE . $customer_image['image'])) {
				$image = $customer_image['image'];
			} else {
				$image = 'no_image.jpg';
			}

			$this->data['customer_images'][] = array(
				'image'      => $image,
				'customer_image_id'      => $customer_image['customer_image_id'],
				'customer_transaction_id'      => $customer_image['customer_transaction_id'],
				'date_added'      =>  explode(' ' ,$customer_image['date_added'])[0],
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $customer_image['sort_order']
			);
		}


		} else {

		}	

		$this->template = 'sale/customer_images.tpl';		

		$this->response->setOutput($this->render());
	}

	public function history() {
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		$reminder = (isset($this->request->post['reminder']) ? $this->request->post['reminder'] : null); 
		$reminder_date = (isset($this->request->post['reminder_date']) ? $this->request->post['reminder_date'] : null); 
		$filter_user_id = (isset($this->request->post['filter_user_id']) ? $this->request->post['filter_user_id'] : null); 
		$filter_customer_id = (isset($this->request->get['customer_id']) ? $this->request->get['customer_id'] : null);  

		if (isset($this->request->post['comment']) && utf8_strlen($this->request->post['comment']) == 0) {
			$this->data['error_warning'] = '';
		} else if (isset($this->request->post['comment']) && utf8_strlen($this->request->post['comment']) < 5) {
			$this->data['error_warning'] = $this->language->get('text_comment_is_short');
		} else if (!$this->validateDate($reminder_date) && $reminder=='checked') {
			$this->data['error_warning'] = $this->language->get('text_date_incorrect');
		} else if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} else if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			if (isset($this->request->post['comment'])) {
				$data = array(
					'user_id' => $this->user->getId(),
					'comment' => $this->request->post['comment'],
					'reminder' => $this->request->post['reminder'],
					'reminder_date' => $this->request->post['reminder_date'],
				);
				$this->model_sale_customer->addHistory($this->request->get['customer_id'], $data);
				$this->data['success'] = $this->language->get('text_success');
			} else {
				$this->data['success'] = '';
			}
		
		} else {
			$this->data['success'] = '.';
		}


		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_reminder_date'] = $this->language->get('column_reminder_date');
		$this->data['column_comment'] = $this->language->get('column_comment');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_customer'] = $this->language->get('column_customer');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['histories'] = array();

		$data = array(
			'filter_user_id' => $filter_user_id,
			'filter_customer_id' => $filter_customer_id
		);


		$results = $this->model_sale_customer->getHistories($data, ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$this->data['histories'][] = array(
				'customer_history_id'     => $result['customer_history_id'],
				'if_treatment'     => $result['if_treatment'],
				'comment'     => $result['comment'],
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
			'filter_customer_id' => $filter_customer_id
		);
		$transaction_total = $this->model_sale_customer->getTotalHistories($data);

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/customer_history.tpl';		

		$this->response->setOutput($this->render());
	}

	public function lendings() {
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
		$this->data['column_user'] = $this->language->get('column_user');

		if (!$lendto_quantity || !$lendto_customer_id || !$lendto_product_id) {
			$this->data['error_warning'] = '';
		// } elseif (isset($this->request->post['comment']) && utf8_strlen($this->request->post['comment']) < 5) {
		// 	$this->data['error_warning'] = $this->language->get('text_comment_is_short');
		// } else if (!$this->validateDate($reminder_date) && $reminder=='checked') {
		// 	$this->data['error_warning'] = $this->language->get('text_date_incorrect');
		// } else if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
		// 	$this->data['error_warning'] = $this->language->get('error_permission');
		} else if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			if ($this->model_sale_customer->addLending($this->request->get['customer_id'], $lendto_customer_id, $lendto_product_id, $lendto_quantity)) {
				$this->data['success'] = $this->language->get('text_success');
			} else {
				$this->data['error_warning'] = $this->language->get('text_error_lending');
			}
		} else {
			$this->data['success'] = '.';
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

		$results = $this->model_sale_customer->getLendings($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {

			$product_descriptions = $this->model_catalog_product->getProductDescriptions($result['product_id']);
			$product_unit = $this->model_catalog_product->getProductUnit($result['product_id']);
			$product_description = $product_descriptions[(int)$this->config->get('config_language_id')]['name'];

			$this->data['lendings'][] = array(
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
				'unit'     => $product_unit,
				// 'type'     => $result['product_type_id'],
				'date_added'     => $result['date_added']
				// 'reminder_date'     => ($result['reminder_date'] == '0000-00-00' ? '' : $result['reminder_date']),
				// 'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$lendings_total = $this->model_sale_customer->getTotalLendings($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $lendings_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

		$this->data['token'] = $this->session->data['token'];
		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/customer_lending.tpl';		

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

	// '2014-09-30 22:35'
	public function edittransaction() {

		$json = array();

		$data = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_transaction_id']) && isset($this->request->post['status'])) { 		

				$this->load->model('sale/customer');	
			
				$data['status'] = $this->request->post['status'];
				$data['comment'] = $this->request->post['comment'];

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


	public function deletetransaction() {

		$json = array();

		$this->language->load('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 

			if (isset($this->request->post['customer_transaction_id'])) { 		

				$this->load->model('sale/customer');	
		
				if ($this->model_sale_customer->deletetransaction($this->request->post['customer_transaction_id'])) {
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

			$json['success'] = 'success';
			$this->response->setOutput(json_encode($json));
		} else {

			$json['error'] = 'error';
			$this->response->setOutput(json_encode($json));
		}

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
			
			$customer_image_id = $this->model_sale_customer->insertCustomerImage($this->request->post['customer_id'], $data);
			
			$json['success'] = $customer_image_id;
			$this->response->setOutput(json_encode($json));
		} else {

			$json['error'] = 'error';
			$this->response->setOutput(json_encode($json));
		}
	}

	// '2014-10-06 13:46'
	public function transaction() {
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');
		// $this->data['customer_id'] = isset($this->request->get['customer_id'] ? $this->request->get['customer_id'] : 0);

		// $reminder = (isset($this->request->post['reminder']) ? $this->request->post['reminder'] : null); 
		// $reminder_date = (isset($this->request->post['reminder_date']) ? $this->request->post['reminder_date'] : null); 
		$filter_user_id = (isset($this->request->post['filter_user_id']) ? $this->request->post['filter_user_id'] : null); 
		$filter_customer_id = (isset($this->request->get['customer_id']) ? $this->request->get['customer_id'] : null);  
		$unitspend = (isset($this->request->post['unitspend']) ? $this->request->post['unitspend'] : null); 
		$product_id = (isset($this->request->post['product_id']) ? $this->request->post['product_id'] : null); 
	
		if ($this->user->hasPermission('modify', 'sale/customer')) { 

			// update information
			if (isset($this->request->post['product_id']) && isset($this->request->post['unitspend']) && isset($this->request->get['customer_id'])) {

				// pure get
				if (!$this->request->post['product_id'] && !$this->request->post['unitspend']) {
					$this->data['success'] = '';	
				} else if ($this->model_sale_customer->addTransaction2($this->request->get['customer_id'], $this->request->post['product_id'], $this->request->post['unitspend'])) {
					$this->data['success'] = $this->language->get('text_success');
				} else {
					$this->data['error_warning'] = $this->language->get('text_cannot_use_inventory');
				}
			} elseif (isset($this->request->get['show_group'])) {
				$this->data['success'] = '';	
			} else {
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

		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_product'] = $this->language->get('column_product');
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

		$this->data['button_change_status'] = $this->language->get('button_change_status');
		$this->data['button_add_picture'] = $this->language->get('button_add_picture');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['transactions'] = array();

		$data = array();

		if (isset($this->request->get['customer_id'])) $data['customer_id'] = $this->request->get['customer_id'];
		if (isset($this->request->post['filter_customer_name'])) $data['filter_customer_name'] = $this->request->post['filter_customer_name'];
		if (isset($this->request->post['filter_product_name'])) $data['filter_product_name'] = $this->request->post['filter_product_name'];
		if (isset($this->request->post['filter_ssn'])) $data['filter_ssn'] = $this->request->post['filter_ssn'];
		$data['filter_product_type_id'] = 2;			
		

		$results = $this->model_sale_customer->getTransactions($data, ($page - 1) * 10, 10);
		$totalresults = $this->model_sale_customer->getTransactions($data, 0, 999999);


		// $data['filter_product_type'] = null;

		$this->load->model('catalog/product');

		$groupresults = array();

		foreach ($results as $result) {

			$product_id = $result['product_id'];

			$product = $this->model_catalog_product->getProduct($product_id);
			
			$unit = $this->model_catalog_product->getProductUnit($product_id);

			$tempdata = array(); 
			if ($filter_customer_id) $tempdata['customer_id'] = $filter_customer_id;
			$tempdata['filter_customer_transaction_id'] = $result['customer_transaction_id'];

			// array(
			// 	'customer_id' => $this->request->get['customer_id'],
			// 	'filter_customer_transaction_id' => $result['customer_transaction_id']
			// );

			$treatment_images_before = $this->model_sale_customer->getCustomerImages($tempdata);

			$treatment_images = array();

			$this->load->model('tool/image');

			foreach ($treatment_images_before as $image) {

				$thumb = $this->model_tool_image->resize($image['image'], 80, 80);
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
				'fullname' => $result['fullname'],
				'product_name' => $product['name'],
				'subquantity' => $result['subquantity'],
				'customer_transaction_id' => $result['customer_transaction_id'],
				'quantity' => $result['quantity'],
				'unit' => $unit,
				'ismain' => $result['ismain'],
				'treatment_images' => $treatment_images,
				'type' => $result['type'],
				'status' => $result['status'],
				'product_which' => $result['product_which'],
				'product_total_which' => $result['product_total_which'],
				'comment' => $result['comment'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'date_modified'  => date($this->language->get('date_format_short'), strtotime($result['date_modified']))
			);
		}

		foreach ($totalresults as $result) {

			if ($result['status'] < 0) continue;

			$product_id = $result['product_id'];

			$product = $this->model_catalog_product->getProduct($product_id);
			
			$unit = $this->model_catalog_product->getProductUnit($product_id);
			
			$groupresults[$product_id]['name'] = $product['name'];
			$groupresults[$product_id]['subquantity'] = (isset($groupresults[$product_id]['subquantity']) ? $groupresults[$product_id]['subquantity'] + $result['subquantity'] : $result['subquantity']);
			$groupresults[$product_id]['quantity'] = (isset($groupresults[$product_id]['quantity']) ? $groupresults[$product_id]['quantity'] + $result['quantity'] : $result['quantity']);
			$groupresults[$product_id]['unit'] = $unit;
		}


		$this->data['grouptransactions'] = $groupresults;
		$this->data['show_group'] = (isset($this->request->get['show_group']) ? $this->request->get['show_group'] : 0);
		$transaction_total = $this->model_sale_customer->getTotalTransactions($data);

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $filter_customer_id . '&show_group=1&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->data['token'] = $this->session->data['token'];

		$this->template = 'sale/customer_transaction.tpl';		

		$this->response->setOutput($this->render());
	}

	public function borrow() {
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			if (!$this->request->post['product_id'] && !$this->request->post['unitspend']) {
				$this->data['error_warning'] = '';
			} elseif ($this->model_sale_customer->addTransaction2($this->request->get['customer_id'], $this->request->post['product_id'], $this->request->post['unitspend'])) {
				$this->data['success'] = $this->language->get('text_success');
			} else {
				$this->data['error_warning'] = $this->language->get('text_cannot_use_inventory');
			}
		} else {
			$this->data['error_warning'] = $this->language->get('text_error');
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} 	


		$this->data['text_service_not_rendered'] = $this->language->get('text_service_not_rendered');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_balance'] = $this->language->get('text_balance');
		$this->data['text_success'] = $this->language->get('text_success');
		$this->data['text_error'] = $this->language->get('text_error');
		$this->data['text_cannot_use_inventory'] = $this->language->get('text_cannot_use_inventory');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_unit_quantity'] = $this->language->get('column_unit_quantity');
		$this->data['column_unit'] = $this->language->get('column_unit');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_amount'] = $this->language->get('column_amount');
		$this->data['column_delete'] = $this->language->get('column_delete');
		$this->data['column_total_units'] = $this->language->get('column_total_units');
		$this->data['text_transaction_unoccured'] = $this->language->get('text_transaction_unoccured');
		$this->data['text_transaction_appointed'] = $this->language->get('text_transaction_appointed');
		$this->data['text_transaction_finished'] = $this->language->get('text_transaction_finished');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['transactions'] = array();

		$data = array(
			'customer_id' => $this->request->get['customer_id']
		);
		$results = $this->model_sale_customer->getTransactions($data, ($page - 1) * 10, 10);

		$this->load->model('catalog/product');

		$groupresults = array();

		foreach ($results as $result) {

			$product_id = $result['product_id'];

			$product = $this->model_catalog_product->getProduct($product_id);
			
			$unit = $this->model_catalog_product->getProductUnit($product_id);

			$this->data['transactions'][] = array(
				'amount'      => $this->currency->format($result['amount'], $this->config->get('config_currency')),
				'product_name' => $product['name'],
				'subquantity' => $result['subquantity'],
				'product_which' => $result['product_which'],
				'product_total_which' => $result['product_total_which'],
				'comment' => $result['comment'],
				'customer_transaction_id' => $result['customer_transaction_id'],
				'quantity' => $result['quantity'],
				'ismain' => $result['ismain'],
				'unit' => $unit,
				'type' => $result['type'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);

			$groupresults[$product_id]['name'] = $product['name'];
			$groupresults[$product_id]['subquantity'] = (isset($groupresults[$product_id]['subquantity']) ? $groupresults[$product_id]['subquantity'] + $result['subquantity'] : $result['subquantity']);
			$groupresults[$product_id]['quantity'] = (isset($groupresults[$product_id]['quantity']) ? $groupresults[$product_id]['quantity'] + $result['quantity'] : $result['quantity']);
			$groupresults[$product_id]['unit'] = $unit;
		}

		$this->data['grouptransactions'] = $groupresults;

		$this->data['balance'] = $this->currency->format($this->model_sale_customer->getTransactionTotal($this->request->get['customer_id']), $this->config->get('config_currency'));


		$data = array(
			'customer_id' => $this->request->get['customer_id']
		);
		$transaction_total = count($results); 

		$pagination = new Pagination();
		$pagination->total = $transaction_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/transaction', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();
		$this->data['token'] = $this->session->data['token'];

		$this->template = 'sale/customer_borrow.tpl';		

		$this->response->setOutput($this->render());
	}


	public function reward() {
		$this->language->load('sale/customer');

		$this->load->model('sale/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->user->hasPermission('modify', 'sale/customer')) { 
			$this->model_sale_customer->addReward($this->request->get['customer_id'], $this->request->post['description'], $this->request->post['points']);

			$this->data['success'] = $this->language->get('text_success');
		} else {
			$this->data['success'] = '';
		}

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && !$this->user->hasPermission('modify', 'sale/customer')) {
			$this->data['error_warning'] = $this->language->get('error_permission');
		} else {
			$this->data['error_warning'] = '';
		}	

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_balance'] = $this->language->get('text_balance');

		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_description'] = $this->language->get('column_description');
		$this->data['column_points'] = $this->language->get('column_points');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}  

		$this->data['rewards'] = array();

		$results = $this->model_sale_customer->getRewards($this->request->get['customer_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$this->data['rewards'][] = array(
				'points'      => $result['points'],
				'description' => $result['description'],
				'date_added'  => date($this->language->get('date_format_short'), strtotime($result['date_added']))
			);
		}

		$this->data['balance'] = $this->model_sale_customer->getRewardTotal($this->request->get['customer_id']);

		$reward_total = $this->model_sale_customer->getTotalRewards($this->request->get['customer_id']);

		$pagination = new Pagination();
		$pagination->total = $reward_total;
		$pagination->page = $page;
		$pagination->limit = 10; 
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/customer/reward', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/customer_reward.tpl';		

		$this->response->setOutput($this->render());
	}

	public function addBanIP() {
		$this->language->load('sale/customer');

		$json = array();

		if (isset($this->request->post['ip'])) { 
			if (!$this->user->hasPermission('modify', 'sale/customer')) {
				$json['error'] = $this->language->get('error_permission');
			} else {
				$this->load->model('sale/customer');

				$this->model_sale_customer->addBanIP($this->request->post['ip']);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function removeBanIP() {
		$this->language->load('sale/customer');

		$json = array();

		if (isset($this->request->post['ip'])) { 
			if (!$this->user->hasPermission('modify', 'sale/customer')) {
				$json['error'] = $this->language->get('error_permission');
			} else {
				$this->load->model('sale/customer');

				$this->model_sale_customer->removeBanIP($this->request->post['ip']);

				$json['success'] = $this->language->get('text_success');
			}
		}

		$this->response->setOutput(json_encode($json));
	}

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

			foreach ($results as $result) {
				// $address = '';
				// foreach ($this->model_sale_customer->getAddresses($result['customer_id']) as $key => $value) {
				// 	$address = $value;
				// }
				// $addresses = $this->model_sale_customer->getAddress($result['address_id']);

				$json[] = array(
					'customer_id'       => $result['customer_id'], 
					'store_id' => $result['store_id'],
					'customer_group_id' => $result['customer_group_id'],
					// 'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'customer_group'    => $result['customer_group'],
					'firstname'         => $result['firstname'],
					'fullname'          => $result['fullname'],
					'lastname'          => $result['lastname'],
					'email'             => $result['email'],
					'telephone'         => $result['telephone'],
					'fax'               => $result['fax'],
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