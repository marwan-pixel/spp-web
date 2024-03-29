<!-- content page -->
<div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success mb-3 biaya-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                    </button>
                    <!-- <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon biaya-btn">help_outline</i>
                    </button> -->
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Biaya</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataBiaya'); ?>">                               
                                    <div class="form-group">
                                        <label for="jenis_pembayaran">Jenis Biaya</label>
                                        <input type="text" name="jenis_pembayaran" class="form-control" id="jenis_pembayaran" aria-describedby="jenis_pembayaran">
                                        <small class="text-danger" id="jenis_pembayaran-error"></small>                                                                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="biaya">Biaya</label>
                                        <input type="number" name="biaya" class="form-control" id="biaya" aria-describedby="biaya">
                                        <small class="text-danger" id="biaya-error"></small>                                                                     
                                    </div>
                                    <div class="form-group">
                                    <label for="InputKelas">Instansi</label>
                                        <select class="form-select" name="instansi" id="instansi">
                                        <?php 
                                        foreach ($data['dataInstansi'] as $value) {
                                            ?>
                                             <option value="<?=$value['jenis_instansi'];?>"><?=$value['jenis_instansi'];?></option>
                                            <?php
                                        }
                                        ?>
                                        </select>
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
                                            <div id="dataTable_filter" class="d-flex justify-content-between input-group">
                                                <form class="biaya-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Jenis Pembayaran</label>
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Jenis Pembayaran" aria-controls="dataTable">
                                                    </div>
                                                </form>
                                                <form class="form mr-2">
                                                    <div class="form-group inputtahun">
                                                       <label for="instansiList">Instansi</label>
                                                       <select id="instansiList" class="form-select" name="kelas">
                                                          <?php
                                                          ?>
                                                          <option selected value="">Semua</option>
                                                          <?php 
                                                            foreach ($data['dataInstansi'] as $value) {
                                                                ?>
                                                                <option value="<?=$value['jenis_instansi'];?>"><?=$value['jenis_instansi'];?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                       </select>
                                                    </div>
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

                                            <table class="table hidden-overflow" id="table">
                                                <thead>
                                                    <tr>
                                                        <th><center>No</center></th>
                                                        <th><center>Jenis Biaya</center> </th>
                                                        <th><center>Biaya</center></th>
                                                        <th class="biaya-instansi"><center>Instansi</center></th>                                                        
                                                        <th class="biaya-update"><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.table-responsive -->
                            <div id="pagination-container ">
                                <ul class="pagination mt-3">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content page ends -->
        <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script>
            let itemsPerPage = 10;
            let currentPage = 1;
            var totalPages;
            let data = [];
            var id_jenis_pembayaran;
            let IDR = new Intl.NumberFormat('id-ID', {
               style: 'currency',
               currency: 'IDR',
            });
            $(document).ready(function() {
                $('#cari').keyup(function(){
                    getData();
                });

                $('#instansiList').change(function(){
                    getData();
                });
                
                $('#instansiList').ready(function(){
                    getData();
                });

                function getData(){
                    let keyword = $('#cari').val();
                    let instansi = $('#instansiList').val();
                    $.ajax({
                        url: '<?= base_url('pages/dataBiayaData')?>',
                        method: 'GET',
                        data: {keyword: keyword, instansi: instansi, status: 1},
                        success: function(response){
                            $('#table tbody').empty();
                            if((response.dataBiaya).length !== 0) {
                                data = response.dataBiaya;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.jenis_pembayaran}</center></td>
                                        <td><center>${IDR.format(item.biaya)}</center></td>
                                        <td><center>${item.instansi}</center></td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <a href="javascript:;" 
                                                    data-id_jenis_pembayaran="${item.id_jenis_pembayaran}"                                                            
                                                    data-jenis_pembayaran="${item.jenis_pembayaran}"
                                                    data-biaya="${item.biaya}"
                                                    data-instansi="${item.instansi}"                                                                
                                                    class="btn btn-warning btn-sm updateData mr-2" data-bs-toggle="modal"
                                                    data-bs-target="#updateBiaya">Ubah
                                                </a>
                                                <a href="javascript:;"
                                                    data-id_jenis_pembayaran="${item.id_jenis_pembayaran}"
                                                    class="btn btn-danger btn-sm deleteData">
                                                    <i class="material-icons icon">delete</i>
                                                </a>
                                            </div>
                                        </td>
                                    '</tr>`;
                                    $('#table tbody').append(row);
                                });
                                if ((currentPage === 1 && pageData.length >= 10)) {
                                    renderPagination(totalPages, 4);
                                } else if(currentPage !== 1){
                                    renderPagination(totalPages, 4);
                                } else {
                                    $('.pagination').empty();
                                }
                            } else {
                                let emptyRow = `<tr><td colspan="5"><center><h5>Data belum tersedia!</h5></center></td></tr>`;
                                $('#table tbody').append(emptyRow);
                                $('.pagination').empty();
                            }
                            $('.jumlahKelas').html(response.dataKelasTotal);
                        }
    
                    });
                }

                function renderPagination(totalPages, visiblePages) {
                    // Clear the pagination container
                    $('.pagination').empty();
                    
                    // Calculate the range of pages to be displayed
                    var startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
                    var endPage = Math.min(totalPages, startPage + visiblePages - 1);
                    startPage = Math.max(1, endPage - visiblePages + 1);

                    var pageLinks = '';
                    if (currentPage > 1) {
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="first">First</a></li>';
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="prev">&laquo;</a></li>';
                    }
                    for (var i = startPage; i <= endPage; i++) {
                        var activeClass = i === currentPage ? 'active' : '';
                        var pageLink = '<li class="page-item ' + activeClass + '">' +
                            '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a>' +
                            '</li>';
                        pageLinks += pageLink;
                    }
                    if (currentPage < totalPages) {
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="next">&raquo;</a></li>';
                        pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="last">Last</a></li>';
                    }
                    
                    $('.pagination').append(pageLinks);
                }

                $('.pagination').on('click', 'a.page-link', function(e) {
                    e.preventDefault();

                    let targetPage = $(this).data('page');

                    if (targetPage === 'first') {
                        currentPage = 1;
                    } else if (targetPage === 'prev') {
                        currentPage = Math.max(1, currentPage - 1);
                    } else if (targetPage === 'next') {
                        currentPage = Math.min(totalPages, currentPage + 1);
                    } else if (targetPage === 'last') {
                        currentPage = totalPages;
                    } else {
                        currentPage = parseInt(targetPage);
                    }
                   getData();
                   renderPagination(totalPages, 4);
                });

                //Modal Config Input Data Biaya
                $('#exampleModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModal').on('submit', 'form' , function (event) {
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
                                $('#exampleModal').modal('hide');
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

                //Modal Config Get Selected Data Biaya
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

                //Modal Config Update Data Biaya
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

                $('#table').on('click', '.deleteData' ,function(event) {  
                    event.preventDefault();
                    id_jenis_pembayaran = $(this).data('id_jenis_pembayaran');
                    $('#DeleteConfirmBiaya').modal('show');
                });

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
        </script>
