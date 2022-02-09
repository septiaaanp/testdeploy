<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_kaskeluar where id_kaskeluar = '$_GET[id]'");

$koneksi->query("DELETE FROM tbl_kaskeluar where id_kaskeluar = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=kasKeluar'; </script>";
?>
