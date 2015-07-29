<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span><?php if(isset($title)) {echo $title;} ?></span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <img src="<?php echo THEME_ASSETS;  ?>images/img.jpg" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>Anthony Fernando</h2>
            </div>
        </div>
        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">  
                    <?php foreach($this->acl->perms as $key=>$value) {  ?>                                 
                        <li>
                            <?php if($value['is_parent'] == 'y' && $value['parent_id'] == 0 ) { $subModules = $this->acl->getSubModules($value['id']); ?>

                                <a><i class="fa fa-home"></i> <?php echo $value['name'] ?><span class="fa fa-chevron-down"></span></a>

                               <?php if($subModules) { ?>
                                <ul class="nav child_menu" style="display: none">                
                                    <?php foreach($subModules as $key => $val) { ?>
                                        <li><a href="<?php echo $val['module_key'] ?>"><?php echo $val['name']; ?></a></li>
                                    <?php } ?>
                                </ul>

                               <?php } ?>
                            <?php } ?>                            
                        </li>
                    <?php } ?>
                </ul>            
            </div>            
        </div>
        <!-- /sidebar menu -->
    </div>
</div>