
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
        <li>Data Personil</li>
        <li>Absensi Personil</li>
        <li>Lihat Absensi Personil</li>
        <li class="Active">Tambah Absensi Personil</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Absensi Personil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <?php
            $ambil = $koneksi->query("SELECT * FROM tbl_daftarpersonil WHERE id_personil = '$_GET[id]'");
            $tampil = $ambil->fetch_assoc();
            ?>

              <form role="form" autocomplete="off" method="POST">
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Nama</strong></p>
                  <label for="">Nama</label>
                  <input type="text" class="form-control" name="nama" value="<?php echo $tampil['nama']?>" readonly>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Kehadiran</strong></p>
                  <label for="">Kehadiran</label>
                  <select class="form-control" name="kehadiran" required>
                    <option value="" class="text-muted">-- Pilih --</option>
                    <option value="Alpha">Alpha</option>
                    <option value="Cuti">Cuti</option>
                    <option value="Hadir">Hadir</option>
                    <option value="Izin">Izin</option>
                    <option value="Sakit">Sakit</option>
                  </select>  
                </div> 
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                    <label>Jam Masuk:</label>
                    <div class="input-group" >
                        <input type="text" name="masuk" class="form-control timepicker" value="9:00">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <?php
                    date_default_timezone_set("Asia/Jakarta");
                    $currentTime = date("H:i")
                ?>
                <div class="bootstrap-timepicker">
                    <div class="form-group">
                    <label>Jam Keluar:</label>
                    <div class="input-group" >
                        <input type="text" name="keluar" class="form-control timepicker" value="<?php echo $currentTime?>">

                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Absensi:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" value="<?php echo date("m/d/Y")?>" name="tanggal" id="datepicker" required>
                  </div>
                  <!-- /.input group -->
                </div>
                Jika absen backup klik disini: <input type="checkbox" id="myCheck" name="backup" value="backup" onclick="myFunction()">
                <br><br>
                <div id="text" style="display:none"> 
                  <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Masukkan nominal tambahan backup</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="">Rp.</i>
                              </div>
                              <input type="text" value="0" class="form-control pull-right" name="uang_backup" placeholder="Masukkan nominal tambahan backup">
                            </div>
                            <!-- /.input group -->
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name = "simpan">Simpan</button> 
                  <a href="?halaman=lihatAbsensi&id=<?php echo $_GET['id']?>" class="btn btn-warning btn-sm" role="button">Batal</a>
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
      if (isset ($_POST ['simpan']))
      {
          $id_personil = $_GET['id'];
          $kehadiran = mysql_real_escape_string($_POST['kehadiran']);
          $masuk = mysql_real_escape_string($_POST['masuk']);
          $keluar = mysql_real_escape_string($_POST['keluar']);
          $tanggal = mysql_real_escape_string($_POST['tanggal']);
          $tgl_absen = date('Y-m-d',strtotime($tanggal));
          $backup= mysql_real_escape_string($_POST['backup']);
          $bonus_backup= mysql_real_escape_string($_POST['uang_backup']);

          $sql_get = $koneksi->query("SELECT * FROM tbl_absensi where id_personil = '$id_personil' and tgl_absensi = '$tgl_absen'");
          $num_row = $sql_get->num_rows;

          if ($num_row == 0){
            $koneksi->query ("INSERT INTO tbl_absensi
            (id_personil, kehadiran, waktu_masuk, waktu_keluar, tgl_absensi, backup, bonus)
            VALUES('$id_personil','$kehadiran','$masuk','$keluar','$tgl_absen', '$backup', '$bonus_backup')");
  
            echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
            echo "<script>location='index.php?halaman=lihatAbsensi&id=$id_personil';</script>";
          }else{
            echo "<script type='text/javascript'>alert('Absensi hari ini sudah terinput!');</script>";
            echo "<script>location='?halaman=tambahAbsensi&id=$id_personil';</script>";
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


<script>
  $(function () {

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
  //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false,
      minuteStep : 1
    })
    
  })
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
