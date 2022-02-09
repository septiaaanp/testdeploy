<?php
//koneksi database
session_start();
$koneksi = new mysqli ("localhost","root","","gsw");
// filter data yang diinputkan
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
// enkripsi password
@$password = mysqli_real_escape_string($koneksi, trim($_POST['password']));
@$confirm = mysqli_real_escape_string($koneksi, trim($_POST['confirm']));

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
    <title>Register - PT. Garuda Sakti Waspada</title>
    
   
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  </head>
  
  <body>
    <!-- Container -->
    <div class="container">
    <br/>
    <div class="card bg-light">
    <article class="card-body mx-auto" style="max-width: 400px;">
        <h4 class="card-title mt-3 text-center">Buat Akun</h4>

    <form action="" autocomplete="off" method="post">
        
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="name" class="form-control" placeholder="Nama Lengkap" type="text">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="username" class="form-control" placeholder="Nama User" type="text">
        </div> <!-- form-group// -->
        
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
            </div>
            <input name="email" class="form-control" placeholder="Alamat Email" type="email">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name ="password" class="form-control" placeholder="Password" type="password">
        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name ="confirm" class="form-control" placeholder="Konfirmasi Password" type="password">
        </div> <!-- form-group// -->                                      
        <div class="form-group">
            <button name = "submit" type="submit" class="btn btn-primary btn-block"> Buat Akun  </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Sudah Punya Akun? <a href="login.php">Log In</a> </p>                                                                 
    </form>
    </article>
    <div class = "mx-auto">
    <!-- Start PHP -->
    <?php

    if (isset ($_POST ['submit']))
    { 
        if ($username&&$password&&$confirm){
            //berfunsgi untuk mengecek form tidak boleh lebih dari 10
            if (strlen($username) > 10)
            {
                echo "<div class='alert alert-warning alert-dismissible fade show'>Username tidak boleh lebih dari 10 karakter!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                      </div>";
            }else{
                //password harus 6-25 karakter
                if (strlen($password) > 25 || strlen($confirm) < 6){
                    echo "<div class='alert alert-warning alert-dismissible fade show'>Password harus antara 6-25 karakter!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
                }else{
                    //untuk mengecek apakah form password dan form konfirmasi password sudah sama
                    if ($password == $confirm){ 
                        $sql_get = mysqli_query ($koneksi,"SELECT * FROM admin where username = '$username' OR email = '$email'");
                        $num_row = mysqli_num_rows($sql_get);
                        //fungsi script ini adalah untuk mengecek ketersediaan username, jika tidak tersedia maka program tdk akan berjalan    
                        if ($num_row == 0){
                            $koneksi->query ("INSERT INTO admin
                            (nama, username, email, password)
                            VALUES('$_POST[name]','$_POST[username]','$_POST[email]','$_POST[password]')");
        
                            echo "<div class = 'alert alert-info alert-dismissible fade show'>Data tersimpan!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>";
                            echo "<meta http-equiv= 'refresh' content = '1;url=index.php'>";   
                        }else {
                            echo "<div class='alert alert-warning alert-dismissible fade show'>Username atau Email sudah terdaftar!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>";
                        }
                    }else {
                            echo "<div class='alert alert-warning alert-dismissible fade show'>Password yang dimasukkan tidak sama!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>";
                        }
                }
            }
        }else {
            echo "<div class='alert alert-warning alert-dismissible fade show'>Silahkan lengkapi formulir ini!
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>";
        }
    } 
    ?>
    </div>
    </div> <!-- card.// -->

    </div><br/> 
    <!--container end.//-->
    <p class="text-center mb-3 text-muted">&copy; PT.Garuda Sakti Waspada - 2019</p>
    <br/>
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>