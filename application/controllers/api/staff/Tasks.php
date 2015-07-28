<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('api/staff/Tasks_model');
	}

	/**
	 * This API will provide staff's accepted today's tasks.
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
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
	 * This API will provide staff's accepted today's tasks.
	 * return type- 
	 * created on - 20th July 2015;
	 * updated on - 
	 * created by - Akshay Patil;
	 */
	public function get_weekly_tasks()
	{
		$sb_parent_service_id 	= 	$this->input->post('sb_parent_service_id');
		$service_due_date	= 	$this->input->post('date');
		$sb_hotel_id 		= 	$this->input->post('sb_hotel_id');

		$weekdates = $this->x_week_range($service_due_date);
		//print_r($weekdates);die;
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
	 * created on - 20th July 2015;
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
}
