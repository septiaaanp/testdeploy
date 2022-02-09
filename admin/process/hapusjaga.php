<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_jagapersonil where id_jaga= '$_GET[id]'");
$tampil = $ambil->fetch_assoc();
$id_personil = $tampil['id_personil'];

$koneksi->query("DELETE FROM tbl_jagapersonil where id_jaga = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=lihatJaga&id=$id_personil'; </script>";
?>
