<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotel_service_model extends CI_Model
{

	function get_submenu($sb_hotel_id, $sb_parent_service_id)
	{
		$qry =  "Select c.* from sb_hotel_child_services c join sb_hotel_service_map m ON c.sb_child_service_id = m.sb_child_service_id
				 join sb_hotel_parent_services s ON s.sb_parent_service_id = m.sb_parent_service_id
				 where m.sb_parent_service_id = '$sb_parent_service_id' AND m.sb_hotel_id = '$sb_hotel_id'";
				
		$query = $this->db->query($qry);
		return $query->result_array();
	}
}
?>	

/*ALTER TABLE  `sb_hotel_request_service` CHANGE  `sb_hotel_requst_ser_id`  `sb_hotel_requst_ser_id` INT( 10 ) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key';*/