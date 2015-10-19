<?php
/* Recover controller class 
 * perform tasks and checks related to admin users password recovery and changes
 * 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Recover extends CI_Controller 
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
		$this->load->model('Hotel_model');
		$this->load->helper('admin/utility_helper');
	}
	/* Method render recovery page
	 * @param void
	 * return void
	 */
	public function index()
	{	
		$this->data['action']	= "admin/recover/verify_email";
		$this->data['title']="Find Your Account";	
		$this->template->load('login_tpl', 'recovery_vw',$this->data);
	}
	
	/* Method authenticate email if such administrator user is present or not.
	 * @param 	void
	 * return  boolean TRUE/FALSE
	 */
	public function verify_email()
	{
		//Setting up validation rules for form inputs
		$this->validation_rules = array(
		array('field'=>'username','label'=>'username','rules'=>'required|callback_validate_hoteluser','class'=>'text-danger'),
				);
		$this->form_validation->set_error_delimiters('<div class="bg-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hoteluser','Hotel User with this username is not exist.');
		//$this->form_validation->set_message('valid_email','Please Enter Valid Email.');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "/login/verify_user";	
			$this->template->load('login_tpl', 'recovery_vw',$this->data);
		}else
		{
			//Get User Id From Email
			$user_info = $this->User_model->get_user_by_name($this->input->post('username'));
			$user_id=$user_info[0]['sb_hotel_user_id'];
			$hotelusername=$user_info[0]['sb_hotel_username'];
			$password =randomPassword();
			$hotel_user_data=array();
			$hotel_user_data['sb_hotel_userpasswd']=createHashAndSalt($password);
			$result=$this->Hotel_model->edit_hotel_user($hotel_user_data,$user_id);
			$data=array();
			$data['password']=$password;
			$data['hotelusername']=$hotelusername;
			$message = $this->load->view('email/forgotpassword',$data,TRUE);
			sendMail('no-reply@sebastian.com',$user_info[0]['sb_hotel_useremail'],"Forgot Password",$message);
			$this->session->set_flashdata('SuccMsg',SUC_MSG_LEVEL_2);	
			redirect('admin/login');
		}		
	}
	/*
	This method returns Whether Hotel User With The particular name Already Exists
	@param -String (Name Of Hotel User)
	@return boolean
	*/
	
	function validate_hoteluser($field_value)
	{
	   $result=$this->Hotel_model->find_hotel_user_by_name($field_value);
	   if($result[0]['hotelusercount'] == 0)
	   {
		 return FALSE;
	   }
	   else
	   {
		 return TRUE;
	   }
	} 
  
    /*
	This method returns Whether Hotel User With The particular email Already Exists
	@param -String (Email Of Hotel User)
	@return boolean
	*/
	
	function validate_hoteluseremail($field_value)
	{
	   $result=$this->Hotel_model->find_hotel_user_by_email($field_value);
	   if($result[0]['hotelusercount'] == 0)
	   {
			return FALSE;
	   }
	   else
	   {
			return TRUE;
	   }
	}

}//End Of Controller Class.

