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
        		<table id="example" class="table table-striped responsive-utilities jambo_table">
			        <thead>
			            <tr>
			                <th>Last Name</th>
			                <th>First Name</th>
			                <th>Email Id</th>
			                <th>Phone No</th>
			                <th>Reservation Code</th>
			            </tr>
			        </thead>
                    
                    <tfoot>
			            <tr>
			                <th>Last Name</th>
			                <th>First Name</th>
			                <th>Email Id</th>
			                <th>Phone No</th>
			                <th>Reservation Code</th>
			            </tr>
        			</tfoot>

                    <tbody>
                        <?php foreach($guest_list as $list) { ?>
                            <tr id="idRow_"<?php echo $list->sb_guest_reservation_code ?>>
                                <td><?php echo $list->sb_guest_lastName ?></td>
                                <td><?php echo $list->sb_guest_firstName ?></td>
                                <td><?php echo $list->sb_guest_email ?></td>
                                <td><?php echo $list->sb_guest_contact_no ?></td>
                                <td><span class="label label-warning"><a href="javascript:void(0)"><?php echo $list->sb_guest_reservation_code ?></a></span></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        	</div>
        </div>
        <div class = "row">
        	<div class = "col-md-2 classBtn">
        		<button class="btn btn-info btn-sm" id="idAddNewGuest" type="button">Add new guest</button>
        	</div>
        	<div class = "col-md-2 classBtn">
        		<button class="btn btn-info btn-sm" id="idAddNewTask" type="button">Create new task</button>
        	</div>
        </div>
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

<!-- line modal -->
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

<!--Page specfic js !-->

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
    $('#example thead th').each( function () {
        var title = $('#example tfoot th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

   
    // DataTable
    var table = $('#example').DataTable({
    	"ordering": false,
		"sPaginationType": "full_numbers",
		"dom": 'T<"clear">lfrtip',
		initComplete: function ()
		{
		  var r = $('#example tfoot tr');
		  r.find('th').each(function(){
		    $(this).css('padding', 8);
		  });
		  $('#example thead').append(r);
		  $('#search_0').css('text-align', 'center');
		}
    });

    // Changing color attribute for first tr

    $('table.jambo_table').find("tr:first").css('color', '#000');
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );

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
    	jsFrmGuestObj.flag       = 16;

    	// Update Services
        jqXHRSaveGuest = $.post(ajax_url,jsFrmGuestObj,function( data ){});

        jqXHRSaveGuest.success(function(data)
        {
           console.log(data);
        });

    })
});
</script>
 <!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function () {

        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange_right span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
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
</script>
<!-- datepicker -->
<script type="text/javascript">
    $(document).ready(function () {

        var cb = function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
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
            opens: 'left',
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
        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
        $('#reportrange').daterangepicker(optionSet1, cb);
        $('#reportrange').on('show.daterangepicker', function () {
            console.log("show event fired");
        });
        $('#reportrange').on('hide.daterangepicker', function () {
            console.log("hide event fired");
        });
        $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
            console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('MMMM D, YYYY'));
        });
        $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
            console.log("cancel event fired");
        });
        $('#options1').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
        });
        $('#options2').click(function () {
            $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
        });
        $('#destroy').click(function () {
            $('#reportrange').data('daterangepicker').remove();
        });
    });
</script>
<!-- /datepicker -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#single_cal1').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_1"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal2').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_2"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal3').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_3"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
        $('#single_cal4').daterangepicker({
            singleDatePicker: true,
            calender_style: "picker_4"
        }, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#reservation').daterangepicker(null, function (start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
        });
    });
</script>
<!-- /datepicker -->
