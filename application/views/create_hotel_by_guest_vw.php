 <div class="right_col" role="main" style="background-color:white">
	<div class="" >    
	<div class="x_content">
            <div id="wizard" class="form_wizard wizard_horizontal">
                <ul class="wizard_steps">
                    <li>
                        <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                            Step 1<br />
                            <small>Step 1 description</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
                            Step 2<br />
                            <small>Step 2 description</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                            Step 3<br />
                            <small>Step 3 description</small>
                            </span>
                        </a>
                    </li>
                    <li>
						<a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                            Step 4<br />
                            <small>Step 4 description</small>
                            </span>
                        </a>
                    </li>
                </ul>
                <div id="step-1" style="height:auto;overflow:hidden">
					<form class="form-horizontal form-label-left"  style="height:auto;scroll-y:hidden">
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
							</form>	
		                </div>  
						<div id="step-2">
                            <h2 class="StepTitle">Step 2 Content</h2>
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
                                        <div id="step-3">
                                            <h2 class="StepTitle">Step 3 Content</h2>
                                            <p>
                                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>
                                        <div id="step-4">
                                            <h2 class="StepTitle">Step 4 Content</h2>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                            </p>
                                        </div>

                                    </div>
		</div>
	</div>
                                    <!-- End SmartWizard Content -->
     <link href="<?php echo THEME_ASSETS;?>css/bootstrap.min.css" rel="stylesheet">

    <link href="<?php echo THEME_ASSETS;?>fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo THEME_ASSETS;?>css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="<?php echo THEME_ASSETS;?>css/custom.css" rel="stylesheet">
    <link href="<?php echo THEME_ASSETS;?>css/icheck/flat/green.css" rel="stylesheet">


    <script src="<?php echo THEME_ASSETS;?>js/jquery.min.js"></script>
 
    <script src="<?php echo THEME_ASSETS;?>js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="<?php echo THEME_ASSETS;?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?php echo THEME_ASSETS;?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo THEME_ASSETS;?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo THEME_ASSETS;?>js/icheck/icheck.min.js"></script>

    <script src="<?php echo THEME_ASSETS;?>js/custom.js"></script>
    <!-- form wizard -->
    <script type="text/javascript" src="<?php echo THEME_ASSETS?>js/wizard/jquery.smartWizard.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Smart Wizard 	
            $('#wizard').smartWizard();

            function onFinishCallback() {
                $('#wizard').smartWizard('showMessage', 'Finish Clicked');
                //alert('Finish Clicked');
            }
        });

     
    </script>


