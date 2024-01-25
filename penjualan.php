<?php
include 'koneksi.php';
include 'cek.php';


//barang keluar
if (isset($_POST['addtransaksi'])) {

    $kodeb = $_POST['kodeb'];
    $keluar = $_POST['keluar'];
    $deskripsi = $_POST['deskripsi'];
    $tgltransaksi = $_POST['tgltransaksi'];

    // ubah tanggal menjadi id
    $currentDate = $_POST['tgltransaksi'];
    $bagian1 = substr($currentDate, 2, 2);
    $bagian2 = substr($currentDate, 5, 2);
    $bagian3 = substr($currentDate, 8, 2);
    
    //*TODO : kita buat dulu auto increment berdasarkan tanggal
    $query = "SELECT MAX(urut) as max_id FROM penjualan WHERE tgltransaksi = '$tgltransaksi'";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    $max_id = $row['max_id'];
    
    // Membuat ID baru
    if ($max_id) {
        $parts = explode('-', $max_id);
        $counter = intval($parts[1]) + 1;
        $new_id = $parts[0] . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
    } else {
        $new_id = '-0001';
    }

     //insert ke tabel opname
     $addtotransaksi = mysqli_query($koneksi, "insert into penjualan (prefix,kodeb,urut,keluar,tgltransaksi,deskripsi) VALUES ('$bagian1$bagian2$bagian3','$kodeb','$new_id','$keluar','$tgltransaksi','$deskripsi')");
    
     //tambah stock
    // ambil data dari tabel stock
    $query    = mysqli_query($koneksi, "SELECT *FROM stock where kodeb = '$kodeb' AND  nota LIKE '%NPJ%'");
    while ($data    = mysqli_fetch_array($query)) {
      $barangkeluar[] = $data['keluar'];
    }
    //kirim data ke tb barang
    $total_keluar = array_sum($barangkeluar);
    $cetakmasuk = mysqli_query($koneksi, "update tbbarang set keluax = '$total_keluar' where kodeb='$kodeb'");

    
    
    if ($addtotransaksi) {
        header('location:penjualan.php');
    } else {
        echo 'Gagal';
        header('location:penjualan.php');
    }
}

// Mendapatkan tanggal saat ini

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Penjualan</title>
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
        .slider {
            width: 400px;
            height: 200px;
            overflow: hidden;
        }
        .slide {
            display: none;
        }
        label{
            color:white;
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
            <nav class="navbar id="sidebar" >
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color:#93E567">AppGudang</h3>
                </a>
                
            
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i class="fa-solid fa-boxes-stacked fa-lg me-2"></i>Data Group</a>
                    <a href="tbbarang.php" class="nav-item nav-link"><i class="fa-solid fa-cubes-stacked fa-lg me-2"></i>Tabel Barang</a>
                    <a href="opname.php" class="nav-item nav-link "><i class="fa fa-th me-2 fa-lg"></i>Opname</a>
                    <a href="stock.php" class="nav-item nav-link"><i class="fa-solid fa-box fa-lg me-2"></i>Stock</a>
                    <a href="pembelian.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket fa-lg me-2"></i>Pembelian</a>
                    <a href="penjualan.php" class="nav-item nav-link active"><i class="fa-solid fa-right-to-bracket fa-lg me-2"></i>Penjualan</a>
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
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 d-flex justify-content-between" style="height: 70px;background-color:#171a1b !important">
                
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-success"></i>
                </a>
                <div id="info-slide" class="alert alert-success d-flex  mh-100 mw-100 pt-4 ">
                    <p id="total_uang" style="color:#124d12;font-weight:bolder">Total Pemasukan&ensp;:&ensp;&ensp;<?= "Rp.", number_format($total_harga, 2, ',', '.') ?></p>
                    <p id="total_barang"  style="color:#124d12;font-weight:bolder">Total Penjualan&ensp;&nbsp;&nbsp;&nbsp;:&ensp;<?= number_format($total_barang, 2, ',', '.')?></p>   
                </div>
                <div>
                    <a href="logout.php" class="nav-item nav-link text-danger" style="font-weight: bolder;font-size:large"><i class="fa-solid fa-power-off fa-lg me-2 me-2"></i>Logout</a>
                </div>

                

                    
            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4" >
            
                    <button type="button" class="rounded-pill m-2 " data-bs-toggle="modal" data-bs-target="#myModaltransaksi" style="padding: 7.5px 10px 7.5px 10px;color:#124d12;background-color:#93E567;font-weight:bolder"><i class="fa-solid fa-arrow-down"></i>&nbsp;Penjualan Barang</button>
                
                    
              
                <?php

                $query    = mysqli_query($koneksi, "SELECT *FROM  tbbarang");
                while ($data    = mysqli_fetch_array($query)) {
                ?>
                <?php
                    $barangkeluar[] = $data['keluax'];
                    $jumlah[]       = $data['keluax'] * $data['hjual'];
                }
                //total
                $total_barang     = array_sum($barangkeluar);
                $total_harga      = array_sum($jumlah);

                //   //Tampilkan
                //   echo "Jumlah barang    =$jumlah_barang<br>";
                //   echo "Total Harga    =$total_harga";

                ?>
                
                

            </div>




            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color:#93E567">Tabel Penjualan</h6>         
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 border-light" >
                            <thead>
                                <tr class="text-white text-center">
                                    <th scope="col" style="width:60px">No</th>
                                    <th scope="col">Tgl Transaksi</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Penjualan</th>
                                    <th scope="col">Deskripsi</th>




                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stokopname = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN tbbarang ON penjualan.kodeb = tbbarang.kodeb ORDER BY nota");
                                $i = 1;

                                while ($tampil = mysqli_fetch_array($stokopname)) {
                                ?>
                                    <tr class="text-white text-center">
                                        <td> <?= $i++ ?></td>
                                        <td> <?= $tampil['tgltransaksi']; ?></td>
                                        <td class="text-start"> <?= $tampil['nota'] ?></td>
                                        <td class="text-start"> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
                                        <td> <?=   number_format($tampil['keluar'], 2, ',', '.') ; ?></td>
                                        <td class="text-start"> <?= $tampil['deskripsi']; ?></td>

                                    </tr>
                                <?php }




                                ?>

                            </tbody>
                        </table>
                        <br>
                        <br>

                        <!-- Tabel Total -->


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
    <!-- slider info keuangan -->
    <script>
        // Data slide dalam bentuk array atau JSON
        var dataSlide = [
            { title: "Total Pemasukan : " , content: "<?= " Rp.", number_format($total_harga, 2, ',', '.') ?>" },
            { title: "Total Penjualan : " ,content: "<?= number_format($total_barang, 2, ',', '.')?> Barang" },
        ];

        // Fungsi untuk mengganti slide
        var currentSlide = 0;
        function changeSlide() {
            document.getElementById("total_uang").textContent = dataSlide[currentSlide].title;
            document.getElementById("total_barang").textContent = dataSlide[currentSlide].content;
            currentSlide = (currentSlide + 1) % dataSlide.length;
        }

        // Panggil fungsi changeSlide() saat halaman dimuat dan setiap 5 detik
        changeSlide(); // Pertama kali
        setInterval(changeSlide, 2000); // Setiap 5 detik
    </script>

</body>


<!-- Barang Masuk -->
<div class="modal fade" id="myModaltransaksi">
    <div class="modal-dialog" >
        <div class="modal-content" style="background-color:#171a1b" >

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Penjualan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <br>

            <!-- Modal body -->
            <div class="centerform" style="display: flex;justify-content:center;width:100%;">
            <form method="post" autocomplete="off" >
                <div class="modal-body">
                <label for="">
                        Kodeb&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <select name="kodeb" style="height: 30px;width: 300px;text-align:center;font-weight:bold">
                        <?php
                        $ambilsemuadatanya = mysqli_query($koneksi, "select * from tbbarang ");
                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                            $kodeb = $fetcharray['kodeb'];
                            $kodeb = $fetcharray['kodeb'];
                            $namab = $fetcharray['namab'];

                        ?>
                            <option value="<?= $kodeb; ?>"><?= $kodeb; ?> - <?= $namab; ?> </option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                    <br><br>
                    <label for="">
                        Keluar&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type='text' name='keluar' placeholder="Barang keluar" style="height: 30px;width: 300px;text-align:center;font-weight:bold">
                    </label>
                    <br><br>
                    <label for="">
                        Deskripsi&ensp;&ensp;&nbsp;&nbsp;
                        <input type='text' name='deskripsi' placeholder="Deskripsi" style="height: 30px;width: 300px;text-align:center;font-weight:bold">
                    </label>
                    <br><br>
                      <label for="">
                        Tanggal&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;
                        <input type='date' name='tgltransaksi' style="height: 30px;width: 300px;text-align:center;font-weight:bold" required>
                    </label>
                    <br><br>
                    
                    <div style="width:100%;justify-content:flex-end;display:flex;margin-top:10px;margin-bottom:10px;">
                        <button type="submit" class="btn" name="addtransaksi" style="background-color:#93E567;color:#124d12;font-weight:bolder">Input</button>
                    </div>
                </div>

            </form>
            </div>


            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>



</html>