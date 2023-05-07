<main style="height:80vh " class="d-flex align-items-center">
    <div class="container ">
        <div class="card mx-auto col-lg-5">
            <div class="container-md">
                <div class="card-body">
                    <form class="mt-3" >
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group mb-3">
                            <h4 class="text-center font-weight-light">Informasi Administrator</h4>
                        </div>
                        <div class="form-group ml-3 mr-3 was-validation" >
                            <label for="exampleInputUsername1">ID</label>
                            <input type="text" class="form-control" disabled value="" id="exampleInputUsername1" aria-describedby="emailHelp" >
                        </div>
                            <div class="form-group ml-3 mr-3 was-validation" >
                            <label for="exampleInputUsername1">Nama Administrator</label>
                            <input type="text" class="form-control" disabled value="" id="exampleInputUsername1" aria-describedby="emailHelp" >
                        </div>
                        <div class="form-group ml-3 mr-3 has-validation">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" disabled value="" id="exampleInputPassword1">
                        </div>
                    </form>
                    <div class="form-group ml-3 mr-3">
                        <button data-toggle="modal" data-target="#updateDataAdmin" class="btn btn-block btn-success">Ubah Data Admin</button>
                    </div>
                    <div class="modal fade" id="updateDataAdmin" tabindex="-1" aria-labelledby="updateDataAdminLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Data Siswa</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>                        
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form method="post" action="<?= site_url('dataadmin');?>">
                                    <div class="form-group">
                                        <label for="InputNama">Nama Administrator</label>
                                        <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <p class="mr-1">Ingin mengubah password?</p><a href="#passwordCollapse" data-toggle="collapse">Klik di sini</a>
                                    </div>
                                    <div class="collapse" id="passwordCollapse">
                                        <div class="form-group">
                                            <label for="InputNama">Password Lama</label>
                                            <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                        </div>
                                         <div class="form-group">
                                            <label for="InputNama">Password Baru</label>
                                            <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                        </div>
                                         <div class="form-group">
                                            <label for="InputNama">Konfirmasi Password Baru</label>
                                            <input type="text" class="form-control" id="InputNama" aria-describedby="InputNama">
                                        </div>
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
                </div>
            </div>
         </div>
    </div>

</main>
