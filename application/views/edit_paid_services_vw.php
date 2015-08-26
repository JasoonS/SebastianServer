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
					<div class="x_panel ">
						<div class="x_title">
							<?php if($action_type =="edit"){ ?>
							<h2><b>Service Updation</b></h2>
							<?php } else { ?>
							<h2><b>Service Creation</b></h2>
							<?php } ?>	                            
		                    <div class="clearfix"></div>
				        </div>
				        <div class = "x_content">
			                <div class = "form-group classFormInputsBox">
			                	<label class="col-md-4 col-xs-4 control-label" for="sb_sub_child_service_name">Service Name :</label>
								<div class="col-md-8 col-xs-8">
									<?php 
										if($action_type =="edit"){
									?>	
										<input id="sb_sub_child_service_name" name="sb_sub_child_service_name" type="text" placeholder="Type Service name here ...." class="form-control" value="<?php echo $serviceinfo['sb_sub_child_service_name'];?>" >
									<?php }else{ ?>
										<input id="sb_sub_child_service_name" name="sb_sub_child_service_name" type="text" placeholder="Type Service name here ...." class="form-control" >
									<?php } ?> 

									<?php echo form_error('sb_sub_child_service_name'); ?>
								</div>
			                </div>
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_hotel_parent_services">Main Service</label>
								<div class="col-md-8 col-xs-8">
								    
								   <?php if($action_type == 'edit'){?>
								   <select id="sb_parent_service_id" name="sb_parent_service_id" class="form-control" disabled>
										<?php if($parent_service[0]['sb_parent_service_id']== "3"){?>
										<option value= "3" selected>Spa</option>
										<option value= "6" >Room Service</option>
										<?php }?>
										<?php if($parent_service[0]['sb_parent_service_id']== "6"){?>
										<option value= "6" selected>Room Service</option>
										<option value= "3" >Spa</option>										
										<?php }?>
									</select>
								  <?php }else {?>
								     <select id="sb_parent_service_id"  class="form-control" onchange="populateChildMenus();" >
										<option value= "3" >Spa</option>	
										<option value= "6" >Room Service</option>	
									</select>
									<?php }?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_child_service_id">Hotel Service Menu</label>
								<div class="col-md-8 col-xs-8">
									 <select id="sb_child_service_id" name="sb_child_service_id" class="form-control">
								    </select>
								</div>
							</div>
			                
							<div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_sub_child_service_image">User Picture :</label>
								<div class="col-md-8 col-xs-8">
									    <div class="col-xs-6">
										<input id="sb_sub_child_service_image" name="sb_sub_child_service_image"  type="file" style="display:none"/>
										<button id='btn-upload'>Upload</button>
                                        </div>	
										<div id="id_filePreview" class="col-xs-6">
										    <?php if($action_type =="edit"){ ?>
												<img id="id_uploadImage" style="width:100%;height:100%" src="<?php  echo base_url(SUBCHILD_SERVICE_PIC."/".$hotel_id."/".$serviceinfo['sb_sub_child_service_image'])?>" alt="your image" />
											<?php } else { ?>
												<img id="id_uploadImage" style="width:100%;height:100%" src="#" alt="your image" />
										    <?php } ?>
										</div>
																			
									</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_sub_child_service_details">Service Details</label>
								<div class="col-md-8 col-xs-8">
									<?php if($action_type =="edit"){ ?>
										<textarea name="sb_sub_child_service_details"  class="form-control textarea" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10" data-parsley-id="1654"><?php echo $serviceinfo['sb_sub_child_service_details'];?></textarea>
									<?php } else { ?>
										<textarea name="sb_sub_child_service_details"  class="form-control textarea" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10" data-parsley-id="1654"></textarea>   
								    <?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-4 col-xs-4 control-label" for="sb_sub_child_price">Service Price</label>
								<div class="col-md-8 col-xs-8">
									<?php if($action_type =="edit"){ ?>
										<input id="sb_sub_child_price" name="sb_sub_child_price" type="text" placeholder="0.00" class="form-control" value="<?php echo $serviceinfo['sb_sub_child_price'];?>">
									<?php } else { ?>
										<input id="sb_sub_child_price" name="sb_sub_child_price" type="text" placeholder="0.00" class="form-control" >
									<?php } ?>
									<?php echo form_error('sb_sub_child_price'); ?>
								</div>
							</div>		
							<div class="control-group">
								<div class="controls">
									<?php if($action_type =="edit"){ ?>
										<button id="submit"  class="btn btn-primary btn-lg btn-block">Update Service</button>
									<?php } else { ?>
										<button id="submit"  class="btn btn-primary btn-lg btn-block">Create Service</button>
									<?php } ?>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
        </form>
	</div>
</div>
<script type="text/javascript">
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
	$("#sb_sub_child_service_image").change(function(){
			readURL(this);
		});	
		/* Button Click To trigger change event on hidden file upload control*/
	$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#sb_sub_child_service_image').click();
		});
	
    populateChildMenus();
	function populateChildMenus()
	{
	    var parent_service_id=$("#sb_parent_service_id").val();
		$.ajax({
					url: request_url,
					type:"post",
					data:{"sb_parent_service_id":parent_service_id,flag:"10"},
					dataType:"json",
					success:function(msg){
								var data = msg;
								$("#sb_child_service_id").html(""); 
								$.each(data, function() {
									$('#sb_child_service_id').append( $('<option value="' + this.sb_child_service_id + '">' + this.sb_child_servcie_name + '</option>' ));
								});
							},
					error:function(msg){
						alert("failure");
					}
				}).done(function(){
					<?php if($action_type=="edit"){?>
					$('#sb_child_service_id').prop("disabled", true);
					<?php }?>
				});
	}

</script>	