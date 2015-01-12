<?php
class ControllerReportSaleInventory extends Controller { 
	public function index() {  
		$this->language->load('report/sale_inventory');

		$this->document->setTitle($this->language->get('heading_title'));

		if (isset($this->request->get['filter_date_start'])) {
			$filter_date_start = $this->request->get['filter_date_start'];
		} else {
			$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = date('Y-m-d');
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
			'href'      => $this->url->link('report/sale_inventory', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		$this->load->model('report/inventory');

		$this->data['orders'] = array();

		$data = array(
			'filter_date_start'	     => $filter_date_start, 
			'filter_date_end'	     => $filter_date_end, 
			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'                  => $this->config->get('config_admin_limit')
		);

		$products = array();
		$purchase = $this->model_report_inventory->getPurchaseList($data); // from purchase
		$sales = $this->model_report_inventory->getSalesList($data); // from order_product
// $this->load->test($purchase);
		foreach ($purchase as $result) {
			$products[] = array(
				'name' => $result['name'],
				'product_id' => $result['product_id'],
				'quantity' => $result['quantity'], 
				'date_added' => $result['date_purchased'], 
				'cost' => $result['cost'],
				'price' => 0
			);
		}
		foreach ($sales as $result) {
			$products[] = array(
				'name' => $result['name'],
				'product_id' => $result['product_id'],
				'quantity' => -$result['quantity'], 
				'date_added' => $result['date_added'], 
				'price' => $result['price'],
				'cost' => 0
			);
		}

		$inventory_start = $this->model_report_inventory->getInventory(array('date' => $filter_date_start));
		$inventory_end = $this->model_report_inventory->getInventory(array('date' => $filter_date_end));

		$this->data['products'] = $products;
		// $this->data['purchase'] = $purchase;
		$this->data['inventory_start'] = $inventory_start;
		$this->data['inventory_end'] = $inventory_end;
// $this->load->test($inventory_start);
		// foreach ($results as $result) {
		// 	$this->data['inventory'][] = array(
		// 		'date_start' => date($this->language->get('date_format_short'), strtotime($result['date_start'])),
		// 		'date_end'   => date($this->language->get('date_format_short'), strtotime($result['date_end'])),
		// 		'orders'     => $result['orders'],
		// 		'products'   => $result['products'],
		// 		'payment_cash'      => $this->currency->format($result['payment_cash'], $this->config->get('config_currency')),
		// 		'payment_visa'      => $this->currency->format($result['payment_visa'], $this->config->get('config_currency')),
		// 		'payment_balance'      => $this->currency->format($result['payment_balance'], $this->config->get('config_currency')),
		// 		'total'      => $this->currency->format($result['total'], $this->config->get('config_currency'))
		// 	);
		// }

		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_all_status'] = $this->language->get('text_all_status');

		$this->data['column_date'] = $this->language->get('column_date');
		$this->data['column_product'] = $this->language->get('column_product');
		$this->data['column_quantity'] = $this->language->get('column_quantity');
		$this->data['column_cost'] = $this->language->get('column_cost');
		$this->data['column_price'] = $this->language->get('column_price');
		$this->data['column_payment_visa'] = $this->language->get('column_payment_visa');
		$this->data['column_payment_balance'] = $this->language->get('column_payment_balance');
		$this->data['column_date_start'] = $this->language->get('column_date_start');
		$this->data['column_date_end'] = $this->language->get('column_date_end');
		$this->data['column_orders'] = $this->language->get('column_orders');
		$this->data['column_products'] = $this->language->get('column_products');
		$this->data['column_tax'] = $this->language->get('column_tax');
		$this->data['column_total'] = $this->language->get('column_total');

		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_group'] = $this->language->get('entry_group');	
		$this->data['entry_status'] = $this->language->get('entry_status');

		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		// $this->load->model('localisation/order_status');

		// $this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		// $this->data['groups'] = array();

		// $this->data['groups'][] = array(
		// 	'text'  => $this->language->get('text_year'),
		// 	'value' => 'year',
		// );

		// $this->data['groups'][] = array(
		// 	'text'  => $this->language->get('text_month'),
		// 	'value' => 'month',
		// );

		// $this->data['groups'][] = array(
		// 	'text'  => $this->language->get('text_week'),
		// 	'value' => 'week',
		// );

		// $this->data['groups'][] = array(
		// 	'text'  => $this->language->get('text_day'),
		// 	'value' => 'day',
		// );

		$url = '';

		if (isset($this->request->get['filter_date_start'])) {
			$url .= '&filter_date_start=' . $this->request->get['filter_date_start'];
		}

		if (isset($this->request->get['filter_date_end'])) {
			$url .= '&filter_date_end=' . $this->request->get['filter_date_end'];
		}

		// if (isset($this->request->get['filter_group'])) {
		// 	$url .= '&filter_group=' . $this->request->get['filter_group'];
		// }		

		// if (isset($this->request->get['filter_order_status_id'])) {
		// 	$url .= '&filter_order_status_id=' . $this->request->get['filter_order_status_id'];
		// }

		// $pagination = new Pagination();
		// $pagination->total = $inventory_total;
		// $pagination->page = $page;
		// $pagination->limit = $this->config->get('config_admin_limit');
		// $pagination->text = $this->language->get('text_pagination');
		// $pagination->url = $this->url->link('report/sale_inventory', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		// $this->data['pagination'] = $pagination->render();		

		$this->data['filter_date_start'] = $filter_date_start;
		$this->data['filter_date_end'] = $filter_date_end;		
		// $this->data['filter_group'] = $filter_group;
		// $this->data['filter_order_status_id'] = $filter_order_status_id;

		$this->template = 'report/sale_inventory.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}
}
?>