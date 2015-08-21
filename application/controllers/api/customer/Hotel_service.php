<?php 
//   THIS IS API FOR HOTEL SERVICES. THIS IS CUSTOMER SIDE API.

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotel_service extends CI_Controller
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
		// $this->load->library('user_agent');
		// if($this->agent->is_browser())
		// {
		//     //response_fail("Please insert all the fields");
		// }
		/*EOF*/
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
	 * updated on -  7th Aug 2015
	 * created by - Akshay Patil;
	 * updated by - Akshay Patil;
	 */

	function place_service()
	{
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
							'result' => $rooms
							);
						continue;
						// response_fail("Wrong Room Number",$result);
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
				$hrs['sb_hotel_service_map_id'] = $this->Hotel_service_model->get_service_map($inputArray['sb_parent_service_id'], $inputArray['sb_child_service_id'], $inputArray['sb_hotel_id'],0);
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

	/**
	 * This function will will show all the requests placed by the user.
	 * return type- 
	 * created on -20th August 2015
	 * updated on - 
	 * created by - Samrat Aher;
	 */
	function place_order()
	{
		//print_r($_POST);
		$sb_hotel_guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$rooms = $this->Hotel_service_model->get_guest_rooms($sb_hotel_guest_booking_id);
		$inputArray = $this->input->post('order_details');
		$order_details = json_decode($inputArray);
		// /print_r($order_details);
		for ($i=0; $i < count($order_details); $i++) 
		{
		
			$order = array();
			$order = (array)$order_details[$i];
			
			
			// print_r($hrs);
			// echo "<br>";
			// print_r($hss);
			$new_order =array();
			for ($j=0; $j < count($order['order']); $j++) 
			{ 
			 	//$order['order'][$j] = (array)$order['order'][$j];
				$new_order[$j] = (array)$order['order'][$j];
			}
			//print_r($new_order[0]);
			$hrs = array();
				$hss = array();
				$user_order = array();
			for ($j=0; $j < count($new_order); $j++) { 
				//sb_guest_allocated_room_no
				
				$index = -1;
				for ($k=0; $k < count($hrs); $k++) { 
					if($hrs[$k]['sb_guest_allocated_room_no'] == $new_order[$j]['sb_guest_allocated_room_no'])
						$index = $k;
				}
				// echo "index ::".$index;
				// if($j > 0)
				// {
				// 	die;
				// }
				// if($index == -1)
				// {
					
				// 	//$hrs[$j]['sb_guest_allocated_room_no'] = '';
				// }

				// if($hrs[$j]['sb_guest_allocated_room_no'] == '')
				if ($index == -1) 
				{
					$hrs[$j]['sb_parent_service_id'] = $order['sb_parent_service_id'];
					$hrs[$j]['sb_hotel_id'] = $sb_hotel_id;
					$hrs[$j]['sb_hotel_guest_booking_id'] = $sb_hotel_guest_booking_id;
					

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
					$temp = array(
						"sb_parent_service_id" => $order['sb_parent_service_id'],
						"sb_child_service_id" => $new_order[$j]['sb_child_service_id'],
						"sub_child_services_id" => $new_order[$j]['sub_child_services_id'],
						"quantity" => $new_order[$j]['quantity'],
						"price" => $new_order[$j]['price'],
					);
					//array_push($user_order[$j], $temp);
					//echo "in If";
					$user_order[$j] = $temp;
					//print_r($user_order);
					//echo "out if";
				}	
				else
				{
					//echo "in else";
					$temp = array(
						"sb_parent_service_id" => $order['sb_parent_service_id'],
						"sb_child_service_id" => $new_order[$j]['sb_child_service_id'],
						"sub_child_services_id" => $new_order[$j]['sub_child_services_id'],
						"quantity" => $new_order[$j]['quantity'],
						"price" => $new_order[$j]['price'],
					);
					//array_push($user_order[$index], $temp);
					$temp1 = $user_order[$index];
					//print_r($temp1);
					array_push($temp1, $temp);
					$user_order[$index] = $temp1;
					//print_r($user_order);//die;
				}
			}

			print_r($hrs);
			echo "\n<br>";
			print_r($hss);
			echo "\n<br>";
			print_r($user_order);
		}
	}


	function place_order12()
	{
		$sb_hotel_guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$rooms = $this->Hotel_service_model->get_guest_rooms($sb_hotel_guest_booking_id);
		$inputArray = $this->input->post('order_details');
		if(!empty($inputArray))
		{
			 // print_r("samrat"); die();
			$order_details = json_decode($inputArray);
			for ($i=0; $i < count($order_details); $i++) 
			{ 
				$order[] = (array)$order_details[$i];
				for ($j=0; $j < count($order[$i]['order']); $j++) 
				{ 
					$order[$i]['order'][$j] = (array)$order[$i]['order'][$j];
				}

			}
			
			$new_array = array();
			$new_array1 = array();
			// $arr = array();
			   // print_r($order); die();
			for($j=0; $j < count($order); $j++)
			{
				$wrongRoom = 0;
				$hrs = array();
				$hrscnt = 0;
				$hss = array();
				$hsscnt = 0;
				$tmp = array();
				$flag =0;
				// array_push($new_array,$order[$j]['sb_parent_service_id']);
				// $parent = $order[$j]['sb_parent_service_id'];
				// $new_array[$parent]=array();
				// $new_array1[$parent]=array();
				// print_r($new_array); die();
					 // echo count($order[$j]['order']); die();
				
				for($i=0;$i < count($order[$j]['order']); $i++)
				{
					// print_r("sam"); die();	
					// if (!in_array($order[$j]['order'][$i]['sb_guest_allocated_room_no'] , $rooms))
					// {
					// 	  // print_r("sam1"); die();
					// 	$wrongRoom ++;
					// 	$result = array(
					// 		'result' => $rooms
					// 		);
					// 	continue;
					// }
					// if(in_array($order[$j]['order'][$i]['sb_guest_allocated_room_no'], $parent))
					// {
					// 	// $parent[$i] = $order[$j]['order'][$i]['sb_guest_allocated_room_no'];
					// 	array_push($parent, $order[$j]['order'][$i]['sb_guest_allocated_room_no']);
					// 	$new_array[$parent[$i]]=array();
					// 	$new_array1[$parent[$i]]=array();
					// }
					if(!in_array($order[$j]['order'][$i]['sb_guest_allocated_room_no'], $tmp))
					{
						$parent = $order[$j]['order'][$i]['sb_guest_allocated_room_no'];
						$new_array[$parent] = array();
						$new_array1[$parent]= array();
						array_push($tmp, $order[$j]['order'][$i]['sb_guest_allocated_room_no']);
						$flag = 1;	
					}	

					if(!array_key_exists("quantity",$order[$j]['order'][$i]) && $order[$j]['order'][$i][$j]['quantity'] <= 0 && $order[$j]['order'][$i][$j]['quantity']  == '')
					{
						 // print_r("sam"); die();
						continue;
					}
					// print_r($order[$j]['order'][$i]['sb_child_service_id']); die(); 
					if($order[$j]['sb_parent_service_id'] != '' && array_key_exists("sb_child_service_id",$order[$j]['order'][$i])  && $sb_hotel_id != '')
					{
						// print_r("sam"); die();
						$hrs['sb_hotel_service_map_id'] = $this->Hotel_service_model->get_service_map($order[$j]['sb_parent_service_id'], $order[$j]['order'][$i]['sb_child_service_id'], $sb_hotel_id);
						// array_push($new_array[$parent], $hrs['sb_hotel_service_map_id']);
					}

					if($sb_hotel_id != '')
					{
						$hrs['sb_hotel_id'] = $sb_hotel_id;
						// array_push($new_array[$parent], $hrs['sb_hotel_id']);
						$hrscnt++;
					}
					if($order[$j]['sb_parent_service_id'] != '')
					{
						$hrs['sb_parent_service_id'] = $order[$j]['sb_parent_service_id'];
						// array_push($new_array[$parent], $hrs['sb_parent_service_id']);
						$hrscnt++;
					}
					if($sb_hotel_guest_booking_id != '')
					{
						$hrs['sb_hotel_guest_booking_id'] = $sb_hotel_guest_booking_id;
						// array_push($new_array[$parent], $hrs['sb_hotel_guest_booking_id']);
						$hrscnt++;
					}
					if(array_key_exists("sb_guest_allocated_room_no",$order[$j]['order'][$i]))
					{
						$hrs['sb_guest_allocated_room_no'] = $order[$j]['order'][$i]['sb_guest_allocated_room_no'];
						// array_push($new_array[$parent], $hrs['sb_guest_allocated_room_no']);
						$hrscnt++;
					}
					// if(array_key_exists("quantity",$order[$j]['order'][$i]))
					// {
					// 	$hrs['sb_quantity'] = $order[$j]['order'][$i]['quantity'];
					// 	array_push($new_array[$parent], $hrs['sb_quantity']);
					// 	$hrscnt++;
					// }

					if(array_key_exists("sub_child_services_id",$order[$j]['order'][$i]))
					{
						$hrs['sub_child_services_id'] = $order[$j]['order'][$i]['sub_child_services_id'];
						// array_push($new_array[$parent], $hrs['sub_child_services_id']);
						$hrscnt++;
					}
					else
					{
						$hrs['sub_child_services_id'] = 0;
						// array_push($new_array[$parent], $hrs['sub_child_services_id']);
						$hrscnt++;
					}
					
					if(array_key_exists("service_due_date",$order[$j]['order'][$i]))
					{
						$hss['sb_hotel_ser_start_date'] = $order[$j]['order'][$i]['service_due_date'];
						$hsscnt++;
					}
					else
					{
						$hss['sb_hotel_ser_start_date'] = date("Y-m-d");
						$hsscnt++;
					}
					if(array_key_exists("service_due_time",$order[$j]['order'][$i]))
					{
						$hss['sb_hotel_ser_start_time'] = $order[$j]['order'][$i]['service_due_time'];
						$hsscnt++;
					}
					else
					{
						$hss['sb_hotel_ser_start_time'] = date("h:i:s");
						$hsscnt++;
					}
					// print_r($hss);
					// print_r($hrs); die();
					if($hrscnt<5 || $hsscnt < 2)
					{
						response_fail("Some input is missing");
					}

					$hrs['sb_service_log'] = json_encode($inputArray);
					$hrs['order_details'] = '1';
					
					// print_r($hrs);
					array_push($new_array[$parent], $hrs);
					array_push($new_array1[$parent], $hss);
					 // print_r($new_array);
					if($flag == 1)
					{
					  $data = $this->Hotel_service_model->place_service($hrs, $hss);
					  $flag = 0 ;
					}
					// array_push($arr, $data);



				}
			 	   print_r($new_array); 
			// 	 print_r($new_array1);
			 }
			// die();
			 // echo(count($new_array));
			//  $sam = array();
			//  $l = 0 ;
			// foreach ($new_array as $arr)
			//  {
			//  	 $sam[$l++] =$arr; 
			//  }
			//   print_r($sam)	;


			//  }
			
			 // print_r($new_array1);
			 // print_r($new_array); 
			 // print_r($new_array1);
			  die();
			  // print_r($new_array); 
			// echo(count($new_array)); die();
			// for($t=0; $t< count($new_array);$t++ )
			// {
			// 	print_r($new_array[$t]); die();
			// 	$data = $this->Hotel_service_model->place_service($new_array[$t], $new_array1[$t]);
			// }
			  
		}

	}
}	