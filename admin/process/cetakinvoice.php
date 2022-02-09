<?php
include_once ('../koneksi.php');

// $bulan = $_POST['bulan'];
// $format_bulan = date('F', strtotime($_POST['bulan']));
// $tahun = $_POST['tahun'];
$no_invoice = $_POST['invoice'];

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


$ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient WHERE id_kontrak = '$_GET[id]'");
$tampil = $ambil->fetch_assoc();
$id_presentasi = $tampil['id_presentasi'];

$ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient WHERE id_presentasi = '$id_presentasi'");
$tampil2 = $ambil2->fetch_assoc();

$ambil3= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$_GET[id]'");
$hasil3 = $ambil3->fetch_array();
$total_nilai1 = $hasil3['total'];

$ambil4= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$_GET[id]' AND jabatan = 'ANGGOTA'");
$hasil4= $ambil4->fetch_array();
$total_nilai2 = $hasil4['total'];

$ambil5= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$_GET[id]'");
$hasil5= $ambil5->fetch_array();
$total_nilai3 = $hasil5['total'];

$total_biaya = $total_nilai1 + $total_nilai2 + $total_nilai3;

$fee_management = $total_biaya * 0.1;

$total_seluruh = $fee_management + $total_biaya;

$ppn = $total_seluruh * 0.1;

$total_seluruh_fix = $ppn + $total_seluruh;

$array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
$bln = $array_bln[date('n')];

include ('fungsi/pdf/textbox.php');
$pdf=new PDF_TextBox();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'A4');

//TABEL FORM
$pdf->Ln();

$pdf->SetFont('Times','',12);
$pdf->drawTextBox('Kepada :
'.$tampil2['nama_perusahaan'].'
'.$tampil2['alamat_perusahaan'].'', 60, 25, 'L', 'T');

$pdf->SetFont('Times', 'B', '12');
$pdf->Image('../media/logo.png',155,10,-500);

$pdf->Ln(10);
$pdf->Cell(0, 6, 'PT. GARUDA SAKTI WASPADA', 0, 1, 'R');

$pdf->SetFont('Times', 'I', '12');
$pdf->SetRightMargin(23);
$pdf->Cell(0, 6, 'SECURITY SERVICE', 0, 1, 'R');

$pdf->SetFont('Times', '', '10');
$pdf->SetRightMargin(11);
$pdf->Cell(0, 6, 'Jl. Tugu Raya Ruko Kelapa Dua Residence', 0, 1, 'R');
$pdf->SetRightMargin(24);
$pdf->Cell(0, 6, 'Blok K. No 18 Kel. Tugu', 0, 1, 'R');
$pdf->SetRightMargin(25);
$pdf->Cell(0, 6, 'Kec. Cimanggis Depok.', 0, 1, 'R');
$pdf->SetRightMargin(16);
$pdf->Cell(0, 6, 'Telp. 021-22852298, 081385729871,', 0, 1, 'R');
$pdf->SetRightMargin(33);
$pdf->Cell(0, 6, '081218000446', 0, 1, 'R');
$pdf->SetRightMargin(39);
$pdf->Cell(0, 6, 'Email:', 0, 1, 'R');

$pdf->SetFont('Times', '', '12');
$pdf->Cell(10, 6, 'INVOICE', 0, 0, 'L');

$pdf->SetFont('Times', 'U', '10');
$pdf->SetRightMargin(14);
$pdf->Cell(0, 6, 'gsw_garudasaktiwaspada@yahoo.com', 0, 1, 'R');

$pdf->SetFont('Times', '', '12');
$pdf->Cell(75, 6, 'NO: '.$no_invoice.'/INV/GSW/'.$bln.'/'.$currentDate2.'', 1, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Times', '', '12');
$pdf->Cell(0, 6, 'Hari, Tanggal: '.$currentDate4.'', 0, 1, 'L');

$pdf->Ln(2);
$pdf->Cell(115, 6, 'URAIAN / DESKRIPSI', 1, 0, 'C');
$pdf->Cell(75, 6, 'JUMLAH', 1, 1, 'C');

$pdf->drawTextBox('
Pembayaran Gaji Karyawan kontrak sebanyak '.$tampil['minta_personil'].' personil Security '.$tampil2['nama_perusahaan'].' periode 1 s.d '.$currentDate5.'

Management Fee 10%

Total Kontrak

PPN 10%
', 115, 45, 'R', 'T');
$pdf->SetXY(125,108.7);
$pdf->drawTextBox('
'.number_format($total_biaya, 0 ,'.','.').'


'.number_format($fee_management, 0 ,'.','.').'

'.number_format($total_seluruh, 0 ,'.','.').'

'.number_format($ppn, 0 ,'.','.').'
',75, 45, 'R', 'T');
$pdf->Ln(7);
$pdf->Cell(115, 6, 'TAGIHAN', 1, 0, 'R');
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell(75, 6, ''.number_format($tampil['nilai_kontrak'], 0 ,'.','.').'', 1, 1, 'R');

$pdf->Ln(7);
$pdf->SetFont('Times', '', '12');
$pdf->Cell(20, 6, 'Terbilang : ', 0, 0, 'L');
$pdf->SetFont('Times', 'I', '12');
$pdf->Cell(15, 6, ''.terbilang($tampil['nilai_kontrak']).'', 0, 1, 'L');

$pdf->Ln(20);

$pdf->SetX(130);
$pdf->SetFont('Times', '', '12');
$pdf->Cell(0, 5, 'Hormat Kami,', 0, 1, 'C');
$pdf->SetX(130);
$pdf->Cell(0, 5, 'PT. Garuda Sakti Waspada', 0, 0, 'C');

$pdf->Ln(25);

$pdf->SetFont('Times', 'U', '12');
$pdf->SetX(130);
$pdf->Cell(0, 5, 'Suryani', 0, 1, 'C'); //NAMA DIREKTUR

$pdf->ln(0);
$pdf->SetFont('Times', '', '12');
$pdf->SetX(130);
$pdf->Cell(0, 5, 'DIREKTUR', 0, 1, 'C'); //NIP DIREKTUR


$pdf->ln(20);
$pdf->SetFont('Times', '', '10');
$pdf->Cell(20, 6, 'Mohon Pembayaran ditransfer ke Rek: 129.00.1081515-3', 0, 1, 'L');
$pdf->Cell(20, 6, 'Bank Mandiri Cabang Jakarta Cimanggis atas nama PT. Garuda Sakti Waspada', 0, 1, 'L');


$title = 'Invoice '.$tampil2['nama_perusahaan'].' periode '.$currentDate6.'';
$pdf->SetTitle($title);


$pdf->Output();

?>