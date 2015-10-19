<!-- Theme specfic js!-->
<link href="<?php echo THEME_ASSETS;  ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
<!--<link href="<?php echo THEME_ASSETS?>css/calendar/fullcalendar.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS?>css/calendar/fullcalendar.print.css" rel="stylesheet" media="print">
<script src="<?php echo THEME_ASSETS?>js/moment.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/calendar/fullcalendar.min.js"></script>-->
        <style>
        	.row{
        		margin-right: 0px;
    			margin-left: 0px;
        	}
        	.msgbybody{
        		padding-left: 15%;
			    width: 75%;
			    color: grey;
			    background-color: #CCD8F1;
			    border-radius: 25px;
			    padding-top: 10px;
			    padding-bottom: 10px;
			    
        	}
        	.msgby{
        		padding-top: 10px;
        		font-weight: bolder;
			    color: #1995DC;
			    /*float: left;*/
        	}
        	.msgbyme{
        		padding-top: 10px;
        		font-weight: bolder;
			    color: #1995DC;
			    float: right;
        	}
        	.msgbymebody{
        		padding-right: 15%;
			    width: 75%;
			    color: grey;
			    background-color: #CCD8F1;
			    border-radius: 25px;
			    padding-top: 10px;
			    padding-bottom: 15px;
			    float: right;
			    text-align: right;
        	}

            @media only screen and (max-width : 540px) 
            {
                .chat-sidebar
                {
                    display: none !important;
                }
                
                .chat-popup
                {
                    display: none !important;
                }
            }
            
            body
            {
                background-color: #e9eaed;
            }
            
            .chat-sidebar
            {
                width: 200px;
                position: fixed;
                height: 100%;
                right: 0px;
                top: 0px;
                padding-top: 10px;
                padding-bottom: 10px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .sidebar-name 
            {
                padding-left: 10px;
                padding-right: 10px;
                margin-bottom: 4px;
                font-size: 12px;
            }
            
            .sidebar-name span
            {
                padding-left: 5px;
            }
            
            .sidebar-name a
            {
                display: block;
                height: 100%;
                text-decoration: none;
                color: inherit;
            }
            
            .sidebar-name:hover
            {
                background-color:#e1e2e5;
            }
            
            .sidebar-name img
            {
                width: 32px;
                height: 32px;
                vertical-align:middle;
            }
            
            .popup-box
            {
                display: none;
                position: fixed;
                bottom: 50px;
                right: 220px;
                height: 315px;
                background-color: rgb(237, 239, 244);
                width: 300px;
                border: 1px solid rgba(29, 49, 91, .3);
            }
            
            .popup-box .popup-head
            {
                background-color: #6d84b4;
                padding: 5px;
                color: white;
                font-weight: bold;
                font-size: 14px;
                clear: both;
            }
            
            .popup-box .popup-head .popup-head-left
            {
                float: left;
            }
            
            .popup-box .popup-head .popup-head-right
            {
                float: right;
                opacity: 0.5;
            }
            
            .popup-box .popup-head .popup-head-right a
            {
                text-decoration: none;
                color: inherit;
            }
            
            .popup-box .popup-messages
            {
                height: 75%;
                overflow-y: scroll;
            }
            


        </style>
        
        <script>
            //this function can remove a array element.
            Array.remove = function(array, from, to) {
                var rest = array.slice((to || from) + 1 || array.length);
                array.length = from < 0 ? array.length + from : from;
                return array.push.apply(array, rest);
            };
        
            //this variable represents the total number of popups can be displayed according to the viewport width
            var total_popups = 0;
            
            //arrays of popups ids
            var popups = [];
        
            //this is used to close a popup
            function close_popup(id)
            {
                for(var iii = 0; iii < popups.length; iii++)
                {
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                        
                        document.getElementById(id).style.display = "none";
                        
                        calculate_popups();
                        
                        return;
                    }
                }   
            }
        
            //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
            function display_popups()
            {
                var right = 220;
                
                var iii = 0;
                for(iii; iii < total_popups; iii++)
                {
                    if(popups[iii] != undefined)
                    {
                        var element = document.getElementById(popups[iii]);
                        element.style.right = right + "px";
                        right = right + 320;
                        element.style.display = "block";
                    }
                }
                
                for(var jjj = iii; jjj < popups.length; jjj++)
                {
                    var element = document.getElementById(popups[jjj]);
                    element.style.display = "none";
                }
            }
            
            //creates markup for a new popup. Adds the id to popups array.
            function register_popup(id, name)
            {
                //alert(name);
                for(var iii = 0; iii < popups.length; iii++)
                {   
                    //already registered. Bring it to front.
                    if(id == popups[iii])
                    {
                        Array.remove(popups, iii);
                    
                        popups.unshift(id);
                        
                        calculate_popups();
                        
                        
                        return;
                    }
                }               
                
                var element = '<div class="popup-box chat-popup" id="'+ id +'">';
                element = element + '<div class="popup-head">';
                element = element + '<div class="popup-head-left">'+ name +'</div>';
                element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\''+ id +'\');">&#10005;</a></div>';
                element = element + '<div style="clear: both"></div></div><div id="'+id+'_id"  class="popup-messages"></div><div style="padding-top:10px;" class="row"><div class="col-md-9"><input class="form-control" type="text"></div><div class="col-md-3"><button class="btn btn-primary btn-block">Send</button></div></div>';
                
                document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;  
        
                popups.unshift(id);
                        
                calculate_popups();
                makeActive(id,name);
            }
            
            //calculate the total number of popups suitable and then populate the toatal_popups variable.
            function calculate_popups()
            {
                var width = window.innerWidth;
                if(width < 540)
                {
                    total_popups = 0;
                }
                else
                {
                    width = width - 200;
                    //320 is width of a single popup box
                    total_popups = parseInt(width/320);
                }
                
                display_popups();
                
            }
            
            //recalculate when window is loaded and also when window is resized.
            window.addEventListener("resize", calculate_popups);
            window.addEventListener("load", calculate_popups);
            
        </script>
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
window.setInterval(function(){
  /// call your function here
  function_name();
}, 5000);

function function_name() {
	for (var i = popups.length - 1; i >= 0; i--) {
		console.log(popups[i]);
		var guestName=$("#"+popups[i] + "_id").html();
		makeActive(popups[i],guestName);
	};
}


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

	//guestName=$("#"+booking_id+" .popup-head-left").html();
	console.log("We need to get populate right panel now..");
	console.log(guest_booking_id);
	if(guest_booking_id == ""){
		//$(".view-mail").html("<h1>Please Select Customer From Left Panel to Read Query.</h1>");
		
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
										//html= html + "<div class='row'><div class='col-md-6 pull-left'>"+"<div style='width:30%;display:inline;float:left'> <b><br>"+guestName+"</b></div><div style='width:70%;float:right'><p class='triangle-right left'>"+this.forum_msg+"</p></div></div></div>";
										html += "<div class='row'><div class='msgby'>"+this.sb_guest_firstName+"</div><div class='msgbybody'>"+this.forum_msg+"</div></div>";
										//html += "<div class='row'><div class='msgbybody'>"+this.forum_msg+"</div></div>";
									}
									else{
										//html= html + "<div class='row'><div class='col-md-6 pull-right'>"+"<div style='width:67%;display:inline;float:left'><p class='triangle-right right'>"+this.forum_msg+"</p></div><div style='width:30%;float:right'><b><br>"+this.sb_hotel_username+"</b></div></div></div>";
										html += "<div class='row'><div class='msgbyme'>"+this.sb_hotel_username+"</div><div class='msgbymebody'>"+this.forum_msg+"</div></div>";
									}
				          		});
								$("#"+booking_id+">.popup-messages").html(html);
								var scrollId = guest_booking_id+"_id";
								console.log(scrollId);
								var objDiv = document.getElementById(scrollId);
								//var objDiv =guestName=$("#"+booking_id+"_id");
								objDiv.scrollTop = objDiv.scrollHeight;
							},
					error:function(msg){
						console.log("failuer");
					}
				});
	  	}
	//$("div").removeClass("customeractive");
	//$("#"+guest_booking_id).addClass("customeractive");
	//$("#idCustomerName").html("<h4>"+guestName+"</h4>");
	  //$(".view-mail").scrollTop = $(".view-mail").scrollHeight;
}
function updateLeftPanel()
	{
		/*
			<div class='sidebar-name'>
                <a href="javascript:register_popup('"+this.booking_id+"', '"+this.sb_guest_firstName +"');">
                    <img width="30" height="30" src="https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p50x50/1510656_10203002897620130_521137935_n.jpg?oh=572eaca929315b26c58852d24bb73310&oe=54BEE7DA&__gda__=1418131725_c7fb34dd0f499751e94e77b1dd067f4c" />
                    <span class="badge badge-success">'+this.unread_count+'</span>
                    <span>QScutter</span>
                </a>
            </div>
		*/
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
									/*html =html+	'<div class="mail_list" style="min-height:50px;" id="'+this.booking_id+'" onclick="makeActive('+this.booking_id+','+"'"+this.sb_guest_firstName +" "+this.sb_guest_lastName+"'"+')"><div class="left" style="padding-left:1%"><span class="badge badge-success">'+this.unread_count+'</span> </div><div class="right" style="padding-left:3%">'+								
											 '<h3>'+this.sb_guest_firstName +" "+this.sb_guest_lastName +'</h3> <small>';
											if(this.created_on !=null){
												html =html+ formatdate(this.created_on)+'</small></div></div>';
											}
											else{
												
												html =html+""+'</small></div></div>';
											}*/
									html += "<div  class='sidebar-name mail_list' style='min-height:50px;'>";
							        html += "<a href=\"javascript:register_popup('"+this.booking_id+"', '"+this.sb_guest_firstName+"');\">";
							        //html += " <img width='30' height='30' src='https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xap1/v/t1.0-1/p50x50/1510656_10203002897620130_521137935_n.jpg?oh=572eaca929315b26c58852d24bb73310&oe=54BEE7DA&__gda__=1418131725_c7fb34dd0f499751e94e77b1dd067f4c' />";
							        html += " <span class='badge badge-success'>"+this.unread_count+"</span>";
							        html += " <span>"+this.sb_guest_firstName +"</span>";
							        html += " </a>";
							        html += "</div>";
															 
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