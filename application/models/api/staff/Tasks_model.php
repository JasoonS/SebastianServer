<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tasks_model extends CI_Model
{
	public function todays_tasks($sb_hotel_user_id,$service_due_date)
	{
		//$qry = "SELECT * FROM `sb_guest_services` WHERE `sb_hotel_user_id` = '$sb_hotel_user_id' ";
		$qry = "SELECT  sb_guest_services.sb_guest_services_id, sb_guest_services.service_type,sb_guest_services.guest_room_number,
				sb_guest_services.service_message,sb_guest_services.service_due_date,sb_guest_services.service_due_time,
				sb_hotel_guest_bookings.sb_guest_firstName,sb_hotel_guest_bookings.sb_guest_lastName
				FROM `sb_guest_services` 
				JOIN `sb_hotel_guest_bookings`
				ON `sb_guest_services`.`sb_hotel_guest_booking_id` = `sb_hotel_guest_bookings`.`sb_hotel_guest_booking_id`
				WHERE `sb_hotel_user_id` = '$sb_hotel_user_id'";

		$qry .=" and `service_status` = 'accepted' AND `service_due_date` = '$service_due_date'";
		$query = $this->db->query($qry);
		return $data = $query->result_array();
	}

	public function weekly_tasks($sb_staff_cat_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT sb_guest_services.*,sb_hotel_guest_bookings.sb_guest_firstName,sb_hotel_guest_bookings.sb_guest_lastName FROM `sb_guest_services` 
				JOIN sb_hotel_guest_bookings
				ON sb_guest_services.sb_hotel_guest_booking_id = sb_hotel_guest_bookings.sb_hotel_guest_booking_id
				WHERE sb_guest_services.sb_hotel_id = '$sb_hotel_id' AND sb_guest_services.sb_staff_cat_id = '$sb_staff_cat_id'
				AND sb_guest_services.service_due_date BETWEEN '$weekdates[0]' AND '$weekdates[1]';";
		
		$query = $this->db->query($qry);
		$data = $query->result_array();

		for ($i=0; $i < count($data); $i++) { 
			$data[$i]['accepted_by'] = '';
			if ($data[$i]['service_status'] == 'accepted') {
				$id =  $data[$i]['sb_hotel_user_id'];
				$qry = "SELECT `sb_hotel_username` FROM `sb_hotel_users` WHERE `sb_hotel_user_id` = '$id';";
				$query = $this->db->query($qry);
				$name = $query->result_array();
				$data[$i]['accepted_by'] = $name[0]['sb_hotel_username'];
			}
		}

		return $data;
	}

	public function completed_tasks($sb_staff_cat_id ,$weekdates, $sb_hotel_id)
	{
		$qry = "SELECT gs.sb_guest_services_id, gs.guest_room_number, gb.sb_guest_firstName, gb.sb_guest_lastName,
				gs.service_due_date,gs.service_due_time,gs.service_done_date,gs.service_done_time,
				gs.service_type, gs.sb_hotel_user_id, hu.sb_hotel_username 
				FROM sb_guest_services as gs 
				JOIN sb_hotel_guest_bookings as gb 
				ON gs.sb_hotel_guest_booking_id = gb.sb_hotel_guest_booking_id
				JOIN sb_hotel_users as hu
				ON gs.sb_hotel_user_id = hu.sb_hotel_user_id
				WHERE gs.service_status = 'completed'
				AND gs.sb_hotel_id = '$sb_hotel_id' AND gs.sb_staff_cat_id ='$sb_staff_cat_id'
				AND  gs.service_due_date BETWEEN '$weekdates[0]' AND '$weekdates[1]';";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
}
?>	