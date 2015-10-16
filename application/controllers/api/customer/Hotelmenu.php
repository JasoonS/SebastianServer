<?php 

if( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hotelmenu extends CI_Controller
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
		$this->load->model('api/customer/Hotelmenu_model');
		// $this->device_log();
	}

	/**
	 * this API is to get hotel menu
	 * return type- 
	 * created on - 16th Oct 2015;
	 * updated on - 
	 * update 	  -
	 * created by - Akshay Patil;
	 */
	function gethotelmenu()
	{
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		
		if($sb_hotel_id == '')
		{
			response_fail("Please Insert All data correctly");
		}
		else
		{
			$result = $this->Hotelmenu_model->gethotelmenu($sb_hotel_id);
			response_ok($result);
			
		}
	}
	
}	