<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    /**
     * This is utility helper which contains common functionality
     * created on - 22nd July,2015;
     * updated on - 
     * created by - Kalyani
     */


/*
	This Function gives all countries in json format or array.
*/ 
function getCountryList($format='array')
{
	$CI =& get_instance();
    $CI->load->model('Utility_model');
	$countrylist=$CI->Utility_model->get_country_list();
	if($format == 'array')
	{
		return $countrylist;
	}
	else
	{
		return json_encode($countrylist);
	}
	
}
/*
	This Function gives states in country in json format or array.
*/
function getCountryStates($country_id,$format='array')
{
	$CI =& get_instance();
    $CI->load->model('Utility_model');
	$statelist=$CI->Utility_model->get_state_list($country_id);

	if($format == 'array')
	{
		return $statelist;
	}
	else
	{
		return json_encode($statelist);
	}
}
/*
	This Function gives cities in state in json format or array.
*/
function getStateCities($state_id,$format='array')
{
	$CI =& get_instance();
    $CI->load->model('Utility_model');
	$citylist=$CI->Utility_model->get_city_list($state_id);

	if($format == 'array')
	{
		return $citylist;
	}
	else
	{
		return json_encode($citylist);
	}
}

/* 
	This function gives all available designation 
*/
function getAllDesignations($format='array')
{
	$CI =& get_instance();
    $CI->load->model('Utility_model');
	$designationlist=$CI->Utility_model->get_all_designations();
	if($format == 'array')
	{
		return $designationlist;
	}
	else
	{
		return json_encode($designationlist);
	}
	
}


/* 
	This function gives list of all available hotels 
*/
function getAllHotels($format='array')
{
	$CI =& get_instance();
    $CI->load->model('Utility_model');
	$hotellist=$CI->Utility_model->get_all_hotels();
	if($format == 'array')
	{
		return $hotellist;
	}
	else
	{
		return json_encode($hotellist);
	}
	
}



/*
	This function gives available User Types according to Logged in User Type.
	If He is Super administrator He cannot see staff type(cannot add staff)
*/
function getAvailableHotelUserTypes($format='array')
{
   $CI = & get_instance();  //get instance, access the CI superobject
   $CI->load->model('Utility_model');
   $hotel_user_types=$CI->Utility_model->get_enum_values( 'sb_hotel_users', 'sb_hotel_user_type' );
   if($format == 'array')
			{
				return  $hotel_user_types;
			}
			else
			{
				return json_encode( $hotel_user_types);
			}	

}

/*
	This function is used to Upload Image
*/
function upload_image($folderName)
	{
		$file_ext = substr(strrchr($_FILES[$folderName]['name'],'.'),1);
		$name= time();
		$config = array(
				'upload_path' => "./user_data/$folderName",
				'allowed_types' => "jpeg|jpg|png|gif",
				'overwrite' => TRUE,
				'file_name' => $name.".".$file_ext
			);
		$this->load->library('upload', $config);
		if($this->upload->do_upload($folderName))
		{
			$data = array('upload_data' => $this->upload->data());
			return $data['upload_data']['file_name'];
		}
		else
		{
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}
	}
