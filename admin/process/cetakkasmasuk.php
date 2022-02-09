<?php
include_once ('../koneksi.php');

$bulan = $_POST['bulan1'];
$format_bulan = date('F', strtotime($_POST['bulan1']));
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

$ambil = $koneksi->query("SELECT * FROM tbl_kasmasuk where substr(tanggal,1,4)= '$tahun' 
                        and substr(tanggal,6,2) = '$bulan' order by tbl_kasmasuk.tanggal");

$ambil2 = $koneksi->query("SELECT * FROM tbl_kasmasuk where substr(tanggal,6,2) = '$bulan'");
$tampil2 = $ambil2->fetch_assoc();
$format_bulan_2 = $tampil2['tanggal'];

$ambil4 = $koneksi->query("SELECT * FROM tbl_kasmasuk where substr(tanggal,1,4)= '$tahun' 
                        and substr(tanggal,6,2) = '$bulan' order by tbl_kasmasuk.tanggal");
$jumlah_kas = $ambil4->num_rows;

if($jumlah_kas < 1){
    echo "<script type='text/javascript'>alert('Data kas masuk tidak ditemukan');</script>";
    echo "Data kas masuk tidak ditemukan";
}else{

    include ('fungsi/pdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('P', 'A4');
    
    // //TABEL FORM
    $pdf->Ln(3);
    $pdf->SetFont('Times', 'BU', '12');
    $pdf->Cell(0, 6, 'LAPORAN KAS MASUK', 0, 1, 'C');
    
    $pdf->SetFont('Times', '', '12');
    $pdf->SetLeftMargin(3);
    $pdf->Cell(0, 6, 'Bulan : '.indonesian_date($format_bulan_2, 'F').''.$tahun, 0, 1, 'C');
    
    $pdf->Ln(10);
    $pdf->SetFont('Times','B', '12');
    $pdf->SetLeftMargin(5);
    
    $pdf->Cell(8,6,'NO',1,0, 'C');
    $pdf->Cell(40,6,'TANGGAL',1,0, 'C');
    $pdf->Cell(45,6,'KETERANGAN',1,0, 'C');
    $pdf->Cell(40,6,'HARGA',1,0, 'C');
    $pdf->Cell(25,6,'JUMLAH',1,0, 'C');
    $pdf->Cell(40,6,'TOTAL',1,1, 'C');
    
    $nomor = 1;
    $pdf->SetFont('Times','',12);
    while($tampil = $ambil->fetch_assoc()){
        //isi tabel
        $pdf->Cell(8,6,$nomor,1,0, 'C');    
        $pdf->Cell(40,6,indonesian_date($tampil['tanggal'], 'd F Y'),1,0, 'C');    
        $pdf->Cell(45,6,$tampil['keterangan'],1,0, 'C');
        $pdf->Cell(40,6,'Rp. '.number_format($tampil['harga'], 0 ,'.','.').'',1,0, 'C');
        $pdf->Cell(25,6,$tampil['total'],1,0, 'C');
        $pdf->Cell(40,6,'Rp. '.number_format($tampil['total_harga'], 0 ,'.','.').'',1,1, 'C');
        
        $nomor++;
    }
    
    $ambil3= $koneksi->query ("SELECT SUM(total_harga) AS total FROM tbl_kasmasuk where substr(tanggal,6,2) = '$bulan' 
                                and substr(tanggal,1,4)= '$tahun'");
    $hasil3 = $ambil3->fetch_array();
    $total_harga = $hasil3['total'];
    
    $pdf->Cell(158,6,'TOTAL HARGA',1,0, 'C');
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(40,6, 'Rp. '.number_format($total_harga, 0 ,'.','.').'',1,1, 'C');
    
    
    $pdf->Output();
}

?>