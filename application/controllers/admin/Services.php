<?php
/* Login controller class 
 * perform checks for valid authorization and
 * all login and logout activities
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class services extends CI_Controller 
{
	
	
	public function __construct()
	{
		parent::__construct();
		//$this->load->library('session');
		$this->load->model('Hotel_model');
		$this->load->model('Services_model');
		$this->load->helper('admin/utility_helper');
	}


	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function select_services()
	{	
		//Check If User is logged in otherwise redirect to login page.
	
		$this->data['action']	= "admin/services/add_hotel_services";
		$this->data['user_email']=$this->session->userdata('user_email');
		$this->data['hotel_id']=$this->Hotel_model->get_hotel_id($this->data['user_email']);
		$hotel_name=$this->Hotel_model->get_hotel_name($this->data['hotel_id']);
		$this->data['hotel_name']=$hotel_name[0]['sb_hotel_name'];
		$this->data['serviceslist'] =$this->Services_model->get_all_services();
		$this->data['hotelserviceslist']=$this->Services_model->get_hotel_services($this->data['hotel_id']);
		$this->data['servicestree']=$this->createservicestree($this->data['serviceslist'],$this->data['hotelserviceslist']);
		$this->template->load('create_hotel_tpl', 'hotel_services',$this->data);
			
	}
	
	/* Method render add Hotel View If User is super administrator
	 * @param void
	 * return void
	 */
	public function add_hotel_services()
	{	
		//Check If User is logged in otherwise redirect to login page.
	   
		$postdata=array();
		$this->data['action']	= "admin/services/add_hotel_services";
		$this->data['user_email']=$this->session->userdata('user_email');
		$this->data['hotel_id']=$this->Hotel_model->get_hotel_id($this->data['user_email']);
		$hotel_name=$this->Hotel_model->get_hotel_name($this->data['hotel_id']);
		$this->data['hotel_name']=$hotel_name[0]['sb_hotel_name'];
		$this->data['serviceslist'] =$this->Services_model->get_all_services();
		$this->data['hotelserviceslist']=$this->Services_model->get_hotel_services($this->data['hotel_id']);
		$this->data['servicestree']=$this->createservicestree($this->data['serviceslist'],$this->data['hotelserviceslist']);
	    foreach($_POST as $key => $value) {
			if (strpos($key, 'cservice') === 0) {
				$valuearray=explode("_",$key);
				$singlearray=array("sb_parent_service_id"=>$valuearray[3],
							 "sb_child_service_id"=>$valuearray[1],
                             "sb_hotel_id"=>$this->data['hotel_id']							 
				);
				array_push($postdata,$singlearray);
			}
		}
		$this->data['serviceslist'] =$this->Services_model->update_hotel_services($postdata,$this->data['hotel_id']);
		$this->session->set_flashdata('category_success', 'Hotel Services Updated Successfully.');
		redirect('admin/services/select_services');
			
	}
	/*
	This Function Creates Hotel Services Checkbox Tree View
	*/
	function createservicestree($serviceslist,$hotelserviceslist)
	{
		$count =0 ;$cnt =0;
		$groupArray = array();
		$hotelChildServicesArray=array();
		$hotelParentServicesArray=array();
		while($cnt<count($serviceslist))
								{
									array_push($groupArray,$serviceslist[$cnt]['sb_parent_service_name']);
									
									$cnt++;
								}
		$cnt=0;	
		while($cnt<count($hotelserviceslist))
								{
									array_push($hotelChildServicesArray,$hotelserviceslist[$cnt]['sb_child_service_id']);
									array_push($hotelParentServicesArray,$hotelserviceslist[$cnt]['sb_parent_service_id']);
									
									$cnt++;
								}			
								
		$arrayValues=array_count_values($groupArray);
		
		$html="<ul id='tree'>";
		while($count<count($serviceslist))
		{
				if($count > 0){
					if($serviceslist[$count]['sb_parent_service_id'] == $serviceslist[$count-1]['sb_parent_service_id'])
						{
						}
					else
						{
							$parentServiceName=$serviceslist[$count]['sb_parent_service_name'];
						
								if($arrayValues[$parentServiceName]>0)
								{
									$servicecount = 0;
									$checked ="";
										$parentservice=$serviceslist[$count]['sb_parent_service_id'];
										if (in_array($parentservice, $hotelParentServicesArray)) {
											$checked = 'checked';
										}
										else
										{
											$checked ='';
										}
									$html.="<li><label><input type='checkbox' $checked id='parent_service_".$serviceslist[$count]['sb_parent_service_id']."' />".$serviceslist[$count]['sb_parent_service_name']."</label>";
								
									while($servicecount<$arrayValues[$parentServiceName])
									{
										$checked ="";
										$childservice=$serviceslist[$count]['sb_child_service_id'];
										if (in_array($childservice, $hotelChildServicesArray)) {
											$checked = 'checked';
										}
										else
										{
											$checked ='';
										}
										$html.="<ul><li><label><input type='checkbox' ".$checked."  id='cservice_".$serviceslist[$count]['sb_child_service_id']."_pservice".$serviceslist[$count]['sb_parent_service_id']."' name='cservice_".$serviceslist[$count]['sb_child_service_id']."_pservice_".$serviceslist[$count]['sb_parent_service_id']."'/>".$serviceslist[$count]['sb_child_service_name']."</label></li>";
										$servicecount++;
										$count++;
									}
										$html.="</ul></li>";
								}
						}
				}	
				else
				{
					$parentServiceName=$serviceslist[$count]['sb_parent_service_name'];
							if($arrayValues[$parentServiceName]>0)
							{
								$servicecount = 0;
								$checked ="";
										$parentservice=$serviceslist[$count]['sb_parent_service_id'];
										if (in_array($parentservice, $hotelParentServicesArray)) {
											$checked = 'checked';
										}
										else
										{
											$checked ='';
										}
								$html .="<li><label><input type='checkbox' $checked id='parent_service_".$serviceslist[$count]['sb_parent_service_id']."' />".$serviceslist[$count]['sb_parent_service_name']."</label>";
								while($servicecount<$arrayValues[$parentServiceName])
								{
									 $checked ="";
										$childservice=$serviceslist[$count]['sb_child_service_id'];
										if (in_array($childservice, $hotelChildServicesArray)) {
											$checked = 'checked';
										}
										else
										{
											$checked ='';
										}
								  
									$html.= "<ul><li><label><input type='checkbox' ".$checked. " id='cservice_".$serviceslist[$count]['sb_child_service_id']."_pservice".$serviceslist[$count]['sb_parent_service_id']."' name='cservice_".$serviceslist[$count]['sb_child_service_id']."_pservice_".$serviceslist[$count]['sb_parent_service_id']."'/>".$serviceslist[$count]['sb_child_service_name']."</label></li></ul>";
									$servicecount++;
									$count++;
								}
								$html .="</li>";
							}
				}

			}
		$html .="</ul>";
		return $html;
	}
	
	
}

