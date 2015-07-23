<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel extends CI_Controller 
{
	public	$data 					= array();
	public	$validation_rules 		= array();
	public	$login_flag				= FALSE;
	private $logged_in_user_meta 	= array();
	private $user_name 				= '';
	private $start_chk_admin 		= FALSE;
	private $start_chk_user			= FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Hotel_model');
		$this->load->helper('admin/utility');
	}
	
	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function add_hotel()
	{	
		//Check If User is logged in otherwise redirect to login page.
		if($this->session->userdata('user_type')!= false || $this->session->userdata('user_type')!= null)
		{
			if($this->session->userdata('user_type')=='1')
			{
				$this->data['action']	= "admin/hotel/create_hotel";
				$this->data['countrylist'] = getCountryList();
				$this->template->load('create_hotel_tpl', 'create_hotel',$this->data);
			}
			else
			{
				echo "You are not authorized person to view this page.";
			}
		}
		else
		{
			redirect('admin/Login');
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
				if($result == '1')
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
}

