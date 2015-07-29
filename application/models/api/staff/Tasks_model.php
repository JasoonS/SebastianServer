<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tasks_model extends CI_Model
{
	public function todays_tasks($sb_hotel_user_id,$service_due_date)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id, hrs.sb_guest_allocated_room_no, hrs.sb_service_log,
				hss.sb_hotel_ser_start_date as service_due_date, hss.sb_hotel_ser_start_time as service_due_time,
				b.sb_guest_firstName, b.sb_guest_lastName,
				IF(hrs.sb_hotel_requst_ser_id != '','request', 'request') as service_type
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN `sb_hotel_guest_bookings` as b
				ON hrs.sb_hotel_guest_booking_id = b.sb_hotel_guest_booking_id
				WHERE hss.sb_hotel_service_status = 'accepted'
				AND hss.sb_hotel_ser_assgnd_to_user_id ='$sb_hotel_user_id'
				AND hss.sb_hotel_ser_start_date='$service_due_date';";
		$query = $this->db->query($qry);
		return $data = $query->result_array();
	}

	public function weekly_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id,hrs.sb_guest_allocated_room_no,hrs.sb_hotel_ser_reqstd_on, hss.sb_hotel_ser_assgnd_to_user_id,
				hss.sb_hotel_service_status, IF(hrs.sb_hotel_requst_ser_id != '','request', 'request') as service_type,
				b.sb_guest_firstName,b.sb_guest_lastName,hrs.sb_service_log
				FROM `sb_hotel_request_service` as hrs
				JOIN sb_hotel_services_status as hss
				ON hrs.`sb_hotel_requst_ser_id` = hss.sb_hotel_requst_ser_id
				JOIN `sb_hotel_guest_bookings` as b
				ON hrs.sb_hotel_guest_booking_id = b.sb_hotel_guest_booking_id
				WHERE hrs.sb_hotel_id = '$sb_hotel_id'
				AND hrs.sb_parent_service_id ='$sb_parent_service_id'
				AND hss.sb_hotel_ser_start_date BETWEEN '$weekdates[0]' AND '$weekdates[1]';";
		
		$query = $this->db->query($qry);
		$data = $query->result_array();
		
		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['accepted_by'] = '';
			if ($data[$i]['sb_hotel_service_status'] == 'accepted' || $data[$i]['sb_hotel_service_status'] == 'completed') {
				$id =  $data[$i]['sb_hotel_ser_assgnd_to_user_id'];
				$qry = "SELECT `sb_hotel_username` FROM `sb_hotel_users` WHERE `sb_hotel_user_id` = '$id';";
				$query = $this->db->query($qry);
				$name = $query->result_array();
				$data[$i]['accepted_by'] = $name[0]['sb_hotel_username'];
			}
		}

		return $data;
	}

	public function completed_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT hrs.sb_hotel_requst_ser_id,hrs.sb_guest_allocated_room_no,gb.sb_guest_firstName, gb.sb_guest_lastName,
				hss.sb_hotel_ser_start_date as service_due_date, hss.sb_hotel_ser_start_time as service_due_time,
				hss.sb_hotel_ser_finished_date as service_done_date, hss.sb_hotel_ser_finished_time as service_done_time,
				hu.sb_hotel_user_id, hu.sb_hotel_username, hrs.sb_service_log,
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
				AND hss.sb_hotel_ser_start_date BETWEEN '$weekdates[0]' AND '$weekdates[1]';";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function check_status($sb_hotel_requst_ser_id)
	{
		$qry = "Select sb_hotel_service_status from sb_hotel_services_status where sb_hotel_requst_ser_id = '$sb_hotel_requst_ser_id'  "	;
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function update_status($sb_hotel_requst_ser_id,$sb_hotel_user_id)
	{
		$date = date('Y-m-d' );
		$time =  date('H:i:s');
		$data = array(
               'sb_hotel_service_assigned' => 'y',
               'sb_hotel_ser_assgnd_to_user_id' => $sb_hotel_user_id,
               'sb_hotel_ser_start_date' => $date,
               'sb_hotel_ser_start_time'=>  $time,
               'sb_hotel_service_status'=> 'accepted' ,

            );
		$this->db->where('sb_hotel_requst_ser_id', $sb_hotel_requst_ser_id);
		$val = $this->db->update('sb_hotel_services_status', $data); 
		return $val;

	}
}
?>	