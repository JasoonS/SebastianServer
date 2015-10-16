<?php if(!(defined('BASEPATH'))) exit('No cross scripting is allowed');
	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('addProperty/Createadmin');
			$this->load->model('User_model');
			$this->load->helper('admin/utility');	
			if($this->session->userdata('addproperty_id')=='')
			{
				redirect("addProperty/Hotel");
			}
		}
		/*
		 * Auto password creation
		 * Data insertion
		 * Email-Username and password
		 */
		function index()
		{
			$data = array();
			if($this->input->post('submit'))
			{
				$this->load->library('form_validation');
				$this->load->helper('form');
				$this->form_validation->set_rules('email', 'User Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('name', 'User Name', 'trim|required|callback_user_name');
				if ($this->form_validation->run() == FALSE)
				{
				 	$this->load->view('addProperty/create_admin',$data); 
				}
				else
				{
					// Usage example
					$randstr = $this->randStrGen(10);
					$randstr;
					$pwd = createHashAndSalt($randstr); 
					$to = $this->input->post('email');
					$subject = "Your credentials for Sabastian";
					$message = "User Name:".$this->input->post('name')."<br> Password:".$randstr;
					$mail=sendMail("",$to,$subject,$message); 
						
					$postdata=$this->input->post();
					$picture = "";
					if(!empty($_FILES['sb_hotel_user_pic']['name']))
					{
						$folderName=HOTEL_USER_PIC;
						$pic1 = upload_image($folderName,"sb_hotel_user_pic");
						if($pic1 != 0)
						{
							$picture = $pic1;
						}	
					}
                    $data = array(
									'sb_hotel_username' => $postdata['name'],
									'sb_hotel_useremail' => $postdata['email'],
									'sb_hotel_userpasswd' => $pwd,
									'sb_hotel_user_type' => 'a',
									'sb_hotel_user_status'=>'1',
									'sb_hotel_id' => $this->session->userdata('addproperty_id'),
									'sb_hotel_user_pic'=>$picture
							);					
					$result = $this->Createadmin->createadmin($data);
					//Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$result,
										'sb_roleid'=>'2',
										'sb_user_role_status'=>'1'
									);
                     									
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$role_modules=$this->User_model->get_role_modules(2);
					$permarray=array();
					$i=0;
					while($i<count($role_modules))
					{
					    array_push($permarray,$role_modules[$i]['sb_mod_id']);
						$i++;
					}
					
					$count=0;
					while($count<count($permarray)){
						$singlearray=array(
										'sb_hotel_user_id'=>$result,
										'sb_mod_id'=>$permarray[$count],
										'sb_user_mod_val'=>'1'
									);
						array_push($user_module_array,$singlearray);
						$count++;
					}
					$this->User_model->set_user_permissions($user_module_array);
				
                    
					
					if($result>1)
					{
					    
						$this->session->set_userdata('admin_admin');
						
						redirect('addProperty/Upload');
					}
					else
						{
							echo "Not inserted";	
						}
				}
			}
			else{
				$this->load->view('addProperty/create_admin',$data);
				}
		}
		/*This function validate if username is unique
		*input string 
		*output boolean
		*/	
		function user_name($field_value)
		{	
	   		$result=$this->Createadmin->find_user($field_value);
			if($result[0]['usercount'] == 0)
	   			{
		 			return TRUE;
	   			}
	   		else
	   			{
	   				$this->form_validation->set_message('user_name','User already Exists');
			 		return FALSE;
	   			}
		}
		/*This function is to generate random password for hotel administrator
		*input int
		*output string
		*/	
		function randStrGen($len){ 
				$result = ""; 
				$chars = "abcdefghijklmnopqrstuvwxyz?!-0123456789"; 
				$charArray = str_split($chars); 
				for($i = 0; $i < $len; $i++)
				{ 
					$randItem = array_rand($charArray); 
					$result .= "".$charArray[$randItem]; 
				} 
			return $result; 
		}	
	}
		
		
?>
