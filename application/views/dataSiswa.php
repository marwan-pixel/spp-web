
        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
                </button>
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
                            <form method="post" action="<?=base_url('Admin/tambahDataSiswa');?>">
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
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" value="<?= set_value('password');?>" name="password" class="form-control" id="password" aria-describedby="InputNIS">
                                    <small class="text-danger" id="password-error"></small>
                                </div>                               
                                <div class="form-group" id="biaya">
                                    <label for="biaya">Biaya</label>
                                    <input type="number" value="<?= set_value('biaya');?>" class="form-control" name="biaya" id="biaya" aria-describedby="InputNIS">
                                    <small class="text-danger" id="biaya-error"></small>

                                </div>
                                <div class="form-group" id="ket_biaya">
                                    <label for="ket_biaya">Keterangan Biaya</label>
                                    <textarea value="<?= set_value('ket_biaya');?>" class="form-control" name="ket_biaya" id="ket_biaya" aria-describedby="textareaNIS"></textarea>
                                    <small class="text-danger" id="ket_biaya-error"></small>
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
                                </div>
                                 <div class="form-group">
                                    <label for="biaya">Biaya</label>
                                    <input type="number" class="form-control" name="biaya" id="biaya" aria-describedby="InputNIS">
                                    <small class="text-danger" id="biaya-errorUpdate"></small>
                                </div>
                                <div class="form-group" id="ket_biaya">
                                    <label for="ket_biaya">Keterangan Biaya</label>
                                    <textarea class="form-control" name="ket_biaya" id="ket_biaya" aria-describedby="textareaNIS"></textarea>
                                    <small class="text-danger" id="ket_biaya-errorUpdate"></small>
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
                        <!-- <div class="card-header">
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">NIS</span>
                                                </div>
                                                <input type="search" size="30" class="form-control form-control ml-2" placeholder="Masukkan NIS Siswa" aria-controls="dataTable">
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
                                                        <th><center>Password</center></th>
                                                        <th><center>Biaya</center></th>
                                                        <th><center>Keterangan Biaya</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data['dataSiswa']) == 0){                                                        
                                                    ?>
                                                    <tr>
                                                        <th colspan="9"><center><h5>Data belum tersedia</h5></center></th>
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
                                                        <td><center>****</center></td>
                                                        <td><center>Rp<?= number_format($value['biaya'],2,',','.');?></center></td>
                                                        <td><center><?= $value['ket_biaya'] ;?></center></td>
                                                        <td>
                                                            <center>
                                                            <a href="javascript:;" 
                                                            data-nipd = "<?= $value['nipd'] ;?>"
                                                            data-nama = "<?= $value['nama_siswa'] ;?>"
                                                            data-kelas = "<?= $value['kelas'] ;?>"
                                                            data-biaya = "<?= $value['biaya'] ;?>"
                                                            data-ket_biaya = "<?= $value['ket_biaya'] ;?>"
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
                    var password = form.find('input[name="password"]').val();
                    var biaya = form.find('input[name="biaya"]').val();
                    var ket_biaya = form.find('input[name="ket_biaya"]').val();
    
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

                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#exampleModalUpdate').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)

                        // Isi nilai pada field
                    modal.find(`#nipd`).attr("value",div.data(`nipd`));
                    modal.find(`#nama`).attr("value",div.data(`nama`));                  
                    modal.find(`#kelas`).val(div.data(`kelas`));
                    modal.find('#biaya').attr("value",div.data(`biaya`));
                    modal.find(`#ket_biaya`).val(div.data(`ket_biaya`));
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
                    var biaya = form.find('input[name="biaya"]').val();
                    var ket_biaya = form.find('input[name="ket_biaya"]').val();

    
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
                                console.log(errors);
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