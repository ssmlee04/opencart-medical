<?php
class ModelSaleHistory extends Model {
	
	function updatehistory($user_id, $reminder_status_id, $customer_history_id){

		$query = $this->db->query("SELECT * FROM oc_reminder_status WHERE reminder_status_id = '$reminder_status_id'");

		$days = $query->row['additional_days'];

		if ($reminder_status_id > 0) $this->db->query("UPDATE oc_customer_history SET reminder_date = DATE_ADD(NOW(), INTERVAL $days DAY), reminder_status = $reminder_status_id, reminded_already=1 WHERE customer_history_id = $customer_history_id AND user_id = $user_id");

		else $this->db->query("UPDATE oc_customer_history SET reminder_date = DATE_ADD(NOW(), INTERVAL $days DAY), reminder_status = $reminder_status_id WHERE customer_history_id = $customer_history_id AND user_id = $user_id");

		return $this->db->countAffected();
	}
}
?>