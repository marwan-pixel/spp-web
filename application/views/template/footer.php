        
    </div>
    <footer class="sticky-footer bg-white border-top">
        <div class="row">
            <div class="container my-3 main-container">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy Tumpas Jaya</span> 
                    </div>
            </div>
        </div>
    </footer>

    <!-- modal for create form ends-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>

    <script src="<?= base_url();?>/assets/js/popper.min.js"></script>
    <script src="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>

    <!-- Cookie jquery file -->
    <script src="<?= base_url();?>/assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="<?= base_url();?>/assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="<?= base_url();?>/assets/vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Swiper carousel jquery file -->
    <script src="<?= base_url();?>/assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- Chart js jquery file -->
    <script src="<?= base_url();?>/assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="<?= base_url();?>/assets/vendor/chartjs/utils.js"></script>

    <!-- Footable jquery file -->
    <script src="<?= base_url();?>/assets/vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- datepicker jquery file -->
    <script src="<?= base_url();?>/assets/vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="<?= base_url();?>/assets/vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>

    <!-- jVector map jquery file -->
    <script src="<?= base_url();?>/assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="<?= base_url();?>/assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Bootstrap tour jquery file -->
    <script src="<?= base_url();?>/assets/vendor/bootstrap_tour/js/bootstrap-tour-standalone.min.js"></script>

    <!-- jquery toast message file -->
    <script src="<?= base_url();?>/assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="<?= base_url();?>/assets/js/main.js"></script>

    <!-- page specific script -->
    <script src="<?= base_url();?>/assets/js/dashboard.js"></script>

    <!-- page specific script -->
    <script>
        "use script";
        $(window).on('load', function() {
            var tour = new Tour({
                steps: [{
                    element: "#left-menu",
                    title: "Main Menu",
                    content: "Access the demo pages from sidebar",
                    smartPlacement: true,
                    storage:false
                }, {
                    element: "button[data-target='#createOrder']",
                    title: "Creative Form",
                    content: "See beautifully designed form in modal",
                    smartPlacement: true,
                    placement: "left",
                    storage:false

                }, {
                    element: ".close-sidebar",
                    title: "Customizaton Menu",
                    content: "Customize your Layout style",
                    smartPlacement: true,
                    placement: "left",
                    storage:false

                }]

            });

            // Initialize the tour
            tour.init();

            // Start the tour
            tour.start();
        });
        
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                "order": [
                    [3, "desc"]
                ]
            });
        });
    </script>
</body>

</html>