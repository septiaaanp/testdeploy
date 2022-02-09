<?php
include_once ('../koneksi.php');

$bulan = $_POST['bulan2'];
$format_bulan = date('F', strtotime($_POST['bulan2']));
$tahun = $_POST['tahun'];
$tahun = $_POST['tahun'];
$id_personil = $_POST['cetak'];


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

$tanggal = date('d-F-Y');
// $timestamp = date('d-F-Y');
$currentDate2 = indonesian_date($tanggal,"Y");
$currentDate3 = indonesian_date($tanggal,"m");
$currentDate4 = indonesian_date($tanggal,"l , d F Y");
$currentDate5 = indonesian_date($tanggal,"d F Y");
$currentDate6 = indonesian_date($tanggal,"F");

function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " Belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." Puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " Seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " Ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " Seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . " Ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " Juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " Milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " Trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}

function terbilang($nilai) {
	if($nilai<0) {
		$hasil = "minus ". trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}     		
	return $hasil;
}


$ambil = $koneksi->query("SELECT * FROM tbl_daftarpersonil WHERE id_personil = '$id_personil'");
$tampil = $ambil->fetch_assoc();
$id_presentasi = $tampil['id_presentasi'];
$id_nilai = $tampil['id_nilai'];

$ambil10 = $koneksi->query("SELECT * FROM tbl_jagapersonil WHERE id_personil = '$id_personil'");
$tampil10 = $ambil10->fetch_assoc();
$max_jaga = $tampil10['jaga'];


$ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient WHERE id_presentasi = '$id_presentasi'");
$tampil2 = $ambil2->fetch_assoc();

$ambil3 = $koneksi->query("SELECT * FROM tbl_biayagaji WHERE id_nilai = '$id_nilai'");
$tampil3 = $ambil3->fetch_assoc();
$gapok = $tampil3['gaji_pokok'];
$bpjs_kerja = round($tampil3['bpjs_kerja']);
$bpjs = round($tampil3['bpjs']);
$thr = round($tampil3['tunjangan']);
// $tunj_pkd = $tampil3['tunj_pkd'];

$gaji = round($gapok + $bpjs_kerja + $bpjs + $thr);

//QUERY HADIR 
$ambil4 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Hadir' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_hadir = $ambil4->num_rows;
$gaji_perhari = round($gaji / $max_jaga);
//QUERY BONUS BACKUP
$ambil11 = $koneksi->query("SELECT SUM(bonus) AS total FROM tbl_absensi WHERE id_personil = '$id_personil' and backup = 'backup' and kehadiran = 'Hadir' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_backup = $ambil11->num_rows;
$tampil11 = $ambil11->fetch_assoc();
$bonus = $tampil11['total'];

$ambil12 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and backup = 'backup' and kehadiran = 'Hadir' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_backup = $ambil12->num_rows;

if($jml_hadir > $max_jaga){
  $bonus;
}else{
  $bonus= '0';
}

if($jml_hadir > $max_jaga){
  $jml_backup;
}else{
  $jml_backup = '0';
}

// QUERY CUTI
$ambil6 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Cuti' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_cuti = $ambil6->num_rows;

if($jml_hadir < $max_jaga){
  $potong_cuti = $gaji_perhari * $jml_cuti;
}else{
  $potong_cuti = '0';
}

if($jml_hadir < $max_jaga){
  $jml_cuti;
}else{
  $jml_cuti = '0';
}

// QUERY ALPHA
$ambil7 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Alpha' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_alpha = $ambil7->num_rows;

if($jml_hadir < $max_jaga){
  $potong_alpha = $gaji_perhari * $jml_alpha;
}else{
  $potong_alpha = '0';
}

if($jml_hadir < $max_jaga){
  $jml_alpha;
}else{
  $jml_alpha = '0';
}


// QUERY IZIN
$ambil8 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Izin' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_izin = $ambil8->num_rows;

if($jml_hadir < $max_jaga){
  $potong_izin = $gaji_perhari * $jml_izin;
}else{
  $potong_izin = '0';
}

if($jml_hadir < $max_jaga){
  $jml_izin;
}else{
  $jml_izin = '0';
}

// QUERY SAKIT
$ambil9 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Sakit' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$jml_sakit = $ambil9->num_rows;

if($jml_hadir < $max_jaga){
  $potong_sakit = $gaji_perhari * $jml_sakit;
}else{
  $potong_sakit = '0';
}

if($jml_hadir < $max_jaga){
  $jml_sakit;
}else{
  $jml_sakit = '0';
}

$ambil5 = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = '$id_personil' and kehadiran = 'Hadir' and substr(tgl_absensi,1,4)= '$tahun' 
and substr(tgl_absensi,6,2) = '$bulan'");
$tampil5 = $ambil5->fetch_assoc();
$bulan_gaji = $tampil5['tgl_absensi'];

if($jml_hadir < 1){
  echo "<script type='text/javascript'>alert('Data gaji tidak ditemukan');</script>";
  echo "Data gaji tidak ditemukan";
}else{

include ('fungsi/pdf/textbox.php');
$pdf=new PDF_TextBox();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'A5', 'C');

//TABEL FORM
$pdf->Ln();
$pdf->Image('../media/logo.png',33,12,-800);
$pdf->SetFont('Times', 'B', '10');
$pdf->Ln(4);
$pdf->Cell(0, 6, 'PT. GARUDA SAKTI WASPADA', 0, 1, 'C');
$pdf->Ln(-2);
$pdf->SetFont('Times', 'BI', '10');
$pdf->Cell(0, 6, 'SECURITY SERVICE', 0, 1, 'C');
$pdf->setX(11);
$pdf->Cell(125, 4, '', 'T', 1, 'R');
$pdf->SetFont('Times', 'B', '10');
$pdf->Cell(0, 6, 'SLIP GAJI', 0, 1, 'C');
$pdf->ln(-2);
$pdf->Cell(0, 6, 'Bulan : '.indonesian_date($bulan_gaji, 'F').''. $tahun, 0, 1, 'C');
$pdf->ln();


$pdf->Ln(10);

$pdf->SetFont('Courier', '', 10);
$pdf->Cell(0, 4, 'NAMA', '0', 0, 'L');
$pdf->setX(30);
$pdf->Cell(0, 4, ': '.$tampil['nama'], '', 1, 'L');
$pdf->Cell(0, 4, 'JABATAN', '0', 0, 'L');
$pdf->setX(30);
$pdf->Cell(0, 4, ': '.$tampil['jabatan'], '', 1, 'L');
// $pdf->Cell(0, 4, $jml_hadir, '0', 0, 'L');
$pdf->Ln(10);


//PERHITUNGAN GAJI
$pdf->setX(20);
$pdf->SetFont('Courier', '', 10);
$pdf->Cell(0, 4, 'Gaji Pokok', '', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($gaji, 0 ,'.','.').'', '', 1, 'R');

$pdf->setX(20);
$pdf->Cell(0, 4, 'Tunjangan Jabatan', '', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($tampil3['tunj_jabatan'], 0 ,'.','.').'', '', 1, 'R');

$pdf->setX(20);
$pdf->Cell(0, 4, 'Backup ('.$jml_backup.' x)', '', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($bonus, 0 ,'.','.').'', '', 1, 'R');

$pdf->Ln();
$pdf->setX(20);
$pdf->Cell(0, 4, 'Potongan Kehadiran', '0', 1, 'L');

$pdf->setX(20);
$pdf->Cell(0, 4, '- Cuti ('.$jml_cuti.' Hari)', '0', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($potong_cuti, 0 ,'.','.').'', '', 1, 'R');
$pdf->setX(20);
$pdf->Cell(0, 4, '- Sakit ('.$jml_sakit.' Hari)', '0', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($potong_sakit, 0 ,'.','.').'', '', 1, 'R');
$pdf->setX(20);
$pdf->Cell(0, 4, '- Ijin ('.$jml_izin.' Hari)', '0', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($potong_izin, 0 ,'.','.').'', '', 1, 'R');
$pdf->setX(20);
$pdf->Cell(0, 4, '- T.Keterangan ('.$jml_alpha.' Hari)', '0', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$pdf->Cell(30, 4, ''.number_format($potong_alpha, 0 ,'.','.').'', '', 1, 'R');
$pdf->setX(74);
$pdf->Cell(30, 4, '', 'T', 1, 'R');
$pdf->setX(40);

$pdf->SetFont('Courier', 'B', '10');
$pdf->Cell(0, 4, 'Jumlah', '0', 0, 'L');
$pdf->setX(70);
$pdf->Cell(0, 4, ': Rp. ', '', 0, 'L');
$pdf->setX(74);
$dapat_gaji = ($gaji + $tampil3['tunj_jabatan'] + $bonus) - $potong_cuti - $potong_sakit - $potong_izin - $potong_alpha;
$pdf->Cell(30, 4, ''.number_format($dapat_gaji, 0 ,'.','.').'', '', 1, 'R');
$pdf->Ln();
$pdf->Ln();
//footer selalu sama
$pdf->SetFont('Courier', 'B', '10');
$pdf->Cell(0, 6, 'Adm. Keuangan', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Courier', 'BU', '10');
$pdf->Cell(0, 6, 'Gunawan', 0, 1, 'C');//NAMA KEUANGAN
$pdf->SetFont('Courier', 'B', '10');
$pdf->Cell(0, 3, 'NIK. 15.003.0571.1014', 0, 1, 'C');//NAMA KEUANGAN




$title = 'Slip Gaji '.$tampil['nama'].' periode '.$currentDate6.'';
$pdf->SetTitle($title);

$pdf->Output();
}
?>