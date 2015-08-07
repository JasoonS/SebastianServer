<?php
/* Model handles Common Hotel User operations For Ajax Datatable
 */
Class Hoteluser_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->user_id= $this->session->userdata('logged_in_user')->sb_hotel_user_id; 
	}
	/* Method To Get Datatable
	 * inside system 
	 * @param @string,string,string,array,int,string,string
	 * return @array on success and False on Fail
	 */
	function get_datatables($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service);
		if($this->input->post('length') != -1)
		$this->db->limit($this->input->post('length'), $this->input->post('start'));
		$query = $this->db->get();
		
		return $query->result();
	}
	/* Method To Prepare Query To Get Resultset
	 * inside system 
	 * @param  @param @string,string,string,array,int,string,string
	 * return void
	 */
	private function _get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
		$this->db->from($tablename);
		if($type == 'm')
		{
			$this->db->join('sb_hotel_user_service_access_map', 'sb_hotel_user_service_access_map.sb_hotel_user_id = sb_hotel_users.sb_hotel_user_id');
			$this->db->where("(sb_hotel_users.sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s' AND sb_hotel_user_id <> '".$this->user_id."' AND sb_parent_service_id='".$by_parent_service."')", NULL, FALSE);
		}
		$i = 0;
	    if($type == 'u')
		{ 
		    if($pagetype !="hotel-admin"){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='u' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
			else{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='a' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
			
		}
		if($type == 'a')
		{
		    if($pagetype=='hotel-managers'){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='m' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
			else
			{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
		}
		
		$searchArray =$this->input->post('search');
		if(isset($searchArray['value'])){
				$this->db->where("(`sb_hotel_users`.`sb_hotel_user_id` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_username` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_useremail` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_user_type` LIKE '%".$searchArray['value']."%' ESCAPE '!')",NULL,FALSE);
				}
		foreach ($columns as $item) 
		{
		    $searchArray =$this->input->post('search');
		    $column[$i] = $item;
		    $i++;
		}
		if($this->input->post('order') != null)
		{
		    $order = $this->input->post('order'); 
			$this->db->order_by("`sb_hotel_users`.".$column[$order['0']['column']], $order['0']['dir']);
		} 
		else if(isset($orderkey) && isset($orderdir))
		{
			$this->db->order_by($orderkey,$orderdir);
		}
	}
	/* Get No Of Filtered Records in Datatable
	 * @params -   @param @string,string,string,array,int,string,string
	 * return int
	 */
    function count_filtered($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service);
		$query = $this->db->get();
		return $query->num_rows();
	}
    
	/* Get Total No Of Records Present
	 * @params -   @param @string,string,string,array,int,string,string
	 * return int
	 */
	public function count_all($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
		if($type == 'u')
		{
			if($pagetype !="hotel-admin"){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='u' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
			else{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='a' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
		}
		if($type == 'a')
		{
			if($pagetype=='hotel-managers'){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='m' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
			else
			{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s' AND sb_hotel_user_id <> '".$this->user_id."')", NULL, FALSE);
			}
		}
		if($type == 'm')
		{
			$this->db->where("(sb_hotel_users.sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s' AND sb_hotel_user_id <> '".$this->user_id."' AND sb_parent_service_id='".$by_parent_service."')", NULL, FALSE);
			$this->db->join('sb_hotel_user_service_access_map', 'sb_hotel_user_service_access_map.sb_hotel_user_id = sb_hotel_users.sb_hotel_user_id');

		}
		$this->db->from($tablename);
		
		return $this->db->count_all_results();
	}
}//End Of Model