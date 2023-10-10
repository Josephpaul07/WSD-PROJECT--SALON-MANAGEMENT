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
* Save or Update data into database starts
*/
$id = $name = $description = $photo = $email = $password = "";

if( isset( $_POST['btnSave'] ) ){ 
    /*
    * Form validatin stars 
    */
    $form_validation->set_rules('name','Name','required','Please enter name');
    $form_errors =  $form_validation->run();
    /*
    * ### End form validation
    */
    $id = (int) $input->post('id');
    $name = $input->post('name');
    $description = $input->post('description');
    $email = $input->post('email');
    $password = $input->post('password');
    $photo = $input->post('photo');
    if( count($form_errors) >0 ){
        $process = 'FORM';
        goto htmlView;

    }else{
          if( $_FILES['fl_photo']['name'] != "" ) {
            $upload->config['max_size'] = 3000000;
            $upload->config['allowed_types'] = 'jpg|png|jpeg|gif|jfif';
            $upload->config['upload_path'] = 'uploads/staffs/';
            if ( $upload->do_upload('fl_photo') ){
              if($photo  != '' && file_exists(base_path( $photo ) )){
                  unlink(base_path( $photo ));
              }
              $photo = $upload->upload_info['file_name'];
            }else{
                $form_errors['photo'] = $upload->upload_info['error']; 
                $process = 'FORM';
                goto htmlView;
            }
        }
        
        if ( $id > 0 ){
            $sql = "UPDATE `staffs` SET `name`= '".$name."',`description`= '".$description."',`photo`= '".$photo."',`email`= '".$email."',`password`= '".$password."' WHERE id =".$id;
            if ( $db->execute($sql) ){
                $session->set_flashdata('msg',alert('Data updated successfully','success'));
            }else{
                $session->set_flashdata('msg',alert('Could n\'t updated the data !','danger'));
            }
        }else{
          $sql = "INSERT INTO `users`( `role`, `name`, `email`, `password`, `status`) VALUES ('3','". $name."','". $email."','". $password."','1')";
          $db->execute($sql);
          $user_id = $db->get_insert_id();


          $sql = "INSERT INTO `staffs`(`user_id`, `name`,`description`, `photo`, `email`,`password`) VALUES ('".$user_id."','".$name."','".$description."','".$photo."','".$email."','".$password."')";
          if ( $db->execute($sql) ){
              $session->set_flashdata('msg',alert('Data saved successfully','success'));
          }else{
              $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
          }   
        }
        redirect('admin/staffs.php');
    }
} 
/*
*  ### END Save or Update data into database
*/

/*
*  Strats load data to edit
*/
//SELECT `id`, `name`, `description`, `photo` FROM `staffs` WHERE 1
$edit = (int)$input->get('edit');
$edit_rec = $db->get_row('staffs',array('id' => $edit));
if ( $edit_rec ){
    $id = $edit_rec->id;
    $name = $edit_rec->name;
    $description = $edit_rec->description;
    $photo = $edit_rec->photo;
    $email = $edit_rec->email;
    $password = $edit_rec->password;
    $process = 'FORM';
}
/*
*  ### End load data to edit
*/

/*
*  Strats record delete
*/
$del = (int)$input->get('del');
if ( $del > 0 ) {
    $del_rec = $db->delete('staffs',array('id' => $del));
    if ( $del_rec ){
        $session->set_flashdata('msg',alert('Data deleted successfully','success'));
    }else{
        $session->set_flashdata('msg',alert('Could n\'t delete the data !','danger'));
    }  
    redirect('admin/staffs.php');
}
/*
*  ### End record delete
*/
if ($process != 'FORM'){
    $whrere = [];
    $order_by = array(
        'id' => 'ASC' , 
    );
    $rec_list = $db->get('staffs', $whrere, $order_by);
}

/*
* Save or Update data into database ends
*/

htmlView:
include_once 'header.php';
?>
<div id="page-wrapper" >
  <div class="header"> 
    <h1 class="page-header">
      Staffs <small></small>
    </h1>         
  </div>
  <div id="page-inner"> 
    <!-- /.row -->
    <?php  if ($process == 'FORM') {?>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <p><?= $id >0 ? 'Edit ' : 'Add ' ?> Service</p>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2">
                <form class="form-horizontal" method="post" action="<?= base_url('admin/staffs.php') ?>" enctype="multipart/form-data" >
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Name:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="name" value="<?= $name ?>">
                      <?= form_error('name') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Photo:</label>
                    <div class="col-sm-5">
                      <input type="hidden" name="photo" value="<?= $photo ?>">
                      <input type="file"  name="fl_photo" >
                      <label>400X400 px</label>
                      <?= form_error('photo') ?>
                    </div>
                    <div class="col-sm-3">
                      <?php if (  $photo != "") {  ?>
                        <img src ="<?= base_url( $photo )   ?>" style="width: 70px">
                      <?php } ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Description:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="description"><?= $description ?></textarea>
                      <?= form_error('description') ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Email:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="email" value="<?= $email ?>">
                      <?= form_error('email') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Password:</label>
                    <div class="col-sm-9">
                      <input type="password" class="form-control" name="password" value="<?= $password ?>">
                      <?= form_error('password') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" name="btnSave" class="btn btn-success">Submit</button>
                      <a class="btn btn-default" href="<?= base_url('admin/staffs.php') ?>">Cancel</a>
                    </div>
                  </div>
                </form>
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
    <?php }else{ ?>
        <div  class="row" >
          <div class="col-lg-12 " style="margin-bottom: 10px">
            <a href="<?= base_url('admin/staffs.php?option=form') ?>" class =" btn btn-warning pull-right"><i class="fa fa-plus "></i> Add Service </a>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                 <?= $session->get_flashdata('msg') ?>
            </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                List of staffs 
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
                                <th style="width: 30%">Name</th>
                                <th style="width: 30%">Description</th>
                                <th style="width: 10%">Photo</th>
                                <th style="width: 10%">Email</th>
                                <th style="width: 8%"></th>
                                <th style="width: 8%"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($rec_list as $key => $row) { ?>
                            <tr class="odd gradeX">
                              <td><?=  ($key+1) ?></td> 
                              <td><?= $row['name']  ?></td>
                              <td><?= $row['description']  ?></td>
                              <td>
                                <?php if (  $row['photo'] != "") {  ?>
                                 <img src ="<?= base_url($row['photo'])   ?>" style="width: 70px">
                                <?php } ?>
                              </td>
                              <td><?= $row['email']  ?></td>
                              <td><a href="<?= base_url('admin/staffs.php?edit='.$row['id'] ) ?>" class="btn btn-sm btn-default"> <i class="fa fa-edit"></i> Edit </a></td>
                              <td><a onclick="if (confirm('Delete record ?')) { window.location.href='<?= base_url('admin/staffs.php?del='.$row['id'] ) ?>';}" class="btn btn-sm btn-default"> <i class="fa fa-trash"></i> Delete </a></td>
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
    <?php } ?>
</div>
<!-- /#page-wrapper -->
<?php 
include_once 'footer.php';
?>
