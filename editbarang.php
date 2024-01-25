<?php
include 'koneksi.php';
include 'cekstock.php';

//edit barang
if (isset($_POST['updatebarang'])) {
  $kodeb = $_POST['kodeb'];
  $namab = $_POST['namab'];
  $satuan = $_POST['satuan'];
  $ket = $_POST['ket'];
  $hbeli = $_POST['hbeli'];
  $hpokok = $_POST['hpokok'];
  $hjual = $_POST['hjual'];
  $status = $_POST['status'];
  $stockmin = $_POST['stockmin'];

  $update = mysqli_query($koneksi, "UPDATE tbbarang set namab='$namab', satuan='$satuan', ket='$ket', hbeli='$hbeli', hpokok='$hpokok', hjual='$hjual', status='$status', stockmin='$stockmin' where kodeb = '$kodeb'");
  if ($update) {
    header('location:editbarang.php');
  } else {
    echo 'Gagal';
    header('location:editbarang.php');
  }
}

//Hapus Barang
if (isset($_POST['deletebarang'])) {
  $kodeb = $_POST['kodeb'];

  $hapus = mysqli_query($koneksi, "delete from tbbarang where kodeb = '$kodeb'");
  if ($hapus) {
    header('location:editbarang.php');
  } else {
    echo 'Gagal';
    header('location:editbarang.php');
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
      <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 justify-content-between" style="height: 90px;width:100%;margin:none">
        <h3 style="color:#93E567;">Edit Data Barang</h3>
        <a href="logouteditbarang.php"> <button type="button" class="btn rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#fol" name="editgrup" style="background-color:#93E567;color:#124d12"><i class="fa fa-mail-reply"></i>Kembali</button></a>


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
            <table class="table text-start align-middle table-bordered table-hover mb-0 border-light border-light text-center text-white" id="colio">
              <thead>
                <tr class="text-white">

                  <th scope="col">No</th>
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
                  <th scope="col">Aksi</th>

                </tr>
              </thead>
              <tbody id="pol">
                <?php
                $stokbarang = mysqli_query($koneksi, "SELECT * FROM tbbarang ");
                $i = 1;
                while ($tampil = mysqli_fetch_array($stokbarang)) {
                ?>
                  <tr>
                    <td> <?= $i++ ?></td>

                    <td> <?= $tampil['kodeg']; ?></td>
                    <td> <?= $tampil['kodeb']; ?></td>
                    <td> <?= $tampil['namab']; ?></td>
                    <td> <?= number_format($tampil['stock'], 2, ',', '.'); ?></td>
                    <td> <?= $tampil['satuan']; ?></td>
                    <td> <?= $tampil['ket']; ?></td>
                    <td> <?= number_format($tampil['hbeli'], 2, ',', '.'); ?></td>
                    <td> <?= number_format($tampil['hpokok'], 2, ',', '.'); ?></td>
                    <td> <?= number_format($tampil['hjual'], 2, ',', '.'); ?></td>
                    <td> <?= $tampil['status']; ?></td>
                    <td> <?= $tampil['stockmin']; ?></td>

                    <td>
                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editbrg<?= $tampil['kodeb']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i>Edit
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletebrg<?= $tampil['kodeb']; ?>">
                        <i class="fa-solid fa-trash"></i>Delete
                      </button>

                    </td>


                  </tr>
                  <!-- edit barang -->
                  <div class="modal fade" id="editbrg<?= $tampil['kodeb']; ?>">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Barang</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <!-- Modal body -->
                          <form id="form" method="post" autocomplete="off">
                            <div class="modal-body" style="display:flex;justify-content:center;align-items:center;margin-top :19px;">


                              <div class="kiri" style="display:flex;flex-direction:column;justify-content:center;align-items:center;width: 100%">
                                <div style="justify-content:center;height:100%;width:75%;display:flex;flex-direction:column;align-items:flex-end">
                                  <label for="">
                                    Namab&emsp;
                                    <input type='text' name='namab' value="<?= $tampil['namab']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                  </label>
                                  <br>

                                  <label for="">
                                    Satuan&emsp;
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
                                    Ket&emsp;
                                    <input type='text' name='ket' value="<?= $tampil['ket']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                  </label>
                                  <br>
                                  <label for="">
                                    Hbeli&emsp;
                                    <input type='text' name='hbeli' value="<?= $tampil['hbeli']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                  </label>
                                  <br>
                                </div>
                              </div>



                              <div class="kanan" style="display:flex;flex-direction:column;justify-content:center;align-items:center;width: 100%;margin-top:26px;margin-top:-25px">
                                <div style="justify-content:center;height:100%;width:75%;display:flex;flex-direction:column;align-items:flex-start;">
                                  <label for="">
                                    Hpokok&emsp;
                                    <input type='text' name='hpokok' value="<?= $tampil['hpokok']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                  </label>
                                  <br>
                                  <label for="">
                                    Hjual&emsp;&emsp;&nbsp;
                                    <input type='text' name='hjual' value="<?= $tampil['hjual']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold" required>

                                  </label>
                                  <br>

                                  <div class="form-group mb-3" style="text-align: left;">
                                    <label for="" required>
                                      Status&emsp;
                                      <input type="radio" name="status" value="1" required /> Tersedia
                                      <input type="radio" name="status" value="0" required /> Tidak Tersedia
                                    </label>
                                  </div>

                                  <label for="">
                                    Stockmin
                                    <input type='text' name='stockmin' value="<?= $tampil['stockmin']; ?>" style="height: 30px;width: 200px;text-align:center;font-weight:bold;margin-top:15px" required>

                                  </label>

                                </div>
                              </div>

                            </div>

                            <input type="hidden" name="kodeb" value="<?= $tampil['kodeb']; ?>">

                            <div style="width:100%;justify-content:center;display:flex;margin-top:20px">
                              <button type="submit" class="btn btn-primary" name="updatebarang" style="height: 40px;width: 150px;text-align:center;font-weight:bold;margin-bottom:20px">Update Barang</button>

                            </div>





                            <div class="modal-footer">
                              <form method="post">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                            </div>

                        </div>
                        <!-- Modal footer -->

                      </div>
                      </form>

                    </div>
                  </div>
          </div>
        </div>



        <!-- DELETE barang -->
        <div class="modal fade" id="deletebrg<?= $tampil['kodeb']; ?>">
          <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-dialog">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Hapus Data Barang</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <form method="post">
                  <div class="modal-body">

                    <p>Apakah Yakin Anda Ingin Menghapus <?= $tampil['namab']; ?>?</p>
                    <input type="hidden" name="kodeb" value="<?= $tampil['kodeb']; ?>">


                    <button type="submit" class="btn btn-primary" name="deletebarang">Delete Data Barang</button>


                  </div>

                </form>


                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>

              </div>
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
</body>




</html>