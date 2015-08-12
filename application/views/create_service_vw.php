<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
	    <form class="form-horizontal" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
		    <div class="row">
	    		<div class = "col-md-6 col-xs-6 classFormBox">
	    			<div class="x_panel">
	    				
		                <div class = "x_content">

		                	<div class = "form-group classFormInputsBox">
                    			<label for="sbHotelName" class="col-xs-3 control-label">Service Name : </label>
							    <div class="col-xs-6">
									<input id="id_sbHotelService"  name="sb_service_name" type="text" placeholder="Type service name here ...." class="form-control" />
									<?php echo form_error('sb_service_name'); ?>
							    </div>
                    		</div>


                    		<div class="form-group classFormInputsBox">
									<label for="sbServicePic" class="col-xs-3 control-label">Service Picture :</label>
									<div class="col-xs-6">
									     <div class="col-xs-6">
										<input id="id_sbServicePic" name="sb_service_pic"  type="file" style="display:none"/>
										<button id='btn-upload'>Upload</button>
                                        </div>	
										<div id="id_filePreview" class="col-xs-6">
										    <img id="id_uploadImage" style="width:100%;height:100%" src="#" alt="your image" />
										</div>										
									</div>
								</div>
							</div>
							<div class="form-group">
                                <label for="id_sbServiceColor" class="col-xs-3 control-label">Service Color</label>
                                 <div class="col-xs-6">
                                    <input type="text" id="sb_service_color" name="sb_service_color" class="colorpicker form-control" value="#5367ce" />
                                </div>
                            </div>
							
		            </div>
	    		</div>
	    	</div>
	
	    	</form>
			<div class="row">
                <div class="col-md-12">
							<div class="row">
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <div class="tile-stats">
                                                <div class="icon"><i class="fa fa-caret-square-o-right"></i>
                                                </div>
                                                <div class="count"><?php echo $parent_service_count;?></div>
                                                <h3>Parent Services</h3>
                                                <p><a id="idShowParents">Show Details</a></p>
                                            </div>
                                </div>
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="tile-stats">
                                        <div class="icon"><i class="fa fa-comments-o"></i>
                                        </div>
                                        <div class="count"><?php echo $child_service_count;?></div>
											<h3>Child Services</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                    </div>
                                </div>
                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="tile-stats">
                                        <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                                        </div>
                                        <div class="count"><?php echo $sub_child_service_count;?></div>
											<h3>Sub-Child Services</h3>
                                            <p>Lorem ipsum psdea itgum rixt.</p>
                                    </div>
                                </div>
                                        
                            </div>
				</div>
			</div>
            <div id="services_widgets" class="row" style="display:none;">
				<legend id="idServiceType"></legend>
				<div class="col-md-12" id="widgets">
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
                            </div>
                    </div>
					<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="tile-stats">
                            <div class="icon"><i class="fa fa-sort-amount-desc"></i>
                            </div>
                            <div class="count"><?php echo $sub_child_service_count;?></div>
								<h3>Sub-Child Services</h3>
                                 <p>Lorem ipsum psdea itgum rixt.</p>
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
<!-- /footer content -->
</div>


<!--- Page specfic css !-->
<link href="<?php echo THEME_ASSETS; ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
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

<script>
$(document).ready(function () {
    $('.colorpicker').colorpicker();
    $("#id_sbServicePic").change(function(){
	
        readURL(this);
    });	
	$('#btn-upload').click(function(e){
        e.preventDefault();
        $('#id_sbServicePic').click();}
    );
	$("#idShowParents").click(function(e){
        e.preventDefault();
        populateServices('Parent');}
    );
	var readURL = function(input) {
     if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
			    $("#id_uploadImage").show(200);
                $('#id_uploadImage').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
	};
	
	var populateServices = function(servicetype){
		$.ajax({
					url: ajax_url,
					type:"post",
					data:{flag:'15',type:servicetype},
					dataType:"json",
					success:function(msg)
					{
						console.log(msg);
						var html="";
						$.each( msg, function( key, value ) {
							console.log( key + ": " + value );
							console.log(value);
							var widget=createParentServiceWidget(value);
							html = html +widget;
						});
						$("#widgets").html(html);
						$("#idServiceType").html("Parent Services");
						$("#services_widgets").show();
					}
				});
	};
	var createParentServiceWidget = function(obj){
		var widget='<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">'+
						'<div class="tile-stats">'+
                            '<div class="icon"><i class="fa fa-sort-amount-desc"></i>'+
                            '</div>'+
                            '<div class="count">fd</div>'+
								'<h3>'+obj.sb_parent_service_name+'</h3>'+
                                '<p>'+obj.sb_parent_service_name+'</p>'+ 
                        '</div>'+
                    '</div>'
		return widget;
	};
	
});

</script>