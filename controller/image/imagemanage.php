<?php    
class ControllerImageImageManage extends Controller { 
	
	public function index() {
		
		$this->language->load('image/imagemanage');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('sale/customer');

		$this->getList();
	}

	public function treatmentimage() {
		
		$this->load->model('sale/customer');
		$this->load->model('catalog/product');

		$this->language->load('image/imagemanage');

		$this->document->setTitle($this->language->get('heading_title'));

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
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_date_added'] = $this->language->get('entry_date_added');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_treatment'] = $this->language->get('entry_treatment');
		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_customer_id'] = $this->language->get('column_customer_id');
		$this->data['column_treatment'] = $this->language->get('column_treatment');
		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
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
		$this->data['button_display_2image'] = $this->language->get('button_display_2image');

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

		$customer_transaction_id = $this->request->get['customer_transaction_id'];

		$transaction = $this->model_sale_customer->getTransaction($customer_transaction_id);

		$images = $this->model_sale_customer->getCustomerImages(array('filter_customer_transaction_id' => $customer_transaction_id));

		$this->data['transaction'] = $transaction;

		$customer_id = $transaction['customer_id'];
		$product_id = $transaction['product_id'];

		$product = $this->model_catalog_product->getProduct($product_id);
		$customer = $this->model_sale_customer->getCustomer($customer_id);

		$this->data['customer'] = $customer;
		$this->data['product'] = $product;
		$this->data['text_product'] = $this->language->get('text_product');
		$this->data['text_date_processed'] = $this->language->get('text_date_processed');
		$this->data['text_customer'] = $this->language->get('text_customer');

		// $this->load->out($transaction);
		foreach ($images as $image) {
			$thumb = '';
			$href = '';
			$this->load->model('tool/image');
			$thumb = $this->model_tool_image->resize($image['image'], 80, 80);
			$href = $this->model_tool_image->resize($image['image'], 800, 800);
			$this->data['images'][] = array(
					'image'      => $image['image'],
					'href'      => $href,
					'thumb'      => $thumb,
					'customer_image_id'      => $image['customer_image_id'],
					'customer_id'      => $image['customer_id'],
					'date_added'      => explode(' ', $image['date_added']),
					'product_id'      => $image['product_id'],
					'comment'      => $image['comment'],
					
				);
		}

		$this->template = 'image/images.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getList() {

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

		if (isset($this->request->get['filter_treatment'])) {
			$filter_treatment = $this->request->get['filter_treatment'];
		} else {
			$filter_treatment = null;
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$filter_date_added_start = $this->request->get['filter_date_added_start'];
		} else {
			$filter_date_added_start = null;
		}

		if (isset($this->request->get['filter_date_added_end'])) {
			$filter_date_added_end = $this->request->get['filter_date_added_end'];
		} else {
			$filter_date_added_end = null;
		}

		if (isset($this->request->get['filter_date_modified_start'])) {
			$filter_date_modified_start = $this->request->get['filter_date_modified_start'];
		} else {
			$filter_date_modified_start = null;
		}

		if (isset($this->request->get['filter_date_modified_end'])) {
			$filter_date_modified_end = $this->request->get['filter_date_modified_end'];
		} else {
			$filter_date_modified_end = null;
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

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_customer_id'])) {
			$url .= '&filter_customer_id=' . (int)$this->request->get['filter_customer_id'];
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_treatment=' . (int)$this->request->get['filter_treatment'];
		}

		if (isset($this->request->get['filter_date_added_start'])) {
			$url .= '&filter_date_added_start=' . $this->request->get['filter_date_added_start'];
		}

		if (isset($this->request->get['filter_date_added_end'])) {
			$url .= '&filter_date_added_end=' . $this->request->get['filter_date_added_end'];
		}

		if (isset($this->request->get['filter_date_modified_start'])) {
			$url .= '&filter_date_modified_start=' . $this->request->get['filter_date_modified_start'];
		}	

		if (isset($this->request->get['filter_date_modified_end'])) {
			$url .= '&filter_date_modified_end=' . $this->request->get['filter_date_modified_end'];
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
			// 'filter_customer'              => $filter_customer, 
			'customer_id'               => $filter_customer_id, 
			'product_id'             => $filter_treatment, 
			'filter_date_added_end' => $filter_date_added_end, 
			'filter_date_added_start'            => $filter_date_added_start, 
			'filter_date_modified_end'          => $filter_date_modified_end, 
			'filter_date_modified_start'          => $filter_date_modified_start, 
			// 'filter_date_added'        => $filter_date_added,
			// 'filter_ip'                => $filter_ip,
			'sort'                     => $sort,
			'order'                    => $order,
			'start'                    => ($page - 1) * 10,
			'limit'                    => 10
		);

		$customer_images = $this->model_sale_customer->getCustomerImages($data);
		$total_customer_images = $this->model_sale_customer->getTotalCustomerImages($data);

		$this->data['customer_images'] = array();
		$this->load->model('tool/image');
		$this->load->model('catalog/product');

		foreach ($customer_images as $customer_image) {
			if ($customer_image['image'] && file_exists(DIR_IMAGE . $customer_image['image'])) {
				$image = $customer_image['image'];
			} else {
				$image = 'no_image.jpg';
			}

			$customer_id = $customer_image['customer_id'];
			$product_id = $customer_image['product_id'];	

			$product = $this->model_catalog_product->getProduct($product_id);
			$customer = $this->model_sale_customer->getCustomer($customer_id);
// $this->load->test($customer);

			if ($customer)
			$this->data['customer_images'][] = array(
				'image'      => $image,
				'product_name'      => (!empty($product) ? $product['name'] : ''),
				'comment'      => $customer_image['comment'],
				'customer_name'      => $customer['fullname'],
				'customer_image_id'      => $customer_image['customer_image_id'],
				'customer_transaction_id'      => $customer_image['customer_transaction_id'],
				'date_added'      =>  trim(explode(' ' ,$customer_image['date_added'])[0]),
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $customer_image['sort_order']
			);
		}

		$this->load->model('catalog/product');
		$this->data['treatments'] = $this->model_catalog_product->getProducts(array('filter_product_type_ids' => array(2)));


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
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_date_added'] = $this->language->get('entry_date_added');
		$this->data['entry_comment'] = $this->language->get('entry_comment');
		$this->data['entry_customer'] = $this->language->get('entry_customer');
		$this->data['entry_treatment'] = $this->language->get('entry_treatment');

		$this->data['column_name'] = $this->language->get('column_name');
		$this->data['column_customer_id'] = $this->language->get('column_customer_id');
		$this->data['column_treatment'] = $this->language->get('column_treatment');
		$this->data['column_date_modified'] = $this->language->get('column_date_modified');
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

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
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

		if (isset($this->request->get['filter_customer'])) {
			$url .= '&filter_customer=' . urlencode(html_entity_decode($this->request->get['filter_customer'], ENT_QUOTES, 'UTF-8'));
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
		$pagination->total = $total_customer_images;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('image/imagemanage', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_treatment'] = $filter_treatment;
		$this->data['filter_customer'] = $filter_customer;
		// $this->data['filter_ssn'] = $filter_ssn;
		// $this->data['filter_email'] = $filter_email;
		// $this->data['filter_customer_group_id'] = $filter_customer_group_id;
		// $this->data['filter_status'] = $filter_status;
		// $this->data['filter_approved'] = $filter_approved;
		// $this->data['filter_ip'] = $filter_ip;
		$this->data['filter_date_modified_start'] = $filter_date_modified_start;
		$this->data['filter_date_modified_end'] = $filter_date_modified_end;
		$this->data['filter_date_added_start'] = $filter_date_added_start;
		$this->data['filter_date_added_end'] = $filter_date_added_end;
		$this->data['filter_customer_id'] = $filter_customer_id;

		$this->load->model('sale/customer_group');

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		$this->load->model('setting/store');

		$this->data['stores'] = $this->model_setting_store->getStores();

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'image/imagemanage.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}



}
?>