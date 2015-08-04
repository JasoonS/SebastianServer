<?php
Class Services_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
    /* Method Return all services list
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_all_services()
	{
		$this->db->select('sb_hotel_child_services.sb_parent_service_id,sb_parent_service_name,sb_child_service_id,sb_child_service_name');
		$this->db->from('sb_hotel_parent_services');
		$this->db->join('sb_hotel_child_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_child_services.sb_parent_service_id');
		//$this->db->group_by('sb_parent_service_id');
		$this->db->order_by('sb_parent_service_id,sb_child_service_id', 'ASC');
		$query = $this->db->get();
        return $query->result_array();		
	}
	
	/* Method add All Services to Hotel While Creation
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
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
								'sb_child_service_id'=>$serviceslist[$i]['sb_child_service_id']
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
	 * @param @string
	 * return @string on success and False on Fail
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
	 * @param @string
	 * return @string on success and False on Fail
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
	 * @param @string
	 * return @string on success and False on Fail
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
	 * @param @string
	 * return @string on success and False on Fail
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
	 * @param @string
	 * return @json array on success and False on Fail
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
     * return @json array on success and False on Fail 
	 */
	function get_hotel_child_services_by_parent_service($hotel_id,$sb_parent_service_id)
	{
		$this->db->select('sb_hotel_child_services.sb_child_service_id,sb_child_service_name,sb_hotel_service_map_id');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->where('sb_hotel_child_services.sb_parent_service_id',$sb_parent_service_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_child_services','sb_hotel_child_services.sb_child_service_id = sb_hotel_service_map.sb_child_service_id');
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
     * return @json array on success and False on Fail 
	 */
	function get_hotel_child_service_map_id($hotel_id,$sb_parent_service_id,$sb_child_service_id)
	{
		$this->db->select('sb_hotel_child_services.sb_child_service_id,sb_child_service_name,sb_hotel_service_map_id');
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
	 * @param @string
	 * return @json array on success and False on Fail
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
	
}
?>