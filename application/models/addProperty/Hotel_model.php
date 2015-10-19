<?php 
class Hotel_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function create_hotel($data)
	{
				
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


