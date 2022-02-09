<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_suratkeluar where id_suratkeluar = '$_GET[id]'");
$pecah = $ambil ->fetch_assoc();
$upload = $pecah ['upload'];
if (file_exists("../admin/process/SuratKeluar/$upload"))
{
    unlink (("../admin/process/SuratKeluar/$upload"));
}
$koneksi->query("DELETE FROM tbl_suratkeluar where id_suratkeluar = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=suratKeluar'; </script>";
?>
