<?php
include 'koneksi.php';

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Opname.xls"); 



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
        <!-- Spinner Start -->


        <div class="content" style="width:100%;margin:-1px">
            <!-- Navbar Start -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h3 class="mb-0">Laporan Opname</h3>
        </div>
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="table-responsive">
                    <table border="1" width="80%" cellspacing="0" >
                                                    <thead style="text-align:center">
                                                        <tr>
                                                            <th scope="col" style="width:60px">No</th>
                                                            <th scope="col">Tanggal</th>
                                                            <th scope="col">Kode Barang</th>
                                                            <th scope="col">Masuk</th>
                                                            <th scope="col">Keluar</th>
                                                            <th scope="col">Deskripsi</th>

                                                    </thead>

                                                    <tbody >
                                                        <?php
                                                        $stokopname = mysqli_query($koneksi, "SELECT * FROM opname JOIN tbbarang ON opname.kodeb = tbbarang.kodeb ");
                                                        $i = 1;
                                                        while ($tampil = mysqli_fetch_array($stokopname)) {

                                                        ?>
                                                            <tr style="text-align:center">
                                                                <td> <?= $i++ ?></td>
                                                                <td> <?= $tampil['tgltransaksi']; ?></td>
                                                                <td style="text-align:left"> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
                                                                <td> <?= $tampil['masuk']; ?></td>
                                                                <td> <?= $tampil['keluar']; ?></td>
                                                                <td style="text-align:left"> <?= $tampil['deskripsi']; ?></td>


                                                            </tr>
                                            </div>
                                        </div>
                                    </div>





                                <?php
                                                        };

                                ?>
                                </tbody>
                                </table>
                    </div>
                </div>
            </div>


        </div>

    </div>



    <!-- Template Javascript -->

</body>




</html>