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
$id = $ref_key = $title = $image = $breaf = $details = "";


if( isset( $_POST['btnSave'] ) ){
    /*
    * Form validatin stars 
    */

    $form_validation->set_rules('ref_key','Key','required');
    $form_validation->set_rules('title','title','required');
    $form_errors =  $form_validation->run();
    /*
    * ### End form validation
    */

    $id = (int) $input->post('id');
    $ref_key = $input->post('ref_key');
    $title = $input->post('title');
    $image = $input->post('image');
    $breaf = $input->post('breaf');
    $details = $input->post('details');
    
    if( count($form_errors) >0 ){
        $process = 'FORM';
        goto htmlView;

    }else{
          if( $_FILES['fl_image']['name'] != "" ) {
            $upload->config['max_size'] = 3000000;
            $upload->config['allowed_types'] = 'jpg|png|jpeg|gif|jfif';
            $upload->config['upload_path'] = 'uploads/web_contents/';
            if ( $upload->do_upload('fl_image') ){
              if($image  != '' && file_exists(base_path( $image ) )){
                  unlink(base_path( $image ));
              }
              $image = $upload->upload_info['file_name'];
            }else{
                $form_errors['image'] = $upload->upload_info['error']; 
                $process = 'FORM';
                goto htmlView;
            }
        }
          
        if ( $id > 0 ){
            $sql = "UPDATE `web_contents` SET `ref_key`= '".$ref_key."',`title`= '".$title."',`image`= '".$image."',`breaf`= '".$breaf."',`details`= '".$details."' WHERE id =".$id;
            if ( $db->execute($sql) ){
                $session->set_flashdata('msg',alert('Data updated successfully','success'));
            }else{
                $session->set_flashdata('msg',alert('Could n\'t updated the data !','danger'));
            }
        }else{
            $sql = "INSERT INTO `web_contents`( `ref_key`, `title`, `image`, `breaf`, `details` ) VALUES ('".$ref_key."','".$title."','".$image."','".$breaf."','".$details."')";
            if ( $db->execute($sql) ){
                $session->set_flashdata('msg',alert('Data saved successfully','success'));
            }else{
                $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
            }   
        }
        redirect('admin/web-contents.php');
    }
} 
/*
*  ### END Save or Update data into database
*/

/*
*  Strats load data to edit
*/

$edit = (int)$input->get('edit');
$edit_rec = $db->get_row('web_contents',array('id' => $edit));
if ( $edit_rec ){
    $id = $edit_rec->id;
    $ref_key = $edit_rec->ref_key;
    $title = $edit_rec->title;
    $image = $edit_rec->image;
    $breaf = $edit_rec->breaf;
    $details = $edit_rec->details;
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
    $del_rec = $db->delete('web_contents',array('id' => $del));
    if ( $del_rec ){
        $session->set_flashdata('msg',alert('Data deleted successfully','success'));
    }else{
        $session->set_flashdata('msg',alert('Could n\'t delete the data !','danger'));
    }  
    redirect('admin/web-contents.php');
}
/*
*  ### End record delete
*/
if ($process != 'FORM'){
    $whrere = [];
    $order_by = array(
        'id' => 'ASC' , 
    );
    $rec_list = $db->get('web_contents', $whrere, $order_by);
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
      Web contents <small></small>
    </h1>         
  </div>
  <div id="page-inner"> 
    <!-- /.row -->
    <?php  if ($process == 'FORM') {?>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <p><?= $id >0 ? 'Edit ' : 'Add ' ?> Web Content</p>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8 col-lg-offset-2">
                <form class="form-horizontal" method="post" action="<?= base_url('admin/web-contents.php') ?>" enctype="multipart/form-data" >
                  <input type="hidden" name="id" value="<?= $id ?>">
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Ref key:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="ref_key" value="<?= $ref_key ?>">
                      <?= form_error('ref_key') ?>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Title :</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" name="title" value="<?= $title ?>">
                      <?= form_error('title') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Image:</label>
                    <div class="col-sm-5">
                      <input type="hidden" name="image" value="<?= $image ?>">
                      <input type="file"  name="fl_image" >
                      <label>400X400 px</label>
                      <?= form_error('image') ?>
                    </div>
                    <div class="col-sm-3">
                      <?php if (  $image != "") {  ?>
                        <img src ="<?= base_url( $image )   ?>" style="width: 70px">
                      <?php } ?>
                    </div>
                  </div> 
                  
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Breaf:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="breaf" style="height: 200px;"><?= $breaf ?></textarea>
                      <?= form_error('breaf') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-3" >Details:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="details" style="height: 200px;"><?= $details ?></textarea>
                      <?= form_error('details') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                      <button type="submit" name="btnSave" class="btn btn-success">Submit</button>
                      <a class="btn btn-default" href="<?= base_url('admin/web-contents.php') ?>">Cancel</a>
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
            <a href="<?= base_url('admin/web-contents.php?option=form') ?>" class =" btn btn-warning pull-right"><i class="fa fa-plus "></i> Add Web Content </a>
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
                List of Web Contents 
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
                                <th style="width: 30%">Key</th>
                                <th style="width: 30%">Title</th>
                                <th style="width: 10%">Image</th>
                                <th style="width: 10%">Breaf</th>
                                <th style="width: 10%">Details</th>
                                <th style="width: 8%"></th>
                                <th style="width: 8%"></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php foreach ($rec_list as $key => $row) { ?>
                            <tr class="odd gradeX">
                              <td><?=  ($key+1) ?></td> 
                              <td><?= $row['ref_key']  ?></td>
                              <td><?= $row['title']  ?></td>
                              <td>
                                <?php if (  $row['image'] != "") {  ?>
                                 <img src ="<?= base_url($row['image'])   ?>" style="width: 70px">
                                <?php } ?>
                              </td>
                              <td><?= short_text( $row['breaf'] ,50)   ?></td>
                              <td><?= short_text( $row['details'] ,50)   ?></td>
                              <td><a href="<?= base_url('admin/web-contents.php?edit='.$row['id'] ) ?>" class="btn btn-sm btn-default"> <i class="fa fa-edit"></i> Edit </a></td>
                              <td><a onclick="if (confirm('Delete record ?')) { window.location.href='<?= base_url('admin/web-contents.php?del='.$row['id'] ) ?>';}" class="btn btn-sm btn-default"> <i class="fa fa-trash"></i> Delete </a></td>
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
