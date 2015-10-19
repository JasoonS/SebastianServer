<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS?>css/calendar/fullcalendar.css" rel="stylesheet">
<!--<link href="<?php echo THEME_ASSETS?>css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">-->
<script src="<?php echo THEME_ASSETS?>js/moment.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/calendar/fullcalendar.min.js"></script>
<div class="right_col" role="main">
                <div class="">
					<div class="page-title">
                        <div class="title_left">
                            <h3>
								Customer Enquiry
                            </h3>
                        </div>

                      
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2> Customer Messages</h2>
                                  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-3 mail_list_column vertical-scroll" id="leftCustomers">
                                           
										</div>
                                        <!-- /MAIL LIST -->


                                        <!-- CONTENT MAIL -->
                                        <div class="col-sm-9 mail_view " >
                                            <div class="inbox-body">
                                                <div class="mail_heading row">
                                                    <div class="col-md-12" id="idCustomerName">
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div class="view-mail right-vertical-scroll" style="overflow-x:hidden;">
                                                   
												</div>
                                              
												<div class="row "> 
												<div class="col-md-12">
												    <textarea class="form-control" rows="3" style="90%" id="idPostMessage" ></textarea>
                                                    </div></div>

												
                                                <div class="compose-btn pull-right">
                                                    <button class="btn btn-sm btn-success" onclick="postAnswer();"><i class="fa fa-arrow-right"></i> Submit </button>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- /CONTENT MAIL -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">Sebastian Admin |
                            <span class="lead"> <i class="fa fa-paw"></i> </span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

	</div>
<script type="text/javascript">
var guest_booking_id="";
var guestName="";
updateLeftPanel();

function postAnswer()
{
    var postMessage=$("#idPostMessage").val();
	if((guest_booking_id == "")||(postMessage == "")){
		console.log("Nothing To Submit");
	}
	else{
		console.log("Submit Message via ajax.");
		  $.ajax({
					url: request_url,
					type:"post",
					data:{flag:"21","guest_booking_id":guest_booking_id,"postMessage":postMessage},
					dataType:"json",
					async: "false",
					success:function(msg){
								var data = msg;
								$("#idPostMessage").val("");
								makeActive(guest_booking_id,guestName);
							},
					error:function(msg){
						console.log("failuer");
					}
				});	
		$("#idPostMessage").val("");
		  $(".view-mail").scrollTop = $(".view-mail").scrollHeight;
	}
}
function formatdate(date)
{
	var dt = date.split(" ");
	var datepart =dt[0].split("-");
	var timepart=dt[1].split(":");
	var d=new Date(datepart[0],datepart[1]-1,datepart[2].replace(/^0+/, ''),timepart[0],timepart[1].replace(/^0+/, ''),timepart[2].replace(/^0+/, ''));
	var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
	var date = datepart[2] + " " + month[datepart[1].replace(/^0+/, '')-1] + ", " + datepart[0];
	var hour="";
	var exten="";
	if(timepart[0]>12){
		hour=timepart[0]%12;
		exten="pm";
	}
	else{
		hour=timepart[0];
		exten="am";
	}

	
	return date + " at " + hour+ ":"+timepart[1]+":"+timepart[2]+exten;

}
function makeActive(booking_id,name)
{
	guest_booking_id=booking_id;
	guestName=name;
	console.log("We need to get populate right panel now..");
	console.log(guest_booking_id);
	if(guest_booking_id == ""){
		$(".view-mail").html("<h1>Please Select Customer From Left Panel to Read Query.</h1>");
		
	}
	else{
	    $.ajax({
					url: request_url,
					type:"post",
					data:{flag:"20","guest_booking_id":guest_booking_id},
					dataType:"json",
					async: "false",
					success:function(msg){
								var data = msg;
								var html="";
								$.each(data, function() {
								console.log(data);
									if(this.sender_type == "customer")
									{
										html= html + "<div class='row'><div class='col-md-6 pull-left'>"+"<div style='width:30%;display:inline;float:left'> <b><img style='height:30%;width:30%' src="+user_pic_url+"/"+'1440675235.jpg'+" class='img-circle profile_img' /><br>"+guestName+"</b></div><div style='width:70%;float:right'><p class='triangle-right left'>"+this.forum_msg+"</p></div></div></div>";
										//html= html + "<div class='row'><div class='col-md-6 pull-left'>"+"<p class='triangle-right<b>"+guestName+" Said :"+"</b></p><p class='triangle-right left'>"+this.forum_msg+"</p></div></div>";
									}
									else{
										html= html + "<div class='row'><div class='col-md-6 pull-right'>"+"<div style='width:67%;display:inline;float:left'><p class='triangle-right right'>"+this.forum_msg+"</p></div><div style='width:30%;float:right'><b><img style='height:30%;width:30%' src="+user_pic_url+"/"+this.sb_hotel_user_pic+" class='img-circle profile_img' /><br>"+this.sb_hotel_username+"</b></div></div></div>";

									}
				          		});
								$(".view-mail").html(html);
							},
					error:function(msg){
						console.log("failuer");
					}
				});
	  	}
	$("div").removeClass("customeractive");
	$("#"+guest_booking_id).addClass("customeractive");
	$("#idCustomerName").html("<h4>"+guestName+"</h4>");
	  $(".view-mail").scrollTop = $(".view-mail").scrollHeight;
}
function updateLeftPanel()
	{
		$.ajax({
					url: request_url,
					type:"post",
					data:{flag:"19"},
					dataType:"json",
					async: "false",
					success:function(msg){
								var data = msg;
								var html="";
								$.each(data, function() {
									html =html+	'<div class="mail_list" style="min-height:50px;" id="'+this.booking_id+'" onclick="makeActive('+this.booking_id+','+"'"+this.sb_guest_firstName +" "+this.sb_guest_lastName+"'"+')"><div class="left" style="padding-left:1%"><span class="badge badge-success">'+this.unread_count+'</span> </div><div class="right" style="padding-left:3%">'+								
																	 '<h3>'+this.sb_guest_firstName +" "+this.sb_guest_lastName +'</h3> <small>';
																	if(this.created_on !=null){
																		html =html+ formatdate(this.created_on)+'</small></div></div>';
																	}
																	else{
																		
																		html =html+""+'</small></div></div>';
																	}
															 
				          		});
								$("#leftCustomers").html(html);
								makeActive(guest_booking_id,guestName);
								
							},
					error:function(msg){
						console.log("failuer");
					}
				}).done(function (){
					setTimeout(updateLeftPanel, 5400);	
		});

	}
</script>	