<?php 
if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_service extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('api/customer/Hotel_service_model');
	}

	/**
	 * This function will fetch the submenus after the user clicks on the specific menu button
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Samrat Aher;
	 */

	function get_submenu()
	{
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$sb_parent_service_id = $this->input->post('sb_parent_service_id');
		if ($sb_hotel_id == ''  || $sb_parent_service_id == '') 
		{
			response_fail("Please Insert Reservation Id");
		}
		else
		{
			$data = $this->Hotel_service_model->get_submenu($sb_hotel_id , $sb_parent_service_id);
			if (!empty($data))
			{
				$result = array(
					'result'=> $data
				);
				response_ok($result);
			}
			else
			{
				response_fail("No such service exists");
			}
		}
	}

	/**
	 * This function will allow all types of service requests
	 * return type- 
	 * created on - 22nd July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */

	function place_service()
	{
		$inputArray = $this->input->post();
		$rooms = $this->Hotel_service_model->get_guest_rooms($inputArray['sb_hotel_guest_booking_id']);
		if (!in_array($inputArray['guest_room_number'], $rooms))
		{
			$result = array(
				'result' => $rooms
				);
			response_fail("Wrong Room Number",$result);
		}

		$hrs = array();
		$hrscnt = 0;
		$hss = array();
		$hsscnt = 0;
		if((array_key_exists("sb_parent_service_id",$inputArray)) AND (array_key_exists("sb_child_service_id",$inputArray)) AND (array_key_exists("sb_hotel_id",$inputArray)))
		{
			$hrs['sb_hotel_service_map_id'] = $this->Hotel_service_model->get_service_map($inputArray['sb_parent_service_id'], $inputArray['sb_child_service_id'], $inputArray['sb_hotel_id']);
			unset($inputArray['sb_child_service_id']);
			$hrscnt++;
		}
		if(array_key_exists("sb_hotel_id",$inputArray))
		{
			$hrs['sb_hotel_id'] = $inputArray['sb_hotel_id'];
			unset($inputArray['sb_hotel_id']);
			$hrscnt++;
		}
		if(array_key_exists("sb_parent_service_id",$inputArray))
		{
			$hrs['sb_parent_service_id'] = $inputArray['sb_parent_service_id'];
			unset($inputArray['sb_parent_service_id']);
			$hrscnt++;
		}
		if(array_key_exists("sb_hotel_guest_booking_id",$inputArray))
		{
			$hrs['sb_hotel_guest_booking_id'] = $inputArray['sb_hotel_guest_booking_id'];
			unset($inputArray['sb_hotel_guest_booking_id']);
			$hrscnt++;
		}
		if(array_key_exists("guest_room_number",$inputArray))
		{
			$hrs['sb_guest_allocated_room_no'] = $inputArray['guest_room_number'];
			unset($inputArray['guest_room_number']);
			$hrscnt++;
		}
		
		if(array_key_exists("service_due_date",$inputArray))
		{
			$hss['sb_hotel_ser_start_date'] = $inputArray['service_due_date'];
			unset($inputArray['service_due_date']);
			$hsscnt++;
		}
		else
		{
			$hss['sb_hotel_ser_start_date'] = date("Y-m-d");
			$hsscnt++;
		}
		if(array_key_exists("service_due_time",$inputArray))
		{
			$hss['sb_hotel_ser_start_time'] = $inputArray['service_due_time'];
			unset($inputArray['service_due_time']);
			$hsscnt++;
		}
		else
		{
			$hss['sb_hotel_ser_start_time'] = date("h:i:s");
			$hsscnt++;
		}

		if($hrscnt<5 || $hsscnt < 2)
		{
			response_fail("Some input is missing");
		}

		$hrs['sb_service_log'] = json_encode($inputArray);


		$data = $this->Hotel_service_model->place_service($hrs, $hss);
		if ($data != 0)
		{
			
 			//code for push notification	

			$token = $sb_hotel_user = $this->Hotel_service_model->get_staff_ids($hrs['sb_hotel_id'],$hrs['sb_parent_service_id']);
			if (count($token)>0)
			{
				$msg = "New service requested from room no : ".$hrs['sb_guest_allocated_room_no'] ;
				$message = array(
					"type" => 'request',
					"message" => $msg,
					"title" => 'New Service Request',
					"id" => $data
					);
				$android_token = array();
				$ios_token = array();
				for ($i=0; $i < count($token); $i++) 
				{ 
					if($token[$i]['sdt_deviceType'] == 'android')
					{
						array_push($android_token,$token[$i]['sdt_token']);
					}
					else
					{
						if($token[$i]['sdt_token'] != "")
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
			response_fail("Sorry, Unable to place your service request. Please try again after some time.");
		}
	}

	/**
	 * This function will will show all the requests placed by the user.
	 * return type- 
	 * created on -28th July 2015
	 * updated on - 
	 * created by - Samrat Aher;
	 */

	function get_request()
	{
		$sb_hotel_guest_booking_id	 = $this->input->post('sb_hotel_guest_booking_id');
		if ($sb_hotel_guest_booking_id == '') 
		{
			response_fail("Please send the valid Guest Bookin Id, Guest Bookin Id  is empty");
		}
		else
		{
			$service = $this->Hotel_service_model->get_request_info($sb_hotel_guest_booking_id);
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