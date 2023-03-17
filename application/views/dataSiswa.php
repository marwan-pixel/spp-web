        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <div class="row">
                <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
                </button>
                <!-- Modal Insert -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="InputNIS">NIS</label>
                                    <input type="number" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <label for="InputNama">Nama Siswa</label>
                                    <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Kelas</label>
                                    <select class="form-control" id="InputKelas">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Tahun Akademik</label>
                                    <select class="form-control" id="InputKelas">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputNIS">No. Telp</label>
                                    <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <label for="InputAlamat">Alamat</label>
                                    <textarea class="form-control" id="InputAlamat" rows="3"></textarea>                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- Modal Update -->
                <div class="modal fade" id="exampleModalUpdate" tabindex="-1" aria-labelledby="exampleModalLabelUpdate" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Siswa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="InputNIS">NIS</label>
                                    <input type="number" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <label for="InputNama">Nama Siswa</label>
                                    <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Kelas</label>
                                    <select class="form-control" id="InputKelas">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputKelas">Tahun Akademik</label>
                                    <select class="form-control" id="InputKelas">
                                        <option>1</option>
                                        <option>2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="InputNIS">No. Telp</label>
                                    <input type="tel" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                <div class="form-group">
                                    <label for="InputAlamat">Alamat</label>
                                    <textarea class="form-control" id="InputAlamat" rows="3"></textarea>                                </div>
                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <!-- <div class="card-header">
                        </div> -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter ">
                                                <label class="input-group">
                                                    NIS:
                                                    <input type="search" size="30" class="form-control form-control ml-2" placeholder="Masukkan NIS Siswa" aria-controls="dataTable">
                                                </label>
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
                                                        <th><center>NIS</center> </th>
                                                        <th><center>Nama Siswa</center></th>
                                                        <th><center>Kelas</center></th>
                                                        <th><center>Tahun Akademik</center></th>
                                                        <th><center>No. Telp</center></th>
                                                        <th><center>Alamat</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>Nama</center></td>
                                                        <td ><center>23-02-2024</center></td>
                                                        <td><center>infoatmaxartkiller.in</center></td>
                                                        <td><center>+91 000 000 0000</center></td>
                                                        <td><center>40</center></td>
                                                        <td><center><span class="btn btn-outline-success btn-sm">Active</span></center></td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#ExampleModalUpdate">Ubah</button>
                                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                                       </td>
                                                    </tr>
                                                    <tr class="even ">
                                                        <td><center>1</center></td>
                                                        <td><center>Nama</center></td>
                                                        <td ><center>23-02-2024</center></td>
                                                        <td><center>infoatmaxartkiller.in</center></td>
                                                        <td><center>+91 000 000 0000</center></td>
                                                        <td><center>40</center></td>
                                                        <td><center><span class="btn btn-outline-success btn-sm">Active</span></center></td>
                                                        <td>
                                                            <button class="btn btn-warning btn-sm">Ubah</button>
                                                            <button class="btn btn-danger btn-sm">Hapus</button>
                                                       </td>
                                                    </tr>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>Nama</center></td>
                                                        <td ><center>23-02-2024</center></td>
                                                        <td><center>infoatmaxartkiller.in</center></td>
                                                        <td><center>+91 000 000 0000</center></td>
                                                        <td><center>40</center></td>
                                                        <td><center><span class="btn btn-outline-success btn-sm">Active</span></center></td>
                                                    </tr>
                                                    <tr class="even ">
                                                        <td><center>1</center></td>
                                                        <td><center>Nama</center></td>
                                                        <td ><center>23-02-2024</center></td>
                                                        <td><center>infoatmaxartkiller.in</center></td>
                                                        <td><center>+91 000 000 0000</center></td>
                                                        <td><center>40</center></td>
                                                        <td><center><span class="btn btn-outline-success btn-sm">Active</span></center></td>                                    </tr>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>Nama</center></td>
                                                        <td ><center>23-02-2024</center></td>
                                                        <td><center>infoatmaxartkiller.in</center></td>
                                                        <td><center>+91 000 000 0000</center></td>
                                                        <td><center>40</center></td>
                                                        <td><center><span class="btn btn-outline-success btn-sm">Active</span></center></td>
                                                    </tr>
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