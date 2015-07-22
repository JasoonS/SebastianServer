
function loadStates(inputelementname,outputelementname,populatecities,cityelement)
{
	var base_url = '../ajax/get_ajax_data';
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
		if(populatecities = 1){
			loadCities(outputelementname,cityelement);
		}
	});
}

function loadCities(inputelementname,outputelementname)
{
	var base_url = '../ajax/get_ajax_data';
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
		});
}
