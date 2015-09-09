	<?php
class CreateAdmin extends CI_Model
{
	function __construct()
	{
	}
	
	 
	function createAdmin($post,$pwd,$id)
	{
		$data = array(
		'sb_hotel_username' => $post['name'],
		'sb_hotel_useremail' => $post['email'],
		'sb_hotel_userpasswd' => $pwd,
		'sb_hotel_user_type' => 'a',
		'sb_hotel_user_status'=>'1',
		'sb_hotel_id' => $id
		);
		$this->db->insert('sb_hotel_users',$data);
		return 1;
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
