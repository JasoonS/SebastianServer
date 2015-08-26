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
function upload_image($folderName,$fieldName)
	{
		$CI = & get_instance(); 
		$file_ext = substr(strrchr($_FILES[$fieldName]['name'],'.'),1);
		$name= time();
		$config = array(
				'upload_path' => "./$folderName",
				'allowed_types' => "jpeg|jpg|png|gif",
				'overwrite' => TRUE,
				'file_name' => $name.".".$file_ext
			);
		$CI->load->helper('file');
		$CI->load->library('upload', $config);
		if($CI->upload->do_upload($fieldName))
			{
				$data = array('upload_data' => $CI->upload->data());
				return $data['upload_data']['file_name'];
						//return $data['upload_data']['file_name'];
			}
			else
			{
				$error = array('error' => $CI->upload->display_errors());
				return "";//$error;
			}
	}

/* Function check for password hash
 * @param string
 * return TRUE on success FALSE if fails
 */
function verifyPasswordHash($password,$hash_and_salt)
{
	if (password_verify($password, $hash_and_salt))
	{
		
		return TRUE;
	}else
	{
		
		return FALSE;
	}
		
}

/* Function create hash and salt password
 * @param string
 * return string 
 */
function createHashAndSalt($user_provided_password)
{
	$options = [
		'cost' => 11,
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	];

	$hash = password_hash($user_provided_password, PASSWORD_BCRYPT,$options);

	return $hash;
}

/*Function To Send An Email To User
*/
function sendMail($from = '',$to,$subject,$message)
{
	if($from='')
		$from = 'no-reply@sebastian.com';
    include 'email_library.php'; // include the library file
    include "classes/class.phpmailer.php"; // include the class name
    $mail	= new PHPMailer; // call the class 
	$mail->IsSMTP(); 
	$mail->Host = SMTP_HOST; //Hostname of the mail server
	$mail->Port = SMTP_PORT; //Port of the SMTP like to be 25, 80, 465 or 587
	$mail->SMTPAuth = true; //Whether to use SMTP authentication
	$mail->Username = SMTP_UNAME; //Username for SMTP authentication any valid email created in your domain
	$mail->Password = SMTP_PWORD; //Password for SMTP authentication
	$mail->AddReplyTo($from); //reply-to address
	$mail->SetFrom($from, "Sebastian"); //From address of the mail
		// put your while loop here like below,
	$mail->Subject = $subject; //Subject od your mail
	$mail->AddAddress($to, ""); //To address who will receive this email
	$mail->MsgHTML( $message); //Put your body of the message you can place html code here
		//$mail->AddAttachment("images/asif18-logo.png"); //Attach a file here if any or comment this line, 
	$send = $mail->Send();
    if($send)
	{
		return true;
	}

	else
	{
		return false;
	}		
}

	
/*Function To Get All Languages List
*/
function getAllLanguages($format='array')
{
	$CI = & get_instance(); 
	$CI->load->model('Utility_model');
	$languagelist=$CI->Utility_model->get_all_languages();
	if($format == 'array')
	{
		return  $languagelist;
	}
	else
	{
		return json_encode( $languagelist);
	}			
}

/* Method redirect user to specfied page
 * with specified message 
 */
function redirectWithErr($err_level,$redirect_controller)
{
	$CI = & get_instance();
	$CI->session->set_flashdata('AuthMsg', $err_level);
	redirect('admin/'.$redirect_controller);
}

/* Method check user access level
 * granted by admin , to hotel admin
 * @param void
 * return void
 */
function check_user_access_level()
{
	$CI = & get_instance();

	// Get the user's ID and add it to the config array
	$config = array('userID'=>$CI->session->userdata('logged_in_user')->sb_hotel_user_id);

	// Load the ACL library and pas it the config array
	$CI->load->library('acl',$config);
}

/*	Method To Create Random Password generation
 *  @param void
 *  return string
 */
function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	$pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}
