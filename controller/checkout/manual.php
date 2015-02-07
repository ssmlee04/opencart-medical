<?php 
class ControllerCheckoutManual extends Controller {
	public function index() {

		// '2014-09-08 15:41'
		$this->session->data['store_id'] = $this->request->post['store_id'];

		$this->language->load('checkout/manual');

		$json = array();

		$this->load->library('user');

		$this->user = new User($this->registry);

		$is_insert = (isset($this->request->get['is_insert']) ? $this->request->get['is_insert'] : false);

		if ($this->user->isLogged() && $this->user->hasPermission('modify', 'sale/order')) {	

			
			// Reset everything
			$this->cart->clear();
			$this->customer->logout();

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);			
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);

			// Settings
			$this->load->model('setting/setting');

			$settings = $this->model_setting_setting->getSetting('config', $this->request->post['store_id']);

			foreach ($settings as $key => $value) {
				$this->config->set($key, $value);
			}

		
			// Customer
			if ($this->request->post['customer_id']) {

				$this->load->model('account/customer');

				$customer_info = $this->model_account_customer->getCustomer($this->request->post['customer_id']);

				if ($customer_info) {
					$this->customer->login($customer_info['email'], '', true);
					$this->cart->clear();
				} else {
					$json['error']['customer'] = $this->language->get('error_customer');
				}
			} else {
				// Customer Group
				$this->config->set('config_customer_group_id', $this->request->post['customer_group_id']);
			}

			// Product
			$this->load->model('catalog/product');

			if (isset($this->request->post['order_product'])) {
				foreach ($this->request->post['order_product'] as $order_product) {
					$product_info = $this->model_catalog_product->getProduct($order_product['product_id']);

					if ($product_info) {	
						//$option_data = array();

						// if (isset($order_product['order_option'])) {
						// 	foreach ($order_product['order_option'] as $option) {
						// 		if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'image') { 
						// 			$option_data[$option['product_option_id']] = $option['product_option_value_id'];
						// 		} elseif ($option['type'] == 'checkbox') {
						// 			$option_data[$option['product_option_id']][] = $option['product_option_value_id'];
						// 		} elseif ($option['type'] == 'text' || $option['type'] == 'textarea' || $option['type'] == 'file' || $option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
						// 			$option_data[$option['product_option_id']] = $option['value'];						
						// 		}
						// 	}
						// }

						$this->cart->add($order_product['product_id'], $order_product['quantity'], null);
					}
				}
			}


			if (isset($this->request->post['product_id'])) {
				$product_info = $this->model_catalog_product->getProduct($this->request->post['product_id']);

				if ($product_info) {
					if (isset($this->request->post['quantity'])) {
						$quantity = $this->request->post['quantity'];
					} else {
						$quantity = 1;
					}

					$option = array();	
					// if (isset($this->request->post['option'])) {
					// 	$option = array_filter($this->request->post['option']);
					// } else {
					// 	$option = array();	
					// }

					// $product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

					// foreach ($product_options as $product_option) {
					// 	if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					// 		$json['error']['product']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
					// 	}
					// }

					if (!isset($json['error']['product']['option'])) {
						$this->cart->add($this->request->post['product_id'], $quantity, $option);
					}
				}
			}

			if (!$this->request->post['customer_id']) {
				$json['error']['nocustomer'] = $this->language->get('error_customer');
			}

			if (!$this->request->post['store_id']) {
				$json['error']['store'] = $this->language->get('error_store');
			}	

			// update always has stock
			if (!$is_insert) {
				
			}

			// Stock
			else if (!$this->cart->hasStock($this->session->data['store_id'])) {
				$json['error']['product']['stock'] = $this->language->get('error_stock');
			}		


			// Tax
			// if ($this->cart->hasShipping()) {
			// 	$this->tax->setShippingAddress($this->request->post['shipping_country_id'], $this->request->post['shipping_zone_id']);
			// } else {
			// 	$this->tax->setShippingAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));
			// }

			// $this->tax->setPaymentAddress($this->request->post['payment_country_id'], $this->request->post['payment_zone_id']);				
			// $this->tax->setStoreAddress($this->config->get('config_country_id'), $this->config->get('config_zone_id'));	

			// Products
			$json['order_product'] = array();

			$products = $this->cart->getProducts();

			$subtotal = 0;

			foreach ($products as $product) {
				$product_total = 0;

				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}	

				$price = 0;
				if (!empty($this->request->post['order_product']))
				foreach ($this->request->post['order_product'] as $product_3) {
					if ($product_3['product_id'] == $product['product_id']) {
						$price = str_replace(',', '', $product_3['price']);
					}
				}

				if ($product['minimum'] > $product_total) {
					$json['error']['product']['minimum'][] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
				}	

				// $option_data = array();

				// foreach ($product['option'] as $option) {
				// 	$option_data[] = array(
				// 		'product_option_id'       => $option['product_option_id'],
				// 		'product_option_value_id' => $option['product_option_value_id'],
				// 		'name'                    => $option['name'],
				// 		'value'                   => $option['option_value'],
				// 		'type'                    => $option['type']
				// 	);
				// }

				// $download_data = array();

				// foreach ($product['download'] as $download) {
				// 	$download_data[] = array(
				// 		'name'      => $download['name'],
				// 		'filename'  => $download['filename'],
				// 		'mask'      => $download['mask'],
				// 		'remaining' => $download['remaining']
				// 	);
				// }

				$last_cost = 0;
				$purchase_product = $this->db->query("SELECT * FROM oc_purchase_product WHERE product_id = " . $product['product_id'] . " ORDER BY purchase_product_id DESC LIMIT 1");
				if ($purchase_product->num_rows) $last_cost = $purchase_product->row['cost'];

				$total = $price *  $product['quantity'];
				$subtotal += $total;

				// $this->load->out($price);
				// $this->load->out([$price, $product['quantity'], $product['quantity'] * ]);
				$json['order_product'][] = array(
					'product_id' => $product['product_id'],
					'name'       => $product['name'],
					'model'      => $product['model'], 
					// 'option'     => $option_data,
					// 'download'   => $download_data,
					'quantity'   => $product['quantity'],
					'stock'      => $product['stock'],
					'ref_price'      => number_format($product['price'], 2),	
					'last_cost'      => number_format($last_cost, 2),	
					'price'      => number_format($price, 2),	
					'price_total'      => number_format($price * $product['quantity'], 2),	
					'total'      => $total,	
					'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
					// 'reward'     => $product['reward']				
				);
			}

			// Voucher
			$this->session->data['vouchers'] = array();

			if (isset($this->request->post['order_voucher'])) {
				foreach ($this->request->post['order_voucher'] as $voucher) {
					$this->session->data['vouchers'][] = array(
						'voucher_id'       => $voucher['voucher_id'],
						'description'      => $voucher['description'],
						'code'             => substr(md5(mt_rand()), 0, 10),
						// 'from_name'        => $voucher['from_name'],
						// 'from_email'       => $voucher['from_email'],
						// 'to_name'          => $voucher['to_name'],
						// 'to_email'         => $voucher['to_email'],
						'voucher_theme_id' => $voucher['voucher_theme_id'], 
						'message'          => $voucher['message'],
						'amount'           => $voucher['amount']    
					);
				}
			}

			// Add a new voucher if set
			// if (isset($this->request->post['amount']) && (float)$this->request->post['amount'] > 0) {
			// 	// if ((utf8_strlen($this->request->post['from_name']) < 1) || (utf8_strlen($this->request->post['from_name']) > 64)) {
			// 	// 	$json['error']['vouchers']['from_name'] = $this->language->get('error_from_name');
			// 	// }  

			// 	// if ((utf8_strlen($this->request->post['from_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['from_email'])) {
			// 	// 	$json['error']['vouchers']['from_email'] = $this->language->get('error_email');
			// 	// }

			// 	// if ((utf8_strlen($this->request->post['to_name']) < 1) || (utf8_strlen($this->request->post['to_name']) > 64)) {
			// 	// 	$json['error']['vouchers']['to_name'] = $this->language->get('error_to_name');
			// 	// }       

			// 	// if ((utf8_strlen($this->request->post['to_email']) > 96) || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $this->request->post['to_email'])) {
			// 	// 	$json['error']['vouchers']['to_email'] = $this->language->get('error_email');
			// 	// }


			// 	if (($this->request->post['amount'] < 1) || ($this->request->post['amount'] > 1000)) {
			// 		$json['error']['vouchers']['amount'] = sprintf($this->language->get('error_amount'), $this->currency->format(1, false, 1), $this->currency->format(1000, false, 1) . ' ' . $this->config->get('config_currency'));
			// 	}

			// 	if (!isset($json['error']['vouchers'])) { 
			// 		$voucher_data = array(
			// 			'order_id'         => 0,
			// 			'code'             => substr(md5(mt_rand()), 0, 10),
			// 			// 'from_name'        => $this->request->post['from_name'],
			// 			// 'from_email'       => $this->request->post['from_email'],
			// 			// 'to_name'          => $this->request->post['to_name'],
			// 			// 'to_email'         => $this->request->post['to_email'],
			// 			'voucher_theme_id' => $this->request->post['voucher_theme_id'], 
			// 			'message'          => $this->request->post['message'],
			// 			'amount'           => $this->request->post['amount'],
			// 			'status'           => true             
			// 		); 
			

			// 		$this->load->model('checkout/voucher');

			// 		$voucher_id = $this->model_checkout_voucher->addVoucher(0, $voucher_data);  

			// 		$this->session->data['vouchers'][] = array(
			// 			'voucher_id'       => $voucher_id,
			// 			'description'      => sprintf($this->language->get('text_for'), $this->currency->format($this->request->post['amount'], $this->config->get('config_currency')), '' /*$this->request->post['to_name']*/),
			// 			'code'             => substr(md5(mt_rand()), 0, 10),
			// 			// 'from_name'        => $this->request->post['from_name'],
			// 			// 'from_email'       => $this->request->post['from_email'],
			// 			// 'to_name'          => $this->request->post['to_name'],
			// 			// 'to_email'         => $this->request->post['to_email'],
			// 			'voucher_theme_id' => $this->request->post['voucher_theme_id'], 
			// 			'message'          => $this->request->post['message'],
			// 			'amount'           => $this->request->post['amount']            
			// 		); 
			// 	}
			// }

			$json['order_voucher'] = array();

			// foreach ($this->session->data['vouchers'] as $voucher) {
			// 	$json['order_voucher'][] = array(
			// 		'voucher_id'       => $voucher['voucher_id'],
			// 		'description'      => $voucher['description'],
			// 		'code'             => $voucher['code'],
			// 		// 'from_name'        => $voucher['from_name'],
			// 		// 'from_email'       => $voucher['from_email'],
			// 		// 'to_name'          => $voucher['to_name'],
			// 		// 'to_email'         => $voucher['to_email'],
			// 		'voucher_theme_id' => $voucher['voucher_theme_id'], 
			// 		'message'          => $voucher['message'],
			// 		'amount'           => $voucher['amount']    
			// 	);
			// }

			$this->load->model('setting/extension');
			// Totals
			$json['order_total'] = array();		

			$json['order_total'][] = array(
				'code' => 'total',
				'title' => '訂單計算項目',
				'text' => $subtotal,
				'value' => $subtotal,
				'sort_order' => '9',
			);			


			if (!isset($json['error'])) { 
				$json['success'] = $this->language->get('text_success');
			} else {
				$json['error']['warning'] = $this->language->get('error_warning');
			}

			// Reset everything
			// $this->cart->clear();
			// $this->customer->logout();

			//unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			//unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['coupon']);
			unset($this->session->data['reward']);
			unset($this->session->data['voucher']);
			unset($this->session->data['vouchers']);
		} else {
			$json['error']['warning'] = $this->language->get('error_permission');
		}

		$this->response->setOutput(json_encode($json));	
	}
}
?>