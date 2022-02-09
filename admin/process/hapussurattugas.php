<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_surattugas where id_surattugas = '$_GET[id]'");
$pecah = $ambil ->fetch_assoc();
$upload = $pecah ['upload'];
if (file_exists("../admin/process/SuratTugas/$upload"))
{
    unlink (("../admin/process/SuratTugas/$upload"));
}
$koneksi->query("DELETE FROM tbl_surattugas where id_surattugas = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=suratTugas'; </script>";
?>
