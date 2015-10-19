<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Feedback_model extends CI_Model
{
	public function insert_feedbck($insert_arr)
	{
		$val = $this->db->insert('sb_feedback', $insert_arr);
		return $val; 
	}
}	
