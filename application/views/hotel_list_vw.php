<link href="<?php echo THEME_ASSETS; ?>font-awesome/css/font-awesome.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/style.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">
    <link href="<?php echo THEME_ASSETS; ?>css/bootstrap-toggle.css" rel="stylesheet" type="text/css">
    <link href="<?php echo THEME_ASSETS; ?>css/fileinput.css" rel="stylesheet" type="text/css">
    <link href="<?php echo THEME_ASSETS; ?>css/jquery-checktree.css" rel="stylesheet" type="text/css">
    <link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">
	<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">

<script src="<?php echo THEME_ASSETS ?>js/jquery.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-toggle.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-timepicker.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/fileinput.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-checktree.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel List</small></h3>
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
                        <h2></h2>
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
                        <table id="hotel-grid" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                             
                                <tr class="disableSorting">
                                    <th aria-label=" " style="width: 40px;" colspan="1" rowspan="1" role="columnheader" class="sorting_disabled disableSorting">
                                        <div style="position: relative;" class="icheckbox_flat-green"><input style="position: absolute; opacity: 0;" class="tableflat" type="checkbox"><ins style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;" class="iCheck-helper"></ins></div>
                                    </th>
                                    <th class='disableSorting'>Hotel Name</th>
                                    <th class='disableSorting'>Hotel Owner</th>
                                    <th class='disableSorting'>Hotel Email</th>
                                    <th class='disableSorting'>Hotel Website</th>
                                    <th class='disableSorting'>Action</th>                       
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

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
</div>
</div>


<script>
    var table;

    $(document).ready(function () {
    
     table = $('#hotel-grid').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'3',tablename:'tbname',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:''},
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1,4], //last column
          "orderable": false, //set not orderable
        },
        ],
         "order": [[ 0, "desc" ]]

      });
    }); 
	$('#hotel-grid tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
		var chkbox =$(this).find('.icheckbox_flat-green');
        chkbox.toggleClass('checked');
    } );
	function changehotelstatus(id,hotelstatus)
	{   
		$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=changestatus('+id+','+hotelstatus+');>Delete</button>');
		$("#confirm-delete").modal('show');
	}
	function changestatus(id,hotelstatus)
	{
		
		var base_url = '<?php echo site_url('admin/hotel/change_hotel_status')?>';
		$.ajax({
			url: base_url,
			type:"post",
			data:{"hotel_id":id,"hotelstatus":hotelstatus},
			dataType:"json",
			success:function(msg){
					    console.log(msg);
					},
			error:function(){
				alert(base_url);
			}
		}).done(function (){
		
		});
	}


		
	
</script>


          


