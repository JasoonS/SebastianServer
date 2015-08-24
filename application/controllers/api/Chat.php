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
		// $this->load->helper('api/device_log');
		// device_log($_SERVER,$_REQUEST);
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
			// $data = $this->Chat_model->get_request($sb_hotel_requst_ser_id);
			// if(count($data) != '1')
			// {
			// 	response_fail("ErrorCode#3, Somthing went wrong, Please Logout and login again");
			// }
			$data = $this->Chat_model->get_chat_messages($sb_hotel_requst_ser_id);
			$arr = array(
					'result'=> $data
				);
			response_ok($arr);			
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


	function insert_chat()
	{
		$type = $this->input->post('type');
		if($type != 'request' AND $type != 'order')
		{
			response_fail("ErrorCode#1, Somthing went wrong, Please Logout and login again");
		}
		if($type == 'request' || $type == 'order')
		{
			$sb_hotel_requst_ser_id = $this->input->post('sb_hotel_requst_ser_id');
			if($sb_hotel_requst_ser_id == '')
			{
				response_fail("ErrorCode#2, Somthing went wrong, Please Logout and login again");
			}
			$data = $this->Chat_model->get_request($sb_hotel_requst_ser_id);
			if( $data > 0)
			{
				$sb_sender_type = $this->input->post('sb_sender_type');
				$sb_chat_message = trim($this->input->post('sb_chat_message'));
				if($sb_sender_type == '' || $sb_chat_message == '' )
				{
					response_fail("ErrorCode#4, Somthing went wrong, Please Logout and login again");
				}
				else
				{
					$insert_arr = array(
									'sb_hotel_requst_ser_id' => $sb_hotel_requst_ser_id,
									'sb_sender_type' => $sb_sender_type,
									'sb_chat_message' => $sb_chat_message	
						);
					$result = $this->Chat_model->insert_chat($insert_arr);
					// print_r($result); die()
					if($result)
					{
							$id = $this->Chat_model->get_ids($sb_hotel_requst_ser_id , $sb_sender_type);
							if($id)
							{
								$token = $this->Chat_model->get_token($id , $sb_sender_type);
								 // print_r($token); die();

								if (count($token) > 0)
								{
									$user_name = $this->Chat_model->get_name($id , $sb_sender_type);
									// print_r($user_name); die();
									$title = "New Message from : ".$user_name ;
									$message = array(
										"type" => 'Message',
										"message" => $sb_chat_message,
										"title" => 'New Service Request',
										"id" => $result
										);
									$android_token = array();
									$ios_token = array();
									for ($i=0; $i < count($token); $i++) 
									{ 
										if($token[$i]['sdt_deviceType'] == 'android' AND $token[$i]['sdt_token'] != NULL AND $token[$i]['sdt_token'] != (null))
										{
											array_push($android_token,$token[$i]['sdt_token']);
										}
										else
										{
											if($token[$i]['sdt_token'] != "" AND $token[$i]['sdt_token'] != NULL AND $token[$i]['sdt_token'] != (null))
											{
												array_push($ios_token,$token[$i]['sdt_token']);
											}	
										}	
									}

									
									if(count($ios_token)>0)
									{
										$ipushdata  = array('deviceToken'=> $ios_token,
													'user'=> "staff",
													'message' => $message
													);
										$this->load->library('api/Iospush');
										$val = $this->iospush->iospush_notification($ipushdata);
									}
												
									// array for android
									if(count($android_token)>0)
									{
										$pushdata = array(
											'message'=> $message,
											'deviceTokens'=> $android_token,
											'user'=> "staff"
											);
										$this->load->library('api/Android_push');
										$val1 = $this->android_push->push_notification($pushdata);
									}
									
								}
									response_ok();
							}
							else
							{
								response_fail("No such user exists");
							}	
					}
					else
					{
						response_fail("Notification not inserted.. Please try again");
					}

				}

			}
			else
			{
				response_fail("ErrorCode#3, Somthing went wrong, Please Logout and login again");
			} 
		}
			
	}	

}	