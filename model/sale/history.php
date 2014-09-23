<?php
class ModelSaleHistory extends Model {
	
	function updatehistory($user_id, $reminder_status_id, $customer_history_id){
		$this->db->query("UPDATE oc_customer_history SET reminder_status = $reminder_status_id WHERE customer_history_id = $customer_history_id AND user_id = $user_id");

		return $this->db->countAffected();
	}
}
?>