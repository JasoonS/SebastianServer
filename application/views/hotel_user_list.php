<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
            <div class="title_left">
                <h3>Hotel User List</small></h3>
            </div>
            <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>-->
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
                           <!-- <li><a href="#"><i class="fa fa-chevron-up"></i></a></li>                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                
                            </li>
                            <li><a href="#"><i class="fa fa-close"></i></a>
                            </li>-->
                            <a class="btn btn-sm btn-success" id="add_hotel" href="<?php echo site_url('/admin/hotel/add_hotel');?>"  title="Add Hotel"><i class="glyphicon glyphicon-plus"></i> Add Hotel</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
						<table id="hotel-grid"  class="table table-striped table-bordered" >
							<thead>
								<tr>
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
</div>
</div>
<script type="text/javascript">

function create_hotel_grid(){
    var columnnames=['sb_hotel_user_id','sb_hotel_username','sb_hotel_useremail','sb_hotel_user_type','sb_hotel_user_type'];
	var hotel_id=$("#sb_hotel_id").val();
	table = $('#hotel-grid').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'4',tablename:'sb_hotel_users',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames,hotel_id:hotel_id,user_type:'<?php echo $user_type;?>'},
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],
		 "order": [[ 0, "desc" ]]

      });
	
}

var table;

$(document).ready(function () {
		create_hotel_grid();
	});
function deletehotel(id)
{   
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=alert('+id+');>Delete</button>');
    $("#confirm-delete").modal('show');
}
function recreateTable()
{
	table.destroy();
	
	create_hotel_grid();
}

</script>


