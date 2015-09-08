<?php
/* Ajax controller class 
 * perform actions on ajax requests according to their inputs
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax extends CI_Controller 
{

	public $return_type = '';
	public $output      = array();

	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin/utility');
		$this->load->model('Hotel_model');
		$this->load->model('Common_model');
		//$this->load->model('Hoteluser_model');
		$this->load->model('User_model');
		$this->load->model('Services_model');
		$this->load->model('Vendor_model');
		$this->load->model('Guest_model');
	}

	
	/* This function decides which function to call after ajax call
	 * @param - int flag (and other post parameters in ajax requests)
	 */
	public function get_ajax_data()
	{

	    $flag=$this->input->post('flag');
		switch($flag)
		{
			case 1:{
			    $this->get_states($this->input->post('country_id'));
				break;
			}
			case 2:{
				$this->get_cities($this->input->post('state_id'));
				break;
			}
			case 3:{
			    $columnnames=['sb_hotel_id','sb_hotel_name','sb_hotel_owner','sb_hotel_email','sb_hotel_website','sb_hotel_website'];
				$this->ajax_list('sb_hotels',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
				break;
			}
			case 4:{ 
			    $this->call_ajax_user_list();
				break;
			}
			case 5:{
				$this->edit_hotel();		
				echo json_encode(array('status'=>'1','message'=>'Hotel User Status Changed'));
				break;
			}
			case 6:{
				$logged_user_type=$this->input->post('logged_user_type');
				$hotel_id=$this->input->post('hotel_id');
				$parent_service_id=$this->input->post('sb_parent_service_id');
				$result=$this->Services_model->get_hotel_child_services_by_parent_service($hotel_id,$parent_service_id);
				echo json_encode($result);
				break;
			}
			
			case 7 : {
				$this->get_hotel_child_service_of_parent();
				break;
			}
			case 8 : {
				$this->update_hotel_services();
				break;
			}
			//We have used this for vendor grid.
			case 9 :{
				$output=$this->ajax_vendor_list();
				//output to json format
				echo json_encode($output);
				break;
			}
			
			//This case is to get in vendorname is not repeating.
			case 10:{
			    $output=$this->Vendor_model->find_vendor($this->input->post('vendorname'));
				echo json_encode($output);
				break;
			}
			//This case is to insert vendor.
			case 11:{
			    $insertData=array(
						  "vendor_name"=>$this->input->post('vendorname'),
						  "address"=>$this->input->post('vendoraddress'),
						  "phone"=>$this->input->post("phone1"),
						  "phone2"=>$this->input->post("phone2"),
						  "web"=>$this->input->post("web1"),
						  "web2"=>$this->input->post("web2"),
						  "stars"=>$this->input->post("vendorstar"),
						  "country"=>$this->input->post("country"),
						  "state"=>$this->input->post("state"),
						  "city"=>$this->input->post("city")
						  );
			    $output=$this->Vendor_model->create_vendor($insertData);
				echo json_encode($output);
				break;
			}

			//This case is to get in vendorname is not repeating for edit.
			case 12:{
			    $output=$this->Vendor_model->find_vendor_edit($this->input->post('vendorname'),$this->input->post('vendor_id'));
				echo json_encode($output);
				break;
			}
			
			//This case is to edit vendor.
			case 13:{
				$output=$this->edit_vendor();
			    echo json_encode($output);
				break;
			}
			//This case is to edit vendor/Soft Delete Or Recover Vendor.
			case 14:{
			    $output=$this->change_vendor_status();
				echo json_encode($output);
				break;
				 
			}
			//This case is to getServices List.
			case 15:{
			    $output=$this->get_service_list();
				echo json_encode($output);
				//echo json_encode($_POST);
				break;	 
			}
			//This case is to create guest.
			case 16:{
				$this->save_guest_data();
				break;
			}
			//This case is to show all guest list.
			case 17:{
				$columnnames=['sb_hotel_guest_booking_id','sb_hotel_id','sb_guest_reservation_code','sb_guest_firstName','sb_guest_lastName','sb_guest_email','sb_guest_contact_no','sb_guest_check_in_date','sb_guest_check_out_date','sb_guest_rooms_alloted','sb_guest_created_on'];
				$output=$this->ajax_guest_list('sb_hotel_guest_bookings',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
				echo json_encode($output);
				break;
			}
			//This case is to show arrival guest list.
			case 18:{
				$columnnames=['sb_hotel_guest_booking_id','sb_hotel_id','sb_guest_reservation_code','sb_guest_firstName','sb_guest_lastName','sb_guest_email','sb_guest_contact_no','sb_guest_check_in_date','sb_guest_check_out_date','sb_guest_rooms_alloted','sb_guest_created_on'];
				$output=$this->ajax_arrival_list('sb_hotel_guest_bookings',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
				echo json_encode($output);
				break;
			}
			default:{
			}
		}
	}
	/*This method is used to edit vendor
    * @param string
	* return true 
    */
	public function edit_vendor()
    {
		$updateData=array(
						  "vendor_name"=>$this->input->post('vendorname'),
						  "address"=>$this->input->post('vendoraddress'),
						  "phone"=>$this->input->post("phone1"),
						  "phone2"=>$this->input->post("phone2"),
						  "web"=>$this->input->post("web1"),
						  "web2"=>$this->input->post("web2"),
						  "stars"=>$this->input->post("vendorstar"),
						  "country"=>$this->input->post("country"),
						  "state"=>$this->input->post("state"),
						  "city"=>$this->input->post("city")
						  );
	    $output=$this->Vendor_model->edit_vendor($updateData,$this->input->post('vendor_id'));
		return $output;		
    } 
   /*This method is used to decide how ajax user list grid is called according to user role
    *@params void
	* return void
    */
    public function call_ajax_user_list()
    {
		$columnnames=['sb_hotel_user_id','sb_hotel_username','sb_hotel_useremail','sb_hotel_user_type','sb_hotel_user_type'];
			if($this->session->userdata('logged_in_user')->sb_hotel_user_type == 'm'){
					$this->load->model('Services_model');
					$user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
					$parent_service=$this->Services_model->get_hotel_user_parent_service($user_id);
					$this->ajax_user_list($this->input->post('tablename'),$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,$this->input->post('hotel_id'),$this->input->post('user_type'),$this->input->post('page_type'),$parent_service[0]['sb_parent_service_id']);
				}
			else{
					$this->ajax_user_list($this->input->post('tablename'),$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames,$this->input->post('hotel_id'),$this->input->post('user_type'),$this->input->post('page_type'),0);
				}
    } 	
   /*This method is used to change vendor status
    * @param void
	* return true 
    */
	public function change_vendor_status()
	{
		if($this->input->post('vendorstatus') == '1')
			{
				$updateData=array("status"=>'0');
			}
		else{
				$updateData=array("status"=>'1');
			}
		$output=$this->Vendor_model->edit_vendor($updateData,$this->input->post('vendor_id'));
		return $output;
	}
	/* Method to Return States List In Json Format Via Ajax According to Country Id
	 * @param void
	 * return void
	 */
	public function get_states($country_id)
	{	
		echo getCountryStates($country_id,'json');
		exit;
	}
	/* Method to Return Cities List In Json Format Via Ajax According to State Id
	 * @param void
	 * return void
	 */
	public function get_cities($state_id)
	{	
		echo getStateCities($state_id,'json');
		exit;
	}
	/* Method to Return Vendor List 
	 * @param void
	 * return array
	 */
	public function ajax_vendor_list(){
		$columnnames=['vendor_id','vendor_name','country','state','city','address','stars','phone','phone2','web','web2','status'];
		$list = $this->Common_model->get_datatables('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
		$data = array();
		$no =$this->input->post('start');
			foreach ($list as $vendor) {
					$no++;
					$row = array();
					$row[] 				= $vendor->vendor_id;
					$row[] 				= $vendor->vendor_name;
					if($vendor->status == '1'){
						$row[] ='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$vendor->vendor_id.',\''.$vendor->vendor_name.'\','.$vendor->country.','.$vendor->state.','.$vendor->city.',\''.$vendor->address.'\','.$vendor->stars.',\''.$vendor->phone.'\',\''.$vendor->phone2.'\',\''.$vendor->web.'\',\''.$vendor->web2.'\');"><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.'<a class="btn btn-sm btn-danger" id="delete" href="#"  onclick="changevendorstatus('.$vendor->vendor_id.','.$vendor->status.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					}
					else{
						$row[]='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$vendor->vendor_id.',\''.$vendor->vendor_name.'\','.$vendor->country.','.$vendor->state.','.$vendor->city.',\''.$vendor->address.'\','.$vendor->stars.',\''.$vendor->phone.'\',\''.$vendor->phone2.'\',\''.$vendor->web.'\',\''.$vendor->web2.'\');"><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.'<a class="btn btn-sm btn-success" id="restore" href="#" data-href="#" onclick="changevendorstatus('.$vendor->vendor_id.','.$vendor->status.');" title="Restore" ><i class="glyphicon glyphicon-file"></i>Restore</a>';
					}
					$data[] = $row;
				}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Common_model->count_all('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->Common_model->count_filtered('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);
		return $output;
	}
	/* Method to Return Hotel Users List In Json Format (For Datatable)
	 * @param void
	 * return void
	 */
	public function ajax_user_list($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
		$this->load->model('Hoteluser_model');
		$list = $this->Hoteluser_model->get_datatables($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $hotel) {
			$no++;
			$row = array();
			$row[] = $hotel->sb_hotel_user_id;
			$row[] = $hotel->sb_hotel_username;
			$row[] = $hotel->sb_hotel_useremail;
			
			switch($hotel->sb_hotel_user_type)
				{
				    case 'u':$row[] ="System Admin";break;
					case 'a':$row[] ="Hotel Admin";break;
					case 'm':$row[] ="Hotel Manager";break;
					case 's':$row[] ="Hotel Staff";break;
				}
			$editurl =base_url("admin/user/edit_hotel_user/".$hotel->sb_hotel_user_id);
			$viewurl =base_url("admin/user/view_hotel_user/".$hotel->sb_hotel_user_id);
			$viewserviceurl = base_url("admin/staffreport/index/".$hotel->sb_hotel_user_id);
				if($hotel->sb_hotel_user_status == '1'){
					$tbl_row='<a  href="'.$editurl.'" title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
					'<a href="'.$viewurl.'" title="View" ><img src="'.FOLDER_ICONS_URL."details.png".'" /></a>'."  ";
					if($hotel->sb_hotel_user_type == 's')
					{ 
					  $tbl_row =$tbl_row ."  ".'<a href="'.$viewserviceurl.'" title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>';
					}
                    $tbl_row = $tbl_row."  ".'<a  id="delete" href="#"  onclick="changehoteluserstatus('.$hotel->sb_hotel_user_id.','.$hotel->sb_hotel_user_status.');" title="Delete" ><img src="'.FOLDER_ICONS_URL."active.png".'" /></a>';
				  					
				    $row[]=$tbl_row; 
				}
				else{
					$tbl_row ='<a  href="'.$editurl.'" title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
					'<a  href="'.$viewurl.'" title="View" ><img src="'.FOLDER_ICONS_URL."details.png".'" /></a>'."  ";
					if($hotel->sb_hotel_user_type == 's')
					{ 
					  $tbl_row =$tbl_row."  ".'<a href="'.$viewserviceurl.'" title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>';
					}
					$tbl_row =$tbl_row."  ".'<a  id="restore" href="#"  onclick="changehoteluserstatus('.$hotel->sb_hotel_user_id.','.$hotel->sb_hotel_user_status.');" title="Restore" ><img src="'.FOLDER_ICONS_URL."Inactive.png".'" /></a>';
 	
				    $row[]=$tbl_row; 
				}
			$data[] = $row;
		}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Hoteluser_model->count_all($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service),
					"recordsFiltered" => $this->Hoteluser_model->count_filtered($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service),
					"data" => $data
				);
		//output to json format
		echo json_encode($output);
	}
	/* Method to Return Hotels List In Json Format (For Datatable)
	 * @param void
	 * return void
	 */
	public function ajax_list($tablename,$orderkey,$orderdir,$columns)
	{
		$list = $this->Common_model->get_datatables($tablename,$orderkey,$orderdir,$columns);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $hotel) {
			$no++;
			$row = array();
			$row[] 				= $hotel->sb_hotel_name;
			$row[] 				= $hotel->sb_hotel_owner;
			$row[] 				= $hotel->sb_hotel_email;
			$row[] 				= $hotel->sb_hotel_website;
			$editurl 			= base_url("admin/hotel/edit_hotel/".$hotel->sb_hotel_id);
			$viewurl 			= base_url("admin/hotel/view_hotel/".$hotel->sb_hotel_id);
			$deleteurl  		= base_url("admin/hotel/delete_hotel/".$hotel->sb_hotel_id);
			$serviceurl			= base_url("admin/HotelServices/edit/".$hotel->sb_hotel_id);
			if($hotel->is_active == '1'){
				$row[]=	'<a href="'.$editurl.'"  title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
						'<a href="'.$viewurl.'"  title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>'."  ".
						'<a id="delete" href="#" title="Delete" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');"><img src="'.FOLDER_ICONS_URL."active.png".'" /></a>'."  ".
						'<a href="'.$serviceurl.'" title="View Services Details" ><img src="'.FOLDER_ICONS_URL."details.png".'"></a>';
		    }
			else{
				$row[]=	'<a href="'.$editurl.'"   title="Edit" ><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
				        '<a href="'.$viewurl.'"   title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>'."  ".
						'<a id="restore" href="#" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');" data-target="#confirm-delete" title="Restore" ><img src="'.FOLDER_ICONS_URL."Inactive.png".'" /></a>'."  ".
						'<a href="'.$serviceurl.'" title="View Services Details" ><img src="'.FOLDER_ICONS_URL."details.png".'"></a>';
			}
			$data[] = $row;
		}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Common_model->count_all($tablename,$orderkey,$orderdir,$columns),
					"recordsFiltered" => $this->Common_model->count_filtered($tablename,$orderkey,$orderdir,$columns),
					"data" => $data,
				 );
		//output to json format
		echo json_encode($output);
		exit;
	}
   /* This function is to Edit Hotel Via ajax
    * @param void
	* return void
	*/
	function edit_hotel(){
		$hotel_user_id=$this->input->post('hotel_user_id');
		$hotel_user_status=$this->input->post('sb_hotel_user_status');
			if($hotel_user_status == 1)
				{
					$status=0;
				}
			else
				{
					$status =1;
				}
			$data=array(
					'sb_hotel_user_status'=>$status	
				);
		$this->Hotel_model->edit_hotel_user($data,$hotel_user_id);
	}
	/*This method is used to get services listing
    * @param string
	* return true 
    */
	public function get_service_list()
    {
	    $type=$this->input->post('type');
		$tablename='sb_hotel_parent_services';
		$subservicetable="";
		if($type == 'Parent'){$tablename = 'sb_hotel_parent_services';$subservicetable='sb_hotel_child_services';}
		if($type == 'Child'){$tablename = 'sb_hotel_child_services';$subservicetable='sb_sub_child_services';}
		if($type == 'Subchild'){$tablename = 'sb_sub_child_services';$subservicetable='';}
	    $output=$this->Services_model->get_services($tablename,$subservicetable);
		return $output;		
    } 
	function get_hotel_child_service_of_parent()
	{
		if($this->input->post('return_type'))
		{
			$this->return_type = $this->input->post('return_type');
		}else
		{
			$this->return_type = 'json';
		}
		$this->output = $this->Services_model->get_hotel_child_services_by_parent_service($this->input->post('hotelId'),$this->input->post('parentId'));
		$this->render_ouput();		
	}

	function update_hotel_services()
	{
		if($this->input->post('return_type'))
		{
			$this->return_type = $this->input->post('return_type');
		}else
		{
			$this->return_type = 'json';
		}

		for($cnt = 0 ; $cnt < count($this->input->post('chkBoxArr'));$cnt ++ )
		{
			$child_id 	= explode('_',$this->input->post('chkBoxArr')[$cnt]['val']);
			$check_val	= explode('_',$this->input->post('chkBoxArr')[$cnt]['isChecked']);
			$data       = array('sb_is_service_in_use' => $check_val[0]);
			$this->db->where('sb_hotel_id',$this->input->post('hotelId'));
			$this->db->where('sb_child_service_id',$child_id[1]);
			$this->db->update('sb_hotel_service_map',$data);
		}

		echo '1';
	}

	function render_ouput()
	{
		if($this->return_type == 'json')
		{
			echo json_encode($this->output);
			exit;
		}
		else
		{
			echo $this->output;
		}
	}

	function save_guest_data() 
	{
		$this->load->model('Guest_model');
		$hotel_id 			= $this->session->logged_in_user->sb_hotel_id;
		$temp_date			= explode('-',$this->input->post('inoutdates'));
		
		$booking_array  = array('sb_hotel_id' 			=> $hotel_id,
						   'sb_guest_firstName' 		=> $this->input->post('firstname'),
						   'sb_guest_lastName'			=> $this->input->post('lastname'),
						   'sb_guest_email'				=> $this->input->post('email'),
						   'sb_guest_contact_no'		=> $this->input->post('phone'),
						   'sb_guest_rooms_alloted'		=> $this->input->post('noOfrooms'),
						   'sb_guest_check_in_date'		=> date("Y-m-d h:i:s",strtotime($temp_date[0])),
						   'sb_guest_check_out_date'	=> date("Y-m-d h:i:s",strtotime($temp_date[1])),
						   
						   );
		// Saving new guest booking
		$save_guest_booking 	= $this->Guest_model->insert_guest_booking($booking_array);
		// Generating confirmation string 
		//$generate_confm_id		= $this->generate_confirmation_id($save_guest_booking,$hotel_id);
		$generate_confm_id 			= $this->input->post('confId');
		$insert_confirmation_id	= $this->Guest_model->update_guest_reservation_code($save_guest_booking,$generate_confm_id);
		
		echo $generate_confm_id;
	}

	/* Method generate confirmation code for last
	 * booking 
	 * @param int
	 * return string
	 */
	function generate_confirmation_id($last_booking_id = null , $hotel_id = null)
	{
		$confm_string 		 	 = '#';
		$guest_last_booking_data = $this->Guest_model->select_guest_booking($last_booking_id,$hotel_id);
		if(!empty($guest_last_booking_data[0]))
		{
			foreach($guest_last_booking_data[0] as $key => $val)
			{
				if(!empty($val))
				{
					$confm_string .= substr($val,0,2);
				}					
			}
		}
		$confm_string		.= "-".$last_booking_id;
		return $confm_string;
	}
    /* Method generate list of guests
	 * booking 
	 * @param string,int,int,array
	 * return array
	 */
	public function ajax_guest_list($tablename,$orderkey,$orderdir,$columns)
	{
	    $this->load->model('Guestgrid_model');
		$list = $this->Guestgrid_model->get_datatables($tablename,$orderkey,$orderdir,$columns);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $guest) {
			$no++;
			$row = array();
			$row[]				= $guest->sb_hotel_guest_booking_id;
			$row[] 				= $guest->sb_guest_lastName;
			$row[] 				= $guest->sb_guest_firstName;
			$row[] 				= $guest->sb_guest_email;
			$row[] 				= $guest->sb_guest_contact_no;
			$row[]				='<span class="label label-warning"><a href="javascript:void(0)">'. $guest->sb_guest_reservation_code.'</a></span>';
			$row[] 				= $guest->sb_guest_rooms_alloted;
			$reservation_code	= $guest->sb_hotel_guest_booking_id;   
			$guestalloted		= $guest->sb_guest_rooms_alloted;	
			//onclick="allocateRoom(\''.$guest->sb_guest_reservation_code.'\','.$guest->sb_guest_rooms_alloted.');" 
			$row[]				='<a id="allocate" href="'.base_url("admin/HotelRooms/Roomcheckin/$reservation_code/$guestalloted").'"  title="Allocate Rooms" ><img src="'.FOLDER_ICONS_URL."Allocate.png".'" /></a>'." ".
								  '<a href="'.base_url("admin/HotelRooms/Roomcheckout/$reservation_code").'"  title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>';
			$data[] = $row;
		}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Guestgrid_model->count_all($tablename,$orderkey,$orderdir,$columns),
					"recordsFiltered" => $this->Guestgrid_model->count_filtered($tablename,$orderkey,$orderdir,$columns),
					"data" => $data,
				 );
		//output to json format
		echo json_encode($output);
		exit;
	}
	/* Method generate list of todays arriving guests
	 * booking 
	 * @param string,int,int,array
	 * return array
	 */
	public function ajax_arrival_list($tablename,$orderkey,$orderdir,$columns)
	{
	    $this->load->model('Arrivalgrid_model');
		$list = $this->Arrivalgrid_model->get_datatables($tablename,$orderkey,$orderdir,$columns);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $guest) {
			$no++;
			$row = array();
			$row[]				= $guest->sb_hotel_guest_booking_id;
			$row[] 				= $guest->sb_guest_lastName;
			$row[] 				= $guest->sb_guest_firstName;
			$row[] 				= $guest->sb_guest_email;
			$row[] 				= $guest->sb_guest_contact_no;
			$row[]				='<span class="label label-warning"><a href="javascript:void(0)">'. $guest->sb_guest_reservation_code.'</a></span>';
			$row[] 				= $guest->sb_guest_rooms_alloted;
			$reservation_code	= $guest->sb_hotel_guest_booking_id;   
			//$row[]				='<a id="allocate" href="#" onclick="allocateRoom(\''.$guest->sb_guest_reservation_code.'\','.$guest->sb_guest_rooms_alloted.');"  title="Allocate Rooms" ><img src="'.FOLDER_ICONS_URL."Allocate.png".'" /></a>'." ".
				//				  '<a href="'.base_url("admin/HotelRooms/Roomcheckout/$reservation_code").'"  title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>';
			$row[]				='<a id="allocate" href="'.base_url("admin/HotelRooms/Roomcheckin/$reservation_code/$guestalloted").'"  title="Allocate Rooms" ><img src="'.FOLDER_ICONS_URL."Allocate.png".'" /></a>'." ".
								  '<a href="'.base_url("admin/HotelRooms/Roomcheckout/$reservation_code").'"  title="View" ><img src="'.FOLDER_ICONS_URL."View-Details.png".'" /></a>';
		
			$data[] = $row;
		}
		$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Arrivalgrid_model->count_all($tablename,$orderkey,$orderdir,$columns),
					"recordsFiltered" => $this->Arrivalgrid_model->count_filtered($tablename,$orderkey,$orderdir,$columns),
					"data" => $data,
				 );
		//output to json format
		echo json_encode($output);
		exit;
	}
}//End Of Controller Class

