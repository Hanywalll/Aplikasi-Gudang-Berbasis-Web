<?php
include 'koneksi.php';




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PRINT</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
   


</head>

<body>


    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->


        <div class="content" style="width:100%;margin:-1px">
            <!-- Navbar Start -->

       
            <div class="container-fluid pt-4 px-4 w-100">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0">Laporan Pembelian</h3>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table border="1" width="100%" style="text-align: center;" cellspacing="0">
                                                    <thead>
                                                    <tr >
                                                            <th  scope="col" style="width: 60px;">No</th>
                                                            <th scope="col" style="width: 150px;">Tgl Transaksi</th>
                                                            <th scope="col" style="width: 150px;">Nota</th>
                                                            <th scope="col" style="width: 150px;">Kode Barang</th>
                                                            <th scope="col" style="width: 80px;">masuk</th>
                                                            <th scope="col " style="width: 200px;">Deskripsi</th>



                                                        </tr>
                                                    </thead>
                                                    <tbody >
                                                        <?php
                                                        $stokopname = mysqli_query($koneksi, "SELECT * FROM pembelian JOIN tbbarang ON pembelian.kodeb = tbbarang.kodeb");
                                                        $i = 1;

                                                        while ($tampil = mysqli_fetch_array($stokopname)) {
                                                        ?>
                                                            <tr style="text-align:center">
                                                                <td> <?= $i++ ?></td>
                                                                <td> <?= $tampil['tgltransaksi']; ?></td>
                                                                <td style="text-align:left"> <?= $tampil['nota'] ?></td>
                                                                <td style="text-align:left"> <?= $tampil['kodeb']; ?> - <?= $tampil['namab']; ?></td>
                                                                <td> <?= $tampil['masuk']; ?></td>
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

    </div>
   
    <script>
        window.print()
        window.onafterprint = function () {
            // Kembali ke halaman sebelumnya
            window.history.back();
        }

</script>

    <!-- Template Javascript -->

</body>




</html>