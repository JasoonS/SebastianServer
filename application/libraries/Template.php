<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Default template class for
 * rendering layouts
 */
class Template
{
	public $ci;
	 
	function __construct()
	{
		$this->ci =& get_instance();
	}
	
	/* Method render module
	 * specfic layouts as per parametere
	 * @param string,string,string
	 * return void
	 */
	function load($tpl_view, $body_view = null, $data = null)
	{
		 // print_r($tpl_view); echo(" "); // print_r($body_view); echo(" "); print_r($data); echo(" "); die();
		if ( ! is_null( $body_view ) )
		{
			if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view ) )
			{
				$body_view_path = $tpl_view.'/'.$body_view;
				 // print_r($body_view_path); die();
			}
			else if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view.'.php' ) )
			{
				$body_view_path = $tpl_view.'/'.$body_view.'.php';
				 // print_r($body_view_path); die();

			}
			else if ( file_exists( APPPATH.'views/'.$body_view ) )
			{
				$body_view_path = $body_view;
				 // print_r($body_view_path);  die();
			}
			else if ( file_exists( APPPATH.'views/'.$body_view.'.php' ) )
			{
				$body_view_path = $body_view.'.php';
				// print_r($body_view_path); die();
			}
			else
			{
				// echo("sam"); die();
				show_error('Unable to load the requested file: ' . $tpl_name.'/'.$view_name.'.php');
			}
			 
			$body = $this->ci->load->view($body_view_path, $data, TRUE);
			 
			if ( is_null($data) )
			{
				$data = array('body' => $body);
			}
			else if ( is_array($data) )
			{
				$data['body'] = $body;
			}
			else if ( is_object($data) )
			{
				$data->body = $body;
			}
		}
		 
		$this->ci->load->view('templates/'.$tpl_view, $data);
	}
}