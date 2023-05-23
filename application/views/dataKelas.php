
        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
                </button>

                <!-- Modal Insert -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="<?=  base_url('admin/tambahDataKelas'); ?>">
                                <div class="form-group">
                                    <label for="InputKelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" id="kelas" aria-describedby="InputNama">
                                    <small id="kelas-error" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Instansi</label>
                                    <input type="text" name="instansi" class="form-control" id="instansi" aria-describedby="InputNama">
                                    <small id="instansi-error" class="text-danger"></small>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalUpdateLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalUpdateLabel">Data Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="<?= site_url('Admin/ubahDataKelas') ;?>">
                                <div hidden class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" name="kelas" id="kelas" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="instansi">Instansi</label>
                                    <input type="text" class="form-control" name="instansi" id="instansi" aria-describedby="InputNama">
                                    <small id="instansi-errorUpdate" class="text-danger"></small>
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
                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row mb-3">                                        
                                        <div class="col-sm-12 d-flex justify-content-end">
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
                                                        <th><center>Kelas</center> </th>
                                                        <th><center>Instansi</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data['dataKelas']) == 0){?>
                                                            <tr class="odd">
                                                                <td colspan="4"><center><h5>Data belum tersedia!</h5></center></td>
                                                            </tr>
                                                            <?php
                                                        } else {                                                   
                                                            foreach ($data['dataKelas'] as $value) { 
                                                                ?>
                                                                <tr class="odd">
                                                                    <th><center><?= ++$start;?></center></th>
                                                                    <td><center><?= $value['kelas']; ?></center></td>
                                                                    <td><center><?= $value['instansi']; ?></center></td>
                                                                    <td>
                                                                        <center>
                                                                        <a href="javascript:;" 
                                                                            data-kelas="<?= $value['kelas']; ?>"
                                                                            data-instansi="<?= $value['instansi']; ?>"
                                                                            class="btn btn-warning btn-sm" data-toggle="modal"
                                                                            data-target="#exampleModalUpdate">Ubah</a>
                                                                        </center>
                                                                   </td>    
                                                                </tr>
                                                            <?php                                                       
                                                            }
                                                        }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?= $this->pagination->create_links();?>                            
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
                    var kelas = form.find('input[name="kelas"]').val();
                    var instansi = form.find('input[name="instansi"]').val();
    
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
                    modal.find(`#kelas`).attr("value",div.data(`kelas`));
                    modal.find(`#instansi`).attr("value",div.data(`instansi`));
                });

                //Modal Config Update Data Kelas
                $('#exampleModalUpdate').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModalUpdate').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var kelas = form.find('input[name="kelas"]').val();
                    var instansi = form.find('input[name="instansi"]').val();
    
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
                                    console.log(field);
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