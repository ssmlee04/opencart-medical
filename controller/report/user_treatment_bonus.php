<?php
class ControllerReportUserTreatmentBonus extends Controller {
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
			$filter_date_start = date('Y-m-d', strtotime(date('Y') . '-' . date('m') . '-01'));
		}

		if (isset($this->request->get['filter_date_end'])) {
			$filter_date_end = $this->request->get['filter_date_end'];
		} else {
			$filter_date_end = date('Y-m-d');
		}
// $this->load->test($this->request->get);
		if (isset($this->request->get['filter_order_status_id'])) {
			$filter_order_status_id = $this->request->get['filter_order_status_id'];
		} else {
			$filter_order_status_id = 0;
		}	

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

		$data['filter_date_start'] = $filter_date_start;
		$data['filter_date_end'] = $filter_date_end;

		// main case (used or not)
		$yy = "(DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "' AND total_amount > 0)";
		

		// nonmain case 
		$xx = " (ct.status = 2 AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		$xx .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		$xx .= " AND total_amount = 0 )";
		
		// product_type_id = 3 case
		$zz = " (ct.status = 2 AND ct.total_amount > 0 AND p.product_type_id = 3 AND DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "') ";
		// $zz = " (ct.status = 0 AND p.product_type_id = 3 AND DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "') ";

		$sql = "SELECT ct.*, p.*, ct.date_modified as tr_date_modified, ct.date_added as tr_date_added, pd.name as pname, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct LEFT JOIN oc_product p ON ct.product_id = p.product_id ";
		$sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		$sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		$sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		$sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		$sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		$sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";
		$sql .= " LEFT JOIN oc_product_description pd ON ct.product_id = pd.product_id ";
		$sql .= " WHERE ($xx or $yy or $zz ) AND pd.language_id = '2'";
		
		$q = $this->db->query($sql);
		$queue = array();
		$treatment_usage_ids = array();
		$treatment_bonus = array();

		// pre
		foreach ($q->rows as $qq) {
			if ($qq['treatment_usage_id'] > 0 && !in_array($qq['treatment_usage_id'], $treatment_usage_ids) ) {	
				$treatment_usage_ids[] = $qq['treatment_usage_id'];
			}
		}
// $this->load->test($q->rows);
		// actual used ids

		$mainarrs = [];

		foreach ($treatment_usage_ids as $k => $treatment_usage_id) {
			$is_main = false;
			$main_total = 0;
			$m = 0;

			foreach ($q->rows as $qq) { 
				if ($qq['total_amount'] > 0 && $qq['treatment_usage_id'] == $treatment_usage_id) {
					$is_main = true;
					$main_total += $qq['total_amount'];

					if ($qq['date_added'] != $qq['date_modified'] && $treatment_usage_id>  0) {
						$mainarrs[] = $treatment_usage_id;
					}
				}
			}

			// if ($m > 0) {
			// $sql = "SELECT ct.*, p.*, ct.date_modified as tr_date_modified, ct.date_added as tr_date_added, pd.name as pname, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct LEFT JOIN oc_product p ON ct.product_id = p.product_id ";
			// $sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
			// $sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
			// $sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
			// $sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
			// $sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
			// $sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";
			// $sql .= " LEFT JOIN oc_product_description pd ON ct.product_id = pd.product_id ";
			// $sql .= " WHERE treatment_usage_id = '$m' AND total_amount = 0 AND pd.language_id = '2'";
			// $qqqqq = $this->db->query($sql);
			// $q->rows = array_merge($q->rows, $qqqqq->rows);
			// }
			

			$order_id = 0;
			$product_id = 0;
			$ufullname = '';
			$cfullname = '';
			$pname = '';
			$cid = 0;
			$subquantity = 0;
			$beauty_name = '';
			$consultant_name = '';
			$doctor_name = '';
			$outsource_name = '';

			$bonus_doctor = 0;
			$bonus_consultant = 0;
			$bonus_beauty = 0;
			$bonus_outsource = 0;

			foreach ($q->rows as $q2) {
				if ($q2['treatment_usage_id'] == $treatment_usage_id) {
					$ufullname = $q2['ufullname'];
					$subquantity += $q2['subquantity'];
					$product_type_id = $q2['product_type_id'];
					// $treatment_usage_id = $q2['treatment_usage_id'];
					$cfullname = $q2['cfullname'];
					$order_id = $q2['order_id'];
					$product_id = $q2['product_id'];
					$cid = $q2['customer_id'];
					$pname = $q2['pname'];
					
					$beauty_name = $q2['beauty_name'];
					$bonus_beauty += $q2['bonus_beauty'] + $q2['bonus_beauty_fixed'];
					$bonus_consultant += $q2['bonus_consultant'] + $q2['bonus_consultant_fixed'];
					$bonus_outsource += $q2['bonus_outsource'] + $q2['bonus_outsource_fixed'];
					$bonus_doctor += $q2['bonus_doctor'] + $q2['bonus_doctor_fixed'];
					$consultant_name = $q2['consultant_name'];
					$doctor_name = $q2['doctor_name'];
					$outsource_name = $q2['outsource_name'];

				}
			};

			if ($is_main) {
				$treatment_bonus[] = array(
					'ufullname' => $ufullname,
					'cfullname' => $cfullname,
					// 'product_type_id' => $qq['product_type_id'],
					'treatment_usage_id' => $treatment_usage_id,
					'comment' => $qq['comment'],
					'customer_id' => $cid,
					'product_type_id' => $product_type_id,
					'consultant_name' => $consultant_name,
					'outsource_name' => $outsource_name,
					'doctor_name' => $doctor_name,
					'beauty_name' => $beauty_name,
					// 'cfullname' => $qq['cfullname'],
					'date_modified' => explode(' ', $qq['tr_date_modified'])[0],
					'date_added' => explode(' ', $qq['tr_date_added'])[0],
					'product_id' => $product_id,
					'product_name' => $pname,
					'order_id' => $order_id,

					'bonus_doctor' => $bonus_doctor,
					'bonus_consultant' => $bonus_consultant,
					'bonus_beauty' => $bonus_beauty,
					'bonus_outsource' => $bonus_outsource,
 					'subquantity' => -1* $subquantity,
					'total_amount' => round($main_total),
					'color' => 'pink'
					// 'total' => $order_info['total'], 
					// 'payment_cash' => $payment_cash, 
					// 'payment_visa' => $payment_visa, 
					// 'payment_balance' => $payment_balance, 
					// 'payment_final' => $payment_final, 
				);
			} else {
				$treatment_bonus[] = array(
					'ufullname' => $ufullname,
					'cfullname' => $cfullname,
					'treatment_usage_id' => $treatment_usage_id,
					'product_type_id' => $product_type_id,
					// 'customer_transaction_id' => $qq['customer_transaction_id'],
					'comment' => $qq['comment'],
					'customer_id' => $cid,
					'consultant_name' => $consultant_name,
					'outsource_name' => $outsource_name,
					'doctor_name' => $doctor_name,
					'beauty_name' => $beauty_name,
					// 'cfullname' => $qq['cfullname'],
					'date_added' => explode(' ', $qq['tr_date_added'])[0],
					'date_modified' => explode(' ', $qq['tr_date_modified'])[0],
					'product_id' => $product_id,
					'product_name' => $pname,
					'order_id' => $order_id,
					'bonus_doctor' => $bonus_doctor,
					'bonus_consultant' => $bonus_consultant,
					'bonus_beauty' => $bonus_beauty,
					'bonus_outsource' => $bonus_outsource,

					'subquantity' => -1* $subquantity,
					'total_amount' => 0,
					'color' => 'lightblue'
					// 'total' => $order_info['total'], 
					// 'payment_cash' => $payment_cash, 
					// 'payment_visa' => $payment_visa, 
					// 'payment_balance' => $payment_balance, 
					// 'payment_final' => $payment_final, 
				);
			}
		} 

		// foreach ($mainarrs as $m) {
		// 	$sql = "SELECT ct.*, p.*, ct.date_modified as tr_date_modified, ct.date_added as tr_date_added, pd.name as pname, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct LEFT JOIN oc_product p ON ct.product_id = p.product_id ";
		// $sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		// $sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		// $sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		// $sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		// $sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		// $sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";
		// $sql .= " LEFT JOIN oc_product_description pd ON ct.product_id = pd.product_id ";
		// $sql .= " WHERE treatment_usage_id = '$m' AND total_amount = 0 AND pd.language_id = '2'";
		// $qqqqq = $this->db->query($sql);
		// }
		// $q->rows = array_merge($q->rows, $qqqqq->rows);


		// $this->load->Test($q->rows);
		// record non-treatments here
		// if main is not used add main
		foreach ($q->rows as $qq) {
			if ($qq['treatment_usage_id'] == 0 && $qq['total_amount'] > 0 && $qq['product_type_id'] != 3) {	
				$treatment_bonus[] = array(
					'ufullname' => $qq['ufullname'],
					'cfullname' => $qq['cfullname'],
					// 'product_type_id' => $qq['product_type_id'],
					'treatment_usage_id' => $qq['treatment_usage_id'],
					// 'customer_transaction_id' => $qq['customer_transaction_id'],
					'comment' => $qq['comment'],
					'customer_id' => $qq['customer_id'],
					'product_type_id' => $qq['product_type_id'],
					'consultant_name' => $qq['consultant_name'],
					'outsource_name' => $qq['outsource_name'],
					'doctor_name' => $qq['doctor_name'],
					'beauty_name' => $qq['beauty_name'],
					// 'cfullname' => $qq['cfullname'],
					'date_added' => explode(' ', $qq['tr_date_added'])[0],
					'date_modified' => explode(' ', $qq['tr_date_modified'])[0],
					'product_id' => $qq['product_id'],
					'product_name' => $qq['pname'],
					'order_id' => $qq['order_id'],
					'bonus_doctor' => 0,
					'bonus_beauty' => 0,
					'bonus_consultant' => 0,
					'bonus_outsource' => 0,
					'subquantity' => '',
					'total_amount' => round($qq['total_amount']),
					'color' => 'lightgreen'
					// 'total' => $order_info['total'], 
					// 'payment_cash' => $payment_cash, 
					// 'payment_visa' => $payment_visa, 
					// 'payment_balance' => $payment_balance, 
					// 'payment_final' => $payment_final, 
				);
			}
		}


		foreach ($q->rows as $qq) {
			if ($qq['product_type_id'] == 3) {	

				$pro = $this->db->query("SELECT * FROM oc_order_product WHERE order_id = '" .$qq['order_id'] . "' AND product_id = '" . $qq['product_id'] ."'")->row;
				// $this->load->test($pro);
				$treatment_bonus[] = array(
					'cfullname' => $qq['cfullname'],
					'ufullname' => $qq['ufullname'],
					// 'product_type_id' => $qq['product_type_id'],
					'treatment_usage_id' => $qq['treatment_usage_id'],
					// 'customer_transaction_id' => $qq['customer_transaction_id'],

					'product_type_id' => $qq['product_type_id'],
					'comment' => $qq['comment'],
					'customer_id' => $qq['customer_id'],
					'consultant_name' => $qq['consultant_name'],
					'outsource_name' => $qq['outsource_name'],
					'doctor_name' => $qq['doctor_name'],
					'beauty_name' => $qq['beauty_name'],
					// 'cfullname' => $qq['cfullname'],
					'date_added' => explode(' ', $qq['tr_date_added'])[0],
					'date_modified' => explode(' ', $qq['tr_date_modified'])[0],
					'product_id' => $qq['product_id'],
					'product_name' => $qq['pname'],
					'order_id' => $qq['order_id'],
					'bonus_beauty' => 0,
					'bonus_doctor' => 0,
					'bonus_consultant' => 0,
					'bonus_outsource' => 0,
					'subquantity' => '',
					'total_amount' => round($pro['total']),
					'color' => 'lightyellow'
					// 'total' => $order_info['total'], 
					// 'payment_cash' => $payment_cash, 
					// 'payment_visa' => $payment_visa, 
					// 'payment_balance' => $payment_balance, 
					// 'payment_final' => $payment_final, 
				);
			}
		}



		// $yy = "(DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "' AND total_amount > 0)";
		$uu = " (ct.treatment_usage_id > 0 AND DATE(ct.date_modified) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		$uu .= " AND DATE(ct.date_modified) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		$uu .= " AND total_amount > 0 AND ct.date_modified <> ct.date_added)";
		// $zz = " (ct.status = 0 AND p.product_type_id = 3 AND DATE(ct.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'AND DATE(ct.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "') ";

		$sql = "SELECT ct.*, p.*, ct.date_modified as tr_date_modified, ct.date_added as tr_date_added, pd.name as pname, u1.fullname as beauty_name, u2.fullname as consultant_name, u3.fullname as outsource_name, u4.fullname as doctor_name, u0.fullname as ufullname, c.fullname as cfullname FROM oc_customer_transaction ct LEFT JOIN oc_product p ON ct.product_id = p.product_id ";
		$sql .= " LEFT JOIN oc_customer c ON ct.customer_id = c.customer_id";
		$sql .= " LEFT JOIN oc_user u0 ON ct.user_id = u0.user_id";
		$sql .= " LEFT JOIN oc_user u1 ON ct.beauty_id = u1.user_id";
		$sql .= " LEFT JOIN oc_user u2 ON ct.consultant_id = u2.user_id";
		$sql .= " LEFT JOIN oc_user u3 ON ct.outsource_id = u3.user_id";
		$sql .= " LEFT JOIN oc_user u4 ON ct.doctor_id = u4.user_id";
		$sql .= " LEFT JOIN oc_product_description pd ON ct.product_id = pd.product_id ";
		$sql .= " WHERE ($uu) AND pd.language_id = '2'";
		
		$q = $this->db->query($sql);
		foreach ($q->rows as $qq) {
			$treatment_usage_id = $qq['treatment_usage_id'];

			$qqqq = $this->db->query("SELECT *, sum(subquantity) as subquantity FROM oc_customer_transaction WHERE treatment_usage_id = '$treatment_usage_id' GROUP BY treatment_usage_id")->row;

			$treatment_bonus[] = array(
					'cfullname' => $qq['cfullname'],
					'ufullname' => $qq['ufullname'],
					'product_type_id' => $qq['product_type_id'],
					'treatment_usage_id' => $qq['treatment_usage_id'],
					// 'customer_transaction_id' => $qq['customer_transaction_id'],
					'comment' => $qq['comment'],
					'customer_id' => $qq['customer_id'],
					'consultant_name' => $qq['consultant_name'],
					'outsource_name' => $qq['outsource_name'],
					'doctor_name' => $qq['doctor_name'],
					'beauty_name' => $qq['beauty_name'],
					// 'cfullname' => $qq['cfullname'],
					'date_added' => explode(' ', $qq['tr_date_added'])[0],
					'date_modified' => explode(' ', $qq['tr_date_modified'])[0],
					'product_id' => $qq['product_id'],
					'product_name' => $qq['pname'],
					'order_id' => $qq['order_id'],

					'subquantity' => -1 * $qqqq['subquantity'],
					'total_amount' => 0, 
					'color' => 'red',
					// 'total' => $order_info['total'], 
					'bonus_doctor' => 0,
					'bonus_consultant' => 0,
					'bonus_outsource' => 0,
					'bonus_beauty' => 0,
					// 'payment_cash' => $payment_cash, 
					// 'payment_visa' => $payment_visa, 
					// 'payment_balance' => $payment_balance, 
					// 'payment_final' => $payment_final, 
				);

		}


// $this->load->test($treatment_bonus);
$trlist = array();
$minis = -1;
foreach ($treatment_bonus as $ttr) {
	
	if (!isset($trlist[$ttr['treatment_usage_id']]) && $ttr['treatment_usage_id'] > 0) {
		$trlist[$ttr['treatment_usage_id']] = array(
			'subquantity' => 0,
			'total_amount' => 0,
			'product_name' => '',
			'product_id' => '',
			'date_added' => '9999-99-99',
			'date_modified' => '9999-99-99',
			'beauty_name' => '',
			'doctor_name' => '',
			'product_type_id' => 0,
			'outsource_name' => '',
			'consultant_name' => '',
			'customer_id' => '',
			'ufullname' => '',
			'cfullname' => '',
			'bonus_doctor' => 0,
			'bonus_beauty' => 0,
			'bonus_consultant' => 0,
			'bonus_outsource' => 0,
			'treatment_usage_id' => $ttr['treatment_usage_id'],
		);
	}

	if ($ttr['treatment_usage_id']  > 0) {
	$trlist[$ttr['treatment_usage_id']]['total_amount'] += $ttr['total_amount'];
	$trlist[$ttr['treatment_usage_id']]['date_added'] = min($trlist[$ttr['treatment_usage_id']]['date_added'], $ttr['date_added']);
	$trlist[$ttr['treatment_usage_id']]['date_modified'] = min($trlist[$ttr['treatment_usage_id']]['date_modified'], $ttr['date_modified']);
	$trlist[$ttr['treatment_usage_id']]['ufullname'] = $ttr['ufullname'];
	$trlist[$ttr['treatment_usage_id']]['cfullname'] = $ttr['cfullname'];
	$trlist[$ttr['treatment_usage_id']]['comment'] = $ttr['comment'];
	$trlist[$ttr['treatment_usage_id']]['beauty_name'] = $ttr['beauty_name'];
	$trlist[$ttr['treatment_usage_id']]['doctor_name'] = $ttr['doctor_name'];
	$trlist[$ttr['treatment_usage_id']]['outsource_name'] = $ttr['outsource_name'];
	$trlist[$ttr['treatment_usage_id']]['consultant_name'] = $ttr['consultant_name'];
	$trlist[$ttr['treatment_usage_id']]['product_name'] = $ttr['product_name'];
	$trlist[$ttr['treatment_usage_id']]['customer_id'] = $ttr['customer_id'];
	$trlist[$ttr['treatment_usage_id']]['product_type_id'] = $ttr['product_type_id'];
	$trlist[$ttr['treatment_usage_id']]['subquantity'] = $ttr['subquantity'];
	$trlist[$ttr['treatment_usage_id']]['bonus_doctor'] += $ttr['bonus_doctor'];
	$trlist[$ttr['treatment_usage_id']]['bonus_consultant'] += $ttr['bonus_consultant'];
	$trlist[$ttr['treatment_usage_id']]['bonus_beauty'] += $ttr['bonus_beauty'];
	$trlist[$ttr['treatment_usage_id']]['bonus_outsource'] += $ttr['bonus_outsource'];
		
	} else {
		$trlist[$minis--] = $ttr;
	}
	
	// $trlist[$ttr['treatment_usage_id']]['']
	# code...
	// if ()
}

foreach ($trlist as $k => $tr) {
	if ($tr['subquantity']=='') {
		$trlist[$k]['date'] = $tr['date_added'];
	} else {
		$trlist[$k]['date'] = $tr['date_modified'];
	}
	if ($trlist[$k]['date'] > $filter_date_end) {
		$trlist[$k]['date'] = 'purchase on '.  $tr['date_added'];
		$trlist[$k]['subquantity'] = '-';
	}
	else if ($trlist[$k]['subquantity'] == '') {
		$trlist[$k]['date'] = 'purchase on '.  $tr['date_added'];
	}

		if ($trlist[$k]['bonus_doctor']==0) $trlist[$k]['bonus_doctor'] = ''; 
		if ($trlist[$k]['bonus_outsource']==0) $trlist[$k]['bonus_outsource'] = ''; 
		if ($trlist[$k]['bonus_consultant']==0) $trlist[$k]['bonus_consultant'] = ''; 
		if ($trlist[$k]['bonus_beauty']==0) $trlist[$k]['bonus_beauty'] = ''; 
	

	if (!in_array($k, $mainarrs) && $trlist[$k]['product_type_id'] < 3)
	{
		if ($trlist[$k]['bonus_doctor'])  $trlist[$k]['bonus_doctor'] .= '*';
		if ($trlist[$k]['bonus_outsource']) $trlist[$k]['bonus_outsource'] .= '*';
		if ($trlist[$k]['bonus_consultant']) $trlist[$k]['bonus_consultant'] .= '*';
		if ($trlist[$k]['bonus_doctor']) $trlist[$k]['bonus_beauty'] .= '*';
	}
}
// $this->load->test($treatment_bonus);


$this->data['treatment_bonus'] = $trlist;
// $this->data['treatment_bonus'] = $treatment_bonus;
// 









































































// 		$data = array(
// 			// 'filter_doctor_id'	     => $filter_doctor_id, 
// 			// 'filter_beauty_id'	     => $filter_beauty_id, 
// 			// 'filter_consultant_id'	 => $filter_consultant_id, 
// 			// 'filter_outsource_id'    => $filter_outsource_id, 
// 			'filter_date_start'	     => $filter_date_start, 
// 			'filter_date_end'	     => $filter_date_end, 
// 			// 'filter_order_status_id' => $filter_order_status_id,
// 			'start'                  => ($page - 1) * $this->config->get('config_admin_limit'),
// 			'limit'                  => $this->config->get('config_admin_limit')
// 		);

// 		$results = $this->model_report_user->getBonusesGroupbyTreatment($data);
// // $this->load->test($results);
// 		$this->data['treatment_bonus'] = [];//$results;

// 		$this->load->model('sale/order');
// 		$this->load->model('catalog/product');

// 		$treatment_bonus = array();

// 		foreach ($results as $result) {
// 			$order_id = $result['order_id'];
			
// 			$product_id = $result['product_id'];

// 			$order_info = $this->model_sale_order->getOrder($order_id);
// 			$product = $this->model_catalog_product->getProduct($product_id);

// 			$payment_cash = 0;
// 			$payment_visa = 0;
// 			$payment_balance = 0;
// 			$payment_final = 0;

// 			if ($result['total_amount']) {
// 				$payment_cash = $order_info['payment_cash'];
// 				$payment_visa = $order_info['payment_visa'];
// 				$payment_balance = $order_info['payment_balance'];
// 				$payment_final = $order_info['payment_final'];
// 			}

// 			$used_unit = -1 * $product['value'] * $result['subquantity'] . ' ' . $product['unit'];
			

// 			$treatment_bonus[] = array(
// 			// $this->data['treatment_bonus'][] = array(
// 				'ufullname' => $result['ufullname'],
// 				'product_type_id' => $result['product_type_id'],
// 				'treatment_usage_id' => $result['treatment_usage_id'],
// 				'customer_transaction_id' => $result['customer_transaction_id'],
// 				'comment' => $result['comment'],
// 				'customer_id' => $result['customer_id'],
// 				'consultant_name' => $result['consultant_name'],
// 				'outsource_name' => $result['outsource_name'],
// 				'doctor_name' => $result['doctor_name'],
// 				'beauty_name' => $result['beauty_name'],
// 				'cfullname' => $result['cfullname'],
// 				'date_modified' => explode(' ', $result['date_modified'])[0],
// 				'product_id' => $result['product_id'],
// 				'product_name' => $product['name'],
// 				'order_id' => $result['order_id'],
// 				'subquantity' => $used_unit,
// 				'total_amount' => $result['total_amount'], 
// 				'total' => $order_info['total'], 
// 				'payment_cash' => $payment_cash, 
// 				'payment_visa' => $payment_visa, 
// 				'payment_balance' => $payment_balance, 
// 				'payment_final' => $payment_final, 
// 			);
// 		}

// 		foreach ($treatment_bonus as $tr) {

// 			// $this->load->test(1234);
// 			// $product = $this->model_catalog_product->getProduct($result['product_id']);

// 			if ($tr['treatment_usage_id'] > 0) {
// 				$this->data['treatment_bonus'][] = $tr;
// 			} else {
				
// 				$qq = $this->model_report_user->getrest($data);
// 				foreach ($qq as $key => $result) {
// 					$this->data['treatment_bonus'][] = array(
// 			// $this->data['treatment_bonus'][] = array(
// 				'ufullname' => $result['ufullname'],
// 				'product_type_id' => $result['product_type_id'],
// 				'treatment_usage_id' => $result['treatment_usage_id'],
// 				'customer_transaction_id' => $result['customer_transaction_id'],
// 				'comment' => $result['comment'],
// 				'customer_id' => $result['customer_id'],
// 				'consultant_name' => $result['consultant_name'],
// 				'outsource_name' => $result['outsource_name'],
// 				'doctor_name' => $result['doctor_name'],
// 				'beauty_name' => $result['beauty_name'],
// 				'cfullname' => $result['cfullname'],
// 				'date_modified' => explode(' ', $result['date_modified'])[0],
// 				'product_id' => $result['product_id'],
// 				'product_name' => $product['name'],
// 				'order_id' => $result['order_id'],
// 				'subquantity' => $used_unit,
// 				'total_amount' => $result['total_amount'], 
// 				'total' => $order_info['total'], 
// 				'payment_cash' => $payment_cash, 
// 				'payment_visa' => $payment_visa, 
// 				'payment_balance' => $payment_balance, 
// 				'payment_final' => $payment_final, 
// 			);
// 				}
// 				// $thi
// 			}
// 		}

// 		$data = array(
// 			// 'filter_order_id'        => $filter_order_id,
// 			// 'filter_customer'	     => $filter_customer,
// 			// 'filter_customer_id'	     => $filter_customer_id,
// 			// 'filter_order_status_id' => $filter_order_status_id,
// 			// 'filter_total_max'           => $filter_total_max,
// 			// 'filter_total_min'           => $filter_total_min,
// 			'filter_date_added_start'      => $filter_date_start,
// 			'filter_date_added_end'      => $filter_date_end,
// 			// 'filter_date_modified_start'   => $filter_date_modified_start,
// 			// 'filter_date_modified_end'   => $filter_date_modified_end,
// 			// 'sort'                   => $sort,
// 			// 'order'                  => $order,
// 			'start'                  => 1,
// 			'limit'                  => 10000000
// 		);

// 		// $order_total = $this->model_sale_order->getTotalOrders($data);

// 		$results = $this->model_sale_order->getOrders($data);

// 		foreach ($results as $key => $result) {

// 			$has3 = false;
// 			$q = $this->model_sale_order->getOrderProducts($result['order_id']);
// 			$product = null;
// 			$sump = array();
// 			$othert = 0;
// 			$othername = '';
// 			$otheru = '';
// 			$otherc = '';
			

// 			foreach ($q as $key2 => $p) {
// 				# code...

// 				$product = $this->model_catalog_product->getProduct($p['product_id']);

// 				//$this->load->test($product);
// 				if ($product['product_type_id'] == 3) {
// 					$has3 = true;
// 					$sump[] = $p;

// 					$othername = $p['name'] + $this->language->get('text_etc');
// 					$othert += $p['total'];

// 				}
// 			}

// 			if ($has3) {

// 				$this->data['treatment_bonus'][] = array(
// 					'ufullname' => $result['ufullname'],
// 					'product_type_id' => $result['product_type_id'],
// 					'treatment_usage_id' => $result['treatment_usage_id'],
// 					'customer_transaction_id' => $result['customer_transaction_id'],
// 					'comment' => $result['comment'],
// 					'customer_id' => $result['customer_id'],
// 					'consultant_name' => $result['consultant_name'],
// 					'outsource_name' => $result['outsource_name'],
// 					'doctor_name' => $result['doctor_name'],
// 					'beauty_name' => $result['beauty_name'],
// 					'cfullname' => $result['cfullname'],
// 					'date_modified' => explode(' ', $result['date_modified'])[0],
// 					'product_id' => $result['product_id'],
// 					'product_name' => $product['name'],
// 					'order_id' => $result['order_id'],
// 					'subquantity' => $used_unit,
// 					'total_amount' => $othert, 
// 					'total' => $othert, 
// 					'payment_cash' => $payment_cash, 
// 					'payment_visa' => $payment_visa, 
// 					'payment_balance' => $payment_balance, 
// 					'payment_final' => $payment_final, 
// 				);

// 			}
			
// 		}

		// $this->load->out()

// $this->load->test($this->data['treatment_bonus']);
// $this->load->test($results);
		

// 		$this->load->model('user/user');
// 		// $this->data['users'] = array();


// 		foreach ($bonus as $user_id => $bonus) {

// 			$transactions = array();

// 			if ($user_id == 0) continue;

// 			if ($filter_doctor_id && $filter_doctor_id != $user_id) {
// 				continue;
// 			}

// 			if ($filter_consultant_id && $filter_consultant_id != $user_id) {
// 				continue;
// 			}

// 			if ($filter_outsource_id && $filter_outsource_id != $user_id) {
// 				continue;
// 			}

// 			if ($filter_beauty_id && $filter_beauty_id != $user_id) {
// 				continue;
// 			}

// 			$user_info = $this->model_user_user->getUser($user_id);
// 			$this->load->model('catalog/product');
// 			$this->load->model('sale/customer');

// 			foreach ($results as $result){

// 				// $this->load->test($result);

// 				$customer = $this->model_sale_customer->getCustomer($result['customer_id']);
// 					$product = $this->model_catalog_product->getProduct($result['product_id']);

// 				$date_modified = explode(' ', $result['date_modified'])[0];

// 				$used_unit = $product['value'] * $result['subquantity'] . ' ' . $product['unit'];
// 				// $this->load->test($used_unit);

// 				if ($result['doctor_id'] == $user_id) {

// 					$transactions[] = array(
// 						'date_modified' => $date_modified,
// 						'used_unit' => $used_unit, 
// 						'customer_id' => $result['customer_id'],
// 						'customer_name' => $customer['fullname'],
// 						'product_id' => $result['product_id'],
// 						'product_name' => $product['name'],
// 						'customer_transaction_id' => $result['customer_transaction_id'],
// 						'bonus' => $result['bonus_doctor']
// 					);
// 				}

// 				if ($result['consultant_id'] == $user_id) {
					
// 					$transactions[] = array(
// 						'date_modified' => $date_modified,
// 						'customer_id' => $result['customer_id'],
// 						'customer_name' => $customer['fullname'],
// 						'product_id' => $result['product_id'],
// 						'product_name' => $product['name'],
// 						'customer_transaction_id' => $result['customer_transaction_id'],
// 						'bonus' => $result['bonus_consultant']
// 					);
// 				}

// 				if ($result['beauty_id'] == $user_id) {

// 					$transactions[] = array(
// 						'date_modified' => $date_modified,
// 						'customer_id' => $result['customer_id'],
// 						'customer_name' => $customer['fullname'],
// 						'product_id' => $result['product_id'],
// 						'product_name' => $product['name'],
// 						'customer_transaction_id' => $result['customer_transaction_id'],
// 						'bonus' => $result['bonus_beauty']
// 					);
// 				}

// 				if ($result['outsource_id'] == $user_id) {

// 					$transactions[] = array(
// 						'date_modified' => $date_modified,
// 						'customer_id' => $result['customer_id'],
// 						'customer_name' => $customer['fullname'],
// 						'product_id' => $result['product_id'],
// 						'product_name' => $product['name'],
// 						'customer_transaction_id' => $result['customer_transaction_id'],
// 						'bonus' => $result['bonus_outsource']
// 					);
// 				}
// 			}

// 			$this->data['users'][] = array(
// 				'user_id'       => $user_id,
// 				'name'       => $user_info['fullname'],
// 				'bonus'       => $bonus, 
// 				'transactions' => $transactions
// 			);
// 		}
		// $this->load->test($results);
		$this->data['heading_title'] = $this->language->get('heading_title');

		$this->data['column_user'] = $this->language->get('column_user');
		$this->data['column_bonus'] = $this->language->get('column_bonus');
		$this->data['text_no_results'] = $this->language->get('text_no_results');
		$this->data['text_all_status'] = $this->language->get('text_all_status');
		$this->data['text_bonus_doctor'] = $this->language->get('text_bonus_doctor');
		$this->data['text_bonus_beauty'] = $this->language->get('text_bonus_beauty');
		$this->data['text_bonus_consultant'] = $this->language->get('text_bonus_consultant');
		$this->data['text_bonus_outsource'] = $this->language->get('text_bonus_outsource');

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

		$this->data['text_customer_id'] = $this->language->get('text_customer_id');
		$this->data['text_customer_fullname'] = $this->language->get('text_customer_fullname');
		$this->data['text_product_name'] = $this->language->get('text_product_name');
		$this->data['text_comment'] = $this->language->get('text_comment');
		$this->data['text_unit_used'] = $this->language->get('text_unit_used');
		$this->data['text_doctor_name'] = $this->language->get('text_doctor_name');
		$this->data['text_outsource_name'] = $this->language->get('text_outsource_name');
		$this->data['text_beauty_name'] = $this->language->get('text_beauty_name');
		$this->data['text_consultant_name'] = $this->language->get('text_consultant_name');
		$this->data['text_payment_cash'] = $this->language->get('text_payment_cash');
		$this->data['text_payment_visa'] = $this->language->get('text_payment_visa');
		$this->data['text_payment_balance'] = $this->language->get('text_payment_balance');
		$this->data['text_payment_final'] = $this->language->get('text_payment_final');
		$this->data['text_user_fullname'] = $this->language->get('text_user_fullname');
		$this->data['text_date_used'] = $this->language->get('text_date_used');
		$this->data['text_total_amount'] = $this->language->get('text_total_amount');

		$this->data['button_filter'] = $this->language->get('button_filter');
		$this->data['button_print'] = $this->language->get('button_print');

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




		$this->template = 'report/user_treatment_bonus.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);

		if (isset($this->request->get['print']) && $this->request->get['print']) {
			$this->template = 'report/user_treatment_bonus_print.tpl';			
		}


		$this->response->setOutput($this->render());
	}
}
?>