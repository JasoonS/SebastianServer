<?php 
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_service extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('api/customer/Hotel_service_model');
	}

	function login()
	{
		$sb_guest_reservation_code = 	$this->input->post('sb_guest_reservation_code');
		$cdt_token				= 	$this->input->post('cdt_token');
		$cdt_deviceType		    =   $this->input->post('cdt_deviceType');
		$cdt_macid 				= 	$this->input->post('cdt_macid');
				
		if($sb_guest_reservation_code == '' ||  $cdt_token == '' ||   $cdt_deviceType == ''|| $cdt_macid=='' )
		{
			response_fail("Please Insert All data correctly");

		}
		else
		{
			$user_info = $this->User_model->login($sb_guest_reservation_code , $cdt_token, $cdt_deviceType ,$cdt_macid);
			if($user_info == 0)
			{
				response_fail("User Not Found");
			}
			else
			{
				// $resp = array(
	   			// 'result' =>$user_info
		  		//);
	        	response_ok($user_info);
			}
		}
	}

	function get_userDetails()
	{
		$sb_guest_reservation_code = $this->input->post('sb_guest_reservation_code');

		if($sb_guest_reservation_code == '')
		{
			response_fail("Please Insert Reservation Id");
		}
		else
		{
			$userDetails = $this->User_model->get_userDetails($sb_guest_reservation_code);
			if(count($userDetails) == 0)
			{
				response_fail("Please Check Reservation Id");
			}
			else
			{
				$resp = array(
	    	        'result' =>$userDetails[0]
		        );
				response_ok($resp);
			}
		}

	}
}	