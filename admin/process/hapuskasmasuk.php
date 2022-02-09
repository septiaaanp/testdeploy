<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_kasmasuk where id_kasmasuk = '$_GET[id]'");

$koneksi->query("DELETE FROM tbl_kasmasuk where id_kasmasuk = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=kasMasuk'; </script>";
?>
