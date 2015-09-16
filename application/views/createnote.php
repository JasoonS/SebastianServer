<div class="right_col" role="main">
        <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('category_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('category_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
		<?php } ?>
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>

		<form  class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" >
			<div class="row">
				<div class = "col-md-6 col-xs-12 col-md-offset-2 classFormBox">
					<div class="x_panel classRequiredPanel">
						<div class="x_title">
		                    <h2><b>
								 <?php
                                    
									if($action_type == "edit"){
										echo "Edit Note";
									}
									else{
										echo "Create Note";
									}
								?>
							
							</b></h2>	                            
		                    <div class="clearfix"></div>
				        </div>
				        <div class = "x_content">

							<div class = "form-group classFormInputsBox" id="id_HotelElement">
		            			<label for="sb_hotel_id" class="col-md-4 col-xs-4 control-label">Hotel</label>
							    <div class="col-md-8 col-xs-8">
									<?php 	
										$sb_hotel_name=$hotel_name;
									?>	
									<input type="text" value ="<?php echo $sb_hotel_name;?>" disabled class="form-control" />
									<input type="hidden" value ="<?php echo $hotel_id?>" id="sb_hotel_id" name="sb_hotel_id" class="form-control" />
								
							    </div>
			                </div>

			                <div class = "form-group classFormInputsBox">
			                	<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_note">Note</label>
								<div class="col-md-8 col-xs-8">
									<?php if($action_type == "edit"){?>
						            <textarea id="id_sbHotelNote" name="sb_hotel_note" required class="form-control"><?php echo $hoteldata['sb_hotel_address']?></textarea>		  
									<?php }
									 else {?>
									<textarea id="id_sbHotelNote" name="sb_hotel_note" required class="form-control"></textarea>
									<?php }?>
									<?php echo form_error('sb_hotel_note'); ?>
								</div>
			                </div>
							
                            
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_note_time">Note Time</label>
								<div class="col-md-4 col-xs-4">
									<input type="text" class="form-control" id="idNoteEventDay" name="note_event_day" required>
								</div>    
								<div class="col-md-4 col-xs-4">
									<div class="input-append bootstrap-timepicker">
											<input id="sb_hotel_note_time" name="sb_hotel_note_time" type="text" class="form-control timepicker input-small" required>
											<span class="add-on"><i class="icon-time"></i></span>
									</div>
								</div>
							</div>
			                
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_note_type">Note Type</label>
								<div class="col-md-8 col-xs-8">
									<select id="idNotetype" name="sb_hotel_note_type" class="form-control" >
										<option>Guest Note</option>
										<option>Internal Note</option>
									</select>
								</div>
							</div>
						    
							
						
							
							<div class="control-group">
								<div class="controls">
								  <?php
								    $button_text = "Update Note";
								    if($action_type !="edit"){
										$button_text="Create Note";
									}
									?>
									<button id="submit"  class="btn btn-primary btn-lg btn-block"><?php echo $button_text;?></button>
								</div>
							</div>	
				
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Page specfic css !-->
<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">

<!-- Page specific js !-->
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
<script type="text/javascript" src="<?php echo THEME_ASSETS?>js/datepicker/daterangepicker.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script type="text/javascript">
	$('#sb_hotel_note_time').timepicker({
						showSeconds: true,
					});
	$( "#idNoteEventDay" ).datepicker();				
</script>
