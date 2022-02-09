<?php
include_once ('../koneksi.php');

$ambil = $koneksi->query("SELECT * FROM tbl_kontrakhabis WHERE id_kontrak = '$_GET[id]'");
$tampil = $ambil->fetch_assoc();
$id_presentasi = $tampil['id_presentasi'];

$ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient WHERE id_presentasi = '$id_presentasi'");
$tampil2 = $ambil2->fetch_assoc();


include ('fungsi/pdf/fpdf.php');
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage('P', 'A4');

//TABEL FORM
$pdf->Ln();
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell(0, 5, 'RINCIAN BIAYA SECURITY PT. GARUDA SAKTI WASPADA', 0, 1, 'C');
$pdf->SetFont('Times', 'B', '12');
$currentDate = date("Y");
$pdf->Cell(0, 5, ''.$tampil2['nama_perusahaan'].' Tahun '.$currentDate.' ', 0, 1, 'C');
$pdf->Ln(1);

$pdf->SetFont('Times','B', '12');
$pdf->SetLeftMargin(15);

$pdf->Cell(8,5,'I',1,0, 'C');
$pdf->Cell(55,5,'BIAYA GAJI',1,0, 'C');
$pdf->Cell(20,5,'Total Org',1,0, 'C');
$pdf->Cell(30,5,'Harga/Orang',1,0, 'C');
$pdf->Cell(30,5,'Harga',1,0, 'C');
$pdf->Cell(10,5,'Qty',1,0, 'C');
$pdf->Cell(30,5,'Total/Bln',1,1, 'C');

$pdf->SetFont('Times','',12);
$nomor = 1;
$ambil3 = $koneksi->query("SELECT * FROM tbl_biayagaji where id_kontrak = '$_GET[id]'");
while ($tampil3 = $ambil3->fetch_assoc()){
    if($tampil3['jumlah_pkd']== null){

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(8,5,$nomor,1,0, 'C');
        $pdf->Cell(175,5,$tampil3['jabatan'],1,1, 'L');
        // GAJI POKOK
        $pdf->SetFont('Times','',12);
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Gaji Pokok / Basic Salary',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'], 0 ,'.','.'),1,1, 'R');
        // TUNJ JABATAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Tunjangan Jabatan',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['tunj_jabatan'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['tunj_jabatan'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['tunj_jabatan'], 0 ,'.','.'),1,1, 'R'); 
        // BPJS KETENAGAKERJAAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'BPJS Ketenagakerjaan 6,24%',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs_kerja'] / 0.0524 , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format(round($tampil3['bpjs_kerja']), 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['bpjs_kerja']), 0 ,'.','.'),1,1, 'R');
        // BPJS KESEHATAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'BPJS Kesehatan',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs'] , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['bpjs']), 0 ,'.','.'),1,1, 'R');
        // THR
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Tunjangan Hari Raya',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'] , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,'12',1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'] / 12), 0 ,'.','.'),1,1, 'R');
    }else{
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(8,5,$nomor,1,0, 'C');
        $pdf->Cell(175,5,$tampil3['jabatan'],1,1, 'L');
        // GAJI POKOK
        $pdf->SetFont('Times','',12);
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Gaji Pokok / Basic Salary',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'], 0 ,'.','.'),1,1, 'R');
        // TUNJ JABATAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Tunjangan Jabatan',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['tunj_jabatan'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['tunj_jabatan'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['tunj_jabatan'], 0 ,'.','.'),1,1, 'R'); 
        // BPJS KETENAGAKERJAAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'BPJS Ketenagakerjaan 6,24%',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs_kerja'] / 0.0524 , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format(round($tampil3['bpjs_kerja']), 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['bpjs_kerja']), 0 ,'.','.'),1,1, 'R');
        // BPJS KESEHATAN
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'BPJS Kesehatan',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs'] , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['bpjs'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['bpjs']), 0 ,'.','.'),1,1, 'R');
        // THR
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Tunjangan Hari Raya',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['gaji_pokok'] , 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,'12',1,0, 'C');
        $pdf->Cell(30,5,@number_format(round($tampil3['jumlah_personil'] * $tampil3['gaji_pokok'] / 12), 0 ,'.','.'),1,1, 'R');

        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,'Tunjangan PKD',1,0, 'L');
        $pdf->Cell(20,5,$tampil3['jumlah_pkd'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['tunj_pkd']/$tampil3['jumlah_pkd'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil3['tunj_pkd']/$tampil3['jumlah_pkd'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil3['jumlah_personil'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil3['tunj_pkd'], 0 ,'.','.'),1,1, 'R');
    }
    $nomor++;
}

$ambil5= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$_GET[id]'");
$hasil5 = $ambil5->fetch_array();
$total_nilai1 = $hasil5['total'];

$ambil6= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$_GET[id]' AND jabatan = 'ANGGOTA'");
$hasil6= $ambil6->fetch_array();
$total_nilai2 = $hasil6['total'];
//TOTAL
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'TOTAL SELURUH GAJI DAN TUNJANGAN',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($total_nilai1 + $total_nilai2, 0 ,'.','.') ,1,1, 'R'); //vertically merged cell

$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10

$pdf->Cell(8,5,'II',1,0, 'C');
$pdf->Cell(175,5,'BIAYA PERLALATAN PENDUKUNG',1,1, 'L');

$nomor = 1;
$ambil7 = $koneksi->query("SELECT * FROM tbl_biayapendukung where id_kontrak = '$_GET[id]'");
while ($tampil7 = $ambil7->fetch_assoc()){
    if($tampil7['jumlah_libur']== null){
        // KATEGORI
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(8,5,$nomor,1,0, 'C');
        $pdf->Cell(175,5,$tampil7['kategori'],1,1, 'L');
        // KETERANGAN
        $pdf->SetFont('Times','',12);
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,$tampil7['keterangan'],1,0, 'L');
        $pdf->Cell(20,5,$tampil7['total'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil7['harga'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil7['total'] * $tampil7['harga'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil7['qty'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil7['total'] * $tampil7['harga'] / $tampil7['qty'], 0 ,'.','.'),1,1, 'R'); 
    }else{
        // KATEGORI
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(8,5,$nomor,1,0, 'C');
        $pdf->Cell(175,5,$tampil7['kategori'],1,1, 'L');
        // KETERANGAN
        $pdf->SetFont('Times','',12);
        $pdf->Cell(8,5,'',1,0, 'C');
        $pdf->Cell(55,5,$tampil7['keterangan'],1,0, 'L');
        $pdf->Cell(20,5,$tampil7['total'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil7['harga'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(30,5,@number_format($tampil7['total'] * $tampil7['harga']* $tampil7['jumlah_libur'], 0 ,'.','.'),1,0, 'R');
        $pdf->Cell(10,5,$tampil7['qty'],1,0, 'C');
        $pdf->Cell(30,5,@number_format($tampil7['total'] * $tampil7['harga']* $tampil7['jumlah_libur'] / $tampil7['qty'], 0 ,'.','.'),1,1, 'R'); 
    }
    $nomor++;
}

$ambil8= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$_GET[id]'");
$hasil8= $ambil8->fetch_array();
$total_nilai3 = $hasil8['total'];


$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'TOTAL SELURUH BIAYA PENDUKUNG',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($total_nilai3, 0 ,'.','.') ,1,1, 'R'); //vertically merged cell

$total_biaya = $total_nilai1 + $total_nilai2 + $total_nilai3;
$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'TOTAL BIAYA I + II',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($total_biaya, 0 ,'.','.') ,1,1, 'R');

$fee_management = $total_biaya * 0.1;
$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'III',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'MANAGEMENT FEE 10%',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($fee_management, 0 ,'.','.') ,1,1, 'R');

$total_seluruh = $fee_management + $total_biaya;
$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'JUMLAH BIAYA',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($total_seluruh, 0 ,'.','.') ,1,1, 'R');

$ppn = round($total_seluruh * 0.1);
$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'IV',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'PPN 10%',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->SetFont('Times','',12);
$pdf->Cell(30,5, number_format($ppn, 0 ,'.','.') ,1,1, 'R');

$total_seluruh_fix = $ppn + $total_seluruh;
$pdf->Cell(183,5,'',1,1); //vertically merged cell, height=2x row height=2x5=10
$pdf->SetFont('Times','B',12);
$pdf->Cell(8,5,'',1,0); //vertically merged cell, height=2x row height=2x5=10
$pdf->Cell(145,5,'TOTAL BIAYA',1,0); //normal height, but occupy 4 columns (horizontally merged)
$pdf->Cell(30,5, number_format($total_seluruh_fix, 0 ,'.','.') ,1,1, 'R');

$pdf->Ln(3);


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
$currentDate2 = indonesian_date($tanggal,"l d F Y");

// TANGGAL HARI INI
$pdf->SetX(135);
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell(0, 5, 'Depok, '.$currentDate2.' ', 50, 1, 'C');
$pdf->Ln(5);

$pdf->SetX(-300);
$pdf->SetFont('Times', 'B', '12');
$pdf->Cell(0, 5, 'Mengetahui,', 0, 1, 'C');
$pdf->SetX(-300);
$pdf->Cell(0, 5, 'Direktur PT. Garuda Sakti Waspada', 0, 0, 'C');
$pdf->SetX(130);
$pdf->Cell(0, 5, 'Marketing', 0, 1, 'C');
$pdf->Ln(15);

$pdf->SetFont('Arial', 'BU', '12');
$pdf->SetX(-300);
$pdf->Cell(0, 5, 'Suryani', 0, 0, 'C'); //NAMA DIREKTUR
$pdf->SetX(130);
$pdf->Cell(0, 5, 'Irsal', 0, 1, 'C'); //NAMA KEUANGAN
$pdf->ln(0);
$pdf->SetFont('Arial', 'B', '12');
$pdf->SetX(-300);
$pdf->Cell(0, 5, 'NIK. 15.003.0571.1015', 0, 0, 'C'); //NIP DIREKTUR
$pdf->SetX(130);
$pdf->Cell(0, 5, 'NIK. 15.003.0571.1015 ', 0, 1, 'C'); //NIP KEUANGAN

$title = 'Nilai Kontrak '.$tampil2['nama_perusahaan'].'';
$pdf->SetTitle($title);

$pdf->Output();

?>