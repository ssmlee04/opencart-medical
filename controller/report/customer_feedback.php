<?php
class ControllerReportCustomerFeedback extends Controller {
	public function index() {     
		$this->language->load('report/customer_reminder');

		$this->document->setTitle($this->language->get('heading_title'));

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

		if (isset($this->request->get['filter_reminder_status_id'])) {
			$filter_reminder_status_id = $this->request->get['filter_reminder_status_id'];
		} else {
			$filter_reminder_status_id = 0;
		}	

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		}

		if (isset($this->request->get['filter_reminder_status_id'])) {
			$url .= '&filter_reminder_status_id=' . $this->request->get['filter_reminder_status_id'];
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
			'href'      => $this->url->link('report/customer_feedback', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->load->model('report/user');

		$this->data['users'] = array();

		$data = array(
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end
			// 'filter_reminder_status_id' => $filter_reminder_status_id
			// 'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			// 'limit'                  => $this->config->get('config_admin_limit')
		);

		$user_total = $this->model_report_user->getTotalUsers($data); 

		$results = $this->model_report_user->getUsers($data);

		$data = array(
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end, 
			'filter_reminder_status_id' => 0
			// 'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			// 'limit'                  => $this->config->get('config_admin_limit')
		);
		$unreads = $this->model_report_user->getUsers($data);

		$data = array(
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end, 
			'filter_reminder_status_id' => 3
			// 'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			// 'limit'                  => $this->config->get('config_admin_limit')
		);
		$finishs = $this->model_report_user->getUsers($data);

		$data = array(
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end
		);
		$rms = $this->model_report_user->getReminders($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('sale/user/update', 'token=' . $this->session->data['token'] . '&user_id=' . $result['user_id'] . $url, 'SSL')
			);

			$finishcount = 0;
			foreach ($finishs as $finish) {
				if ($finish['user_id'] == $result['user_id']) {
					$finishcount = $finish['total'];
				}
			}

			$unreadcount = 0;
			foreach ($unreads as $unread) {
				if ($unread['user_id'] == $result['user_id']) {
					$unreadcount = $unread['total'];
				}
			}

			$reminders = array();
			foreach ($rms as $reminder) {
				if ($reminder['user_id'] == $result['user_id']) {
					$reminders[] = $reminder;
				}
			}

			$this->data['users'][] = array(
				'user_id'       => $result['user_id'],
				'name'       => $result['lastname'] . $result['firstname'],
				// 'cname'       => $result['clastname'] . $result['cfirstname'],
				'user_group_id' => $result['user_group_id'],
				'user_group_name' => $result['name'],
				// 'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'unread_reminders'         => $unreadcount,
				'finished_reminders'         => $finishcount,
				'total_reminders'         => $result['total'],
				'reminders'       => $reminders, 
				'total'          => $this->currency->format($result['total'], $this->config->get('config_currency')),
				'action'         => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_all_status'] = $this->language->get('text_all_status');

		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_email'] = $this->language->get('column_email');
		$this->data['column_user_group'] = $this->language->get('column_user_group');
		$this->data['column_status'] = $this->language->get('column_status');
		$this->data['column_orders'] = $this->language->get('column_orders');
		$this->data['column_products'] = $this->language->get('column_products');
		$this->data['column_total'] = $this->language->get('column_total');
		$this->data['column_action'] = $this->language->get('column_action');
		$this->data['column_finished_reminders'] = $this->language->get('column_finished_reminders');
		$this->data['column_unread_reminders'] = $this->language->get('column_unread_reminders');
		$this->data['column_total_reminders'] = $this->language->get('column_total_reminders');

		$this->data['entry_reply'] = $this->language->get('entry_reply');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date'] = $this->language->get('entry_date');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_customer'] = $this->language->get('entry_customer');

		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/reminder_status');

		$this->data['reminder_statuses'] = $this->model_localisation_reminder_status->getReminderStatuses();

		$url = '';

		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		}

		if (isset($this->request->get['filter_reminder_status_id'])) {
			$url .= '&filter_reminder_status_id=' . $this->request->get['filter_reminder_status_id'];
		}

		$pagination = new Pagination();
		$pagination->total = $user_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('report/customer_feedback', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;		
		$this->data['filter_reminder_status_id'] = $filter_reminder_status_id;

		$this->template = 'report/customer_reminder.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}
}
?>