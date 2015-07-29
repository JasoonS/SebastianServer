<script src="<?php echo THEME_ASSETS;  ?>js/bootstrap.min.js"></script>

<!-- chart js -->
<script src="<?php echo THEME_ASSETS;  ?>js/chartjs/chart.min.js"></script>

<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS;  ?>js/progressbar/bootstrap-progressbar.min.js"></script>


<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS;  ?>js/icheck/icheck.min.js"></script>

<script src="<?php echo THEME_ASSETS;  ?>js/custom.js"></script>

<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Invoice<small>Some examples to get you started</small></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daily active users <small>Sessions</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a href="#"><i class="fa fa-chevron-up"></i></a></li>                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a></li>                                    
                                    <li><a href="#">Settings 2</a></li>                                    
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <table id="hotel-grid" class="table table-striped responsive-utilities jambo_table">
                            <thead>                                                      
                                <!--<tr class="headings">
                                    <th><input type="checkbox" class="tableflat">   </th>
                                    <th>Hotel ID</th>
                                    <th>Hotel Name</th>
                                    <th>Hotel Owner</th>
                                    <th>Hotel Email</th>
                                    <th>Hotel Website</th>
                                    <th>Action</th>                       
                                </tr>!-->
                                <tr class="headings">
                                    <th>
                                        <input type="checkbox" class="tableflat">
                                    </th>
                                    <th><input type="checkbox" class="tableflat">   </th>
                                    <th>Hotel ID</th>
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
                                </tr>
                                <tr class="even pointer selected">
                                    <td class="a-center ">
                                        <input type="checkbox" checked class="tableflat">
                                    </td>
                                    <td class=" ">121000038</td>
                                    <td class=" ">May 24, 2014 10:55:33 PM</td>
                                    <td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
                                    </td>
                                    <td class=" ">Mike Smith</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$432.26</td>
                                    <td class=" last"><a href="#">View</a>
                                    </td>
                                </tr>
                                <tr class="odd pointer">
                                    <td class="a-center ">
                                        <input type="checkbox" class="tableflat">
                                    </td>
                                    <td class=" ">121000037</td>
                                    <td class=" ">May 24, 2014 10:52:44 PM</td>
                                    <td class=" ">121000204</td>
                                    <td class=" ">Mike Smith</td>
                                    <td class=" ">Paid</td>
                                    <td class="a-right a-right ">$333.21</td>
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
            <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
            </p>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>


<script>
var table;

/*$(document).ready(function () {
 var columnnames=['sb_hotel_id','sb_hotel_id','sb_hotel_name','sb_hotel_owner','sb_hotel_email','sb_hotel_website','sb_hotel_website'];
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
      "targets": [ -1 ], //last column
      "orderable": false, //set not orderable
    },
    ],
     "order": [[ 1, "desc" ],[2,'desc']]

  });
});*/

$(document).ready(function () {
    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
});

var asInitVals = new Array();
var columnnames=['sb_hotel_id','sb_hotel_id','sb_hotel_name','sb_hotel_owner','sb_hotel_email','sb_hotel_website','sb_hotel_website'];

$(document).ready(function () {
    var table = $('#examples').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
    
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'3',tablename:'sb_hotels',orderkey: ' sb_hotel_id ',orderdir:' desc ',columns:columnnames},
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
</script>


          


