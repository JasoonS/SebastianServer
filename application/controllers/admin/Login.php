<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		die('inside login');	
		//$this->load->view('welcome_message');
		
	}
}

