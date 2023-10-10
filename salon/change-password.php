<?php
include_once 'config/config.php';
$email ="";
$user_id = (int)$session->get_userdata('user_id');
if (isset ($_POST['btnChangePassword'])){
    $password = $input->post('password');
    $c_password = $input->post('c_password');

    $form_validation->set_rules('password','Password','required','Please enter name');
    $form_errors =  $form_validation->run();
    
    if( $password != $c_password){
        $form_errors['c_password'] = "Mismatch in confirm password !";
    }
    if( count($form_errors) >0 ){
        $process = 'FORM';
        goto htmlView;

    }else{
        $sql = "UPDATE `users` SET `password`='".$password."' WHERE id='".$user_id."'";
        if ( $db->execute($sql) ){
            $session->set_flashdata('msg',alert('Password changed succesffully','success'));
        }else{
            $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
        }   
        redirect('change-password.php');
    }
}
htmlView:
include_once 'header.php';
?>
<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="margin-top: 50px;min-height: 600px">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>Change Password</span></h3>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                 <?= $session->get_flashdata('msg') ?>
            </div>
        </div>
        
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 offset-lg-2">
            <div class="box-1">
              <form action="<?= base_url("change-password.php") ?>" method ="post">
                
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">New Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="password" class="form-control" >
                    <?= form_error('password') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Confirm Password</label>
                  <div class="col-sm-9">
                    <input type="password" name="c_password" class="form-control" >
                    <?= form_error('c_password') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-3 col-form-label"></label>
                  <div class="col-sm-5">
                    <button type="submit" name="btnChangePassword" class="btn btn-success">Change Password</button>
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