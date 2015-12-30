<?php
//   THIS IS API FOR HOTEL SERVICES. THIS IS CUSTOMER SIDE API.

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_service extends CI_Controller
{
	function __construct()
	{
		header('Access-Control-Allow-Origin: *');

		parent::__construct();
		/*
			this code is to maintain all hits log
			as well as to restrict API to any devices not browsers

			SOF
		*/
		//$this->load->helper('api/device_log');
		//device_log($_SERVER,$_REQUEST);
		$this->load->library('user_agent');
		if($this->agent->is_browser())
		{
		    //response_fail("Please insert all the fields");
		}
		/*EOF*/
		$this->load->model('api/customer/Hotel_service_model');
		$this->load->model('api/customer/User_order_model');
	}

  function logInfo($fName) {
    log_message('ERROR', $fName.': ');
    $postParams = $this->input->post();
    $string = '';
    foreach ($postParams as $key => $val) {
        $string .= ' key:'.$key.', value:'.$val.';';
    }
    log_message('ERROR', $string);
    log_message('ERROR', $fName.' done:');
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
    $this->logInfo('Hotel_service/get_submenu()');
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
	 * updated on -  7th Aug 2015
	 * created by - Akshay Patil;
	 * updated by - Akshay Patil;
	 */

	function place_service()
	{
    $this->logInfo('Hotel_service/place_service()');
    $inputArray = $this->input->post();
		//print_r($inputArray);die;
		if(array_key_exists("room_details",$inputArray))
		{
			$room_details = $inputArray['room_details'];
			$room_details = json_decode($room_details);
			unset($inputArray['room_details']);
			$applied_count = 0;
			$wrongRoom = 0;
			for ($i=0; $i <count($room_details); $i++)
			{
				$temp =  (array) $room_details[$i];
				if(array_key_exists("guest_room_number",$temp))
				{
					$inputArray['guest_room_number'] = $temp['guest_room_number'];

					$rooms = $this->Hotel_service_model->get_guest_rooms($inputArray['sb_hotel_guest_booking_id']);
					if (!in_array($inputArray['guest_room_number'], $rooms))
					{
						$wrongRoom ++;
						$result = array(
							'sb_guest_allocated_room_no' => $rooms
							);
						continue;
						response_fail("Wrong Room Number",$result);
					}


					if(array_key_exists("quantity",$temp))
					{
						$inputArray['quantity'] = $temp['quantity'];
					}
					if(array_key_exists("quantity",$inputArray) AND $inputArray['quantity'] <=0)
					{
						continue;
					}
					else
					{
						$rply = $this->place_service1($inputArray);
						$applied_count = intval($applied_count) + intval($rply);
					}
				}
			}
			if(count($room_details) == $applied_count)
			{
				response_ok();
			}
			else
			{
				if($wrongRoom > 0)
				{
					response_fail("Wrong Room Number",$result);
				}
				else
				{
					response_fail("May be some request(s) is not placed");
				}
			}
		}
		response_fail("room_details missing");
	}

	function place_service1($inputArray)
	{
		//$inputArray = $this->input->post();

		// $rooms = $this->Hotel_service_model->get_guest_rooms($inputArray['sb_hotel_guest_booking_id']);
		// if (!in_array($inputArray['guest_room_number'], $rooms))
		// {
		// 	$result = array(
		// 		'result' => $rooms
		// 		);
		// 	response_fail("Wrong Room Number",$result);
		// }
		// print_r("samrat"); die();
		$hrs = array();
		$hrscnt = 0;
		$hss = array();
		$hsscnt = 0;
		if((array_key_exists("sb_parent_service_id",$inputArray)) AND (array_key_exists("sb_child_service_id",$inputArray)) AND (array_key_exists("sb_hotel_id",$inputArray)))
		{
			// if(array_key_exists("sb_sub_child_service_id",$inputArray))
			// {
			// 	$hrs['sb_hotel_service_map_id'] = $this->Hotel_service_model->get_service_map($inputArray['sb_parent_service_id'], $inputArray['sb_child_service_id'], $inputArray['sb_hotel_id'] , $inputArray['sb_sub_child_service_id']);
			// }
			// else
			//{
				$hrs['sb_hotel_service_map_id'] = $this->Hotel_service_model->get_service_map($inputArray['sb_parent_service_id'], $inputArray['sb_child_service_id'], $inputArray['sb_hotel_id']);
			//}
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
		if(array_key_exists("quantity",$inputArray))
		{
			$hrs['sb_quantity'] = $inputArray['quantity'];
			unset($inputArray['quantity']);
			$hrscnt++;
		}
		if(array_key_exists("sub_child_services_id",$inputArray))
		{
			$hrs['sub_child_services_id'] = $inputArray['sub_child_services_id'];
			unset($inputArray['sub_child_services_id']);
			$hrscnt++;
		}
		else
		{
			$hrs['sub_child_services_id'] = 0;
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

		if($hrscnt<6 || $hsscnt < 2)
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

			return 1;
			//response_ok();
		}
		else
		{
			return 0;
			//response_fail("Sorry, Unable to place your service request. Please try again after some time.");
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
    $this->logInfo('Hotel_service/get_request()');
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
