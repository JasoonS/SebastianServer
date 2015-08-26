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
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>
<script>
 $("#room_num_prefix").on("keydown",function(e){return e.which !==32;});
 $("#room_num_postfix").on("keydown",function(e){return e.which !==32;});
function formvalidate()
{
	var room_num_from = document.getElementById("room_num_from").value;
	var room_num_to = document.getElementById("room_num_to").value;
	if(room_num_from=="")
	{
		alert("please give From field");
		return false;
	}
	if(room_num_to=="")
	{
		alert("please give To field");
		return false;
	}
	if( room_num_from.trim() > room_num_to.trim() )
	{
		alert("From value must be smaller then To value");
		$("#room_num_from").val("");
		return false;		
	}

}

</script>
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <h4 style="color:green"><?php   echo $this->session->flashdata('rooms_success'); ?> </h4>
		<h4 style="color:red"><?php echo $this->session->flashdata('rooms_error'); ?></h4>
	   <!--  <div class="">		 -->
			<!-- <div style="width:20%;margin:auto;padding:auto;">	 -->	
				<form role="form" method="post" action="<?php   echo BASE_URL.$action ?>" onsubmit="return formvalidate()" class="" name="create_rooms_form">
					 <div class="row">
	    			<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel classRequiredPanel">
	    				<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

                		<div class = "form-group classFormInputsBox" style="height:34px;">
					<!-- <div class="form-group" style="">
					<label for="room_num">Room No.:</label>
					&nbsp;&nbsp;&nbsp;<br> -->
							<label for="room_num_from" class="col-xs-4 control-label">Room No.: From:</label>
							<div class="col-xs-4">
							<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_from" id="room_num_from" required>
							</div>
						</div>	
						<div class = "form-group classFormInputsBox" style="height:34px;">
							<!-- <br/><br/> -->
							<label for="room_num_to" class="col-xs-4 control-label">To:</label>
							<div class="col-xs-4">
							<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_to" id="room_num_to" required>
							</div>
						</div>
						<!-- <br/><br/> -->
						<div class = "form-group classFormInputsBox">
							<label for="room_num_prefix" class="col-xs-4 control-label">Prefix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_prefix" id="room_num_prefix">
							</div>
						</div>
						<br/><br/>
						<div class = "form-group classFormInputsBox">
							<label for="room_num_postfix" class="col-xs-4 control-label">Postfix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_postfix" id="room_num_postfix">
							</div>
						</div>
						<br/><br/>
					<!-- <div class="checkbox">
					<label><input type="checkbox"> Remember me</label>
					</div> -->
					<!-- <input type="submit" class="btn btn-default" value="Submit"></input> -->
						<div class="control-group">
							<div class="controls">
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit"></input>
								<!-- <button id="submit"  class="btn btn-primary btn-lg btn-block">Upload Image</button> -->
							</div>
						</div>
				</form>
			<!-- </div>
		</div> -->
	</div>
</div>
