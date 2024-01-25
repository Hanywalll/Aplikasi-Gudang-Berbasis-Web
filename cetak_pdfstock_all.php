<?php
include 'koneksi.php';
require_once('vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$namaFile = 'Laporan Stock';
$mpdf->AddPage('L');
ob_start();
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PDF</title>
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

       
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Laporan Stock</h3>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table width="100%" cellspacing="0" cellpadding="5" border="1" style="text-align:center">
                                                    <thead>
                                                        <tr>
                                                        <th scope="col" style="width:60px;">No</th>
                                                        <th scope="col"  style="width: 150px;;">Tgl Transaksi</th>
                                                        <th scope="col"  style="width:150px;">Nota</th>
                                                        <th scope="col" style="width:150px">Kode Barang</th>
                                                        <th scope="col"  style="width:80px;">Masuk</th>
                                                        <th scope="col" style="width: 80px;">Keluar</th>
                                                        <th scope="col" style="width: 200px;">Deskripsi</th>

                                                    </thead>

                                                    <tbody style="text-align:center">
                                                        <?php
                                $stokopname = mysqli_query($koneksi, "SELECT * FROM stock JOIN tbbarang ON stock.kodeb = tbbarang.kodeb ");

                                $i = 1;
                                                        while ($tampil = mysqli_fetch_array($stokopname)) {

                                                        ?>
                                                            <tr>
                                                                <td> <?= $i++ ?></td>
                                                                <td> <?= $tampil['tgltransaksi']; ?></td>
                                                                <td style="text-align:left"> <?= $tampil['nota']; ?></td>
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


<?php
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output("".$namaFile.".pdf",'D');
    ?>

</html>