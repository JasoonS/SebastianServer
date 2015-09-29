<?php 
	$this->load->view('addProperty/header'); 
?>

<div class="container-fluid" id="container">
		<div class="row">
			<?php $this->load->view('addProperty/menu'); ?>
			<div class="col-md-10">
				<h3><u><?php echo $this->router->fetch_class(); ?></u></h3>
					
					<form method="post" class="form" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div id="cotaints">	
                                    <div class="marginclass">  								
										<label>Hotel Name</label>
										<input type="text" name="hotel_name" class="form-control" />
										<span class="error"><?php echo form_error('hotel_name'); ?></span>
									</div>
									<div class="marginclass">
										<label>Select Category</label>
										<select name="category" class="form-control">	
											<option value="1">Hotel</option>
											<option value="2">Resort</option>	
										</select>
									</div>
									<div class="marginclass">
										<label>Hotel Email</label>
										<input type="text" name="email" class="form-control" />
										<span class="error"><?php echo form_error('email'); ?></span>
								    </div>
									<div class="marginclass">
										<label>Hotel Website</label>
										<input type="text" name="website" class="form-control" />
										<span class="error"><?php echo form_error('website'); ?></span>
									</div>	
									<div class="marginclass">
										<label>Country</label>
										<select name="country" class="form-control" id="id_sbHotelCountry" onchange="loadStates('id_sbHotelCountry','id_sbHotelState','1','id_sbHotelCity','0','0','0')">
											<?php foreach($country as $row){ ?>
											<option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="marginclass">
										<label>State</label>
										<select name="state" class="form-control" id="id_sbHotelState" onchange="loadCities('id_sbHotelState','id_sbHotelCity','0','0')">
											
										</select>
									</div>
									<div class="marginclass">
										<label>City</label>
										<select name="city" class="form-control" id="id_sbHotelCity">
											
										</select>
								    </div>
									<div class="marginclass">
										<label for="sbHotelStar" >Hotel Star :</label>
											<div class="col-xs-6">
												<input id="id_sbHotelStar" name="hotel_star" value="0" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false"/>
											</div>
										</div>
									</div>
							</div>
							<div class="col-md-6">
								<div id="cotaints">	
								    <div class="marginclass"> 
										<label>Address</label>
										<input type="text" name="address" class="form-control" />
										<span class="error"><?php echo form_error('address'); ?></span>
									</div> 
									<div class="marginclass">
										<label>Postal Code</label>
										<input type="text" name="postal_code" class="form-control" id="id_sbHotelZipcode" required/>
										<span class="error"><?php echo form_error('postal_code'); ?></span>
									</div>
									<div class="marginclass">
										<label>Hotel Owner</label>
										<input type="text" name="owner_name" class="form-control"/>
										<span class="error"><?php echo form_error('owner_name'); ?></span>
									</div>
									<div class="marginclass">	
										<label>Picture</label>
										<input type="file" name="sb_hotel_pic" id="sb_hotel_pic" />
									</div>
									<div class="marginclass">
										<label>Establishment Month</label>
										<select id="id_sbPropertyBuiltMonth" name="month" class="form-control">
														<?php 
														$monthArray = array('January','February','March','April','May','June','July','August','September','October','November','December');
														$i=0;
														while($i<count($monthArray))
														{
															echo "<option value='".$i."'>".$monthArray[$i]."</option>";
															$i++;														
														}
														?>
										</select>
									</div>
									<div class="marginclass">
										<label>Built in</label>
										<input type="" name="built_calender" class="form-control" id="id_sbPropertyBuiltYear"/>
										<span class="error"><?php echo form_error('built_calender'); ?></span>				
								    </div>
									<div class="marginclass">
										<label>Opening</label>
										<input type="" name="opening_calender" class="form-control" id="id_sbPropertyOpenYear"/>
										<span class="error"><?php echo form_error('opening_calender;'); ?></span>				
									</div>
									<div class="marginclass">
										<label>Languages</label>
										<?php $i=0;
												while($i<count($languagelist))
												{				    
													echo '<input type="checkbox" name="lang[]" value="'.$languagelist[$i]['lang_id'].'" checked><b>'. $languagelist[$i]['lang_name'].'</b>';									
													$i++;
												}
										?>
									</div>
								</div>
							</div>					
						<input type="submit" name="insert" value="Create Hotel" class="btn btn-info" id="button">
					</form>
			</div>	
		</div>	
	</div>	
</body>
<script type="text/javascript">
	$(document).ready(function(){
		loadStates('id_sbHotelCountry','id_sbHotelState','1','id_sbHotelCity','0','0','0'); 
	
	});
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
		
</script>		
</html>
