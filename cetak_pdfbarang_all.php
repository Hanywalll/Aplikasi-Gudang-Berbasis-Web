<?php
include 'koneksi.php';
require_once('vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$namaFile = 'Laporan Barang';
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

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


</head>

<body>


    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
   

        <div class="content" style="width:100%;margin:-1px">
            <!-- Navbar Start -->
        
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Laporan Barang</h3>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table border="1"  style="text-align: center;" cellspacing="0">
    <thead>
        <tr>
            <th scope="col" style="width:40px ">No</th>
            <th scope="col">Kode Grup</th>
            <th scope="col" style="width:40px">Kode Barang</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stock</th>
            <th scope="col">Satuan</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Pokok</th>
            <th scope="col">Harga Jual</th>
            <th scope="col" style="width:30px">Status</th>
            <th scope="col">Stock</th>  
    </thead>

    <tbody>

        <?php
        $stokbarang = mysqli_query($koneksi, "SELECT * FROM  tbbarang JOIN tbgroup ON tbbarang.kodeg = tbgroup.kodeg ");
        $i = 1;
        while ($tampil = mysqli_fetch_array($stokbarang)) {

        ?>
        <tr style="text-align:center;">
            <td > <?= $i++ ?></td>
            <td style="text-align:left;height:40px"> <?= $tampil['kodeg']; ?> - <?= $tampil['namag']; ?></td>
            <td style="text-align:left"> <?= $tampil['kodeb']; ?></td>
            <td style="text-align:left"> <?= $tampil['namab']; ?></td>
            <td> <?= $tampil['stock']; ?></td>
            <td style="text-align:left"> <?= $tampil['satuan']; ?></td>
            <td style="text-align:left"> <?= $tampil['ket']; ?></td>
            <td style="text-align:left"><?='Rp.'.$tampil['hbeli']; ?></td>
            <td style="text-align:left"> <?='Rp.'.$tampil['hpokok']; ?></td>
            <td style="text-align:left"> <?='Rp.'.$tampil['hjual']; ?></td>
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
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- JavaScript Libraries -->


    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <?php
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output("".$namaFile.".pdf",'D');
    ?>
</body>




</html>