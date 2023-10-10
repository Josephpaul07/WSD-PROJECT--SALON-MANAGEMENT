<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= get_appname() ?></title>
    <link href="<?= base_url('assets/common/img/favicon32.png')?>" rel="icon">
    <!-- Bootstrap Styles-->
    <link href="<?= base_url('assets/admin/css/bootstrap.css') ?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?= base_url('assets/admin/css/font-awesome.css') ?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?= base_url('assets/admin/js/morris/morris-0.4.3.min.css') ?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="<?= base_url('assets/admin/css/custom-styles.css') ?>" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="<?= base_url('assets/admin/js/Lightweight-Chart/cssCharts.css') ?>"> 
    <style type="text/css">
        .nav>li>a {
            position: relative;
            display: block;
            padding: 5px 15px 5px 52px;
        }
        .error{
      color: red;
    }
    #ajax-loader {
        position:fixed;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255,255,255,0.7);
        z-index:9999;
        display:none;
    }
    @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
    }

    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }
    #ajax-loader:after {
        content:'';
        display:block;
        position:absolute;
        left:48%;top:40%;
        width:40px;height:40px;
        border-style:solid;
        border-color:black;
        border-top-color:transparent;
        border-width: 4px;
        border-radius:50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
    </style>
</head>

<body>
    <div id="ajax-loader" style="display: none"></div>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= base_url('admin/') ?>"><strong><?= get_appname() ?></strong></a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" style="margin-right: 20px">
                        <i class="fa fa-user fa-fw"></i> Admin &nbsp;&nbsp;&nbsp; <i class="fa fa-caret-down">  </i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="<?= base_url('admin/change-password.php') ?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= base_url('admin/login.php?signout=1') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
		<div id="sideNav" href=""></div>
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <?php 
                    $page_name  = pathinfo( $_SERVER['PHP_SELF'] , PATHINFO_FILENAME );
                    ?>
                    <li>
                        <a class="<?= $page_name == 'index' ||  $page_name == ''   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/') ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a class="<?= $page_name == 'services'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/services.php') ?>"><i class="fa fa-long-arrow-right"></i> Services</a>
                    </li>
                    <li>
                        <a class="<?= $page_name == 'web-contents'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/web-contents.php') ?>"><i class="fa fa-long-arrow-right"></i> Web Contents</a>
                    </li>
                    <li>
                        <a class="<?= $page_name == 'appointments'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/appointments.php') ?>"><i class="fa fa-long-arrow-right"></i> Appointments</a>
                    </li>
                    <li>
                        <a class="<?= $page_name == 'enquiries'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/enquiries.php') ?>"><i class="fa fa-long-arrow-right"></i> Enquiries</a>
                    </li>

                    <li>
                        <a class="<?= $page_name == 'customers'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/customers.php') ?>"><i class="fa fa-long-arrow-right"></i> Customers</a>
                    </li>
                    
                   
                    <?php 
                    $ar_menuitems = ['sales-report','stock-report','registration-report'];
                    ?>
                    <!-- <li class="<?= in_array($page_name, $ar_menuitems) ? 'active ' :'' ?>">    
                        <a href="#"><i class="fa  fa-long-arrow-right"></i> Reports <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="<?= $page_name == 'sales-report'  ? 'active-menu ' :'' ?>" href="<?= base_url('admin/sales-report.php') ?>">Sales Report</a>
                            </li>
                            <li>
                                <a class="<?= $page_name == 'stock-report'  ? 'active-menu ' :'' ?>" href="<?= base_url('admin/stock-report.php') ?>">Stock Report</a>
                            </li>
                            <li>
                                <a class="<?= $page_name == 'registration-report'  ? 'active-menu ' :'' ?>" href="<?= base_url('admin/registration-report.php') ?>">Registration - Report</a>
                            </li>
                        </ul>
                    </li>  -->


                    
                </ul>
            </div>
        </nav>
        <!-- /. NAV SIDE  -->