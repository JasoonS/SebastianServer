<?php
/* Class manages services associated with hotel
 * and responsible for update and delete
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class HotelServices extends CI_Controller
{
	public $data = array();
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in_user'))
		{
			redirectWithErr(ERR_MSG_LEVEL_2,'login');
		}else
		{
			// Get the user's ID and add it to the config array
			$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
			// Load the ACL library and pas it the config array
			$this->load->library('acl',$config);

			//echo '<pre>';
			//print_r($this->acl->perms);
			//exit;
		}
		$this->load->model('Hotel_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
	}

	public function index()
	{

	}

	public function edit($hotel_id = '')
	{
		
		$this->data['title'] 				= 'Hotel Services';

		// Get all parent services
		$this->data['parent_services'] 		= $this->Services_model->get_all_parent_services();

		//echo '<pre>';
		//print_r($this->data['parent_services']);
		//exit;

		$this->template->load('page_tpl', 'parent_service_list_vw',$this->data);


		//$this->get_child_services_for_hotel($hotel_id);
	}

	public function get_child_services_for_hotel($hotel_id = '')
	{
		$parent_service_id = 1;

		//Get hotel id if user is not system admin
		if($hotel_id == '' && $this->session->logged_in_user->sb_hotel_user_type !== 'u')
		{
			$hotel_id = $this->session->logged_in_user->sb_hotel_id;
			
		}
		
		$child_services_for_this_parent = 	$this->Services_model->get_hotel_child_services_by_parent_service($hotel_id,$parent_service_id);
	}
}