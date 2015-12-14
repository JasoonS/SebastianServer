<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>

<div class="right_col" role="main">
 <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('rooms_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('rooms_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('rooms_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('rooms_error') ?> </div>
		<?php } ?>
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
		<div class="row">
				<div class = "col-md-8 col-xs-12 col-md-offset-2 classFormBox">
					<div class="x_panel classRequiredPanel">
						<h1>Coming Soon</h1>
					</div>
				</div>
		</div>
	</div>
	 <footer>
		<div class="">
		    <p class="pull-right">Sebastian Admin |
		        <span class="lead"> <i class="fa fa-paw"></i></span>
		    </p>
		</div>
		<div class="clearfix"></div>
	</footer>	
</div>



	
