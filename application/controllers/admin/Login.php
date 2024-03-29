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
	public  $password_salt 			= '';
	private $logged_in_user_meta 	= array();
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->helper('admin/utility_helper');
	}
	/* Method render login page
	 * @param void
	 * return void
	 */
	public function index()
	{	
		$this->data['action']	= "admin/login/verify_user";
		$this->data['title']="Login";	
		$this->template->load('login_tpl', 'login_vw',$this->data);
	}
	
	/* Method authenticate user and verify user type
	 * @param 	void
	 * return  boolean TRUE/FALSE
	 */
	public function verify_user()
	{
		header('Access-Control-Allow-Origin: *');
		
		//Setting up validation rules for form inputs
		$this->validation_rules = array(
		array('field'=>'username','label'=>'Username','rules'=>'required','class'=>'text-danger'),
		array('field'=>'password','label'=>'Password','rules'=>'required','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="bg-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "/login/verify_user";	
			$this->template->load('login_tpl', 'login_vw',$this->data);
		}else
		{
			// Authenticate user by performing below steps
			//1. check if he is admin by checking user name and password
			// if admin switch to admin dashboard
			//2. Else it is hotel user and check for its hotel credentials
			$this->password_salt = $this->get_password_salt();
			$this->authenticate_user_login();
		}		
	}

	/* Method return password salt
	 * after verifying user name in both 
	 * tables
	 * @param void
	 * return object
	 */	
	public function get_password_salt()
	{
		$admin_password_salt = $this->User_model->authenticate_user_salt('sb_hotel_userpasswd','sb_hotel_users',array('sb_hotel_username'=>$this->input->post('username'),"sb_hotel_user_status"=>"1"));
		if($admin_password_salt === FALSE)
		{
			$this->redirectWithErrMsg(ERR_MSG_LEVEL_1);
		}
		return $admin_password_salt;
	}

	/* Method authenticate user 
	 * after verifying user name and
	 * provided password
	 * @param array
	 * return array
	 */
	private function authenticate_user_login()
	{
		if(is_object($this->password_salt))
		{
			if(verifyPasswordHash($this->input->post('password'),$this->password_salt->sb_hotel_userpasswd) === TRUE)
			{
				$this->logged_in_user_meta 	=  $this->User_model->authenticated_hoteleir_records($this->input->post('username'),$this->password_salt->sb_hotel_userpasswd);
			}
			else
			{
				$this->redirectWithErrMsg(ERR_MSG_LEVEL_1);
			}	
		}
		$this->register_user_session();
	}

	/* Method start login session by assigning
	 * session variables 
	 * @param string,array
	 * return void
	 */
	private function register_user_session()
	{
		$this->session->set_userdata('logged_in_user',$this->logged_in_user_meta);
		if ($this->input->post('site') != 'api') {
			redirect('admin/dashboard');
		}
	}

	/* Method redirect user if auhorization
	 * fails during login activity
	 * @param void
	 * return void
	 */
	private function redirectWithErrMsg($err_level)
	{
		$this->session->set_flashdata('AuthMsg', $err_level);
		if ($this->input->post('site') != 'api') {
			redirect('admin/login');
		}
	}

	/* Method destroy logged in
	 * user session and redirect to page
	 * @param void
	 * return void
	 */
	public function logout()
	{
		$this->session->unset_userdata('logged_in_user');
		$this->session->set_flashdata('SuccMsg',SUC_MSG_LEVEL_1);
		if ($this->input->post('site') != 'api') {
			redirect('admin/login');
		}
	}
}//End Of Controller Class.

