<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('api/staff/User_model');
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
				
		if($sb_hotel_useremail == '' || $sb_hotel_userpasswd == '' ||  $sdt_token == '' ||   $sdt_deviceType == ''|| $sdt_macid=='' )
		{
			response_fail("Please Insert All data correctly");

		}
		else
		{
			$user_info = $this->User_model->login($sb_hotel_useremail,$sb_hotel_userpasswd, $sdt_token, $sdt_deviceType ,$sdt_macid);
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

		if($sb_hotel_user_id == '')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$user_info = $this->User_model->logout($sb_hotel_user_id);
			response_ok();
		}
	}

	public function forgot_password()
	{
		$sb_hotel_useremail =	$this->input->post('sb_hotel_useremail');
		$newpassword = $this->random_password();

		$arr = array();
		$arr['sb_hotel_useremail']= $sb_hotel_useremail;
		$user_info = $this->User_model->check_user($arr);
		
		if($user_info == 1)
		{
			$arr1['sb_hotel_userpasswd']= $newpassword;
			$user_info1 = $this->User_model->update_user($arr1,$arr);
			$config = Array(
			    'protocol' => 'smtp',
			    'smtp_host' => 'smtp.mailgun.org',
			    'smtp_port' => 25,
			    'smtp_user' => 'postmaster@eeshana.com',
			    'smtp_pass' => '045b85d175e5f3e1289b84c355774ccc',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);

			$this->email->from('no-reply@sebastian.com', 'Sebastian');
	        $this->email->to($sb_hotel_useremail); 
	        $this->email->subject('Sebastian App');

	        $msg = "<div style='font-family: Arial, Helvetica, sans-serif;'>
	        		Hi there,<br><br>
	        		We got forgot password request from <b>$sb_hotel_useremail</b>. Please note your updated password for 'Sebastian App'.<br>
	        		Password :- '<b>$newpassword</b>' (please skip quotes).<br><br>
	        		Sebastian Team</div>
	        		";
	        
	        $this->email->message($msg);  
	        $this->email->send();
	        //echo $this->email->print_debugger();
	        response_ok();
		}
		else
		{
			response_fail("Email is wrong");
		}
	}

	public function change_password()
	{
		$sb_hotel_useremail =	$this->input->post('sb_hotel_useremail');
		$sb_hotel_userpasswd =	$this->input->post('old_password');
		$newpassword =	$this->input->post('newpassword');
		if($sb_hotel_useremail == '' || $sb_hotel_userpasswd == '' || $newpassword == '')
		{
			response_fail("Input may be empty");
		}
		else
		{
			$arr = array();
			$arr['sb_hotel_useremail']= $sb_hotel_useremail;
			$arr['sb_hotel_userpasswd']= $sb_hotel_userpasswd;
			$user_info = $this->User_model->check_user($arr);
			if($user_info ==1)
			{
				$arr1['sb_hotel_userpasswd']= $newpassword;
				$user_info1 = $this->User_model->update_user($arr1,$arr);
				response_ok();
			}
			else
			{
				response_fail("Something is wrong");
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
}
