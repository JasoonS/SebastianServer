<?php
Class Staff_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
    /* Method Return all services list
	 * inside system 
	 * @param void
	 * return @array on success and False on Fail
	 */
	function getTasks()
	{
	    $sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('*');
		$this->db->from('sb_hotel_request_service');
		$this->db->join('sb_hotel_services_status','sb_hotel_request_service.sb_hotel_requst_ser_id = sb_hotel_services_status.sb_hotel_requst_ser_id');
		$this->db->where('sb_hotel_service_assigned','y');
		$this->db->where('sb_hotel_id', $sb_hotel_id);
		$this->db->order_by('sb_parent_service_id', 'ASC');
		$query = $this->db->get();	
        return $query->result_array();		
	}
	
	
}
?>