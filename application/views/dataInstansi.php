
        <!-- content page -->
        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3 instansi-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                    </button>
                    <button class="btn btn-secondary mb-3 instansi-btn">
                        <i class="material-icons icon">help_outline</i>
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Instansi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataInstansi'); ?>">                               
                                    <div class="form-group">
                                        <label for="instansi">Instansi</label>
                                        <input type="text" name="instansi" class="form-control" id="instansi" aria-describedby="instansi">
                                        <small class="text-danger" id="instansi-error"></small>                                                                                    
                                    </div>                            
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Update -->
                <div class="modal fade" id="updateInstansi" tabindex="-1" aria-labelledby="updateInstansiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="updateInstansiLabel">Data Instansi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataInstansi')?>">
                                    <input hidden type="text" name="instansi"  class="form-control" id="instansi" aria-describedby="instansi">
                                    <div class="form-group">
                                        <label for="instansinew">Instansi</label>
                                        <input type="text" name="instansinew" class="form-control" id="instansinew" aria-describedby="instansinew">
                                        <small class="text-danger" id="instansinew-errorUpdate"></small> 
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Confirm Delete-->
                <div class="modal fade" id="DeleteConfirmInstansi" tabindex="-1" aria-labelledby="DeleteConfirmInstansiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteConfirmInstansiLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini? Data yang terhapus ini secara otomatis
                            membuat data dari tabel yang berkaitan ikut terhapus, di antaranya: Data Kelas dan Data Biaya.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn modalDelete btn-danger text-white">Iya</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel data instansi -->
                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4 ">
                                                <form action="<?= base_url('pages/datainstansi');?>" method="post" class="form-inline instansi-cari">
                                                    <div class="form-group mb-2 ">
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari instansi" aria-controls="dataTable">
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
                                                        <th><center>Instansi</center> </th>
                                                        <th class="instansi-update"><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1;
                                                    if(count($data['dataInstansi']) == 0){
                                                        ?>
                                                        <tr class="odd">
                                                                <td colspan="3"><center><h5>Data belum tersedia!</h5></center></td>
                                                        </tr>
                                                    <?php
                                                    }
                                                    foreach ($data['dataInstansi'] as $value) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td><center><?= $no++; ?></center></td>
                                                        <td><center><?= $value['jenis_instansi']; ?></center></td>
                                                        <td>
                                                            <center>
                                                            <a href="javascript:;" 
                                                                data-instansi="<?= $value['jenis_instansi']; ?>"
                                                                data-instansinew="<?= $value['jenis_instansi']; ?>"
                                                                class="btn btn-warning btn-sm updateData" data-bs-toggle="modal"
                                                                data-bs-target="#updateInstansi">Ubah
                                                            </a>
                                                            <a href="javascript:;"
                                                                data-instansi="<?= $value['jenis_instansi']; ?>"
                                                                class="btn btn-danger btn-sm deleteData">
                                                                <i class="material-icons icon">delete</i>
                                                            </a>
                                                            </center>
                                                       </td>    
                                                    </tr>
                                                  </tr>
                                                
                                                  <?php }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="siswa-pagination mt-3">
                                    <?= $this->pagination->create_links();?>
                                </div>
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
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });             
                });

                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#updateInstansi').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this);

                        // Isi nilai pada field
                    modal.find(`#instansi`).attr("value",div.data(`instansi`));
                    modal.find(`#instansinew`).attr("value",div.data(`instansinew`));
                });

                //Modal Config Update Data Kelas
                $('#updateInstansi').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateInstansi').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var instansi = form.find('input[name="instansi"]').val();
                    var instansinew = form.find('input[name="instansinew"]').val();
                    
                    
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json' ,
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#updateInstansi').modal('hide');
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

                $('.deleteData').click(function(){
                    let instansi = $(this).data('instansi');
                    event.preventDefault();
                    $('#DeleteConfirmInstansi').modal('show');
                    $('.modalDelete').click(function(){
    
                        $.ajax({
                            url: '<?= base_url('admin/hapusDataInstansi');?>',
                            method: 'POST',
                            data: {instansi: instansi},
                            dataType: 'json' ,
                            success: function (response) {
                                if(response.success) {
                                    window.location.href = response.redirect;
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                });
            });
        </script>
      