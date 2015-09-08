<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Android_push
{
	function push_notification($pushdata)
	{
		$apiKey = "AIzaSyCIn_XQi6ErlAt8HYh55BMYxYUPq_z4G3k";

		$message = $pushdata['message'];
		$registrationIDs = $pushdata['deviceTokens'];//array("e8S6EFp98lc:APA91bFC6zLebQu6KCtbjSEeVJph-6wPJlJV6FdPALoVeGcJxdfpcXOD3to406swyJoeYsfUmxFQIY5GFIJUC5ntnmhvtDHclxNmMNTyKpg0h1QSoPT5jWuGS-GfVMP4LURoMtFE4tgv");
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
		$result = curl_exec($ch);
		// print_r($result); 	// Execute post	;

	 //    if($result === false)
	 //        die('Curl failed ' . curl_error());

	 //    curl_close($ch);
	 //    //return $result;
		// // curl_close($ch);          // Close connection
		// $response = json_decode($result);
		// print_r($response);
		return 1;
	}	
}	
?>