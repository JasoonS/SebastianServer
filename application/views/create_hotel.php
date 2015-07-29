<style>
.ui-datepicker-calendar,.ui-datepicker-month {
    display: none;
}​


</style>

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
	<?php
	
	?>
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		<fieldset>
		<!-- Form Name -->
		<legend>Create Hotel</legend>
		<!-- Text input-->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_name">Hotel Name</label>
			<div class="controls">
			<input id="sb_hotel_name" name="sb_hotel_name" type="text" placeholder="Type Hotel Name Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_name'); ?>
			</div>
		</div>
		<!-- Select Basic -->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_category">Hotel Category</label>
			<div class="controls">
				<select id="sb_hotel_category" name="sb_hotel_category" class="input-large">
					<option>Hotel</option>
					<option>Resort</option>
				</select>
			</div>
		</div>

		<div class="control-group">
		  <label class="control-label" for="sb_hotel_star">Hotel Star</label>
		  <div class="controls">
			 <!-- <input id="sb_hotel_star" name="sb-hotel-star" data-min="1" data-max="7" data-step="1">-->
			 <input id="sb_hotel_star" name="sb_hotel_star" value="0" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false">
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
			<input id="sb_hotel_email" name="sb_hotel_email" type="text" placeholder="Type Hotel Email Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_email'); ?>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="sb_hotel_website">Hotel Website</label>
			<div class="controls">
			<input id="sb_hotel_website" name="sb_hotel_website" type="text" placeholder="Type Hotel Website Url Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_website'); ?>
			</div>
		</div>
		
		
		<div class="control-group">
			<label class="control-label" for="sb_hotel_owner">Hotel Owner</label>
			<div class="controls">
			<input id="sb_hotel_owner" name="sb_hotel_owner" type="text" placeholder="Type Hotel Owner Name Here ..." class="input-large" >
			<?php echo form_error('sb_hotel_owner'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_property_built_month">Hotel Property Built Month</label>
			<div class="controls">
				<select id="sb_property_built_month" name="sb_property_built_month" class="input-large">
					<option value='1'>January</option>
					<option value='2'>February</option>
					<option value='3'>March</option>
					<option value='4'>April</option>
					<option value='5'>May</option>
					<option value='6'>June</option>
					<option value='7'>July</option>
					<option value='8'>August</option>
					<option value='9'>September</option>
					<option value='10'>October</option>
					<option value='11'>November</option>
					<option value='12'>December</option>
				</select>
			</div>
		</div>
		
	
		
		<div class="control-group">
			<label class="control-label" for="sb_property_built_year">Hotel Property Built Year</label>
			<div class="controls">
			<input id="sb_property_built_year" name="sb_property_built_year" type="text"  class="input-large" >
			<?php echo form_error('sb_property_built_year'); ?>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="sb_property_open_year">Hotel Property Opened Year</label>
			<div class="controls">
			<input id="sb_property_open_year" name="sb_property_open_year" type="text"  class="input-large" >
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
					echo "<option value='".$country['country_id']."'>".$country['country_name']."</option>";
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
			<textarea id="sb_hotel_address" name="sb_hotel_address" required=""></textarea>
			<?php echo form_error('sb_hotel_address'); ?>
		  </div>
		</div>

		<!-- Text input-->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_zipcode">Postal Code</label>
		  <div class="controls">
			<input id="sb_hotel_zipcode" name="sb_hotel_zipcode" type="text"  placeholder="Type Postal Code Here" class="input-large"  maxlength="5">
				<?php echo form_error('sb_hotel_zipcode'); ?>
		  </div>
		</div>
		
		
		</fieldset>
		<fieldset>
			<?php //print_r($languagelist);?>
			<?php
					$i=0;
					while($i<count($languagelist))
					{
					    echo '<div class="checkbox">';
						echo '<label><input type="checkbox" name="sb_languages[]" value="'.$languagelist[$i]['lang_id'].'" checked>'.$languagelist[$i]['lang_name'].'</label>';
						echo '</div>';
						$i++;
					}
			?>
		

        <div class="control-group">
		  <label class="control-label" for="submit"></label>
		  <div class="controls">
			<button id="submit"  class="btn btn-primary">Create Hotel</button>
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
    loadStates('sb_hotel_country','sb_hotel_state','1','sb_hotel_city','0','0','0'); 
	$("#sb_hotel_pic").fileinput({
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


