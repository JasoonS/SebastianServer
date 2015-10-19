<?php 

class Uploadprofilepic extends CI_Controller
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
		$data['action'] = 'admin/Uploadprofilepic/uploadPic';
		//$this->data['Hotels'] = $this->Hotel_model->get_hotels();
		
		$this->template->load('page_tpl','uploadprofilepic_vw',$data);
		//print_r($this->session->userdata('logged_in_user')->sb_hotel_user_pic);
	}

	public function uploadPic()
    { 
	    if(!empty($_FILES['sb_hotel_user_pic']['name']))
				{
					$folderName=HOTEL_USER_PIC;
					$pic1 = upload_image($folderName,"sb_hotel_user_pic");
					if($pic1 != 0)
					{
						$data["sb_hotel_user_pic"] = $pic1;
						$edit= array(
							'sb_hotel_user_pic'=>$pic1
						);
						
						$this->uploadprofilepic_model->uploadPic($edit);
					}	
				} 
		
			      
			$this->session->userdata('logged_in_user')->sb_hotel_user_pic=$edit['sb_hotel_user_pic'];      
			$this->session->set_flashdata('UPLOAD_PROFILEPIC_SUCCESS', UPLOAD_PROFILEPIC_SUCCESS);
			redirect('admin/uploadprofilepic');
	}
	/* Method render Uplaod Image After submission Of uploadProfilePic_form
	* @param image_name
	* return void
	*/

}













