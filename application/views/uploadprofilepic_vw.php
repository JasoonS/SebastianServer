<?php /*	<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">    
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
*/?>
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<div class="right_col" role="main">
	<!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('category_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('UPLOAD_PROFILEPIC_SUCCESS') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('category_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('UPLOAD_PROFILEPIC_FAIL') ?> </div>
		<?php } ?>
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
    
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
                    			<label for="sbOldPassword" class="col-xs-4 control-label">User Picture</label>
							    <div class="col-xs-6">
							      <input id="sb_hotel_user_pic" name="sb_hotel_user_pic"  type="file" style="display:none"/>
								    <button id='btn-upload'>Upload</button>
                                </div>	
								<div id="id_filePreview" class="col-xs-6">
									<img id="id_uploadImage" style="width:100%;height:100%" src="<?php echo base_url(HOTEL_USER_PIC).'/'.$this->session->logged_in_user->sb_hotel_user_pic; ?>" alt="your image" />
									
								</div>							    
								</div>
							
							<div class="form-group classFormInputsBox">
								<div class="controls">
									<button id="submit"  class="btn btn-primary btn-lg btn-block">Change Profile Image</button>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<script type = "text/javascript">
/* This Function is used To Show Uploaded image */
	function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$("#id_uploadImage").show(200);
					$('#id_uploadImage').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		/* Change Event is bind to Hidden File Upload Control*/
	$("#sb_hotel_user_pic").change(function(){
			readURL(this);
		});	
		/* Button Click To trigger change event on hidden file upload control*/
	$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#sb_hotel_user_pic').click();
		});
</script>