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
}
