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
<style>
.eventClass{
	color :'#000 !important';
}
.Colordiv {   
    float: left;
    width: 15px;
    height: 15px;
    margin: 1px 20px 0px 5px;
    border-width: 1px;
    border-style: solid;
    border-color: rgba(0,0,0,.2);
}

.fc-slats tr {
    border: 1px red;
}
#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
</style>
<div class="right_col" role="main">
    <div class="">
		<div class="page-title">
			<div class="title_left">
                <h3>
					Staff Work Details
                        <!--<small>
							Click to add/edit events
                        </small>-->
                </h3>
            </div>

            <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>-->
        </div>
		<div class="clearfix"></div>
		<!-- Upper Widgets -->
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="row">
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
					<div class="tile-stats">
						<div class="count" id="idPendingRequest">0</div>
							<h3>Pending Requests</h3>
						</div>
			     </div>
				<div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
					<div class="tile-stats">
						<div class="count" id="idAcceptedRequest">0</div>
							<h3>Accepted Requests</h3>
						</div>
			    </div>
                <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
					<div class="tile-stats">
						<div class="count" id="idCompletedRequest">0</div>
							<h3>Completed Requests</h3>
						</div>
			     </div> 
                 <div class="animated flipInY col-lg-2 col-md-2 col-sm-4 col-xs-12">
					<div class="tile-stats">
						<div class="count" id="idRejectedRequest">0</div>
							<h3>Rejected Requests</h3>
						</div>
			     </div>
				<div class="animated flipInY col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="tile-stats">
					   
						<div>
							<div class="Colordiv" style="background-color:red;"></div><div>Pending Requests</div><br>
							<div class="Colordiv" style="background-color:orange;"></div><div>Accepted Requests</div><br>
							<div class="Colordiv" style="background-color:green;"></div><div>Completed Requests</div><br>
							<div class="Colordiv" style="background-color:blue;"></div><div>Rejected Requests</div>
						</div>
						
				    </div>
			    </div>	
            </div>
		</div>
		
		<!-- -->
		<div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                    <h2>Staff Name :<?php echo $hotel_user_name;?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            </ul>
                                <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id='calendar'></div>
					</div>
                </div>
            </div>
		</div>
    </div>
	<!-- footer content -->
    <footer>
		<div class="">
			<p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
    <div id="fc_create" data-toggle="modal" data-target="#CalenderModalNew"></div>
    <div id="fc_edit" data-toggle="modal" data-target="#CalenderModalEdit"></div>
	
	<!-- Start Calender modal To Assign Task To Staff.-->
    <div id="idAssignTask" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Assign Task</h4>
					<div id="successMessage" style="display:none"></div>
                </div>
            <div class="modal-body">
                <div id="testmodal" style="padding: 5px 20px;">
					<form id="antoform" class="form-horizontal calender" role="form">
                        <div class="form-group">
                        <label class="col-sm-3 control-label">Assign To</label>
							<div class="col-sm-9">
								<select id="sb_hotel_user_id" name="sb_hotel_user_id" class="form-control" >
										<?php
										foreach($other_staff as $key=>$value)
										{
										   echo "<option value='".$value['sb_hotel_user_id']."'>".$value['sb_hotel_username']."</option>";
										}
									   ?> 
								</select>
                            </div>
							<input type="hidden" id="req_id" name="req_id" />
                        </div>
                        
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default antoclose" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary antosubmit" onclick="assignRequest()">Proceed</button>
            </div>
            </div>
        </div>
    </div>
    <div id="CalenderModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
				<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel2">Edit Calender Entry</h4>
					
                </div>
                <div class="modal-body">
					<div id="testmodal2" style="padding: 5px 20px;">
                        <form id="antoform2" class="form-horizontal calender" role="form">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="title2" name="title2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" style="height:55px;" id="descr2" name="descr"></textarea>
                                </div>
                            </div>
						</form>
					</div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default antoclose2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary antosubmit2" onclick="assignRequest();">Save changes</button>
                </div>
            </div>
        </div>
    </div>	
</div>
 <script>
            $(window).load(function () {

                var date = new Date();
                var d = date.getDate();
                var m = date.getMonth()-1;
                var y = date.getFullYear();
                var started;
                var categoryClass;
                var acceptedrequests =0;
				var rejectedrequests =0;
                var pendingrequests	 =0;
                var completedrequests =0;				
                var calendar = $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
					defaultView: 'agendaDay',
					eventLimit: true, // for all non-agenda views
  
					views: {
						basic: {
							// options apply to basicWeek and basicDay views
						},
						agenda: {
							// options apply to agendaWeek and agendaDay views
							eventLimit: 2,
							
						},
						week: {
							// options apply to basicWeek and agendaWeek views
							eventLimit: 2,
							
						},
						day: {
							// options apply to basicDay and agendaDay views
							eventLimit: 2,
							
						}
    },
	   
					//slotMinutes: 60,
					//defaultEventMinutes: 120,			   
					allDaySlot: true,
					allDayText:"Notes",
                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
					   
                      /*  $('#fc_create').click();

                        started = start;
                        ended = end

                        $(".antosubmit").on("click", function () {
                            var title = $("#title").val();
                            if (end) {
                                ended = end
                            }
                            categoryClass = $("#event_type").val();

                            if (title) {
                                calendar.fullCalendar('renderEvent', {
                                        title: title,
                                        start: started,
                                        end: end,
                                        allDay: allDay
                                    },
                                    true // make the event "stick"
                                );
                            }
                            $('#title').val('');
                            calendar.fullCalendar('unselect');

                            $('.antoclose').click();

                            return false;
                        });*/
                    },
                    eventClick: function (calEvent, jsEvent, view) {
                        //alert(calEvent.title, jsEvent, view);
                         $("#successMessage").hide();
						 $("#req_id").val(calEvent.id);
						 $("#idAssignTask").modal('show');
                       /* $('#fc_edit').click();
                        $('#title2').val(calEvent.title);
                        categoryClass = $("#event_type").val();

                        $(".antosubmit2").on("click", function () {
                            calEvent.title = $("#title2").val();

                            calendar.fullCalendar('updateEvent', calEvent);
                            $('.antoclose2').click();
                        });
                        calendar.fullCalendar('unselect');*/
                    },
					eventRender: function(event, element,view) {
							/*element.qtip({
								content: event.description
							});*/
						   /* var row = $(".fc-slats tr:contains('"+ moment(event.start).format('ha') + "')");
							if (moment(event.start).format('mm') != '00')
							{
								row = row.next();
							}
							console.log(element);*/
						//row.height(element.height()+row.height());
							if(event.backgroundColor == "orange"){
								acceptedrequests=acceptedrequests +1;				
							}
							if(event.backgroundColor == "blue"){
								rejectedrequests=rejectedrequests +1;
							}
							if(event.backgroundColor == "red"){
								pendingrequests=pendingrequests+1;
								
							}
							if(event.backgroundColor == "green"){
								completedrequests=completedrequests+1;
							}
							
							//data-toggle="tooltip" data-placement="bottom" title="Tooltip bottom"
							element.attr('data-toggle',"tooltip" );
							element.attr('data-placement',"top");
							element.attr('title',event.description);
					},
					 eventAfterRender: function( event, element, view ) { 
						/*var row = $(".fc-slats tr:contains('"+ moment(event.start).format('ha') + "')");
							console.log("dsa");
							console.log(moment(event.start).format('mm'));
							if (moment(event.start).format('hh') != '00')
							{
								row = row.next();
							}
							console.log(element);
						row.height(element.height()+row.height());*/
					},
					eventAfterAllRender:function( event, element, view)
					{
						
						$("#idAcceptedRequest").html(acceptedrequests);
						$("#idRejectedRequest").html(rejectedrequests);
						$("#idPendingRequest").html(pendingrequests);
						$("#idCompletedRequest").html(completedrequests);
						acceptedrequests = 0;
						rejectedrequests = 0;
						pendingrequests=0;
						completedrequests =0;
						
					},
					editable: true,
					eventSources: {
						url : '<?php echo base_url('admin/Staffreport/staffTasks')."/".$hotel_user_id;?>'
					}
                  
                });
            });
 
function assignRequest()
{
	var hotel_staff_id=$("#sb_hotel_user_id").val();
	var req_id=$("#req_id").val();
	$.ajax({
		url: request_url,
		type:"post",
		data:{"hotel_staff_id":hotel_staff_id,"req_id":req_id,"flag":18},
		dataType:"json",
		async: false,
		success:function(data){
			console.log(data);
			$("#calendar").fullCalendar("refetchEvents");
			$("#successMessage").html("This request is assigned to particular staff successfully.");
			$("#successMessage").show();
			
		},
		error:function(){
				alert("Error");
			}
		});
	
} 
			
 </script>