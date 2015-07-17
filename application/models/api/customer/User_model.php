<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
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
	
	function login($sb_guest_reference_id ,  $cdt_token, $cdt_deviceType ,$cdt_macid)
	{
		$qry = "SELECT * FROM `sb_hotel_guest_bookings` WHERE `sb_guest_reference_id` ='$sb_guest_reference_id';";
		$query = $this->db->query($qry);
		$custData = $query->result_array();
		if(count($custData)>0)
		{
			$hotel_id =$custData[0]['hotel_id'];
			$sql1= "SELECT `hotel_services` FROM `sb_hotel_admin` WHERE `hotel_id` = '$hotel_id'";
			$query = $this->db->query($sql1);
			$service_id = $query->result_array()[0]['hotel_services'];
			if($service_id =='')
			{
				$service =array();
			}
			else
			{
				$sql1="SELECT * FROM `sb_services` WHERE `service_id` in ($service_id)";
				$query = $this->db->query($sql1);
				$service = $query->result_array();
			}
			$result = array(
				"userInfo" => $custData,
				"services" => $service
				);
			return $result;
		}
		else
		{
			return 0;
		}
	}
}
?>	