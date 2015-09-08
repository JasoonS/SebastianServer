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
						<?php
							if($grid_user_type == 'hotel-staff')
							{
						?>
								 <a class="btn btn-sm btn-success" id="idSendMessage" href="#" onclick="openSendMessagePopup();"  title="Send Message"><i class="glyphicon glyphicon-envelope"></i> Send Message</a>
                        <?php 						
							}
						?>
                            <a class="btn btn-sm btn-success" id="add_hotel_user" href="<?php echo site_url('/admin/user/add_hotel_user');?>"  title="Add Hotel User"><i class="glyphicon glyphicon-plus"></i> Add Hotel User</a>
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
<!--Confirmation Dialog For Delete Hotel -->
<div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Send Message To Staff</h4>
				<div id="successDiv" class="alert alert-success alert-dismissible fade in" role="alert" style="display:none;">
				<span id="success_message"></span>
				</div>
				<div id="errorDiv" class="alert alert-error alert-dismissible fade in" role="alert" style="display:none;">
				<span id="error_message"></span>
				</div>
            </div>
        
            <div class="modal-body">
			    <p> 
                <div class = "row form-group classFormInputsBox" >
					 <label class="col-md-3 col-xs-3 control-label" for="id_staffType">To Staff </label>
						<div class="col-md-9 col-xs-9">
							<select id="id_staffType" name="id_staffType" class="form-control" required="">
								<option value="all">All</option>
								<?php
								if($user_type != 'u'){ 
									$i=0;
									while($i<count($parent_services))
									{
										echo "<option value=".$parent_services[$i]['sb_parent_service_id'].">".$parent_services[$i]['sb_parent_service_name']."</option>";
										$i++;
									}
								}	
								?>
							</select>
						</div>
				</div>
				</p>
				<p>
				<div class = "row form-group classFormInputsBox" >
					<label class="col-md-3 col-xs-3 control-label" for="id_staffMessage">Message</label>	
						<div class="col-md-9 col-xs-9">
							<textarea id="id_staffMessage" name="staff_message" class="form-control"></textarea>		  
							<div id="err_staff_message" class="errorclass" style="display:none"></div>		
						</div>
			    </div>
				</p>
                <p class="debug-url"></p>
            </div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" onclick="sendMessage();">Proceed</button>
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
		setRedirectUrl();
		create_hotel_grid();
	});

function recreateTable()
{
    setRedirectUrl();
	
	table.destroy();
	create_hotel_grid();
}
function changehoteluserstatus(id,status)
{
    $("#confirm-delete .modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger" onclick=changeuserstatus('+id+','+status+');>Proceed</button>');
    $("#confirm-delete").modal('show');
			
}
function changeuserstatus(id,status)
{
	var base_url = ajax_url;
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
function setRedirectUrl()
{
	var base_url = '<?php echo site_url('admin/ajax/get_ajax_data')?>';
	var hotel_id=$("#sb_hotel_id").val();
	$("#add_hotel_user").attr("href",'<?php echo site_url('admin/user/add_hotel_user/')?>'+'/'+hotel_id);
	
}
function openSendMessagePopup()
{
    $("#id_staffMessage").val("");
    $("#err_staff_message").hide();
	$("#successDiv").hide();
	$("#errorDiv").hide();
	$("#send_message").modal('show');
}
function sendMessage()
{
	var staffMessage=$("#id_staffMessage").val();
	var staffType=$("#id_staffType").val();
	if(staffMessage=="")
	{
		$("#err_staff_message").html("Please Provide message to send.");
		$("#err_staff_message").show();
		$("#successDiv").hide();
		$("#errorDiv").hide();
	}
	else{
	    $("#err_staff_message").hide();
		$.ajax({
		url: request_url,
		type:"post",
		data:{"staff_type":staffType,"staff_message":staffMessage,"flag":17},
		dataType:"json",
		success:function(msg){
			console.log(msg);
			if(msg.status==true)
			{
			    $("#success_message").html(msg.message);
				$("#successDiv").show();
			}
			else{
				$("#error_message").html(msg.message);
				$("#errorDiv").show();
			}
		},
		error:function(){
					alert("Error");
			}
		});
		
	}
	
}
</script>


