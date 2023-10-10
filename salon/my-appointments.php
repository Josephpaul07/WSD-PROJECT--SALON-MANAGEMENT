<?php
require_once 'config/config.php';
/*
* Check user is logined
*/
$customer_id = (int)$session->get_userdata('customer_id');
if ( ! $customer_id > 0 ){
  $session->set_flashdata('msg',alert('Please login to continue !','danger'));
  redirect('login.php');
}
/*
* ### End login check
*/
$process = ( $input->get('option') == 'form' )  ? 'FORM' : 'LIST' ;

/*
*  Strats apporve
*/ 
$cancel = (int)$input->get('cancel');
if ( $cancel > 0  ){
    $sqls = "UPDATE appointments SET `status`= 4 WHERE id ='".$cancel."'";
    $upd_rec = $db->execute( $sqls );
    if ( $upd_rec ){
      $session->set_flashdata('msg',alert('Appointment cancelled successfully','success'));
  }else{
      $session->set_flashdata('msg',alert('Could n\'t  update the record !','danger'));
  }  
  redirect('my-appointments.php');
}






$sqls = "SELECT ap.*,c. `name`,c. `address`,c. `phone`,c. `email`, s.`name` AS service_name FROM `appointments` ap
LEFT JOIN  `customers` c ON ap.`customer_id` = c.`id` 
LEFT JOIN  `services` s ON ap.`service_id` = s.`id` 
WHERE 1 ORDER BY ap.`id` DESC ";
$rec_list = $db->execute_get($sqls );

/*
* Save or Update data into database ends
*/
htmlView:
include_once 'header.php';

$days = get_days();

?>
<section id="contact" class="contact" style="margin-top: 50px;min-height: 600px">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>Enquiry</span></h3>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                 <?= $session->get_flashdata('msg') ?>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12">
            <div class="box-1">
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
                                <th style="width: 10%">Customer name</th>
                                <th style="width: 10%">Address</th>
                                <th style="width: 10%">Phone</th>
                                <th style="width: 20%">Booking for ( Date /Time ) </th>
                                <th style="width: 10%">Booked on</th>
                                <th style="width: 5%">Status</th>
                                <th style="width: 15%">Action</th>
                                
                            </tr>
                          </thead>
                          <tbody>
                          
                          <?php foreach ($rec_list as $key => $row) { ?>
                            <tr class="odd gradeX">
                              <td><?=  ($key+1) ?></td>
                              <td><?= $row['service_name']  ?></td>
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
                              <a href="javascript:void(0)" onclick="javascript:if(confirm('Cancel this appontment ? ')){ window.location.href='<?= base_url('my-appointments.php?cancel='.$row['id'] ) ?>'}" class="btn btn-sm btn-danger"> <i class="fa fa-close"></i> Cancel </a>
                             
                              <?php } ?>
                            </td>
                              
                            </tr>
                          <?php } ?>
                            </tbody>
                        </table>
                    <?php }?>         
                  </div>
                  </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
<?php 
include_once 'footer.php';
?>
