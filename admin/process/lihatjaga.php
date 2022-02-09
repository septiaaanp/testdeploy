<?php
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
?>
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <style>
    .dtHorizontalVerticalExampleWrapper {
    max-width: 600px;
    margin: 0 auto;
    }
    #dtHorizontalVerticalExample th, td {
    white-space: nowrap;
    }
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_asc_disabled:after,
    table.dataTable thead .sorting_asc_disabled:before,
    table.dataTable thead .sorting_desc:after,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting_desc_disabled:after,
    table.dataTable thead .sorting_desc_disabled:before {
    bottom: .5em;
    }
</style>

  <?php
  $ambil2 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_personil = '$_GET[id]'");
  $tampil2 = $ambil2->fetch_assoc();
  $id_presentasi = $tampil2['id_presentasi'];

  $ambil4 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
  $tampil4 = $ambil4->fetch_assoc();
  ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Personil
        <small>Absensi Personil</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Personil</li>
        <li>Absensi</li>
        <li class="active">Jaga Personil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-building"></i> <?php echo $tampil4['nama_perusahaan']; ?> - <?php echo $tampil2['nama']; ?>
                <small class="pull-right">Date: <?php echo date("d/m/Y");?></small>
            </h2>
            </div>
            <!-- /.col -->
        </div>

        <!-- Table row -->
        <div class="row">
            <div class="box-body">
                <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                width="100%">  
                <thead>
                    <tr>
                    <th>No.</th>
                    <th>Periode</th>
                    <th>Jumlah Jaga</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_jagapersonil where id_personil = '$_GET[id]' order by tbl_jagapersonil.tgl_jaga");?>
                    <?php while ($tampil3 = $ambil3->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor?></td>
                        <td><?php echo indonesian_date($tampil3['tgl_jaga'], ' F Y');?></td>
                        <td><?php echo $tampil3['jaga']?> Hari</td>
                        <td>
                            <a href = "?halaman=ubahJaga&id=<?php echo $tampil3['id_jaga']; ?>" class = "btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href = "?halaman=hapusJaga&id=<?php echo $tampil3['id_jaga']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                    <th>No.</th>
                    <th>Periode</th>
                    <th>Jumlah Jaga</th>
                    <th>Action</th>
                    </tr>
                </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
            <!-- <a href="../admin/process/cetaklistpersonil.php?id=" target="_blank" 
                class="btn btn-primary pull-left">
                <span class="glyphicon glyphicon-print"></span> Print PDF
            </a> -->
            <a href="?halaman=jagaPersonil" class="btn btn-warning pull-right">
                <i class="fa fa-undo"></i> Kembali
            </a>
            <a href="?halaman=tambahJaga&id=<?php echo $tampil2['id_personil']?>" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                <i class="fa fa-plus"></i> Tambah Data
            </a>
            </div>
        </div>
    </section>
    
    <!-- /.content -->
    <div class="clearfix"></div>
    


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>


<script>
    function goBack() {
        window.history.back();
    }
</script>

<script>
$(document).ready(function () {
$('#dtHorizontalVerticalExample').DataTable({
"searching": true,
"scrollX": true,
"scrollY": 310
});
$('.dataTables_length').addClass('bs-select');
});
</script>


