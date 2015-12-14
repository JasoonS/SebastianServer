<?php
/* Surroundings Controller Class
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Surroundings extends CI_Controller 
{
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Hotel_model');
		$this->load->model('Services_model');
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

	public function index($hotel_id)
	{
	    $requested_mod = 'hotel/view_hotel/';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}    
		$this->data['title']  = 'Surroundings';
	
		$this->template->load('page_tpl','modules_vw',$this->data);
	}
	
}//End Of Controller Class