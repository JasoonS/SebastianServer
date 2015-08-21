<?php 
//   THIS IS API FOR HOTEL SERVICES. THIS IS CUSTOMER SIDE API.

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_order extends CI_Controller
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
		// $this->load->library('user_agent');
		// if($this->agent->is_browser())
		// {
		//     //response_fail("Please insert all the fields");
		// }
		/*EOF*/
		$this->load->model('api/customer/Hotel_service_model');
		$this->load->model('api/customer/User_order_model');
	}

	/**
	 * This function will get All placed orders by a customer
	 * return type- 
	 * created on - 21st aug 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 * updated by - 
	 */

	function get_order_record()
	{
		$sb_hotel_guest_booking_id	 = $this->input->post('sb_hotel_guest_booking_id');
		if ($sb_hotel_guest_booking_id == '') 
		{
			response_fail("Please send the valid Guest Bookin Id, Guest Bookin Id  is empty");
		}
		else
		{
			$service = $this->User_order_model->get_order_record($sb_hotel_guest_booking_id);
			if ($service != 0)
			{	
				$result = array(
					'result' => $service
				);
				response_ok($result);
			}
			else
			{
				response_fail("Sorry, No request from you.");
			}
		}	
	}

}	