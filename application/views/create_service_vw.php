<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title">
            
        </div>
        <div class="clearfix"></div>
	    <?php echo $this->session->flashdata('success_msg');?>
		<ul class="nav navbar-right panel_toolbox">
			<a class="btn btn-sm btn-success" id="idAddParents" href="#"  title="Add Parent Service"><i class="glyphicon glyphicon-plus"></i> Add Parent Service</a>
        </ul>
		<!-- This is Space For Parent Services Grid -->
		<div class="row">
        <h3>Parent Services</h3>
		<div class="table-responsive x_content">
                        <table id="idParentServices" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Service Id</th>
                                    <th>Service Name</th>
                                    <th>Service Colour</th>
                                    <!--<th>No Of Subservices</th>-->
                                    <th>Action</th>  
									<th></th>		
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
						</table>
        </div>
		</div>
		<!-- This is Space For Child Services Grid -->
		<div class="row" id="id_ChildServicesGridWrap" style="display:none;">
			<h3 id="idChildServicesLabel"></h3>
			<div class="table-responsive x_content">
                        <table id="idChildServices" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Service Id</th>
                                    <th>Service Name</th>
                                    <th>Is Menu</th>
                                    <th>Action</th>                       
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
						</table>
			</div>
        </div>
		<!-- This is a Space For Adding Multiple Child Services For Selected Parent Service in Table -->
		<div class="row" id="idChildServiceCreationWrap" style="display:none;">
		<h3 id="idChildServicesCreationLabel"></h3>
			<div id="childErrorDiv" style="display:none;"></div>
			<div class="table-responsive x_content removeyscroll" >
				<form id="formAddChild" name="formAddChild" method="post" action='<?php echo base_url("admin/HotelServices/addChildServices");?>' enctype="multipart/form-data">
                <input type = "hidden" name ="child_parent_service_id">
				<table id="idAddChildServices" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Child Service Name</th>
                            <th>Child Service Image</th>
							<th>Child Service Details</th>
                            <th>Is It Menu?</th> 	
                        </tr>
                    </thead>

					<tbody>
						<tr>
							<td><input id="id_sbChildService"  name="sb_child_service_name[]" type="text" placeholder="Type service name here ...." class="form-control" value=""/></td>
							<td>
								<input class="fileControl" name="sb_child_service_pic0"  type="file" style="display:none"/>
								<div><button class="upload">Upload</button>	
								
									<img class="uploadImage" style="max-width:100px;max-height:100px" src="" alt="your image" />
								</div>
							
							</td>
							<td>
								<textarea name="service_detail[]" required="required" class="form-control textarea" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10" data-parsley-id="1654"></textarea>
							</td>
							<td>
								<input class="radio" type="radio" name="is_menu[0]" value="yes">Yes 
                                <input class="radio" type="radio" name="is_menu[0]" value="no" checked=""> No
							</div>
							</td>
						</tr>
						
					</tbody>
				</table>
				<ul class="nav navbar-right panel_toolbox">
					<a id="addButton" class="btn btn-sm btn-danger" title="Add Child Service" href="#">
						<i class="glyphicon glyphicon-plus"></i>
						Add More ...
					</a>
					<a id="addChildServices" class="btn btn-sm btn-success" title="Submit" href="#">
						<i class="glyphicon glyphicon-plus"></i>
						Submit
					</a>
				</ul>
				</form>
			</div>
		
		</div>
		<!-- This is Space For Child Sub Services Grid -->
		<div class="row" id="id_ChildSubServicesGridWrap" style="display:none;">
			<h3 id="idChildSubServicesLabel"></h3>
			<div class="table-responsive x_content">
                        <table id="idSubChildServices" class="table table-striped responsive-utilities jambo_table">
                            <thead>
                                <tr class="headings">
									<th>Service Id</th>
                                    <th>Service Name</th>
                                    <th>Action</th> 
									<th></th>
									<th></th>
									<th></th>
                                </tr>
                            </thead>

                            <tbody>
                            </tbody>
						</table>
			</div>
        </div>		
   		
    </div>
	<!-- This is a place for adding sub services in menu service -->
	<div class="row" id="idChildSubServiceCreationWrap" style="display:none;">
		<h3 id="idSubChildServicesCreationLabel"></h3>
			<div id="subchildErrorDiv" style="display:none;"></div>
			<div class="table-responsive x_content removeyscroll" >
				<form id="formAddSubChild" name="formAddChild" method="post" action='<?php echo base_url("admin/HotelServices/addSubChildServices");?>' enctype="multipart/form-data">
                <input type = "hidden" name ="child_sub_parent_service_id">
				<table id="idAddSubChildServices" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                        <tr class="headings">
                            <th>Child Service Name</th>
                            <th>Child Service Image</th>
							<th>Child Service Details</th>
                      	
                        </tr>
                    </thead>

					<tbody>
						<tr>
							<td><input id="id_sbChildService"  name="sb_child_service_name[]" type="text" placeholder="Type service name here ...." class="form-control" value=""/></td>
							<td>
								<input class="subfileControl" name="sb_child_service_pic0"  type="file" style="display:none"/>
								<div><button class="subupload">Upload</button>	
								
									<img class="subuploadImage" style="max-width:100px;max-height:100px" src="" alt="your image" />
								</div>
							
							</td>
							<td>
								<textarea name="service_detail[]" required="required" class="form-control textarea" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10" data-parsley-id="1654"></textarea>
							</td>
							
						</tr>
						
					</tbody>
				</table>
				<ul class="nav navbar-right panel_toolbox">
					<a id="addSubChildButton" class="btn btn-sm btn-danger" title="Add Sub-Child Service" href="#">
						<i class="glyphicon glyphicon-plus"></i>
						Add More ...
					</a>
					<a id="addSubChildServices" class="btn btn-sm btn-success" title="Submit" href="#">
						<i class="glyphicon glyphicon-plus"></i>
						Submit
					</a>
				</ul>
				</form>
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
<!-- /footer content -->
</div>
<!-- This is add services Dialog -->
<div id="modal-dialog" class="modal fade" role="dialog"  tabindex="-1"  
   aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog model-lg">
        <div class="modal-content">
  
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>
        
            <div class="modal-body">
			
                
            </div>
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-danger" id="idServiceActionButton"></button>	
				                              
            </div>
        </div>
    </div>
  </div>
<!--- Page specfic css !-->
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/custom.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo THEME_ASSETS; ?>css/icheck/flat/blue.css" rel="stylesheet">
<!-- Page specific js !-->
<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery-ui.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>

<!-- ColorPicker -->
<script src="<?php echo THEME_ASSETS?>js/bootstrap-colorpicker.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/jquery.dataTables.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/customjs/hotelservices.js"></script>
