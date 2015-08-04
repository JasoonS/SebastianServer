<!-- Adding CSS AND JS -->
<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
<div class="right_col" role="main">
    <div class="">
	<!-- This is for Success Message.-->
	<?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
	<!-- This is for Generic Error Message.-->
	<?php if ($this->session->flashdata('category_error')) { ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
	<?php } ?>
	<legend>Create Hotel User</legend>
	<div class="account-container">	
	<div class="content clearfix">
	<form  action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" >
		<fieldset>
			<div class="control-group">
				<label class="control-label" for="sb_hotel_id">Hotel </label>
					<div class="controls">
					   <?php if($user_type == 'u'){?>
						<select id="sb_hotel_id" name="sb_hotel_id" class="input-large">
							<?php
							foreach($hotellist as $key=>$hotel)
							echo "<option value='".$hotel['sb_hotel_id']."'>".$hotel['sb_hotel_name']."</option>";
						   ?> 
						</select>
						<?php }else{?>
						<input type="text" value ="<?php echo $sb_hotel_name[0]['sb_hotel_name']?>" disabled  class="input-large" />
						<input type="hidden" value ="<?php echo $hotel_id?>" id="sb_hotel_id" name="sb_hotel_id" class="input-large" />
					    <?php }?>
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
						<select id="sb_hotel_user_type" name="sb_hotel_user_type" class="input-large"  onchange="callToChildServices();">
							<?php
							foreach($hotelusertypes as $key=>$usertype)
							{
								if($usertype == 'a')
								{
									$label = "Hotel Admin";
								}
								if($usertype == 'm')
								{
									$label = "Hotel Manager";
								}
								if($usertype == 's')
								{
									$label = "Hotel Staff";
								}
			
								echo "<option value='".$usertype."'>".$label."</option>";
							}
						   ?> 
						</select>
					</div>
			</div>
			<?php if($user_type !='u'){?>
				<div class="control-group">
				<label class="control-label" for="sb_staff_designation_id">User Designation</label>
					<div class="controls">
						<select id="sb_staff_designation_id" name="sb_staff_designation_id" class="input-large">
							<?php
							foreach($designation_list as $key=>$value)
							{
								echo "<option value='".$value['designation_id']."'>".$value['designation_name']."</option>";
							}
						   ?> 
						</select>
					</div>
			    </div>
			<?php }?>
			<?php if($user_type == 'a'){?>
			<div class="control-group">
				<label class="control-label" for="sb_parent_service_id">User Parent Service</label>
					<div class="controls">
						<select id="sb_parent_service_id" name="sb_parent_service_id" class="input-large" onchange="callToChildServices();">
							<?php
							foreach($parent_services as $key=>$value)
							{
								echo "<option value='".$value['sb_parent_service_id']."'>".$value['sb_parent_service_name']."</option>";
							}
						   ?> 
						</select>
					</div>
			</div>
			
			<div class="control-group" id="child_services_control" style="display:none;" >
				<label class="control-label" for="sb_child_service_id">User Child Service</label>
					<div class="controls">
						<select id="sb_child_service_id" name="sb_child_service_id" class="input-large" >
							
						</select>
					</div>
			</div>
			<?php }?>
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
 function callToChildServices()
 {
	<?php  if(isset($hotel_id) && $user_type == 'a'){?>
				populateChildServices('<?php echo $user_type;?>','<?php echo $user_id;?>','<?php echo $hotel_id;?>');
	<?php } ?>
 }
 <?php  if(isset($hotel_id) && $user_type == 'a'){?>
 populateChildServices('<?php echo $user_type;?>','<?php echo $user_id;?>','<?php echo $hotel_id;?>');
<?php } ?>

/* This method is used to load child services
 * params 
 *
 */
 function populateChildServices(loggedusertype,userid,hotelid)
 {
	var proj_url=location.protocol + "//" + location.host;
	var creation_user_type=$("#sb_hotel_user_type").val();
	var parent_service_id=$("#sb_parent_service_id").val();
	var base_url = proj_url+'/sebastian-admin-panel/admin/ajax/get_ajax_data';
	if(creation_user_type == 's'){
		$("#child_services_control").show(2000);
		$.ajax({
			url: base_url,
			type:"post",
			data:{"sb_parent_service_id":parent_service_id,"logged_user_type":loggedusertype,"logged_user_id":userid,"hotel_id":hotelid,flag:"6"},
			dataType:"json",
			success:function(msg){
					    var data = msg;
						console.log(data);
						$("#sb_child_service_id").html(""); 
						$.each(data, function() {
							$('#sb_child_service_id').append( $('<option value="' + this.sb_child_service_id + '">' + this.sb_child_service_name + '</option>' ));
						});
					},
			error:function(msg){
				alert("failure");
			}
		}).done(function (){
		//Nothing in callback
	 });
	}
	else
	{
		$("#child_services_control").hide(2000);
	}

 }

 </script>