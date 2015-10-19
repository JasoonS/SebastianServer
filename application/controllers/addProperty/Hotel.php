<?php if(!defined('BASEPATH')) exit('No Cross scripting is allowed');
	class Hotel extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
        	$this->load->model('addProperty/Hotel_model');
			$this->load->model('Services_model');
		} 
		
		/*
		 * Method have hotel creation code
		 * image upload code
		 * code to add basic services
		 * input void
		 * output view
		 */
		function index()
		{
			$data = array();
			$this->load->helper('admin/utility');
			$data['country'] = getCountryList();
			$data['languagelist']=getAllLanguages();	
			if($this->input->post('insert'))
			{
				$this->load->library('form_validation');
				$this->load->helper('form');
				$this->form_validation->set_rules('hotel_name', 'Hotel Name', 'required');
		    	$this->form_validation->set_rules('email','Hotel Email','required|valid_email');
				$this->form_validation->set_rules('address','Address','required','text-danger');
				$this->form_validation->set_rules('postal_code','Postal Code','required','text-danger');
				$this->form_validation->set_rules('owner_name','Hotel Owner','required','text-danger');
				$this->form_validation->set_rules('website','Hotel Website','required','text-danger');	
				$this->form_validation->set_rules('built_calender','Built in','required','text-danger');
				$this->form_validation->set_rules('opening_calender','Opening','required','text-danger');
				$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
				if ($this->form_validation->run() == FALSE)
				{
				 	$this->load->view('addProperty/createHotel',$data);
				}
				else
				{	
				    
					$num = FLOOR(RAND() * 101);
					$picture = "";
					if(!empty($_FILES['sb_hotel_pic']['name']))
					{
						$folderName=HOTEL_PIC;
						$pic1 = upload_image($folderName,"sb_hotel_pic");
						if($pic1 != 0)
						{
							$picture = $pic1;
							
						}	
					} 
					$postdata=$this->input->post();
					
						$hoteldata = array(
								'sb_hotel_name'=>$postdata['hotel_name'],	
								'sb_hotel_category'=>$postdata['category'],
								'sb_hotel_star'=>$postdata['hotel_star'],
								'sb_hotel_email'=>$postdata['email'],
								'sb_hotel_website'=>$postdata['website'],
								'sb_hotel_owner'=>$postdata['owner_name'],
								'sb_hotel_country'=>$postdata['country'],
								'sb_hotel_state'=>$postdata['state'],
								'sb_hotel_city'=>$postdata['city'],
								'sb_hotel_address'=>$postdata['address'],	
								'sb_hotel_zipcode'=>$postdata['postal_code'],
							
								'sb_property_built_month'=>$postdata['month'],
								'sb_property_built_year'=>$postdata['built_calender'],
								'sb_property_open_year'=>$postdata['opening_calender'],
								'is_active'=>0,
								'sb_hotel_pic'=>$picture	
							 );
				   
					$result = $this->Hotel_model->create_hotel($hoteldata,$num);
					$addproperty_id = $result;
					$session = array(
						'addproperty_id' => $addproperty_id,
						'admin_hotel' => '1',
						'property_name'=>$postdata['hotel_name']
					);
					$this->session->set_userdata($session);
					if($result > '1')
					{	
						$this->Hotel_model->set_hotel_languages($result,$this->input->post('lang'));
						$this->Services_model->add_all_services_to_hotel($result);
						redirect('addProperty/Admin');
					}
				}	 
			}
			else{
			     $this->session->sess_destroy();
				$this->load->view('addProperty/createHotel',$data);
			}
		}	
        /*Validation method to check if hotel is already exist
		*input string
		*return boolean
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
					$this->form_validation->set_message('validate_hotel','Hotel already Exists');
					return FALSE;
				}
		}
	}
?>
