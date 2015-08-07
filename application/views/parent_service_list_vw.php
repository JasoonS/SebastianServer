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

                				<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">                					
                                    <div class="tile-stats">                            
                                        <div class="count"><?php echo $parent_service['sb_parent_service_name'] ?></div>
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