<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat_model extends CI_Model
{
	// public function get_request($id)
	// {
	// 	$qry = "SELECT a.sb_hotel_requst_ser_id,a.sb_hotel_guest_booking_id,
	// 			b.sb_hotel_ser_assgnd_to_user_id
	// 			FROM sb_hotel_request_service as a
	// 			JOIN sb_hotel_services_status as b
	// 			on a.sb_hotel_requst_ser_id = b.sb_hotel_requst_ser_id
	// 			WHERE a.sb_hotel_requst_ser_id = '$id'
	// 			AND b.sb_hotel_service_status = 'accepted';";
	// 	$query = $this->db->query($qry);
	// 	return $query->result_array();
	// }

	public function get_request($id)
	{
		$qry = "SELECT a.sb_hotel_requst_ser_id
				FROM sb_hotel_request_service as a
				JOIN sb_hotel_services_status as b
				on a.sb_hotel_requst_ser_id = b.sb_hotel_requst_ser_id
				WHERE a.sb_hotel_requst_ser_id = '$id'
				AND b.sb_hotel_service_status = 'accepted';";
		$query = $this->db->query($qry);
		return $query->num_rows();
	}

	public function get_chat_messages($sb_hotel_requst_ser_id)
	{
		$qry = "SELECT * FROM `sb_chat` WHERE `sb_hotel_requst_ser_id` = '$sb_hotel_requst_ser_id' ORDER BY `created_on` ASC";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function insert_chat($insert_arr)
	{
		$query = $this->db->insert('sb_chat',$insert_arr);
		return $query;
	}
}
?>	