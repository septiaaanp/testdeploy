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

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>Kas Masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Transaksi</li>
        <li class="active">Kas Masuk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Arus kas masuk</h3>
              <!-- <div class="row">
                <div class="col-xs-8">
                    <label for="">Tahun:&nbsp;&nbsp;&nbsp;</label>
                    <select name="" id="">
                        <option>-- Pilih --</option>
                    </select>
                </div>
                <div class="col-xs-4">
                    <label for="" class="col-xs-4">&emsp;&emsp;&emsp;Bulan:</label>
                    <select name="" id="" class="col-xs-8">
                        <option>-- Pilih --</option>
                    </select>
                </div> -->
              <!-- </div> -->
            </div>
            <!-- /.box-header -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#lihatkas" data-toggle="tab">Lihat Kas Masuk</a></li>
                <li><a href="#cetak" data-toggle="tab">Cetak Kas Masuk per Bulan</a></li>
                <li><a href="#cetaktahun" data-toggle="tab">Cetak Kas Masuk per Tahum</a></li>
              </ul>
              <div class="tab-content">
                <div class="active tab-pane" id="lihatkas">
                  <div class="box-body">
                    <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                      width="100%">
                      <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Keterangan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM tbl_kasmasuk order by tbl_kasmasuk.tanggal");?>
                        <?php while ($tampil = $ambil->fetch_assoc()){ ?>
                        <tr>
                          <td><?php echo $nomor ; ?></td>
                          <td><?php echo indonesian_date($tampil['tanggal'], 'd F Y') ?></td>
                          <td><?php echo $tampil['keterangan']; ?></td>
                          <td>Rp. <?php echo number_format($tampil['harga'], 0 ,'.','.'); ?></td>
                          <td><?php echo $tampil['total']; ?> </td>
                          <td>Rp. <?php echo number_format($tampil['total_harga'], 0 ,'.','.'); ?></td>
                          <td>
                            <a href = "?halaman=ubahKasMasuk&id=<?php echo $tampil['id_kasmasuk'];?>" class = "btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                            <a href = "?halaman=hapusKasMasuk&id=<?php echo $tampil['id_kasmasuk']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                          </td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php } ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <?php
                        $ambil2= $koneksi->query ("SELECT SUM(total_harga) AS total FROM tbl_kasmasuk");
                        $hasil2 = $ambil2->fetch_array();
                        $total_harga = $hasil2['total'];
                        ?>
                        <th>No.</th>
                        <th colspan="4">Total Kas Masuk</th>
                        <th style="background-color:#dcdde1;">Rp. <?php echo number_format($total_harga, 0 ,'.','.'); ?></th>
                        <th>Action</th>
                      </tr>
                      </tfoot>
                    </table>
                    <div class="box-footer ">
                      <a class="btn btn-primary" href="?halaman=tambahKasMasuk" role="button">Tambah Data</a>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <div class="tab-pane" id="cetak">
                  <!-- /.box-header -->
                  <form role="form" method="POST" target="_blank" action="../admin/process/cetakkasmasuk.php">
                    <div class="box-body col-md-6">
                    <div class="row">
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Bulan</label>
                                <select class="form-control" name="bulan1">
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
                                    <option value="" class="text-muted">Pilih Tahun</option>
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
                        <button type="submit" class="btn btn-primary pull-right">
                            <i class="fa fa-print"></i> Cetak Kas Masuk
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
                <div class="tab-pane" id="cetaktahun">
                  <form role="form" method="POST" target="_blank" action="../admin/process/cetakkasmasuktahun.php">
                    <div class="box-body col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tahun</label>
                                <select class="form-control" name="tahun">
                                    <option value="" class="text-muted">Pilih Tahun</option>
                                    <?php for ( $i = 2000; $i <= date('Y'); $i ++) { ?>
                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <!-- /.form-group -->
                            <div>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <i class="fa fa-print"></i> Cetak Kas Masuk
                                </button>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
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
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->


<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<!-- page script -->
<script>
$(document).ready(function () {
$('#dtHorizontalVerticalExample').DataTable({
"scrollX": true,
"scrollY": 310,
});
$('.dataTables_length').addClass('bs-select');
});
</script>