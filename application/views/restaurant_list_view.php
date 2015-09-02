<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Available Restaurants List</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <a class="btn btn-sm btn-success" id="add_vendor" href="#"  title="Add Restaurants" onclick="addVendor('create');"><i class="glyphicon glyphicon-plus"></i> Add Restaurants</a>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="table-responsive x_content">
                        <table id="idVendors" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Restaurant's Id</th>
                                    <th>Restaurant's Name</th> 
                                    <th>Restaurant's Description</th>
                                    <th>Restaurant's Image</th>
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
                <p>You are about to change status of one Restaurant.</p>
                <p>Do you want to proceed?</p>
                <p class="debug-url"></p>
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Proceed</button>	
				                              
            </div>
        </div>
    </div>
</div>
<!-- This Dialog is used to add Or Edit Restaurants -->
<div class="modal fade" id="add-edit" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true" >
    <form class="form-horizontal" action="<?php echo base_url()?>admin/Restaurants/insert_restaurant" method="post" onsubmit = "return add()" enctype="multipart/form-data"> -->
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add / Edit Restaurants</h4>
            </div>
        			<input type="hidden" id = "sb_hotel_id" name="sb_hotel_id" value = "<?php echo($this->session->userdata('logged_in_user')->sb_hotel_id);?>" />
        			<input type="hidden" id = "sb_hotel_restaurant_id" name="sb_hotel_restaurant_id"/>
            <div class="modal-body" style ="padding-bottom:80%">
			    
				<div class = "form-group classFormInputsBox" class="applypadding2">
			        <label class="col-md-4 col-xs-4 control-label" for="sb_rest_name">Restaurants Name :</label>
						<div class="col-md-8 col-xs-8">
							<input id="sb_rest_name" name="sb_rest_name" type="text" class="form-control" value="" >
							<div id="sb_rest_name" class="errorclass" style="display:none"></div>
						</div>
			    </div>

			    <div class = "form-group classFormInputsBox" class="applypadding2">
					<label class="col-md-4 col-xs-4 control-label" for="sb_rest_desc"> Restaurants Description :</label>	
						<div class="col-md-8 col-xs-8">
							<textarea id="sb_rest_desc" name="sb_rest_desc" class="form-control"></textarea>		  
							<div id="sb_rest_desc" class="errorclass" style="display:none"></div>		
						</div>
			    </div>

			    <div class="form-group classFormInputsBox">
								<label class="col-md-4 col-xs-4 control-label" for="sb_sub_child_service_image">Restaurant's Picture :</label>
								<div class="col-md-8 col-xs-8">
									    <div class="col-xs-6">
											<input id="sb_sub_child_service_image" name="sb_sub_child_service_image"  type="file" style="display:none"/>
										<button id='btn-upload'>Upload</button>
                                        </div>	
										<div id="id_filePreview" class="col-xs-6">
										<img id="id_uploadImage" style="width:100%;height:100%" src="" alt="your image" />
										
										</div>
																			
								</div>
				</div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" id="idChangeVendorStats">Proceed</button>	
				                              
            </div>
        </div>
    </div>
</div>
</form>

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
<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/star-rating.js"></script>
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">

<script>

function createTable(){
		$('#idVendors').dataTable({
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
		"bDestroy":true,	
        "ajax": {
            "url": "<?php echo site_url('admin/Restaurants/get_restaurants');?>",
            "data":{flag:'9',tablename:'sb_hotel_restaurant',orderkey: 'sb_hotel_restaurant_id',orderdir:'desc'},
            "type": "POST",
         
        },
        "order": [[ 1, "desc" ]],

        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [0,3,4]
            }, //disables sorting for column one
			{
                'visible': false,
                'aTargets': [0,3]
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

    createTable();
    
});

function changevendorstatus(id,vendorstatus)
{  
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-danger id="idChangeHotelStats" onclick="changestatus('+id+','+vendorstatus+');">Proceed</button>');
    $("#confirm-delete").modal('show');
}

function addVendor(action)
{   
    $("#myModalLabel").html("Create Vendor");
	$("#sb_vendorname").val('');
	loadStates('id_sbVendorCountry','id_sbVendorState','1','id_sbVendorCity','0','0','0'); 
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button><input class="btn btn-danger" type ="submit" onclick="add();"   value = "Add Restaurant" name = "add" id = "submit">');
    $("#add-edit").modal('show');
    $('#id_uploadImage').attr('src', "#");
}
function edit(sb_hotel_restaurant_id, sb_hotel_restaurant_name, sb_hotel_restaurant_details, sb_rest_image)
{  

	$("#myModalLabel").html("Edit Restaurants");
	$("#sb_hotel_restaurant_id").val(sb_hotel_restaurant_id);
	$("#sb_rest_name").val(sb_hotel_restaurant_name);
	$("#sb_rest_desc").val(sb_hotel_restaurant_details);
	$('#id_uploadImage').attr('src', restaurant_pic_url+"/"+sb_rest_image);

	// $(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><button type="button" class="btn btn-danger id="editVendor" onclick="editVendor('+sb_hotel_restaurant_id+',\''+sb_hotel_restaurant_name+'\');">Edit Restaurant</button>');
	$(".modal-footer").html('<button type="button" class="btn btn-default" data-dismiss="modal">OK</button><input class="btn btn-danger" type ="submit" value = "Edit Restaurant" onclick="add();" name = "edit" id = "submit">');
    $("#add-edit").modal('show');
}

function changestatus(id,vendorstatus)
{
    $.ajax({
        url: "<?php echo site_url('admin/Restaurants/status_change');?>",
        type:"post",
        data:{"sb_hotel_restaurant_id":id,"is_delete":vendorstatus},
        dataType:"json",
        success:function(msg)
        {
            $('#confirm-delete').modal('hide');
			createTable();
        }
    });
}

function editVendor(sb_hotel_restaurant_id,sb_hotel_restaurant_name)
{
	// alert(sb_hotel_restaurant_name);
	 
	var sb_hotel_restaurant_name = $("#sb_rest_name").val();
	var sb_hotel_restaurant_details = $("#sb_rest_desc").val();
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
	// alert("samrat");
	var sb_hotel_id =  $("#sb_hotel_id").val();
	var sb_rest_name = $("#sb_rest_name").val();
	var sb_rest_desc = $("#sb_rest_desc").val();
	// var sb_rest_img=$("#sb_rest_img").val();
	
	if((sb_hotel_id == "")||(sb_rest_name == "")|| (sb_rest_desc == ""))
	{
		if(sb_rest_name == "")
		{
			$("#sb_rest_name").html("Restaurant Name is compulsory.");
			$("#sb_rest_name").show();
			return false ;
		}
		if(sb_rest_desc == "")
		{
			$("#sb_rest_desc").html("Restaurant Description is compulsory.");
			$("#sb_rest_desc").show();
			return false ;
		}
		
	}
	else
	{
		return true;
	}
} 

function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				
				reader.onload = function (e) {
					$("#id_uploadImage").show(200);
					$('#id_uploadImage').attr('src', e.target.result);
				}
				
				reader.readAsDataURL(input.files[0]);
			}
		}
		/* Change Event is bind to Hidden File Upload Control*/
	$("#sb_sub_child_service_image").change(function(){
			readURL(this);
		});	
		/* Button Click To trigger change event on hidden file upload control*/
	$('#btn-upload').click(function(e){
			e.preventDefault();
			$('#sb_sub_child_service_image').click();
		});
</script>


          


