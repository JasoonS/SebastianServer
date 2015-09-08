<?php if(!(defined('BASEPATH'))) exit('No cross scripting is allowed');
	class Admin extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('addProperty/Createadmin');			
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
					
				function randStrGen($len){ $result = ""; 
				$chars = "abcdefghijklmnopqrstuvwxyz?!-0123456789"; $charArray = str_split($chars); for($i = 0; $i < $len; $i++){ $randItem = array_rand($charArray); $result .= "".$charArray[$randItem]; } return $result; } // Usage example
				$randstr = randStrGen(5);
				$randstr;
				
				
				$pwd = createHashAndSalt($randstr); 
				$to = $this->input->post('email');
				$subject = "Your credentials for Sabastian";
				$message = "User Name:".$this->input->post('email')."<br> Password:".$randstr;
				$mail=sendMail("",$to,$subject,$message);
					 
					$result = $this->Createadmin->createadmin($this->input->post(),$pwd,$this->session->userdata('addproperty_id'));
					print_r($result);
					if($result==1)
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
				$this->load->view('addProperty/create_admin',$data);
			}

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
			
		}
	
?>
