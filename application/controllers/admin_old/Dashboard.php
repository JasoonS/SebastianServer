<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller 
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
		}
	}
    /*This method decides which dashboard to show according to user is Hotel Administrator or Super Administrator
	 * params void
	 * return void
     */	 
	public function index()
	{	
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		{
			$this->data['title'] = LABEL_1;
			$this->load->model('Guest_model');
			$this->data['visitor']=$this->Guest_model->getAllVisitors();
			$this->template->load('page_tpl','admin_dashboard_vw',$this->data);
		}else
		{
			$this->data['title'] = LABEL_2;
			$this->load->model('Guest_model');
			$this->load->model('Services_model');
			$this->data['visitor']=$this->Guest_model->getTotalVisitors();
			$this->data['hotelServices']=$this->Services_model->get_hotel_unique_parent_services($this->session->userdata('logged_in_user')->sb_hotel_id);
			$this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
			//print_r($this->data['hotelServices']);exit;
			$this->template->load('page_tpl','hotelier_dashboard_vw',$this->data);
		}	
	}
	/* Call To Render dashboard view through method
	 *
     */	 
	public function permission()
	{
		$this->index();
	}

	/* Method check user access level
	 * granted by admin , to hotel admin
	 * @param void
	 * return void
	 *
	private function check_user_access_level()
	{
		// Get the user's ID and add it to the config array
		$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
		// Load the ACL library and pas it the config array
		$this->load->library('acl',$config);
	}*/
}//End Of Controller class