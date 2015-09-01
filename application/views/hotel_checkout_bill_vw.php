 <?php
 
 ?>
 <div class="right_col" role="main">

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                         
                        </div>   
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Invoice </h2>
                                  
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <section class="content invoice">
                                        <!-- title row -->
                                        <div class="row">
                                            <div class="col-xs-12 invoice-header">
                                                <h1>
                                        <i class="fa fa-globe"></i> Invoice.
                                        <small class="pull-right">Date: <?php echo date("d/m/Y");?></small>
                                    </h1>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- info row -->
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                From
                                                <address>
													<strong><?php echo $hotel_data['sb_hotel_name'];?></strong>
													<br><?php echo $hotel_data['sb_hotel_address'];?>
													<br><?php echo $hotel_data['state_name']." , ".$hotel_data['city_name'];?>, <?php echo $hotel_data['sb_hotel_zipcode'];?>
													<br>Phone: <?php echo $hotel_data['sb_hotel_phone'];?>
													<br>Email: <?php echo $hotel_data['sb_hotel_email'];?>
												</address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
											
                                                To
                                                <address>
													<strong><?php echo $guest_general_data[0]->sb_guest_firstName." ".$guest_general_data[0]->sb_guest_lastName ;?></strong>
													<!--<br>795 Freedom Ave, Suite 600
													<br>New York, CA 94107-->
													<br>Phone: <?php echo $guest_general_data[0]->sb_guest_contact_no;?>
													<br>Email: <?php echo $guest_general_data[0]->sb_guest_email;?>
												</address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <b>Reservation Code <?php echo $guest_general_data[0]->sb_guest_reservation_code;?></b>
                                                <br>
                                                <br>
                                                <b>Booking Creation Date:</b> <?php echo date("d/m/Y",strtotime($guest_general_data[0]->sb_guest_created_on));?>
                                                <!--<br>
                                                <b>Payment Due:</b> 2/22/2014
                                                <br>
                                                <b>Account:</b> 968-34567-->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- Table row -->
                                        <div class="row">
										    <?php //echo "<pre>";print_r($guest_data);?>
                                            <div class="col-xs-12 table">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Qty</th>
                                                            <th>Product</th>
                                                            <th>Room No.</th>
                                                            <th>Order Creation Date</th>
															<th>Order Due Date</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
															$i=0;
															$total_amount = 0;
															while($i<count($guest_data))
															{
															    $inner_counter = 0;
																while($inner_counter<count($guest_data[$i]->customer_orders))
																{
																	echo "<tr>";
																	echo "<td>".$guest_data[$i]->customer_orders[$inner_counter]->quantity."</td>";
																	echo "<td>".$guest_data[$i]->customer_orders[$inner_counter]->service_name."</td>";
																	echo "<td>".$guest_data[$i]->customer_orders[$inner_counter]->sb_guest_allocated_room_no."</td>";
																	echo "<td>".date('d/m/Y',strtotime($guest_data[$i]->customer_orders[$inner_counter]->created_on))."</td>";
																	echo "<td>".date('d/m/Y h:i:s',strtotime($guest_data[$i]->customer_orders[$inner_counter]->sb_customer_order_duedate.$guest_data[$i]->customer_orders[$inner_counter]->sb_customer_order_duetime ))."</td>";		
																	echo "<td>".$guest_data[$i]->customer_orders[$inner_counter]->quantity*$guest_data[$i]->customer_orders[$inner_counter]->price."</td>";
																	echo "</tr>";
																	$total_amount = $total_amount + ($guest_data[$i]->customer_orders[$inner_counter]->quantity*$guest_data[$i]->customer_orders[$inner_counter]->price);
																	$inner_counter++;
																}
																$i++;
															}
														?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <div class="row">
                                            <!-- accepted payments column -->
                                            <div class="col-xs-6">
                                                
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-xs-6">
                                                <p class="lead">Amount Till <?php echo date('d/m/Y');?></p>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th style="width:50%">Total:</th>
                                                                <td>$<?php echo $total_amount;?></td>
                                                            </tr>
                                                            <!--<tr>
                                                                <th>Tax (9.3%)</th>
                                                                <td>$10.34</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Shipping:</th>
                                                                <td>$5.80</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total:</th>
                                                                <td>$265.24</td>
                                                            </tr>-->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <!-- this row will not appear when printing -->
                                        <div class="row no-print">
                                            <div class="col-xs-12">
                                                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                                               <!-- <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                                                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>-->
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right"> |
                            <span class="lead"> <i class="fa fa-paw"></i> Sebastian Admin</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

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


          


