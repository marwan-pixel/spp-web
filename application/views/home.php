
  <!-- content page -->
        <div class="container mt-4 main-container content">
            <div class="row">
                <div  class="col-12 col-md-6 total-pemasukan">
                    <div class="card mb-4">
                        <div class="card-body pb-4" style="border-left:4px solid #1AAF45; border-right: 4px solid #1AAF45; border-radius: 5px;">
                            <div class="media">
                                <div class="media-body" >
                                        <p class="content-color-secondary mb-0">Total Pemasukan<span class="text-success float-right"></p>
                                        <h3 class="content-color-primary mb-3 mt-2"><?= number_format($data['total']['nominal'],2,',','.') ?? 0;?></h3>
                                </div>
                                <h5>Rp</h5>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 jumlah-siswa">
                    <div class="card mb-4">
                        <div class="card-body" style="border-left:4px solid #F8C90A; border-right: 4px solid #F8C90A; border-radius: 5px;">
                            <div class="media">
                                <div class="media-body" >
                                    <p class=" mb-0">Jumlah Siswa<span class="text-success float-right"></p>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h3 class="content-color-primary mt-2 mb-3"><?= $data['datasiswa']['all']; ?></h3> 
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datasiswa']['tk']; ?></h4> 
                                            <h6 class="text-muted">TK</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datasiswa']['sd']; ?></h4> 
                                            <h6 class="text-muted">SD</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datasiswa']['smp']; ?></h4> 
                                            <h6 class="text-muted">SMP</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datasiswa']['ponpes']; ?></h4> 
                                            <h6 class="text-muted">Ponpes</h6>
                                        </div>
                                    </div>
                                </div>
                                <i class="material-icons icon">person</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 transaksi-aktif">
                    <div class="card mb-4">
                        <div class="card-body" style="border-left:4px solid #0A8CF8; border-right: 4px solid #0A8CF8; border-radius: 5px;">
                            <div class="media" data-title = "Total Transaksi Aktif" data-intro = "Di sini anda bisa melihat total transaksi yang aktif pada bulan ini">
                                <div class="media-body" >
                                    <p class="content-color-secondary mb-0">Total Transaksi Bulan Ini</p>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h3 class="content-color-primary mt-2 mb-3"><?= $data['datatransaksi']['all'];?></h3>
                                        </div>
                                    </div>
                                </div>
                                <i class="material-icons icon">date_range</i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 jumlah-kelas">
                    <div class="card mb-4">
                        <div class="card-body" style="border-left:4px solid red; border-right: 4px solid red; border-radius: 5px;">
                            <div class="media" class="media" data-title = "Total Transaksi Aktif" data-intro = "Di sini anda bisa melihat jumlah kelas pada setiap tingkat sekolah">
                                <div class="media-body">
                                    <p class="content-color-secondary mb-0">Jumlah Kelas (Setiap Tingkat) <span class="text-success float-right"></p>
                                    <div class="row">
                                        <div class="col-sm">
                                            <h3 class="content-color-primary mb-3 mt-2"><?= $data['datakelas']['all']; ?></h3> 
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datakelas']['tk']; ?></h4> 
                                            <h6 class="text-muted">TK</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datakelas']['sd']; ?></h4> 
                                            <h6 class="text-muted">SD</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datakelas']['smp']; ?></h4> 
                                            <h6 class="text-muted">SMP</h6>
                                        </div>
                                        <div class="col-sm d-flex flex-column align-items-center">
                                            <h4 class="content-color-primary mt-2"><?= $data['datakelas']['ponpes']; ?></h4> 
                                            <h6 class="text-muted">Ponpes</h6>
                                        </div>
                                    </div>
                                </div>
                                <i class="material-icons icon">group</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content page ends -->