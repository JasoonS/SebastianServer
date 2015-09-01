<?php
//   THIS API IS FOR HOTEL STAFF. THIS API WILL FOCUS ON TASKS OF HOTEL STAFF.

defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

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
		$this->load->model('api/staff/Tasks_model');
	}

	/**
	 * This API will provide staff's accepted today's tasks.
	 * return type- 
	 * created on - 27th July 2015;
	 * created by - Akshay Patil;
	 * updated on - 10th August 2015
	 * updated by - Samrat Aher
	 */
	public function get_todays_tasks()
	{
		
		$sb_hotel_user_id 	= 	$this->input->post('sb_hotel_user_id');
		$service_due_date	= 	$this->input->post('date');

		if($sb_hotel_user_id != '' || $service_due_date !='')
		{
			$tasks = $this->Tasks_model->todays_tasks($sb_hotel_user_id,$service_due_date);

			$resp = array(
		   			'result' =>$tasks
				);
		    response_ok($resp);	
		}
		else
		{
			response_fail("Please Insert All data correctly");
		}
	}

	/**
	 * This API will provide staff's accepted weekly tasks.
	 * return type- 
	 * created on - 27th July 2015;
	 * created by - Akshay Patil;
	 * updated on - 10th August 2015
	 * updated by - Samrat Aher
	 */
	public function get_weekly_tasks()
	{
		$sb_parent_service_id 	= 	$this->input->post('sb_parent_service_id');
		$service_due_date	= 	$this->input->post('date');
		$sb_hotel_id 		= 	$this->input->post('sb_hotel_id');

		$weekdates = $this->x_week_range($service_due_date);
		
		if($sb_parent_service_id != '' || $service_due_date !='' || $sb_hotel_id != '')
		{
			$tasks = $this->Tasks_model->weekly_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id);

			$resp = array(
		   			'result' =>$tasks
				);
		    response_ok($resp);	
		}
		else
		{
			response_fail("Please Insert All data correctly");
		}
	}

	public function x_week_range($date1) {
    	/*$date = new DateTime($date1);
  		//add one week to date
  		$ds = $date->add(new DateInterval('P1W'))->format('Y-m-d');
    	$weekdate = array();
    	array_push($weekdate, $date1);
    	array_push($weekdate, $ds);
    	return $weekdate;*/

    	$ts = strtotime($date1);
    	$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    	return array(date('Y-m-d', $start),
        date('Y-m-d', strtotime('next saturday', $start)));
	}

	/**
	 * This API will provide staff's completed weekly tasks.
	 * return type- 
	 * created on - 28th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function get_completed_tasks()
	{
		$sb_parent_service_id 	= 	$this->input->post('sb_parent_service_id');
		$service_due_date	= 	$this->input->post('date');
		$sb_hotel_id 		= 	$this->input->post('sb_hotel_id');

		$weekdates = $this->x_week_range($service_due_date);
		
		if($sb_parent_service_id != '' || $service_due_date !='' || $sb_hotel_id != '')
		{
			$tasks = $this->Tasks_model->completed_tasks($sb_parent_service_id ,$weekdates, $sb_hotel_id);

			$resp = array(
		   			'result' =>$tasks
				);
		    response_ok($resp);	
		}
		else
		{
			response_fail("Please Insert All data correctly");
		}
	}
	/**
	 * This API allow staff to accept/reject/complete the request
	 * return type- 
	 * created on - 29th July 2015;
	 * updated on - 
	 * created by - Samrat Aher/ Akshay Patil;
	 */
	public function action()
	{

		$sb_hotel_requst_ser_id 	= 	$this->input->post('sb_hotel_requst_ser_id');
		$sb_hotel_user_id 	= 	$this->input->post('sb_hotel_user_id');
		$sb_hotel_service_status 	= 	$this->input->post('sb_hotel_service_status');
		if($sb_hotel_requst_ser_id == '' || $sb_hotel_user_id =='' || $sb_hotel_service_status =='')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$status = $this->Tasks_model->check_status($sb_hotel_requst_ser_id);
			if($sb_hotel_service_status == 'accepted')
			{
				if($status[0]['sb_hotel_service_status'] == 'accepted' || $status[0]['sb_hotel_service_status'] ==  'completed' || $status[0]['sb_hotel_service_status'] ==  'rejected')
				{
				 	$msg = "Request was already ".$status[0]['sb_hotel_service_status'];
				 	response_fail($msg);
				}
				elseif($status[0]['sb_hotel_service_status'] == 'pending')
				{
				 	$date = date('Y-m-d' );
					$time =  date('H:i:s');
					$data = array(
			               'sb_hotel_service_assigned' => 'y',
			               'sb_hotel_ser_assgnd_to_user_id' => $sb_hotel_user_id,
			               'sb_hotel_ser_start_date' => $date,
			               'sb_hotel_ser_start_time'=>  $time,
			               'sb_hotel_service_status'=> 'accepted',
			            );
				 	$val = $this->Tasks_model->update_status($sb_hotel_requst_ser_id,$data);
				 	if($val)
				 	{
				 		response_ok();
				 	}
				 	else
				 	{
				 		response_fail("Some problem occured.. Please try again");
				 	}
				}			
			}
			elseif($sb_hotel_service_status == 'rejected')
			{
				if($status[0]['sb_hotel_service_status'] ==  'completed' || $status[0]['sb_hotel_service_status'] ==  'rejected')
				{
				 	$msg = "Request was already ".$status[0]['sb_hotel_service_status'];
				 	response_fail($msg);
				}
				elseif(($status[0]['sb_hotel_service_status'] == 'accepted' AND $status[0]['sb_hotel_ser_assgnd_to_user_id'] == $sb_hotel_user_id)|| $status[0]['sb_hotel_service_status'] == 'pending')
				{
				 	$date = date('Y-m-d' );
					$time =  date('H:i:s');
					$data = array(
			               'sb_hotel_ser_assgnd_to_user_id' => $sb_hotel_user_id,
			               'reject_reason' => $this->input->post('reject_reason'),
			               'sb_hotel_service_status'=> 'rejected',
			            );
				 	$val = $this->Tasks_model->update_status($sb_hotel_requst_ser_id,$data);
				 	if($val)
				 	{
				 		response_ok();
				 	}
				 	else
				 	{
				 		response_fail("Some problem occured.. Please try again");
				 	}
				}			
			}
			elseif($sb_hotel_service_status == 'completed')
			{
				if($status[0]['sb_hotel_service_status'] == 'pending' || $status[0]['sb_hotel_service_status'] ==  'completed'|| $status[0]['sb_hotel_service_status'] ==  'rejected')
				{
				 	$msg = "Request was already ".$status[0]['sb_hotel_service_status'];
				 	response_fail($msg);
				}
				elseif($status[0]['sb_hotel_service_status'] == 'accepted' AND $status[0]['sb_hotel_ser_assgnd_to_user_id'] == $sb_hotel_user_id)
				{
				 	$date = date('Y-m-d' );
					$time =  date('H:i:s');
					$data = array(
			               'sb_hotel_ser_finished_date' => $date,
			               'sb_hotel_ser_finished_time'=>  $time,
			               'sb_hotel_service_status'=> 'completed',
			            );
				 	$val = $this->Tasks_model->update_status($sb_hotel_requst_ser_id,$data);
				 	if($val)
				 	{
				 		response_ok();
				 	}
				 	else
				 	{
				 		response_fail("Some problem occured.. Please try again");
				 	}
				}
				else
				{
					response_fail("User Id miss match");
				}
			}
			else
			{
				response_fail("Please enter valid request");
			}	 
		}	
	}

	/**
	 * This API allow staff to reject item order
	 * return type- 
	 * created on - 20th AUG 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function reject_order_item()
	{
		$order_placed_id 	= 	$this->input->post('order_placed_id');
		
		if($order_placed_id == '')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$res = $this->Tasks_model->check_order_item($order_placed_id);
			if($res === 1)
			{
				response_fail("This item is already rejected");
			}
			elseif ($res === 0) {
				$val = $this->Tasks_model->reject_order_item($order_placed_id);
				response_ok();
			}
			else
			{
				response_fail("Please try after some time");
			}
		}
	}
}
