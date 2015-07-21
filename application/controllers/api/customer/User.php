<?php 
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('api/customer/User_model');
	}

	/**
	 * This function will take reservation id and device token etc. check for reservation id updates
	 * device token and return User details as well as hotel's services list etc
	 * return type- 
	 * created on - 17th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
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

	/**
	 * This function will take reservation id, check for reservation id 
	 * and return User details etc
	 * return type- 
	 * created on - 17th July 2015;
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
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Samrat Aher;
	 */
	function forgot()
	{
		$sb_guest_firstName = $this->input->post('sb_guest_firstName');
		$sb_guest_lastName = $this->input->post('sb_guest_lastName');
		$sb_guest_email = $this->input->post('sb_guest_email');
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$sb_guest_contact_no = $this->input->post('sb_guest_contact_no');

		if ($sb_guest_firstName == '' || $sb_guest_lastName == '' || $sb_guest_email == '' || $sb_hotel_id == '' || $sb_guest_contact_no == '' ) 
		{
				response_fail("Please insert all the fields");
		}
		else
		{
			$resp = $this->User_model->get_reservation($sb_guest_firstName, $sb_guest_lastName , $sb_guest_email, $sb_hotel_id , $sb_guest_contact_no);
			
			if (empty($resp))
			{
				response_fail("No such user exist");
			}
			else
			{
				$reservation_code = $resp[0]['sb_guest_reservation_code'];
		        $body = "<div style='font-family: Arial, Helvetica, sans-serif;'>
				        		Hi there,<br><br>
				        		We got forgot reservation request from <b></b>. Please note your updated reservation code for 'Sebastian App'.<br>
				        		Reservation code:- '<b>$reservation_code</b>' <br><br>
				        		Sebastian Team</div>
				        		";
				include 'email_library.php'; // include the library file
			    include "classes/class.phpmailer.php"; // include the class name
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
				$mail->AddAddress($sb_guest_email, ""); //To address who will receive this email
				$mail->MsgHTML( $body); //Put your body of the message you can place html code here
				//$mail->AddAttachment("images/asif18-logo.png"); //Attach a file here if any or comment this line, 
				$send = $mail->Send(); //Send the mails
				response_ok();
			}				
		}
	}
	
}	