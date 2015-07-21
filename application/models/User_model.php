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
	
}