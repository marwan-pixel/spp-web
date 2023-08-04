<!-- content page -->
        <div class="container-fluid mt-4 main-container content">
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-sm-12">
                    <button type="button" class="btn btn-success ml-3 mb-3 thn-akademik-add" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                    </button>
                    <button class="btn btn-secondary mb-3 ">
                        <i class="material-icons icon thn-akademik-btn">help_outline</i>
                    </button>
                </div>

                <!-- Modal Insert-->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="exampleModalLabel">Data Tahun Akademik</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                                    <div class="form-check">
                                        <input class="form-check-input" name="status" type="checkbox" id="status">
                                        <label class="form-check-label" for="status">
                                            Status: Aktif/Tidak Aktif
                                        </label>
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
                <div class="modal fade" id="updateTahun" tabindex="-1" aria-labelledby="updateTahunLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="updateTahunLabel">Data Tahun Akademik</h4>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?= base_url('Admin/ubahDataTahunAkademik')?>">
                                    <input hidden type="text" name="thn_akademikold" id="thn_akademikold">
                                    <div class="form-group">
                                        <label for="tahun_ganjil">Tahun Ganjil</label>
                                        <input type="text" onchange="getYear(this.value)" name="thn_akademik" class="form-control" id="thn_akademik" aria-describedby="thn_akademik">                                                                 
                                    </div>
                                    <div class="form-group">
                                        <label for="tahun_genap">Tahun Genap</label>
                                        <input disabled type="number" name="tahun_genap" class="form-control" id="tahun_genap_update" aria-describedby="tahun_genap">
                                    </div>
                                    <small class="text-danger" id="thn_akademik-errorUpdate"></small>

                                    <div hidden id="statusUpdate" class="form-group ">
                                        <label for="status">Status:</label>
                                        <input type="radio" value="0" name="status" id="status_aktif">
                                        <label for="status_aktif">Aktif</label>
                                        <small class="text-danger" id="status-errorUpdate"></small>
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
                <div class="col-sm-12">
                    <div class="card mb-4 fullscreen">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 d-flex justify-content-between">
                                            <div id="dataTable_filter" class="dataTables_filter input-group col-sm-4 ">
                                                <form class="thn-akademik-cari">
                                                    <div class="form-group mb-2 ">
                                                        <label for="cari">Tahun Akademik</label>
                                                        <input type="text" size="20" class="form-control mr-2" id="cari" name="keyword" placeholder="Cari Tahun Akademik" aria-controls="dataTable">
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
                                                        <th><center>Tahun Akademik</center> </th>
                                                        <th class="thn-akademik-status"><center>Status</center></th>
                                                        <th class="thn-akademik-update"><center>Aksi</center></th>
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
            function getYear(value) {
                let yearsend = parseInt(value) + 1;
                $("#tahun_genap").val(yearsend);
                $("#tahun_genap_update").val(yearsend);
	        }

            $(document).ready(function() {
                getData();

                $('#cari').keyup(function(){
                    getData();
                });

                function getData(){
                    let keyword = $('#cari').val();
                    $.ajax({
                        url: '<?= base_url('pages/dataTahunAkademikData')?>',
                        method: 'GET',
                        data: {keyword: keyword, status: 1},
                        success: function(response){
                            $('#table tbody').empty();
                            if((response.dataTahunAkademik).length !== 0) {
                                data = response.dataTahunAkademik;
                                startIndex = (currentPage - 1) * itemsPerPage + 1;
                                endIndex = startIndex + itemsPerPage - 1;
                                totalPages = Math.ceil(data.length / itemsPerPage);
                                pageData = data.slice(startIndex - 1, endIndex);
                                $.each(pageData, function(index, item){
                                    let no = startIndex + index;
                                    let row = 
                                    `<tr>
                                        <td><center>${no++}</center></td>
                                        <td><center>${item.thn_akademik}</center></td>
                                        <td><center>${item.status == 1 ? 'Aktif' : 'Tidak Aktif'}</center></td>
                                        <td><center>
                                        <a href="javascript:;" 
                                            data-thn_akademikold="${item.thn_akademik}"
                                            data-thn_akademik="${item.thn_akademik}"                                                            
                                            data-status="${item.status}"
                                            class="btn btn-warning btn-sm updateData" data-bs-toggle="modal"
                                            data-bs-target="#updateTahun">Ubah
                                        </a>
                                    </center></td>
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
    
                    let form = $(this);
                    let tahun_ganjil = form.find('input[name="thn_akademik"]').val();             
                    let tahun_genap = form.find('input[name="tahun_genap"]').val();
                    let status = form.find('input[name="status"]').is(':checked');
                    if(status){
                        status = 1;
                    } else {
                        status = 0;
                    }
                    if(form.find('input[name="thn_akademik"]').val() === "" 
                    || form.find('input[name="tahun_genap"]').val() === ""){
                        $('#thn_akademik-error').html("Tahun Akademik tidak boleh kosong!");
                    } else {
                        let thn_akademik = `${tahun_ganjil}/${tahun_genap}`;
                        $.ajax({
                            url: form.attr('action'),
                            method: form.attr('method'),
                            data: {thn_akademik: thn_akademik, status: status},
                            dataType: 'json',
                            success: function (response) {
         
                                if(response.success) {
                                    window.location.href = response.redirect;
                                    $('#exampleModal').modal('hide');
                                } else {             
                                    let errors = response.errors;
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
                    }
                });

                //Modal Config Get Selected Data Kelas
                // Untuk sunting
                $('#updateTahun').on('show.bs.modal', function (event) {
                    let div = $(event.relatedTarget) // Tombol dimana modal di tampilkan
                    let modal = $(this)

                    let year = div.data(`thn_akademik`);
                    let yearValues = year.split("/");
                    let tahun_awal = parseInt(yearValues[0]);
                    let tahun_akhir = parseInt(yearValues[1]);

                        // Isi nilai pada field
                    modal.find(`#thn_akademik`).attr("value",tahun_awal);
                    modal.find(`#tahun_genap_update`).attr("value",tahun_akhir);
                    modal.find(`#thn_akademikold`).attr("value", div.data('thn_akademikold'));

                    let status = $(div).data('status');
                    if(status == 0){
                        $('#statusUpdate').attr('hidden', false);
                    } else {
                        $('#statusUpdate').attr('hidden', true);
                    }
                });

                //Modal Config Update Data Kelas
                $('#updateTahun').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#updateTahun').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    let form = $(this);
                    let thn_akademikold = form.find('input[name="thn_akademikold"]').val();             
                    let tahun_ganjil = form.find('input[name="thn_akademik"]').val();             
                    let tahun_genap = form.find('input[name="tahun_genap"]').val();
                    let status = form.find('input[name="status"]:checked').val();
                    if (status == 0) {
                        status = 1;
                    }
                    if(form.find('input[name="thn_akademik"]').val() === "" 
                    || form.find('input[name="tahun_genap"]').val() === ""){
                        $('#thn_akademik-error').html("Tahun Akademik tidak boleh kosong!");
                    } else {
                        let thn_akademik = `${tahun_ganjil}/${tahun_genap}`;
                        $.ajax({
                            url: form.attr('action'),
                            method: form.attr('method'),
                            data: {thn_akademik: thn_akademik, status: status, thn_akademikold: thn_akademikold},
                            dataType: 'json',
                            success: function (response) {
                                if(response.success) {
                                    window.location.href = response.redirect;
                                    $('#exampleModal').modal('hide');
                                } else {             
                                    let errors = response.errors;
                                    $.each(errors, function (field, message) {
                                        console.log(field)
                                        let errorElement = $('#' + field + '-errorUpdate');
                                        errorElement.html(message);
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });           
                    }             
                });
            });
        </script>