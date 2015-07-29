<?php
/* User controller class 
 * perform checks for valid authorization and
 * all login and logout activities
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


	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function add_hotel()
	{	
		//Check If User is logged in otherwise redirect to login page.
	
		$this->data['action']	= "admin/user/create_hotel";
		$this->data['countrylist'] = getCountryList();
		$this->data['languagelist']=getAllLanguages();
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		{
			$this->data['title'] = LABEL_1;
		    $this->template->load('page_tpl', 'create_hotel',$this->data);
		}
			
	}
	
	/* Method render create Hotel After submission Of add_hotel_form is super administrator
	 * @param void
	 * return void
	 */
	public function create_hotel()
    {

		$data = $this->input->post();
		//Verify Hotel Data
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_name','label'=>'Hotel Name','rules'=>'required|callback_validate_hotel','class'=>'text-danger'),
		    array('field'=>'sb_hotel_country','label'=>'Country','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_state','label'=>'State','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_city','label'=>'City','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_address','label'=>'Address','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_zipcode','label'=>'Postal Code','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_owner','label'=>'Hotel Owner','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_website','label'=>'Hotel Website','rules'=>'required|prep_url','class'=>'text-danger'),
			array('field'=>'sb_hotel_email','label'=>'Hotel Email','rules'=>'required|valid_email','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hotel','This hotel already Exists.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/user/create_hotel";	
			$this->data['countrylist'] = getCountryList();
			$this->data['languagelist']=getAllLanguages();
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->template->load('page_tpl', 'create_hotel',$this->data);
			}
		}else{
				$data["sb_hotel_pic"] = "";
				
		        if(!empty($_FILES['sb_hotel_pic']['name']))
				{

					$folderName=HOTEL_PIC;
					$pic1 = upload_image($folderName,"sb_hotel_pic");
					if($pic1 != 0)
					{
						$data["sb_hotel_pic"] = $pic1;
					}	
				} 
                
				$hoteldata = array(
									'sb_hotel_name'=>$data['sb_hotel_name'],	
									'sb_hotel_category'=>$data['sb_hotel_category'],
									'sb_hotel_star'=>$data['sb_hotel_star'],
									'sb_hotel_email'=>$data['sb_hotel_email'],
									'sb_hotel_website'=>$data['sb_hotel_website'],
									'sb_hotel_owner'=>$data['sb_hotel_owner'],
									'sb_hotel_country'=>$data['sb_hotel_country'],
									'sb_hotel_state'=>$data['sb_hotel_state'],
									'sb_hotel_city'=>$data['sb_hotel_city'],
									'sb_hotel_address'=>$data['sb_hotel_address'],	
									'sb_hotel_zipcode'=>$data['sb_hotel_zipcode'],
									'sb_hotel_pic'=>$data['sb_hotel_pic'],
									'sb_property_built_month'=>$data['sb_property_built_month'],
									'sb_property_built_year'=>$data['sb_property_built_year'],
									'sb_property_open_year'=>$data['sb_property_open_year']	
							 );
							 
				$result=$this->Hotel_model->create_hotel($hoteldata);

				if($result > '1')
				{
					$languageresult =$this->Hotel_model->set_hotel_languages($result,$data['sb_languages']);
					$this->session->set_flashdata('category_success', HOTEL_CREATION_SUCCESS);
					redirect('admin/user/add_hotel');
				}
				else
				{
					$this->session->set_flashdata('category_error', HOTEL_CREATION_FAIL);
					redirect('admin/user/add_hotel');
				}
			}
	}	
	
	/*
	This method returns Whether Hotel With The particular name Already Exists
	*/
    function validate_hotel($field_value)
	{
	   $result=$this->Hotel_model->find_hotel($field_value);

	   if($result[0]['hotelcount'] == 0)
	   {
		 return TRUE;
	   }
	   else
	   {
		 return FALSE;
	   }
	}
	
	/*
	This method is used to create Hotel administrator view
	*/
	function add_hotel_admin_user()
	{
			$this->data['action']	= "admin/user/create_hotel_admin_user";
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['hotellist']=getAllHotels();	
				if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}	
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;	
			    $this->template->load('page_tpl', 'create_hotel_admin_user',$this->data);
			}
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
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hoteluser','Hotel User with this name is already Exists.');
		$this->form_validation->set_message('validate_hoteluseremail','Hotel User with this email is already Exists.');
		$this->form_validation->set_message('valid_email','Please Enter Valid Email.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/user/create_hotel_admin_user";
			
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['hotellist']=getAllHotels();
            if (($key = array_search('u',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}			
			if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
			if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
			$this->template->load('page_tpl', 'create_hotel_admin_user',$this->data);
		}else{
		        
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
		        $hotelname = $this->Hotel_model->get_hotel_name($data['sb_hotel_id']);
				$password =$hotelname[0]['sb_hotel_name'];
				$password = str_replace(' ', '', $password);
				$data['sb_hotel_userpasswd']=createHashAndSalt($password);
				$data['sb_hotel_user_shift_from']= date("H:i:s", strtotime($data['sb_hotel_user_shift_from']));
				$data['sb_hotel_user_shift_to']= date("H:i:s", strtotime($data['sb_hotel_user_shift_to']));
				
				$result=$this->Hotel_model->create_hotel_admin($data);

				$hotelusername=$data['sb_hotel_username'];
				$message="Hi ,
							Congratulations Your administrator account is created on sebastian.
							Account Details are
							User Name =  $hotelusername
							Password = $password
							
							Thanks
						";
				sendMail('no-reply@sebastian.com',$data[sb_hotel_useremail],"Administrator Account Creation",$message);
				if($result == '1')
				{
					$this->session->set_flashdata('category_success', HOTEL_ADMIN_CREATION_SUCCESS);
					redirect('admin/user/add_hotel_admin_user');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Administrator Creation.');
					redirect('admin/user/add_hotel_admin_user');
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
	
	/* Method render Hotel Lising View If User is super administrator
	 * @param void
	 * return void
	 */
	public function view_hotels()
	{	
		//Check If User is logged in otherwise redirect to login page.
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->template->load('page_tpl', 'hotel_list');
            }		
	}
	
	/* Method render edit Hotel View If User is super administrator/Hotel Administrator
	 * @param int
	 * return void
	 */
	public function edit_hotel($hotel_id)
	{	
		//Check If User is logged in otherwise redirect to login page.
	
		$this->data['action']	= "admin/user/edit_hotel_action/$hotel_id";
		$this->data['hotel_id']	= $hotel_id;
		$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
		$this->data['countrylist'] = getCountryList();
		$this->data['languagelist']=getAllLanguages();
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
		$this->template->load('page_tpl', 'edit_hotel',$this->data);
		}
			
	}
	
	/* Method Have Hotel Data updation logic super administrator/Hotel Administrator
	 * @param int
	 * return void
	 */
	public function edit_hotel_action($hotel_id)
	{	
		//Check If User is logged in otherwise redirect to login page.
	
		$data = $this->input->post();
		$this->validation_rules = array(
		   
		    array('field'=>'sb_hotel_country','label'=>'Country','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_state','label'=>'State','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_city','label'=>'City','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_address','label'=>'Address','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_zipcode','label'=>'Postal Code','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_owner','label'=>'Hotel Owner','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_website','label'=>'Hotel Website','rules'=>'required|prep_url','class'=>'text-danger'),
			array('field'=>'sb_hotel_email','label'=>'Hotel Email','rules'=>'required|valid_email','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/user/edit_hotel_action/$hotel_id";	
			$this->data['countrylist'] = getCountryList();
			$this->data['languagelist']=getAllLanguages();
			$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
			$this->template->load('page_tpl', 'edit_hotel',$this->data);
		}else{
		        $this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
		        
				$data["sb_hotel_pic"] =$this->data['hoteldata']['sb_hotel_pic'];
				
		        if(!empty($_FILES['sb_hotel_pic']['name']))
				{

					$folderName=HOTEL_PIC;
					$pic1 = upload_image($folderName,"sb_hotel_pic");
					if($pic1 != 0)
					{
						$data["sb_hotel_pic"] = $pic1;
					}	
				} 
               
				$hoteldata = array(
									
									'sb_hotel_category'=>$data['sb_hotel_category'],
									'sb_hotel_star'=>$data['sb_hotel_star'],
									'sb_hotel_email'=>$data['sb_hotel_email'],
									'sb_hotel_website'=>$data['sb_hotel_website'],
									'sb_hotel_owner'=>$data['sb_hotel_owner'],
									'sb_hotel_country'=>$data['sb_hotel_country'],
									'sb_hotel_state'=>$data['sb_hotel_state'],
									'sb_hotel_city'=>$data['sb_hotel_city'],
									'sb_hotel_address'=>$data['sb_hotel_address'],	
									'sb_hotel_zipcode'=>$data['sb_hotel_zipcode'],
									'sb_hotel_pic'=>$data['sb_hotel_pic'],
									'sb_property_built_month'=>$data['sb_property_built_month'],
									'sb_property_built_year'=>$data['sb_property_built_year'],
									'sb_property_open_year'=>$data['sb_property_open_year']	
							 );
							 
				$result=$this->Hotel_model->edit_hotel($hoteldata,$hotel_id);

				if($result == '1')
				{
					$languageresult =$this->Hotel_model->set_hotel_languages($hotel_id,$data['sb_languages']);
					$this->session->set_flashdata('category_success', HOTEL_UPDATION_SUCCESS);
					redirect("admin/user/edit_hotel/$hotel_id");
				}
				else
				{
					$this->session->set_flashdata('category_error', HOTEL_UPDATION_FAIL);
					redirect("admin/user/edit_hotel/$hotel_id");
				}
			}
		
			
	}
	
	/* Method render  Hotel View If User is super administrator/Hotel Administrator
	 * @param int
	 * return void
	 */
	public function view_hotel($hotel_id)
	{	
		
		$this->data['action']	= "admin/user/view_hotel/$hotel_id";
		$this->data['hotel_id']	= $hotel_id;
		$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
		$this->data['languagelist']=getAllLanguages();
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->template->load('page_tpl', 'view_hotel',$this->data);
			}
			
	}
	/* Method Deactivates hotel
	 * @param int
	 * return void
	 */
	public function delete_hotel($hotel_id)
	{	
		
		print_r($hotel_id);exit;
			
	}
	
	/* Method render User Listing If User is super administrator
	 * @param int
	 * return void
	 */
	public function view_hotel_users()
	{	
		
		$this->data['action']	= "admin/user/view_hotel_users";
	
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->template->load('page_tpl', 'hotel_user_list',$this->data);
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

