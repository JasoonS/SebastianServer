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
					$this->load->model('email/Email_mod');
				}
			}
		
		
		function index()
		{
			//$this->load->view('email_view/email_view');
			$this->data['title']="Email";
			/*if($this->session->userdata('logged_in_user')->sb_hotel_user_type=='u')
			{
				($this->data['names'] = $this->Email_mod->get_username('a'));
			}
			elseif($this->session->userdata('logged_in_user')->sb_hotel_user_type=='a')
			{
				($this->data['names'] = $this->Email_mod->get_username('u'));
			}*/
			$this->data['names']=$this->Email_mod->getAllEmails();
			//print_r($this->data['names']);exit;
			$this->template->load('page_tpl','email_view/email_view',$this->data);
		}	
		function staff_email()
		{
			//$this->load->view('email_view/email_view');
			$this->data['title']="Email";
			/*if($this->session->userdata('logged_in_user')->sb_hotel_user_type=='u')
			{
				($this->data['names'] = $this->Email_mod->get_username('a'));
			}
			elseif($this->session->userdata('logged_in_user')->sb_hotel_user_type=='a')
			{
				($this->data['names'] = $this->Email_mod->get_username('u'));
			}*/
			$this->data['names']=$this->Email_mod->getAllEmails();
			//print_r($this->data['names']);exit;
			$this->template->load('page_tpl','email_view/email_view',$this->data);
		}	
		function sebastian_email()
		{
			//$this->load->view('email_view/email_view');
			$this->data['title']="Email";
			/*if($this->session->userdata('logged_in_user')->sb_hotel_user_type=='u')
			{
				($this->data['names'] = $this->Email_mod->get_username('a'));
			}
			elseif($this->session->userdata('logged_in_user')->sb_hotel_user_type=='a')
			{
				($this->data['names'] = $this->Email_mod->get_username('u'));
			}*/
			$this->data['names']=$this->Email_mod->getAllEmails();
			//print_r($this->data['names']);exit;
			$this->template->load('page_tpl','email_view/email_view',$this->data);
		}		
			
		function get_email()
		{
			$result = $this->Email_mod->get_mail($this->input->post('ID'));
			$html = array();
			array_push($html,$result->email_from,$result->email_subject,$result->email_message,$result->email_time);			
			echo json_encode($html);
		}
		function compose(){
		    $this->data['title']="Compose Mail";
			$this->template->load('page_tpl','email_view/compose_email',$this->data);
			//echo "We need to Show the compose email View here";exit;
		}
		function reply()
		{
				$this->data['title']="Compose Mail";
				if($this->input->post('send'))
				{
					$this->load->library('form_validation');
					$this->load->helper('form');
					$this->form_validation->set_rules('receiver', 'To', 'required|valid_email');
					$this->form_validation->set_rules('subject', 'Subject', 'required');
					$this->form_validation->set_rules('message', 'Message', 'required');
					$this->form_validation->set_error_delimiters('<div class="text-danger" style="margin-left:150px;">', '</div>');
					if ($this->form_validation->run() == FALSE)
					{
				 	
					}
					else
					{
						$get = $this->Email_mod->email_details($this->input->post());
						/*if($get==1)
						{
							redirect('admin/Email');
						}*/
					}
			}
		  $this->template->load('page_tpl','email/reply_email');
		}			
	}	
?>
