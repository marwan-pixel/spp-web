<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover">
      <!-- favicons -->
      <link rel="apple-touch-icon" href="<?= base_url();?>/assets/img/favicon-apple.png">
      <link rel="icon" href="<?= base_url();?>/assets/img/Yayasan Ar-Rahmah.jpeg">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <!-- Bootstrap CSS -->
      <!-- <link rel="stylesheet" href="assets/vendor/bootstrap-4.1.3/css/bootstrap.min.css"> -->
      <!-- Material design icons CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/materializeicon/material-icons.css">
      <!-- animate CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/animatecss/animate.css">
      <!-- swiper carousel CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/swiper/css/swiper.min.css">
      <!-- daterange CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/bootstrap-daterangepicker-master/daterangepicker.css">
      <!-- footable CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/footable-bootstrap/css/footable.bootstrap.min.css">
      <!-- Bootstrap tour CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/bootstrap_tour/css/bootstrap-tour-standalone.css">
      <!-- jvector map CSS -->
      <link rel="stylesheet" href="<?= base_url();?>/assets/vendor/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
      <!-- app CSS -->
      <link id="theme" rel="stylesheet" href="<?= base_url();?>/assets/css/dark-greensidebar.css" type="text/css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
      <title>SPP Web</title>
   </head>
   <body class="fixed-header sidebar-right-close">
   <?php
    if(!$this->session->userdata('id')) {
        redirect('login');
    }
   ?>
         <!-- main header -->
         <header class="main-header">
            <div class="container-fluid">
               <nav>
                  <div class="row align-items-center">
                     <div class="col-auto pl-0">
                        <button style="width:10vw;" class="btn success-gradient btn-icon" id="left-menu"><img class="img-fluid" height="40" width="60" src="<?= base_url();?>/assets/img/Yayasan Ar-Rahmah.jpeg" alt=""></button>
                        <a href="<?= base_url('/');?>" class="logo"><span class="text-hide-xs">Yayasan Islam Rahmatan Lil Alamin</span></a>
                     </div>
                     <div class="col text-center p-xs-0">
                     </div>
                     <div class="col-auto pr-0">
                        <div class="dropdown d-inline-block">
                           <a class="btn header-color-secondary btn-icon dropdown-toggle caret-none" href="#" role="button" id="dropdownmessage" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <i class="fa-solid fa-bell"></i>
                           <span class="status-number bg-danger text-white">9+</span>
                           </a>
                           <div class="dropdown-menu notification-dropdown align-center arrow-top pt-0" aria-labelledby="dropdownmessage">
                              <div class="arrow success-gradient"></div>
                              <div class="success-gradient py-3 text-center">
                                 <h5 class="mb-0">Messages</h5>
                                 <p class="mb-0">Just Recieved Messages</p>
                              </div>
                              <a href="#" class="media success-gradient-active new">
                                 <figure class="avatar avatar-40">
                                    <img src="assets/img/user3.png" alt="Generic placeholder image">
                                 </figure>
                                 <div class="media-body">
                                    <h5 class="my-0">Donald Costapor </h5>
                                    <small class="text-muted d-block mb-2">2:05 am</small>
                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</p>
                                 </div>
                              </a>
                           </div>
                        </div>
                        <div class="dropdown d-inline-block">
                           <a class="btn header-color-secondary dropdown-toggle username" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <figure class="userpic"><img src="<?=base_url();?>/assets/img/user1.png" alt=""></figure>
                              <h5 class="text-hide-xs">
                                 <small class="header-color-secondary">Welcome,</small>
                                 <span class="header-color-success"><?= $name; ?></span>
                              </h5>
                           </a>
                           <div class="dropdown-menu dropdown-menu-right profile-dropdown" aria-labelledby="dropdownMenuLink">
                              <a href="<?= site_url('dataadmin'); ?>" class="dropdown-item">
                                 <div class="row align-items-center">
                                    <div class="col">
                                       Informasi
                                    </div>
                                    <div class="col-auto">
                                       <div class="text-danger ml-2">
                                          <i class="material-icons icon">person</i>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                              <div class="dropdown-divider m-0"></div>
                              <a class="dropdown-item" href="<?= base_url('User/logout'); ?>">
                                 <div class="row align-items-center">
                                    <div class="col">
                                       Logout
                                    </div>
                                    <div class="col-auto">
                                       <div class="text-danger ml-2">
                                          <i class="fa-solid fa-right-from-bracket"></i>
                                       </div>
                                    </div>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </nav>
            </div>
         </header>
         <!-- main header ends -->
      <div class="wrapper">
         <!-- sidebar left -->
         <div class="sidebar sidebar-left" style="background: #22B07D;">
            <ul class="nav flex-column">
               <li class="nav-item">
                  <a href="<?= base_url(); ?>" class="nav-link dropdwown-toggle "> <i class="material-icons icon">dashboard</i> <span>Dashboard</span></a>
               </li>
               <p class="ml-3 mt-3 mb-2 pt-2 pb-2 border-bottom border-top ">Menu</p>
               <li class="nav-item">
                  <a href="javascript:void(0);" class="nav-link dropdwown-toggle"> <i class="material-icons icon">folder</i> <span>Master Data</span><i class="material-icons icon arrow">expand_more</i></a>
                  <ul class="nav flex-column">
                     <!-- <li class="nav-item">
                        <a href="<?= base_url('pages'); ?>" class="nav-link success-gradient-active"><i class="material-icons icon">monetization_on</i> <span>Data Biaya</span> </a>
                     </li> -->
                     <li class="nav-item">
                        <a href="<?= base_url(''); ?>pages/datakelas" class="nav-link success-gradient-active"><i class="material-icons icon">group</i> <span>Data Kelas</span> </a>
                     </li>
                     <li class="nav-item">
                        <a href="<?= base_url(''); ?>pages/datasiswa" class="nav-link success-gradient-active"><i class="material-icons icon">person</i> <span>Data Siswa</span></a>
                     </li>
                     <!-- <li class="nav-item">
                        <a href="" class="nav-link success-gradient-active"><i class="material-icons icon">person_pin</i> <span>Data Administrator</span> </a>
                     </li> -->
                  </ul>
               </li>
               <li class="nav-item">
                  <a href="<?= base_url('pages/datatransaksi'); ?>" class="nav-link dropdwown-toggle "> <i class="material-icons icon">folder</i> <span>Transaksi</span></a>
               </li>
            </ul>
         </div>
         <!-- sidebar left ends -->
         
         <!-- content page title --> 
            <div class="container-fluid bg-light-opac">
               <div class="row">
                  <div class="container-fluid my-3 main-container">
                     <div class="row align-items-center">
                        <div class="col d-flex justify-content-between">
                           <h2 class="content-color-success page-title"><?= $title;?></h2>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- content page title ends -->