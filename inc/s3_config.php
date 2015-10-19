<?php
// Bucket Name
$bucket="thesebastian";
if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
// if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIVH752YX27VQUTMA');
// if (!defined('awsSecretKey')) define('awsSecretKey', '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');
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAJAL5OEAVVFFNQ4UQ');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>