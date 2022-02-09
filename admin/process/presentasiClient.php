
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
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Client
        <small>Presentasi Client</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Client</li>
        <li class="active">Presentasi Client</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data client yang sudah dipresentasi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
              width="100%">  
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Perusahaan/Client</th>
                  <th>Pemilik Perusahaan</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                  <th>Email</th>
                  <th>Tanggal Presentasi</th>
                  <th>Status Presentasi</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                  <?php $nomor = 1; ?>
                  <?php $ambil = $koneksi->query("SELECT * FROM tbl_presentasiclient");?>
                  <?php while ($tampil = $ambil->fetch_assoc()){ ?>
                    
                  <tr>
                      <td><?php echo $nomor ; ?></td>
                      <td><?php echo $tampil['nama_perusahaan']; ?></td>
                      <td><?php echo $tampil['pemilik_perusahaan']; ?></td>
                      <td><?php echo $tampil['alamat_perusahaan']; ?></td>
                      <td><?php echo $tampil['telp_perusahaan']; ?></td>
                      <td><?php echo $tampil['email_perusahaan']; ?></td>
                      <td><?php echo date('d F Y', strtotime($tampil['tgl_presentasi'])); ?></td>
                      <td><?php echo $tampil['status']; ?></td>
                      <td> 
                        <a href = "?halaman=ubahpresentasiclient&id=<?php echo $tampil ['id_presentasi']; ?>" class = "btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                        <a href = "?halaman=hapuspresentasiclient&id=<?php echo $tampil ['id_presentasi']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                  </tr>
                  <?php $nomor++; ?>
                  <?php } ?>

                </tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Perusahaan/Client</th>
                    <th>Pemilik Perusahaan</th>
                    <th>Alamat</th>
                    <th>Telp</th>
                    <th>Email</th>
                    <th>Tanggal Presentasi</th>
                    <th>Status Presentasi</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
              </table>
              <div class="box-footer">
                <a class="btn btn-primary" href="?halaman=tambahPresentasiClient" role="button">Tambah Data</a>
              </div>
            </div>
            <!-- /.box-body -->
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