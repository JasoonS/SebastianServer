<!-- page content -->

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
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
	    <form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		    <div class="row">
	    		<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel classRequiredPanel">
	    				<div class="x_title">
		                    <h2><b>Mandatory Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

		                	<div class = "form-group classFormInputsBox">
                    			<label for="sbHotelName" class="col-xs-3 control-label">Hotel Name : </label>
							    <div class="col-xs-6">
							      <!--<input type="email" class="form-control" id="inputEmail3" placeholder="Email">!-->
							      	<?php if(isset($hoteldata)){?>
										<input id="id_sbHotelName"  name="sb_hotel_name" type="text" placeholder="Type Hotel Name Here ..." class="form-control" value="<?php echo $hoteldata['sb_hotel_name']?>" disabled />
									<?php } else { ?>
										<input id="id_sbHotelName"  name="sb_hotel_name" type="text" placeholder="Type Hotel Name Here ..." class="form-control" />
									<?php }?>
									<?php echo form_error('sb_hotel_name'); ?>
							    </div>
                    		</div>

                    		<div class = "form-group classFormInputsBox">
                    			<label for = "sbHotelCategory" class="col-xs-3 control-label">Hotel Category :</label>
                    			<div class="col-xs-6">
                    				<?php if(isset($hoteldata)){?>
										<select id="id_sbHotelCategory" name="sb_hotel_category" class="form-control">
										    <?php
												if($hoteldata['sb_hotel_category']=='Hotel')
												{
													echo "<option checked>Hotel</option>";
													echo "<option>Resort</option>";
												}
												else
												{
													echo "<option>Hotel</option>";
													echo "<option checked>Resort</option>";
												}	
										   ?>	
				   						</select>
									<?php }	else {?>
									<select id="id_sbHotelCategory" name="sb_hotel_category" class="form-control">
										<option>Hotel</option>
										<option>Resort</option>
									</select>
									<?php }?>
                    			</div>
                    		</div>

                    		<div class="form-group classFormInputsBox">
								<label for="sbHotelEmail" class="col-xs-3 control-label">Hotel Email :</label>
								<div class="col-xs-6">
									<?php if(isset($hoteldata)){?>
										<input id="id_sbHotelEmail" name="sb_hotel_email" type="text" placeholder="Type Hotel Email Here ..." class="form-control" value="<?php echo $hoteldata['sb_hotel_email'];?>" />
									<?php } else {?>	
										<input id="id_sbHotelEmail" name="sb_hotel_email" type="text" placeholder="Type Hotel Email Here ..." class="form-control" />
									<?php }?>
									<?php echo form_error('sb_hotel_email'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label for="sbHotelWebsite" class="col-xs-3 control-label">Hotel Website :</label>
								<div class="col-xs-6">
								<?php if(isset($hoteldata)){?>
									<input id="id_sbHotelWebsite" name="sb_hotel_website" type="text" placeholder="Type Hotel Website Url Here ..." class="form-control" value="<?php echo $hoteldata['sb_hotel_website']?>">
								<?php } else { ?>
									<input id="id_sbHotelWebsite" name="sb_hotel_website" type="text" placeholder="Type Hotel Website Url Here ..." class="form-control" >
								<?php }?>
								<?php echo form_error('sb_hotel_website'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
							  <label for="sbHotelCountry" class="col-xs-3 control-label">Country :</label>
							  <div class="col-xs-6">
								<select id="id_sbHotelCountry" name="sb_hotel_country" class="form-control" required="" onchange="loadStates('id_sbHotelCountry','id_sbHotelState','1','id_sbHotelCity','0','0','0')">
									<?php
										if(isset($hoteldata)){
											foreach($countrylist as $key=>$country)
											{
												if($country['country_id'] == $hoteldata['sb_hotel_country']){
													echo "<option value='".$country['country_id']."' checked>".$country['country_name']."</option>";
												}
												else
												{
													echo "<option value='".$country['country_id']."'>".$country['country_name']."</option>";
												}
											}
									  	}
										else{
											foreach($countrylist as $key=>$country)
											echo "<option value='".$country['country_id']."'>".$country['country_name']."</option>";
										}
									?>   				
								</select>
								<?php echo form_error('sb_hotel_country'); ?>
							  </div>
							</div>

							<div class="form-group classFormInputsBox">
							  <label for="sbHotelState" class="col-xs-3 control-label">State :</label>
							  <div class="col-xs-6">
								<select id="id_sbHotelState" name="sb_hotel_state" class="form-control" required="" onchange="loadCities('id_sbHotelState','id_sbHotelCity','0','0')">
								  
								</select>
								<?php echo form_error('sb_hotel_state'); ?>
							  </div>
							</div>



							<div class="form-group classFormInputsBox">
							  <label for="sbHotelCity" class="col-xs-3 control-label">City :</label>
							  <div class="col-xs-6">
								<select id="id_sbHotelCity" name="sb_hotel_city" class="form-control" required="">
								</select>
								<?php echo form_error('sb_hotel_city'); ?>
							  </div>
							</div>


							<div class="form-group classFormInputsBox">
		  						<label for="sbHotelAddress" class="col-xs-3 control-label" >Hotel Address :</label>
							  	<div class="col-xs-6">
									<?php if(isset($hoteldata)){?>
						            <textarea id="id_sbHotelAddress" name="sb_hotel_address" required class="form-control"><?php echo $hoteldata['sb_hotel_address']?></textarea>		  
									<?php }
									 else {?>
									<textarea id="sb_hotel_address" name="sb_hotel_address" required class="form-control"></textarea>
									<?php }?>
									<?php echo form_error('sb_hotel_address'); ?>
							  	</div>
							</div>

							<div class="form-group classFormInputsBox">
							  <label class="col-xs-3 control-label" for="sbHotelZipcode">Postal Code</label>
							  <div class="col-xs-6">
							    <?php if(isset($hoteldata)){?>
							    	<input id="id_sbHotelZipcode" name="sb_hotel_zipcode" type="text"  placeholder="Type Postal Code Here" class="form-control"  maxlength="6" value="<?php echo $hoteldata['sb_hotel_zipcode']?>">
								<?php } else {?>
									<input id="id_sbHotelZipcode" name="sb_hotel_zipcode" type="text"  placeholder="Type Postal Code Here" class="form-control"  maxlength="6">
								<?php }?>	
								<?php echo form_error('sb_hotel_zipcode'); ?>
							  </div>
							</div>								
		                </div>    
	    			</div>
	    			<div class="form-group classFormInputsBox">													  								 
						    <?php if(isset($hoteldata)){ ?>
									<button id="submit"  class="btn btn-primary btn-lg btn-block">Update Hotel</button>
							<?php }
							 else {?>	
									<button id="submit"  class="btn btn-primary btn-lg btn-block">Create Hotel</button>
							<?php }?>							  
						</div>
	    		</div>

	    		<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel classOptionalPanel">
	    				<div class="x_title">
		                    <h2><b>Optional Inputs</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

		                	<div class = "form-group classFormInputsBox">
                    			<label for="sbHotelStar" class="col-xs-3 control-label">Hotel Star :</label>
                    			<div class="col-xs-6">
                    				<?php if(isset($hoteldata)){?>
										<input id="id_sbHotelStar" name="sb_hotel_star" value="<?php echo $hoteldata['sb_hotel_star'];?>" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false"/>
									<?php } else {?>
										<input id="id_sbHotelStar" name="sb_hotel_star" value="0" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false"/>
									<?php }?>
                    			</div>
                    		</div>

                    		<div class="form-group classFormInputsBox">
									<label for="sbHotelPic" class="col-xs-3 control-label">Hotel Picture :</label>
									<div class="col-xs-6">
									     <div class="col-xs-6">
										<input id="id_sbHotelPic" name="sb_hotel_pic"  type="file" style="display:none"/>
										<button id='btn-upload'>Upload</button>
                                        </div>	
										<div id="id_filePreview" class="col-xs-6">
										    <img id="id_uploadImage" style="width:100%;height:100%" src="#" alt="your image" />
										</div>
																			
									</div>
								</div>

							<div class="form-group classFormInputsBox">
								<label for="sbHotelOwner" class="col-xs-3 control-label">Hotel Owner :</label>
								<div class="col-xs-6">
								<?php if(isset($hoteldata)){?>
								<input id="id_sbHotelOwner" name="sb_hotel_owner" type="text" placeholder="Type Hotel Owner Name Here ..." class="form-control" value="<?php echo $hoteldata['sb_hotel_owner']?>"/>
								<?php }
								 else {?>
								<input id="id_sbHotelOwner" name="sb_hotel_owner" type="text" placeholder="Type Hotel Owner Name Here ..." class="form-control" />
								<?php }?>
								<?php echo form_error('sb_hotel_owner'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label for="sbPropertyBuiltMonth" class="col-xs-3 control-label">Hotel Built-In (Month) </label>
								<div class="col-xs-6">
									<select id="id_sbPropertyBuiltMonth" name="sb_property_built_month" class="form-control">
										<?php 
										$monthArray = array('January','February','March','April','May','June','July','August','September','October','November','December');
										$i=0;
										while($i<count($monthArray))
									    {
										   if(isset($hoteldata)){
												if($i==$hoteldata['sb_property_built_month'])
												{
													echo "<option value='".$i."' checked>".$monthArray[$i]."</option>";	
												}
												else{
													echo "<option value='".$i."'>".$monthArray[$i]."</option>";
												}
										    }
											else{
												echo "<option value='".$i."'>".$monthArray[$i]."</option>";
											}
											$i++;
										} 
									   ?>	
									</select>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label for="sbPropertyBuiltYear" class="col-xs-3 control-label" >Hotel Built-In (Year)</label>
								<div class="col-xs-6">
									<?php if(isset($hoteldata)){?>
										<input id="id_sbPropertyBuiltYear" name="sb_property_built_year" type="text"  class="form-control" value="<?php echo $hoteldata['sb_property_built_year']?>">
									<?php } else {?>
										<input id="id_sbPropertyBuiltYear" name="sb_property_built_year" type="text"  class="form-control" >
									<?php }?>
									<?php echo form_error('sb_property_built_year'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label for="sbPropertyOpenYear" class="col-xs-3 control-label">Hotel Opened (Year)</label>
								<div class="col-xs-6">
									<?php if(isset($hoteldata)){?>
										<input id="id_sbPropertyOpenYear" name="sb_property_open_year" type="text"  class="form-control" value="<?php echo $hoteldata['sb_property_open_year']?>">
									<?php } else {?>
										<input id="id_sbPropertyOpenYear" name="sb_property_open_year" type="text"  class="form-control" >
									<?php }?>
									<?php echo form_error('sb_property_open_year'); ?>
								</div>
							</div>

							<div class="form-group classFormInputsBox">
								<label class="col-xs-3 control-label" for="sbHotelZipcode">Language Set :</label>
								<div class="col-xs-6">
									<?php
										if(isset($hoteldata)){	
											$selectedlanguages =explode(',',$hoteldata['lang_id']);
											$i=0;
											while($i<count($languagelist))
											{
											    if (in_array($languagelist[$i]['lang_id'], $selectedlanguages)) 
											    {				
													echo '<input type="checkbox"  name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'" checked><b>'.$languagelist[$i]['lang_name'].'</b><br/>';				        
												}
												else
												{
												
													echo '<input type="checkbox"  name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'"><b>'. $languagelist[$i]['lang_name'].'</b><br/>';														
												}
												$i++;
											}
										}
										else{
											$i=0;
											while($i<count($languagelist))
											{				    
												echo '<input type="checkbox" name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'" checked><b>'. $languagelist[$i]['lang_name'].'</b><br/>';
												
												$i++;
											}
										}
									?>
								</div>								
							</div>
							
		                </div>
	    			</div>
	    		</div>
		    	</div>
	    	</form>
    </div>
    <footer>
		<div class="">
		    <p class="pull-right">Sebastian Admin |
		        <span class="lead"> <i class="fa fa-paw"></i></span>
		    </p>
		</div>
		<div class="clearfix"></div>
	</footer>
<!-- /footer content -->
</div>


<!--- Page specfic css !-->
<link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">


<!-- Page specific js !-->
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/fileinput.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>


<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>


<script>
$(document).ready(function () {

  //called when key is pressed in textbox
  $("#id_sbHotelZipcode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
		}
    });
	<?php if(isset($hoteldata)){ ?>
		    $("#id_sbHotelCountry").val("<?php echo $hoteldata['sb_hotel_country'];?>");
			loadStates('id_sbHotelCountry','id_sbHotelState','1','id_sbHotelCity','1','<?php echo $hoteldata['sb_hotel_state']?>','<?php echo $hoteldata['sb_hotel_city']?>');
			$('#id_uploadImage').attr('src','<?php echo FOLDER_BASE_URL."/".HOTEL_PIC."/".$hoteldata['sb_hotel_pic'];?>');
			$('#id_sbPropertyBuiltYear').datepicker({
				changeYear: true,
				dateFormat: 'yy',
				yearRange: "-100:+0",
				onClose: function() {
						  var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	                      $(this).datepicker('setDate', new Date(iYear, 1, 1));
	            },
				beforeShow: function() {
						if ((selDate = $(this).val()).length > 0) 
						{
							iYear = selDate.substring(selDate.length - 4, selDate.length);
							// iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
							// $(this).datepicker('option', 'monthNames'));
							//$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
							$(this).datepicker('setDate', new Date(iYear, 1, 1));
						}
				}
			});
		
			$('#id_sbPropertyOpenYear').datepicker({
				changeYear: true,
				dateFormat: 'yy',
				yearRange: "-100:+0",
				onClose: function() {
						 //var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
						  var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
	                      $(this).datepicker('setDate', new Date(iYear, 1, 1));
	            },
				beforeShow: function() {
						if ((selDate = $(this).val()).length > 0) 
						{
							iYear = selDate.substring(selDate.length - 4, selDate.length);
							// iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
							// $(this).datepicker('option', 'monthNames'));
							//$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
							$(this).datepicker('setDate', new Date(iYear, 1, 1));
						}
				}
			});
	<?php } else { ?>
	$("#id_uploadImage").hide();
    loadStates('id_sbHotelCountry','id_sbHotelState','1','id_sbHotelCity','0','0','0'); 
	$('#id_sbPropertyBuiltYear').datepicker({
			changeYear: true,
			dateFormat: 'yy',
			yearRange: "-100:+0",
			onClose: function() {
					 //var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					  var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).datepicker('setDate', new Date(iYear, 1, 1));
            },
			beforeShow: function() {
					if ((selDate = $(this).val()).length > 0) 
					{
						iYear = selDate.substring(selDate.length - 4, selDate.length);
						// iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
						// $(this).datepicker('option', 'monthNames'));
						//$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
						$(this).datepicker('setDate', new Date(iYear, 1, 1));
					}
			}
		});
		
		$('#id_sbPropertyOpenYear').datepicker({
			changeYear: true,
			dateFormat: 'yy',
			yearRange: "-100:+0",
			onClose: function() {
					 //var iMonth = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
					  var iYear = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                      $(this).datepicker('setDate', new Date(iYear, 1, 1));
            },
			beforeShow: function() {
					if ((selDate = $(this).val()).length > 0) 
					{
						iYear = selDate.substring(selDate.length - 4, selDate.length);
						// iMonth = jQuery.inArray(selDate.substring(0, selDate.length - 5), 
						// $(this).datepicker('option', 'monthNames'));
						//$(this).datepicker('option', 'defaultDate', new Date(iYear, iMonth, 1));
						$(this).datepicker('setDate', new Date(iYear, 1, 1));
					}
			}
		});
	<?php } ?>	
		$('input[type="checkbox"][name="sb_languages"]').on('change',function(){
				var getArrVal = $('input[type="checkbox"][name="sb_languages"]:checked').map(function(){
				return this.value;
			}).toArray();
  
			if(getArrVal.length){
					//execute the code
			} else {
				$(this).prop("checked",true);
				return false;
    
			};
		});
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
    $("#id_sbHotelPic").change(function(){
	
        readURL(this);
    });	
	$('#btn-upload').click(function(e){
        e.preventDefault();
        $('#id_sbHotelPic').click();}
    );
});
</script>