<p align="center" style="font-weight:bold;font-size:16pt">DATA TRANSAKSI SPP SEKOLAH AR RAHMAH</p>
<table border="1" align="center">
    <thead>
        <tr>
            <th width="50">No</th>
            <th width="100">NIPD</th>
            <th width="100">Nominal</th>
            <th width="200">Keterangan</th>
            <th width="200">Tanggal Bayar</th>
            <th width="100">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
            header("Content-type: application/vnd-ms-excel");
            header("Content-Disposition: attachment; filename=laporan-excel.xls"); 
            $getData = $this->input->get();
            $no = 1;
            foreach ($getData as $value) {
            ?>
            <tr>
                <td align="center"><?= $no++; ?></td>
                <td align="center"><?= $value['nipd']; ?></td>
                <td align="center"><?= $value['nominal']; ?></td>
                <td align="center"><?= $value['keterangan']; ?></td>
                <td align="center"><?= $value['created_at']; ?></td>
                <td align="center"><?= $value['status']; ?></td>
            </tr>
            <?php
            }
        ?>
    </tbody>
</table>