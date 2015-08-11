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
		$this->load->model('Hoteluser_model');
		$this->load->model('User_model');
		$this->load->model('Services_model');
		$this->load->model('Vendor_model');
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
				break;
			}
			case 5:{
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
			//We have used this for vendor grid
			case 9 :{
				$columnnames=['vendor_id','vendor_name','status'];
				$list = $this->Common_model->get_datatables('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
				$data = array();
				$no =$this->input->post('start');
				foreach ($list as $vendor) {
					$no++;
					$row = array();
					$row[] 				= $vendor->vendor_id;
					$row[] 				= $vendor->vendor_name;
					if($vendor->status == '1'){
						$row[] ='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$vendor->vendor_id.',\''.$vendor->vendor_name.'\');"><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.'<a class="btn btn-sm btn-danger" id="delete" href="#"  onclick="changevendorstatus('.$vendor->vendor_id.','.$vendor->status.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					}
					else{
						$row[]='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$vendor->vendor_id.',\''.$vendor->vendor_name.'\');"><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.'<a class="btn btn-sm btn-success" id="restore" href="#" data-href="#" onclick="changevendorstatus('.$vendor->vendor_id.','.$vendor->status.');" title="Restore" ><i class="glyphicon glyphicon-file"></i>Restore</a>';
					}
					$data[] = $row;
				}
				$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Common_model->count_all('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->Common_model->count_filtered('sb_vendors',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);
				//output to json format
				echo json_encode($output);
				break;
			}
			
			//This case is to get in vendorname is not repeating
			case 10:{
			    $output=$this->Vendor_model->find_vendor($this->input->post('vendorname'));
				echo json_encode($output);
				break;
			}
			//This case is to insert vendor
			case 11:{
			    $insertData=array("vendor_name"=>$this->input->post('vendorname'));
			    $output=$this->Vendor_model->create_vendor($insertData);
				echo json_encode($output);
				break;
			}

			//This case is to get in vendorname is not repeating for edit
			case 12:{
			    $output=$this->Vendor_model->find_vendor_edit($this->input->post('vendorname'),$this->input->post('vendor_id'));
				echo json_encode($output);
				break;
			}
			
			//This case is to edit vendor
			case 13:{
			    $updateData=array("vendor_name"=>$this->input->post('vendorname'));
			    $output=$this->Vendor_model->edit_vendor($updateData,$this->input->post('vendor_id'));
				echo json_encode($output);
				break;
			}
			//This case is to edit vendor/Soft Delete Or Recover Vendor
			case 14:{
			     if($this->input->post('vendorstatus') == '1')
				 {
					$updateData=array("status"=>'0');
				 }
				 else{
					$updateData=array("status"=>'1');
				 }
				$output=$this->Vendor_model->edit_vendor($updateData,$this->input->post('vendor_id'));
				echo json_encode($output);
				break;	 
			}
			case 15:{
				$this->save_guest_data();
			}
			default:{
			}
		}
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
	/* Method to Return Hotel Users List In Json Format (For Datatable)
	 * @param void
	 * return void
	 */
	public function ajax_user_list($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype,$by_parent_service)
	{
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
			$deleteurl =base_url("admin/user/delete_hotel_user/".$hotel->sb_hotel_user_id);
				if($hotel->sb_hotel_user_status == '1'){
					$row[] ='<a class="btn btn-sm btn-primary" href="'.$editurl.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
					'<a class="btn btn-sm btn-warning" href="'.$viewurl.'" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
					'<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="'.$deleteurl.'" onclick="changehoteluserstatus('.$hotel->sb_hotel_user_id.','.$hotel->sb_hotel_user_status.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
				}
				else{
					$row[] ='<a class="btn btn-sm btn-primary" href="'.$editurl.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
					'<a class="btn btn-sm btn-warning" href="'.$viewurl.'" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
					'<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="'.$deleteurl.'" onclick="changehoteluserstatus('.$hotel->sb_hotel_user_id.','.$hotel->sb_hotel_user_status.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
			//$row[] = $hotel->sb_hotel_id;
			//$row[]='<input style="" class="tableflat icheckbox_flat-green" type="checkbox">';
			//$row[] ="<input type=checkbox class=tableflat>";
			$row[] 				= $hotel->sb_hotel_name;
			$row[] 				= $hotel->sb_hotel_owner;
			$row[] 				= $hotel->sb_hotel_email;
			$row[] 				= $hotel->sb_hotel_website;
			$editurl 			= base_url("admin/hotel/edit_hotel/".$hotel->sb_hotel_id);
			$viewurl 			= base_url("admin/hotel/view_hotel/".$hotel->sb_hotel_id);
			$deleteurl  		= base_url("admin/hotel/delete_hotel/".$hotel->sb_hotel_id);
			$serviceurl			= base_url("admin/HotelServices/edit/".$hotel->sb_hotel_id);
			if($hotel->is_active == '1'){
				$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'"  title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
						'<a class="btn btn-sm btn-warning" href="'.$viewurl.'"  title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
						'<a class="btn btn-sm btn-danger"  id="delete" href="#" title="Delete" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');"><i class="glyphicon glyphicon-trash"></i> Delete</a>'.
						'<a class="btn btn-sm btn-dark btn-round" href="'.$serviceurl.'" title="View/Edit" >Services</a>';
		    }
			else{
				$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'"   title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
				        '<a class="btn btn-sm btn-warning" href="'.$viewurl.'"   title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
						'<a class="btn btn-sm btn-dark btn-round" id="restore" href="#" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');" data-target="#confirm-delete" title="Restore" ><i class="glyphicon glyphicon-save-file"></i>Restore</a>'.
						'<a class="btn btn-sm btn-dark btn-round" href="'.$serviceurl.'" title="View/Edit" >Services</a>';
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
		echo '<pre>';
		print_r($_POST);
		exit;
	}
}//End Of Controller Class

