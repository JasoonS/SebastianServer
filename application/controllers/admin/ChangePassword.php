<?php
class ChangePassword extends CI_Controller
{
	public function __construct(){

		parent:: __construct();
		$this->load->model('changepassword_model');
		$this->load->helper('admin/utility_helper');
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
	public function index(){
		$data['title']  = 'Change Password';
		$data['action'] = 'admin/changePassword/change_password';
		//$this->data['Hotels'] = $this->Hotel_model->get_hotels();
		$this->template->load('page_tpl','change_password_vw',$data);
	}

	/* Method render Change Password View If User is Hotel Admin
	 * @param void
	 * return void
	 */

	public function change_password(){
		$old_password=$this->input->post('old_password');
		$new_password=$this->input->post('new_password');
		$arr=array();
		$arr['sb_hotel_user_id']=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
		//print_r($arr);
		$password = $this->changepassword_model->check_user($arr);
		//print_r($password);
		if(verifyPasswordHash($old_password,$password[0]['sb_hotel_userpasswd']) == TRUE)
		{		
			$arr1['sb_hotel_userpasswd']= createHashAndSalt($new_password);
			$user_info1 = $this->changepassword_model->update_user($arr1,$arr);
			$this->session->set_flashdata('change_success',PASSWORD_CHANGE_SUCCESS);
		}
		else
		{
			$this->session->set_flashdata('change_fail',PASSWORD_CHANGE_FAIL);
		}		
		redirect('admin/changePassword');
	}

/* Method render Change Password after submission of form changePassword_form
	 * @param old_password, new_password
	 * return void
	 */
}