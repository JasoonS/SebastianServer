<?php

class Changepassword_model extends CI_Model{
	// public function __construct(){

	// 	parent:: __construct();
	// 	$this->load->model('changePassword_model');
	// 	if(!$this->session->userdata('logged_in_user'))
	// 	{
	// 		redirectWithErr(ERR_MSG_LEVEL_2,'login');
	// 	}else
	// 	{
	// 		// Get the user's ID and add it to the config array
	// 		$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
	// 		// Load the ACL library and pas it the config array
	// 		$this->load->library('acl',$config);
	// 	}
	// }

	// public function change_password($old_password,$new_password){
	// 	$userID=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
	// 	$this->db->select('*');
	// 	$this->db->from('sb_hotel_users');
	// 	$this->db->where('sb_hotel_user_id',$userID);
	// 	$this->db->where('sb_hotel_userpasswd',$old_password);
	// 	$query=$this->db->get();
	// 	//print_r($query->num_rows());
	// 	if($query->num_rows()>0)
	// 	{
	// 		$data=array(
	// 			'sb_hotel_userpasswd'=>$new_password
	// 			);
	// 		$id=$userID;
	// 		$this->db->update('sb_hotel_users', $data,"sb_hotel_user_id=$id");			
	// 		return 1;			
	// 	}
	// 	else
	// 	{
	// 		return 0;
	// 	}
	// }
	public function check_user($arr)
	{
		$this->db->select('sb_hotel_userpasswd');
		$this->db->from('sb_hotel_users');
		$this->db->where($arr);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update_user($arr1,$arr)
	{
		$this->db->where($arr);
		$this->db->update('sb_hotel_users', $arr1);
		return 1;
	}
}