<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= get_appname() ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons --> 
  <link href="<?= base_url('assets/common/img/favicon32.png')?>" rel="icon">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/web/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/web/vendor/icofont/icofont.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/web/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/web/vendor/owl.carousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/web/vendor/venobox/venobox.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/web/vendor/aos/aos.css') ?>" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/web/css/style.css') ?>" rel="stylesheet">

  <!-- =======================================================
  * Template Name: BizLand - v1.2.1
  * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
<style type="text/css">
  #hero {
    width: 100%;
    margin-top: 100px;
    height: 70vh;

}
#hero:before {
    
    background: rgba(255, 255, 255, 0)  !important;
   
}
  p{
    margin-bottom: 3px !important;
  }
  .box-1{
    box-shadow: 0 0 30px rgb(214 215 216 / 40%);
    padding: 30px;
  }
  .form-control{
     border-radius: 0  !important;
  }
   .error{
      color: red;
    }
    #ajax-loader {
        position:fixed;
        width:100%;
        left:0;right:0;top:0;bottom:0;
        background-color: rgba(255,255,255,0.7);
        z-index:9999;
        display:none;
    }
    @-webkit-keyframes spin {
        from {-webkit-transform:rotate(0deg);}
        to {-webkit-transform:rotate(360deg);}
    }

    @keyframes spin {
        from {transform:rotate(0deg);}
        to {transform:rotate(360deg);}
    }
    #ajax-loader:after {
        content:'';
        display:block;
        position:absolute;
        left:48%;top:40%;
        width:40px;height:40px;
        border-style:solid;
        border-color:black;
        border-top-color:transparent;
        border-width: 4px;
        border-radius:50%;
        -webkit-animation: spin .8s linear infinite;
        animation: spin .8s linear infinite;
    }
</style>
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="<?= base_url() ?>"><img src="<?= base_url('assets/common/img/logo.png') ?>" style="width: 150px"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt=""></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?= base_url() ?>">Home</a></li>
          <li><a href="<?= base_url('about.php') ?>">About</a></li>
          <li><a href="<?= base_url('services.php') ?>">Services</a></li>
          <li><a href="<?= base_url('staffs.php') ?>">Our Barber</a></li>
          <li><a href="<?= base_url('appointments.php') ?>">Appointment</a></li>
          <li><a href="<?= base_url('enquiry.php') ?>">Enquiry</a></li>
          <?php
          $customer_id = (int)$session->get_userdata('customer_id');
          $customer = $db->get_row('customers',array('id' => $customer_id));
          if ( $customer != null){
          ?>
          <li class="drop-down"><a href=""><?= $customer->name ?></a>
            <ul>
            
              <li><a href="<?= base_url('my-appointments.php') ?>">My-Appointments</a></li>
              <li><a href="<?= base_url('change-password.php') ?>">Change Password</a></li>
              <li><a href="<?= base_url('login.php?logout=1') ?>">Logout</a></li>
            </ul>
          </li>
        <?php }else{ ?>
          <!-- <li><a href="<?= base_url('register.php') ?>">Register</a></li> -->
          <li><a href="<?= base_url('login.php') ?>">Login</a></li>
        <?php } ?>
        </ul>
      </nav><!-- .nav-menu -->
    </div>
  </header><!-- End Header -->
   