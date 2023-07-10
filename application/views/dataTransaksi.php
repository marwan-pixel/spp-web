<div class="container-fluid main-conteiner content">
   <div class="row">
         <div class="col-sm-12">
            <button class="btn btn-secondary mt-3">
               <i class="material-icons icon transaksi-btn">help_outline</i>
            </button>
            <div class="card mt-3 fullscreen cari-siswa">
               <div class="card-body">
                  <form class="form-inline">
                     <div class="form-group mb-2">
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="NIPD / Nama Siswa ">
                     </div>
                     <div class="form-group mx-sm-3 mb-2 col-sm-3">
                        <input type="text" class="form-control col-sm-12" id="keyword" placeholder="Masukkan NIPD / Nama Siswa" name="keyword">
                     </div>
                  </form>
                  <ul class="list-group mx-sm-3 mb-2 col-sm-3" id="result"></ul>
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

            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Data Kelas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body add-transaction">
                        <form method="post" action="<?=  base_url('admin/tambahDataTransaksi'); ?>">
                           <div class="form-group">
                              <label for="nipd">NIPD</label>
                              <input disabled type="text" id="nipdtransaction" name="nipd" class="form-control"  aria-describedby="nipd">
                           </div>
                           <div class="form-group">
                              <label for="nominal">Nominal</label>
                              <input disabled type="number" name="nominal" class="form-control" id="nominaltransaction" aria-describedby="nominal">
                              <small id="nominal-error" class="text-danger"></small>
                           </div>
                           <div class="form-group">
                              <label for="status">Status</label>
                              <input type="text" disabled value="Diterima" name="status" class="form-control" id="status-transaction" aria-describedby="status">
                           </div>
                           <div class="form-group">
                              <label for="Keterangan">Keterangan</label>
                              <input type="text" name="keterangan" class="form-control" id="keterangan-transaction" aria-describedby="Keterangan">
                              <small id="keterangan-error" class="text-danger"></small>
                           </div>
                           <div class="form-group">
                              <label for="created_at">Tanggal Bayar</label>
                              <input type="date" name="created_at" class="form-control" id="created_at-transaction" aria-describedby="created_at">
                              <small id="created_at-error" class="text-danger"></small>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Tambah Data</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div> -->
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
                           <div class="col-sm-12 mb-2 d-flex justify-content-between">
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
                           <div class="row mt-3">
                              <div class="col-sm-12 hidden-overflow">
                                 <div class="nominal-container d-flex justify-content-between">
                                    <div>
                                       <h5 align="left">Nominal Masuk</h5>
                                       <h4 align="left" id="nominalmasuk" class="text-primary"></h4>
                                    </div>
                                    <div class="d-flex flex-sm-column justify-content-end">
                                       <h5 align="right">Total Biaya</h5>
                                       <h4 align="right" id="totalnominal" class="text-primary"></h4>
                                       <button data-bs-toggle="modal" data-bs-target="#totalBiaya" class="btn btn-small btn-primary">Detail Biaya</button>
                                    </div>
                                 </div>
                                 <!-- <button type="button" class="btn btn-success mb-3 mt-3" data-toggle="modal" data-target="#exampleModal">
                                       Tambah Data (Jika Membayar dengan Cash)
                                 </button> -->
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
                        <?= $this->pagination->create_links();?>
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
            let IDR = new Intl.NumberFormat('id-ID', {
               style: 'currency',
               currency: 'IDR',
            });
            $(document).ready(function() {
               $('#keyword').keyup(function(){
                  var searchText = $(this).val();
                  
                  if(searchText == "" ) {
                     $('#biodata').attr('hidden', true);
                     $('#form .form-group').find('#nipd-print').attr("value", '');
                  } else {
                     $.ajax({
                        url: '<?= base_url('admin/cariDataTransaksi')?>',
                        method: 'GET',
                        data: { query: searchText },
                        success: function(response) {
                           $('#biodata').removeAttr('hidden');
                           $('#table tbody').empty();
                           if (response.dataSiswa !== undefined) {
                              console.log(response.dataSiswa);
                              $('.transactions').show();
                              $('.add-transaction').find('#nominaltransaction').attr("value", response.dataNominal);
                              $.each(response.dataSiswa, function(index, item) {
                                 $('#dataTables-example').show();
                                 $('#message').empty();
                                 let data = $('#' + index);
                                 data.html(item);
                                 
                              });
                              
                              // Total Biaya
                              $('.nominal-container').find('#totalnominal').html(IDR.format((response.dataNominal - 
                              response.dataSiswa.potongan) * 12));

                              // Biaya Masuk
                              $('.nominal-container').find('#nominalmasuk').html(IDR.format(response.dataNominalMasuk));

                              if(response.dataTransaksi !== undefined) {
                                 let no = 1;
                                 $.each(response.dataTransaksi, function(index, item) {
                                    let row = `<tr>
                                             <td><center>${no++}</center></td>
                                             <td><center>${item.nipd}</center></td>
                                             <td><center>${IDR.format(item.nominal)}</center></td>
                                             <td><center>${item.image}</center></td>
                                             <td><center>${item.keterangan}</center></td>
                                             <td><center>${item.created_at}</center></td>
                                             <td><center><button class=" update-link btn text-white" 
                                             data-created-at="${item.created_at}"
                                             data-nipd="${item.nipd}">${item.status}
                                             </button></center></td>
                                             '</tr>`;
                                    $('#table tbody').append(row);
                                    if(item.status == "2"){
                                       $(`.update-link[data-created-at="${item.created_at}"]`).prop('disabled', true).addClass('btn-secondary').text('Diterima');
                                    } else if(item.status == "1"){
                                       $(`.update-link[data-created-at="${item.created_at}"]`).addClass('btn-warning').text('Ditunggu');
                                    } else {
                                       $(`.update-link[data-created-at="${item.created_at}"]`).prop('disabled', true).addClass('btn-danger').text('Ditolak');
                                    }
                                    // $('.add-transaction').find('#nipdtransaction').attr("value", item.nipd);
                                    $('#form .form-group').find('#nipd-print').attr("value", item.nipd);
                                 });
                                 $('#transaction h5').empty();
                              } else {
                                    let emptyRow = `<tr><td colspan="7"><center>${response.errors}</center></td></tr>`;
                                    $('#table tbody').append(emptyRow);
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
               })

               $('#table').on('click', '.update-link' ,function(event) {
                  event.preventDefault();
                  let created_at = $(this).data('created-at');
                  let nipd = $(this).data('nipd');
                  $('#RestoreConfirmModal').modal('show');
                  $('.confirmModal').click(function(){
                     let status = $(this).data('status');
                     $.ajax({
                        url: '<?= base_url('admin/validasiPembayaran')?>',
                        method: 'POST',
                        data: { status: status, created_at: created_at, nipd: nipd },
                        success: function(response) {
                           $('#RestoreConfirmModal').modal('hide');
                           console.log(response)
                           // Update the status element with the new value
                           if(response.value[0] == 2){
                              $(`.update-link[data-created-at="${response.value[1]}"]`).data('status', response.value[0]).text("Diterima");
                              $(`.update-link[data-created-at="${response.value[1]}"]`).prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary');
                           } else if(response.value[0] == 0){
                              $(`.update-link[data-created-at="${response.value[1]}"]`).data('status', response.value[0]).text("Diterima");
                              $(`.update-link[data-created-at="${response.value[1]}"]`).prop('disabled', true).removeClass('btn-warning').addClass('btn-secondary');
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

                //Modal Config Input Data Kelas
               //  $('#exampleModal').on('hide.bs.modal', function(event) {
               //      $(this).find('.text-danger');
               //  });
    
               //  $('#exampleModal').on('submit', 'form' , function (event) {
               //      event.preventDefault();
    
               //      let form = $(this);
               //      let nipd = form.find('input[name="nipd"]').val();                  
               //      let nominal = form.find('input[name="nominal"]').val();
               //      let status = form.find('input[name="status"]').val();
               //      let keterangan = form.find('input[name="keterangan"]').val();
               //      let created_at = form.find('input[name="created_at"]').val();
    
               //      $.ajax({
               //          url: form.attr('action'),
               //          method: form.attr('method'),
               //          data: form.serialize(),
               //          dataType: 'json' ,
               //          success: function (response) {
     
               //              if(response.success) {
               //                  window.location.href = response.redirect;
               //                  $('#exampleModal').modal('hide');
               //              } else {             
               //                  var errors = response.errors;
               //                  $.each(errors, function (field, message) {
               //                      let errorElement = $('#' + field + '-error');
               //                      errorElement.html(message);
               //                  })
               //              }
               //          },
               //          error: function (xhr, status, error) {
               //              console.error(error);
               //              console.error(status);
                            
               //          }
               //      })                
               //  })
            })   
             
        </script>
</div>
