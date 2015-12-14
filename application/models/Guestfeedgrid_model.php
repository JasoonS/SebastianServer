<?php

/* Model handles Restaurant operations For Ajax Datatable (For Single Table)
 */
Class GuestFeedgrid_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/* Method To Get Datatable
	 * inside system 
	 * @param @string,@int,@int,@array
	 * return @array on success and False on Fail
	 */
	function get_datatables($tablename,$orderkey,$orderdir,$columns)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns);
		if($this->input->post('length') != -1)
		$this->db->limit($this->input->post('length'), $this->input->post('start'));
		$query = $this->db->get();
		return $query->result();
	}
	/* Method To Prepare Query To Get Resultset
	 * inside system 
	 * @param @string,@int,@int,@array
	 * return @string on success and False on Fail
	 */
	private function _get_datatables_query($tablename,$orderkey,$orderdir,$columns)
	{
		$this->db->from($tablename);
		
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->join('sb_hotel_guest_bookings','sb_feedback.guest_booking_id = sb_hotel_guest_bookings.sb_hotel_guest_booking_id');

		$this->db->where("(sb_feedback.hotel_id='$hotel_id')", NULL, FALSE);

		$i = 0;
		$searchArray =$this->input->post('search');
		if(isset($searchArray['value'])){
		
				$this->db->where("(`sb_guest_firstName` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_guest_lastName` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `special_hotel_person` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `suggestion` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  DATE(sent_date) LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `feedback` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							)",NULL,FALSE);
				}
		foreach ($columns as $item) 
		{
		    $searchArray =$this->input->post('search');
		   /* if(isset($searchArray['value']))
				($i===0) ? $this->db->like($item, $searchArray['value']) : $this->db->or_like($item, $searchArray['value']);*/
			$column[$i] = $item;
			$i++;
		}
		if($this->input->post('order') != null)
		{
		    $order = $this->input->post('order'); 
			$this->db->order_by($column[$order['0']['column']], $order['0']['dir']);
		} 
		else if(isset($orderkey) && isset($orderdir))
		{
			$this->db->order_by($orderkey,$orderdir);
		}
	}
	/* Get No Of Filtered Records in Datatable
	 * @param @string,@int,@int,@array
	 * return int 
	 */
    function count_filtered($tablename,$orderkey,$orderdir,$columns)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns);
		$query = $this->db->get();
		return $query->num_rows();
	}
    
	/* Get Total No Of Records Present
	 * @param @string,@int,@int,@array
	 * return int 
	 */
	public function count_all($tablename,$orderkey,$orderdir,$columns)
	{
		$this->db->from($tablename);
		$this->db->join('sb_hotel_guest_bookings','sb_feedback.guest_booking_id = sb_hotel_guest_bookings.sb_hotel_guest_booking_id');

		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		
		$this->db->where("(sb_feedback.hotel_id='$hotel_id')", NULL, FALSE);
		return $this->db->count_all_results();
	}
}//End Of REstaurantgrid Model