 <!-- top navigation -->
<div class="top_nav non-printable">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo base_url(HOTEL_USER_PIC).'/'.$this->session->logged_in_user->sb_hotel_user_pic ?>" alt=""><?php //echo $this->session-> ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                        <li><a href="<?php echo base_url()."admin/uploadprofilepic"?>">  Profile</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url()."admin/changePassword"?>">
                                Change Password
                            </a>
                        </li>
                        <!--<li>
                            <a href="javascript:;">Help</a>
                        </li>-->
                        <li><a href="<?php echo base_url() ?>admin/login/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                        </li>
                    </ul>
                </li>

                <!--<li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                        <li>
                            <a>
                            <span class="image">
                            <img src="<?php echo THEME_ASSETS;  ?>images/img.jpg" alt="Profile Image" />
                        </span>
                                <span>
                            <span>John Smith</span>
                                <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where... 
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                            <img src="<?php echo THEME_ASSETS;  ?>images/img.jpg" alt="Profile Image" />
                        </span>
                                <span>
                            <span>John Smith</span>
                                <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where... 
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                            <img src="<?php echo THEME_ASSETS;  ?>images/img.jpg" alt="Profile Image" />
                        </span>
                                <span>
                            <span>John Smith</span>
                                <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where... 
                        </span>
                            </a>
                        </li>
                        <li>
                            <a>
                                <span class="image">
                            <img src="<?php echo THEME_ASSETS;  ?>images/img.jpg" alt="Profile Image" />
                        </span>
                                <span>
                            <span>John Smith</span>
                                <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                            Film festivals used to be do-or-die moments for movie makers. They were where... 
                        </span>
                            </a>
                        </li>
                        <li>
                            <div class="text-center">
                                <a>
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->

            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->

