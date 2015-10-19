<div class="col-md-3 left_col non-printable">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="<?php echo site_url('admin/dashboard'); ?>" class="site_title"><i class="fa fa-paw"></i> <span><?php if(isset($title)) {echo $title;} ?></span></a>
        </div>
        <div class="clearfix"></div>
		
	   <?php
        //echo '<pre>';
        //print_r($this->session->all_userdata());
        //exit;
       ?>
        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?php echo HOTEL_USER_PIC.$this->session->logged_in_user->sb_hotel_user_pic; ?>" alt="" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php $this->session->logged_in_user->sb_hotel_username;?></h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3><?php echo $this->session->userdata('logged_in_user')->sb_hotel_username;?></h3>
                <ul class="nav side-menu">  
				<?php //echo "<pre>";
				      //print_r($this->acl->perms);
					  foreach ($this->acl->perms as $key => $row) {
						$order[$key]  = $row['order'];
						$name[$key] = $row['name'];
					}

					// Sort the data with volume descending, edition ascending
					// Add $data as the last parameter, to sort by the common key
						//$parentmodules=array_multisort($order, SORT_ASC, $name, SORT_DESC, $this->acl->perms);
						//print_r($parentmodules);echo "<pre>";print_r($this->acl->perms);exit;
					  array_multisort($order, SORT_ASC, $this->acl->perms);
					  foreach($this->acl->perms as $key=>$value) {  ?>                              
                        <li>
                            <?php if($value['is_parent'] == 'y' && $value['parent_id'] == 0 ) { 
							           // echo $value['module_key'];
                                  //print_r($value['icon']);
										if(trim($value['module_key'])=="dashboard"){?>
											
										   <a href="<?php echo base_url('admin/'.$value['module_key']); ?>"><i class="<?php echo $value['icon'];?>"></i> <?php echo $value['name'] ?><span class="fa fa-chevron-down"></span></a>
								
										<?php  }
										 else{?>
											<a><i class="<?php echo $value['icon'];?>"></i> <?php echo $value['name'] ?><span class="fa fa-chevron-down"></span></a>
								
										<?php }?>
							  <?php $subModules = $this->acl->getSubModules($value['id']); ?>
 
                                	<!--<ul class="nav child_menu" style="display:none">
										<li><a>level1</a></li>
										<li><a>level1</a>
											<ul class="nav child_menu" style="display:none">
												<li><a>level2</a></li>
												<li><a>level2</a></li>
												<li><a>level2</a></li>
											</ul>
										</li>
										
										<li><a>level1</a></li>
                                    </ul>-->
								<?php if($subModules) { ?>
								<?php //echo "<pre>";print_r($subModules);?>
                                <ul class="nav child_menu" style="display: none">                
                                    <?php foreach($subModules as $key => $val) { ?>
									    <?php if(($val['module_key'] == "hotel/view_hotel/")||($val['module_key'] == "hotel/photos/")||($val['module_key'] == "hotel/surroundings/")){
											$val['module_key'] = $val['module_key'].$this->session->userdata('logged_in_user')->sb_hotel_id;
										
										}?>
									      
                                        <li><a href="<?php echo base_url('admin/'.$val['module_key']); ?>"><?php echo $val['name']; ?></a></li>
                                    <?php } ?>
                                </ul>

                               <?php } ?>
                             
                            <?php } ?>                            
                        </li>
                    <?php }
					  ?> 
                   
                </ul>            
            </div>            
        </div>
        <!-- /sidebar menu -->
    </div>
</div>