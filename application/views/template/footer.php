        
    </div>
    <footer class="sticky-footer bg-white border-top">
        <div class="row">
            <div class="container my-3 main-container">
                    <div class="copyright text-center">
                        <span>Copyright &copy Tumpas Jaya</span> 
                    </div>
            </div>
        </div>
    </footer>

    <!-- modal for create form ends-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?= base_url();?>assets/js/popper.min.js"></script>
    <!-- <script src="<?= base_url();?>/assets/vendor/bootstrap-4.1.3/js/bootstrap.min.js"></script> -->
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" ></script>
    <!-- Cookie jquery file -->
    <script src="<?= base_url();?>assets/vendor/cookie/jquery.cookie.js"></script>

    <!-- sparklines chart jquery file -->
    <script src="<?= base_url();?>assets/vendor/sparklines/jquery.sparkline.min.js"></script>

    <!-- Circular progress gauge jquery file -->
    <script src="<?= base_url();?>assets/vendor/circle-progress/circle-progress.min.js"></script>

    <!-- Footable jquery file -->
    <script src="<?= base_url();?>assets/vendor/footable-bootstrap/js/footable.min.js"></script>

    <!-- jVector map jquery file -->
    <script src="<?= base_url();?>assets/vendor/jquery-jvectormap/jquery-jvectormap.js"></script>
    <script src="<?= base_url();?>assets/vendor/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intro.js@7.0.1/intro.min.js"></script>
    <!-- jquery toast message file -->
    <script src="<?= base_url();?>assets/vendor/jquery-toast-plugin-master/dist/jquery.toast.min.js"></script>

    <!-- Application main common jquery file -->
    <script src="<?= base_url();?>assets/js/main.js"></script>

    <!-- page specific script -->
    <style>
        .introjs-overlay {
        background-color: rgba(0, 0, 0, 0.5);
        }

        /* Customize the tooltip */
        .introjs-tooltip {
        width: 600px;
        height: auto;
        padding: 5px;
        }

        /* Customize the next button */
        .introjs-nextbutton {
        background-color: #007bff;
        color: #fff;
        padding: 8px 12px;
        border-radius: 4px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('.about').click(function(){
                var intro = introJs().setOptions({
                    autoPosition: true,
                    steps: [
                        {
                            title: 'Tentang Aplikasi',
                            intro: 'Aplikasi ini adalah aplikasi pengelolaan SPP untuk membantu memudahkan administrator atau bendahara dalam mengelola SPP',
                            position: 'center'
                        },
                        {
                            intro: 'Ini adalah bagian header pada aplikasi',
                            element: document.querySelector('.main-header'),
                            positon: 'center'
                        },
                        {
                            element: document.querySelector(' .info'),
                            intro: 'Jika ingin melihat / mengubah profil atau logout, bisa mengklik pada bagian ini',      
                        },
                        {
                            intro: 'Pada bagian sidebar ini berfungsi sebagai tempat mengelola data, ',      
                            element: document.querySelector('.sidebar'),
                        },
                        {
                            intro: `Dan di sini merupakan halaman di mana informasi ditampilkan, seperti contoh pada halaman dashboard
                                    menampilkan informasi utama.`,      
                            element: document.querySelector('.content'),
                        },
                    ],
                });
                intro.start();
            });

            $('.using').click(function(){
                var intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Penggunaan Aplikasi',
                            intro: `Aplikasi ini terintegrasi dengan aplikasi mobile milik orang tua siswa, proses kerjanya dimulai dari sini.
                            Admin menambahkan atau mengubah data yang tersedia pada sidebar kemudian data ini akan dikirimkan ke aplikasi mobile`,
                            position: 'center'
                        },
                        {
                            intro: 'Sidebar ini merupakan tempat untuk menambah serta mengubah data, terdapat folder Master Data dan Transaksi',      
                            element: document.querySelector('.sidebar'),
                        },
                    ],

                });
                intro.addStep({
                    element: document.querySelector('.master-data-ul'),
                    intro: 'Pada master data, terdapat Data Instansi, Data Kelas, Data Tahun Akademik, Data Siswa, dan Data Admin. Proses penambahan data di sini harus mengisi data dari yang paling atas hingga ke yang paling bawah (kecuali Data Admin)',
                }).onchange(function(targetElement) {
                    var currentStep = intro._introItems.findIndex(item => item.element === targetElement);
                    if(currentStep === 2) {
                        // Show the element
                        document.querySelector('.master-data-ul').style.display = 'block';
                        document.querySelector('.master-data-nav').classList.add('active');
                    } else {
                        document.querySelector('.master-data-ul').style.display = 'none';
                        document.querySelector('.master-data-nav').classList.remove('active');
                    }
                })
                intro.addStep(
                    {
                        element: document.querySelector('.transaksi-ul'),
                        intro: `Pada bagian transaksi, Data Biaya berfungsi untuk menentukan jumlah biaya setiap instansi lalu data ini akan dikirim ke aplikasi mobile. 
                        Sedangkan Data Transaksi berfungsi untuk menerima biaya SPP yang dikirimkan dari aplikasi mobile`,
                    },
                ).onbeforechange(function(targetElement) {
                    var currentStep = intro._introItems.findIndex(item => item.element === targetElement);
                    if(currentStep === 3){
                        // Show the element
                        document.querySelector('.transaksi-ul').style.display = 'block';
                        document.querySelector('.transaksi-nav').classList.add('active');
                    } else {
                        // hide the element
                        document.querySelector('.transaksi-ul').style.display = 'none';
                        document.querySelector('.transaksi-nav').classList.remove('active');
                    }
                }).onexit(function() {
                    document.querySelector('.master-data-ul').style.display = 'none';
                    document.querySelector('.master-data-nav').classList.remove('active');
                    document.querySelector('.transaksi-ul').style.display = 'none';
                    document.querySelector('.transaksi-nav').classList.remove('active');
                });
                intro.start();
            });
        });
    </script>
</body>

</html>