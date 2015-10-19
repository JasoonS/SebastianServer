<!-- Theme specfic js !-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/star-rating.css" rel="stylesheet" type="text/css">	
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>

<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
	
<div class="right_col" role="main">
 <!-- This is for Success Message.-->
		<?php if ($this->session->flashdata('rooms_success')) { ?>
	        <div class="alert alert-success"> <?= $this->session->flashdata('rooms_success') ?> </div>
	    <?php } ?>

		<!-- This is for Generic Error Message.-->
		<?php if ($this->session->flashdata('rooms_error')) { ?>
	    	<div class="alert alert-danger"> <?= $this->session->flashdata('rooms_error') ?> </div>
		<?php } ?>
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
		<?php
			//print_r($guest_feedbacks);	
		?>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <!--<ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_vendor" href="#"  title="Add Restaurants" onclick="addVendor('create');"><i class="glyphicon glyphicon-plus"></i> Add Restaurants</a>
                        </ul>-->
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="table-responsive x_content">
                        <table id="feedback" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Guest First Name</th>
									<th>Guest Last Name</th>
									<th>Special Hotel Person</th>
									<th>Suggestion</th>
                                    <th>Feedback</th> 
                                    <th>Sent On</th>						
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
	 <footer>
		<div class="">
		    <p class="pull-right">Sebastian Admin |
		        <span class="lead"> <i class="fa fa-paw"></i></span>
		    </p>
		</div>
		<div class="clearfix"></div>
	</footer>	
</div>
<script type="text/javascript">
function createTable(){
		$('#feedback').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/Guestprofiles/get_feedback');?>",
            "data":{tablename:'sb_feedback',orderkey: 'feedback_id',orderdir:'desc'},
            "type": "POST",
         
        },
        "order": [[ 1, "desc" ]],

        "aoColumnDefs": [
           
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

    createTable();
    
});
</script>

	
