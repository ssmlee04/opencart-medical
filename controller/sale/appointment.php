<?php   
class ControllerSaleAppointment extends Controller {   
	public function index() {
		$this->language->load('common/home');

		$this->document->setTitle($this->language->get('heading_title'));

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
		$this->data['text_please_refresh'] = $this->language->get('text_please_refresh');
		



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

		$this->data['breadcrumbs'] = array();

		$this->data['breadcrumbs'][] = array(
			'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
			'separator' => false
		);

		$this->data['token'] = $this->session->data['token'];
		
		$this->template = 'sale/appointment.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->data['events'] = array();

		$this->load->model('sale/customer');

		$data = array();

		$events = $this->model_sale_customer->getEvents($data);

		foreach ($events as $result) {

			$event = array('title' => $result['title'], 'id' => $result['customer_event_id']);
			if ($result['date_start'] != '0000-00-00 00:00:00') $event['start'] = $result['date_start'];
			if ($result['date_end'] != '0000-00-00 00:00:00') $event['end'] = $result['date_end'];

			$this->data['events'][] = $event;
		}

		$this->response->setOutput($this->render());
	}
	
}
?>