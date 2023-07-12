<!-- content page -->
<div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3 biaya-add" data-bs-toggle="modal" data-bs-target="#tambahDataPengeluaran">
                    Tambah Data
                    </button>
                    <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon biaya-btn">help_outline</i>
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="tambahDataPengeluaran" tabindex="-1" aria-labelledby="tambahDataPengeluaranLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="tambahDataPengeluaranLabel">Data Pengeluaran</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataPengeluaran'); ?>">                               
                                    <div class="form-group">
                                        <label for="nominal">Nominal</label>
                                        <input type="number" name="nominal" class="form-control" id="nominal" aria-describedby="nominal">
                                        <small class="text-danger" id="nominal-error"></small>                                                                     
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Nominal</label>
                                        <input type="text" name="jenis_pembayaran" class="form-control" id="jenis_pembayaran" aria-describedby="jenis_pembayaran">
                                        <small class="text-danger" id="jenis_pembayaran-error"></small>                                                                                    
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

                <!-- Modal Delete -->
                <div class="modal fade" id="DeleteConfirmBiaya" tabindex="-1" aria-labelledby="DeleteConfirmBiayaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteConfirmBiayaLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn modalDelete btn-danger text-white">Iya</button>
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
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4 siswa-cari">
                                                <form action="<?= base_url('pages/datapengeluaran');?>" method="post" class="form-inline">
                                                    <div class="form-group mb-2 ">
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Keterangan Biaya" aria-controls="dataTable">
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
                                                    if(count($data) === 0){
                                                        ?>

                                                        <?php
                                                    } else {
                                                        $no = 1; 
                                                        foreach ($data as $value) {
                                                        ?>
                                                        <tr class="odd">
                                                            <td><center><?= $no++; ?></center></td>
                                                            <td><center><?= "Rp" . number_format($value['nominal'],2,',','.'); ?></center></td>
                                                            <td><center><?= $value['keterangan']; ?></center></td>
                                                            <td>
                                                                <center>
                                                                <a href="javascript:;" 
                                                                    data-id_pengeluaran="<?= $value['id_pengeluaran']; ?>"                                                            
                                                                    data-nominal="<?= $value['nominal']; ?>"
                                                                    data-keterangan="<?= $value['keterangan']; ?>"
                                                                    class="btn btn-warning btn-sm updateData" data-bs-toggle="modal"
                                                                    data-bs-target="#updateBiaya">Ubah
                                                                </a>
                                                                <a href="javascript:;"
                                                                    data-id_pengeluaran="<?= $value['id_pengeluaran']; ?>"
                                                                    class="btn btn-danger btn-sm deleteData">
                                                                    <i class="material-icons icon">delete</i>
                                                                </a>
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
                $('#tambahDataPengeluaran').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#tambahDataPengeluaran').on('submit', 'form' , function (event) {
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
                                $('#tambahDataPengeluaran').modal('hide');
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
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });              
                });

                $('.deleteData').click(function(){
                    event.preventDefault();
                    let id_jenis_pembayaran = $(this).data('id_jenis_pembayaran');

                    $('#DeleteConfirmBiaya').modal('show');
                    $('.modalDelete').click(function(){
                        $.ajax({
                            url: '<?= base_url('admin/hapusDataBiaya');?>',
                            method: 'POST',
                            data: {id_jenis_pembayaran: id_jenis_pembayaran},
                            dataType: 'json' ,
                            success: function (response) {
                                if(response.success) {
                                    window.location.href = response.redirect;
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
                        });
                    });
                });
            });  
        </script>