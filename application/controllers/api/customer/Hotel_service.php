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

	function get_sub_menu()
	{
		$sb_hotel_id = $this->input->post('sb_hotel_id');
		$sb_parent_service_id = $this->input->post('sb_parent_service_id');
		if ($sb_hotel_id == ''  || $sb_parent_service_id == '') 
		{
			response_fail("Please Insert Reservation Id");
		}

		else
		{
			$data = $this->Hotel_service_model->get_sub_menu($sb_hotel_id , $sb_parent_service_id);
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
}	