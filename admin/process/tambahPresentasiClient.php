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
        <li>Presentasi Client</li>
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
              <h3 class="box-title">Tambah Client yang lolos presentasi atau tidak</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" method="POST">
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Nama Perusahaan</strong></p>
                  <label for="">Nama Perusahaan</label>
                  <input type="text" class="form-control" name="perusahaan" placeholder="Nama Perusahaan ..." required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Pemilik Perusahaan</strong></p>
                  <label for="">Pemilik Perusahaan</label>
                  <input type="text" class="form-control" name="pemilik" placeholder="Pemilik Perusahaan ..." required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Alamat Perusahaan</strong></p>
                  <label>Alamat Perusahaan</label>
                  <textarea class="form-control" rows="1" name="alamat" placeholder="Alamat Perusahaan ..." required></textarea>               
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Telp Perusahaan</strong></p>
                  <label>Telp Perusahaan</label>
                  <input type="number" class="form-control" name="telp" placeholder="Telp Perusahaan ..." required>
                </div>  
                <div class="form-group float-label-control">
                  <p><strong>Email Perusahaan</strong></p>
                  <label>Email Perusahaan</label>
                  <input type="email" class="form-control" name="email" placeholder="Email Perusahaan ..." required>
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Presentasi:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tanggal" id="datepicker2" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Status Keberhasilan Presentasi</strong></p>
                  <label>Status Presentasi</label>
                  <select class="form-control" name="status" required>
                    <option value="" class="text-muted">-- Pilih --</option>
                    <option value="Berhasil">Berhasil</option>
                    <option value="Menunggu Hasil">Menunggu Hasil</option>
                    <option value="Belum Berhasil">Belum Berhasil</option>
                  </select>
                </div>
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name = "simpan">Simpan</button> 
                  <a class="btn btn-warning btn-sm" href="?halaman=presentasiClient" role="button">Batal</a>
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
     
          $nama = mysql_real_escape_string($_POST['perusahaan']);
          $pemilik = mysql_real_escape_string($_POST['pemilik']);
          $alamat = mysql_real_escape_string($_POST['alamat']);
          $telp = mysql_real_escape_string($_POST['telp']);
          $email = mysql_real_escape_string($_POST['email']);
          $tanggal = mysql_real_escape_string($_POST['tanggal']);
          $tgl_presentasi = date('Y-m-d',strtotime($tanggal));
          $status = mysql_real_escape_string($_POST['status']);
        

          $koneksi->query ("INSERT INTO tbl_presentasiclient
          (nama_perusahaan, pemilik_perusahaan, alamat_perusahaan, telp_perusahaan, email_perusahaan, tgl_presentasi, status)
          VALUES('$nama','$pemilik','$alamat','$telp','$email','$tgl_presentasi','$status')");

         
          echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
          echo "<script>location='index.php?halaman=presentasiClient';</script>";
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
  $(function () {
   

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
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
