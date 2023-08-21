<div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <!-- <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon nonaktifKelas-btn">help_outline</i>
                    </button> -->
                </div>

                <div class="modal fade" id="RestoreConfirmKelas" tabindex="-1" aria-labelledby="RestoreConfirmKelasLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="RestoreConfirmKelasLabel">Konfirmasi</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Apakah Anda yakin ingin memulihkan data ini?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                                <button type="button"  class="btn restoreModal btn-primary text-white">Iya</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-3 mb-3 jumlah-kelas" style="border-radius: 20px">
                    <div class="card shadow-sm d-flex flex-fill">
                        <div class="card-body" >
                            <div class="media ">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Jumlah Kelas</p>
                                    <div class="d-flex justify-content-between">
                                        <p class=" content-color-primary mt-2 mb-3 fs-5 jumlahKelas"></p>
                                    </div>
                                </div>
                                <h5 class="material-icons icon text-dark">group</h5>
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
                                            <div id="dataTable_filter" class="d-flex justify-content-between input-group">
                                                <form class="nonaktifKelas-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Kelas</label>
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Kelas" aria-controls="dataTable">
                                                    </div>
                                                </form>
                                                <form class="form mr-2">
                                                    <div class="form-group inputtahun">
                                                       <label for="instansiList">Kelas</label>
                                                       <select id="instansiList" class="form-select" name="instansi">
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
                                                        <th><center>Kelas</center></th>
                                                        <th><center>Instansi</center> </th>
                                                        <th class="nonaktifKelas-update"><center>Aksi</center></th>
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
        <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script>
            let itemsPerPage = 10;
            let currentPage = 1;
            var totalPages;
            let data = [];
            var kelas, instansi;
            $(document).ready(function(){
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
                        url: '<?= base_url('pages/dataKelasData')?>',
                        method: 'GET',
                        data: {keyword: keyword, instansi: instansi, status: 0},
                        success: function(response){
                            $('#table tbody').empty();
                            if((response.dataKelas).length !== 0) {
                                data = response.dataKelas;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.kelas}</center></td>
                                        <td><center>${item.instansi}</center></td>
                                        <td>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a class="btn btn-primary restoreData text-white"
                                            data-instansi="${item.instansi}" data-kelas=
                                            "${item.kelas}">
                                            <i class="material-icons icon">restore</i>
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
                                let emptyRow = `<tr><td colspan="4"><center><h5>Data belum tersedia!</h5></center></td></tr>`;
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

                $('#table').on('click', '.restoreData' ,function(event) {  
                    jenis_instansi = $(this).data('instansi');
                    kelas = $(this).data('kelas');
                    event.preventDefault();
                    $('#RestoreConfirmKelas').modal('show');

                });

                $('.restoreModal').click(function(){

                    $.ajax({
                        url: '<?= base_url('admin/restoreDataKelas');?>',
                        method: 'POST',
                        data: {jenis_instansi: jenis_instansi, kelas: kelas},
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
