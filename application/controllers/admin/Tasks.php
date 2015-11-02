<?php
/* Dashboard display user dashboard
 * according to inheriated/assigned access levels
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Tasks extends CI_Controller 
{
	public $user_acl = array();
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Tasks_model');
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
	public function task_details()
	{	
		$data['title'] = "Task Details";
		// $requested_mod = $this->uri->segment(2);
	
		// if(!$this->acl->hasPermission($requested_mod))
		// {
		// 	redirect('admin/dashboard');
		// }
		/*$this->data['hotel_user_id']=$hotel_user_id;
		$this->data['hotel_user_name']=$this->User_model->get_user_name($hotel_user_id)->sb_hotel_username;
		$this->data['parent_service_id']=$this->User_model->get_user_parent_service($hotel_user_id)->sb_parent_service_id;
		$other_staff = $this->User_model->get_staff($this->data['parent_service_id']);
		$this->data['other_staff']=$other_staff;*/
		$sb_hotel_requst_ser_id = $this->input->post("sb_hotel_requst_ser_id");
		$sb_hotel_id = $this->session->userdata('logged_in_user')->sb_hotel_id;
		$task_details=$this->Tasks_model->task_details($sb_hotel_requst_ser_id);
		if(count($task_details)>0)
		{
			$hotel = $task_details[0]['sb_hotel_id'];
			if($hotel == $sb_hotel_id)
			{
				$data['task_details'] =$task_details;
				$staff = $this->Tasks_model->get_parentStaff($sb_hotel_id,$task_details[0]['sb_parent_service_id']);
				$data['staff']=$staff;
				$this->template->load('page_tpl','task_details',$data);
			}
			else
			{
				redirect('admin/dashboard');
			}
		}
		else
		{
			redirect('admin/dashboard');
		}
	}

	public function action()
	{
		
		$update_data = $this->input->post();
		$sb_hotel_requst_ser_id = $update_data['sb_hotel_requst_ser_id'];
		unset($update_data['sb_hotel_requst_ser_id']);
		if($update_data['action']=='accept')
		{
			unset($update_data['action']);
			$update_data['sb_hotel_service_assigned']='y';
			$update_data['sb_hotel_service_status']='accepted';
		}
		else if($update_data['action']=='complete')
		{
			unset($update_data['action']);
			$update_data['sb_hotel_service_assigned']='y';
			$update_data['sb_hotel_service_status']='completed';
		}
		else
		{
			unset($update_data['action']);
			$update_data['sb_hotel_service_assigned']='n';
			$update_data['sb_hotel_service_status']='rejected';
			$update_data['sb_hotel_ser_assgnd_to_user_id']=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
		}
		$reply = $this->Tasks_model->update_task_status($update_data,$sb_hotel_requst_ser_id);
		redirect('admin/dashboard');
	}
	
}//End Of Controller class