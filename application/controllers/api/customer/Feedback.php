<?php
//   THIS IS API FOR HOTEL USERS(CUSTOMERS). THIS IS CUSTOMER SIDE API.THIS API WILL FOCUS feedback of user.

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends CI_Controller
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
		$this->load->model('api/customer/Feedback_model');
		// $this->device_log();
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

	public function insert_feedback()
	{
    $this->logInfo('Feedback/insert_feedback()');
		$rate_stay = $this->input->post('rate_stay');
		$improve_feedback = $this->input->post('improve_feedback');
		$service_feedback = $this->input->post('service_feedback');
		$special_info = $this->input->post('special_info');
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$guest_booking_id = $this->input->post('sb_hotel_guest_booking_id');
		if($sb_hotel_id == '' || $guest_booking_id == '')
		{
			response_fail("Hotel id or Guest Booking ID is missing");
		}
		else
		{
			$insert_arr = array("rate_stay" => $rate_stay,
							"improve_feedback" => $improve_feedback,
							"service_feedback" => $service_feedback,
							"special_info" => $special_info,
							"sb_hotel_id" => $sb_hotel_id,
							"guest_booking_id" => $guest_booking_id);
			// print_r($insert_arr); die();

			$result = $this->Feedback_model->insert_feedbck($insert_arr);
			if ($result == 0)
			{
				response_fail("Some error occoured.. Please try again");
			}
			else
			{
				response_ok();
			}
		}

	}

}
