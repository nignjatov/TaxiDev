<body>
<section id="container" class="hr-menu">
<!--header start-->
<header class="header fixed-top clearfix">
    <div id="navigationHolder">
        <div class="brand">
            <!--logo start-->
            <a href="index.html" class="logo">
                <img src="<?php echo base_url()?>application/views/images/lifeData_logo_web_app.png" alt="LifeData">
            </a>
            <!--logo end-->
            <!--sidebar toggle start-->
            <!--            <div class="sidebar-toggle-box">-->
            <!--                <div class="fa fa-bars"></div>-->
            <!--            </div>-->
            <!--sidebar toggle end-->
        </div>
        <div class="horizontal-menu navbar-collapse collapse ">
            <ul class="nav navbar-nav">
                <li id="menu_dashboard" class="dropdown">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                        <b class=" fa fa-angle-down"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('Widget/getAllWidgets')?>">Dashboard</a></li>
                        <li><a href="<?php echo site_url('Dashboard/getDashboards')?>">Manage Dashboards</a></li>
                    </ul>
                </li>
                <li id="menu_lifepak">
                    <a href="<?php echo site_url('LifePak/getLifePaks')?>">
                        <i class="fa fa-tasks"></i>
                        <span>LifePak</span>
<!--                        <b class=" fa fa-angle-down"></b>-->
                    </a>
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="--><?php //echo site_url('LifePak/getLifePaks')?><!--">My LifePak</a></li>-->
<!--                        <li><a href="#">Search LifePak</a></li>-->
<!--                    </ul>-->
                </li>
<!--                <li id="menu_report">-->
<!--                    <a href="--><?php //echo site_url('Reports/showReport')?><!--">-->
<!--                        <i class="ico-chart"></i>-->
<!--                        <span>Report & Analytics</span>-->
<!--                    </a>-->
<!--                </li>-->
                <li id="menu_data_download">
                    <a href="<?php echo site_url('DataDownload/dataDownload')?>">
                        <i class="ico-download2"></i>
                        <span>Data Download</span>
<!--                        <b class=" fa fa-angle-down"></b>-->
                    </a>
<!--                    <ul class="dropdown-menu">-->
<!--                        <li><a href="#">EMA Data File</a></li>-->
<!--                        <li><a href="#">Tailored EMA Data File</a></li>-->
<!--                        <li><a href="#">Demographic Data File</a></li>-->
<!--                    </ul>-->
                </li>
                <li id="menu_help">
                    <a href="mailto:<?php echo config_item('support_email_id');?>" target="_top">
                        <i class="fa fa-question-circle"></i>
                        <span>Help</span>
                    </a>
                </li>
            </ul>

        </div>
        <div class="top-nav clearfix">
            <!--search & user info start-->
            <ul class="nav pull-right top-menu">
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <img alt="" src="<?php echo base_url()?>application/views/images/avatar1_small.png">
                        <span class="clientName"><?php echo $userInfo['FirstName'].' '.$userInfo['LastName']?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <li>
                            <a href="<?php echo site_url('User/viewProfile')?>">
                                <i class=" fa fa-suitcase"></i>Profile</a>
                        </li>
                        <!--                        <li>-->
                        <!--                            <a href="#">-->
                        <!--                                <i class="fa fa-cog"></i>Settings</a>-->
                        <!--                        </li>-->
                        <li>
                            <a href="<?php echo site_url('User/logout')?>">
                                <i class="fa fa-key"></i>Log Out</a>
                        </li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!--search & user info end-->
        </div>
    </div>
