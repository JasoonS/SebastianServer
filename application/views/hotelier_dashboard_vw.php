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

		</div>
	</div>

	<div class="row">
		<div class ="col-md-6">
			<div class="x_panel">
                <div class="x_title">
                    <h2>Current pending tasks</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="">
                        <ul class="to_do"  id="myajax">
                            <li>
                                <p style="color:red"> Schedule meeting with new client </p>
                            </li>
                            <li>
                                <p> Create email address for new intern</p>
                            </li>
                            <li>
                                <p> Have IT fix the network printer</p>
                            </li>
                            <li>
                                <p> Copy backups to offsite location</p>
                            </li>
                            <li>
                                <p> Food truck fixie locavors mcsweeney</p>
                            </li>
                            <li>
                                <p> Food truck fixie locavors mcsweeney</p>
                            </li>
                            <li>
                                <p> Create email address for new intern</p>
                            </li>
                            <li>
                                <p> Have IT fix the network printer</p>
                            </li>
                            <li>
                                <p> Copy backups to offsite location</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>

		<div class ="col-md-6">
			<div class ="x_panel">

			</div>
		</div>
	</div>
</div>

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS;  ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS;  ?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/velocity.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/velocity.ui.js"></script>

<script type="text/javascript">
setInterval(function() {
  $(".shakeme").velocity("callout.shake");
}, 2000);
tasks();
// function getFormattedPartTime(partTime){
//         if (partTime<10)
//            return "0"+partTime;
//         return partTime;
// }
function tasks() {
	hotel_id1 = <?php echo $this->session->userdata('logged_in_user')->sb_hotel_id?>;
	//var date = new Date();
    //var currentDate = date.getFullYear() + "-" + getFormattedPartTime(date.getMonth()) + "-" + getFormattedPartTime(date.getDate()) + " " +  getFormattedPartTime(date.getHours()) + ":" + getFormattedPartTime(date.getMinutes()) + ":" + getFormattedPartTime(date.getSeconds());

	// var fullDate = new Date();
	// var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	// var currentDate =fullDate.getFullYear()+"-"+ twoDigitMonth + "-" +fullDate.getDate();
	//alert(hotel_id1);
	//formData = {hotel_id:"ravi"}; //Array 
	$.ajax({
	    type:'post',
	    //contentType: 'application/json; charset=utf-8',
	  	data: { hotel_id: hotel_id1 },// service_due_date : currentDate},
	    url: '<?php echo base_url()?>'+"admin/Dashboard/currentTasks",
	    success: function (data) {
	   		//console.log(data);
	   		$('#myajax').empty();
			var appenddata1 = "";
	        var obj  = JSON.parse(data);
	        for(var i = 0; i < obj.length; i++)
	        {
	     		var sb_hotel_requst_ser_id = obj[i].sb_hotel_requst_ser_id;
	     		var sb_guest_allocated_room_no = obj[i].sb_guest_allocated_room_no;
	     		var sb_child_servcie_name = obj[i].sb_child_servcie_name;
	     		var service_due_date = obj[i].service_due_date;
                var service_due_time = obj[i].service_due_time;
                var datetime = service_due_date+" "+service_due_time;
                var d2 = new Date();
                var d1 = new Date(datetime);
                var seconds =  (d2- d1)/1000;
                //console.log(seconds);
                if(seconds >= 600)
                {
                    appenddata1 += "<li><p class='shakeme' style='color:rgb(245, 98, 98);font-weight: bold;'>";
                }
                else
                {
                    appenddata1 += "<li><p>";
                }
                //appenddata1 += "<option value = '" + obj[i].id + " '>" + obj[i].service_name + " </option>";
	     		appenddata1 += sb_child_servcie_name+" Request From room : "+sb_guest_allocated_room_no;
                appenddata1 +="<span style='float:right;'><a onclick='action("+sb_hotel_requst_ser_id+")'><i class='fa fa-binoculars'></i></a></span></p></li>";
	        }
            $("#myajax").append(appenddata1);
	  }
		
	}).done(function (){
		setTimeout(tasks, 5400);	
	}); 
}

function action(sb_hotel_requst_ser_id) {
    var url = '<?php echo base_url()?>'+"admin/Tasks/task_details/";
    //window.location=url;

    method = "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", url);

    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", 'sb_hotel_requst_ser_id');
    hiddenField.setAttribute("value", sb_hotel_requst_ser_id);
    form.appendChild(hiddenField);
    
    document.body.appendChild(form);
    form.submit();
}
</script>
<!-- <footer>
    <div class="">
        <p class="pull-right"><?php echo $title; ?> from <a>Eeshana</a>. |
            <span class="lead"> <i class="fa fa-paw"></i> <?php echo $title; ?></span>
	    </p>
    </div>
    <div class="clearfix"></div>
</footer> -->