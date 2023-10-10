<?php
include_once 'config/config.php';
$email ="";
if (isset ($_POST['btnLogin'])){
    $email = $input->post('email');
    $password = $input->post('password');
    $where =  array(
        'email' => $email , 
        'password' => $password , 
    );
    $user = $db->get_row('users',$where );
    if (  $user  ){
        if ( $user->role == '1' ){
          $session->set_userdata('admin_userid',$user->id);
          $session->set_userdata('admin_name',$user->name);
          redirect('admin/');
        }else if ( $user->role == '2'){
          $where =  array(
            'user_id' => $user->id, 
          );
          $customer = $db->get_row('customers',$where );
          if  ( $customer  ){
            $session->set_userdata('user_id',$user->id);
            $session->set_userdata('customer_id',$customer->id);
            redirect(''); 
          }else{
            $session->set_flashdata('msg',alert('Invalid email or password !','danger'));
          }
        }
    }else{
        $session->set_flashdata('msg',alert('Invalid email or password !','danger'));
    }
}

$logout = $input->get('logout');
if ( $logout == '1' ){
    $session->unset_userdata('admin_userid');
    $session->unset_userdata('admin_name');

    $session->unset_userdata('customer_id');
    redirect('login.php');
}
htmlView:
include_once 'header.php';
?>
<!-- ======= Contact Section ======= -->
    <section id="contact" class="contact" style="margin-top: 50px;min-height: 600px">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h3><span>Login</span></h3>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2" >
                 <?= $session->get_flashdata('msg') ?>

            </div>
        </div>
        <div class="row">
          <div class="col-lg-8 offset-lg-2" style="padding: 20px 15px">
            <a href="<?= base_url('register.php') ?>"  >Not registered yet ( Register Now )</a>
          </div>
        </div>
        
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-8 offset-lg-2">
            <div class="box-1">
              <form action="<?= base_url("login.php") ?>" method ="post">
                <div class="form-group row">
                  <label  class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" value="<?= $email  ?>" >
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
                  <label  class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-5">
                    <button type="submit" name="btnLogin" class="btn btn-success">Login</button>
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