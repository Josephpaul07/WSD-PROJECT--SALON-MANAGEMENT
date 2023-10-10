<?php
require_once '../config/config.php';
if (isset ($_POST['btnLogin'])){
    $email = $input->post('email');
    $password = $input->post('password');
    $where =  array(
        'email' => $email , 
        'password' => $password , 
        'role' => '3', 
    );
    $staff = $db->get_row('users',$where );

   
    if (  $staff  ){
        $session->set_userdata('staff_userid',$staff->id);
        $session->set_userdata('staff_name',$staff->name);
        redirect('staff/');
    }else{
        $session->set_flashdata('msg',alert('Invalid email or password !','danger'));
    }
}

$logout = $input->get('logout');
if ( $logout == '1' ){
    $session->unset_userdata('staff_userid');
    $session->unset_userdata('staff_name');
    redirect('staff/login.php');
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= get_appname() ?></title>
    <!-- Bootstrap Styles-->
    <link href="<?= base_url('assets/admin/css/bootstrap.css') ?>" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="<?= base_url('assets/admin/css/font-awesome.css') ?>" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="<?= base_url('assets/admin/js/morris/morris-0.4.3.min.css') ?>" rel="stylesheet" />
    <!-- Custom Styles-->
    <style type="text/css">
        .btn {
            border-radius: 0px;
        }
        .form-control {
            border-radius: 0px;
        }
    </style>
   
</head>

<body style="background-color: #ababab33">
    
    <div id="login-wrapper" style="width: 450px; margin-left:  auto;margin-right:  auto;padding: 100px 0px ">

       

        <div id ="login-box" style=" padding: 20px;border:1px solid #333; box-shadow: 10px 10px 8px #888888;background-color:#fff">


            <div class="row">
                <div class="col-sm-12">
                    <?= $session->get_flashdata('msg')?>
                </div>
            </div>
             
            <div id="page-header" style="padding: 20px 0px">
                <h2 class="text-center" style="margin-top: 10px"><i class="fa fa-user"></i> Login (Staff)</h2>
            </div>

            <form class="form-horizontal" action="<?= base_url('staff/login.php') ?>" method="post">
              <div class="form-group">
                <label class="control-label col-sm-3"  >Email:</label>
                <div class="col-sm-9">
                  <input type="email" class="form-control"  name="email" >
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" >Password:</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" name="password"  >
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <div class="checkbox">
                     <button type="submit" class="btn btn-primary" name="btnLogin">Submit</button>
                  </div>
                </div>
              </div>
            </form>
            <p>All right reserved.: <a href="#"><?=  get_appname() ?></a></p>

        </div>
     
    
        
    </div>


        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
</div>
<!-- /. WRAPPER  -->
<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="<?= base_url('assets/admin/js/jquery-1.10.2.js')?>"></script>
<!-- Bootstrap Js -->
<script src="<?= base_url('assets/admin/js/bootstrap.min.js')?>"></script>
 
</body>

</html>