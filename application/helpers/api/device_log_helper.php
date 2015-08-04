<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function device_log($SERVER,$REQUEST)
    {
        
        $arr = array();
        if(array_key_exists("UNIQUE_ID",$SERVER))
        {
            $arr['UNIQUE_ID'] = $SERVER['UNIQUE_ID'];
        }
        if(array_key_exists("HTTP_ORIGIN",$SERVER))
        {
            $arr['HTTP_ORIGIN'] = $SERVER['HTTP_ORIGIN'];
        }
        if(array_key_exists("REQUEST_URI",$SERVER))
        {
            $arr['REQUEST_URI'] = $SERVER['REQUEST_URI'];
        }
        if(array_key_exists("HTTP_USER_AGENT",$SERVER))
        {
            $arr['HTTP_USER_AGENT'] = $SERVER['HTTP_USER_AGENT'];
        }
        if(array_key_exists("REMOTE_ADDR",$SERVER))
        {
            $arr['REMOTE_ADDR'] = $SERVER['REMOTE_ADDR'];
        }
        $arr['REQUEST'] = $REQUEST;
                
        $file_name = date('Y-m-d').".txt";
        $myfile = fopen("api_log/".$file_name, "a+");
		$txt = json_encode($arr);
		$txt .= "\n\n";
		fwrite($myfile, $txt);
		fclose($myfile);

    }   
