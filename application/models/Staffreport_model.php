<?php
/* Model handles user crud operations
 * user authentication , module permssions
 * by checking access rights
 */
Class Staffreport_model extends CI_Model
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
	function getTasks($sb_hotel_id,$start,$end,$user_ids,$parent_service_id)
	{
	    
		$this->db->select('*');
		$this->db->from('sb_hotel_request_service');
		
		$this->db->join('sb_hotel_services_status','sb_hotel_request_service.sb_hotel_requst_ser_id = sb_hotel_services_status.sb_hotel_requst_ser_id');
		$this->db->join('sb_hotel_parent_services','sb_hotel_request_service.sb_parent_service_id = sb_hotel_parent_services.sb_parent_service_id','left');
		$this->db->join('sb_paid_services','sb_hotel_request_service.sub_child_services_id = sb_paid_services.sub_child_services_id','left');
		$this->db->join('sb_hotel_guest_bookings','sb_hotel_guest_bookings.sb_hotel_guest_booking_id = sb_hotel_request_service.sb_hotel_guest_booking_id');
		$this->db->where_in('sb_hotel_ser_assgnd_to_user_id',$user_ids);
		$this->db->where('sb_hotel_request_service.sb_hotel_id',$sb_hotel_id);
		$this->db->where('sb_hotel_ser_start_date >=',$start);
		$this->db->where('sb_hotel_ser_start_date <=',$end);
		$this->db->where('sb_hotel_request_service.sb_parent_service_id',$parent_service_id);
		//$this->db->order_by('sb_hotel_request_service.sb_parent_service_id', 'ASC');
		$query = $this->db->get();	
		return $query->result_array();	
		
	}
}//End Of Model