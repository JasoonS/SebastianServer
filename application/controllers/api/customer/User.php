<?php 
//   THIS IS API FOR HOTEL USERS(CUSTOMERS). THIS IS CUSTOMER SIDE API.THIS API WILL FOCUS ON LOGIN/LOGOUT/CHANGE PASSWORD/FORGOT PASSWORD/NOTIFICATIONS FOR HOTEL USER(CUSTOMER).

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
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
		$this->load->model('api/customer/User_model');
		// $this->device_log();
	}

	/**
	 * This function will take reservation id and device token etc. check for reservation id updates
	 * device token and return User details as well as hotel's services list etc
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	function login()
	{

		$sb_guest_reservation_code = 	$this->input->post('sb_guest_reservation_code');
		$cdt_token				= 	$this->input->post('cdt_token');
		$cdt_deviceType		    =   $this->input->post('cdt_deviceType');
		$cdt_macid 				= 	$this->input->post('cdt_macid');
		
		if($cdt_token == '(null)' || $cdt_token == 'null' || $cdt_token == null || $cdt_token == '')
			$cdt_token == '';

		if($sb_guest_reservation_code == '' ||  $cdt_deviceType == ''|| $cdt_macid=='' )
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
				response_ok($user_info);
			}
		}
	}

	/**
	 * This function will take reservation id, check for reservation id 
	 * and return User details etc
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
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

	/**
	 * This function is for forgot Reservation code.
	 * return type- 
	 * created on - 21th July 2015;
	 * updated on - 
	 * created by - Samrat Aher;
	 */
	function forgot()
	{
		$sb_guest_firstName = $this->input->post('sb_guest_firstName');
		$sb_guest_lastName = $this->input->post('sb_guest_lastName');
		$sb_guest_email = $this->input->post('sb_guest_email');
		$sb_hotel_name = $this->input->post('sb_hotel_name');
		$sb_guest_contact_no = $this->input->post('sb_guest_contact_no');

		if ($sb_guest_firstName == '' || $sb_guest_lastName == '' || $sb_guest_email == '' || $sb_hotel_name == '' || $sb_guest_contact_no == '' ) 
		{
			response_fail("Please insert all the fields");
		}
		else
		{
			$resp = $this->User_model->get_reservation($sb_guest_firstName, $sb_guest_lastName , $sb_guest_email, $sb_hotel_name , $sb_guest_contact_no);
			
			if (empty($resp))
			{
				response_fail("No such user exist");
			}
			else
			{
				$reservation_code = $resp[0]['sb_guest_reservation_code'];
		        $body = "<div  style='padding-left:20px;font: \"MisoRegular\";letter-spacing: 2px;font-size:12px;'>
				        		Hi there,<br><br>
				        		We got forgot reservation request from <b>$sb_guest_email</b>. Please note your reservation code for 'Sebastian App'.<br>
				        		Reservation code:- '<b>$reservation_code</b>' <br><br>
				        		Sebastian Team
				        </div>
				        		";
				$this->load->helper('admin/utility_helper');
				sendMail('',$sb_guest_email,"Reservation code",$body);
				response_ok();
			}				
		}
	}

	public function get_hotel_names()
	{
		$sb_hotel_name = '';
		if (!empty($_POST)) 
		{
			$sb_hotel_name = $this->input->post('sb_hotel_name');
		}

		$result = $this->User_model->get_hotel($sb_hotel_name);
		if (!empty($result)) 
		{
			$resp = array(
	    	        'result' =>$result
	    	        );
			response_ok($resp);
		}
		else
		{
			response_fail("No Hotel Exists");
		}
		
	}

	
}	