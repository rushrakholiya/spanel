<?php ob_start(); ?>
<!DOCTYPE html> 
<?php include('lib.php'); ?>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo SITE_NAME; ?> | <?php echo str_replace(".php","",basename($_SERVER['PHP_SELF'])); ?></title>
    <!-- Bootstrap core CSS -->
    <link href="<?php echo SITE_URL; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/animate.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="<?php echo SITE_URL; ?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/icheck/flat/green.css" rel="stylesheet">    <!-- editor -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/editor/index.css" rel="stylesheet">    <!-- select2 -->
    <link href="<?php echo SITE_URL; ?>/css/select/select2.min.css" rel="stylesheet">    <!-- switchery -->
    <link rel="<?php echo SITE_URL; ?>/stylesheet" href="css/switchery/switchery.min.css" />     <!-- Custom styling plus plugins -->
    <link href="<?php echo SITE_URL; ?>/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/custom.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?php echo SITE_URL; ?>/css/datatables/tools/css/dataTables.tableTools.css" rel="stylesheet">
    <script src="<?php echo SITE_URL; ?>/js/jquery.min.js"></script>
    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="<?php echo SITE_URL; ?>" class="site_title"><img src="<?php echo SITE_URL; ?>/images/jmsc_icon.png" /><!--<i class="fa fa-paw"></i>--> <span><?php echo SITE_NAME; ?></span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic" style="display:none;">
                            <img src="<?php echo SITE_URL; ?>/images/img.jpg" alt="admin_img" class="img-circle profile_img">
                        </div>
                        <div class="profile_info" style="width:100%; display:none;">
                            <span>Welcome Administrator,</span>                            
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="clear:left;">

                        <div class="menu_section">

                            <ul class="nav side-menu">                                
                                <li><a><i class="fa fa-users"></i> App Registration <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/app_register">Add Registration</a>
                                        </li>
                                        <li><a href="<?php echo SITE_URL; ?>/view_register">View Registrations</a>
                                        </li>
                                        <li><a href="<?php echo SITE_URL; ?>/trash_register">Inactive Services</a>
                                        </li>                                        
                                    </ul>
                                </li> 

                                <li><a><i class="fa fa-cube"></i> Products <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/add_product">Add Product</a>
                                        </li>
                                        <li><a href="<?php echo SITE_URL; ?>/view_product">View Product</a>
                                        </li>          
                                    </ul>
                                </li> 

                                <li><a><i class="fa fa-check-square-o"></i> Services <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/add_service">Add Service</a>
                                        </li>
                                        <li><a href="<?php echo SITE_URL; ?>/view_service">View Service</a>
                                        </li>          
                                    </ul> 
                                </li>

                                <li><a><i class="fa fa-envelope-o"></i> Newsletter <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/add_newsletter">Add Newsletter</a>
                                        </li>
                                        <li><a href="<?php echo SITE_URL; ?>/view_newsletter">View Newsletter</a>
                                        </li>                                                  
                                    </ul>
                                </li>


                                <li><a><i class="fa fa-edit"></i> Message <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/add_message">Add Message</a>
                                        </li>                                                  
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-usd"></i> Payments <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo SITE_URL; ?>/add_payment">Add Payment</a>
                                        </li> 
                                        <li><a href="<?php echo SITE_URL; ?>/view_payment">View Payment</a>
                                        </li>                                                 
                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" href="<?php echo SITE_URL; ?>/settings" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>                        
                        <a data-toggle="tooltip" href="<?php echo SITE_URL; ?>/logout" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">Administrator
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?php echo SITE_URL; ?>/profile">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo SITE_URL; ?>/settings">
                                            <span>Settings</span>
                                        </a>
                                    </li>                                    
                                    <li><a href="<?php echo SITE_URL; ?>/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">                                
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
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
                                        <img src="images/img.jpg" alt="Profile Image" />
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
                                        <img src="images/img.jpg" alt="Profile Image" />
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
                                        <img src="images/img.jpg" alt="Profile Image" />
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
                            </li>

                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->
            <?php ob_flush(); ?>