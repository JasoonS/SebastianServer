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

}