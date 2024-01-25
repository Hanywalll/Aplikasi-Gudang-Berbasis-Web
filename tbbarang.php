<?php
include 'koneksi.php';
include 'cek.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Data Barang</title>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
         *{
            user-select: none;
        }
        body #myModalbarang .modal-body {
            max-height: 415px;
            overflow-y: auto;
        }

        .invalid {
            border-color: blue;
        }

        #hilang {
            display: none;
        }

        .hilangkan {
            display: none;
        }
        ul :hover{
        background-color: #2f6611;
        color: white;
      }
      .dropdown:hover .dropdown-menu {
            display: block;
        }
        #sidebar a:hover{
            color:#93E567;
        }
        .nav-link.active{
            color:#93E567 !important;
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
            <nav class="navbar">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color: #93E567;">AppGudang</h3>
                </a>
                
                <div class="navbar-nav w-100 " id="sidebar">
                    <a href="index.php" class="nav-item  nav-link "><i class="fa-solid fa-boxes-stacked fa-lg me-2"></i>Data Group</a>
                    <a href="tbbarang.php" class="nav-item nav-link active"><i class="fa-solid fa-cubes-stacked fa-lg me-2"></i>Tabel Barang</a>
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
            //tambah barang
            if (isset($_POST['addnewbarang'])) {

                $kodeg = $_POST['kodeg'];
                $kodeb = $_POST['kodeb'];
                $namab = $_POST['namab'];
                $satuan = $_POST['satuan'];
                $ket = $_POST['ket'];
                $hbeli = $_POST['hbeli'];
                $hpokok = $_POST['hpokok'];
                $hjual = $_POST['hjual'];
                $status = $_POST['status'];
                $stockmin = $_POST['stockmin'];

                //periksa barang di database
                $query_check_barang = "SELECT * FROM tbbarang WHERE kodeb = '$kodeb'";
                $result_check_barang = mysqli_query($koneksi, $query_check_barang);

                if (mysqli_num_rows($result_check_barang) > 0) {
                    // Barang sudah ada, tampilkan alert
            ?>
                    <div class="alert alert-dismissible alert-danger" style="padding:10px 20px;position:fixed;top:0;left:0;right:0;bottom: 795px;z-index:10000;display:flex;justify-content:center;align-items:center">
                        <a href="tbbarang.php"><button type="button" class="btn-close" data-bs-dismiss="alert"></button></a>
                        <strong>Input Gagal&nbsp;</strong> Kode <?= $kodeb; ?> Sudah Ada Dalam Database, Silahkan Input Data Kembali.
                    </div>
                    <?php
                } else {
                    // Barang belum ada, lakukan penyimpanan ke database
                    $query_insert_barang = "INSERT INTO tbbarang (kodeg,kodeb,namab,satuan,ket,hbeli,hpokok,hjual,status,stockmin) VALUES ('$kodeg','$kodeb','$namab','$satuan','$ket','$hbeli','$hpokok','$hjual','$status','$stockmin')";
                    $result_insert_barang = mysqli_query($koneksi, $query_insert_barang);

                    if ($result_insert_barang) {
                    ?>
                        <div class="alert alert-dismissible alert-success" style="padding:10px 20px;position:fixed;top:0;left:0;right:0;bottom: 795px;z-index:10000;display:flex;justify-content:center;align-items:center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Sukses!&nbsp;</strong> Kode <?= $kodeb; ?> berhasil ditambahkan ke database.
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="alert alert-dismissible alert-danger" style="padding:10px 20px;position:fixed;top:0;left:0;right:0;bottom: 795px;z-index:10000;display:flex;justify-content:center;align-items:center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Gagal!&nbsp;</strong> Terjadi kesalahan saat menambahkan barang ke database.
                        </div>
            <?php
                    }
                }
            }
            ?>

<nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 d-flex justify-content-between" style="height: 70px;background-color:#171a1b !important">
                
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
                    <button type="button" class="rounded-pill m-2" style="padding: 7.5px 10px 7.5px 10px;color:#124d12;background-color:#93E567;font-weight:bolder" data-bs-toggle="modal" data-bs-target="#myModalbarang"><i class="fa-solid fa-circle-plus fa-lg me-2"></i>Tambah Barang</button>
                    <a href="logineditbrg.php"><button type="button" class="btn rounded-pill m-2" style="color:#124d12;background-color:#93E567;font-weight:bolder"><i class="fa-regular fa-pen-to-square fa-lg me-2"></i>Edit</button></a>

                </div>




            </div>
            <!-- Sale & Revenue End -->



            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">

                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color:#93E567">Tabel Barang</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 border-light" >
                            <thead >
                                <tr class="text-white text-center">
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
                                    <th class="hilangkan" scope="col">Masuk</th>
                                    <th class="hilangkan" scope="col">Keluar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stokbarang = mysqli_query($koneksi, "SELECT * FROM tbbarang JOIN tbgroup ON tbbarang.kodeg = tbgroup.kodeg");
                                $i = 1;
                                while ($tampil = mysqli_fetch_array($stokbarang)) {
                                ?>
                                    <tr class="text-white text-center">
                                        <td> <?= $i++ ?></td>


                                        <td class="text-start"> <?= $tampil['kodeg']; ?> - <?= $tampil['namag']; ?></td>
                                        <td class="text-start"> <?= $tampil['kodeb']; ?></td>
                                        <td class="text-start"> <?= $tampil['namab']; ?></td>
                                        <td> <?= number_format($tampil['stock'], 2, ',', '.'); ?></td>
                                        <td class="text-start"> <?= $tampil['satuan']; ?></td>
                                        <td class="text-start"> <?= $tampil['ket']; ?></td>
                                        <td class="text-start"><?= "Rp.", number_format($tampil['hbeli'], 2, ',', '.'); ?></td>
                                        <td class="text-start"> <?= "Rp.", number_format($tampil['hpokok'], 2, ',', '.'); ?></td>
                                        <td class="text-start"> <?= "Rp.", number_format($tampil['hjual'], 2, ',', '.'); ?></td>
                                        <td> <?= $tampil['status']; ?></td>
                                        <td> <?= $tampil['stockmin']; ?></td>

                                        <td class="hilangkan"> <?= $tampil['masuq']; ?></td>
                                        <td class="hilangkan"> <?= $tampil['keluax']; ?></td>


                                    </tr>
                                <?php }



                                ?>


                                <?php

                                $ambildatastock = mysqli_query($koneksi, "SELECT * FROM tbbarang WHERE stock <= 5");
                                while ($fetch = mysqli_fetch_array($ambildatastock)) {
                                    $barang = $fetch['namab'];
                                    $stock = $fetch['stock'];

                                ?>
                                    <div class="alert alert-dismissible <?php echo ($stock < 1) ? 'alert-danger' : 'alert-warning'; ?>">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                        <strong>Perhatian!</strong> Stock <?= $barang; ?> <?php echo ($stock < 1) ? 'Sudah Habis' : 'Hampir Habis'; ?>.
                                    </div>
                                <?php
                                }
                                ?>



                            </tbody>
                        </table>


                        <table id="hilang" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>masuk</th>
                                    <th>keluar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stokmasuk = mysqli_query($koneksi, "SELECT masuk,keluar from opname");
                                $i = 1;
                                while ($tampil = mysqli_fetch_array($stokmasuk)) {
                                ?>
                                    <tr>
                                        <td> <?= $i++ ?></td>


                                        <td> <?= $tampil['masuk']; ?></td>
                                        <td> <?= $tampil['keluar']; ?></td>
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


    <!-- rupiah -->
    <!-- <script src="js/rp2.js"></script> -->


    <!--AJAX -->
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
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


    <!-- cek kodeb -->
    <script>
        function checkKodeb(kodeb) {

            var usernameRegex = /^[a-zA-Z0-9]+$/;

            if (usernameRegex.test(kodeb)) {
                document.getElementById('uname_response').innerHTML = "";

                if (kodeb.length > 2) {

                    // AJAX request
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST", "cekid.php", true);
                    xhttp.setRequestHeader("Content-Type", "application/json");
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {

                            // Response
                            var response = this.responseText;
                            document.getElementById('uname_response').innerHTML = response;
                        }
                    };
                    var data = {
                        kodeb: kodeb
                    };
                    xhttp.send(JSON.stringify(data));
                }
            } else {
                document.getElementById('uname_response').innerHTML = "<span style='color: white;'>Masukkan Kode Barang !</span>";
            }

        }
    </script>



    <!-- blur -->
    <script src="js/blur.js"></script>


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
</body>


<!-- Input Barang -->
<div class="modal fade" id="myModalbarang">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="  background-color: #171a1b;">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tabel Barang</h4>&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;&emsp13;
                    &emsp13;&emsp13;&emsp13;
                    <div id="uname_response" style="text-align:center;font-weight:bold;font-size:x-large;background-color:brown"></div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form id="form" method="post" autocomplete="off">
                    <div class="modal-body" style="display:flex">

                        <div class="kiri" style="display:flex;flex-direction:column;justify-content:center;align-items:center;width: 50%;">
                            <div style="justify-content:center;height:100%;width:75%;display:flex;flex-direction:column;align-items:flex-end">
                                <label for="">
                                    Kodeg&emsp;
                                    <select name="kodeg" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>
                                        <?php
                                        $ambilsemuadatanya = mysqli_query($koneksi, "select * from tbgroup ORDER BY kodeg ");
                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                            $kodeg = $fetcharray['kodeg'];
                                            $namag = $fetcharray['namag'];


                                        ?>
                                            <option value="<?= $kodeg; ?>"><?= $kodeg; ?> - <?= $namag; ?> </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <br>
                                </label>
                                <div>
                                    <label for="">
                                        Kodeb&emsp;
                                        <input id="kodeb" type='text' name='kodeb' placeholder="Kode Barang" onkeyup="checkKodeb(this.value);" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>
                                    </label>
                                </div>
                                <br>

                                <label for="">
                                    Namab&ensp;&ensp;
                                    <input type='text' name='namab' placeholder="Nama Barang" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                </label>
                                <br>

                                <label for="">
                                    Satuan&nbsp;&ensp;
                                    <select name="satuan" style="height: 30px;width: 200px;text-align:center;font-weight:bold">
                                        <?php
                                        $ambilsemuadatanya = mysqli_query($koneksi, "select * from inputsatuan");
                                        while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                            $satuan = $fetcharray['satuan'];

                                        ?>
                                            <option value="<?= $satuan; ?>"><?= $satuan; ?> </option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </label>

                                <br>

                                <label for="">
                                    Ket&nbsp;&ensp;&ensp;&nbsp;
                                    <input type='text' name='ket' placeholder="Keterangan" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                </label>
                            </div>
                        </div>

                        <div class="kanan" style="display:flex;flex-direction:column;justify-content:center;align-items:center;width: 50%;margin-top:26px">
                            <div style="justify-content:center;height:100%;width:75%;display:flex;flex-direction:column;align-items:flex-start;">
                                <label for="">
                                    Hbeli&emsp;&nbsp;&nbsp;&nbsp;
                                    <input id="empat" type='text' name='hbeli' placeholder="Harga Beli" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>
                                </label>
                                <br>
                                <label for="">
                                    Hpokok&ensp;
                                    <input id="lima" type='text' name='hpokok' placeholder="Harga Pokok" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>
                                </label>
                                <br>
                                <label for="">
                                    Hjual&ensp;&emsp;&nbsp;
                                    <input id="enam" type='text' name='hjual' placeholder="Harga Jual" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                </label>
                                <br>

                                <div class="form-group mb-3">
                                    <label for="" required>
                                        Status&ensp;&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="status" value="1" required /> Tersedia
                                        <input type="radio" name="status" value="0" required /> Tidak Tersedia
                                    </label>
                                </div>
                                <br>
                                <label for="" style="margin-top:-9px">
                                    Stockmin
                                    <input type='text' name='stockmin' placeholder="Stock Minimal" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                </label>
                                &nbsp; &nbsp; &nbsp;

                            </div>

                        </div>

                    </div>
                    <div style="width:90%;justify-content:flex-end;display:flex;margin-bottom:30px">
                        <button id="submit" type="submit" class="btn " name="addnewbarang" style="background-color:#93E567;color:#124d12;font-weight:bolder" >Tambah Barang</button>
                    </div>
                </form>


                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>

                </div>
            </div>



        </div>




        <!-- Modal footer -->


    </div>
</div>
</div>
</div>





</html>