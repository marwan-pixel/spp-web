        
    </div>
    <footer class="sticky-footer bg-white border-top">
        <div class="row footer">
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
        max-width: 600px;
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
                            intro: 'Pada bagian sidebar inilah tempat di mana admin mengelola data. ',      
                            element: document.querySelector('.sidebar'),
                        },
                        {
                            intro: `Bagian footer di bawah untuk menunjukkan bahwa aplikasi pengelolaan SPP ini 
                            milik Yayasan Islam Rahmatan Lil Alamin`,      
                            element: document.querySelector('.footer'),
                        },
                        {
                            element: document.querySelector(' .info'),
                            intro: 'Jika ingin melihat / mengubah profil atau logout, bisa mengklik pada bagian ini',      
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
                let intro = introJs();
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

            $('.instansi-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Instansi',
                            intro: `Ini adalah halaman yang menampilkan data instansi sekolah. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.instansi-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        },
                        {
                            element: '.instansi-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                            position: 'left'
                        }
                    ]
                });
                intro.start();
            });

            $('.kelas-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Kelas',
                            intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data kelas sekolah. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.kelas-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        }
                        ,
                        {
                            element: '.instansi-kelas',
                            intro: `Pada tabel data kelas, terdapat instansi yang didapatkan dari tabel <b>Data Instansi</b> 
                            sekolah yang sudah ditambahkan sebelumnya.`,
                            position: 'left'
                        },
                        {
                            element: '.kelas-pagination',
                            intro: `<img src="<?= base_url();?>assets/img/pagination.png" />
                            <br>
                            Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
                            itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
                            berpindah ke halaman lainnya`,
                        },
                        {
                            element: '.kelas-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                            position: 'left'
                        }
                    ]
                });
                intro.start();
            });

            $('.thn-akademik-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Tahun Akademik',
                            intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data tahun akademik sekolah. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.thn-akademik-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        },
                        {
                            element: '.thn-akademik-pagination',
                            intro: `
                            <img src="<?= base_url();?>assets/img/pagination.png" />
                            <br>
                            Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
                            itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
                            berpindah ke halaman lainnya`,
                        },
                        {
                            element: '.thn-akademik-status',
                            intro: `Pada kolom <b>Status</b> di bawah ini, terdapat dua status: <b>Aktif</b>
                            (Tahun Akademik yang saat ini berjalan) dan <b>Tidak Aktif</b> (Tahun Akademik yang
                             sudah berlalu atau yang akan datang)`,
                            position: 'left'
                        },
                        {
                            element: '.thn-akademik-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                            position: 'left'
                        },
                    ]
                });
                intro.start();
            });

            $('.siswa-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Siswa',
                            intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data siswa sekolah. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.siswa-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        },
                        {
                            element: '.siswa-add-excel',
                            intro: `Ada opsi lain untuk menambahkan data secara batch, yakni dengan meng-upload
                             file spreadsheet (Excel).`
                        },
                        {
                            element: '.siswa-cari',
                            intro: `Untuk memudahkan pencarian nama siswa, bisa melakukan pencarian di sini 
                            dengan mengetikkan nama siswa.`
                        },
                        {
                            element: '.siswa-kelas',
                            intro: `Pada kolom <b>Kelas</b> di bawah ini, data didapatkan dari <b>Data Kelas</b> 
                            yang ditambah atau diubah.`
                        },
                        {
                            element: '.siswa-thn-akademik',
                            intro: `Pada kolom <b>Tahun Akademik</b> di bawah ini, data didapatkan dari 
                            <b>Data Tahun Akademik</b> yang ditambah atau diubah. Jika status siswa tidak aktif
                            tidak perlu mengganti ke tahun akademik yang statusnya aktif.`
                        },
                        {
                            element: '.siswa-status',
                            intro: `kolom <b>Status</b> di sini berbeda dengan yang ada di tabel <b>Data Tahun Akademik</b>
                            . Aktif di sini menandakan bahwa siswa adalah peserta didik aktif atau tidak.
                            <br><br>
                            Jika status masih aktif,
                            wajib mengganti tahun akademik yang lama ke yang statusnya aktif.`
                        },
                        {
                            element: '.siswa-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                            position: 'left'
                        },
                        {
                            element: '.siswa-pagination',
                            intro: `
                            <img src="<?= base_url();?>assets/img/pagination.png" />
                            <br>
                            Setiap halaman akan memuat sepuluh data dalam tabel, sehingga ketika ada lebih dari 
                            itu akan muncul sebuah tombol <b>Pagination</b> seperti pada gambar di atas untuk 
                            berpindah ke halaman lainnya`,
                        },
                    ]
                });
                intro.start();
            });

            $('.admin-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Admin',
                            intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data administrator yang 
                            mengurus aplikasi SPP ini. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.admin-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        },
                        {
                            intro: `Di sini tidak ada kolom <b>Aksi</b> yang terdapat tombol <b>Ubah</b> karena untuk
                            mengubah data admin. Admin yang bersangkutan haruslah login terlebih dahulu lalu masuk ke 
                            <b>Informasi</b> untuk mengubah data.`,
                            position: 'center'
                        }
                    ]
                });
                intro.start();
            });

            $('.biaya-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Biaya',
                            intro: `Ini adalah halaman yang menambah, mengubah, serta menampilkan data biaya sekolah. 
                            Terdapat sebuah tabel di mana data instansi akan disajikan`
                        },
                        {
                            element: '.biaya-add',
                            intro: `Jika ingin menambahkan data, klik tombol <b>Tambah Data</b> untuk menampilkan 
                            sebuah form.`
                        },
                        {
                            element: '.biaya-instansi',
                            intro: `kolom <b>Data Instansi</b> berarti bahwa jumlah biaya ditentukan berdasarkan instansi
                            masing - masing.`,
                            position: 'left'
                        },
                        {
                            element: '.biaya-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                        }
                    ]
                });
                intro.start();
            });

            $('.transaksi-btn').click(function(){
                let intro = introJs();
                intro.setOptions({
                    tooltipClass: 'introjs-tooltip',
                    steps: [
                        {
                            title: 'Data Transaksi',
                            intro: `Ini adalah halaman Data Transaksi. Semua data transaksi yang dikirimkan dari aplikasi
                            mobile akan disajikan pada sebuah tabel. Tetapi data transaksi yang ditampilkan hanya didapatkan
                            dari satu orang siswa.`
                        },
                        {
                            element: '.cari-siswa',
                            intro: `Untuk menampilkan data transaksi, ketikkan nama atau nipd yang bersangkutan di sini. Nanti 
                            akan muncul sebuah biodata siswa seperti pada gambar di bawah.
                            <br>
                            <img src="<?= base_url();?>assets/img/transaksi.png" />`
                        },
                        {
                            element: '.cari-siswa',
                            intro: `Di bawah tabel biodata siswa, inilah tabel di mana data transaksi disajikan. (Contoh di bawah
                            ini adalah tabel yang belum menampilkan data transaksi karena belum dikirimkan oleh orang tua siswa) 
                            <br>
                            <img src="<?= base_url();?>assets/img/transaksi-2.png" />`,
                            position: 'left'
                        },
                        {
                            element: '.cari-siswa',
                            intro: `Contoh di bawah ini adalah tabel yang menampilkan data transaksi yang telah dikirimkan oleh orang tua siswa
                            , di situ terdapat sebuah tombol dengan tulisan <b>Ditunggu</b> yang di mana data transaksi orang tua siswa harus di
                            konfirmasi oleh admin agar datanya diterima. Jika diterima, maka jumlah nominal transaksi yang masuk akan dikalkulasikan
                            ke <b>Nominal Masuk</b>.
                            <br>
                            <img src="<?= base_url();?>assets/img/transaksi-3.png" />`,
                            position: 'left'
                        },
                        {
                            element: '.cari-siswa',
                            intro: `Contoh di bawah ini adalah tabel yang menampilkan data transaksi yang telah dikirimkan oleh orang tua siswa
                            , di situ terdapat sebuah tombol dengan tulisan <b>Ditunggu</b> yang di mana data transaksi orang tua siswa harus di
                            konfirmasi oleh admin agar datanya diterima. Jika diterima, maka jumlah nominal transaksi yang masuk akan dikalkulasikan
                            ke <b>Nominal Masuk</b>.`,
                            position: 'left'
                        },
                        {
                            element: '.biaya-update',
                            intro: `Setelah data ditambahkan, pada kolom Aksi akan ada tombol <b>Ubah</b> dengan 
                            jumlah yang sesuai dengan banyaknya baris pada tabel untuk mengubah data jika diperlukan.`,
                        }
                    ]
                });
                intro.start();
            });
        });
    </script>
</body>

</html>