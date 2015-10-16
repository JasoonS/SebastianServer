<?php if( ! defined('BASEPATH')) exit('No direct script access allowed');
class Hotelmenu_model extends CI_Model
{

	function gethotelmenu($sb_hotel_id)
	{
		
			$IMP_PATH = PARENT_SERVICE_PIC;
			$sql1 = "SELECT `sb_parent_service_id`,`sb_parent_service_name`,
					CONCAT('$IMP_PATH',`sb_parent_service_image`) as `sb_parent_service_image`,`sb_parent_service_color`,
					`sb_parent_service_created_on` 
					FROM `sb_hotel_parent_services` 
					WHERE `sb_parent_service_id` in(SELECT distinct(`sb_parent_service_id`) FROM `sb_hotel_service_map` WHERE `sb_hotel_id` = '$sb_hotel_id')";
			$query = $this->db->query($sql1);
			$services = $query->result_array();
			if(count($services) == 0)
			{
				$service =array();
			}
			else
			{
				$removeindex = array();
				for ($i=0; $i < count($services); $i++) {
					$sb_parent_service_id = $services[$i]['sb_parent_service_id'];
					$subchild = $this->get_submenu($sb_hotel_id, $sb_parent_service_id);
					if(count($subchild)===0)
					{
						array_push($removeindex, $i);
					}
				}
				for ($i=0; $i < count($removeindex); $i++) { 
					$index = $removeindex[$i];
					if($index != 7)
					unset($services[$index]);
				}
				$services = array_values($services);
				$service = $services;
			}
						
			$result = array(
				"services" => $service,
				);
			return $result;
		
	}

	

	function get_submenu($sb_hotel_id, $sb_parent_service_id)
	{
		$IMP_PATH = CHILD_SERVICE_PIC;
		$qry =  "SELECT DISTINCT m.sb_child_service_id,
				c.`sb_child_service_id`,c.`sb_parent_service_id`,
				c.`sb_child_servcie_name`,c.`sb_child_servcie_detail`,
				concat('$IMP_PATH',c.child_service_image) as `child_service_image`,
				c.`sb_child_service_created_on`,c.`is_service`  
				from sb_hotel_child_services c 
				join sb_hotel_service_map m ON c.sb_child_service_id = m.sb_child_service_id
				join sb_hotel_parent_services s ON s.sb_parent_service_id = m.sb_parent_service_id
				where m.sb_parent_service_id = '$sb_parent_service_id' AND m.sb_hotel_id = '$sb_hotel_id'
				AND sb_is_service_in_use = '1'";
				
		$query = $this->db->query($qry);
		$data = $query->result_array();
		//print_r($data);die;
		return $data;
	}



}
?>	