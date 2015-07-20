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

	/**
	 * This function will mail user with new password
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
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
	        $body = "<div style='font-family: Arial, Helvetica, sans-serif;'>
	        		Hi there,<br><br>
	        		We got forgot password request from <b>$sb_hotel_useremail</b>. Please note your updated password for 'Sebastian App'.<br>
	        		Password :- '<b>$newpassword</b>' (please skip quotes).<br><br>
	        		Sebastian Team</div>
	        		";
	        include '../../library.php'; // include the library file
        	include "../../classes/class.phpmailer.php"; // include the class name
        	$mail	= new PHPMailer; // call the class 
			$mail->IsSMTP(); 
			$mail->Host = SMTP_HOST; //Hostname of the mail server
			$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
			$mail->SMTPAuth = true; //Whether to use SMTP authentication
			$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
			$mail->Password = SMTP_PWORD; //Password for SMTP authentication
			$mail->AddReplyTo($sb_hotel_useremail); //reply-to address
			$mail->SetFrom("no-reply@sebastian.com", "Sebastian"); //From address of the mail
			// put your while loop here like below,
			$mail->Subject = 'Sebastian App'; //Subject od your mail
			$mail->AddAddress($email, ""); //To address who will receive this email
			$mail->MsgHTML( $body); //Put your body of the message you can place html code here
			//$mail->AddAttachment("images/asif18-logo.png"); //Attach a file here if any or comment this line, 
			$send = $mail->Send(); //Send the mails
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
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
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
