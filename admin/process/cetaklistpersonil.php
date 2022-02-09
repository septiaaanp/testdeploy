<?php
include_once ('../koneksi.php');
// $koneksi = new mysqli ("localhost","root","","gsw");

$ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient WHERE id_kontrak = '$_GET[id]'");
$tampil = $ambil->fetch_assoc();
$id_presentasi = $tampil['id_presentasi'];

$ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient WHERE id_presentasi = '$id_presentasi'");
$tampil2 = $ambil2->fetch_assoc();

include ('fungsi/pdf/fpdf.php');
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L', 'A4');
$pdf->Ln();
//TABEL FORM
$linespace1 = 3;
$pdf->Ln(10);
$pdf->SetFont('Times', 'BU', '12');
$pdf->Image('../media/logo.png',255,15,-500);
$pdf->Cell(0, 6, 'PT. GARUDA SAKTI WASPADA', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell(0, 6, 'Daftar Personil - '.$tampil2['nama_perusahaan'].'', 0, 1, 'C');
// $pdf->Ln(15);
$pdf->SetFont('Times','B', '12');
$pdf->SetLeftMargin(20);
$pdf->Cell(10,7,'',0,1, 'C');

$pdf->Cell(10,6,'No',1,0, 'C');
$pdf->Cell(50,6,'Penempatan',1,0, 'C');
$pdf->Cell(60,6,'Jabatan',1,0, 'C');
$pdf->Cell(50,6,'Nama Personil',1,0, 'C');
$pdf->Cell(60,6,'Alamat',1,0, 'C');
$pdf->Cell(25,6,'Telp',1,1, 'C');

$pdf->SetFont('Times','',12);
$nomor = 1;
$ambil3 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_presentasi = '$id_presentasi'");
while ($tampil3 = $ambil3->fetch_assoc()){
    $pdf->Cell(10,6,$nomor,1,0, 'C');
    $pdf->Cell(50,6,$tampil2['nama_perusahaan'],1,0);
    $pdf->Cell(60,6,$tampil3['jabatan'],1,0);
    $pdf->Cell(50,6,$tampil3['nama'],1,0);
    $pdf->Cell(60,6,$tampil3['alamat'],1,0);
    $pdf->Cell(25,6,$tampil3['telp'],1,1);
    $nomor++;
}   

$title = 'Daftar Personil - '.$tampil2['nama_perusahaan'].'';
$pdf->SetTitle($title);

$pdf->Output();

?>