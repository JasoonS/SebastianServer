<?php
/* User controller class 
 * perform crud of hotel userss
 * all user related
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
	public $user_acl = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hotel_model');
		$this->load->model('User_model');
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

	public function type($user_type = '')
	{
		
		$requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		
		// If user is admin get hotel list and then after selection list out admins
		
		// If user is hotel admin , he can see all managers and staff
		
		// If manager then show him staff under him
		
		// Staff cant access this module
		

		if(($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u'))
		{
			$data['hotel_list'] = getAllHotels();
			$data['user_type']= 'u';
			$this->template->load('page_tpl', 'hotel_user_list',$data);
		}
		
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'a')
		{
			$data['user_type']= 'a';
			$data['sb_hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
			$data['sb_hotel_name']=$this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
			$this->template->load('page_tpl', 'hotel_user_list',$data);
		}
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'm')
		{
			$data['user_type']= 'm';
			$data['sb_hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
			$data['sb_hotel_name']=$this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
			$this->template->load('page_tpl', 'hotel_user_list',$data);
		}
	}

    /*
	This method is used to authenticate while using session for Creating Hotel Admin Users
	*/
	function make_authentication_validation(){
	/*** If Logged In User is Super Administrator .He can create only Hotel Admins **/
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			    $this->data['hotellist']=getAllHotels();	
			  
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
                if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}	
                				
			    
			}
			
			/*** If Logged In User is Hotel Administrator .He can create only Managers **/
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'a')
		    {
				$this->data['title'] = LABEL_1;
				$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			    $this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
				$this->data['sb_hotel_name']=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
				
                if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('a',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}	
                				
			   
			}
			
			/*** If Logged In User is Hotel Manager .He can create only Staff **/
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'm')
		    {
				$this->data['title'] = LABEL_1;
				$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			    $this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
				$this->data['sb_hotel_name']=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
                if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('a',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}	
                				
			   
			}
	}
	/*
	This method is used to create Hotel administrator view
	*/
	function add_hotel_user($hotel_id= '')
	{
			$this->data['action']	= "admin/user/create_hotel_admin_user/".$hotel_id;
			$this->make_authentication_validation();
		    $this->template->load('page_tpl', 'create_hotel_admin_user',$this->data); 
			
	}
	/*
	This method is used to create Hotel administrator/manager
	*/
	
	function  create_hotel_admin_user()
	{
		$data = $this->input->post();
		//Verify Hotel Data
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_username','label'=>'Hotel User','rules'=>'required|callback_validate_hoteluser','class'=>'text-danger'),
		    array('field'=>'sb_hotel_useremail','label'=>'Hotel User Email','rules'=>'required|valid_email|callback_validate_hoteluseremail','class'=>'text-danger'),
		    array('field'=>'sb_hotel_user_shift_from','label'=>'Hotel User Shift From','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_user_shift_to','label'=>'Hotel User Shift To','rules'=>'required','class'=>'text-danger'),
			
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hoteluser','Hotel User with this name is already Exists.');
		$this->form_validation->set_message('validate_hoteluseremail','Hotel User with this email is already Exists.');
		$this->form_validation->set_message('valid_email','Please Enter Valid Email.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->make_authentication_validation();
			
		}else{
		        $this->make_authentication_validation();
				$data["sb_hotel_user_pic"] = "";
				
		        if(!empty($_FILES['sb_hotel_user_pic']['name']))
				{

					$folderName=HOTEL_USER_PIC;
					$pic1 = upload_image($folderName,"sb_hotel_user_pic");
				

					if($pic1 != 0)
					{
						$data["sb_hotel_user_pic"] = $pic1;
					}	
				} 
				$data['sb_hotel_user_status']='0';
				if(isset($data['sb_hotel_user_status']))
					{
						$data['sb_hotel_user_status']='1';
					}
                if(isset($data['sb_hotel_id']))
                {    				
					$hotelname = $this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
					
				}
				else
				{
					$hotelname=$this->Hotel_model->get_hotel_name($this->session->userdata('logged_in_user')->sb_hotel_id);
					$data['sb_hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
				}
				$password =$hotelname[0]['sb_hotel_name'];
				$password = str_replace(' ', '', $password);
				$data['sb_hotel_userpasswd']=createHashAndSalt($password);
				$data['sb_hotel_user_shift_from']= date("H:i:s", strtotime($data['sb_hotel_user_shift_from']));
				$data['sb_hotel_user_shift_to']= date("H:i:s", strtotime($data['sb_hotel_user_shift_to']));
				
				$result=$this->Hotel_model->create_hotel_user($data);
                //We need to Add User Permissions HERE in db //
			
				if($data['sb_hotel_user_type'] == 'a')
				{
				    //Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$result,
										'sb_roleid'=>'2',
										'sb_user_role_status'=>'1'
									);
                     									
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$permarray=array('5','7');
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
				}
				if($data['sb_hotel_user_type'] == 'm')
				{
				    //Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$result,
										'sb_roleid'=>'3',
										'sb_user_role_status'=>'1'
								
									);
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$permarray=array('7');
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
				}
				
				$hotelusername=$data['sb_hotel_username'];
				$message="Hi ,
							Congratulations Your user account is created on sebastian.
							Account Details are
							User Name =  $hotelusername
							Password = $password
							
							Thanks
						";
				sendMail('no-reply@sebastian.com',$data[sb_hotel_useremail],"Administrator Account Creation",$message);
				if($result > '0')
				{
					$this->session->set_flashdata('category_success', HOTEL_ADMIN_CREATION_SUCCESS);
					redirect('admin/user/add_hotel_user');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Administrator Creation.');
					redirect('admin/user/add_hotel_user');
				}
			}
	}
	
	/*
	This method returns Whether Hotel User With The particular name Already Exists
	*/
	
	function validate_hoteluser($field_value)
	{
	   
	   $result=$this->Hotel_model->find_hotel_user_by_name($field_value);

	   if($result[0]['hotelusercount'] == 0)
	   {
		 return TRUE;
	   }
	   else
	   {
		 return FALSE;
	   }
	}
	
	/*
	This method returns Whether Hotel User With The particular email Already Exists
	*/
	
	function validate_hoteluseremail($field_value)
	{
	   
	   $result=$this->Hotel_model->find_hotel_user_by_email($field_value);

	   if($result[0]['hotelusercount'] == 0)
	   {
		 return TRUE;
	   }
	   else
	   {
		 return FALSE;
	   }
	}
	
	
	/* Method render User Information 
	 * @param int
	 * return void
	 */
	public function view_hotel_user($user_id)
	{	
		
		$this->data['action']	= "admin/user/view_hotel_users";
	
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
	    {
			$this->data['title'] = LABEL_1;
			$this->data['userinfo']=$this->User_model->get_user_info($user_id);
			$this->template->load('page_tpl', 'view_hotel_user',$this->data);
		}
			
	}
}

