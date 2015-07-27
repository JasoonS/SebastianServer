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
			    
				 $this->ajax_list($this->input->post('tablename'),$this->input->post('orderkey'),$this->input->post('orderdir'),$this->input->post('columns'));
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
			$row[] = $hotel->sb_hotel_name;
			$row[] = $hotel->sb_hotel_owner;
			$row[] = $hotel->sb_hotel_email;
			$row[] = $hotel->sb_hotel_website;
			//$row[] = $hotel->sb_hotel_website;
			$url =base_url("admin/user/edit_hotel/".$hotel->sb_hotel_id);
			$row[] ='<a class="btn btn-sm btn-primary" href="'.$url.'" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
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
		
	

}

