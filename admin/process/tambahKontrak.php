<!-- Custom CSS -->
<link href="assets/css/float-label.css" rel="stylesheet">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

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
          <!-- general form elements disabled -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Client yang sudah terkontrak</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" method="POST">
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Nama Perusahaan</strong></p>
                  <label>Nama Perusahaan</label>
                  <select class="form-control" name="perusahaan" onchange='changeValue(this.value)' required>
                    <option value="" class="text-muted">-- PILIH NAMA PERUSAHAAN / CLIENT --</option>

                    <?php 
                    
                      $query= $koneksi->query("SELECT * FROM tbl_presentasiclient
                      WHERE status='Berhasil' order by id_presentasi asc;"); 
      
                      $jsArray = "var prdName = new Array();\n";
                      while ($row = $query->fetch_array()) {  
                      echo '<option name="nama_perusahaan"  value="' . $row['nama_perusahaan'] . '">' . $row['nama_perusahaan'] . '</option>';  
                      $jsArray .= "prdName['" . $row['nama_perusahaan'] . "'] = { pemilik_perusahaan:'" . addslashes($row['pemilik_perusahaan']) . "',
                      alamat_perusahaan:'" . addslashes($row['alamat_perusahaan']) . "', telp_perusahaan:'" . addslashes($row['telp_perusahaan']) . "',
                      email_perusahaan:'" . addslashes($row['email_perusahaan']) . "' };\n";   
                      }
                    ?>

                  </select>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Pemilik Perusahaan</strong></p>
                  <label for="">Pemilik Perusahaan</label>
                  <input type="text" class="form-control" name="pemilik" placeholder="Pemilik Perusahaan ..." id="pemilik_perusahaan" readonly required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Alamat Perusahaan</strong></p>
                  <label>Alamat Perusahaan</label>
                  <textarea class="form-control" rows="1" name="alamat" placeholder="Alamat Perusahaan ..." id="alamat_perusahaan" readonly required></textarea>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Telp Perusahaan</strong></p>
                  <label>Telp Perusahaan</label>
                  <input type="number" class="form-control" name="telp" placeholder="Telp Perusahaan ..." id="telp_perusahaan" readonly required>
                </div>  
                <div class="form-group float-label-control">
                  <p><strong>Email Perusahaan</strong></p>
                  <label>Email Perusahaan</label>
                  <input type="email" class="form-control" name="email" placeholder="Email Perusahaan ..." id="email_perusahaan" readonly required>
                </div>
                <!-- Date -->
                <div class="form-group">
                  <label>Mulai Kontrak:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="awal" class="form-control pull-right" id="datepicker" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- Date -->
                <div class="form-group">
                  <label>Akhir Kontrak Kontrak:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="akhir" class="form-control pull-right" id="datepicker2" onchange="cal()" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <div class="form-group float-label-control">
                  <p><strong>Status</strong></p>
                  <label for="">Status</label>
                  <input type="text" class="form-control" id="status" name="status" readonly required>
                </div> 
                <!-- money mask -->
                <!-- <div class="form-group">
                <label>Nilai Kontrak</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i>Rp.</i>
                    </div>
                    <input type="text" id="angka4" name="nilai" class="form-control" required >
                  </div>
                </div> -->
                <!-- /.form group --> 
                <!-- <div class="form-group float-label-control">
                  <p><strong>Jumlah Permintaan Personil</strong></p>
                  <label>Jumlah Permintaan Personil</label>
                  <input type="number" name="personil" class="form-control" required>
                </div> -->
                <!-- <div class="form-group ">
                  <label>Pilih Posisi Yang Diminta</label><br>
                  <input type="checkbox" name="chief" value="ya" > Chief &emsp; 
                  <input type="checkbox" name="komandan_regu"> Komandan Regu <br>
                  <input type="checkbox" name="anggota" value="ya" > Anggota <br>
                </div> -->
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name= "lanjut">Lanjut</button> 
                  <a class="btn btn-warning btn-sm" href="?halaman=kontrakClient" role="button">Batal</a>
              </div> 
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    <?php
      if (isset ($_POST ['lanjut']))
      { 
        
        $nama = mysql_real_escape_string($_POST['perusahaan']);
        $tanggal1 = mysql_real_escape_string($_POST['awal']);
        $mulai_kontrak = date('Y-m-d',strtotime($tanggal1));
        $tanggal2 = mysql_real_escape_string($_POST['akhir']);
        $akhir_kontrak = date('Y-m-d',strtotime($tanggal2));

        $status = mysql_real_escape_string($_POST['status']);

        $ambil= $koneksi->query ("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$nama'");
        $hasil = $ambil->fetch_array();
        $id_perusahaan = $hasil['id_presentasi'];
      
        $sql_get = $koneksi->query("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_perusahaan'");
        $num_row = $sql_get->num_rows;
        //fungsi script ini adalah untuk mengecek ketersediaan username, jika tidak tersedia maka program tdk akan berjalan    
        if ($num_row == 0){
            
          $koneksi->query ("INSERT INTO tbl_kontrakclient
          (id_presentasi, mulai_kontrak, akhir_kontrak, status)
          VALUES('$id_perusahaan', '$mulai_kontrak', '$akhir_kontrak', '$status')");
          
           //echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
            echo "<script>location='index.php?halaman=selanjutnya&client=$nama';</script>"; 

        }else {
            echo "<script type='text/javascript'>alert('Nama Perusahaan tidak boleh sama');</script>";
            echo "<script>location='?halaman=tambahKontrak';</script>";
        }
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<script>//status kontrak
 var todaydate = new Date();
   var day = todaydate.getDate();
   var month = todaydate.getMonth() + 1;
   var year = todaydate.getFullYear();
   var datestring =month  + "/" +  day+ "/" + year;
   

  
  function GetDays(){

    var dropdt = new Date(document.getElementById("datepicker2").value);
    var pickdt = new Date(document.getElementById("datepicker").value);
                
    var dateDifference = Math.floor((Date.UTC(dropdt.getFullYear(), dropdt.getMonth(), 
    dropdt.getDate()) - Date.UTC(pickdt.getFullYear(), pickdt.getMonth(), pickdt.getDate())) / (1000 * 60 * 60 * 24));

    return dateDifference;
    }

  function cal(){
    if (GetDays() >= 0) { document.getElementById('status').value = "Terkontrak"; } 
    else { document.getElementById('status').value = "Tidak Terkontrak"; } 
    }
</script>

<script> 
<?php echo $jsArray; ?>
function changeValue(nama_perusahaan){
      if (nama_perusahaan == 0) {
        document.getElementById('pemilik_perusahaan').value = "";
        document.getElementById('alamat_perusahaan').value = "";
        document.getElementById('telp_perusahaan').value = "";
        document.getElementById('email_perusahaan').value = "";
      } else {
        document.getElementById('pemilik_perusahaan').value = prdName[nama_perusahaan].pemilik_perusahaan;
        document.getElementById('alamat_perusahaan').value = prdName[nama_perusahaan].alamat_perusahaan;
        document.getElementById('telp_perusahaan').value = prdName[nama_perusahaan].telp_perusahaan;
        document.getElementById('email_perusahaan').value = prdName[nama_perusahaan].email_perusahaan;
      }
    
};
</script>


<script>
$(document).ready(function(){
			 //Date picker
       $('#datepicker').datepicker({
      autoclose: true
    });
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    });
     $('#angka4').maskMoney({ thousands:'.', decimal:',', precision:0});
		});

</script>

<script>
/* Float Label Pattern Plugin for Bootstrap 3.1.0 by Travis Wilson
**************************************************/

(function ($) {
    $.fn.floatLabels = function (options) {

        // Settings
        var self = this;
        var settings = $.extend({}, options);


        // Event Handlers
        function registerEventHandlers() {
            self.on('input keyup change', 'input, textarea', function () {
                actions.swapLabels(this);
            });
        }


        // Actions
        var actions = {
            initialize: function() {
                self.each(function () {
                    var $this = $(this);
                    var $label = $this.children('label');
                    var $field = $this.find('input,textarea').first();

                    if ($this.children().first().is('label')) {
                        $this.children().first().remove();
                        $this.append($label);
                    }

                    var placeholderText = ($field.attr('placeholder') && $field.attr('placeholder') != $label.text()) ? $field.attr('placeholder') : $label.text();

                    $label.data('placeholder-text', placeholderText);
                    $label.data('original-text', $label.text());

                    if ($field.val() == '') {
                        $field.addClass('empty')
                    }
                });
            },
            swapLabels: function (field) {
                var $field = $(field);
                var $label = $(field).siblings('label').first();
                var isEmpty = Boolean($field.val());

                if (isEmpty) {
                    $field.removeClass('empty');
                    $label.text($label.data('original-text'));
                }
                else {
                    $field.addClass('empty');
                    $label.text($label.data('placeholder-text'));
                }
            }
        }


        // Initialization
        function init() {
            registerEventHandlers();

            actions.initialize();
            self.each(function () {
                actions.swapLabels($(this).find('input,textarea').first());
            });
        }
        init();


        return this;
    };

    $(function () {
        $('.float-label-control').floatLabels();
    });
})(jQuery);
</script>
