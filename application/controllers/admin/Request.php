<?php
/* Request controller class 
 * perform actions on ajax requests according to their inputs
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Request extends CI_Controller 
{

	public $return_type = '';
	public $output      = array();

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin/utility');
	}

	
	/* This function decides which function to call after ajax call
	 * @param - int flag (and other post parameters in ajax requests)
	 */
	public function get_request_data()
	{

	    $flag=$this->input->post('flag');
		switch($flag)
		{
		    //This Case is written to get if parent service with the same name is already in the database.
			case 1:{
			    $output=$this->get_parent_service_by_name();
				echo $output;
				break;
			}
			//This Case is written to get grid of Parent Services
			case 2:{
				$output=$this->ajax_parent_service_list();
				echo json_encode($output);
				break;
			}
			//This Case is written to get grid of Child Services accourding to Parent
			case 3:{
				$output=$this->ajax_child_service_list();
				echo json_encode($output);
				break;
			}
			//This Case is written to get grid of Sub Child Services accourding to Child
			case 4:{
				$output=$this->ajax_sub_child_service_list();
				echo json_encode($output);
				break;
			}
			//This Case is written to get if parent service with the same name is already in the database.
			//Excluding Current Service (This is option For Edit)
			case 5:{
				$output=$this->get_parent_service_by_name();
				echo json_encode($output);
				break;
			}
			//This Case is written to get if child service with the same name is already in the database.
			case 6:{
			    $output=$this->get_child_service_by_name();
				echo $output;
				break;
			}
			//This Case is written to get if sub child service with the same name is already in the database.
			case 7:{
			    $output=$this->get_sub_child_service_by_name();
				echo $output;
				break;
			}
		}
    }
	 /* This function returns count of child service with same name
	* @param void
	* return int
	*/
	public function get_sub_child_service_by_name(){
		$this->load->model('Services_model');
		if($this->input->post('flag')==7)
		{
			return $this->Services_model->get_sub_child_service_by_name($this->input->post('service_name'),$this->input->post('service_id'));
		}
		return $this->Services_model->get_sub_child_service_by_name($this->input->post('service_name'));
	}	
    /* This function returns count of child service with same name
	* @param void
	* return int
	*/
	public function get_child_service_by_name(){
		$this->load->model('Services_model');
		if($this->input->post('flag')==6)
		{
			return $this->Services_model->get_child_service_by_name($this->input->post('service_name'),$this->input->post('service_id'));
		}
		return $this->Services_model->get_child_service_by_name($this->input->post('service_name'));
	}	

   /* This function returns count of parent service with same name
	* @param void
	* return int
	*/
	public function get_parent_service_by_name(){
		$this->load->model('Services_model');
		if($this->input->post('flag')==5)
		{
			return $this->Services_model->get_parent_service_by_name($this->input->post('service_name'),$this->input->post('service_id'));
		}
		return $this->Services_model->get_parent_service_by_name($this->input->post('service_name'));
	}
	/* Method to Return Parent Service List 
	 * @param void
	 * return array
	 */
	public function ajax_parent_service_list(){
    	$this->load->model('Common_model');
		$columnnames=['sb_parent_service_id','sb_parent_service_image','sb_parent_service_name','sb_parent_service_color','sb_parent_service_created_on'];
		$list = $this->Common_model->get_datatables('sb_hotel_parent_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sb_parent_service_id;
					$row[] 				= $service->sb_parent_service_name;
					$row[] 				= $service->sb_parent_service_color;
					$row[]				='<span class="badge badge-success" id="show_parent_details_'.$service->sb_parent_service_id.'">Show Details</span>'.
										 '<span class="badge badge-success" id="edit_parent_'.$service->sb_parent_service_id.'">Edit Service</span>'.
										 '<span class="badge badge-success" id="add_subservices_'.$service->sb_parent_service_id.'">Add Child Services</span>';
					$row[] 				= $service->sb_parent_service_image;
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Common_model->count_all('sb_hotel_parent_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->Common_model->count_filtered('sb_hotel_parent_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);
		return $output;
	}
	/* Method to Return Child Service List 
	 * @param void
	 * return array
	 */
	public function ajax_child_service_list(){
    	$this->load->model('ChildServices_model');
		$columnnames=['sb_child_service_id','child_service_image','sb_child_servcie_detail','sb_child_servcie_name','is_service'];
		$list = $this->ChildServices_model->get_datatables('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id'));
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sb_child_service_id;
					$row[] 				= $service->sb_child_servcie_name;
					if($service->is_service == 0){
						$row[] 				= "Yes";				
						$row[]				='<span class="badge badge-success" id="show_child_details_'.$service->sb_child_service_id.'">Show Details</span>'.
											 '<span class="badge badge-success" id="edit_child_'.$service->sb_child_service_id.'">Edit Service</span>'.	
											 '<span class="badge badge-success" id="add_child_subservices_'.$service->sb_child_service_id.'">Add Sub Services</span>';	
					}
					else
					{
						$row[] 				= "No";				
						$row[]				='<span class="badge badge-success" id="edit_child_'.$service->sb_child_service_id.'">Edit Service</span>';	
											 
					}
					$row[] 				= $service->sb_child_servcie_detail;
					$row[] 				= $service->child_service_image;
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->ChildServices_model->count_all('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id')),
					"recordsFiltered" => $this->ChildServices_model->count_filtered('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id')),
					"data" => $data
				);
		return $output;
	}
	/* Method to Return Sub Child Service List 
	 * @param void
	 * return array
	 */
	public function ajax_sub_child_service_list(){
    	$this->load->model('SubChildservices_model');
		$columnnames=['sb_child_service_id','sub_child_services_id','sb_sub_child_service_name','sb_sub_child_service_image','sb_sub_child_service_details'];
		$list = $this->SubChildservices_model->get_datatables('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id'));
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sub_child_services_id;
					$row[] 				= $service->sb_sub_child_service_name;
					$row[]				='<span class="badge badge-success" id="edit_sub_child_'.$service->sub_child_services_id.'">Edit</span>';
					$row[] 				= $service->sb_child_service_id;
					$row[] 				= $service->sb_sub_child_service_image;
					$row[]				= $service->sb_sub_child_service_details;
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->SubChildservices_model->count_all('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"recordsFiltered" => $this->SubChildservices_model->count_filtered('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"data" => $data
				);
		return $output;
	}
	
}//End Of Controller Class

