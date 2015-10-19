<link href="<?php echo THEME_ASSETS;?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/email/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/email/custom.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/email/icheck/flat/green.css" rel="stylesheet">


<script src="<?php echo THEME_ASSETS;?>/js/email.js"></script>

    <div class="right_col" role="main"  id="email">

<div class="clearfix"></div>
<div class="row">
<div class="col-md-12">
<div class="x_panel">
<div class="x_title">
<h2> Compose Mail</h2>



   <div class="col-sm-9 mail_view" style="margin-top: 60px;border-left: none">
                                            		<div>
                                            			<form method="post" class="form">
                                            			<label>To</label>
                                            			<input type="text" name="receiver" style="width: 500px;"/>
                                            			<span class="error"><?php echo form_error('receiver'); ?></span><br /><br />
                                            			
                                            			<label style="margin-left: -30px">Subject</label>
                                            			<input type="text" name="subject" style="width: 500px;" />
                                            			<span class="error"><?php echo form_error('subject'); ?></span>
                                            			<br /><br />
                                            			
                                            			<label style="margin-left: -40px">Message</label>
                                            			<textarea name="message" style="width: 500px;"></textarea>
                                            			<span class="error"><?php echo form_error('message'); ?></span>
                                            			<br /><br />
 														<input type="submit" name="send" value="Send" class="btn btn-warning">
                                                    </div>	
                                                    
                                                    
														
                                                   	


                                            
                                         
                                            
                                            



                                       