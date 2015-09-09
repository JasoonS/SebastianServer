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
				//$this->form_validation->set_rules($this->validation_rules);
				
				if ($this->form_validation->run() == FALSE)
				{
				 	$this->load->view('addProperty/createHotel',$data);
				}
				else
				{	
					$num = FLOOR(RAND() * 101);
					if(!move_uploaded_file($_FILES['upload']['tmp_name'],APPPATH."../user_data/hotel_pic/".$num))
				{
					$data['failuer'] ="Failed to upload";
				}
				
				$result = $this->Hotel_model->create_hotel($this->input->post(),$num);
				
				$addproperty_id = $result;
				$session = array(
					'addproperty_id' => $addproperty_id,
					'admin_hotel' => '1'
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
			
			$this->load->view('addProperty/createHotel',$data);
			}	

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
