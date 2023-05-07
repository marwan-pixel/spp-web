<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link rel="apple-touch-icon" href="<?= base_url();?>/assets/img/favicon-apple.png">
      <link rel="icon" href="assets/img/Yayasan Ar-Rahmah.jpeg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/css/bootstrap.min.css">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/vendor/materializeicon/material-icons.css">

    <!-- animate CSS -->
    <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/animatecss/animate.css">
    <link id="theme" rel="stylesheet" href="<?= base_url();?>/assets/css/purplesidebar.css" type="text/css">
</head>
<body class="fixed-header" style="display:flex; align-items:center;background: #22B07D">
    <div class="container">
        <div class="card mx-auto col-lg-5">
            <div class="container-md">
                <div class="card-body">
                    <form class="mt-3 needs-validation" method="post" action="<?= site_url('registrasi');?>">
                        <div class="form-group" style="display:flex; justify-content:center;">
                            <img src="<?= base_url(); ?>/assets/img/Yayasan Ar-Rahmah.jpeg" alt="" width="110" height="80" srcset="">
                        </div>
                        <div class="form-group mb-3">
                            <h4 class="text-center font-weight-light">Registrasi</h4>
                        </div>
                        <div class="form-group ml-3 mr-3 was-validation" >
                            <label for="exampleInputUsername1">ID</label>
                            <input value="<?= set_value('id'); ?>" type="text" class="form-control" name="id" id="exampleInputUsername1" aria-describedby="emailHelp" >
                            <?= form_error('id','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                           <div class="form-group ml-3 mr-3 was-validation" >
                            <label for="exampleInputUsername1">Nama</label>
                            <input value="<?= set_value('nama'); ?>" type="text" class="form-control" name="nama" id="exampleInputUsername1" aria-describedby="emailHelp" >
                            <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ml-3 mr-3 has-validation">
                            <label for="exampleInputPassword1">Password</label>
                            <input value="<?= set_value('password'); ?>" type="password" class="form-control" name="password" id="exampleInputPassword1">
                            <?= form_error('password','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ml-3 mr-3 has-validation">
                            <label for="exampleInputPassword1">Konfirmasi Password</label>
                            <input value="<?= set_value('conf_password'); ?>" type="password" class="form-control" name="conf_password" id="exampleInputPassword1">
                            <?= form_error('conf_password','<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                        <div class="form-group ml-3 mr-3">
                            <button type="submit" class="btn btn-block btn-success">Registrasi</button>
                        </div>
                        <div class="form-group mb-3">
                            <h6 class="text-center font-weight-light">Sudah memiliki akun?</h6>
                        </div>
                        <div class="form-group ml-3 mr-3">
                            <a href="<?= site_url('login');?>" class="btn btn-block btn-primary">Kembali ke Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</body>
</html>