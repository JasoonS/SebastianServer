<?php
/* Model handles user crud operations
 * user authentication , module permssions
 * by checking access rights
 */
Class Utility_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/* 
	Returns List Of all countries
	 */
	function get_country_list()
	{
		$this->db->select('id as country_id,sortname as country_short_name,name as country_name');
        $query = $this->db->get('countries');
		if($query->num_rows() > 0)
			return $row = $query->result_array();
		else
			return FALSE;
	}
	
	/* 
	Returns List Of states in country by country id
	 */
	function get_state_list($country_id)
	{
		$this->db->select('id as state_id,name as state_name');
        $this->db->where('country_id',$country_id);
		$query = $this->db->get('states');
		if($query->num_rows() > 0)
			return $row = $query->result_array();
		else
			return FALSE;
	}

	/* 
	Returns List Of Cities in state by state id
	 */
	function get_city_list($state_id)
	{
		$this->db->select('id as city_id,name as city_name');
        $this->db->where('state_id',$state_id);
		$query = $this->db->get('cities');
		if($query->num_rows() > 0)
			return $row = $query->result_array();
		else
			return FALSE;
	} 
	

	
}