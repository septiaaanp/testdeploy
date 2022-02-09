<?php
include_once ('../koneksi.php');

$bulan = $_POST['bulan'];
$format_bulan = date('F', strtotime($bulan));
$tahun = $_POST['tahun'];
$format_tahun = date('Y', strtotime($_POST['tahun']));
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

$ambil = $koneksi->query("SELECT substr(tgl_absensi,9,2) AS tgl FROM tbl_absensi where substr(tgl_absensi,1,4)= '$tahun' 
                        and substr(tgl_absensi,6,2) = '$bulan' group by tgl_absensi");
$jumlah_absensi = $ambil->num_rows;

//QUERY Karyawan
$query_karyawan = $koneksi->query("SELECT * FROM tbl_daftarpersonil GROUP BY id_personil");
$jlh_karyawan = $query_karyawan->num_rows;

$ambil2 = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_kontrak = '$_GET[id]'");
$tampil2 = $ambil2->fetch_assoc();
$id_presentasi = $tampil2['id_presentasi'];

$ambil3 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
$tampil3 = $ambil3->fetch_assoc();
$perusahaan = $tampil3['nama_perusahaan'];

$ambil4 = $koneksi->query("SELECT * FROM tbl_absensi where substr(tgl_absensi,6,2) = '$bulan'");
$tampil4 = $ambil4->fetch_assoc();
$format_bulan_2 = $tampil4['tgl_absensi'];

if($jumlah_absensi < 1){
    echo "<script type='text/javascript'>alert('Data absensi tidak ditemukan');</script>";
    echo "Data absensi tidak ditemukan";
    // echo "<script>location='../admin/process/cetakrekapabsensi.php';</script>";  
}else{
    include ('fungsi/pdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AliasNbPages();
    $pdf->AddPage('L', 'A4');
    
    
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
    $pdf->setX(4);
    $pdf->SetFont('Times', 'B', 10);
    $pdf->Cell(0, 6, 'Bulan : ' .indonesian_date($format_bulan_2, 'F'). ' ' . $tahun, 0, 1, 'L');
    // $pdf->ln();
    
    //TABEL DATA
    $linespace = 6;
    $w = array(6, 15, 40, 7, 7, 15, 7, 7, 15);
    //=========0, 1,  2,  3, 4, 5, 6, 7=====//
    
    
    $pdf->setX(4);
    $pdf->SetFont('Arial', 'B', 7);
    
    $pdf->Cell($w[0], 6, '', 'TLR', 0, 'L');
    $pdf->Cell($w[1], 6, '', 'TLR', 0, 'C');
    $pdf->Cell($w[2], 6, '', 'TLR', 0, 'C');
    //PERULANGAN KOLOM TANGGAL
    $pdf->Cell($w[4] * $jumlah_absensi, 6, 'TANGGAL', 'TLR', 0, 'C');
    $pdf->Cell($w[5], 6, '', 'TLR', 0, 'C');
    $pdf->Ln();
    $pdf->setX(4);
    $pdf->Cell($w[0], 6, 'NO', 'LR', 0, 'L');
    $pdf->Cell($w[1], 6, 'NIP', 'LR', 0, 'C');
    $pdf->Cell($w[2], 6, 'NAMA', 'LR', 0, 'C');
    // //PERULANGAN KOLOM TANGGAL
    $nou = 0;
    while ($data_absen = $ambil->fetch_array()) {
        $nou++;
        $pdf->Cell($w[4], 6, $data_absen['tgl'], 'TLR', 0, 'C');
    }
    $pdf->Cell($w[5], 6, 'JML HADIR', 'LR', 0, 'C');
    $pdf->Ln();
    
    //=========0, 1,  2,  3,  4,  5,  6,  7=====//
    //Color and font restoration
    $pdf->setX(4);
    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(1);
    $pdf->SetFont('Arial', '', 8);
    //Data

    $fill = false;
    $i = 0;

    $num = count($ambil);

    $data_result = array();

    while ($data = $query_karyawan->fetch_array()) {
        $jumlah_kanan = 0;
        $result_kehadiran = array();

        $query_jlh_kehadiran = $koneksi->query("SELECT * FROM tbl_absensi
									WHERE id_personil = '$data[id_personil]' AND kehadiran = 'Hadir' AND substr(tgl_absensi,6,2) = '$bulan' AND substr(tgl_absensi,1,4) = '$tahun'");
        $jumlah_kehadiran = $query_jlh_kehadiran->num_rows;

        $data_result[] = array(
            'id_personil' => $data['id_personil'],
            'nama' => $data['nama'],
            'jkanan' => $jumlah_kehadiran,
        );
        //var_dump($data_result);die();
    }

    $j = 0;
    foreach ($data_result as $row) {
        $pdf->setX(4);
        $i++;
        $pdf->Cell($w[0], $linespace, $i, 'TLRB', 0, 'C', $fill); //NOMOR
        $pdf->Cell($w[1], $linespace, $row['id_personil'], 'TLRB', 0, 'C', $fill); //NIS
        $pdf->Cell($w[2], $linespace, ucwords(strtolower($row['nama'])), 'TLRB', 0, 'L', $fill); //NAMA KARYAWAN

        $query_tgl = $koneksi->query("SELECT tgl_absensi FROM tbl_absensi 
							WHERE substr(tgl_absensi,1,4) = '$tahun'
							AND substr(tgl_absensi,6,2) = '$bulan'
							GROUP BY tgl_absensi");
        $no_tgl = 0;
        while ($data_tgl = $query_tgl->fetch_array()) {
            $hadir_nip = $koneksi->query("SELECT * FROM tbl_absensi WHERE id_personil = $row[id_personil] AND tgl_absensi = '$data_tgl[tgl_absensi]'");

            $data_hadir_nip = $hadir_nip->fetch_array();
            
            if ($data_hadir_nip['kehadiran'] == 'Hadir') {
                $kehadiran = 'H';
            } else if ($data_hadir_nip['kehadiran'] == 'Sakit') {
                $kehadiran = 'S';
            } else if ($data_hadir_nip['kehadiran'] == 'Izin') {
                $kehadiran = 'I';
            } else if ($data_hadir_nip['kehadiran'] == 'Alpha') {
                $kehadiran = 'A';
            } else if ($data_hadir_nip['kehadiran'] == 'Cuti') {
                $kehadiran = 'C';
            } else {
                $kehadiran = '-';
            }

            $no_tgl++;
            $pdf->Cell($w[4], $linespace, $kehadiran, 'TLRB', 0, 'C', $fill);
        }
        $pdf->Cell($w[5], $linespace, $row['jkanan'], 'TLRB', 0, 'C', $fill); //JUMLAH KANAN
        $fill = !$fill;
        $pdf->Ln();
        $j++;
    }
    
    $pdf->Output();
}

?>