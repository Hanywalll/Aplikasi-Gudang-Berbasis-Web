<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "appgudang");
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan Kas.xls"); 

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Ambil tanggal awal dan tanggal akhir dari form
$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];

// Query untuk mengambil data transaksi dalam periode tertentu
$query = "SELECT * FROM stock
JOIN tbbarang ON tbbarang.kodeb = stock.kodeb
WHERE tgltransaksi BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
AND (nota LIKE '%NPM%' OR nota LIKE '%NPJ%')";
$result = mysqli_query($koneksi, $query);

$tgl_awal = date("d-m-Y", strtotime($tanggal_awal));
$tgl_akhir = date("d-m-Y", strtotime($tanggal_akhir));

// format ubah bulan yang berupa angka ke huruf 
$tanggal_awal_obj = new DateTime($tanggal_awal);
$tanggal_akhir_obj = new DateTime($tanggal_akhir);

$tanggal_awal_string = $tanggal_awal_obj->format('d F Y');
$tanggal_akhir_string = $tanggal_akhir_obj->format('d F Y');


// Tutup koneksi ke database
mysqli_close($koneksi);




?>


<html>
    
    <head>
    <title>EXCEL
</title>





</head>

<body>


    <div >
        <!-- Spinner Start -->
      
    

            <div >
                <div >
                    <div >
                        <h3 >Laporan kas
</h3>
                    <h3 >Periode <?php  echo"$tanggal_awal_string";?> &nbsp;<?php echo"S/d"?>&nbsp; <?php  echo" $tanggal_akhir_string" ?></h3>                                                        

                        <!-- <a href="">Show All</a> -->
                    </div>
                    <div class="table-responsive">
                    <table border="1" width="100%" cellspacing="0" cellpadding="5" style="text-align:center">
                    <thead>
                        <tr>
                        <th style="width:60px" scope="col">No</th>
                        <th style="width:150px" scope="col">Tgl Transaksi</th>
                        <th style="width:150px" scope="col">Nota</th>
                        <th style="width:150px" scope="col">Kode Barang</th>
                        <th style="width:150px" scope="col">Pemasukan</th>
                        <th style="width:150px" scope="col">Pengeluaran</th>
                    </thead>
                <tbody>
                    <?php
                    // Proses hasil query untuk membuat laporan
                    $i = 1;
                    if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $pemasukan      = $row['keluar'] * $row['hjual'];
                        $pengeluaran    = $row['masuk'] * $row['hbeli'];
                        
                        echo '<tr style="text-align:center">';
                        echo "<td>" . $i++ . "</td>";
                        echo "<td>" . $row['tgltransaksi'] . "</td>";
                        echo '<td style="text-align:left">' . $row['nota'] . "</td>";
                        echo '<td style="text-align:left">' . $row['kodeb'] . ' - ' . $row['namab'] . "</td>";
                        echo '<td style="text-align:left">' . "Rp.", number_format($pemasukan, 2, ',', '.') . "</td>";
                        echo '<td style="text-align:left">' . "Rp.", number_format($pengeluaran, 2, ',', '.') . "</td>";


                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "Tidak ada data transaksi dalam periode ini.";
                                                    }

                                                    ?>
                                        </div>
                                    </div>
                                </div>





                                <?php


                                ?>
                                </tbody>
                                </table>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <!-- JavaScript Libraries -->


    <!-- Template Javascript -->
    <script src="js/main.js"></script>
 



</body>

</html>














  