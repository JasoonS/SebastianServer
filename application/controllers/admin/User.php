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
		$this->load->model('Services_model');
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
	/*
	This method is used to Show Tables of Hotel Users according to their access permissions(1.Hotel Admin Users 2.Hotel Managers 3.Hotel Staff)
	@input - String(User Type)
	@output - List Of Adminside users.
	*/
	public function type($user_type = '')
	{
		$requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$data['grid_user_type']=$this->uri->segment(4);
		// If user is admin get hotel list and then after selection list out admins
		// If user is hotel admin , he can see all managers and staff
		// If manager then show him staff under him
		// Staff cant access this module
		if(($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u'))
		{
			$data['hotel_list'] 	= 	getAllHotels();
			$data['user_type']		= 	'u';
			$data['page_type']		=	$this->uri->segment(4);
			$data['title']			=   'Hotel Admins';
		}
		
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'a')
		{
			$data['user_type']		= 	'a';
			$data['page_type']		=	$this->uri->segment(4);
			$data['sb_hotel_id']	=	$this->session->userdata('logged_in_user')->sb_hotel_id;
			$data['parent_services']=$this->Services_model->get_hotel_selected_parent_services($data['sb_hotel_id']);
			$data['sb_hotel_name']	=	$this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
			$data['title']			=   'Hotel Users';
		}
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'm')
		{
			$data['user_type']		= 	'm';
			$data['page_type']		=	$this->uri->segment(4);
			$data['sb_hotel_id']	=	$this->session->userdata('logged_in_user')->sb_hotel_id;
			$data['parent_services']=   $this->Services_model->get_hotel_selected_parent_services($data['sb_hotel_id']);
			$data['sb_hotel_name']	=	$this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
			$data['title']			=   'Hotel Users';
		}
        if(($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')&&($requested_mod=='user/type/admin')){
			$data['title']			=   'Super Admins';
			$this->template->load('page_tpl', 'superadmin_user_list_vw',$data);
		}
		else{

			$this->template->load('page_tpl', 'hotel_user_list_vw',$data);
		}
	}

    /*
	This method is used to authenticate while using session for Creating Hotel Admin Users
	@input - none
	$output -none
	*/
	function make_authentication_validation(){
			/*** If Logged In User is Super Administrator .He can create only Hotel Admins **/
			$this->data['action_type']="create";
			
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			    $this->data['hotellist']=getAllHotels();	
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
				$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
				$this->data['user_id']=$hotel_user_id;
				if($this->data['hotel_id'] == 0)
				{
					$this->data['hotel_name']="None";
				}
				else{
					$result=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				
					$this->data['hotel_name']=$result[0]['sb_hotel_name'];
				}
				if($this->data['hotel_id'] == 0){
					
					if (($key = array_search('a',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
					}
				}
				else{
					if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
							unset($this->data['hotelusertypes'][$key]);
					}
				}
                if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				
			}
			/*** If Logged In User is Hotel Administrator .He can create only Managers **/
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'a')
		    {
				$this->data['title'] = LABEL_1;
				$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			    $this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
				$result=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				$this->data['hotel_name']=$result[0]['sb_hotel_name'];
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
				$this->data['designation_list']=$this->User_model->get_all_designations();
				$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
				$this->data['user_id']=$hotel_user_id;
				$this->data['parent_services']=$this->Services_model->get_hotel_unique_parent_services($this->data['hotel_id']);
                
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
				$result=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				$this->data['hotel_name']=$result[0]['sb_hotel_name'];
				$this->data['designation_list']=$this->User_model->get_all_designations();
				$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
				$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
				$this->data['user_id']=$hotel_user_id;
				$this->data['parent_services']=$this->Services_model->get_hotel_user_parent_service($hotel_user_id);
				
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
	This method is used to create Hotel User view
	@input - int(Id of Hotel)
    @output - none	
	*/
	function add_hotel_user($hotel_id= 0)
	{
       
		$this->data['action']	= "admin/user/create_hotel_admin_user/".$hotel_id;
		$this->data['title']	= 'Add hotel admin';
		$this->data['hotel_id']=$hotel_id;
		$this->load->model('Services_model');
		$this->data['parent_services']=$this->Services_model->get_hotel_unique_parent_services($hotel_id);
		$result=$this->Hotel_model->get_hotel_name($hotel_id);
		if($hotel_id == 0)
		{
			$this->data['hotel_name']="None";
		}
		else{
			$this->data['hotel_name']=$result[0]['sb_hotel_name'];
		}
		$this->make_authentication_validation();
		$this->template->load('page_tpl','create_hotel_admin_user',$this->data); 
			
	}
	/*
	This method is used to create Hotel administrator/manager/staff
	@param void
	@return void
	*/
	function  create_hotel_admin_user($hotel_id)
	{
		
		//Verify Hotel Data
		$data =$this->input->post();
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_username','label'=>'Hotel User','rules'=>'required|callback_validate_hoteluser','class'=>'text-danger'),
		    array('field'=>'sb_hotel_useremail','label'=>'Hotel User Email','rules'=>'required|valid_email','class'=>'text-danger'),
		    array('field'=>'sb_hotel_user_shift_from','label'=>'Hotel User Shift From','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_user_shift_to','label'=>'Hotel User Shift To','rules'=>'required','class'=>'text-danger'),
			
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hoteluser','Hotel User with this name is already Exists.');
		//$this->form_validation->set_message('validate_hoteluseremail','Hotel User with this email is already Exists.');
		$this->form_validation->set_message('valid_email','Please Enter Valid Email.');
		if ($this->form_validation->run() == FALSE)
		{
		    $this->data['hotel_id']=$hotel_id;
			$result=$this->Hotel_model->get_hotel_name($hotel_id);
			
			if($hotel_id == 0)
			{
				$this->data['hotel_name']="None";
			}
			else{
				$this->data['hotel_name']=$result[0]['sb_hotel_name'];
			}
			$this->make_authentication_validation();
			$this->data['action']	= "admin/user/create_hotel_admin_user/".$data['sb_hotel_id'];
			$this->template->load('page_tpl', 'create_hotel_admin_user',$this->data); 
			
		}else{
				$this->data['hotel_id']=$hotel_id;
				$result=$this->Hotel_model->get_hotel_name($hotel_id);	
					if($hotel_id == 0)
					{
						$this->data['hotel_name']="None";
					}
					else{
						$this->data['hotel_name']=$result[0]['sb_hotel_name'];
					}
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
				$password =randomPassword();
				//$password="password";
				$data['sb_hotel_userpasswd']=createHashAndSalt($password);
				$data['sb_hotel_user_shift_from']= date("H:i:s", strtotime($data['sb_hotel_user_shift_from']));
				$data['sb_hotel_user_shift_to']= date("H:i:s", strtotime($data['sb_hotel_user_shift_to']));
				if(!isset($data['sb_staff_designation_id']))
				{
					$data['sb_staff_designation_id']=0;
				}
				$hotel_user_data =array(
									'sb_hotel_username'=>$data['sb_hotel_username'],
									'sb_hotel_useremail'=>$data['sb_hotel_useremail'],
									'sb_hotel_user_shift_from'=>$data['sb_hotel_user_shift_from'],
									'sb_hotel_user_shift_to'=>$data['sb_hotel_user_shift_to'],
									'sb_hotel_user_status'=>'1',
									'sb_hotel_user_type'=>$data['sb_hotel_user_type'],
									'sb_staff_designation_id'=>$data['sb_staff_designation_id'],
									'sb_hotel_user_pic'=>$data['sb_hotel_user_pic'],
									'sb_hotel_id'=>$data['sb_hotel_id'],
									'sb_hotel_userpasswd'=>$data['sb_hotel_userpasswd']
								);	
				
				$result=$this->Hotel_model->create_hotel_user($hotel_user_data);
                //We need to Add User Permissions & Services From HERE in db //
				if($data['sb_hotel_user_type'] == 'u')
				{
				    //Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$result,
										'sb_roleid'=>'1',
										'sb_user_role_status'=>'1'
									);
                     									
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$role_modules=$this->User_model->get_role_modules(1);
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
				}
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
					$role_modules=$this->User_model->get_role_modules(3);
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
					//Get all child Services of particular parent service and of particular hotel
					$child_services=$this->Services_model->get_hotel_child_services_by_parent_service($data['sb_hotel_id'],$data['sb_parent_service_id']);	
				    $i=0;
					$insert_user_services=array();
					while($i<count($child_services)){
						$singlearray=array(
											'sb_hotel_service_map_id'=>$child_services[$i]['sb_hotel_service_map_id'],
											'sb_hotel_user_id'=>$result,
											'sb_parent_service_id'=>$data['sb_parent_service_id'],
											'sb_service_rel_status'=>'1'
										);
						array_push($insert_user_services,$singlearray);
						$i++;
					}
					$this->Services_model->set_services($insert_user_services,$result);
				}
				if($data['sb_hotel_user_type'] == 's'){
					if(!isset($data['sb_child_service_id']))
					{
						$data['sb_child_service_id']='0';
					}
					//$child_services=$this->Services_model->get_hotel_child_service_map_id($data['sb_hotel_id'],$data['sb_parent_service_id'],$data['sb_child_service_id']);
				    	$child_services=$this->Services_model->get_hotel_child_services_by_parent_service($data['sb_hotel_id'],$data['sb_parent_service_id']);	
					$i=0;
					$insert_user_services=array();
					while($i<count($child_services)){
						$singlearray=array(
											'sb_hotel_service_map_id'=>$child_services[$i]['sb_hotel_service_map_id'],
											'sb_hotel_user_id'=>$result,
											'sb_parent_service_id'=>$data['sb_parent_service_id'],
											'sb_service_rel_status'=>'1'
										);
						array_push($insert_user_services,$singlearray);
						$i++;
					}
					$this->Services_model->set_services($insert_user_services,$result);
				}
				$hotelusername=$data['sb_hotel_username'];
				$data['password']=$password;
				$data['hotelusername']=$hotelusername;
				
				if($data['sb_hotel_user_type'] == 's')
				{
					$message = $this->load->view('email/staffaccountcreation',$data,TRUE);
				}
				else{
					$message = $this->load->view('email/accountcreation',$data,TRUE);
				}	
				sendMail('no-reply@sebastian.com',$data[sb_hotel_useremail],"Administrator Account Creation",$message);
				//For Time being we are sending an email to developer.
				//sendMail('no-reply@sebastian.com',"kalyani.joshi@eeshana.com","Administrator Account Creation",$message);
				if($result > '0')
				{
					$this->session->set_flashdata('category_success', HOTEL_ADMIN_CREATION_SUCCESS);
					redirect('admin/user/add_hotel_user/'.$hotel_id);
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Administrator Creation.');
					redirect('admin/user/add_hotel_user/'.$hotel_id);
				}
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
		 return TRUE;
	   }
	   else
	   {
		 return FALSE;
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
			return TRUE;
	   }
	   else
	   {
			return FALSE;
	   }
	}

	/* Method render Hotel User Information 
	 * @param int(Id Of Hotel User)
	 * return void
	 */
	public function view_hotel_user($user_id)
	{	
		$this->data['action']	= "admin/user/view_hotel_users";
		$this->data['title'] = LABEL_1;
		$this->data['userinfo']=$this->User_model->get_user_info($user_id);
		$this->template->load('page_tpl', 'view_hotel_user',$this->data);
			
	}
	/*	Method Check Edit hotel user Permissions for Adminside Users (1.Hotel Administrator 2.Hotel Manager 3.Hotel Staff)
	 *  @param int(Id Of Hotel User)
	 *  return void
	 */
	public function check_edit_user_permissions($user_id)
	{
	    $this->data['action_type']='edit';
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
	    {
			$this->data['title'] = LABEL_1;
			$this->data['userinfo']=$this->User_model->get_user_info($user_id);
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
			$this->data['hotel_id']=$this->data['userinfo']->sb_hotel_id;
			/*if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}*/
            if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
					unset($this->data['hotelusertypes'][$key]);
		    }
			if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
					unset($this->data['hotelusertypes'][$key]);
			}	
		}
		
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'a')
	    {
			$this->data['title'] = LABEL_1;
			$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
			$this->data['userinfo']=$this->User_model->get_user_info($user_id);
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
			$this->data['designation_list']=$this->User_model->get_all_designations();
			$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
			$this->data['user_id']=$hotel_user_id;
			$this->data['parent_services']=$this->Services_model->get_hotel_unique_parent_services($this->data['userinfo']->sb_hotel_id);
			if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
					unset($this->data['hotelusertypes'][$key]);
			}
			if (($key = array_search('a',$this->data['hotelusertypes'])) !== false) {
					unset($this->data['hotelusertypes'][$key]);
			}
		}
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'm')
	    {
			$this->data['title'] = LABEL_1;
			$this->data['userinfo']=$this->User_model->get_user_info($user_id);
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['sb_hotel_name']=$this->Hotel_model->get_hotel_name($this->data['userinfo']->sb_hotel_id);
			$this->data['designation_list']=$this->User_model->get_all_designations();
			$this->data['user_type']=$this->session->userdata('logged_in_user')->sb_hotel_user_type;
			$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
			$this->data['user_id']=$hotel_user_id;
			$this->data['hotel_id']=$this->session->userdata('logged_in_user')->sb_hotel_id;
			$this->data['parent_services']=$this->Services_model->get_hotel_user_parent_service($hotel_user_id);
				
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
		$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
		$this->data['user_id']=$hotel_user_id;
			if($this->data['hotel_id'] == 0)
			{
				$this->data['hotel_name']="None";
			}
			else{
				$result=$this->Hotel_model->get_hotel_name( $this->data['hotel_id']);
				$this->data['hotel_name']=$result[0]['sb_hotel_name'];
			}
	}
	
	/* Method render edit hotel user view
	 * @param int
	 * return void
	 */
	public function edit_hotel_user($user_id)
	{	
		$this->data['action']	= "admin/user/edit_hotel_user_action/".$user_id;
		$this->data['action_type']	= "edit";
		$this->data['userinfo']=$this->User_model->get_user_info($user_id);
	    $this->data['hotel_id']=$data['sb_hotel_id']=$this->data['userinfo']->sb_hotel_id;	;
		$this->load->model('Services_model');
		$this->data['parent_services']=$this->Services_model->get_hotel_unique_parent_services($this->data['hotel_id']);
		if($this->data['userinfo']->sb_hotel_user_type !='a'){
			$this->data['user_parent_service']=$this->Services_model->get_hotel_user_parent_service($user_id);
			$this->data['user_child_service']=$this->Services_model->get_hotel_user_child_service($user_id);
		}
		$this->check_edit_user_permissions($user_id);
		$this->template->load('page_tpl', 'create_hotel_admin_user',$this->data);
	}
	/*Method performs actual logic of user edit and his permission edition
	 *@param int
 	 * return void
	 */
	public function edit_hotel_user_action($user_id)
	{
		$data = $this->input->post();
	
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_user_shift_from','label'=>'Hotel User Shift From','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_user_shift_to','label'=>'Hotel User Shift To','rules'=>'required','class'=>'text-danger'),	
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->check_edit_user_permissions($user_id);
			$this->template->load('page_tpl', 'create_hotel_admin_user',$data);
		}else{
        		$this->check_edit_user_permissions($user_id);
				$data["sb_hotel_user_pic"] = $this->data['userinfo']->sb_hotel_user_pic;
		        if(!empty($_FILES['sb_hotel_user_pic']['name']))
				{
					$folderName=HOTEL_USER_PIC;
					$pic1 = upload_image($folderName,"sb_hotel_user_pic");
					if($pic1 != 0)
					{
						$data["sb_hotel_user_pic"] = $pic1;
					}	
				} 
				$data['sb_hotel_user_shift_from']= date("H:i:s", strtotime($data['sb_hotel_user_shift_from']));
				$data['sb_hotel_user_shift_to']= date("H:i:s", strtotime($data['sb_hotel_user_shift_to']));
				$hotel_user_data =array(
									'sb_hotel_user_shift_from'=>$data['sb_hotel_user_shift_from'],
									'sb_hotel_user_shift_to'=>$data['sb_hotel_user_shift_to'],
									'sb_hotel_user_type'=>$data['sb_hotel_user_type'],
									'sb_staff_designation_id'=>$data['sb_staff_designation_id'],
									'sb_hotel_user_pic'=>$data['sb_hotel_user_pic'],
								);	
				$data['sb_hotel_id']=$this->data['userinfo']->sb_hotel_id;	
				
				$result=$this->Hotel_model->edit_hotel_user($hotel_user_data,$user_id);
				//We need to Remove Previous Permissions//
				$this->User_model->remove_user_role($user_id);
				$this->User_model->remove_user_permissions($user_id);
                //We need to Add User Permissions HERE in db //
				if($data['sb_hotel_user_type'] == 'u')
				{
				    //Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$user_id,
										'sb_roleid'=>'1',
										'sb_user_role_status'=>'1'
									);
                     									
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$role_modules=$this->User_model->get_role_modules(1);
					$permarray =array();
					$i=0;
					while($i<count($role_modules))
					{
					    array_push($permarray,$role_modules[$i]['sb_mod_id']);
						$i++;
					}
					
					//$permarray=array('5','7','13','15','16','18','19');
					$count=0;
					while($count<count($permarray)){
						$singlearray=array(
										'sb_hotel_user_id'=>$user_id,
										'sb_mod_id'=>$permarray[$count],
										'sb_user_mod_val'=>'1'
									);
						array_push($user_module_array,$singlearray);
						$count++;
					}
					$this->User_model->set_user_permissions($user_module_array);					
				}
				if($data['sb_hotel_user_type'] == 'a')
				{
				    //Permissions For admins list
					$useradminpermissions=array(
										'sb_hotel_user_id'=>$user_id,
										'sb_roleid'=>'2',
										'sb_user_role_status'=>'1'
									);									
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$role_modules=$this->User_model->get_role_modules(2);
					$permarray =array();
					$i=0;
					while($i<count($role_modules))
					{
					    array_push($permarray,$role_modules[$i]['sb_mod_id']);
						$i++;
					}
					
					//$permarray=array('5','7','13','15','16','18','19');
					$count=0;
					while($count<count($permarray)){
						$singlearray=array(
										'sb_hotel_user_id'=>$user_id,
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
										'sb_hotel_user_id'=>$user_id,
										'sb_roleid'=>'3',
										'sb_user_role_status'=>'1'
								
									);
					$this->User_model->set_user_role($useradminpermissions);
					$user_module_array=array();
					$role_modules=$this->User_model->get_role_modules(3);
					$permarray =array();
					$i=0;
					while($i<count($role_modules))
					{
					    array_push($permarray,$role_modules[$i]['sb_mod_id']);
						$i++;
					}
					
					//$permarray=array('5','7','13','15','16','18','19');
					$count=0;
					while($count<count($permarray)){
						$singlearray=array(
										'sb_hotel_user_id'=>$user_id,
										'sb_mod_id'=>$permarray[$count],
										'sb_user_mod_val'=>'1'
									);
						array_push($user_module_array,$singlearray);
						$count++;
					}
					$this->User_model->set_user_permissions($user_module_array);
					$child_services=$this->Services_model->get_hotel_child_services_by_parent_service($data['sb_hotel_id'],$data['sb_parent_service_id']);	      
				    $i=0;
					$insert_user_services=array();
					while($i<count($child_services)){
						$singlearray=array(
											'sb_hotel_service_map_id'=>$child_services[$i]['sb_hotel_service_map_id'],
											'sb_hotel_user_id'=>$user_id,
											'sb_parent_service_id'=>$data['sb_parent_service_id'],
											'sb_service_rel_status'=>'1'
										);
						array_push($insert_user_services,$singlearray);
						$i++;
					}
					
					$this->Services_model->set_services($insert_user_services,$user_id);	
				}
				if($data['sb_hotel_user_type'] == 's'){
					if(!isset($data['sb_child_service_id']))
					{
						$data['sb_child_service_id']='0';
					}
					//$child_services=$this->Services_model->get_hotel_child_service_map_id($data['sb_hotel_id'],$data['sb_parent_service_id'],$data['sb_child_service_id']);
				   $child_services=$this->Services_model->get_hotel_child_services_by_parent_service($data['sb_hotel_id'],$data['sb_parent_service_id']);	      
				  
					$i=0;
					$insert_user_services=array();
					while($i<count($child_services)){
						$singlearray=array(
											'sb_hotel_service_map_id'=>$child_services[$i]['sb_hotel_service_map_id'],
											'sb_hotel_user_id'=>$user_id,
											'sb_parent_service_id'=>$data['sb_parent_service_id'],
											'sb_service_rel_status'=>'1'
										);
					
						array_push($insert_user_services,$singlearray);
						$i++;
					}
					
					$this->Services_model->set_services($insert_user_services,$user_id);
				}
				if($result > '0')
				{
					$this->session->set_flashdata('category_success', HOTEL_ADMIN_UPDATION_SUCCESS);
					redirect('admin/user/edit_hotel_user/'.$user_id);
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Administrator Creation.');
					redirect('admin/user/edit_hotel_user/'.$user_id);
				}
			}
	}
	
	
}//End Of Controller Class.

