
<?php
//koneksi database
$username = $_SESSION['username'];
// $koneksi = new mysqli ("localhost","root","","gsw");
include_once ('../admin/koneksi.php');

// enkripsi password
@$password_lama = mysqli_real_escape_string($koneksi, trim($_POST['password_lama']));
@$password_baru = mysqli_real_escape_string($koneksi, trim($_POST['password_baru']));
@$konfirmasi_password = mysqli_real_escape_string($koneksi, trim($_POST['konfirmasi_password']));

  $ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$username'");
  $pecah = $ambil->fetch_assoc();
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <form action="" method="post" enctype="multipart/form-data">
          <div class="box box-primary">
            <div class="box-body box-profile" id="profile-preview">
              <img class="profile-user-img img-responsive img-circle" src="../admin/media/<?php if($pecah['foto_profile']== null){ echo 'profile.png'; } else { echo $pecah['foto_profile']; } ?>" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $pecah ['nama'];?></h3>

              <p class="text-muted text-center">Admin</p>
              <div class="text-center">
                <div class ="btn btn-primary btn-file btn-md">
                  <i class ="glyphicon glyphicon-floppy-open" aria-hidden="true"></i>
                  <input type="file" id="preview-img" name="foto" onchange="readURL(this);" value=""/>
                </div>
                <button type="buton" name="hapusfoto" class="btn btn-danger btn-md btn-remove">
                  <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
                <div class="caption">
                  <small class="text-muted">Types : .jpg, .jpeg, .png</small><br>
                  <small class="text-muted">Max file size : 1MB</small>
                </div>
              </div>
              <br>
              <button type="file" name="submit_foto" class="btn btn-primary btn-block">Upload Foto</button>      
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          </form>
          <!-- /.form -->

          <?php 
          
          if (isset($_POST['hapusfoto']))
          {

          $ambil = $koneksi->query ("SELECT * FROM admin where username = '$username'");
          $pecah = $ambil ->fetch_assoc();
          $foto_profile = $pecah ['foto_profile'];
          if (file_exists("../admin/media/$foto_profile"))
          {
              unlink (("../admin/media/$foto_profile"));
          }

          $koneksi->query("UPDATE `admin` SET `foto_profile`='' where username = '$username'");

          echo "<script>alert('foto telah dihapus');</script>";
          echo "<script>location='index.php?halaman=profileAdmin'; </script>";
          }
          ?>

          <!-- /.Start PHP submit foto -->
          <?php

          if (isset($_POST['submit_foto']))
          {
            // Cek apakah inputan gambar kosong atau tidak
            if(!empty($_FILES["foto"]["tmp_name"])){
              $username = $_SESSION['username'];
              $uploads_dir = realpath(dirname(__FILE__)."/../admin/media");
              $namafoto = $_FILES['foto']['name'];
              $lokasifoto = $_FILES['foto']['tmp_name'];
              $path = realpath(dirname(__FILE__)."/../admin/media") .'/';
              //jk foto dirubah


              move_uploaded_file ($lokasifoto, "../admin/media/$namafoto");

              $koneksi->query("UPDATE admin SET foto_profile = '$namafoto'
              WHERE username = '$username'");

              echo "<script type='text/javascript'>alert('Foto telah diupload');</script>";
              echo "<script>location='index.php?halaman=profileAdmin';</script>";  
            }
            else{
              echo "<script type='text/javascript'>alert('Silahkan pilih foto dahulu');</script>";
            }        
          }
          ?>
          <!-- /.end php -->
          
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#editprofile" data-toggle="tab">Edit Profile</a></li>
              <li><a href="#ubahpassword" data-toggle="tab">Ubah Password</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="editprofile">
                <!-- Post -->
                <form class="form-horizontal" id="profileubah" autocomplete="off" method="POST">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama" class="form-control" id="inputName" value = "<?php echo $pecah ['nama'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" name="username" class="form-control" id="inputUserName" value = "<?php echo $pecah ['username'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" name="email" class="form-control" id="inputEmail" value = "<?php echo $pecah ['email'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Nomor Hp</label>
                    <div class="col-sm-10">
                      <input type="text" name="telp" class="form-control" id="inputHP" value = "<?php echo $pecah ['telp'];?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="sel1" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                    <select class="form-control" name="j_kelamin" id="sel1" required>
                      <option value="" >-- Pilih --</option>
                      <option <?php if($pecah['jenis_kelamin']=="Pria"){ echo "selected"; }?>>Pria</option>
                      <option <?php if($pecah['jenis_kelamin']=="Wanita"){ echo "selected"; }?>>Wanita</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" name="submit" id="mybtn" class="btn btn-danger" disabled>Simpan</button>
                    </div>
                  </div>
                </form>

                <!-- Start PHP UPDATE DATA-->
                <?php
                  if (isset($_POST['submit']))
                  {   
                      $username = $_SESSION['username'];
                      
                      $koneksi->query("UPDATE admin SET nama = '$_POST[nama]', username = '$_POST[username]' , email = '$_POST[email]', telp = '$_POST[telp]' , jenis_kelamin = '$_POST[j_kelamin]'
                      WHERE username = '$username'");
    
                      echo "<script type='text/javascript'>alert('Data telah diupdate');</script>";
                      echo "<script>location='index.php?halaman=profileAdmin';</script>";
                      
                    }
                ?>
                <!-- /.end php -->

              </div>
              <!-- /.tab-pane -->
            
              <div class="tab-pane" id="ubahpassword">
                <form class="form-horizontal" id="passwordubah" action="" method="POST" autocomplete="of">
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password Lama</label>
                    <div class="col-sm-3">
                       <input name ="password_lama" class="form-control" placeholder="Password Lama" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Password Baru</label>
                    <div class="col-sm-3">
                        <input name ="password_baru" class="form-control" placeholder="Password Baru" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword" class="col-sm-2 control-label">Konfirmasi Password</label>
                    <div class="col-sm-3">
                        <input name ="konfirmasi_password" class="form-control" placeholder="Konfirmasi Password" type="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button name= "submit2" id="mybtn2" type="submit" class="btn btn-danger" disabled>Submit</button>
                    </div>
                  </div>

                  <!-- /.Start PHP Ganti Password -->
                  <?php
                    
                    $koneksi = new mysqli ("localhost","root","","gsw");
                  
                    if(isset($_POST['submit2'])){
                      //membuat variabel untuk menyimpan data inputan yang di isikan di form
                      $password_lama			= $_POST['password_lama'];
                      $password_baru			= $_POST['password_baru'];
                      $konfirmasi_password	= $_POST['konfirmasi_password'];
					            $id_user 		= $_SESSION['username'];//ini dari session saat login
                      
                      //cek dahulu ke database dengan query SELECT
                      //kondisi adalah WHERE (dimana) kolom password adalah $password_lama di encrypt m5
                      //encrypt -> md5($password_lama)
                      $password_lama	;//= md5($password_lama);
                      $cek 			= $koneksi->query("SELECT password FROM admin WHERE username ='$id_user' and password='$password_lama'");
                      
                      if($cek->num_rows>0){
                        //kondisi ini jika password lama yang dimasukkan sama dengan yang ada di database
                        //membuat kondisi minimal password adalah 5 karakter
                        if(strlen($password_baru) >= 6){
                          //jika password baru sudah 5 atau lebih, maka lanjut ke bawah
                          //membuat kondisi jika password baru harus sama dengan konfirmasi password
                          if($password_baru == $konfirmasi_password){
                            //jika semua kondisi sudah benar, maka melakukan update kedatabase
                            //query UPDATE SET password = encrypt md5 password_baru
                            //kondisi WHERE id user = session id pada saat login, maka yang di ubah hanya user dengan id tersebut
                            $password_baru 	;//= md5($password_baru);
                        
                            
                            $update 		= $koneksi->query("UPDATE admin SET password='$password_baru' WHERE username='$id_user'");
                            if($update){
                              //kondisi jika proses query UPDATE berhasil
                              echo "<script type='text/javascript'>alert('Password berhasil diubah');</script>";
                            }else{
                              //kondisi jika proses query gagal
                            echo "<script type='text/javascript'>alert('Gagal merubah Password');</script>";
                            }					
                          }else{
                            //kondisi jika password baru beda dengan konfirmasi password
                           echo "<script type='text/javascript'>alert('Konfirmasi password tidak cocok');</script>";
                          }
                        }else{
                          //kondisi jika password baru yang dimasukkan kurang dari 5 karakter
                          echo "<script type='text/javascript'>alert('Minimal password baru adalah 6 karakter');</script>";
                        }
                      }else{
                        //kondisi jika password lama tidak cocok dengan data yang ada di database
                        echo "<script type='text/javascript'>alert('Password lama tidak cocok');</script>";
                      }
                    }
                ?>
                <!-- /.end PHP -->
                
                <!-- /.form -->
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
	//Upload Profile Image
    function readURL(input) {
        var fileInput = document.getElementById('preview-img');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('File type not allowed!!');
            fileInput.value = '';
            return false;
        } else {
            if (input.files && input.files[0]) {
				var filex = input.files[0].size;
				var sizex = (filex/1024).toFixed(2);
				//1000000 MB = 1 MB
				//2000000 MB = 2 MB
				if(filex >= 2000000 ) {
					alert('File size too large!!');
					fileInput.value = '';
					return false;
				}
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-preview > img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    }
</script>


<!-- SCRIPT EXTERNAL DISBALED BUTTON-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- DISABLED BUTTON PASSWORD -->
<script >
  $(document).ready(function() {
  $('#passwordubah').on('input change', function() {
    $('#mybtn2').attr('disabled', false);
  });
})
</script>
<!-- DISABLED BUTTON PROFILE -->
<script >
  $(document).ready(function() {
  $('#profileubah').on('input change', function() {
    $('#mybtn').attr('disabled', false);
  });
})
</script>



