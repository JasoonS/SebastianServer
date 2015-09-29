<?php
/* Class responsible for managing Module Creation
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller
{
	public $data 			= array();


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
		}
		$this->load->model('Guest_model');
		$this->load->helper('admin/utility_helper');
	}

	/* Method is to generate performance report
	 * input -void
	 * output -view render
	 */
	public function index()
	{
	    $requested_mod = $this->uri->segment(2);
	   
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}

		$this->data['title'] = 'Modules';
		$this->template->load('page_tpl', 'modules_vw',$this->data);
		
	}
	
	
}
?>