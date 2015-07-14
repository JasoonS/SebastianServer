<div class="account-container">
	
	<div class="content clearfix">
		<form action="<?php echo base_url().$action?>" method="post">
		
			<h1>User Login</h1>		
			
			<div class="login-fields" id="idLoginFields">
				
				<p>Please provide your details</p>
				
				<div class="field" id="idFields">
					<label for="username">Username</label>
					<input type="text" id="idUsername" name="username" value="<?php echo set_value('username');?>" placeholder="Username" class="login username-field" />
					<?php echo form_error('username'); ?>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" id="idPassword" name="password" value="<?php echo set_value('password');?>" placeholder="Password" class="login password-field"/>
					<p class="text-danger"><?php echo form_error('password'); ?></p>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox" id="idLoginChkbox">
					<input id="idRememberMe" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">Keep me signed in</label>
				</span>
									
				<input type="submit" class="button btn btn-success btn-large" id="idSignIn" value="Sign In">
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->

