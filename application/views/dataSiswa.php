
        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
                </button>
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModalExcel">
                Tambah Data (Impor Dari Excel)
                </button>

                <div class="modal fade" id="exampleModalExcel" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="exampleModalExcelLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalExcelLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <h5><b> Petunjuk Singkat</b></h5>
                                    <div class="">
                                        <p>Penginputan data Siswa bisa dilakukan dengan mengcopy data dari file Ms. Excel. Format file excel harus sesuai kebutuhan aplikasi. 
                                            Silakan Klik pada tombol di sebelah kanan untuk melihat cara menggunakannya 
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#LargeModal">Contoh Excel</a>
                                        </p>
                                    </div>
                                </div>
                            <form method="post" id="sample_form" enctype="multipart/form-data" action="<?=base_url('admin/tambahDataSiswaExcel');?>">
                                <div class="form-group">
                                    <label for="file">File Input</label>
                                    <input type="file" class="form-control" requi name="fileExcel" id="fileExcel" aria-describedby="fileExcel">
                                    <small class="text-danger" id="fileExcel-error"></small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade bd-example-modal-lg" id="LargeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Contoh Mengupload Data Siswa Menggunakan Excel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Insert -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <select value="<?= set_value('kelas');?>" class="form-control kelas" name="kelas" id="kelas">
                                        <?php
                                            foreach ($data['dataKelas'] as $value) {
                                                ?>
                                            <option value="<?= $value['kelas']; ?>" id="kelas"><?= $value['kelas']; ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                        <small class="text-danger" id="kelas-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="thn_akademik">Tahun Akademik</label>
                                        
                                        <select value="<?= set_value('thn_akademik');?>" class="form-control thn_akademik" name="thn_akademik" id="thn_akademik">
                                        <?php
                                            foreach ($data['dataTahunAkademik'] as $value) {
                                                ?>
                                            <option value="<?= $value['thn_akademik']; ?>" id="thn_akademik"><?= $value['thn_akademik']; ?></option>
                                        <?php
                                            }
                                        ?>
                                        </select>
                                        <small class="text-danger" id="thn_akademik-error"></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Keterangan:</label>
                                        <input type="radio" value="1" name="status" id="status_aktif">
                                        <label for="status_aktif">Aktif</label>
                                        <input type="radio" value="0" name="status" id="status_tidak-aktif">
                                        <label for="status_tidak-aktif">Tidak Aktif</label>
                                        <small class="text-danger" id="status-error"></small>
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- Modal Update -->
                <div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalUpdateLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalUpdateLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="<?= base_url('Admin/ubahDataSiswa');?>">
                                <div hidden class="form-group">
                                    <input type="text" class="form-control nipd" name="nipd" id="nipd" aria-describedby="InputNama">
                                </div>
                                 <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input type="text" class="form-control nama" name="nama" id="nama" aria-describedby="InputNama">
                                    <small class="text-danger" id="nama-errorUpdate"></small>
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select class="form-control kelas" name="kelas" id="kelas">
                                    <?php
                                        foreach ($data['dataKelas'] as $value) {
                                            ?>
                                        <option value="<?= $value['kelas']; ?>"><?= $value['kelas']; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                    <small class="text-danger" id="kelas-errorUpdate"></small>
                                </div>
                                <div class="form-group">
                                    <label for="thn_akademik">Tahun Akademik</label>
                                    
                                    <select class="form-control thn_akademik" name="thn_akademik" id="thn_akademik">
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
                                    <label for="status">Keterangan:</label>
                                    <input type="radio" value="1" name="status" id="status_aktif">
                                    <label for="status_aktif">Aktif</label>
                                    <input type="radio" value="0" name="status" id="status_tidak-aktif">
                                    <label for="status_tidak-aktif">Tidak Aktif</label>
                                    <small class="text-danger" id="status-error"></small>
                                </div>
                                 <div class="form-group">
                                    <label for="potongan">Potongan</label>
                                    <input type="number" class="form-control" name="potongan" id="potongan" aria-describedby="InputNIS">
                                    <small class="text-danger" id="potongan-errorUpdate"></small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4">
                                                <form action="<?= base_url('pages/datasiswa');?>" method="post" class="form-inline">
                                                    <div class="form-group mb-2 ">
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Nama Siswa" aria-controls="dataTable">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mb-2">Cari</button>
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
                                            <table class="table hidden-overflow" id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th><center>No</center></th>
                                                        <th><center>NIPD</center> </th>
                                                        <th><center>Nama Siswa</center></th>
                                                        <th><center>Kelas</center></th>
                                                        <th><center>Tahun Akademik</center></th>
                                                        <th><center>Status</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data['dataSiswa']) == 0){                                                        
                                                    ?>
                                                    <tr>
                                                        <th colspan="7"><center><h5>Data belum tersedia</h5></center></th>
                                                    </tr>
                                                    <?php    
                                                    } else {
                                                        foreach ($data['dataSiswa'] as $value) {
                                                    ?>
                                                    <tr class="odd">
                                                        <th><center><?= ++$start;?></center></th>
                                                        <td><center><?= $value['nipd'] ;?></center></td>
                                                        <td><center><?= $value['nama_siswa'] ;?></center></td>
                                                        <td><center><?= $value['kelas'] ;?></center></td>
                                                        <td><center><?= $value['thn_akademik'] ;?></center></td>
                                                        <td><center><?= $value['status'] == 1 ? "Aktif" : "Tidak Aktif" ;?></center></td>
                                                        <td>
                                                            <center>
                                                            <a href="javascript:;" 
                                                            data-nipd = "<?= $value['nipd'] ;?>"
                                                            data-nama = "<?= $value['nama_siswa'] ;?>"
                                                            data-kelas = "<?= $value['kelas'] ;?>"
                                                            data-thn_akademik = "<?= $value['thn_akademik'] ;?>"
                                                            data-status = "<?= $value['status'] ;?>"
                                                            data-potongan = "<?= $value['potongan'] ;?>"
                                                            class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModalUpdate"
                                                            >Ubah</a>
                                                            <!-- <button class="btn btn-danger btn-sm">Hapus</button> -->                                                           
                                                            </center>
                                                       </td>
                                                    </tr>
                                                    <?php
                                                        } 
                                                    } 
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <?= $this->pagination->create_links();?>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content page ends -->

        <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script>
            
            $(document).ready(function() {
                //Modal Config Input Data Kelas
                $('#exampleModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModal').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var nipd = form.find('input[name="nipd"]').val();                  
                    var nama = form.find('input[name="nama"]').val();
                    var kelas = form.find('input[name="kelas"]').val();
                    var thn_akademik = form.find('input[name="thn_akademik"]').val();
                    var password = form.find('input[name="password"]').val();
                    var potongan = form.find('input[name="potongan"]').val();
                    var status = form.find('input[name="status:checked"]').val();
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#exampleModal').modal('hide');
                            } else {
                                var errors = response.errors;
                                console.log(errors);
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

                $('#exampleModalExcel').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModalExcel').on('submit', 'form' , function (event) {
                    event.preventDefault();
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
                            console.log(response);
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#exampleModalExcel').modal('hide');
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
                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#exampleModalUpdate').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)

                        // Isi nilai pada field
                    modal.find(`#nipd`).attr("value",div.data(`nipd`));
                    modal.find(`#nama`).attr("value",div.data(`nama`));                  
                    modal.find(`#kelas`).val(div.data(`kelas`));
                    modal.find(`#thn_akademik`).val(div.data(`thn_akademik`));
                    modal.find('#potongan').attr("value",div.data(`potongan`));
                    modal.find(`input[name="status"][value="${div.data('status')}"]`).prop('checked', true);
                });

                //Modal Config Update Data Kelas
                $('#exampleModalUpdate').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModalUpdate').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var nipd = form.find('input[name="nipd"]').val();
                    var nama = form.find('input[name="nama"]').val();
                    var kelas = form.find('input[name="kelas"]').val();
                    var thn_akademik = form.find('input[name="thn_akademik"]').val();
                    var potongan = form.find('input[name="potongan"]').val();
                    var status = form.find('input[name="status"]:checked').val();
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
                                    let errorElement = $('#' + field + '-errorUpdate');
                                    errorElement.html(message);
                                })
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    })               
                })
            })   
        </script>
