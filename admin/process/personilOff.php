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
        Data Personil
        <small>Daftar Personil Tidak Aktif</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Personil</li>
        <li class="active">Daftar Personil Tidak Aktif</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data penempatan personil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="dtHorizontalVerticalExample" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Foto Personil</th>
                  <th>Penempatan</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                  <th>Nama Personil</th>
                  <th>NIK</th>
                  <th>Agama</th>
                  <th>Status Diri</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                  <th>Email</th>
                  <th>Ijazah</th>
                  <th>Action</th>
                </tr>
                </thead>
                
                  <tbody>
                  <?php $nomor = 1; ?>
                    <?php $ambil = $koneksi->query("SELECT tbl_presentasiclient.nama_perusahaan , tbl_personiloff.* FROM 
                      tbl_presentasiclient, tbl_personiloff WHERE 
                      tbl_presentasiclient.id_presentasi = tbl_personiloff.id_presentasi");?>
                    <?php while ($tampil = $ambil->fetch_assoc()){ ?>
                      
                    <tr>
                        <td><?php echo $nomor ; ?></td>
                        <td>
                          <img class="profile-user-img img-thumbnail" src="../admin/process/FotoPersonil/<?php if($tampil['foto']== date("YmdHis",strtotime($tampil['foto'])))
                          { echo 'profile.png'; } else { echo $tampil['foto']; } ?>" alt="User profile picture">
                        </td>
                        <td><?php echo $tampil['nama_perusahaan']; ?></td>
                        <td><?php echo $tampil['jabatan']; ?></td>
                        <td><?php echo $tampil['status']?></td>
                        <td><?php echo $tampil['nama']; ?></td>
                        <td><?php echo $tampil['nik']; ?></td>
                        <td><?php echo $tampil['agama']; ?></td>
                        <td><?php echo $tampil['status_diri']; ?></td>
                        <td><?php echo $tampil['alamat']; ?></td>
                        <td><?php echo $tampil['telp']; ?></td>
                        <td><?php if($tampil['email']== null){ echo 'Tidak memiliki email'; } else { echo $tampil['email']; } ?></td>
                        <td>
                          <a href="../admin/process/SertifPersonil/<?php echo $tampil['sertifikat'] ?>" target="_blank">
                            <?php if($tampil['sertifikat']== true){ echo 'Cek file'; } ?>
                          </a>
                            <?php if($tampil['sertifikat']== null){ echo 'Tidak ada sertifikat'; } ?>
                        </td>
                        <td> 
                          <a href = "?halaman=hapusdaftarpersonil&id=<?php echo $tampil ['id_personil']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                    <?php } ?>
                  </tbody>

                <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Foto Personil</th>
                  <th>Penempatan</th>
                  <th>Jabatan</th>
                  <th>Status</th>
                  <th>Nama Personil</th>
                  <th>NIK</th>
                  <th>Agama</th>
                  <th>Status Diri</th>
                  <th>Alamat</th>
                  <th>Telp</th>
                  <th>Email</th>
                  <th>Ijazah</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
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