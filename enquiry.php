<?php
include_once 'config/config.php';

/*
* Save or Update data into database starts
*/
$id =  $name  = $mobile = $message = "";
$service_id = $input->get('service_id');

if( isset( $_POST['btnSave'] ) ){
    /*
    * Form validatin stars 
    */
 
    $form_validation->set_rules('name','name','required');
    $form_validation->set_rules('mobile','mobile','required');
    $form_validation->set_rules('message','message','required');
    $form_errors =  $form_validation->run();
    /*
    * ### End form validation
    */
    // SELECT `id`, `name`, `mobile`, `service_id`, `message`, `status`, `date` FROM `enquiries` WHERE 1
    $id = (int) $input->post('id');
    
    $name = $input->post('name');
    $mobile = $input->post('mobile');
    $service_id = $input->post('service_id');
    $message = $input->post('message');
    $status = 1;
    $date = date('Y-m-d');
    if( count($form_errors) >0 ){
        $process = 'FORM';
        goto htmlView;
        
    }else{
      $sql = "INSERT INTO `enquiries`( `name`,`mobile`,`service_id`,`message`,`status`,`date`) VALUES ('".$name."','".$mobile."','".$service_id."','".$message."','".$status."','".$date."')";
      if ( $db->execute($sql) ){
          $session->set_flashdata('msg',alert('Enquiry sent successfully','success'));
      }else{
          $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
      }   
      redirect('enquiry.php');
    }
  }


htmlView:

include_once 'header.php';
$whrere = [];
$order_by = array(
    'name' => 'ASC' , 
);
$services = $db->get('services', $whrere, $order_by);
?>
<!-- ======= Contact Section ======= -->
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
          <div class="col-lg-8 offset-lg-2">
            <div class="box-1">
              <form action="<?= base_url("enquiry.php") ?>" method ="post">
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">Name</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?= $name ?>" name="name">
                  <?= form_error('name'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">Mobile</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control" value="<?= $mobile ?>" name="mobile">
                  <?= form_error('mobile'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">Service</label>
                  <div class="col-sm-9">
                  <select class="form-control" name="service_id" id="service_id">
                      <option value="">Select</option>
                      <?php foreach($services as $row){ ?>
                        
                      <option value="<?= $row['id'] ?>" <?= $service_id == $row['id'] ? ' selected="selected"' :''  ?> ><?= $row['name'] ?></option>
                      <?php } ?>
                    </select>
                    <?= form_error('service_id'); ?>
                    
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">Message</label>
                  <div class="col-sm-9">
                  <textarea class="form-control" name="message"><?= $message ?></textarea>
                    <?= form_error('message'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-5">
                    <button type="submit" name="btnSave" class="btn btn-success">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- End Contact Section -->
<?php
include_once 'footer.php';
?>