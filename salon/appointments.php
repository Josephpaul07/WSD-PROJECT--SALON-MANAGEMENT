<?php
include_once 'config/config.php';

/*
* Save or Update data into database starts
*/
$id =  $date  = $time_slot = $notes = "";
$service_id = $input->get('service_id');
$customer_id = (int)$session->get_userdata('customer_id');
if ( ! $customer_id > 0 ){
  $session->set_flashdata('msg',alert('Please login to continue !','danger'));
  redirect('login.php');
}
if( isset( $_POST['btnSave'] ) ){
    /*
    * Form validatin stars 
    */
 
    $form_validation->set_rules('service_id','Service','required');
    $form_validation->set_rules('date','date','required');
    $form_validation->set_rules('time_slot','time slot','required');
    $form_validation->set_rules('time_slot','time slot','required');
    $form_errors =  $form_validation->run();
    /*
    * ### End form validation
    */
    //  SELECT `id`, `customer_id`, `service_id`, `date`, `time_slot`, `notes`, `booked_on`, `status` FROM `appointments` WHERE 1
    $id = (int) $input->post('id');
    
    $service_id = $input->post('service_id');
    $date = $input->post('date');
    $time_slot = $input->post('time_slot');
    $notes = $input->post('notes');
    $booked_on = date('Y-m-d');
    $status = 1;
    if( count($form_errors) >0 ){
        $process = 'FORM';
        goto htmlView;
        
    }else{
      $sql = "INSERT INTO `appointments`( `customer_id`, `service_id`, `date`, `time_slot`, `notes`, `booked_on`, `status`) VALUES ('".$customer_id."','".$service_id."','".$date."','".$time_slot."','".$notes."','".$booked_on."','1')";
      if ( $db->execute($sql) ){
          $session->set_flashdata('msg',alert('Appoinment booked successfully','success'));
      }else{
          $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
      }   
      redirect('appointments.php');
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
          <h3><span>Appointment Booking</span></h3>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                 <?= $session->get_flashdata('msg') ?>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 offset-lg-2">
            <div class="box-1">
              <form action="<?= base_url("appointments.php") ?>" method ="post">
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
                  <label class="col-sm-3 col-form-label">Date / Time slot</label>
                  <div class="col-sm-4">
                    <input type="date" name="date" class="form-control" >
                    <?= form_error('date') ?>
                  </div>
                  <div class="col-sm-4">
                    <?php $time_slots = [
                      '9 AM - 10 AM',
                      '10 AM - 11 AM',
                      '11 AM - 12 PM',
                      '12 PM - 1 PM',
                      '1 PM - 2 PM',
                      '2 PM - 3 PM',
                      '3 PM - 4 PM',
                      '4 PM - 5 PM',
                      '5 PM - 6 PM',
                      '6 PM - 7 PM',
                      '7 PM - 8 PM',
                    ] ?>
                    <select class="form-control" name="time_slot" id="time_slot">
                      <option value="">Select time slot</option>
                      <?php foreach ( $time_slots as  $time_slot ){?>
                        <option value="<?= $time_slot ?>"><?= $time_slot ?></option>
                      <?php } ?>
                      </select>
                    <?= form_error('service_id'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label">Notes</label>
                  <div class="col-sm-9">
                  <textarea class="form-control" name="notes"></textarea>
                    <?= form_error('notes'); ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-5">
                    <button type="submit" name="btnSave" class="btn btn-success">Biook Now</button>
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