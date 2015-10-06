<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Iospush {
	/*
		title - This is customize library to send PUSH-NOTIFICATION on iOS device
	 	----------------------------------------------------------------------------
		|	@param = $iospushdata (associative array)
	 	|	return type- 0, 1
	 	|	created on - 24th Feb 2015
	 	|	created by - AKshay Patil
	*/
    public function iospush_notification($iospushdata)
    {
    	error_reporting(0);
    	 // print_r($iospushdata); die();
		$server = "dev";

		if($server == 'dev')
			$url = "ssl://gateway.sandbox.push.apple.com:2195";
		else
			$url = "ssl://gateway.push.apple.com:2195";
		//this this password set for .pem file
		$passphrase = 'sebastian';
		// Put your alert message here:
		//$message = $iospushdata['message'];
		$data = $iospushdata['message'];
		$message = $data['message'];

		if(array_key_exists("type",$data))
		{
			$body['type'] = $data['type'];
		}
		if(array_key_exists("title",$data))
		{
			$body['title'] = $data['title'];
		}
		if(array_key_exists("id",$data))
		{
			$body['id'] = $data['id'];
		}

		$deviceToken = $iospushdata['deviceToken'];
		// print_r($deviceToken[0]); die();
		////////////////////////////////////////////////////////////////////////////////
		if($iospushdata['user'] == 'customer')
			$pemPath = 'push/customer/SebastianCustomerCK.pem';
		else
			$pemPath = 'push/staff/SebastianStaffCK.pem';
		// echo $pemPath; die;
		$arrContextOptions=array(
		    "ssl"=>array(
		        "verify_peer"=>false,
		        "verify_peer_name"=>false,
		    ),
		);
		$ctx = stream_context_create($arrContextOptions);
		stream_context_set_option($ctx, 'ssl', 'local_cert', $pemPath);
		stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
		
		// Open a connection to the APNS server
		$fp = stream_socket_client(
			$url, $err,
			$errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
		
		if (!$fp)
		{
			return 2;
			//exit("Failed to connect: $err $errstr" . PHP_EOL);
		}	
		else
		{
			//echo 'Connected to APNS' . PHP_EOL;
			// Create the payload body
			$body['aps'] = array(
				'alert' => $message,
				'sound' => 'default'
				);
			
			// Encode the payload as JSON
			$payload = json_encode($body);
			$result ='';
			//print_r($deviceToken);
			for($i=0; $i<count($deviceToken); $i++)
			{// Build the binary notification
				sleep(1);
				$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken[$i]) . pack('n', strlen($payload)) . $payload;
			
			// Send it to the server
				//echo strlen($msg);
				//usleep(2000);
				$result = fwrite($fp, $msg, strlen($msg));
			}
			if (!$result)
			{
				return 0;
				fclose($fp);
			}//echo 'Message not delivered' . PHP_EOL;
			else
			{	return 1;
				fclose($fp);
				//echo 'Message successfully delivered' . PHP_EOL;
			}
			// Close the connection to the server
		}    	
    }
}

/* End of file Iospush.php */