<?php
	class Email_mod extends CI_Model
	{
		function __construct()
		{
			parent::__construct();	
		}
		
		function get_username($type)
		{
			$data = array(
			'sb_hotel_user_type' => $type
			);
			$this->db->select('sb_hotel_user_id,sb_hotel_username');	
			$this->db->where($data);
			$this->db->from('sb_hotel_users');
			$get=$this->db->get();
			return $get->result();
		}
	   /*This Method is to get all incoming emails to the user
        *input -void
		* output array
        */   		
		function getAllEmails()
		{
			$hotel_user_id=$this->session->userdata('logged_in_user')->sb_hotel_user_id;
			$this->db->select('sb_hotel_user_id,sb_hotel_users.sb_hotel_id,email_id');
			$this->db->select('(SELECT sb_hotel_username FROM sb_hotel_users WHERE sb_hotel_user_id = sender_id) as sb_hotel_username');	
			$this->db->select('(SELECT sb_hotel_id FROM sb_hotels WHERE sb_hotel_id = hotel_id) as sb_hotel_name');	
			
			$this->db->where('receiver_id',$hotel_user_id);
			$this->db->from('sb_hotel_email');
			$this->db->join('sb_hotel_users', 'sb_hotel_users.sb_hotel_user_id= sb_hotel_email.receiver_id');
			$get=$this->db->get();
			return $get->result();
		}
		
		/*This Method is to get Single Email information
        *input -void
		* output array
        */   		
		function getEmail($id)
		{
			$this->db->select('*');
			$this->db->where('email_id',$id);
			$this->db->from('sb_hotel_email');
			$get=$this->db->get();
			return $get->result();
		}
		/*This Method is to get Hotel User Names
        *input -void
		* output array
        */ 
		function getToUsers($toUsers){
			$this->db->select('sb_hotel_user_id');
			$this->db->where_in('sb_hotel_username',$toUsers);
			$this->db->from('sb_hotel_users');
			$get=$this->db->get();
			return $get->result();
		}
		/*This Method is send Email
         *input -array
		 *output boolean
         */   		
		function sendEmail($data)
		{
			$this->db->insert_batch('sb_hotel_email',$data);
			return true;
		}
		function get_mail($email_id)
		{
			$res = $this->db->query("select * from sb_hotel_email where sender_id ='".$email_id."' order by email_id desc limit 1 ");
			return $res->row();
		}
		
		function email_details($post)
		{
			$data = array(
			'sb_hotel_useremail' => $post['receiver']
			);	
			$this->db->select('sb_hotel_user_id');
			$this->db->where($data);
			$this->db->from('sb_hotel_users');
			$get = $this->db->get();
			//echo $this->db->last_query();exit;
			$res = $get->row();
			
			$data1 = array(
			'hotel_id'		=> 	$this->session->userdata('logged_in_user')->sb_hotel_id,	
			'email_to'		=> 	$post['receiver'],
			'email_from'	=>	$this->session->userdata('logged_in_user')->sb_hotel_username,
			'email_subject' =>  $post['subject'],
			'email_message'	=>	$post['message'],
			'sender_id'		=>	$this->session->userdata('logged_in_user')->sb_hotel_user_id,
			'receiver_id'	=>	$res->sb_hotel_user_id
			);
			$this->db->insert('sb_hotel_email',$data1);
			return 1;
		} 
		
		
	}
?>