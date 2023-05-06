        <!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <div class="row">
                <!-- Modal Insert -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Administrator</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="InputNIS">ID</label>
                                    <input type="text" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                 <div class="form-group">
                                    <label for="InputNIS">Nama</label>
                                    <input type="text" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
                                 <div class="form-group">
                                    <label for="InputNIS">Password</label>
                                    <input type="text" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
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
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Tahun Akademik</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="InputNIS">Tahun Akademik</label>
                                    <input type="text" class="form-control" id="InputNIS" aria-describedby="InputNIS">
                                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                                </div>
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
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row mb-3">                                        
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter ">
                                                <label class="input-group">
                                                    Kode ID:
                                                    <input type="search" size="30" class="form-control form-control ml-2" placeholder="Masukkan Kode Administrator" aria-controls="dataTable">
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
                                                        <th><center>ID Administrator</center></th>
                                                        <th><center>Nama</center></th>
                                                        <th><center>Password</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>1232</center></td>
                                                        <td><center>Nama</center></td> 
                                                        <td><center>*****</center></td>
                                                        <td>
                                                            <center>                                     
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalUpdate">Ubah</button>
                                                            </center>   
                                                         </td>
                                                    </tr>
                                                    <tr class="even ">
                                                        <td><center>1</center></td>
                                                        <td><center>1232</center></td>
                                                        <td><center>Nama</center></td> 
                                                        <td><center>*****</center></td>
                                                        <td>
                                                            <center>                                     
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalUpdate">Ubah</button>
                                                            </center>   
                                                         </td>
                                                    </tr>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>1232</center></td>
                                                        <td><center>Nama</center></td> 
                                                        <td><center>*****</center></td>
                                                        <td>
                                                            <center>                                     
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalUpdate">Ubah</button>
                                                            </center>   
                                                         </td>
                                                    </tr>
                                                    <tr class="even ">
                                                        <td><center>1</center></td>
                                                        <td><center>1232</center></td>
                                                        <td><center>Nama</center></td> 
                                                        <td><center>*****</center></td>
                                                        <td>
                                                            <center>                                     
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalUpdate">Ubah</button>
                                                            </center>   
                                                         </td>                  </tr>
                                                    <tr class="odd">
                                                        <td><center>1</center></td>
                                                        <td><center>1232</center></td>
                                                        <td><center>Nama</center></td> 
                                                        <td><center>*****</center></td>
                                                        <td>
                                                            <center>                                     
                                                            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModalUpdate">Ubah</button>
                                                            </center>   
                                                         </td>
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