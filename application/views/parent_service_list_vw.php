<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title">
            <div class="title_left">
                <h3><?php echo $title; ?></h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- Parent service widgets !-->

        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="x_content">                    	
                		<?php $pCnt = 1; if($parent_services)  { ?>

                			<?php foreach($parent_services as $parent_service) { ?>

                				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12 classParentServicePanel">                					
                                    <div class="tile-stats classParentServiceBox">
                                        <a  id="idParentService_<?php echo $parent_service['sb_parent_service_id']; ?>_<?php echo $parent_service['sb_parent_service_name']; ?>" href="javascript:void(0)"><div class="icon"><i class="fa fa-caret-square-o-right"></i></div></a>
	                                    
	                                    <h3 class = "text-primary"><?php echo $parent_service['sb_parent_service_name']; ?></h3>
                                         
                                        <p>Lorem ipsum psdea itgum rixt.</p>
	                                </div>                                   
                                </div>

                                <?php if($pCnt % 3 == 0) { ?> 
                                	<div class="clearfix"></div> 
                                <?php } ?>
                			<?php $pCnt++;} ?>
                		<?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class = "row">
            <div class="col-sm-3">
                <div class="card">
                    <canvas class="header-bg" width="250" height="70" id="header-blur"></canvas>
                    <div class="avatar">
                        <img src="<?php echo site_url('user_data') ?>/hotel_pic/1437977204.jpg" alt="" />
                    </div>
                    <div class="content">
                        <p>Web Developer <br>
                           More description here</p>
                        <p><button type="button" class="btn btn-default">Contact</button></p>
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
                <div class="btn-group" role="group">
                    <button type="button" id="idSaveService" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="<?php echo THEME_ASSETS ?>js/customjs/utility.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!--<script src="<?php echo THEME_ASSETS ?>js/stackblurjs/stackblur.js"></script>!-->


<script>
$(document).ready(function(){

    var host_url        = window.location.origin;
    var base_url        = '';
    var jsHotelId       = "<?php echo $hotel_id ?>";
    var jsTmpArr        = [];
    var jsParentId      = '';
    var jqXHR           = '';
   

    if(host_url == 'http://bizmoapps.com')
    {
        base_url    = host_url+'/sebastian/';
    }else
    {
        base_url    = host_url+'/sebastian-admin-panel/';
    }


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
        jqXHRSaveService = $.post(base_url+js_requesting,jsTmpObj,function( data ){});

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
      

        jqXHR = $.post(base_url+js_requesting,jsTmpObj,function( data ){});

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