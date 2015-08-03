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
	 *
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
	}*/

	/* Method return user records relative
	 * to hotleir
	 * @param string,string
	 * return array on success , false on failure
	 */
	function authenticated_hoteleir_records($hoteleir_user_name,$hoteleir_passwd_salt)
	{
		$this->db->select('sb_hotel_user_id,sb_hotel_id,sb_hotel_username');
		$this->db->select('sb_hotel_useremail,sb_hotel_user_pic,sb_hotel_user_type');
		$this->db->select('sb_hotel_user_shift_from,sb_hotel_user_shift_to');
		$this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_username',$hoteleir_user_name);
		$this->db->where('sb_hotel_userpasswd',$hoteleir_passwd_salt);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	
	/* Method return user info
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_user_info($user_id)
	{
		$this->db->select('sb_hotel_user_id,sb_hotels.sb_hotel_id,sb_hotel_username,sb_hotel_name');
		$this->db->select('sb_hotel_useremail,sb_hotel_user_pic,sb_hotel_user_type');
		$this->db->select('sb_hotel_user_shift_from,sb_hotel_user_shift_to');
		$this->db->from('sb_hotel_users');
		$this->db->join('sb_hotels','sb_hotels.sb_hotel_id=sb_hotel_users.sb_hotel_id');
		$this->db->where('sb_hotel_user_id',$user_id);
		$query = $this->db->get();

		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	
	/* Method insert User Role in Database
	 * 
	 * @param array
	 * return true on success , false on failure
	 */
	function set_user_role($data)
	{
		$this->db->insert('sb_user_roles',$data);
		return $this->db->insert_id();
	}
	/* Method insert User Module Permissions in Database
	 * 
	 * @param array
	 * return true on success , false on failure
	 */
	function set_user_permissions($data)
	{
		$this->db->insert_batch('sb_user_modules',$data);
		return $this->db->insert_id();
	}
	
	/* Method Remove User Role in Database
	 * 
	 * @param array
	 * return true on success , false on failure
	 */
	function remove_user_role($user_id)
	{
	    $this->db->where('sb_hotel_user_id',$user_id);
		$this->db->delete('sb_user_roles');
		return 1;
	}
	/* Method Remove User Module Permissions in Database
	 * 
	 * @param array
	 * return true on success , false on failure
	 */
	function remove_user_permissions($user_id)
	{
		$this->db->where('sb_hotel_user_id',$user_id);
		$this->db->delete('sb_user_modules');
		return 1;
	}
	
	
}