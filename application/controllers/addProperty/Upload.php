<?php if(!defined('BASEPATH')) exit('No cross scripting is alowed');
	class Upload extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('addProperty/File_upload');
			$this->load->model('User_model');
			if($this->session->userdata('addproperty_id')=='')
			{
				redirect("addProperty/Hotel");
			}
		}
		
		function index()
		{
			$data = array();
			if($this->input->post('submit'))
			{
					if($_FILES['upload']['size'][0]==0)
					{
						$data['error'] = "At least one file needed";
					}
					else
					{
						//Call to helper function for multiple upload	
						$num = FLOOR(RAND() * 101);
						multiple_upload($_FILES,APPPATH.'../user_data/hotel_pic/',$num);
						//Insertion of Multiple data
						$data = array();	
						for($i=0;$i<count($_FILES['upload']['name']);$i++)
						{
							$path = $_FILES['upload']['name'][$i];
							$ext = pathinfo($path, PATHINFO_EXTENSION);

							$singleArray =array('hotel_id'=>$this->session->userdata('addproperty_id'),'sb_hotel_pic'=>$num.".".$ext);			
							array_push($data,$singleArray);
							$num++;	
						}
						$result=$this->File_upload->upload('sb_hotel_album',$data);
						if($result==1)
						{
							$this->session->sess_destroy();
							redirect('addProperty/Hotel');
						}
			
					}
			}
			else{
					$to_mails=$this->User_model->get_all_active_superadministrators();
					$toarray=array();			
					$emailData['hotel_name']=$this->session->userdata('property_name');
					$message1 = $this->load->view('email/hotelcreationnotification',$emailData,TRUE);					
					$counter=0;
					while($counter<count($to_mails))
					{
						array_push($toarray,$to_mails[$counter]['sb_hotel_useremail']);
						$counter++;
					}
					
					$mail1=sendBulkMail('',$toarray,"New Hotel Created",$message1);
					$this->load->view('addProperty/uploadImage',$data);
				}
			}
	}
?>