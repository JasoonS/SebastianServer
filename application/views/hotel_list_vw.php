<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel List</small></h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_hotel" href="<?php echo site_url('/admin/hotel/add_hotel');?>"  title="Add Hotel"><i class="glyphicon glyphicon-plus"></i> Add Hotel</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="idHotels" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" class="tableflat" >
                                    </th>
                                    <th>Hotel Name</th>
                                    <th>Hotel Owner</th>
                                    <th>Hotel Email</th>
                                    <th>Hotel Website</th>
                                    <th>Action</th>                       
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($Hotels as $hotel) { $row = 1; ?>

                                <?php if ($row % 2 == 1) { ?>

                                <tr class="even pointer" id="idtr_<?php echo $row ?>_<?php echo $hotel['sb_hotel_id'] ?>">

                                    <td class="a-center" id="idtd_<?php echo $hotel['sb_hotel_id']?>_<?php echo $row ?>"><input type="checkbox" class="tableflat" value="<?php echo $hotel['sb_hotel_id'] ?>"></td>
                                    <td id="idtd_<?php echo $hotel['sb_hotel_name']?>_<?php echo $row ?>"><?php echo $hotel['sb_hotel_name']   ;  ?></td>
                                    <td id="idtd_<?php echo $hotel['sb_hotel_owner']?>_<?php echo $row ?>"><?php echo $hotel['sb_hotel_owner'] ;  ?></td>
                                    <td id="idtd_<?php echo $hotel['sb_hotel_email']?>_<?php echo $row ?>"><?php echo $hotel['sb_hotel_email'] ;  ?></td>
                                    <td id="idtd_<?php echo $hotel['sb_hotel_website']?>_<?php echo $row ?>"><?php echo $hotel['sb_hotel_website']; ?></td>

                                    <td id="idtd_<?php echo $hotel['is_active']?>_<?php echo $row ?>">
                                        <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/hotel/edit_hotel')."/".$hotel['sb_hotel_id']?>" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url('admin/hotel/view_hotel')."/".$hotel['sb_hotel_id']?>" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>
										
									   <?php if($hotel['is_active']=='1'){
										echo '<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="#"  title="Delete" onclick=changehotelstatus('. $hotel['sb_hotel_id'].','.$hotel['is_active'].')><i class="glyphicon glyphicon-trash"></i> Delete</a>';

									}
										 else {
										echo '<a class="btn btn-sm btn-success" id="restore" href="#" data-href="'.base_url('admin/hotel/view_hotel').'"  title="Restore" onClick=changehotelstatus('. $hotel['sb_hotel_id'].','.$hotel['is_active'].'); ><i class="glyphicon glyphicon-save-file"></i> Restore</a>';
										
										}?>	
									</td>
                                </tr>

                                <?php } else { ?>

                                <tr class="odd pointer" id="idtr_<?php echo $row ?>_<?php echo $hotel['sb_hotel_id'] ?>">
                                    <td class="a-center"><input type="checkbox"  class="tableflat"value="<?php echo $hotel['sb_hotel_id'] ?>" class="tableflat"></td>
                                    <td><?php echo $hotel['sb_hotel_name']  ;  ?></td>
                                    <td><?php echo $hotel['sb_hotel_owner'] ;  ?></td>
                                    <td><?php echo $hotel['sb_hotel_email'] ;  ?></td>
                                    <td><?php echo $hotel['sb_hotel_website']; ?></td>
                                    <td>
                                      <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/hotel/edit_hotel')."/".$hotel['sb_hotel_id']?>" title="Edit" ><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                                      <a class="btn btn-sm btn-warning" href="<?php echo base_url('admin/hotel/view_hotel')."/".$hotel['sb_hotel_id']?>" title="View" ><i class="glyphicon glyphicon-search"></i> View</a>
									 	
									  <?php if($hotel['is_active']=='1'){
										echo '<a class="btn btn-sm btn-danger" id="delete" href="#" data-href="#"  title="Delete" onclick=changehotelstatus('. $hotel['sb_hotel_id'].','.$hotel['is_active'].')><i class="glyphicon glyphicon-trash"></i> Delete</a>';
										 }
										 else {
										echo '<a class="btn btn-sm btn-success" id="restore" href="#" data-href="#"  title="Restore" onclick=changehotelstatus('. $hotel['sb_hotel_id'].','.$hotel['is_active'].') ><i class="glyphicon glyphicon-save-file"></i> Restore</a>';
										
										}?>	
									 </td>
                                </tr>

                                <?php } $row++; } ?>             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer content -->
    <footer>
        <div class="">
            <p class="pull-right">Sebastian Admin |
                <span class="lead"> <i class="fa fa-paw"></i></span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
<div class="modal fade" id="confirm-delete" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Change Status</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to change status of one hotel.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
					
				                              
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
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


<script>
var asInitVals  = new Array();
var action_url  = '';
 
$(document).ready(function () {

   /* $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
	alert("fdsfds");
*/
    $('#idHotels').dataTable({
         "order": [[ 1, "desc" ]],
		
         "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0]
            } //disables sorting for column one
        ],
        "sPaginationType": "full_numbers",
        "dom": 'T<"clear">lfrtip',
    });
    $("tfoot input").keyup(function () {
        
        oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
    });
    $("tfoot input").each(function (i) {
        asInitVals[i] = this.value;
    });
    $("tfoot input").focus(function () {
        if (this.className == "search_init") {
            this.className = "";
            this.value = "";
        }
    });
    $("tfoot input").blur(function (i) {
        if (this.value == "") {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    });
});

function changehotelstatus(id,hotelstatus)
{  

    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal" >OK</button>'+
	                        '<button type="button" onclick="makeAlert();" id="changeS" class="btn btn-danger" >Change</button>');
							
   
    $("#confirm-delete").modal('show');
}

function changestatus(id,hotelstatus)
{
    alert(id);
    action_url = '<?php echo site_url('admin/hotel/change_hotel_status')?>';

   /* $.ajax({
        url: action_url,
        type:"post",
        data:{"hotel_id":id,"hotelstatus":hotelstatus},
        dataType:"json",
        success:function(msg)
        {
            console.log(msg);
			alert(id);
    		$('#confirm-delete').modal('hide');
		}
		});*/
}           
</script>


          


