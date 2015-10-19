<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Forum extends CI_Controller 
{
	public $user_acl = array();
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Staffreport_model');
		//$this->load->library('Event');
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
    /*This Shows Calendar view to the Hotel Administrator
	 * params void
	 * return void
     */	 
	public function index()
	{	
		$this->data['title'] = "Forum";
		$requested_mod = $this->uri->segment(2);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		/*$this->data['hotel_user_id']=$hotel_user_id;
		$this->data['hotel_user_name']=$this->User_model->get_user_name($hotel_user_id)->sb_hotel_username;
		$this->data['parent_service_id']=$this->User_model->get_user_parent_service($hotel_user_id)->sb_parent_service_id;
		$other_staff = $this->User_model->get_staff($this->data['parent_service_id']);
		$this->data['other_staff']=$other_staff;*/

		$this->template->load('page_tpl','forum_vw',$this->data);
			
	}
	
}//End Of Controller class