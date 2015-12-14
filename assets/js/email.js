$(document).ready(function(){
	var LINK = $("div#email").attr('data');
	$("p").click(function(){
	var id = $(this).attr('data');

	//$.post(link+'get_email',{ID:id},function(d,s){
		/*var email_details = JSON.parse(d);
		$("p.date").html(email_details[3]);
		$("h4.subject").html("Subject : "+email_details[1]);
		$("span.sender_email").html(email_details[0]);
		$("div.view-mail").html("<h2>Message</h2> "+email_details[2]);*/
		
		/*function setSession(variable, value) {
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("GET", "setSession.php?variable=" + sender_email_id + "&value=" + email_details[0], true);
        xmlhttp.send();
        
    	}*/

	//});
	
	});
});
