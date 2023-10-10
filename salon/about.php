<?php
include_once 'config/config.php';
include_once 'header.php';
$whrere = [];
$order_by = array(
    'name' => 'ASC' , 
);
$services = $db->get('services', $whrere, $order_by);
$about = $db->get_row('web_contents', ['ref_key' => 'ABOUT']);


?>


    <?php if ( $about != null ){?>
    <section id="about" class="about section-bg" style="margin-top:100px">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $about->title ?></h2>
          <h3>Find Out More <span>About Us</span></h3>
          
        </div>

        <div class="row">
          <?php if ( $about->image  != '' ){?>
          <div class="col-lg-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="<?= base_url($about->image) ?>" class="img-fluid" alt="">
          </div>
          <?php } ?>
          <div class="<?= $about->image  != ''? 'col-lg-6' : 'col-lg-12' ?> pt-4 pt-lg-0 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <?= $about->details ?>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
    <?php } ?>
  </main><!-- End #main -->

<?php
include_once 'footer.php';
?>

