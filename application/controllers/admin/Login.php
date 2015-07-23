<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public	$data 					= array();
	public	$validation_rules 		= array();
	public	$login_flag				= FALSE;
	private $logged_in_user_meta 	= array();
	private $user_name 				= '';
	private $start_chk_admin 		= FALSE;
	private $start_chk_user			= FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->helper('admin/utility_helper');
	}
	
	/* Method render login page
	 * @param void
	 * return void
	 */
	public function index()
	{	
		$this->data['action']	= "admin/login/verify_user";	
		$this->template->load('login_tpl', 'login_vw',$this->data);
	}
	
	/* Method authenticate user and verify user type
	 * @param 	void
	 * return  boolean TRUE/FALSE
	 */
	public function verify_user()
	{
		//Setting up validation rules for form inputs
		$this->validation_rules = array(
		array('field'=>'username','label'=>'Username','rules'=>'required','class'=>'text-danger'),
		array('field'=>'password','label'=>'Password','rules'=>'required','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/login/verify_user";	
			$this->template->load('login_tpl', 'login_vw',$this->data);
		}else
		{
			// Authenticate user by performing below steps
			//1. check if he is admin by checking user name and password
			// if admin switch to admin dashboard
			//2. Else it is hotel user and check for its hotel credentials


			$password_salt = $this->get_password_salt();

			if($password_salt['hashed_salt'] == TRUE)
			{
				$this->authenticate_user_login($password_salt);
			} else
			{
				redirect();
			}
		}		
	}

	/* Method return password salt
	 * after verifying user name in both 
	 * tables
	 * @param void
	 * return array
	 */	
	public function get_password_salt()
	{

		//verifyPasswordHash($this->input->post('password'));

		//exit;
		$admin_password_salt 		= $this->User_model->authenticate_user_salt('admin_password_salt','sb_admin',array('admin_uname'=>$this->input->post('username')));


		if($admin_password_salt === FALSE)
		{
			$hoteleir_password_salt = $this->User_model->authenticate_user_salt('sb_hotel_userpasswd','sb_hotel_users',array('sb_hotel_username'=>$this->input->post('username')));

			return array('start_chk_hoteleir'=>TRUE,'hashed_salt'=>$hoteleir_password_salt);
		}

		return array('start_chk_admin'=>TRUE,'hashed_salt'=>$admin_password_salt);
	}

	/* Method authenticate user 
	 * after verifying user name and
	 * provided password
	 * @param array
	 * return array
	 */
	private function authenticate_user_login($password_salt_n_type = null)
	{

		// Admin password authentication
		if($password_salt_n_type['start_chk_admin'] === TRUE)
		{
			if(verifyPasswordHash($this->input->post('password'),$password_salt_n_type['hashed_salt']->admin_password_salt) == TRUE)
			{
				$user_type				  = 'A';
				$logged_in_user 		  =  $this->User_model->authenticated_admin_records($this->input->post('username'),$password_salt_n_type['hashed_salt']->admin_password_salt);
				die('password correct for admin');
			}else
			{
				die('wrong password for admin');
			}
		}else // Hotelier password verification
		{
			if(verifyPasswordHash($this->input->post('password'),$password_salt_n_type['hashed_salt']->admin_password_salt) == TRUE)
			{
				$user_type 				  = 'H';
				$logged_in_user 		  = $this->User_model->authenticated_hoteleir_records($this->input->post('username'),$password_salt_n_type['hashed_salt']->admin_password_salt);
				die('password correct for hotelier');
			}else
			{
				die('wrong password for hotel');
			}
		}

		$this->register_user_session($user_type,$logged_in_user);
	}

	/* Method start login session by assigning
	 * session variables 
	 * @param string,array
	 * return void
	 */
	private function register_user_session($user_type,$logged_in_user)
	{

		//Creating custom array to store in sessions
		if($user_type === 'A')
		{
			$user_session_records = array('user_name' 			=> $logged_in_user->admin_uname,
										  'user_email' 			=>	$logged_in_user->admin_email,
										  'user_type'	 		=>  $logged_in_user->admin_type,
										  'user_last_logged_in'	=>  $logged_in_user->admin_last_logged_in,
										  'logged_in_type'		=> $user_type );
		}else
		{
			$user_session_records = array('user_name'    		=> $logged_in_user->admin_uname,
										  'user_email' 			=>	$logged_in_user->admin_email,
										  'user_type'	 		=>  $logged_in_user->admin_type,
										  'user_last_logged_in'	=>  $logged_in_user->admin_last_logged_in);
		}

		$this->session->set_userdata($user_session_records);
	}
}

