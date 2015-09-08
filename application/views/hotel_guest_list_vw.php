<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
    	</div>
        <div class="clearfix"></div>
        <div class="row">
        	<div class="x_content">
				<div class="x_panel">
					<div class="x_title">
					<ul class="nav navbar-right panel_toolbox">
						<button class="btn btn-sm btn-success" id="idAddNewGuest" type="button">Add new guest</button>
					</ul>
					<div class="clearfix"></div>
					</div>
				<table id="idGuest" class="table table-striped responsive-utilities jambo_table">
			        <thead>
			            <tr>
						    <th>Booking Id</th>
			                <th>Last Name</th>
			                <th>First Name</th>
			                <th>Email Id</th>
			                <th>Phone No</th>
			                <th>Reservation Code</th>
							<th>No Of Rooms</th>
							<th>Action</th>
			            </tr>
			        </thead>
                    
                    <tfoot>
			           
        			</tfoot>

                    <tbody>
                        <?php /*foreach($guest_list as $list) { ?>
                            <tr id="idRow_"<?php echo $list->sb_guest_reservation_code ?>>
                                <td><?php echo $list->sb_guest_lastName ?></td>
                                <td><?php echo $list->sb_guest_firstName ?></td>
                                <td><?php echo $list->sb_guest_email ?></td>
                                <td><?php echo $list->sb_guest_contact_no ?></td>
                                <td><span class="label label-warning"><a href="javascript:void(0)"><?php echo $list->sb_guest_reservation_code ?></a></span></td>
								<td><?php echo $list->sb_guest_rooms_alloted; ?></td>
							</tr>
                        <?php } */?>
                    </tbody>
                </table>
        	</div>
			</div>
        </div>
       <!-- <div class = "row">
        	<div class = "col-md-2 classBtn">
        		<button class="btn btn-info btn-sm" id="idAddNewGuest" type="button">Add new guest</button>
        	</div>
        	
        </div>-->
    </div>
    <!-- footer content -->
    <footer>
        <div class="">
            <p class="pull-right">Sebastian Admin |
                <span class="lead"> <i class="fa fa-paw"></i></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
</div>

<!-- This model is For Adding new Guest-->
<div class="modal fade" id="idAddGuestModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
        	<div class="x_panel">
                <div class="x_title">
                    <h2>Add new guest <small>Insert a confirmation id for guest</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" id="idAddGuetsFrm">
                    	<div class="form-group">
                        	<label class="control-label col-md-3 col-sm-3 col-xs-12">In/Out Date</label>
                            <div id="reportrange_right" class="col-md-9 col-sm-9 col-xs-12 classModalDatePicker">
                                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                <span id="idChekInOutDate">December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">First Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idGuestFirstName" placeholder="guest first name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Last Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idGuestLastName" placeholder="guest last name">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Reservation Code</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idReservationCode" placeholder="Reservation Code">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idGuestEmail">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Phone no</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idGuestPhoneno">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">No of rooms</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" id="idGuestNoOfRooms">
                            </div>
                        </div>
                    </form>
                </div>
                <p class="text-success" id="idSucessMsg"></p>
            </div>
        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" id="idSaveGuest" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- This Model is For Allocating Rooms -->
<div class="modal fade" id="idAllocateRooms" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Allocate Rooms</h4>
            </div>
            <div class="modal-body" id="" style ="height:auto">
			    
				
				<p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				                              
            </div>
		 </div>
    </div>
</div>
<!-- Theme specfic js !-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>	
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo THEME_ASSETS?>js/moment.min2.js"></script>
<script type="text/javascript" src="<?php echo THEME_ASSETS?>js/datepicker/daterangepicker.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	var jsFrmGuestObj = new Object();
	var jsFrmGuesrArr = [];
    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
	// Setup - add a text input to each footer cell
   /* $('#example thead th').each( function () {
        var title = $('#example tfoot th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );*/  
    // DataTable
    var table = $('#idGuest').DataTable({
    	"ordering": true,
		"sPaginationType": "full_numbers",
		"dom": 'T<"clear">lfrtip',
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'17',tablename:'tbname',orderkey: ' sb_hotel_id ',orderdir:' desc '},
            "type": "POST",
         
        },
		"order": [[ 1, "desc" ]],

        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0,7]
            }, //disables sorting for column one"visible": false,
			{
                'visible': false,
                'aTargets': [0]
            } 
		],
		initComplete: function ()
		{
		  var r = $('#idGuest tfoot tr');
		  r.find('th').each(function(){
		    $(this).css('padding', 8);
		  });
		
		}
    });

    $("#idAddNewGuest").on('click',function(){
    	// Intialize modal
        $('#idAddGuestModal').modal({
            show: true,
        });
    });

    $("#idSaveGuest").on('click',function(){
    	jsFrmGuestObj.inoutdates = $("#idChekInOutDate").html();
    	jsFrmGuestObj.firstname  = $("#idGuestFirstName").val();
    	jsFrmGuestObj.lastname 	 = $("#idGuestLastName").val();
    	jsFrmGuestObj.email 	 = $("#idGuestEmail").val();
    	jsFrmGuestObj.phone 	 = $("#idGuestPhoneno").val();
    	jsFrmGuestObj.noOfrooms  = $("#idGuestNoOfRooms").val();
		jsFrmGuestObj.confId	 = $("#idReservationCode").val();	
    	jsFrmGuestObj.flag       = 16;
    	// Update Services
        jqXHRSaveGuest = $.post(ajax_url,jsFrmGuestObj,function( data ){});
        jqXHRSaveGuest.success(function(data)
        {
           if(data)
           {
            $("#idAddGuestModal #idSucessMsg").html('New guest booking added.Reservation Code -'+data).delay(5000).fadeOut(function(){ window.location.reload(); });
           }
        });
    })

    var cb = function (start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
        $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    }

    var optionSet1 = {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: {
                days: 60
            },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM/DD/YYYY',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Clear',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        };

        $('#reportrange_right span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange_right').daterangepicker(optionSet1, cb);

        $('#reportrange_right').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange_right').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange_right').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange_right').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });

        $('#options1').click(function () {
            $('#reportrange_right').data('daterangepicker').setOptions(optionSet1, cb);
        });

        $('#options2').click(function () {
            $('#reportrange_right').data('daterangepicker').setOptions(optionSet2, cb);
        });

        $('#destroy').click(function () {
            $('#reportrange_right').data('daterangepicker').remove();
        });
    });
	
	function rescale(){
		var size = {width: $(window).width() , height: $(window).height() }
		/*CALCULATE SIZE*/
		var offset = 20;
		var offsetBody = 50;

		$('#idAllocateRooms').css('height', size.height - offset );
		$('#idAllocateRooms .modal-body').css('height', size.height - (offset + offsetBody));
		$('#idAllocateRooms').css('top', 0);
	}
	
	function allocateRoom(reservation_code,allowedRooms){
	var base_url = request_url;
	$.ajax({
		url: base_url,
		type:"post",
		data:{"reservation_code":reservation_code,"flag":11},
		dataType:"json",
		success:function(msg){
		    var data = msg;
			if(data[0].roomscount == allowedRooms){
				alert("Rooms for this customer are already allocated");
			}
			else{
			    var roomsToCreate = allowedRooms - data[0].roomscount;
				var i=0;
				var innerHtml = "";
				while(i<roomsToCreate){
				    var room_no=i+1;
					
					innerHtml +='<div class = "form-group classFormInputsBox" class="applypadding2">'+
							'<label class="col-md-4 col-xs-4 control-label" for="sb_vendorname">Room '+room_no+':</label>'+
							'<div class="col-md-8 col-xs-8">'+
							'<input id="sb_room_'+room_no+'" name="sb_room_'+room_no+'" type="text" class="form-control" value="" >'+
							'<div id="sb_room_'+room_no+'_err" class="errorclass" style="display:none"></div>'+
							'</div>'+
							'</div>';
					i++;
				}
				$("#idAllocateRooms .modal-body").html(innerHtml);
				$("#idAllocateRooms .modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'+
				'<button type="button" class="btn btn-danger" id="idAllocatedRooms" onclick="allocate(\''+reservation_code+'\');">Allocate</button>');	
				
				$("#idAllocateRooms").modal('show');
				rescale();
			}	
		},
		error:function(){
					alert("Error");
			}
		});
	}
	function allocate(reservation_code){
	    var roomsToAdd =$('[id^="sb_room_"]');
        var room_no_array=[];
		var i=0,cnt=1;
		while(i<roomsToAdd.length){
			checkAvailability("sb_room_"+cnt);
			console.log("#sb_room_"+cnt);
			
			if($("#sb_room_"+cnt).val() != ""){
				room_no_array.push($("#sb_room_"+cnt).val());
			}
			i++;cnt++;
		}

		if(room_no_array.length == 0){
			alert("Please Allocate atleast one room.");
		}
		else{
				$.ajax({
					url: request_url,
					type:"post",
					data:{"reservation_code":reservation_code,"rooms_array":room_no_array,"flag":13},
					dataType:"json",
					success:function(data){
						$("#idAllocateRooms").modal('hide');
					}
				});
	        }
	}
	function checkAvailability(e){
		var base_url = request_url;
		console.log(e);
		$.ajax({
		url: base_url,
		type:"post",
		data:{"room_no":$("#"+e).val(),"flag":12},
		dataType:"json",
		async: false,
		success:function(data){
			if(data[0].roomscount == 0)
			{
				$("#"+e).val("");
				$("#"+e+"_err").html("This room is invalid.");
				$("#"+e+"_err").show();
			}
		},
		error:function(){
				alert("Error");
			}
		});
		
	}
</script>

