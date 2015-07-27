<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller 
{
	public $user_acl = array();

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
		echo '<pre>';
		print_r($this->acl);
		exit;
	}

	/* Method check user access level
	 * granted by admin , to hotel admin
	 * @param void
	 * return void
	 */
	private function check_user_access_level()
	{
		// Get the user's ID and add it to the config array
		$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);

		// Load the ACL library and pas it the config array
		$this->load->library('acl',$config);
	}

}