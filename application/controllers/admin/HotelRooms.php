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
		$data['title']  = 'Room Creation Page';
		$this->template->load('page_tpl','hotel_rooms_vw',$data);
	}
	/* Method render add Rooms view to perticulr Hotel If User is super administrator
		Created on:-
	 * @param void
	 * return void
	 */

	public function hotelRoomsInsert()
<<<<<<< HEAD
	{	
        $requested_mod = 'HotelRooms';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  	
=======
	{		
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
>>>>>>> 9a8c93371fc20e18543271013f2c9a3e88667919
		$hotelRoomsInsert_data=array(
			'room_num_from'=>$room_num_from,
			'room_num_to'=>$room_num_to,
			'room_num_prefix'=>$this->input->post('room_num_prefix'),
			'room_num_postfix'=>$this->input->post('room_num_postfix')
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
	/* Method render create Rooms After submission Of create_rooms_form If User is super administrator
	 * @param -	Number(From and To )->room number limit
				String(prefix and suffix)->as prefix and postfix to Room number
	 * return void
	 */
}