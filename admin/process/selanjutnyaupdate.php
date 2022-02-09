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
  $ambil = $koneksi->query("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$_REQUEST[client]'");
  $tampil = $ambil->fetch_assoc();
  $nama = $tampil['nama_perusahaan'];
  $id_presentasi = $tampil['id_presentasi'];

  $ambil2 = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_presentasi'");
  $tampil2 = $ambil2->fetch_assoc();
  $id_kontrak = $tampil2['id_kontrak'];
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
              <h3 class="box-title">Input Biaya Gaji <?php echo $tampil['nama_perusahaan'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="box-body">     
                      <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="box box-primary">
                          <form role="form" autocomplete="off" method="POST" action=""> 
                              <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                              width="100%"> 
                                <thead>
                                  <tr>
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
                                    <tr>
                                        <td>
                                          <!-- select -->
                                          <div class="form-group ">
                                            <select class="form-control" name="jabatan[0]" required>
                                              <option value="" class="text-muted">-- PILIH JABATAN --</option>
                                              <option >Chief / Supervisor</option>
                                              <option >Komandan Regu (DANRU)</option>
                                              <option >Anggota</option>
                                            </select>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="jumlah[0]" placeholder="Jumlah..." required>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="gj_pokok[0]" placeholder="Gaji Pokok..." required>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="tunj_jabatan[0]" placeholder="Tunjangan Jabatan..." required>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="bpjs_kerja[0]" placeholder="BPJS Ketenegakerjaan..." required>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="bpjs[0]" placeholder="BPJS Kesehatan..." required>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="tunjangan[0]" placeholder="Tunjangan Hari Raya..." required>
                                          </div> 
                                        </td>
                                        <td> 
                                          
                                        </td>
                                    </tr>
                                  </tbody>
                                  <tfoot>
                                    <th colspan="7"></th>
                                    <th>
                                      <button class="btn btn-sm btn-primary" onclick="additem(); return false">
                                        <span class=" glyphicon glyphicon-plus"></span>
                                      </button>
                                    </th>
                                  </tfoot>
                              </table>
                              <div>
                                Tambah Tunjangan PKD jika ada klik disini: <input type="checkbox" id="myCheck" onclick="myFunction()">
                                <div id="text" style="display:none"> 
                                  <table id="dtHorizontalVerticalExample" class="table table-striped table-bordered table-sm " cellspacing="0"
                                  width="50%">
                                    <thead>
                                      <tr>
                                        <th>Jumlah</th>
                                        <th>Tunjangan PKD</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $ambil10 = $koneksi->query("SELECT * FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'Anggota'");
                                    $tampil10 = $ambil10->fetch_array();
                                    ?>
                                      <td width="30%">
                                        <div class="form-group ">
                                          <input type="text" class="form-control" value="<?php if($tampil10['jumlah_pkd']== null){ echo ''; } 
                                            else { echo $tampil10['jumlah_pkd']; } ?>" onkeypress="return hanyaAngka(event)" name="jumlah_pkd">
                                        </div> 
                                      </td>
                                      <td width="30%">
                                        <div class="form-group ">
                                          <input type="text" class="form-control" value="<?php if($tampil10['jumlah_pkd']== null){ echo ''; } 
                                            else { echo $tunj_pkd_tampil = $tampil10['tunj_pkd'] / $tampil10['jumlah_pkd']; } ?>" onkeypress="return hanyaAngka(event)" name="tunj_pkd">
                                        </div> 
                                      </td>
                                    </tbody>
                                  </table>
                                </div>
                              </div>             
                            <div class="text-right">
                              <button class = "btn btn-primary " type="submit" name = "biaya_gaji">Selanjutnya</button> 
                              <button class="btn btn-warning " onclick="goBack()">
                                <i class="fa fa-undo"> Kembali</i>
                              </button>
                            </div>
                          </form>                          
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

      <!-- php biaya gaji -->
      <?php
      if (isset ($_POST ['biaya_gaji']))
      { 
        foreach($_POST['jabatan'] as $key1 => $jabatan){

          $jabatan = mysql_real_escape_string($_POST['jabatan'][$key1]);
          $jumlah = mysql_real_escape_string($_POST['jumlah'][$key1]);
          $gj_pokok = mysql_real_escape_string($_POST['gj_pokok'][$key1]);
          $tunj_jabatan = mysql_real_escape_string($_POST['tunj_jabatan'][$key1]);

          $bpjs_kerja = mysql_real_escape_string($_POST['bpjs_kerja'][$key1]);
          $bpjs_kerja_fix = round($bpjs_kerja * 0.0624, 2);
          $bpjs = mysql_real_escape_string($_POST['bpjs'][$key1]);
          $tunjangan = mysql_real_escape_string($_POST['tunjangan'][$key1]);
          $thr = round($tunjangan / 12 , 3);
          
          $nilai_gaji = round($jumlah * ( $gj_pokok + $tunj_jabatan + $bpjs_kerja_fix + $bpjs + $thr));

          $koneksi->query ("INSERT INTO tbl_biayagaji
            (id_kontrak, id_presentasi, jabatan, jumlah_personil, gaji_pokok, tunj_jabatan, 
            bpjs_kerja, bpjs, tunjangan, nilai_gaji)
            VALUES('$id_kontrak','$id_presentasi','$jabatan','$jumlah','$gj_pokok','$tunj_jabatan',
            '$bpjs_kerja_fix','$bpjs','$thr','$nilai_gaji')");
        }
        $jumlah_pkd = mysql_real_escape_string($_POST['jumlah_pkd']);
        $tunj_pkd = mysql_real_escape_string($_POST['tunj_pkd']);
        $nilai_pkd = $jumlah_pkd * $tunj_pkd;

        $ambil3= $koneksi->query ("SELECT SUM(jumlah_personil) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
        $hasil3 = $ambil3->fetch_array();
        $personil = $hasil3['total'];

        $koneksi->query ("UPDATE tbl_biayagaji SET jumlah_pkd = '$jumlah_pkd', tunj_pkd = '$nilai_pkd' where jabatan = 'Anggota' AND id_kontrak = '$id_kontrak'");
        $koneksi->query ("UPDATE tbl_kontrakclient SET minta_personil = '$personil' where id_kontrak = '$id_kontrak'");

        $ambil4= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak'");
        $hasil4 = $ambil4->fetch_array();
        $total_nilai1 = $hasil4['total'];

        $ambil5= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
        $hasil5 = $ambil5->fetch_array();
        $total_nilai2 = $hasil5['total'];

        $ambil6= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'ANGGOTA'");
        $hasil6= $ambil6->fetch_array();
        $total_nilai3 = $hasil6['total'];

        $nilai_total = $total_nilai1 + $total_nilai2 + $total_nilai3;
        $fee_management = round($nilai_total * 0.1);
        $nilai_fix = $nilai_total + $fee_management;
        
        $ppn = round($nilai_fix * 0.1);
        $nilai_fix_ppn = $ppn + $nilai_fix;
        
        $koneksi->query("UPDATE tbl_kontrakclient SET nilai_kontrak = '$nilai_fix_ppn' WHERE id_kontrak = '$id_kontrak'");

        echo "<script>location='index.php?halaman=ubahnilaigaji&id=$id_kontrak';</script>";
        // echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
        // echo "<script>location='index.php?halaman=kontrakClient';</script>";
      }                     
    ?>



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

<script>
    function goBack() {
        window.history.back();
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

<script>
  var i = 1;
            function additem() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist');
//                membuat element
                var row = document.createElement('tr');

                var jabatan1 = document.createElement('td');
                var jumlah1 = document.createElement('td');
                var gj_pokok1 = document.createElement('td');
                var tunj_jabatan1 = document.createElement('td');
                var bpjs_kerja1 = document.createElement('td');
                var bpjs1 = document.createElement('td');
                var tunjangan1 = document.createElement('td');
                var aksi1 = document.createElement('td');
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(jabatan1);
                row.appendChild(jumlah1);
                row.appendChild(gj_pokok1);
                row.appendChild(tunj_jabatan1);
                row.appendChild(bpjs_kerja1);
                row.appendChild(bpjs1);
                row.appendChild(tunjangan1);
                row.appendChild(aksi1);
//              membuat element input

                var jabatan = document.createElement('select');
                jabatan.setAttribute('name', 'jabatan[' + i + ']');
                jabatan.setAttribute('class', 'form-control');
                jabatan.setAttribute('required', '');
                var option2 = document.createElement("option");
                option2.value = "";
                option2.setAttribute('class', 'text-muted');
                var option3 = document.createElement("option");
                option3.value = "Chief / Supervisor";
                var option4 = document.createElement("option");
                option4.value = "Komandan Regu (DANRU)";
                var option5 = document.createElement("option");
                option5.value = "Anggota";

                var jumlah = document.createElement('input');
                jumlah.setAttribute('name', 'jumlah[' + i + ']');
                jumlah.setAttribute('type', 'text');
                jumlah.setAttribute("onkeypress", "return hanyaAngka(event)")
                jumlah.setAttribute('class', 'form-control');
                jumlah.setAttribute('placeholder', 'Jumlah...');
                jumlah.setAttribute('required', '');
                
                var gj_pokok = document.createElement('input');
                gj_pokok.setAttribute('name', 'gj_pokok[' + i + ']');
                gj_pokok.setAttribute('type', 'text');
                gj_pokok.setAttribute("onkeypress", "return hanyaAngka(event)")
                gj_pokok.setAttribute('class', 'form-control');
                gj_pokok.setAttribute('placeholder', 'Gaji Pokok...');
                gj_pokok.setAttribute('required', '');

                var tunj_jabatan = document.createElement('input');
                tunj_jabatan.setAttribute('name', 'tunj_jabatan[' + i + ']');
                tunj_jabatan.setAttribute('type', 'text');
                tunj_jabatan.setAttribute("onkeypress", "return hanyaAngka(event)")
                tunj_jabatan.setAttribute('class', 'form-control');
                tunj_jabatan.setAttribute('placeholder', 'Tunjangan Jabatan...');
                tunj_jabatan.setAttribute('required', '');

                var bpjs_kerja = document.createElement('input');
                bpjs_kerja.setAttribute('name', 'bpjs_kerja[' + i + ']');
                bpjs_kerja.setAttribute('type', 'text');
                bpjs_kerja.setAttribute("onkeypress", "return hanyaAngka(event)")
                bpjs_kerja.setAttribute('class', 'form-control');
                bpjs_kerja.setAttribute('placeholder', 'BPJS Ketenagakerjaan...');
                bpjs_kerja.setAttribute('required', '');

                var bpjs = document.createElement('input');
                bpjs.setAttribute('name', 'bpjs[' + i + ']');
                bpjs.setAttribute('type', 'text');
                bpjs.setAttribute("onkeypress", "return hanyaAngka(event)")
                bpjs.setAttribute('class', 'form-control');
                bpjs.setAttribute('placeholder', 'BPJS Kesehatan...');
                bpjs.setAttribute('required', '');

                var tunjangan = document.createElement('input');
                tunjangan.setAttribute('name', 'tunjangan[' + i + ']');
                tunjangan.setAttribute('type', 'text');
                tunjangan.setAttribute("onkeypress", "return hanyaAngka(event)")
                tunjangan.setAttribute('class', 'form-control');
                tunjangan.setAttribute('placeholder', 'Tunjangan Hari Raya...');
                tunjangan.setAttribute('required', '');

                var hapus = document.createElement('span');

//              meng append element input

                jabatan1.appendChild(jabatan);
                option2.appendChild(document.createTextNode("-- PILIH JABATAN --"));
                jabatan.appendChild(option2);
                option3.appendChild(document.createTextNode("Chief / Supervisor"));
                jabatan.appendChild(option3);
                option4.appendChild(document.createTextNode("Komandan Regu (DANRU)"));
                jabatan.appendChild(option4);
                option5.appendChild(document.createTextNode("Anggota"));
                jabatan.appendChild(option5);

                jumlah1.appendChild(jumlah);
                gj_pokok1.appendChild(gj_pokok);
                tunj_jabatan1.appendChild(tunj_jabatan);
                bpjs_kerja1.appendChild(bpjs_kerja);
                bpjs1.appendChild(bpjs);
                tunjangan1.appendChild(tunjangan);
                aksi1.appendChild(hapus);
                hapus.innerHTML = '<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
                
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
                i++;
            }
</script>
