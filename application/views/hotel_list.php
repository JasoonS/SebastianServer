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
        <legend>Hotels List </legend>
		<div class="x_content">
			<table id="hotel-grid"  class="table table-striped bulk_action responsive-utilities jambo_table" >
					<thead>
                        <tr>
						    <th aria-label="" style="width: 40px;" colspan="1" rowspan="1" role="columnheader" class="sorting_disabled">
                                <div style="position: relative;" class="icheckbox_flat-green"><input style="position: absolute; opacity: 0;" class="tableflat" type="checkbox"><ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins></div>
                            </th>
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
<!--Confirmation Dialog For Delete Hotel -->
	<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete one hotel.</p>
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
     var columnnames=['sb_hotel_id','sb_hotel_name','sb_hotel_owner','sb_hotel_email','sb_hotel_website','sb_hotel_website'];
     table = $('#hotel-grid').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        // Load data for the table's content from an Ajax source
		
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
			"data":{flag:'3',tablename:'sb_hotels',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames},
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
			{ 
				"targets": [ -1,0 ], //last column
				"orderable": false,		  //set not orderable
				"sortable":false
			},
        ],
		 fnDrawCallback : function( oSettings ) {
							$(this).find('tbody tr').each(function(index) {
							$(this).find('td').first(0).text(index+1);
						});
					},
		 "order": [[ 1, "desc" ]]
		}) 
	});
function deletehotel(id)
{   
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=alert('+id+');>Delete</button>');
    $("#confirm-delete").modal('show');
}

</script>


