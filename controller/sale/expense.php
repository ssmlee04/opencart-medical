<?php 
class ControllerSaleExpense extends Controller {
	private $error = array();

	public function index() {
		$this->language->load('sale/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/expense');

		$this->getList();
	}

	public function insert() {
		$this->language->load('sale/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/expense');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_sale_expense->addExpense($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_expense_id'])) {
				$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . urlencode(html_entity_decode($this->request->get['filter_store'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_user'])) {
				$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_total_min'])) {
				$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
			}

			if (isset($this->request->get['filter_total_max'])) {
				$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
			}

			if (isset($this->request->get['filter_date_expensed'])) {
				$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
			}

			// if (isset($this->request->get['filter_date_added'])) {
			// 	$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			// }

			// if (isset($this->request->get['sort'])) {
			// 	$url .= '&sort=' . $this->request->get['sort'];
			// }

			// if (isset($this->request->get['order'])) {
			// 	$url .= '&order=' . $this->request->get['order'];
			// }

			// if (isset($this->request->get['page'])) {
			// 	$url .= '&page=' . $this->request->get['page'];
			// }

			$this->redirect($this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('sale/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/expense');
		
		$this->data['is_insert'] = false;

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			if ($this->model_sale_expense->editExpense($this->request->get['expense_id'], $this->request->post)) {
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->session->data['error'] = $this->language->get('text_error');
			}

			

			$url = '';

			if (isset($this->request->get['filter_expense_id'])) {
				$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
			}

			if (isset($this->request->get['filter_user'])) {
				$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . urlencode(html_entity_decode($this->request->get['filter_store'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_expense_status_id'])) {
				$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
			}

			if (isset($this->request->get['filter_total_min'])) {
				$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
			}

			if (isset($this->request->get['filter_total_max'])) {
				$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
			}

			if (isset($this->request->get['filter_date_expensed'])) {
				$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['expense'])) {
				$url .= '&expense=' . $this->request->get['expense'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('sale/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/expense');

		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $expense_id) {

				if ($this->model_sale_expense->deleteExpense($expense_id, $this->request->post)) {
					$this->session->data['success'] = $this->language->get('text_success');
				} else {
					$this->session->data['error'] = $this->language->get('text_error');
				}
			}

			$url = '';

			if (isset($this->request->get['filter_expense_id'])) {
				$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
			}

			if (isset($this->request->get['filter_user'])) {
				$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_store'])) {
				$url .= '&filter_store=' . urlencode(html_entity_decode($this->request->get['filter_store'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_expense_status_id'])) {
				$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
			}

			if (isset($this->request->get['filter_total_min'])) {
				$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
			}

			if (isset($this->request->get['filter_total_max'])) {
				$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
			}

			if (isset($this->request->get['filter_date_expensed'])) {
				$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
			}

			if (isset($this->request->get['filter_date_added'])) {
				$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
			}

			if (isset($this->request->get['filter_date_modified'])) {
				$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['expense'])) {
				$url .= '&expense=' . $this->request->get['expense'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {

		if (isset($this->request->get['filter_expense_id'])) {
			$filter_expense_id = $this->request->get['filter_expense_id'];
		} else {
			$filter_expense_id = null;
		}
		
		if (isset($this->request->get['filter_user'])) {
			$filter_user = $this->request->get['filter_user'];
		} else {
			$filter_user = null;
		}


		if (isset($this->request->get['filter_store'])) {
			$filter_store = $this->request->get['filter_store'];
		} else {
			$filter_store = null;
		}

		if (isset($this->request->get['filter_total_min'])) {
			$filter_total_min = $this->request->get['filter_total_min'];
		} else {
			$filter_total_min = null;
		}

		if (isset($this->request->get['filter_total_max'])) {
			$filter_total_max = $this->request->get['filter_total_max'];
		} else {
			$filter_total_max = null;
		}

		if (isset($this->request->get['filter_date_expensed_start'])) {
			$filter_date_expensed_start = $this->request->get['filter_date_expensed_start'];
		} else {
			$filter_date_expensed_start = null;
		}

		if (isset($this->request->get['filter_date_expensed_end'])) {
			$filter_date_expensed_end = $this->request->get['filter_date_expensed_end'];
		} else {
			$filter_date_expensed_end = null;
		}

		if (isset($this->request->get['filter_date_added'])) {
			$filter_date_added = $this->request->get['filter_date_added'];
		} else {
			$filter_date_added = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'o.expense_id';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_expense_id'])) {
			$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
		}

		if (isset($this->request->get['filter_user'])) {
			$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . urlencode(html_entity_decode($this->request->get['filter_store'], ENT_QUOTES, 'UTF-8'));
		}

		// if (isset($this->request->get['filter_expense_status_id'])) {
		// 	$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
		// }

		if (isset($this->request->get['filter_total_min'])) {
			$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
		}

		if (isset($this->request->get['filter_total_max'])) {
			$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
		}

		if (isset($this->request->get['filter_date_expensed'])) {
			$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['expense'])) {
			$url .= '&expense=' . $this->request->get['expense'];
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
			'href'      => $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['invoice'] = $this->url->link('sale/expense/invoice', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['insert'] = $this->url->link('sale/expense/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('sale/expense/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['expenses'] = array();

		$data = array(
			'filter_expense_id'        => $filter_expense_id,
			'filter_user'	     => $filter_user,
			'filter_store' 			=> $filter_store,
			'filter_total_min'           => $filter_total_min,
			'filter_total_max'           => $filter_total_max,
			'filter_date_expensed_start'      => $filter_date_expensed_start,
			'filter_date_expensed_end'      => $filter_date_expensed_end,
			'filter_date_added'      => $filter_date_added,
			// 'filter_date_modified'   => $filter_date_modified,
			'sort'                   => $sort,
			'order'                  => $order,
			'start'                  => ($page - 1) * 10,
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$expense_total = $this->model_sale_expense->getTotalExpenses($data);

		$results = $this->model_sale_expense->getExpenses($data);
		// $this->load->test($results);

		$this->load->model('user/user')	;

		$data = array();

		$users = $this->model_user_user->getUsers($data);

		$this->data['users'] = $users;

		$this->load->model('setting/store');
	
		$stores = $this->model_setting_store->getStores();
				
		$this->data['stores'] = $stores;		

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/expense/update', 'token=' . $this->session->data['token'] . '&expense_id=' . $result['id'] . $url, 'SSL')
			);

			$userinfo = $this->model_user_user->getUser($result['user_id']);

			$storeinfo = $this->model_setting_store->getStore($result['store_id']);

			$this->data['expenses'][] = array(
				'expense_id'      => $result['id'],
				'message'      => $result['message'],
				'user'      => $result['user_id'],
				'store'      => $storeinfo['name'],
				'name'      => $userinfo['fullname'],
				// 'status'        => $result['status'],
				'total'         => $result['total'],// //$this->currency->format($result['total'], $result['currency_code'], $result['currency_value']),
				'date_added'    => $result['date_added'], //date($this->language->get('date_format_short'), strtotime($result['date_expensed'])),
				'date_expensed'    => $result['date_expensed'], //date($this->language->get('date_format_short'), strtotime($result['date_expensed'])),
				'date_modified' => $result['date_modified'], //date($this->language->get('date_format_short'), strtotime($result['date_modified'])),
				'selected'      => isset($this->request->post['selected']) && in_array($result['expense_id'], $this->request->post['selected']),
				'action'        => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_missing'] = $this->language->get('text_missing');

		$this->data['column_expense_id'] = $this->language->get('column_expense_id');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_date_expensed'] = $this->language->get('column_date_expensed');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_store'] = $this->language->get('column_store');
		$this->data['column_cost'] = $this->language->get('column_cost');

		$this->data['button_invoice'] = $this->language->get('button_invoice');
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
		} else {
			$this->data['error_warning'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_expense_id'])) {
			$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
		}

		if (isset($this->request->get['filter_user'])) {
			$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_expense_status_id'])) {
			$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
		}

		if (isset($this->request->get['filter_total_min'])) {
			$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
		}

		if (isset($this->request->get['filter_total_max'])) {
			$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
		}

		if (isset($this->request->get['filter_date_expensed'])) {
			$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
		}	

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['filter_date_modified'])) {
			$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_expense'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=o.expense_id' . $url, 'SSL');
		$this->data['sort_customer'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_total'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
		$this->data['sort_date_expensed'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=o.date_expensed' . $url, 'SSL');
		$this->data['sort_date_modified'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');
		$this->data['sort_store'] = '';
		$this->data['sort_user'] = '';
		$this->data['sort_date_added'] = '';

		$url = '';

		if (isset($this->request->get['filter_expense_id'])) {
			$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
		}

		if (isset($this->request->get['filter_store'])) {
			$url .= '&filter_store=' . urlencode(html_entity_decode($this->request->get['filter_store'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_user'])) {
			$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_expense_status_id'])) {
			$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
		}

		if (isset($this->request->get['filter_date_expensed_start'])) {
			$url .= '&filter_date_expensed_start=' . $this->request->get['filter_date_expensed_start'];
		}

		if (isset($this->request->get['filter_date_expensed_end'])) {
			$url .= '&filter_date_expensed_end=' . $this->request->get['filter_date_expensed_end'];
		}

		if (isset($this->request->get['filter_total_min'])) {
			$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
		}

		if (isset($this->request->get['filter_total_max'])) {
			$url .= '&filter_total_max=' . $this->request->get['filter_total_max'];
		}

		if (isset($this->request->get['filter_date_expensed'])) {
			$url .= '&filter_date_expensed=' . $this->request->get['filter_date_expensed'];
		}

		if (isset($this->request->get['filter_date_added'])) {
			$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['expense'])) {
			$url .= '&expense=' . $this->request->get['expense'];
		}

		$pagination = new Pagination();
		$pagination->total = $expense_total;
		$pagination->page = $page;
		$pagination->limit = 10;//$this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_expense_id'] = $filter_expense_id;
		$this->data['filter_user'] = $filter_user;
		$this->data['filter_store'] = $filter_store;
		// $this->data['filter_expense_status_id'] = $filter_expense_status_id;
		$this->data['filter_date_expensed_end'] = $filter_date_expensed_end;
		$this->data['filter_date_expensed_start'] = $filter_date_expensed_start;
		$this->data['filter_total_min'] = $filter_total_min;
		$this->data['filter_total_max'] = $filter_total_max;
		// $this->data['filter_date_expensed'] = $filter_date_expensed;
		$this->data['filter_date_added'] = $filter_date_added;
		// $this->data['filter_date_modified'] = $filter_date_modified;

		//$this->load->model('localisation/expense_status');

		//$this->data['expense_statuses'] = $this->model_localisation_expense_status->getExpensestatuses();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'sale/expense_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	public function getForm() {
		$this->load->model('sale/customer');

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_wait'] = $this->language->get('text_wait');
		$this->data['text_product'] = $this->language->get('text_product');
		$this->data['text_voucher'] = $this->language->get('text_voucher');
		$this->data['text_expense'] = $this->language->get('text_expense');
		$this->data['text_today'] = $this->language->get('text_today');
		$this->data['text_product_unavailable'] = $this->language->get('text_product_unavailable');
		$this->data['text_duplicate'] = $this->language->get('text_duplicate');
		$this->data['text_error'] = $this->language->get('text_error');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		
		$this->data['entry_message'] = $this->language->get('entry_message');
		$this->data['entry_default_store'] = $this->language->get('entry_default_store');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_firstname'] = $this->language->get('entry_firstname');
		$this->data['entry_lastname'] = $this->language->get('entry_lastname');
		$this->data['entry_email'] = $this->language->get('entry_email');
		$this->data['entry_telephone'] = $this->language->get('entry_telephone');
		$this->data['entry_fax'] = $this->language->get('entry_fax');
		$this->data['entry_expense_status'] = $this->language->get('entry_expense_status');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_affiliate'] = $this->language->get('entry_affiliate');
		$this->data['entry_address'] = $this->language->get('entry_address');
		$this->data['entry_company'] = $this->language->get('entry_company');
		$this->data['entry_company_id'] = $this->language->get('entry_company_id');
		$this->data['entry_tax_id'] = $this->language->get('entry_tax_id');
		$this->data['entry_address_1'] = $this->language->get('entry_address_1');
		$this->data['entry_address_2'] = $this->language->get('entry_address_2');
		$this->data['entry_city'] = $this->language->get('entry_city');
		$this->data['entry_postcode'] = $this->language->get('entry_postcode');
		$this->data['entry_zone'] = $this->language->get('entry_zone');
		$this->data['entry_zone_code'] = $this->language->get('entry_zone_code');
		$this->data['entry_country'] = $this->language->get('entry_country');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_to_name'] = $this->language->get('entry_to_name');
		$this->data['entry_to_email'] = $this->language->get('entry_to_email');
		$this->data['entry_from_name'] = $this->language->get('entry_from_name');
		$this->data['entry_from_email'] = $this->language->get('entry_from_email');
		$this->data['entry_theme'] = $this->language->get('entry_theme');
		$this->data['entry_message'] = $this->language->get('entry_message');
		$this->data['entry_amount'] = $this->language->get('entry_amount');
		$this->data['entry_shipping'] = $this->language->get('entry_shipping');
		$this->data['entry_payment'] = $this->language->get('entry_payment');
		$this->data['entry_voucher'] = $this->language->get('entry_voucher');
		$this->data['entry_coupon'] = $this->language->get('entry_coupon');
		$this->data['entry_reward'] = $this->language->get('entry_reward');
		$this->data['entry_cost'] = $this->language->get('entry_cost');
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_product'] = $this->language->get('entry_product');
		$this->data['entry_total'] = $this->language->get('entry_total');
		$this->data['entry_date_expensed'] = $this->language->get('entry_date_expensed');

		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_model'] = $this->language->get('column_model');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_cost'] = $this->language->get('column_cost');
		$this->data['column_total'] = $this->language->get('column_total');

		$this->data['button_save'] = $this->language->get('button_save');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_expense'] = $this->language->get('button_add_expense');
		$this->data['button_add_voucher'] = $this->language->get('button_add_voucher');
		$this->data['button_update_total'] = $this->language->get('button_update_total');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_upload'] = $this->language->get('button_upload');
		$this->data['button_edit_basic'] = $this->language->get('button_edit_basic');

		$this->data['tab_expense'] = $this->language->get('tab_expense');
		$this->data['tab_customer'] = $this->language->get('tab_customer');
		$this->data['tab_payment'] = $this->language->get('tab_payment');
		$this->data['tab_shipping'] = $this->language->get('tab_shipping');
		$this->data['tab_product'] = $this->language->get('tab_product');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_total'] = $this->language->get('tab_total');

		if (isset($this->error['store'])) {
			$this->data['error_store'] = $this->error['store'];
		} else {
			$this->data['error_store'] = '';
		}

		if (isset($this->error['date'])) {
			$this->data['error_date'] = $this->error['date'];
		} else {
			$this->data['error_date'] = '';
		}

		if (isset($this->error['user'])) {
			$this->data['error_user'] = $this->error['user'];
		} else {
			$this->data['error_user'] = '';
		}

		if (isset($this->error['message'])) {
			$this->data['error_message'] = $this->error['message'];
		} else {
			$this->data['error_message'] = '';
		}

		if (isset($this->error['cost'])) {
			$this->data['error_cost'] = $this->error['cost'];
		} else {
			$this->data['error_cost'] = '';
		}

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
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

		if (isset($this->error['payment_firstname'])) {
			$this->data['error_payment_firstname'] = $this->error['payment_firstname'];
		} else {
			$this->data['error_payment_firstname'] = '';
		}

		if (isset($this->error['payment_lastname'])) {
			$this->data['error_payment_lastname'] = $this->error['payment_lastname'];
		} else {
			$this->data['error_payment_lastname'] = '';
		}

		if (isset($this->error['payment_address_1'])) {
			$this->data['error_payment_address_1'] = $this->error['payment_address_1'];
		} else {
			$this->data['error_payment_address_1'] = '';
		}

		if (isset($this->error['payment_city'])) {
			$this->data['error_payment_city'] = $this->error['payment_city'];
		} else {
			$this->data['error_payment_city'] = '';
		}

		if (isset($this->error['payment_postcode'])) {
			$this->data['error_payment_postcode'] = $this->error['payment_postcode'];
		} else {
			$this->data['error_payment_postcode'] = '';
		}

		if (isset($this->error['payment_tax_id'])) {
			$this->data['error_payment_tax_id'] = $this->error['payment_tax_id'];
		} else {
			$this->data['error_payment_tax_id'] = '';
		}

		if (isset($this->error['payment_country'])) {
			$this->data['error_payment_country'] = $this->error['payment_country'];
		} else {
			$this->data['error_payment_country'] = '';
		}

		if (isset($this->error['payment_zone'])) {
			$this->data['error_payment_zone'] = $this->error['payment_zone'];
		} else {
			$this->data['error_payment_zone'] = '';
		}

		if (isset($this->error['payment_method'])) {
			$this->data['error_payment_method'] = $this->error['payment_method'];
		} else {
			$this->data['error_payment_method'] = '';
		}

		if (isset($this->error['shipping_firstname'])) {
			$this->data['error_shipping_firstname'] = $this->error['shipping_firstname'];
		} else {
			$this->data['error_shipping_firstname'] = '';
		}

		if (isset($this->error['shipping_lastname'])) {
			$this->data['error_shipping_lastname'] = $this->error['shipping_lastname'];
		} else {
			$this->data['error_shipping_lastname'] = '';
		}

		if (isset($this->error['shipping_address_1'])) {
			$this->data['error_shipping_address_1'] = $this->error['shipping_address_1'];
		} else {
			$this->data['error_shipping_address_1'] = '';
		}

		if (isset($this->error['shipping_city'])) {
			$this->data['error_shipping_city'] = $this->error['shipping_city'];
		} else {
			$this->data['error_shipping_city'] = '';
		}

		if (isset($this->error['shipping_postcode'])) {
			$this->data['error_shipping_postcode'] = $this->error['shipping_postcode'];
		} else {
			$this->data['error_shipping_postcode'] = '';
		}

		if (isset($this->error['shipping_country'])) {
			$this->data['error_shipping_country'] = $this->error['shipping_country'];
		} else {
			$this->data['error_shipping_country'] = '';
		}

		if (isset($this->error['shipping_zone'])) {
			$this->data['error_shipping_zone'] = $this->error['shipping_zone'];
		} else {
			$this->data['error_shipping_zone'] = '';
		}

		if (isset($this->error['shipping_method'])) {
			$this->data['error_shipping_method'] = $this->error['shipping_method'];
		} else {
			$this->data['error_shipping_method'] = '';
		}

		$url = '';

		// if (isset($this->request->get['filter_expense_id'])) {
		// 	$url .= '&filter_expense_id=' . $this->request->get['filter_expense_id'];
		// }

		// if (isset($this->request->get['filter_user'])) {
		// 	$url .= '&filter_user=' . urlencode(html_entity_decode($this->request->get['filter_user'], ENT_QUOTES, 'UTF-8'));
		// }

		// if (isset($this->request->get['filter_expense_status_id'])) {
		// 	$url .= '&filter_expense_status_id=' . $this->request->get['filter_expense_status_id'];
		// }

		// if (isset($this->request->get['filter_total_min'])) {
		// 	$url .= '&filter_total_min=' . $this->request->get['filter_total_min'];
		// }

		// if (isset($this->request->get['filter_date_expensed_start'])) {
		// 	$url .= '&filter_date_expensed_start=' . $this->request->get['filter_date_expensed_start'];
		// }

		// if (isset($this->request->get['filter_date_expensed_end'])) {
		// 	$url .= '&filter_date_expensed_end=' . $this->request->get['filter_date_expensed_end'];
		// }

		// if (isset($this->request->get['filter_date_added'])) {
		// 	$url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
		// }

		// if (isset($this->request->get['filter_date_modified'])) {
		// 	$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
		// }

		// if (isset($this->request->get['sort'])) {
		// 	$url .= '&sort=' . $this->request->get['sort'];
		// }

		// if (isset($this->request->get['expense'])) {
		// 	$url .= '&expense=' . $this->request->get['expense'];
		// }

		// if (isset($this->request->get['page'])) {
		// 	$url .= '&page=' . $this->request->get['page'];
		// }

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['expense_id'])) {
			$this->data['action'] = $this->url->link('sale/expense/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('sale/expense/update', 'token=' . $this->session->data['token'] . '&expense_id=' . $this->request->get['expense_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('sale/expense', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['expense_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$expense_info = $this->model_sale_expense->getExpense($this->request->get['expense_id']);
		}

		// if (isset($this->request->get['expense_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		// 	$expense_products = $this->model_sale_expense->getExpenseProducts($this->request->get['expense_id']);
		// } else {
		// 	$expense_products = array();
		// }

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->request->get['expense_id'])) {
			$this->data['expense_id'] = $this->request->get['expense_id'];
		} else {
			$this->data['expense_id'] = 0;
		}

		if (isset($this->request->post['date_expensed'])) {
			$this->data['date_expensed'] = $this->request->post['date_expensed'];
		} elseif (!empty($expense_info)) {
			$this->data['date_expensed'] = $expense_info['date_expensed'];
		} else {
			$this->data['date_expensed'] = '';
		}

		if (isset($this->request->post['total'])) {
			$this->data['total'] = $this->request->post['total'];
		} elseif (!empty($expense_info)) {
			$this->data['total'] = $expense_info['total'];
		} else {
			$this->data['total'] = '';
		}

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		$this->data['stores'] = $stores;

		$this->load->model('user/user');

		$this->data['users'] = $this->model_user_user->getUsers();

		// if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
		// 	$this->data['store_url'] = HTTPS_CATALOG;
		// } else {
		// 	$this->data['store_url'] = HTTP_CATALOG;
		// }

		$this->load->model('user/user');
		$user = $this->model_user_user->getUser($this->user->getId());

// $this->load->test($this->request->post);
		if (isset($this->request->post['user_id'])) {
			$this->data['defaultuser'] = $this->request->post['user_id'];
		} elseif (!empty($expense_info)) {
			$this->data['defaultuser'] = $expense_info['user_id'];
		// } else if (isset($user['user_id'])) {
			// $this->data['defaultuser'] = $user['user_id'];			
		} else {
			$this->data['defaultuser'] = '';
		}

		if (isset($this->request->post['store_id'])) {
			$this->data['defaultstore'] = $this->request->post['store_id'];
		} elseif (!empty($expense_info)) {
			$this->data['defaultstore'] = $expense_info['store_id'];
			// } else if (isset($user['store_id'])) {
			// $this->data['store_id'] = $user['store_id'];
		} else {
			$this->data['defaultstore'] = '';
		}

		// if (isset($this->request->post['expense_status_id'])) {
		// 	$this->data['expense_status_id'] = $this->request->post['expense_status_id'];
		// } elseif (!empty($expense_info)) {
		// 	$this->data['expense_status_id'] = $expense_info['expense_status_id'];
		// } else {
		// 	$this->data['expense_status_id'] = '';
		// }

		if (isset($this->request->post['message'])) {
			$this->data['message'] = $this->request->post['message'];
		} elseif (!empty($expense_info)) {
			$this->data['message'] = $expense_info['message'];
		} else {
			$this->data['message'] = '';
		}

		if (isset($this->request->post['date_expensed'])) {
			$this->data['date_expensed'] = $this->request->post['date_expensed'];
		} elseif (!empty($expense_info)) {
			$this->data['date_expensed'] = $expense_info['date_expensed'];
		} else {
			$this->data['date_expensed'] = '';
		}

		// $this->load->model('catalog/product');

		// $this->document->addScript('view/javascript/jquery/ajaxupload.js');

		// $this->data['expenses'] = array();

		// if (isset($this->request->post['expense'])) {
		// 	$expense = $this->request->post['expense'];
		// } elseif (isset($this->request->get['expense_id'])) {
		// 	$expense = $this->model_sale_expense->getExpense($this->request->get['expense_id']);
		// } else {
		// 	$expense = array();
		// }


		// foreach ($expenses as $expense) {

			// $this->data['expense'] = $expense;
		// }

		$this->template = 'sale/expense_form.tpl';
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

		// foreach ($this->request->post['expense_product'] as $key => $expense_product) {
		// 	if ($expense_product['quantity'] <= 0) $this->error['quantity'] = $this->language->get('error_warning');
		// 	if ($expense_product['cost'] <= 0) $this->error['cost'] = $this->language->get('error_warning');
		// }
		$this->language->load('sale/customer');

		if (!$this->user->hasPermission('modify', 'sale/expense')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (utf8_strlen($this->request->post['user_id']) <= 0) {
			$this->error['user'] = $this->language->get('error_user');
		}

		if (!$this->validateDate($this->request->post['date_expensed'])) {
			$this->error['date'] = $this->language->get('error_date');
		}

		if (utf8_strlen($this->request->post['store_id']) <= 0) {
			$this->error['store'] = $this->language->get('error_store');
		}

		if (utf8_strlen($this->request->post['message']) <= 5) {
			$this->error['message'] = $this->language->get('error_message');
		}

		if (!$this->user->hasPermission('modifystore', $this->request->post['store_id'])) {
			$this->error['warning'] = $this->language->get('error_store_permission');
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
		if (!$this->user->hasPermission('modify', 'sale/expense')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}


}
?>