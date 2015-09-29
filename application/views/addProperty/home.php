<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo THEME_ASSETS; ?>images/favicon.ico">

    <title>Add Property</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo THEME_ASSETS; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo THEME_ASSETS; ?>css/addProperty/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo THEME_ASSETS; ?>js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    	<div class="customLogin">
	    	<form role="form">
	    		<div class="form-group">
	    			<label for="sb_hotel_name">Property type:</label>
		    		<div id="donate">
					    <label class="blue">
					    	<input type="radio" name="toggle">
					    	<span>Hotel</span>
					    </label>
					    <label class="blue">
					    	<input type="radio" name="toggle">
					    	<span>Restaurant</span>
					    </label>
					</div>
				</div>
			  	<div class="form-group">
				    <label for="sb_hotel_name">Property Name:</label>
				    <input type="text" class="form-control" id="sb_hotel_name" name="sb_hotel_name">
			  	</div>
			  	<div class="form-group">
				    <label for="sb_hotel_username">Hotel UserName:</label>
				    <input type="text" class="form-control" id="sb_hotel_username" name="sb_hotel_username">
			  	</div>
			  	<div class="form-group">
				    <label for="sb_hotel_email">Hotel Email:</label>
				    <input type="email" class="form-control" id="sb_hotel_email" name="sb_hotel_email">
			  	</div>
			    <button type="submit" class="btn btn-info btn-block btn-lg">Submit</button>
			</form>
		</div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo THEME_ASSETS; ?>js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
