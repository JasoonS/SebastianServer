<div class="account-container">	
	<div class="content clearfix">
	<!-- This is for Success Message.-->
	<?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
	<!-- This is for Generic Error Message.-->
	<?php if ($this->session->flashdata('category_error')) { ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
	<?php } ?>
	
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" >
		<fieldset>
		<!-- Form Name -->
		<legend>Create Hotel Administrator</legend>
		<!-- Text input-->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_id">Hotel </label>
			<div class="controls">
				<select id="sb_hotel_id" name="sb_hotel_id" class="input-large">
					<?php
				    foreach($hotellist as $key=>$hotel)
					echo "<option value='".$hotel['sb_hotel_id']."'>".$hotel['sb_hotel_name']."</option>";
                   ?> 
				</select>
			</div>
		</div>
		
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_username">Hotel User Name</label>
			<div class="controls">
			<input id="sb_hotel_username" name="sb_hotel_username" type="text" placeholder="Type Hotel User Name Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_username'); ?>
			</div>
		</div>
		<!-- Text input-->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_useremail">Hotel User Email ID</label>
			<div class="controls">
			<input id="sb_hotel_useremail" name="sb_hotel_useremail" type="text" placeholder="Type Hotel User Email Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_useremail'); ?>
			</div>
		</div>
		
		<!-- Select Basic -->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_user_pic">Hotel User Picture</label>
			<div class="controls">
				<input id="sb_hotel_user_pic" name="sb_hotel_user_pic" type="file"  class="input-large" >
			</div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="sb_hotel_user_shift_from">Shift From</label>
		  <div class="controls">
		
			<div class="input-append bootstrap-timepicker">
            <input id="sb_hotel_user_shift_from" name="sb_hotel_user_shift_from" type="text" class="timepicker input-small">
            <span class="add-on"><i class="icon-time"></i></span>
           </div>
			<?php echo form_error('sb_hotel_user_shift_from'); ?>
		
		  </div>
		</div>
		
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_user_shift_to">Shift To</label>
		  <div class="controls">
			<div class="input-append bootstrap-timepicker">
            <input id="sb_hotel_user_shift_to" name="sb_hotel_user_shift_to" type="text" class="timepicker input-small">
            <span class="add-on"><i class="icon-time"></i></span>
           </div>
			<?php echo form_error('sb_hotel_user_shift_to'); ?>
		
		  </div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_user_status">Hotel User Status</label>
			<div class="controls">
			     <input type="checkbox" id="sb_hotel_user_status" name="sb_hotel_user_status" checked data-toggle="toggle" data-on="Enabled" data-off="Disabled">		
			</div>
		</div>
		<!-- This Field Will Get Populated according to Super Admin Or Hotel Admin -->
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_user_type">Hotel User Type</label>
			<div class="controls">
				<select id="sb_hotel_user_type" name="sb_hotel_user_type" class="input-large">
					<?php
				    foreach($hotelusertypes as $key=>$usertype)
					{
					    if($usertype == 'a')
						{
							$label = "Hotel Admin";
						}
	
						echo "<option value='".$usertype."'>".$label."</option>";
					}
				   ?> 
				</select>
			</div>
		</div>
		
		
		
		
		<div class="control-group">
		  <label class="control-label" for="submit"></label>
		  <div class="controls">
			<button id="submit"  class="btn btn-primary">Create Hotel User</button>
		  </div>
		</div>
		</fieldset>
	</form>
</div>
</div>
<script type="text/javascript">
 $(function() {
    $('#sb_hotel_user_shift_from').timepicker({
               
                showSeconds: true,
               
            });
    $('#sb_hotel_user_shift_to').timepicker({
               
                showSeconds: true,
               
            });
	$("#sb_hotel_user_pic").fileinput({
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
	});
 });
</script>