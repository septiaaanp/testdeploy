<?php
include_once ('../koneksi.php');

$bulan = $_POST['bulan2'];
$format_bulan = date('F', strtotime($_POST['bulan2']));
$tahun = $_POST['tahun'];
// $nip = $_POST['nip'];

function indonesian_date ($timestamp = '', $date_format = 'd F Y', $suffix = '') {
    if($timestamp == NULL)
      return '-';
 
    if($timestamp == '1970-01-01' || $timestamp == '0000-00-00' || $timestamp == '-25200')
      return '-';
 
 
    if (trim ($timestamp) == '')
    {
            $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','September',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
} 

$ambil = $koneksi->query("SELECT * FROM tbl_absensi where substr(tgl_absensi,1,4)= '$tahun' 
                            and substr(tgl_absensi,6,2) = '$bulan' and id_personil = '$_GET[id]' order by tgl_absensi asc");

$ambil5 = $koneksi->query("SELECT * FROM tbl_absensi where substr(tgl_absensi,1,4)= '$tahun' 
                            and substr(tgl_absensi,6,2) = '$bulan' and id_personil = '$_GET[id]' order by tgl_absensi asc");
$tampil5 = $ambil5->fetch_assoc();
$bulan_absen = $tampil5['tgl_absensi'];

$ambil2 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_personil = '$_GET[id]'");
$tampil2 = $ambil2->fetch_assoc();
$id_presentasi = $tampil2['id_presentasi'];

$ambil3 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
$tampil3 = $ambil3->fetch_assoc();
$perusahaan = $tampil3['nama_perusahaan'];

$ambil4 = $koneksi->query("SELECT * FROM tbl_absensi where substr(tgl_absensi,1,4)= '$tahun' 
                            and substr(tgl_absensi,6,2) = '$bulan' and id_personil = '$_GET[id]' order by tgl_absensi asc");
$jumlah_absensi = $ambil4->num_rows;

if($jumlah_absensi < 1){
    echo "<script type='text/javascript'>alert('Data absensi tidak ditemukan');</script>";
    echo "Data absensi tidak ditemukan";
}else{
    include ('fungsi/pdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'A4');
    
    
    // //TABEL FORM
    $pdf->Ln(5);
    $pdf->SetY(4);
    $pdf->SetFont('Times', 'BU', '12');
    $pdf->Cell(0, 6, ''.$perusahaan.'', 0, 1, 'C');
    $pdf->Ln(-2);
    
    $pdf->SetFont('Times', '', '12');
    $pdf->Cell(0, 7, 'Rekapitulasi Absensi', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetLeftMargin(14);
    $pdf->Cell(0, 6, 'Bulan :  '.indonesian_date($bulan_absen, 'F').''.$tahun, 0, 1, 'L');
    $pdf->Cell(0, 6, 'Nama Personil :  '.$tampil2['nama'].'', 0, 1, 'L');
    // $pdf->ln();
    
    $pdf->SetFont('Times','B', '12');
    $pdf->SetLeftMargin(15);
    
    $pdf->Cell(8,6,'NO',1,0, 'C');
    $pdf->Cell(40,6,'TANGGAL',1,0, 'C');
    $pdf->Cell(45,6,'KEHADIRAN',1,0, 'C');
    $pdf->Cell(40,6,'JAM MASUK',1,0, 'C');
    $pdf->Cell(40,6,'JAM KELUAR',1,1, 'C');
    
    $nomor = 1;
    $pdf->SetFont('Times','',12);
    while($tampil = $ambil->fetch_assoc()){
        if($tampil['kehadiran'] == 'Hadir'){
            $kehadiran = 'Hadir';
            $jam_masuk = $tampil['waktu_masuk'];
            $jam_keluar = $tampil['waktu_keluar'];
        }else{
            $kehadiran = $tampil['kehadiran'];
            $jam_masuk = '-';
            $jam_keluar = '-';
        }
        //isi tabel
        $pdf->Cell(8,6,$nomor,1,0, 'C');
        $pdf->Cell(40,6,indonesian_date($tampil['tgl_absensi'], 'd F Y'),1,0, 'C');
        $pdf->Cell(45,6,$kehadiran,1,0, 'C');
        $pdf->Cell(40,6,$jam_masuk,1,0, 'C');
        $pdf->Cell(40,6,$jam_keluar,1,1, 'C');
    
        $nomor++;
    }
    
    $title = 'Absensi '.$tampil3['nama_perusahaan'].' - '.$tampil2['nama'].'';
    $pdf->SetTitle($title);
    
    $pdf->Output();
}
?>