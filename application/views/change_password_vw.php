 <script>
function form_validate()
{
	var old_password=document.getElementById("old_password").value;
	var new_password=document.getElementById("new_password").value;
	var conf_password=document.getElementById("conf_password").value;
	if(new_password!=conf_password)
	{
		alert("New and Confirm password not same");
		return false;
	}

}

 </script>
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
        <h4 style="color:red"><?php echo $this->session->flashdata('change_success');
        echo $this->session->flashdata('change_fail'); ?></h4>
	    <form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" role="form" onsubmit="return form_validate()" name="changePassword_form">
		    <div class="row">
	    		<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel classRequiredPanel">
	    				<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

		                	<div class = "form-group classFormInputsBox">
                    			<label for="sbOldPassword" class="col-xs-4 control-label">Enter Old Password  </label>
							    <div class="col-xs-6">
							      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email">!-->
							      	<input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control" required></input>
							    </div>
							</div>
							<div class = "form-group classFormInputsBox">
							    <label for="sbNewPassword" class="col-xs-4 control-label" >Enter New Password  </label>
							    <div class="col-xs-6">
							      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email">!-->
							      	<input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control" required></input>
							    </div>
							</div>
							<div class = "form-group classFormInputsBox">							
							    <label for="sbConfPassword" class="col-xs-4 control-label">Enter Confirm Password  </label>
							    <div class="col-xs-6">
							      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email">!-->
							      	<input type="password" name="conf_password" id="conf_password" placeholder="Confirm Password" class="form-control" required></input>
							    </div>
							</div>
							<div class="control-group">
								<div class="controls">
									<button id="submit"  class="btn btn-primary btn-lg btn-block">Change Password</button>
								</div>
							</div>	
                    		</div>
                    	</div>
                    </div>
				</div>
			</div>
		</form>
	</div>
</div>