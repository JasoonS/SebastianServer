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
