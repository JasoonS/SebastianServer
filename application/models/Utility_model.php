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
	
	/* 
	Returns List Of Hotels
	 */
	function get_all_hotels()
	{
		$this->db->select('sb_hotel_id ,sb_hotel_name');
		$query = $this->db->get('sb_hotels');
		if($query->num_rows() > 0)
			return $row = $query->result_array();
		else
			return FALSE;
	} 
	
	/* 
	Returns List Of all Designations of Hotel Users
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
	
	/*
	Returns List Of Enum values Passed
	*/
    function get_enum_values( $table, $field )
	{
		$type = $this->db->query( "SHOW COLUMNS FROM {$table} WHERE Field = '{$field}'" )->row( 0 )->Type;
		preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
		$enum = explode("','", $matches[1]);
		return $enum;
	} 
	
}