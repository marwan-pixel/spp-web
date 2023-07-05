
<main style="height:80vh " class="d-flex align-items-center content">
    <div class="container ">
        <div class="card mx-auto col-lg-5">
            <div class="container-md">
                <div class="card-body">
                    <form class="mt-3" >
                        <?= $this->session->flashdata('message'); ?>
                        <div class="form-group mb-3">
                            <h4 class="text-center font-weight-light">Informasi Administrator</h4>
                        </div>
                        <div class="form-group ml-3 mr-3" >
                            <label for="exampleInputUsername1">ID</label>
                            <input type="text" class="form-control" disabled value="<?= $kode; ?>" id="exampleInputUsername1" aria-describedby="emailHelp" >
                        </div>
                            <div class="form-group ml-3 mr-3" >
                            <label for="exampleInputUsername1">Nama Administrator</label>
                            <input type="text" class="form-control" disabled value="<?= $name; ?>" id="exampleInputUsername1" aria-describedby="emailHelp" >
                        </div>

                    </form>
                    <div class="form-group ml-3 mr-3">
                        <button data-bs-toggle="modal" data-bs-target="#updateDataAdmin" class="btn btn-block btn-success">Ubah Data Admin</button>
                    </div>
                    <div class="modal fade" id="updateDataAdmin" tabindex="-1" aria-labelledby="updateDataAdminLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLabel">Informasi Administrator</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>                        
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataAdmin');?>">
                                    <input hidden type="text" class="form-control" name="kode_petugas" value="<?= $kode; ?>" id="exampleInputUsername1" aria-describedby="emailHelp" >
                                    <div class="form-group">
                                        <label for="nama">Nama Administrator</label>
                                        <input type="text" value="<?= $name; ?>" class="form-control" name="nama" id="nama" aria-describedby="nama">
                                        <small class="text-danger" id="nama-errorUpdate"></small>
                                    </div>
                                    <div class="mb-2 d-flex">
                                        <p class="mr-1">Ingin mengubah password?</p><a href="#passwordCollapse" data-bs-toggle="collapse">Klik di sini</a>
                                    </div>
                                    <div class="collapse" id="passwordCollapse">
                                         <div class="form-group">
                                            <label for="password">Password Baru</label>
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
                                            <small class="text-danger" id="password-errorUpdate"></small>
                                        </div>
                                         <div class="form-group">
                                            <label for="confPassword">Konfirmasi Password Baru</label>
                                            <input type="password" class="form-control" name="confPassword" id="confPassword" aria-describedby="confPassword">
                                            <small class="text-danger" id="confPassword-errorUpdate"></small>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="update-errorUpdate"></small>
                                    <div class="modal-footer">
                                        <a class="text-light btn btn-secondary" data-bs-dismiss="modal">Close</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
    <script src="<?= base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script>
        $(document).ready(function() {
                //Modal Config Update Data Kelas
                $('#updateDataAdmin').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateDataAdmin').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var kode_petugas = form.find('input[name="kode_petugas"]').val();
                    var nama = form.find('input[name="nama"]').val();
                    var password = form.find('input[name="password"]').val();
                    var confPassword = form.find('input[name="confPassword"]').val();
    
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json' ,
                        success: function (response) {
                            console.log(response);
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#updateDataAdmin').modal('hide');
                            } else {                           
                                var errors = response.errors;
                                $.each(errors, function (field, message) {
                                let errorElement = $('#' + field + '-errorUpdate');
                                console.log(message);
                                errorElement.html(message);
                            })
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                })               
            })
        })   
    </script>
