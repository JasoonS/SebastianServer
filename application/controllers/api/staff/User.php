<?php
// THIS API IS FOR HOTEL STAFF. THIS API WILL FOCUS ON LOGIN/LOGOUT/CHANGE PASSWORD/FORGOT PASSWORD/NOTIFICATIONS FOR HOTEL STAFF.

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		    response_fail("Please insert all the fields");
		}
		/*EOF*/		
		$this->load->model('api/staff/User_model');
		$this->load->helper('admin/utility_helper');
		$this->load->library('api/android_push');
		$this->load->library('api/iospush');
		// $this->device_log();
	}

	/**
	 * This function will take emsil and plain password with device token stuff
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function login()
	{
		$sb_hotel_useremail 	= 	$this->input->post('sb_hotel_useremail');
		$sb_hotel_userpasswd	= 	$this->input->post('sb_hotel_userpasswd');
		$sdt_token				= 	$this->input->post('sdt_token');
		$sdt_deviceType		    =   $this->input->post('sdt_deviceType');
		$sdt_macid 				= 	$this->input->post('sdt_macid');
		
		if($sb_hotel_useremail == '' || $sb_hotel_userpasswd == '' ||  $sdt_deviceType == ''|| $sdt_macid=='' )
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$password =  $this->User_model->checkPassword($sb_hotel_useremail);
			
			if(count($password) <= 0)
			{
				response_fail("Email is wrong");
			}
			else
			{
				if(verifyPasswordHash($sb_hotel_userpasswd,$password[0]['sb_hotel_userpasswd']) == TRUE)
				{
					$user_info = $this->User_model->login($sb_hotel_useremail,$sdt_token, $sdt_deviceType ,$sdt_macid);
					if(count($user_info) <=0)
					{
						response_fail("Email or Password is wrong");
					}
					else
					{
						$resp = array(
			   			'result' =>$user_info[0]
				  		);
			        	response_ok($resp);
					}
				}
				else
				{
					response_fail("Password is wrong");
				}
			}
		}
	}

	/**
	 * This function will logout, Only empty device token for all devices of that user, 
	 * Just to be sure that that user will not get any notification
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function logout()
	{
		$sb_hotel_user_id =	$this->input->post('sb_hotel_user_id');
		$sdt_macid = $this->input->post('sdt_macid');

		if($sb_hotel_user_id == '' || $sdt_macid == '')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$user_info = $this->User_model->logout($sb_hotel_user_id,$sdt_macid);
			response_ok();
		}
	}

	/**
	 * This function will mail user with new password
	 * return type- 
	 * created on - 29th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function forgot_password()
	{
		$sb_hotel_useremail =	$this->input->post('sb_hotel_useremail');
		$newpassword = $this->random_password();
		$hash = createHashAndSalt($newpassword);
		$arr = array();
		$arr['sb_hotel_useremail']= $sb_hotel_useremail;
		$user_info = $this->User_model->check_user($arr);
		
		if(count($user_info)>0)
		{
			$arr1['sb_hotel_userpasswd']= $hash;
			$user_info1 = $this->User_model->update_user($arr1,$arr);
	        $body = "<div style='padding-left:20px;font: \"MisoRegular\";letter-spacing: 2px;font-size:12px;'>
	        		Hi there,<br><br>
	        		We got forgot password request from <b>$sb_hotel_useremail</b>. Please note your updated password for 'Sebastian App'.<br>
	        		Password :- '<b>$newpassword</b>' (please skip quotes).<br><br>
	        		Sebastian Team
	        		</div>
	        		";
	        sendMail('',$sb_hotel_useremail,"New login password",$body);
	        response_ok();
		}
		else
		{
			response_fail("Email is wrong");
		}
	}

	/**
	 * This function will change password
	 * return type- 
	 * created on - 22th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function change_password()
	{
		$sb_hotel_user_id =	$this->input->post('sb_hotel_user_id');
		$sb_hotel_userpasswd =	$this->input->post('old_password');
		$newpassword =	$this->input->post('new_password');
		if($sb_hotel_user_id == '' || $sb_hotel_userpasswd == '' || $newpassword == '')
		{
			response_fail("Input may be empty");
		}
		else
		{
			$arr = array();
			$arr['sb_hotel_user_id']= $sb_hotel_user_id;
			$password =  $this->User_model->check_user($arr);
			if(count($password) <= 0)
			{
				response_fail("Email is wrong");
			}
			else
			{
				if(verifyPasswordHash($sb_hotel_userpasswd,$password[0]['sb_hotel_userpasswd']) == TRUE)
				{
				
					$arr1['sb_hotel_userpasswd']= createHashAndSalt($newpassword);
					$user_info1 = $this->User_model->update_user($arr1,$arr);
					response_ok();
				}
				else
				{
					response_fail("Something is wrong");
				}
			}
		}
	}

	
	public function random_password() {
	    $alphabet = "abcdefghijklmnopqrstuwxyz0123456789";
	    $pass = array(); //remember to declare $pass as an array
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	    }
	    return implode($pass); //turn the array into a string
	}

	/**
	 * This function is for sending notification
	 * return type- 
	 * created on - 22th July 2015;
	 * updated on - 
	 * created by - Samrat Aher;
	 * This was for testing and may be used future..
	 */
	public function notification()
	{
		$sdt_deviceType = $this->input->post('sdt_deviceType');
		$token = $this->User_model->get_token($sdt_deviceType);
		 
		$message = "Hi Everyone....";

		$dev_token = array();
		$ios_token = array();
		for ($i=0; $i < count($token); $i++) 
		{ 
			if($sdt_deviceType == 'android')
			{

				array_push($dev_token,$token[$i]['sdt_token']);
			}
			else
			{
				if(strlen($token[$i]['sdt_token']) == 64 )
				{
					array_push($ios_token,$token[$i]['sdt_token']);
				}	
			}	
		}
		
		
		// array for ios
		$ipushdata  = array('deviceToken'=> $ios_token,
							'user'=> "customer",
							'message' => $message
							);

		
		// array for android
		$pushdata = array(
			'message'=> $message,
			'deviceTokens'=> $dev_token
			);
		if($sdt_deviceType == 'android')
		{
			$val = $this->android_push->push_notification($pushdata);
		}
		else
		{
			$val = $this->iospush->iospush_notification($ipushdata);	
		}	
		if ($val == 1) {
			echo("Notification send");
		}
	}

	
}
