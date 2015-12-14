<?php
class Uploadprofilepic_model extends CI_Model
{
	function __construct()
	{
		parent:: __construct();
	}

	function uploadPic($edit,$sb_hotel_user_id)
	{
		
		$this->db->where('sb_hotel_user_id',$sb_hotel_user_id);
		$this->db->update('sb_hotel_users',$edit);
	} 
}
