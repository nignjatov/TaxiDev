<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="icon" type="img/ico" href="<?php echo base_url()?>favicon.png">

    <title>TaxiDeals</title>

    <!--Core CSS -->
    <link href="<?php echo base_url()?>application/views/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url()?>application/views/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url()?>application/views/css/jquery/jquery-ui-1.10.1.custom.css" rel="stylesheet">
    <link href="<?php echo base_url()?>application/views/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <link href="<?php echo base_url()?>application/views/js/advanced-datatable/css/demo_page.css" rel="stylesheet"/>
    <link href="<?php echo base_url()?>application/views/js/advanced-datatable/css/demo_table.css" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo base_url()?>application/views/js/data-tables/DT_bootstrap.css"/>

    <link rel="stylesheet" href="<?php echo base_url()?>application/views/css/bootstrap-switch.css"/>
<!--    <link rel="stylesheet" type="text/css" href="--><?php //echo base_url()?><!--application/views/js/bootstrap-fileupload/bootstrap-fileupload.css"/>-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/views/js/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/views/css/bootstrap-datepicker/datepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/views/css/bootstrap-timepicker/timepicker.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>application/views/css/bootstrap-colorpicker/colorpicker.css"/>

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>application/views/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>application/views/css/style-responsive.css" rel="stylesheet" />
    <link href="<?php echo base_url()?>application/views/css/style-cuadro.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>application/views/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/jquery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/jquery/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrapValidator/bootstrapValidator.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/advanced-datatable/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrapValidator/bootstrapValidator.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrap-timepicker/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/bootstrap-switch/bootstrap-switch.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/jquery-tags-input/jquery.tagsinput.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/jquery.dcjqaccordion.2.7.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>application/views/js/jquery.nicescroll.js"></script>
</head>
<body>

<section id="container">
    <!--header start-->
    <header class="header fixed-top clearfix">
        <div id="navigationHolder">
            <div class="brand">
                <!--logo start-->
                <a class="logo" href="#">
                    <img width="185" alt="TaxiDeals" src="<?php echo base_url()?>application/views/img/taxideals_logo_admin.png">
                </a>
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="http://lifedatadevws01.azurewebsites.net/application/views/images/avatar1_small.png"
                                 alt="">
                            <span class="clientName"><?php echo $username?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li>
                                <a href="<?php echo site_url('User/viewProfile')?>">
                                    <i class=" fa fa-suitcase"></i>Profile</a>
                            </li>
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
    </header>
    <!--header end-->
	
	<!--sidebar start-->
    <aside>
		<div class="sidebar-nav">
			<div id="navbar-green" class="navbar navbar-inverse" role="navigation">
    
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
      
				<div  class="navbar-collapse collapse sidebar-navbar-collapse">
					<ul class="nav navbar-nav">
						<ul class="sidebar-menu" id="nav-accordion">
                            <li class="sub-menu" id="dashboard_menu">
                                <a href="<?php echo site_url('Dashboard/viewDriverDashboard')?>">
                                    <i class="fa fa-dashboard"></i>
                                    <span>Driver Dashboard</span>
                                </a>
                            </li>
                            <li class="sub-menu">
                                <a id="operator_menu" href="javascript:;" class="active">
                                    <i class="fa fa-cab"></i>
                                    <span>Driver</span>
                                </a>
                                <ul class="sub">
                                    <li id="taxi_menu"><a href="<?php echo site_url('Journal/getAllJournal')?>" class="active">Journal</a></li>
                                </ul>
                            </li>
							<li class="sub-menu" id="dashboard_menu_operator">
								<a href="<?php echo site_url('Dashboard/viewDashboard')?>">
									<i class="fa fa-dashboard"></i>
									<span>Operator Dashboard</span>
								</a>
							</li>
							<li class="sub-menu">
								<a id="operator_menu" href="javascript:;">
									<i class="fa fa-cab"></i>
									<span>Operator</span>
								</a>
								<ul class="sub">
									<li id="taxi_menu"><a href="<?php echo site_url('Operator/getAllTaxi')?>" class="active">Taxi List</a></li>
								</ul>
							</li>
							<li id="roster_menu" class="sub-menu">
								<a href="<?php echo site_url('Roster/getAllRoster')?>">
									<i class="fa fa-calendar"></i>
									<span>Roster & pay-in</span>
								</a>
							</li>
							<li id="maintenance_menu" class="sub-menu">
								<a href="<?php echo site_url('Maintenance/getAllMaintenance')?>">
									<i class="fa fa-list-alt"></i>
									<span>Maintenance history</span>
								</a>
							</li>
							<li id="driver_ad_menu"><a href="<?php echo site_url('Operator/getAllDriverAds')?>">
                                <i class="fa fa-plus"></i>
                            <span>General Ad List</span></a></li>
						</ul>
					</ul>
				</div><!--/.nav-collapse -->
			</div><!--/.navbar -->
		</div><!--/.sidebar-nav -->  
    </aside>
	<!--sidebar end-->