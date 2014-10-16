<?php   
class ControllerSaleFollowup extends Controller {   
	public function index() {
		$this->language->load('common/home');

		$this->document->setTitle($this->language->get('heading_title'));


		if (isset($this->request->get['filter_date_start'])) {
			$filter_date_start= $this->request->get['filter_date_start'];
		} else {
			$filter_date_start = null;
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = null;
		}

		if (isset($this->request->get['filter_consultant'])) {
			$filter_consultant = $this->request->get['filter_consultant'];
		} else {
			$filter_consultant = null;
		}

		if (isset($this->request->get['filter_comment'])) {
			$filter_comment = $this->request->get['filter_comment'];
		} else {
			$filter_comment = null;
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = $this->request->get['filter_product_id'];
		} else {
			$filter_product_id = null;
		}

		if (isset($this->request->get['filter_treatment'])) {
			$filter_treatment = $this->request->get['filter_treatment'];
		} else {
			$filter_treatment = null;
		}

		if (isset($this->request->get['filter_reminder_status_id'])) {
			$filter_reminder_status_id = $this->request->get['filter_reminder_status_id'];
		} else {
			$filter_reminder_status_id = null;
		}
		
		if (isset($this->request->get['filter_user'])) {
			$filter_user = $this->request->get['filter_user'];
		} else {
			$filter_user = null;
		}

		if (isset($this->request->get['filter_user_id'])) {
			$filter_user_id = $this->request->get['filter_user_id'];
		} else {
			$filter_user_id = null;
		}


		if (isset($this->request->get['filter_customer'])) {
			$filter_customer = $this->request->get['filter_customer'];
		} else {
			$filter_customer = null;
		}

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

		$url = '';
		
		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . urlencode(html_entity_decode($this->request->get['filter_date_start'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . urlencode(html_entity_decode($this->request->get['filter_date_end'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_comment'])) {
			$url .= '&filter_comment=' . urlencode(html_entity_decode($this->request->get['filter_comment'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . (int)$this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_treatment'])) {
			$url .= '&filter_treatment=' . (int)$this->request->get['filter_treatment'];
		}

		if (isset($this->request->get['filter_user'])) {
			$url .= '&filter_user=' . $this->request->get['filter_user'];
		}

		if (isset($this->request->get['filter_user_id'])) {
			$url .= '&filter_user_id=' . (int)$this->request->get['filter_user_id'];
		}

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . $this->request->get['filter_customer'];
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . $this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['heading_title'] = $this->language->get('heading_title');
		$this->data['text_overview'] = $this->language->get('text_overview');
		$this->data['text_statistics'] = $this->language->get('text_statistics');
		$this->data['text_latest_messages'] = $this->language->get('text_latest_messages');
		$this->data['text_latest_10_orders'] = $this->language->get('text_latest_10_orders');
		$this->data['text_total_sale'] = $this->language->get('text_total_sale');
		$this->data['text_total_sale_year'] = $this->language->get('text_total_sale_year');
		$this->data['text_total_order'] = $this->language->get('text_total_order');
		$this->data['text_total_customer'] = $this->language->get('text_total_customer');
		$this->data['text_total_customer_approval'] = $this->language->get('text_total_customer_approval');
		$this->data['text_total_review_approval'] = $this->language->get('text_total_review_approval');
		$this->data['text_total_affiliate'] = $this->language->get('text_total_affiliate');
		$this->data['text_total_affiliate_approval'] = $this->language->get('text_total_affiliate_approval');
		$this->data['text_day'] = $this->language->get('text_day');
		$this->data['text_week'] = $this->language->get('text_week');
		$this->data['text_month'] = $this->language->get('text_month');
		$this->data['text_year'] = $this->language->get('text_year');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_all_status'] = $this->language->get('text_all_status');
		$this->data['button_record_history'] = $this->language->get('button_record_history');
		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['column_order'] = $this->language->get('column_order');
		$this->data['column_message'] = $this->language->get('column_message');
		$this->data['column_customer'] = $this->language->get('column_customer');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_date_added'] = $this->language->get('column_date_added');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_firstname'] = $this->language->get('column_firstname');
		$this->data['column_lastname'] = $this->language->get('column_lastname');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_consultant'] = $this->language->get('entry_consultant');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_treatment'] = $this->language->get('entry_treatment');
		$this->data['entry_range'] = $this->language->get('entry_range');
		$this->data['entry_user'] = $this->language->get('entry_user');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['text_not_processed'] = $this->language->get('text_not_processed');
		$this->data['text_processed_not_finished'] = $this->language->get('text_processed_not_finished');
		$this->data['text_processed_finished'] = $this->language->get('text_processed_finished');

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);


		$this->data['token'] = $this->session->data['token'];
		$this->load->model('sale/customer');

		$data = array();
		if (isset($this->request->get['filter_user_id'])) $data['filter_user_id'] = $this->request->get['filter_user_id'];
		if (isset($this->request->get['filter_customer_id'])) $data['filter_customer_id'] = $this->request->get['filter_customer_id'];
		if (isset($this->request->get['filter_comment'])) $data['filter_comment'] = $this->request->get['filter_comment'];
		if (isset($this->request->get['filter_product_id'])) $data['filter_product_id'] = $this->request->get['filter_product_id'];
		if (isset($this->request->get['filter_reminder_status_id'])) $data['filter_reminder_status'] = $this->request->get['filter_reminder_status_id'];
		if (isset($this->request->get['filter_date_start'])) $data['filter_date_start'] = $this->request->get['filter_date_start'];
		if (isset($this->request->get['filter_date_end'])) $data['filter_date_end'] = $this->request->get['filter_date_end'];
		$data['start'] = ($page - 1) * $this->config->get('config_admin_limit') / 2;
		$data['limit'] = $this->config->get('config_admin_limit') / 2;
		
		$this->data['messages'] = array();
		$reminders = $this->model_sale_customer->getCustomerReminders($data);
		$reminder_total = $this->model_sale_customer->getTotalCustomerReminders($data);

		foreach ($reminders as $result) {

			$status = 'not processed';
			if ($result['reminder_status'] == 0) $status = 'not processed';
			if ($result['reminder_status'] == 1) $status = 'processed, not finished';
			if ($result['reminder_status'] == 2) $status = 'finished';

			// if ($result['filter_reminder_status_id'])
			$this->data['messages'][] = array(
				'status' => $status, 
				'comment' => $result['comment'],
				'customer_history_id' => $result['customer_history_id'],
				'ufullname' => $result['ufullname'],
				'cfullname' => $result['cfullname'],
				'reminder_date' => $result['reminder_date'],
				'store_id' => $result['store_id'],
			);
		}
		

		$this->data['reminder_statuses'] = array();
		$this->data['reminder_statuses'][] = array();

		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;
		$this->data['filter_consultant'] = $filter_consultant;
		$this->data['filter_user'] = $filter_user;
		$this->data['filter_customer'] = $filter_customer;
		$this->data['filter_comment'] = $filter_comment;
		$this->data['filter_treatment'] = $filter_treatment;
		$this->data['filter_product_id'] = $filter_product_id;
		$this->data['filter_reminder_status_id'] = (isset($filter_reminder_status_id) ? $filter_reminder_status_id : -1);
		$this->data['filter_customer_id'] = $filter_customer_id;
		$this->data['filter_user_id'] = $filter_user_id;


		$data = array(
				'product_type_id' => array(2),
				'filter_status' => 1
		);

		$this->load->model('catalog/product');
		$results = $this->model_catalog_product->getProducts($data);
		$this->data['treatments'] = array(); 

		foreach ($results as $result) {
			$this->data['treatments'][] = array(
				'product_id' => $result['product_id'],
				'name' => $result['name']
			);
		}

		$pagination = new Pagination();
		$pagination->total = $reminder_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit') / 2;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('sale/followup', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->template = 'sale/followup.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

}
?>