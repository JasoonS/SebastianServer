<?php
/* Model handles Common operations For Ajax Datatable (For Single Table)
 */
Class Dashboard_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function weekly_tasks($sb_hotel_id)
	{
		$qry = "SELECT distinct(hrs.sb_hotel_requst_ser_id),hrs.sb_guest_allocated_room_no,hrs.sb_hotel_ser_reqstd_on, 
				hss.sb_hotel_ser_assgnd_to_user_id, hss.sb_hotel_ser_start_date as service_due_date,  hss.sb_hotel_ser_start_time as service_due_time,
				hss.sb_hotel_ser_finished_date as service_done_date,  hss.sb_hotel_ser_finished_time as service_done_time,
				hss.sb_hotel_service_status, IF(hrs.order_details = '0','request', 'order') as service_type,
				b.sb_guest_firstName,b.sb_guest_lastName,hrs.sb_service_log,hrs.sb_hotel_guest_booking_id
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN `sb_hotel_guest_bookings` as b
				ON hrs.sb_hotel_guest_booking_id = b.sb_hotel_guest_booking_id
				WHERE hrs.sb_hotel_id = '$sb_hotel_id'
				AND hss.sb_hotel_service_status = 'pending'
				OR  hss.sb_hotel_service_status = 'accepted'
				ORDER BY hss.sb_hotel_ser_start_date ASC, hss.sb_hotel_ser_start_time ASC;";
		//echo $qry;die;
		$query = $this->db->query($qry);
		$data = $query->result_array();
		
		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['accepted_by'] = '';
			if ($data[$i]['sb_hotel_service_status'] == 'accepted' || $data[$i]['sb_hotel_service_status'] == 'completed'|| $data[$i]['sb_hotel_service_status'] == 'rejected') {
				$id =  $data[$i]['sb_hotel_ser_assgnd_to_user_id'];
				$qry = "SELECT `sb_hotel_username` FROM `sb_hotel_users` WHERE `sb_hotel_user_id` = '$id';";
				$query = $this->db->query($qry);
				$name = $query->result_array();
				if(count($name)>0)
				$data[$i]['accepted_by'] = $name[0]['sb_hotel_username'];
			}
		}

		/*if(count($data)>0)
		{
			for ($i=0; $i < count($data); $i++) { 
				$child = $this->getChildServiceDetails($data[$i]['sb_hotel_requst_ser_id']);
				$data[$i]['sb_child_servcie_name'] = '';
				if(count($child)>0)
				{
					$data[$i]['sb_child_servcie_name'] = $child[0]['sb_child_servcie_name'];
				}
			}			
		}*/
		if(count($data)>0)
		{
			for ($i=0; $i < count($data); $i++) { 
				$data[$i]['sb_child_servcie_name'] = '';
				if($data[$i]['service_type'] == 'order')
				{
					$data[$i]['orderDetails'] = array();
					$orderDetails = $this->getOrderDetails($data[$i]['sb_hotel_requst_ser_id']);
					if(count($orderDetails)>0)
					{
						$data[$i]['orderDetails'] = $orderDetails;
					}
				}
				else
				{
					$child = $this->getChildServiceDetails($data[$i]['sb_hotel_requst_ser_id']);
					if(count($child)>0)
					{
						$data[$i]['sb_child_servcie_name'] = $child[0]['sb_child_servcie_name'];
					}
				}
			}			
		}

		return $data;
	}

	/**
	 * This model will provide childs and sub-childs for a requested service.
	 * return type- 
	 * created on - 27th July 2015;
	 * created by - Akshay Patil;
	 * updated on - 10th August 2015
	 * updated by - Samrat Aher
	 */

	public function getChildServiceDetails($id)
	{
		$sql = "Select sub_child_services_id from sb_hotel_request_service where sb_hotel_requst_ser_id = '$id' ";
		$query1 = $this->db->query($sql);
		$data = $query1->result_array();
		if($data[0]['sub_child_services_id'] == 0)
		{
			$qry = "SELECT c.* FROM sb_hotel_request_service as a
					JOIN sb_hotel_service_map as b
					ON a.sb_hotel_service_map_id = b.sb_hotel_service_map_id
					JOIN sb_hotel_child_services as c
					on b.sb_child_service_id = c.sb_child_service_id
					WHERE a.sb_hotel_requst_ser_id = '$id';";
					$query = $this->db->query($qry);
			return $query->result_array();
		}
		else
		{
			$sub_child_services_id = $data[0]['sub_child_services_id'];
			$qry = "SELECT sb_sub_child_service_name from sb_sub_child_services where sub_child_services_id = '$sub_child_services_id' ";
			$query = $this->db->query($qry);
			$result = $query->result_array();
			if(count($result)>0)
			{
				$result[0]['sb_child_servcie_name'] = $result[0]['sb_sub_child_service_name'];
				$result[0]['sb_sub_child_service_name'] = '';
			}
			return $result; 
		}
	}

	/**
	 * This model will provide requested oder detail.
	 * return type- 
	 * created on - 20th AUG 2015;
	 * created by - Akshay Patil;
	 * updated on - 
	 * updated by - 
	 */
	public function getOrderDetails($sb_hotel_requst_ser_id)
	{
		$qry = "SELECT a.order_placed_id,a.quantity,a.price,
				b.sb_sub_child_service_name, b.sb_sub_child_service_details
				from sb_customer_order_placed as a
				JOIN sb_paid_services as b
				ON a.sub_child_services_id = b.sub_child_services_id
				WHERE a.sb_hotel_requst_ser_id = '$sb_hotel_requst_ser_id'
				AND a.is_temp_delete = '0'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}


	public function currentGuest($sb_hotel_id,$currentDate)
	{
		$qry = "SELECT *,false as flag FROM `sb_hotel_guest_bookings` WHERE `sb_hotel_id` = '$sb_hotel_id' AND `is_checkedout` = '0'";
		$query = $this->db->query($qry);
		$users = $query->result_array();
		
		for ($i=0; $i < count($users); $i++) { 
			$sb_guest_reservation_code = $users[$i]['sb_guest_reservation_code'];
			$qry = "SELECT `sb_guest_allocated_room_no` FROM `sb_hotel_guest_reservation_attributes` 
					WHERE `sb_guest_reservation_code` = '$sb_guest_reservation_code' AND `sb_guest_actual_check_out` = '0000-00-00 00:00:00'";
			$query = $this->db->query($qry);
			$room = $query->result_array();
			$rooms = array();
			for ($j=0; $j < count($room) ; $j++) { 
				array_push($rooms, $room[$j]['sb_guest_allocated_room_no']);
			}
			$users[$i]['room_no'] = implode(",", $rooms);
		}

		/*$qry = "SELECT `visitor_firstName` as sb_guest_firstName,`visitor_lastName` as sb_guest_lastName,
				DATE(`updated_on`)as sb_guest_check_in_date, true as flag FROM `sb_visitor` HAVING sb_guest_check_in_date <= '$currentDate'";
		$query = $this->db->query($qry);
		$visitor = $query->result_array();*/
		$visitor = array();
		$finaldata = array_merge($users,$visitor);
		for ($i=0; $i < count($finaldata); $i++) { 
			for ($j=0; $j < count($finaldata) ; $j++) { 
				//echo $finaldata[$i]['sb_guest_check_in_date']."==".$finaldata[$j]['sb_guest_check_in_date'];
				if($finaldata[$i]['sb_guest_check_in_date'] > $finaldata[$j]['sb_guest_check_in_date'])
				{
					$temp = $finaldata[$i];
					$finaldata[$i] = $finaldata[$j];
					$finaldata[$j] = $temp;
				}
			}
		}
		//print_r($finaldata);die;
		return $finaldata;
	}
}//End Of Common Model