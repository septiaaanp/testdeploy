<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_biayapendukung where id_biaya = '$_GET[id]'");
$hasil = $ambil->fetch_array();
$id_kontrak = $hasil['id_kontrak'];

$koneksi->query("DELETE FROM tbl_biayapendukung where id_biaya = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=ubahnilaipendukung&id=$id_kontrak'; </script>";
?>
