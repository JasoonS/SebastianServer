<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
    	</div>
        <div class="clearfix"></div>
        <div class="row">
        	<div class="x_content">
        		<table id="example" class="table table-striped responsive-utilities jambo_table">
			        <thead>
			            <tr>
			                <th>Last Name</th>
			                <th>First Name</th>
			                <th>Email Id</th>
			                <th>Phone No</th>
			                <th>Action</th>
			                <!--<th>Salary</th>!-->
			            </tr>
			        </thead>
                    
                    <tfoot>
			            <tr>
			                <th>Last Name</th>
			                <th>First Name</th>
			                <th>Email Id</th>
			                <th>Phone No</th>
			                <th>Action</th>
			                <!--<th>Salary</th>!-->
			            </tr>
        			</tfoot>

                    <tbody>
                        <tr>
			                <td>Tiger Nixon</td>
			                <td>System Architect</td>
			                <td>Edinburgh</td>
			                <td>61</td>
			                <td>2011/04/25</td>
			               
            			</tr>
			            <tr>
			                <td>Garrett Winters</td>
			                <td>Accountant</td>
			                <td>Tokyo</td>
			                <td>63</td>
			                <td>2011/07/25</td>
			                
			            </tr>
			            <tr>
			                <td>Ashton Cox</td>
			                <td>Junior Technical Author</td>
			                <td>San Francisco</td>
			                <td>66</td>
			                <td>2009/01/12</td>  
			            </tr>                        
                    </tbody>
                </table>
        	</div>
        </div>
        <div class = "row">
        	<div class = "col-md-2 classBtn">
        		<button class="btn btn-info btn-sm" id="idAddNewGuest" type="button">Add new guest</button>
        	</div>
        	<div class = "col-md-2 classBtn">
        		<button class="btn btn-info btn-sm" id="idAddNewTask" type="button">Create new task</button>
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
$(document).ready(function () {

    $('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

	
	// Setup - add a text input to each footer cell
    $('#example thead th').each( function () {
        var title = $('#example tfoot th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

  
 
    // DataTable
    var table = $('#example').DataTable({
    	"ordering": false,
		"sPaginationType": "full_numbers",
		"dom": 'T<"clear">lfrtip',
		initComplete: function ()
		{
		  var r = $('#example tfoot tr');
		  r.find('th').each(function(){
		    $(this).css('padding', 8);
		  });
		  $('#example thead').append(r);
		  $('#search_0').css('text-align', 'center');
		}
    });
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );
});
</script>