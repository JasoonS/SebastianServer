<?php
/* Class manages services associated with hotel
 * and responsible for update and delete
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class HotelServices extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hotel_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
	}

	public function index()
	{

	}

	public function edit($hotel_id = '')
	{
		//Get hotel id if user is not system admin
		if($hotel_id == '' && $this->session->logged_in_user->sb_hotel_user_type === 'u')
		{
			$hotel_id = $this->session->logged_in_user->sb_hotel_id;
		}

		// Get all parent services
		$parent_services = $this->Services_model->get_all_parent_services();
	}
}