<?php
/* Class manages services associated with hotel
 * and responsible for update and delete
 */
defined('BASEPATH') OR exit('No direct script access allowed');
Class HotelServices extends CI_Controller
{
	public $data = array();
	public function __construct()
	{
		parent::__construct();
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
		$this->load->model('Hotel_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
	}

	public function index()
	{

	}

	public function edit($hotel_id = '')
	{
		
		$this->data['title'] 				= 'Hotel Services';
		$this->data['parent_services'] 		= $this->Services_model->get_all_parent_services();
		$this->data['hotel_id']				= $hotel_id;
		$this->template->load('page_tpl', 'parent_service_list_vw',$this->data);
	}

	public function get_child_services_for_hotel($hotel_id = '')
	{
		$parent_service_id = 1;

		//Get hotel id if user is not system admin
		if($hotel_id == '' && $this->session->logged_in_user->sb_hotel_user_type !== 'u')
		{
			$hotel_id = $this->session->logged_in_user->sb_hotel_id;
			
		}
		
		$child_services_for_this_parent = 	$this->Services_model->get_hotel_child_services_by_parent_service($hotel_id,$parent_service_id);
	}
	
   /* This method is used to render Service Creation Form
	* @params void
	* return view 
    */
	
	public function add()
	{
		$this->data['action']	= "admin/HotelServices/addService";
		$this->data['title']	= 'Create Service';
		$this->data['parent_service_count']=$this->Services_model->get_services_count('sb_hotel_parent_services');
		$this->data['child_service_count']=$this->Services_model->get_services_count('sb_hotel_child_services');
		$this->data['sub_child_service_count']=$this->Services_model->get_services_count('sb_sub_child_services');
		$this->template->load('page_tpl','create_service_vw',$this->data); 
	}	
	
	/*This method is used for actual Service Creation Task
	 *@params void
	 *return void
	 */
	public function addParentService(){
		$data=array();
		$data["sb_parent_service_image"]="";
		if(!empty($_FILES['sb_service_pic']['name']))
				{
					$folderName=PARENT_SERVICE_PIC;
					$pic1 = upload_image($folderName,"sb_service_pic");
					if($pic1 != 0)
					{
						$data["sb_parent_service_image"] = $pic1;
					}	
				}
		$data['sb_parent_service_name']=$this->input->post('sb_service_name');
		$data['sb_parent_service_color']=$this->input->post('sb_service_color');
		$tablename="sb_hotel_parent_services";
		$this->Services_model->add_service($data,$tablename);
		$this->session->set_flashdata('success_msg', PARENT_SERVICE_CREATION_SUCCESS);
		redirect('admin/HotelServices/add');
	}	
	/*This method is used for Edit Service Task
	 *@params void
	 *return void
	 */
	public function editParentService(){
		$data=array();
		//$data["sb_parent_service_image"]="";
		if(!empty($_FILES['sb_service_pic']['name']))
				{
					$folderName=PARENT_SERVICE_PIC;
					$pic1 = upload_image($folderName,"sb_service_pic");
					if($pic1 != 0)
					{
						$data["sb_parent_service_image"] = $pic1;
					}	
				}
		$data['sb_parent_service_name']=$this->input->post('sb_service_name');
		$data['sb_parent_service_color']=$this->input->post('sb_service_color');
		$tablename="sb_hotel_parent_services";
		$sb_parent_service_id=$this->input->post('sb_service_id');
		$this->Services_model->edit_service($data,$tablename,$sb_parent_service_id);
		$this->session->set_flashdata('success_msg', PARENT_SERVICE_UPDATION_SUCCESS);
		redirect('admin/HotelServices/add');
	}
	/*This method is used for Add Child Services Task
	 *@params void
	 *return void
	 */
	public function addChildServices(){
		$child_services_names=$this->input->post('sb_child_service_name');
		$is_menu=$this->input->post('is_menu');
		$service_detail=$this->input->post('service_detail');
		$data=array();
		$i=0;
		while($i<count($child_services_names)){
			if($child_services_names[$i] != ""){
				//Check if child service name is not already there in db.
				$ispresent=$this->Services_model->get_child_service_by_name($child_services_names[$i]);
				if($ispresent == 0)
				{
				    if($is_menu[$i] == "no"){$is_menu[$i] ='1';}
					else{$is_menu[$i] ='0';}
					$child_service_image="";
					if(!empty($_FILES['sb_child_service_pic'.$i]['name']))
					{
						$folderName=CHILD_SERVICE_PIC;
						
						$pic1 = upload_image($folderName,"sb_child_service_pic".$i);
						if($pic1 != 0)
						{
							$child_service_image= $pic1;
						
						}	
					} 
					$singleArray=array(
									"sb_child_servcie_name"=>$child_services_names[$i],
									"is_service"=>$is_menu[$i],
									"sb_child_servcie_detail"=>$service_detail[$i],
									"sb_parent_service_id"=>$this->input->post('child_parent_service_id'),
									"child_service_image"=>$child_service_image
								);
					array_push($data,$singleArray);
				}
			}
			$i++;
		}
		if(count($data)>0){
			$this->Services_model->create_child_services($data);
			$this->session->set_flashdata('success_msg', CHILD_SERVICE_CREATION_SUCCESS);
		}
		else{
			$this->session->set_flashdata('failure_msg', CHILD_SERVICE_CREATION_FAILURE);
		}
		redirect('admin/HotelServices/add');
	}
	/*This method is used for Edit Child Service Task
	 *@params void
	 *return void
	 */
	public function editChildService(){
		$data=array();
		if(!empty($_FILES['sb_service_pic']['name']))
				{
					$folderName=CHILD_SERVICE_PIC;
					$pic1 = upload_image($folderName,"sb_service_pic");
					if($pic1 != 0)
					{
						$data["child_service_image"] = $pic1;
					}	
				}
		$data['sb_child_servcie_name']=$this->input->post('sb_service_name');
		$data['sb_child_servcie_detail']=$this->input->post('service_detail');
		$tablename="sb_hotel_child_services";
		$sb_parent_service_id=$this->input->post('sb_service_id');
		$this->Services_model->edit_child_service($data,$tablename,$sb_parent_service_id);
		$this->session->set_flashdata('success_msg', CHILD_SERVICE_UPDATION_SUCCESS);
		redirect('admin/HotelServices/add');
	}
	/*This method is used for Add Child Services Task
	 *@params void
	 *return void
	 */
	public function addSubChildServices(){
		$child_services_names=$this->input->post('sb_child_service_name');
		$service_detail=$this->input->post('service_detail');
		$data=array();
		$i=0;
		while($i<count($child_services_names)){
			if($child_services_names[$i] != ""){
				//Check if sub child service name is not already there in db.
				$ispresent=$this->Services_model->get_sub_child_service_by_name($child_services_names[$i]);
				if($ispresent == 0)
				{
					$child_service_image="";
					if(!empty($_FILES['sb_child_service_pic'.$i]['name']))
					{
						$folderName=SUBCHILD_SERVICE_PIC;
						
						$pic1 = upload_image($folderName,"sb_child_service_pic".$i);
						if($pic1 != 0)
						{
							$child_service_image= $pic1;
						
						}	
					} 
					$singleArray=array(
									"sb_sub_child_service_name"=>$child_services_names[$i],
									"sb_sub_child_service_details"=>$service_detail[$i],
									"sb_child_service_id"=>$this->input->post('child_sub_parent_service_id'),
									"sb_sub_child_service_image"=>$child_service_image
								);
					array_push($data,$singleArray);
				}
			}
			$i++;
		}
	
		//print_r($data);exit;
		if(count($data)>0){
			$this->Services_model->create_subchild_services($data);
			$this->session->set_flashdata('success_msg', CHILD_SERVICE_CREATION_SUCCESS);
		}
		else{
			$this->session->set_flashdata('failure_msg', CHILD_SERVICE_CREATION_FAILURE);
		}
		redirect('admin/HotelServices/add');
	}
	/*This method is used for Edit Sub Child Service Task
	 *@params void
	 *return void
	 */
	public function editSubChildService(){
		$data=array();
		if(!empty($_FILES['sb_service_pic']['name']))
				{
					$folderName=SUBCHILD_SERVICE_PIC;
					$pic1 = upload_image($folderName,"sb_service_pic");
					if($pic1 != 0)
					{
						$data["sb_sub_child_service_image"] = $pic1;
					}	
				}
		$data['sb_sub_child_service_name']=$this->input->post('sb_service_name');
		$data['sb_sub_child_service_details']=$this->input->post('service_detail');
		$tablename="sb_sub_child_services";
		$sb_parent_service_id=$this->input->post('sb_service_id');
		$this->Services_model->edit_sub_child_service($data,$tablename,$sb_parent_service_id);
		$this->session->set_flashdata('success_msg', CHILD_SERVICE_UPDATION_SUCCESS);
		redirect('admin/HotelServices/add');
	}
	
}