
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                    </button>
                </div>

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
                            <form method="post" action="<?=  base_url('admin/tambahDataAdmin'); ?>">
                                <div class="form-group">
                                    <label for="InputKode">Kode Petugas</label>
                                    <input type="text" name="kode_petugas" class="form-control" id="kode_petugas" aria-describedby="InputKode">
                                    <small id="kode_petugas-error" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="InputNama">Nama Petugas</label>
                                    <input type="text" name="nama_petugas" class="form-control" id="nama_petugas" aria-describedby="InputNama">
                                    <small id="nama_petugas-error" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="InputPassword">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" aria-describedby="InputPassword">
                                    <small id="password-error" class="text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label for="InputConfPassword">Password</label>
                                    <input type="password" name="confPassword" class="form-control" id="confPassword" aria-describedby="InputConfPassword">
                                    <small id="confPassword-error" class="text-danger"></small>
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
                                                        <th><center>Kode Petugas</center> </th>
                                                        <th><center>Nama Petugas</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data) == 0){?>
                                                            <tr class="odd">
                                                                <td colspan="4"><center><h5>Data belum tersedia!</h5></center></td>
                                                            </tr>
                                                            <?php
                                                        } else {                                                   
                                                            foreach ($data as $value) { 
                                                                ?>
                                                                <tr class="odd">
                                                                    <th><center><?= ++$start;?></center></th>
                                                                    <td><center><?= $value['kode_petugas']; ?></center></td>
                                                                    <td><center><?= $value['nama_petugas']; ?></center></td>
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
                    var kode_petugas = form.find('input[name="kode_petugas"]').val();                  
                    var nama_petugas = form.find('input[name="nama_petugas"]').val();
                    var password = form.find('input[name="password"]').val();
                    var confPassword = form.find('input[name="confPassword"]').val();
    
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
                            console.error(status);
                            
                        }
                    })                
                })
            })   
        </script>
