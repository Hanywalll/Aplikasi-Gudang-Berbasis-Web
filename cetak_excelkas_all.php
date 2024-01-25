<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Kas.xls");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>EXCEL</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">



</head>

<body>
<div class="container-fluid position-relative d-flex p-0">
    <div class="content" style="width:100%;margin:-1px">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="mb-0">Laporan Kas</h3>
        </div>
   <div class="container-fluid pt-4 px-4 w-100">
       <div class="bg-secondary text-center rounded p-4">
           <div class="table-responsive">
               <table border="1" width="100%" cellspacing="0" cellpadding="5" style="text-align:center">
                   <thead>
                       <tr class="text-white text-center">
                           <th style="width:60px;" scope="col">No</th>
                           <th scope="col" style="width:150px">Tanggal</th>
                           <th scope="col" style="width:150px">Nota</th>
                           <th scope="col" style="width:150px">Nama Barang</th>
                           <th scope="col" style="width:150px">Pemasukan</th>
                           <th scope="col" style="width:150px">Pengeluaran</th>
                       </tr>
                   </thead>
                   <tbody>
                       <?php

                       $query    = mysqli_query($koneksi, "SELECT * FROM  stock join tbbarang ON tbbarang.kodeb = stock.kodeb where nota LIKE '%NPM%' OR nota LIKE '%NPJ%' ");
                       $i = 1;

                       while ($data    = mysqli_fetch_array($query)) {
                           $pemasukan       = $data['keluar'] * $data['hjual'];
                           $pengeluaran       = $data['masuk'] * $data['hbeli'];
                        ?>

                        <tr style="text-align:center">

                            <td> <?= $i++; ?></td>
                            <td> <?= $data['tgltransaksi']; ?></td>
                            <td style="text-align: left;"> <?= $data['nota']; ?></td>
                            <td style="text-align: left;"> <?= $data['kodeb']; ?> - <?= $data['namab']; ?></td>
                            <td style="text-align: left;"> <?= "Rp.", number_format($pemasukan, 2, ',', '.') ?></td>
                            <td style="text-align: left;"> <?= "Rp.", number_format($pengeluaran, 2, ',', '.') ?></td>
                        </tr>

                         <?php

                            $pemasukan       = $data['keluar'] * $data['hjual'];
                            $pengeluaran      = $data['masuk'] * $data['hbeli'];
                            }
                            ?>
                            <?php
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>