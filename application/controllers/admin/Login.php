<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public $data = array();
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/* Index method render
	 * login page
	 * @param void
	 * return void
	 */
	public function index()
	{		
		$this->template->load('login_tpl', 'login_vw',$this->data);
	}
}

