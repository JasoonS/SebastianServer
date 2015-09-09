$(document).ready(function(){	
	var headerHeight = $("div#header").height();
	var bodyHeight = $(document).height();
	$("div#menu").css("height",(bodyHeight-headerHeight)+"px");



$("select[name='country']").change(function(){
	var option = $(this).val();
	$.post("GetStateCity",{OPTION:option},function(d,s){
	});
	$("select[name='state']").html();
});

$(".form").submit(function(){
$("input[name='hotel_star']").hide();
});
});