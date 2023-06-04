<div class="container-fluid main-conteiner">
   <div class="row">
      <div class="col-sm-12">
         <div class="card mt-4 fullscreen ">
            <div class="card-body">
               <form method="post" action="<?= base_url('pages/datatransaksi')?>" class="form-inline">
                  <div class="form-group mb-2">
                     <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Masukkan NIPD Siswa">
                  </div>
                  <div class="form-group mx-sm-3 mb-2 col-sm-3">
                     <input type="text" class="form-control col-sm-12" name="keyword">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2">Cari</button>
               </form>
            </div>
         </div>
         <?php 
            if(($data['dataSiswa'])){
         ?>
         <div class="card mt-4 shadow fullscreen ">
               <div class="card-header border-bottom">
                  <div class="card-title">
                     <h5>Biodata Siswa</h5>
                  </div>
               </div>
       
               <div class="card-body">
                  <div class="table-responsive ">
                     <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row mt-3">
                           <div class="col-sm-12 ">
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
                     </div>
                  </div>
               </div>
         </div>
       
         <div class="card mt-4 mb-2 fullscreen">
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
                                       $no = 1;
                                       foreach ($data['dataTransaksi'] as $value) {
                                       ?>
                                       <th>
                                          <?= $no++; ?>
                                       </th>
                                       <th>
                                          <?= $value['no_transaksi']; ?>
                                       </th>
                                       <th>
                                           <?= $value['nipd']; ?>
                                       </th>
                                       <th>
                                           <?= $value['nominal']; ?>
                                       </th>
                                       <th>
                                           <?= $value['status']; ?>
                                       </th>
                                       <th>
                                           <?= $value['bukti']; ?>
                                       </th>
                                       <th>
                                           <?= $value['keterangan']; ?>
                                       </th>
                                       <th>
                                           <?= $value['created_at']; ?>
                                       </th>
                                       <?php
                                       
                                       }
                                    }
                                    ?>
                                    </tbody>
                                 </table>
                                 <!-- /.table-responsive -->
       
                              </div>
                           </div>
                        </div>
                        <?= $this->pagination->create_links();?>
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
      <div class="col-sm-12">
         <div class="card shadow mb-3 mt-3 fullscreen">
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