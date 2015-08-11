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
}
