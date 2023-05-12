        

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
                                <form method="post" action="<?= base_url('Admin/tambahDataBiaya'); ?>">
                                    <?= $this->session->flashdata('message'); ?>                               
                                    <div class="form-group">
                                        <label for="instansi">Instansi</label>
                                        <input type="text" name="instansi" value="<?= set_value('instansi');?>" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                        <?= form_error('instansi','<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="InputNama">Biaya</label>
                                        <input type="number" name="biaya" value="<?= set_value('biaya');?>" class="form-control" id="InputNama" aria-describedby="InputNama">
                                        <?= form_error('biaya','<small class="text-danger pl-3">', '</small>'); ?>                                    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                                <h4 class="modal-title" id="exampleModalLabel">Data Biaya</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="InputNIS">Instansi</label>
                                        <input type="text" class="form-control" id="instansi" aria-describedby="instansi">
                                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="number" class="form-control" id="biaya" aria-describedby="biaya">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
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
                                                        <th><center>Biaya</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $no = 1; 
                                                    foreach ($data as $value) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td><center><?= $no++; ?></center></td>
                                                        <td><center><?= $value['instansi']; ?></center></td>
                                                        <td><center><?= "Rp" . number_format($value['biaya'],2,',','.'); ?></center></td>
                                                        <td>
                                                            <center>
                                                            <a href="javascript:;" 
                                                                data-instansi="<?= $value['instansi']; ?>"
                                                                data-biaya="<?= $value['biaya']; ?>"
                                                                class="btn btn-warning btn-sm" data-toggle="modal" 
                                                                data-target="#exampleModalUpdate">Ubah</a>
                                                            <!-- <button class="btn btn-danger btn-sm">Hapus</button> -->
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
      