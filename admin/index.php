<?php
require_once '../config/config.php';
/*
* Check user is logined
*/
$admin_userid = $session->get_userdata('admin_userid');
if( !$admin_userid && ! ( $admin_userid > 0) ){
    $session->set_flashdata('msg','Please login to admin panel!');
    redirect('admin/login.php');
}
/*
* ### End login check
*/
htmlView:
include_once 'header.php';
?>
<div id="page-wrapper">
<div class="header"> 
    <h1 class="page-header">
        Dashboard 
    </h1>
	<ol class="breadcrumb">
  <li><a href="#">Home</a></li>
 
</ol> 
				
</div>
<div id="page-inner">

<!-- /. ROW  -->




                    
                    
                    

                    




<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          
          <div class="panel-body">
            <ul>
            <li>
                <a class="<?= $page_name == 'services'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/services.php') ?>"><i class="fa fa-long-arrow-right"></i> Services</a>
            </li>
                
            </ul>

          </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          
          <div class="panel-body">
            <ul>
            <li>
                        <a class="<?= $page_name == 'web-contents'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/web-contents.php') ?>"><i class="fa fa-long-arrow-right"></i> Web Contents</a>
                    </li>
                
            </ul>

          </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul>
            <li>
                        <a class="<?= $page_name == 'appointments'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/appointments.php') ?>"><i class="fa fa-long-arrow-right"></i> Appointments</a>
                    </li>
            </ul>
          </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul>
            <li>
                        <a class="<?= $page_name == 'enquiries'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/enquiries.php') ?>"><i class="fa fa-long-arrow-right"></i> Enquiries</a>
                    </li>
                    
            </ul>
          </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-body">
            <ul>
            <li>
                        <a class="<?= $page_name == 'customers'   ? 'active-menu ' :'' ?>" href="<?= base_url('admin/customers.php') ?>"><i class="fa fa-long-arrow-right"></i> Customers</a>
                    </li>
                    
            </ul>
          </div>
        </div>
    </div>
    
    
   <!--  <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="panel panel-default">
          <div class="panel-heading">Reports</div>
          <div class="panel-body">
            <ul>
                <li>
                    <a  href="<?= base_url('admin/sales-report.php') ?>">Sales Report</a>
                </li>
                <li>
                    <a  href="<?= base_url('admin/stock-report.php') ?>">Stock Report</a>
                </li>
                <li>
                    <a  href="<?= base_url('admin/registration-report.php') ?>">Registration - Report</a>
                </li>
            </ul>

          </div>
        </div>
    </div> -->
</div>
</div>
</div>





<!-- /. ROW  -->
<?php 
include_once 'footer.php';
?>