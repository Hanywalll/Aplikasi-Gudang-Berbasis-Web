<?php
include 'koneksi.php';



//login
if(isset($_POST['loginn'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    //mencocokan data
    $cekdatabase = mysqli_query($koneksi, "SELECT * FROM login where username ='$username' and password ='$password'");


    //hitung data
    $hitung = mysqli_num_rows($cekdatabase);
    if($hitung>0) {
        $_SESSION['log'] = 'True';
        header('location:index.php');
    }else{
        $error_message = "Username atau Password Salah. Silakan Coba Lagi.";
        header('location:login.php?login_error=' . urlencode($error_message));
    };
};
if (isset($_GET['login_error'])) {
    $error_message = urldecode($_GET['login_error']);
    echo '<div class="alert alert-danger" style="position:absolute;top:0;left:0;right:0;z-index:10">' . $error_message . '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
	<style>
     *{
            user-select: none;
        }
		body{
			overflow-y: hidden;
		}

	/* CSS disini */
  #button{
    background-color: transparent;
    border: 2px solid white;
  }
  #button:hover{
    color: black;
    background-color: white;
  }
	</style>
<!--===============================================================================================-->
</head>
<body >

	<video loop muted autoplay poster="kmy.mp4" class="fullscreen-bg__video" style="position:fixed; right: 0; top: 0;bottom:0;left:0;height:100%;width:100%; min-width:100%; z-index: 0; object-fit: cover;" class="video" loop muted>
		<source src="login/images/samurai.mp4" type="video/mp4">
					</video>
	
	
	<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-transparent text-white border-0" id="form-container" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
				
            <form action="" method="post" autocomplete="off">
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white mb-5">Masukkan Username & Password Anda</p>

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX" style="text-align: left;">Username</label>
				<input class="form-control form-control-lg"  type="text" name="username" id="inputUsername"  required>


              </div>

              <div class="form-outline form-white mb-4">
              <label class="form-label" for="typePasswordX" style="text-align: left;">Password</label>

				<input class="form-control form-control-lg" type="password" name="password" id="inputPassword"  required>

              </div>


              <button class="btn btn-outline-light btn-lg px-5" id="button" name="loginn" type="submit">Login</button>
              </form>

              <!-- <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div> -->

            </div>

            <!-- <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
              </p>
            </div> -->

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
	
<!--===============================================================================================-->
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/daterangepicker/moment.min.js"></script>
	<script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>