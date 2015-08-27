<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="<?php echo THEME_ASSETS; ?>images/favicon.ico"> 
	
	<title><?php echo $title ?></title>

	 
	<!-- Bootstrap core CSS and Required Theme Js -->
	 
	<link href="<?php echo THEME_ASSETS;  ?>css/bootstrap.min.css" rel="stylesheet">
	 
	<link href="<?php echo THEME_ASSETS;  ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?php echo THEME_ASSETS;  ?>css/animate.min.css" rel="stylesheet">
	 
	<!-- Custom styling plus plugins -->
	<link href="<?php echo THEME_ASSETS;  ?>css/custom.css" rel="stylesheet">
	<link href="<?php echo THEME_ASSETS;  ?>css/icheck/flat/green.css" rel="stylesheet">
	<link href="<?php echo THEME_ASSETS;  ?>css/style.css" rel="stylesheet">
	<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>

	<script src="<?php echo THEME_ASSETS;  ?>js/jquery.min.js"></script>
    <script src="<?php echo THEME_ASSETS;  ?>js/customjs/constants.js"></script>
	<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
	


	 
	<!--[if lt IE 9]>
	<script src="../assets/js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	 
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body class="nav-md">

    <div class="container body">


        <div class="main_container">

        	<?php $this->load->view('templates/side_nav_tpl'); ?>

        	<?php $this->load->view('templates/top_nav_tpl'); ?>

        	<?php echo $body; ?>
        </div>
    </div>

</body>
<html/>

		



