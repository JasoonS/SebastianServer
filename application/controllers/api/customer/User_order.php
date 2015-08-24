<?php 
//   THIS IS API FOR HOTEL SERVICES. THIS IS CUSTOMER SIDE API.

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_order extends CI_Controller
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
		$this->load->model('api/customer/Hotel_service_model');
		$this->load->model('api/customer/User_order_model');
	}

	/**
	 * This function will get All placed orders by a customer
	 * return type- 
	 * created on - 21st aug 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 * updated by - 
	 */

	function get_order_record()
	{
		$sb_hotel_guest_booking_id	 = $this->input->post('sb_hotel_guest_booking_id');
		if ($sb_hotel_guest_booking_id == '') 
		{
			response_fail("Please send the valid Guest Bookin Id, Guest Bookin Id  is empty");
		}
		else
		{
			$service = $this->User_order_model->get_order_record($sb_hotel_guest_booking_id);
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

	/**
	 * This function will will show all the requests placed by the user.
	 * return type- 
	 * created on -20th August 2015
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	function place_order()
	{
		$sb_hotel_guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$rooms = $this->Hotel_service_model->get_guest_rooms($sb_hotel_guest_booking_id);
		$inputArray = $this->input->post('order_details');
		$order_details = json_decode($inputArray);

		if($sb_hotel_id <= 0 || $sb_hotel_id == '' || $sb_hotel_guest_booking_id == '' || $sb_hotel_guest_booking_id <= 0)
		{
			response_fail("Wrong Input");
		}
		
		for ($i=0; $i < count($order_details); $i++) 
		{
		
			$order = array();
			$order = (array)$order_details[$i];
			
			$new_order =array();
			for ($j=0; $j < count($order['order']); $j++) 
			{ 
				$new_order[$j] = (array)$order['order'][$j];
			}
			$hrs = array();
			$hss = array();
			$user_order = array();
			
			for ($j=0; $j < count($new_order); $j++) { 
				
				$index = -1;
				for ($k=0; $k < count($hrs); $k++) { 
					if($hrs[$k]['sb_guest_allocated_room_no'] == $new_order[$j]['sb_guest_allocated_room_no'])
						$index = $k;
				}
				if ($index == -1) 
				{
					$hrs[$j]['sb_parent_service_id'] = $order['sb_parent_service_id'];
					$hrs[$j]['sb_hotel_id'] = $sb_hotel_id;
					$hrs[$j]['sb_hotel_guest_booking_id'] = $sb_hotel_guest_booking_id;
					$hrs[$j]['order_details'] = '1';

					if($this->input->post('service_due_date'))
					{
						$hss[$j]['sb_hotel_ser_start_date'] = $this->input->post('service_due_date');
					}
					else
					{
						$hss[$j]['sb_hotel_ser_start_date'] = date("Y-m-d");
					}
					if($this->input->post('service_due_time'))
					{
						$hss[$j]['sb_hotel_ser_start_time'] = $this->input->post('service_due_time');
					}
					else
					{
						$hss[$j]['sb_hotel_ser_start_time'] = date("h:i:s");
					}
					$hrs[$j]['sb_guest_allocated_room_no'] = $new_order[$j]['sb_guest_allocated_room_no'];
					
					if($new_order[$j]['quantity'] > 0)
					{
						$temp = array(
						"sb_parent_service_id" => $order['sb_parent_service_id'],
						"sb_child_service_id" => $new_order[$j]['sb_child_service_id'],
						"sub_child_services_id" => $new_order[$j]['sub_child_services_id'],
						"quantity" => $new_order[$j]['quantity'],
						"price" => $new_order[$j]['price'],
						);
						
						$user_order[$j][] = $temp;
					}
				}	
				else
				{
					if($new_order[$j]['quantity'] > 0)
					{
						$temp = array(
							"sb_parent_service_id" => $order['sb_parent_service_id'],
							"sb_child_service_id" => $new_order[$j]['sb_child_service_id'],
							"sub_child_services_id" => $new_order[$j]['sub_child_services_id'],
							"quantity" => $new_order[$j]['quantity'],
							"price" => $new_order[$j]['price'],
						);
						$temp1 = $user_order[$index];
						array_push($temp1, $temp);
						$user_order[$index] = $temp1;
					}
				}
			}
			
			$wrongRoom = 0;
			for ($l=0; $l < count($hrs); $l++)
			{ 
				if (!in_array($hrs[$l]['sb_guest_allocated_room_no'], $rooms))
				{
					$wrongRoom ++;
					$result = array(
						'result' => $rooms
					);
					continue;
				}
				else
				{
					$data = $this->Hotel_service_model->place_service($hrs[$l], $hss[$l]);
					
					for ($m=0; $m < count($user_order[$l]); $m++) { 
						$user_order[$l][$m]['sb_hotel_requst_ser_id'] = $data;
					}
					$rply = $this->User_order_model->place_order_details($user_order[$l]);
					/*PUSH NOTIFICATION*/
					if ($data != 0)
					{
						
			 			$token = $sb_hotel_user = $this->Hotel_service_model->get_staff_ids($hrs[$l]['sb_hotel_id'],$hrs[$l]['sb_parent_service_id']);
						
						if (count($token)>0)
						{
							$msg = "New service requested from room no : ".$hrs[$l]['sb_guest_allocated_room_no'] ;
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
					}
				}
			}
			if($wrongRoom > 0)
			{
				response_fail("Wrong Room Number",$result);
			}
			else
			{
				response_ok();
			}			
		}
	}


	/**
	 * This function will get All restaurant for the Hotel
	 * return type- 
	 * created on - 22st aug 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 * updated by - 
	 */
	public function get_hotel_restaurant()
	{
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$hotel_restaurant = $this->User_order_model->get_hotel_restaurant($sb_hotel_id);
		$result = array(
			'result' => $hotel_restaurant
		);
		response_ok($result);
	}
}	