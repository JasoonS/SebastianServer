<?php
/* Model handles Common operations For Ajax Datatable (For Single Table)
 */
Class Paidservices_model extends CI_Model
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
		$this->db->join('sb_hotel_child_services', 'sb_hotel_child_services.sb_child_service_id= sb_paid_services.sb_child_service_id');
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		
		$this->db->where("(sb_paid_services.sb_hotel_id='$hotel_id')", NULL, FALSE);
		if($this->input->post('parent_service_id')!=null){
			$this->db->where("(sb_hotel_child_services.sb_parent_service_id='".$this->input->post('parent_service_id')."')", NULL, FALSE);
		}
		$i = 0;
		if(isset($searchArray['value'])){
		
				$this->db->where("(`sb_paid_services.sb_child_service_id` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sub_child_services_id` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_sub_child_price` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_is_service_in_use` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_child_servcie_name` LIKE '%".$searchArray['value']."%' ESCAPE '!'
							OR  `sb_sub_child_service_name` LIKE '%".$searchArray['value']."%' ESCAPE '!')",NULL,FALSE);
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
		$this->db->join('sb_hotel_child_services', 'sb_hotel_child_services.sb_child_service_id= sb_paid_services.sb_child_service_id');
		
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		
		$this->db->where("(sb_paid_services.sb_hotel_id='$hotel_id')", NULL, FALSE);
		if($this->input->post('parent_service_id')!=null){
			$this->db->where("(sb_hotel_child_services.sb_parent_service_id='".$this->input->post('parent_service_id')."')", NULL, FALSE);
		}
		return $this->db->count_all_results();
	}
	
	/* Change Status Of Selected Paid Service
	 * @param @array,@int
	 * return int 
	 */
	public function change_status($data,$id)
	{
	    $this->db->where('sub_child_services_id',$id); 
		$this->db->update('sb_paid_services',$data);
		return 1;
	}
}//End Of Common Model