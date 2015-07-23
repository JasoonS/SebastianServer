<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel_service_model extends CI_Model
{

	function get_submenu($sb_hotel_id, $sb_parent_service_id)
	{
		$qry =  "Select c.* from sb_hotel_child_services c join sb_hotel_service_map m ON c.sb_child_service_id = m.sb_child_service_id
				 join sb_hotel_parent_services s ON s.sb_parent_service_id = m.sb_parent_service_id
				 where m.sb_parent_service_id = '$sb_parent_service_id' AND m.sb_hotel_id = '$sb_hotel_id'";
				
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	function get_service_map($sb_parent_service_id, $sb_child_service_id,$sb_hotel_id)
	{
		$qry = "SELECT `sb_hotel_service_map_id` FROM `sb_hotel_service_map` 
				WHERE `sb_parent_service_id` = '$sb_parent_service_id'
				AND `sb_child_service_id` = '$sb_child_service_id' 
				AND `sb_hotel_id` = '$sb_hotel_id';";
		$query = $this->db->query($qry);
		$rply = $query->result_array();
		if(count($rply)>0)
			return $rply[0]['sb_hotel_service_map_id'];
		else
			return 0;
	}

	public function place_service($hrs, $hss)
	{
		$this->db->insert('sb_hotel_request_service', $hrs);
		$id = $this->db->insert_id();
		if($id ==  0)
		{
			return 0;
		}
		else
		{
			$hss['sb_hotel_requst_ser_id'] = $id;
			$this->db->insert('sb_hotel_services_status', $hss);
			$id = $this->db->insert_id();
			if($id ==  0)
			{
				return 0;
			}
			else
			{
				return 1;
			}
		}
	}

	public function get_guest_rooms($sb_hotel_guest_booking_id)
	{
		$qry = "SELECT `sb_guest_allocated_room_no` FROM `sb_hotel_guest_reservation_attributes` as r
				JOIN sb_hotel_guest_bookings b
				ON b.sb_guest_reservation_code = r.sb_guest_reservation_code
				WHERE b.sb_hotel_guest_booking_id = '$sb_hotel_guest_booking_id'
				AND r.sb_guest_actual_check_out ='0000-00-00 00:00:00';";
		$query = $this->db->query($qry);
		$data = $query->result_array();
		$roomNumbers = array();
		if(count($data))
		{
			for ($i=0; $i < count($data); $i++) { 
				array_push($roomNumbers,$data[$i]['sb_guest_allocated_room_no']);
			}
		}
		return $roomNumbers;
	}
}
?>