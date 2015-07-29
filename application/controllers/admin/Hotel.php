<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller 
{
	public $data	 = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');

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
	}

	public function index()
	{
		//$this->template->load('page_tpl','hotelier_dashboard_vw',$this->data);

		$this->template->load('page_tpl', 'hotel_list_vw',$this->data);
	}
}