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
		$this->language->load('catalog/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/expense');

		$this->data['is_insert'] = true;

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

			// if (isset($this->request->get['filter_date_modified'])) {
			// 	$url .= '&filter_date_modified=' . $this->request->get['filter_date_modified'];
			// }

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['expense'])) {
				$url .= '&expense=' . $this->request->get['expense'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->redirect($this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('catalog/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/expense');
		
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

			$this->redirect($this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->language->load('catalog/expense');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/expense');

		if (isset($this->request->post['selected']) && ($this->validateDelete())) {
			foreach ($this->request->post['selected'] as $expense_id) {

				if ($this->model_sale_expense->deleteexpense($expense_id, $this->request->post)) {
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

			$this->redirect($this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'));
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

		if (isset($this->request->get['filter_date_expensed'])) {
			$filter_date_expensed = $this->request->get['filter_date_expensed'];
		} else {
			$filter_date_expensed = null;
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

		if (isset($this->request->get['expense'])) {
			$expense = $this->request->get['expense'];
		} else {
			$expense = 'DESC';
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
			'href'      => $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->data['invoice'] = $this->url->link('catalog/expense/invoice', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['insert'] = $this->url->link('catalog/expense/insert', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['delete'] = $this->url->link('catalog/expense/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['expenses'] = array();

		$data = array(
			'filter_expense_id'        => $filter_expense_id,
			'filter_user'	     => $filter_user,
			'filter_store' 			=> $filter_store,
			'filter_total_min'           => $filter_total_min,
			'filter_total_max'           => $filter_total_max,
			'filter_date_expensed'      => $filter_date_expensed,
			'filter_date_added'      => $filter_date_added,
			// 'filter_date_modified'   => $filter_date_modified,
			'sort'                   => $sort,
			'expense'                  => $expense, // expense_id
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$expense_total = $this->model_sale_expense->getTotalExpenses($data);
		$results = $this->model_sale_expense->getExpenses($data);

		$this->load->model('user/user')	;

		$data = array();

		$users = $this->model_user_user->getUsers($data);

		$this->data['users'] = $users;

		$this->load->model('setting/store');
	
		$stores = $this->model_setting_store->getStores();
				
		$this->data['stores'] = $stores;		

		

		foreach ($results as $result) {
			$action = array();

			// $action[] = array(
			// 	'text' => $this->language->get('text_view'),
			// 	'href' => $this->url->link('catalog/expense/info', 'token=' . $this->session->data['token'] . '&expense_id=' . $result['expense_id'] . $url, 'SSL')
			// );

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/expense/update', 'token=' . $this->session->data['token'] . '&expense_id=' . $result['expense_id'] . $url, 'SSL')
			);

			// if (strtotime($result['date_expensed']) > strtotime('-' . (int)$this->config->get('config_expense_edit') . ' day')) {
			// 	$action[] = array(
			// 		'text' => $this->language->get('text_edit'),
			// 		'href' => $this->url->link('catalog/expense/update', 'token=' . $this->session->data['token'] . '&expense_id=' . $result['expense_id'] . $url, 'SSL')
			// 	);
			// }

			$userinfo = $this->model_user_user->getUser($result['user_id']);

			$storeinfo = $this->model_setting_store->getStore($result['store_id']);

			$this->data['expenses'][] = array(
				'expense_id'      => $result['expense_id'],
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

		if ($expense == 'ASC') {
			$url .= '&expense=DESC';
		} else {
			$url .= '&expense=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_expense'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=o.expense_id' . $url, 'SSL');
		$this->data['sort_customer'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=customer' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$this->data['sort_total'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=o.total' . $url, 'SSL');
		$this->data['sort_date_expensed'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=o.date_expensed' . $url, 'SSL');
		$this->data['sort_date_modified'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . '&sort=o.date_modified' . $url, 'SSL');
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
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_expense_id'] = $filter_expense_id;
		$this->data['filter_user'] = $filter_user;
		$this->data['filter_store'] = $filter_store;
		// $this->data['filter_expense_status_id'] = $filter_expense_status_id;
		$this->data['filter_total_min'] = $filter_total_min;
		$this->data['filter_total_max'] = $filter_total_max;
		$this->data['filter_date_expensed'] = $filter_date_expensed;
		$this->data['filter_date_added'] = $filter_date_added;
		// $this->data['filter_date_modified'] = $filter_date_modified;

		//$this->load->model('localisation/expense_status');

		//$this->data['expense_statuses'] = $this->model_localisation_expense_status->getExpensestatuses();

		$this->data['sort'] = $sort;
		$this->data['expense'] = $expense;

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

		if (isset($this->error['quantity'])) {
			$this->data['error_quantity'] = $this->error['quantity'];
		} else {
			$this->data['error_quantity'] = '';
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
			'href'      => $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		if (!isset($this->request->get['expense_id'])) {
			$this->data['action'] = $this->url->link('catalog/expense/insert', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/expense/update', 'token=' . $this->session->data['token'] . '&expense_id=' . $this->request->get['expense_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL');

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

		$this->load->model('setting/store');

		$stores = $this->model_setting_store->getStores();

		$this->data['stores'] = $stores;
		
		// $user_store_permissions = json_decode($this->user->getStorePermission());
		
		// $this->data['stores'] = [];
		
		// foreach ($stores as $store) {
		// 	foreach ($user_store_permissions as $key => $value) {
		// 		if ($value == $store['store_id']) {
		// 			$this->data['stores'][] = $store;
					
		// 		}
		// 	}
		// }



		$this->load->model('user/user');

		$this->data['users'] = $this->model_user_user->getUsers();

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['store_url'] = HTTPS_CATALOG;
		} else {
			$this->data['store_url'] = HTTP_CATALOG;
		}

		$this->load->model('user/user');
		$user = $this->model_user_user->getUser($this->user->getId());

		// if (isset($this->request->get['filter_user'])) {
		// 	$filter_user = $this->request->get['filter_user'];
		// } else if (isset($user['user_id'])) {
		// 	$filter_store = $user['user_id'];			
		// } else {
		// 	$filter_user = null;
		// }


		// if (isset($this->request->get['filter_store'])) {
		// 	$filter_store = $this->request->get['filter_store'];
		// } else if (isset($user['store_id'])) {
		// 	$filter_store = $user['store_id'];
		// } else {
		// 	$filter_store = null;
		// }


		if (isset($this->request->post['user_id'])) {
			$this->data['user_id'] = $this->request->post['user_id'];
		} elseif (!empty($expense_info)) {
			$this->data['user_id'] = $expense_info['user_id'];
			} else if (isset($user['user_id'])) {
			$this->data['user_id'] = $user['user_id'];			
		} else {
			$this->data['user_id'] = '';
		}

		if (isset($this->request->post['store_id'])) {
			$this->data['store_id'] = $this->request->post['store_id'];
		} elseif (!empty($expense_info)) {
			$this->data['store_id'] = $expense_info['store_id'];
			} else if (isset($user['store_id'])) {
			$this->data['store_id'] = $user['store_id'];
		} else {
			$this->data['store_id'] = '';
		}

		if (isset($this->request->post['expense_status_id'])) {
			$this->data['expense_status_id'] = $this->request->post['expense_status_id'];
		} elseif (!empty($expense_info)) {
			$this->data['expense_status_id'] = $expense_info['expense_status_id'];
		} else {
			$this->data['expense_status_id'] = '';
		}

		$this->load->model('localisation/expense_status');

		$this->data['expense_statuses'] = $this->model_localisation_expense_status->getExpensestatuses();

		if (isset($this->request->post['comment'])) {
			$this->data['comment'] = $this->request->post['comment'];
		} elseif (!empty($expense_info)) {
			$this->data['comment'] = $expense_info['comment'];
		} else {
			$this->data['comment'] = '';
		}

		$this->load->model('catalog/product');

		$this->document->addScript('view/javascript/jquery/ajaxupload.js');

		$this->data['expense_products'] = array();

		if (isset($this->request->post['expense_product'])) {
			$expense_products = $this->request->post['expense_product'];
		} elseif (isset($this->request->get['expense_id'])) {
			$expense_products = $this->model_sale_expense->getExpenseProducts($this->request->get['expense_id']);
		} else {
			$expense_products = array();
		}


		foreach ($expense_products as $expense_product) {

			$this->data['expense_products'][] = array(
				'expense_product_id' => $expense_product['expense_product_id'],
				'product_id'       => $expense_product['product_id'],
				'name'             => $expense_product['name'],
				'quantity'         => $expense_product['quantity'],
				'cost'            => $expense_product['cost'],
				'total'            => $expense_product['quantity'] * $expense_product['cost'], //$expense_product['total']
				// 'tax'              => $expense_product['tax'],
				// 'reward'           => $expense_product['reward']
			);
		}

		$this->load->model('tool/image'); 

		if (isset($this->request->post['image1'])) {
			$this->data['image1'] = $this->request->post['image1'];
			$this->data['thumb1'] = $this->model_tool_image->resize($this->data['image1'], 100, 100);
		} elseif (!empty($expense_info)) {
			$this->data['image1'] = $expense_info['image1'];
			$this->data['thumb1'] = $this->model_tool_image->resize($this->data['image1'], 100, 100);
		} else {
			$this->data['image1'] = '';
			$this->data['thumb1'] = '';
		}

		if (isset($this->request->post['image2'])) {
			$this->data['image2'] = $this->request->post['image2'];
			$this->data['thumb2'] = $this->model_tool_image->resize($this->data['image2'], 100, 100);
		} elseif (!empty($expense_info)) {
			$this->data['image2'] = $expense_info['image2'];
			$this->data['thumb2'] = $this->model_tool_image->resize($this->data['image2'], 100, 100);
		} else {
			$this->data['image2'] = '';
			$this->data['thumb2'] = '';
		}

		if (isset($this->request->post['image3'])) {
			$this->data['image3'] = $this->request->post['image3'];
			$this->data['thumb3'] = $this->model_tool_image->resize($this->data['image3'], 100, 100);
		} elseif (!empty($expense_info)) {
			$this->data['image3'] = $expense_info['image3'];
			$this->data['thumb3'] = $this->model_tool_image->resize($this->data['image3'], 100, 100);
		} else {
			$this->data['image3'] = '';
			$this->data['thumb3'] = '';
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		// if (isset($this->request->post['expense_total'])) {
		// 	$this->data['expense_totals'] = $this->request->post['expense_total'];
		// } elseif (isset($this->request->get['expense_id'])) {
		// 	$this->data['expense_totals'] = $this->model_sale_expense->getexpenseTotals($this->request->get['expense_id']);
		// } else {
		// 	$this->data['expense_totals'] = array();
		// }



		$this->template = 'catalog/expense_form.tpl';
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

		foreach ($this->request->post['expense_product'] as $key => $expense_product) {
			if ($expense_product['quantity'] <= 0) $this->error['quantity'] = $this->language->get('error_warning');
			if ($expense_product['cost'] <= 0) $this->error['cost'] = $this->language->get('error_warning');
		}

		if (!$this->user->hasPermission('modify', 'catalog/expense')) {
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
		if (!$this->user->hasPermission('modify', 'catalog/expense')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
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

	public function info() {
		$this->load->model('catalog/expense');

		if (isset($this->request->get['expense_id'])) {
			$expense_id = $this->request->get['expense_id'];
		} else {
			$expense_id = 0;
		}

		$expense_info = $this->model_sale_expense->getExpense($expense_id);

		if ($expense_info) {
			$this->language->load('catalog/expense');

			$this->document->setTitle($this->language->get('heading_title'));

			$this->data['heading_title'] = $this->language->get('heading_title');
			$this->data['button_remove'] = $this->language->get('button_remove');
			$this->data['button_add_product_quantity'] = $this->language->get('button_add_product_quantity');
			$this->data['entry_product'] = $this->language->get('entry_product');
			$this->data['entry_quantity'] = $this->language->get('entry_quantity');

			$this->data['text_amazon_expense_id'] = $this->language->get('text_amazon_expense_id');
			$this->data['text_name'] = $this->language->get('text_name');
			$this->data['text_expense_id'] = $this->language->get('text_expense_id');
			$this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
			$this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
			$this->data['text_store_name'] = $this->language->get('text_store_name');
			$this->data['text_store_url'] = $this->language->get('text_store_url');
			$this->data['text_customer'] = $this->language->get('text_customer');
			$this->data['text_customer_group'] = $this->language->get('text_customer_group');
			$this->data['text_email'] = $this->language->get('text_email');
			$this->data['text_telephone'] = $this->language->get('text_telephone');
			$this->data['text_fax'] = $this->language->get('text_fax');
			$this->data['text_total'] = $this->language->get('text_total');
			$this->data['text_reward'] = $this->language->get('text_reward');
			$this->data['text_expense_status'] = $this->language->get('text_expense_status');
			$this->data['text_comment'] = $this->language->get('text_comment');
			$this->data['text_affiliate'] = $this->language->get('text_affiliate');
			$this->data['text_commission'] = $this->language->get('text_commission');
			$this->data['text_ip'] = $this->language->get('text_ip');
			$this->data['text_forwarded_ip'] = $this->language->get('text_forwarded_ip');
			$this->data['text_user_agent'] = $this->language->get('text_user_agent');
			$this->data['text_accept_language'] = $this->language->get('text_accept_language');
			$this->data['text_date_expensed'] = $this->language->get('text_date_expensed');
			$this->data['text_date_modified'] = $this->language->get('text_date_modified');
			$this->data['text_firstname'] = $this->language->get('text_firstname');
			$this->data['text_lastname'] = $this->language->get('text_lastname');
			$this->data['text_company'] = $this->language->get('text_company');
			$this->data['text_company_id'] = $this->language->get('text_company_id');
			$this->data['text_tax_id'] = $this->language->get('text_tax_id');
			$this->data['text_address_1'] = $this->language->get('text_address_1');
			$this->data['text_address_2'] = $this->language->get('text_address_2');
			$this->data['text_city'] = $this->language->get('text_city');
			$this->data['text_postcode'] = $this->language->get('text_postcode');
			$this->data['text_zone'] = $this->language->get('text_zone');
			$this->data['text_zone_code'] = $this->language->get('text_zone_code');
			$this->data['text_country'] = $this->language->get('text_country');
			$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');
			$this->data['text_payment_method'] = $this->language->get('text_payment_method');
			$this->data['text_download'] = $this->language->get('text_download');
			$this->data['text_wait'] = $this->language->get('text_wait');
			$this->data['text_generate'] = $this->language->get('text_generate');
			$this->data['text_reward_add'] = $this->language->get('text_reward_add');
			$this->data['text_reward_remove'] = $this->language->get('text_reward_remove');
			$this->data['text_commission_add'] = $this->language->get('text_commission_add');
			$this->data['text_commission_remove'] = $this->language->get('text_commission_remove');
			$this->data['text_credit_add'] = $this->language->get('text_credit_add');
			$this->data['text_credit_remove'] = $this->language->get('text_credit_remove');
			$this->data['text_country_match'] = $this->language->get('text_country_match');
			$this->data['text_country_code'] = $this->language->get('text_country_code');
			$this->data['text_high_risk_country'] = $this->language->get('text_high_risk_country');
			$this->data['text_distance'] = $this->language->get('text_distance');
			$this->data['text_ip_region'] = $this->language->get('text_ip_region');
			$this->data['text_ip_city'] = $this->language->get('text_ip_city');
			$this->data['text_ip_latitude'] = $this->language->get('text_ip_latitude');
			$this->data['text_ip_longitude'] = $this->language->get('text_ip_longitude');
			$this->data['text_ip_isp'] = $this->language->get('text_ip_isp');
			$this->data['text_ip_org'] = $this->language->get('text_ip_org');
			$this->data['text_ip_asnum'] = $this->language->get('text_ip_asnum');
			$this->data['text_ip_user_type'] = $this->language->get('text_ip_user_type');
			$this->data['text_ip_country_confidence'] = $this->language->get('text_ip_country_confidence');
			$this->data['text_ip_region_confidence'] = $this->language->get('text_ip_region_confidence');
			$this->data['text_ip_city_confidence'] = $this->language->get('text_ip_city_confidence');
			$this->data['text_ip_postal_confidence'] = $this->language->get('text_ip_postal_confidence');
			$this->data['text_ip_postal_code'] = $this->language->get('text_ip_postal_code');
			$this->data['text_ip_accuracy_radius'] = $this->language->get('text_ip_accuracy_radius');
			$this->data['text_ip_net_speed_cell'] = $this->language->get('text_ip_net_speed_cell');
			$this->data['text_ip_metro_code'] = $this->language->get('text_ip_metro_code');
			$this->data['text_ip_area_code'] = $this->language->get('text_ip_area_code');
			$this->data['text_ip_time_zone'] = $this->language->get('text_ip_time_zone');
			$this->data['text_ip_region_name'] = $this->language->get('text_ip_region_name');
			$this->data['text_ip_domain'] = $this->language->get('text_ip_domain');
			$this->data['text_ip_country_name'] = $this->language->get('text_ip_country_name');
			$this->data['text_ip_continent_code'] = $this->language->get('text_ip_continent_code');
			$this->data['text_ip_corporate_proxy'] = $this->language->get('text_ip_corporate_proxy');
			$this->data['text_anonymous_proxy'] = $this->language->get('text_anonymous_proxy');
			$this->data['text_proxy_score'] = $this->language->get('text_proxy_score');
			$this->data['text_is_trans_proxy'] = $this->language->get('text_is_trans_proxy');
			$this->data['text_free_mail'] = $this->language->get('text_free_mail');
			$this->data['text_carder_email'] = $this->language->get('text_carder_email');
			$this->data['text_high_risk_username'] = $this->language->get('text_high_risk_username');
			$this->data['text_high_risk_password'] = $this->language->get('text_high_risk_password');
			$this->data['text_bin_match'] = $this->language->get('text_bin_match');
			$this->data['text_bin_country'] = $this->language->get('text_bin_country');
			$this->data['text_bin_name_match'] = $this->language->get('text_bin_name_match');
			$this->data['text_bin_name'] = $this->language->get('text_bin_name');
			$this->data['text_bin_phone_match'] = $this->language->get('text_bin_phone_match');
			$this->data['text_bin_phone'] = $this->language->get('text_bin_phone');
			$this->data['text_customer_phone_in_billing_location'] = $this->language->get('text_customer_phone_in_billing_location');
			$this->data['text_ship_forward'] = $this->language->get('text_ship_forward');
			$this->data['text_city_postal_match'] = $this->language->get('text_city_postal_match');
			$this->data['text_ship_city_postal_match'] = $this->language->get('text_ship_city_postal_match');
			$this->data['text_score'] = $this->language->get('text_score');
			$this->data['text_explanation'] = $this->language->get('text_explanation');
			$this->data['text_risk_score'] = $this->language->get('text_risk_score');
			$this->data['text_queries_remaining'] = $this->language->get('text_queries_remaining');
			$this->data['text_maxmind_id'] = $this->language->get('text_maxmind_id');
			$this->data['text_error'] = $this->language->get('text_error');

			$this->data['column_product'] = $this->language->get('column_product');
			$this->data['column_model'] = $this->language->get('column_model');
			$this->data['column_quantity'] = $this->language->get('column_quantity');
			$this->data['column_price'] = $this->language->get('column_price');
			$this->data['column_total'] = $this->language->get('column_total');
			$this->data['column_download'] = $this->language->get('column_download');
			$this->data['column_filename'] = $this->language->get('column_filename');
			$this->data['column_remaining'] = $this->language->get('column_remaining');
			$this->data['column_cost'] = $this->language->get('column_cost');

			$this->data['entry_expense_status'] = $this->language->get('entry_expense_status');
			$this->data['entry_notify'] = $this->language->get('entry_notify');
			$this->data['entry_comment'] = $this->language->get('entry_comment');

			$this->data['button_invoice'] = $this->language->get('button_invoice');
			$this->data['button_cancel'] = $this->language->get('button_cancel');
			$this->data['button_add_history'] = $this->language->get('button_add_history');

			$this->data['tab_expense'] = $this->language->get('tab_expense');
			$this->data['tab_payment'] = $this->language->get('tab_payment');
			$this->data['tab_shipping'] = $this->language->get('tab_shipping');
			$this->data['tab_product'] = $this->language->get('tab_product');
			$this->data['tab_history'] = $this->language->get('tab_history');
			$this->data['tab_data'] = $this->language->get('tab_data');
			$this->data['tab_fraud'] = $this->language->get('tab_fraud');

			$this->data['token'] = $this->session->data['token'];

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
				'href'      => $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL'),
				'separator' => ' :: '
			);

			$this->data['invoice'] = $this->url->link('catalog/expense/invoice', 'token=' . $this->session->data['token'] . '&expense_id=' . (int)$this->request->get['expense_id'], 'SSL');
			$this->data['cancel'] = $this->url->link('catalog/expense', 'token=' . $this->session->data['token'] . $url, 'SSL');

			$this->data['expense_id'] = $this->request->get['expense_id'];

			if ($expense_info['invoice_no']) {
				$this->data['invoice_no'] = $expense_info['invoice_prefix'] . $expense_info['invoice_no'];
			} else {
				$this->data['invoice_no'] = '';
			}

			$this->data['amazon_expense_id'] = $expense_info['amazon_expense_id'];
			$this->data['store_name'] = $expense_info['store_name'];
			$this->data['store_url'] = $expense_info['store_url'];
			$this->data['firstname'] = $expense_info['firstname'];
			$this->data['lastname'] = $expense_info['lastname'];

			if ($expense_info['customer_id']) {
				$this->data['customer'] = $this->url->link('sale/customer/update', 'token=' . $this->session->data['token'] . '&customer_id=' . $expense_info['customer_id'], 'SSL');
			} else {
				$this->data['customer'] = '';
			}

			$this->load->model('sale/customer_group');

			$customer_group_info = $this->model_sale_customer_group->getCustomerGroup($expense_info['customer_group_id']);

			if ($customer_group_info) {
				$this->data['customer_group'] = $customer_group_info['name'];
			} else {
				$this->data['customer_group'] = '';
			}

			$this->data['email'] = $expense_info['email'];
			$this->data['telephone'] = $expense_info['telephone'];
			$this->data['fax'] = $expense_info['fax'];
			$this->data['comment'] = nl2br($expense_info['comment']);
			$this->data['shipping_method'] = $expense_info['shipping_method'];
			$this->data['payment_method'] = $expense_info['payment_method'];
			$this->data['total'] = $this->currency->format($expense_info['total'], $expense_info['currency_code'], $expense_info['currency_value']);

			if ($expense_info['total'] < 0) {
				$this->data['credit'] = $expense_info['total'];
			} else {
				$this->data['credit'] = 0;
			}

			$this->load->model('sale/customer');
			
			$this->load->model('localisation/expense_status');

			$expense_status_info = $this->model_localisation_expense_status->getExpensestatus($expense_info['expense_status_id']);

			if ($expense_status_info) {
				$this->data['expense_status'] = $expense_status_info['name'];
			} else {
				$this->data['expense_status'] = '';
			}

			$this->data['ip'] = $expense_info['ip'];
			$this->data['forwarded_ip'] = $expense_info['forwarded_ip'];
			$this->data['user_agent'] = $expense_info['user_agent'];
			$this->data['accept_language'] = $expense_info['accept_language'];
			$this->data['date_expensed'] = $expense_info['date_expensed']; //date($this->language->get('date_format_short'), strtotime($expense_info['date_expensed']));
			$this->data['date_modified'] = $expense_info['date_modified']; //date($this->language->get('date_format_short'), strtotime($expense_info['date_modified']));
			$this->data['payment_firstname'] = $expense_info['payment_firstname'];
			$this->data['payment_lastname'] = $expense_info['payment_lastname'];
			$this->data['payment_company'] = $expense_info['payment_company'];
			$this->data['payment_company_id'] = $expense_info['payment_company_id'];
			$this->data['payment_tax_id'] = $expense_info['payment_tax_id'];
			$this->data['payment_address_1'] = $expense_info['payment_address_1'];
			$this->data['payment_address_2'] = $expense_info['payment_address_2'];
			$this->data['payment_city'] = $expense_info['payment_city'];
			$this->data['payment_postcode'] = $expense_info['payment_postcode'];
			$this->data['payment_zone'] = $expense_info['payment_zone'];
			$this->data['payment_zone_code'] = $expense_info['payment_zone_code'];
			$this->data['payment_country'] = $expense_info['payment_country'];
			$this->data['shipping_firstname'] = $expense_info['shipping_firstname'];
			$this->data['shipping_lastname'] = $expense_info['shipping_lastname'];
			$this->data['shipping_company'] = $expense_info['shipping_company'];
			$this->data['shipping_address_1'] = $expense_info['shipping_address_1'];
			$this->data['shipping_address_2'] = $expense_info['shipping_address_2'];
			$this->data['shipping_city'] = $expense_info['shipping_city'];
			$this->data['shipping_postcode'] = $expense_info['shipping_postcode'];
			$this->data['shipping_zone'] = $expense_info['shipping_zone'];
			$this->data['shipping_zone_code'] = $expense_info['shipping_zone_code'];
			$this->data['shipping_country'] = $expense_info['shipping_country'];

			$this->data['products'] = array();

			$products = $this->model_sale_expense->getexpenseProducts($this->request->get['expense_id']);

			foreach ($products as $product) {
				$option_data = array();

				$options = $this->model_sale_expense->getexpenseOptions($this->request->get['expense_id'], $product['expense_product_id']);

				foreach ($options as $option) {
					if ($option['type'] != 'file') {
						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $option['value'],
							'type'  => $option['type']
						);
					} else {
						$option_data[] = array(
							'name'  => $option['name'],
							'value' => utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.')),
							'type'  => $option['type'],
							'href'  => $this->url->link('catalog/expense/download', 'token=' . $this->session->data['token'] . '&expense_id=' . $this->request->get['expense_id'] . '&expense_option_id=' . $option['expense_option_id'], 'SSL')
						);
					}
				}

				$this->data['products'][] = array(
					'expense_product_id' => $product['expense_product_id'],
					'product_id'       => $product['product_id'],
					'name'    	 	   => $product['name'],
					'model'    		   => $product['model'],
					'option'   		   => $option_data,
					'quantity'		   => $product['quantity'],
					'price'    		   => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $expense_info['currency_code'], $expense_info['currency_value']),
					'total'    		   => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $expense_info['currency_code'], $expense_info['currency_value']),
					'href'     		   => $this->url->link('catalog/product/update', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], 'SSL')
				);
			}

			
			$this->data['totals'] = $this->model_sale_expense->getexpenseTotals($this->request->get['expense_id']);

			$this->data['expense_statuses'] = $this->model_localisation_expense_status->getExpensestatuses();

			$this->data['expense_status_id'] = $expense_info['expense_status_id'];

			if($this->hasAction('payment/' . $expense_info['payment_code'] . '/expenseAction') == true){
				$this->data['payment_action'] = $this->getChild('payment/' . $expense_info['payment_code'] . '/expenseAction');
			}else{
				$this->data['payment_action'] = '';
			}

			$this->template = 'catalog/expense_info.tpl';
			$this->children = array(
				'common/header',
				'common/footer'
			);

			$this->response->setOutput($this->render());
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

	public function createInvoiceNo() {
		$this->language->load('catalog/expense');

		$json = array();

		if (!$this->user->hasPermission('modify', 'catalog/expense')) {
			$json['error'] = $this->language->get('error_permission');
		} elseif (isset($this->request->get['expense_id'])) {
			$this->load->model('catalog/expense');

			$invoice_no = $this->model_sale_expense->createInvoiceNo($this->request->get['expense_id']);

			if ($invoice_no) {
				$json['invoice_no'] = $invoice_no;
			} else {
				$json['error'] = $this->language->get('error_action');
			}
		}

		$this->response->setOutput(json_encode($json));
	}


	public function history() {
		$this->language->load('catalog/expense');

		$this->data['error'] = '';
		$this->data['success'] = '';

		$this->load->model('catalog/expense');

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!$this->user->hasPermission('modify', 'catalog/expense')) {
				$this->data['error'] = $this->language->get('error_permission');
			}

			if (!$this->data['error']) {
				$this->model_sale_expense->addExpenseHistory($this->request->get['expense_id'], $this->request->post);

				$this->data['success'] = $this->language->get('text_success');
			}
		}

		$this->data['text_no_results'] = $this->language->get('text_no_results');

		$this->data['column_date_expensed'] = $this->language->get('column_date_expensed');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_notify'] = $this->language->get('column_notify');
		$this->data['column_comment'] = $this->language->get('column_comment');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$this->data['histories'] = array();

		$results = $this->model_sale_expense->getexpenseHistories($this->request->get['expense_id'], ($page - 1) * 10, 10);

		foreach ($results as $result) {
			$this->data['histories'][] = array(
				'notify'     => $result['notify'] ? $this->language->get('text_yes') : $this->language->get('text_no'),
				'status'     => $result['status'],
				'comment'    => nl2br($result['comment']),
				'date_expensed' => date($this->language->get('date_format_short'), strtotime($result['date_expensed']))
			);
		}

		$history_total = $this->model_sale_expense->getTotalexpenseHistories($this->request->get['expense_id']);

		$pagination = new Pagination();
		$pagination->total = $history_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/expense/history', 'token=' . $this->session->data['token'] . '&expense_id=' . $this->request->get['expense_id'] . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->template = 'catalog/expense_history.tpl';

		$this->response->setOutput($this->render());
	}

	public function upload() {
		$this->language->load('catalog/expense');

		$json = array();

		if ($this->request->server['REQUEST_METHOD'] == 'POST') {
			if (!empty($this->request->files['file']['name'])) {
				$filename = html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8');

				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
					$json['error'] = $this->language->get('error_filename');
				}

				// Allowed file extension types
				$allowed = array();

				$filetypes = explode("\n", $this->config->get('config_file_extension_allowed'));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array(substr(strrchr($filename, '.'), 1), $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Allowed file mime types
				$allowed = array();

				$filetypes = explode("\n", $this->config->get('config_file_mime_allowed'));

				foreach ($filetypes as $filetype) {
					$allowed[] = trim($filetype);
				}

				if (!in_array($this->request->files['file']['type'], $allowed)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				// Check to see if any PHP files are trying to be uploaded
				$content = file_get_contents($this->request->files['file']['tmp_name']);

				if (preg_match('/\<\?php/i', $content)) {
					$json['error'] = $this->language->get('error_filetype');
				}

				if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {
					$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);
				}
			} else {
				$json['error'] = $this->language->get('error_upload');
			}

			if (!isset($json['error'])) {
				if (is_uploaded_file($this->request->files['file']['tmp_name']) && file_exists($this->request->files['file']['tmp_name'])) {
					$file = basename($filename) . '.' . md5(mt_rand());

					$json['file'] = $file;

					move_uploaded_file($this->request->files['file']['tmp_name'], DIR_DOWNLOAD . $file);
				}

				$json['success'] = $this->language->get('text_upload');
			}
		}

		$this->response->setOutput(json_encode($json));
	}

	public function invoice() {
		$this->language->load('catalog/expense');

		$this->data['title'] = $this->language->get('heading_title');

		if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1'))) {
			$this->data['base'] = HTTPS_SERVER;
		} else {
			$this->data['base'] = HTTP_SERVER;
		}

		$this->data['direction'] = $this->language->get('direction');
		$this->data['language'] = $this->language->get('code');

		$this->data['text_invoice'] = $this->language->get('text_invoice');

		$this->data['text_expense_id'] = $this->language->get('text_expense_id');
		$this->data['text_invoice_no'] = $this->language->get('text_invoice_no');
		$this->data['text_invoice_date'] = $this->language->get('text_invoice_date');
		$this->data['text_date_expensed'] = $this->language->get('text_date_expensed');
		$this->data['text_telephone'] = $this->language->get('text_telephone');
		$this->data['text_fax'] = $this->language->get('text_fax');
		$this->data['text_to'] = $this->language->get('text_to');
		$this->data['text_company_id'] = $this->language->get('text_company_id');
		$this->data['text_tax_id'] = $this->language->get('text_tax_id');
		$this->data['text_ship_to'] = $this->language->get('text_ship_to');
		$this->data['text_payment_method'] = $this->language->get('text_payment_method');
		$this->data['text_shipping_method'] = $this->language->get('text_shipping_method');

		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_model'] = $this->language->get('column_model');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_comment'] = $this->language->get('column_comment');

		$this->load->model('catalog/expense');

		$this->load->model('setting/setting');

		$this->data['expenses'] = array();

		$expenses = array();

		if (isset($this->request->post['selected'])) {
			$expenses = $this->request->post['selected'];
		} elseif (isset($this->request->get['expense_id'])) {
			$expenses[] = $this->request->get['expense_id'];
		}

		foreach ($expenses as $expense_id) {
			$expense_info = $this->model_sale_expense->getexpense($expense_id);

			if ($expense_info) {
				$store_info = $this->model_setting_setting->getSetting('config', $expense_info['store_id']);

				if ($store_info) {
					$store_address = $store_info['config_address'];
					$store_email = $store_info['config_email'];
					$store_telephone = $store_info['config_telephone'];
					$store_fax = $store_info['config_fax'];
				} else {
					$store_address = $this->config->get('config_address');
					$store_email = $this->config->get('config_email');
					$store_telephone = $this->config->get('config_telephone');
					$store_fax = $this->config->get('config_fax');
				}

				if ($expense_info['invoice_no']) {
					$invoice_no = $expense_info['invoice_prefix'] . $expense_info['invoice_no'];
				} else {
					$invoice_no = '';
				}

				if ($expense_info['shipping_address_format']) {
					$format = $expense_info['shipping_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $expense_info['shipping_firstname'],
					'lastname'  => $expense_info['shipping_lastname'],
					'company'   => $expense_info['shipping_company'],
					'address_1' => $expense_info['shipping_address_1'],
					'address_2' => $expense_info['shipping_address_2'],
					'city'      => $expense_info['shipping_city'],
					'postcode'  => $expense_info['shipping_postcode'],
					'zone'      => $expense_info['shipping_zone'],
					'zone_code' => $expense_info['shipping_zone_code'],
					'country'   => $expense_info['shipping_country']
				);

				$shipping_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				if ($expense_info['payment_address_format']) {
					$format = $expense_info['payment_address_format'];
				} else {
					$format = '{firstname} {lastname}' . "\n" . '{company}' . "\n" . '{address_1}' . "\n" . '{address_2}' . "\n" . '{city} {postcode}' . "\n" . '{zone}' . "\n" . '{country}';
				}

				$find = array(
					'{firstname}',
					'{lastname}',
					'{company}',
					'{address_1}',
					'{address_2}',
					'{city}',
					'{postcode}',
					'{zone}',
					'{zone_code}',
					'{country}'
				);

				$replace = array(
					'firstname' => $expense_info['payment_firstname'],
					'lastname'  => $expense_info['payment_lastname'],
					'company'   => $expense_info['payment_company'],
					'address_1' => $expense_info['payment_address_1'],
					'address_2' => $expense_info['payment_address_2'],
					'city'      => $expense_info['payment_city'],
					'postcode'  => $expense_info['payment_postcode'],
					'zone'      => $expense_info['payment_zone'],
					'zone_code' => $expense_info['payment_zone_code'],
					'country'   => $expense_info['payment_country']
				);

				$payment_address = str_replace(array("\r\n", "\r", "\n"), '<br />', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '<br />', trim(str_replace($find, $replace, $format))));

				$product_data = array();

				$products = $this->model_sale_expense->getexpenseProducts($expense_id);

				foreach ($products as $product) {
					$option_data = array();

					$options = $this->model_sale_expense->getexpenseOptions($expense_id, $product['expense_product_id']);

					foreach ($options as $option) {
						if ($option['type'] != 'file') {
							$value = $option['value'];
						} else {
							$value = utf8_substr($option['value'], 0, utf8_strrpos($option['value'], '.'));
						}

						$option_data[] = array(
							'name'  => $option['name'],
							'value' => $value
						);
					}

					$product_data[] = array(
						'name'     => $product['name'],
						'model'    => $product['model'],
						'option'   => $option_data,
						'quantity' => $product['quantity'],
						'price'    => $this->currency->format($product['price'] + ($this->config->get('config_tax') ? $product['tax'] : 0), $expense_info['currency_code'], $expense_info['currency_value']),
						'total'    => $this->currency->format($product['total'] + ($this->config->get('config_tax') ? ($product['tax'] * $product['quantity']) : 0), $expense_info['currency_code'], $expense_info['currency_value'])
					);
				}

				$voucher_data = array();

				$vouchers = $this->model_sale_expense->getexpenseVouchers($expense_id);

				foreach ($vouchers as $voucher) {
					$voucher_data[] = array(
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount'], $expense_info['currency_code'], $expense_info['currency_value'])
					);
				}

				$total_data = $this->model_sale_expense->getexpenseTotals($expense_id);

				$this->data['expenses'][] = array(
					'expense_id'	         => $expense_id,
					'invoice_no'         => $invoice_no,
					'date_expensed'         => date($this->language->get('date_format_short'), strtotime($expense_info['date_expensed'])),
					'store_name'         => $expense_info['store_name'],
					'store_url'          => rtrim($expense_info['store_url'], '/'),
					'store_address'      => nl2br($store_address),
					'store_email'        => $store_email,
					'store_telephone'    => $store_telephone,
					'store_fax'          => $store_fax,
					'email'              => $expense_info['email'],
					'telephone'          => $expense_info['telephone'],
					'shipping_address'   => $shipping_address,
					'shipping_method'    => $expense_info['shipping_method'],
					'payment_address'    => $payment_address,
					'payment_company_id' => $expense_info['payment_company_id'],
					'payment_tax_id'     => $expense_info['payment_tax_id'],
					'payment_method'     => $expense_info['payment_method'],
					'product'            => $product_data,
					'voucher'            => $voucher_data,
					'total'              => $total_data,
					'comment'            => nl2br($expense_info['comment'])
				);
			}
		}

		$this->template = 'catalog/expense_invoice.tpl';

		$this->response->setOutput($this->render());
	}

}
?>