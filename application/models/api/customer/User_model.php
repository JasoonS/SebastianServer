<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{

	function get_userDetails($sb_guest_reservation_code)
	{
		$qry = "SELECT h.sb_hotel_name, gb.sb_guest_firstName, gb.sb_guest_lastName FROM `sb_hotel_guest_bookings` as gb 
				JOIN sb_hotels as h on gb.`sb_hotel_id` = h.sb_hotel_id 
				JOIN sb_hotel_guest_reservation_attributes as gba on gba.`sb_guest_reservation_code` = gb.`sb_guest_reservation_code` 
				where gb.`sb_guest_reservation_code` = '$sb_guest_reservation_code'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
	
	function login($sb_guest_reservation_code , $cdt_token, $cdt_deviceType ,$cdt_macid)
	{
		$qry = "SELECT * FROM `sb_hotel_guest_bookings` 
				JOIN `sb_hotel_guest_reservation_attributes`
				ON `sb_hotel_guest_reservation_attributes`.`sb_guest_reservation_code` = `sb_hotel_guest_bookings`.`sb_guest_reservation_code`
				where `sb_hotel_guest_bookings`.`sb_guest_reservation_code` = '$sb_guest_reservation_code'";
		$query = $this->db->query($qry);
		$custData = $query->result_array();
		$roomNumbers = array();
		for ($i=0; $i < count($custData); $i++) { 
			array_push($roomNumbers,$custData[$i]['sb_guest_allocated_room_no']);
		}
		if(count($custData)>0)
		{
			$sb_hotel_id =$custData[0]['sb_hotel_id'];

			$sql1 = "SELECT * FROM `sb_hotel_parent_services` WHERE `sb_parent_service_id` 
					in(SELECT distinct(`sb_parent_service_id`) FROM `sb_hotel_service_map` WHERE `sb_hotel_id` = '$sb_hotel_id')";
			$query = $this->db->query($sql1);
			$services = $query->result_array();
			if(count($services) == 0)
			{
				$service =array();
			}
			else
			{
				$service = $services;
			}
			$this->guest_deviceToken($cdt_token, $cdt_deviceType ,$cdt_macid, $custData[0]['sb_hotel_guest_booking_id']);
			unset($custData[0]['sb_guest_terms']);
			$custData[0]['sb_guest_allocated_room_no'] = $roomNumbers;
			$result = array(
				"userInfo" => $custData[0],
				"services" => $service
				);
			return $result;
		}
		else
		{
			return 0;
		}
	}

	function guest_deviceToken($cdt_token, $cdt_deviceType ,$cdt_macid, $sb_hotel_guest_booking_id)
	{
		$sql = "SELECT * FROM `sb_guest_devicetoken` WHERE `cdt_macid` = '$cdt_macid' AND `sb_hotel_guest_booking_id` = '$sb_hotel_guest_booking_id';";
		$query = $this->db->query($sql);
		$device = $query->result_array();
		if(count($device)>0)
		{
			$sql = "UPDATE `sb_guest_devicetoken` SET `cdt_token` = '$cdt_token' 
					 WHERE `cdt_macid` = '$cdt_macid' AND `sb_hotel_guest_booking_id` = '$sb_hotel_guest_booking_id';";
		}
		else
		{
			$sql = "INSERT INTO `sb_guest_devicetoken` (`cdt_id`, `cdt_token`, `cdt_deviceType`, `sb_hotel_guest_booking_id`, `cdt_macid`, `created_on`) 
					VALUES (NULL, '$cdt_token', '$cdt_deviceType', '$sb_hotel_guest_booking_id', '$cdt_macid', CURRENT_TIMESTAMP);";
		}
		$query = $this->db->query($sql);
		return 1;
	}

	function get_reservation($sb_guest_firstName, $sb_guest_lastName , $sb_guest_email, $sb_hotel_name , $sb_guest_contact_no)
	{
		$qry = "Select b.sb_guest_reservation_code 
				from sb_hotel_guest_bookings as b
				JOIN sb_hotels as h on b.sb_hotel_id = h.sb_hotel_id
				where b.sb_guest_firstName = '$sb_guest_firstName'
				AND b. sb_guest_lastName = '$sb_guest_lastName' 
				AND b.sb_guest_email = '$sb_guest_email' 
				AND h.sb_hotel_name = '$sb_hotel_name'
				AND b.sb_guest_contact_no = '$sb_guest_contact_no'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
}
?>	