<?php
/* Notes controller class 
 * perform creation of Notes.
 * all user related
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notes extends CI_Controller 
{
	public $user_acl = array();
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hotel_model');
		$this->load->model('User_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
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
	/* This method is to show view Of Create Note.
	 * input -void
	 * output -view
	 */
	public function createnote()
    {
		
		$this->data['action_type']="create";
		$this->data['action']='admin/notes/addnote';
		$this->data['title']="Notes";
		//$this->template->load('page_tpl','hotel_rooms_vw',$data);
		$requested_mod = $this->uri->segment(2).'/'.$this->uri->segment(3);
	
		if(!$this->acl->hasPermission($requested_mod))
		{
			redirect('admin/dashboard');
		}
		$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		$this->data['hotel_id']=$hotel_id;
		$hotel_name=$this->Hotel_model->get_hotel_name($this->data['hotel_id']);
		$this->data['hotel_name']=$hotel_name[0]['sb_hotel_name'];
		$this->template->load('page_tpl','createnote',$this->data);
		
    }	
	
	/* This method is to actually add note in database.
	 * input -void
	 * output -view
	 */
	public function addnote()
    {
	
		$data = $this->input->post();
		//Verify Hotel Data
		$this->validation_rules = array(
		    array('field'=>'sb_hotel_note','label'=>'Note','rules'=>'required','class'=>'text-danger')
		);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($this->validation_rules);
		if ($this->form_validation->run() == FALSE)
		{
			$this->data['action']='admin/notes/addnote';	
			$this->data['action_type']="create";
		    $this->data['title']="Notes";
			$hotel_id=$this->session->userdata('logged_in_user')->sb_hotel_id;
		    $this->data['hotel_id']=$hotel_id;
		    $hotel_name=$this->Hotel_model->get_hotel_name($this->data['hotel_id']);
		    $this->data['hotel_name']=$hotel_name[0]['sb_hotel_name'];
			$this->template->load('page_tpl','createnote',$this->data);
		}else{
			$notedata['sb_hotel_id']=$data['sb_hotel_id'];
			$notedata['sb_note']=$data['sb_hotel_note'];
			$notedata['sb_note_time']=date('Y-m-d h:i:s',strtotime($data['note_event_day']." ".$data['sb_hotel_note_time']));
			$notedata['sb_note_type']=$data['sb_hotel_note_type'];
			$this->load->model('Notes_model');
			$this->Notes_model->create_note($notedata);
			$this->session->set_flashdata('category_success',"Note Created Successfully.");
			redirect('admin/notes/createnote');
			
		}
    }	
}//End Of Controller Class.

