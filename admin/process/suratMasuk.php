
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Arsip Surat
        <small>Surat Masuk</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Arsip Surat</li>
        <li class="active">Surat Masuk</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Arsip Surat Masuk </h3>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>No. Surat</th>
                  <th>Perihal</th>
                  <th>Pengirim</th>
                  <th>Tgl Masuk</th>
                  <th>Tgl Surat</th>
                  <th>Alamat Pengirim</th>
                  <th>Scan Surat</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    
                    <?php $ambil = $koneksi->query("SELECT * FROM tbl_suratmasuk");?>
                    <?php while ($tampil = $ambil->fetch_assoc()){ ?>
                      
                    <tr>
                        <td><?php echo $nomor ; ?></td>
                        <td><?php echo $tampil['no_surat']; ?></td>
                        <td><?php echo $tampil['perihal']; ?></td>
                        <td><?php echo $tampil['pengirim']?></td>
                        <td><?php echo date('d F Y', strtotime($tampil['tgl_masuk'])); ?></td>
                        <td><?php echo date('d F Y', strtotime($tampil['tgl_surat'])); ?></td>
                        <td><?php echo $tampil['alamat']; ?></td>
                        <td><a href="../admin/process/SuratMasuk/<?php echo $tampil['upload'] ?>" target="_blank"><?php echo $tampil ['upload'];?></a></td>
                        <td> 
                          <a href = "?halaman=ubahSuratMasuk&id=<?php echo $tampil ['id_suratmasuk']; ?>" class = "btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span></a>
                          <a href = "?halaman=hapusSuratMasuk&id=<?php echo $tampil ['id_suratmasuk']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>No. Surat</th>
                  <th>Perihal</th>
                  <th>Pengirim</th>
                  <th>Tgl Masuk</th>
                  <th>Tgl Surat</th>
                  <th>Alamat Pengirim</th>
                  <th>Scan Surat</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
              <div class="box-footer ">
                <a class="btn btn-primary" href="?halaman=tambahsuratMasuk" role="button">Tambah Data</a>
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
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>