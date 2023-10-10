<?php
require_once 'config/config.php';


if ( !empty ( $_POST )){
    $appointment_id = isset($_POST['udf1']) ? isset($_POST['udf1']) : 0;
    $status= isset($_POST['status']) ? isset($_POST['status']) : 0;
    if (    $status == 'success'  ){
        $q = "UPDATE appointments SET `payment_status`='1' WHERE id='".$appointment_id."'";
        $session->set_flashdata('msg',alert('Payment was successfull!','success'));
        $db->execute( $q );
    }else{
        $session->set_flashdata('msg',alert('Payment was not successfull,Retry again!','danger'));
        redirect('payment.php?appointment_id='.$appointment_id);
    }
    
}
include_once 'header.php';

?>

<div class="courses1-area">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12" >
                <h2 class="content-title">Order Status</h2>
            </div> 
        </div>
    </div>
	<div class="container" style="min-height: 400px">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center appointment_complete">
                	<i class="fas fa-check"></i>
                    <div class="heading_s1">
                  	<h3>Your appointment is completed!</h3>
                    </div>
                  	<p>Thank you for your appointment! Your appointment is being processed and will be completed within 3-6 hours. You will receive an email confirmation when your appointment is completed.</p>
                    <a href="<?= base_url('index.php') ?>" class="btn btn-success">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION SHOP -->
<?php
include_once 'footer.php';
?>