
<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>

<script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>



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

 <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('category_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('rooms_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('category_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('rooms_error') ?> </div>
		<?php } ?>


    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
      
				<form role="form" method="post" action="<?php   echo BASE_URL.$action ?>" onsubmit="return formvalidate()" class="" name="create_rooms_form">
					 <div class="row">
	    			<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel ">
	    				<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

                		<div class = "form-group classFormInputsBox">
				
							<label for="room_num_from" class="col-xs-4 control-label">Room No.: From:</label>
							<div class="col-xs-2">
							<input type="text" class="form-control" data-min="1" data-max="50" data-zeros="true" name="room_num_from" id="room_num_from"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
					

							<label for="room_num_to" class="col-xs-1 control-label">To:</label>
							<div class="col-xs-2">
							<input type="text" class="form-control" data-min="1" data-max="50" data-zeros="true" name="room_num_to" id="room_num_to" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>

							</div>
						</div>
						<!-- <br/><br/> -->
						<div class = "form-group classFormInputsBox">
							<label for="room_num_prefix" class="col-xs-4 control-label">Prefix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_prefix" id="room_num_prefix">
							</div>
						</div>
						
						<div class = "form-group classFormInputsBox">
							<label for="room_num_postfix" class="col-xs-4 control-label">Postfix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_postfix" id="room_num_postfix">
							</div>
						</div>
                       
					
							<div class = "form-group classFormInputsBox">
							<div class="col-xs-12">
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit"></input>
								
							</div>
						</div>
						</div>
				</form>
			
	
</div>
