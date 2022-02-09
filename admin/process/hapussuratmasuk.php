<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_suratmasuk where id_suratmasuk = '$_GET[id]'");
$pecah = $ambil ->fetch_assoc();
$upload = $pecah ['upload'];
if (file_exists("../admin/process/SuratMasuk/$upload"))
{
    unlink (("../admin/process/SuratMasuk/$upload"));
}
$koneksi->query("DELETE FROM tbl_suratmasuk where id_suratmasuk = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=suratMasuk'; </script>";
?>
