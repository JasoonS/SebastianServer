<?php
/* Hotel Controller Class
 * perform crud of hotels
 * All Hotels Related
 */
defined('BASEPATH') OR exit('No direct script access allowed');
class Hotel extends CI_Controller 
{
	public $data	 = array();
	public function __construct()
	{
		parent::__construct();

        $this->load->model('Hotel_model');
	}

	public function index()
	{
	    echo "You do not have permission to be here.";
	}
	
	/* Get the names of all the hotels
	 * return string
	 */
	public function listall()
	{
		header('Access-Control-Allow-Origin: *');
		
		$data = $this->Hotel_model->get_hotel_list();

		echo json_encode($data);
	}
}//End Of Controller Class
