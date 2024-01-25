<?php
require 'koneksi.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Barang.xls");

?>

<h3>Laporan Barang</h3>
<table border="1" width="100%" style="text-align: center;">
    <thead>
        <tr>
            <th scope="col" style="width:10px">No</th>
            <th scope="col">Kode Grup</th>
            <th scope="col">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stock</th>
            <th scope="col">Satuan</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Pokok</th>
            <th scope="col">Harga Jual</th>
            <th scope="col">Status</th>
            <th scope="col">Stock
    </thead>

    <tbody>

        <?php
        $stokbarang = mysqli_query($koneksi, "SELECT * FROM  tbbarang JOIN tbgroup ON tbbarang.kodeg = tbgroup.kodeg ");
        $i = 1;
        while ($tampil = mysqli_fetch_array($stokbarang)) {

        ?>
            <tr style="text-align:center">
                <td> <?= $i++ ?></td>
                <td style="text-align:left"> <?= $tampil['kodeg']; ?> - <?= $tampil['namag']; ?></td>
                <td style="text-align:left"> <?= $tampil['kodeb']; ?></td>
                <td style="text-align:left"> <?= $tampil['namab']; ?></td>
                <td> <?= $tampil['stock']; ?></td>
                <td style="text-align:left"> <?= $tampil['satuan']; ?></td>
                <td style="text-align:left"> <?= $tampil['ket']; ?></td>
                <td style="text-align:left"><?= 'Rp.' . $tampil['hbeli']; ?></td>
                <td style="text-align:left"> <?= 'Rp.' . $tampil['hpokok']; ?></td>
                <td style="text-align:left"> <?= 'Rp.' . $tampil['hjual']; ?></td>
                <td> <?= $tampil['status']; ?></td>
                <td> <?= $tampil['stockmin']; ?></td>
            </tr>

            </div>
            </div>
            </div>

        <?php
        };
        ?>

    </tbody>
</table>