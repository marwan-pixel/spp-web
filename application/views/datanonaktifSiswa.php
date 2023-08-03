        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button class="btn btn-secondary mb-3">
                        <i class="material-icons icon nonaktifSiswa-btn">help_outline</i>
                    </button>
                </div>
                <div class="col-12 col-lg-3 mb-3 jumlah-siswa" style="border-radius: 20px">
                    <div class="card shadow-sm d-flex flex-fill">
                        <div class="card-body" >
                            <div class="media ">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Jumlah Siswa</p>
                                    <div class="d-flex justify-content-between">
                                        <p class=" content-color-primary mt-2 mb-3 fs-5 jumlahSiswa"></p>
                                    </div>
                                </div>
                                <h5 class="material-icons icon text-dark">person</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Restore Modal -->
                <div class="modal fade" id="RestoreConfirmSiswa" tabindex="-1" aria-labelledby="RestoreConfirmSiswaLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="RestoreConfirmSiswaLabel">Konfirmasi</h1>
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
                                                <form class=" nonaktifSiswa-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Nama Siswa</label>
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Nama Siswa" aria-controls="dataTable">
                                                    </div>
                                                </form>
                                                <form class="form mr-2">
                                                    <div class="form-group inputtahun">
                                                       <label for="kelasList">Kelas</label>
                                                       <select id="kelasList" class="form-select" name="kelas">
                                                          <?php
                                                          ?>
                                                          <option selected value="">Semua</option>
                                                          <?php
                                                          foreach ($data['dataKelas'] as $value) {
                                                          ?>
                                                          <option value="<?= $value['kelas'];?>"><?= $value['kelas'];?></option>
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
                                                        <th><center>NIPD</center> </th>
                                                        <th><center>Nama Siswa</center></th>
                                                        <th><center>Kelas</center></th>
                                                        <th><center>Tahun Akademik</center></th>
                                                        <th><center>Status</center></th>
                                                        <th class="nonaktifSiswa-update"><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="nonaktifSiswa-pagination mt-3">
                                <?= $this->pagination->create_links();?>
                            </div> -->
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
            var nipd, kelas;
            $(document).ready(function(){
                $('#cari').keyup(function(){
                    getData();
                });

                $('#kelasList').change(function(){
                    getData();
                });
                
                $('#kelasList').ready(function(){
                    getData();
                });

                function getData(){
                    let keyword = $('#cari').val();
                    let kelas = $('#kelasList').val();
                    $.ajax({
                        url: '<?= base_url('pages/dataSiswaData')?>',
                        method: 'GET',
                        data: {keyword: keyword, kelas: kelas, status: 0},
                        success: function(response){
                            $('#table tbody').empty();
                            console.log(response);
                            if((response.dataSiswa).length !== 0) {
                                data = response.dataSiswa;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.nipd}</center></td>
                                        <td><center>${item.nama_siswa}</center></td>
                                        <td><center>${item.kelas}</center></td>
                                        <td><center>${item.thn_akademik}</center></td>
                                        <td><center>${item.status == 0 ? 'Tidak Aktif' : 'Aktif'}</center></td>
                                        <td><center>
                                        <a class="btn btn-primary restoreData text-white" data-nipd="${item.nipd}"
                                            data-kelas="${item.kelas}">
                                            <i class="material-icons icon">restore</i>
                                        </a>
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
                                let emptyRow = `<tr><td colspan="7"><center><h5>Data belum tersedia!</h5></center></td></tr>`;
                                $('#table tbody').append(emptyRow);
                                $('.pagination').empty();
                            }
                            $('.jumlahSiswa').html(response.dataSiswaTotal);
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
                    nipd = $(this).data('nipd');
                    kelas = $(this).data('kelas');
                    event.preventDefault();
                    $('#RestoreConfirmSiswa').modal('show');
                });

                $('.restoreModal').click(function(){
                    $.ajax({
                        url: '<?= base_url('admin/restoreDataSiswa');?>',
                        method: 'POST',
                        data: {nipd: nipd, kelas: kelas},
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