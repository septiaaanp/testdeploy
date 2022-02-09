<?php
include_once ('../koneksi.php');
$ambil7 = $koneksi->query("SELECT DISTINCT kategori FROM tbl_biayapendukung where id_kontrak = '121'");
while ($tampil7 = $ambil7->fetch_assoc()){
    echo $tampil7['kategori'];
}

?>