
<div class="container-fluid main-conteiner">
   <div class="row">
      <!-- Modal -->
      <div class="modal fade" id="searchModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">Detail Transaksi Siswa</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div class="card shadow fullscreen mt-2">
                     <div id="dataTable_filter" class="dataTables_filter ">
                        <form id="searchForm" method="post" action="<?= base_url('pages/datatransaksi')?>">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <td>
                                       <label class="input-group">NIS: </label>
                                    </td>
                                    <td>
                                       <input type="text" class="form-control col-sm-12" name="keyword">
                                    </td>
                                    <td>
                                       <button type="submit" class="btn btn-primary mb-2">Cari</button>
                                    </td>
                                 </tr>
                              </thead>
                           </table>
                        </form>
                     </div>
                  </div>
                  <?php 
                     if(($data['dataSiswa'])){
                  ?>
                  <div class="card shadow fullscreen mt-2">
                     <div class="card-body">
                        <div class="card-title">
                           <h5 class="text-primary">Informasi Siswa</h5>
                        </div>
                        <table class="table hidden-overflow table-striped" id="dataTables-example">
                           <tbody class="table-bordered">
                              <tr>
                                 <td>NIPD</td>
                                 <td><?= $data['dataSiswa']['nipd'] ;?></td>
                              </tr>
                              <tr>
                                 <td>Nama</td>
                                 <td><?= $data['dataSiswa']['nama_siswa'] ;?></td>
                              </tr>
                              <tr>
                                 <td>Kelas</td>
                                 <td><?= $data['dataSiswa']['kelas'] ;?></td>
                              </tr>
                              <tr>
                                 <td>Instansi</td>
                                 <td><?= $data['dataSiswa']['instansi'] ;?></td>
                              </tr>
                              <tr>
                                 <td>potongan</td>
                                 <td><?= $data['dataSiswa']['potongan'] ;?></td>
                              </tr>                                    
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card shadow fullscreen mt-2">
                     <a href="#collapseCardExample1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExamplex">
                        <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran SPP Kelas /  [Tahun / ]</h6>
                        <div class="row no-gutters align-items-center">
                           <div class="col-auto">
                              <div >SPP dibayar</div>
                           </div>
                           <div class="col">
                              <div class="progress progress-sm ml-2 mr-2">
                                 <div class="" role="progressbar" style="width: 10%" aria-valuenow="" aria-valuemin="0" aria-valuemax="12"></div>
                              </div>
                           </div>
                        </div>
                     </a>
                     <div class="collapse" id="collapseCardExample1">
                        <div class="card-body">
                           <div class="row">
                           <div class="col-sm-12">
                              <div class="card-header py-3">
                                 <h5>
                                    <b class="text-primary">Data Pembayaran</b>
                                    <button class="btn btn-primary"><i class="fa fa-print"></i> Cetak Rekap SPP</button>
                                 </h5>
                              </div>
                              <div class="table-responsive">
                              <table class="table hidden-overflow " id="dataTables-example">
                                 <thead>
                                    <tr>
                                       <th>
                                          <center>No</center>
                                       </th>
                                       <th>
                                          <center>Nomor Transaksi</center>
                                       </th>
                                       <th>
                                          <center>Nomor Induk Siswa</center>
                                       </th>
                                       <th>
                                          <center>Tanggal Pembayaran</center>
                                       </th>
                                       <th>
                                          <center>Nomor Pembayaran</center>
                                       </th>
                                       <th>
                                          <center>Biaya</center>
                                       </th>
                                       <th>
                                          <center>Kode Petugas</center>
                                       </th>
                                       <th>
                                          <center>Status</center>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr data-toggle="modal" data-target="#exampleModal" class="odd">
                                       <td>
                                          <center>1</center>
                                       </td>
                                       <td>
                                          <center>Nama</center>
                                       </td>
                                       <td>
                                          <center>23-02-2024</center>
                                       </td>
                                       <td>
                                          <center>infoatmaxartkiller.in</center>
                                       </td>
                                       <td>
                                          <center>+91 000 000 0000</center>
                                       </td>
                                       <td>
                                          <center>40</center>
                                       </td>
                                       <td>
                                          <center>
                                             <span class="btn btn-outline-success btn-sm">Active</span>
                                          </center>
                                       </td>
                                    </tr>
                                    <tr class="odd">
                                       <td>
                                          <center>1</center>
                                       </td>
                                       <td>
                                          <center>Nama</center>
                                       </td>
                                       <td>
                                          <center>23-02-2024</center>
                                       </td>
                                       <td>
                                          <center>infoatmaxartkiller.in</center>
                                       </td>
                                       <td>
                                          <center>+91 000 000 0000</center>
                                       </td>
                                       <td>
                                          <center>40</center>
                                       </td>
                                       <td>
                                          <center>
                                             <span class="btn btn-outline-success btn-sm">Active</span>
                                          </center>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              </div>
                           </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php      
                     }
                  ?>
                  <?php if ($this->session->has_userdata('search_message')): ?>
                     <div class="alert mt-3 alert-danger">
                        <?= $this->session->userdata('search_message'); ?>
                     </div>
                  <?php
                  // Clear the search message from session or storage
                     $this->session->unset_userdata('search_message');
                  ?>
                  <?php endif; ?>                  
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <div class="col-sm-12">
         <div class="card mt-4 mb-4 fullscreen">
            <div class="card-body">
               <div class="table-responsive">
                  <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                     <div class="row">
                        <div class="col-sm-12 d-flex justify-content-between">
                           <button class="btn btn-primary" data-toggle="modal" data-target="#searchModal">Data Transaksi Berdasarkan NIS</button>
                           <div class="media">
                              <a href="javascript:void(0);" class="icon-circle icon-30 content-color-secondary fullscreenbtn form-control-sm">
                              <i class="material-icons ">crop_free</i>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="row mt-3">
                        <div class="col-sm-12 ">
                           <table class="table hidden-overflow " id="dataTables-example">
                              <thead>
                                 <tr>
                                    <th>
                                       <center>No</center>
                                    </th>
                                    <th>
                                       <center>Nomor Transaksi</center>
                                    </th>
                                    <th>
                                       <center>NIPD</center>
                                    </th>
                                    <th>
                                       <center>Nominal</center>
                                    </th>
                                    <th>
                                       <center>Status</center>
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
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php
                                 if(count($data['dataTransaksi']) == 0){
                                    ?>
                                 <tr><td colspan="8"><center><h5>Data belum tersedia</h5></center></td></tr>
                                 <?php
                                 } else {
                                    foreach ($data['dataTransaksi'] as $value) {
                                    ?>
                                    <?php
                                    }
                                 }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="card shadow fullscreen">
            <div class="card-header py-3">
               <h5>Cetak Rekap Seluruh Data Pembayaran</h5>
            </div>
            <div class="card-body">
               <form action="">
                  <div class="form-group row">
                     <div class="col-sm-2">
                        <p class="text-primary" for="InputKelas">Cetak Berdasarkan Tanggal (Opsional)</p>
                     </div>                     
                     <div class="col-sm-2 mb-2">
                        <div class="input-group">
                           <input class="form-control" type="date" name="" id="">
                        </div>
                     </div>
                     <div class="col-sm-2">
                        <div class="input-group">
                           <input class="form-control" type="date" name="" id="">
                        </div>
                     </div>
                     </div>
                  <div class="row">
                        <div class="col-md-2">
                           <button class="btn btn-primary">Cetak</button>
                        </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
<script>
   $(document).ready(function() {
      $('#searchForm').submit(function(event) {
         // Prevent the default form submission behavior
         event.preventDefault();

         // Get the form data
         var formData = $(this);
         var nipd = formData.find('input[name="keyword"]').val();
         // Send the form data via AJAX
         $.ajax({
            url: formData.attr('action'),
            method: 'POST',
            data: formData.serialize(),
            dataType: 'json',
            success: function(response) {
               $('#modalContent').html(response);

               // Optionally, open the modal if it's not already open
               $('#searchModal').modal('show');
            },
            error: function(xhr, status, error) {
            // Handle the error if needed
            }
         });
      });
   });

</script>