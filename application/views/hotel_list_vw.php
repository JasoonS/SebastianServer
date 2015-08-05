<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel List</h3>
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
                    
                    <div class="table-responsive x_content">
                        <table id="idHotels" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Hotel Name</th>
                                    <th>Hotel Owner</th>
                                    <th>Hotel Email</th>
                                    <th>Hotel Website</th>
                                    <th>Action</th>                       
                                </tr>
                            </thead>

                            <tbody>
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
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				<button type="button" class="btn btn-danger" id="idChangeHotelStats">Change</button>	
				                              
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


<script>
var asInitVals  = new Array();
var action_url  = '';
function createTable(){
		$('#idHotels').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'3',tablename:'tbname',orderkey: ' sb_hotel_id ',orderdir:' desc '},
            "type": "POST",
         
        },
        "order": [[ 1, "desc" ]],

        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0,4]
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


}
$(document).ready(function () {


    /*$('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });*/
    createTable();
    
});

function changehotelstatus(id,hotelstatus)
{   
    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="idChangeHotelStats" onclick="changestatus('+id+','+hotelstatus+');">Change</button>');
    $("#confirm-delete").modal('show');
}


function changestatus(id,hotelstatus)
{
    
    action_url = '<?php echo site_url('admin/hotel/change_hotel_status')?>';

    $.ajax({
        url: action_url,
        type:"post",
        data:{"hotel_id":id,"hotelstatus":hotelstatus},
        dataType:"json",
        success:function(msg)
        {
            $('#confirm-delete').modal('hide');
			createTable();
        }
    });
}           
</script>


          


