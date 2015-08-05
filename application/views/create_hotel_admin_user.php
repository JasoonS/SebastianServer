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

		<?php if(isset($userinfo)){?>
			<legend>Update Hotel User</legend>
		<?php } else{ ?>
			<legend>Create Hotel User</legend>
		<?php }?>

		<form  class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data" >
			<div class="row">
				<div class = "col-md-6 col-xs-12 col-md-offset-2 classFormBox">
					<div class="x_panel classRequiredPanel">
						<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
				        </div>
				        <div class = "x_content">

							<div class = "form-group classFormInputsBox">
		            			<label for="sb_hotel_id" class="col-md-4 col-xs-4 control-label">Hotel :</label>
							    <div class="col-md-8 col-xs-8">
									<?php 
										if(!isset($userinfo))
										{
											if($user_type == 'u'){ ?>
												<select id="sb_hotel_id" name="sb_hotel_id" class="form-control">
											<?php foreach($hotellist as $key=>$hotel)
												
												echo "<option value='".$hotel['sb_hotel_id']."'>".$hotel['sb_hotel_name']."</option>";
											?> 
												</select>
											<?php } else { ?>
												<input type="text" value ="<?php echo $sb_hotel_name[0]['sb_hotel_name']?>" disabled  	 class="form-control" />
												<input type="hidden" value ="<?php echo $hotel_id?>" id="sb_hotel_id" name="sb_hotel_id" class="form-control" />
						    				<?php }
										} else {
									?>
										<input type="text" value ="<?php echo $userinfo->sb_hotel_name;?>" disabled class="form-control" />
									<?php }?>
							    </div>
			                </div>

			                <div class = "form-group classFormInputsBox">
			                	<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_username">Hotel User Name :</label>
								<div class="col-md-8 col-xs-8">
									<?php 
										if(isset($userinfo)){
									?>	
										<input id="sb_hotel_username" name="sb_hotel_username" type="text" disabled class="form-control" value="<?php echo $userinfo->sb_hotel_username;?>" >
									<?php }else{ ?>
										<input id="sb_hotel_username" name="sb_hotel_username" type="text" placeholder="Type Hotel User Name Here ..." class="form-control" >
									<?php } ?>

									<?php echo form_error('sb_hotel_username'); ?>
								</div>
			                </div>

			                <div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_useremail">Hotel User Email ID :</label>
								<div class="col-md-8 col-xs-8">
								    <?php if(isset($userinfo)){?>
										<input id="sb_hotel_useremail" name="sb_hotel_useremail" type="text" class="form-control" disabled value="<?php echo $userinfo->sb_hotel_useremail;?>">
									<?php } else { ?>
										<input id="sb_hotel_useremail" name="sb_hotel_useremail" type="text" placeholder="Type Hotel User Email Here ..." class="form-control" >
									<?php } ?>
									<?php echo form_error('sb_hotel_useremail'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_pic">Hotel User Picture :</label>
								<div class="col-md-8 col-xs-8">
									<input id="sb_hotel_user_pic" name="sb_hotel_user_pic" type="file"  class="input-large" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_shift_from">Shift From</label>
								<div class="col-md-8 col-xs-8">
									<div class="input-append bootstrap-timepicker">
										<input id="sb_hotel_user_shift_from" name="sb_hotel_user_shift_from" type="text" class="timepicker input-small">
										<span class="add-on"><i class="icon-time"></i></span>
									</div>
									<?php echo form_error('sb_hotel_user_shift_from'); ?>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_shift_to">Shift To</label>
									<div class="col-md-8 col-xs-8">
										<div class="input-append bootstrap-timepicker">
											<input id="sb_hotel_user_shift_to" name="sb_hotel_user_shift_to" type="text" class="timepicker input-small">
											<span class="add-on"><i class="icon-time"></i></span>
										</div>
										<?php echo form_error('sb_hotel_user_shift_to'); ?>
								  </div>
							</div>
					
							<div class="control-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_status">Hotel User Status</label>
								<div class="col-md-8 col-xs-8">
									 <input type="checkbox" id="sb_hotel_user_status" name="sb_hotel_user_status" checked data-toggle="toggle" data-on="Enabled" data-off="Disabled">		
								</div>
							</div>

							<!--This Field Will Get Populated according to Super Admin Or Hotel Admin !-->
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_type">Hotel User Type</label>
								<div class="col-md-8 col-xs-8">
									<select id="sb_hotel_user_type" name="sb_hotel_user_type" class="form-control"  onchange="callToChildServices();">
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
						                    if(!isset($userinfo)){
												echo "<option value='".$usertype."'>".$label."</option>";
											}
											else{
												if($userinfo->sb_hotel_user_type==$usertype){
													echo "<option value='".$usertype."' selected>".$label."</option>";
												}
												else{
													echo "<option value='".$usertype."'>".$label."</option>";
												}
											}
										}
									   ?> 
									</select>
								</div>
							</div>
							<?php if($user_type !='u'){?>
								<div class="form-group">
									<label class="col-md-4 col-xs-4 control-label" for="sb_staff_designation_id">User Designation</label>
									<div class="col-md-8 col-xs-8">
										<select id="sb_staff_designation_id" name="sb_staff_designation_id" class="form-control">
											<?php
											if(!isset($userinfo)){
												foreach($designation_list as $key=>$value)
												{
													echo "<option value='".$value['designation_id']."'>".$value['designation_name']."</option>";
												}
											}
											else{
											  
												foreach($designation_list as $key=>$value)
												{
													if($userinfo->sb_staff_designation_id==$value['designation_id']){
														echo "<option value='".$value['designation_id']."' selected>".$value['designation_name']."</option>";
													}
													else
													{
														echo "<option value='".$value['designation_id']."'>".$value['designation_name']."</option>";
													}
												}
											}
										   ?> 
										</select>
									</div>
							    </div>
							<?php }?>

							<?php if($user_type == 'a' || $user_type == 'm'){?>
								<div class="form-group">
									<label class="col-md-4 col-xs-4 control-label" for="sb_parent_service_id">User Parent Service</label>
										<div class="col-md-8 col-xs-8">
											<select id="sb_parent_service_id" name="sb_parent_service_id" class="form-control" onchange="callToChildServices();">
												<?php
												foreach($parent_services as $key=>$value)
												{
													echo "<option value='".$value['sb_parent_service_id']."'>".$value['sb_parent_service_name']."</option>";
												}
											   ?> 
											</select>
										</div>
								</div>
					
								<div class="form-group" id="child_services_control" style="display:none;" >
									<label class="col-md-4 col-xs-4 control-label" for="sb_child_service_id">User Child Service</label>
									<div class="col-md-8 col-xs-8">
										<select id="sb_child_service_id" name="sb_child_service_id" class="form-control" >
											
										</select>
									</div>
								</div>
							<?php }?>
						</div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button id="submit"  class="btn btn-primary btn-lg btn-block">Create Hotel User</button>
						</div>
					</div>				
				</div>
			</div>
		</form>
	</div>
</div>
<!-- Adding CSS AND JS -->
<!--<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
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
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>!-->

<!-- Page specfic css !-->
<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">

<!-- Page specific js !-->
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>


<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>

<script type="text/javascript">
	$(function() {

		<?php if(!isset($userinfo)){?>
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
		<?php }
		else { ?>
				$('#sb_hotel_user_shift_from').timepicker({
							defaultTime: '<?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_from)); ?>',
							showSeconds: true,
						   
						});
				$('#sb_hotel_user_shift_to').timepicker({
							defaultTime: '<?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_to)); ?>',
							showSeconds: true,
						   
						});
				$("#sb_hotel_user_pic").fileinput({
					initialPreview: [
						"<img src='<?php echo FOLDER_BASE_URL."/".HOTEL_USER_PIC."/".$userinfo->sb_hotel_user_pic;?>' class='file-preview-image' alt='Hotel Image' title='HotelImage'>",
					],
					showUpload: false,
					showCaption: false,
					browseClass: "btn btn-primary btn-lg",
					fileType: "any",
					previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
				});
				
				<?php if(isset($user_parent_service)){?>
				           $("#sb_parent_service_id").val('<?php echo $user_parent_service[0]["sb_parent_service_id"];?>');
						console.log(' <?php echo $user_parent_service[0]["sb_parent_service_id"];?>');
				<?php }?>
		<?php }?>
		  	
		});
		function callToChildServices()
		{
		<?php  

		      if(isset($hotel_id) && ($user_type == 'a' || $user_type == 'm')){?>
					populateChildServices('<?php echo $user_type;?>','<?php echo $user_id;?>','<?php echo $hotel_id;?>');
		<?php } ?>
		}
		<?php  if(isset($hotel_id) && ($user_type == 'a' || $user_type == 'm')){?>
		populateChildServices('<?php echo $user_type;?>','<?php echo $user_id;?>','<?php echo $hotel_id;?>');
		<?php }
		?>


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
				<?php
		          if(isset($userinfo)){			
					  if(($userinfo->sb_hotel_user_type == 's')&&($user_parent_service[0]["sb_parent_service_id"] == $user_child_service[0]["sb_parent_service_id"])){?>	
					 console.log("We need to set child service here");
					 console.log('<?php echo $user_child_service[0]["sb_child_service_id"];?>');
					  $("#sb_child_service_id").val('<?php echo $user_child_service[0]["sb_child_service_id"];?>')
					<?php } 
				} 
				?>
		 });
		}
		else
		{
			$("#child_services_control").hide(2000);
		}
	}
</script>