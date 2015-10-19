<link href="<?php echo THEME_ASSETS;?>css/bootstrap.min.css" rel="stylesheet">
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<link href="<?php echo THEME_ASSETS;?>css/email/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS;?>css/animate.min.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS;?>css/email/custom.css" rel="stylesheet">
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<link href="<?php echo THEME_ASSETS;?>css/email/icheck/flat/green.css" rel="stylesheet">	
<script src="<?php echo THEME_ASSETS;?>/js/email.js"></script>
<div class="right_col" role="main"  id="email">
	<div class="clearfix"></div>
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> Inbox Design<small>User Mail</small></h2>
						<a class="btn btn-sm btn-primary pull-right" href="<?php echo BASE_URL; ?>admin/Email/compose"><i class="fa"></i> Compose</a>               

						<div class="clearfix"></div>
					</div>
				<div class="x_content">
					<div class="row">
						<div class="col-sm-3 mail_list_column vertical-scroll">
							<?php foreach($names as $row){ ?>
								<div class="mail_list">
									<div class="left">
										<i class="fa fa-circle"></i> 
									</div>
									<div class="right" id="user">
										<h3><p id="<?php echo $row->email_id; ?>" data="<?php echo $row->sb_hotel_user_id; ?>" onclick="showEmail('<?php echo $row->email_id; ?>','<?php echo $row->sb_hotel_useremail; ?>');"><?php echo $row->sb_hotel_username; ?></p></h3>
									</div>
								</div>	
							<?php } ?>    
						</div>
    <!-- /MAIL LIST -->
	<!-- CONTENT MAIL -->
                        <div class="col-sm-9 mail_view ">
						    
                            <div class="inbox-body" style="display:none;">
                                <div class="mail_heading row">
                                    <div class="col-md-8">
                                        
                                    </div>
                                    <div class="col-md-4 text-right datewrapper" style="display:none;">
                                        <p class="date"> </p>
                                    </div>
                                    <div class="col-md-12 subjectwrapper" style="display:none;">
                                        <h4 class="subject"> </h4>
                                    </div>
                                </div>
                                <div class="sender-info" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span class="sender_email"></span>
										</div>
                                    </div>
                                </div>
                                <div class="view-mail vertical-scroll" style="display:none;" >
								</div>
                                <div class="compose-btn pull-left" id="reply" style="display:none;">
                                <a class="btn btn-sm btn-primary" href="<?php echo BASE_URL; ?>admin/Email/reply"><i class="fa fa-reply"></i> Reply</a>
                               

								</div>
                            </div>
						</div>
<script type="text/javascript">
function showEmail(id,senderemail)
{
	$.ajax({
					url: request_url,
					type:"post",
					data:{flag:"27","email_id":id},
					dataType:"json",
					async: "false",
					success:function(msg){
								var data = msg;
						
								$(".subject").html(data[0].email_subject);
								$(".date").html(data[0].sent_on);
								$(".sender_email").html(senderemail);
								$(".view-mail").html(data[0].email_message);
								$(".inbox-body").show();
								$(".view-mail").show();
								$(".sender-info").show();
								$(".subjectwrapper").show();
								$(".datewrapper").show();
								$("#reply").show();
							},
					error:function(msg){
						console.log("failuer");
					}
				});	
}
</script>