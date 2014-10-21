<?php
class ControllerReportUserBonus extends Controller {
	public function index() {     

		$this->language->load('report/user_bonus');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_doctor_id'])) {
			$filter_doctor_id = $this->request->get['filter_doctor_id'];
		} else {
			$filter_doctor_id = '';
		}

		if (isset($this->request->get['filter_outsource_id'])) {
			$filter_outsource_id = $this->request->get['filter_outsource_id'];
		} else {
			$filter_outsource_id = '';
		}

		if (isset($this->request->get['filter_consultant_id'])) {
			$filter_consultant_id = $this->request->get['filter_consultant_id'];
		} else {
			$filter_consultant_id = '';
		}

		if (isset($this->request->get['filter_beauty_id'])) {
			$filter_beauty_id = $this->request->get['filter_beauty_id'];
		} else {
			$filter_beauty_id = '';
		}


		if (isset($this->request->get['filter_doctor'])) {
			$filter_doctor = $this->request->get['filter_doctor'];
		} else {
			$filter_doctor = '';
		}

		if (isset($this->request->get['filter_outsource'])) {
			$filter_outsource = $this->request->get['filter_outsource'];
		} else {
			$filter_outsource = '';
		}

		if (isset($this->request->get['filter_consultant'])) {
			$filter_consultant = $this->request->get['filter_consultant'];
		} else {
			$filter_consultant = '';
		}

		if (isset($this->request->get['filter_beauty'])) {
			$filter_beauty = $this->request->get['filter_beauty'];
		} else {
			$filter_beauty = '';
		}

		if (isset($this->request->get['filter_date_start'])) {
			$filter_date_start = $this->request->get['filter_date_start'];
		} else {
			$filter_date_start = '';
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = '';
		}
// $this->load->test($this->request->get);
		// if (isset($this->request->get['filter_order_status_id'])) {
		// 	$filter_order_status_id = $this->request->get['filter_order_status_id'];
		// } else {
		// 	$filter_order_status_id = 0;
		// }	

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		// if (isset($this->request->get['filter_date_start'])) {
		// 	$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		// }

		// if (isset($this->request->get['filter_date_end'])) {
		// 	$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		// }

		// if (isset($this->request->get['filter_order_status_id'])) {
		// 	$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
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
			'href'      => $this->url->link('report/customer_order', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->load->model('report/user');

		$this->data['customers'] = array();

		$data = array(
			'filter_doctor_id'	     => $filter_doctor_id, 
			'filter_beauty_id'	     => $filter_beauty_id, 
			'filter_consultant_id'	 => $filter_consultant_id, 
			'filter_outsource_id'    => $filter_outsource_id, 
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end, 
			// 'filter_order_status_id' => $filter_order_status_id,
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$results = $this->model_report_user->getBonuses($data);

		foreach ($results as $result) {
			$bonus[$result['doctor_id']] = (isset($bonus[$result['doctor_id']]) ? $bonus[$result['doctor_id']] + $result['bonus_doctor'] : $result['bonus_doctor']);
			$bonus[$result['consultant_id']] = (isset($bonus[$result['consultant_id']]) ? $bonus[$result['consultant_id']] + $result['bonus_consultant'] : $result['bonus_consultant']);
			$bonus[$result['beauty_id']] = (isset($bonus[$result['beauty_id']]) ? $bonus[$result['beauty_id']] + $result['bonus_beauty'] : $result['bonus_beauty']);
			$bonus[$result['outsource_id']] = (isset($bonus[$result['outsource_id']]) ? $bonus[$result['outsource_id']] + $result['bonus_outsource'] : $result['bonus_outsource']);
		}

		$this->load->model('user/user');
		$this->data['users'] = array();


		foreach ($bonus as $user_id => $bonus) {

			$transactions = array();

			if ($user_id == 0) continue;

			if ($filter_doctor_id && $filter_doctor_id != $user_id) {
				continue;
			}

			if ($filter_consultant_id && $filter_consultant_id != $user_id) {
				continue;
			}

			if ($filter_outsource_id && $filter_outsource_id != $user_id) {
				continue;
			}

			if ($filter_beauty_id && $filter_beauty_id != $user_id) {
				continue;
			}

			$user_info = $this->model_user_user->getUser($user_id);
			$this->load->model('catalog/product');
			$this->load->model('sale/customer');

			foreach ($results as $result){
				$customer = $this->model_sale_customer->getCustomer($result['customer_id']);
					$product = $this->model_catalog_product->getProduct($result['product_id']);

				$date_modified = explode(' ', $result['date_modified'])[0];

				if ($result['doctor_id'] == $user_id) {

					$transactions[] = array(
						'date_modified' => $date_modified,
						'customer_id' => $result['customer_id'],
						'customer_name' => $customer['fullname'],
						'product_id' => $result['product_id'],
						'product_name' => $product['name'],
						'customer_transaction_id' => $result['customer_transaction_id'],
						'bonus' => $result['bonus_doctor']
					);
				}

				if ($result['consultant_id'] == $user_id) {
					
					$transactions[] = array(
						'date_modified' => $date_modified,
						'customer_id' => $result['customer_id'],
						'customer_name' => $customer['fullname'],
						'product_id' => $result['product_id'],
						'product_name' => $product['name'],
						'customer_transaction_id' => $result['customer_transaction_id'],
						'bonus' => $result['bonus_consultant']
					);
				}

				if ($result['beauty_id'] == $user_id) {

					$transactions[] = array(
						'date_modified' => $date_modified,
						'customer_id' => $result['customer_id'],
						'customer_name' => $customer['fullname'],
						'product_id' => $result['product_id'],
						'product_name' => $product['name'],
						'customer_transaction_id' => $result['customer_transaction_id'],
						'bonus' => $result['bonus_beauty']
					);
				}

				if ($result['outsource_id'] == $user_id) {

					$transactions[] = array(
						'date_modified' => $date_modified,
						'customer_id' => $result['customer_id'],
						'customer_name' => $customer['fullname'],
						'product_id' => $result['product_id'],
						'product_name' => $product['name'],
						'customer_transaction_id' => $result['customer_transaction_id'],
						'bonus' => $result['bonus_outsource']
					);
				}
			}

			$this->data['users'][] = array(
				'user_id'       => $user_id,
				'name'       => $user_info['fullname'],
				'bonus'       => $bonus, 
				'transactions' => $transactions
			);
		}
		// $this->load->test($results);
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_bonus'] = $this->language->get('column_bonus');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_all_status'] = $this->language->get('text_all_status');

		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_customer_group'] = $this->language->get('column_customer_group');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_orders'] = $this->language->get('column_orders');
		$this->data['column_products'] = $this->language->get('column_products');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_action'] = $this->language->get('column_action');

		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_outsource'] = $this->language->get('entry_outsource');
		$this->data['entry_consultant'] = $this->language->get('entry_consultant');
		$this->data['entry_doctor'] = $this->language->get('entry_doctor');
		$this->data['entry_beauty'] = $this->language->get('entry_beauty');
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_treatment'] = $this->language->get('entry_treatment');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_amount'] = $this->language->get('entry_amount');

		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/order_status');

		$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		// $url = '';

		// if (isset($this->request->get['filter_date_start'])) {
		// 	$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		// }

		// if (isset($this->request->get['filter_date_end'])) {
		// 	$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		// }

		// if (isset($this->request->get['filter_order_status_id'])) {
		// 	$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		// }

		// if (isset($this->request->get['filter_user_id'])) {
		// 	$url .= '&filter_user_id=' . $this->request->get['filter_user_id'];
		// }

		// $pagination = new Pagination();
		// $pagination->total = $customer_total;
		// $pagination->page = $page;
		// $pagination->limit = $this->config->get('config_admin_limit');
		// $pagination->text = $this->language->get('text_pagination');
		// $pagination->url = $this->url->link('report/customer_order', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		// $this->data['pagination'] = $pagination->render();

		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;		
		$this->data['filter_doctor_id'] = $filter_doctor_id;		
		$this->data['filter_doctor'] = $filter_doctor;		
		$this->data['filter_consultant_id'] = $filter_consultant_id;		
		$this->data['filter_consultant'] = $filter_consultant;		
		$this->data['filter_outsource_id'] = $filter_outsource_id;		
		$this->data['filter_outsource'] = $filter_outsource;		
		$this->data['filter_beauty_id'] = $filter_beauty_id;		
		$this->data['filter_beauty'] = $filter_beauty;		
		$this->data['filter_order_status_id'] = $filter_order_status_id;



		$this->template = 'report/user_bonus.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}
}
?>