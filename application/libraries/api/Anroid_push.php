<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Anroid_push
{
	function push_notification()
	{
		//echo "AKshay";
		//$message= "Sua conta no moveHair foi bloqueada por questões de segurança. Aguarde um novo contato.";
		//$message= "კომენტარი";
		$message = "હેલો";
		//$message = "您好";
		//$message = "नमस्कार";
		//$message = "Seu estabelecimento foi desbloqueado no moveHair. Acesse agora e receba as solicitações de agendamento de serviços no 'seu celular'";
		//$message = "你好$ *";
		//$message = "Nǐ hǎo $*";
		//$message = "3 New Dealz for you";
		$apiKey = "AIzaSyAccqNeulAAiGmp99GU5s9utvZdgQdNMpY"; 
		$registrationIDs = array("e8S6EFp98lc:APA91bFC6zLebQu6KCtbjSEeVJph-6wPJlJV6FdPALoVeGcJxdfpcXOD3to406swyJoeYsfUmxFQIY5GFIJUC5ntnmhvtDHclxNmMNTyKpg0h1QSoPT5jWuGS-GfVMP4LURoMtFE4tgv");
		$url = 'https://android.googleapis.com/gcm/send';  	
		// Set POST variables
		$fields = array(
			'registration_ids' => $registrationIDs,
			'data' => array( "message"  => $message,
							 )
							);
		$headers = array(
			'Authorization: key=' . $apiKey,
			'Content-Type: application/json'
		);
		$ch = curl_init(); // Open connection
		curl_setopt($ch, CURLOPT_URL, $url );
		// Set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_POST, true );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));
		$result = curl_exec($ch); 	// Execute post	

	    if($result === false)
	        die('Curl failed ' . curl_error());

	    curl_close($ch);
	    //return $result;
		// curl_close($ch);          // Close connection
		$response = json_decode($result);
		print_r($response);
	}	
}	
?>