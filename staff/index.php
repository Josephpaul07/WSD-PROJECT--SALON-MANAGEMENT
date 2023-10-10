<?php
require_once '../config/config.php';
/*
* Check user is logined
*/
$staff_userid = $session->get_userdata('staff_userid');
if( !$staff_userid && ! ( $staff_userid > 0) ){
    $session->set_flashdata('msg','Please login to staff panel!');
    redirect('staff/login.php');
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
                        <a class="<?= $page_name == 'appointments'   ? 'active-menu ' :'' ?>" href="<?= base_url('staff/appointments.php') ?>"><i class="fa fa-long-arrow-right"></i> Appointments</a>
                    </li>
            </ul>
          </div>
        </div>
    </div>
    

</div>
</div>
</div>





<!-- /. ROW  -->
<?php 
include_once 'footer.php';
?>