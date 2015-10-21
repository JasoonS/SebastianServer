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
				//AND `sb_hotel_guest_reservation_attributes`.sb_guest_actual_check_out ='0000-00-00 00:00:00'";
		$query = $this->db->query($qry);
		$custData = $query->result_array();
		/*$roomNumbers = array();
		for ($i=0; $i < count($custData); $i++) { 
			array_push($roomNumbers,$custData[$i]['sb_guest_allocated_room_no']);
		}*/
		if(count($custData)>0)
		{
			$sb_hotel_id =$custData[0]['sb_hotel_id'];
			$roomNumbers = array();
			$sql4 = "SELECT `sb_guest_allocated_room_no` 
					FROM `sb_hotel_guest_reservation_attributes` 
					WHERE `sb_guest_reservation_code` = '$sb_guest_reservation_code' 
					AND sb_guest_actual_check_out ='0000-00-00 00:00:00'";
			$query4 = $this->db->query($sql4);
			$roomData = $query4->result_array();
			for ($i=0; $i < count($roomData); $i++) { 
				array_push($roomNumbers,$roomData[$i]['sb_guest_allocated_room_no']);
			}
			/*$sql1 = "SELECT * FROM `sb_hotel_parent_services` WHERE `sb_parent_service_id` 
					in(SELECT distinct(`sb_parent_service_id`) FROM `sb_hotel_service_map` WHERE `sb_hotel_id` = '$sb_hotel_id')";
			*/
			$IMP_PATH = PARENT_SERVICE_PIC;
			$sql1 = "SELECT `sb_parent_service_id`,`sb_parent_service_name`,
					CONCAT('$IMP_PATH',`sb_parent_service_image`) as `sb_parent_service_image`,`sb_parent_service_color`,
					`sb_parent_service_created_on` 
					FROM `sb_hotel_parent_services` 
					WHERE `sb_parent_service_id` in(SELECT distinct(`sb_parent_service_id`) FROM `sb_hotel_service_map` WHERE `sb_hotel_id` = '$sb_hotel_id')";
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
			$IMP_PATH = HOTEL_PIC;
			$sql1 = "SELECT `sb_hotel_id`,`sb_hotel_name`,`sb_hotel_country`,sb_hotel_description,
				`sb_hotel_city`,`sb_hotel_state`, `sb_hotel_zipcode`,
				`sb_hotel_address`,`sb_hotel_phone`,`sb_hotel_star`,
				`sb_hotel_category`,`sb_hotel_created_on`,`sb_hotel_website`,
				CONCAT('$IMP_PATH',`sb_hotel_pic`) as `sb_hotel_pic`,
				`sb_hotel_owner`, `sb_property_built_month` ,`sb_hotel_email`,`sb_property_built_year`,`sb_property_open_year`,
				`is_active` 
				FROM sb_hotels WHERE `sb_hotel_id` = '$sb_hotel_id';";
			$query = $this->db->query($sql1);
			$hotel = $query->result_array();
			if(count($hotel) == 0)
			{
				$hotelInfo =array();
			}
			else
			{
				$hotelInfo = $hotel[0];
			}
			$this->guest_deviceToken($cdt_token, $cdt_deviceType ,$cdt_macid, $custData[0]['sb_hotel_guest_booking_id']);
			unset($custData[0]['sb_guest_terms']);
			$custData[0]['sb_guest_allocated_room_no'] = $roomNumbers;
			$result = array(
				"userInfo" => $custData[0],
				"services" => $service,
				"hotelInfo" => $hotelInfo,
				"hasBooked" => "1"
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

	public function get_hotel($sb_hotel_name)
	{
		if ($sb_hotel_name == '') 
		{
			$qry = "Select sb_hotel_id, sb_hotel_name from sb_hotels where is_active='1';";
			$query = $this->db->query($qry);
		}
		else
		{
			$qry = "Select sb_hotel_id, sb_hotel_name from sb_hotels where sb_hotel_name LIKE '%$sb_hotel_name%' AND  is_active='1';";
			$query = $this->db->query($qry);
		}
		
		return $query->result_array();

	}

	function check_reservation($sb_guest_email, $sb_hotel_id)
	{
		$qry = "SELECT * FROM `sb_hotel_guest_bookings` 
				WHERE `sb_hotel_id` = '{$sb_hotel_id}' 
				AND `sb_guest_email` = '{$sb_guest_email}'
				AND `is_checkedout` = '0'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	function check_visitor($visitor_email, $sb_hotel_id)
	{
		$qry = "SELECT * FROM `sb_visitor` 
				WHERE `visitor_email` = '{$visitor_email}' 
				AND `sb_hotel_id` = '{$sb_hotel_id}'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	function new_visitor($new_visitor)
	{
		$this->db->insert('sb_visitor', $new_visitor);
		return $this->db->insert_id();
	}

	public function update_visitor($visitor_id)
	{
		$qry = "UPDATE `sb_visitor` SET `visit_cout`= visit_cout +1 WHERE `visitor_id` = '{$visitor_id}'";
		$query = $this->db->query($qry);
		return 1;
	}

	public function get_visitor_menu($sb_hotel_id)
	{
		//$sb_hotel_id =$new_visitor['sb_hotel_id'];

		$IMP_PATH = PARENT_SERVICE_PIC;
		
		$sql1 = "SELECT `sb_parent_service_id`,`sb_parent_service_name`,
					CONCAT('$IMP_PATH',`sb_parent_service_image`) as `sb_parent_service_image`,`sb_parent_service_color`,
					`sb_parent_service_created_on` 
					FROM `sb_hotel_parent_services` 
					WHERE `sb_parent_service_id` in(SELECT distinct(`sb_parent_service_id`) FROM `sb_hotel_service_map` WHERE `sb_hotel_id` = '$sb_hotel_id')";
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
		
		$IMP_PATH = HOTEL_PIC;
		$sql1 = "SELECT `sb_hotel_id`,`sb_hotel_name`,`sb_hotel_country`,sb_hotel_description,
				`sb_hotel_city`,`sb_hotel_state`, `sb_hotel_zipcode`,
				`sb_hotel_address`,`sb_hotel_phone`,`sb_hotel_star`,
				`sb_hotel_category`,`sb_hotel_created_on`,`sb_hotel_website`,
				CONCAT('$IMP_PATH',`sb_hotel_pic`) as `sb_hotel_pic`,
				`sb_hotel_owner`, `sb_property_built_month` ,`sb_hotel_email`,`sb_property_built_year`,`sb_property_open_year`,
				`is_active` 
				FROM sb_hotels WHERE `sb_hotel_id` = '$sb_hotel_id';";
		$query = $this->db->query($sql1);
		$hotel = $query->result_array();
		if(count($hotel) == 0)
		{
			$hotelInfo =array();
		}
		else
		{
			$hotelInfo = $hotel[0];
		}
		//$this->guest_deviceToken($cdt_token, $cdt_deviceType ,$cdt_macid, $custData[0]['sb_hotel_guest_booking_id']);
		//unset($custData[0]['sb_guest_terms']);
		//$custData[0]['sb_guest_allocated_room_no'] = $roomNumbers;
		$result = array(
			//"userInfo" => $custData[0],
			"services" => $service,
			"hotelInfo" => $hotelInfo,
			"hasBooked" => "0"
			);
		return $result;
	}


	public function logout($sb_hotel_guest_booking_id,$cdt_macid,$updateData)
	{
		$this->db->where('sb_hotel_guest_booking_id', $sb_hotel_guest_booking_id);
		$this->db->where('cdt_macid', $cdt_macid);
		$this->db->update('sb_guest_devicetoken', $updateData); 
		return 1;
	}

}
?>	