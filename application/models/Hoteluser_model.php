<?php
/* Model handles Common Hotel User operations For Ajax Datatable
 */
Class Hoteluser_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/* Method To Get Datatable
	 * inside system 
	 * @param @string,string,string,array,int,string,string
	 * return @array on success and False on Fail
	 */
	function get_datatables($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype);
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
	private function _get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype)
	{
		$this->db->from($tablename);
		$i = 0;
	    if($type == 'u')
		{
			$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='a')", NULL, FALSE);
		}
		if($type == 'a')
		{
		    if($pagetype=='hotel-managers'){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='m')", NULL, FALSE);
			}
			else
			{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s')", NULL, FALSE);
			}
		}
		if($type == 'm')
		{
			$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s')", NULL, FALSE);
		}
		$searchArray =$this->input->post('search');
			if(isset($searchArray['value'])){
				$this->db->where("(`sb_hotel_user_id` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_username` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_useremail` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_hotel_user_type` LIKE '%".$searchArray['value']."%' ESCAPE '!'
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
			$this->db->order_by($column[$order['0']['column']], $order['0']['dir']);
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
    function count_filtered($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype)
	{
		$this->_get_datatables_query($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype);
		$query = $this->db->get();
		return $query->num_rows();
	}
    
	/* Get Total No Of Records Present
	 * @params -   @param @string,string,string,array,int,string,string
	 * return int
	 */
	public function count_all($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype)
	{
		if($type == 'u')
		{
			$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='a')", NULL, FALSE);
		}
		if($type == 'a')
		{
			if($pagetype=='hotel-managers'){
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='m')", NULL, FALSE);
			}
			else
			{
				$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s')", NULL, FALSE);
			}
		}
		if($type == 'm')
		{
			$this->db->where("(sb_hotel_id='$hotel_id' AND sb_hotel_user_type='s')", NULL, FALSE);
		}
		$this->db->from($tablename);
		return $this->db->count_all_results();
	}
}//End Of Model