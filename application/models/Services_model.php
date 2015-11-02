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
		$this->db->select('sb_hotel_parent_services.sb_parent_service_id,sb_parent_service_name,sb_hotel_child_services.sb_child_service_id,sb_child_servcie_name');
		$this->db->from('sb_hotel_parent_services');
		$this->db->join('sb_hotel_child_services','sb_hotel_parent_services.sb_parent_service_id = sb_hotel_child_services.sb_parent_service_id','left');
		//$this->db->join('sb_sub_child_services','sb_sub_child_services.sb_child_service_id = sb_hotel_child_services.sb_child_service_id','left');
		
		//$this->db->group_by('sb_parent_service_id');
		$this->db->order_by('sb_parent_service_id', 'ASC');
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
	
	/* Method Get All Unique Hotel Parent Services
	 * inside system 
	 * @param @int
	 * return @array
	 */
	function get_hotel_selected_parent_services($hotel_id)
	{
		$this->db->select('sb_hotel_parent_services.sb_parent_service_id,sb_parent_service_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->where('sb_is_service_in_use',1);
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
		$this->db->select('sb_hotel_child_services.sb_child_service_id,sb_hotel_child_services.sb_parent_service_id,sb_child_servcie_name,sb_is_service_in_use,sb_hotel_service_map_id');
		$this->db->where('sb_hotel_id',$hotel_id);
		//$this->db->where('sb_hotel_child_services.sb_parent_service_id',$sb_parent_service_id);
		$this->db->where_in('sb_hotel_child_services.sb_parent_service_id',$sb_parent_service_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_child_services','sb_hotel_child_services.sb_child_service_id = sb_hotel_service_map.sb_child_service_id');
		$this->db->group_by('sb_hotel_child_services.sb_child_service_id');
		$query = $this->db->get();
		// /echo $this->db->last_query();
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
		$this->db->where('sb_hotel_service_map.sb_parent_service_id',$sb_parent_service_id);
		$this->db->where('sb_hotel_service_map.sb_child_service_id',$sb_child_service_id);
		$this->db->from('sb_hotel_service_map');
		$this->db->join('sb_hotel_child_services','sb_hotel_child_services.sb_child_service_id = sb_hotel_service_map.sb_child_service_id','left');
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
	/* Method To get Count Of all Parent/Child/SubChild Services.
	 * @param int
	 * return int
	 */
	function get_services_count($tablename)
	{
		$this->db->select('count(*) as servicecount',false);
		$query=$this->db->get($tablename);
		$result=$query->result_array();
		return $result[0]['servicecount'];
	}
	
	/* Method To get all Parent/Child/SubChild Services.
	 * @param string
	 * return array
	 */
	function get_services($tablename,$servicetable='')
	{
		$this->db->select('*',false);
		if($servicetable != ''){
			if($servicetable == 'sb_hotel_child_services'){
			    $this->db->select('sb_parent_service_id as service_id');
				$this->db->select("(SELECT count(*) from $servicetable where sb_parent_service_id = service_id) as servicecount",false);
			}
		}
		$query=$this->db->get($tablename);
		$result=$query->result_array();
		return $result;
	}
   /* Method To get no of parent services with given name(For validation)
	* @params string,int
    * return int
	*/
	public function get_parent_service_by_name($service_name,$service_id=0){
		$this->db->select('count(*) as servicecount');
		$this->db->where('sb_parent_service_name',$service_name);
		if($service_id !=0)
		{
			$this->db->where('sb_parent_service_id <>',$service_id);
		}
		$query=$this->db->get('sb_hotel_parent_services');
		$result=$query->result_array();
		return $result[0]['servicecount'];
	}
   /* Method To Add Service
	* @params array
    * return 1
	*/
	public function add_service($data,$tablename){
		$this->db->insert($tablename,$data);
		return 1;
	}		
	/* Method To Edit Parent Service
	* @params array
    * return 1
	*/
	public function edit_service($data,$tablename,$service_id){
		$this->db->where('sb_parent_service_id',$service_id);
		$this->db->update($tablename,$data);
		return 1;
	}
	/* Method To Edit Child Service
	* @params array
    * return 1
	*/
	public function edit_child_service($data,$tablename,$service_id){
		$this->db->where('sb_child_service_id',$service_id);
		$this->db->update($tablename,$data);
		return 1;
	}

   /* Method To get no of child services with given name(For validation)
	* @params string,int
    * return int
	*/
	public function get_child_service_by_name($service_name,$service_id=0){
		$this->db->select('count(*) as servicecount');
		$this->db->where('sb_child_servcie_name',$service_name);
		if($service_id !=0)
		{
			$this->db->where('sb_child_service_id <>',$service_id);
		}
		$query=$this->db->get('sb_hotel_child_services');
		$result=$query->result_array();
		return $result[0]['servicecount'];
	}	
	/* Method insert child services 
	* @params array
    * return int
	*/
	public function create_child_services($data){
		//print_r($data);die();
		$ids = array();
		for ($i=0; $i < count($data) ; $i++) { 
			$this->db->insert('sb_hotel_child_services',$data[$i]);
			array_push($ids, $this->db->insert_id());
		}
		$hotel_ids = $this->getallhotels();
		$hotel_services_relation = array();
		$sb_parent_service_id = $data[0]['sb_parent_service_id'];
		for ($i=0; $i < count($hotel_ids); $i++) { 
			for ($j=0; $j < count($ids); $j++) { 
				$tmp = array(
					"sb_hotel_id" => $hotel_ids[$i]['sb_hotel_id'],
					"sb_child_service_id" => $ids[$j],
					"sb_parent_service_id" => $sb_parent_service_id,
					"sb_is_service_in_use" => 1
					);
				array_push($hotel_services_relation, $tmp);
			}
		}
		//print_r($hotel_services_relation);
		$this->db->insert_batch('sb_hotel_service_map',$hotel_services_relation);
		
		return 1;
	}

	public function getallhotels()
	{
		$qry = "SELECT `sb_hotel_id` FROM `sb_hotels`";
		$query = $this->db->query($qry);
		return $query->result_array();
	}

	/* Method To get no of sub child services with given name(For validation)
	* @params string,int
    * return int
	*/
	public function get_sub_child_service_by_name($service_name,$service_id=0){
		$this->db->select('count(*) as servicecount');
		$this->db->where('sb_sub_child_service_name',$service_name);
		if($service_id !=0)
		{
			$this->db->where('sub_child_services_id <>',$service_id);
		}
		$query=$this->db->get('sb_sub_child_services');
		$result=$query->result_array();
		return $result[0]['servicecount'];
	}
   /* Method insert sub child services 
	* @params array
    * return int
	*/
	public function create_subchild_services($data){
		$this->db->insert_batch('sb_sub_child_services',$data);
		return 1;
	}
   /* Method To Edit Sub Child Service
	* @params array
    * return 1
	*/
	public function edit_sub_child_service($data,$tablename,$service_id){
		$this->db->where('sub_child_services_id',$service_id);
		$this->db->update($tablename,$data);
		return 1;
	}	
   /* Method To Get Menu Child Services
	* @params void
    * return array
	*/
	public function get_menu_child_services(){
		$this->db->select('*');
		$this->db->where('is_service','0');
		$query=$this->db->get('sb_hotel_child_services');
		$result=$query->result_array();
		return $result;
	}
	
   /* Method insert sub child paid hotel admin services 
	* @params array
    * return int
	*/
	public function create_paid_service($data){
		$this->db->insert('sb_paid_services',$data);
		return $this->db->insert_id();
	}
	
   /* Method to get hotel service details 
	* @params int 
	* return array 
	*/
	public function get_hotel_service($paid_service_id){
		$this->db->select('*');
		$this->db->where('sub_child_services_id',$paid_service_id);
		$this->db->from('sb_paid_services');
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
	}
	/* Method To Get Menu Child Services of specific parent
	* @params int
    * return array
	*/
	public function get_menu_child_services_by_service($parent_id){
		$this->db->select('*');
		$this->db->where('is_service','0');
		$this->db->where('sb_parent_service_id',$parent_id);
		$query=$this->db->get('sb_hotel_child_services');
		$result=$query->result_array();
		return $result;
	}
   /* Method To get parent of child menu
	* input -  int
    * output - array
	*/
	public function get_parent_service_by_child($child_id)
	{
		$this->db->select('sb_parent_service_id');
		$this->db->where('sb_child_service_id',$child_id);
		$query=$this->db->get('sb_hotel_child_services');
		$result=$query->result_array();
		return $result;
	}
	
	/* Method To Get Staff Users
	* input -  int
    * output - array
	*/
	public function get_staff_users($staff_type)
	{
		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('sb_hotel_users.sb_hotel_user_id');
		if($staff_type!="all")
		{
			$this->db->where('sb_parent_service_id',$staff_type);
		}
		$this->db->where('sb_hotel_users.sb_hotel_id',$sb_hotel_id);
		$this->db->where('sb_hotel_users.sb_hotel_user_type','s');
		$this->db->group_by('sb_hotel_users.sb_hotel_user_id');
		$this->db->from('sb_hotel_users');
		$this->db->join('sb_hotel_user_service_access_map','sb_hotel_user_service_access_map.sb_hotel_user_id = sb_hotel_users.sb_hotel_user_id');
	
		$query=$this->db->get();
		$result=$query->result_array();
		return $result;
	}
	/* Method To Assign Task To Staff
	* @params array
    * return 1
	*/
	public function assign_task($data,$task_id){
		$this->db->where('sb_hotel_requst_ser_id',$task_id);
		$this->db->update('sb_hotel_services_status',$data);
		return 1;
	}
	/* Method To Get Latest guest requests top 10
	* @params int
    * return array
	*/
	public function get_guest_latest_requests($service_id){
		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->db->select('*');
		//$this->db->select('sb_hotel_ser_reqstd_on');
		$this->db->from('sb_hotel_request_service');
		$this->db->join('sb_hotel_guest_bookings','sb_hotel_guest_bookings.sb_hotel_guest_booking_id = sb_hotel_request_service.sb_hotel_guest_booking_id');
		$this->db->join('sb_hotel_services_status','sb_hotel_services_status.sb_hotel_requst_ser_id = sb_hotel_request_service.sb_hotel_requst_ser_id');
		$this->db->join('sb_hotel_users','sb_hotel_users.sb_hotel_user_id = sb_hotel_services_status.sb_hotel_ser_assgnd_to_user_id','left');

		$this->db->where('sb_parent_service_id',$service_id);
		$this->db->where('sb_hotel_request_service.sb_hotel_id',$sb_hotel_id);
		$this->db->order_by("sb_hotel_request_service.sb_hotel_requst_ser_id","desc");
		$this->db->limit(0,5);
		$query=$this->db->get();
		return $query->result_array();
		
	}
}
?>