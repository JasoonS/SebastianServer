 <script src="<?php echo THEME_ASSETS ?>js/customjs/constants.js"></script>
<!-- Theme specfic js!-->
<script src="<?php echo THEME_ASSETS?>js/bootstrap.min.js"></script>
<!-- chart js -->
<script src="<?php echo THEME_ASSETS?>js/chartjs/chart.min.js"></script>
<script src="<?php echo THEME_ASSETS ?>js/bootstrap-formhelpers.min.js"></script>
<script src="<?php echo THEME_ASSETS?>js/custom.js"></script>
 <div class="right_col" role="main">
                
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3> Hotel Album </h3>
                        </div>
                        <?php
							//print_r($hotelpictures);
							$no_of_rows = count($hotelpictures);
						
						?>
                        
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Hotel Album </h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">

                                    <div class="row">
                                        <?php 
											$i = 0 ;
											while($i<count($hotelpictures))
											{
											     $image_url = HOTEL_PIC.$hotelpictures[$i]['sb_hotel_pic'];
                                                //$image_url = base_url().HOTEL_PIC ."/".$hotel_id."/" .$hotelpictures[$i]['sb_hotel_pic'];
												if($i == 0)
												{
												   //$image_url = base_url().HOTEL_PIC ."/".$hotel_id."/" .$hotelpictures[$i]['sb_hotel_pic'];
												
													echo '<div class = "row"><div class="col-md-55">
															<div class="thumbnail">
																<div class="image view view-first">
																	<img style="width: 100%; display: block;" src="'.$image_url.'" alt="image" />
																	<div class="mask">
																		
																		<div class="tools tools-bottom">
																			<a href="#"><i class="fa fa-link"></i></a>
																			<a href="#"><i class="fa fa-pencil"></i></a>
																			<a href="#"><i class="fa fa-times"></i></a>
																		</div>
																	</div>
																</div>
																<div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
															</div>
														</div>';
												}
												else {
													if(($i !=0) && ($i%5 == 0)){
													//$image_url = base_url().HOTEL_PIC ."/".$hotel_id."/" .$hotelpictures[$i]['sb_hotel_pic'];
												
														echo '</div><div class = "row"><div class="col-md-55">
															<div class="thumbnail">
																<div class="image view view-first">
																	<img style="width: 100%; display: block;" src="'.$image_url.'" alt="image" />
																	<div class="mask">
																		
																		<div class="tools tools-bottom">
																			<a href="#"><i class="fa fa-link"></i></a>
																			<a href="#"><i class="fa fa-pencil"></i></a>
																			<a href="#"><i class="fa fa-times"></i></a>
																		</div>
																	</div>
																</div>
																<div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
															</div>
														</div>';
													}
													else{
													//$image_url = base_url().HOTEL_PIC ."/".$hotel_id."/" .$hotelpictures[$i]['sb_hotel_pic'];
												
														echo '<div class="col-md-55">
															<div class="thumbnail">
																<div class="image view view-first">
																	<img style="width: 100%; display: block;" src="'.$image_url.'" alt="image" />
																	<div class="mask">
																		
																		<div class="tools tools-bottom">
																			<a href="#"><i class="fa fa-link"></i></a>
																			<a href="#"><i class="fa fa-pencil"></i></a>
																			<a href="#"><i class="fa fa-times"></i></a>
																		</div>
																	</div>
																</div>
																<div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
															</div>
														</div>';
													}
												}
												$i++;
											}
                                     
										?>				
                                        <!--<div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask">
                                                        <p>Your Text</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask">
                                                        <p>Your Text</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask">
                                                        <p>Your Text</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask">
                                                        <p>Your Text</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask">
                                                        <p>Your Text</p>
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p>Snow and Ice Incoming for the South</p>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong>
                                                    </p>
                                                    <p>Snow and Ice Incoming</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong>
                                                    </p>
                                                    <p>Snow and Ice Incoming</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong>
                                                    </p>
                                                    <p>Snow and Ice Incoming</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong>
                                                    </p>
                                                    <p>Snow and Ice Incoming</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;" src="images/4.jpg" alt="image" />
                                                    <div class="mask no-caption">
                                                        <div class="tools tools-bottom">
                                                            <a href="#"><i class="fa fa-link"></i></a>
                                                            <a href="#"><i class="fa fa-pencil"></i></a>
                                                            <a href="#"><i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="caption">
                                                    <p><strong>Image Name</strong>
                                                    </p>
                                                    <p>Snow and Ice Incoming</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>-->

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