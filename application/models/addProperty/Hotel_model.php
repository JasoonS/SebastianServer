<?php 
class Hotel_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function create_hotel($post,$num)
	{
		$data = array(
		'sb_hotel_name'=> $post['hotel_name'],
		'sb_hotel_country' => $post['country'],
		'sb_hotel_state' => $post['state'],
		'sb_hotel_city' =>$post['city'],
		'sb_hotel_category' =>$post['category'],
		'sb_hotel_email'=>$post['email'],
		'sb_hotel_website'=>$post['website'],
		'sb_hotel_owner'=> $post['owner_name'],
      	'sb_hotel_address'=>$post['address'],
		'sb_hotel_zipcode'=>$post['postal_code'],
		'sb_property_built_month'=>$post['month'],
		'sb_property_built_year'=>$post['built_calender'],
		'sb_property_open_year'	=>$post['opening_calender'],
		'sb_hotel_pic' => $num.'.jpg'
		);		
		$this->db->insert('sb_hotels',$data);	
			
		return $this->db->insert_id();
	}
		
	/*public function find_hotel($hotel_name)
	{
	    $this->db->select('COUNT(`sb_hotel_name`) as hotelcount',false);
		$this->db->where('sb_hotel_name',$hotel_name);
		$query=$this->db->get('sb_hotels');
		return $query->result_array();
	}*/

	
	function find_hotel($hotel_name)
		{
	    	$this->db->select('COUNT(`sb_hotel_name`) as hotelcount',false);
			$this->db->where('sb_hotel_name',$hotel_name);
			$query=$this->db->get('sb_hotels');
			return $query->result_array();
		}
		
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

}
?>


