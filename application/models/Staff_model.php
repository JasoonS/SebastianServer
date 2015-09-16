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
	
	/* Method To add Chat Messages to Staff
	 * inside system 
	 * @param array
	 * return int 
	 */
	function add_message($data)
	{
	   	$this->db->insert('sb_hotel_staff_chat',$data);
		return $this->db->insert_id();
	}
	
	/* Method make messages as read
	 * for passed user_id
	 * @param void
	 * return array
	 */
	function mark_as_read($receiver_id)
	{
		$update_data=array(
		            'read_status'=>'1'
					);   
		$this->db->where_in('receiver_id',$this->session->userdata('logged_in_user')->sb_hotel_user_id);
		$this->db->where_in('sender_id',$receiver_id);
		
		$this->db->update('sb_hotel_staff_chat',$update_data);
		return 1;
		
	}

    /* Method return staff chat history
	 * for passed user_id
	 * @param void
	 * return array
	 */
	function get_staff_chat_history($sender_id)
	{
		$this->db->select('*');
		$this->db->where_in('sender_id',array($sender_id,userdata('logged_in_user')->sb_hotel_user_id));
			$this->db->or_where_in('receiver_id',array($sender_id,userdata('logged_in_user')->sb_hotel_user_id));
		$this->db->from('sb_hotel_staff_chat');
		//$this->db->join('sb_hotel_users','sb_hotel_users.sb_hotel_user_id = sb_hotel_staff_chat.hotel_user_id','left');
	
		$this->db->order_by('sb_hotel_staff_chat.created_on','asc');
		echo $this->db->last_query();
		$query = $this->db->get();
		return $query->result();
	}		
}
?>