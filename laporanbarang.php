<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Barang</title>
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

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
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
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="content" style="width:100%;margin:-1px">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand  navbar-dark sticky-top px-4 py-0 justify-content-between" style="height: 90px;width:100%;background-color:#171a1b !important">
                <h3 style="color:#93E567;">Laporan Barang</h3>
                <a href="logouteditgroup.php"> <button type="button" class="btn rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#fol" name="editgrup" style="background-color:#93E567;color:#124d12"><i class="fa fa-mail-reply"></i>Kembali</button></a>


            </nav>
           
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data Barang</h6>
                        <div class="cetak ms-5 mt-3">
                <button class="me-2 btn btn-success">
                    <a class="text-white" href="cetak_pdfbarang_all.php">PDF</a>
                </button>
                <button class="me-2 btn btn-success">
                    <a class="text-white" href="cetak_excelbarang_all.php">EXCEL</a>
                </button>
                <button class="me-2 btn btn-success">
                    <a class="text-white" href="cetak_printbarang_all.php">PRINT</a>
                </button>
            </div>
         
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered text-center border-light text-white" id="exportstock" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" style="width:60px">No</th>
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
                                                            <th scope="col">Stock Minimal</th>

                                                    </thead>

                                                    <tbody>

                                                        <?php
                                                        $stokbarang = mysqli_query($koneksi, "SELECT * FROM  tbbarang JOIN tbgroup ON tbbarang.kodeg = tbgroup.kodeg ");
                                                        $i = 1;


                                                        while ($tampil = mysqli_fetch_array($stokbarang)) {

                                                        ?>

                                                            <tr>
                                                                <td> <?= $i++ ?></td>
                                                                <td class="text-start"> <?= $tampil['kodeg']; ?> - <?= $tampil['namag']; ?></td>
                                                                <td class="text-start"> <?= $tampil['kodeb']; ?></td>
                                                                <td class="text-start"> <?= $tampil['namab']; ?></td>
                                                                <td> <?= $tampil['stock']; ?></td>
                                                                <td class="text-start"> <?= $tampil['satuan']; ?></td>
                                                                <td class="text-start"> <?= $tampil['ket']; ?></td>
                                                                <td class="text-start"> <?='Rp.'.$tampil['hbeli']; ?></td>
                                                                <td class="text-start"> <?='Rp.'.$tampil['hpokok']; ?></td>
                                                                <td class="text-start"> <?='Rp.'.$tampil['hjual']; ?></td>
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
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>




</html>