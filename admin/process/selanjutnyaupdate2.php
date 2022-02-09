<link href="assets/css/float-label.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
 <!-- DataTables -->
 <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

  <style>
    .dtHorizontalVerticalExampleWrapper {
    max-width: 600px;
    margin: 0 auto;
    }
    #dtHorizontalVerticalExample2 th, td {
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
        Form Input
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Data Client</li>
        <li>Kontrak Client</li>
        <li class="active">Form Input</li>
      </ol>
    </section>

    <?php
     $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$_REQUEST[client]'");
     $tampil2 = $ambil2->fetch_assoc();
     $nama = $tampil2['nama_perusahaan'];
     $id_presentasi = $tampil2['id_presentasi'];

     $ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_presentasi'");
     $tampil = $ambil->fetch_assoc();
     $id_kontrak = $tampil['id_kontrak'];
    ?>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Input Nilai Kontrak <?php echo $tampil2['nama_perusahaan'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="box-body">
                      <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="box box-primary">
                            <form role="form" autocomplete="off" method="POST" action="">
                              <table id="dtHorizontalVerticalExample2" class="table table-striped table-bordered table-sm " cellspacing="0"
                              width="100%"> 
                                <thead>
                                  <tr>
                                    <th>Kategori <small class="text-danger">*libur nasional tulis "Hari Libur Nasional"</small></th>
                                    <th>Keterangan</th>
                                    <th>Total</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="itemlist2">
                                    <tr>
                                        <td>
                                          <!-- select -->
                                          <div class="form-group ">
                                            <input type="text" class="form-control" name="kategori[]" placeholder="Kategori ..." required>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" name="keterangan[]" placeholder="Keterangan ..." required>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="total[]" placeholder="Total ..." required>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="harga[]" placeholder="Harga ..." required>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="qty[]" placeholder="Qty ..." required>
                                          </div> 
                                        </td>
                                        <td> 
                                          
                                        </td>
                                    </tr>
                                  </tbody>
                                  <tfoot>
                                    <th colspan="5"></th>
                                    <th>
                                      <button class="btn btn-sm btn-primary" onclick="additem2(); return false">
                                        <span class=" glyphicon glyphicon-plus"></span>
                                      </button>
                                    </th>
                                  </tfoot>
                              </table>
                              <div>
                                Jumlah libur nasional input disini: <input type="checkbox" id="myCheck" onclick="myFunction()">
                                <div class="row">
                                  <?php
                                   $ambil9 = $koneksi->query("SELECT * FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak' AND kategori = 'Hari Libur Nasional'");
                                   $tampil9 = $ambil9->fetch_array();
                                  ?>
                                  <div class="col-md-3" id="text" style="display:none"> 
                                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="libur" value="<?php echo $tampil9['jumlah_libur']?>">
                                  </div>
                                </div>
                              </div>                             
                            <div class="text-right">
                              <button class = "btn btn-primary " type="submit" name = "biaya_pendukung">Simpan</button> 
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
      if (isset ($_POST ['biaya_pendukung']))
      { 
          foreach($_POST['kategori'] as $key2 => $kategori){

            $kategori = mysql_real_escape_string($_POST['kategori'][$key2]);
            $keterangan = mysql_real_escape_string($_POST['keterangan'][$key2]);
            $total = mysql_real_escape_string($_POST['total'][$key2]);
            $harga = mysql_real_escape_string($_POST['harga'][$key2]);
            $qty = mysql_real_escape_string($_POST['qty'][$key2]);

            $nilai_pendukung = round($total * $harga / $qty);

            $koneksi->query ("INSERT INTO tbl_biayapendukung
            (id_kontrak, id_presentasi, kategori, keterangan, total, harga, qty, nilai_pendukung)
              VALUES('$id_kontrak','$id_presentasi','$kategori','$keterangan','$total','$harga','$qty',$nilai_pendukung)");
          }
          $libur = mysql_real_escape_string($_POST['libur']);
          $ambil5= $koneksi->query ("SELECT * FROM tbl_biayapendukung where id_kontrak = '$id_kontrak' AND 
            kategori = 'Hari Libur Nasional'");
          $hasil5 = $ambil5->fetch_array();
          $total_lama = $hasil5['total'];
          $harga_lama = $hasil5['harga'];
          $qty_lama = $hasil5['qty'];

          $nilai_pendukung_lama = @round($total_lama * $harga_lama / $qty_lama);

          $nilai_update = $nilai_pendukung_lama * $libur;
          $koneksi->query ("UPDATE tbl_biayapendukung SET jumlah_libur = '$libur', nilai_pendukung = '$nilai_update' 
            where id_kontrak = '$id_kontrak' AND kategori = 'Hari Libur Nasional'");
          
          $ambil3= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak'");
          $hasil3 = $ambil3->fetch_array();
          $total_nilai1 = $hasil3['total'];

          $ambil2= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
          $hasil2 = $ambil2->fetch_array();
          $total_nilai2 = $hasil2['total'];

          $ambil4= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'ANGGOTA'");
          $hasil4= $ambil4->fetch_array();
          $total_nilai3 = $hasil4['total'];

          $nilai_total = $total_nilai1 + $total_nilai2 + $total_nilai3;
          $fee_management = round($nilai_total * 0.1);
          $nilai_fix = $nilai_total + $fee_management;

          $ppn = round($nilai_fix * 0.1);
          $nilai_fix_ppn = $ppn + $nilai_fix;
          
          $koneksi->query("UPDATE tbl_kontrakclient SET nilai_kontrak = '$nilai_fix_ppn'
          WHERE id_kontrak = '$id_kontrak'");

          echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
          echo "<script>location='index.php?halaman=ubahnilaipendukung&id=$id_kontrak';</script>";
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
$('#dtHorizontalVerticalExample2').DataTable({
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

<!-- FORM DINAMIS 2 -->
<script>
  var i = 1;
            function additem2() {
//                menentukan target append
                var itemlist = document.getElementById('itemlist2');
//                membuat element
                var row = document.createElement('tr');

                var kategori1 = document.createElement('td');
                var keterangan1 = document.createElement('td');
                var total1 = document.createElement('td');
                var harga1 = document.createElement('td');
                var qty1 = document.createElement('td');
                var aksi1 = document.createElement('td');
//                meng append element
                itemlist.appendChild(row);
                row.appendChild(kategori1);
                row.appendChild(keterangan1);
                row.appendChild(total1);
                row.appendChild(harga1);
                row.appendChild(qty1);
                row.appendChild(aksi1);
//              membuat element input

                var kategori = document.createElement('input');
                kategori.setAttribute('name', 'kategori[' + i + ']');
                kategori.setAttribute('type', 'text');
                kategori.setAttribute('class', 'form-control');
                kategori.setAttribute('placeholder', 'Kategori ...');
                kategori.setAttribute('required', '');

                
                var keterangan = document.createElement('input');
                keterangan.setAttribute('name', 'keterangan[' + i + ']');
                keterangan.setAttribute('type', 'text');
                keterangan.setAttribute('class', 'form-control');
                keterangan.setAttribute('placeholder', 'Keterangan ...');
                keterangan.setAttribute('required', '');

                var total = document.createElement('input');
                total.setAttribute('name', 'total[' + i + ']');
                total.setAttribute('type', 'text');
                total.setAttribute("onkeypress", "return hanyaAngka(event)")
                total.setAttribute('class', 'form-control');
                total.setAttribute('placeholder', 'Total ...');
                total.setAttribute('required', '');

                var harga = document.createElement('input');
                harga.setAttribute('name', 'harga[' + i + ']');
                harga.setAttribute('type', 'text');
                harga.setAttribute("onkeypress", "return hanyaAngka(event)")
                harga.setAttribute('class', 'form-control');
                harga.setAttribute('placeholder', 'Harga ...');
                harga.setAttribute('required', '');

                var qty = document.createElement('input');
                qty.setAttribute('name', 'qty[' + i + ']');
                qty.setAttribute('type', 'text');
                qty.setAttribute("onkeypress", "return hanyaAngka(event)")
                qty.setAttribute('class', 'form-control');
                qty.setAttribute('placeholder', 'Qty ...');
                qty.setAttribute('required', '');

                var hapus = document.createElement('span');

//              meng append element input

                kategori1.appendChild(kategori);
                keterangan1.appendChild(keterangan);
                total1.appendChild(total);
                harga1.appendChild(harga);
                qty1.appendChild(qty);
                aksi1.appendChild(hapus);
                hapus.innerHTML = '<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
                
//                membuat aksi delete element
                hapus.onclick = function () {
                    row.parentNode.removeChild(row);
                };
                i++;
            }
</script>