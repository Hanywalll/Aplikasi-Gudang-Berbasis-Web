<?php
include 'koneksi.php';
include 'cekgroup.php';

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
  <title>Edit Data Group</title>
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
    <!-- Spinner End -->


    <!-- Sidebar Start -->

    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content" style="width:100%;margin:-5px">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0 justify-content-between" style="height: 90px;width:100%">
        <h3 style="color:#93E567;">Edit Data Group</h3>
        <a href="logouteditgroup.php"> <button type="button" class="btn rounded-pill m-2" data-bs-toggle="modal" data-bs-target="#fol" name="editgrup" style="background-color:#93E567;color:#124d12"><i class="fa fa-mail-reply"></i>Kembali</button></a>


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
            <h6 class="mb-0">Data Group</h6>
            <!-- <a href="">Show All</a> -->
          </div>
          <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0 border-light " id="colio">
              <thead>
                <tr class="text-white text-center">

                  <th scope="col">No</th>
                  <th scope="col">Kodeg</th>
                  <th scope="col">Namag</th>
                  <th scope="col">Aksi</th>




                </tr>
              </thead>
              <tbody id="pol">
                <?php
                $stokbarang = mysqli_query($koneksi, "SELECT * FROM tbgroup ");
                $i = 1;
                while ($tampil = mysqli_fetch_array($stokbarang)) {
                ?>
                  <tr class="text-center text-white">
                    <td> <?= $i++ ?></td>
                    <td> <?= $tampil['kodeg']; ?></td>
                    <td> <?= $tampil['namag']; ?></td>

                    <td>

                      <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editgroup<?= $tampil['kodeg']; ?>">
                        <i class="fa-solid fa-pen-to-square"></i>Edit
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletegroup<?= $tampil['kodeg']; ?>">
                        <i class="fa-solid fa-trash"></i>Delete
                      </button>

                    </td>


                  </tr>
                  <!-- edit group -->
                  <div class="modal fade" id="editgroup<?= $tampil['kodeg']; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Edit Data Group</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <!-- Modal body -->
                          <form method="post" autocomplete="off">
                            <div class="modal-body">


                            <label for="">
                              Nama Group&ensp;&ensp;&ensp;
                              <input type='text' name='namag' value="<?= $tampil['namag']; ?>"  required>
                            </label>
                              <br>
                              <input type="hidden" name="kodeg" value="<?= $tampil['kodeg']; ?>">
                              <br><br>
                              <button type="submit" class="btn btn-primary" name="updategroup">Update Group</button>


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



                  <!-- delete group -->
                  <div class="modal fade" id="deletegroup<?= $tampil['kodeg']; ?>">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- Modal Header -->
                          <div class="modal-header">
                            <h4 class="modal-title">Hapus Data Group</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                          </div>

                          <!-- Modal body -->
                          <form method="post">
                            <div class="modal-body">

                              <p>Apakah Yakin Anda Ingin Menghapus <?= $tampil['namag']; ?>?</p>
                              <input type="hidden" name="kodeg" value="<?= $tampil['kodeg']; ?>">


                              <button type="submit" class="btn btn-primary" name="deletegroup">Delete Data Group</button>


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

  <!-- Template Javascript -->
  <script src="js/main.js"></script>
</body>




</html>