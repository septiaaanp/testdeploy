<?php
//koneksi database
session_start();
require 'koneksi.php';
// $koneksi = new mysqli ("localhost","root","","gsw");
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

// enkripsi password
@$password = mysqli_real_escape_string($koneksi, trim($_POST['pass']));
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="media/logo.png">
    <title>Login - PT. Garuda Sakti Waspada</title>
    <br/>
  </head>
  <body>


    <!-- Container -->
    <div class="container">
    <!-- login -->
    <div class="card border-primary mx-auto" style ="max-width: 380px;">
      <div class = "card-body">
      <form class="form-signin " autocomplete="off" action="" method="POST">
        <img class="mx-auto d-block" src="media/simgasawa.png" alt="" width="300" height="110"><br/>
        <p class="text-center text-muted mb-0">Masukkan Username dan Password anda pada kolom di bawah ini!</p> <br/>
          <label for="inputEmail" class="sr-only">Username</label>
            <input type="text" class="form-control" placeholder="Username" name = "user" required autofocus>
          <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" name = "pass" placeholder="Password" required>
        <button class="btn btn-primary btn-block" type="submit" name="login">
          <span class="spinner-border spinner-border-sm"></span>Log in
        </button>
        <p class="divider-text">
          <span class="bg-light">Atau</span>
        </p>
        <div class="text-center forget">
          <a href="forgotpassword.php">Lupa Password?</a>
        </div>
      </form>

      <!-- PHP LOGIN -->
      <?php
          if (isset($_POST['login']))
          {
              $ambil = $koneksi->query("SELECT * FROM admin WHERE BINARY username = '$_POST[user]'
              AND BINARY password ='$_POST[pass]'");
              $yangcocok = $ambil->num_rows;
              if ($yangcocok==0)
              {
                $ambil = $koneksi->query("SELECT * FROM admin WHERE BINARY username = '$_POST[user]'");
                $yangcocok = $ambil->num_rows;
                if ($yangcocok==0)
                { 
                  echo "<div class='alert alert-danger'>Username tidak terdaftar !</div>";
                  echo "<meta http-equiv='refresh'>";
                }else{
                  echo "<div class='alert alert-danger'>Password anda salah !</div>";
                  echo "<meta http-equiv='refresh'>";
                }         
              }
              else
              { 
                $baris = $ambil->fetch_assoc();
                $_SESSION['admin']='admin';
                $_SESSION['username']=$baris['username'];
                echo "<div class = 'alert alert-info'>Login berhasil</div>";
                echo "<meta http-equiv='refresh' content = '1;url=index.php'>";
                  
              }
          }
      
      ?>   
          </div>           
      </div><br/>
      <!-- end login -->

      <!-- <div class="card border-primary mx-auto" style ="max-width: 380px;">
        <div class = "card-body">
          <p class="text-center mb-0">Belum punya akun? <a href="register.php">Daftar disini</a> </p>  
        </div>
      </div> -->
    </div>
    <!-- /end container -->
    <p class="text-center mb-3 text-muted">&copy; PT.Garuda Sakti Waspada - 2019</p>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>