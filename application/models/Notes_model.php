<?php
/* Model handles Common operations For Ajax Datatable (For Single Table)
 */
Class Notes_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/* Method Insert Note
	 * inside system 
	 * input array
     * output insertid int
	 */
	function create_note($data)
	{
		$this->db->insert('sb_hotel_notes',$data);
		return $this->db->insert_id();
	}
	/* Method Get Notes
	 * inside system 
	 * input array
     * output insertid int
	 */
	function get_notes($start,$end)
	{
		$hotel_id =$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('*');
		$this->db->where('sb_note_time >=',$start);
		$this->db->where('sb_note_time <=',$end);
		$this->db->where('sb_hotel_id',$hotel_id);
		$query=$this->db->get('sb_hotel_notes');
		return $query->result_array();
	}
	
}//End Of Notes Model