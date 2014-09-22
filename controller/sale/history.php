<?php
class ControllerSaleHistory extends Controller {

	public function updatehistory() {

		$json = array();

		$this->load->language('sale/history');

		$reminder_class_id = $this->request->get['reminder_class_id'];
		$customer_history_id = $this->request->get['customer_history_id'];
		$user_id = $this->user->getId();

		$this->load->model('sale/history');

		if ($this->model_sale_history->updatehistory($user_id, $reminder_class_id, $customer_history_id)) {
			$json['success'] = $this->language->get('text_success');
		} else {
			$json['error'] = $this->language->get('text_error');
		}

		$this->response->setOutput(json_encode($json));			
	}

}
?>