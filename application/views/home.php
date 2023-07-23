  <!-- content page -->
    <div class="container-lg mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form class="form">
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
            </div>
        </div>
    </div>
    <div class="container-lg mt-3">
        <div class="row">
            <div class="col-12 col-lg-6 mb-3 total-pemasukan" style="border-radius: 20px">
                <div class="card shadow-sm d-flex flex-fill">
                    <div class="card-body" >
                        <div class="media ">
                            <div class="media-body text-wrap text-truncate" >
                                <p class="content-color-secondary mb-0">Total Pemasukan Bulan Ini</p>
                                <p class=" content-color-primary mt-2 mb-3 fs-5 pemasukan"></p>
                            </div>
                            <h5 class="materh5al-icons icon text-danger">Rp</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3 col-12 col-lg-6 transaksi-aktif" style="border-radius: 20px" >
                <div class="card shadow-sm d-flex flex-fill">
                    <div class="card-body" >
                        <div class="media">
                            <div class="media-body text-wrap text-truncate" >
                                <p class="content-color-secondary mb-0">Jumlah Transaksi Aktif Bulan Ini</p>
                                <p class="content-color-primary mt-2 mb-3 fs-5 transaksiAktif"></p>
                            </div>
                            <i class="material-icons icon text-success">date_range</i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <div class="container-lg">
            <div class="row">
                <div class="col-12 col-lg-6 ">
                    <div class="card shadow-sm d-flex flex-fill mb-4">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Total Pemasukan Tahun ini</p>
                                    <p class="content-color-primary mt-2 mb-3 fs-5 pemasukanTahun"></p>
                                </div>
                            </div>
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm d-flex flex-fill">
                        <div class="card-body">
                            <div class="media">
                                <div class="media-body text-wrap text-truncate" >
                                    <p class="content-color-secondary mb-0">Jumlah Transaksi Aktif Tahun ini</p>
                                    <p class="content-color-primary mt-2 mb-3 fs-5 transaksiAktifTahun"></p>
                                </div>
                            </div>
                            <canvas id="myChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content page ends -->
        <script src="<?= base_url();?>/assets/js/jquery-3.2.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var data;
            let IDR = new Intl.NumberFormat('id-ID', {
               style: 'currency',
               currency: 'IDR',
            });

            let ctx = document.getElementById('myChart');
            let ctx2 = document.getElementById('myChart2');

            var pemasukanChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [{
                    label: 'Total Pemasukan SPP Setiap Bulan',
                    data: [],
                    borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                    responsive: true, 
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                },
            });
            var totalTransaksi = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                    datasets: [{
                    label: 'Total Transaksi Aktif SPP Setiap Bulan',
                    data: [],
                    borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: true,
                    responsive: true,
                    scales: {
                    y: {
                        beginAtZero: true
                    }
                    }
                }
            });
            function getData(){
                let thn_akademik = $('#thn_akademikList').val();
                console.log(thn_akademik);
                $.ajax({
                    url: '<?= base_url('pages/homeData');?>',
                    method: 'GET',
                    data: {thn_akademik: thn_akademik},
                    dataType: 'json',
                    success: function(response){
                        console.log(response);
                        $('.pemasukan').text(IDR.format(response.totalPemasukan.curdate.nominal));
                        $('.transaksiAktif').text(response.dataTransaksi.curdate);
                        $('.pemasukanTahun').text(IDR.format(response.totalPemasukan.tahun.nominal));
                        $('.transaksiAktifTahun').text(response.dataTransaksi.tahun);
                        
                        // $('.jumlahSiswa').text(response.dataSiswa.all);
                        // $('.jumlahKelas').text(response.dataKelas.all);

                        // $.each(response.dataBiaya, function(index, item){
                        //     let row = `
                        //     <tr>
                        //         <td>${response.dataInstansi[index].jenis_instansi}</td>
                        //         <td>${IDR.format(item)}</td>
                        //     '</tr>`;
                        //     $('.biayaInstansi tbody').append(row);
                        // });

                        // $.each(response.dataSiswa, function(index, item){
                        //     console.log(item)
                        //     let row = `
                        //     <tr>
                        //         <td>${response.dataInstansi[index].jenis_instansi}</td>
                        //         <td>${IDR.format(item)}</td>
                        //     '</tr>`;
                        //     $('.jumlahPeserta tbody').append(row);
                        // });

                        pemasukanChart.data.datasets[0].data = [
                        response.totalPemasukan.januari.nominal, response.totalPemasukan.februari.nominal, response.totalPemasukan.maret.nominal,
                        response.totalPemasukan.april.nominal, response.totalPemasukan.mei.nominal, response.totalPemasukan.juni.nominal,
                        response.totalPemasukan.juli.nominal, response.totalPemasukan.agustus.nominal, response.totalPemasukan.september.nominal,
                        response.totalPemasukan.oktober.nominal, response.totalPemasukan.november.nominal, response.totalPemasukan.desember.nominal,
                        ];

                        totalTransaksi.data.datasets[0].data = [
                        response.dataTransaksi.januari, response.dataTransaksi.februari, response.dataTransaksi.maret, response.dataTransaksi.april, 
                        response.dataTransaksi.mei, response.dataTransaksi.juni, response.dataTransaksi.juli, response.dataTransaksi.agustus, 
                        response.dataTransaksi.september, response.dataTransaksi.oktober, response.dataTransaksi.november, response.dataTransaksi.desember,
                        ];
                        pemasukanChart.update();
                        totalTransaksi.update();
                    }
                });
            }
            $('#thn_akademikList').ready(function(){
                getData();
            });
            $('#thn_akademikList').change(function(){
                getData();
            });
        </script>