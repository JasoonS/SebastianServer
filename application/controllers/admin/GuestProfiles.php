<?php
/* Class responsible for managing guest 
 * profiles added in a hotel
 * admin can access all guest profile corresponding to a hotel
 * hotel users can access only guest inside their hotel
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class GuestProfiles extends CI_Controller
{
	public $data = array();

	public function __construct()
	{
		//die('i am here');
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
		}
		$this->load->helper('admin/utility_helper');
	}

	public function index()
	{
		
	}

	public function guest()
	{
		$this->data['title'] = 'Guest Profiles';
		$this->template->load('page_tpl', 'hotel_guest_list_vw',$this->data);

	}

	public function hotel_guest()
	{
		die('access by admin');
	}
}
?>