<?php
Class Services_model extends CI_Model
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
	function get_all_services()
	{
		$this->db->select('sb_hotel_child_services.sb_parent_service_id,sb_parent_service_name,sb_hotel_child_services.sb_child_service_id,sb_child_servcie_name,sub_child_services_id');
		$this->db->from('sb_hotel_parent_services');
		$this->db->join('sb_hotel_child_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_child_services.sb_parent_service_id');
		$this->db->join('sb_sub_child_services','sb_sub_child_services.sb_child_service_id = sb_hotel_child_services.sb_child_service_id','left');
		
		//$this->db->group_by('sb_parent_service_id');
		$this->db->order_by('sb_parent_service_id,sb_child_service_id', 'ASC');
		$query = $this->db->get();
	
        return $query->result_array();		
	}
	
	/* Method add All Services to Hotel While Creation
	 * inside system 
	 * @param @int
	 * return true
	 */
	function add_all_services_to_hotel($hotel_id)
	{
		$serviceslist=$this->get_all_services();
		
		//Delete Previously added services for the particular hotel.
		//$this->db->where('sb_hotel_id',$hotel_id);
		//$this->db->delete('sb_hotel_service_map');
		//
		$i=0;
		$data=array();
		while($i<count($serviceslist))
		{
			$singlearray=array('sb_hotel_id'=>$hotel_id,
								'sb_parent_service_id'=>$serviceslist[$i]['sb_parent_service_id'],
								'sb_child_service_id'=>$serviceslist[$i]['sb_child_service_id'],
								'sb_sub_child_service_id'=>$serviceslist[$i]['sub_child_services_id']
							  );
			array_push($data,$singlearray);				  
			$i++;
		}
		
		$this->db->insert_batch('sb_hotel_service_map',$data);
		return true;
		//return $query->result_array();
	}
	
	/* Method add Admin Selected Services to Hotel 
	 * inside system 
	 * @param @array,@int
	 * return true
	 */
	function update_hotel_services($data,$hotel_id)
	{
		//Delete Previously added services for the particular hotel.
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->delete('sb_hotel_service_map');
		//
		if(count($data)>0){
			$this->db->insert_batch('sb_hotel_service_map',$data);
		}
		return true;
		//return $query->result_array();
	}
	
	/* Method Get Selected Services of Hotel 
	 * inside system 
	 * @param @int
	 * return @array on success 
	 */
	function get_hotel_services($hotel_id)
	{
		$this->db->select('sb_hotel_id,sb_child_service_id,sb_parent_service_id');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->from('sb_hotel_service_map');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/* Method Get All Hotel Parent Services
	 * inside system 
	 * @param @int
	 * return @array
	 */
	function get_hotel_parent_services($hotel_id)
	{
		$this->db->select('sb_hotel_parent_services.sb_parent_service_id,sb_parent_service_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_parent_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_service_map.sb_parent_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	/* Method Get All Unique Hotel Parent Services
	 * inside system 
	 * @param @int
	 * return @array
	 */
	function get_hotel_unique_parent_services($hotel_id)
	{
		$this->db->select('sb_hotel_parent_services.sb_parent_service_id,sb_parent_service_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_parent_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_service_map.sb_parent_service_id');
		$this->db->group_by('sb_hotel_parent_services.sb_parent_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method Get Current Hotel User Parent Service
	 * inside system 
	 * @param @int
	 * return @array
	 */
	function get_hotel_user_parent_service($user_id)
	{
		$this->db->select('sb_hotel_parent_services.sb_parent_service_id,sb_parent_service_name');
		$this->db->where('sb_hotel_user_id',$user_id);
		$this->db->from('sb_hotel_user_service_access_map');
		$this->db->join('sb_hotel_parent_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_user_service_access_map.sb_parent_service_id');
		$this->db->group_by('sb_hotel_parent_services.sb_parent_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method Get Hotel Child Services according to Parent Service
     * @param int,int
     * return @array 
	 */
	function get_hotel_child_services_by_parent_service($hotel_id,$sb_parent_service_id)
	{
		$this->db->select('sb_hotel_child_services.sb_child_service_id,sb_child_servcie_name,sb_is_service_in_use,sb_hotel_service_map_id');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->where('sb_hotel_child_services.sb_parent_service_id',$sb_parent_service_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_child_services','sb_hotel_child_services.sb_child_service_id = sb_hotel_service_map.sb_child_service_id');
		$this->db->group_by('sb_hotel_child_services.sb_child_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method Remove Previous services assignment and make new services assignment for hotel user
     * @param array,int
     * return void
	 */
	function set_services($service_data,$user_id)
	{
	    $this->db->where('sb_hotel_user_id',$user_id);
	    $this->db->delete('sb_hotel_user_service_access_map');
		
		$this->db->insert_batch('sb_hotel_user_service_access_map',$service_data);
		return 1;
	}
	/* Method Get Hotel Child Services according to Parent Service & child Service 
     * @param int,int
     * return @array on success 
	 */
	function get_hotel_child_service_map_id($hotel_id,$sb_parent_service_id,$sb_child_service_id)
	{
		$this->db->select('sb_hotel_child_services.sb_child_service_id,sb_child_servcie_name,sb_hotel_service_map_id');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->where('sb_hotel_child_services.sb_parent_service_id',$sb_parent_service_id);
		$this->db->where('sb_hotel_child_services.sb_child_service_id',$sb_child_service_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_child_services','sb_hotel_child_services.sb_child_service_id = sb_hotel_service_map.sb_child_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}
	/* Method Get Current Hotel User Child Service
	 * inside system 
	 * @param @int
	 * return @array on success
	 */
	function get_hotel_user_child_service($user_id)
	{
		$this->db->select('sb_hotel_service_map.sb_child_service_id,sb_hotel_service_map.sb_parent_service_id');
		$this->db->where('sb_hotel_user_id',$user_id);
		$this->db->from('sb_hotel_user_service_access_map');
		$this->db->join('sb_hotel_service_map','sb_hotel_service_map.sb_hotel_service_map_id = sb_hotel_user_service_access_map.sb_hotel_service_map_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* Method return all parent services 
	 * inside system
	 * @param void
	 * return array
	 */
	function get_all_parent_services()
	{
		$this->db->select('sb_parent_service_id,sb_parent_service_name,sb_parent_service_image');
		$this->db->from('sb_hotel_parent_services');
		$this->db->order_by('sb_parent_service_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	/* Method return child services of 
	 * a parent id
	 * @param int
	 * return array
	 */
	function get_child_of_parent($parent_id)
	{
		$this->db->select('sb_child_servcie_name,sb_child_service_id');
		$this->db->from('sb_hotel_child_services');
		$this->db->where('sb_parent_service_id',$parent_id);
		$query = $this->db->get();
		//echo $this->db->last_query();
		//exit;
		return $query->result_array();
	}
	/* Method get All Child Services Which are paid
	 * @param int
     * return array 
	 */
	function get_all_paid_child_services(){
		$this->db->select('sb_child_service_id');
		$this->db->from('sb_hotel_child_services');
		$this->db->where('service_type',"paid");
		$query = $this->db->get();
		return $query->result_array();
	}	
	/* Method get All SubChild Services Which are paid
	 * @param int
     * return array 
	 */
	function get_all_paid_subchild_services(){
		$this->db->select('sb_child_service_id');
		$this->db->from('sb_sub_child_services');
		$this->db->where('service_type',"paid");
		$query = $this->db->get();
		return $query->result_array();
	}	
	/* Method add child services which are paid with default amount 0
	 * @param int
	 * return boolean true
	 */
    function add_all_paid_services($hotel_id){
		$childServices=$this->get_all_paid_child_services();
	    $insertData=array();
		foreach($childServices as $servicekey=>$service)
		{
			$singlearray=array(
						'service_id'=>$service['sb_child_service_id'],
						'service_price'=>'1',
						'service_table'=>'child',
						'sb_hotel_id'=>$hotel_id
						);
			array_push($insertData,$singlearray);			
		}
		$subChildServices=$this->get_all_paid_subchild_services();
	   
		foreach($subChildServices as $servicekey=>$service)
		{
			$singlearray=array(
						'service_id'=>$service['sb_child_service_id'],
						'service_price'=>'1',
						'service_table'=>'child',
						'sb_hotel_id'=>$hotel_id
						);
			array_push($insertData,$singlearray);			
		}
		$this->db->insert_batch('sb_hotel_paid_services',$insertData);
		return true;
	}
	
}
?>