
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
	
	<form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		<fieldset>
		<!-- Form Name -->
		<legend>Select Hotel Services For <?php echo $hotel_name;?></legend>
		<!-- Tree -->
		<div class="control-group">
			<label class="control-label" for="sb_hotel_category">Available Services</label>
			<div class="controls">
				<?php echo $servicestree; ?>
			</div>
		</div>
		
		<div class="control-group">
		  <label class="control-label" for="submit"></label>
		  <div class="controls">
			<button id="submit"  class="btn btn-primary">Update Services</button>
		  </div>
		</div>
		
    </fieldset>
	</form>
</div>
</div>
<script type="text/javascript">
$(document).ready(function () {
$('#tree').checktree();
});

</script>


