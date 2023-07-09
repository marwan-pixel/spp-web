        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon admin-btn">help_outline</i>
                    </button>
                </div>

                <div class="modal fade" id="RestoreConfirmAdmin" tabindex="-1" aria-labelledby="RestoreConfirmAdminLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="RestoreConfirmAdminLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin memulihkan data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn restoreModal btn-danger text-white">Iya</button>
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
                                                        <th><center>Kode Petugas</center></th>
                                                        <th><center>Nama Petugas</center></th>
                                                        <th><center>Aksi</center></th>
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
                                                                    <td><center><a class="btn btn-primary text-white restoreData" 
                                                                    data-kode-petugas="<?= $value['kode_petugas']; ?>">
                                                                    <i class="material-icons icon">restore</i></a></center></td>
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
            $(document).ready(function(){
                $('.restoreData').click(function(){
                    let kode_petugas = $(this).data('kode-petugas');
                    event.preventDefault();
                    $('#RestoreConfirmAdmin').modal('show');
                    $('.restoreModal').click(function(){
    
                        $.ajax({
                            url: '<?= base_url('admin/restoreDataAdmin');?>',
                            method: 'POST',
                            data: {kode_petugas: kode_petugas},
                            dataType: 'json' ,
                            success: function (response) {
                                console.log(response)
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