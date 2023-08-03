<!-- content page -->
<div class="container-fluid mt-4 main-container content">
    <div class="row">
        <div class="col-sm-12">
            <button class="btn btn-secondary mb-3 ">
                <i class="material-icons icon siswa-btn">help_outline</i>
            </button>
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
            $.ajax({
                url: '<?= base_url('pages/dataTransaksiHomeData');?>',
                method: 'GET',
                data: {kelas: kelas, status: status, keyword: keyword},
                dataType: 'json',
                success: function(response) {
                    console.log(response)
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
                            renderPagination(totalPages);
                         } else if(currentPage !== 1){
                            renderPagination(totalPages);
                         } else {
                            $('.pagination').empty();
                         }
                    } else {
                        let emptyRow = `<tr><td colspan="8"><center>Data Belum Tersedia</center></td></tr>`;
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

    });
</script>