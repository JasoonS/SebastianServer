	<?php
class CreateAdmin extends CI_Model
{
	function __construct()
	{
	}
	
	 
	function createAdmin($data)
	{
		
		$this->db->insert('sb_hotel_users',$data);
		return $this->db->insert_id();
	}
	function find_user($user_name)
		{
	    	$this->db->select('COUNT(`sb_hotel_username`) as usercount',false);
			$this->db->where('sb_hotel_username',$user_name);
			$query=$this->db->get('sb_hotel_users');
			return $query->result_array();
		}
}
?>
