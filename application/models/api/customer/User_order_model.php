<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_order_model extends CI_Model
{
	function get_order_record($sb_hotel_guest_booking_id)
	{
		$qry = "SELECT r.sb_hotel_requst_ser_id , h.sb_hotel_service_assigned, h.sb_hotel_ser_start_date, r.sb_hotel_ser_reqstd_on, 
				h.sb_hotel_ser_start_time, h.sb_hotel_ser_finished_date , h.sb_hotel_ser_finished_time,h.sb_hotel_ser_assgnd_to_user_id,
				h.sb_hotel_service_status, r.sb_service_log,h.reject_reason,
				r.sb_hotel_ser_reqstd_on, r.sb_hotel_id
				from sb_hotel_request_service r 
				join sb_hotel_services_status h
				ON r.sb_hotel_requst_ser_id = h.sb_hotel_requst_ser_id
				
				where r.sb_hotel_guest_booking_id = '$sb_hotel_guest_booking_id'
				AND r.order_details='1'";
				//AND h.sb_hotel_service_status !='rejected'";
		$query = $this->db->query($qry);
		$data = $query->result_array();		
			 
			if(count($data))
			{
				for ($i=0; $i < count($data) ; $i++)
				 { 
				 	$sb_hotel_id = $data[$i]['sb_hotel_id'];
				 	$IMP_PATH = base_url().SUBCHILD_SERVICE_PIC."/$sb_hotel_id/";
				 	$sb_hotel_requst_ser_id = $data[$i]['sb_hotel_requst_ser_id'];
					$sql = "SELECT a.`order_placed_id`, a.`sb_child_service_id`, 
							a.`sub_child_services_id`, a.`quantity`, a.`price`,
							a.sb_customer_order_duedate, a.sb_customer_order_duetime,a.sb_customer_order_comment,
							a.is_temp_delete, 
							b.`sb_sub_child_service_name`,
							b.`sb_sub_child_service_details`,
							concat('$IMP_PATH',b.sb_sub_child_service_image ) as sb_sub_child_service_image 
							FROM `sb_customer_order_placed` as a
							JOIN `sb_paid_services`as b
							ON  a.`sub_child_services_id`=  b.`sub_child_services_id`
							WHERE `sb_hotel_requst_ser_id` = '$sb_hotel_requst_ser_id' AND `is_temp_delete` = '0'";
					$query = $this->db->query($sql);
					$data[$i]['order_details'] = $query->result_array();
					$data[$i]['sb_hotel_ser_assgnd_to_username'] = "";
					if($data[$i]['sb_hotel_ser_assgnd_to_user_id']!= '' && $data[$i]['sb_hotel_ser_assgnd_to_user_id'] != NULL && $data[$i]['sb_hotel_ser_assgnd_to_user_id'] != 0)
					{	
						$sb_hotel_user_id = $data[$i]['sb_hotel_ser_assgnd_to_user_id'];
						$qry1 = "Select sb_hotel_user_id,sb_hotel_username from sb_hotel_users where sb_hotel_user_id = '$sb_hotel_user_id'";
						$query1 = $this->db->query($qry1);
						$data1 = $query1->result_array();
						if(count($data1)>0)
							$data[$i]['sb_hotel_ser_assgnd_to_username'] = $data1[0]['sb_hotel_username'];
						else
							$data[$i]['sb_hotel_ser_assgnd_to_username'] = '';

					}
				 }	
			}
			return $data;
	}

	public function place_order_details($data)
	{
		$this->db->insert_batch('sb_customer_order_placed', $data);
		return 1; 
	}

	public function get_hotel_restaurant($sb_hotel_id)
	{
		$sql = "SELECT * FROM sb_hotel_restaurant
				WHERE `sb_hotel_id` = '$sb_hotel_id'
				AND `is_delete` = '0'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function get_paid_service_status($sub_child_services_id)
	{
		$sql = "SELECT `sb_sub_child_price`,`sub_child_services_id`,
				`sb_is_service_in_use` 
				FROM `sb_paid_services` 
				WHERE `sub_child_services_id` 
				IN ($sub_child_services_id);";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
}
?>	