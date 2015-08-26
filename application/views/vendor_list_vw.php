<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Available Vendors List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_vendor" href="#"  title="Add Vendor" onclick="addVendor('create');"><i class="glyphicon glyphicon-plus"></i> Add Vendor</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="table-responsive x_content">
                        <table id="idVendors" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Vendor Id</th>
                                    <th>Vendor Name</th> 
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
    <!-- /footer content -->
</div>

<!-- This Dialog is used to Change Status Of Vendor -->
<div class="modal fade" id="confirm-delete" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Change Status</h4>
            </div>
        
            <div class="modal-body">
                <p>You are about to change status of one vendor.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Change</button>	
				                              
            </div>
        </div>
    </div>
</div>
<!-- This Dialog is used to add Or Edit Vendor -->
<div class="modal fade" id="add-edit" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add / Edit Vendor</h4>
            </div>
        
            <div class="modal-body" style ="padding-bottom:80%">
			    
				<div class = "form-group classFormInputsBox" class="applypadding2">
			        <label class="col-md-4 col-xs-4 control-label" for="sb_vendorname">Vendor Name :</label>
						<div class="col-md-8 col-xs-8">
							<input id="sb_vendorname" name="sb_vendorname" type="text" class="form-control" value="" >
							<div id="err_vendorname" class="errorclass" style="display:none"></div>
						</div>
			    </div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					 <label class="col-md-4 col-xs-4 control-label" for="id_sbVendorCountry">Country :</label>
						<div class="col-md-8 col-xs-8">
							<select id="id_sbVendorCountry" name="sb_vendorcountry" class="form-control" required="" onchange="loadStates('id_sbVendorCountry','id_sbVendorState','1','id_sbVendorCity','0','0','0')">
							<?php
								foreach($countrylist as $key=>$country)
									{
										echo "<option value='".$country['country_id']."'>".$country['country_name']."</option>";
									}
							?>
							</select>
						</div>
				</div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					 <label class="col-md-4 col-xs-4 control-label" for="id_sbVendorState">State :</label>
						<div class="col-md-8 col-xs-8">
							<select id="id_sbVendorState" name="sb_vendor_state" class="form-control" required="" onchange="loadCities('id_sbVendorState','id_sbVendorCity','0','0')">
							</select>
						</div>
				</div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					 <label class="col-md-4 col-xs-4 control-label" for="id_sbVendorCity">City :</label>
						<div class="col-md-8 col-xs-8">
							<select id="id_sbVendorCity" name="sb_vendor_city" class="form-control" required="">
							</select>
						</div>
				</div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					<label class="col-md-4 col-xs-4 control-label" for="id_vendorAddress">Address :</label>	
						<div class="col-md-8 col-xs-8">
							<textarea id="id_vendorAddress" name="vendor_address" class="form-control"></textarea>		  
							<div id="err_vendoraddress" class="errorclass" style="display:none"></div>		
						</div>
			    </div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					<label class="col-md-4 col-xs-4 control-label" for="id_vendorAddress">Vendor Stars :</label>
						<div class="col-md-8 col-xs-8">
							<input id="id_sbVendorStar" name="sb_vendor_star" value="0" type="number" class="rating" data-stars=7 min=0 max=7 step=1 data-size="xs" data-glyphicon="false"/>
						</div>
				</div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					<label class="col-md-4 col-xs-4 control-label" for="id_vendorPhone1">Phone :</label>	
						<div class="col-md-8 col-xs-8">
							<input id="id_vendorPhone1" name="sb_vendorPhone1" type="text" class="form-control" value="" maxlength="10">
							<div id="err_vendorPhone1" class="errorclass" style="display:none"></div>
						</div>
			    </div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
					<label class="col-md-4 col-xs-4 control-label" for="id_vendorPhone2">(Alt) Phone :</label>	
						<div class="col-md-8 col-xs-8">
							<input id="id_vendorPhone2" name="sb_vendorPhone2" type="text" class="form-control" value="" maxlength="10">
							<div id="err_vendorPhone2" class="errorclass" style="display:none"></div>
						</div>
			    </div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
			        <label class="col-md-4 col-xs-4 control-label" for="sb_web1">Vendor Website1 :</label>
						<div class="col-md-8 col-xs-8">
							<input id="sb_web1" name="sb_web1" type="text" class="form-control" value="" >
							<div id="err_sb_web1" class="errorclass" style="display:none"></div>
						</div>
			    </div>
				<div class = "form-group classFormInputsBox" class="applypadding2">
			        <label class="col-md-4 col-xs-4 control-label" for="sb_web2">Vendor Website2 :</label>
						<div class="col-md-8 col-xs-8">
							<input id="sb_web2" name="sb_web2" type="text" class="form-control" value="" >
							<div id="err_sb_web2" class="errorclass" style="display:none"></div>
						</div>
			    </div>
				<p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Change</button>	
				                              
            </div>
        </div>
    </div>
</div>

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
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">

<script>
var asInitVals  = new Array();
var action_url  = '';
 $("#id_vendorPhone1").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
		}
    });
 $("#id_vendorPhone2").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
               return false;
		}
    });
function isUrl(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
    return regexp.test(s);
}

function createTable(){
		$('#idVendors').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/ajax/get_ajax_data');?>",
            "data":{flag:'9',tablename:'tbname',orderkey: ' vendor_id ',orderdir:' desc '},
            "type": "POST",
         
        },
        "order": [[ 1, "desc" ]],

        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0,2]
            } //disables sorting for column one
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


    /*$('input.tableflat').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });*/
    createTable();
    
});

function changevendorstatus(id,vendorstatus)
{   
    $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="idChangeHotelStats" onclick="changestatus('+id+','+vendorstatus+');">Change</button>');
    $("#confirm-delete").modal('show');
}

function addVendor(action)
{   
    $("#myModalLabel").html("Create Vendor");
	$("#sb_vendorname").val('');
	loadStates('id_sbVendorCountry','id_sbVendorState','1','id_sbVendorCity','0','0','0'); 
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="addVendor" onclick="add();">Add Vendor</button>');
    $("#add-edit").modal('show');
}
function edit(vendor_id,vendor_name,country,state,city,address,star,phone1,phone2,web1,web2)
{ 
	  
    $("#myModalLabel").html("Edit Vendor");
	$("#sb_vendorname").val(vendor_name);
	$("#id_sbVendorCountry").val(country);
	loadStates('id_sbVendorCountry','id_sbVendorState','1','id_sbVendorCity','1',state,city);
	$("#id_vendorAddress").html(address);	
	console.log(star);
	  $("#id_sbVendorStar").rating('destroy');
	$("#id_sbVendorStar").val(star);
	 $("#id_sbVendorStar").rating('create');
	$("#id_vendorPhone1").val(phone1);
	$("#id_vendorPhone2").val(phone2);
	$("#sb_web1").val(web1);
	$("#sb_web2").val(web2);
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="editVendor" onclick="editVendor('+vendor_id+',\''+vendor_name+'\');">Edit Vendor</button>');
    $("#add-edit").modal('show');
}

function changestatus(id,vendorstatus)
{
    $.ajax({
        url: ajax_url,
        type:"post",
        data:{flag:"14","vendor_id":id,"vendorstatus":vendorstatus},
        dataType:"json",
        success:function(msg)
        {
            $('#confirm-delete').modal('hide');
			createTable();
        }
    });
}

function editVendor(vendor_id,vendor_name)
{
	var vendorname=$("#sb_vendorname").val();
	var vendoraddress=$("#id_vendorAddress").val();
	var vendorphone1=$("#id_vendorPhone1").val();
	var vendorphone2=$("#id_vendorPhone2").val();
	var web1=$("#sb_web1").val();
	var web2=$("#sb_web2").val();
	var vendorstar=$("#id_sbVendorStar").val();
	var country =$("#id_sbVendorCountry").val();
	var state =$("#id_sbVendorState").val();
	var city =$("#id_sbVendorCity").val();
	isweburl1=true;
	isweburl2=true;
	if(web1 !=""){
		isweburl1=isUrl(web1);
	}
	if(web2 !=""){
		isweburl2=isUrl(web2);
	}
	if((vendorname == "")||(vendoraddress == "")||(vendorphone1 == "" )||(isweburl1 !=true) ||(isweburl2 !=true))
	{
		if(vendorname == ""){
			$("#err_vendorname").html("Vendor Name is compulsory.");
			$("#err_vendorname").show();
		}
		if(vendoraddress == ""){
			$("#err_vendoraddress").html("Vendor Address is compulsory.");
			$("#err_vendoraddress").show();
		}
		if(vendorphone1 == ""){
			$("#err_vendorPhone1").html("Vendor Phone is compulsory.");
			$("#err_vendorPhone1").show();
		}
		if(isweburl1 !=true){
			$("#err_sb_web1").html("Vendor Website Url is not valid.");
			$("#err_sb_web1").show();
		}
		if(isweburl2 !=true){
			$("#err_sb_web2").html("Vendor Website Url is not valid.");
			$("#err_sb_web2").show();
		}
	}
	else{
	
		$.ajax({
			url: ajax_url,
			type:"post",
			data:{flag:'12',vendorname:vendorname,vendor_id:vendor_id},
			dataType:"json",
			success:function(msg)
			{
				if(msg[0].vendorcount == 1){
					$("#err_vendorname").html("Vendor is already present.");
					$("#err_vendorname").show();
				}
				else{
					$("#err_vendorname").hide();
					$("#err_vendoraddress").hide();
					$("#err_vendorPhone1").hide();
					$("#err_sb_web1").hide();
					$("#err_sb_web2").hide();
					
					$.ajax({
						url: ajax_url,
						type:"post",
						data:{flag:'13',vendorname:vendorname,vendor_id:vendor_id,vendoraddress:vendoraddress,phone1:vendorphone1,phone2:vendorphone2,web1:web1,web2:web2,vendorstar:vendorstar,country:country,state:state,city:city},
						dataType:"json",
						success:function(msg)
						{
							$("#add-edit").modal('hide');
							createTable();
						}
					});
				}
			}
		});
	}
} 

function add()
{
	var vendorname=$("#sb_vendorname").val();
	var vendoraddress=$("#id_vendorAddress").val();
	var vendorphone1=$("#id_vendorPhone1").val();
	var vendorphone2=$("#id_vendorPhone2").val();
	var web1=$("#sb_web1").val();
	var web2=$("#sb_web2").val();
	var country =$("#id_sbVendorCountry").val();
	var state =$("#id_sbVendorState").val();
	var city =$("#id_sbVendorCity").val();
	isweburl1=true;
	isweburl2=true;
	var vendorstar=$("#id_sbVendorStar").val();
	if(web1 !=""){
		isweburl1=isUrl(web1);
	}
	if(web2 !=""){
		isweburl2=isUrl(web2);
	}
	if((vendorname == "")||(vendoraddress == "")|| (vendorphone1 == "")||(isweburl1 !=true) ||(isweburl2 !=true))
	{
		if(vendorname == ""){
			$("#err_vendorname").html("Vendor Name is compulsory.");
			$("#err_vendorname").show();
		}
		if(vendoraddress == ""){
			$("#err_vendoraddress").html("Vendor Address is compulsory.");
			$("#err_vendoraddress").show();
		}
		if(vendorphone1 == ""){
			$("#err_vendorPhone1").html("Vendor Phone is compulsory.");
			$("#err_vendorPhone1").show();
		}
		if(isweburl1 !=true){
			$("#err_sb_web1").html("Vendor Website Url is not valid.");
			$("#err_sb_web1").show();
		}
		if(isweburl2 !=true){
			$("#err_sb_web2").html("Vendor Website Url is not valid.");
			$("#err_sb_web2").show();
		}
	}
	else{
		
		$.ajax({
			url: ajax_url,
			type:"post",
			data:{flag:'13',vendorname:vendorname},
			dataType:"json",
			success:function(msg)
			{
				if(msg[0].vendorcount == 1){
					$("#err_vendorname").html("Vendor is already present.");
					$("#err_vendorname").show();
				}
				else{
					$("#err_vendorname").hide();
					$("#err_vendoraddress").hide();
					$("#err_vendorPhone1").hide();
					$("#err_sb_web1").hide();
					$("#err_sb_web2").hide();
					$.ajax({
						url: ajax_url,
						type:"post",
						data:{flag:'11',vendorname:vendorname,vendoraddress:vendoraddress,phone1:vendorphone1,phone2:vendorphone2,web1:web1,web2:web2,vendorstar:vendorstar,country:country,state:state,city:city},
						dataType:"json",
						success:function(msg)
						{
							$("#add-edit").modal('hide');
							createTable();
						}
					});
				}
			}
		});
	}
}          
</script>


          


