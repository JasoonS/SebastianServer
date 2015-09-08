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

}
?>