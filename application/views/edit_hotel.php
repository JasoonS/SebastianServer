	<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-checktree.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-checktree.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
	<style>
	.ui-datepicker-calendar,.ui-datepicker-month {
		display: none;
	}	​
	</style>

<div class="right_col">	
	<div class="content clearfix">
	<!-- This is for Success Message.-->
	<?php if ($this->session->flashdata('category_success')) { ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
    <?php } ?>
	<!-- This is for Generic Error Message.-->
	<?php if ($this->session->flashdata('category_error')) { ?>
    <div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
	<?php } ?>
	<?php
	
	?>
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		<fieldset>
		<!-- Form Name -->
		<legend>Update Hotel</legend>
		<!-- Text input-->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_name">Hotel Name</label>
			<div class="controls">
			<input id="sb_hotel_name" name="sb_hotel_name" type="text" placeholder="Type Hotel Name Here ..." class="input-large" value="<?php echo $hoteldata['sb_hotel_name']?>" disabled>
			<?php echo form_error('sb_hotel_name'); ?>
			</div>
		</div>
		<!-- Select Basic -->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_category">Hotel Category</label>
			<div class="controls">
				<select id="sb_hotel_category" name="sb_hotel_category" class="input-large">
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
			</div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="sb_hotel_star">Hotel Star</label>
		  <div class="controls">
			 <!-- <input id="sb_hotel_star" name="sb-hotel-star" data-min="1" data-max="7" data-step="1">-->
			 <input id="sb_hotel_star" name="sb_hotel_star" value="<?php echo $hoteldata['sb_hotel_star'];?>" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false">
		  </div>
		</div>

		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_pic">Hotel Picture</label>
			<div class="controls">
				<input id="sb_hotel_pic" name="sb_hotel_pic" type="file"  class="input-large" >
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_email">Hotel Email</label>
			<div class="controls">
			<input id="sb_hotel_email" name="sb_hotel_email" type="text" placeholder="Type Hotel Email Here ..." class="input-large" value="<?php echo $hoteldata['sb_hotel_email'];?>" >
			<?php echo form_error('sb_hotel_email'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="sb_hotel_website">Hotel Website</label>
			<div class="controls">
			<input id="sb_hotel_website" name="sb_hotel_website" type="text" placeholder="Type Hotel Website Url Here ..." class="input-large" value="<?php echo $hoteldata['sb_hotel_website']?>">
			<?php echo form_error('sb_hotel_website'); ?>
			</div>
		</div>
		
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_owner">Hotel Owner</label>
			<div class="controls">
			<input id="sb_hotel_owner" name="sb_hotel_owner" type="text" placeholder="Type Hotel Owner Name Here ..." class="input-large" value="<?php echo $hoteldata['sb_hotel_owner']?>">
			<?php echo form_error('sb_hotel_owner'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_property_built_month">Hotel Property Built Month</label>
			<div class="controls">
				<select id="sb_property_built_month" name="sb_property_built_month" class="input-large">
				<?php 
					$monthArray = array('January','February','March','April','May','June','July','August','September','October','November','December');
					$i=0;
					while($i<count($monthArray))
				    {
						if($i==$hoteldata['sb_property_built_month'])
						{
							echo "<option value='".$i."' checked>".$monthArray[$i]."</option>";	
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
		
	
		
		<div class="control-group">
			<label class="control-label" for="sb_property_built_year">Hotel Property Built Year</label>
			<div class="controls">
			<input id="sb_property_built_year" name="sb_property_built_year" type="text"  class="input-large" value="<?php echo $hoteldata['sb_property_built_year']?>">
			<?php echo form_error('sb_property_built_year'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_property_open_year">Hotel Property Opened Year</label>
			<div class="controls">
			<input id="sb_property_open_year" name="sb_property_open_year" type="text"  class="input-large" value="<?php echo $hoteldata['sb_property_open_year']?>">
			<?php echo form_error('sb_property_open_year'); ?>
			</div>
		</div>
		
		
		<!-- Select Basic -->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_country">Country</label>
		  <div class="controls">
		  
			<select id="sb_hotel_country" name="sb_hotel_country" class="input-large" required="" onchange="loadStates('sb_hotel_country','sb_hotel_state','1','sb_hotel_city','0','0','0')">
				<?php
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
				?>   				
			</select>
			<?php echo form_error('sb_hotel_country'); ?>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_state">State</label>
		  <div class="controls">
			<select id="sb_hotel_state" name="sb_hotel_state" class="input-large" required="" onchange="loadCities('sb_hotel_state','sb_hotel_city','0','0')">
			  
			</select>
			<?php echo form_error('sb_hotel_state'); ?>
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_city">City</label>
		  <div class="controls">
			<select id="sb_hotel_city" name="sb_hotel_city" class="input-large" required="">
			 
			</select>
			<?php echo form_error('sb_hotel_city'); ?>
		  </div>
		</div>
		
		

		<!-- Textarea -->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_address">Hotel Address</label>
		  <div class="controls">                     
			<textarea id="sb_hotel_address" name="sb_hotel_address" required=""><?php echo $hoteldata['sb_hotel_address']?></textarea>
			<?php echo form_error('sb_hotel_address'); ?>
		  </div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_zipcode">Postal Code</label>
		  <div class="controls">
			<input id="sb_hotel_zipcode" name="sb_hotel_zipcode" type="text"  placeholder="Type Postal Code Here" class="input-large"  maxlength="5" value="<?php echo $hoteldata['sb_hotel_zipcode']?>">
				<?php echo form_error('sb_hotel_zipcode'); ?>
		  </div>
		</div>
		
		
		</fieldset>
		<fieldset>
			<?php 
				$selectedlanguages =explode(',',$hoteldata['lang_id']);
				$i=0;
				while($i<count($languagelist))
					{
					    if (in_array($languagelist[$i]['lang_id'], $selectedlanguages)) {
								 echo '<div class="checkbox">';
								 echo '<label><input type="checkbox" name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'" checked>'.$languagelist[$i]['lang_name'].'</label>';
						         echo '</div>';
						}
						else{
								echo '<div class="checkbox">';
								echo '<label><input type="checkbox" name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'">'.$languagelist[$i]['lang_name'].'</label>';
								echo '</div>';
						}
						$i++;
					}
			?>
		

        <div class="control-group">
		  <label class="control-label" for="submit"></label>
		  <div class="controls">
			<button id="submit"  class="btn btn-primary">Update Hotel</button>
		  </div>
		</div>		
		</fieldset>
	</form>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
  //called when key is pressed in textbox
  $("#sb_hotel_zipcode").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
		}
   });
    $("#sb_hotel_country").val("<?php echo $hoteldata['sb_hotel_country'];?>");
    loadStates('sb_hotel_country','sb_hotel_state','1','sb_hotel_city','1','<?php echo $hoteldata['sb_hotel_state']?>','<?php echo $hoteldata['sb_hotel_city']?>');
	$("#sb_hotel_pic").fileinput({
	     initialPreview: [
			"<img src='<?php echo FOLDER_BASE_URL.HOTEL_PIC."/".$hoteldata['sb_hotel_pic'];?>' class='file-preview-image' alt='Hotel Image' title='HotelImage'>",
        ],
		showUpload: false,
		showCaption: false,
		browseClass: "btn btn-primary btn-lg",
		fileType: "any",
        previewFileIcon: "<i class='glyphicon glyphicon-king'></i>"
	});
	
	  $('#sb_property_built_year').datepicker({
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
		
		  $('#sb_property_open_year').datepicker({
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
	
	
});
</script>


