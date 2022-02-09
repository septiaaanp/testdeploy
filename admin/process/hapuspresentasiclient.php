<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_presentasiclient where id_presentasi = '$_GET[id]'");

$koneksi->query("DELETE FROM tbl_presentasiclient where id_presentasi = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=presentasiClient'; </script>";
?>
