<?php
//koneksi database
session_start();
$koneksi = new mysqli ("localhost","root","","gsw");
@$password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
@$confirm = mysqli_real_escape_string($koneksi, trim($_POST['confirm']));
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="media/logo.png">
    <title>Reset Password - PT. Garuda Sakti Waspada</title>
  </head>
    <br/>
  <body>

    <!-- Container -->
    <div class="container">
        <!-- Card reset -->
        <div class="card mx-auto"style ="max-width: 350px;">
            <!-- Card header -->
            <div class="card-header">
                <h5><img class="img-fluid" src="media/logo.png" alt="Chania" style="max-width:15%; height:auto;">
                &nbsp;PT. Garuda Sakti Waspada</h5>
            </div>
            <!-- end header -->

            <!-- Card Body -->
            <div class="card-body">
            <form action="" autocomplete="off" method="POST">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name ="password" class="form-control" placeholder="Password Baru" type="password">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name ="confirm" class="form-control" placeholder="Konfirmasi Password" type="password">
                </div> <!-- form-group// --> 
                <button name = "submit" type="submit" class="btn btn-primary btn-block"> Ubah Password </button>
                <br/>

                <!-- Start PHP -->
                <?php
                    if(!isset($_GET["email"])){
                        exit ("Halaman ini tidak dapat diakses, silahkan melakukan permintaan tautan.");
                    }

                    $email =$_GET["email"];
                    $token =$koneksi->real_escape_string($_GET['token']);

                    $getEmailQuery = mysqli_query ($koneksi, "SELECT email FROM admin WHERE email = '$email' AND token='$token' AND token<>'' AND tokenExpire > NOW()");
                    if(mysqli_num_rows($getEmailQuery)==0){
                        exit("Halaman ini tidak dapat diakses, silahkan melakukan permintaan tautan.");
                    }

                    if(isset($_POST["submit"])){
                        if($password == $confirm){
                            $password = $_POST['password'];
                            $confirm = $_POST['confirm'];

                            $sql_get = mysqli_query ($koneksi,"SELECT * FROM admin where password = '$password' AND email = '$email'");
                            $num_row = mysqli_num_rows($sql_get);
                            
                            if($num_row == 0 ){
                                
                                $pw = $password;
                                $row = mysqli_query($koneksi, "UPDATE admin SET password='$pw' WHERE email='$email'");
                                echo "<p class='text-info text-center'>Password anda sudah berubah!</p>";
                                echo "<meta http-equiv= 'refresh' content = '1;url=index.php'>";     
                            }else{
                                echo "<div class='alert alert-danger'>Masukkan password yang baru!</div>";
                            }
                            
                        }else {
                            echo "<div class='alert alert-danger'>Konfirmasi password tidak sama!</div>";
                        }
                    }
                ?> 
                <!-- End PHP -->
            </form>  
            </div> 
            <!-- End Body -->
        </div>
        <!-- End Reset -->
    </div><br/>
    <!-- Container -->
    <p class="text-center mb-3 text-muted">&copy; PT.Garuda Sakti Waspada - 2019</p>
                    
  

   
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </body>
</html>