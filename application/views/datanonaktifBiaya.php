        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon nonaktifBiaya-btn">help_outline</i>
                    </button>
                </div>

                <!-- Restore Modal -->
                <div class="modal fade" id="RestoreConfirmBiaya" tabindex="-1" aria-labelledby="RestoreConfirmBiayaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="RestoreConfirmBiayaLabel">Konfirmasi</h1>
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

                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row mb-3">                                        
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="d-flex justify-content-between input-group">
                                                <form class="nonaktifBiaya-cari">
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
                                                        <th><center>Instansi</center></th>                                                        
                                                        <th class="nonaktifBiaya-update"><center>Aksi</center></th>
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
            let totalPages;
            let data = [];
            var id_jenis_pembayaran;
            var instansi;
            let IDR = new Intl.NumberFormat('id-ID', {
               style: 'currency',
               currency: 'IDR',
            });

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
                        url: '<?= base_url('pages/dataBiayaData')?>',
                        method: 'GET',
                        data: {keyword: keyword, instansi: instansi, status: 0},
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
                                        <td><center>
                                        <a class="btn btn-primary text-white restoreData" data-id_jenis_pembayaran=
                                        "${item.id_jenis_pembayaran}" data-instansi="${item.instansi}"
                                        ><i class="material-icons icon">restore</i></a>
                                        </center></td>
                                    '</tr>`;
                                    $('#table tbody').append(row);
                                });
                                if ((currentPage === 1 && pageData.length >= 10)) {
                                    renderPagination(totalPages);
                                } else if(currentPage !== 1){
                                    renderPagination(totalPages);
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

                function renderPagination(totalPages) {
                    // Clear the pagination container
                    $('.pagination').empty();
                    
                    // Generate the pagination links
                    for (var i = 1; i <= totalPages; i++) {
                       var activeClass = i === currentPage ? 'active' : '';
                       var pageLink = '<li class="page-item ' + activeClass + '">' +
                                      '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a>' +
                                      '</li>';
                       $('.pagination').append(pageLink);
                    }
                }

                $('.pagination').on('click', 'a.page-link', function(e) {
                   e.preventDefault();
                   
                   let targetPage = parseInt($(this).data('page'));
                   if(targetPage === currentPage + 1 && currentPage === totalPages){
                      currentPage = 1;
                   } else {
                      currentPage = targetPage;
                   }
                   getData();
                   renderPagination();
                });

                $('#table').on('click', '.restoreData' ,function(event) {  
                    instansi = $(this).data('instansi');
                    id_jenis_pembayaran = $(this).data('id_jenis_pembayaran');
                    event.preventDefault();
                    $('#RestoreConfirmBiaya').modal('show');
                });

                $('.restoreModal').click(function(){
                    $.ajax({
                        url: '<?= base_url('admin/restoreDataBiaya');?>',
                        method: 'POST',
                        data: {id_jenis_pembayaran: id_jenis_pembayaran, instansi: instansi},
                        dataType: 'json' ,
                        success: function (response) {
                            console.log(response)
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