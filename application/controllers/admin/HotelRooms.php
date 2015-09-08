<?php
/* User controller class 
 * perform crud of hotel userss
 * all user related
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class HotelRooms extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hotelrooms_model');
		$this->load->model('Guest_model');
		$this->load->model('Hotel_model');
		if(!$this->session->userdata('logged_in_user'))
		{
			redirectWithErr(ERR_MSG_LEVEL_2,'login');
		}else
		{
			// Get the user's ID and add it to the config array
			$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
			// Load the ACL library and pas it the config array
			$this->load->library('acl',$config);
		}
	}

	public function index()
	{
	    $requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$data['action']="admin/hotelRooms/hotelRoomsInsert";
		$data['ajaxurl']="admin/hotelRooms/";
		$data['title']  = 'Room Creation';
		$data['rooms_booked']=$this->hotelrooms_model->get_ordinary_booked_rooms();
		$data['room_types']=$this->hotelrooms_model->getAvailableRoomTypes();
		$room_array=$data['rooms_booked'];	
		$temparray = array_chunk($room_array, 5);
		$data['rooms_booked']=$temparray;
		$this->template->load('page_tpl','hotel_rooms_vw',$data);
	}
	/* Method render add Rooms view to perticulr Hotel If User is super administrator
		Created on:-
	 * @param void
	 * return void
	 */

	public function hotelRoomsInsert()
	{	
        $requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}			
		$room_num_from=$this->input->post('room_num_from');
		$room_num_to=$this->input->post('room_num_to');
		if($room_num_from <10)
		{
			$room_num_from=$room_num_from%10;
		}
		if($room_num_to <10)
		{
			$room_num_to=$room_num_to%10;
		}	
		$sb_hotel_room_type = $this->input->post('sb_hotel_room_type');
		
        if($this->input->post('sb_hotel_room_type') == "not specified")
        {
			$sb_hotel_room_type=$this->input->post('sb_hotel_new_room_type');
        }  		
		$hotelRoomsInsert_data=array(
			'room_num_from'=>$room_num_from,
			'room_num_to'=>$room_num_to,
			'room_num_prefix'=>$this->input->post('room_num_prefix'),
			'room_num_postfix'=>$this->input->post('room_num_postfix'),
			'sb_hotel_room_type'=>$sb_hotel_room_type
		);
		$r=$this->hotelrooms_model->hotelRoomsInsert($hotelRoomsInsert_data);
		if($r!=0)
		{
			$this->session->set_flashdata('rooms_success', ROOMS_CREATION_SUCCESS);
			//redirect('admin/hotel/add_hotel');
		}
		else
		{
			$this->session->set_flashdata('rooms_error', ROOMS_CREATION_FAIL);
		}
		redirect('admin/HotelRooms');	
	}

	/* Method To Room Checkout Form Details
    * input - void
    * output - void
	*/
   public function Roomcheckout($booking_id = ' ')
   {
		$requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = "Guest Details";
		$guest_data=$this->Guest_model->get_hotel_guest_data($booking_id);
		
		//$this->data['room_types']=$this->Hotelrooms_model->getAvailableRoomTypes
		$i=0;
	 	$checked_out_rooms =0;$checked_in_rooms=0;
		while($i<count($guest_data))
		{
			$room_number =$guest_data[$i]->sb_guest_allocated_room_no;
			if($guest_data[$i]->sb_guest_actual_check_out != "0000-00-00 00:00:00")
			{
				$checked_out_rooms++;
			}
			else{
				$checked_in_rooms++;
			}
			$customer_orders=$this->Guest_model->get_hotel_guest_orders($booking_id,$room_number);
			$count =0;
			$total_amount =0;
			while($count < count($customer_orders))
			{
			    
				$total_amount = $total_amount + ($customer_orders[$count]->quantity * $customer_orders[$count]->price);
				$count++;
			}
			$guest_data[$i]->customer_orders=$customer_orders;
			$guest_data[$i]->total_amount=$total_amount;
			$i++;
		}

		$this->data['guest_data']=$guest_data;
		$this->data['guest_general_data']=$this->Guest_model->get_hotel_guest_general_data($booking_id);
		$hotel_pic=HOTEL_PIC;
		$hotel_image = $this->Hotel_model->get_hotel_pic($this->data['guest_general_data'][0]->sb_hotel_id);
		$this->data['hotel_pic']=base_url($hotel_pic)."/".$hotel_image[0]['sb_hotel_pic'];
		$this->data['checked_out_rooms']=$checked_out_rooms;
		$this->data['checked_in_rooms']=$checked_in_rooms;
		$this->template->load('page_tpl','hotel_checkout_vw',$this->data);
    }
	/* Method To Room Checkin 
    * input - void
    * output - void
	*/
   public function Roomcheckin($booking_id = ' ',$alloted_rooms = ' ')
   {
		$requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = "Allocate Room";
		$this->data['action']="admin/hotelRooms/allocate_rooms";
		$this->data['booking_id']=$booking_id;
		$this->data['alloted_rooms']=$alloted_rooms;
		$this->data['guest_general_data']=$this->Guest_model->get_hotel_guest_general_data($booking_id);
		$this->data['room_types']=$this->hotelrooms_model->getAvailableRoomTypes();
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Guest_model');
		$allocated_rooms=$this->Guest_model->get_allocated_rooms($this->data['guest_general_data'][0]->sb_guest_reservation_code,$hotel_id);
		$hotel_pic=HOTEL_PIC;
		$hotel_image = $this->Hotel_model->get_hotel_pic($this->data['guest_general_data'][0]->sb_hotel_id);
		$this->data['hotel_pic']=base_url($hotel_pic)."/".$hotel_image[0]['sb_hotel_pic'];
		$this->data['allocated_rooms']=$allocated_rooms;
		$guest_data=$this->Guest_model->get_hotel_guest_data($booking_id);
		$i=0;
	 	$checked_out_rooms =0;$checked_in_rooms=0;
		while($i<count($guest_data))
		{
			$room_number =$guest_data[$i]->sb_guest_allocated_room_no;
			if($guest_data[$i]->sb_guest_actual_check_out != "0000-00-00 00:00:00")
			{
				$checked_out_rooms++;
			}
			else{
				$checked_in_rooms++;
			}
			
			$i++;
		}

		$this->data['guest_data']=$guest_data;
		$this->data['guest_general_data']=$this->Guest_model->get_hotel_guest_general_data($booking_id);
		$hotel_pic=HOTEL_PIC;
		$hotel_image = $this->Hotel_model->get_hotel_pic($this->data['guest_general_data'][0]->sb_hotel_id);
		$this->data['hotel_pic']=base_url($hotel_pic)."/".$hotel_image[0]['sb_hotel_pic'];
		$this->data['checked_out_rooms']=$checked_out_rooms;
		$this->data['checked_in_rooms']=$checked_in_rooms;
		
		$this->data['roomsToAlloted']=($this->data['guest_general_data'][0]->sb_guest_rooms_alloted - $checked_in_rooms )- $checked_out_rooms;
		$this->template->load('page_tpl','hotel_checkin_vw',$this->data);
    }
	/* Method To Show All Order Details
    * input - void
    * output - void
	*/
	public function details($booking_id = ' ')
    {
		$requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = "Invoice Details";
		$this->data['hotel_data'] = $this->Hotel_model->get_hotel_data($this->session->userdata('logged_in_user')->sb_hotel_id);
		$this->data['guest_general_data']=$this->Guest_model->get_hotel_guest_general_data($booking_id);
		$guest_data=$this->Guest_model->get_hotel_guest_data($booking_id);
		$i=0;
		while($i<count($guest_data))
		{
			$room_number =$guest_data[$i]->sb_guest_allocated_room_no;
			
			$customer_orders=$this->Guest_model->get_hotel_guest_orders($booking_id,$room_number);
			$count =0;
			$total_amount =0;
			
			while($count < count($customer_orders))
			{
			    
				$total_amount = $total_amount + ($customer_orders[$count]->quantity * $customer_orders[$count]->price);
				$count++;
			}
			$guest_data[$i]->customer_orders=$customer_orders;
			$guest_data[$i]->total_amount=$total_amount;
			$i++;
		}
		$this->data['guest_data']=$guest_data;
		$this->template->load('page_tpl','hotel_checkout_bill_vw',$this->data);
    }	

	/* Method To Show All Order Details For Paricular Room In the Booking
    * input - void
    * output - void
	*/
	public function detail($booking_id = ' ',$room_no = ' ')
    {
	   
		$requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = "Invoice Details";
		$this->data['hotel_data'] = $this->Hotel_model->get_hotel_data($this->session->userdata('logged_in_user')->sb_hotel_id);
		$this->data['guest_general_data']=$this->Guest_model->get_hotel_guest_general_data($booking_id);
		$guest_data=$this->Guest_model->get_hotel_guest_data($booking_id,$room_no);
		$i=0;
		while($i<count($guest_data))
		{
			$room_number =$guest_data[$i]->sb_guest_allocated_room_no;
			
			$customer_orders=$this->Guest_model->get_hotel_guest_orders($booking_id,$room_number);
			$count =0;
			$total_amount =0;
			
			while($count < count($customer_orders))
			{
				$total_amount = $total_amount + ($customer_orders[$count]->quantity * $customer_orders[$count]->price);
				$count++;
			}
			$guest_data[$i]->customer_orders=$customer_orders;
			$guest_data[$i]->total_amount=$total_amount;
			$i++;
		}
		$this->data['guest_data']=$guest_data;
		$this->template->load('page_tpl','hotel_checkout_bill_vw',$this->data);
    }		
    /* Method To get Booked Rooms
    * input - void
    * output - void
	*/
    public function get_booked_rooms()
    {
    	$room_type_value=$this->input->post('room_type_value');
    	$rooms_type_booked=$this->hotelrooms_model->get_booked_rooms($room_type_value);    	
    	if(count($rooms_type_booked)>0)
    	{
    	 	$room_array=$rooms_type_booked;
    		$temparray = array_chunk($room_array, 5);
    		echo json_encode($temparray);
    	}
    	else
    	{
    		echo 0;
    	}
    }
   /* Method To Rooms Data
    * input - void
    * output - void
	*/
    public function allocate_rooms()
    {
		$room_array = array();
	    $length =count($this->input->post())-3;
		$postDataLength=$length/2;
		$i=0;
		while($i<$postDataLength)
		{
			if(trim($this->input->post("sb_room_number_".$i))!=""){
				$this->load->model('Hotelrooms_model');
				$data=$this->Hotelrooms_model->getIfRoomAvailable($this->input->post("sb_hotel_room_type_".$i),$this->input->post("sb_room_number_".$i));
				if(count($data)>0)
				{
					array_push($room_array,$data[0]['sb_room_number']);
				}
			}
			$i++;
		}

		if(count($room_array)>0){
			$unique_rooms=array();
			$unique_rooms=array_unique($room_array);
			$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
			$this->load->model('Guest_model');
			$i=0;
			$Roomdata =array();
			while($i<count($unique_rooms)){
				$single_array=array(
										'sb_guest_actual_check_in'=>date('Y-m-d h:i:s'),
										'sb_guest_reservation_code'=>$this->input->post('reservation_code'),
										'sb_guest_allocated_room_no'=>$unique_rooms[$i],
										'sb_guest_terms'=>'1'
									);	
				array_push($Roomdata,$single_array);					
				$i++;
			}
			$this->Guest_model->allocate_rooms($Roomdata);
			$this->Guest_model->make_rooms_unavailable($unique_rooms);
			$totalRooms=count($unique_rooms);
			$this->session->set_flashdata('category_success', "$totalRooms  rooms are alloted succesfully.");
		}
		else{
			$this->session->set_flashdata('category_error', 'No valid rooms provided to allocate.');
		}
		$booking_id=$this->input->post('booking_id');
		$alloted_rooms=$this->input->post('alloted_rooms');
		redirect("admin/HotelRooms/Roomcheckin/$booking_id/$alloted_rooms");
    }

}