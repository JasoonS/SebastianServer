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
		$this->load->model('Hoteluser_model');
		$this->load->model('User_model');
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
			  
				 $this->ajax_user_list($this->input->post('tablename'),$this->input->post('orderkey'),$this->input->post('orderdir'),$this->input->post('columns'),$this->input->post('hotel_id'),$this->input->post('user_type'),$this->input->post('page_type'));
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
	public function ajax_user_list($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype)
	{
		$list = $this->Hoteluser_model->get_datatables($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype);
	
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
							"recordsTotal" => $this->Hoteluser_model->count_all($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype),
							"recordsFiltered" => $this->Hoteluser_model->count_filtered($tablename,$orderkey,$orderdir,$columns,$hotel_id,$type,$pagetype),
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
			$row[] = $hotel->sb_hotel_id;
			//$row[]='<input style="" class="tableflat icheckbox_flat-green" type="checkbox">';
			//$row[] ="<input type=checkbox class=tableflat>";
			$row[] = $hotel->sb_hotel_name;
			$row[] = $hotel->sb_hotel_owner;
			$row[] = $hotel->sb_hotel_email;
			$row[] = $hotel->sb_hotel_website;
			$editurl =base_url("admin/hotel/edit_hotel/".$hotel->sb_hotel_id);
			$viewurl =base_url("admin/hotel/view_hotel/".$hotel->sb_hotel_id);
			$deleteurl =base_url("admin/hotel/delete_hotel/".$hotel->sb_hotel_id);

		

			if($hotel->is_active == '1'){
				$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'"  title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
						'<a class="btn btn-sm btn-warning" href="'.$viewurl.'"  title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
						'<a class="btn btn-sm btn-danger" id="delete" href="#"  data-toggle="modal" data-target="#myModal"  title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		    }
			else{
				$row[]=	'<a class="btn btn-sm btn-primary" href="'.$editurl.'"   title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.

				        '<a class="btn btn-sm btn-warning" href="'.$viewurl.'"   title="View" ><i class="glyphicon glyphicon-search"></i> View</a>'.
						'<a class="btn btn-sm btn-success" id="restore" href="#" data-toggle="modal" data-target="#myModal" title="Restore" ><i class="glyphicon glyphicon-save-file"></i>Restore</a>';
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

