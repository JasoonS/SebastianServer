<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('admin/utility');
		$this->load->model('Hotel_model');
		$this->load->model('Common_model');
	}
	/*
		This function decides which function to call after ajax call
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
			    
				 $this->ajax_user_list($this->input->post('tablename'),$this->input->post('orderkey'),$this->input->post('orderdir'),$this->input->post('columns'));
				 break;
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
	public function ajax_user_list($tablename,$orderkey,$orderdir,$columns)
	{
		$list = $this->Common_model->get_datatables($tablename,$orderkey,$orderdir,$columns);
	
		$data = array();
		
		$no =$this->input->post('start');
		foreach ($list as $hotel) {
			$no++;
			$row = array();
			$row[] = $hotel->sb_hotel_user_id;
			$row[] = $hotel->sb_hotel_username;
			$row[] = $hotel->sb_hotel_useremail;
			$row[] = $hotel->sb_hotel_user_type;
			
			$editurl =base_url("admin/user/edit_hotel_user/".$hotel->sb_hotel_user_id);
			$viewurl =base_url("admin/user/view_hotel_user/".$hotel->sb_hotel_user_id);
			$deleteurl =base_url("admin/user/delete_hotel_user/".$hotel->sb_hotel_user_id);
			$row[] ='<a class="btn btn-sm btn-primary" href="'.$editurl.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
					'<a class="btn btn-sm btn-warning" href="'.$viewurl.'" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
					'<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="'.$deleteurl.'" onclick="deletehoteluser('.$hotel->sb_hotel_user_id.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
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
			$row[]='<div style="position: relative;" class="icheckbox_flat-green"><input style="position: absolute; opacity: 0;" class="tableflat" type="checkbox"><ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins></div>';
			$row[] = $hotel->sb_hotel_name;
			$row[] = $hotel->sb_hotel_owner;
			$row[] = $hotel->sb_hotel_email;
			$row[] = $hotel->sb_hotel_website;
			$editurl =base_url("admin/hotel/edit_hotel/".$hotel->sb_hotel_id);
			$viewurl =base_url("admin/hotel/view_hotel/".$hotel->sb_hotel_id);
			$deleteurl =base_url("admin/hotel/delete_hotel/".$hotel->sb_hotel_id);
				if($hotel->is_active == '1'){
					$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
							'<a class="btn btn-sm btn-warning" href="'.$viewurl.'" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
							'<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="'.$deleteurl.'" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
			    }
				else{
					$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
					        '<a class="btn btn-sm btn-warning" href="'.$viewurl.'" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
							'<a class="btn btn-sm btn-success" id="restore" href="#" data-href="'.$deleteurl.'" onclick="changehotelstatus('.$hotel->sb_hotel_id.','.$hotel->is_active.');" title="Delete" ><i class="glyphicon glyphicon-save-file"></i>Restore</a>';
			      
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
}

