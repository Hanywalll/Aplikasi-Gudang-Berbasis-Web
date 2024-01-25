<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>

<body>
   <?php

   include 'koneksi.php';

   // Read POST data
   $data = json_decode(file_get_contents("php://input"));

   if (isset($data->kodeb)) {

      $kodeb = mysqli_real_escape_string($koneksi, $data->kodeb);

      $query = "select count(*) as cntUser from tbbarang where kodeb='" . $kodeb . "'";

      $result = mysqli_query($koneksi, $query);
      $response = "<span style='color: white;'>Kode barang Bisa Digunakan</span>";
      if (mysqli_num_rows($result)) {
         $row = mysqli_fetch_array($result);

         $count = $row['cntUser'];

         if ($count > 0) {
            $response = "<span style='color: white;'>Kode Barang Telah Terdaftar</span>";
         }
      }
      echo $response;
   }

   ?>
   <!--AJAX -->
   <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

</body>

</html>