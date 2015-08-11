<?php
/* Model handles vendor crud operations
 * vendor searching operations
 */
Class Vendor_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	/* Method create Vendor 
	 * inside system 
	 * @param @array
	 * return @int 
	 */
	function create_vendor($vendor_data)
	{
		$this->db->insert('sb_vendors',$vendor_data);
		return $this->db->insert_id();
	}
	
	/* Method Update Vendor 
	 * inside system 
	 * @param @array
	 * return 1
	 */
	function edit_vendor($vendor_data,$vendor_id)
	{
		$this->db->where('vendor_id',$vendor_id);
		$this->db->update('sb_vendors',$vendor_data);
	
		return '1';
	}
	/* Method Return If Vendor Present  
	 * inside system 
	 * @param @string
	 * return 1 on success and 0 on Fail
	 */
	function find_vendor($vendor_name)
	{
	    $this->db->select('COUNT(`vendor_name`) as vendorcount',false);
		$this->db->where('vendor_name',$vendor_name);
		$query=$this->db->get('sb_vendors');
		return $query->result_array();
	}	
	
}//End Of Vendor Model	