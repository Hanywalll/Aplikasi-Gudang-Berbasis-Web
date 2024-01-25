<?php
include 'koneksi.php';
include 'cek.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Data Group</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

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
        *{
            user-select: none;
            
        }
        
        body #myModalbarang .modal-body {
            max-height: 415px;
            overflow-y: auto;
        }

        ul :hover{
        background-color: #2f6611;
        color: white;
      }

        .dropdown:hover .dropdown-menu {
            display: block;
        }
        .nav-link.active{
            color:#93E567 !important;
        }
        #sidebar a:hover{
            color:#93E567;
        }
        .modal-header,.modal-footer{
            border-color:white;
        }
        .sidebar .navbar .navbar-nav .nav-link:hover i,
        .sidebar .navbar .navbar-nav .nav-link.active i {
            background-color:#171a1b !important; 
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
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" style="background-color:#171a1b !important;">
            <nav class="navbar" id="sidebar" >
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color:#93E567">AppGudang</h3>
                </a>
                <!-- <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Sasa</h6>
                        <span>Admin</span>
                    </div>
                </div> -->
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active "><i class="fa-solid fa-boxes-stacked fa-lg me-2"></i>Data Group</a>
                    <a href="tbbarang.php" class="nav-item nav-link"><i class="fa-solid fa-cubes-stacked fa-lg me-2"></i>Data Barang</a>
                    <a href="opname.php" class="nav-item nav-link "><i class="fa fa-th me-2 fa-lg"></i>Opname</a>
                    <a href="stock.php" class="nav-item nav-link"><i class="fa-solid fa-box fa-lg me-2"></i>Stock</a>
                    <a href="pembelian.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket fa-lg me-2"></i>Pembelian</a>
                    <a href="penjualan.php" class="nav-item nav-link"><i class="fa-solid fa-right-to-bracket fa-lg me-2"></i>Penjualan</a>
                    <a href="kas.php" class="nav-item nav-link "><i class="fa-solid fa-money-check-dollar fa-lg me-2"></i>Kas</a>

                    <li class="dropdown" >
                        <a href="#" class="nav-link  text-truncate" id="dropdown"  aria-expanded="false">
                            <i class="fa-solid fa-file-export"></i>Laporan
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="dropdown" style="border:none;background-color:transparent;margin-left:30px">
                            <li><a class="dropdown-item" href="laporangroup.php">Data Group</a></li>
                            <li><a class="dropdown-item" href="laporanbarang.php">Data Barang</a></li>
                            <li><a class="dropdown-item" href="laporanopname.php">Opname</a></li>
                            <li><a class="dropdown-item" href="laporanstock.php">Stock</a></li>
                            <li><a class="dropdown-item" href="laporanpembelian.php">Pembelian</a></li>
                            <li><a class="dropdown-item" href="laporanpenjualan.php">Penjualan</a></li>
                            <li><a class="dropdown-item" href="laporankas.php">Kas</a></li>
                        </ul>
                    </li>
              
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php
            //tambah group
            if (isset($_POST['addnewgroup'])) {

                $kodeg = $_POST['kodeg'];
                $namag = $_POST['namag'];

                // Periksa apakah barang sudah ada dalam database
                $query_check_grup = "SELECT * FROM tbgroup WHERE kodeg = '$kodeg'";
                $result_check_grup = mysqli_query($koneksi, $query_check_grup);

                if (mysqli_num_rows($result_check_grup) > 0) {
                    // Barang sudah ada, tampilkan alert
            ?>
                    <div class="alert alert-dismissible alert-danger" style="padding:10px 20px;">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Input Gagal</strong> Kode <?= $kodeg; ?> Sudah Ada Dalam Database Silahkan Input Data Kembali.
                    </div>
                    <?php
                } else {
                    // Barang belum ada, lakukan penyimpanan ke database
                    $query_insert_grup = "INSERT INTO tbgroup (kodeg, namag ) VALUES ('$kodeg', '$namag')";
                    $result_insert_grup = mysqli_query($koneksi, $query_insert_grup);

                    if ($result_insert_grup) {
                    ?>
                        <div class="alert alert-dismissible alert-success" style="padding:10px 20px;">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Sukses!</strong> Kode <?= $kodeg; ?> berhasil ditambahkan ke database.
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-dismissible alert-danger" style="padding:10px 20px;">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Gagal!</strong> Terjadi kesalahan saat menambahkan barang ke database.
                        </div>
            <?php
                    }
                }
            }
            ?>
            <nav class="navbar navbar-expand navbar-dark sticky-top px-4 py-0 d-flex justify-content-between" style="height: 70px;background-color:#171a1b !important">
                
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-success"></i>
                </a>
                <div>
                    <a href="logout.php" class="nav-item nav-link text-danger" style="font-weight: bolder;font-size:large"><i class="fa-solid fa-power-off fa-lg me-2 me-2"></i>Logout</a>
                </div>

                

                    
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4" style="display: flex;">
                <div>
                    <button type="button" class=" rounded-pill m-2" style="border:none;padding: 7.5px 10px 7.5px 10px;color:#124d12;background-color:#93E567;font-weight:bolder" data-bs-toggle="modal" data-bs-target="#myModalgrup"><i class="fa-solid fa-circle-plus fa-lg me-2"></i>Tambah Grup</button>
                    <a href="logineditgrup.php"><button type="button" class="btn rounded-pill m-2" style="color:#124d12;background-color:#93E567;font-weight:bolder"><i class="fa-regular fa-pen-to-square fa-lg me-2"></i>Edit</button></a>

                </div>




            </div>
            <!-- Sale & Revenue End -->



            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color:#93E567">Tabel Group</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 border-light">
                            <thead style>
                                <tr class="text-white text-center">
                                    <th scope="col" style="width:60px">No</th>
                                    <th scope="col">Kode Grup</th>
                                    <th scope="col">Nama Grup</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stokopname = mysqli_query($koneksi, "SELECT * FROM tbgroup ORDER BY kodeg");
                                $i = 1;
                                while ($tampil = mysqli_fetch_array($stokopname)) {
                                ?>
                                    <tr class="text-white text-center"> 
                                        <td> <?= $i++ ?></td>
                                        <td class="text-start"> <?= $tampil['kodeg']; ?></td>
                                        <td class="text-start"> <?= $tampil['namag']; ?></td>

                                    </tr>
                                <?php }



                                ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Widgets Start -->

        </div>
        <!-- Content End -->


        <!-- Back to Top -->
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
    
    <script>
        // Mencegah tindakan copy
document.addEventListener('copy', function(e) {
    e.preventDefault();
});

// Mencegah tindakan paste
document.addEventListener('paste', function(e) {
    e.preventDefault();
});

    </script>

    <!-- untuk kembali ke  halaman paling atas-->
    <a href="#" onclick="scrollToTop()" id="topBtn" class="btn btn-lg bg-success  back-to-top" style="width: 50px;"><i class="bi bi-arrow-up text-white"></i></a>

    <script>
     // Fungsi untuk menggulir ke atas
     function scrollToTop() {
         window.scrollTo({ top: 0, behavior: 'smooth' });
     }

     // Menampilkan atau menyembunyikan tombol "Back to Top" saat pengguna menggulir
     window.onscroll = function() {
         if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
             document.getElementById("topBtn").style.display = "block";
         } else {
             document.getElementById("topBtn").style.display = "none";
         }
     }
 </script>
</body>



<!-- untuk kembali ke  halaman paling atas-->


<!-- Tambah Grup -->
<div class="modal fade" id="myModalgrup" >
    <div class="modal-dialog">
        <div class="modal-content" style="  background-color: #171a1b;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color:white">Input Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <br>
            <!-- Modal body -->
            <div class="centerform" style="display: flex;justify-content:center;width:100%;">

                <form method="post" autocomplete="off">
                    <div class="modal-body">
                        <label for="" style="color:white">
                            Kode Group &nbsp;&nbsp;&nbsp;
                            <input type="text" name="kodeg" placeholder="Kode Grup" style="height: 30px;width: 300px;text-align:center;font-weight:bold" required>

                        </label>
                        <br>
                        <br>
                        <label for="namag" style="color:white">
                            Nama Group&nbsp;&nbsp;&nbsp;
                            <input type="text" name="namag" placeholder="Nama Grup" style="height: 30px;width: 300px;text-align:center;font-weight:bold" required>

                        </label>
                        <br>
                        <br>
                        <div style="width:100%;justify-content:flex-end;display:flex;margin-top:10px;margin-bottom:10px;">
                            <button type="submit" class="btn" name="addnewgroup" style="background-color:#93E567;color:#124d12;font-weight:bolder">Tambah</button>

                        </div>
                    </div>

                </form>
            </div>

            <br>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


</html>