<div class="row" style="margin-top:20px;">
  	<div class="container">
    	<div class="col-md-4 col-md-offset-8">
	    	<div class="pull-right">
	    		<a href="http://localhost/join.sebastian" class="btn btn-dark">Add Property</a>
	    	</div>  
	    </div>
  	</div>
</div>

<div id="wrapper">
	<div id="login" class="animate form">
	    <section class="login_content">
	        <form action="<?php echo base_url().$action?>" method="post">
	            <h1>Login</h1>

	            <?php if($this->session->flashdata('AuthMsg')) { ?>
		            <p class="bg-danger">
		            	<?php echo $this->session->flashdata('AuthMsg');  ?>
		            </p>
	            <?php } ?>

	            <?php if($this->session->flashdata('SuccMsg')) { ?>
					<p class="bg-success">
						<?php echo $this->session->flashdata('SuccMsg');  ?>
					</p>
	            <?php } ?>

	            <div class="classLoginFrmFields" id="idLoginFields">
					<input type="text" class="form-control" placeholder="Username" id="idUsername" name="username" value="<?php echo set_value('username');?>" required="" />
					<?php echo form_error('username'); ?>
				</div>

	            <div class="classLoginFrmFields" id="idPasswordFields">
					<input type="password" class="form-control" id="idPassword" name="password" value="<?php echo set_value('password');?>" placeholder="Password" required="" />
					<?php echo form_error('password'); ?>
				</div>

	            <div class="classLoginFrmFields">
					<input type="submit" id="idSignIn" value="Sign In" name="sign_in" class="btn btn-dark">                    
					<a class="reset_pass" href="<?php echo base_url('admin/recover');?>">Lost your password?</a>
				</div>

	            <div class="clearfix"></div>

	            <div class="separator">               
	                <div class="clearfix"></div>
	                <br />
	                <div>
	                    <h1><i class="fa fa-paw"></i> Sebastian Admin!</h1>

	                    <p>©2015 All Rights Reserved.Privacy and Terms</p>
	                </div>
	            </div>
	        </form>
	        <!-- form -->
	    </section>
	    <!-- content -->
	</div>
</div>
</div>

