<?php
class File_upload extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	public function upload($table,$data)
	{
		$this->db->insert_batch($table, $data);
		return true;
	}
}
?>