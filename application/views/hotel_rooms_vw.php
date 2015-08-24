<html>
<head>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>

<script>
 $("#room_num_prefix").on("keydown",function(e){return e.which !==32;});
 $("#room_num_postfix").on("keydown",function(e){return e.which !==32;});
function formvalidate()
{
	// var room_num_from = $("#room_num_from").val().trim();
	// var room_num_to = $("#room_num_to").val().trim();
	var room_num_from = document.getElementById("room_num_from").value;
	var room_num_to = document.getElementById("room_num_to").value;
	if(room_num_from=="")
	{
		alert("please give From field");
		return false;
	}
	if(room_num_to=="")
	{
		alert("please give To field");
		return false;
	}
	if( room_num_from.trim() > room_num_to.trim() )
	{
		//alert( room_num_from.trim() > room_num_to.trim() );
		alert("From value must be smaller then To value");
		$("#room_num_from").val("");
		return false;		
	}

	// alert($("#room_num_from").val().trim());
	// alert($("#room_num_to").val().trim());
	//return false;
}
</script>
<script>
// $(document).ready(function(){
// 	$(function(){
// 	{
		
// 		var room_num_from = $("#room_num_from").val();
// 		var room_num_to = $("#room_num_to").val();
// 		if(room_num_from > room_num_to)
// 		{
// 			alert("From value must be smaller then To value");
// 			//$("#room_num_from").val("");
// 		}
// 	}
// });
// });
</script>

</head>
<body>

	<h3>Create Room</h3>
	<h5 style="color:#FF0000"><?php   echo $this->session->flashdata('rooms_success');
					echo $this->session->flashdata('rooms_error'); ?></h5>
	<div style="width:20%;margin:auto;padding:auto;">		
		<form role="form" method="post" action="<?php   echo BASE_URL.$action ?>" onsubmit="return formvalidate()" class="" name="create_rooms_form">
			<div class="form-group" style="">
			<!-- <label for="room_num">Room No.:</label> -->
			&nbsp;&nbsp;&nbsp;<br>
			<label for="room_num_from">Room No.: From:</label>
			<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_from" id="room_num_from" required>
			</div>
			<div class="form-group">
			<label for="room_num_to">To:</label>
			<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_to" id="room_num_to" required>
			</div>
			<div class="form-group">
			<label for="room_num_prefix">Prefix</label>
			<input type="text" class="form-control" name="room_num_prefix" id="room_num_prefix">
			</div>
			<div class="form-group">
			<label for="room_num_postfix">Postfix</label>
			<input type="text" class="form-control" name="room_num_postfix" id="room_num_postfix">
			</div>
			<!-- <div class="checkbox">
			<label><input type="checkbox"> Remember me</label>
			</div> -->
			<input type="submit" class="btn btn-default" value="Submit"></input>
		</form>
	</div>
</body>


</html>