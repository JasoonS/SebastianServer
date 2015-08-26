<?php 

class Hotelrooms_model extends CI_Model{
	public function __construct()
	{
		parent::__construct();
	}

	public function hotelRoomsInsert($hotelRoomsInsert_data)
	{
		$room_num_from=$hotelRoomsInsert_data['room_num_from'];
		$room_num_to=$hotelRoomsInsert_data['room_num_to'];
		$room_num_prefix=$hotelRoomsInsert_data['room_num_prefix'];
		$room_num_postfix=$hotelRoomsInsert_data['room_num_postfix'];
		//$temp=array();	
		$data=array();	
		$data2=array();
		for($i=$room_num_from;$i<=$room_num_to;$i++)
		{
			// if($i<10)
			// {
			// 	$i=str_pad($i,2,0,STR_PAD_LEFT);
			// }
			$temp=array(
			'sb_hotel_id'=>$this->session->userdata('logged_in_user')->sb_hotel_id,
			'sb_room_number'=>$room_num_prefix.$i.$room_num_postfix
			);
			array_push($data, $temp);
			$temp2=array(
			$room_num_prefix.$i.$room_num_postfix
			);
			array_push($data2, $temp2[0]);
		}
		// echo '<pre>';
		// print_r($data2);		
		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;	
		$this->db->select('*');
		$this->db->from('sb_hotel_rooms');
		$this->db->where_in('sb_room_number', $data2);
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return 0;
		}
		else
		{
			$this->db->insert_batch('sb_hotel_rooms',$data);
			return 1;
		}		
	}

}