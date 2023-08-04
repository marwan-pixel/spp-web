
        <!-- content page -->
        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success mb-3 instansi-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                    </button>
                    <button class="btn btn-secondary mb-3 instansi-btn">
                        <i class="material-icons icon">help_outline</i>
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Instansi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= site_url('Admin/tambahDataInstansi'); ?>">                               
                                    <div class="form-group">
                                        <label for="instansi">Instansi</label>
                                        <input type="text" name="instansi" class="form-control" id="instansi" aria-describedby="instansi">
                                        <small class="text-danger" id="instansi-error"></small>                                                                                    
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
                <div class="modal fade" id="updateInstansi" tabindex="-1" aria-labelledby="updateInstansiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="updateInstansiLabel">Data Instansi</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataInstansi')?>">
                                    <input hidden type="text" name="instansi"  class="form-control" id="instansi" aria-describedby="instansi">
                                    <div class="form-group">
                                        <label for="instansinew">Instansi</label>
                                        <input type="text" name="instansinew" class="form-control" id="instansinew" aria-describedby="instansinew">
                                        <small class="text-danger" id="instansinew-errorUpdate"></small> 
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

                <!-- Modal Confirm Delete-->
                <div class="modal fade" id="DeleteConfirmInstansi" tabindex="-1" aria-labelledby="DeleteConfirmInstansiLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="DeleteConfirmInstansiLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin menghapus data ini? Data yang terhapus ini secara otomatis
                            membuat data dari tabel yang berkaitan ikut terhapus, di antaranya: Data Kelas dan Data Biaya.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn modalDelete btn-danger text-white">Iya</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3 jumlah-instansi" style="border-radius: 20px">
                    <div class="card shadow-sm d-flex flex-fill">
                        <div class="card-body" >
                            <div class="media ">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Jumlah Instansi</p>
                                    <div class="d-flex justify-content-between">
                                        <p class=" content-color-primary mt-2 mb-3 fs-5 jumlahInstansi"></p>
                                    </div>
                                </div>
                                <h5 class="material-icons icon text-success">crop_square</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabel data instansi -->
                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4 ">
                                                <form class="instansi-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Nama Instansi</label>
                                                        <input type="text" size="20" class="form-control" id="cari" name="keyword" placeholder="Cari instansi" aria-controls="dataTable">
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
                                                        <th><center>Instansi</center> </th>
                                                        <th class="instansi-update"><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="pagination-container ">
                                <ul class="pagination mt-3">
                                </ul>
                            </div>
                            <!-- /.table-responsive -->
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
            var instansi;
            
            $(document).ready(function() {
                getData();
                $('#cari').keyup(function(){
                    getData();
                });

                function getData(){
                    let keyword = $('#cari').val();
                    $.ajax({
                        url: '<?= base_url('pages/dataInstansiData')?>',
                        method: 'GET',
                        data: {keyword: keyword, status: 1},
                        success: function(response){
                            $('#table tbody').empty();
                            if((response.dataInstansi).length !== 0) {
                                data = response.dataInstansi;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.jenis_instansi}</center></td>
                                        <td><center>
                                        <a href="javascript:;" 
                                            data-instansi="${item.jenis_instansi}"
                                            data-instansinew="${item.jenis_instansi}"
                                            class="btn btn-warning btn-sm updateData" data-bs-toggle="modal"
                                            data-bs-target="#updateInstansi"
                                        >Ubah</a>
                                        <a href="javascript:;"
                                            data-instansi="${item.jenis_instansi}"
                                            class="btn btn-danger btn-sm deleteData">
                                            <i class="material-icons icon">delete</i>
                                        </a></center></td>
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
                                let emptyRow = `<tr><td colspan="3"><center><h5>Data belum tersedia!</h5></center></td></tr>`;
                                $('#table tbody').append(emptyRow);
                                $('.pagination').empty();
                            }
                            $('.jumlahInstansi').html(response.dataInstansiTotal);
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

                    var pageLinks = '<li class="page-item"><a class="page-link" href="#" data-page="first">First</a></li>';
                    if (currentPage > 1) {
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
                    }
                    pageLinks += '<li class="page-item"><a class="page-link" href="#" data-page="last">Last</a></li>';
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

                //Modal Config Input Data Kelas
                $('#exampleModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModal').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var instansi = form.find('input[name="instansi"]').val();
    
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

                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#updateInstansi').on('show.bs.modal', function (event) {
                    var div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    var modal = $(this);

                        // Isi nilai pada field
                    modal.find(`#instansi`).attr("value",div.data(`instansi`));
                    modal.find(`#instansinew`).attr("value",div.data(`instansinew`));
                });

                //Modal Config Update Data Kelas
                $('#updateInstansi').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateInstansi').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var instansi = form.find('input[name="instansi"]').val();
                    var instansinew = form.find('input[name="instansinew"]').val();
                    
                    
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json' ,
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#updateInstansi').modal('hide');
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
                    instansi = $(this).data('instansi');
                    event.preventDefault();
                    $('#DeleteConfirmInstansi').modal('show');

                });

                $('.modalDelete').click(function(){
                    $.ajax({
                        url: '<?= base_url('admin/hapusDataInstansi');?>',
                        method: 'POST',
                        data: {instansi: instansi},
                        dataType: 'json' ,
                        success: function (response) {
                            if(response.success) {
                                window.location.href = response.redirect;
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error(error);
                        }
                    });
                });
            });
        </script>
      