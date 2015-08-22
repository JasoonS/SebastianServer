<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Chat_model extends CI_Model
{
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
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

	public function get_ids($sb_hotel_requst_ser_id , $sb_sender_type)
	{
		if($sb_sender_type == 1)
		{
			$qry = "SELECT `sb_hotel_guest_booking_id` FROM `sb_hotel_request_service` WHERE `sb_hotel_requst_ser_id` = '$sb_hotel_requst_ser_id'";
		}
		else
		{
			$qry = "SELECT `sb_hotel_ser_assgnd_to_user_id` FROM `sb_hotel_services_status` WHERE `sb_hotel_requst_ser_id` = '$sb_hotel_requst_ser_id'";
		}
		$query = $this->db->query($qry);
		$result = $query->result_array();
		if(!empty($result))
		{
			if ($sb_sender_type == 1) 
			{
				return $result[0]['sb_hotel_guest_booking_id'];
			}
			else
			{
				return $result[0]['sb_hotel_ser_assgnd_to_user_id'];
			}
		}
		else
		{
			return '';
		}
		
	}
	public function get_token($id , $sb_sender_type)
	{
		if($sb_sender_type == 1)
		{
			$qry = "SELECT `cdt_token` AS sdt_token,`cdt_deviceType` AS sdt_deviceType FROM `sb_guest_devicetoken` WHERE `sb_hotel_guest_booking_id`= '$id' ";
		}
		else
		{
			$qry = "SELECT `sdt_token`,`sdt_deviceType` FROM `sb_staff_devicetoken` WHERE `sb_hotel_user_id` = '$id'";
		}

		$query = $this->db->query($qry);
		return $query->result_array();	
	}

	public function get_name($id , $sb_sender_type)
	{
		if($sb_sender_type == 1)
		{
			$qry = "SELECT CONCAT('Mr',' ',`sb_guest_firstName`,'.',`sb_guest_lastName`) AS user_name FROM `sb_hotel_guest_bookings` WHERE`sb_hotel_guest_booking_id` = '$id' ";
		}
		else
		{
			$qry = "SELECT concat('Mr',' ',u.`sb_hotel_username`,' ','(',d.`sb_staff_designation_name`,')') AS user_name FROM `sb_hotel_users` u join `sb_hotel_staff_designation` d on u.`sb_staff_designation_id` = d.`sb_staff_designation_id` where `sb_hotel_user_id` = '$id'";
		}

		$query = $this->db->query($qry);
		$result = $query->result_array();

		if(!empty($result))
		{
			if ($sb_sender_type == 1) 
			{
				return $result[0]['user_name'];
			}
			else
			{
				return $result[0]['user_name'];
			}
		}
		else
		{
			return '';
		}
	}
}
?>	