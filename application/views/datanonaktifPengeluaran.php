<div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon admin-btn">help_outline</i>
                    </button>
                </div>

                <div class="modal fade" id="RestoreConfirmKelas" tabindex="-1" aria-labelledby="RestoreConfirmKelasLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="RestoreConfirmKelasLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin memulihkan data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn restoreModal btn-primary text-white">Iya</button>
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
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4 siswa-cari">
                                                <form action="<?= base_url('pages/datanonaktifkelas');?>" method="post" class="form-inline">
                                                    <div class="form-group mb-2 ">
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Kelas" aria-controls="dataTable">
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
                                                        <th><center>Nominal</center> </th>
                                                        <th><center>Keterangan</center></th>
                                                        <th class="biaya-update"><center>Aksi</center></th>
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
                                                                <td><center><?= $no++; ?></center></td>
                                                                <td><center><?= "Rp" . number_format($value['nominal'],2,',','.'); ?></center></td>
                                                                <td><center><?= $value['keterangan']; ?></center></td>
                                                                    <td><center><a class="btn btn-primary restoreData text-white"
                                                                    data-nominal="<?= $value['nominal']; ?>" data-keterangan=
                                                                    "<?= $value['keterangan']; ?>">
                                                                    <i class="material-icons icon">restore</i>
                                                                    </a></center></td>
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
                    let jenis_instansi = $(this).data('instansi');
                    let kelas = $(this).data('kelas');
                    event.preventDefault();
                    $('#RestoreConfirmKelas').modal('show');
                    $('.restoreModal').click(function(){
    
                        $.ajax({
                            url: '<?= base_url('admin/restoreDataKelas');?>',
                            method: 'POST',
                            data: {jenis_instansi: jenis_instansi, kelas: kelas},
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