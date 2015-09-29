<?php if(!defined('BASEPATH')) exit('No direct access is allowed');
		class Email extends CI_Controller
		{
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
			function index()
			{
				//$this->load->view('email_view/email_view');
				$this->data['title']="Email";
				//print_r($this->session->all_userdata());
				//die;
				$this->template->load('page_tpl','email_view/email_view',$this->data);
			}
		}	
?>
