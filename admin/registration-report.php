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
* End login check
*/
$process = ( $input->get('option') == 'form' )  ? 'FORM' : 'LIST' ;
/*
* Save or Update data into database starts
*/
$id = $manufacturer_id = $warehouse_id = "";
$date = date('Y-m-d');

htmlView:
$month = date('m');
$year = date('Y');

$rec_list = [];
if (isset ($_POST['btnReport'])){
 
    $sql = "SELECT p.* FROM `patients` p
    WHERE 1 AND  YEAR( p.`reg_date` ) ='". $year ."' AND MONTH( p.`reg_date` ) ='".$month. "' ORDER BY p.`id` DESC";
    $rec_list = $db->execute_get( $sql );
}
include_once 'header.php';
?>
<div id="page-wrapper" >
  <div class="header"> 
    <h1 class="page-header">
      Registration-Report <small></small>
    </h1>         
  </div>
  <div id="page-inner"> 
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
         
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <form class="form-horizontal" action="<?= base_url('admin/registration-report.php') ?> " method="post">
                <?php 
                  $ar_months = ['Jan','feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                  ?>
                  <div class="col-sm-2">
                     <select name="month" class="form-control">
                       <?php foreach ($ar_months as $key => $month_name) {
                        $selected = ($key+1) == (int)$month ? 'selected="selected"':'' ;
                        ?>
                         <option <?= $selected ?> value="<?= ($key+1) ?>"><?= $month_name ?></option>
                       <?php } ?>
                       
                     </select>
                    <?=form_error('month'); ?>
                  </div>

                  <?php  
                  $q = "SELECT YEAR(MIN(`reg_date`)) AS start_year FROM `patients` WHERE 1 ";
                  $year_row = $db->execute_get_row($q);
                  $sart_year =date('Y');
                  if( $year_row && $year_row->start_year > 0  ){
                     $sart_year =  $year_row->start_year;
                  }
                  ?>
                  <div class="col-sm-2" style="padding: 0px">
                     <select name="year" class="form-control">
                       <?php  for ($y= $sart_year  ; $y<= date('Y') ; $y++) {
                        $selected = $y== (int)$year ? 'selected="selected"':'' ;
                        ?>
                         <option <?= $selected ?> value="<?= $y ?>"><?= $y ?></option>
                       <?php } ?>  
                     </select>
                    <?=form_error('date'); ?>
                  </div>
                  <div class="col-sm-2">
                    <input type="submit" value="Show Report" class="btn btn-success" name="btnReport">
                  </div> 
                </form>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <?php 
                if (isset($_POST['btnReport'])){ ?>
                <div id="div1" >
                <?php $month_name = isset($ar_months[$month -1]) ? $ar_months[$month-1] :''  ?>
                <h2>Registration report <?=  $month_name."-".$year ?></h2>
                <?php 
                if(count( $rec_list) == 0){
                    echo '<div class="jumbotron" style="padding:20px">
                      <h3 class="text-center" >No records found !</h3>
                    </div>';
                }else{ ?>
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                            <th style="width: 5%">Sl.No</th>
                            <th style="width: 10%">Reg No</th>
                            <th style="width: 13%">Name</th>
                            <th style="width: 14%">Address</th>
                            <th style="width: 12%">Phone</th>
                            <th style="width: 12%">Email</th>
                            <th style="width: 10%">DOB</th>
                            <th style="width: 10%">Gender</th>
                            <th style="width: 10%">Reg.date</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($rec_list as $key => $row) { ?>
                        <tr class="odd gradeX">
                          <td><?=  ($key+1) ?></td>
                          <td><?= $row['reg_no'] ?></td>
                          <td><?= $row['name']  ?></td>
                          <td><?= $row['address']  ?></td>
                          <td><?= $row['phone']  ?></td>
                          <td><?= $row['email']  ?></td>
                          <td><?= $row['dob']  ?></td>
                          <td><?= $row['gender']  ?></td>
                           <td><?= date('d-m-Y',strtotime($row['reg_date']))  ?></td>
                        </tr>
                      <?php } ?> 
                        </tbody>
                    </table>
                <?php } ?>
              </div>
              <?php } ?>
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
  </div><!-- /.page-inner -->
</div><!-- /.page-wrapper -->
<?php 
include_once 'footer.php';
?>


<?php
if (isset($_POST['btnReport'])){
?>
<script type="text/javascript">
  headerContent = '<style>'+
      'table,tr,td,th {'+
      'border:1px solid #3333;'+
      'border-collapse:collapse;'+
      '}'+
  '</style>';
  var divToPrint = document.getElementById('div1');
  var newWin=window.open('','Print-Window');
  newWin.document.open();
  newWin.document.write('<html>'+headerContent+'<body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
  newWin.document.close();
</script>
<?php } ?>
