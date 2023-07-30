<div class="container-fluid main-conteiner content">
   <div class="row">
         <div class="col-sm-12">
            <button class="btn btn-secondary mt-3">
               <i class="material-icons icon transaksi-btn">help_outline</i>
            </button>
            <div class="card mt-3 fullscreen cari-siswa">
               <div class="card-body d-flex justify-content-between">
                  <form class="form-inline">
                     <div class="form-group">
                        <label class="mx-2" for="keyword">NIPD / Nama Siswa</label>
                        <input type="text" class="form-control" id="keyword" placeholder="Masukkan NIPD / Nama " name="keyword">
                     </div>
                  </form>
                  <form class="form-inline">
                     <div class=" inputtahun">
                        <label for="thn_akademikList">Tahun Akademik</label>
                        <select id="thn_akademikList" class="form-select" name="thn_akademik">
                           <?php
                           ?>
                           <option selected value="<?= $data[1][0]['thn_akademik'];?>"><?= $data[1][0]['thn_akademik'];?></option>
                           <?php
                           foreach ($data[0] as $value) {
                              if($value['thn_akademik'] === $data[1][0]['thn_akademik']){
                                 continue;
                             }
                           ?>
                           <option value="<?= $value['thn_akademik'];?>"><?= $value['thn_akademik'];?></option>
                           <?php
                           }
                           ?>
                        </select>
                     </div>
                  </form>
               </div>
            </div>

            
                     
               <!-- Detail Biaya Modal -->
            <div class="modal fade" id="detailBiayaModal" tabindex="-1" aria-labelledby="detailBiayaModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailBiayaModalLabel">Detail Biaya</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body ">
                        <ul class="detailBiayaContent list-group list-group-flush">
                        </ul>
                        <div class="totalBiaya">

                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>

               <!-- Detail Nominal Masuk -->
            <div class="modal fade" id="detailNominalMasukModal" tabindex="-1" aria-labelledby="detailNominalMasukModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h1 class="modal-title fs-5" id="detailNominalMasukModalLabel">Detail Nominal Masuk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body ">
                        <ul class="detailNominalMasukContent list-group list-group-flush">
                        </ul>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>
            
            <!-- Modal Insert-->
            <div class="modal fade" id="insertTransaksi" tabindex="-1" aria-labelledby="insertTransaksiLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                           <h4 class="modal-title" id="insertTransaksiLabel">Data Transaksi</h4>
                           <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                           </button>
                     </div>
                     <div class="modal-body">
                           <form method="post" action="<?= base_url('admin/tambahDataTransaksi');?>"> 
                              <div class="form-group">
                                 <label for="nipdInsert">NIPD</label>
                                 <input type="text" readonly name="nipdInsert"  class="form-control" id="nipdInsert" aria-describedby="nipdInsert">
                              </div>
                              <div class="form-group">
                                 <label for="thn_akademikInsert">Tahun Akademik</label>
                                 <input type="text" readonly name="thn_akademikInsert"  class="form-control" id="thn_akademikInsert" aria-describedby="thn_akademikInsert">
                              </div>
                              <div class="form-group">
                                 <label for="nominalInsert">Nominal Bayar</label>
                                 <input type="number" name="nominalInsert" class="form-control" id="nominalInsert" aria-describedby="nominalInsert">
                                 <small class="text-danger" id="nominalInsert-error"></small>
                              </div>
                              <div class="form-group">
                                 <label for="keteranganInsert">Keterangan</label>
                                 <input type="text" name="keteranganInsert" class="form-control" id="keteranganInsert" aria-describedby="keteranganInsert">
                                 <small class="text-danger" id="keteranganInsert-error"></small>
                              </div>
                              <div class="form-group">
                                 <label for="bulanAwalPembayaran">Rentang Awal Tanggal</label>
                                 <input type="month" name="bulanAwalPembayaran" class="form-control" id="bulanAwalPembayaran" aria-describedby="bulanAwalPembayaran">
                                 <small class="text-danger" id="bulanAwalPembayaran-error"></small>
                              </div>
                              <div class="form-group">
                                 <label for="bulanAkhirPembayaran">Rentang Akhir Tanggal</label>
                                 <input type="month" name="bulanAkhirPembayaran" class="form-control" id="bulanAkhirPembayaran" aria-describedby="bulanAkhirPembayaran">
                                 <small class="text-danger" id="bulanAkhirPembayaran-error"></small>
                              </div>
                              <div class="form-group">
                                 <label for="statusInsert">Status</label>
                                 <input type="text" readonly value="Diterima" name="statusInsert" class="form-control" id="statusInsert" aria-describedby="statusInsert">
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

            <!-- Show Image Modal -->
            <div class="modal fade" id="showImageModal" tabindex="-1" aria-labelledby="showImageModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                     <div class="modal-header">
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                     <img class="img-fluid image" src="" alt="">
                     </div>
                     <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     </div>
                  </div>
               </div>
            </div>

            <!-- Transaction Confirm Modal -->
            <div class="modal fade" id="RestoreConfirmModal" tabindex="-1" aria-labelledby="RestoreConfirmModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h1 class="modal-title fs-5" id="RestoreConfirmModalLabel">Konfirmasi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        Apakah Anda yakin ingin menerima atau menolak data ini? Data yang sudah diterima atau ditolak akan
                        tersimpan permanen dan tidak dapat diubah kembali ke semula.
                     </div>
                     <div class="modal-footer">
                       <button type="button" data-status="2" class="btn confirmModal btn-primary">Terima</button>
                       <button type="button" data-status="0" class="btn confirmModal btn-danger text-white">Tolak</button>
                     </div>
                  </div>
               </div>
            </div>

         </div>
         <div hidden id="biodata" class="col-sm-12">
            
            <div class="card mt-4 shadow fullscreen">
               <div class="card-header border-bottom">
                  <div class="card-title">
                     <h5>Biodata Siswa</h5>
                  </div>
               </div>

               <div class="card-body">
                  <h5 class="text-danger" id="message"></h5>
                  <div class="table-responsive ">
                     <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row mt-3">
                           <div class="col-sm-12 ">
                              <table class="table hidden-overflow table-striped" id="dataTables-example">
                                 <tbody class="table-bordered">
                                    <tr>
                                       <td>NIPD</td>
                                       <td align="left" id="nipd"></td>
                                    </tr>
                                    <tr >
                                       <td>Nama</td>
                                       <td align="left" id="nama_siswa"></td>
                                    </tr>
                                    <tr>
                                       <td>Kelas</td>
                                       <td align="left" id="kelas"></td>
                                    </tr>
                                    <tr>
                                       <td>Instansi</td>
                                       <td align="left"id="instansi"></td>
                                    </tr>
                                    <tr>
                                       <td>Tahun Akademik</td>
                                       <td align="left"id="thn_akademik"></td>
                                    </tr>
                                   <tr>
                                       <td>Potongan</td>
                                       <td align="left" id="potongan"></td>
                                    </tr>
                                    <tr>
                                       <td>Status</td>
                                       <td align="left" id="status"></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
       
            <div class="card transactions mt-4 mb-2 fullscreen">
               <div class="card-body">
                  <div class="table-responsive">
                     <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                           <div class="col-sm-12 mb-2 d-flex justify-content-between align-items-center">
                              <div id="dataTable_filter">
                                    <h5>Data Pembayaran</h5>
                              </div>
                              <div class="media">
                                    <a href="javascript:void(0);" class="icon-circle icon-30 content-color-secondary fullscreenbtn form-control-sm">
                                    <i class="material-icons ">crop_free</i>
                                    </a>
                              </div>
                              
                           </div>
                           
                        </div>
                        <div class="row">
                           <div class="col-sm-12 hidden-overflow">
                              
                              <button type="button" class="btn btn-success mb-3 mt-3 " id="insertDataTransaksi" data-bs-toggle="modal" data-bs-target="#insertTransaksi">
                                 Tambah Data (Jika Membayar dengan Cash)
                              </button>
                              <div class="nominal-container d-flex justify-content-between">
                                 <div>
                                    <h5 align="left">Nominal Masuk</h5>
                                    <h4 align="left" id="nominalmasuk" class="text-primary"></h4>
                                    <button class="btn btn-small btn-primary detailNominalMasuk">Detail Nominal Masuk</button>
                                 </div>
                                 <div class="d-flex flex-sm-column justify-content-end mb-3">
                                    <h5 align="right">Total Biaya</h5>
                                    <h4 align="right" id="totalnominal" class="text-primary"></h4>
                                    <button class="btn btn-small btn-primary detailBiaya">Detail Biaya</button>
                                 </div>
                              </div>
                                 
                              <table class="table hidden-overflow " id="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <center>No</center>
                                       </th>
                                       <th>
                                          <center>NIPD</center>
                                       </th>
                                       <th>
                                          <center>Nominal</center>
                                       </th>
                                       <th>
                                          <center>Bulan Pembayaran</center>
                                       </th>
                                       <th>
                                          <center>Bukti</center>
                                       </th>
                                       <th>
                                          <center>keterangan</center>
                                       </th>
                                       <th>
                                          <center>Tanggal bayar</center>
                                       </th>
                                       <th>
                                          <center>Status</center>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div id="pagination-container">
                        <ul class="pagination">
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            </div>
      <div class="col-sm-12">
         <div class="card shadow mb-3 mt-3 fullscreen cetak-transaksi">
            <div class="card-header py-3">
               <h5>Cetak Rekap Seluruh Data Pembayaran</h5>
               <div role="alert" id="errormessage"></div>
               <?= $this->session->flashdata('message'); ?>
            </div>
            <div class="card-body" id="form">
               <form action="<?= base_url('admin/cetakDataTransaksi'); ?>" method="post">
                  <div class="form-group row tanggal-transaksi">
                     <input hidden name="function" value="cetak" type="text">
                     <input hidden id="nipd-print" name="nipd" type="text">
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
   </div>
         <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
         <script>
            // pagination
            let data = [];
            let itemsPerPage = 10;
            let currentPage = 1;
            let totalPages;

            var biayaSisa;
            var potongan;
            var created_at;
            var nipd;
          
            let IDR = new Intl.NumberFormat('id-ID', {
               style: 'currency',
               currency: 'IDR',
            });
            $(document).ready(function() {
               $('#keyword').keyup(function(){
                  fetchSearchResults();
               });

               $('#thn_akademikList').change(function(){
                  fetchSearchResults();
               });

               function fetchSearchResults(){
                  let searchText = $('#keyword').val();
                  let thn_akademik = $('#thn_akademikList').val();
                  if(searchText == "") {
                     $('#biodata').attr('hidden', true);
                     $('#form .form-group').find('#nipd-print').attr("value", '');
                  } else {
                     $.ajax({
                        url: '<?= base_url('admin/cariDataTransaksi')?>',
                        method: 'GET',
                        data: { query: searchText, thn_akademik: thn_akademik },
                        success: function(response) {
                           $('#biodata').removeAttr('hidden');
                           
                           if (response.dataSiswa !== undefined) {
                              console.log(response);

                              $('#table tbody').empty();
                              $('.transactions').show();
                              $('.add-transaction').find('#nominaltransaction').attr("value", response.dataBiaya);
                              $('#nipdInsert').attr('value', response.dataSiswa.nipd);
                              $('#thn_akademikInsert').attr('value', response.dataSiswa.thn_akademik);
                              $.each(response.dataSiswa, function(index, item) {
                                 $('#dataTables-example').show();
                                 $('#message').empty();
                                 let data = $('#' + index);
                                 data.html(item);
                              });

                              
                              if((response.dataBiaya).length === 0) {
                                 $('.detailBiaya').prop('disabled', true);
                                 $('.nominal-container').find('#totalnominal').html(IDR.format(0));
                                 $('.nominal-container').find('#nominalmasuk').html(IDR.format(0));
                              } else {
                                 $('.detailBiaya').prop('disabled', false);
                                 // Total Biaya
                                 $('.nominal-container').find('#totalnominal').html(IDR.format((response.biaya - 
                                 response.dataSiswa.potongan) * 12));

                                 // Biaya Masuk
                                 $('.nominal-container').find('#nominalmasuk').html(IDR.format(response.nominalMasuk));
                                 if(response.nominalMasuk == ((response.biaya - response.dataSiswa.potongan) * 12)){
                                    $('#insertDataTransaksi').prop('disabled', true);
                                 } else {
                                    $('#insertDataTransaksi').prop('disabled', false);
                                 }
                              }

                              $('.detailBiayaContent').empty();
                              $('.detailNominalMasukContent').empty();
                              //Detail Biaya
                              $.each(response.dataBiaya, function(index, item){
                                 let detailBiaya = `
                                    <li class="list-group-item">
                                       <div class=" d-flex align-items-center justify-content-between">
                                       <p class="fw-semibold fs-6">${item.jenis_pembayaran}</p> <p class="fw-semibold fs-6">${IDR.format(item.biaya)}</p>
                                       </div>
                                    </li>
                                 `;
                                 $('.detailBiayaContent').append(detailBiaya);
                              });

                              //Potongan dan Detail Biaya
                              $('.detailBiayaContent').append(`
                                 <li class="list-group-item">
                                    <div class=" d-flex align-items-center justify-content-between">
                                    <p class="fw-semibold fs-6">Total Biaya</p>
                                    <p class="fw-semibold fs-6">${IDR.format(response.biaya)}</p>
                                    </div>
                                 </li>
                                 <li class="list-group-item">
                                    <div class=" d-flex align-items-center justify-content-between">
                                    <p class="fw-semibold fs-6">Potongan Biaya</p>
                                    <p class="fw-semibold fs-6">${IDR.format(response.dataSiswa.potongan)}</p>
                                    </div>
                                 </li>
                                 <li class="list-group-item">
                                    <div class=" d-flex align-items-center justify-content-between">
                                    <p class="fw-semibold fs-6">Total Seluruh Biaya</p>
                                    <p class="fw-semibold fs-6 w-50">(Total Biaya - Potongan Biaya) x 12 bulan =
                                    ${IDR.format((response.biaya - response.dataSiswa.potongan) * 12)}</p>
                                    </div>
                                 </li>
                              `);

                              $.each(response.dataNominalMasuk, function(index, item){
                                 let bulan = new Date(item.bulan);
                                 let month = bulan.toLocaleString('id-ID', {month: 'long'});
                                 let detailNominalMasuk = `
                                    <li class="list-group-item">
                                       <div class=" d-flex align-items-center justify-content-between">
                                       <p class="fw-semibold fs-6">${month}</p> <p class="fw-semibold fs-6">${IDR.format(item.nominal)}</p>
                                       </div>
                                    </li>
                                 `;
                                 $('.detailNominalMasukContent').append(detailNominalMasuk);
                              });

                              if(response.dataTransaksi !== undefined) {
                                 
                                 data = response.dataTransaksi;
                                 startIndex = (currentPage - 1) * itemsPerPage + 1;
                                 endIndex = startIndex + itemsPerPage - 1;
                                 totalPages = Math.ceil(data.length / itemsPerPage);
                                 pageData = data.slice(startIndex - 1, endIndex);

                                 $.each(pageData, function(index, item) {
                                    let bulan = new Date(item.bulan);
                                    let month = bulan.toLocaleString('id-ID', {month: 'long'});
                                    let no = startIndex + index;
                                    let row = `<tr>
                                             <td><center>${no++}</center></td>
                                             <td><center>${item.nipd}</center></td>
                                             <td><center>${IDR.format(item.nominal)}</center></td>
                                             <td><center>${month}</center></td>
                                             <td><center>${item.image !== null ? `<button class="btn btn-small btn-primary
                                             showImage" data-bs-toggle="modal" data-bs-target="#showImageModal" 
                                             data-image="${item.image}">
                                             Bukti
                                             </button>` : "Tidak Ada"}</center></td>
                                             <td><center>${item.keterangan}</center></td>
                                             <td><center>${item.created_at}</center></td>
                                             <td><center><button class="update-link btn text-white" 
                                             data-created-at="${item.created_at}"
                                             data-nipd="${item.nipd}">${item.status}
                                             </button></center></td>
                                             '</tr>`;
                                    $('#table tbody').append(row);
                                    $('.showImage').click(function() {
                                       var imageSrc = $(this).data('image');
                                       $('.image').attr('src', `<?= base_url();?>/uploads/${imageSrc}`);
                                    });
                                    if(item.status == "2"){
                                       $(`.update-link[data-created-at="${item.created_at}"]`).prop('disabled', true).addClass('btn-secondary').text('Diterima');
                                    } else if(item.status == "1"){
                                       $(`.update-link[data-created-at="${item.created_at}"]`).addClass('btn-warning').text('Ditunggu');
                                    } else if(item.status == "0") {
                                       $(`.update-link[data-created-at="${item.created_at}"]`).prop('disabled', true).addClass('btn-danger').text('Ditolak');
                                    }
                                    // $('.add-transaction').find('#nipdtransaction').attr("value", item.nipd);
                                    $('#form .form-group').find('#nipd-print').attr("value", item.nipd);
                                 });
                                 if ((currentPage === 1 && pageData.length >= 10)) {
                                    renderPagination(totalPages);
                                 } else if(currentPage !== 1){
                                    renderPagination(totalPages);
                                 } else {
                                    $('.pagination').empty();
                                 }
                                 
                                 $('#transaction h5').empty();
                              } else {
                                    let emptyRow = `<tr><td colspan="8"><center>${response.errors}</center></td></tr>`;
                                    $('#table tbody').append(emptyRow);
                                    $('.pagination').empty();
                              }
                           } else {
                              if (!$('#message').text().includes(response.errors)) {
                                 $('#message').append(response.errors);
                              }
                              $('#dataTables-example').hide();
                              $('.transactions').hide();
                           }
                        },
                        error: function(xhr, status, error) {
                           console.error(error);
                           $('#result').append(`<li>${error}</li>`); // Handle the error if necessary
                        }
                     });
                  }
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

               $('#insertTransaksi').on('hide.bs.modal', function(event) {
                  $(this).find('.text-danger');
               });

               $('#insertTransaksi').on('submit', 'form' , function (event) {
                  event.preventDefault();
                  let form = $(this);

                  let data = {
                     nipdInsert: form.find('input[name="nipdInsert"]').val(),
                     thn_akademikInsert: form.find('input[name="thn_akademikInsert"]').val(),
                     nominalInsert: form.find('input[name="nominalInsert"]').val(),
                     keteranganInsert: form.find('input[name="keteranganInsert"]').val(),
                     bulanAwalPembayaran: form.find('input[name="bulanAwalPembayaran"]').val(),
                     bulanAkhirPembayaran: form.find('input[name="bulanAkhirPembayaran"]').val(),
                     status: 2,
                  };
                  if(data.nominalInsert > biayaSisa) {
                     console.log('kelebihan!', biayaSisa);
                     let errorElement = $('#nominalInsert-error');
                     errorElement.html("Biaya yang dibayar lebih dari nominal yang ditentukan!");
                  } else {
                     $.ajax({
                         url: form.attr('action'),
                         method: form.attr('method'),
                         data: data,
                         dataType: 'json' ,
                         success: function (response) {
                           console.log(response);
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
                             console.error(xhr, status,error);
                         }
                     }); 
                  }
               });

               $('.detailBiaya').click(function(){
                  $('#detailBiayaModal').modal('show');
               });
               
               $('.detailNominalMasuk').click(function(){
                  $('#detailNominalMasukModal').modal('show');
               });

               $('.pagination').on('click', 'a.page-link', function(e) {
                  e.preventDefault();
                  
                  let targetPage = parseInt($(this).data('page'));
                  if(targetPage === currentPage + 1 && currentPage === totalPages){
                     currentPage = 1;
                  } else {
                     currentPage = targetPage;
                  }
                  fetchSearchResults();
                  renderPagination();
               });

               $('#table').on('click', '.update-link' ,function(event) {  
                  event.preventDefault();        
                  created_at = $(this).data('created-at');
                  nipd = $(this).data('nipd');
                  $('#RestoreConfirmModal').modal('show');
               });

               $('.confirmModal').click(function(){
                  let thn_akademik = $('#thn_akademikList').val();
                  let status = $(this).data('status');
                  const data = {status: status, created_at: created_at, nipd: nipd, thn_akademik: thn_akademik }
                  $('#RestoreConfirmModal').modal('hide');
                  $.ajax({
                     url: '<?= base_url('admin/validasiPembayaran')?>',
                     method: 'POST',
                     data: data,
                     success: function(response) {
                        $('#RestoreConfirmModal').modal('hide');
                        console.log(response);
                        // Update the status element with the new value
                        if(response.value[0] == 2){
                           $(`.update-link[data-created-at="${response.value[1]}"]`).data('status', response.value[0]).text("Diterima");
                           $(`.update-link[data-created-at="${response.value[1]}"]`).prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary');
                        } else if(response.value[0] == 0){
                           $(`.update-link[data-created-at="${response.value[1]}"]`).data('status', response.value[0]).text("Ditolak");
                           $(`.update-link[data-created-at="${response.value[1]}"]`).prop('disabled', true).removeClass('btn-warning').addClass('btn-danger');
                        }
                        $('.nominal-container').find('#nominalmasuk').html(IDR.format(response.value[2]));
                        
                     },
                     error: function(xhr, status, error) {
                     // Handle the error if necessary
                        console.error(error);
                     }
                  });
               });

            });
             
        </script>
</div>
