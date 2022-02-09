<?php
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL); 
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
    <title>Forgot Password - PT. Garuda Sakti Waspada</title>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!------ Include the above in your HEAD tag ---------->
  </head>

  <body>
   
    <br/><br/>
    <!-- Container -->
    <div class="container">
      <!-- Card -->
      <div class="card mx-auto"style ="max-width: 380px;">
        <!-- card body -->
        <div class="card-body text-center">
          <h3><i class="fa fa-lock fa-4x"></i></h3>
          <h2 class="text-center">Lupa Password?</h2>
          <p class="text-muted">Masukkan email Anda dan kami akan mengirimkan 
          Anda tautan untuk kembali ke akun Anda.</p>


          <form id="register-form" role="form" autocomplete="off" class="form" method="post">
            <!-- form group -->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                <input id="email" name="email" placeholder="Email Address" class="form-control"  type="email">
              </div>
            </div>
            <!-- form group -->
            <div class="form-group">
              <input name="submit" class="btn btn-sm btn-primary btn-block" value="Kirim tautan masuk" type="submit">
            </div>
            <input type="hidden" class="hide" name="token" id="token" value=""> 
            
            <!-- Start PHP MAiller-->
            <?php 
              if (isset($_POST["submit"])){
                  $koneksi = new mysqli ("localhost","root","","gsw");
                  $email = $koneksi->real_escape_string($_POST["email"]);

                  $data = $koneksi->query ("SELECT id_admin from admin where email = '$email' ");
                
                  if ($data->num_rows>0){
                    
                    $token = "qwertyuiopasdfghjklzxcvbnm0123456789";
                    $token = str_shuffle($token);
                    $token = substr($token, 0, 10);

                    $koneksi->query("UPDATE admin SET token='$token',
                    tokenExpire=DATE_ADD(NOW(), INTERVAL 5 MINUTE)
                    WHERE email='$email'");
                    
                    
                    require 'PHPMailer/PHPMailerAutoload.php';
                    
                    $mail = new PHPMailer;
                    $mail ->SMTPOptions = array(
                      'ssl' => array (
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                      )
                      );
                    $mail -> addAddress($email);
                    $mail -> setFrom("tumbascoffee@gmail.com", "ADMIN PT. GARUDA SAKTI WASPADA"); // nanti disesuaikan dengan email pengirim
                    $mail -> Subject = "Reset Password (no-reply)";
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'tumbascoffee@gmail.com';                 // SMTP username
                    $mail->Password = 'sugutamu261902';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    $mail->isHTML(true);
                    $mail -> Body = "
                      
                      Hi,<br/><br/>

                      Kami mendapat permintaan untuk mereset kata sandi Anda <br/>

                      <a href='http://localhost/gsw/admin/resetpassword.php?email=$email&token=$token
                      ' class=btn btn-primary> http://localhost/gsw/admin/resetpassword.php?email=$email&token=$token </a> <br/>

                      Jika Anda mengabaikan pesan ini, kata sandi Anda tidak akan diubah. Pesan ini akan otomatis kadaluwarsa dalam waktu 5 menit kedepan.<br/><br/><br/>
                      Terimakasih,<br/>
                      Admin PT. Garuda Sakti Waspada
                    ";
                    
                    if($mail->send())
                      {
                        echo "<p class='text-info text-center'>Terimakasih! Silahkan periksa email Anda untuk mengatur ulang kata sandi Anda</p>";
                      }else{
                        echo "<p class='text-danger text-center'>Email tidak tersedia</p>";
                      }
                  
                    }else{
                    echo "<p class='text-danger text-center'>Email tidak tersedia</p>";
                  }
                }
              ?>
              <!-- End PHP -->
          </form>

          <!-- <p class="divider-text">
            <span class="bg-light">Atau</span>
          </p>
          <a class="font-weight-bold" href="register.php">Buat Akun</a> -->

          </div>
          <!-- end body -->

          <!-- card footer -->
          <div class="card-footer text-center" >
            <a class="font-weight-bold" href="login.php">Kembali ke login</a>
          </div>
          <!-- end footer -->
      </div>
      <!-- end card -->
    </div><br/>
    <!-- end container -->
    <p class="text-center mb-3 text-muted">&copy; PT.Garuda Sakti Waspada - 2019</p>
                    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 
    </body>
</html>