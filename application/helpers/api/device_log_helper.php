<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function device_log($SERVER,$REQUEST)
    {
        $arr = array(
        'UNIQUE_ID' => $SERVER['UNIQUE_ID'],
        'HTTP_ORIGIN' => $SERVER['HTTP_ORIGIN'],
        'REQUEST_URI' => $SERVER['REQUEST_URI'],
        'HTTP_USER_AGENT' => $SERVER['HTTP_USER_AGENT'],
        'REQUEST' => $REQUEST
        );
        $file_name = date('Y-m-d').".txt";
        $myfile = fopen("api_log/".$file_name, "a+");
		$txt = json_encode($arr);
		$txt .= "\n\n";
		fwrite($myfile, $txt);
		fclose($myfile);

    }   
