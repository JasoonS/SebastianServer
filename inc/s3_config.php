<?php
// Bucket Name
$bucket="thesebastian";
if (!class_exists('S3'))require_once('S3.php');
			
if (!defined('awsAccessKey')) define('awsAccessKey', '');
if (!defined('awsSecretKey')) define('awsSecretKey', '');
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>