<!-- page content -->
<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
		 <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('category_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('category_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('category_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('category_error') ?> </div>
		<?php } ?>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                                        <div class="profile_img">
                                            <div id="crop-avatar">
                                                <!-- Current avatar -->
                                                <div class="avatar-view" title="Hotel Cover Image" style = "background-image: url('<?php echo $hotel_pic;?>');background-repeat:no-repeat;background-size:cover; ">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <h3><?php echo $guest_general_data[0]->sb_guest_firstName." ".$guest_general_data[0]->sb_guest_lastName?></h3>

                                        <ul class="list-unstyled user_data">
                                            <li>
											 <?php echo " Reservation Code -<b>".$guest_general_data[0]->sb_guest_reservation_code."</b>";?>
                                            </li>
											<li>
											<?php echo " Booking Check In Date -<b>".$guest_general_data[0]->sb_guest_check_in_date."</b>";?>
											</li>
											<li>
											<?php echo " Booking Check Out Date -<b>".$guest_general_data[0]->sb_guest_check_out_date."</b>";?>
											</li>
											<!--<li>
												
												<a href="<?php echo base_url('admin/HotelRooms/details')."/".$guest_general_data[0]->sb_hotel_guest_booking_id; ?>" class="btn btn-success" >Show Details</a>
												<button class="btn btn-danger" onclick="showAllCheckoutModel('<?php echo $guest_general_data[0]->sb_guest_reservation_code;?>');">Checkout All </button>
																			            
											</li>-->
                                        </ul>

                                       
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
										<!--<div class="row">
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											
											<div class="count"><?php echo $guest_general_data[0]->sb_guest_rooms_alloted;?></div>
											<h3>Rooms Booked</h3>
											</div>
										</div>
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											
											<div class="count"><?php echo $checked_in_rooms;?></div>
											<h3>Total Rooms In Use</h3>
											</div>
										</div>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											
											<div class="count"><?php echo $checked_out_rooms;?></div>
											<h3>Total Rooms Not In Use</h3>
											</div>
										</div> 
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											
											<div class="count"><?php echo ($guest_general_data[0]->sb_guest_rooms_alloted - $checked_in_rooms )- $checked_out_rooms;?></div>
											<h3>Rooms To Allocate</h3>
											</div>
										</div>										
                                        </div>-->
										<div class="row">
										    <form  action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
										        <?php
													
													if($roomsToAlloted == 0)
													{
													
								                ?>
												<h1>Rooms For this guest are already alloted.</h1>
												<?php
													}
													else{
														$i=0;
														while($i<$roomsToAlloted){
												?>
												<div class ="row">
												<div id="idRoomNumber_<?php echo $i;?>" class = "form-group classFormInputsBox col-md-5 col-sm-5 ">
													<label for="sb_room_number_<?php echo $i;?>" class="col-xs-3 control-label">Room Number</label>
													<div class="col-xs-6">
														<input type="text" class="form-control" name="sb_room_number_<?php echo $i;?>" id="sb_room_number_<?php echo $i;?>">
													</div>
												</div>
												<div id="idNewRoomType_<?php echo $i;?>" class = "form-group classFormInputsBox col-md-5 col-sm-5 ">
													<label for="sb_hotel_room_type_<?php echo $i;?>" class="col-xs-3 control-label">Room Type</label>
													<div class="col-xs-6">
														<select class="form-control" name="sb_hotel_room_type_<?php echo $i;?>" id="sb_hotel_room_type_<?php echo $i;?>" onchange="hideMessages(<?php echo $i;?>);">
														<?php 
															$cnt=0;
															while($cnt<count($room_types))
															{ 
																echo "<option value='".$room_types[$cnt]['sb_hotel_room_type']."'>".$room_types[$cnt]['sb_hotel_room_type']."</option>";
																$cnt++;
															}
														?>
														
														</select>
														
													</div>
											    </div>
												<div class = "form-group classFormInputsBox col-md-2 col-sm-2">
													<button class="btn btn-primary" type="button" onclick="getAvailability('<?php echo $i;?>')">Get Availability</button>
												</div>
												</div>
												<div class= "row" style="display:none;" id="status_message_<?php echo $i;?>">
													<div class="alert alert-success alert-dismissible fade in" role="alert">
														<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
														</button>
														<strong>2</strong> Rooms Available.<strong><span onclick="alert('here')">Click Here To get Details</span></strong>
													</div>
												</div>
												
												<?php
													$i++;
													}
												}
												?>
											<div class ="row">
												<div class = "form-group classFormInputsBox col-md-3 col-sm-3">
												<input type="hidden" name="reservation_code" id="reservation_code" value="<?php echo $guest_general_data[0]->sb_guest_reservation_code; ?>" />
												<input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_id; ?>" />

												<input type="hidden" name="alloted_rooms" id="alloted_rooms" value="<?php echo $alloted_rooms; ?>" />

												<input type="submit" class="btn btn-primary " value="Allot Rooms" ></input>
												</div>
											</div>		
											</form>	
										</div>
									</div>
									
                </div>
            </div>
        </div>
    </div>
                   
</div>

    <footer>
        <div class="">
            <p class="pull-right">Sebastian Admin |
                <span class="lead"> <i class="fa fa-paw"></i></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
<!--</div>-->
<div class="modal fade" id="confirm-checkin" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Available Rooms</h4>
				<div id="messageDiv" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
				<span id="message"></span>
				</div>
			</div>
        
            <div class="modal-body" id="idModalBody" style="height:300px;overflow-y:scroll">
              
            </div>
            
            <div class="modal-footer" id="idModalFooter">
					
				                              
            </div>
        </div>
    </div>
</div>

<!-- Theme specfic js !-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>	
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<script type = "text/javascript">
function hideMessages(count)
{
	$("#status_message_"+count).hide(20);
}
function getAvailability(count)
{
	var room_type=$("#sb_hotel_room_type_"+count).val();
	var room_number=$("#sb_room_number_"+count).val();
	$("#status_message_"+count).hide();
	var base_url = request_url;
	$.ajax({
		url: base_url,
		type:"post",
		data:{"room_type":room_type,"room_number":room_number,"flag":16},
		dataType:"json",
		async: false,
		success:function(data){
			console.log(data);
			var html ="";
			if(data.length == 0){
				html = '<div class="alert alert-error alert-dismissible fade in" role="alert">'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
											'<span aria-hidden="true">×</span>'+
									'</button>'+
									'<strong>No Rooms Available. Sorry For inconvience. </strong>'+
								'</div>';
						$("#status_message_"+count).html(html);
						$("#status_message_"+count).show();
						$("#sb_room_number_"+count).val("");
			}
			else{	
					if(room_number == "")
					{
						html = '<div class="alert alert-error alert-dismissible fade in" role="alert">'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
											'<span aria-hidden="true">×</span>'+
									'</button>'+
									'<strong>'+data.length+'</strong> Rooms Available. Please Select Room.<strong><span onclick="openRoomSelector('+count+')">Click Here To get Details</span></strong>'+
								'</div>';
						$("#status_message_"+count).html(html);
						$("#status_message_"+count).show();
						
					}
				else{
						var flag =false;
						$.each(data, function(key, value) {
							console.log(value.sb_room_number);
							if(room_number == value.sb_room_number)
							{
								flag = true;
							}
						});
						if(flag == false)
						{
							html = '<div class="alert alert-error alert-dismissible fade in" role="alert">'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
											'<span aria-hidden="true">×</span>'+
									'</button>'+
									'<strong>'+data.length+'</strong> Rooms Available. Room you selected is not present in this type or not available.Please select other room.<strong><span onclick="alert('+count+')">Click Here To get Details</span></strong>'+
								'</div>';
							$("#status_message_"+count).html(html);
							$("#status_message_"+count).show();
							$("#sb_room_number_"+count).val("");
						}
						else{
							html = '<div class="alert alert-success alert-dismissible fade in" role="alert">'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
											'<span aria-hidden="true">×</span>'+
									'</button>'+
									'<strong>'+data.length+'</strong> Rooms Available.Congrats you have select right room.<strong><span onclick="openRoomSelector('+count+')">Click Here To see other availabilities in this type.</span></strong>'+
								'</div>';
							$("#status_message_"+count).html(html);
							$("#status_message_"+count).show();
							
						}	
					}
				}console.log(html);
		},
		error:function(){
				alert("Error");
			}
		});
}
function openRoomSelector(count)
{
	var room_type=$("#sb_hotel_room_type_"+count).val();
	var room_number=$("#sb_room_number_"+count).val();
	$("#messageDiv").hide();
	var base_url = request_url;
	$.ajax({
		url: base_url,
		type:"post",
		data:{"room_type":room_type,"room_number":room_number,"flag":16},
		dataType:"json",
		async: false,
		success:function(data){
			var html ="";
			if(data.length == 0){
				alert("Sorry no rooms of this type available.");
			}
			else{	
					
					
					if(room_number == "")
					{
						html ="<table class='table table-striped table-bordered table-responsive'>";
						html += '<tbody style="overflow-y: scroll;height: 200px;">';
						var rowLen=3;
						var j=0;
						$.each(data, function(key, value) {
									if (j%3==0)
									{
										html +="<tr>";
									}
									var classname="";
									
									html += '<td class="'+classname+'" onclick="selectRoom('+"'"+value.sb_room_number+"',"+count+')">' + value.sb_room_number + '</td>';
									
									if (j%3==2)
									{
										html +="</tr>";
									}
									j++ ;
						});
						html +='</tbody>';
						html += '</table>';	
					}
				else{
						var flag =false;
						
						html ="<table class='table table-striped table-bordered table-responsive'>";
						html += '<tbody style="overflow-y: scroll;height: 200px;">';
						var rowLen=3;
						var j=0;
						$.each(data, function(key, value) {
									if (j%3==0)
									{
										html +="<tr>";
									}
									var classname="";
									if(room_number == value.sb_room_number)
									{
										flag = true;
										classname = "selectedRoom";
									}
									html += '<td class="'+classname+'" onclick="selectRoom('+"'"+value.sb_room_number+"',"+count+')">' + value.sb_room_number + '</td>';
									
									if (j%3==2)
									{
										html +="</tr>";
									}
									j++ ;
						});
						html +='</tbody>';
						html += '</table>';
						if(flag == false)
						{
							$("#sb_room_number_"+count).val("");
						}
						
						
					}
					console.log(html);
					$("#idModalBody").html(html);
					$("#confirm-checkin").modal('show');
				}
				
		},
		error:function(){
				alert("Error");
			}
		});
	
}
function selectRoom(room_number,count)
{
   $("#sb_room_number_"+count).val(room_number);
   $("#message").html("You have selected room number "+room_number);
   $("#messageDiv").show();
   
	//alert(room_number);
}
</script>


          


