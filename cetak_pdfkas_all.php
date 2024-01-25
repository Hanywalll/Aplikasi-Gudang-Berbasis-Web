<?php
include 'koneksi.php';
require_once('vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf();
$namaFile = 'Laporan Kas';
$mpdf->AddPage('L');

ob_start();
    
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
    <title>PDF</title>
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
                        <h3 class="mb-0">Laporan Kas</h3>
                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="5" style="text-align:center">
                            <thead>
                                <tr class="text-white text-center">
                                    <th scope="col" style="width:60px">No</th>
                                    <th scope="col" style="width:150px">tanggal</th>
                                    <th scope="col" style="width:150px">Nota</th>
                                    <th scope="col" style="width:150px">Nama Barang</th>
                                    <th scope="col" style="width:150px">Pemasukan</th>
                                    <th scope="col" style="width:150px">Pengeluaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                $query    =mysqli_query($koneksi, "SELECT * FROM  stock join tbbarang ON tbbarang.kodeb = stock.kodeb where nota LIKE '%NPM%' OR nota LIKE '%NPJ%' ");
                                $i = 1;
                             
    
                                while ($data    =mysqli_fetch_array($query)){
                                    $pemasukan       =$data['keluar']*$data['hjual'];
                                    $pengeluaran       =$data['masuk']*$data['hbeli'];
                                ?>

                                    <tr style="text-align:center">

                                    <td> <?= $i++;?></td>
                                    <td> <?= $data['tgltransaksi'];?></td>
                                    <td style="text-align: left;">  <?= $data['nota'];?></td>
                                    <td style="text-align: left;"> <?= $data['kodeb'];?> - <?= $data['namab'];?></td>
                                    <td style="text-align: left;"> <?="Rp.", number_format( $pemasukan , 2, ',', '.')?></td>
                                    <td style="text-align: left;"> <?="Rp.", number_format( $pengeluaran , 2, ',', '.')?></td>
                                    </tr>                         
                            
                                <?php
                                
                            $pemasukan       =$data['keluar']*$data['hjual'];
                            $pengeluaran      =$data['masuk']*$data['hbeli'];

                         
                              
                          }
                          ?>
   


        
                            <?php
     
               
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>

    </div>



    <!-- Template Javascript -->

</body>


<?php
        $html = ob_get_contents();
        ob_end_clean();
        $mpdf->WriteHTML(utf8_encode($html));
        $mpdf->Output("".$namaFile.".pdf",'D');
    ?>

</html>