
        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#insertSiswa">
                Tambah Data
                </button>
                <!-- Modal Insert -->
                <div class="modal fade" id="insertSiswa" tabindex="-1" aria-labelledby="insertSiswaLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="insertSiswaLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form method="post" action="<?=base_url('Admin/tambahDataSiswa');?>">
                                <div class="form-group">
                                    <label for="nipd">NIPD</label>
                                    <input value="<?= set_value('nipd');?>" type="number" name="nipd" class="form-control nipd" id="nipd" aria-describedby="InputNIS">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input value="<?= set_value('nama');?>" type="text" class="form-control nama" name="nama" id="nama" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select value="<?= set_value('kelas');?>" class="form-control kelas" name="kelas" id="kelas">
                                    <?php
                                        foreach ($data['dataKelas'] as $value) {
                                            ?>
                                        <option value="<?= $value['kelas']; ?>" id="kelas"><?= $value['kelas']; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" value="<?= set_value('password');?>" name="password" class="form-control" id="password" aria-describedby="InputNIS">
                                </div>
                                <div class="mb-2 d-flex">
                                    <p class="mr-1">Jika ingin memberikan potongan biaya, </p><a href="#potonganCollapse" data-toggle="collapse">Klik di sini</a>
                                </div>                                
                                <div class="form-group collapse" id="potonganCollapse">
                                    <label for="potongan">Potongan</label>
                                    <input type="number" value="<?= set_value('potongan');?>" class="form-control" name="potongan" id="potongan" aria-describedby="InputNIS">
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
                  <!-- Modal Update -->
                <div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalUpdateLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalUpdateLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                 <div class="form-group">
                                    <label for="nama">Nama Siswa</label>
                                    <input value="<?= set_value('nama');?>" type="text" class="form-control nama" name="nama" id="nama" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="kelas">Kelas</label>
                                    <select value="<?= set_value('kelas');?>" class="form-control kelas" name="kelas" id="kelas">
                                    <?php
                                        foreach ($data['dataKelas'] as $value) {
                                            ?>
                                        <option value="<?= $value['kelas']; ?>"><?= $value['kelas']; ?></option>
                                    <?php
                                        }
                                    ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="potongan">Potongan</label>
                                    <input type="number" value="<?= set_value('potongan');?>" class="form-control" name="potongan" id="potongan" aria-describedby="InputNIS">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 ">
                    <div class="card mb-4 fullscreen">
                        <!-- <div class="card-header">
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 mb-2 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="inputGroup-sizing-default">NIS</span>
                                                </div>
                                                <input type="search" size="30" class="form-control form-control ml-2" placeholder="Masukkan NIS Siswa" aria-controls="dataTable">
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
                                                        <th><center>NIPD</center> </th>
                                                        <th><center>Nama Siswa</center></th>
                                                        <th><center>Kelas</center></th>
                                                        <th><center>Password</center></th>
                                                        <th><center>Potongan</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data['dataSiswa']) == 0){                                                        
                                                    ?>
                                                    <tr>
                                                        <th colspan="7"><center><h5>Data belum tersedia</h5></center></th>
                                                    </tr>
                                                    <?php    
                                                    } else {
                                                        $no = 1;
                                                        foreach ($data['dataSiswa'] as $value) {
                                                    ?>
                                                    <tr class="odd">
                                                        <td><center><?= $no++ ;?></center></td>
                                                        <td><center><?= $value['nipd'] ;?></center></td>
                                                        <td><center><?= $value['nama_siswa'] ;?></center></td>
                                                        <td><center><?= $value['kelas'] ;?></center></td>
                                                        <td><center>****</center></td>
                                                        <td><center><?= $value['potongan'] ;?></center></td>
                                                        <td>
                                                            <center>
                                                            <a href="javascript:;" 
                                                            data-nama = "<?= $value['nama_siswa'] ;?>"
                                                            data-kelas = "<?= $value['kelas'] ;?>"
                                                            data-potongan = "<?= $value['potongan'] ;?>"
                                                            class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#exampleModalUpdate"
                                                            onclick="updateDataModal(['nama', 'kelas', 'potongan'])">Ubah</a>
                                                            <!-- <button class="btn btn-danger btn-sm">Hapus</button> -->                                                           
                                                            </center>
                                                       </td>
                                                    </tr>
                                                    <?php
                                                        } 
                                                    } 
                                                    ?>
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