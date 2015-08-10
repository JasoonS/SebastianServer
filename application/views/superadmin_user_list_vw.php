<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
    	</div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_hotel_user" href="<?php echo site_url('/admin/user/add_hotel_user/0');?>"  title="Add Hotel User"><i class="glyphicon glyphicon-plus"></i> Add Administrator</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive x_content">
						<table id="user-grid"  class="table table-striped responsive-utilities jambo_table" >
							<thead>
								<tr class="headings">
									<th>User ID</th>
									<th>Username</th>
									<th>User Email</th>
									<th>User Type</th>		
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
</div>
<!--Confirmation Dialog For Delete Hotel -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to delete/restore one super administrator.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<!-- Theme specfic js !-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>	
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>

<script type="text/javascript">
var table;
var columnnames="";
function create_admin_grid()
{
	table = $('#user-grid').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'4',tablename:'sb_hotel_users',orderkey:'sb_hotel_id',orderdir:' desc ',columns:columnnames,hotel_id:0,user_type:'<?php echo $user_type;?>',page_type:'<?php echo $page_type;?>'},
			"type": "POST"
		},
		//Set column definition initialisation properties.
		"columnDefs": [
			{ 
				"targets": [ -1 ], //last column
				"orderable": false, //set not orderable
			},
		],
		"order": [[ 0, "desc" ]],
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
		create_admin_grid();
	});

function recreateTable()
{
	table.destroy();
	create_admin_grid();
}
function changehoteluserstatus(id,status)
{
    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=changeuserstatus('+id+','+status+');>Change</button>');
    $("#confirm-delete").modal('show');
			
}
function changeuserstatus(id,status)
{
	var base_url = '<?php echo site_url('admin/ajax/get_ajax_data')?>';
	$.ajax({
		url: base_url,
		type:"post",
		data:{"hotel_user_id":id,"sb_hotel_user_status":status,"flag":5},
		dataType:"json",
		success:function(msg){
			$('#confirm-delete').modal('hide');
			recreateTable();
		},
		error:function(){
					alert("Error");
			}
		});
}
</script>


