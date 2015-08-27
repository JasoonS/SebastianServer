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
			//This Case is written to get sub child hotel admin services.
			case 8:{
				$output=$this->ajax_hotel_service_list();
				echo json_encode($output);
				break;
			}
			//This Case is written to change hotel service status.
			case 9:{
				$output=$this->change_hotel_service_status();
				echo $output;
				break;
			}
			//This case is written to populate child services according to parent.
			case 10:{
				$output = $this->get_child_menus();
				echo json_encode($output);
				break;
			}
			//This case is written to know how many rooms are already allocated to same guest.
			case 11:{
				$output =$this->get_allocated_rooms();
				echo json_encode($output);
				break;
			}
			//This case is written to know is room is valid or not
			case 12:{
				$output =$this->get_room_validity();
				echo json_encode($output);
				break;
			}
			case 13:{
				$output = $this->allocate_rooms();
				echo json_encode($output);
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
					$row[]				='<a href="#" id="show_parent_details_'.$service->sb_parent_service_id.'"><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>'."  ".
										 '<a href="#" id="edit_parent_'.$service->sb_parent_service_id.'"><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>'."  ".
										 '<a href="#" id="add_subservices_'.$service->sb_parent_service_id.'"><img src="'.FOLDER_ICONS_URL."add.png".'" /></a>';
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
    	$this->load->model('Childservices_model');
		$columnnames=['sb_child_service_id','child_service_image','sb_child_servcie_detail','sb_child_servcie_name','is_service'];
		$list = $this->Childservices_model->get_datatables('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id'));
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sb_child_service_id;
					$row[] 				= $service->sb_child_servcie_name;
					if($service->is_service == 0){
						$row[] 				= "Yes";				
						$row[]				='<a href="#" id="show_child_details_'.$service->sb_child_service_id.'"><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>'."  ".
											 '<a href="#" id="edit_child_'.$service->sb_child_service_id.'"><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>'."  ".	
											 '<a href="#" id="add_child_subservices_'.$service->sb_child_service_id.'"><img src="'.FOLDER_ICONS_URL."add.png".'" /></a>';	
					}
					else
					{
						$row[] 				= "No";				
						$row[]				='<a href="#" id="edit_child_'.$service->sb_child_service_id.'"><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>';	
											 
					}
					$row[] 				= $service->sb_child_servcie_detail;
					$row[] 				= $service->child_service_image;
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Childservices_model->count_all('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id')),
					"recordsFiltered" => $this->Childservices_model->count_filtered('sb_hotel_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_parent_service_id',$this->input->post('parent_id')),
					"data" => $data
				);
		return $output;
	}
	/* Method to Return Sub Child Service List 
	 * @param void
	 * return array
	 */
	public function ajax_sub_child_service_list(){
    	$this->load->model('Subchildservices_model');
		$columnnames=['sb_child_service_id','sub_child_services_id','sb_sub_child_service_name','sb_sub_child_service_image','sb_sub_child_service_details'];
		$list = $this->Subchildservices_model->get_datatables('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id'));
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sub_child_services_id;
					$row[] 				= $service->sb_sub_child_service_name;
					$row[]				='<a href="#" id="edit_sub_child_'.$service->sub_child_services_id.'"><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>'."  ";
					$row[] 				= $service->sb_child_service_id;
					$row[] 				= $service->sb_sub_child_service_image;
					$row[]				= $service->sb_sub_child_service_details;
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Subchildservices_model->count_all('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"recordsFiltered" => $this->Subchildservices_model->count_filtered('sb_sub_child_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"data" => $data
				);
		return $output;
	}
	/* Method to Return Paid Service List 
	 * @param void
	 * return array
	 */
	public function ajax_hotel_service_list(){
    	$this->load->model('Paidservices_model');
		$columnnames=['sb_paid_services.sb_child_service_id','sub_child_services_id','sb_sub_child_service_name','sb_sub_child_price','sb_is_service_in_use','sb_child_servcie_name'];
		$list = $this->Paidservices_model->get_datatables('sb_paid_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sub_child_services_id',$this->input->post('parent_id'));
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $service) {
					$no++;
					$row = array();
					$row[] 				= $service->sub_child_services_id;
					$row[] 				= $service->sb_sub_child_service_name;
					$row[] 				= $service->sb_child_servcie_name;
					$row[] 				= $service->sb_sub_child_price;
				    $editurl =base_url("admin/HotelServices/editPaidService/".$service->sub_child_services_id);
						if($service->sb_is_service_in_use == '1'){
							$row[] ='<a href="'.$editurl.'" title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>'."  ".
									'<a id="delete" href="#" onclick="changeservicestatus('.$service->sub_child_services_id.','.$service->sb_is_service_in_use.');" title="Delete" ><img src="'.FOLDER_ICONS_URL."active.png".'" /></a>';
						}
						else{
							$row[] ='<a href="'.$editurl.'" title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'" /></a>'."  ".
									'<a id="restore" href="#"  onclick="changeservicestatus('.$service->sub_child_services_id.','.$service->sb_is_service_in_use.');" title="Restore" ><img src="'.FOLDER_ICONS_URL."Inactive.png".'" /></a>';
						}
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Paidservices_model->count_all('sb_paid_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"recordsFiltered" => $this->Paidservices_model->count_filtered('sb_paid_services',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,'sb_child_service_id',$this->input->post('parent_id')),
					"data" => $data
				);
		return $output;
	}
	/* Method to Change Hotel Service in use status 
	 * @param void
	 * return array
	 */
	public function change_hotel_service_status()
	{
	    if($this->input->post('sb_is_service_in_use') == '1'){
			$data=array("sb_is_service_in_use"=>'0');
		}
        else{
			$data=array("sb_is_service_in_use"=>'1');
        }
		$this->load->model('Paidservices_model');
		$output = $this->Paidservices_model->change_status($data,$this->input->post('sb_child_service_id'));	
		return $output;
	}
   /* This function is written to get child services according to parent service.
    * input -void
	* output -void
	*/
	public function get_child_menus(){
		$this->load->model('Services_model');
		$output = $this->Services_model->get_menu_child_services_by_service($this->input->post('sb_parent_service_id'));
		return $output;
	}
   /* This function is written to get how many rooms are already allocated to particular guest.
    * input -string 
	* output -int
	*/
	public function get_allocated_rooms(){
		$reservation_code=$this->input->post("reservation_code");
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Guest_model');
		$allocated_rooms=$this->Guest_model->get_allocated_rooms($reservation_code,$hotel_id);
		return $allocated_rooms;
	}
	
   /* This function is written to get how many rooms are already allocated to particular guest.
    * input -string 
	* output -int
	*/
	public function get_room_validity(){
		$room_no=$this->input->post("room_no");
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Guest_model');
		$room_availability=$this->Guest_model->get_if_room_present($room_no,$hotel_id);
		//Check if room is created.
		return $room_availability;
	}
	
   /* This function allocate room.
    * input -string 
	* output -int
	*/
	public function allocate_rooms(){
		$roomsarry=$this->input->post("rooms_array");
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Guest_model');
		$rooms=array_unique($roomsarry);
		$i=0;
		$data =array();
		while($i<count($rooms)){
			$single_array=array(
									'sb_guest_actual_check_in'=>date('Y-m-d h:i:s'),
									'sb_guest_reservation_code'=>$this->input->post('reservation_code'),
									'sb_guest_allocated_room_no'=>$rooms[$i],
									'sb_guest_terms'=>'1'
								);	
			array_push($data,$single_array);					
			$i++;
		}
		$this->Guest_model->allocate_rooms($data);
		return array("sucess"=>true);
	}
}//End Of Controller Class

