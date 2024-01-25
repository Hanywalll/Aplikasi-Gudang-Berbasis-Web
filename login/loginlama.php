<?php
include 'koneksi.php';


//login
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //mencocokan data
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM login where username ='$username' and password ='$password'");


    //hitung data
    $hitung = mysqli_num_rows($cekdatabase);
    if($hitung>0) {
        echo "data Ada";
        $_SESSION['log'] = 'True';
        header('location:index.php');
    }else{
        $error_message = "Username atau Password Salah. Silakan Coba Lagi.";
        header('location:login.php?login_error=' . urlencode($error_message));
    };
};
if (isset($_GET['login_error'])) {
    $error_message = urldecode($_GET['login_error']);
    echo '<div class="alert alert-danger">' . $error_message . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    <link rel="stylesheet" href="css/login.css">
</head>
<body class="main-bg">
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
</div>
        <div class="login-container text-c animated flipInX">
                <div>
                    <h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
                </div>
                    <h3 class="text-whitesmoke">Login</h3>
                <div class="container-content">
                <form method="post"> 
                    
                        <form class="margin-t">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Enter Username" required="">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Enter Password" required="">
                            </div>
                            <button type="submit" class="form-button button-l margin-b" name="login">Login</button>
                            
                        </form>
                </form>
                        <p class="margin-t text-whitesmoke"><small>  ThanBlue &copy; 2015</small> </p>
                </div>
            </div>
</body>
</html>