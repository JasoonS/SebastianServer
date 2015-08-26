<?php
Class Restaurant_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function insert_rest($insert_data)
	{
		$val = $this->db->insert('sb_hotel_restaurant',$insert_data);
		return $val;
	}

	public function change_status($sb_hotel_restaurant_id,$is_delete)
	{
		$sb_hotel_id = $this->session->userdata('logged_in_user')->sb_hotel_id;
		$qry = "UPDATE `sb_hotel_restaurant` SET `is_delete`='$is_delete' WHERE `sb_hotel_restaurant_id` = '$sb_hotel_restaurant_id' AND `sb_hotel_id`='$sb_hotel_id'";
		$query = $this->db->query($qry);
		return $query;
	}

	public function get_img($sb_hotel_restaurant_id, $sb_hotel_id)
	{
		$qry = "Select sb_rest_image from sb_hotel_restaurant WHERE sb_hotel_restaurant_id = '$sb_hotel_restaurant_id' AND sb_hotel_id = '$sb_hotel_id'";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	public function update_rest($insert_data1, $sb_hotel_restaurant_id,$sb_hotel_id)
	{
		$this->db->where('sb_hotel_restaurant_id', $sb_hotel_restaurant_id);
		$this->db->where('sb_hotel_id', $sb_hotel_id);
		$val = $this->db->update('sb_hotel_restaurant', $insert_data1);
		return $val;
	}
}	