<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{
	public $data	 		= array();
	public $requested_mod	= '';

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

	public function type($user_type = '')
	{
		$requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);

		if(!$this->acl->hasPermission($requested_mod))
		{
			//$this->session->set_flashdata('ErrorAcessMsg',ERR_MSG_LEVEL_3);
			redirect('admin/dashboard/');
		}

		// If user is admin get listing of all hotels and show him admins of that hotel

		// If user is hotel admin then show him managers and staff of its hotel

		// If user is manager then show him staff of this hotels

		// Staff will not access this modules
	}
}


?>

