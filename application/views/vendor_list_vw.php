<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Available Vendors List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_vendor" href="#"  title="Add Vendor" onclick="addVendor('create');"><i class="glyphicon glyphicon-plus"></i> Add Vendor</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="table-responsive x_content">
                        <table id="idVendors" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Vendor Id</th>
                                    <th>Vendor Name</th> 
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

<!-- This Dialog is used to Change Status Of Vendor -->
<div class="modal fade" id="confirm-delete" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Change Status</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to change status of one vendor.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Change</button>	
				                              
            </div>
        </div>
    </div>
</div>
<!-- This Dialog is used to add Or Edit Vendor -->
<div class="modal fade" id="add-edit" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add / Edit Vendor</h4>
            </div>
        
            <div class="modal-body">
				<div class = "form-group classFormInputsBox" style="padding:5%">
			        <label class="col-md-4 col-xs-4 control-label" for="sb_vendorname">Vendor Name :</label>
						<div class="col-md-8 col-xs-8">
							<input id="sb_vendorname" name="sb_vendorname" type="text" class="form-control" value="" >
							<div id="err_vendorname" class="errorclass" style="display:none"></div>
						</div>
			        </div> 
				<p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Change</button>	
				                              
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
		$('#idVendors').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'9',tablename:'tbname',orderkey: ' vendor_id ',orderdir:' desc '},
            "type": "POST",
         
        },
        "order": [[ 1, "desc" ]],

        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0,2]
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

function changevendorstatus(id,vendorstatus)
{   
    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="idChangeHotelStats" onclick="changestatus('+id+','+vendorstatus+');">Change</button>');
    $("#confirm-delete").modal('show');
}

function addVendor(action)
{   
    $("#myModalLabel").html("Create Vendor");
	$("#sb_vendorname").val('');
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="addVendor" onclick="add();">Add Vendor</button>');
    $("#add-edit").modal('show');
}
function edit(vendor_id,vendor_name)
{   
    $("#myModalLabel").html("Create Vendor");
	$("#sb_vendorname").val(vendor_name);
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="editVendor" onclick="editVendor('+vendor_id+',\''+vendor_name+'\');">Edit Vendor</button>');
    $("#add-edit").modal('show');
}

function changestatus(id,vendorstatus)
{
    $.ajax({
        url: ajax_url,
        type:"post",
        data:{flag:"14","vendor_id":id,"vendorstatus":vendorstatus},
        dataType:"json",
        success:function(msg)
        {
            $('#confirm-delete').modal('hide');
			createTable();
        }
    });
}

function editVendor(vendor_id,vendor_name)
{
	var vendorname=$("#sb_vendorname").val();
	if(vendorname == "")
	{
		$("#err_vendorname").html("Vendor Name is compulsory.");
		$("#err_vendorname").show();
	}
	else{
		$.ajax({
			url: ajax_url,
			type:"post",
			data:{flag:'12',vendorname:vendorname,vendor_id:vendor_id},
			dataType:"json",
			success:function(msg)
			{
				if(msg[0].vendorcount == 1){
					$("#err_vendorname").html("Vendor is already present.");
					$("#err_vendorname").show();
				}
				else{
					$("#err_vendorname").hide();
					$.ajax({
						url: ajax_url,
						type:"post",
						data:{flag:'13',vendorname:vendorname,vendor_id:vendor_id},
						dataType:"json",
						success:function(msg)
						{
							$("#add-edit").modal('hide');
							createTable();
						}
					});
				}
			}
		});
	}
} 

function add()
{
	var vendorname=$("#sb_vendorname").val();
	if(vendorname == "")
	{
		$("#err_vendorname").html("Vendor Name is compulsory.");
		$("#err_vendorname").show();
	}
	else{
		
		$.ajax({
			url: ajax_url,
			type:"post",
			data:{flag:'13',vendorname:vendorname},
			dataType:"json",
			success:function(msg)
			{
				if(msg[0].vendorcount == 1){
					$("#err_vendorname").html("Vendor is already present.");
					$("#err_vendorname").show();
				}
				else{
					$("#err_vendorname").hide();
					$.ajax({
						url: ajax_url,
						type:"post",
						data:{flag:'11',vendorname:vendorname},
						dataType:"json",
						success:function(msg)
						{
							$("#add-edit").modal('hide');
							createTable();
						}
					});
				}
			}
		});
	}
}          
</script>


          


