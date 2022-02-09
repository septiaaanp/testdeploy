<link href="assets/css/float-label.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
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
  $id_kontrak = $tampil['id_kontrak'];

  $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
  $tampil2 = $ambil2->fetch_assoc();
  ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Form Input
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Client</li>
        <li>Kontrak Client</li>
        <li class="active">Form Input</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Nilai Gaji <?php echo $tampil2['nama_perusahaan'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="box-body"> 
                      <div class="">
                        <a href="?halaman=selanjutnyaupdate&client=<?php echo $tampil2['nama_perusahaan'];?>" 
                          type="button" class="btn btn-primary btn-sm" name="tambah">
                          <span class=" glyphicon glyphicon-plus"></span> Tambah nilai gaji
                        </a>
                      </div><br>    
                      <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="box box-primary">
                          <!-- <form role="form" autocomplete="off" method="POST" action="">  -->
                              <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                              width="100%"> 
                                <thead>
                                  <tr>
                                    <td hidden>ID</td>
                                    <th>Jabatan</th>
                                    <th>Total</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan Jabatan <small class="text-danger">*Jika tidak ada isikan 0</small></th>
                                    <th>BPJS Ketenagakerjaan</th>
                                    <th>BPJS Kesehatan</th>
                                    <th>Tunjangan Hari Raya</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="itemlist">
                                    <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_biayagaji where id_kontrak = '$id_kontrak'");
                                    ?>
                                    <?php while ($tampil3 = $ambil3->fetch_array()){ ?>
                                    <tr>
                                        <td hidden><input type="text" name="id" value="<?php echo $tampil3 ['id_nilai'];?>"></td>
                                        <td >
                                          <!-- select -->
                                          <div class="form-group ">
                                            <select class="form-control" name="jabatan" required disabled>
                                              <option value="" class="text-muted">-- PILIH JABATAN --</option>
                                              <option <?php if($tampil3['jabatan']=="Chief / Supervisor"){ echo "selected"; }?>>Chief / Supervisor</option>
                                              <option <?php if($tampil3['jabatan']=="Komandan Regu (DANRU)"){ echo "selected"; }?>>Komandan Regu (DANRU)</option>
                                              <option <?php if($tampil3['jabatan']=="Anggota"){ echo "selected"; }?>>Anggota</option>
                                            </select>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="jumlah" value="<?php echo $tampil3['jumlah_personil'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="gj_pokok" value="<?php echo $tampil3['gaji_pokok'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="tunj_jabatan" value="<?php echo $tampil3['tunj_jabatan'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="bpjs_kerja" value="<?php echo $bpjs_kerja_tampil = round($tampil3['bpjs_kerja'] / 0.0624);?>" 
                                            required disabled>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="bpjs" value="<?php echo $tampil3['bpjs'];?>"required disabled>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="tunjangan" value="<?php echo $tunjangan_tampil = round(12 * $tampil3['tunjangan']);?>" 
                                            required disabled>
                                          </div> 
                                        </td>
                                        <td> 
                                          <a class="btn btn-sm btn-success but_apply" data-toggle="modal" data-target="#modal-default<?php echo $tampil3['id_nilai']?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                          </a>
                                          <a href = "?halaman=hapusnilaigaji&id=<?php echo $tampil3['id_nilai']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_biayagaji where id_kontrak = '$_GET[id]'");
                                    ?>
                                    <?php while ($tampil3 = $ambil3->fetch_array()){ ?>
                                  
                                    <!-- awal modal -->
                                    <div class="modal fade" id="modal-default<?php echo $tampil3['id_nilai']?>">
                                
                                    <form method="post" autocomplete="off">
                                        <div class="modal-dialog">
                                          <div class="modal-content">

                                            <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                              <h4 class="modal-title">Ubah Nilai Gaji</h4>
                                            </div>

                                            <div class="modal-body">
                                              <div hidden>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                                name="id_nilai1" value="<?php echo $tampil3['id_nilai'];?>" required>
                                              </div>
                                              <div class="form-group float-label-control">
                                                <p><strong>Jabatan</strong></p>
                                                <label for="">Jabatan</label>
                                                <select class="form-control" name="jabatan1" required>
                                                  <option value="" class="text-muted">-- PILIH JABATAN --</option>
                                                  <option <?php if($tampil3['jabatan']=="Chief / Supervisor"){ echo "selected"; }?>>Chief / Supervisor</option>
                                                  <option <?php if($tampil3['jabatan']=="Komandan Regu (DANRU)"){ echo "selected"; }?>>Komandan Regu (DANRU)</option>
                                                  <option <?php if($tampil3['jabatan']=="Anggota"){ echo "selected"; }?>>Anggota</option>
                                                </select>
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>Total</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah1" value="<?php echo $tampil3['jumlah_personil'];?>" required>
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>Gaji Pokok</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="gj_pokok1" value="<?php echo $tampil3['gaji_pokok'];?>" required>
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>Tunjangan Jabatan <small class="text-danger">*Jika tidak ada isikan 0</small></strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="tunj_jabatan1" value="<?php echo $tampil3['tunj_jabatan'];?>" required>
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>BPJS Ketenagakerjaan</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="bpjs_kerja1" value="<?php echo 
                                                $bpjs_kerja_tampil = round($tampil3['bpjs_kerja'] / 0.0624);?>" required>             
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>BPJS Kesehatan</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="bpjs1" value="<?php echo $tampil3['bpjs'];?>"required>             
                                              </div>
                                              <div class="form-group ">
                                                <p><strong>Tunjangan</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="tunjangan1" value="<?php echo 
                                                $tunjangan_tampil = round(12 * $tampil3['tunjangan']);?>" required>
                                              </div>    
                                              <!-- <p>One fine body&hellip;</p> -->
                                            </div>

                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                              <button type="submit" class="btn btn-primary" name="update">Simpan</button>
                                            </div>
                                          </div>
                                          <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </form>
                                    </div>
                                    <!-- /.modal -->
                                    <?php } ?>

                                    <?php
                                      if(isset($_POST['update']))
                                      {
                                        $id_nilai = mysql_real_escape_string($_POST['id_nilai1']);
                                        $jabatan = mysql_real_escape_string($_POST['jabatan1']);
                                        $jumlah = mysql_real_escape_string($_POST['jumlah1']);
                                        $gj_pokok = mysql_real_escape_string($_POST['gj_pokok1']);
                                        $tunj_jabatan = mysql_real_escape_string($_POST['tunj_jabatan1']);
                                        $bpjs_kerja = mysql_real_escape_string($_POST['bpjs_kerja1']);
                                        $bpjs_kerja_fix = round($bpjs_kerja * 0.0624, 2);
                                        $bpjs = mysql_real_escape_string($_POST['bpjs1']);
                                        $tunjangan = mysql_real_escape_string($_POST['tunjangan1']);
                                        $thr = round($tunjangan / 12 , 3);
                                        
                                        $nilai_gaji = round($jumlah * ( $gj_pokok + $tunj_jabatan + $bpjs_kerja_fix + $bpjs + $thr));
                                                                                
                                        $koneksi->query ("UPDATE tbl_biayagaji SET id_kontrak = '$id_kontrak', id_presentasi = '$id_presentasi', jabatan = '$jabatan', 
                                        jumlah_personil ='$jumlah', gaji_pokok = '$gj_pokok', tunj_jabatan = '$tunj_jabatan', bpjs_kerja = '$bpjs_kerja_fix', bpjs = '$bpjs', 
                                        tunjangan = '$thr', nilai_gaji ='$nilai_gaji' WHERE id_nilai = '$id_nilai'");

                                        echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
                                        echo "<script>location='index.php?halaman=ubahnilaigaji&id=$id_kontrak';</script>";             
                                      }      
                                    ?>

                                    <!-- untuk update jumlah personil -->
                                    <?php
                                      
                                      $ambil4= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
                                      $hasil4 = $ambil4->fetch_array();
                                      $total_nilai1 = $hasil4['total'];

                                      $ambil5= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'ANGGOTA'");
                                      $hasil5= $ambil5->fetch_array();
                                      $total_nilai2 = $hasil5['total'];

                                      $ambil6= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak'");
                                      $hasil6= $ambil6->fetch_array();
                                      $total_nilai3 = $hasil6['total'];

                                      $ambil7= $koneksi->query ("SELECT SUM(jumlah_personil) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
                                      $hasil7 = $ambil7->fetch_array();
                                      $personil = $hasil7['total'];

                                      $nilai_total = $total_nilai1 + $total_nilai2 + $total_nilai3;
                                      $fee_management = round($nilai_total * 0.1);
                                      $nilai_fix = $nilai_total + $fee_management;

                                      $ppn = round($nilai_fix * 0.1);
                                      $nilai_fix_ppn = $ppn + $nilai_fix;

                                      $koneksi->query ("UPDATE tbl_kontrakclient SET minta_personil = '$personil' where id_kontrak = '$id_kontrak'");
                                      $koneksi->query("UPDATE tbl_kontrakclient SET nilai_kontrak = '$nilai_fix_ppn'  WHERE id_kontrak = '$id_kontrak'");
                                    ?>
                                    <!-- end -->

                                  </tbody>

                                  <tfoot>
                                    <th colspan="8"></th>
                                  </tfoot>
                                  
                              </table><br>
                              <!-- <div> -->
                                <!-- Tambah Tunjangan PKD jika ada klik disini: <input type="checkbox" id="myCheck" onclick="myFunction()"> -->
                                <div id="text" style="display"> 
                                  <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                                  width="100%">
                                    <thead>
                                      <tr>
                                        <th>Jumlah <small class="text-danger">*Harap isi kembali jika ada perubahan</small></th>
                                        <th>Tunjangan PKD</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ambil8 = $koneksi->query("SELECT * FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'Anggota'");
                                    $tampil8 = $ambil8->fetch_array();
                                    ?>
                                      <td width="30%">
                                        <div class="form-group ">
                                          <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="jumlah_pkd" value="<?php if($tampil8['jumlah_pkd']== null){ echo '0'; } 
                                            else { echo $tampil8['jumlah_pkd']; } ?>" disabled>
                                        </div> 
                                      </td>
                                      <td width="30%">
                                        <div class="form-group ">
                                          <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                            name="tunj_pkd" value="<?php if($tampil8['jumlah_pkd']== null){ echo '0'; } 
                                            else { echo $tunj_pkd_tampil = $tampil8['tunj_pkd'] / $tampil8['jumlah_pkd']; } ?>" disabled>
                                        </div> 
                                      </td>
                                      <td width="5%">
                                        <button class = "btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default2<?php echo $tampil8['id_nilai']?>"><span class="glyphicon glyphicon-edit"></span></button>
                                        <a href = "?halaman=hapusnilaigaji&id=<?php echo $tampil8['id_nilai']; ?>" class = "btn btn-danger btn-sm" onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')"><span class="glyphicon glyphicon-trash"></span></a>
                                      </td>
                                    </tbody>

                                    <div class="modal fade" id="modal-default2<?php echo $tampil8['id_nilai']?>">
                                      <form method="post" autocomplete="off">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Ubah Tunjangan PKD</h4>
                                          </div>

                                          <div class="modal-body">
                                            <div hidden>
                                              <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                              name="id_nilai2" value="<?php echo $tampil8['id_nilai'];?>" required>
                                            </div>                                            
                                            <div class="form-group ">
                                              <p><strong>Jumlah</strong></p>
                                              <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                                name="jumlah_pkd1" value="<?php if($tampil8['jumlah_pkd']== null){ echo '0'; } 
                                                else { echo $tampil8['jumlah_pkd']; } ?>">
                                            </div>
                                            <div class="form-group ">
                                              <p><strong>Tunjangan PKD</strong></p>
                                              <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                                name="tunj_pkd1" value="<?php if($tampil8['jumlah_pkd']== null){ echo '0'; } 
                                                else { echo $tunj_pkd_tampil = $tampil8['tunj_pkd'] / $tampil8['jumlah_pkd']; } ?>">
                                            </div>  
                                          </div>

                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                            <button type="submit" name="update_pkd" class="btn btn-primary">Simpan</button>
                                          </div>
                                        </div>
                                        <!-- /.modal-content -->
                                      </div>
                                      <!-- /.modal-dialog -->
                                      </form>
                                    </div>
                                    <!-- /.modal -->
                                  
                                  </table>

                                  <?php
                                      if(isset($_POST['update_pkd']))
                                      {
                                        $id_nilai = mysql_real_escape_string($_POST['id_nilai2']);
                                        $jumlah_pkd = mysql_real_escape_string($_POST['jumlah_pkd1']);
                                        $tunj_pkd = mysql_real_escape_string($_POST['tunj_pkd1']);
                                        $nilai_pkd = $jumlah_pkd * $tunj_pkd;
                                      
                                        $koneksi->query ("UPDATE tbl_biayagaji SET id_kontrak = '$id_kontrak', id_presentasi = '$id_presentasi', jumlah_pkd = '$jumlah_pkd', tunj_pkd = '$nilai_pkd' 
                                        where jabatan = 'Anggota' AND id_nilai = '$id_nilai'");

                                        echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
                                        echo "<script>location='index.php?halaman=ubahnilaigaji&id=$id_kontrak';</script>";             
                                      }
                                    ?>

                                </div>
                              <!-- </div>              -->
                            <div class="text-right">
                              <a href="?halaman=ubahkontrakclient&id=<?php echo $tampil['id_kontrak']; ?>" class="btn btn-warning ">
                                <i class="fa fa-undo"> Kembali</i>
                              </a>
                            </div>
                          <!-- </form>                           -->
                        </div>
                        <!-- /.box -->
                      </div>
                      <!--/.col (right) -->
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


<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<script>
function hanyaAngka(evt) {
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))

    return false;
  return true;
}
</script>

<script>
function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("myCheck");
  // Get the output text
  var text = document.getElementById("text");

  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
    text.style.display = "none";
  }
}
</script>

<!-- page script -->
<script>
$(document).ready(function () {
$('#dtHorizontalVerticalExample').DataTable({
"scrollX": true,
"scrollY": 200,
"paging":   false,
"ordering": false,
"info":     false,
"searching": false
});
$('.dataTables_length').addClass('bs-select');
});
</script>

