<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel_service_model extends CI_Model
{

	function get_submenu($sb_hotel_id, $sb_parent_service_id)
	{
		$IMP_PATH = base_url().CHILD_SERVICE_PIC."/";
		$qry =  "SELECT DISTINCT m.sb_child_service_id,
				c.`sb_child_service_id`,c.`sb_parent_service_id`,
				c.`sb_child_servcie_name`,c.`sb_child_servcie_detail`,
				concat('$IMP_PATH',c.child_service_image) as `child_service_image`,
				c.`sb_child_service_created_on`,c.`is_service`  
				from sb_hotel_child_services c 
				join sb_hotel_service_map m ON c.sb_child_service_id = m.sb_child_service_id
				join sb_hotel_parent_services s ON s.sb_parent_service_id = m.sb_parent_service_id
				where m.sb_parent_service_id = '$sb_parent_service_id' AND m.sb_hotel_id = '$sb_hotel_id'
				AND sb_is_service_in_use = '1'";
				
		$query = $this->db->query($qry);
		$data = $query->result_array();

		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['sub_childmenu'] = array();
			if($data[$i]['is_service'] == 0)
			{
				$id = $data[$i]['sb_child_service_id'];
				if($sb_parent_service_id == 3 || $sb_parent_service_id == 6)
				{
					$IMP_PATH = base_url().SUBCHILD_SERVICE_PIC."/$sb_hotel_id/";
					$qry1 = "SELECT `sub_child_services_id`,`sb_hotel_id`,
					`sb_child_service_id`,`sb_sub_child_service_name`,`sb_sub_child_service_details`,
					concat('$IMP_PATH',sb_sub_child_service_image) as `sb_sub_child_service_image`,
					`sb_sub_child_price`,`sb_is_service_in_use`,`created_on` 
					from sb_paid_services  where sb_hotel_id = '$sb_hotel_id'
					AND sb_child_service_id = '$id' AND sb_is_service_in_use = '1' ";
				}
				else
				{
					/*$qry1 = "SELECT scs.*  FROM `sb_sub_child_services` as scs
						join sb_hotel_service_map m ON scs.sub_child_services_id = m.sb_sub_child_service_id 
						WHERE `sb_hotel_id` = '$sb_hotel_id'
							AND m.`sb_parent_service_id` = '$sb_parent_service_id' 
							AND m.`sb_child_service_id` = '$id'
							AND sb_is_service_in_use = '1'";*/
					$IMP_PATH = base_url().SUBCHILD_SERVICE_PIC."/";
					$qry1 = "SELECT `sub_child_services_id`,`sb_child_service_id`,
					`sb_sub_child_service_name`,`sb_sub_child_service_details`,`created_on`,
					concat('$IMP_PATH',sb_sub_child_service_image) as `sb_sub_child_service_image` 
					FROM `sb_sub_child_services` 
					WHERE `sb_child_service_id` ='$id'";
				}			
				$query = $this->db->query($qry1);
				$subChildService = $query->result_array();
				$data[$i]['sub_childmenu'] = $subChildService;
			}
		}
		//print_r($data);die;
		return $data;
	}

	function get_service_map($sb_parent_service_id, $sb_child_service_id,$sb_hotel_id)
	{
		// if($sb_sub_child_service_id == 0)
		// {
		// 	$qry = "SELECT `sb_hotel_service_map_id` FROM `sb_hotel_service_map` 
		// 			WHERE `sb_parent_service_id` = '$sb_parent_service_id'
		// 			AND `sb_child_service_id` = '$sb_child_service_id' 
		// 			AND `sb_hotel_id` = '$sb_hotel_id';";
		// }
		// else
		// {
			// $qry = "SELECT `sb_hotel_service_map_id` FROM `sb_hotel_service_map` 
			// 		WHERE `sb_parent_service_id` = '$sb_parent_service_id'
			// 		AND `sb_child_service_id` = '$sb_child_service_id' 
			// 		AND `sb_hotel_id` = '$sb_hotel_id'
			// 		AND `sb_sub_child_service_id` = '$sb_sub_child_service_id';";
			//}		
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
			$id1 = $this->db->insert_id();
			if($id1 ==  0)
			{
				return 0;
			}
			else
			{
				return $id;
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

	public function get_staff_ids($sb_hotel_id,$sb_parent_service_id)
	{
		$qry = "Select s.sb_hotel_user_id from sb_hotel_service_map h join sb_hotel_user_service_access_map s on
				 h.sb_hotel_service_map_id = s.sb_hotel_service_map_id where h.sb_hotel_id = $sb_hotel_id AND
				 h.sb_parent_service_id = $sb_parent_service_id"; 
				
		$query = $this->db->query($qry);
		$data = $query->result_array();
		$token = array();
		if(count($data)>0)
		{
			for ($i=0; $i < count($data) ; $i++)
			{ 
				if($data[$i]['sb_hotel_user_id']!= '' && $data[$i]['sb_hotel_user_id'] != NULL)
				{
					array_push($token,$data[$i]['sb_hotel_user_id']);
				}	
			}
			$token1 = implode(",",$token);
			$sql = "Select sdt_token , sdt_deviceType from sb_staff_devicetoken where sb_hotel_user_id IN ($token1)";
			$query1 = $this->db->query($sql);
			return $query1->result_array();
		}
		else
			return array();
	}

	function get_request_info($sb_hotel_guest_booking_id)
	{
		$qry = "SELECT r.sb_hotel_requst_ser_id , h.sb_hotel_service_assigned, h.sb_hotel_ser_start_date, r.sb_hotel_ser_reqstd_on, 
				h.sb_hotel_ser_start_time, h.sb_hotel_ser_finished_date , h.sb_hotel_ser_finished_time,h.sb_hotel_ser_assgnd_to_user_id,
				h.sb_hotel_service_status, r.sb_service_log,c.sb_child_servcie_name, c.child_service_image,h.reject_reason,
				r.sb_hotel_ser_reqstd_on
				from sb_hotel_request_service r join sb_hotel_services_status h
				ON r.sb_hotel_requst_ser_id = h.sb_hotel_requst_ser_id
				join sb_hotel_service_map m ON r.sb_hotel_service_map_id = m.sb_hotel_service_map_id
				join sb_hotel_child_services c ON m.sb_child_service_id = c.sb_child_service_id 
				where r.sb_hotel_guest_booking_id = '$sb_hotel_guest_booking_id'
				AND r.order_details='0'
				AND h.sb_hotel_service_status !='rejected'";
		$query = $this->db->query($qry);
		$data = $query->result_array();		

		if(count($data))
		{
			for ($i=0, $j=0; $i < count($data) ; $i++)
			 { 
				$data[$i]['sb_hotel_ser_assgnd_to_username'] = "";
				if($data[$i]['sb_hotel_ser_assgnd_to_user_id']!= '' && $data[$i]['sb_hotel_ser_assgnd_to_user_id'] != NULL && $data[$i]['sb_hotel_ser_assgnd_to_user_id'] != 0)
				{	
					$sb_hotel_user_id = $data[$i]['sb_hotel_ser_assgnd_to_user_id'];
					$qry1 = "Select sb_hotel_user_id,sb_hotel_username from sb_hotel_users where sb_hotel_user_id = '$sb_hotel_user_id'";
					$query1 = $this->db->query($qry1);
					$data1 = $query1->result_array();	
					$data[$i]['sb_hotel_ser_assgnd_to_username'] = $data1[0]['sb_hotel_username'];
				}
			}	
		}
		return $data;
	}
}
?>