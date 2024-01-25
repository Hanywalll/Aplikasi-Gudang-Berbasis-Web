<?php
require 'koneksi.php';
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Group.xls");

?>

<h3>Laporan Group</h3>
<table width="60%" border="1" cellspacing="0">
    <thead style="text-align: center;">
        <tr class="text-white text-center">
            <th scope="col">No</th>
            <th scope="col">Kode Group</th>
            <th scope="col">Nama Group</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stokbarang = mysqli_query($koneksi, "SELECT * FROM tbgroup ");
        $i = 1;
        while ($tampil = mysqli_fetch_array($stokbarang)) {
        ?>
        <tr style="text-align: center;">
          <td style="text-align: center;width: 50px;"> <?= $i++ ?></td>
          <td style="text-align: left;"><?= $tampil['kodeg']; ?></td>
          <td style="text-align: left;"> <?= $tampil['namag']; ?></td>
        </tr>
        <?php }

        ?>

    </tbody>
</table>