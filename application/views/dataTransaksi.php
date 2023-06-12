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
                                       <td>Potongan</td>
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
                                    <?php
                                    if(count($data['dataTransaksi']) != 0){
                                       $no = 1;
                                       foreach ($data['dataTransaksi'] as $value) {
                                       ?>
                                       <tr>
                                          <th>
                                             <center><?= $no++; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['nipd']; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['nominal']; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['image']; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['keterangan']; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['created_at']; ?></center>
                                          </th>
                                          <th>
                                             <center><?= $value['status']; ?></center>
                                          </th>
                                       </tr>
                                       
                                    <?php
                                       }
                                    } else {
                                       ?>
                                       <tr>
                                          <th colspan="7">
                                             <center><h5>Data Belum Tersedia</h5></center>
                                          </th>
                                       </tr>
                                       <?php
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
               <div role="alert" id="errormessage"></div>
            </div>
            <div class="card-body" id="form">
               <form action="<?= base_url('admin/cetakDataTransaksi'); ?>" method="post">
                  <div class="form-group row">
                     <input hidden name="function" value="cetak" type="text">
                     <input hidden name="nipd" value="<?= $data['dataSiswa']['nipd'] ?? '' ;?>" type="text">
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
                     <div class="col-md-2">
                        <button type="submit" name="excel" value="excel" class="btn btn-success">Cetak (Excel)</button>
                     </div>
                     <div class="col-md-2">
                        <button type="submit" name="pdf" value="pdf" class="btn btn-danger">Cetak (PDF)</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>      
      </div>
   </div>
        <!-- <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script>
            
            $(document).ready(function() {
               $('#form').on('submit', 'form' , function (event) {
                  event.preventDefault();
    
                  var form = $(this);
                  var nipd = form.find('input[name="nipd"]').val();                  
                  var from = form.find('input[name="since"]').val();
                  var to = form.find('input[name="till"]').val();
                  var cetak = form.find('input[name="function"]').val();
    
                  $.ajax({
                     url: form.attr('action'),
                     method: form.attr('method'),
                     data: form.serialize(),
                     dataType: 'json' ,
                     success: function (response) {
                        if(response.success) {
                           $('#errormessage').hide();
                        } else {
                           console.log(errors)      
                           var errors = response.errors;
                           $.each(errors, function (field, message) {
                              let errorElement = $('#' + field);
                              errorElement.html(message).attr("class", "alert alert-danger");
                           })
                        }
                     },
                     error: function (xhr, status, error) {
                         console.error(error);
                         console.error(status);             
                     }
                  })                
               })
            })   
        </script> -->
</div>
