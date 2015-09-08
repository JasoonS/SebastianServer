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
			//This case is written to allocate room.
			case 13:{
				$output = $this->allocate_rooms();
				echo json_encode($output);
				break;
			}
			//This case is written to release room.
			case 14:{
				$output = $this->release_room();
				
				echo json_encode(array("success"=>true));
				break;
			}
			//This case is written to release all allocated rooms at once.
			case 15:{
				$output =$this->release_all_rooms();
				echo json_encode($output);
				break;
			}	
			//This case is written to check avaiablity of rooms by type.
			case 16:{
				$output =$this->get_available_rooms();
				echo json_encode($output);
				break;
			}	
			
			//This case is written to send notification to staff.
			case 17:{
				$output =$this->notify_staff();
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
	public function get_allocated_room_numbers(){
		$reservation_code=$this->input->post("reservation_code");
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->load->model('Guest_model');
		$allocated_rooms=$this->Guest_model->get_allocated_room_numbers($reservation_code,$hotel_id);
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
		$this->Guest_model->make_rooms_unavailable($rooms);
		return array("success"=>true);
	}
	/* This function is written to release room
    * input -string 
	* output -int
	*/
	public function release_room(){
		$room_no=$this->input->post("room_no");
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$reservation_code=$this->input->post("reservation_code");
		$this->load->model('Guest_model');
		$room_availability=$this->Guest_model->release_room($room_no,$hotel_id,$reservation_code);
		//Check if room is created.
		return $room_availability;
	}
	/*Method To release all allocated rooms
	* params void
    *	output -array
	*/
	public function release_all_rooms(){
		$allocated_rooms = $this->get_allocated_room_numbers();
		$i=0;
		$rooms_array=array();
		while($i<count($allocated_rooms))
			{
				array_push($rooms_array,$allocated_rooms[$i]['sb_guest_allocated_room_no']);
				$i++;
			}
			if(count($rooms_array)>0)
				{
					$this->load->model('Guest_model');
					$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
					$reservation_code=$this->input->post('reservation_code');
					$this->Guest_model->release_rooms($rooms_array,$hotel_id,$reservation_code);
					return array("success"=>true);
				}
			else{
					return array("success"=>false,"reason"=>"User has already checked out from all the rooms.");
				}
	}
	
	/*This function is used to get all available rooms of particular type
	*@input - void
	*output -array
	*/
	function get_available_rooms()
	{
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$room_type=$this->input->post('room_type');
		$room_number=$this->input->post('room_number');
		$this->load->model('Hotelrooms_model');
		$data=$this->Hotelrooms_model->getHotelAvailableRooms($hotel_id,$room_type,$room_number);
		return $data;
	}
	/*This function is used to send notification to staff.
	*@input - void
	*output -array
	*/
	function notify_staff()
	{
		$this->load->model('Services_model');
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$staffUsers=$this->Services_model->get_staff_users($this->input->post('staff_type'));
		$staffUserIds=array();
		$i=0;
		while($i<count($staffUsers))
		{
		   
			array_push($staffUserIds,$staffUsers[$i]['sb_hotel_user_id']);
			$i++;
		}
		$this->load->model('User_model');
		$device_tokens=$this->User_model->get_staff_device_tokens($staffUserIds);
		$ios_token=array();
		$android_token=array();
		$userType = "staff";
		$message=$this->input->post('staff_message');
	
		$count=0;
		for ($i=0; $i < count($device_tokens); $i++) 
			{ 
				if($device_tokens[$i]['sdt_deviceType'] == 'android' AND $device_tokens[$i]['sdt_token'] != NULL AND $device_tokens[$i]['sdt_token'] != (null))
				{
					array_push($android_token,$device_tokens[$i]['sdt_token']);
				}
				else
				{
					if($device_tokens[$i]['sdt_token'] != "" AND $device_tokens[$i]['sdt_token'] != NULL AND $device_tokens[$i]['sdt_token'] != (null))
						{
							array_push($ios_token,$device_tokens[$i]['sdt_token']);
						}	
				}	
			}
		if(count($ios_token)>0)
			{
				$ipushdata  = array('deviceToken'=> $ios_token,
									'user'=> $userType,
									'message' => "$message"
				);
				//print_r($ipushdata);
				$this->load->library('api/Iospush');
				$val = $this->iospush->iospush_notification($ipushdata);
			}
			// array for android
		if(count($android_token)>0)
			{
				$pushdata = array(
									'message'=> "$message",
									'deviceTokens'=> $android_token,
									'user'=> $userType
								);
				//print_r($pushdata);exit;				
				$this->load->library('api/Android_push');
				$val1 = $this->android_push->push_notification($pushdata);
			}	
		if((count($android_token)==0)&&(count($ios_token)==0))	{
			$data=array("status"=>false,"message"=>"No Staff Present to send notification.");
			return $data;
		}
		else{
			$data=array("status"=>true,"message"=>"Notification sent successfully.");
			return $data;
		}

	}
}//End Of Controller Class

