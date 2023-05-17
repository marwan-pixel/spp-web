        
    </div>
    <footer class="sticky-footer bg-white border-top">
        <div class="row">
            <div class="container my-1 main-container">
                <div class="col d-flex align-items-center justify-content-center">
                    <div class="copyright my-auto"><span>Copyright &copy Tumpas Jaya</p> </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- modal for create form ends-->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script>

    <!-- Cookie jquery file -->
    <script src="assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="assets/vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Swiper carousel jquery file -->
    <script src="assets/vendor/swiper/js/swiper.min.js"></script>

    <!-- Chart js jquery file -->
    <script src="assets/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="assets/vendor/chartjs/utils.js"></script>

    <!-- Footable jquery file -->
    <script src="assets/vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- datepicker jquery file -->
    <script src="assets/vendor/bootstrap-daterangepicker-master/moment.js"></script>
    <script src="assets/vendor/bootstrap-daterangepicker-master/daterangepicker.js"></script>

    <!-- jVector map jquery file -->
    <script src="assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>

    <!-- Bootstrap tour jquery file -->
    <script src="assets/vendor/bootstrap_tour/js/bootstrap-tour-standalone.min.js"></script>

    <!-- jquery toast message file -->
    <script src="assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="assets/js/main.js"></script>

    <!-- page specific script -->
    <script src="assets/js/dashboard.js"></script>

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

        $(document).ready(function() {
        // Untuk sunting
            $('#updateBiaya').on('show.bs.modal', function (event) {
                var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                var modal = $(this)

                    // Isi nilai pada field
                modal.find(`#instansi`).attr("value",div.data(`instansi`));
                modal.find(`#biaya`).attr("value",div.data(`biaya`));
            });
        });     
        
        $(document).ready(function () {
            $('#exampleModal').on('hide.bs.modal', function(event) {
                $(this).find('.text-danger');
            });

            $('#exampleModal').on('submit', 'form' , function (event) {
                event.preventDefault();

                var form = $(this);
                var instansi = form.find('input[name="instansi"]').val();
                var biaya = form.find('input[name="biaya"]').val();

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json' ,
                    success: function (response) {
 
                        if(response.success) {
                            window.location.href = response.redirect;
                            $('#exampleModal').modal('hide');
                        } else {                           
                            var errors = response.errors;
                            $.each(errors, function (field, message) {
                                let errorElement = $('#' + field + '-error');
                                errorElement.html(message);
                            })
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                })                
            })

            $('#exampleModalUpdate').on('hide.bs.modal', function(event) {
                $(this).find('.text-danger');
            });

            $('#exampleModalUpdate').on('submit', 'form' , function (event) {
                event.preventDefault();

                var form = $(this);
                var instansi = form.find('input[name="instansi"]').val();
                var biaya = form.find('input[name="biaya"]').val();

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: form.serialize(),
                    dataType: 'json' ,
                    success: function (response) {
 
                        if(response.success) {
                            window.location.href = response.redirect;
                            $('#exampleModalUpdate').modal('hide');
                        } else {                           
                            var errors = response.errors;
                            $.each(errors, function (field, message) {
                                let errorElement = $('#' + field + '-error');
                                errorElement.html(message);
                            })
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                })               
            })

        });
    </script>
</body>

</html>