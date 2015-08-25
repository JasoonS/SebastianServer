<?php 

class UploadProfilePic extends CI_Controller
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->model("uploadprofilepic_model");
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



	public function index()
	{
		$data['title']  = 'Upload Profile Image';
		$data['action'] = 'admin/UploadProfilePic/uploadPic';
		//$this->data['Hotels'] = $this->Hotel_model->get_hotels();
		$this->template->load('page_tpl','uploadprofilepic_vw',$data);
		//print_r($this->session->userdata('logged_in_user')->sb_hotel_user_pic);
	}

	public function uploadPic()
    { 
		$file_ext=strtolower(substr(strrchr($_FILES['sb_hotel_user_pic']['name'],"."),1));
		$name=time();
		$_FILES['sb_hotel_user_pic']['name']=$name.".".$file_ext;
		$config['upload_path']='./user_data/hotel_user_pic/';
		$config['overwrite']=TRUE;
		$config['allowed_types']='jpeg|jpg|png|gif';
		// $config['max_width']='1024';
		// $config['max_height']='768';
		// $config['max_size']='100';
		$this->load->library('upload',$config);
		//print_r($_FILES);die;
		if($this->upload->do_upload('sb_hotel_user_pic'))
		{
			chmod($config['upload_path'] . '/' .$this->upload->file_name, 0777);
			$edit= array(
			'sb_hotel_user_pic'=>$this->upload->file_name

			);
			//print_r($edit);			
		 	//$this->session->set_userdata($this->session->userdata('logged_in_user')->sb_hotel_user_pic);           
			$this->uploadprofilepic_model->uploadPic($edit);      
			$this->session->userdata('logged_in_user')->sb_hotel_user_pic=$edit['sb_hotel_user_pic'];      
			$this->session->set_flashdata('UPLOAD_PROFILEPIC_SUCCESS', UPLOAD_PROFILEPIC_SUCCESS);
			//$this->session->keep_flashdata('edit_profile_flash');
			//redirect('admin/inbox_mail_con/index');
		 }
		else
		{
			$error=array('error'=>$this->upload->display_errors());
			//  print_r($error);die;
			$this->session->set_flashdata('UPLOAD_PROFILEPIC_FAIL', "Upload Fail");			
		}
		redirect('admin/uploadProfilePic/');
	}
	/* Method render Uplaod Image After submission Of uploadProfilePic_form
	* @param image_name
	* return void
	*/

}













