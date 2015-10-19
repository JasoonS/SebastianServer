<!-- page content -->
<style type="text/css">
    .btn-default {
    background-color: #284C79;
    border-color: #ccc;
}
    
</style>
<div class="right_col" role="main">

    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>
           <ul class="nav navbar-right panel_toolbox">
				<a class="btn btn-sm btn-success" href="<?php echo base_url('admin/HotelServices/showHotelPaidServices')?>">Paid Services</a>
           </ul>

        <!-- Parent service widgets !-->

        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">                    	
                		<?php $pCnt = 1; if($parent_services)  { ?>

                			<?php foreach($parent_services as $parent_service) { ?>

                                <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 classParentServicePanel">
                                    <div class = "card">
                                        <!-- <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas> -->
                                        <div class="avatar">
                                            <img src="" alt="" />
                                        </div>
                                        <div class="content">
                                            <br/>
                                            <p>
                                                <a id="idParentService_<?php echo $parent_service['sb_parent_service_id']; ?>_<?php echo $parent_service['sb_parent_service_name']; ?>" href="javascript:void(0)">
                                                    <button type="button" class="btn btn-default"><?php echo $parent_service['sb_parent_service_name']; ?></button>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <?php /*if($pCnt % 3 == 0) { ?> 
                                	<div class="clearfix"></div> 
                                <?php } */ ?>
                			<?php $pCnt++;} ?>
                		<?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Storing image data soruce !-->
        <?php foreach($parent_services as $parent_service) { ?>
            <img class="src-image"src="<?php echo PARENT_SERVICE_PIC; ?><?php echo $parent_service['sb_parent_service_image']; ?>" />
        <?php } ?>
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

<!-- line modal -->
<div class="modal fade" id="idChildServiceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="idLineModalLabel">My Modal</h3>
        </div>
        <div class="modal-body">
            
            <!-- content goes here -->
            <form id="idFrmSelectChildService">
                <div class = "classFormChkBoxes" id="idChidServiceContainer"></div>              
                <p class = "text-success" id="idSucessMsg"></p>             
            </form>
        </div>

        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                </div>
				
				<?php if($this->session->userdata('logged_in_user')->sb_hotel_user_type != 'u') {?>
                <div class="btn-group" role="group">
                    <button type="button" id="idSaveService" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                </div>
				<?php }?>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS?>js/icheck/icheck.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/stackblurjs/stackblur.js"></script>


<script>
$(document).ready(function(){
    var jsHotelId       = "<?php echo $hotel_id ?>";
	var jsTmpArr        = [];
    var jsParentId      = '';
    var jqXHR           = '';
    // Defining Page Specfic Funcions
    var jsSaveServices = function () {

        var jsChkBoxVals    = [];
        var jsTmpObj        = new Object();
   
        $("#idChidServiceContainer .childChkBoxs").each(function (){

            var jsObjChkBox         = new Object;
            jsObjChkBox.val         = $(this).attr("value");
            jsObjChkBox.isChecked   = $(this).is(":checked") ? "1":"0";
            jsChkBoxVals.push(jsObjChkBox);
        })

       
        jsTmpObj.flag       = 8;
        jsTmpObj.chkBoxArr  = jsChkBoxVals;
        jsTmpObj.hotelId    = jsHotelId;
        // Update Services
        jqXHRSaveService = $.post(ajax_url,jsTmpObj,function( data ){});
        jqXHRSaveService.success(function(data)
        {
           $('#idSucessMsg').html("Service updated successfully").fadeIn('slow') //also show a success message 
        });
    }
	$('a[id^="idParentService"]').on('click',function(){

		jsTmpArr           = this.id.split('_');
        jsParentId         = jsTmpArr[1];
        jsParentName       = jsTmpArr[2];
        //Creating object properties
        var jsTmpObj       = new Object();
        jsTmpObj.flag      = 7;
        jsTmpObj.parentId  = jsParentId;
        jsTmpObj.hotelId   = jsHotelId;
        jqXHR = $.post(ajax_url,jsTmpObj,function( data ){});

        jqXHR.done(function(data)
        {
            //var container = appendTo("#idFrmSelectChildService");
            $("#idLineModalLabel").html(jsParentName);

            jsParsedData = jQuery.parseJSON(data);
            

            for(var cnt = 0; cnt < jsParsedData.length; cnt++ )
            {
               if(jsParsedData[cnt].sb_is_service_in_use == 1 )
               {
                    checked = "checked = 'checked'";
               }else
               {
                    checked = '';
               }
               var childInputs  = '<input type=checkbox class=childChkBoxs id="idChildService_'+jsParentId+'_'+jsParsedData[cnt].sb_child_service_id+'" value="'+jsParentId+'_'+jsParsedData[cnt].sb_child_service_id+'" '+checked+' name="childServices[]" />'+jsParsedData[cnt].sb_child_servcie_name;
               var jsNewElement = '<div class = "checkbox"><label>'+childInputs+'</label></div>';
               $("#idChidServiceContainer").append(jsNewElement);                
            }
            if( jsParsedData.length  == 0){
				$("#idChidServiceContainer").html("No Child Services are present in this parent service.");
				$("#idSaveService").hide();
				
			}
			else{
					var user_type ='<?php $this->session->userdata('logged_in_user')->sb_hotel_user_type; ?>';
					if(user_type != 'u'){
						$("#idSaveService").show();
					}			  
            }			
			
            // Intialize modal
            $('#idChildServiceModal').modal({
                show: true,
            });

            // Reset Modal
            $('#idChildServiceModal').on('hidden.bs.modal', function (e) {
                $(".classFormChkBoxes").html("");
            })
        })
	});

    // Save Service
    $("#idSaveService").on('click',function(){
        jsSaveServices()
    })

})
</script>