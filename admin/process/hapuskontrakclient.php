<?php 
$ambil1 = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where id_kontrak = '$_GET[id]'");
$pecah = $ambil1 ->fetch_assoc();
$upload = $pecah ['foto'];
    if (file_exists("../admin/process/FotoPersonil/$upload"))
    {
        @unlink (("../admin/process/FotoPersonil/$upload"));
    }
$ambil2 = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where id_kontrak = '$_GET[id]'");
    $pecah2 = $ambil2 ->fetch_assoc();
    $upload2 = $pecah2 ['sertifikat'];
    if (file_exists("../admin/process/SertifPersonil/$upload2"))
    {
        @unlink (("../admin/process/SertifPersonil/$upload2"));
    }

$ambil3 = $koneksi->query ("SELECT * FROM tbl_biayagaji where id_kontrak = '$_GET[id]'");
$ambil4 = $koneksi->query ("SELECT * FROM tbl_biayapendukung where id_kontrak = '$_GET[id]'");
$ambil5 = $koneksi->query ("SELECT * FROM tbl_kontrakclient where id_kontrak = '$_GET[id]'");

$koneksi->query("DELETE FROM tbl_daftarpersonil where id_kontrak = '$_GET[id]' ");
$koneksi->query("DELETE FROM tbl_biayagaji where id_kontrak = '$_GET[id]' ");
$koneksi->query("DELETE FROM tbl_biayapendukung where id_kontrak = '$_GET[id]' ");
$koneksi->query("DELETE FROM tbl_kontrakclient where id_kontrak = '$_GET[id]' ");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=kontrakClient'; </script>";
?>
