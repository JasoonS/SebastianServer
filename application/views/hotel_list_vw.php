<!--<link href="<?php echo THEME_ASSETS; ?>css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/jquery.dataTables.css" rel="stylesheet" type="text/css">


<script src="<?php echo THEME_ASSETS ?>js/bootstrap.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<script src="<?php echo THEME_ASSETS?>js/datatables/tools/js/dataTables.tableTools.js"></script>
 
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>

<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>!-->



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
                        <table id="example" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" class="tableflat">
                                    </th>
                                    <th>Hotel Name</th>
                                    <th>Hotel Owner</th>
                                    <th>Hotel Email</th>
                                    <th>Hotel Website</th>
                                    <th>Action</th>                       
                                </tr>
                            </thead>
                            <tbody>
                                 <!--<tr class="even pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="tableflat">
                                    </td>
                                    <td class=" ">121000040</td>
                                    <td class=" ">May 23, 2014 11:47:56 PM </td>
                                    <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i>
                                    </td>
                                    <td class=" ">John Blank L</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$7.45</td>
                                    <td class=" last"><a href="#">View</a>
                                    </td>
                                </tr>
                                <tr class="odd pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="tableflat">
                                    </td>
                                    <td class=" ">121000039</td>
                                    <td class=" ">May 23, 2014 11:30:12 PM</td>
                                    <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                                    </td>
                                    <td class=" ">John Blank L</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$741.20</td>
                                    <td class=" last"><a href="#">View</a>
                                    </td>
                                </tr>!-->
                              
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
<!--<script src="<?php echo THEME_ASSETS ?>js/datatables/tools/js/dataTables.tableTools.js"></script>!-->


<script>
    //var table;

    var asInitVals = new Array();

    var oTable;
    $(document).ready(function () {
         oTable = $('#example').dataTable({

            "order": [[ 1, "desc" ]],
            
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "bDestroy": true,
            "ajax": {
                "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
                "data":{flag:'3',tablename:'tbname',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:''},
                "type": "POST"
            },

            /*"createdRow": function ( row, data, index ) {
                $('td', row).eq(0).iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                })
            },*/

            "createdRow": function ( row, data, index ) {
                 $('td', row).eq(3).addClass('highlight');
            },

            "oLanguage": {
                "sSearch": "Search all columns:"
            },
            "aoColumnDefs": [
                {
                    'bSortable': false,
                    'aTargets': [0]
                } //disables sorting for column one
            ],
            'iDisplayLength': 12,
            "sPaginationType": "full_numbers",
            "dom": 'T<"clear">lfrtip',

        });

        $("tfoot input").keyup(function () {
            /* Filter on the column based on the index of this element's parent <th> */
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
		$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger" onclick=changestatus('+id+','+hotelstatus+');>Change</button>');
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
				$('#confirm-delete').modal('hide');
				
				oTable = $('#example').dataTable({

											"processing": true, //Feature control the processing indicator.
											"serverSide": true, //Feature control DataTables' server-side processing mode.
										    "bDestroy": true, 
											// Load data for the table's content from an Ajax source
											"ajax": {
												"url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
												"data":{flag:'3',tablename:'tbname',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:''},
												"type": "POST"
											},

											"oLanguage": {
												"sSearch": "Search all columns:"
											},
											"aoColumnDefs": [
												{
													'bSortable': false,
													'aTargets': [0]
												} //disables sorting for column one
											],
											'iDisplayLength': 12,
											"sPaginationType": "full_numbers",
											"dom": 'T<"clear">lfrtip',
									});
      
								}
							});
	}
							
</script>


          


