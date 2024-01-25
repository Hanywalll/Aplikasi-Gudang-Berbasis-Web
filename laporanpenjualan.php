<?php
include 'koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
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
        input[type="date"]:focus {
    outline: none;
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
            <nav class="navbar navbar-expand navbar-dark sticky-top px-4 py-0 justify-content-between" style="height: 90px;width:100%;background-color:#171a1b !important">
                <h3 style="color:#93E567;">Laporan Penjualan</h3>
                <a href="logouteditopname.php"> <button type="button" class="btn rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#fol" name="editgrup" style="background-color:#93E567;color:#124d12"><i class="fa fa-mail-reply"></i>Kembali</button></a>


            </nav>
            <div class="cetak ms-5 mt-3 d-flex align-items-center ">
                <form  id="filterpenjualan" method="post" style="height:50px;align-items:center;display:flex">
                    <input class="rounded-pill" type="date" name="tanggal_awal" onkeypress="return preventEnter(event);" style="padding: 5px;width: 205px;" required>&nbsp;&nbsp;&nbsp;
                    <input class="rounded-pill" type="date" name="tanggal_akhir" onkeypress="return preventEnter(event);" style="padding: 5px;width: 205px;" required>&nbsp;&nbsp;
                    <button type="submit"  class="btn btn-danger me-2" onclick="setFormAction(1)" autocomplete="off">PDF</button>
                    <button type="submit"  class="btn btn-success me-2" onclick="setFormAction(2)">EXCEL</button>
                    <button type="submit"  class="btn btn-light me-2" onclick="setFormAction(3)">PRINT</button>
     


                </form>
            </div>
       
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Data penjualan</h6>
                        <div class="cetak ms-5 mt-3">
                            <button class="me-2 btn btn-success me-2 ">
                                <a class="text-white" href="cetak_pdfpenjualan_all.php">PDF</a>
                            </button>
                            <button class="me-2 btn btn-success me-2">
                                <a class="text-white" href="cetak_excelpenjualan_all.php">EXCEL</a>
                            </button>
                            <button class="me-2 btn btn-success me-2">
                                <a class="text-white" href="cetak_printpenjualan_all.php">PRINT</a>

                            </button>
                            
                        </div>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table class="table table-bordered text-center text-white border-light" id="exportopname" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr class="text-black">
                                                            <th scope="col" style="width:60px">No</th>
                                                            <th scope="col">Tgl Transaksi</th>
                                                            <th scope="col">Nota</th>
                                                            <th scope="col">Kode Barang</th>
                                                            <th scope="col">keluar</th>
                                                            <th scope="col">Deskripsi</th>




                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $stokopname = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN tbbarang ON penjualan.kodeb = tbbarang.kodeb");
                                                        $i = 1;

                                                        while ($tampil = mysqli_fetch_array($stokopname)) {
                                                        ?>
                                                            <tr>
                                                                <td> <?= $i++ ?></td>
                                                                <td> <?= $tampil['tgltransaksi']; ?></td>
                                                                <td style="text-align:left"> <?= $tampil['nota'] ?></td>
                                                                <td style="text-align:left"> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
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

        <a href="index.php" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
    
    <script>
        function preventEnter(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                return false;
            }
        }
    </script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script>
        function setFormAction(actionNumber) {
            var form = document.getElementById('filterpenjualan');
            if (actionNumber === 1) {
                form.action = 'cetak_pdfpenjualan_filter.php';
            } else if (actionNumber === 2) {
                form.action = 'cetak_excelpenjualan_filter.php';
            } else if (actionNumber === 3) {
                form.action = 'cetak_printpenjualan_filter.php';
            }
        }
    </script>

</body>




</html>