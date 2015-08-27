<?php
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
		$this->load->model('Restaurantgrid_model');
       
		if(!$this->session->userdata('logged_in_user'))
		{
			redirectWithErr(ERR_MSG_LEVEL_2,'login');
		}else
		{
			// Get the user's ID and add it to the config array
			$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
			$this->load->library('acl',$config);
		}
	}
    /* This method is to show listing view of vendors
	 *	@ params void
     * 	return view
	 */
	public function index()
	{
	   $requested_mod = $this->uri->segment(2);
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title']  = 'Available Restaurants List';
		$this->template->load('page_tpl','restaurant_list_view',$this->data);
	}
    /* This method is to add or edit restaurant.
	 *	@ params void
     * 	return view
	 */
	public function insert_restaurant()
	{
	    $requested_mod = $this->uri->segment(2);
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		if(!empty($_POST))
		{
				$insert_data['sb_hotel_id'] = $this->input->post('sb_hotel_id');
				$insert_data['sb_hotel_restaurant_name'] = $this->input->post('sb_rest_name');
				$insert_data['sb_hotel_restaurant_details']  = $this->input->post('sb_rest_desc');
				if (array_key_exists("add",$_POST))
				{
					if(!empty($_FILES['sb_rest_img']['name']))
					{	
						$folderName=RESTAURANT_PIC;
						$pic1 = upload_image($folderName,"sb_rest_img");
						if($pic1 != 0)
						{
							$insert_data['sb_rest_image'] = $pic1;
						}	
					}			
					$r = $this->Restaurant_model->insert_rest($insert_data);
					if ($r>0) 
						{
							$this->data['title']  = 'Available Restaurants List';
							$this->session->set_flashdata('message', 'New Restaurants added successfully.');
							//$this->template->load('page_tpl','restaurant_list_view',$this->data);	
						}
					else
						{
							$this->data['title']  = 'Available Restaurants List';
							$this->session->set_flashdata('message', 'Some error occured.. Try Again');
							//$this->template->load('page_tpl','restaurant_list_view',$this->data);	
						}
			    }
			
		
			// The code below is for updating restaurant
			elseif(array_key_exists("edit",$_POST))
			{
				$insert_data1['sb_hotel_restaurant_name'] = $this->input->post('sb_rest_name');
				$insert_data1['sb_hotel_restaurant_details']  = $this->input->post('sb_rest_desc');
				$sb_hotel_restaurant_id = $this->input->post('sb_hotel_restaurant_id');
				if($_FILES['sb_rest_img']['name'] != '')
				{
					$this->unlink_images($sb_hotel_restaurant_id,$insert_data['sb_hotel_id']);	
					$folderName=RESTAURANT_PIC;
					$pic1 = upload_image($folderName,"sb_rest_img");
						if($pic1 != 0)
						{
							$insert_data1['sb_rest_image'] = $pic1;
						}	
				}
				$r = $this->Restaurant_model->update_rest($insert_data1, $sb_hotel_restaurant_id,$insert_data['sb_hotel_id']);
				if ($r>0) 
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Restaurants Editted successfully.');
					//$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}
				else
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Some error occured.. Try Again');
					//$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}
			}
		}
		else
				{
					$this->data['title']  = 'Available Restaurants List';
					$this->session->set_flashdata('message', 'Image type not valid');
					//$this->template->load('page_tpl','restaurant_list_view',$this->data);	
				}
		redirect('admin/Restaurants');
	}
	/*Method To unlink images while editing restuatrant
	 *input - int,int
     *output -int
	 */

	function unlink_images($sb_hotel_restaurant_id, $sb_hotel_id)
	{
		$img_name = $this->Restaurant_model->get_img($sb_hotel_restaurant_id, $sb_hotel_id);
		$name = $img_name[0]['sb_rest_image'];
		if($name != '')
		{	
			$path = RESTAURANT_PIC."/". $name;
			$a = unlink($path);
		}	
		return 1;
	}		
	/*Method To get Datatable for available restaurants in particular hotel.
	*input -void
	*output -void
	*/
	public function get_restaurants()
	{
	  
		$columnnames=['sb_hotel_restaurant_id','sb_hotel_restaurant_name','sb_hotel_restaurant_details','sb_rest_image','is_delete'];
		$list = $this->Restaurantgrid_model->get_datatables('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
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
						$row[] ='<a  href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
						        '<a  id="delete" href="#"  onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Delete" ><img src="'.FOLDER_ICONS_URL."active.png".'"></a>';
					}
					else{
						$row[]='<a  href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
							   '<a  id="restore" href="#" data-href="#" onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Restore" ><img src="'.FOLDER_ICONS_URL."Inactive.png".'"></a>';
						      
					}
					$data[] = $row;
				}

				$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->Restaurantgrid_model->count_all('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->Restaurantgrid_model->count_filtered('sb_hotel_restaurant',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);

				echo json_encode($output);
	}
    /*Method To make Active restaurant inactive and inactive restaurant active.
	*input -void
	*output -void
	*/
	public function status_change()
	{
	    $requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$sb_hotel_restaurant_id = $this->input->post('sb_hotel_restaurant_id');
		$is_delete = $this->input->post('is_delete');
		if($is_delete == 1)
		{
			$is_delete = 0;
		}
		else
		{
			$is_delete = 1;
		}
		$r = $this->Restaurant_model->change_status($sb_hotel_restaurant_id,$is_delete);
		echo json_encode($r);
	}
	
}//End Of Controller Class