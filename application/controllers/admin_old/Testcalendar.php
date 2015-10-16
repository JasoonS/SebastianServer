<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Testcalendar extends CI_Controller 
{
	public $user_acl = array();
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

			//echo '<pre>';
			//print_r($this->acl->perms);
			//exit;
		}
	}
    /*This method decides which dashboard to show according to user is Hotel Administrator or Super Administrator
	 * params void
	 * return void
     */	 
	public function index()
	{	
		$this->data['title'] = LABEL_2;
		$this->template->load('page_tpl','calendar_vw',$this->data);
			
	}
	
}//End Of Controller class