<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Checkout Options</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
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
												
												<a href="<?php echo base_url('admin/HotelRooms/details')."/".$guest_general_data[0]->sb_hotel_guest_booking_id; ?>" class="btn btn-success" >Show Details</a>
												<button class="btn btn-danger" onclick="showAllCheckoutModel('<?php echo $guest_general_data[0]->sb_guest_reservation_code;?>');">Checkout All </button>
																			            
											</li>
                                        </ul>

                                       
                                    </div>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
										<div class="row">
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											<!--<div class="icon">
											<i class="fa fa-caret-square-o-right"></i>
											</div>-->
											<div class="count"><?php echo $guest_general_data[0]->sb_guest_rooms_alloted;?></div>
											<h3>Rooms Booked</h3>
											</div>
										</div>
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											<!--<div class="icon">
											<i class="fa fa-caret-square-o-right"></i>
											</div>-->
											<div class="count"><?php echo $checked_in_rooms;?></div>
											<h3>Total Rooms In Use</h3>
											</div>
										</div>
                                        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											<!--<div class="icon">
											<i class="fa fa-caret-square-o-right"></i>
											</div>-->
											<div class="count"><?php echo $checked_out_rooms;?></div>
											<h3>Total Rooms Not In Use</h3>
											</div>
										</div> 
										<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<div class="tile-stats">
											<!--<div class="icon">
											<i class="fa fa-caret-square-o-right"></i>
											</div>-->
											<div class="count"><?php echo ($guest_general_data[0]->sb_guest_rooms_alloted - $checked_in_rooms )- $checked_out_rooms;?></div>
											<h3>Rooms To Allocate</h3>
											</div>
										</div>										
                                        </div>
										<div class="row">
										<table class="table table-striped responsive-utilities ">
                                        <thead>
                                            <tr class="headings">    
                                                <th class="column-title">Room No </th>
                                                <th class="column-title">Actual Check In </th>
                                                <th class="column-title">Actual Check Out </th>
                                                <th class="column-title">Bill to Name </th>
                                                <th class="column-title">Total Orders</th>
												<th class="column-title">Total Amount</th>
                                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                            </th>
										</tr>
									</thead>
								<tbody>
							   <?php
							    $i=0;
								while($i<count($guest_data)){
							   ?>
                                <tr >
                                    <td class=" "><?php echo $guest_data[$i]->sb_guest_allocated_room_no;?></td>
                                    <td class=" "><?php echo $guest_data[$i]->sb_guest_actual_check_in;?></td>
									<?php if($guest_data[$i]->sb_guest_actual_check_out== "0000-00-00 00:00:00"){?>
									 <td class=" ">-</td>
									<?php }else{?>
									 <td class=" "><?php echo $guest_data[$i]->sb_guest_actual_check_out;?></td>
									<?php }?>
     									
                             
                                    <td class=" "><?php echo $guest_data[$i]->sb_guest_firstName." ".$guest_data[$i]->sb_guest_lastName;?></td>
                                    <td class="a-right a-right "><?php echo count ($guest_data[$i]->customer_orders);?></td>
                                    <td class="a-right a-right "><?php echo $guest_data[$i]->total_amount;?></td>
                                    <td class=" last"><a href="<?php echo base_url('admin/HotelRooms/detail')."/".$guest_general_data[0]->sb_hotel_guest_booking_id."/".$guest_data[$i]->sb_guest_allocated_room_no; ?>"><img src="<?php echo FOLDER_ICONS_URL ?>View-Details.png" /></a><?php echo "  ";?>
									    <?php if($guest_data[$i]->sb_guest_actual_check_out== "0000-00-00 00:00:00"){?>
									    <a href="#" onclick="showCheckoutModel('<?php echo $guest_data[$i]->sb_guest_allocated_room_no;?>','<?php echo $guest_data[$i]->sb_guest_reservation_code;?>');"><img src="<?php echo FOLDER_ICONS_URL ?>active.png" /></a>   
                                        <?php } else {?>
										 <a href="#"><img src="<?php echo FOLDER_ICONS_URL ?>Inactive.png" /></a> 
										<?php }?>
                                    </td>
                                            </tr>
                                           
											<?php $i++;}?>
								    </tbody>
								</table>
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
<div class="modal fade" id="confirm-checkout" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Checkout</h4>
            </div>
        
            <div class="modal-body" id="idModalBody">
              
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
function showCheckoutModel(room_no,reservation_code)
{
	$("#idModalBody").html( '<p>You are about to checkout from room no.'+ room_no +'</p>'+
											'<p>Do you want to proceed?</p><p class="debug-url"></p>');
											
	$("#idModalFooter").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'+
				'<button type="button" class="btn btn-danger" onclick=checkoutRoom(\"'+room_no+'\",\"'+reservation_code+'");>Proceed</button>');			
	$("#confirm-checkout").modal('show');
}
function showAllCheckoutModel(reservation_code)
{
	$("#idModalBody").html( '<p>You are about to checkout from all rooms that are currently alloted to guest with code <b>'+reservation_code+'</b></p>'+
											'<p>Do you want to proceed?</p><p class="debug-url"></p>');
	$("#idModalFooter").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'+
				'<button type="button" class="btn btn-danger" onclick=checkoutAllRooms(\"'+reservation_code+'\");>Proceed</button>');			

	$("#confirm-checkout").modal('show');
}
function checkoutAllRooms(reservation_code)
{
	$.ajax({
					url: request_url,
					type:"post",
					data:{"reservation_code":reservation_code,flag:"15"},
					dataType:"json",
					success:function(msg){
								var data = msg;
								console.log(data);
							},
					error:function(msg){
						alert("failure");
					}
				}).done(function(){
					window.location.reload(true);
				});
}
function checkoutRoom(room_no,reservation_code)
{
	
	$.ajax({
					url: request_url,
					type:"post",
					data:{"room_no":room_no,"reservation_code":reservation_code,flag:"14"},
					dataType:"json",
					success:function(msg){
								var data = msg;
								console.log(data);
							},
					error:function(msg){
						alert("failure");
					}
				}).done(function(){
					window.location.reload(true);
				});
}
</script>


          


