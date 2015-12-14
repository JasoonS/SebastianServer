<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forum_model extends CI_Model
{
	function post_forum($insertData)
	{
		$this->db->insert('sb_forum', $insertData);
		return $this->db->insert_id();
	}

	public function get_forum($sb_hotel_guest_booking_id)
	{
		$qry = "SELECT * FROM `sb_forum` 
				WHERE `sb_hotel_guest_booking_id` = '{$sb_hotel_guest_booking_id}'
				ORDER BY `created_on` DESC";
		$query = $this->db->query($qry);
		return $query->result_array();
	}
}
?>	