
<div class="container-fluid main-conteiner">
   <div class="row">
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                              <form action="" method="get">
                                 <table class="table">
                                    <thead>
                                       <tr>
                                          <td >
                                             <label class="input-group">NIS: </label>
                                          </td>
                                          <td>
                                             <input type="text" size="30" placeholder="Masukkan NIS Siswa" class="form-control form-control ml-2" aria-controls="dataTable">
                                          </td>
                                          <td>
                                             <button class="btn btn-primary">Submit</button>
                                          </td>
                                       </tr>
                                    </thead>
                                 </table>
                              </form>
                        </div>
                  </div>
                  <div class="card shadow fullscreen mt-2">
                     <div class="card-body">
                        <div class="card-title">
                           <h5 class="text-primary">Informasi Siswa</h5>
                        </div>
                        <table class="table hidden-overflow" id="dataTables-example">
                           <tbody>
                              <tr data-toggle="modal" data-target="#exampleModal" class="odd">
                                 <td> NIS </td>
                                 <td> ------ </td>
                              </tr>
                              <tr>
                                 <td> Nama </td>
                                 <td> ------ </td>
                              </tr>
                              <tr>
                                 <td> Kelas </td>
                                 <td> ------ </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div class="card shadow fullscreen mt-2">
                     <a href="#collapseCardExamplex" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExamplex">
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
                     <div class="collapse " id="collapseCardExamplex">
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
															<th>
															  <center>Tanggal Pembayaran</center>
															</th>
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
                           <button class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">Data Transaksi Berdasarkan NIS</button>
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
                                       <center>NIS</center>
                                    </th>
									<th>
                                       <center>Nama Siswa</center>
                                    </th>
									<th>
                                       <center>Kelas</center>
                                    </th>
                                    <th>
                                       <center>Jumlah Bayar</center>
                                    </th>
                                    <th>
                                       <center>Jumlah Biaya</center>
                                    </th>
                                    <th>
                                       <center>Status</center>
                                    </th>
                                    <th>
                                       <center>Keterangan</center>
                                    </th>
                                    <th>
                                       <center>Tanggal Pembayaran</center>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php
                              if(count($data) == 0){
                                 ?>
                              <tr><td colspan="8"><center><h5>Data belum tersedia</h5></center></td></tr>
                              <?php
                              } else {
                                  foreach ($data['dataTransaksi'] as $value) {
                                 ?>
 															<tr class="odd">
                                                        <th><center><?= ++$start;?></center></th>
                                                        <td><center><?= $value['no_transaksi'] ;?></center></td>
                                                        <td><center><?= $value['nis'] ;?></center></td>
                                                        <td><center><?= $value['nama_siswa'] ;?></center></td>
                                                        <td><center><?= $value['kelas'] ;?></center></td>
                                                        <td><center><?= $value['total_payment'] ;?> Bulan</center></td>
                                                        <td><center><?= $value['total_amount'] ;?></center></td>
                                                        <td><center><?= $value['status'] ;?></center></td>
                                                        <td><center><?= $value['keterangan'] ;?></center></td>
                                                        <td><center><?= $value['created_at'] ;?></center></td>
                                                    </tr>
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
