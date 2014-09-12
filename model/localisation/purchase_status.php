<?php 
class ModelLocalisationPurchaseStatus extends Model {
	public function addPurchaseStatus($data) {
		foreach ($data['purchase_status'] as $language_id => $value) {
			if (isset($purchase_status_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "purchase_status SET purchase_status_id = '" . (int)$purchase_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "purchase_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$purchase_status_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('purchase_status');
	}

	public function editPurchaseStatus($purchase_status_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "purchase_status WHERE purchase_status_id = '" . (int)$purchase_status_id . "'");

		foreach ($data['purchase_status'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "purchase_status SET purchase_status_id = '" . (int)$purchase_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('purchase_status');
	}

	public function deletePurchaseStatus($purchase_status_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "purchase_status WHERE purchase_status_id = '" . (int)$purchase_status_id . "'");

		$this->cache->delete('purchase_status');
	}

	public function getPurchaseStatus($purchase_status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purchase_status WHERE purchase_status_id = '" . (int)$purchase_status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPurchaseStatuses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "purchase_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY name";	

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}				

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}	

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}	

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$purchase_status_data = $this->cache->get('purchase_status.' . (int)$this->config->get('config_language_id'));

			if (!$purchase_status_data) {
				$query = $this->db->query("SELECT purchase_status_id, name FROM " . DB_PREFIX . "purchase_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$purchase_status_data = $query->rows;

				$this->cache->set('purchase_status.' . (int)$this->config->get('config_language_id'), $purchase_status_data);
			}	

			return $purchase_status_data;				
		}
	}

	public function getPurchaseStatusDescriptions($purchase_status_id) {
		$purchase_status_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "purchase_status WHERE purchase_status_id = '" . (int)$purchase_status_id . "'");

		foreach ($query->rows as $result) {
			$purchase_status_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $purchase_status_data;
	}

	public function getTotalPurchaseStatuses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "purchase_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}	
}
?>