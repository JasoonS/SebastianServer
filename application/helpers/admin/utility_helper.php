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
