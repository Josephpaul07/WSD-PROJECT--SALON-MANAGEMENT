 <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container py-4">
      <div class="copyright">
        &copy; Copyright <strong><span><?= get_appname() ?></span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/web/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/jquery.easing/jquery.easing.min.js') ?>"></script>
  
  <script src="<?= base_url('assets/web/vendor/waypoints/jquery.waypoints.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/counterup/counterup.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/owl.carousel/owl.carousel.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/isotope-layout/isotope.pkgd.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/venobox/venobox.min.js') ?>"></script>
  <script src="<?= base_url('assets/web/vendor/aos/aos.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/web/js/main.js') ?>"></script>
  <script type="text/javascript">
    $(document).on("keypress","input.numeric",function(evt){
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    });
    $(document).on("keypress","input.float",function(evt){
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if(ASCIICode == 46){
            if($(this).val().indexOf('.') != -1) {
                return false;
            }
        }else if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    });
  </script>
</body>

</html>