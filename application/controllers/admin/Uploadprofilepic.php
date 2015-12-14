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
    	//include('inc/s3_config.php');
		//$bucket = 'akshaytestbucket';
		$old_pic_name = $this->input->post('pic_name');
		$sb_hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
	    if(!empty($_FILES['sb_hotel_user_pic']['name']))
		{
			// $tempFile = $_FILES['sb_hotel_user_pic']['tmp_name'];
			// $ext = $this->getExtension($_FILES['sb_hotel_user_pic']['name']);
			// $fileName = $sb_hotel_user_id."_profilepic_".time().".".$ext;
			// $targetFile = $targetPath . $fileName ;
			
			// if($s3->putObjectFile($tempFile, BUCKET, $fileName, S3::ACL_PUBLIC_READ) )
   //          {
   //          	if($old_pic_name !="")
   //          		$result = $s3->deleteObject(BUCKET,$old_pic_name);
            	
   //          	$edit= array(
			// 		'sb_hotel_user_pic'=>$fileName
			// 	);
		
			// 	$this->uploadprofilepic_model->uploadPic($edit,$sb_hotel_user_id);
   //          }
           
			//$folderName=HOTEL_USER_PIC;
			$folderName = $sb_hotel_user_id."_profilepic_";
			$pic1 = upload_image($folderName,"sb_hotel_user_pic");
			if($pic1 != 0)
			{
				if($old_pic_name !="")
					$one = delete_oldpic($old_pic_name);
				$data["sb_hotel_user_pic"] = $pic1;
				$edit= array(
					'sb_hotel_user_pic'=>$pic1
				);
		
				$this->uploadprofilepic_model->uploadPic($edit,$sb_hotel_user_id);
			}	
		} 
		
			      
		$this->session->userdata('logged_in_user')->sb_hotel_user_pic=$edit['sb_hotel_user_pic'];      
		$this->session->set_flashdata('UPLOAD_PROFILEPIC_SUCCESS', UPLOAD_PROFILEPIC_SUCCESS);
		redirect('admin/uploadprofilepic');
	}
	
	function getExtension($str) 
	{
		$i = strrpos($str,".");
		if (!$i) { return ""; }
		$l = strlen($str) - $i;
		$ext = substr($str,$i+1,$l);
		return $ext;
	}

}













