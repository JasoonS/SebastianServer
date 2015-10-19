<?php
/* Class responsible for managing guest 
 * profiles added in a hotel
 * admin can access all guest profile corresponding to a hotel
 * hotel users can access only guest inside their hotel
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Guestprofiles extends CI_Controller
{
	public $data 			= array();
	public $guest_info		= array();
	public $guest_fname 	= '';
	public $guest_lanme 	= '';
	public $guest_email		= '';
	public $guest_booking	= '';

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logged_in_user'))
		{
			redirectWithErr(ERR_MSG_LEVEL_2,'login');
		}else
		{
			// Get the user's ID and add it to the config array
			$config = array('userID'=>$this->session->userdata('logged_in_user')->sb_hotel_user_id);
			// Load the ACL library and pas it the config array
			$this->load->library('acl',$config);
		}
		$this->load->model('Guest_model');
		$this->load->helper('admin/utility_helper');
	}

	/* Method is to get Guest Listing
	 * input -void
	 * output -view render
	 */
	public function guest()
	{
	    $requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}

		if($this->session->userdata('logged_in_user')->sb_hotel_id !=0)
		{
			$this->data['title'] = 'Guest Profiles';
			$this->data['guest_list']	= $this->Guest_model->get_guest_data($this->session->userdata('logged_in_user')->sb_hotel_id);
			$this->template->load('page_tpl', 'hotel_guest_list_vw',$this->data);
		}
	}
	
	/* Method is to get Guest Listing
	 * input -void
	 * output -view render
	 */
	public function guest_arrivals()
	{
	    $requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}

		if($this->session->userdata('logged_in_user')->sb_hotel_id !=0)
		{
			$this->data['title'] = 'Arrivals';
			$this->data['guest_list']	= $this->Guest_model->get_guest_data($this->session->userdata('logged_in_user')->sb_hotel_id);
			$this->template->load('page_tpl', 'hotel_guest_arrivals_vw',$this->data);
		}
	}
	/* Method is to get Guest History
	 * input -void
	 * output -view render
	 */
	public function guest_history()
	{
	    $requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = 'Guest History';
		$this->template->load('page_tpl', 'modules_vw',$this->data);
		
	}
	/* Method is to get Guest Feedback
	 * input -void
	 * output -view render
	 */
	public function feedback()
	{
	    $requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$this->data['title'] = 'Guest Feedback';
		$guest_feedbacks = $this->Guest_model->getFeedbacks($this->session->userdata('logged_in_user')->sb_hotel_id);
		$this->data['guest_feedbacks']=$guest_feedbacks;
		$this->template->load('page_tpl', 'feedback_vw',$this->data);	
	}
	/* Method is to get Guest Feedback Grid
	 * input -void
	 * output -view render
	 */
	public function get_feedback()
	{
	    $this->load->model('GuestFeedgrid_model');
		$columnnames=['sb_guest_firstName','sb_guest_lastName','special_hotel_person','feedback','suggestion','sent_date'];
		$list = $this->GuestFeedgrid_model->get_datatables('sb_feedback',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames);
		$data = array();
		$no =$this->input->post('start');
		foreach ($list as $rest) {
					$no++;
					$row = array();
					$row[] 				= $rest->sb_guest_firstName;
					$row[] 				= $rest->sb_guest_lastName;
					$row[]				= $rest->special_hotel_person;	
					$row[] 				= $rest->suggestion;
					$row[]				= $rest->feedback;
					$row[] 				= $rest->sent_date;
					
					/*$row[] 				= $rest->sb_hotel_restaurant_details;
					$row[] 				= $rest->sb_rest_image;
					if($rest->is_delete == '0'){
						$row[] ='<a  href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
						        '<a  id="delete" href="#"  onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Delete" ><img src="'.FOLDER_ICONS_URL."active.png".'"></a>';
					}
					else{
						$row[]='<a  href="#" title="Edit" onclick="edit('.$rest->sb_hotel_restaurant_id.',\''.$rest->sb_hotel_restaurant_name.'\''.',\''.$rest->sb_hotel_restaurant_details.'\''.',\''.$rest->sb_rest_image.'\''.')";><img src="'.FOLDER_ICONS_URL."edit.png".'"></a>'."  ".
							   '<a  id="restore" href="#" data-href="#" onclick="changevendorstatus('.$rest->sb_hotel_restaurant_id.',\''.$rest->is_delete.'\''.');" title="Restore" ><img src="'.FOLDER_ICONS_URL."Inactive.png".'"></a>';
						      
					}*/
					$data[] = $row;
				}

				$output = array(
					"draw" => $this->input->post("draw"),
					"recordsTotal" => $this->GuestFeedgrid_model->count_all('sb_feedback',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"recordsFiltered" => $this->GuestFeedgrid_model->count_filtered('sb_feedback',$this->input->post('orderkey'),$this->input->post('orderdir'),$columnnames),
					"data" => $data
				);

				echo json_encode($output);
	}
}
?>