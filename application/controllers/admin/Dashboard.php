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
		$this->load->model('Dashboard_model');
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



	/*
		AJAX call for Task
		By AKSHAY
	*/
	public function currentTasks()
	{
		$sb_hotel_id = $this->input->post("hotel_id");
		// $service_due_date = $this->input->post("service_due_date");
		// $weekdates = $this->x_week_range($service_due_date);
		$data =$this->Dashboard_model->weekly_tasks($sb_hotel_id);

		echo json_encode($data);
	}

	/*
		AJAX call for currentGuest
		By AKSHAY
	*/
	public function currentGuest()
	{
		$sb_hotel_id = $this->input->post("hotel_id");
		$currentDate = $this->input->post("currentDate");
		// $weekdates = $this->x_week_range($service_due_date);
		$data = $this->Dashboard_model->currentGuest($sb_hotel_id,$currentDate);

		echo json_encode($data);
	}

	public function x_week_range($date1) {
    	/*$date = new DateTime($date1);
  		//add one week to date
  		$ds = $date->add(new DateInterval('P1W'))->format('Y-m-d');
    	$weekdate = array();
    	array_push($weekdate, $date1);
    	array_push($weekdate, $ds);
    	return $weekdate;*/

    	$ts = strtotime($date1);
    	$start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
    	return array(date('Y-m-d', $start),
        date('Y-m-d', strtotime('next saturday', $start)));
	}
}//End Of Controller class