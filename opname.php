<?php
include 'koneksi.php';
include 'cek.php';
ini_set("display_errors", 0);
if (isset($_POST['addtransaksi'])) {
    // Aksi pertama: Lakukan sesuatu di sini
    $nota = $_POST['nota'];
    $kodeb = $_POST['kodeb'];
    $masuk = $_POST['masuk'];
    $keluar = $_POST['keluar'];
    $deskripsi = $_POST['deskripsi'];
    $tgltransaksi = $_POST['tgltransaksi'];

    // ubah tanggal menjadi id
    $currentDate = $_POST['tgltransaksi'];
    $bagian1 = substr($currentDate, 2, 2);
    $bagian2 = substr($currentDate, 5, 2);
    $bagian3 = substr($currentDate, 8, 2);

    //*TODO : kita buat dulu auto increment berdasarkan tanggal
    $query = "SELECT MAX(urut) as max_id FROM opname WHERE tgltransaksi = '$tgltransaksi'";
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

    // Misalnya, validasi formulir
    if (!empty($masuk)) {
        $addtotransaksi = mysqli_query($koneksi, "insert into opname (prefix,kodeb,urut,masuk,tgltransaksi,deskripsi) VALUES ('$bagian1$bagian2$bagian3','$kodeb','$new_id','$masuk','$tgltransaksi','$deskripsi')");
        //tambah stock
        // ambil data dari tabel stock
        $query    = mysqli_query($koneksi, "SELECT * FROM stock where kodeb = '$kodeb'");
        while ($data    = mysqli_fetch_array($query)) {
            $barangmasuk[] = $data['masuk'];
            $barangkeluar[] = $data['keluar'];
        }
        //kirim data ke tb barang
        $total_masuk = array_sum($barangmasuk);
        $total_keluar = array_sum($barangkeluar);

        $cetakmasuk = mysqli_query($koneksi, "update tbbarang set stock = '$total_masuk' - '$total_keluar' where kodeb='$kodeb'");
    }
    if (empty($masuk)) {
    }
    if (!empty($keluar)) {
        //insert ke tabel opname
        $addtotransaksi = mysqli_query($koneksi, "insert into opname (prefix,kodeb,urut,keluar,tgltransaksi,deskripsi) VALUES ('$bagian1$bagian2$bagian3','$kodeb','$new_id','$keluar','$tgltransaksi','$deskripsi')");

        //tambah stock
        // ambil data dari tabel stock
        $query    = mysqli_query($koneksi, "SELECT * FROM stock where kodeb = '$kodeb'");
        while ($data    = mysqli_fetch_array($query)) {
            $barangmasuk[] = $data['masuk'];
            $barangkeluar[] = $data['keluar'];
        }
        //kirim data ke tb barang
        $total_masuk = array_sum($barangmasuk);
        $total_keluar = array_sum($barangkeluar);

        // $cetakmasuk = mysqli_query($koneksi, "update stock set keluar = masuk - '$keluar'  where (kodeb= '$kodeb' AND MAX(masuk)");


        $cetakmasuk = mysqli_query($koneksi, "update tbbarang set stock = '$total_masuk' - '$total_keluar' where kodeb='$kodeb'");


        if ($addtotransaksi) {
            header('location:opname.php');
        } else {
            echo 'Gagal';
            header('location:opname.php');
        }
    }
    if (empty($keluar)) {
    } else {
        // Aksi kedua: Lakukan yang lain di sini
        // Misalnya, proses data formulir atau tindakan lain
        echo "Form berhasil disubmit!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Opname</title>
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
        * {
            user-select: none;
        }

        body #myModalbarang .modal-body {
            max-height: 415px;
            overflow-y: auto;
        }

        * {
            border: none;
        }

        ul :hover {
            background-color: #2f6611;
            color: white;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .nav-link.active {
            color: #93E567 !important;
        }

        #sidebar a:hover {
            color: #93E567;
        }

        label {
            color: white;
        }

        hr {
            border: 2px solid white;
        }

        .modal-header,
        .modal-footer {
            border-color: white;
        }

        .sidebar .navbar .navbar-nav .nav-link:hover i,
        .sidebar .navbar .navbar-nav .nav-link.active i {
            background-color: #171a1b !important;
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
            <nav class="navbar " id="sidebar">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color:#93E567">AppGudang</h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link "><i class="fa-solid fa-boxes-stacked fa-lg me-2"></i>Data Group</a>
                    <a href="tbbarang.php" class="nav-item nav-link"><i class="fa-solid fa-cubes-stacked fa-lg me-2"></i>Tabel Barang</a>
                    <a href="opname.php" class="nav-item nav-link active"><i class="fa fa-th me-2 fa-lg"></i>Opname</a>
                    <a href="stock.php" class="nav-item nav-link"><i class="fa-solid fa-box fa-lg me-2"></i>Stock</a>
                    <a href="pembelian.php" class="nav-item nav-link"><i class="fa-solid fa-right-from-bracket fa-lg me-2"></i>Pembelian</a>
                    <a href="penjualan.php" class="nav-item nav-link"><i class="fa-solid fa-right-to-bracket fa-lg me-2"></i>Penjualan</a>
                    <a href="kas.php" class="nav-item nav-link "><i class="fa-solid fa-money-check-dollar fa-lg me-2"></i>Kas</a>

                    <li class="dropdown">
                        <a href="#" class="nav-link  text-truncate" id="dropdown" aria-expanded="false">
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

                <div>
                    <a href="logout.php" class="nav-item nav-link text-danger" style="font-weight: bolder;font-size:large"><i class="fa-solid fa-power-off fa-lg me-2 me-2"></i>Logout</a>
                </div>




            </nav>
            <!-- Navbar End -->


            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4" style="display: flex;">
                <div>
                    <button type="button" class="rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#myModaltransaksi" style="padding: 7.5px 10px 7.5px 10px;color:#124d12;background-color:#93E567;font-weight:bolder"><i class="fa-solid fa-arrow-up"></i>&nbsp;<i class="fa-solid fa-arrow-down"></i>&nbsp;Masuk-Keluar</button>
                    <a href="editopname.php"><button type="button" class="btn rounded-pill m-2" style="color:#124d12;background-color:#93E567;font-weight:bolder"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Edit</button></a>

                </div>




            </div>
            <!-- Sale & Revenue End -->



            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="text-center rounded p-4" style="background-color:#171a1b !important">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0" style="color:#93E567">Tabel Opname</h6>

                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0 border-light">
                            <thead class="text-white text-center">
                                <tr class="text-white">
                                    <th scope="col" style="width:60px">No</th>
                                    <th scope="col">Tgl Transaksi</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Kode Barang</th>
                                    <th scope="col">Masuk</th>
                                    <th scope="col">Keluar</th>
                                    <th scope="col">Deskripsi</th>




                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stokopname = mysqli_query($koneksi, "SELECT * FROM opname JOIN tbbarang ON opname.kodeb = tbbarang.kodeb ORDER BY nota");
                                $i = 1;

                                while ($tampil = mysqli_fetch_array($stokopname)) {
                                ?>
                                    <tr class="text-white text-center">
                                        <td> <?= $i++ ?></td>

                                        <td> <?= $tampil['tgltransaksi']; ?></td>
                                        <td class="text-start"> <?= $tampil['nota'] ?></td>
                                        <td class="text-start"> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
                                        <td> <?= $tampil['masuk']; ?></td>
                                        <td> <?= $tampil['keluar']; ?></td>
                                        <td class="text-start"> <?= $tampil['deskripsi']; ?></td>

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

    <a href="#" onclick="scrollToTop()" id="topBtn" class="btn btn-lg bg-success  back-to-top" style="width: 50px;"><i class="bi bi-arrow-up text-white"></i></a>

    <script>
        // Fungsi untuk menggulir ke atas
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
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
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <!-- oblur masuk-keluar -->
    <script>
        $(document).ready(function() {

            $("#masuk").on("input", function() {
                if ($(this).val().length > 0) {
                    $("#keluar").prop("disabled", true).css({
                        'background-color': 'darkred'
                    });
                    var newPlaceholder = "---";
                    $("#keluar").attr("placeholder", newPlaceholder);
                } else {
                    $("#keluar").prop("disabled", false).css({
                        'background-color': ''
                    });
                    var newPlaceholder = "Barang Keluar";
                    $("#keluar").attr("placeholder", newPlaceholder);
                }
            });

            $("#keluar").on("input", function() {
                if ($(this).val().length > 0) {
                    $("#masuk").prop("disabled", true).css({
                        'background-color': 'darkred'
                    });
                    var newPlaceholder = "---";
                    $("#masuk").attr("placeholder", newPlaceholder);
                } else {
                    $("#masuk").prop("disabled", false).css({
                        'background-color': ''
                    });
                    var newPlaceholder = "Barang Masuk";
                    $("#masuk").attr("placeholder", newPlaceholder);
                }
            });
        });
    </script>


    <!-- ubah placeholder -->





</body>


<!-- transaksi -->
<div class="modal fade" id="myModaltransaksi">
    <div class="modal-dialog modal-dialog-scrollable modal-md">
        <div class="modal-content" style="background-color:#171a1b;">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Opname</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <br>
            <!-- Modal body masuk -->

            <div class="modal-body" style="display:flex;justify-content:center;align-items:center;width:100%">
                <form method="post" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
                    <label for="">
                        Kodeb&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;
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
                    <br>

                    <br>
                    <label for="">
                        Masuk&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;
                        <input type="text" name="masuk" id="masuk" placeholder="Barang Masuk" style="height: 30px;width: 300px;text-align:center;font-weight:bold">
                    </label>
                    <input type="hidden" name="nota" value="<?= $tampil['nota']; ?>">
                    <br>
                    <br>
                    <label for="">
                        Keluar&ensp;&ensp;&ensp;&nbsp;&nbsp;&nbsp;
                        <input type='text' name='keluar' id="keluar" placeholder="Barang Keluar" style="height: 30px;width: 300px;text-align:center;font-weight:bold">
                    </label>
                    <br>
                    <br>
                    <label for="">
                        Deskripsi&ensp;&ensp;
                        <input type='text' name='deskripsi' placeholder="Deskripsi" style="height: 30px;width: 300px;text-align:center;font-weight:bold">

                    </label>
                    <br>
                    <br>
                    <label for="">
                        Tanggal&ensp;&ensp;&nbsp;&nbsp;&nbsp;
                        <input type='date' name='tgltransaksi' style="height: 30px;width: 300px;text-align:center;font-weight:bold;" required>

                    </label>
                    <br>
                    <br>
                    <div style="width:100%;justify-content:flex-end;display:flex;margin-top:10px;margin-bottom:10px;">
                        <button type="submit" class="btn " name="addtransaksi" style="background-color:#93E567;color:#124d12;font-weight:bolder">Tambah</button>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">`
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>





</html>