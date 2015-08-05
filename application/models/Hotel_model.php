<?php
/* Model handles hotel crud operations
 * hotel searching operations
 */
Class Hotel_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/* Method create Hotel 
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel($hotel_data)
	{
		$this->db->insert('sb_hotels',$hotel_data);
		return $this->db->insert_id();
	}
	
	/* Method Update Hotel 
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function edit_hotel($hotel_data,$hotel_id)
	{
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->update('sb_hotels',$hotel_data);
	
		return '1';
	}
	/* Method Return If Hotel Present  
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel($hotel_name)
	{
	    $this->db->select('COUNT(`sb_hotel_name`) as hotelcount',false);
		$this->db->where('sb_hotel_name',$hotel_name);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}	
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_name($hotel_user_name)
	{
	    $this->db->select('COUNT(`sb_hotel_username`) as hotelusercount',false);
		$this->db->where('sb_hotel_username',$hotel_user_name);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	/* Method Return If Hotel User is present by username 
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_hotel_user_by_email($hotel_email)
	{
	    $this->db->select('COUNT(`sb_hotel_useremail`) as hotelusercount',false);
		$this->db->where('sb_hotel_useremail',$hotel_email);
		$query=$this->db->get('sb_hotel_users');
		return $query->result_array();
	}
	/* Method create Hotel Admin
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function create_hotel_user($hotel_user_data)
	{
		$this->db->insert('sb_hotel_users',$hotel_user_data);
		return $this->db->insert_id();
	}
	/* Method edit Hotel Admin User
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function edit_hotel_user($hotel_user_data,$user_id)
	{
	    $this->db->where('sb_hotel_user_id',$user_id);
		$this->db->update('sb_hotel_users',$hotel_user_data);
		return 1;
	}
	/* Method get Hotel Name
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_hotel_name($hotel_id)
	{
		$this->db->select('sb_hotel_name');
		$this->db->where('sb_hotel_id',$hotel_id);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}
	
	/* Method get Hotel Id from Hotel admin email
	 * inside system 
	 * @param @string
	 * return @string on success and False on Fail
	 */
	function get_hotel_id($adminemail)
	{
		$this->db->select('sb_hotel_id');
		$this->db->where('sb_hotel_useremail',$adminemail);
		$query=$this->db->get('sb_hotel_users');
		$result= $query->result_array();
		return $result[0]['sb_hotel_id'];
	}
	/* Method set languages For Hotel
	 * inside system 
	 * @param @int,@array
	 * return @string on success and False on Fail
	 */
	function set_hotel_languages($hotel_id,$languages)
	{
	    //Delete Previously Assigned languages To avoid duplicate assignment of languages 
		$this->db->where('sb_hotel_id',$hotel_id);
		$this->db->delete('sb_hotel_lang_map');
		//
		$i=0;
		$data=array();
		while($i<count($languages))
		{
			$singleArray=array(
							'lang_id'=>$languages[$i],
							'sb_hotel_id'=>$hotel_id
						);
			array_push($data,$singleArray);
			$i++;
		}
		$this->db->insert_batch('sb_hotel_lang_map',$data);
		return true;
	}
  	/* Method get Hotel data from Hotel id
	 * inside system 
	 * @param @int
	 * return @array on success and False on Fail
	 */
	function get_hotel_data($hotel_id)
	{
		$this->db->select('sb_hotels.sb_hotel_id,GROUP_CONCAT(sb_languages.lang_name) as lang_name,GROUP_CONCAT(sb_hotel_lang_map.lang_id) as lang_id,sb_hotel_address,sb_hotel_city,sb_hotel_country,sb_hotel_category',false);
		$this->db->select('sb_hotel_email,sb_hotel_name,sb_hotel_owner,sb_hotel_pic,sb_hotel_star,sb_hotel_state');
		$this->db->select('(select name from states where id=sb_hotel_state) as state_name',false);
		$this->db->select('(select name from cities where id=sb_hotel_city) as city_name',false);
		$this->db->select('(select name from countries where id=sb_hotel_country) as country_name',false);
		$this->db->select('sb_hotel_website,sb_hotel_zipcode,sb_property_built_month,sb_property_built_year,sb_property_open_year');
		$this->db->from('sb_hotels');
		$this->db->join('sb_hotel_lang_map', 'sb_hotel_lang_map.sb_hotel_id = sb_hotels.sb_hotel_id','left');
		$this->db->join('sb_languages', 'sb_languages.lang_id = sb_hotel_lang_map.lang_id','left');
		$this->db->where('sb_hotels.sb_hotel_id',$hotel_id);
		$this->db->group_by('sb_hotels.sb_hotel_id');
		$query=$this->db->get();
		$result= $query->result_array();
		return $result[0];
	}
	/* Method return list of all hotel
	 * @param void
	 * return array
	 */
	function get_hotels()
	{
		$this->db->select('sb_hotel_id,sb_hotel_name,sb_hotel_website,sb_hotel_owner,sb_hotel_email,is_active');
		$this->db->from('sb_hotels');
		$this->db->order_by('sb_hotel_id','desc');
		$query=$this->db->get();
		$result= $query->result_array();
		return $result;
	}
}//End Of Hotel Model	