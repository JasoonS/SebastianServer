var proj_url=location.protocol + "//" + location.host;
/* This method is used to load states according to country and callback to load cities according to states
 * params string,string,boolean,string,boolean,string,string
 *
 */
function loadStates(inputelementname,outputelementname,populatecities,cityelement,haveDefaultStateAndCity,state,city)
{
	var base_url = proj_url+'/sebastian-admin-panel/admin/ajax/get_ajax_data';
	var country_id = $("#"+inputelementname).val();
	$.ajax({
			url: base_url,
			type:"post",
			data:{"country_id":country_id,flag:"1"},
			dataType:"json",
			success:function(msg){
					    var data = msg;
					    $("#"+outputelementname).html(""); 
						$.each(data, function() {
							$('#'+outputelementname).append( $('<option value="' + this.state_id + '">' + this.state_name + '</option>' ));
						});
					},
			error:function(){
				alert("failure");
			}
		}).done(function (){
		if(haveDefaultStateAndCity ==1)
		{
			$("#"+outputelementname).val(state);
		}
		if(populatecities == 1){
			loadCities(outputelementname,cityelement,haveDefaultStateAndCity,city);
		}
	});
}
/* This method is used to load cities
 * params string,string,boolean,string
 *
 */
function loadCities(inputelementname,outputelementname,haveDefaultStateAndCity,city)
{
	var base_url = proj_url+'/sebastian-admin-panel/admin/ajax/get_ajax_data';
	var state_id = $("#"+inputelementname).val();
	$.ajax({
			url: base_url,
			type:"post",
			data:{"state_id":state_id,flag:"2"},
			dataType:"json",
			success:function(msg){
					    var data = msg;
						console.log(data);
					    $("#"+outputelementname).html(""); 
						$.each(data, function() {
							$('#'+outputelementname).append( $('<option value="' + this.city_id + '">' + this.city_name + '</option>' ));
						});
					},
			error:function(){
				alert("failure");
			}
		}).done(function (){
		if(haveDefaultStateAndCity ==1)
		{
			$("#"+outputelementname).val(city);
		}	
	});
}
/* This method is used to load child services
 * params 
 *
 */
 function populateChildServices(loggedusertype,userid,hotelid)
 {
	console.log($("#sb_hotel_user_type").val());
	console.log($("#sb_parent_service_id").val());
	console.log(loggedusertype);
	console.log(userid);
	console.log(hotelid);
	var creation_user_type=$("#sb_hotel_user_type").val();
	var parent_service_id=$("#sb_parent_service_id").val();
	var base_url = proj_url+'/sebastian-admin-panel/admin/ajax/get_ajax_data';
	console.log(creation_user_type);
	if(creation_user_type == 's'){
		$("#child_services_control").show(2000);
		$.ajax({
			url: base_url,
			type:"post",
			data:{"sb_parent_service_id":parent_service_id,"logged_user_type":loggedusertype,"logged_user_id":userid,"hotel_id":hotelid,flag:"6"},
			dataType:"json",
			success:function(msg){
					    var data = msg;
						console.log(data);
						$("#sb_child_service_id").html(""); 
						$.each(data, function() {
							$('#sb_child_service_id').append( $('<option value="' + this.sb_child_service_id + '">' + this.sb_child_service_name + '</option>' ));
						});
					},
			error:function(msg){
				alert("failure");
			}
		}).done(function (){
		//Nothing in callback
	 });
	}
	else
	{
		$("#child_services_control").hide(2000);
	}

 }

