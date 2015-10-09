<?php
// Bucket Name
$bucket="akshaytestbucket";
if (!class_exists('S3'))require_once('S3.php');
			
//AWS access info
if (!defined('awsAccessKey')) define('awsAccessKey', 'AKIAIVH752YX27VQUTMA');
if (!defined('awsSecretKey')) define('awsSecretKey', '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');
			
//instantiate the class
$s3 = new S3(awsAccessKey, awsSecretKey);

$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);

?>