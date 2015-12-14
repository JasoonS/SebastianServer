<?php
/* Model responsible for handling all guest queries */
class Guest_model extends CI_Model
{
	public $hotel_id = '';

	function __construct()
	{
		parent::__construct();
	}

	/* Method return guest data
	 * for passed hotel id
	 * @param int
	 * return array
	 */
	function get_guest_data($passed_hotel_id = NULL)
	{
		$this->hotel_id = $passed_hotel_id;
		$this->db->select('*');
		$this->db->from('sb_hotel_guest_bookings');
		$this->db->where('sb_hotel_id',$this->hotel_id);
		$query = $this->db->get();
		return $query->result();
	}

	/* Method insert guest booking in `sb_hotel_guest_bookings`
	 * @param array
	 * return integer
	 */
	function insert_guest_booking($guest_booking_array = array())
	{
		$this->db->insert('sb_hotel_guest_bookings', $guest_booking_array);
		return $this->db->insert_id();
	}

	/* Method return first name , last name
	 * and hotel name of a guest booking
	 * @param int,int
	 * return array
	 */
	function select_guest_booking($booking_id,$hotel_id)
	{
		$this->db->select('sb_guest_firstName,sb_guest_lastName,sb_hotel_name');
		$this->db->from('sb_hotel_guest_bookings');
		$this->db->join('sb_hotels','sb_hotel_guest_bookings.sb_hotel_id = sb_hotels.sb_hotel_id');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$this->db->where('sb_hotels.sb_hotel_id',$hotel_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/* Method update `sb_guest_reservation_code`
	 * in sb_hotel_guest_bookings
	 * @param int,string
	 * return boolean
	 */
	function update_guest_reservation_code($last_booking_id = null , $confirmation_code = null)
	{
		$data = array('sb_guest_reservation_code'=>$confirmation_code);
		$this->db->where('sb_hotel_guest_booking_id', $last_booking_id);
		$this->db->update('sb_hotel_guest_bookings', $data);
		return $this->db->affected_rows(); 
	}
	/* Method get allocated rooms 
	 * in sb_hotel_guest_reservation_attributes
	 * @param string
	 * return int
	 */
	function get_allocated_rooms($reservation_code,$hotel_id)
	{
		$this->db->select('count(*) as roomscount',false);
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$query=$this->db->get('sb_hotel_guest_reservation_attributes');
		return $query->result_array();
	}	
	/* Method get if room is present 
	 * @param string
	 * return int
	 */
	function get_if_room_present($room_no,$hotel_id)
	{
		$this->db->select('count(*) as roomscount',false);
		$this->db->from('sb_hotel_rooms');
		$this->db->join('sb_hotel_guest_reservation_attributes','sb_hotel_guest_reservation_attributes.sb_guest_allocated_room_no=sb_hotel_rooms.sb_room_number','left');
		$this->db->where('sb_room_number',$room_no);
		$this->db->where('sb_hotel_rooms.sb_hotel_id',$hotel_id);
		$this->db->where('sb_room_is_deleted','0');
		$this->db->where('is_available','1');
		$query=$this->db->get();
		return $query->result_array();
		
	}	
	/* Method to allocate rooms
	 * @param array
	 * return 1
	 */
	function allocate_rooms($data)
	{
		$this->db->insert_batch('sb_hotel_guest_reservation_attributes',$data);
		return 1;
	}
	
	/* Method to make rooms unavailable
	 * @param array
	 * return 1
	 */
	function make_rooms_unavailable($data)
	{
	    $update_data=array(
						"is_available"=>'0'
					 );
	    $hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
	    $this->db->where('sb_hotel_id',$hotel_id);
		$this->db->where_in('sb_room_number',$data);
		$this->db->update('sb_hotel_rooms', $update_data); 
		return 1;
	}
	/* Method get guest data by rooms
	 * @param int
	 * return array
	 */
	function get_hotel_guest_data($booking_id,$room_no = 0)
	{
	    $this->db->select('*');
		$this->db->from('sb_hotel_guest_bookings');
		$this->db->join('sb_hotel_guest_reservation_attributes','sb_hotel_guest_bookings.sb_guest_reservation_code = sb_hotel_guest_reservation_attributes.sb_guest_reservation_code');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		if($room_no !=0)
		{
			$this->db->where('sb_guest_allocated_room_no',$room_no);
		}
		$query = $this->db->get();
		return $query->result();
	}
	/* Method to get room orders data
	 * @param int,int
	 * return array
	 */
	function get_hotel_guest_orders($booking_id,$room_no)
	{
	    $this->db->select('*');
		$sub_child_service_image_url=base_url(SUBCHILD_SERVICE_PIC)."/";
		$this->db->select('sb_customer_order_placed.sub_child_services_id as subchildservice',false);
		$this->db->select('(SELECT sb_sub_child_service_name from sb_paid_services WHERE sub_child_services_id = subchildservice ) as service_name');
		$this->db->select('(SELECT CONCAT("'.$sub_child_service_image_url.'", `sb_hotel_id` ,"/", `sb_sub_child_service_image`) from sb_paid_services WHERE sub_child_services_id = subchildservice ) as service_image',false);	
		$this->db->from('sb_hotel_request_service');
		$this->db->join('sb_customer_order_placed','sb_hotel_request_service.sb_hotel_requst_ser_id = sb_customer_order_placed.sb_hotel_requst_ser_id');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$this->db->where('sb_guest_allocated_room_no',$room_no);
		$this->db->where('order_details','1');
		$this->db->where('is_temp_delete','0');
		$query = $this->db->get();
		return $query->result();
	}
	/* Method to get guest general data
	 * @param int
	 * return array
	 */
	function get_hotel_guest_general_data($booking_id)
	{
	    $this->db->select('*');
		$this->db->from('sb_hotel_guest_bookings');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$query = $this->db->get();
		return $query->result();
	}
	/* Method to release the hotel room
	 * @param int
	 * return array
	 */
	function release_room($room_no,$hotel_id,$reservation_code)
	{
	    $date=date('y-m-d h:i:s');
		$update_data=array(
		            'sb_guest_actual_check_out'=>$date
					);   
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->where('sb_guest_allocated_room_no',$room_no);	
		$this->db->update('sb_hotel_guest_reservation_attributes',$update_data);
		$room_data=array(
					'is_available'=>'1'
					);
		$this->db->where('sb_room_number',$room_no);
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->update('sb_hotel_rooms',$room_data);
		return true;
	}
	/* Method to get allocated room nos to particular reservation code/booking
	 * @param int
	 * return array
	 */
	function get_allocated_room_numbers($reservation_code,$hotel_id)
	{
		$this->db->select('sb_guest_allocated_room_no');
		$this->db->where('sb_guest_actual_check_out',"0000-00-00 00:00:00");
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->from('sb_hotel_guest_reservation_attributes');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method to release the hotel rooms
	 * @param int
	 * return array
	 */
	function release_rooms($room_nos,$hotel_id,$reservation_code)
	{
	    $date=date('y-m-d h:i:s');
		$update_data=array(
		            'sb_guest_actual_check_out'=>$date
					);   
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->where_in('sb_guest_allocated_room_no',$room_nos);	
		$this->db->update('sb_hotel_guest_reservation_attributes',$update_data);
		$room_data=array(
					'is_available'=>'1'
					);
		$this->db->where_in('sb_room_number',$room_nos);
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->update('sb_hotel_rooms',$room_data);
		return true;
	}
	/* Method to update checkout flag when all rooms are checkout
	 * @param int
	 * return array
	 */
	function change_status($reservation_code,$hotel_id)
	{
		$guest_booking_data=array(
					'is_checkedout'=>'1'
					);
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->update('sb_hotel_guest_bookings',$guest_booking_data);
		return true;
	}
   
   /* Method to get booking_id from reservation_code
    * @param string
	* return int
	*/
    function getBookingId($reservation_code,$hotel_id)
    {
		$this->db->select('sb_hotel_guest_booking_id');
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->where('sb_hotel_id',$hotel_id);
		$query=$this->db->get('sb_hotel_guest_bookings');
		return $query->result_array();
		
    } 
   /* Method to get device token for guest
    * @param string
	* return int
	*/
    function getdevicetoken($booking_id)
    {
		$this->db->select('cdt_token,cdt_deviceType');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$query=$this->db->get('sb_guest_devicetoken');
		return $query->result_array();
		
    }
    /* Method To get Total Hotel Visitor Users
	 * for passed hotel id
	 * @param int
	 * return array
	 */
	function getTotalVisitors()
	{
		$hotel_id = $this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select_sum('visit_cout');
		$this->db->from('sb_visitor');
		$this->db->where('sb_hotel_id',$hotel_id);
		$query = $this->db->get();
		return $query->row()->visit_cout;
	}

    /* Method To get Total Visitor Users
	 * for passed hotel id
	 * @param int
	 * return array
	 */
	function getAllVisitors()
	{
		$this->db->select_sum('visit_cout');
		$this->db->from('sb_visitor');	
		$query = $this->db->get();
		return $query->row()->visit_cout;
	}

	/* Method return customer data
	 * for passed hotel id
	 * @param void
	 * return array
	 */
	function get_customer_list()
	{
		$this->hotel_id =  $this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('*');
		$this->db->select('sb_hotel_guest_bookings.sb_hotel_guest_booking_id as booking_id');
		$this->db->select('(SELECT count(*) FROM sb_forum WHERE read_status=\'0\' AND sender_type="customer" AND sb_hotel_guest_booking_id=booking_id ) as unread_count',false);
		$this->db->from('sb_hotel_guest_bookings');
		$this->db->join('sb_forum','sb_forum.sb_hotel_guest_booking_id = sb_hotel_guest_bookings.sb_hotel_guest_booking_id','left');
		$this->db->where('sb_hotel_guest_bookings.sb_hotel_id',$this->hotel_id);
		$this->db->where('is_checkedout','0');
		$this->db->where('sb_guest_firstName<>','');
		$this->db->group_by('sb_hotel_guest_bookings.sb_hotel_guest_booking_id');
		$this->db->order_by('sb_forum.created_on','desc');	
		$query = $this->db->get();
		return $query->result();
	}	
	/* Method return customer chat history
	 * for passed booking_id
	 * @param void
	 * return array
	 */
	function get_customer_chat_history($booking_id)
	{
		$this->db->select('*');
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$this->db->from('sb_forum');
		$this->db->join('sb_hotel_users','sb_hotel_users.sb_hotel_user_id = sb_forum.hotel_user_id','left');
		$this->db->order_by('sb_forum.created_on','asc');
		$query = $this->db->get();
		return $query->result();
	}	
		
	/* Method make messages as read
	 * for passed booking_id
	 * @param void
	 * return array
	 */
	function mark_as_read($booking_id)
	{
		$update_data=array(
		            'read_status'=>'1'
					);   
		$this->db->where('sb_hotel_guest_booking_id',$booking_id);
		$this->db->where('sender_type',"customer");
		$this->db->update('sb_forum',$update_data);
		return 1;
		
	}	
    /* Method add Admin Post in forum
	 * for passed booking_id
	 * @param void
	 * return array
	 */
	function addMessage($booking_id,$postMessage)
	{
		$hotel_user_id = $this->session->userdata('logged_in_user')->sb_hotel_user_id;
		$hotel_id = $this->session->userdata('logged_in_user')->sb_hotel_id;
		$insert_data=array(
		            'sb_hotel_id'=>$hotel_id,
					'sb_hotel_guest_booking_id'=>$booking_id,
					'forum_msg'=>$postMessage,
					'sender_type'=>"hoteladmin",
					'read_status'=>'0',
					'hotel_user_id'=>$hotel_user_id
					);   
		
		$this->db->insert('sb_forum',$insert_data);
		return 1;
		
	}
   /* Method to get booking_id from reservation_code
    * @param string
	* return int
	*/
    function get_reservation_code($reservation_code)
    {
		$this->db->select('count(*) as count',false);
		$this->db->where('sb_guest_reservation_code',$reservation_code);
		$this->db->where('sb_hotel_id',$this->session->userdata('logged_in_user')->sb_hotel_id);
		$query=$this->db->get('sb_hotel_guest_bookings');
		return $query->result_array();
		
    } 	
}
