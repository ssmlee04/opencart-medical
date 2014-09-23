<?php 
class ModelLocalisationReminderStatus extends Model {
	public function addReminderStatus($data) {
		foreach ($data['reminder_status'] as $language_id => $value) {
			if (isset($reminder_status_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "reminder_status SET reminder_status_id = '" . (int)$reminder_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "reminder_status SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$reminder_status_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('reminder_status');
	}

	public function editReminderStatus($reminder_status_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "reminder_status WHERE reminder_status_id = '" . (int)$reminder_status_id . "'");

		foreach ($data['reminder_status'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "reminder_status SET reminder_status_id = '" . (int)$reminder_status_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('reminder_status');
	}

	public function deleteReminderStatus($reminder_status_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "reminder_status WHERE reminder_status_id = '" . (int)$reminder_status_id . "'");

		$this->cache->delete('reminder_status');
	}

	public function getReminderStatus($reminder_status_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "reminder_status WHERE reminder_status_id = '" . (int)$reminder_status_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getReminderStatuses($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "reminder_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
			$reminder_status_data = $this->cache->get('reminder_status.' . (int)$this->config->get('config_language_id'));

			if (!$reminder_status_data) {
				$query = $this->db->query("SELECT reminder_status_id, name FROM " . DB_PREFIX . "reminder_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$reminder_status_data = $query->rows;

				$this->cache->set('reminder_status.' . (int)$this->config->get('config_language_id'), $reminder_status_data);
			}	

			return $reminder_status_data;				
		}
	}

	public function getReminderStatusDescriptions($reminder_status_id) {
		$reminder_status_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "reminder_status WHERE reminder_status_id = '" . (int)$reminder_status_id . "'");

		foreach ($query->rows as $result) {
			$reminder_status_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $reminder_status_data;
	}

	public function getTotalReminderStatuses() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "reminder_status WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}	
}
?>