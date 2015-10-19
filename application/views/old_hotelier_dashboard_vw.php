

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Guest Requests</h3>
            </div>

            <!--<div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>-->
        </div>
		<div class="row">
			<div class="col-md-9 col-sm-9 col-xs-12">
				<div class="row">
                    <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="tile-stats">
							<div class="count"><?php echo $visitor;?></div>
							<h3>Total Visitors</h3>
						</div>
					</div>
				</div>
		    </div>
		</div>
		<div class="row">
		
			<?php 
					$count =0 ;
					while($count<count($hotelServices))
					{
						//echo $hotelServices[$count]['sb_parent_service_name']."<br>";
						if($count == 0){
						    echo "<div class='row'>";
							echo '<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="x_panel classNav">
										<div class="x_title">
											<h2>'.$hotelServices[$count]['sb_parent_service_name'].'<small>requests</small></h2>
                       
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<ul class="list-unstyled timeline" id="parentlist_'.$hotelServices[$count]['sb_parent_service_id'].'">
                       
										</ul>
									</div>
								  </div>
                                 </div>';
						}
                        if($count%2 == 0 && $count!=0)
							{
								echo "</div><div class='row'>";
							    echo '<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="x_panel classNav">
										<div class="x_title">
											<h2>'.$hotelServices[$count]['sb_parent_service_name'].'<small>requests</small></h2>
                       
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<ul class="list-unstyled timeline" id="parentlist_'.$hotelServices[$count]['sb_parent_service_id'].'">
                       
										</ul>
									</div>
								  </div>
                                 </div>';
							}
                            else{
							    if($count!=0){
								echo '<div class="col-md-6 col-sm-6 col-xs-12">
									<div class="x_panel classNav">
										<div class="x_title">
											<h2>'.$hotelServices[$count]['sb_parent_service_name'].'<small>requests</small></h2>
                       
										<div class="clearfix"></div>
									</div>
									<div class="x_content">
										<ul class="list-unstyled timeline" id="parentlist_'.$hotelServices[$count]['sb_parent_service_id'].'">
                       
										</ul>
									</div>
								  </div>
                                 </div>';
								}
                            }    							
						$count++;
					}
			
			?>
		</div>
        <!--<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel classNav">
                    <div class="x_title">
                        <h2>Frontdesk<small>requests</small></h2>
                       
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            <!--<li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
											<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
										</h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel classNav">
                    <div class="x_title">
                        <h2>Housekeeping<small>requests</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel classNav">
                    <div class="x_title">
                        <h2>Frontdesk<small>requests</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel classNav">
                    <div class="x_title">
                        <h2>Housekeeping<small>requests</small></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <ul class="list-unstyled timeline">
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
                                <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                            </h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
											<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
										</h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag">
                                            <span>Entertainment</span>
                                        </a>
                                    </div>
                                    <div class="block_content">
                                        <h2 class="title">
											<a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
										</h2>
                                        <div class="byline">
                                            <span>13 hours ago</span> by <a>Jane Smith</a>
                                        </div>
                                        <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They were where you met the producers that could fund your project, and if the buyers liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>-->
            </div>
        </div>
        <footer>
            <div class="">
                <p class="pull-right"><?php echo $title; ?> from <a>Eeshana</a>. |
                    <span class="lead"> <i class="fa fa-paw"></i> <?php echo $title; ?></span>
                </p>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>
<script src="<?php echo THEME_ASSETS;  ?>js/bootstrap.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo THEME_ASSETS;  ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo THEME_ASSETS;  ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo THEME_ASSETS;  ?>js/icheck/icheck.min.js"></script>

<script type="text/javascript">
function populateRequests(id,servicename) {
console.log("parent_service_id"+id);
        $.ajax({
					url: ajax_url,
					type:"post",
					data:{flag:"20",service_id:id},
					dataType:"json",
					async: "false",
					success:function(msg){
					            console.log(msg);   
								$("#parentlist_"+id).html("");
								var html="";
							    $.each(msg, function(key, value) { 
									 
									console.log(value);
									html =  html + '<li>'+
											'<div class="block">'+
												'<div class="tags">'+
													'<a href="" class="tag">'+
														'<span>New Request</span>'+
													'</a>'+
											'</div>'+
											'<div class="block_content">'+
													'<h2 class="title">'+
														'<a> New request of '+ servicename+' from room no.'+value.sb_guest_allocated_room_no+'</a>'+
													'</h2>'+
												'<div class="byline">'+
														'<span> On '+ value.sb_hotel_ser_reqstd_on +'</span> by <a>'+value.sb_guest_firstName+" "+value.sb_guest_lastName+'</a>'+
												'</div>'+
												'<p class="excerpt">';
													if(value.sb_hotel_service_status == "pending")
													{
														html = html + ' This request is <b>yet not accepted </b>by any staff. Please assign this request to any staff member.';
												    }
												    else{
														html = html + ' This request is <b>'+ value.sb_hotel_service_status +'</b> by staff member '+value.sb_hotel_username; 
														if(value.sb_hotel_service_status == "rejected")
														{
															html = html + ' The Service is rejected because <b>'+value.reject_reason+'</b>';
														}
													
													}
												html = html +'</a>'+
												'</p>'+
											'</div>'+
											'</div>'+
											'</li>';
									
								});
								if(html == ""){
									html = "No Requests Found.";
								}
								$("#parentlist_"+id).html(html);
							},
					error:function(msg){
						console.log("failuer");
					}
				});	 
    setTimeout(function() {
		populateRequests(id,servicename);
	}, 4000);
}

$(document).ready(function() {
  // run the first time; all subsequent calls will take care of themselves
    $.ajax({
					url: ajax_url,
					type:"post",
					data:{flag:"19"},
					dataType:"json",
					async: "true",
					success:function(msg){
					            console.log(msg);   
								$.each(msg, function(key, value) { 
									console.log(key + ': ' + value); 
									console.log(value.sb_parent_service_id);
									populateRequests(value.sb_parent_service_id,value.sb_parent_service_name);
									
								});
							},
					error:function(msg){
						console.log("failuer");
					}
				});	  
});
</script>
