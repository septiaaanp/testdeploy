<?php
//koneksi database
session_start();
require 'koneksi.php';
// $koneksi = new mysqli ("localhost","root","","gsw");
$username = $_SESSION['username'];

$ambil = $koneksi->query("SELECT * FROM admin WHERE username = '$username'");
$pecah = $ambil->fetch_assoc();

if (!isset($_SESSION['admin']))
{
  echo "<script>alert('Anda Harus Login');</script>";  
  echo "<script>location='login.php'; </script>";
  header('location:login.php');
  exit();
}
?>

  <?php
    
    $koneksi->query("UPDATE tbl_kontrakclient SET status = 'Tidak Terkontrak' WHERE akhir_kontrak < NOW();");
    $ambil2 = $koneksi->query("SELECT * FROM tbl_kontrakclient WHERE status = 'Tidak Terkontrak'");
    $pecah2 = $ambil2->fetch_assoc();
    $id_kontrak =  $pecah2['id_kontrak'];

    $ambil3 = $koneksi->query("SELECT * FROM tbl_daftarpersonil WHERE id_kontrak = '$id_kontrak'");
    $pecah3 = $ambil3->fetch_assoc();
    $id_personil =  $pecah3['id_personil'];
    
    $koneksi->query("UPDATE tbl_daftarpersonil SET status = 'Tidak Terkontrak' where id_kontrak in (SELECT id_kontrak from tbl_kontrakclient where status = 'Tidak Terkontrak')");

    $koneksi->query("INSERT INTO tbl_kontrakhabis SELECT * FROM tbl_kontrakclient where status = 'Tidak Terkontrak'");
    $koneksi->query("INSERT INTO tbl_personiloff SELECT * FROM tbl_daftarpersonil where status = 'Tidak Terkontrak'");

    $koneksi->query("DELETE FROM tbl_daftarpersonil where status = 'Tidak Terkontrak'");
    // $koneksi->query("DELETE FROM tbl_absensi where id_personil = '$id_personil' and status = 'Tidak Terkontrak'");
    // $koneksi->query("DELETE FROM tbl_jagapersonil where id_personil = '$id_personil' and status = 'Tidak Terkontrak'");
    // $koneksi->query("DELETE FROM tbl_biayapendukung where id_kontrak = '$id_kontrak'"); 
    // $koneksi->query("DELETE FROM tbl_biayagaji where id_kontrak = '$id_kontrak'"); 
    $koneksi->query("DELETE FROM tbl_kontrakclient where status = 'Tidak Terkontrak'");         
  
  ?>

<?php
	//Elemen halaman website==================
    include_once 'view/header.php';
    include_once 'view/topmenu.php';
    include_once 'view/main.php';
    include_once 'view/leftside.php';
    include_once 'view/footer.php'; 
    include_once 'view/script.php';		
?>