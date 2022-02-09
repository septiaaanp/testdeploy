
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
    $ambil = $koneksi->query("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$_REQUEST[client]'");
    $tampil = $ambil->fetch_assoc();
    $id_presentasi = $tampil['id_presentasi'];

    $ambil2 = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_presentasi'");
    $tampil2 = $ambil2->fetch_assoc();
    $id_kontrak = $tampil2['id_kontrak'];
    ?>
    <?php
      $ambil3 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_presentasi = '$id_presentasi'");
      // $tampil = $ambil->fetch_assoc();
    ?>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Personil Aktif
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Transaksi</li>
          <li>Gaji Personil</li>
          <li class="active">Daftar Personil</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-building"></i> <?php echo $tampil['nama_perusahaan']; ?>
              <small class="pull-right">Date: <?php echo date("d/m/Y");?></small>
            </h2>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.box-header -->
        <?php $ambil4 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_presentasi = '$id_presentasi'");?>
        <?php $tampil4 = $ambil4->fetch_assoc()?>
        <form role="form" method="POST" target="_blank" action="../admin/process/cetakgaji.php">
        <div class="box-body col-md-6">
          <!-- ruang kosong biar select option di kanan -->
        </div>
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
        </div>
        <!-- /.box-body -->
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <!-- biar ga kopong -->
        </div>
          

        <!-- Table row -->
        <div class="row">
          <div class="box-body">
              <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                width="100%">  
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Penempatan</th>
                    <th>Jabatan</th>
                    <th>Nama Personil</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php $nomor = 1; ?>
                        <?php while ($tampil3 = $ambil3->fetch_assoc()){ ?>
                          
                            <td><?php echo $nomor ; ?></td>
                            <td><?php echo $tampil['nama_perusahaan']; ?></td>
                            <td><?php echo $tampil3['jabatan']; ?></td>
                            <td><?php echo $tampil3['nama']; ?></td>
                            <td>
                                <!-- <a href="?halaman=lihatGaji&id=<?php echo $tampil3['id_personil'];?>" 
                                class="btn btn-primary pull-left"> Lihat Gaji
                                </a> -->
                                <button type="submit" 
                                class="btn btn-primary pull-left" name="cetak" value="<?php echo $tampil3['id_personil']; ?>"> Lihat Gaji
                                </a>
                            </td>
                  </tr>
                  <?php $nomor++; ?>
                  <?php } ?>
                </tbody>
                </form>
                <!-- akhir form -->
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Penempatan</th>
                    <th>Jabatan</th>
                    <th>Nama Personil</th>
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
            <!-- <a href="../admin/process/cetaklistpersonil.php?id=<?php echo $tampil4['id_kontrak'];?>" target="_blank" 
              class="btn btn-primary pull-left">
              <span class="glyphicon glyphicon-print"></span> Cetak List Personil
            </a> -->
            <a href="?halaman=gajiPersonil" class="btn btn-warning pull-right" onclick="goBack()">
              <i class="fa fa-undo"></i> Kembali
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
  "scrollY": 310,
  });
  $('.dataTables_length').addClass('bs-select');
  });
  </script>


