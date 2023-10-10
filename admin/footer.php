                <footer>
                    <p>All right reserved.: <a href="#"><?=  get_appname() ?></a></p>
                </footer>
            </div>
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="<?= base_url('assets/admin/js/jquery-1.10.2.js')?>"></script>
    <!-- Bootstrap Js -->
    <script src="<?= base_url('assets/admin/js/bootstrap.min.js')?>"></script>
	 
    <!-- Metis Menu Js -->
    <script src="<?= base_url('assets/admin/js/jquery.metisMenu.js')?>"></script>
    <!-- Morris Chart Js -->
    <script src="<?= base_url('assets/admin/js/morris/raphael-2.1.0.min.js')?>"></script>
    <script src="<?= base_url('assets/admin/js/morris/morris.js')?>"></script>
	
	
	<script src="<?= base_url('assets/admin/js/easypiechart.js')?>"></script>
	<script src="<?= base_url('assets/admin/js/easypiechart-data.js')?>"></script>
	
	 <script src="<?= base_url('assets/admin/js/Lightweight-Chart/jquery.chart.js')?>"></script>
	
    <!-- Custom Js -->
    <script src="<?= base_url('assets/admin/js/custom-scripts.js')?>"></script>
    <script src="<?= base_url('assets/admin/plugins/ckeditor4/ckeditor.js')?>"></script>

    <script>
        $( document ).ajaxStart(function() {
          $( "#ajax-loader" ).show();
        });
        $( document ).ajaxComplete(function() {
          $( "#ajax-loader" ).hide();
        });
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