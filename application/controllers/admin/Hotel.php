<?php
/* Hotel Controller Class
 * perform crud of hotels
 * All Hotels Related
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Hotel extends CI_Controller 
{
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
        $this->load->model('Hotel_model');
		$this->load->model('Services_model');
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
	    $requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['title']  = 'All Hotel List';
		$this->data['Hotels'] = $this->Hotel_model->get_hotels();
		$this->template->load('page_tpl','hotel_list_vw',$this->data);
	}
	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function add_hotel()
	{	
		//Check If User is logged in otherwise redirect to login page.
		$requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['action']	= "admin/hotel/create_hotel";
		$this->data['countrylist'] = getCountryList();
		$this->data['languagelist']=getAllLanguages();
		if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		{
			$this->data['title'] = 'Add new Hotel';
		    $this->template->load('page_tpl', 'create_hotel_vw',$this->data);
		}	
	}
	
	/* Method render create Hotel After submission Of add_hotel_form is super administrator
	 * @param void
	 * return void
	 */
	public function create_hotel()
    { 
		$requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$data = $this->input->post();
		//Verify Hotel Data
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_name','label'=>'Hotel Name','rules'=>'required|callback_validate_hotel','class'=>'text-danger'),
		    array('field'=>'sb_hotel_country','label'=>'Country','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_state','label'=>'State','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_city','label'=>'City','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_address','label'=>'Address','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_zipcode','label'=>'Postal Code','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_website','label'=>'Hotel Website','rules'=>'required|prep_url','class'=>'text-danger'),
			array('field'=>'sb_hotel_email','label'=>'Hotel Email','rules'=>'required|valid_email','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		$this->form_validation->set_message('validate_hotel','This hotel already Exists.');
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/hotel/create_hotel";	
			$this->data['countrylist'] = getCountryList();
			$this->data['languagelist']=getAllLanguages();
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'u')
		    {
				$this->data['title'] = LABEL_1;
				$this->template->load('page_tpl', 'create_hotel_vw',$this->data);
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
					$this->Services_model->add_all_services_to_hotel($result);
					$this->session->set_flashdata('category_success', HOTEL_CREATION_SUCCESS);
				}
				else
				{
					$this->session->set_flashdata('category_error', HOTEL_CREATION_FAIL);
				}
				redirect('admin/hotel/add_hotel');
			}
	}	
	
	/* This method returns Whether Hotel With The particular name Already Exists
	 * @params - String (Hotel Name)	 
	 * return -boolean 
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
	
	/* Method render Hotel Lising View If User is super administrator
	 * @param void
	 * return void
	 */
	public function view_hotels()
	{	
		//Check If User is logged in otherwise redirect to login page.
		$requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
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
		$requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['action']			= "admin/hotel/edit_hotel_action/$hotel_id";
		$this->data['hotel_id']			= $hotel_id;
		$this->data['hoteldata'] 		= $this->Hotel_model->get_hotel_data($hotel_id); 
		$this->data['countrylist'] 		= getCountryList();
		$this->data['languagelist']		=getAllLanguages();

			$this->data['title'] = "Edit Hotel";
			$this->template->load('page_tpl', 'create_hotel_vw',$this->data);

	}
	
	/* Method Have Hotel Data updation logic super administrator/Hotel Administrator
	 * @param int
	 * return void
	 */
	public function edit_hotel_action($hotel_id)
	{	
		$data = $this->input->post();

		$requested_mod = 'hotel';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
			
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_country','label'=>'Country','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_state','label'=>'State','rules'=>'required','class'=>'text-danger'),
		    array('field'=>'sb_hotel_city','label'=>'City','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_address','label'=>'Address','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_zipcode','label'=>'Postal Code','rules'=>'required','class'=>'text-danger'),
			array('field'=>'sb_hotel_website','label'=>'Hotel Website','rules'=>'required|prep_url','class'=>'text-danger'),
			array('field'=>'sb_hotel_email','label'=>'Hotel Email','rules'=>'required|valid_email','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']	= "admin/hotel/edit_hotel_action/$hotel_id";	
			$this->data['countrylist'] = getCountryList();
			$this->data['languagelist']=getAllLanguages();
			$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
			$this->data['title'] = "Edit Hotel";
			$this->template->load('page_tpl', 'create_hotel_vw',$this->data);
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
					redirect("admin/hotel/edit_hotel/$hotel_id");
				}
				else
				{
					$this->session->set_flashdata('category_error', HOTEL_UPDATION_FAIL);
					redirect("admin/hotel/edit_hotel/$hotel_id");
				}
			}
	}
	
	/* Method render  Hotel View If User is super administrator/Hotel Administrator
	 * @param int
	 * return void
	 */
	public function view_hotel($hotel_id)
	{	
	    $requested_mod = 'hotel/view_hotel/';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['action']	= "admin/hotel/view_hotel/$hotel_id";
		$this->data['hotel_id']	= $hotel_id;
		$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
		$this->data['languagelist']=getAllLanguages();
		$this->data['title'] = LABEL_1;
		$this->template->load('page_tpl', 'view_hotel',$this->data);
			
	}
	/* Method render  Hotel Photos
	 * @param int
	 * return void
	 */
	public function photos($hotel_id)
	{	
	    $requested_mod = 'hotel/view_hotel/';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['action']	= "admin/hotel/view_hotel/$hotel_id";
		$this->data['hotel_id']	= $hotel_id;
		$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 
		$this->data['hotelpictures'] = $this->Hotel_model->get_hotel_pictures($hotel_id);
		$this->data['languagelist']=getAllLanguages();
		$this->data['title'] ="Photos";
		//print_r($this->data['hotelpictures']);die();
		$this->template->load('page_tpl', 'album_vw',$this->data);	
	}
	/* Method render  Hotel Surroundings
	 * @param int
	 * return void
	 */
	public function surroundings($hotel_id)
	{	
	    $requested_mod = 'hotel/view_hotel/';
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}  
		$this->data['action']	= "admin/hotel/view_hotel/$hotel_id";
		$this->data['hotel_id']	= $hotel_id;
		$this->data['hoteldata'] = $this->Hotel_model->get_hotel_data($hotel_id); 

		$this->data['languagelist']=getAllLanguages();
		$this->data['title'] = LABEL_1;
		$this->template->load('page_tpl', 'modules_vw',$this->data);	
	}
	/* Method Deactivates/Activates hotel
	 * @param int
	 * return void
	 */
	public function change_hotel_status()
	{	
		$hotel_id=$this->input->post('hotel_id');
		$hotel_status=$this->input->post('hotelstatus');
		if($hotel_status == 1)
		{
			$status=0;
		}
		else
		{
			$status =1;
		}
		$data=array(
				'sb_hotel_id'=>$hotel_id,
				'is_active'=>$status	
			);
		$this->Hotel_model->edit_hotel($data,$hotel_id);		
		echo json_encode(array('status'=>'1','message'=>'Hotel Status Changed'));
	}
}//End Of Controller Class