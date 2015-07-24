<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller 
{
	
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		$this->load->model('Hotel_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
	}


	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function add_hotel()
	{	
		//Check If User is logged in otherwise redirect to login page.
	
		$this->data['action']	= "admin/hotel/create_hotel";
		$this->data['countrylist'] = getCountryList();
	
		$this->template->load('create_hotel_tpl', 'create_hotel',$this->data);
			
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
			array('field'=>'sb_hotel_zipcode','label'=>'Postal Code','rules'=>'required','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hotel','This hotel already Exists.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/hotel/create_hotel";	
			$this->data['countrylist'] = getCountryList();
			
			$this->template->load('create_hotel_tpl', 'create_hotel',$this->data);
		}else{
				$result=$this->Hotel_model->create_hotel($data);
				$insertid=$result;
				$this->Services_model->add_all_services_to_hotel($insertid);
				if($result)
				{
				     
					$this->session->set_flashdata('category_success', 'Hotel Created Successfully.');
					redirect('admin/hotel/add_hotel');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Creation.');
					redirect('admin/hotel/add_hotel');
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
			$this->data['action']	= "admin/hotel/create_hotel_admin_user";
			
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['hotellist']=getAllHotels();	
			
				
				if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				
			
			$this->template->load('create_hotel_tpl', 'create_hotel_admin_user',$this->data);
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
			$this->data['action']	= "admin/hotel/create_hotel_admin_user";
			
			$this->data['hotelusertypes'] = getAvailableHotelUserTypes();
			$this->data['hotellist']=getAllHotels();	
			    if (($key = array_search('s',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
				if (($key = array_search('m',$this->data['hotelusertypes'])) !== false) {
						unset($this->data['hotelusertypes'][$key]);
				}
			$this->template->load('create_hotel_tpl', 'create_hotel_admin_user',$this->data);
		}else{
		        
				$data["sb_hotel_user_pic"] = "";
				
		        if(!empty($_FILES['sb_hotel_user_pic']['name']))
				{
					$folderName="sb_hotel_user_pic";
					$pic1 = upload_image($folderName);
				
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
					$this->session->set_flashdata('category_success', 'Hotel Administrator Created Successfully.');
					redirect('admin/hotel/add_hotel_admin_user');
				}
				else
				{
					$this->session->set_flashdata('category_error', 'Error in Hotel Administrator Creation.');
					redirect('admin/hotel/add_hotel_admin_user');
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
	
}

