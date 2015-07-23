
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
	
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" >
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
			 <input id="sb_hotel_star" name="sb_hotel_star" value="0" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" >
		  </div>
		</div>

		<!-- Select Basic -->
		<div class="control-group">
		  <label class="control-label" for="sb_hotel_country">Country</label>
		  <div class="controls">
			<select id="sb_hotel_country" name="sb_hotel_country" class="input-large" required="" onchange="loadStates('sb_hotel_country','sb_hotel_state','1','sb_hotel_city')">
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
			<select id="sb_hotel_state" name="sb_hotel_state" class="input-large" required="" onchange="loadCities('sb_hotel_state','sb_hotel_city')">
			  
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
    loadStates('sb_hotel_country','sb_hotel_state','1','sb_hotel_city'); 
	//loadCities('sb_hotel_state','sb_hotel_city');
});

</script>


