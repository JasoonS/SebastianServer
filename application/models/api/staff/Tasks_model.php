<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tasks_model extends CI_Model
{
	public function todays_tasks($sb_hotel_user_id,$service_due_date)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id, hrs.sb_guest_allocated_room_no, hrs.sb_service_log,
				hss.sb_hotel_ser_start_date as service_due_date,  DATE_FORMAT(hss.sb_hotel_ser_start_time,'%l:%i %p') as service_due_time,
				b.sb_guest_firstName,hss.sb_hotel_service_status, b.sb_guest_lastName,hrs.sb_hotel_guest_booking_id,
				IF(hrs.sb_hotel_requst_ser_id != '','request', 'request') as service_type
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN `sb_hotel_guest_bookings` as b
				ON hrs.sb_hotel_guest_booking_id = b.sb_hotel_guest_booking_id
				WHERE hss.sb_hotel_service_status = 'accepted'
				AND hss.sb_hotel_ser_assgnd_to_user_id ='$sb_hotel_user_id'
				AND hss.sb_hotel_ser_start_date='$service_due_date'
				ORDER BY hss.sb_hotel_ser_start_date DESC, hss.sb_hotel_ser_start_time DESC;";
		$query = $this->db->query($qry);
		$data = $query->result_array();
		if(count($data)>0)
		{
			for ($i=0; $i < count($data); $i++) { 
				$child = $this->getChildServiceDetails($data[$i]['sb_hotel_requst_ser_id']);
				$data[$i]['sb_child_servcie_name'] = '';
				if(count($child)>0)
				{
					$data[$i]['sb_child_servcie_name'] = $child[0]['sb_child_servcie_name'];
				}
			}			
		}
		return $data;	
	}

	public function weekly_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id,hrs.sb_guest_allocated_room_no,hrs.sb_hotel_ser_reqstd_on, 
				hss.sb_hotel_ser_assgnd_to_user_id, hss.sb_hotel_ser_start_date as service_due_date,  DATE_FORMAT(hss.sb_hotel_ser_start_time,'%l:%i %p') as service_due_time,
				hss.sb_hotel_ser_finished_date as service_done_date,  DATE_FORMAT(hss.sb_hotel_ser_finished_time,'%l:%i %p') as service_done_time,
				hss.sb_hotel_service_status, IF(hrs.sb_hotel_requst_ser_id != '','request', 'request') as service_type,
				b.sb_guest_firstName,b.sb_guest_lastName,hrs.sb_service_log,hrs.sb_hotel_guest_booking_id
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN `sb_hotel_guest_bookings` as b
				ON hrs.sb_hotel_guest_booking_id = b.sb_hotel_guest_booking_id
				WHERE hrs.sb_hotel_id = '$sb_hotel_id'
				AND hss.sb_hotel_service_status != 'completed'
				AND hrs.sb_parent_service_id ='$sb_parent_service_id'
				AND hss.sb_hotel_ser_start_date BETWEEN '$weekdates[0]' AND '$weekdates[1]'
				ORDER BY hss.sb_hotel_ser_start_date DESC, hss.sb_hotel_ser_start_time DESC;";
		
		$query = $this->db->query($qry);
		$data = $query->result_array();
		
		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['accepted_by'] = '';
			if ($data[$i]['sb_hotel_service_status'] == 'accepted' || $data[$i]['sb_hotel_service_status'] == 'completed'|| $data[$i]['sb_hotel_service_status'] == 'rejected') {
				$id =  $data[$i]['sb_hotel_ser_assgnd_to_user_id'];
				$qry = "SELECT `sb_hotel_username` FROM `sb_hotel_users` WHERE `sb_hotel_user_id` = '$id';";
				$query = $this->db->query($qry);
				$name = $query->result_array();
				$data[$i]['accepted_by'] = $name[0]['sb_hotel_username'];
			}
		}

		if(count($data)>0)
		{
			for ($i=0; $i < count($data); $i++) { 
				$child = $this->getChildServiceDetails($data[$i]['sb_hotel_requst_ser_id']);
				$data[$i]['sb_child_servcie_name'] = '';
				if(count($child)>0)
				{
					$data[$i]['sb_child_servcie_name'] = $child[0]['sb_child_servcie_name'];
				}
			}			
		}

		return $data;
	}

	public function completed_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id,hrs.sb_guest_allocated_room_no,gb.sb_guest_firstName, gb.sb_guest_lastName,
				hss.sb_hotel_ser_start_date as service_due_date,  DATE_FORMAT(hss.sb_hotel_ser_start_time,'%l:%i %p') as service_due_time,
				hss.sb_hotel_ser_finished_date as service_done_date,  DATE_FORMAT(hss.sb_hotel_ser_finished_time,'%l:%i %p') as service_done_time,
				hu.sb_hotel_user_id, hu.sb_hotel_username, hrs.sb_service_log,hrs.sb_hotel_guest_booking_id,
				IF(hrs.sb_hotel_requst_ser_id != '','request', 'request') as service_type
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN sb_hotel_guest_bookings as gb 
				ON hrs.sb_hotel_guest_booking_id = gb.sb_hotel_guest_booking_id
				JOIN sb_hotel_users as hu
				ON hss.sb_hotel_ser_assgnd_to_user_id = hu.sb_hotel_user_id
				WHERE hss.sb_hotel_service_status = 'completed'
				AND hrs.sb_hotel_id = '$sb_hotel_id'
				AND hrs.sb_parent_service_id ='$sb_parent_service_id'
				AND hss.sb_hotel_ser_start_date BETWEEN '$weekdates[0]' AND '$weekdates[1]'
				ORDER BY hss.sb_hotel_ser_start_date DESC, hss.sb_hotel_ser_start_time DESC;";
		$query = $this->db->query($qry);
		$data = $query->result_array();
		if(count($data)>0)
		{
			for ($i=0; $i < count($data); $i++) { 
				$child = $this->getChildServiceDetails($data[$i]['sb_hotel_requst_ser_id']);
				$data[$i]['sb_child_servcie_name'] = '';
				if(count($child)>0)
				{
					$data[$i]['sb_child_servcie_name'] = $child[0]['sb_child_servcie_name'];
				}
			}			
		}
		return $data;
	}

	public function check_status($sb_hotel_requst_ser_id)
	{
		$qry = "Select sb_hotel_service_status,sb_hotel_ser_assgnd_to_user_id from sb_hotel_services_status where sb_hotel_requst_ser_id = '$sb_hotel_requst_ser_id'  "	;
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function update_status($sb_hotel_requst_ser_id,$data)
	{
		$this->db->where('sb_hotel_requst_ser_id', $sb_hotel_requst_ser_id);
		$val = $this->db->update('sb_hotel_services_status', $data); 
		return $val;
	}

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
			
		}
		else
		{
			$sub_child_services_id = $data[0]['sub_child_services_id'];
			$qry = "SELECT sb_sub_child_service_name from sb_sub_child_services where sub_child_services_id = '$sub_child_services_id' ";
			$query = $this->db->query($qry);
			$result = $query->result_array();
			$result[0]['sb_child_servcie_name'] = $result[0]['sb_sub_child_service_name'];
			$result[0]['sb_sub_child_service_name'] = '';
			return $result; 
		}

		
		
		return $query->result_array();
	}
}
?>	