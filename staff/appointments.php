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
$process = ( $input->get('option') == 'form' )  ? 'FORM' : 'LIST' ;

/*
*  Strats apporve
*/ 
$apporve = (int)$input->get('apporve');
if ( $apporve > 0  ){
    $sqls = "UPDATE appointments SET `status`= 2 WHERE id ='".$apporve."'";
    $upd_rec = $db->execute( $sqls );
    if ( $upd_rec ){
      $session->set_flashdata('msg',alert('Appointment approved successfully','success'));
  }else{
      $session->set_flashdata('msg',alert('Could n\'t  update the record !','danger'));
  }  
  redirect('staff/appointments.php');
}

/*
*  Strats reject
*/  
$reject = (int)$input->get('reject');
if ( $reject > 0  ){
    $sqls = "UPDATE appointments SET `status`= 3 WHERE id ='".$reject."'";
    $upd_rec = $db->execute( $sqls );
    if ( $upd_rec ){
      $session->set_flashdata('msg',alert('Appointment rejected successfully','success'));
  }else{
      $session->set_flashdata('msg',alert('Could n\'t  update the record !','danger'));
  }  
  redirect('staff/appointments.php');
}




$sqls = "SELECT ap.*,c. `name`,c. `address`,c. `phone`,c. `email`, s.`name` AS service_name,stf.name AS staff_name FROM `appointments` ap
LEFT JOIN  `customers` c ON ap.`customer_id` = c.`id` 
LEFT JOIN  `services` s ON ap.`service_id` = s.`id` 
LEFT JOIN  `staffs` stf ON ap.`staff_id` = stf.`id` 
WHERE 1 ORDER BY ap.`id` DESC ";
$rec_list = $db->execute_get($sqls );

/*
* Save or Update data into database ends
*/
htmlView:
include_once 'header.php';

$days = get_days();

?>
<div id="page-wrapper" >
  <div class="header"> 
    <h1 class="page-header">
      Appointments<small></small>
    </h1>         
  </div>
  <div id="page-inner"> 
    <!-- /.row -->
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                 <?= $session->get_flashdata('msg') ?>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                List of Appointments
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-lg-12">
                    <?php 
                    if(count( $rec_list) == 0){
                        echo '<div class="jumbotron" style="padding:20px">
                          <h3 class="text-center" >No records found !</h3>
                        </div>';
                    }else{ ?>
                      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                          <thead>
                          
                            <tr>
                                <th style="width: 4%">Sl.No</th>
                                <th style="width: 10%">Service</th>
                                <th style="width: 10%">Staff</th>
                                <th style="width: 10%">Customer name</th>
                                <th style="width: 10%">Address</th>
                                <th style="width: 6%">Phone</th>
                                <th style="width: 20%">Booking for ( Date /Time ) </th>
                                <th style="width: 10%">Booked on</th>
                                <th style="width: 5%">Status</th>
                                <th style="width: 15%"></th>
                                
                            </tr>  
                          </thead>
                          <tbody>
                          
                          <?php foreach ($rec_list as $key => $row) { ?>
                            <tr class="odd gradeX">
                              <td><?=  ($key+1) ?></td>
                              <td><?= $row['service_name']  ?></td>
                              <td><?= $row['staff_name']  ?></td>
                              <td><?= $row['name']  ?></td>
                              <td><?= $row['address']  ?></td>
                              <td><?= $row['phone']  ?></td>
                             
                              <td><?= date('d-m-Y',strtotime( $row['date'] )).", " . $row['time_slot']   ?></td>
                              
                              <td><?= date('d-m-Y',strtotime( $row['booked_on'] ))   ?></td>
                              <td>
                                <?php 
                                if ( $row['status'] == 1 ){
                                  echo get_label('Pending','warning');
                                }elseif ( $row['status'] == 2 ){
                                  echo get_label('Approved','success');
                                }elseif ( $row['status'] == 3 ){
                                  echo get_label('Rejected','danger');
                                }elseif ( $row['status'] == 4 ){
                                  echo get_label('Cancelled','warning');
                                }
                                ?></td>
                              <td>
                              <?php if ( $row['status'] == 1 )  {?>  
                              <a href="<?= base_url('staff/appointments.php?apporve='.$row['id'] ) ?>" class="btn btn-sm btn-success"> <i class="fa fa-check"></i> Approve </a>
                              <a href="<?= base_url('staff/appointments.php?reject='.$row['id'] ) ?>" class="btn btn-sm btn-danger"> <i class="fa fa-close"></i> Reject </a>
                              <?php }elseif ( $row['status'] == 2 )  {?>  
                                <a href="<?= base_url('staff/appointments.php?reject='.$row['id'] ) ?>" class="btn btn-sm btn-danger"> <i class="fa fa-close"></i> Reject </a>
                              <?php }elseif ( $row['status'] == 3 )  {?>  
                                <a href="<?= base_url('staff/appointments.php?apporve='.$row['id'] ) ?>" class="btn btn-sm btn-success"> <i class="fa fa-check"></i> Approve </a>
                              <?php } ?>
                            </td>
                              
                            </tr>
                          <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>         
                  </div>
                </div>
                <!-- /.row (nested) -->
              </div>
              <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
          </div>
          <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    
</div>
<!-- /#page-wrapper -->
<?php 
include_once 'footer.php';
?>
