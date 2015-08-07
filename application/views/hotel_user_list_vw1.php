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
                        <?php
							//Show Hotel Listing If User is Super Admin
							if($user_type == 'u')
							{
								echo '<select id="sb_hotel_id" name="sb_hotel_id" class="input-large" onchange="recreateTable();">';
								foreach($hotel_list as $key=>$hotel)
								echo "<option value='".$hotel['sb_hotel_id']."'>".$hotel['sb_hotel_name']."</option>";
								echo '</select>';
							}
							//Else Show Hotel Name
							else
							{
								echo "<label>". $sb_hotel_name[0]['sb_hotel_name']."</label>";
								echo "<input type='hidden' id='sb_hotel_id' name='sb_hotel_id' value='".$sb_hotel_id."'/>";
							}
						?>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_hotel_user" href="<?php echo site_url('/admin/user/add_hotel_user');?>"  title="Add Hotel User"><i class="glyphicon glyphicon-plus"></i> Add Hotel Admin</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="table-responsive x_content">
						<table id="hotel-grid"  class="table table-striped responsive-utilities jambo_table" >
							<thead>
								<tr class="headings">
									<th>Hotel User ID</th>
									<th>Hotel Username</th>
									<th>Hotel User Email</th>
									<th>Hotel User Type</th>		
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
                <p>You are about to delete/restore one hotel user.</p>
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
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>

<script type="text/javascript">
function create_hotel_grid()
{
    var columnnames=['sb_hotel_user_id','sb_hotel_username','sb_hotel_useremail','sb_hotel_user_type','sb_hotel_user_type'];
	var hotel_id=$("#sb_hotel_id").val();
	table = $('#hotel-grid').DataTable({ 
		"processing": true, //Feature control the processing indicator.
		"serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,// Load data for the table's content from an Ajax source
		"ajax": {
			"url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'4',tablename:'sb_hotel_users',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames,hotel_id:hotel_id,user_type:'<?php echo $user_type;?>',page_type:'<?php echo $page_type;?>'},
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

var table;
$(document).ready(function () {
		create_hotel_grid();
	});

function recreateTable()
{
	table.destroy();
	create_hotel_grid();
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


