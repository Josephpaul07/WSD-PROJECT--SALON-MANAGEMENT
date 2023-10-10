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
$process = ( $input->get('option') == 'form' )  ? 'FORM' : 'LIST' ;



/*
* Save or Update data into database ends
*/

/*
*  Strats record delete
*/
$del = (int)$input->get('del');
if ( $del > 0 ) {
    $del_rec = $db->delete('enquiries',array('id' => $del));
    if ( $del_rec ){
        $session->set_flashdata('msg',alert('Data deleted successfully','success'));
    }else{
        $session->set_flashdata('msg',alert('Could n\'t delete the data !','danger'));
    }  
    redirect('admin/enquiries.php');
}
$sqls = "SELECT enq.*, s.`name` AS `service_name` FROM `enquiries` enq
LEFT JOIN  `services` s ON enq.`service_id` = s.`id` 
WHERE 1 ORDER BY enq.`id` DESC ";
$rec_list = $db->execute_get($sqls );
htmlView:
include_once 'header.php';

$days = get_days();

?>
<div id="page-wrapper" >
  <div class="header"> 
    <h1 class="page-header">
      Enquiries<small></small>
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
                List of Enquiries
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
                                <th style="width: 15%">Service</th>
                                <th style="width: 15%">Name</th>
                                <th style="width: 15%">Mobile</th>
                                <th style="width: 20%">Message </th>
                               
                                <th style="width: 10%">Date</th>
                               
                                <th style="width: 6%"></th>
                               
                                
                            </tr>
                          </thead>
                          <tbody>
                          
                          <?php foreach ($rec_list as $key => $row) { ?>
                            <tr class="odd gradeX">
                              <td><?=  ($key+1) ?></td>
                              <td><?= $row['service_name']  ?></td>
                              <td><?= $row['name']  ?></td>
                              <td><?= $row['mobile']  ?></td>
                              <td><?= $row['message']  ?></td>
                             
                              <td><?= date('d-m-Y',strtotime( $row['date'] ))   ?></td>
                               <td>
                               <a onclick="if (confirm('Delete record ?')) { window.location.href='<?= base_url('admin/enquiries.php?del='.$row['id'] ) ?>';}" class="btn btn-sm btn-default"> <i class="fa fa-trash"></i> Delete </a>
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
