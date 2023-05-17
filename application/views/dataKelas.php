<?php
    // foreach ($data as $value) {
    //     echo count($data['dataKelas']);
    // }
    // die();
?>
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
                            <form method="post" action="<?= base_url('Admin/tambahDataKelas'); ?>">
                                <div class="form-group">
                                    <label for="InputKelas">Kelas</label>
                                    <input type="text" name="kelas" class="form-control" id="kelas" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Instansi</label>
                                    <select name="instansi" class="form-control" id="instansi">
                                        <?php 
                                            foreach ($data['dataInstansi'] as $value) {
                                        ?>
                                        <option><?= $value['instansi'] ;?></option>
                                        <?php        
                                            }
                                        ?>
                                    </select>
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
                <div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabelUpdate" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Kelas</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <input type="text" class="form-control" name="kelas" id="kelas" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="instansi">Instansi</label>
                                    <select class="form-control" name="instansi" id="instansi">
                                        <?php 
                                            foreach ($data['dataInstansi'] as $value) {
                                        ?>
                                        <option value="<?= $value['instansi'] ;?>"><?= $value['instansi'] ;?></option>
                                        <?php        
                                            }
                                        ?>
                                    </select>
                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                <button type="button" class="btn btn-primary">Simpan</button>
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
                                                    if(count($data['dataKelas'])  == 0){
                                                            ?>
                                                            <tr class="odd">
                                                                <td colspan="4"><center><h5>Data belum tersedia!</h5></center></td>
                                                            </tr>
                                                            <?php
                                                        } else {                                                   
                                                            $no = 1;
                                                            foreach ($data['dataKelas'] as $value) { 
                                                                    ?>
                                                                <tr class="odd">
                                                                    <td><center><?= $no++;?></center></td>
                                                                    <td><center><?= $value['kelas']; ?></center></td>
                                                                    <td><center><?= $value['instansi']; ?></center></td>
                                                                    <td>
                                                                        <center>
                                                                        <a href="javascript:;" 
                                                                            data-kelas="<?= $value['kelas']; ?>"
                                                                            data-instansi="<?= $value['instansi']; ?>"
                                                                            class="btn btn-warning btn-sm" data-toggle="modal" onclick="updateDataModal(['kelas', 'instansi'])"
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

                            <!-- /.table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content page ends -->