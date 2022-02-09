
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
        <li>Absensi Personil</li>
        <li class="Active">Lihat Absensi Personil</li>
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

      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#lihatabsensi" data-toggle="tab">Lihat Absensi</a></li>
          <li><a href="#rekapabsen" data-toggle="tab">Rekap Absensi</a></li>
        </ul>
        <div class="tab-content">
            <div class="active tab-pane" id="lihatabsensi">
                <!-- Table row -->
                <div class="row">
                    <div class="box-body">
                        <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                        width="100%">  
                        <thead>
                            <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Kehadiran</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nomor = 1; ?>
                            <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_absensi where id_personil = '$_GET[id]' order by tbl_absensi.tgl_absensi");?>
                            <?php while ($tampil3 = $ambil3->fetch_assoc()){ ?>
                            <tr>
                                <td><?php echo $nomor?></td>
                                <td><?php echo date('d/m/Y', strtotime($tampil3['tgl_absensi']));?></td>
                                <td><?php echo $tampil3['kehadiran']?></td>
                                <td><?php echo date('H:i', strtotime($tampil3['waktu_masuk']));?></td>
                                <td><?php echo date('H:i', strtotime($tampil3['waktu_keluar']));?></td>
                                <td>
                                    <a href = "?halaman=ubahAbsensi&id=<?php echo $tampil3['id_absensi']; ?>" class = "btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a href = "?halaman=hapuspresentasiclient&id=<?php echo $tampil ['id_presentasi']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                                </td>
                            </tr>
                            <?php $nomor++; ?>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Kehadiran</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
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
                    <a href="?halaman=absensiPersonil" class="btn btn-warning pull-right">
                        <i class="fa fa-undo"></i> Kembali
                    </a>
                    <a href="?halaman=tambahAbsensi&id=<?php echo $tampil2['id_personil']?>" type="button" class="btn btn-success pull-right" style="margin-right: 5px;">
                        <i class="fa fa-plus"></i> Tambah Absensi
                    </a>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="rekapabsen">
              <!-- /.box-header -->
              <form role="form" method="POST" target="_blank" action="../admin/process/cetakabsensi.php?id=<?php echo $_GET['id']?>">
                <div class="box-body col-md-6">
                 <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan2">
                                <option value="" class="text-muted">Pilih Bulan</option>
                                <option value="01">01 - Januari</option>
                                <option value="02">02 - Februari</option>
                                <option value="03">03 - Maret</option>
                                <option value="04">04 - April</option>
                                <option value="05">05 - Mei</option>
                                <option value="06">06 - Juni</option>
                                <option value="07">07 - Juli</option>
                                <option value="08">08 - Agustus</option>
                                <option value="09">09 - September</option>
                                <option value="10">10 - Oktober</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - Desember</option>	
                            </select>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun">
                                <?php for ( $i = 2000; $i <= date('Y'); $i ++) { ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                 </div>
                 <!-- /.row -->
                 <div>
                    <a href="?halaman=absensiPersonil" class="btn btn-warning pull-right" >
                        <i class="fa fa-undo"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px;">
                        <i class="fa fa-print"></i> Cetak Absensi
                    </button>
                 </div>
                </div>
                <!-- /.box-body -->

                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <!-- biar ga kopong -->
                </div>
             </form>
            </div>
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


