<!-- content page -->
        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Biaya</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataBiaya'); ?>">                               
                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Jenis Biaya</label>
                                        <input type="text" name="jenis_pembayaran" class="form-control" id="jenis_pembayaran" aria-describedby="jenis_pembayaran">
                                        <small class="text-danger" id="jenis_pembayaran-error"></small>                                                                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="number" name="biaya" class="form-control" id="biaya" aria-describedby="biaya">
                                        <small class="text-danger" id="biaya-error"></small>                                                                     
                                    </div>
                                    <div class="form-group">
                                    <label for="InputKelas">Instansi</label>
                                        <select class="form-select" name="instansi" id="instansi">
                                        <?php 
                                        foreach ($data['dataInstansi'] as $value) {
                                            ?>
                                             <option value="<?=$value['jenis_instansi'];?>"><?=$value['jenis_instansi'];?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                    </div>   
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Update -->
                <div class="modal fade" id="updateBiaya" tabindex="-1" aria-labelledby="updateBiayaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="updateBiayaLabel">Data Biaya</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataBiaya')?>">
                                    <input hidden type="text" name="id_jenis_pembayaran"  class="form-control" id="id_jenis_pembayaran" aria-describedby="id_jenis_pembayaran">
                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Jenis Biaya</label>
                                        <input type="text" name="jenis_pembayaran" class="form-control" id="jenis_pembayaran" aria-describedby="jenis_pembayaran">
                                        <small class="text-danger" id="jenis_pembayaran-errorUpdate"></small> 
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="number" name="biaya" class="form-control" id="biaya" aria-describedby="biaya">
                                        <small class="text-danger" id="biaya-errorUpdate"></small> 
                                    </div>  
                                    <div class="form-group">
                                    <label for="InputKelas">Instansi</label>
                                        <select class="form-select instansi" name="instansi" id="instansi">
                                        <?php 
                                        foreach ($data['dataInstansi'] as $value) {
                                            ?>
                                             <option value="<?=$value['jenis_instansi'];?>"><?=$value['jenis_instansi'];?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
                                        <small class="text-danger" id="instansi-errorUpdate"></small> 
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
                                                        <th><center>Jenis Biaya</center> </th>
                                                        <th><center>Biaya</center></th>
                                                        <th><center>Instansi</center></th>                                                        
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data['dataBiaya']) === 0){
                                                        ?>

                                                        <?php
                                                    } else {
                                                        $no = 1; 
                                                        foreach ($data['dataBiaya'] as $value) {
                                                        ?>
                                                        <tr class="odd">
                                                            <td><center><?= $no++; ?></center></td>
                                                            <td><center><?= $value['jenis_pembayaran']; ?></center></td>
                                                            <td><center><?= "Rp" . number_format($value['biaya'],2,',','.'); ?></center></td>
                                                            <td><center><?= $value['instansi']; ?></center></td>
                                                            <td>
                                                                <center>
                                                                <a href="javascript:;" 
                                                                    data-id_jenis_pembayaran="<?= $value['id_jenis_pembayaran']; ?>"                                                            
                                                                    data-jenis_pembayaran="<?= $value['jenis_pembayaran']; ?>"
                                                                    data-biaya="<?= $value['biaya']; ?>"
                                                                    data-instansi="<?= $value['instansi']; ?>"                                                                
                                                                    class="btn btn-warning btn-sm updateData" data-bs-toggle="modal"
                                                                    data-bs-target="#updateBiaya">Ubah</a>
                                                                </center>
                                                            </td>    
                                                        </tr>
                                                        <?php
                                                    }
                                                }  ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.table-responsive -->
                             <?= $this->pagination->create_links();?>
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
                    var jenis_pembayaran = form.find('input[name="jenis_pembayaran"]').val();                  
                    var biaya = form.find('input[name="biaya"]').val();
    
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
                $('#updateBiaya').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)

                        // Isi nilai pada field
                    modal.find(`#id_jenis_pembayaran`).attr("value",div.data(`id_jenis_pembayaran`));
                    modal.find(`#jenis_pembayaran`).attr("value",div.data(`jenis_pembayaran`));
                    modal.find('#biaya').attr("value",div.data(`biaya`));
                    modal.find('#instansi').val(div.data(`instansi`));
                });

                //Modal Config Update Data Kelas
                $('#updateBiaya').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateBiaya').on('submit', 'form' , function (event) {
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
                                $('#updateBiaya').modal('hide');
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