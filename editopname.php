<?php
include 'koneksi.php';
include 'cekopname.php';



if (isset($_POST['submit'])) {
  // Aksi pertama: Lakukan sesuatu di sini
  $masuk = $_POST['masuk'];
  $keluar = $_POST['keluar'];
  $nota = $_POST['nota'];
  $kodeb = $_POST['kodeb'];


  if (!empty($keluar)) {
    //update tabel stockopname
    $updatemasuk = mysqli_query($koneksi, "UPDATE opname set keluar='$keluar' where nota = '$nota' ");

    //update tabel stock kolom masuk
    $update1 = mysqli_query($koneksi, "UPDATE stock set keluar = '$keluar' where nota = '$nota' ");

    $query    = mysqli_query($koneksi, "SELECT *FROM stock where kodeb = '$kodeb'");
    while ($data    = mysqli_fetch_array($query)) {
      $barangmasuk[] = $data['masuk'];
      $barangkeluar[] = $data['keluar'];
    }
    //kirim data ke tb barang
    $total_masuk = array_sum($barangmasuk);
    $total_keluar = array_sum($barangkeluar);

    $cetakmasuk = mysqli_query($koneksi, "update tbbarang set stock = '$total_masuk' - '$total_keluar' where kodeb='$kodeb'");

    if ($updatemasuk) {
      header('location:editopname.php');
    } else {
      echo 'Gagal';
      header('location:editopname.php');
    }
  }
  if (empty($keluar)) {
  }
  if (!empty($masuk)) {
    $updatemasuk = mysqli_query($koneksi, "UPDATE opname set masuk='$masuk' where nota = '$nota' ");

    //update tabel stock kolom masuk
    $update1 = mysqli_query($koneksi, "UPDATE stock set masuk='$masuk' where nota = '$nota' ");

    $query    = mysqli_query($koneksi, "SELECT *FROM stock where kodeb = '$kodeb' ");
    while ($data    = mysqli_fetch_array($query)) {
      $barangmasuk[] = $data['masuk'];
      $barangkeluar[] = $data['keluar'];
    }
    //kirim data ke tb barang
    $total_masuk = array_sum($barangmasuk);
    $total_keluar = array_sum($barangkeluar);

    $cetakmasuk = mysqli_query($koneksi, "update tbbarang set stock = '$total_masuk' - '$total_keluar' where kodeb='$kodeb'");

    if ($updatemasuk) {
      header('location:editopname.php');
    } else {
      echo 'Gagal';
      header('location:editopname.php');
    }
  }
  if (empty($masuk)) {
  } else {
    // Aksi kedua: Lakukan yang lain di sini
    // Misalnya, proses data formulir atau tindakan lain
    echo "Form berhasil disubmit!";
  }
}

//Hapus Barang
if (isset($_POST['deleteopname'])) {
  $nota = $_POST['nota'];
  $kodeb = $_POST['kodeb'];
  $barangmasuk[] = $data['masuk'];

  // hapus data di tabel opname
  $hapusopname = mysqli_query($koneksi, "delete from opname where nota = '$nota'");

  // hapus data dari tabel stock
  $cetakmasukk = mysqli_query($koneksi, "delete from stock where nota = '$nota'");

  $query    = mysqli_query($koneksi, "SELECT *FROM stock where kodeb = '$kodeb'");

  while ($data    = mysqli_fetch_array($query)) {
    $barangmasuk[] = $data['masuk'];
  }
  //kirim data ke tb barang
  $total_masuk = array_sum($barangmasuk);

  $cetakmasuk = mysqli_query($koneksi, "update tbbarang set stock = $total_masuk where kodeb='$kodeb'");


  if ($hapusopname) {
    header('location:editopname.php');
  } else {
    echo 'Gagal';
    header('location:editopname.php');
  }
  if ($hapusstock) {
    header('location:editopname.php');
  } else {
    echo 'Gagal';
    header('location:editopname.php');
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Edit Data Barang</title>
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
       *{
            user-select: none;
        }
    body .modal-body {
      max-height: 550px;
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
    <!-- Spinner End -->


    <!-- Sidebar Start -->

    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content" style="width:100%;margin:-5px">
      <!-- Navbar Start -->
      <div class="content" style="width:100%;margin:-5px">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 justify-content-between" style="height: 90px;">
        <h3 style="color:#93E567;">Edit Data Opname</h3>
        <a href="logouteditopname.php"> <button type="button" class="btn rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#fol" name="editgrup" style="background-color:#93E567;color:#124d12"><i class="fa fa-mail-reply"></i>Kembali</button></a>


      </nav>
      <!-- Navbar End -->


      <!-- Sale & Revenue Start -->
      <!-- <div class="container-fluid pt-4 px-4" style="display: flex;">
                <div>
                    <h3 style="color: #EB1616;" >EDIT BARANG</h3>
                </div>
                
                
                 
                    
                   
            </div> -->
      <!-- Sale & Revenue End -->



      <!-- Recent Sales Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Data Barang</h6>
            <!-- <a href="" style="color:#93E567">Show All</a> -->
          </div>
          <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0 border-light text-center text-white" id="colio">
              <thead>
                <tr class="text-white">
                  <th scope="col">No</th>
                  <th scope="col">Kode Barang</th>
                  <th scope="col">Nota</th>
                  <th scope="col">Masuk</th>
                  <th scope="col">Keluar</th>
                  <th scope="col">Tgl Transaksi</th>
                  <th scope="col">Aksi</th>



                </tr>
              </thead>
              <tbody id="pol">
                <?php
                $stokopname = mysqli_query($koneksi, "SELECT * FROM opname JOIN tbbarang ON opname.kodeb = tbbarang.kodeb ORDER BY nota");
                $i = 1;


                while ($tampil = mysqli_fetch_array($stokopname)) {
                ?>
                  <tr>
                    <td> <?= $i++ ?></td>
                    <td> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
                    <td> <?= $tampil['nota']; ?></td>
                    <td> <?= $tampil['masuk']; ?></td>
                    <td> <?= $tampil['keluar']; ?></td>
                    <td> <?= $tampil['tgltransaksi']; ?></td>



                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editopname<?= $tampil['nota']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i>Edit
                      </button>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $tampil['nota']; ?>">
                        Hapus
                      </button>

                    </td>


                  </tr>



                  <!-- Hapus Barang -->

                  <div class="modal fade" id="exampleModal<?= $tampil['nota']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post">
                            <div class="modal-body">

                              <p>Anda Yakin Ingin Menghapus Transaksi <?= $tampil['namab']; ?>?</p>
                              <p>dengan nota <?= $tampil['nota']; ?>?</p>


                              <input type="hidden" name="nota" value="<?= $tampil['nota']; ?>">
                              <input type="hidden" name="kodeb" value="<?= $tampil['kodeb']; ?>">



                              <button type="submit" class="btn btn-primary" name="deleteopname">Delete Data Barang</button>


                            </div>

                          </form>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                        </div>
                      </div>
                    </div>
                  </div>



                  <!-- edit barang -->
                  <div class="modal fade" id="editopname<?= $tampil['nota']; ?>">
                    <div class="modal-dialog modal-dialog-scrollable modal-md">
                      <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Data Opname</h4>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Masuk -->
                        <!-- Modal body -->
                        <div class="modal-body" style="display:flex;justify-content:center;align-items:center;margin-top :19px;">
                          <form class="myForm" method="post" autocomplete="off">
                            <div class="kiri" style="display:flex;justify-content:center;align-items:center;width: 100%;">
                              <div style="justify-content:center;height:100%;width:100%;">
                                <h4 class="modal-title" style="display:flex;justify-content:flex-start;width:100%;padding-left:15px">Masuk</h4>
                                <br>
                                <label for="">
                                  Masuk&emsp;
                                  <input type='text' name='masuk' id="masuk" value="<?= $tampil['masuk']; ?>" style="height: 30px;width: 300px;text-align:center;font-weight:bold" required>

                                </label>
                                <br>
                                <br>
                                <label for="">
                                  Keluar&emsp;&nbsp;
                                  <input type='text' name='keluar' id="keluar" value="<?= $tampil['keluar']; ?>" style="height: 30px;width: 300px;text-align:center;font-weight:bold" required>

                                </label>
                                <br>
                                <input type="hidden" name="nota" value="<?= $tampil['nota']; ?>">
                                <input type="hidden" name="kodeb" value="<?= $tampil['kodeb']; ?>">

                                <br>

                                <div style="width:100%;justify-content:flex-end;display:flex;margin-top:20px;">
                                  <button type="submit" class="btn btn-primary" name="submit" style="height: 40px;width: 150px;text-align:center;font-weight:bold;margin-bottom:20px;margin-right:48px">Update</button>

                                </div>

                              </div>
                              <!-- Modal footer -->


                          </form>
                        </div>
                      </div>

                      <div class="modal-footer">
                        <form method="post">
                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                      </div>

                    </div>
                  </div>

                <?php }



                ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>


    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
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
  <script src="js/rp2.js"></script>


  <!-- Template Javascript -->
  <script src="js/main.js"></script>




  <!-- oblur masuk-keluar -->
  <script>
    $('.myForm #masuk,#keluar').filter(function() {
      return +this.value === 0;
    }).closest("input").prop("disabled", true).css({
      'background-color': 'darkred'
    });
    var newPlaceholder = "---";
    $("#keluar").attr("placeholder", newPlaceholder);

    $('.myForm #keluar,#masuk').filter(function() {
      return +this.value === 0;
    }).closest("input").prop("disabled", true).css({
      'background-color': 'darkred'
    });
    var newPlaceholder = "---";
    $("#keluar").attr("placeholder", newPlaceholder);
  </script>


</body>




</html>