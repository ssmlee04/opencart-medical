<?php 
class ControllerCatalogProduct extends Controller {
	private $error = array(); 

	public function index() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title')); 

		$this->load->model('catalog/product');

		$this->getList();
	}


	// '2014-09-27 01:05'
	public function productExist() {

		$this->language->load('catalog/product');

		$product_id = $this->request->get['product_id'];

		$name = $this->request->get['name'];

		$this->load->model('catalog/product');

		if (!empty($product_id)) $product = $this->model_catalog_product->getProduct($product_id);

		else if (!empty($name)) {
// $this->load->out("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id WHERE language_id = '" . $this->config->get('config_language_id') .  "' AND name = '" . $this->db->escape($name) . "'");
			$query = $this->db->query("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id WHERE language_id = '" . $this->config->get('config_language_id') .  "' AND name = '" . $this->db->escape($name) . "'");

			// $this->load->out($query);
			if ($query->num_rows != 1) {
				return false;
			} else {
				$product_id = $query->row['product_id'];
				$product = $this->model_catalog_product->getProduct($product_id);
			}
		} else {
			return false;
		}

		if (!empty($product) && $product['name']==$name) {
			$json['success'] = $this->language->get('text_success');
		} else {
			$json['error'] = $this->language->get('text_error');
		}
		
		$this->response->setOutput(json_encode($json));	
	}

	public function insert() {

		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		$type = $this->request->get['type'];

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_product->addProduct($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirect($this->url->link('catalog/product&type=' . (int)$type, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function update() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		$type = $this->request->get['type'];

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_catalog_product->editProduct($this->request->get['product_id'], $this->request->post);

			$product = $this->model_catalog_product->getProduct($this->request->get['product_id']);

			$type = $product['product_type_id'];

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirect($this->url->link('catalog/product&type=' . (int)$type, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}


	public function delete() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		$type = $this->request->get['type'];

		if (isset($this->request->post['selected']) && $this->validateDelete()) {

			$deletable = true;
			
			foreach ($this->request->post['selected'] as $product_id) {
				$deletable = $this->model_catalog_product->deleteProduct($product_id) && $deletable;
			}

			if ($deletable) {
				$this->session->data['success'] = $this->language->get('text_success');
			} else {
				$this->session->data['error'] = $this->language->get('text_cannot_delete');
			}

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirect($this->url->link('catalog/product&type=' . $type, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	// '2014-09-27 00:30' recover prodduct deleted
	public function recover() {
		$this->language->load('catalog/product');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/product');

		$product_id = $this->request->get['product_id'];

		$type = $this->request->get['type'];

		if ($this->validateDelete()) {
			
			$this->model_catalog_product->recoverProduct($product_id);
			
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}	

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->redirect($this->url->link('catalog/product&type=' . $type, 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	// public function copy() {
	// 	$this->language->load('catalog/product');

	// 	$this->document->setTitle($this->language->get('heading_title'));

	// 	$this->load->model('catalog/product');

	// 	if (isset($this->request->post['selected']) && $this->validateCopy()) {
	// 		foreach ($this->request->post['selected'] as $product_id) {
	// 			$this->model_catalog_product->copyProduct($product_id);
	// 		}

	// 		$this->session->data['success'] = $this->language->get('text_success');

	// 		$url = '';

	// 		if (isset($this->request->get['filter_name'])) {
	// 			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
	// 		}

	// 		if (isset($this->request->get['filter_model'])) {
	// 			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
	// 		}

	// 		if (isset($this->request->get['filter_price'])) {
	// 			$url .= '&filter_price=' . $this->request->get['filter_price'];
	// 		}

	// 		if (isset($this->request->get['filter_quantity'])) {
	// 			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
	// 		}	

	// 		if (isset($this->request->get['filter_status'])) {
	// 			$url .= '&filter_status=' . $this->request->get['filter_status'];
	// 		}

	// 		if (isset($this->request->get['sort'])) {
	// 			$url .= '&sort=' . $this->request->get['sort'];
	// 		}

	// 		if (isset($this->request->get['order'])) {
	// 			$url .= '&order=' . $this->request->get['order'];
	// 		}

	// 		if (isset($this->request->get['page'])) {
	// 			$url .= '&page=' . $this->request->get['page'];
	// 		}

	// 		$this->redirect($this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'));
	// 	}

	// 	$this->getList();
	// }

	protected function getList() {

		if (isset($this->request->get['type'])) {
			$product_type_id = $this->request->get['type'];
		} else {
			$product_type_id = null;
		}

		if (!$product_type_id) $this->redirect($this->url->link('catalog/product&type=1', 'token=' . $this->session->data['token'] . $url, 'SSL'));

		$this->data['type'] = $product_type_id;

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}		

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),       		
			'separator' => ' :: '
		);

		$this->data['insert'] = $this->url->link('catalog/product/insert&type=' . $product_type_id, 'token=' . $this->session->data['token'] . $url, 'SSL');
		// $this->data['copy'] = $this->url->link('catalog/product/copy&type=' . $product_type_id, 'token=' . $this->session->data['token'] . $url, 'SSL');	
		$this->data['delete'] = $this->url->link('catalog/product/delete&type=' . $product_type_id, 'token=' . $this->session->data['token'] . $url, 'SSL');

		$this->data['products'] = array();

		$data = array(
			'filter_name'	  => $filter_name, 
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_admin_limit'),
			'limit'           => $this->config->get('config_admin_limit'),
			'filter_product_type_ids' => array((int)$product_type_id), 
		);

		$this->load->model('tool/image');

		$product_total = $this->model_catalog_product->getTotalProducts($data);

		$results = $this->model_catalog_product->getProducts($data);

		foreach ($results as $result) {
			$action = array();

			$action[] = array(
				'text' => $this->language->get('text_edit'),
				'href' => $this->url->link('catalog/product/update&type=' . (int)$product_type_id, 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
			);

			$deleteaction = array();

			if ($result['status'] == -1) {
				$deleteaction[] = array(
					'text' => $this->language->get('text_recover'),
					'href' => $this->url->link('catalog/product/recover&type=' . (int)$product_type_id . '&token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL')
				);
			}

			if ($result['image'] && file_exists(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.jpg', 40, 40);
			}

			// $special = false;

			// $product_specials = $this->model_catalog_product->getProductSpecials($result['product_id']);

			// foreach ($product_specials  as $product_special) {
			// 	if (($product_special['date_start'] == '0000-00-00' || $product_special['date_start'] < date('Y-m-d')) && ($product_special['date_end'] == '0000-00-00' || $product_special['date_end'] > date('Y-m-d'))) {
			// 		$special = $product_special['price'];

			// 		break;
			// 	}					
			// }

			$store_quantity = $this->model_catalog_product->getProductStores($result['product_id']);

			$quantity = 0;
			foreach ($store_quantity  as $q) {
				$quantity += $q['quantity'];
			}


			$this->data['products'][] = array(
				'product_id' => $result['product_id'],
				'subtract' => $result['subtract'],
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'href'      => $this->url->link('catalog/product/update&type=' . (int)$product_type_id, 'token=' . $this->session->data['token'] . '&product_id=' . $result['product_id'] . $url, 'SSL'),
				'product_type_id' => $result['product_type_id'],
				'image'      => $image,
				'quantity'   => $quantity,
				'status'     => ($result['status']==1 ? $this->language->get('text_enabled') : ($result['status']==0 ? $this->language->get('text_disabled') :  $this->language->get('text_deleted'))),
				'deleteaction' => $deleteaction,
				'selected'   => isset($this->request->post['selected']) && in_array($result['product_id'], $this->request->post['selected']),
				'action'     => $action
			);
		}

		$this->data['heading_title'] = $this->language->get('heading_title');		

		$this->data['text_enabled'] = $this->language->get('text_enabled');		
		$this->data['text_disabled'] = $this->language->get('text_disabled');		
		$this->data['text_no_results'] = $this->language->get('text_no_results');		
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');		

		$this->data['column_image'] = $this->language->get('column_image');		
		$this->data['column_name'] = $this->language->get('column_name');		
		$this->data['column_model'] = $this->language->get('column_model');		
		$this->data['column_price'] = $this->language->get('column_price');		
		$this->data['column_quantity'] = $this->language->get('column_quantity');		
		$this->data['column_status'] = $this->language->get('column_status');		
		$this->data['column_action'] = $this->language->get('column_action');		

		$this->data['button_copy'] = $this->language->get('button_copy');		
		$this->data['button_insert'] = $this->language->get('button_insert');		
		$this->data['button_delete'] = $this->language->get('button_delete');		
		$this->data['button_filter'] = $this->language->get('button_filter');

		$this->data['token'] = $this->session->data['token'];

		if (isset($this->session->data['error'])) {
			$this->data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
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

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}



		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$this->data['sort_name'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$this->data['sort_model'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$this->data['sort_price'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$this->data['sort_quantity'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$this->data['sort_status'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$this->data['sort_order'] = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['type'])) {
			$url .= '&type=' . $this->request->get['type'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
// $this->load->test($url, false);

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_admin_limit');
		$pagination->text = $this->language->get('text_pagination');
		$pagination->url = $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$this->data['pagination'] = $pagination->render();

		$this->data['filter_name'] = $filter_name;
		$this->data['filter_model'] = $filter_model;
		$this->data['filter_price'] = $filter_price;
		$this->data['filter_quantity'] = $filter_quantity;
		$this->data['filter_status'] = $filter_status;

		$this->data['sort'] = $sort;
		$this->data['order'] = $order;

		$this->template = 'catalog/product_list.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function getForm() {
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['text_order_info'] = $this->language->get('text_order_info');
		$this->data['text_purchase_info'] = $this->language->get('text_purchase_info');
		$this->data['text_enabled'] = $this->language->get('text_enabled');
		$this->data['text_disabled'] = $this->language->get('text_disabled');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_yes'] = $this->language->get('text_yes');
		$this->data['text_no'] = $this->language->get('text_no');
		$this->data['text_plus'] = $this->language->get('text_plus');
		$this->data['text_minus'] = $this->language->get('text_minus');
		$this->data['text_default'] = $this->language->get('text_default');
		$this->data['text_image_manager'] = $this->language->get('text_image_manager');
		$this->data['text_browse'] = $this->language->get('text_browse');
		$this->data['text_clear'] = $this->language->get('text_clear');
		$this->data['text_option'] = $this->language->get('text_option');
		$this->data['text_option_value'] = $this->language->get('text_option_value');
		$this->data['text_select'] = $this->language->get('text_select');
		$this->data['text_none'] = $this->language->get('text_none');
		$this->data['text_percent'] = $this->language->get('text_percent');
		$this->data['text_amount'] = $this->language->get('text_amount');

		$this->data['entry_bonus_percent_doctor'] = $this->language->get('entry_bonus_percent_doctor');
		$this->data['entry_bonus_percent_consultant'] = $this->language->get('entry_bonus_percent_consultant');
		$this->data['entry_bonus_percent_outsource'] = $this->language->get('entry_bonus_percent_outsource');
		$this->data['entry_bonus_percent_beauty'] = $this->language->get('entry_bonus_percent_beauty');
		$this->data['entry_name'] = $this->language->get('entry_name');
		$this->data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$this->data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$this->data['entry_description'] = $this->language->get('entry_description');
		$this->data['entry_store'] = $this->language->get('entry_store');
		$this->data['entry_keyword'] = $this->language->get('entry_keyword');
		$this->data['entry_model'] = $this->language->get('entry_model');
		$this->data['entry_sku'] = $this->language->get('entry_sku');
		$this->data['entry_upc'] = $this->language->get('entry_upc');
		$this->data['entry_ean'] = $this->language->get('entry_ean');
		$this->data['entry_jan'] = $this->language->get('entry_jan');
		$this->data['entry_isbn'] = $this->language->get('entry_isbn');
		$this->data['entry_mpn'] = $this->language->get('entry_mpn');
		$this->data['entry_location'] = $this->language->get('entry_location');
		$this->data['entry_minimum'] = $this->language->get('entry_minimum');
		$this->data['entry_unit_quantity'] = $this->language->get('entry_unit_quantity');
		$this->data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$this->data['entry_shipping'] = $this->language->get('entry_shipping');
		$this->data['entry_date_available'] = $this->language->get('entry_date_available');
		$this->data['entry_reminder_days'] = $this->language->get('entry_reminder_days');
		$this->data['entry_reminder'] = $this->language->get('entry_reminder');
		$this->data['entry_bonus_percent'] = $this->language->get('entry_bonus_percent');
		$this->data['entry_bonus'] = $this->language->get('entry_bonus');
		$this->data['entry_quantity'] = $this->language->get('entry_quantity');
		$this->data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$this->data['entry_price'] = $this->language->get('entry_price');
		$this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$this->data['entry_points'] = $this->language->get('entry_points');
		$this->data['entry_option_points'] = $this->language->get('entry_option_points');
		$this->data['entry_subtract'] = $this->language->get('entry_subtract');
		$this->data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$this->data['entry_weight'] = $this->language->get('entry_weight');
		$this->data['entry_dimension'] = $this->language->get('entry_dimension');
		$this->data['entry_length'] = $this->language->get('entry_length');
		$this->data['entry_image'] = $this->language->get('entry_image');
		$this->data['entry_download'] = $this->language->get('entry_download');
		$this->data['entry_category'] = $this->language->get('entry_category');
		$this->data['entry_filter'] = $this->language->get('entry_filter');
		$this->data['entry_related'] = $this->language->get('entry_related');
		$this->data['entry_attribute'] = $this->language->get('entry_attribute');
		$this->data['entry_text'] = $this->language->get('entry_text');
		$this->data['entry_option'] = $this->language->get('entry_option');
		$this->data['entry_option_value'] = $this->language->get('entry_option_value');
		$this->data['entry_required'] = $this->language->get('entry_required');
		$this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$this->data['entry_status'] = $this->language->get('entry_status');
		$this->data['entry_date_start'] = $this->language->get('entry_date_start');
		$this->data['entry_date_end'] = $this->language->get('entry_date_end');
		$this->data['entry_priority'] = $this->language->get('entry_priority');
		$this->data['entry_tag'] = $this->language->get('entry_tag');
		$this->data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$this->data['entry_reward'] = $this->language->get('entry_reward');
		$this->data['entry_layout'] = $this->language->get('entry_layout');
		$this->data['entry_profile'] = $this->language->get('entry_profile');
		$this->data['entry_unit_class'] = $this->language->get('entry_unit_class');

		$this->data['text_recurring_help'] = $this->language->get('text_recurring_help');
		$this->data['text_recurring_title'] = $this->language->get('text_recurring_title');
		$this->data['text_recurring_trial'] = $this->language->get('text_recurring_trial');
		$this->data['entry_recurring'] = $this->language->get('entry_recurring');
		$this->data['entry_recurring_price'] = $this->language->get('entry_recurring_price');
		$this->data['entry_recurring_freq'] = $this->language->get('entry_recurring_freq');
		$this->data['entry_recurring_cycle'] = $this->language->get('entry_recurring_cycle');
		$this->data['entry_recurring_length'] = $this->language->get('entry_recurring_length');
		$this->data['entry_trial'] = $this->language->get('entry_trial');
		$this->data['entry_trial_price'] = $this->language->get('entry_trial_price');
		$this->data['entry_trial_freq'] = $this->language->get('entry_trial_freq');
		$this->data['entry_trial_length'] = $this->language->get('entry_trial_length');
		$this->data['entry_trial_cycle'] = $this->language->get('entry_trial_cycle');

		$this->data['text_purchase_id'] = $this->language->get('text_purchase_id');
		$this->data['text_order_total'] = $this->language->get('text_order_total');
		$this->data['text_date_added'] = $this->language->get('text_date_added');
		$this->data['text_order_id'] = $this->language->get('text_order_id');
		$this->data['text_length_day'] = $this->language->get('text_length_day');
		$this->data['text_length_week'] = $this->language->get('text_length_week');
		$this->data['text_length_month'] = $this->language->get('text_length_month');
		$this->data['text_length_month_semi'] = $this->language->get('text_length_month_semi');
		$this->data['text_length_year'] = $this->language->get('text_length_year');

		$this->data['button_save'] = $this->language->get('button_save_file');
		$this->data['button_cancel'] = $this->language->get('button_cancel');
		$this->data['button_add_attribute'] = $this->language->get('button_add_attribute');
		$this->data['button_add_option'] = $this->language->get('button_add_option');
		$this->data['button_add_option_value'] = $this->language->get('button_add_option_value');
		$this->data['button_add_discount'] = $this->language->get('button_add_discount');
		$this->data['button_add_special'] = $this->language->get('button_add_special');
		$this->data['button_add_image'] = $this->language->get('button_add_image');
		$this->data['button_remove'] = $this->language->get('button_remove');
		$this->data['button_add_profile'] = $this->language->get('button_add_profile');
		$this->data['button_add_store_quantity'] = $this->language->get('button_add_store_quantity');

		$this->data['tab_history'] = $this->language->get('tab_history');
		$this->data['tab_general'] = $this->language->get('tab_general');
		$this->data['tab_data'] = $this->language->get('tab_data');
		$this->data['tab_attribute'] = $this->language->get('tab_attribute');
		$this->data['tab_option'] = $this->language->get('tab_option');		
		$this->data['tab_profile'] = $this->language->get('tab_profile');
		$this->data['tab_discount'] = $this->language->get('tab_discount');
		$this->data['tab_special'] = $this->language->get('tab_special');
		$this->data['tab_image'] = $this->language->get('tab_image');
		$this->data['tab_links'] = $this->language->get('tab_links');
		$this->data['tab_reward'] = $this->language->get('tab_reward');
		$this->data['tab_design'] = $this->language->get('tab_design');
		$this->data['tab_marketplace_links'] = $this->language->get('tab_marketplace_links');

		if (isset($this->error['warning'])) {
			$this->data['error_warning'] = $this->error['warning'];
		} else {
			$this->data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$this->data['error_name'] = $this->error['name'];
		} else {
			$this->data['error_name'] = array();
		}

		if (isset($this->error['meta_description'])) {
			$this->data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$this->data['error_meta_description'] = array();
		}		

		if (isset($this->error['description'])) {
			$this->data['error_description'] = $this->error['description'];
		} else {
			$this->data['error_description'] = array();
		}	

		if (isset($this->error['model'])) {
			$this->data['error_model'] = $this->error['model'];
		} else {
			$this->data['error_model'] = '';
		}		

		if (isset($this->error['date_available'])) {
			$this->data['error_date_available'] = $this->error['date_available'];
		} else {
			$this->data['error_date_available'] = '';
		}	

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}	

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
			'href'      => $this->url->link('catalog/product', 'token=' . $this->session->data['token'] . $url, 'SSL'),
			'separator' => ' :: '
		);

		// '2014-09-27 00:21'
		$type = $this->request->get['type'];
		// $type = $this->request->post['type'];
		// $this->data['type'] = $this->request->get['type'];

		if (!isset($this->request->post['type'])) {
			$this->data['type'] = 1;
		} else {
			$this->data['type'] = $this->request->post['type'];
		}

		if (!isset($this->request->get['product_id'])) {
			$this->data['action'] = $this->url->link('catalog/product/insert&type=' . $type, 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$this->data['action'] = $this->url->link('catalog/product/update&type=' . $type, 'token=' . $this->session->data['token'] . '&product_id=' . $this->request->get['product_id'] . $url, 'SSL');
		}

		$this->data['cancel'] = $this->url->link('catalog/product&type=' . $type, 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$product_info = $this->model_catalog_product->getProduct($this->request->get['product_id']);
		}

		$this->data['order_infos'] = [];
		$this->data['purchase_infos'] = [];
		if (isset($this->request->get['product_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			
			$order_query = $this->db->query("SELECT * FROM oc_order o LEFT JOIN  oc_order_product op ON o.order_id = op.order_id WHERE product_id = '" . $this->request->get['product_id'] . "'");
			$purchase_query = $this->db->query("SELECT * FROM oc_purchase o LEFT JOIN  oc_purchase_product op ON o.purchase_id = op.purchase_id WHERE product_id = '" . $this->request->get['product_id'] . "'");

			$this->data['order_infos'] = $order_query->rows;
			$this->data['purchase_infos'] = $purchase_query->rows;
		}

		// $this->load->test($this->data['order_infos']);

		$this->data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$this->data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['product_description'])) {
			$this->data['product_description'] = $this->request->post['product_description'];
		} elseif (isset($this->request->get['product_id'])) {
			$this->data['product_description'] = $this->model_catalog_product->getProductDescriptions($this->request->get['product_id']);
		} else {
			$this->data['product_description'] = array();
		}

		if (isset($this->request->post['model'])) {
			$this->data['model'] = $this->request->post['model'];
		} elseif (!empty($product_info)) {
			$this->data['model'] = $product_info['model'];
		} else {
			$this->data['model'] = '';
		}

		if (isset($this->request->post['reminder'])) {
			$this->data['reminder'] = $this->request->post['reminder'];
		} elseif (!empty($product_info)) {
			$this->data['reminder'] = $product_info['reminder'];
		} else {
			$this->data['reminder'] = '';
		}

		if (isset($this->request->post['reminder_days'])) {
			$this->data['reminder_days'] = $this->request->post['reminder_days'];
		} elseif (!empty($product_info)) {
			$this->data['reminder_days'] = $product_info['reminder_days'];
		} else {
			$this->data['reminder_days'] = '';
		}

		if (isset($this->request->get['type'])) {
			$this->data['type'] = $this->request->get['type'];
		} else {
			$this->data['type'] = 1;
		}

		if (isset($this->request->post['subtract'])) {
			$this->data['subtract'] = $this->request->post['subtract'];
		} elseif (!empty($product_info)) {
			$this->data['subtract'] = $product_info['subtract'];
		} else {
			$this->data['subtract'] = '';
		}

		if (isset($this->request->post['bonus'])) {
			$this->data['bonus'] = $this->request->post['bonus'];
		} elseif (!empty($product_info)) {
			$this->data['bonus'] = $product_info['bonus'];
		} else {
			$this->data['bonus'] = '';
		}

		if (isset($this->request->post['bonus_percent_doctor'])) {
			$this->data['bonus_percent_doctor'] = $this->request->post['bonus_percent_doctor'];
		} elseif (!empty($product_info)) {
			$this->data['bonus_percent_doctor'] = $product_info['bonus_percent_doctor'];
		} else {
			$this->data['bonus_percent_doctor'] = '';
		}	

		if (isset($this->request->post['bonus_percent_outsource'])) {
			$this->data['bonus_percent_outsource'] = $this->request->post['bonus_percent_outsource'];
		} elseif (!empty($product_info)) {
			$this->data['bonus_percent_outsource'] = $product_info['bonus_percent_outsource'];
		} else {
			$this->data['bonus_percent_outsource'] = '';
		}

		if (isset($this->request->post['bonus_percent_consultant'])) {
			$this->data['bonus_percent_consultant'] = $this->request->post['bonus_percent_consultant'];
		} elseif (!empty($product_info)) {
			$this->data['bonus_percent_consultant'] = $product_info['bonus_percent_consultant'];
		} else {
			$this->data['bonus_percent_consultant'] = '';
		}

		if (isset($this->request->post['bonus_percent_beauty'])) {
			$this->data['bonus_percent_beauty'] = $this->request->post['bonus_percent_beauty'];
		} elseif (!empty($product_info)) {
			$this->data['bonus_percent_beauty'] = $product_info['bonus_percent_beauty'];
		} else {
			$this->data['bonus_percent_beauty'] = '';
		}

		
		if (isset($this->request->post['sku'])) {
			$this->data['sku'] = $this->request->post['sku'];
		} elseif (!empty($product_info)) {
			$this->data['sku'] = $product_info['sku'];
		} else {
			$this->data['sku'] = '';
		}

		if (isset($this->request->post['upc'])) {
			$this->data['upc'] = $this->request->post['upc'];
		} elseif (!empty($product_info)) {
			$this->data['upc'] = $product_info['upc'];
		} else {
			$this->data['upc'] = '';
		}

		if (isset($this->request->post['ean'])) {
			$this->data['ean'] = $this->request->post['ean'];
		} elseif (!empty($product_info)) {
			$this->data['ean'] = $product_info['ean'];
		} else {
			$this->data['ean'] = '';
		}

		if (isset($this->request->post['jan'])) {
			$this->data['jan'] = $this->request->post['jan'];
		} elseif (!empty($product_info)) {
			$this->data['jan'] = $product_info['jan'];
		} else {
			$this->data['jan'] = '';
		}

		if (isset($this->request->post['isbn'])) {
			$this->data['isbn'] = $this->request->post['isbn'];
		} elseif (!empty($product_info)) {
			$this->data['isbn'] = $product_info['isbn'];
		} else {
			$this->data['isbn'] = '';
		}

		if (isset($this->request->post['mpn'])) {
			$this->data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($product_info)) {
			$this->data['mpn'] = $product_info['mpn'];
		} else {
			$this->data['mpn'] = '';
		}

		if (isset($this->request->post['location'])) {
			$this->data['location'] = $this->request->post['location'];
		} elseif (!empty($product_info)) {
			$this->data['location'] = $product_info['location'];
		} else {
			$this->data['location'] = '';
		}

		//$this->load->model('setting/store');

		//$this->data['stores'] = $this->model_setting_store->getStores();

		// if (isset($this->request->post['product_store'])) {
		// 	$this->data['product_store'] = $this->request->post['product_store'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$this->data['product_store'] = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
		// } else {
		// 	$this->data['product_store'] = array(0);
		// }	

		// if (isset($this->request->post['keyword'])) {
		// 	$this->data['keyword'] = $this->request->post['keyword'];
		// } elseif (!empty($product_info)) {
		// 	$this->data['keyword'] = $product_info['keyword'];
		// } else {
		// 	$this->data['keyword'] = '';
		// }

		if (isset($this->request->post['image'])) {
			$this->data['image'] = $this->request->post['image'];
		} elseif (!empty($product_info)) {
			$this->data['image'] = $product_info['image'];
		} else {
			$this->data['image'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && file_exists(DIR_IMAGE . $this->request->post['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($product_info) && $product_info['image'] && file_exists(DIR_IMAGE . $product_info['image'])) {
			$this->data['thumb'] = $this->model_tool_image->resize($product_info['image'], 100, 100);
		} else {
			$this->data['thumb'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);
		}

		if (isset($this->request->post['shipping'])) {
			$this->data['shipping'] = $this->request->post['shipping'];
		} elseif (!empty($product_info)) {
			$this->data['shipping'] = $product_info['shipping'];
		} else {
			$this->data['shipping'] = 1;
		}

		if (isset($this->request->post['price'])) {
			$this->data['price'] = $this->request->post['price'];
		} elseif (!empty($product_info)) {
			$this->data['price'] = $product_info['price'];
		} else {
			$this->data['price'] = '';
		}

		// $this->load->model('catalog/profile');

		// $this->data['profiles'] = $this->model_catalog_profile->getProfiles();

		// if (isset($this->request->post['product_profiles'])) {
		// 	$this->data['product_profiles'] = $this->request->post['product_profiles'];
		// } elseif (!empty($product_info)) {
		// 	$this->data['product_profiles'] = $this->model_catalog_product->getProfiles($product_info['product_id']);
		// } else {
		// 	$this->data['product_profiles'] = array();
		// }

		// $this->load->model('localisation/tax_class');

		// $this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		// if (isset($this->request->post['tax_class_id'])) {
		// 	$this->data['tax_class_id'] = $this->request->post['tax_class_id'];
		// } elseif (!empty($product_info)) {
		// 	$this->data['tax_class_id'] = $product_info['tax_class_id'];
		// } else {
		// 	$this->data['tax_class_id'] = 0;
		// }

		if (isset($this->request->post['date_available'])) {
			$this->data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($product_info)) {
			$this->data['date_available'] = date('Y-m-d', strtotime($product_info['date_available']));
		} else {
			$this->data['date_available'] = date('Y-m-d', time() - 86400);
		}

		// if (isset($this->request->post['quantity'])) {
		// 	$this->data['quantity'] = $this->request->post['quantity'];
		// } elseif (!empty($product_info)) {
		// 	$this->data['quantity'] = $product_info['quantity'];
		// } else {
		// 	$this->data['quantity'] = 1;
		// }

		// Attributes
		// $this->load->model('catalog/attribute');

		if (isset($this->request->post['store_quantity'])) {
			$store_quantity = $this->request->post['store_quantity'];
		} elseif (isset($this->request->get['product_id'])) {
			$store_quantity = $this->model_catalog_product->getProductStores($this->request->get['product_id']);
		} else {
			$store_quantity = array();
		}

		$this->data['store_quantitys'] = array();

		foreach ($store_quantity as $quantity) {

				$this->data['store_quantitys'][] = array(
					'store_id'                  => $quantity['store_id'],
					'name'                          => $quantity['name'],
					'quantity' => $quantity['quantity']
				);
			
		}	

		if (isset($this->request->post['minimum'])) {
			$this->data['minimum'] = $this->request->post['minimum'];
		} elseif (!empty($product_info)) {
			$this->data['minimum'] = $product_info['minimum'];
		} else {
			$this->data['minimum'] = 1;
		}

		if (isset($this->request->post['unit_quantity'])) {
			$this->data['unit_quantity'] = $this->request->post['unit_quantity'];
		} elseif (!empty($product_info)) {
			$this->data['unit_quantity'] = $product_info['unit_quantity'];
		} else {
			$this->data['unit_quantity'] = 1;
		}

		if (isset($this->request->post['subtract'])) {
			$this->data['subtract'] = $this->request->post['subtract'];
		} elseif (!empty($product_info)) {
			$this->data['subtract'] = $product_info['subtract'];
		} else {
			$this->data['subtract'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$this->data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($product_info)) {
			$this->data['sort_order'] = $product_info['sort_order'];
		} else {
			$this->data['sort_order'] = 1;
		}

		$this->load->model('localisation/stock_status');

		$this->data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		if (isset($this->request->post['stock_status_id'])) {
			$this->data['stock_status_id'] = $this->request->post['stock_status_id'];
		} elseif (!empty($product_info)) {
			$this->data['stock_status_id'] = $product_info['stock_status_id'];
		} else {
			$this->data['stock_status_id'] = $this->config->get('config_stock_status_id');
		}

		if (isset($this->request->post['status'])) {
			$this->data['status'] = $this->request->post['status'];
		} elseif (!empty($product_info)) {
			$this->data['status'] = $product_info['status'];
		} else {
			$this->data['status'] = 1;
		}

		if (isset($this->request->post['weight'])) {
			$this->data['weight'] = $this->request->post['weight'];
		} elseif (!empty($product_info)) {
			$this->data['weight'] = $product_info['weight'];
		} else {
			$this->data['weight'] = '';
		}

		$this->load->model('localisation/weight_class');

		$this->data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['weight_class_id'])) {
			$this->data['weight_class_id'] = $this->request->post['weight_class_id'];
		} elseif (!empty($product_info)) {
			$this->data['weight_class_id'] = $product_info['weight_class_id'];
		} else {
			$this->data['weight_class_id'] = $this->config->get('config_weight_class_id');
		}

		$this->load->model('localisation/unit_class');

		$this->data['unit_classes'] = $this->model_localisation_unit_class->getUnitClasses();

		if (isset($this->request->post['unit_class_id'])) {
			$this->data['unit_class_id'] = $this->request->post['unit_class_id'];
		} elseif (!empty($product_info)) {
			$this->data['unit_class_id'] = $product_info['unit_class_id'];
		} else {
			$this->data['unit_class_id'] = $this->config->get('config_unit_class_id');
		}


		if (isset($this->request->post['length'])) {
			$this->data['length'] = $this->request->post['length'];
		} elseif (!empty($product_info)) {
			$this->data['length'] = $product_info['length'];
		} else {
			$this->data['length'] = '';
		}

		if (isset($this->request->post['width'])) {
			$this->data['width'] = $this->request->post['width'];
		} elseif (!empty($product_info)) {	
			$this->data['width'] = $product_info['width'];
		} else {
			$this->data['width'] = '';
		}

		if (isset($this->request->post['height'])) {
			$this->data['height'] = $this->request->post['height'];
		} elseif (!empty($product_info)) {
			$this->data['height'] = $product_info['height'];
		} else {
			$this->data['height'] = '';
		}

		$this->load->model('localisation/length_class');

		$this->data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post['length_class_id'])) {
			$this->data['length_class_id'] = $this->request->post['length_class_id'];
		} elseif (!empty($product_info)) {
			$this->data['length_class_id'] = $product_info['length_class_id'];
		} else {
			$this->data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->post['manufacturer_id'])) {
			$this->data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($product_info)) {
			$this->data['manufacturer_id'] = $product_info['manufacturer_id'];
		} else {
			$this->data['manufacturer_id'] = 0;
		}

		if (isset($this->request->post['manufacturer'])) {
			$this->data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($product_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($product_info['manufacturer_id']);

			if ($manufacturer_info) {		
				$this->data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$this->data['manufacturer'] = '';
			}	
		} else {
			$this->data['manufacturer'] = '';
		}

		// Categories
		// $this->load->model('catalog/category');

		// if (isset($this->request->post['product_category'])) {
		// 	$categories = $this->request->post['product_category'];
		// } elseif (isset($this->request->get['product_id'])) {		
		// 	$categories = $this->model_catalog_product->getProductCategories($this->request->get['product_id']);
		// } else {
		// 	$categories = array();
		// }

		// $this->data['product_categories'] = array();

		// foreach ($categories as $category_id) {
		// 	$category_info = $this->model_catalog_category->getCategory($category_id);

		// 	if ($category_info) {
		// 		$this->data['product_categories'][] = array(
		// 			'category_id' => $category_info['category_id'],
		// 			'name'        => ($category_info['path'] ? $category_info['path'] . ' &gt; ' : '') . $category_info['name']
		// 		);
		// 	}
		// }

		// Filters
		// $this->load->model('catalog/filter');

		// if (isset($this->request->post['product_filter'])) {
		// 	$filters = $this->request->post['product_filter'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$filters = $this->model_catalog_product->getProductFilters($this->request->get['product_id']);
		// } else {
		// 	$filters = array();
		// }

		// $this->data['product_filters'] = array();

		// foreach ($filters as $filter_id) {
		// 	$filter_info = $this->model_catalog_filter->getFilter($filter_id);

		// 	if ($filter_info) {
		// 		$this->data['product_filters'][] = array(
		// 			'filter_id' => $filter_info['filter_id'],
		// 			'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
		// 		);
		// 	}
		// }		

		// Attributes
		// $this->load->model('catalog/attribute');

		// if (isset($this->request->post['product_attribute'])) {
		// 	$product_attributes = $this->request->post['product_attribute'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$product_attributes = $this->model_catalog_product->getProductAttributes($this->request->get['product_id']);
		// } else {
		// 	$product_attributes = array();
		// }

		// $this->data['product_attributes'] = array();

		// foreach ($product_attributes as $product_attribute) {
		// 	$attribute_info = $this->model_catalog_attribute->getAttribute($product_attribute['attribute_id']);

		// 	if ($attribute_info) {
		// 		$this->data['product_attributes'][] = array(
		// 			'attribute_id'                  => $product_attribute['attribute_id'],
		// 			'name'                          => $attribute_info['name'],
		// 			'product_attribute_description' => $product_attribute['product_attribute_description']
		// 		);
		// 	}
		// }		

		// Options
		// $this->load->model('catalog/option');

		// if (isset($this->request->post['product_option'])) {
		// 	$product_options = $this->request->post['product_option'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$product_options = $this->model_catalog_product->getProductOptions($this->request->get['product_id']);			
		// } else {
		// 	$product_options = array();
		// }			

		// $this->data['type'] = $this->request->get['type'];
		

		// $this->data['product_options'] = array();

		// foreach ($product_options as $product_option) {
		// 	if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
		// 		$product_option_value_data = array();

		// 		foreach ($product_option['product_option_value'] as $product_option_value) {
		// 			$product_option_value_data[] = array(
		// 				'product_option_value_id' => $product_option_value['product_option_value_id'],
		// 				'option_value_id'         => $product_option_value['option_value_id'],
		// 				'quantity'                => $product_option_value['quantity'],
		// 				'subtract'                => $product_option_value['subtract'],
		// 				'price'                   => $product_option_value['price'],
		// 				'price_prefix'            => $product_option_value['price_prefix'],
		// 				'points'                  => $product_option_value['points'],
		// 				'points_prefix'           => $product_option_value['points_prefix'],						
		// 				'weight'                  => $product_option_value['weight'],
		// 				'weight_prefix'           => $product_option_value['weight_prefix']	
		// 			);
		// 		}

		// 		$this->data['product_options'][] = array(
		// 			'product_option_id'    => $product_option['product_option_id'],
		// 			'product_option_value' => $product_option_value_data,
		// 			'option_id'            => $product_option['option_id'],
		// 			'name'                 => $product_option['name'],
		// 			'type'                 => $product_option['type'],
		// 			'required'             => $product_option['required']
		// 		);				
		// 	} else {
		// 		$this->data['product_options'][] = array(
		// 			'product_option_id' => $product_option['product_option_id'],
		// 			'option_id'         => $product_option['option_id'],
		// 			'name'              => $product_option['name'],
		// 			'type'              => $product_option['type'],
		// 			'option_value'      => $product_option['option_value'],
		// 			'required'          => $product_option['required']
		// 		);				
		// 	}
		// }

		// $this->data['option_values'] = array();

		// foreach ($this->data['product_options'] as $product_option) {
		// 	if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox' || $product_option['type'] == 'image') {
		// 		if (!isset($this->data['option_values'][$product_option['option_id']])) {
		// 			$this->data['option_values'][$product_option['option_id']] = $this->model_catalog_option->getOptionValues($product_option['option_id']);
		// 		}
		// 	}
		// }

		$this->load->model('sale/customer_group');

		$this->data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		// if (isset($this->request->post['product_discount'])) {
		// 	$this->data['product_discounts'] = $this->request->post['product_discount'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$this->data['product_discounts'] = $this->model_catalog_product->getProductDiscounts($this->request->get['product_id']);
		// } else {
		// 	$this->data['product_discounts'] = array();
		// }

		// if (isset($this->request->post['product_special'])) {
		// 	$this->data['product_specials'] = $this->request->post['product_special'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$this->data['product_specials'] = $this->model_catalog_product->getProductSpecials($this->request->get['product_id']);
		// } else {
		// 	$this->data['product_specials'] = array();
		// }

		// Images
		if (isset($this->request->post['product_image'])) {
			$product_images = $this->request->post['product_image'];
		} elseif (isset($this->request->get['product_id'])) {
			$product_images = $this->model_catalog_product->getProductImages($this->request->get['product_id']);
		} else {
			$product_images = array();
		}

		$this->data['product_images'] = array();

		foreach ($product_images as $product_image) {
			if ($product_image['image'] && file_exists(DIR_IMAGE . $product_image['image'])) {
				$image = $product_image['image'];
			} else {
				$image = 'no_image.jpg';
			}

			$this->data['product_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($image, 100, 100),
				'sort_order' => $product_image['sort_order']
			);
		}

		$this->data['no_image'] = $this->model_tool_image->resize('no_image.jpg', 100, 100);

		// Downloads
		// $this->load->model('catalog/download');

		// if (isset($this->request->post['product_download'])) {
		// 	$product_downloads = $this->request->post['product_download'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$product_downloads = $this->model_catalog_product->getProductDownloads($this->request->get['product_id']);
		// } else {
		// 	$product_downloads = array();
		// }

		// $this->data['product_downloads'] = array();

		// foreach ($product_downloads as $download_id) {
		// 	$download_info = $this->model_catalog_download->getDownload($download_id);

		// 	if ($download_info) {
		// 		$this->data['product_downloads'][] = array(
		// 			'download_id' => $download_info['download_id'],
		// 			'name'        => $download_info['name']
		// 		);
		// 	}
		// }

		// if (isset($this->request->post['product_related'])) {
		// 	$products = $this->request->post['product_related'];
		// } elseif (isset($this->request->get['product_id'])) {		
		// 	$products = $this->model_catalog_product->getProductRelated($this->request->get['product_id']);
		// } else {
		// 	$products = array();
		// }

		// $this->data['product_related'] = array();

		// foreach ($products as $product_id) {
		// 	$related_info = $this->model_catalog_product->getProduct($product_id);

		// 	if ($related_info) {
		// 		$this->data['product_related'][] = array(
		// 			'product_id' => $related_info['product_id'],
		// 			'name'       => $related_info['name']
		// 		);
		// 	}
		// }

		// if (isset($this->request->post['points'])) {
		// 	$this->data['points'] = $this->request->post['points'];
		// } elseif (!empty($product_info)) {
		// 	$this->data['points'] = $product_info['points'];
		// } else {
		// 	$this->data['points'] = '';
		// }

		// if (isset($this->request->post['product_reward'])) {
		// 	$this->data['product_reward'] = $this->request->post['product_reward'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$this->data['product_reward'] = $this->model_catalog_product->getProductRewards($this->request->get['product_id']);
		// } else {
		// 	$this->data['product_reward'] = array();
		// }

		// if (isset($this->request->post['product_layout'])) {
		// 	$this->data['product_layout'] = $this->request->post['product_layout'];
		// } elseif (isset($this->request->get['product_id'])) {
		// 	$this->data['product_layout'] = $this->model_catalog_product->getProductLayouts($this->request->get['product_id']);
		// } else {
		// 	$this->data['product_layout'] = array();
		// }

		// $this->load->model('design/layout');

		// $this->data['layouts'] = $this->model_design_layout->getLayouts();

		$this->template = 'catalog/product_form.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		$this->response->setOutput($this->render());
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['product_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 1) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}

		// if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
		// 	$this->error['model'] = $this->language->get('error_model');
		// }

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
		if (!$this->user->hasPermission('modify', 'catalog/product')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->error) {
			return true;
		} else {
			return false;
		}
	}


	// public function autocompletestockables() {
	// 	$json = array();

	// 	if (isset($this->request->get['filter_name'])  ) {
	// 		$this->load->model('catalog/product');

	// 		if (isset($this->request->get['filter_name'])) {
	// 			$filter_name = $this->request->get['filter_name'];
	// 		} else {
	// 			$filter_name = '';
	// 		}

	// 		if (isset($this->request->get['limit'])) {
	// 			$limit = $this->request->get['limit'];	
	// 		} else {
	// 			$limit = 20;	
	// 		}			

	// 		$data = array(
	// 			'filter_name'  => $filter_name,
	// 			'start'        => 0,
	// 			'limit'        => $limit,
	// 			'filter_product_type_ids' => array(1, 3),
	// 			'filter_status' => 1

	// 		);

	// 		$results = $this->model_catalog_product->getProducts($data);

	// 		foreach ($results as $result) {
	// 			$option_data = array();

	// 			$json[] = array(
	// 				'product_id' => $result['product_id'],
	// 				'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
	// 				'model'      => $result['model'],
	// 				// 'option'     => $option_data,
	// 				'price'      => $result['price']
	// 			);	
	// 		}
	// 	}

	// 	$this->response->setOutput(json_encode($json));
	// }

	// public function autocompletetreatments() {
	// 	$json = array();

	// 	if (isset($this->request->get['filter_name'])  ) {
	// 		$this->load->model('catalog/product');

	// 		if (isset($this->request->get['filter_name'])) {
	// 			$filter_name = $this->request->get['filter_name'];
	// 		} else {
	// 			$filter_name = '';
	// 		}

	// 		if (isset($this->request->get['limit'])) {
	// 			$limit = $this->request->get['limit'];	
	// 		} else {
	// 			$limit = 20;	
	// 		}			

	// 		$data = array(
	// 			'filter_name'  => $filter_name,
	// 			'start'        => 0,
	// 			'limit'        => $limit,
	// 			'filter_product_type_ids' => array(2),
	// 			'filter_status' => 1

	// 		);

	// 		$results = $this->model_catalog_product->getProducts($data);

	// 		foreach ($results as $result) {
	// 			$option_data = array();

	// 			$json[] = array(
	// 				'product_id' => $result['product_id'],
	// 				'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
	// 				'price'      => $result['price']
	// 			);	
	// 		}
	// 	}

	// 	$this->response->setOutput(json_encode($json));
	// }

	// public function autocompletesellables() {
	// 	$json = array();

	// 	if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model']) || isset($this->request->get['filter_category_id'])) {
	// 		$this->load->model('catalog/product');

	// 		if (isset($this->request->get['filter_name'])) {
	// 			$filter_name = $this->request->get['filter_name'];
	// 		} else {
	// 			$filter_name = '';
	// 		}

	// 		if (isset($this->request->get['limit'])) {
	// 			$limit = $this->request->get['limit'];	
	// 		} else {
	// 			$limit = 20;	
	// 		}			

	// 		$data = array(
	// 			'filter_name'  => $filter_name,
	// 			'start'        => 0,
	// 			'limit'        => $limit,
	// 			'filter_product_type_ids' => array(1, 2, 3),
	// 			'filter_status' => 1

	// 		);

	// 		$results = $this->model_catalog_product->getProducts($data);

	// 		foreach ($results as $result) {
	// 			$option_data = array();

	// 			$json[] = array(
	// 				'product_id' => $result['product_id'],
	// 				'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
	// 				'model'      => $result['model'],
	// 				// 'option'     => $option_data,
	// 				'price'      => $result['price']
	// 			);	
	// 		}
	// 	}

	// 	$this->response->setOutput(json_encode($json));
	// }


	public function getproductidbyname(){
		$json = array();

		
		if (isset($this->request->get['name'])) {
			$query = $this->db->query("SELECT * FROM oc_product p LEFT JOIN oc_product_description pd ON p.product_id = pd.product_id WHERE pd.name = '" . $this->request->get['name'] . "' AND pd.language_id = '" . $this->config->get('config_language_id') . "'");

			if (!$query->num_rows) {
				$json['error'] = 'not exist';
			} else {
				$json['success'] = 'success';
				$json['product_id'] = $query->row['product_id'];
			}
		} else {
			$json['error'] = 'not exists2';
		}

		$this->response->setOutput(json_encode($json));
		
	}

	// '2014-10-20 22:21'
	public function all() {
		$json = array();
		// if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/product');

			// if (isset($this->request->get['filter_name'])) {
			// 	$filter_name = $this->request->get['filter_name'];
			// } else {
			// 	$filter_name = '';
			// }
			if (isset($this->request->get['filter_product_type_ids'])) {
				$filter_product_type_ids = explode(',', $this->request->get['filter_product_type_ids']);
			} else {
				$filter_product_type_ids = array();
			}

			if (isset($this->request->get['filter_status_ids'])) {
				$filter_status_ids = explode(',', $this->request->get['filter_status_ids']);
			} else {
				$filter_status_ids = array();
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 99999;	
			}			

			$data = array(
				// 'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit,
				'filter_product_type_ids' => $filter_product_type_ids,
				'filter_status_ids' => $filter_status_ids,
			);

			$results = $this->model_catalog_product->getProducts($data);

			foreach ($results as $result) {
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'value'      => $result['value'],
					'unit'      => $result['unit'],
					'price'      => $result['price']
				);	
			}
		// }

		$this->response->setOutput(json_encode($json));
	}


	public function sellable() {
		$json = array();

		// if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/product');

			// if (isset($this->request->get['filter_name'])) {
			// 	$filter_name = $this->request->get['filter_name'];
			// } else {
			// 	$filter_name = '';
			// }

			if (isset($this->request->get['filter_product_type_ids'])) {
				$filter_product_type_ids = explode(',', $this->request->get['filter_product_type_ids']);
			} else {
				$filter_product_type_ids = array();
			}


			if (isset($this->request->get['filter_status_ids'])) {
				$filter_status_ids = explode(',', $this->request->get['filter_status_ids']);
			} else {
				$filter_status_ids = array();
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 99999;	
			}			

			$data = array(
				// 'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit,
				'filter_subtract'     => 1, 
				'filter_product_type_ids' => $filter_product_type_ids,
				'filter_status_ids' => $filter_status_ids,
			);

			$results = $this->model_catalog_product->getProducts($data);
// $this->load->out($results);
			foreach ($results as $result) {
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'value'      => $result['value'],
					'unit'      => $result['unit'],
					'price'      => $result['price']
				);	
			}
		// }

		$this->response->setOutput(json_encode($json));
	}

	public function treatment() {
		$json = array();

		// if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/product');

			// if (isset($this->request->get['filter_name'])) {
			// 	$filter_name = $this->request->get['filter_name'];
			// } else {
			// 	$filter_name = '';
			// }

			if (isset($this->request->get['filter_product_type_ids'])) {
				$filter_product_type_ids = explode(',', $this->request->get['filter_product_type_ids']);
			} else {
				$filter_product_type_ids = array();
			}


			if (isset($this->request->get['filter_status_ids'])) {
				$filter_status_ids = explode(',', $this->request->get['filter_status_ids']);
			} else {
				$filter_status_ids = array();
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 99999;	
			}			

			$data = array(
				// 'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit,
				'filter_subtract'     => 0, 
				'filter_product_type_ids' => $filter_product_type_ids,
				'filter_status_ids' => $filter_status_ids,
			);

			$this->load->out($data);

			$results = $this->model_catalog_product->getProducts($data);
// $this->load->out($results);
			foreach ($results as $result) {
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'value'      => $result['value'],
					'unit'      => $result['unit'],
					'price'      => $result['price']
				);	
			}
		// }

		$this->response->setOutput(json_encode($json));
	}


	// '2014-10-20 22:21'
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/product');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_product_type_ids'])) {
				$filter_product_type_ids = explode(',', $this->request->get['filter_product_type_ids']);
			} else {
				$filter_product_type_ids = array();
			}


			if (isset($this->request->get['filter_status_ids'])) {
				$filter_status_ids = explode(',', $this->request->get['filter_status_ids']);
			} else {
				$filter_status_ids = array();
			}

			if (isset($this->request->get['filter_subtract'])) {
				$filter_subtract = $this->request->get['filter_subtract'];
			} else {
				$filter_subtract = null;
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];	
			} else {
				$limit = 20;	
			}			

			$data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit,
				'filter_subtract'        => $filter_subtract,
				'filter_product_type_ids' => $filter_product_type_ids,
				'filter_status_ids' => $filter_status_ids,
			);

			$results = $this->model_catalog_product->getProducts($data);

			foreach ($results as $result) {
				// $unit_id = $results[]
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),	
					'model'      => $result['model'],
					'price'      => $result['price'],
					'unit'      => $result['unit'],
					'value'      => $result['value']
				);	
			}
		}

		$this->response->setOutput(json_encode($json));
	}
}
?>