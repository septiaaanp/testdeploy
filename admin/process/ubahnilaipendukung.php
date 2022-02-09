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
        $ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_kontrak = '$_GET[id]'");
        $tampil = $ambil->fetch_assoc();
        $id_presentasi = $tampil['id_presentasi'];
        $id_kontrak = $tampil['id_kontrak'];

        $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient where id_presentasi = '$id_presentasi'");
        $tampil2 = $ambil2->fetch_assoc();
    ?>
    
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Ubah Nilai Pendukung <?php echo $tampil2['nama_perusahaan'];?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                    <div class="box-body">
                      <div class="">
                        <a href="?halaman=selanjutnyaupdate2&client=<?php echo $tampil2['nama_perusahaan'];?>" 
                          type="button" class="btn btn-primary btn-sm" name="tambah">
                          <span class=" glyphicon glyphicon-plus"></span> Tambah nilai pendukung
                        </a>
                      </div><br>
                      <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="box box-primary">
                            
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

                                <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_biayapendukung where id_kontrak = '$id_kontrak'");?>
                                <?php while ($tampil3 = $ambil3->fetch_array()){ ?>
                                    <tr>
                                        <td>
                                          <!-- select -->
                                          <div class="form-group ">
                                            <input type="text" class="form-control" name="kategori" value="<?php echo $tampil3['kategori'];?>" required disabled>
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" name="keterangan" value="<?php echo $tampil3['keterangan'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="total" 
                                            value="<?php echo $tampil3['total'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="harga" 
                                            value="<?php echo $tampil3['harga'];?>" required disabled>             
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group ">
                                            <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="qty" 
                                            value="<?php echo $tampil3['qty'];?>" required disabled>
                                          </div> 
                                        </td>
                                        <td> 
                                          <a class="btn btn-sm btn-success but_apply" data-toggle="modal" data-target="#modal-default<?php echo $tampil3['id_biaya']?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                          </a>
                                          <a href = "?halaman=hapusnilaipendukung&id=<?php echo $tampil3['id_biaya']; ?>" 
                                            class = "btn btn-danger btn-sm" 
                                            onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')">
                                            <span class="glyphicon glyphicon-trash"></span>
                                          </a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <?php $ambil3 = $koneksi->query("SELECT * FROM tbl_biayapendukung where id_kontrak = '$id_kontrak'");
                                    ?>
                                    <?php while ($tampil3 = $ambil3->fetch_array()){ ?>

                                    <!-- awal modal -->
                                    <div class="modal fade" id="modal-default<?php echo $tampil3['id_biaya']?>">

                                    <form method="post" autocomplete="off">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Ubah Nilai Pendukung</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div hidden>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                                name="id_biaya" value="<?php echo $tampil3['id_biaya'];?>" required>
                                            </div>
                                            <div class="form-group ">
                                                <p><strong>Kategori</strong> <small class="text-danger">*libur nasional tulis "Hari Libur Nasional"</small></p>
                                                <input type="text" class="form-control" name="kategori" value="<?php echo $tampil3['kategori'];?>" required>
                                            </div>
                                            <div class="form-group ">
                                                <p><strong>Keterangan</strong></p>
                                                <input type="text" class="form-control" name="keterangan" value="<?php echo $tampil3['keterangan'];?>" required >
                                            </div>
                                            <div class="form-group ">
                                                <p><strong>Total</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="total" 
                                                value="<?php echo $tampil3['total'];?>" required>
                                            </div>
                                            <div class="form-group ">
                                                <p><strong>Harga</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="harga" 
                                                value="<?php echo $tampil3['harga'];?>" required>             
                                            </div>
                                            <div class="form-group ">
                                                <p><strong>Qty</strong></p>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" name="qty" 
                                                value="<?php echo $tampil3['qty'];?>" required>
                                            </div>   
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
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
                                        if(isset($_POST['update'])){
                                            $id_biaya = mysql_real_escape_string($_POST['id_biaya']);
                                            $kategori = mysql_real_escape_string($_POST['kategori']);
                                            $keterangan = mysql_real_escape_string($_POST['keterangan']);
                                            $total = mysql_real_escape_string($_POST['total']);
                                            $harga = mysql_real_escape_string($_POST['harga']);
                                            $qty = mysql_real_escape_string($_POST['qty']);
                                                                                        
                                            $nilai_pendukung = round($total * $harga / $qty );
                                            
                                            $koneksi->query("UPDATE tbl_biayapendukung SET id_kontrak='$id_kontrak', id_presentasi='$id_presentasi', kategori='$kategori',
                                            keterangan='$keterangan', total='$total', harga='$harga', qty='$qty', nilai_pendukung= '$nilai_pendukung' WHERE id_biaya='$id_biaya'");
                                  
                                            echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
                                            echo "<script>location='index.php?halaman=ubahnilaipendukung&id=$id_kontrak';</script>";
                                        }                                    
                                    ?>

                                  </tbody>
                                  <tfoot>
                                    <th colspan="6"></th>                        
                                  </tfoot>
                              </table>

                              <?php

                                $ambil11= $koneksi->query ("SELECT * FROM tbl_biayapendukung where id_kontrak = '$id_kontrak' AND kategori='Hari Libur Nasional'");
                                $hasil11 = $ambil11->fetch_array();
                                $total2 = $hasil11['total'];
                                $harga2 = $hasil11['harga'];
                                $qty2 = $hasil11['qty'];
                                $libur = $hasil11['jumlah_libur'];
                                
                                $nilai_pendukung2 = @round($total2 * $harga2 / $qty2 );

                                //khusus libur nasional
                                $khusus_libur = $nilai_pendukung2 * $libur;
                                
                                $koneksi->query ("UPDATE tbl_biayapendukung SET jumlah_libur = '$libur', nilai_pendukung = '$khusus_libur' 
                                where id_kontrak = '$id_kontrak' AND kategori = 'Hari Libur Nasional'");

                                $ambil5= $koneksi->query ("SELECT SUM(nilai_gaji) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak'");
                                $hasil5 = $ambil5->fetch_array();
                                $total_nilai1 = $hasil5['total'];

                                $ambil6= $koneksi->query ("SELECT SUM(tunj_pkd) AS total FROM tbl_biayagaji WHERE id_kontrak = '$id_kontrak' AND jabatan = 'ANGGOTA'");
                                $hasil6= $ambil6->fetch_array();
                                $total_nilai2 = $hasil6['total'];

                                $ambil7= $koneksi->query ("SELECT SUM(nilai_pendukung) AS total FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak'");
                                $hasil7= $ambil7->fetch_array();
                                $total_nilai3 = $hasil7['total'];

                                $nilai_total = $total_nilai1 + $total_nilai2 + $total_nilai3;
                                $fee_management = round($nilai_total * 0.1);
                                $nilai_fix = $nilai_total + $fee_management;

                                $ppn = round($nilai_fix * 0.1);
                                $nilai_fix_ppn = $ppn + $nilai_fix;

                                $koneksi->query("UPDATE tbl_kontrakclient SET nilai_kontrak = '$nilai_fix_ppn'
                                WHERE id_kontrak = '$id_kontrak'");                              
                              ?>

                              <div>                              
                                Jumlah libur nasional input disini: 
                                <div class="row">
                                    <?php
                                    $ambil9 = $koneksi->query("SELECT * FROM tbl_biayapendukung WHERE id_kontrak = '$id_kontrak' AND kategori = 'Hari Libur Nasional'");
                                    $tampil9 = $ambil9->fetch_array();
                                    ?>
                                  <div class="col-md-3"> 
                                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="libur" 
                                    value="<?php if($tampil9['jumlah_libur']== null){ echo '0'; }
                                    else { echo $tampil9['jumlah_libur']; } ?>" disabled> 
                                  </div>
                                  <div class="col-md-3">
                                    <a class="btn btn-sm btn-success but_apply" data-toggle="modal" data-target="#modal-default2<?php echo $tampil9['id_biaya']?>">
                                      <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="?halaman=hapusnilaipendukung&id=<?php echo $tampil9['id_biaya']; ?>" 
                                      class="btn btn-danger btn-sm" 
                                      onclick="javascript: return confirm('Apakah anda yakin menghapus data tersebut?')">
                                      <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                  </div>
                                </div>
                              </div>

                              <div class="modal fade" id="modal-default2<?php echo $tampil9['id_biaya']?>">
                              <form method="post" autocomplete="off">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Ubah Jumlah Libur Nasional</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div hidden>
                                                <input type="text" class="form-control" onkeypress="return hanyaAngka(event)" 
                                                name="id_biaya2" value="<?php echo $tampil9['id_biaya'];?>" required>
                                        </div>
                                        <div class=""> 
                                            <p><strong>Jumlah Libur Nasional</strong></p>
                                            <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="libur" 
                                            value="<?php if($tampil9['jumlah_libur']== null){ echo '0'; }
                                            else { echo $tampil9['jumlah_libur']; } ?>"> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Keluar</button>
                                        <button type="submit" name="update_libur" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </form>
                              </div>
                              <!-- /.modal -->

                              <?php
                                if(isset($_POST['update_libur'])){
                                    $id_biaya = mysql_real_escape_string($_POST['id_biaya2']);
                                    $jml_libur = mysql_real_escape_string($_POST['libur']);

                                    $ambil10= $koneksi->query ("SELECT * FROM tbl_biayapendukung where id_kontrak = '$id_kontrak' AND kategori='Hari Libur Nasional'");
                                    $hasil10 = $ambil10->fetch_array();
                                    $libur = $hasil10['jumlah_libur'];
                                    $nilai = $hasil10['nilai_pendukung'];
                                    $libur_nas = $nilai / $libur;

                                    $nilai_update = $libur_nas * $jml_libur;
                                    $koneksi->query ("UPDATE tbl_biayapendukung SET jumlah_libur = '$jml_libur', nilai_pendukung = '$nilai_update' 
                                    where id_kontrak = '$id_kontrak' AND kategori = 'Hari Libur Nasional'");
                                    
                                    echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
                                    echo "<script>location='index.php?halaman=ubahnilaipendukung&id=$id_kontrak';</script>";
                                }                              
                              ?>
                                                          
                              <div class="text-right">                                 
                                <a href="?halaman=ubahkontrakclient&id=<?php echo $id_kontrak?>" class="btn btn-warning">
                                    <i class="fa fa-undo"> Kembali</i>
                                </a>
                              </div>                         
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