<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel_service_model extends CI_Model
{

	function get_userDetails($sb_guest_reference_id)
	{
		$qry = "SELECT h.sb_hotel_name, gba.sb_guest_firstName, gba.sb_guest_lastName FROM `sb_hotel_guest_bookings` as gb 
				JOIN sb_hotels as h on gb.`sb_hotel_id` = h.sb_hotel_id 
				JOIN sb_hotel_guest_reservation_attributes as gba on gba.`sb_guest_reference_id` = gb.`sb_guest_reference_id` 
				where gb.`sb_guest_reference_id` = '$sb_guest_reference_id'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
	
	function login($sb_guest_reference_id , $cdt_token, $cdt_deviceType ,$cdt_macid)
	{
		$qry = "SELECT * FROM `sb_hotel_guest_bookings` 
				JOIN `sb_hotel_guest_reservation_attributes`
				ON `sb_hotel_guest_reservation_attributes`.`sb_guest_reference_id` = `sb_hotel_guest_bookings`.`sb_guest_reference_id`
				where `sb_hotel_guest_bookings`.`sb_guest_reference_id` = '$sb_guest_reference_id'";
		$query = $this->db->query($qry);
		$custData = $query->result_array();
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
}
?>	