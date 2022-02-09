<?php
  $ambil = $koneksi->query("SELECT * FROM tbl_kontrakclient WHERE id_kontrak = '$_GET[id]'");
  $tampil = $ambil->fetch_assoc();
  $id_presentasi = $tampil['id_presentasi'];
?>
<?php
  $ambil2 = $koneksi->query("SELECT * FROM tbl_presentasiclient WHERE id_presentasi = '$id_presentasi'");
  $tampil2 = $ambil2->fetch_assoc();
?>


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
              <h3 class="box-title">Ubah data client yang terkontrak</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" id="ubahkontrak" method="POST">
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Nama Perusahaan</strong></p>
                  <label for="">Nama Perusahaan</label>
                  <input type="text" class="form-control" name="perusahaan" value="<?php echo $tampil2 ['nama_perusahaan'];?>" disabled>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Pemilik Perusahaan</strong></p>
                  <label for="">Pemilik Perusahaan</label>
                  <input type="text" class="form-control" name="pemilik" value="<?php echo $tampil2 ['pemilik_perusahaan'];?>" disabled>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Alamat Perusahaan</strong></p>
                  <label>Alamat Perusahaan</label>
                  <textarea class="form-control" rows="1" name="alamat" disabled><?php echo $tampil2 ['alamat_perusahaan'];?> </textarea>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Telp Perusahaan</strong></p>
                  <label>Telp Perusahaan</label>
                  <input type="number" class="form-control" name="telp" placeholder="Telp Perusahaan ..." value="<?php echo $tampil2 ['telp_perusahaan'];?>" disabled>
                </div>  
                <div class="form-group float-label-control">
                  <p><strong>Email Perusahaan</strong></p>
                  <label>Email Perusahaan</label>
                  <input type="email" class="form-control" name="email" placeholder="Email Perusahaan ..." value="<?php echo $tampil2 ['email_perusahaan'];?>" disabled>
                </div>
                <!-- Date -->
                <div class="form-group">
                  <label>Mulai Kontrak:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="awal" class="form-control pull-right" id="datepicker" value="<?php echo date('m/d/Y', strtotime($tampil['mulai_kontrak'])); ?>" required>
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
                    <input type="text" name="akhir" class="form-control pull-right" onchange="cal()" id="datepicker2" value="<?php echo date('m/d/Y', strtotime($tampil['akhir_kontrak'])); ?>" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
                <!-- /.form group -->
                <div class="form-group float-label-control">
                  <p><strong>Status</strong></p>
                  <label for="">Status</label>
                  <input type="text" class="form-control" name="status" id="status" value="<?php echo $tampil ['status'];?>" readonly>
                </div> 
                <!-- money mask -->
                <div class="form-group">
                <label>Nilai Kontrak</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i>Rp.</i>
                    </div>
                    <input type="text" name="nilai" class="form-control" value="<?php if($tampil['nilai_kontrak']== null){ echo '0'; } else { echo number_format($tampil['nilai_kontrak'], 0 ,'.','.'); } ?>" required disabled>
                  </div><br>
                  <!-- /.input group -->
                  <div>
                    <a href="?halaman=ubahnilaigaji&id=<?php echo $tampil['id_kontrak']; ?>" type="button" class="btn btn-default" >
                      Ubah Nilai Biaya Gaji
                    </a>
                    <a href="?halaman=ubahnilaipendukung&id=<?php echo $tampil['id_kontrak']; ?>" type="button" class="btn btn-default" >
                      Ubah Nilai Biaya Pendukung
                    </a>
                  </div>
                </div>
                <!-- /.form group -->
                <div class="form-group float-label-control">
                  <p><strong>Jumlah Permintaan Personil</strong></p>
                  <label>Jumlah Permintaan Personil</label>
                  <input type="number" name="personil" class="form-control" value="<?php echo $tampil ['minta_personil'];?>" readonly>
                </div>
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" id="mybtn" name="ubah" disabled>Perbaharui</button> 
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


    <!-- Start PHP UPDATE DATA-->
    <?php
      if (isset($_POST['ubah']))
        {   
          $tanggal1 = mysql_real_escape_string($_POST['awal']);
          $mulai_kontrak = date('Y-m-d',strtotime($tanggal1));
          $tanggal2 = mysql_real_escape_string($_POST['akhir']);
          $akhir_kontrak = date('Y-m-d',strtotime($tanggal2));
          $status = mysql_real_escape_string($_POST['status']);
          $personil = mysql_real_escape_string($_POST['personil']);

          $koneksi->query("UPDATE tbl_kontrakclient SET mulai_kontrak = '$mulai_kontrak' , 
          akhir_kontrak = '$akhir_kontrak', status = '$status', minta_personil = '$personil'
          WHERE id_kontrak = '$_GET[id]'");
    
          echo "<script type='text/javascript'>alert('Data telah diupdate');</script>";
          echo "<script>location='?halaman=kontrakClient';</script>";
                      
        }
    ?>
    <!-- /.end php -->

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

<!-- SCRIPT EXTERNAL DISBALED BUTTON-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

<!-- DISABLED BUTTON PASSWORD -->
<script >
  $(document).ready(function() {
  $('#ubahkontrak').on('input change', function() {
    $('#mybtn').attr('disabled', false);
  });
})
</script>

<script>
$(document).ready(function(){
    $('#datepicker').datepicker({
      dateFormat: 'dd-mm-yy',
      autoclose: true
    }).val();
    //Date picker
    $('#datepicker2').datepicker({
      dateFormat: 'dd-mm-yy',
      autoclose: true
    }).val();
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
