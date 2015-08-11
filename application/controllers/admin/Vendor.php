<?php
/* Vendor Controller Class
 * perform crud of Vendors
 * All Vendors Related
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor extends CI_Controller 
{
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Common_model');
       
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
	}
    /* This method is to show listing view of vendors
	 *	@ params void
     * 	return view
	 */
	public function index()
	{
		$this->data['title']  = 'Available Vendor List';
		$this->template->load('page_tpl','vendor_list_vw',$this->data);
		
	}
	
}//End Of Controller Class