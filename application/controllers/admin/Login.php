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
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
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
			
			//$query = $this->db->get_where('mytable', array('id' => $id), $limit, $offset);
			$this->password_salt	= $this->User_model->authenticate_user('admin_password_salt','sb_admin',array('admin_uname'=>$this->input->post('username')));
			
			if($this->password_salt == TRUE)
			{
				die('if');
			}else 
			{
				$this->password_salt	= $this->User_model->authenticate_user('admin_password_salt','sb_admin',array('admin_uname'=>$this->input->post('username')));
			}
		}
			
	}	
}

