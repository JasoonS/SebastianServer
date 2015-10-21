<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Setting_model extends CI_Model
{
	public function update_setting($updateData,$sb_hotel_guest_booking_id)
	{
		$this->db->where('sb_hotel_guest_booking_id', $sb_hotel_guest_booking_id);
		$this->db->update('sb_hotel_guest_bookings', $updateData); 
		return 1;
	}

	public function remove_devicetokens($updateData,$sb_hotel_guest_booking_id)
	{
		$this->db->where('sb_hotel_guest_booking_id', $sb_hotel_guest_booking_id);
		$this->db->update('sb_guest_devicetoken', $updateData); 
		return 1;
	}
}	
