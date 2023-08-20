
        <!-- content page -->
        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success mb-3 siswa-add" data-bs-toggle="modal" data-bs-target="#insertData">
                    Tambah Data
                    </button>
                    <button type="button" class="btn btn-success mb-3 siswa-add-excel" data-bs-toggle="modal" data-bs-target="#ExcelModal">
                    Tambah Data (Impor Dari Excel)
                    </button>
                    <!-- <button class="btn btn-secondary mb-3 ">
                        <i class="material-icons icon siswa-btn">help_outline</i>
                    </button> -->
                </div>

                <!-- Modal Untuk Insert Data Dari Excel -->
                <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="ExcelModal" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="ExcelModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="ExcelModalLabel">Data Siswa</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <h5><b> Petunjuk Singkat</b></h5>
                                    <div class="">
                                        <p>Penginputan data Siswa bisa dilakukan dengan mengcopy data dari file Ms. Excel. Format file excel harus sesuai kebutuhan aplikasi. 
                                            Silakan Klik pada tombol di sebelah kanan untuk melihat cara menggunakannya 
                                            <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#Information">Contoh Excel</a>
                                        </p>
                                    </div>
                                </div>

                                <form method="post" id="sample_form" enctype="multipart/form-data" action="<?=base_url('admin/tambahDataSiswaExcel');?>">
                                    <div class="form-group">
                                        <label for="file">File Input</label>
                                        <input type="file" class="form-control" required name="fileExcel" id="fileExcel" aria-describedby="fileExcel">
                                        <small class="text-danger" id="fileExcel-error"></small>
                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="exitfromExcel btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="excelSubmit btn btn-primary d-flex justify-content-center">
                                        Simpan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Informasi Cara Mengupload Data Melalui Excel -->
                <div class="modal fade bd-example-modal-lg" id="Information" tabindex="-1" role="dialog" aria-labelledby="myInformationLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="insertDataLongTitle">Contoh Mengupload Data Siswa Menggunakan Excel</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="img d-flex justify-content-center mb-2">
                                    <img src="<?= base_url();?>/assets/img/ContohExcel1.png" alt="">
                                </div>
                                <div class="img d-flex justify-content-center mb-2">
                                    <img src="<?= base_url();?>/assets/img/Sheet1.png" alt="">
                                </div>
                                <div class="explained">
                                    <p>Buat kolom tabel dengan jumlah kolom sesuai dengan yang ada di gambar, dimulai dari judul - judul:</p>
                                    <li><b>NIPD</b></li> 
                                    <li><b>Nama</b></li> 
                                    <li><b>Kelas</b></li> 
                                    <li><b>Tahun Akademik</b></li> 
                                    <li><b>Password</b></li>
                                    <li><b>Potongan</b></li>
                                    <br>
                                    <p>
                                        Untuk kolom judul, penulisan judul tidak harus sesuai dengan yang ada di gambar. Ukuran font, diberi <i>bold</i> atau tidak,
                                        penulisan secara <i>CAPSLOCK</i> atau tidak itu tergantung sesuai dengan keinginan. Untuk setiap kolom di bawah judul
                                        wajib diisi seperti yang ada di gambar, kecuali pada kolom potongan itu opsional boleh diisi atau dibiarkan saja kosong.
                                    </p>
                                    <p>
                                        Format penulisan potongan sama seperti layaknya uang rupiah (10 pada tabel di atas = Rp10). Untuk kolom <b>password</b>, 
                                        nilainya diketik sama seperti NIPD untuk digunakan pada aplikasi <i>mobile</i> (orang tua siswa).
                                    </p>
                                    <p>
                                        Selama pembuatan tabel data siswa, proses pembuatan bisa dilakukan dengan <i>sheet</i> yang berbeda. Seperti pada contoh 
                                        di bawah ini:
                                    </p>
                                </div>
                                 <div class="img d-flex justify-content-center mb-2">
                                    <img src="<?= base_url();?>/assets/img/ContohExcel2.png" alt="">
                                </div>
                                <div class="img d-flex justify-content-center mb-2">
                                    <img src="<?= base_url();?>/assets/img/Sheet2.png" alt="">
                                </div>
                                <div class="explained">
                                    <p>Format pembuatan tabel masih sama seperti pada <i>sheet</i> yang pertama. Jumlah <i>sheet</i> bisa ditambah sesuai keinginan.
                                        Hal ini untuk memudahkan dalam memisahkan data siswa berdasarkan kelas.    
                                    </p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ExcelModal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Insert -->
                <div class="modal fade" id="insertData" tabindex="-1" aria-labelledby="insertDataLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="insertDataLabel">Data Siswa</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?=base_url('admin/tambahDataSiswa');?>">
                                    <div class="form-group">
                                        <label for="nipd">NIPD</label>
                                        <input value="<?= set_value('nipd');?>" type="number" name="nipd" class="form-control nipd" id="nipd" aria-describedby="InputNIS">
                                        <small class="text-danger" id="nipd-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Siswa</label>
                                        <input value="<?= set_value('nama');?>" type="text" class="form-control nama" name="nama" id="nama" aria-describedby="InputNama">
                                        <small class="text-danger" id="nama-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <select class="form-select kelas" name="kelas" class="kelas" id="kelas" >
                                        <?php
                                            foreach ($data['dataKelas'] as $value) {
                                                ?>
                                            <option value="<?= $value['kelas']; ?>"><?= $value['kelas']; ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                        <small class="text-danger" id="kelas-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="thn_akademik">Tahun Akademik</label>
                                        <select class="form-select thn_akademik" name="thn_akademik" id="thn_akademik">
                                        <?php
                                            foreach ($data['dataTahunAkademik'] as $value) {
                                                ?>
                                            <option value="<?= $value['thn_akademik']; ?>"><?= $value['thn_akademik']; ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                        <small class="text-danger" id="thn_akademik-error"></small>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" value="<?= set_value('password');?>" name="password" class="form-control" id="password" aria-describedby="InputNIS">
                                        <small class="text-danger" id="password-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="potongan">Potongan</label>
                                        <input type="number" value="<?= set_value('potongan');?>" name="potongan" class="form-control" id="potongan" aria-describedby="InputNIS">
                                        <small class="text-danger" id="potongan-error"></small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                  <!-- Modal Untuk Update Data -->
                <div class="modal fade" id="UpdateData" tabindex="-1" aria-labelledby="UpdateDataLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="UpdateDataLabel">Data Siswa</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="<?= base_url('Admin/ubahDataSiswa');?>">
                                <div hidden class="form-group">
                                    <input type="text" class="form-control nipd" name="nipd" id="nipd" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="nipdnew">NIPD Siswa</label>
                                    <input type="text" class="form-control nipdnew" name="nipdnew" id="nipdnew" aria-describedby="Inputnipdnew">
                                    <small class="text-danger" id="nipdnew-errorUpdateData"></small>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input type="text" class="form-control nama" name="nama" id="nama" aria-describedby="InputNama">
                                    <small class="text-danger" id="nama_siswa-errorUpdateData"></small>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-select kelas" name="kelas" id="kelas">
                                    <?php
                                        foreach ($data['dataKelas'] as $value) {
                                            ?>
                                        <option value="<?= $value['kelas']; ?>"><?= $value['kelas']; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <small class="text-danger" id="kelas-errorUpdateData"></small>
                                </div>
                                <div class="form-group">
                                    <label for="thn_akademik">Tahun Akademik</label>
                                    <select class="form-select thn_akademik" id="thn_akademik" name="thn_akademik">
                                    <?php
                                        foreach ($data['dataTahunAkademik'] as $value) {
                                            ?>
                                        <option value="<?= $value['thn_akademik']; ?>"><?= $value['thn_akademik']; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <small class="text-danger" id="thn_akademik-errorUpdateData"></small>
                                </div>
                                 <div class="form-group">
                                    <label for="potongan">Potongan</label>
                                    <input type="number" class="form-control" name="potongan" id="potongan" aria-describedby="InputNIS">
                                    <small class="text-danger" id="potongan-errorUpdateData"></small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Confirm Modal -->
                <div class="modal fade" id="DeleteConfirmSiswa" tabindex="-1" aria-labelledby="DeleteConfirmSiswaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteConfirmSiswaLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data Siswa ini? Data yang terhapus tidak akan bisa melakukan pembayaran.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn modalDelete btn-danger text-white">Iya</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3 jumlah-siswa" style="border-radius: 20px">
                    <div class="card shadow-sm d-flex flex-fill">
                        <div class="card-body" >
                            <div class="media ">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Jumlah Siswa</p>
                                    <div class="d-flex justify-content-between">
                                        <p class=" content-color-primary mt-2 mb-3 fs-5 jumlahSiswa"></p>
                                    </div>
                                </div>
                                <h5 class="material-icons icon text-success">person</h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tabel Data Siswa -->
                <div class="col-sm-12 ">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="d-flex justify-content-between input-group">
                                                <form class="form siswa-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Nama Siswa</label>
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Nama Siswa" aria-controls="dataTable">
                                                    </div>
                                                </form>
                                                <form class="form mr-2">
                                                    <div class="form-group inputtahun">
                                                       <label for="kelasList">Kelas</label>
                                                       <select id="kelasList" class="form-select" name="kelas">
                                                          <?php
                                                          ?>
                                                          <option selected value="">Semua</option>
                                                          <?php
                                                          foreach ($data['dataKelas'] as $value) {
                                                          ?>
                                                          <option value="<?= $value['kelas'];?>"><?= $value['kelas'];?></option>
                                                          <?php
                                                          }
                                                          ?>
                                                       </select>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="media">
                                                <a href="javascript:void(0);" class="icon-circle icon-30 content-color-secondary fullscreenbtn form-control-sm">
                                                    <i class="material-icons ">crop_free</i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>                             
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table class="table hidden-overflow" id="table">
                                                <thead>
                                                    <tr>
                                                        <th><center>No</center></th>
                                                        <th><center>NIPD</center> </th>
                                                        <th><center>Nama Siswa</center></th>
                                                        <th class="siswa-kelas"><center>Kelas</center></th>
                                                        <th class="siswa-thn-akademik"><center>Tahun Akademik</center></th>
                                                        <th class="siswa-status"><center>Status</center></th>
                                                        <th class="siswa-update"><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.table-responsive -->
                            <div id="pagination-container ">
                                <ul class="pagination mt-3">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content page ends -->

        <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script>
            let itemsPerPage = 10;
            let currentPage = 1;
            var totalPages;
            let data = [];
            var nipd;

            $(document).ready(function() {
                $('#cari').keyup(function(){
                    getData();
                });

                $('#kelasList').change(function(){
                    getData();
                });
                
                $('#kelasList').ready(function(){
                    getData();
                });

                function getData(){
                    let keyword = $('#cari').val();
                    let kelas = $('#kelasList').val();
                    $.ajax({
                        url: '<?= base_url('pages/dataSiswaData')?>',
                        method: 'GET',
                        data: {keyword: keyword, kelas: kelas, status: 1},
                        success: function(response){
                            $('#table tbody').empty();
                            if((response.dataSiswa).length !== 0) {
                                data = response.dataSiswa;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.nipd}</center></td>
                                        <td><center>${item.nama_siswa}</center></td>
                                        <td><center>${item.kelas}</center></td>
                                        <td><center>${item.thn_akademik}</center></td>
                                        <td><center>${item.status == 1? 'Aktif' : 'Tidak Aktif'}</center></td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="javascript:;" 
                                                    data-nipd = "${item.nipd}"
                                                    data-nipdnew = "${item.nipd}"
                                                    data-nama = "${item.nama_siswa}"
                                                    data-kelas = "${item.kelas}"
                                                    data-thn_akademik = "${item.thn_akademik}"
                                                    data-potongan = "${item.potongan}"
                                                    class="btn btn-warning btn-sm mr-2"  data-bs-toggle="modal" data-bs-target="#UpdateData"
                                                >Ubah</a>
                                                <a href="javascript:;"
                                                data-nipd = "${item.nipd}"
                                                class="btn btn-danger btn-sm deleteData">
                                                    <i class="material-icons icon">delete</i>
                                                </a>
                                            </div>
                                        </td>
                                    '</tr>`;
                                    $('#table tbody').append(row);
                                });
                                if ((currentPage === 1 && pageData.length >= 10)) {
                                    renderPagination(totalPages, 4);
                                } else if(currentPage !== 1){
                                    renderPagination(totalPages, 4);
                                } else {
                                    $('.pagination').empty();
                                }
                            } else {
                                let emptyRow = `<tr><td colspan="7"><center><h5>Data belum tersedia!</h5></center></td></tr>`;
                                $('#table tbody').append(emptyRow);
                                $('.pagination').empty();
                            }
                            $('.jumlahSiswa').html(response.dataSiswaTotal);
                        }
    
                    });
                }

                function renderPagination(totalPages, visiblePages) {
                    // Clear the pagination container
                    $('.pagination').empty();
                    
                    // Calculate the range of pages to be displayed
                    var startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
                    var endPage = Math.min(totalPages, startPage + visiblePages - 1);
                    startPage = Math.max(1, endPage - visiblePages + 1);

                    var pageLinks = '';
                    if (currentPage > 1) {
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="first">First</a></li>';
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
                    }
                    for (var i = startPage; i <= endPage; i++) {
                        var activeClass = i === currentPage ? 'active' : '';
                        var pageLink = '<li class="page-item ' + activeClass + '">' +
                            '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a>' +
                            '</li>';
                        pageLinks += pageLink;
                    }
                    if (currentPage < totalPages) {
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="next">&raquo;</a></li>';
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="last">Last</a></li>';
                    }
                    
                    $('.pagination').append(pageLinks);
                }

                $('.pagination').on('click', 'a.page-link', function(e) {
                    e.preventDefault();

                    let targetPage = $(this).data('page');

                    if (targetPage === 'first') {
                        currentPage = 1;
                    } else if (targetPage === 'prev') {
                        currentPage = Math.max(1, currentPage - 1);
                    } else if (targetPage === 'next') {
                        currentPage = Math.min(totalPages, currentPage + 1);
                    } else if (targetPage === 'last') {
                        currentPage = totalPages;
                    } else {
                        currentPage = parseInt(targetPage);
                    }
                   getData();
                   renderPagination(totalPages, 4);
                });
                
                //Modal Config Input Data Kelas
                $('#insertData').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#insertData').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var nipd = form.find('input[name="nipd"]').val();                  
                    var nama = form.find('input[name="nama"]').val();
                    var kelas = form.find('input[name="kelas"]').val();
                    var thn_akademik = form.find('input[name="thn_akademik"]').val();
                    var password = form.find('input[name="password"]').val();
                    var potongan = form.find('input[name="potongan"]').val();
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#insertData').modal('hide');
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
                            console.error(status);
                            
                        }
                    })                
                })

                $('#ExcelModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                }); 

                $('#ExcelModal').on('submit', 'form' , function (event) {
                    event.preventDefault();
                    $('.spinner-border').removeAttr('hidden');
                    $('.excelSubmit').attr('disabled', true);
                    $('.excelSubmit').html(`
                        <div class="spinner-border text-light" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    `);
                    $('.exitfromExcel').attr('disabled', true);
                    $('.close').attr('disabled', true);
                    var form = $(this);
                    var fileInput = form.find('input[name="fileExcel"]')[0].files[0];
                    var formData = new FormData();
                    var progressBar = $('.progress-bar');
                    formData.append('fileExcel', fileInput);
                    $.ajax({
                        url: form.attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,

                        success: function (response) {
                            $('.excelSubmit').html('Submit');
                            $('.exitfromExcel').removeAttr('disabled');
                            $('.excelSubmit').removeAttr('disabled');
                            $('.close').removeAttr('disabled');
                            $('.spinner-border').attr('hidden', true);
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#ExcelModal').modal('hide');
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
                            console.error(status);
                            
                        }
                    })                
                });

                //Modal Config Get Selected Data Kelas
                // Untuk suntingS
                $('#UpdateData').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)
                    // Isi nilai pada field
                    modal.find(`#nipd`).attr("value",div.data(`nipd`));
                    modal.find(`#nipdnew`).attr("value",div.data(`nipdnew`));
                    modal.find(`#nama`).attr("value",div.data(`nama`));                  
                    modal.find(`#kelas`).val(div.data(`kelas`));
                    modal.find(`#thn_akademik`).val(div.data(`thn_akademik`));
                    modal.find('#potongan').attr("value",div.data(`potongan`));
                    modal.find(`input[name="status"][value="${div.data('status')}"]`).prop('checked', true);
                });

                //ModUpdateData Data Kelas
                $('#UpdateData').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#UpdateData').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var nipd = form.find('input[name="nipd"]').val();
                    var nipdnew = form.find('input[name="nipdnew"]').val();
                    var nama = form.find('input[name="nama"]').val();
                    var kelas = form.find('input[name="kelas"]').val();
                    var thn_akademik = form.find('input[name="thn_akademik"]').val();
                    var potongan = form.find('input[name="potongan"]').val();
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json' ,
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#UpdateData').modal('hide');
                            } else {                           
                                var errors = response.errors;
                                $.each(errors, function (field, message) {
                                    let errorElement = $('#' + field + '-errorUpdateData');
                                    errorElement.html(message);
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });               
                });

                $('#table').on('click', '.deleteData' ,function(event) {  
                    event.preventDefault();
                    nipd = $(this).data('nipd');
                    $('#DeleteConfirmSiswa').modal('show');
                });

                $('.modalDelete').click(function(){
                    $.ajax({
                        url: '<?= base_url('admin/hapusDataSiswa');?>',
                        method: 'POST',
                        data: {nipd: nipd},
                        dataType: 'json' ,
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                            } else {                           
                                var errors = response.errors;
                                $.each(errors, function (field, message) {
                                    let errorElement = $('#' + field + '-errorUpdate');
                                    errorElement.html(message);
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            })   
        </script>
