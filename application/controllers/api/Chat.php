<?php 
//   THIS IS API FOR HOTEL USERS(CUSTOMERS). THIS IS CUSTOMER SIDE API.THIS API WILL FOCUS ON LOGIN/LOGOUT/CHANGE PASSWORD/FORGOT PASSWORD/NOTIFICATIONS FOR HOTEL USER(CUSTOMER).

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		/*
			this code is to maintain all hits log
			as well as to restrict API to any devices not browsers

			SOF
		*/
		$this->load->helper('api/device_log');
		device_log($_SERVER,$_REQUEST);
		$this->load->library('user_agent');
		if($this->agent->is_browser())
		{
		    //response_fail("Please insert all the fields");
		}
		/*EOF*/
		$this->load->model('api/Chat_model');
	}

	/**
	 * This function will take reservation id and device token etc. check for reservation id updates
	 * device token and return User details as well as hotel's services list etc
	 * return type- 
	 * created on - 4th Aug 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	function get_chat()
	{
		$type = $this->input->post('type');
		if($type != 'request' AND $type != 'order')
		{
			response_fail("ErrorCode#1, Somthing went wrong, Please Logout and login again");
		}
		if($type == 'request')
		{
			$sb_hotel_requst_ser_id = $this->input->post('sb_hotel_requst_ser_id');
			if($sb_hotel_requst_ser_id == '')
			{
				response_fail("ErrorCode#2, Somthing went wrong, Please Logout and login again");
			}
			$data = $this->Chat_model->get_request($sb_hotel_requst_ser_id);
			if(count($data) != '1')
			{
				response_fail("ErrorCode#3, Somthing went wrong, Please Logout and login again");
			}
			response_ok($data);			
		}
		elseif ($type == 'order')
		{
			response_fail("This service is not available");
		}
		else
		{
			response_fail("ErrorCode#2, Somthing went wrong, Please Logout and login again");
		}	
	}

}	