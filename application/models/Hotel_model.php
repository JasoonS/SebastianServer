<?php
/* Model handles user crud operations
 * user authentication , module permssions
 * by checking access rights
 */
Class Hotel_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* Method create Hotel 
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel($hotel_data)
	{
		return $this->db->insert('sb_hotels',$hotel_data);
	}
	
	/* Method Return If Hotel Present  
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel($hotel_name)
	{
	    $this->db->select('COUNT(`sb_hotel_name`) as hotelcount',false);
		$this->db->where('sb_hotel_name',$hotel_name);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}
	
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_name($hotel_user_name)
	{
	    $this->db->select('COUNT(`sb_hotel_username`) as hotelusercount',false);
		$this->db->where('sb_hotel_username',$hotel_user_name);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_email($hotel_email)
	{
	    $this->db->select('COUNT(`sb_hotel_useremail`) as hotelusercount',false);
		$this->db->where('sb_hotel_useremail',$hotel_email);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	/* Method create Hotel Admin
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel_admin($hotel_admin_data)
	{
		return $this->db->insert('sb_hotel_users',$hotel_admin_data);
	}
	/* Method get Hotel Name
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_hotel_name($hotel_id)
	{
		$this->db->select('sb_hotel_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}

}