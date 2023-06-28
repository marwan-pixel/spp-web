<!-- content page -->
        <div class="container-fluid mt-4 main-container">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                    Tambah Data
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Tahun Akademik</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataTahunAkademik'); ?>">                               
                                    <div class="form-group">
                                        <label for="tahun_ganjil">Tahun Ganjil</label>
                                        <input type="number" min="1900" max="2099" onchange="getYear(this.value)" name="thn_akademik" class="form-control" id="tahun_ganjil" aria-describedby="tahun_ganjil">
                                                                                                                            
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_genap">Tahun Genap</label>
                                        <input readonly type="number" name="tahun_genap" class="form-control" id="tahun_genap" aria-describedby="tahun_genap">
                                    </div>
                                    <small class="text-danger" id="thn_akademik-error"></small>
                                    <div class="form-group">
                                        <label for="status">Keterangan:</label>
                                        <input type="radio" value="1" name="status" id="status_aktif">
                                        <label for="status_aktif">Aktif</label>
                                        <input type="radio" value="0" name="status" id="status_tidak-aktif">
                                        <label for="status_tidak-aktif">Tidak Aktif</label>
                                        <small class="text-danger" id="status-error"></small>
                                    </div>   
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Update -->
                <div class="modal fade" id="updateTahun" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateTahunLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="updateTahunLabel">Data Biaya</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataTahunAkademik')?>">
                                    <div class="form-group">
                                        <label for="tahun_ganjil">Tahun Ganjil</label>
                                        <input type="text" onchange="getYear(this.value)" name="thn_akademik" class="form-control" id="thn_akademik" aria-describedby="thn_akademik">
                                                                                                                           
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_genap">Tahun Genap</label>
                                        <input disabled type="number" name="tahun_genap" class="form-control" id="tahun_genap_update" aria-describedby="tahun_genap">
                                    </div>
                                    <small class="text-danger" id="thn_akademik-error"></small>
                                    <div class="form-group">
                                        <label for="status">Keterangan:</label>
                                        <input type="radio" value="1" name="status" id="status_aktif">
                                        <label for="status_aktif">Aktif</label>
                                        <input type="radio" value="0" name="status" id="status_tidak-aktif">
                                        <label for="status_tidak-aktif">Tidak Aktif</label>
                                        <small class="text-danger" id="status-error"></small>
                                    </div>  
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
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
                                                        <th><center>Tahun Akademik</center> </th>
                                                        <th><center>Status</center></th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(count($data) === 0) {
                                                        ?>
                                                        <tr>
                                                            <th colspan="4"><center><h5>Data belum tersedia</h5></center></th>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        $no = 1; 
                                                        foreach ($data as $value) {
                                                        ?>
                                                        <tr class="odd">
                                                            <td><center><?= $no++; ?></center></td>
                                                            <td><center><?= $value['thn_akademik']; ?></center></td>
                                                            <td><center><?= $value['status'] == 1 ? "Aktif" : "Tidak Aktif"; ?></center></td>
                                                            <td>
                                                                <center>
                                                                <a href="javascript:;" 
                                                                    data-thn_akademik="<?= $value['thn_akademik']; ?>"                                                            
                                                                    data-status="<?= $value['status']; ?>"
                                                                    class="btn btn-warning btn-sm updateData" data-toggle="modal"
                                                                    data-target="#updateTahun">Ubah</a>
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
           
            function getYear(value) {
                var yearsend = parseInt(value) + 1;
                $("#tahun_genap").val(yearsend);
                $("#tahun_genap_update").val(yearsend);
	        }

            $(document).ready(function() {
                //Modal Config Input Data Kelas
                $('#exampleModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModal').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var tahun_ganjil = form.find('input[name="thn_akademik"]').val();             
                    var tahun_genap = form.find('input[name="tahun_genap"]').val();
                    var status = form.find('input[name="status"]:checked').val();

                    if(form.find('input[name="thn_akademik"]').val() === "" 
                    || form.find('input[name="tahun_genap"]').val() === ""){
                        $('#thn_akademik-error').html("Tahun Akademik tidak boleh kosong!");
                    } else {
                        var thn_akademik = `${tahun_ganjil}/${tahun_genap}`;
                        $.ajax({
                            url: form.attr('action'),
                            method: form.attr('method'),
                            data: {thn_akademik: thn_akademik, status: status},
                            dataType: 'json' ,
                            success: function (response) {
         
                                if(response.success) {
                                    window.location.href = response.redirect;
                                    $('#exampleModal').modal('hide');
                                } else {             
                                    var errors = response.errors;
                                    $.each(errors, function (field, message) {
                                        let errorElement = $('#' + field + '-error');
                                        errorElement.html(message);
                                    })
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        })                
                    }
                })

                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#updateTahun').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this)

                    var year = div.data(`thn_akademik`);
                    var yearValues = year.split("/");
                    var tahun_awal = parseInt(yearValues[0]);
                    var tahun_akhir = parseInt(yearValues[1]);   
                        // Isi nilai pada field
                    modal.find(`#thn_akademik`).attr("value",tahun_awal);
                    modal.find(`#tahun_genap_update`).attr("value",tahun_akhir);
                    modal.find(`input[name="status"][value="${div.data('status')}"]`).prop('checked', true);
                });

                //Modal Config Update Data Kelas
                $('#updateTahun').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateTahun').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var tahun_ganjil = form.find('input[name="thn_akademik"]').val();             
                    var tahun_genap = form.find('input[name="tahun_genap"]').val();
                    var status = form.find('input[name="status"]:checked').val();
                    if(form.find('input[name="thn_akademik"]').val() === "" 
                    || form.find('input[name="tahun_genap"]').val() === ""){
                        $('#thn_akademik-error').html("Tahun Akademik tidak boleh kosong!");
                    } else {
                        var thn_akademik = `${tahun_ganjil}/${tahun_genap}`;
                        $.ajax({
                            url: form.attr('action'),
                            method: form.attr('method'),
                            data: {thn_akademik: thn_akademik, status: status},
                            dataType: 'json' ,
                            success: function (response) {
                                console.log(response)
                                if(response.success) {
                                    window.location.href = response.redirect;
                                    $('#exampleModal').modal('hide');
                                } else {             
                                    var errors = response.errors;
                                    $.each(errors, function (field, message) {
                                        let errorElement = $('#' + field + '-error');
                                        errorElement.html(message);
                                    })
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        })                
                    }             
                })
            })   
        </script>