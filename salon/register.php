<?php
include_once 'config/config.php';


$name = $address = $phone = $email = $dob = $gender = "";
$gender = "Male";

if ( isset( $_POST['btnRegister'] ) ){

  $name = $input->post('name');
  $address = $input->post('address');
  $phone = $input->post('phone');
  $email = $input->post('email');
  $gender = $input->post('gender');
  
  $reg_date = date('Y-m-d');
  $password = $input->post('password');
  $c_password = $input->post('c_password');

  /*
  * Form validatin starts 
  */
  $form_validation->set_rules('name','Name','required','Please enter name');
  $form_validation->set_rules('email','Email','required|valid_email','');
  $form_validation->set_rules('phone','Phone','required|valid_phone','');
  $form_validation->set_rules('password','Password','required','');
  $form_errors =  $form_validation->run();

  if ( $password  !=   $c_password ){
      $form_errors['c_password'] = 'Mismatch in password confirmation !';
  }
  if( count($form_errors) >0 ){
      $process = 'FORM';
      goto htmlView;

  }else{

    $sql = "INSERT INTO `users`( `role`, `name`, `email`, `password`, `status`) VALUES ('2','". $name."','". $email."','". $password."','1')";
    $db->execute($sql);
    $user_id = $db->get_insert_id();
    $sql = "INSERT INTO `customers`(`user_id`, `name`, `address`, `phone`, `email`, `gender`, `reg_date`) VALUES ('".$user_id."','".$name."','".$address."','".$phone."','".$email."','".$gender."','".$reg_date."')";

    if ( $db->execute($sql) ){
        $session->set_flashdata('msg',alert('Registration successfully completed','success'));
    }else{
        $session->set_flashdata('msg',alert('Could n\'t save the data !','danger'));
    }   
    redirect('register.php');

  }

}
htmlView:
include_once 'header.php';
?>
<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="margin-top: 50px;min-height: 600px">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>Registraion</span></h3>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                 <?= $session->get_flashdata('msg') ?>

            </div>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2" style="padding: 20px 15px">
            <a href="<?= base_url('login.php') ?>"  >Already Registered ( Login )</a>
          </div>
        </div>
        
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 offset-lg-2">
            <div class="box-1">
              <form action="<?= base_url("register.php") ?>" method ="post">
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" value="<?= $name  ?>" >
                    <?= form_error('name') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Address</label>
                  <div class="col-sm-10">
                    <textarea name="address" class="form-control" ><?= $address  ?></textarea>
                    <?= form_error('address') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control numeric" name="phone" value="<?= $phone  ?>" >
                    <?= form_error('phone') ?>
                  </div>
                </div>
                
                
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Gender</label>
                  <div class="col-sm-5">
                    <label style="margin-right: 20px">
                      <input type="radio" name="gender" value="Male" <?= $gender == 'Male' ? 'checked="checked"' : ''  ?> > Male
                    </label>
                    <label style="margin-right: 20px">
                      <input type="radio" name="gender" value="Female" <?= $gender == 'Female' ? 'checked="checked"' : ''  ?>> Female
                    </label>
                    <label style="margin-right: 20px">
                      <input type="radio" name="gender" value="Other" <?= $gender == 'Other' ? 'checked="checked"' : ''  ?>> Other
                    </label>
                    <?= form_error('gender') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="<?= $email  ?>" autocomplete="false" >
                    <?= form_error('email') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" >
                    <?= form_error('password') ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" name="c_password" class="form-control" >
                    <?= form_error('c_password') ?>
                  </div>
                </div>


                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-5">
                    <button type="submit" name="btnRegister" class="btn btn-success">Register</button>
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