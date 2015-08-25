	<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">    
	<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-checktree.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-checktree.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <h4 style="color:green"><?php echo $this->session->flashdata('UPLOAD_PROFILEPIC_SUCCESS'); ?></h4>
     	<h4 style="color:red"><?php echo $this->session->flashdata('UPLOAD_PROFILEPIC_FAIL'); ?></h4>
	    <form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" role="form" name="uploadProfilePic_form">
		    <div class="row">
	    		<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel classRequiredPanel">
	    				<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

		                	<div class = "form-group classFormInputsBox">
                    			<label for="sbOldPassword" class="col-xs-4 control-label">Enter Old Password : </label>
							    <div class="col-xs-6">
							      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email">!-->
							      	<input type="file" name="sb_hotel_user_pic" id="sb_hotel_user_pic" class="form-control" required></input>
							    </div>
							</div>
							<div class="control-group">
								<div class="controls">
									<button id="submit"  class="btn btn-primary btn-lg btn-block">Upload Image</button>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>