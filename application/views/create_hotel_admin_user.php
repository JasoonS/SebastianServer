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
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
				        </div>
				        <div class = "x_content">

							<div class = "form-group classFormInputsBox" id="id_HotelElement">
		            			<label for="sb_hotel_id" class="col-md-4 col-xs-4 control-label">Hotel :</label>
							    <div class="col-md-8 col-xs-8">
									<?php 	
										$sb_hotel_name[0]['sb_hotel_name']=$hotel_name;
									?>	
									<input type="text" value ="<?php echo $sb_hotel_name[0]['sb_hotel_name']?>" disabled class="form-control" />
									<input type="hidden" value ="<?php echo $hotel_id?>" id="sb_hotel_id" name="sb_hotel_id" class="form-control" />
								
							    </div>
			                </div>

			                <div class = "form-group classFormInputsBox">
			                	<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_username">User Name :</label>
								<div class="col-md-8 col-xs-8">
									<?php 
										if($action_type =="edit"){
									?>	
										<input id="sb_hotel_username" name="sb_hotel_username" type="text" disabled class="form-control" value="<?php echo $userinfo->sb_hotel_username;?>" >
									<?php }else{ ?>
										<input id="sb_hotel_username" name="sb_hotel_username" type="text" placeholder="Type Hotel User Name Here ..." class="form-control" >
									<?php } ?> 

									<?php echo form_error('sb_hotel_username'); ?>
								</div>
			                </div>

			                <div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_useremail">User Email ID :</label>
								<div class="col-md-8 col-xs-8">
								    <?php
                                    
									if($action_type == "edit"){
									?>
										<input id="sb_hotel_useremail" name="sb_hotel_useremail" type="text" class="form-control" value="<?php echo $userinfo->sb_hotel_useremail;?>"  disabled >
									<?php } else { ?>
										<input id="sb_hotel_useremail" name="sb_hotel_useremail" type="text" placeholder="Type Hotel User Email Here ..." class="form-control" >
									<?php } ?>
									<?php echo form_error('sb_hotel_useremail'); ?>
								</div>
							</div>
							
							<div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_pic">User Picture :</label>
								<div class="col-md-8 col-xs-8">
									    <div class="col-xs-6">
										<input id="sb_hotel_user_pic" name="sb_hotel_user_pic"  type="file" style="display:none"/>
										<button id='btn-upload'>Upload</button>
                                        </div>	
										<div id="id_filePreview" class="col-xs-6">
										    <img id="id_uploadImage" style="width:100%;height:100%" src="#" alt="your image" />
										</div>
																			
									</div>
							</div>
							
							<div class="form-group" id="id_shiftFrom">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_shift_from">Shift From</label>
								<div class="col-md-8 col-xs-8">
									<div class="input-append bootstrap-timepicker">
										<input id="sb_hotel_user_shift_from" name="sb_hotel_user_shift_from" type="text" class="timepicker input-small">
										<span class="add-on"><i class="icon-time"></i></span>
									</div>
									<?php echo form_error('sb_hotel_user_shift_from'); ?>
								</div>
							</div>

							<div class="form-group" id="id_shiftTo">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_shift_to">Shift To</label>
									<div class="col-md-8 col-xs-8">
										<div class="input-append bootstrap-timepicker">
											<input id="sb_hotel_user_shift_to" name="sb_hotel_user_shift_to" type="text" class="timepicker input-small">
											<span class="add-on"><i class="icon-time"></i></span>
										</div>
										<?php echo form_error('sb_hotel_user_shift_to'); ?>
								  </div>
							</div>
							
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_user_type">User Type</label>
								<div class="col-md-8 col-xs-8">
									<select id="sb_hotel_user_type" name="sb_hotel_user_type" class="form-control"  onchange="callToChildServices();">
										<?php
										foreach($hotelusertypes as $key=>$usertype)
										{
										    if($usertype == 'u')
											{
												$label = "Super Admin";
										    }
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
						                    if($action_type != "edit"){
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
											if($action_type !="edit"){
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
							<div class="control-group">
								<div class="controls">
								  <?php
								    $button_text = "Update User";
								    if($action_type !="edit"){
										$button_text="Create User";
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
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>

<script type="text/javascript">
$(function() {
        populateChildServices('<?php echo $user_type;?>','<?php echo $user_id ?>','<?php echo $hotel_id?>','0')
        hideShowElements();
		<?php if($action_type == "create"){?>
		$('#sb_hotel_user_shift_from').timepicker({
						showSeconds: true,
					   
					});
		$('#sb_hotel_user_shift_to').timepicker({
						showSeconds: true,
					});
		$('#id_uploadImage').attr('src','#');
			
		<?php }else{  ?>
		$('#sb_hotel_user_shift_from').timepicker({
                defaultTime: '<?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_from)); ?>',
                showSeconds: true,
               
            });
        $('#sb_hotel_user_shift_to').timepicker({
                defaultTime: '<?php echo date("g:i A",strtotime($userinfo->sb_hotel_user_shift_to)); ?>',
                showSeconds: true,
               
            });
		$('#id_uploadImage').attr('src','<?php echo FOLDER_BASE_URL."/".HOTEL_USER_PIC."/".$userinfo->sb_hotel_user_pic;?>');
		
			<?php	
				if($action_type == "edit"){ ?>
				$("#sb_parent_service_id").val('<?php echo $user_child_service[0]["sb_parent_service_id"];?>');
				<?php }?>
		<?php }?>
	});
	function callToChildServices()
		{
			hideShowElements();
			populateChildServices('<?php echo $user_type;?>','<?php echo $user_id ?>','<?php echo $hotel_id?>','1');
        } 
	/* This method is used to load child services
	 * params 
	 *
	 */
	function populateChildServices(loggedusertype,userid,hotelid,change)
		{
			
			var creation_user_type=$("#sb_hotel_user_type").val();
		
			var parent_service_id=$("#sb_parent_service_id").val();
			var base_url = proj_url+'/admin/ajax/get_ajax_data';
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
									$('#sb_child_service_id').append( $('<option value="' + this.sb_child_service_id + '">' + this.sb_child_servcie_name + '</option>' ));
								});
								
							},
					error:function(msg){
						alert("failure");
					}
				}).done(function (){

					<?php
						if($action_type == "edit"){	?>		
							<?php if(($userinfo->sb_hotel_user_type == 's')&&($user_parent_service[0]["sb_parent_service_id"] == $user_child_service[0]["sb_parent_service_id"])){?>	
							console.log(<?php echo $user_child_service[0]["sb_child_service_id"];?>);
							if(change == 0){
							$("#sb_child_service_id").val(<?php echo $user_child_service[0]["sb_child_service_id"];?>);
						    }
							else{
								$("#sb_child_service_id").val($("#sb_child_service_id option:first").val());
							}
						<?php } ?>
					
					<?php } 
					?>
			 });
			}
			else
			{
				$("#child_services_control").hide(2000);
			}
		}
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
		/* This method is written for hide and Show Of Elements According to User Type
		   And Set Default Values For It.	
		*/
	function hideShowElements()
		{
			var user_type=$("#sb_hotel_user_type").val();
		
			if(user_type == 'u')
			{
				$("#sb_hotel_id").val('0');
				$("#id_HotelElement").hide();
			}
			else{
				$("#id_HotelElement").show();
			}
			//alert(user_type); 
			if((user_type == 'u')||(user_type=='a'))
			{
				$("#id_shiftFrom").hide();
				$("#id_shiftTo").hide();
			}
			else{
				$("#id_shiftFrom").show();
				$("#id_shiftTo").show();
			}
			
		}
		
</script>