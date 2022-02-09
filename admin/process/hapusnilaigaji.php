<?php 

$ambil = $koneksi->query ("SELECT * FROM tbl_biayagaji where id_nilai = '$_GET[id]'");
$hasil = $ambil->fetch_array();
$id_kontrak = $hasil['id_kontrak'];

$koneksi->query("DELETE FROM tbl_biayagaji where id_nilai = '$_GET[id]' ");

$ambil3= $koneksi->query ("SELECT SUM(jumlah_personil) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
$hasil3 = $ambil3->fetch_array();
$personil = $hasil3['total'];

$koneksi->query ("UPDATE tbl_kontrakclient SET minta_personil = '$personil' where id_kontrak = '$id_kontrak'");

echo "<script>alert('Data terhapus');</script>";
echo "<script>location='?halaman=ubahnilaigaji&id=$id_kontrak'; </script>";
?>
