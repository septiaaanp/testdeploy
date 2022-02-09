
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
        <li>Arsip Surat</li>
        <li>Surat Masuk</li>
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
              <h3 class="box-title">Tambah data surat masuk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" method="POST" enctype = "multipart/form-data">
                <div class="form-group float-label-control">
                  <p><strong>Nomor Surat</strong></p>
                  <label for="">Nomor Surat</label>
                  <input type="text" class="form-control" name="no_surat" placeholder="Nomor Surat ..." required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Perihal Surat</strong></p>
                  <label for="">Perihal Surat</label>
                  <input type="text" class="form-control" name="perihal" placeholder="Perihal Surat ..." required>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Pengirim Surat</strong></p>
                  <label for="">Pengirim Surat</label>
                  <input type="text" class="form-control" name="pengirim" placeholder="Pengirim Surat ..." required>
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Surat Masuk:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tgl_masuk" id="datepicker" required>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Pembuatan Surat:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tgl_surat" id="datepicker2" required>
                  </div>
                  <!-- /.input group -->
                </div>  
                <div class="form-group float-label-control">
                  <p><strong>Alamat Pengirim</strong></p>
                  <label>Alamat Pengirim</label>
                  <textarea class="form-control" rows="1" name="alamat" placeholder="Alamat Pengirim..." required></textarea>               
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Upload Scan Surat</strong></p>
                  <label>Upload Scan Surat</label>
                  <input type="file" class="form-control" name="upload" required>
                </div>  
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name="save">Simpan</button> 
                  <a class="btn btn-warning btn-sm" href="?halaman=suratMasuk" role="button">Batal</a>
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
      if (isset ($_POST ['save']))
      {
          
          $tanggal1 = mysql_real_escape_string($_POST['tgl_masuk']);
          $tgl_masuk = date('Y-m-d',strtotime($tanggal1));
          $tanggal2 = mysql_real_escape_string($_POST['tgl_surat']);
          $tgl_surat = date('Y-m-d',strtotime($tanggal2));
          $no_surat = mysql_real_escape_string($_POST['no_surat']);
          $perihal = mysql_real_escape_string($_POST['perihal']);
          $pengirim = mysql_real_escape_string($_POST['pengirim']);
          $alamat = mysql_real_escape_string($_POST['alamat']);
          $nama = $_FILES['upload']['name'];
          $lokasi = $_FILES['upload']['tmp_name'];
          move_uploaded_file ($lokasi, "../admin/process/SuratMasuk/".$nama);
          $koneksi->query ("INSERT INTO tbl_suratmasuk
          (no_surat, perihal, pengirim, tgl_masuk, tgl_surat, alamat, upload)
          VALUES('$no_surat','$perihal','$pengirim','$tgl_masuk','$tgl_surat','$alamat', '$nama')");

         
          echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
          echo "<script>location='index.php?halaman=suratMasuk';</script>";
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
