var proj_url		=	location.protocol + "//" + location.host;

var js_requesting	= 'admin/ajax/get_ajax_data';
/* This method is used to load states according to country and callback to load cities according to states
 * params string,string,boolean,string,boolean,string,string
 *
 */
function loadStates(inputelementname,outputelementname,populatecities,cityelement,haveDefaultStateAndCity,state,city)
{

	var base_url = proj_url+'/sebastian/admin/ajax/get_ajax_data';
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
	var base_url = proj_url+'/sebastian/admin/ajax/get_ajax_data';
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

