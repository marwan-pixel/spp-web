<!-- content page -->
<div class="container-fluid mt-4 main-container content">
    <div class="row">
        <div class="col-sm-12">
            <!-- <button class="btn btn-secondary mb-3 ">
                <i class="material-icons icon siswa-btn">help_outline</i>
            </button> -->
        </div>
    
        <!-- Tabel Data Siswa -->
        <div class="col-sm-12 ">
            <div class="card mb-4 fullscreen">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-sm-12 mb-2 d-flex justify-content-between">
                                    <div class="d-flex justify-content-content">
                                        <form class="form mr-2">
                                            <div class="form-group">
                                               <label for="keyword">Nama Siswa</label>
                                               <input type="text" class="form-control" id="keyword" placeholder="Masukkan Nama " name="keyword">
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
                                                  foreach ($data[0] as $value) {
                                                  ?>
                                                  <option value="<?= $value['kelas'];?>"><?= $value['kelas'];?></option>
                                                  <?php
                                                  }
                                                  ?>
                                               </select>
                                            </div>
                                        </form>
                                        <form class="form">
                                            <div class="form-group inputtahun">
                                               <label for="statusList">Status</label>
                                               <select id="statusList" class="form-select" name="status">
                                                  <option selected value="">Semua</option>
                                                  <option value="aktif">Aktif</option>
                                                  <option value="tidakAktif">Tidak Aktif</option>
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
                                                <th class="siswa-kelas"><center>Kelas</center></th>
                                                <th class="siswa-status_pembayaran"><center>Pembayaran Bulan Ini</center></th>
                                                <th class="siswa-update"><center>Aksi</center></th>
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
                    <div id="pagination-container">
                        <ul class="pagination">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="card shadow mb-3 mt-3 fullscreen cetak-transaksi">
        <div class="card-header py-3">
            <h5>Cetak Rekap Seluruh Data Pembayaran Semua Siswa</h5>
            <div role="alert" id="errormessage"></div>
            <?= $this->session->flashdata('message'); ?>
        </div>
        <div class="card-body" id="form">
            <form action="<?= base_url('admin/cetakDataTransaksi'); ?>" method="post">
                <div class="form-group row tanggal-transaksi">
                    <input hidden id="kelas" name="kelas" value="cetak" type="text">
                    <input hidden id="status" name="status" value="cetak" type="text">
                    <input hidden name="function" value="cetak" type="text">
                    <div class="col-sm-2">
                        <p class="text-primary" for="InputKelas">Cetak Berdasarkan Tanggal (Opsional)</p>
                    </div>                     
                    <div class="col-sm-2 mb-2">
                        <div class="input-group">
                        <input class="form-control" type="date" name="since" id="since">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="input-group">
                        <input class="form-control" type="date" name="till" id="till">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" name="excel" value="excel" class="btn btn-success">Cetak (Excel)</button>
                        <button type="submit" name="pdf" value="pdf" class="btn btn-danger">Cetak (PDF)</button>
                    </div>
                </div>
            </form>
        </div>
    </div>      
</div>
<script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
<script>
    let itemsPerPage = 10;
    let currentPage = 1;
    let totalPages;
    let data = [];
    $(document).ready(function(){
        
        $('#keyword').keyup(function(){
            getData();
        });

        $('#kelasList, #statusList').change(function(){
            getData();
        });
        
        $('#kelasList, #statusList').ready(function(){
            getData();
        });

        function getData(){
            let keyword = $('#keyword').val();
            let kelas = $('#kelasList').val();
            let status = $('#statusList').val();
            $('#form .form-group').find('#kelas').attr("value", $('#kelasList').val());
        $('#form .form-group').find('#status').attr("value", $('#statusList').val());
            $.ajax({
                url: '<?= base_url('pages/dataTransaksiHomeData');?>',
                method: 'GET',
                data: {kelas: kelas, status: status, keyword: keyword},
                dataType: 'json',
                success: function(response) {
                    $('#table tbody').empty();
                    if((response).length !== 0) {
                        data = response;
                        startIndex = (currentPage - 1) * itemsPerPage + 1;
                        endIndex = startIndex + itemsPerPage - 1;
                        totalPages = Math.ceil(data.length / itemsPerPage);
                        pageData = data.slice(startIndex - 1, endIndex);
                        $.each(pageData, function(index, item){
                            let no = startIndex + index;
                            let row = `<tr>
                            <td><center>${no++}</center></td>
                            <td><center>${item.nipd}</center></td>
                            <td><center>${item.nama_siswa}</center></td>
                            <td><center>${item.kelas}</center></td>
                            <td><center><b>${item.status}</b></center></td>
                            <td><center><button data-nipd=${item.nipd} class="detailTransaksi btn btn-primary text-white">
                            Detail</button></center></td>
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
                        let emptyRow = `<tr><td colspan="6"><center>Data Belum Tersedia</center></td></tr>`;
                        $('#table tbody').append(emptyRow);
                        $('.pagination').empty();
                    }
                }
            });
        }

        $('#table').on('click', '.detailTransaksi' ,function(event) {  
            event.preventDefault();
            let nipd = $(this).data('nipd');
            let detailURL = '<?= base_url();?>pages/datatransaksi?nipd=' + nipd;
            window.location.href = detailURL;
         });

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
    });
</script>
