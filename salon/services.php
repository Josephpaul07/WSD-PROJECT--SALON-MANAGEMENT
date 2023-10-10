<?php
include_once 'config/config.php';
include_once 'header.php';
$whrere = [];
$order_by = array(
    'name' => 'ASC' , 
);
$services = $db->get('services', $whrere, $order_by);

?>
<!-- ======= Featured Services Section ======= -->
<main id="main" style="margin-top: 100px;min-height: 500px">
<section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Services</h2>
          <h3>Check our <span>Services</span></h3>
          
        </div>
        <div class="row">
          <?php foreach ($services as $key => $row) { ?>
          <div class="col-lg-3 col-md-6 " data-aos="zoom-in" data-aos-delay="100" style="    box-shadow: 0 0 29px 0 rgb(68 88 144 / 12%);
    transition: all 0.3s ease-in-out;
    border-radius: 8px;padding:10px;">
            <div class="">
              <?php $photo =  $row['image'] != '' ?   $row['image'] : 'assets/common/img/dummy-image.jpg';?>
              <img src="<?= base_url( $photo ) ?>" style="width:100%;max-height:200px;overflow:hidden;min-height:200px">
              <div class="text-center">
                <h4 style="margin:10px 0px;line-height:21px;"><a href=""><?=  $row['name'] ?></a></h4>
                <p><?=  $row['name'] ?></p>
                <p><?=  $row['description'] ?></p>
                <p><strong>Rs.<?=  $row['amount'] ?></strong> </p>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-7">
                <a href="<?= base_url('appointments.php?service_id='.$row['id']) ?>" class="btn btn-info btn-sm btn-block">Book Appoinment</a>
                </div>
                <div class="col-sm-5">
                <a href="<?= base_url('enquiry.php?service_id='.$row['id']) ?>" class="btn btn-warning btn-sm  btn-block" >Enquiry</a>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>
        

      </div>
    </section><!-- End Services Section -->

  </main>
<?php
include_once 'footer.php';
?>