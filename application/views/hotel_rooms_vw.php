<?php // echo '<pre>'; print_r($rooms_booked);die; ?>


<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>

<script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>

<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>

<script>

function getroombooked()
{
	var room_type_value= $("#room_type").val();
	$("#room_booked_view").empty();
	base_url ="<?php echo BASE_URL.$ajaxurl; ?>";
	$.ajax({		  
	url: base_url+'/get_booked_rooms',
	type:"post",
	data: {'room_type_value':room_type_value},
	dataType:'json',
	success:function(data){
		if(data!=0)
		{
				
			var html = '<table class="table table-striped table-bordered">';
			for (var i = 0, len = data.length; i < len; ++i) {
			    html += '<tr>';
			    for (var j = 0, rowLen = data[i].length; j < rowLen; ++j ) {
			        html += '<td>' + data[i][j].sb_room_number + '</td>';
			    }
			    html += "</tr>";
			}
			html += '</table>';
			$(html).appendTo('#room_booked_view');				
		}
		else		
		{
			
		}
	},
	error: function(){
		alert("failure");						 
	}
	});
}
// });
// });

</script>
<script>
 $("#room_num_prefix").on("keydown",function(e){return e.which !==32;});
 $("#room_num_postfix").on("keydown",function(e){return e.which !==32;});
function formvalidate()
{
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
		alert("From value must be smaller then To value");
		$("#room_num_from").val("");
		return false;		
	}

}
function specifyRoomType()
{
    if($("#room_type").val() == "not specified"){ 
		$("#idNewRoomType").show(200);
	}
	else
	{
		$("#idNewRoomType").hide(200);
	}
}
getroombooked();
</script>
<div class="right_col" role="main">

 <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('rooms_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('rooms_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('rooms_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('rooms_error') ?> </div>
		<?php } ?>


    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
      
				<form role="form" method="post" action="<?php   echo BASE_URL.$action ?>" onsubmit="return formvalidate()" class="" name="create_rooms_form">
					<div class="row">
	    			<div class = "col-md-7 col-xs-7 classFormBox">
	    			<div class="x_panel ">
	    				<div class="x_title">
		                    <h2><b>Create Room</b></h2>	                            
		                    <div class="clearfix"></div>
		                </div>
		                <div class = "x_content">

                		<div class = "form-group classFormInputsBox">
				
							<label for="room_num_from" class="col-xs-3 control-label">Room No.: From:</label>
							<div class="col-xs-4">
							<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_from" id="room_num_from"  onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
							</div>
						<!--</div>
						<div class = "form-group classFormInputsBox">-->
							<label for="room_num_to" class="col-xs-1 control-label">To:</label>
							<div class="col-xs-4">
							<input type="text" class="form-control bfh-number" data-min="1" data-max="50" data-zeros="true" name="room_num_to" id="room_num_to" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>

							</div>
						</div>
						<!-- <br/><br/> -->
						<div class = "form-group classFormInputsBox">
							<label for="room_num_prefix" class="col-xs-4 control-label">Prefix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_prefix" id="room_num_prefix">
							</div>
						</div>
						
						<div class = "form-group classFormInputsBox">
							<label for="room_num_postfix" class="col-xs-4 control-label">Postfix</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="room_num_postfix" id="room_num_postfix">
							</div>
						</div>

						<div class = "form-group classFormInputsBox">
							<label for="room_type" class="col-xs-4 control-label">Room Type</label>
							<div class="col-xs-6">
							<!--<input type="text" class="form-control" name="sb_hotel_room_type" id="room_type">-->
							<input type="button" class="btn btn-primary btn-lg btn-block" value="Check Availability" onclick="getroombooked()"></input>
				
							<select class="form-control" name="sb_hotel_room_type" id="room_type" onchange="specifyRoomType();">
						   	    <?php 
									$i=0;
									while($i<count($room_types))
									{ 
										echo "<option value='".$room_types[$i]['sb_hotel_room_type']."'>".$room_types[$i]['sb_hotel_room_type']."</option>";
										$i++;
									}
								?>
								<option value="not specified">Not Specified</option>
							</select>
													

							
							</div>
						</div>
                        <div id="idNewRoomType" style="display:none;" class = "form-group classFormInputsBox">
							
							<label for="new_room_type" class="col-xs-4 control-label">Specify Room Type</label>
							<div class="col-xs-6">
							<input type="text" class="form-control" name="sb_hotel_new_room_type" id="new_room_type">
							</div>
					    </div>
							<div class = "form-group classFormInputsBox">
							<div class="col-xs-12">
								<input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit"></input>
							</div>
							</div>
						</div>  <!-- x-content -->
					</div>
					</div>
					</div>
				</form>	
	<br/><br/><br/>
	<div id="room_booked_view" class="table-responsive" style="font-siez;width:80%;height:150px;overflow-y:auto;margin:auto;padding:auto;">
		<table class="table table-striped table-bordered">
			<?php 
				for($i=0;$i<count($rooms_booked);$i++)
				{
			?>
				<tr>
					<?php for($j=0;$j<count($rooms_booked[$i]);$j++) {  ?>			
					<td>						
						<?php echo $rooms_booked[$i][$j]['sb_room_number']; ?>
					</td>
					<?php } ?>
				</tr>
			<?php				
				}
			?>
		</table>
	</div>	
	</div>	
</div>



	
