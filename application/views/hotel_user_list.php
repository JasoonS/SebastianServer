

	<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
    
	<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
   
	<link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-checktree.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-checktree.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
	<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
	<div class="right_col" role="main">
    <div class="">
	<div class="account-container">	
			<legend>Hotel Users List </legend>
			<div class="container">
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
var table;

$(document).ready(function () {
     var columnnames=['sb_hotel_user_id','sb_hotel_username','sb_hotel_useremail','sb_hotel_user_type','sb_hotel_user_type'];
     table = $('#hotel-grid').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'4',tablename:'sb_hotel_users',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames},
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
	
	
});
function deletehotel(id)
{   
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=alert('+id+');>Delete</button>');
    $("#confirm-delete").modal('show');
}

</script>


