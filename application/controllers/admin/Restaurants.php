<?php
// echo("samrat"); die();
/* Restaurants Controller Class
 * perform crud of Restaurants
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Restaurants extends CI_Controller 
{
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('Restaurant_model');
       
		if(!$this->session->userdata('logged_in_user'))
		{
			redirectWithErr(ERR_MSG_LEVEL_2,'login');
		}else
		{
			// Get the user's ID and add it to the config array
			$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
			// print_r($this->session->userdata()); die();
			// Load the ACL library and pas it the config array
			$this->load->library('acl',$config);
		}
	}
    /* This method is to show listing view of vendors
	 *	@ params void
     * 	return view
	 */
	public function index()
	{
		$this->data['title']  = 'Available Restaurants List';
		$this->template->load('page_tpl','restaurant_list_view',$this->data);
	}

	public function insert_restaurant()
	{
		if(!empty($_POST))
		{
				$insert_data['sb_hotel_id'] = $this->input->post('sb_hotel_id');
				$insert_data['sb_hotel_restaurant_name'] = $this->input->post('sb_rest_name');
				$insert_data['sb_hotel_restaurant_details']  = $this->input->post('sb_rest_desc');
			if (array_key_exists("add",$_POST))
			{
				
				if(!empty($_FILES))
				{	
					$file_ext = strtolower(substr(strrchr($_FILES['sb_rest_img']['name'],'.'),1));
					
					if($file_ext=="gif" || $file_ext=="jpeg" || $file_ext=="png" || $file_ext=="jpg") // chekcing format of image
					{
						$date = date_create();
						$config['file_name'] = date_timestamp_get($date);
						$config['upload_path'] = './uploads/restaurant/';
						$config['allowed_types'] = 'gif|jpg|png';
						
						$this->load->library('upload', $config);
						$this->upload->do_upload("sb_rest_img");
						$err = $this->upload->display_errors();
						$upload = array('upload_data' => $this->upload->data());
						
										
						$insert_data['sb_rest_image'] = $upload['upload_data']['file_name'];
						$r = $this->Restaurant_model->insert_rest($insert_data);
						if ($r>0) 
						{
							$this->data['title']  = 'Available Restaurants List';
							$this->session->set_flashdata('message', 'New Restaurants added successfully.');
							$this->template->load('page_tpl','restaurant_list_view',$this->data);	
						}
						else
						{

							$this->data['title']  = 'Available Restaurants List';
							$this->session->set_flashdata('message', 'Some error occured.. Try Again');
							$this->template->load('page_tpl','restaurant_list_view',$this->data);	
						}

					}
					else
					{
						$this->data['title']  = 'Available Restaurants List';
						$this->session->set_flashdata('message', 'Image type not valid');
						$this->template->load('page_tpl','restaurant_list_view',$this->data);	
					}
				}
				else
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Image type not selected');
					$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}	
			}
			// The code below is for updating restaurant
			elseif(array_key_exists("edit",$_POST))
			{
				
				$insert_data1['sb_hotel_restaurant_name'] = $this->input->post('sb_rest_name');
				$insert_data1['sb_hotel_restaurant_details']  = $this->input->post('sb_rest_desc');
				$sb_hotel_restaurant_id = $this->input->post('sb_hotel_restaurant_id');
				// print_r($_FILES['sb_rest_img']); 
				if(!empty($_FILES))
				{
					echo("sam"); die();
					
					$this->unlink_images($sb_hotel_restaurant_id,$insert_data['sb_hotel_id']);	
					$file_ext = strtolower(substr(strrchr($_FILES['sb_rest_img']['name'],'.'),1));
					
					if($file_ext=="gif" || $file_ext=="jpeg" || $file_ext=="png" || $file_ext=="jpg") // chekcing format of image
					{
						$date = date_create();
						$config['file_name'] = date_timestamp_get($date);
						$config['upload_path'] = './uploads/restaurant/';
						$config['allowed_types'] = 'gif|jpg|png';
						
						$this->load->library('upload', $config);
						$this->upload->do_upload("sb_rest_img");
						$err = $this->upload->display_errors();
						$upload = array('upload_data' => $this->upload->data());
						$insert_data1['sb_rest_image'] = $upload['upload_data']['file_name'];
					}	
				}

				$r = $this->Restaurant_model->update_rest($insert_data1, $sb_hotel_restaurant_id,$insert_data['sb_hotel_id']);
				if ($r>0) 
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Restaurants Editted added successfully.');
					$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}
				else
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Some error occured.. Try Again');
					$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}
			}
		
		}
	}

	function unlink_images($sb_hotel_restaurant_id, $sb_hotel_id)
	{
		
		$img_name = $this->Restaurant_model->get_img($sb_hotel_restaurant_id, $sb_hotel_id);
		
		$name = $img_name[0]['sb_rest_image'];
		
		echo $path = './uploads/restaurant/'. $name;
		unlink($path);
		return 1;
	}		
	

	public function get_restaurants()
	{
		// print_r($_POST); die();
		$columnnames=['sb_hotel_restaurant_id','sb_hotel_restaurant_name','sb_hotel_restaurant_details','sb_rest_image','is_delete'];
		$list = $this->Common_model->get_datatables('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $rest) {
					$no++;
					$row = array();
					$row[] 				= $rest->sb_hotel_restaurant_id;
					$row[] 				= $rest->sb_hotel_restaurant_name;
					$row[] 				= $rest->sb_hotel_restaurant_details;
					$row[] 				= $rest->sb_rest_image;
					if($rest->is_delete == '0'){
						$row[] ='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
						        '<a class="btn btn-sm btn-danger" id="delete" href="#"  onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Delete" ><i class="glyphicon glyphicon-trash"></i> Delete</a>';
					}
					else{
						$row[]='<a class="btn btn-sm btn-primary" href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><i class="glyphicon glyphicon-pencil"></i> Edit</a>'.
							   '<a class="btn btn-sm btn-success" id="restore" href="#" data-href="#" onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Restore" ><i class="glyphicon glyphicon-file"></i>Restore</a>';
						      
					}
					$data[] = $row;
				}

				$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Common_model->count_all('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->Common_model->count_filtered('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);

				echo json_encode($output);
	}

	public function status_change()
	{
		$sb_hotel_restaurant_id = $this->input->post('sb_hotel_restaurant_id');
		$is_delete = $this->input->post('is_delete');
		// print_r($sb_hotel_restaurant_id); print_r($is_delete); die();
		if($is_delete == 1)
		{
			$is_delete = 0;
		}
		else
		{
			$is_delete = 1;
		}
		// print_r($is_delete); die();
		$r = $this->Restaurant_model->change_status($sb_hotel_restaurant_id,$is_delete);
		echo json_encode($r);

	}
	
}//End Of Controller Class