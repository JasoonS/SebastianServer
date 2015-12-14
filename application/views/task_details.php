<!-- page content -->
<script src="<?php echo THEME_ASSETS?>js/jquery.min.js"></script>
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
	<div class="row">
		<div class ="col-md-12">
            <?php $task_details = $task_details[0];?>
		</div>
	</div>
    
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo $task_details['sb_child_servcie_name']." Request from ".$task_details['sb_guest_allocated_room_no'];?></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br>
                    <form id="task_form" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="" action="<?php echo base_url()?>admin/Tasks/action" method="POST">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Customer Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" readonly="readonly" class="form-control" placeholder="Default Input" value="<?php echo strtoupper($task_details['sb_guest_firstName'].' '.$task_details['sb_guest_lastName']);?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Service Due Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" readonly="readonly" class="form-control" placeholder="Default Input" value="<?php echo strtoupper($task_details['service_due_date']);?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Service Due Time</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" readonly="readonly" class="form-control" placeholder="Default Input" value="<?php echo strtoupper($task_details['service_due_time']);?>">
                            </div>
                        </div>
                        <?php 
                            $array = array();
                            $array = json_decode($task_details['sb_service_log'],true);
                        if(count($array)>0)
                        foreach ($array as $key => $value){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12"><?php echo $key;?></label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <textarea type="text" readonly="readonly" class="form-control" placeholder="Default Input"><?php echo $value;?></textarea>
                            </div>
                        </div>
                        <?php }?>
                        <input type="hidden" name="sb_hotel_requst_ser_id" value="<?php echo$task_details['sb_hotel_requst_ser_id']; ?>">
                        <input type="hidden" id="action" name="action">
                        <input type="hidden" id="sb_hotel_ser_start_date" name="sb_hotel_ser_start_date">
                        <input type="hidden" id="sb_hotel_ser_start_time" name="sb_hotel_ser_start_time">
                        <?php if(count($staff)>0){?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Staff</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="sb_hotel_ser_assgnd_to_user_id" id="sb_hotel_ser_assgnd_to_user_id" class="form-control">
                                    <option value="0">Select</option>
                                    <?php for ($i=0; $i <count($staff); $i++) { ?>
                                    <option <?php if($task_details['sb_hotel_ser_assgnd_to_user_id'] == $staff[$i]['sb_hotel_user_id']) echo "selected";?> value="<?php echo $staff[$i]['sb_hotel_user_id']?>"><?php echo $staff[$i]['sb_hotel_username']?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <?php } else {?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Staff</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <!-- <div class="x_panel"> -->
                                    <div class="x_content bs-example-popovers">
                                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                            <strong>You dont have staff for this Service!</strong> <a href="<?php echo base_url()?>admin/user/type/hotel-admin">Please click here to manage staff</a>.
                                        </div>
                                    </div>
                                <!-- </div> -->
                            </div>
                        </div>
                        <?php }?>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Reject Reason</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" name ="reject_reason" id="reject_reason" class="form-control" placeholder="Reason"  maxlength="250">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button <?php if($task_details['sb_hotel_service_status'] == 'accepted') echo "disabled"?> type="button" class="btn btn-success" onclick="accept()">Accept</button>
                                <button type="button" class="btn btn-warning" onclick="reject()">Reject</button>
                                <button <?php if($task_details['sb_hotel_service_status'] != 'accepted') echo "disabled"?> type="button" class="btn btn-warning" onclick="complete()">Complete</button>
                                <button type="button" class="btn btn-primary" onclick="back()">Back</button>                                
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function reject() {
        if(document.getElementById("reject_reason").value == "")
        {
            alert("Reason is mendetory to reject order");
            $('#reject_reason').addClass('parsley-error');
            document.getElementById("reject_reason").focus();
            document.getElementById("reject_reason").select();
        }
        else
        {
            var d = new Date();
            var currentTime = moment(d).format('hh:mm:ss');
            var currentDate = moment().format("YYYY-MM-DD");


            document.getElementById("sb_hotel_ser_start_time").value = currentTime;
            document.getElementById("sb_hotel_ser_start_date").value = currentDate;
            document.getElementById("action").value = "reject";
            document.getElementById("task_form").submit();    
        }        
    }

    function accept() {
        var sb_hotel_ser_assgnd_to_user_id = $('#sb_hotel_ser_assgnd_to_user_id').val();
        if(sb_hotel_ser_assgnd_to_user_id != '0' && sb_hotel_ser_assgnd_to_user_id > 0)
        {
            var d = new Date();
            var currentTime = moment(d).format('hh:mm:ss');
            var currentDate = moment().format("YYYY-MM-DD");


            document.getElementById("sb_hotel_ser_start_time").value = currentTime;
            document.getElementById("sb_hotel_ser_start_date").value = currentDate;
            document.getElementById("action").value = "accept";
            document.getElementById("task_form").submit();
        }
        else
        {
            alert("Please select Staff");
            $('#sb_hotel_ser_assgnd_to_user_id').addClass('parsley-error');
            document.getElementById("sb_hotel_ser_assgnd_to_user_id").focus();
            document.getElementById("sb_hotel_ser_assgnd_to_user_id").select();
        }
    }

    function complete() {
        var sb_hotel_ser_assgnd_to_user_id = $('#sb_hotel_ser_assgnd_to_user_id').val();
        if(sb_hotel_ser_assgnd_to_user_id != '0' && sb_hotel_ser_assgnd_to_user_id > 0)
        {
            //var d = new Date();
            //var currentTime = moment(d).format('hh:mm:ss');
            //var currentDate = moment().format("YYYY-MM-DD");


            //document.getElementById("sb_hotel_ser_start_time").value = currentTime;
            //document.getElementById("sb_hotel_ser_start_date").value = currentDate;
            document.getElementById("action").value = "complete";
            document.getElementById("task_form").submit();
        }
        else
        {
            alert("Please select Staff");
            $('#sb_hotel_ser_assgnd_to_user_id').addClass('parsley-error');
            document.getElementById("sb_hotel_ser_assgnd_to_user_id").focus();
            document.getElementById("sb_hotel_ser_assgnd_to_user_id").select();
        }
    }

    function back() {
        var url = '<?php echo base_url()?>'+"admin/Dashboard";
        window.location = url;
    }
</script>
