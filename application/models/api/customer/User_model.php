<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	function get_reservation($sb_guest_firstName, $sb_guest_lastName , $sb_guest_email, $sb_hotel_name , $sb_guest_contact_no)
	{
		$qry = "Select sb.sb_guest_reservation_code 
				from sb_hotel_guest_bookings as sb
				JOIN sb_hotels as h
				ON sb.sb_hotel_id = h.sb_hotel_id
				where sb.sb_guest_firstName = '$sb_guest_firstName' 
				AND sb.sb_guest_lastName = '$sb_guest_lastName'
				AND sb.sb_guest_email = '$sb_guest_email'
				AND h.sb_hotel_name = '$sb_hotel_name'
				AND sb.sb_guest_contact_no = '$sb_guest_contact_no';";
		
		$query = $this->db->query($qry);
		return $query->result_array();
	}
}
?>	