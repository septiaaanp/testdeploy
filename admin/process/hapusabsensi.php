<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_absensi where id_absensi= '$_GET[id]'");
$tampil = $ambil->fetch_assoc();
$id_personil = $tampil['id_personil'];

$koneksi->query("DELETE FROM tbl_absensi where id_absensi = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=lihatAbsensi&id=$id_personil'; </script>";
?>
