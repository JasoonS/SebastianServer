<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin/utility');
	}
	/*
		This function is used to upload images
	*/
public function upload_image($folderName)
	{
		$file_ext = substr(strrchr($_FILES[$folderName]['name'],'.'),1);
		$name= time();
		$config = array(
				'upload_path' => "./user_data/$folderName",
				'allowed_types' => "jpeg|jpg|png|gif",
				'overwrite' => TRUE,
				'file_name' => $name.".".$file_ext
			);
		$this->load->library('upload', $config);
		if($this->upload->do_upload($folderName))
		{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	}
		
	

}

