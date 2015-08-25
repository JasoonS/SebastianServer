<?php

class Changepassword_model extends CI_Model{	
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