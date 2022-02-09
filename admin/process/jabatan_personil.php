<?php

$koneksi = new mysqli ("localhost","root","","gsw");

$ambil= $koneksi->query ("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$_POST[nama_perusahaan]'");
$hasil = $ambil->fetch_array();
$id_presentasi = $hasil['id_presentasi'];

$tampil=$koneksi->query ("SELECT * FROM tbl_biayagaji WHERE id_presentasi ='$id_presentasi'");
$jml=$tampil->num_rows;
if($jml > 0){
    echo"<option selected>-- PILIH JABATAN --</option>";
    while($r=$tampil->fetch_array()){
        echo '<option  value="' . $r['jabatan'] . '">' . $r['jabatan'] . '</option>'; 
    }
}else{
    echo "<option value='' class='text-muted' selected>-- PILIH JABATAN --</option>";
}
?>