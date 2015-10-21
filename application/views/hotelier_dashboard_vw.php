
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
                              </li><!--
                                <li id="col-3">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">...</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                                <li id="col-4">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">...</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                                <li id="col-5">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">...</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>
                                <li id="col-6">
                                  <div class="col-a">
                                    <p class="img"></p>
                                    <p class="description">...</p>
                                  </div>
                                  <div class="col-b">
                                    <p class="sysdt">...</p>
                                    <p class="temp">...</p>
                                    <p class="wind">...</p>
                                  </div>
                              </li>-->
                              </ul>
                        </div>
                    </div>
                </div>
                <!-- <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators --
                       <!--  <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                        </ol> --

                        <!-- Wrapper for slides --
                        <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <div class="tile-stats">
                                
                                <div class="count">$</div>

                                <h3>CURRENCY</h3>
                                <p id="usd"></p>
                            </div>
                          </div>

                          <div class="item">
                            <div class="tile-stats">
                                
                                <div class="count">£</div>

                                <h3>CURRENCY</h3>
                                <p id="gbp"></p>
                            </div>
                          </div>
                        
                          <div class="item">
                            <div class="tile-stats">
                                
                                <div class="count">₹</div>

                                <h3>CURRENCY</h3>
                                <p id="inr"></p>
                            </div>
                          </div>
                        </div>

                        <!-- Left and right controls --
                        <!-- <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a> --
                      
                    </div>
                </div> -->
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
                        <p>Lorem ipsum psdea itgum rixt.</p>
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

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS;  ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS;  ?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/velocity.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/velocity.ui.js"></script>

<script type="text/javascript">
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
tasks();
guest();
// function getFormattedPartTime(partTime){
//         if (partTime<10)
//            return "0"+partTime;
//         return partTime;
// }
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
            console.log(data);
            $('#myGuest').empty();
            var appenddata1 = "";
            var obj  = JSON.parse(data);
            if(obj.length > 0)
            {
                
                for(var i = 0; i < obj.length; i++)
                {
                    console.log(obj[i].flag);
                    if(obj[i].flag == 1)
                    {
                        appenddata1 += "<li><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" visited</p></li>";
                    }
                    else
                    {
                        appenddata1 += "<li><p>"+obj[i].sb_guest_firstName+" "+obj[i].sb_guest_lastName+" <span style='float:right;'> ";
                        if(obj[i].room_no != "")
                            appenddata1 += " Room No : "+obj[i].room_no+"</span></p></li>";
                        else
                        {
                            var addroomurl= '<?php echo base_url()?>'+"admin/HotelRooms/Roomcheckin/"+obj[i].sb_hotel_guest_booking_id+"/"+obj[i].sb_guest_rooms_alloted;
                            appenddata1 += " <a href='"+addroomurl+"'>Please check for rooms</a></span></p></li>";
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
        setTimeout(tasks, 5400);    
    }); 

}
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
	   		console.log(data);
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
                        appenddata1 +="</p></p></li>";
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

/*
var API = "http://api.openweathermap.org/data/2.5/weather?q=Pune";
//var API = "http://api.openweathermap.org/data/2.5/weather?q=Pune"
$.ajax({
    type: "get",
    enctype: 'multipart/form-data',
    contentType: false,
    processData: false,         
    url: API,
}).done(function(msg){

    temp = msg.main.temp - 272.15;  
    temp_min = msg.main.temp_min - 272.15;
    temp_max = msg.main.temp_max - 272.15;
    
    sysdt = new Date(msg.dt * 1000);
    sunrise = new Date( msg.sys.sunrise * 1000);
    sunset = new Date( msg.sys.sunset * 1000);
    
    $("#col-0 .img").html("<img src=images/64x64/"+msg.weather[0].icon+".png>");
    $("#col-0 .wind").html("Wind "+msg.wind.speed +"m/s " + msg.wind.deg + "&deg;");    
    $("#col-0 .description").html(msg.weather[0].description);
    $("#col-0 .temp").html(Math.round(temp) + "&deg;C");
    $("#col-0 .sysdt").html(sysdt.getDate() + " " +month[sysdt.getMonth()]);
});
*/
// var API = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Pune&cnt=3&mode=json";
// //var API = "http://api.openweathermap.org/data/2.5/weather?q=Pune"
// $.ajax({
//     type: "get",
//     enctype: 'multipart/form-data',
//     contentType: false,
//     processData: false,         
//     url: API,
// }).done(function(msg){
//     var weather_description = new Array();

//     var i = 0;
//     while(i <= 3){
//         temp_min = msg.list[i].temp.min - 272.15;
//         temp_max = msg.list[i].temp.max - 272.15;
//         temp = msg.list[i].temp.day - 272.15;
//         //console.log(msg.list[i].weather[0].icon);

//         sysdt = new Date(msg.list[i].dt * 1000);
        
//         $("#col-"+(i)+" .sysdt").html(sysdt.getDate()+ " "+ month[sysdt.getMonth()]);
//         $("#col-"+(i)+" .temp").html(Math.round(temp) + "&deg;C");      
//         $("#col-"+(i)+" .temp-min").html(Math.round(temp_min));
//         $("#col-"+(i)+" .description").html(msg.list[i].weather[0].description.toLowerCase());
//         $("#col-"+(i)+" .img").html("<img src=\"../assets/images/64x64/"+msg.list[i].weather[0].icon+".png\">");
//         $("#col-"+(i)+" .wind").html(" wind "+msg.list[i].speed + "m/s "+ msg.list[i].deg + "&deg;");
        
//         i++;
//     }
// });

$('.bxslider').bxSlider({
  auto: true,
  controls: false
});
</script>

<script type="text/javascript">
/*
var API = "http://api.fixer.io/latest?base=USD&symbols=TRY";
$.ajax({
    type: "get",
    enctype: 'multipart/form-data',
    contentType: false,
    processData: false,         
    url: API,
}).done(function(msg){
    //console.log(msg.rates.TRY);
    document.getElementById('usd').innerHTML = msg.rates.TRY + " TRY equals  to 1$.";
});

var API = "http://api.fixer.io/latest?base=GBP&symbols=TRY";
$.ajax({
    type: "get",
    enctype: 'multipart/form-data',
    contentType: false,
    processData: false,         
    url: API,
}).done(function(msg){
    //console.log(msg.rates.TRY);
    document.getElementById('gbp').innerHTML = msg.rates.TRY + " TRY equals  to 1£.";
});

var API = "http://api.fixer.io/latest?base=INR&symbols=TRY";
$.ajax({
    type: "get",
    enctype: 'multipart/form-data',
    contentType: false,
    processData: false,         
    url: API,
}).done(function(msg){
    //console.log(msg.rates.TRY);
    document.getElementById('inr').innerHTML = msg.rates.TRY + " TRY equals to 1₹.";
});
*/
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
    //console.log(API);
    //var API = "http://api.openweathermap.org/data/2.5/forecast/daily?q=Pune&cnt=3&mode=json";
    //var API = "http://api.openweathermap.org/data/2.5/weather?q=Pune"
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

<!-- <footer>
    <div class="">
        <p class="pull-right"><?php echo $title; ?> from <a>Eeshana</a>. |
            <span class="lead"> <i class="fa fa-paw"></i> <?php echo $title; ?></span>
	    </p>
    </div>
    <div class="clearfix"></div>
</footer>
