<?php
/* Model handles user crud operations
 * user authentication , module permssions
 * by checking access rights
 */
Class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* Method check for an existing user name
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function check_provided_username($field,$tbl,$cond = array())
	{
		$this->db->select($field);
		$query = $this->db->get_where($tbl,$cond);
	
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}

	/* Method return password salt relative
	 * to user type
	 * @param 
	 * return void
	 */
	function authenticate_user_salt($field,$tbl,$cond = array()) 
	{
		
		$this->db->select($field);
		$query = $this->db->get_where($tbl,$cond);
	
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}

	/* Method return user records relative
	 * to admin type
	 * @param string,string
	 * return array on success , false on failure
	 */
	function authenticated_admin_records($admin_user_name,$admin_passwd_salt)
	{
		$this->db->select('admin_uname,admin_email,admin_type,admin_last_logged_in');
		$this->db->from('sb_admin');
		$this->db->where('admin_uname',$admin_user_name);
		$this->db->where('admin_password_salt',$admin_passwd_salt);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}

	/* Method return user records relative
	 * to hotleir
	 * @param string,string
	 * return array on success , false on failure
	 */
	function authenticated_hoteleir_records($hoteleir_user_name,$hoteleir_passwd_salt)
	{
		$this->db->select('sb_hotel_user_id,sb_hotel_id,sb_hotel_username');
		$this->db->select('sb_hotel_useremail,sb_hotel_user_pic,sb_hotel_user_type');
		$this->db->select('sb_staff_cat_id,sb_hotel_user_shift_from,sb_hotel_user_shift_to');
		$this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_username',$hoteleir_user_name);
		$this->db->where('sb_hotel_userpasswd',$hoteleir_passwd_salt);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	
}