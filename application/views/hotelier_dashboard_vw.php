
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

<style>
.tile-stats {
    font-family: 'Open Sans', sans-serif;
    padding: 0;
    margin: 0;
    font-size: 13px;
    font-weight: bold;
    text-transform: uppercase;
}
.wrap{
    color: #73879C;
    overflow: hidden;
}
.location{
    padding:10px 10px 0;
}
.bxslider{
    padding:0;
    margin:0;
}
.col-a{
    padding: 0 0 0 10px;
    width: 50%;
    float: left;
    height:110px;
}
.col-b{
    float:left;
    width: 45%;
}
.temp{
    font-size:24px;
    padding:0;
    margin:0;
}
.wind{
    font-size:10px;
    font-weight:normal;
}
#myajax i{
    color: #1995DC;
}
#myGuest a{
    color: #1995DC;
}

#roommember {
    cursor:pointer;
    cursor:hand;
}
#roommember:hover {
        background-color: #E4E4E4;
}
</style>

<div class="right_col" role="main">
	<div class="row">
		<div class ="col-md-12">
            <div class="row top_tiles">
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="wrap">
                            <ul class="bxslider">
                                <li id="col-0">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">Please share Your location</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                                <li id="col-1">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">Please share Your location</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                                <li id="col-2">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">Please share Your location</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                              </ul>
                        </div>
                    </div>
                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <h3>Currency Converter</h3>
                        <br>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4"><input id ="from" type="text" class="form-control"></div>
                            <div class="col-md-4">
                                <select id="from_currency" class="form-control" onchange="getRate()">
                                    <option value="TRY">Lira</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-4"><input id ="to" type="text" class="form-control"></div>
                            <div class="col-md-4">
                                <select id="to_currency" class="form-control" onchange="getRate()">
                                    <option value="TRY">Lira</option>
                                    <option value="EUR">EUR</option>
                                    <option value="USD">USD</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                        </div>
                        <div class="count">179</div>

                        <h3>New Sign ups</h3>
                        <p>Lorem ipsum psdea itgum rixt..</p>
                    </div>
                </div>
            </div>
		</div>
	</div><br>

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

                        </ul>
                    </div>
                </div>
                <div class="x_title">
                    <hr>
                    <button type="button" class="btn btn-block btn-default">More Info</button>
                </div>
            </div>
		</div>

		<div class ="col-md-6">

                <div class="x_panel">
                <div class="x_title">
                    <h2>Guest</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="">
                        <ul class="to_do" id="myGuest">

                        </ul>
                    </div>
                </div>
                <div class="x_title">
                    <hr>
                    <button type="button" class="btn btn-block btn-default">More Info</button>
                </div>
            </div>

		</div>
	</div>
</div>


<div class="edit_elementName">
    <div id="room_pop" class="modal fade" role="dialog">
        <div class="modal-dialog" style="width:35%;">
            <!-- Modal content-->
            <div class="modal-content">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                          <h4>Allocate Roomnumber</h4><hr>
                            <input type="hidden" id='allote_sb_hotel_guest_booking_id' name='allote_sb_hotel_guest_booking_id' value=''>
                            <div class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="no_rooms">Number of Rooms to allote</label>
                                  <select class="form-control" id="no_rooms" name="no_rooms" onchange="no_rooms_change()">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div id="roomrow" class="row">
                              <div class="col-md-4">
                                <div class="form-group">
                                  <label for="room_1">Room 1</label>
                                  <input required type="text" class="form-control myroom" id="room_1" name="room_1" onkeydown="return event.keyCode!=32">
                                </div>
                              </div>
                            </div>
                            <hr>
                            <div id="roomrow" class="row">
                              <div class="col-md-12">
                                <div class="form-group">
                                     <button type="submit" onclick="submit_room()" id="submit_room" class="btn btn-block btn-primary">Allote</button>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <script>

                    function submit_room(){
                            document.getElementById("submit_room").disabled = true;
                            var sb_hotel_guest_booking_id = document.getElementById('allote_sb_hotel_guest_booking_id').value;
                            var no_rooms = document.getElementById('no_rooms').value;
                            var room_names = [];
                            var empty_value = 0;
                            for (var i = 1; i <= no_rooms; i++) {
                                var r_name = document.getElementById("room_"+i+"").value;
                                if(r_name == "")
                                    empty_value++;
                                room_names.push(r_name);
                            };
                            //console.log(room_names);
                            if(empty_value == 0)
                            {
                                $.ajax({
                                    url: '<?php echo base_url()?>'+"admin/HotelRooms/room_allocate",
                                    //dataType: "jsonp",
                                    type:'post',
                                    data: {sb_hotel_guest_booking_id: sb_hotel_guest_booking_id,room_names:room_names},
                                    success: function(response) {

                                        if (response == 1) {
                                            guest();
                                            alert("Rooms Allocated successfully");
                                            $('#room_pop').modal('hide');
                                        }
                                    }
                                });
                            }
                            else
                            {
                                alert("Please Enter Room Number(s)");
                                document.getElementById("submit_room").disabled = false;
                            }
                        }
                    </script>
                <!-- </form> -->
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

var sb_hotel_guest_booking_id;
function allote_rooms(sb_hotel_guest_booking_id)
{
    document.getElementById('allote_sb_hotel_guest_booking_id').value = sb_hotel_guest_booking_id;
    document.getElementById('no_rooms').value = '1';
    document.getElementById("submit_room").disabled = false;
    no_rooms_change();
    $('#room_pop').modal('show');

}

function getInvoice(sb_hotel_guest_booking_id) {
    //alert(sb_hotel_guest_booking_id);
    url = '<?php echo base_url()?>'+"admin/HotelRooms/details/"+sb_hotel_guest_booking_id;
    window.location = url;
    ///admin/HotelRooms/details/10
}

function no_rooms_change () {
    var rooms = document.getElementById('no_rooms').value;
    $('#roomrow').empty();
    var add_room = '';
    for (var i = 1; i <= rooms; i++) {
        add_room += "<div class='col-md-4'><div class='form-group'><label for='room_"+i+"'>Room "+i+"</label><input onkeydown='return event.keyCode!=32' required type='text' class='form-control myroom' id='room_"+i+"' name='room_"+i+"'></div></div>";
    }
    $("#roomrow").append(add_room);
}

/*$( "#no_rooms" ).change(function() {

});*/

function getRate(){
    var to = document.getElementById('to').value;
    var from = document.getElementById('from').value;
    var to_currency = document.getElementById('to_currency').value;
    var from_currency = document.getElementById('from_currency').value;

    $.ajax({
        url: 'https://currency-api.appspot.com/api/'+from_currency+'/'+to_currency+'.jsonp',
        dataType: "jsonp",
        data: {amount: from},
        success: function(response) {

            if (response.success) {
                //console.log(parseFloat(response.rate).toFixed(2));
                document.getElementById('to').value = parseFloat(from).toFixed(2)*parseFloat(response.rate).toFixed(2);
                //alert('1 USD is worth ' + parseFloat(response.rate).toFixed(2) + ' EUR');
            }
        }
    });
}
setInterval(function() {
  $(".shakeme").velocity("callout.shake");
}, 2000);
// tasks();
// guest();
window.setInterval(function(){
  /// call your function here
  tasks();
  guest();
}, 5400);
function guest() {

    var fullDate = new Date();
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
    var currentDate =fullDate.getFullYear()+"-"+ twoDigitMonth + "-" +fullDate.getDate();
    hotel_id1 = <?php echo $this->session->userdata('logged_in_user')->sb_hotel_id?>;
    $.ajax({
        type:'post',
        //contentType: 'application/json; charset=utf-8',
        data: { hotel_id: hotel_id1, currentDate:currentDate },// service_due_date : currentDate},
        url: '<?php echo base_url()?>'+"admin/Dashboard/currentGuest",
        success: function (data) {
            //alert("Hi");
            //console.log(data);
            $('#myGuest').empty();
            var appenddata1 = "";
            var obj  = JSON.parse(data);
            if(obj.length > 0)
            {
                //console.log("update");
                for(var i = 0; i < obj.length; i++)
                {
                    //console.log(obj[i].flag);
                    if(obj[i].flag == 1)
                    {
                        appenddata1 += "<li><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" visited</p></li>";
                    }
                    else
                    {
                        //appenddata1 += "<li><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" <span style='float:right;'> ";
                        if(obj[i].room_no != "")
                        {
                            appenddata1 += "<li id='roommember' onclick='getInvoice("+obj[i].sb_hotel_guest_booking_id+")'><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" <span style='float:right;'> ";
                            appenddata1 += " Room No : "+obj[i].room_no+"</span></p></li>";
                        }
                        else
                        {
                            appenddata1 += "<li><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" <span style='float:right;'> ";
                            //var addroomurl= '<?php echo base_url()?>'+"admin/HotelRooms/Roomcheckin/"+obj[i].sb_hotel_guest_booking_id+"/"+obj[i].sb_guest_rooms_alloted;
                            appenddata1 += " <a onclick='allote_rooms("+obj[i].sb_hotel_guest_booking_id+")'>Please check for rooms</a></span></p></li>";
                        }
                    }
                }
            }
            else
            {
                appenddata1 += "<li><p>No new Guest</p></li>";
            }
            $("#myGuest").append(appenddata1);
      }

    }).done(function (){
        // setTimeout(tasks, 5400);
    });

}
function tasks() {
	hotel_id1 = <?php echo $this->session->userdata('logged_in_user')->sb_hotel_id?>;

	$.ajax({
	    type:'post',
	    //contentType: 'application/json; charset=utf-8',
	  	data: { hotel_id: hotel_id1 },// service_due_date : currentDate},
	    url: '<?php echo base_url()?>'+"admin/Dashboard/currentTasks",
	    success: function (data) {
	   		//console.log(data);
             //alert("Akshay");
	   		$('#myajax').empty();
			var appenddata1 = "";
	        var obj  = JSON.parse(data);
            if(obj.length > 0)
            {
    	        for(var i = 0; i < obj.length; i++)
    	        {
    	     		var sb_hotel_requst_ser_id = obj[i].sb_hotel_requst_ser_id;
    	     		var sb_guest_allocated_room_no = obj[i].sb_guest_allocated_room_no;
                    var service_type = obj[i].service_type;
                    if(service_type == 'order')
                    {
                        var sb_child_servcie_name = obj[i].orderDetails[0].sb_sub_child_service_name;
                    }
                    else
                    {
    	     		    var sb_child_servcie_name = obj[i].sb_child_servcie_name;
    	     		}var service_due_date = obj[i].service_due_date;
                    var service_due_time = obj[i].service_due_time;
                    var datetime = service_due_date+" "+service_due_time;
                    var status = obj[i].sb_hotel_service_status;
                    var d2 = new Date();
                    var d1 = new Date(datetime);
                    var seconds =  (d2- d1)/1000;
                    //console.log(seconds);
                    if(seconds >= 600 && status=="pending")
                    {
                        appenddata1 += "<li><p class='shakeme' style='color:rgb(245, 98, 98);font-weight: bold;'>";
                    }
                    else if(status=="accepted")
                    {
                        appenddata1 += "<li><p style='color:#009118'>";
                    }
                    else
                    {
                        appenddata1 += "<li><p style='color:rgb(245, 98, 98);font-weight: bold;'>";
                    }
                    //appenddata1 += "<option value = '" + obj[i].id + " '>" + obj[i].service_name + " </option>";
    	     		appenddata1 += sb_child_servcie_name+" Request From room : "+sb_guest_allocated_room_no+". ";
                    if(status=="accepted")
                    {
                        appenddata1 += "<p>Accepted by : "+obj[i].accepted_by;
                        //appenddata1 +="</p>";//</p></li>";
                        appenddata1 +="<span style='float:right;'><a onclick='action("+sb_hotel_requst_ser_id+")'><i class='fa fa-binoculars'></i></a></span></p></li>";
                    }
                    else
                    {
                        appenddata1 +="<span style='float:right;'><a onclick='action("+sb_hotel_requst_ser_id+")'><i class='fa fa-binoculars'></i></a></span></p></li>";
                    }
    	        }
            }
            else
            {
                appenddata1 += "<li><p>hooray no pending task</p></li>";
            }
            $("#myajax").append(appenddata1);
	  }

	}).done(function (){
		// setTimeout(tasks, 54000);
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
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
<link href='<?php echo THEME_ASSETS?>css/jquery.bxslider.css' rel='stylesheet' type='text/css'>

<script src="<?php echo THEME_ASSETS;?>js/jquery.bxslider.js"></script>
<script>
var month = new Array();
month[0] = "January";
month[1] = "February";
month[2] = "March";
month[3] = "April";
month[4] = "May";
month[5] = "June";
month[6] = "July";
month[7] = "August";
month[8] = "September";
month[9] = "October";
month[10] = "November";
month[11] = "December";


$('.bxslider').bxSlider({
  auto: true,
  controls: false
});
</script>

<script type="text/javascript">

</script>

<script>
getLocation();
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {

    var API = "http://api.openweathermap.org/data/2.5/forecast/daily?lat="+ position.coords.latitude +"&lon=" + position.coords.longitude+"&cnt=3&mode=json&APPID=79eaea6da847dd6943e9b63374fa8dfa";

    $.ajax({
        type: "get",
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        url: API,
    }).done(function(msg){
        var weather_description = new Array();

        var i = 0;
        while(i <= 3){
            temp_min = msg.list[i].temp.min - 272.15;
            temp_max = msg.list[i].temp.max - 272.15;
            temp = msg.list[i].temp.day - 272.15;
            //console.log(msg.list[i].weather[0].icon);

            sysdt = new Date(msg.list[i].dt * 1000);

            $("#col-"+(i)+" .sysdt").html(sysdt.getDate()+ " "+ month[sysdt.getMonth()]);
            $("#col-"+(i)+" .temp").html(Math.round(temp) + "&deg;C");
            $("#col-"+(i)+" .temp-min").html(Math.round(temp_min));
            $("#col-"+(i)+" .description").html(msg.list[i].weather[0].description.toLowerCase());
            $("#col-"+(i)+" .img").html("<img src=\"../assets/images/64x64/"+msg.list[i].weather[0].icon+".png\">");
            $("#col-"+(i)+" .wind").html(" wind "+msg.list[i].speed + "m/s "+ msg.list[i].deg + "&deg;");

            i++;
        }
    });
    // x.innerHTML = "Latitude: " + position.coords.latitude +
    // "<br>Longitude: " + position.coords.longitude;
}
</script>
