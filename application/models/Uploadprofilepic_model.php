<?php
class Uploadprofilepic_model extends CI_Model
{
	function __construct()
	{
		parent:: __construct();
	}

	function uploadPic($edit)
	{
		$userID=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
		$this->db->where('sb_hotel_user_id',$userID);
		$this->db->update('sb_hotel_users',$edit);
	} 
}
