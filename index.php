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
<!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style="background:url('<?= base_url('assets/web/img/slider-bg-1.jpg') ?>');">
    <div class="container" data-aos="zoom-out" data-aos-delay="100">
      <h1 style="color:#fff ;margin-bottom:50px"><?= get_appname() ?> </h1>
      
      <div class="d-flex">
        <a href="<?= base_url('register.php') ?>" class="btn-get-started scrollto">Register Now</a>
        
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
  	<!-- ======= About Section ======= -->
    <?php if ( $about != null ){?>
    <section id="about" class="about section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2><?= $about->title ?></h2>
        </div>
        <div class="row">
          <div class="col-lg-12 content d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="100">
            <p class="font-italic">
            <?= $about->breaf ?> <a href="<?= base_url('about.php') ?>">Read more.. </a>
            </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
    <?php } ?>
    
    
  </main><!-- End #main -->

<?php
include_once 'footer.php';
?>

