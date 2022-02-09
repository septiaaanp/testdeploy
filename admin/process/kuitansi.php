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
        $ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_kontrak = '$_GET[id]'");
        $tampil = $ambil->fetch_assoc();
        $id_presentasi = $tampil['id_presentasi'];

        $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
        $tampil2 = $ambil2->fetch_assoc();
        $perusahaan= $tampil2['nama_perusahaan'];
    ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Invoice dan Kuitansi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li>Invoice dan Kuitansi</li>
        <li class="Active">Kuitansi</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-building"></i><?php echo $perusahaan?>
            <small class="pull-right">Date: <?php echo date("d/m/Y");?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- /.box-header -->
        <form role="form" method="POST" target="_blank" autocomplete="off" action="../admin/process/cetakkuitansi.php?id=<?php echo $_GET['id']?>">
                <div class="box-body col-md-4">
                 <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>No. Kuitansi</label>
                            <input type="text" name="kuitansi" onkeypress="return hanyaAngka(event)" placeholder="Tulis No Kuitansi" class="form-control" required>
                        </div>
                    <!-- /.form-group -->
                    </div>
                
                    <!-- <div class="col-md-4">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan">
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
                        </div> -->
                    <!-- /.form-group -->
                    <!-- </div> -->
                    <!-- /.col -->
                    <!-- <div class="col-md-5">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun">
                                <?php for ( $i = 2000; $i <= date('Y'); $i ++) { ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div>
                        /.form-group
                    </div> -->
                    <!-- /.col -->
                 </div>
                 <!-- /.row -->
                 <div>
                    <a href="?halaman=invoiceKuitansi" class="btn btn-warning pull-right" >
                        <i class="fa fa-undo"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary pull-right" style="margin-right: 10px;">
                        <i class="fa fa-print"></i> Cetak Rekap Absensi
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
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}
</script>

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


