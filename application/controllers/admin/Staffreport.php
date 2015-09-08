<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Staffreport extends CI_Controller 
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
    /*This method decides which dashboard to show according to user is Hotel Administrator or Super Administrator
	 * params void
	 * return void
     */	 
	public function index($hotel_user_id)
	{	
		$this->data['title'] = LABEL_2;
		$this->data['hotel_user_id']=$hotel_user_id;
		$this->data['hotel_user_name']=$this->User_model->get_user_name($hotel_user_id)->sb_hotel_username;
		$this->data['parent_service_id']=$this->User_model->get_user_parent_service($hotel_user_id)->sb_parent_service_id;
		$this->template->load('page_tpl','calendar_vw',$this->data);
			
	}
	 /*This method gives array of tasks for hotel staff by id
	 * params int
	 * return array
     */	
	public function staffTasks($hotel_user_id)
	{

		$sb_hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Hotel_model');
		$hotel_name=$this->Hotel_model->get_hotel_name($sb_hotel_id)[0]['sb_hotel_name'];
		
		$user_ids=array('0',$hotel_user_id);
		$parent_service_id=$this->User_model->get_user_parent_service($hotel_user_id)->sb_parent_service_id;
		$tasks = $this->Staffreport_model->getTasks($sb_hotel_id,$_GET['start'],$_GET['end'],$user_ids,$parent_service_id);
		//print_r($tasks);
		$i=0;
		$eventData=array();
		while($i<count($tasks))
		{
		    $eventObject = new stdClass;
			$eventObject->start= date('Y-m-d',strtotime($tasks[$i]['sb_hotel_ser_start_date']." ".$tasks[$i]['sb_hotel_ser_start_time']))."T".date('h:i:s',strtotime($tasks[$i]['sb_hotel_ser_start_date']." ".$tasks[$i]['sb_hotel_ser_start_time']));
		    if($tasks[$i]['sb_hotel_ser_finished_date'] != "0000-00-00")
			{
				//$eventObject->end= date('Y-m-d h:i:s',strtotime($tasks[$i]['sb_hotel_ser_finished_date']." ".$tasks[$i]['sb_hotel_ser_finished_time']));
			}
			$eventObject->id=$tasks[$i]['sb_hotel_requst_ser_id'];
			$eventObject->description="Request From ".$tasks[$i]['sb_guest_firstName']." ".$tasks[$i]['sb_guest_lastName']." "." Room No :"." ".$tasks[$i]['sb_guest_allocated_room_no'];
			$quantity = " $hotel_name";
			if($tasks[$i]['sb_quantity']!= 0)
			{
				$quantity = " $hotel_name Quantity = ".$tasks[$i]['sb_quantity'];
			}
			if($tasks[$i]['sb_sub_child_service_name'] == ""){
				$eventObject->title=$tasks[$i]['sb_parent_service_name']." Request From ".$tasks[$i]['sb_guest_firstName'].$quantity;
			}
			else{
				$eventObject->title=$tasks[$i]['sb_parent_service_name']." ".$tasks[$i]['sb_sub_child_service_name']." Request From ".$tasks[$i]['sb_guest_firstName'].$quantity;
			}
			switch($tasks[$i]['sb_hotel_service_status'])
			{
				case 'completed':{
									$eventObject->backgroundColor = "green" ;
									$eventObject->textColor = 'white !important';
									$eventObject->className = 'eventClass';
									//$eventObject->allDay=true;
									//$eventObject->overlap= false;
									break;
								}	
				case 'pending':{
								$eventObject->backgroundColor = "red" ;
								$eventObject->textColor = 'white !important';
								$eventObject->className = 'eventClass';
								//$eventObject->overlap= false;
								break;
							}
				case 'accepted':{
								$eventObject->backgroundColor = "orange" ;
								$eventObject->textColor = 'white !important';
								$eventObject->className = 'eventClass';
								//$eventObject->overlap= false;
								break;
							}
				case 'rejected':{
								$eventObject->backgroundColor = "blue" ;
								$eventObject->textColor = 'white !important';
								$eventObject->className = 'eventClass';
								//$eventObject->overlap= false;
								break;
							}
			}
			array_push($eventData,$eventObject);
		
			
			$i++;
		}
		echo json_encode($eventData);exit;
	
		
	}
	
}//End Of Controller class