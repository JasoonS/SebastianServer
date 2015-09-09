<?php 

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forum extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		/*
			this code is to maintain all hits log
			as well as to restrict API to any devices not browsers

			SOF
		*/
		// $this->load->helper('api/device_log');
		// device_log($_SERVER,$_REQUEST);
		$this->load->library('user_agent');
		if($this->agent->is_browser())
		{
		    //response_fail("Please insert all the fields");
		}
		/*EOF*/
		$this->load->model('api/customer/Forum_model');
		// $this->device_log();
	}

	/**
	 * this API is for posting msg into forum
	 * return type- 
	 * created on - 09Th Sept 2015;
	 * updated on - 
	 * update 	  -
	 * created by - Akshay Patil;
	 */
	function post_forum()
	{
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$sb_hotel_guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		$msg 				= 	$this->input->post('msg');
		
		if($sb_hotel_guest_booking_id == '' ||  $sb_hotel_id == ''|| $msg=='' )
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$insertData = array(
				"sb_hotel_guest_booking_id" => $sb_hotel_guest_booking_id,
				"sb_hotel_id"				=> $sb_hotel_id,
				"forum_msg"					=> $msg,
				"sender_type"				=> "customer"
				);
			$result = $this->Forum_model->post_forum($insertData);
			if($result != 0)
			{
				response_ok();
			}
			else
			{
				response_fail("Somthing goes Wrong");
			}
		}
	}

	/**
	 * API to retrieve 
	 * return type- 
	 * created on - 09Th Sept 2015;
	 * updated on - 
	 * update 	  -
	 * created by - Akshay Patil;
	 */
	function get_forum()
	{
		$sb_hotel_guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		
		if($sb_hotel_guest_booking_id == '')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$data = $this->Forum_model->get_forum($sb_hotel_guest_booking_id);
			$result = array(
					'result' => $data
				);
			response_ok($result);
		}
	}
	
}	