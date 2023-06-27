        

        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
                </button>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Biaya</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Ubah</button>
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
                                    <div class="row">
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
                                                        <th><center>Instansi</center> </th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1; 
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
                                                                class="btn btn-warning btn-sm updateData" data-toggle="modal"
                                                                data-target="#updateInstansi">Ubah</a>
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
                $('#updateInstansi').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)

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
      