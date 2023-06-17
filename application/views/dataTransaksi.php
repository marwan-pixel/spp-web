<div class="container-fluid main-conteiner">


   <div class="row">
      <div class="col-sm-12">
         <div class="card mt-4 fullscreen ">
            <div class="card-body">
               <form method="post" action="<?= base_url('admin/cariDataTransaksi')?>" class="form-inline">
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
            $dataSiswa = $this->input->get('dataSiswa');
            $dataTransaksi = $this->input->get('dataTransaksi');
            if(!is_null($dataSiswa) && !is_null($dataTransaksi)):
         ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Data Kelas</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <form method="post" action="<?=  base_url('admin/tambahDataTransaksi'); ?>">
                           <div class="form-group">
                              <label for="nipd">NIPD</label>
                              <input disabled value="<?= $dataSiswa['nipd'] ;?>" type="text" name="nipd" class="form-control" id="nipd" aria-describedby="nipd">
                           </div>
                           <div class="form-group">
                              <label for="nominal">Nominal</label>
                              <input type="number" name="nominal" class="form-control" id="nominal" aria-describedby="nominal">
                              <small id="nominal-error" class="text-danger"></small>
                           </div>
                           <div class="form-group">
                              <label for="status">Status</label>
                              <input type="text" disabled value="Diterima" name="status" class="form-control" id="status" aria-describedby="status">
                           </div>
                           <div class="form-group">
                              <label for="Keterangan">Keterangan</label>
                              <input type="text" name="keterangan" class="form-control" id="keterangan" aria-describedby="Keterangan">
                              <small id="keterangan-error" class="text-danger"></small>
                           </div>
                           <div class="form-group">
                              <label for="created_at">Tanggal Bayar</label>
                              <input type="date" name="created_at" class="form-control" id="created_at" aria-describedby="created_at">
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
            </div>

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
                                       <td><?= $dataSiswa['nipd'] ;?></td>
                                    </tr>
                                    <tr>
                                       <td>Nama</td>
                                       <td><?= $dataSiswa['nama_siswa'] ;?></td>
                                    </tr>
                                    <tr>
                                       <td>Kelas</td>
                                       <td><?= $dataSiswa['kelas'] ;?></td>
                                    </tr>
                                    <tr>
                                       <td>Instansi</td>
                                       <td><?= $dataSiswa['instansi'] ;?></td>
                                    </tr>
                                   <tr>
                                       <td>Potongan</td>
                                       <td><?= $dataSiswa['potongan'] ;?></td>
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
                                 <button type="button" class="btn btn-success ml-3 mb-3" data-toggle="modal" data-target="#exampleModal">
                                    Tambah Data (Jika Membayar dengan Cash)
                                 </button>
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
                                    if(count($dataTransaksi) != 0){
                                       $no = 1;
                                       foreach ($dataTransaksi as $value) {
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
                                             <center>
                                                <a id="update-link" href="<?= base_url('admin/validasiPembayaran') . '?' .
                                                http_build_query(array('param1' => $value['status'], 'param2' => $value['created_at']
                                                , 'nipd' => $value['nipd']));?>"
                                                class="btn <?= $value['status'] == "Diterima" ? "btn-success" : "btn-warning";?>">
                                                <?= $value['status']; ?></a>
                                             </center>
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
            endif;
            if ($this->session->has_userdata('search_message')): ?>
               <div class="alert mt-3 alert-danger">
                  <?= $this->session->userdata('search_message'); ?>
               </div>
         <?php
         // Clear the search message from session or storage
               $this->session->unset_userdata('search_message');
            endif; ?>
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
                     <input hidden name="nipd" value="<?= $dataSiswa['nipd'] ?? '' ;?>" type="text">
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
         <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
         <script>
            $(document).ready(function() {
                //Modal Config Input Data Kelas
                $('#exampleModal').on('hide.bs.modal', function(event) {
                    $(this).find('.text-danger');
                });
    
                $('#exampleModal').on('submit', 'form' , function (event) {
                    event.preventDefault();
    
                    var form = $(this);
                    var nipd = form.find('input[name="nipd"]').val();                  
                    var nominal = form.find('input[name="nominal"]').val();
                    var status = form.find('input[name="status"]').val();
                    var keterangan = form.find('input[name="keterangan"]').val();
                    var created_at = form.find('input[name="created_at"]').val();
    
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        dataType: 'json' ,
                        success: function (response) {
     
                            if(response.success) {
                                window.location.href = response.redirect;
                                $('#exampleModal').modal('hide');
                            } else {             
                                var errors = response.errors;
                                $.each(errors, function (field, message) {
                                    let errorElement = $('#' + field + '-error');
                                    errorElement.html(message);
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
        </script>
</div>
