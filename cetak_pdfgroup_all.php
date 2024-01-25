<?php
include 'koneksi.php';
require_once('vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$namaFile = 'Laporan Group';
$mpdf->AddPage('L');

ob_start();

// Edit Group
if (isset($_POST['updategroup'])) {
    $kodeg = $_POST['kodeg'];
    $namag = $_POST['namag'];

    $update = mysqli_query($koneksi, "UPDATE tbgroup set namag='$namag' where kodeg = '$kodeg'");
    if ($update) {
        header('location:editgroup.php');
    } else {
        echo 'Gagal';
        header('location:editgroup.php');
    }
}

//Hapus Group
if (isset($_POST['deletegroup'])) {
    $kodeg = $_POST['kodeg'];

    $hapus = mysqli_query($koneksi, "delete from tbgroup where kodeg = '$kodeg'");
    if ($hapus) {
        header('location:editgroup.php');
    } else {
        echo 'Gagal';
        header('location:editgroup.php');
    }
}


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

    <style>
        * {
            user-select: none;
        }

        body .modal-body {
            max-height: 410px;
            overflow-y: auto;
        }

        body {
            height: 100%;
            /* overflow-y: hidden; */
        }

        table #pol {
            max-height: 140px;
            overflow-y: auto;

        }

        body tbody {
            max-height: 100px;
            overflow-y: auto;
        }
    </style>

</head>

<body>


    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
   

        <div class="content" style="width:100%;margin:-1px">
            <!-- Navbar Start -->
        
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Laporan Group</h3>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                        <table width="100%" border="1" id="colio" cellspacing="0">
                            <thead style="text-align: center;">
                                <tr >

                                    <th scope="col">No</th>
                                    <th scope="col">Kodeg</th>
                                    <th scope="col">Namag</th>

                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                $stokbarang = mysqli_query($koneksi, "SELECT * FROM tbgroup ");
                                $i = 1;
                                while ($tampil = mysqli_fetch_array($stokbarang)) {
                                ?>
                                    <tr style="text-align: center;">
                                        <td  style="text-align: center;width: 50px;"> <?= $i++ ?></td>
                                        <td style="text-align: left;"><?= $tampil['kodeg']; ?></td>
                                        <td style="text-align: left;"> <?= $tampil['namag']; ?></td>

                


                                    </tr>
                                    <!-- edit group -->
                          


                                <?php }



                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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