<?php
class ModelReportInventory extends Model {
	
	public function getPurchaseList($data = array()) {
		// $sql = "SELECT * FROM oc_order WHERE date_added < "
		// $products = array();

		$sql = "SELECT * FROM oc_purchase p 
		LEFT JOIN oc_purchase_product pp ON p.purchase_id = pp.purchase_id 
		LEFT JOIN oc_product_description pd ON pd.product_id = pp.product_id 
		WHERE date_purchased > '" . $data['filter_date_start'] . "' AND date_purchased < '" . $data['filter_date_end'] . "'  ORDER BY date_added";
		 $query = $this->db->query($sql);
		
		return $query->rows;

	}	


	public function getSalesList($data = array()) {

		// $products = array();

		$sql = "SELECT * FROM oc_order o 
		LEFT JOIN oc_order_product op ON o.order_id = op.order_id 
		LEFT JOIN oc_product_description pd ON pd.product_id = op.product_id  
		WHERE date_added > '" . $data['filter_date_start'] . "' AND date_added < '" . $data['filter_date_end'] . "'  ORDER BY date_added";
		$query = $this->db->query($sql);
		
		return $query->rows;

		// $sql = "SELECT * FROM oc_order WHERE date_added < "
	}	


	public function getInventory($data = array()) {

		$sales = $this->getSale($data);
		$purchase = $this->getPurchase($data);
		$products = array();

		// $this->load->test($sales);
		foreach ($purchase as $k1 => $product1) {
			$found = false;
			foreach ($sales as $k2 => $product2) {
				
				if ($product1['product_id'] == $product2['product_id']) {
					$found = true;
					// $product1['quantity'] -= $product2['quantity'];


					$products[] = array(
						'quantity' => $product1['quantity'] - $product2['quantity'],
						'name' => $product1['name'],
						'product_id' => $product1['product_id']
					);
					// $this->load->test($products);

				}
				
			}
			if (!$found) {
					$products[] = array(
						'quantity' => $product1['quantity'],
						'name' => $product1['name'],
						'product_id' => $product1['product_id']
					);
				}
		}
		// $this->load->test($products);

		return $products;

	}

	public function getSale($data = array()) {

		$sql = "SELECT sum(op.quantity) as quantity, 
		-- sum(pp.subquantity) as subquantity,
		pd.name as name,
		op.product_id as product_id
		 FROM oc_order o 
		 LEFT JOIN oc_order_product op ON o.order_id = op.order_id 
		 LEFT JOIN oc_product_description pd ON pd.product_id = op.product_id 
		 WHERE date_added < '" . $data['date'] . "'";

		 $sql .= " GROUP BY op.product_id";
		 $query = $this->db->query($sql);
		
		return $query->rows;

	}	

	public function getPurchase($data = array()) {
		
		// $sql = "SELECT ch.coupon_id, c.name, c.code, COUNT(DISTINCT ch.order_id) AS `orders`, SUM(ch.amount) AS total FROM `" . DB_PREFIX . "coupon_history` ch LEFT JOIN `" . DB_PREFIX . "coupon` c ON (ch.coupon_id = c.coupon_id)"; 

		$sql = "SELECT sum(pp.quantity) as quantity, 
		-- sum(op.subquantity) as subquantity,
		pd.name as name,
		pp.product_id as product_id
		 FROM oc_purchase p 
		 LEFT JOIN oc_purchase_product pp ON p.purchase_id = pp.purchase_id 
		 LEFT JOIN oc_product_description pd ON pd.product_id = pp.product_id 
		 WHERE date_purchased < '" . $data['date'] . "'";

		// $implode = array();
		
		// if (!empty($data['filter_date_start'])) {
		// 	$implode[] = "DATE(ch.date_added) >= '" . $this->db->escape($data['filter_date_start']) . "'";
		// }

		// if (!empty($data['filter_date_end'])) {
		// 	$implode[] = "DATE(ch.date_added) <= '" . $this->db->escape($data['filter_date_end']) . "'";
		// }

		// if ($implode) {
		// 	$sql .= " WHERE " . implode(" AND ", $implode);
		// }
				
		$sql .= " GROUP BY pp.product_id";
		
		// $this->load->test($sql);
		// if (isset($data['start']) || isset($data['limit'])) {
		// 	if ($data['start'] < 0) {
		// 		$data['start'] = 0;
		// 	}			

		// 	if ($data['limit'] < 1) {
		// 		$data['limit'] = 20;
		// 	}	
			
		// 	$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		// }	
		
		$query = $this->db->query($sql);
		
		return $query->rows;
	}	
	
	// public function getTotalInventory($data = array()) {
	// 	return 1000;
	// }		
}
?>