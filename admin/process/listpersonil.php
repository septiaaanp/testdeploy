
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
    $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$_REQUEST[client]'");
    $tampil2 = $ambil2->fetch_assoc();
    $id_presentasi = $tampil2['id_presentasi'];

    $ambil4 = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_presentasi'");
    $tampil4 = $ambil4->fetch_assoc();
    $id_kontrak = $tampil4['id_kontrak'];
    ?>
    <?php
      $ambil3 = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_presentasi = '$id_presentasi'");
      $tampil3 = $ambil3->fetch_assoc();
    ?>
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Daftar Personil Aktif
        </h1>
        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Data Client</li>
          <li>Kontrak Client</li>
          <li class="active">Daftar Personil</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
              <i class="fa fa-building"></i> <?php echo $tampil2['nama_perusahaan']; ?>
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
                    <th>Penempatan</th>
                    <th>Jabatan</th>
                    <th>Nama Personil</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <?php $nomor = 1; ?>
                        <?php $ambil = $koneksi->query("SELECT * FROM tbl_daftarpersonil where id_presentasi = '$id_presentasi'");?>
                        <?php while ($tampil = $ambil->fetch_assoc()){ ?>
                          
                            <td><?php echo $nomor ; ?></td>
                            <td><?php echo $tampil2['nama_perusahaan']; ?></td>
                            <td><?php echo $tampil['jabatan']; ?></td>
                            <td><?php echo $tampil['nama']; ?></td>
                            <td><?php echo $tampil['alamat']; ?></td>
                            <td><?php echo $tampil['telp']; ?></td>
                  </tr>
                  <?php $nomor++; ?>
                  <?php } ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Penempatan</th>
                    <th>Jabatan</th>
                    <th>Nama Personil</th>
                    <th>Alamat</th>
                    <th>Telp</th>
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
            <a href="../admin/process/cetaklistpersonil.php?id=<?php echo $tampil4['id_kontrak'];?>" target="_blank" 
              class="btn btn-primary pull-left">
              <span class="glyphicon glyphicon-print"></span> Cetak List Personil
            </a>
            <button class="btn btn-warning pull-right" onclick="goBack()">
              <i class="fa fa-undo"></i> Kembali
            </button>
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
  "searching": false,
  "scrollX": true,
  "scrollY": 310,
  dom: 'Bfrtip',
  buttons: [    
              'copy', 'excel',  
              // {
              //     extend: 'pdfHtml5',
              //     orientation: 'potrait',
              //     download : 'open', //nanti dihapus
              //     pageSize: 'A4',
              //     title: 'Daftar Personil <?php echo $tampil2['nama_perusahaan'];?>',
              //     filename: 'Daftar Personil - <?php echo $tampil2['nama_perusahaan'];?>',
                  
              //     customize: function ( doc ) {
                    
              //     doc.content[1].table.widths = [
              //     '5%',
              //     '25%',
              //     '17,5%',
              //     '17,5%',
              //     '17,5%',
              //     '17,5%'
              //     ]}
              // },
              
              {
                extend: 'print',
                customize: function ( win ) {
                  $(win.document.body)
                    .css( 'font-size', '10pt' )
                    .prepend(
                      '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                            );

                  $(win.document.body).find( 'table' )
                    .addClass( 'compact' )
                    .css( 'font-size', 'inherit' );
                  }
              }
          ]
  });
  $('.dataTables_length').addClass('bs-select');
  });
  </script>


