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
		$this->db->select('sb_hotel_users.sb_hotel_user_id,sb_hotel_users.sb_hotel_id,sb_hotel_username,sb_hotel_name');
		$this->db->select('sb_hotel_useremail,sb_hotel_user_pic,sb_hotel_user_type');
		$this->db->select('sb_hotel_user_shift_from,sb_hotel_user_shift_to,sb_staff_designation_name,sb_parent_service_name,sb_hotel_user_service_access_map.sb_parent_service_id');
		$this->db->from('sb_hotel_users');
		$this->db->join('sb_hotels','sb_hotels.sb_hotel_id=sb_hotel_users.sb_hotel_id','left');
		$this->db->join('sb_hotel_staff_designation','sb_hotel_staff_designation.sb_staff_designation_id=sb_hotel_users.sb_staff_designation_id','left');
		$this->db->join('sb_hotel_user_service_access_map','sb_hotel_user_service_access_map.sb_hotel_user_id=sb_hotel_users.sb_hotel_user_id','left');
		$this->db->join('sb_hotel_parent_services','sb_hotel_parent_services.sb_parent_service_id=sb_hotel_user_service_access_map.sb_parent_service_id','left');
		
		$this->db->where('sb_hotel_users.sb_hotel_user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	
	/* Method insert User Role in Database 
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
	 * @param array
	 * return true on success , false on failure
	 */
	function remove_user_permissions($user_id)
	{
		$this->db->where('sb_hotel_user_id',$user_id);
		$this->db->delete('sb_user_modules');
		return 1;
	}
	/* Returns List Of all Designations of Hotel Users
	 * @params void
	 *
	 */
	function get_all_designations()
	{
		$this->db->select('sb_staff_designation_id as designation_id,sb_staff_designation_name as designation_name');
        $query = $this->db->get('sb_hotel_staff_designation');
		if($query->num_rows() > 0)
			return $row = $query->result_array();
		else
			return FALSE;
	}
	
	/* Method Get User Information according to its Email Id
	 * @param string
	 * return array
	 */
	function get_user_by_email($user_email)
	{
		$this->db->select('sb_hotel_user_id,sb_hotel_username');
		$this->db->where('sb_hotel_useremail',$user_email);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	/* Method return user name
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_user_name($user_id)
	{
		$this->db->select('sb_hotel_username');
	    $this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	/* Method return user parent service id
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_user_parent_service($user_id)
	{
		$this->db->select('DISTINCT sb_parent_service_id',false);
	    $this->db->from('sb_hotel_user_service_access_map');
		$this->db->where('sb_hotel_user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	
	/* Method to get device token of provided hotel staff user.
	 *@param array
     * return array
	 */
	function get_staff_device_tokens($user_ids)
	{
	    $this->db->select('sdt_token,sdt_deviceType');
		$this->db->from('sb_staff_devicetoken');
		$this->db->where_in('sb_hotel_user_id',$user_ids);
		$query =$this->db->get();
		return $query->result_array();	
	}
	/* Method to get Role Modules.
	 *@param array
     * return array
	 */
	function get_role_modules($role_id)
	{
	    $this->db->select('sb_roleid,sb_mod_id');
		$this->db->from('sb_roles_mod');
		$this->db->where('sb_roleid',$role_id);
		$query =$this->db->get();
		return $query->result_array();	
	}
	/* Method return user hotel id
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_user_hotel_id($user_id)
	{
		$this->db->select('sb_hotel_id');
	    $this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_user_id',$user_id);
		$query = $this->db->get();
		if($query->num_rows() > 0)
			return $row = $query->row();
		else
			return FALSE;
	}
	/* Method return user hotel id
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_staff($service_id)
	{
		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('sb_hotel_users.sb_hotel_user_id,sb_hotel_username');
		$this->db->join('sb_hotel_user_service_access_map','sb_hotel_user_service_access_map.sb_hotel_user_id=sb_hotel_users.sb_hotel_user_id','left');
	    $this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_user_type','s');
		$this->db->where('sb_parent_service_id',$service_id);
		$this->db->where('sb_hotel_user_status','1');
		$this->db->group_by('sb_hotel_users.sb_hotel_user_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method return user hotel id
	 * to hotleir
	 * @param int
	 * return array on success , false on failure
	 */
	function get_staff_list($service_id=0)
	{
		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('*');
		$this->db->join('sb_hotel_user_service_access_map','sb_hotel_user_service_access_map.sb_hotel_user_id=sb_hotel_users.sb_hotel_user_id','left');
	    $this->db->join('sb_hotel_parent_services','sb_hotel_parent_services.sb_parent_service_id=sb_hotel_user_service_access_map.sb_parent_service_id');
	    $this->db->from('sb_hotel_users');
		$this->db->where('sb_hotel_user_type','s');
		if($service_id != 0){
			$this->db->where('sb_hotel_user_service_access_map.sb_parent_service_id',$service_id);
		}
		$this->db->where('sb_hotel_user_status','1');
		$this->db->group_by('sb_hotel_users.sb_hotel_user_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method Get All Superadministrators
	 * @param string
	 * return array
	 */
	function get_all_active_superadministrators()
	{
		$this->db->select('sb_hotel_useremail');
		$this->db->where('sb_hotel_user_type','u');
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	
	
}//End Of Model