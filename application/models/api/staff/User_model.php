<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
	public function login($sb_hotel_useremail,$sb_hotel_userpasswd, $sdt_token, $sdt_deviceType ,$sdt_macid)
	{
		$qry = "SELECT hu.sb_hotel_user_id,hu.sb_hotel_id,hu.sb_hotel_username,hu.sb_staff_cat_id, hu.sb_hotel_user_pic,
				 hu.sb_hotel_user_shift_from,hu.sb_hotel_user_shift_to,s.sb_staff_cat_name FROM `sb_hotel_users` as hu
				JOIN `sb_hotel_staff_cat` as s
				ON s.`sb_staff_cat_id` = hu.`sb_staff_cat_id`
				WHERE hu.sb_hotel_useremail = '$sb_hotel_useremail' AND hu.sb_hotel_userpasswd = '$sb_hotel_userpasswd'
				AND hu.sb_hotel_user_status = '1' AND hu.sb_hotel_user_type != 'a'
				";
		$query = $this->db->query($qry);
		$result_array = $query->result_array();
		if(count($result_array)>0)
		{
			$reply = $this->staff_deviceToken($sdt_token, $sdt_deviceType ,$sdt_macid, $result_array[0]['sb_hotel_user_id']);
		}
		return $result_array;
	}

	public function logout($sb_hotel_user_id)
	{
		$qry = "UPDATE `sb_staff_devicetoken` SET `sdt_token`= '' WHERE `sb_hotel_user_id` = '$sb_hotel_user_id'";
		$query = $this->db->query($qry);
		return 1;
	}

	public function staff_deviceToken($sdt_token, $sdt_deviceType ,$sdt_macid, $sb_hotel_user_id)
	{
		$sql = "SELECT * FROM `sb_staff_devicetoken` WHERE `sdt_macid` = '$sdt_macid' AND `sb_hotel_user_id` = '$sb_hotel_user_id';";
		$query = $this->db->query($sql);
		$device = $query->result_array();
		if(count($device)>0)
		{
			$sql = "UPDATE `sb_staff_devicetoken` SET `sdt_token` = '$sdt_token' 
					 WHERE `sdt_macid` = '$sdt_macid' AND `sb_hotel_user_id` = '$sb_hotel_user_id';";
		}
		else
		{
			$sql = "INSERT INTO `sb_staff_devicetoken` (`sdt_id`, `sdt_token`, `sdt_deviceType`, `sb_hotel_user_id`, `sdt_macid`, `created_on`) 
					VALUES (NULL, '$sdt_token', '$sdt_deviceType', '$sb_hotel_user_id', '$sdt_macid', CURRENT_TIMESTAMP);";
		}
		$query = $this->db->query($sql);
		return 1;
	}

	public function check_user($arr)
	{
		$this->db->select('*');
		$this->db->from('sb_hotel_users');
		$this->db->where($arr);
		$query = $this->db->get();
		if(count($query->result_array()) > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function update_user($arr1,$arr)
	{
		$this->db->where($arr);
		$this->db->update('sb_hotel_users', $arr1);
		return 1;
	}
}
?>	