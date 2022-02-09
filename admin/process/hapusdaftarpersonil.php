<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where id_personil = '$_GET[id]'");
$pecah = $ambil ->fetch_assoc();
$upload = $pecah ['foto'];
if (file_exists("../admin/process/FotoPersonil/$upload"))
{
    @unlink (("../admin/process/FotoPersonil/$upload"));
}
$ambil = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where id_personil = '$_GET[id]'");
    $pecah2 = $ambil ->fetch_assoc();
    $upload2 = $pecah2 ['sertifikat'];
    if (file_exists("../admin/process/SertifPersonil/$upload2"))
    {
        @unlink (("../admin/process/SertifPersonil/$upload2"));
    }

$koneksi->query("DELETE FROM tbl_daftarpersonil where id_personil  = '$_GET[id]' ");
$koneksi->query("DELETE FROM tbl_absensi where id_personil  = '$_GET[id]' ");
$koneksi->query("DELETE FROM tbl_jagapersonil where id_personil  = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=daftarPersonil'; </script>";
?>

