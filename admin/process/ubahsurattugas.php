<?php

  $ambil = $koneksi->query("SELECT * FROM tbl_surattugas WHERE id_surattugas = '$_GET[id]'");
  $tampil = $ambil->fetch_assoc();

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
        <li>Arsip Surat</li>
        <li>Surat Tugas</li>
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
              <h3 class="box-title">Ubah data surat tugas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" method="POST" enctype = "multipart/form-data">
                <div class="form-group float-label-control">
                  <p><strong>Nomor Surat</strong></p>
                  <label for="">Nomor Surat</label>
                  <input type="text" class="form-control" name="no_surat" value="<?php echo $tampil ['no_surat'];?>" required>
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Pembuatan Surat:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tgl_surat" id="datepicker2" value="<?php echo date('d-m-Y', strtotime($tampil['tgl_surat'])); ?>" required>
                  </div>
                </div>   
                <div class="form-group float-label-control">
                  <p><strong>Kegiatan Tugas</strong></p>
                  <label for="">Kegiatan Tugas</label>
                  <input type="text" class="form-control" name="kegiatan" value="<?php echo $tampil ['kegiatan'];?>" required>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Tempat Kegiatan</strong></p>
                  <label>Tempat Kegiatan</label>
                  <textarea class="form-control" rows="1" name="tempat" required><?php echo $tampil ['tempat'];?></textarea>               
                </div>
                <!-- Date -->
                <div class="form-group" >
                  <label>Tanggal Kegiatan Tugas:</label>
                  <div class="input-group date">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" name="tgl_kegiatan" id="datepicker" value="<?php echo date('d-m-Y', strtotime($tampil['tgl_kegiatan'])); ?>" required>
                  </div>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Upload File Surat</strong></p>
                  <label>Upload File Surat</label>
                  <a href="../admin/process/SuratTugas/<?php echo $tampil['upload'] ?>" target="_blank"><?php echo $tampil ['upload'];?></a>
                  <input type="file" class="form-control" name="upload">
                </div>  
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name="save">Simpan</button> 
                  <a class="btn btn-warning btn-sm" href="?halaman=suratTugas" role="button">Batal</a>
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
      if (isset($_POST['save']))
        {   
            $no_surat = mysql_real_escape_string($_POST['no_surat']);
            $tanggal1 = mysql_real_escape_string($_POST['tgl_surat']);
            $tgl_surat = date('Y-m-d',strtotime($tanggal1));
            $kegiatan = mysql_real_escape_string($_POST['kegiatan']);
            $tempat = mysql_real_escape_string($_POST['tempat']);
            $tanggal2 = mysql_real_escape_string($_POST['tgl_kegiatan']);
            $tgl_kegiatan = date('Y-m-d',strtotime($tanggal2));
            $nama = $_FILES['upload']['name'];
            $lokasi = $_FILES['upload']['tmp_name'];

            $ambil = $koneksi->query ("SELECT * FROM tbl_surattugas where id_surattugas = '$_GET[id]'");
            $pecah = $ambil ->fetch_assoc();
            $upload = $pecah ['upload'];
            if (!empty ($lokasi))
            {
                unlink (("../admin/process/SuratTugas/$upload"));
                move_uploaded_file ($lokasi, "../admin/process/SuratTugas/".$nama);

                $koneksi->query("UPDATE tbl_surattugas SET no_surat = '$no_surat', tgl_surat = '$tgl_surat', kegiatan = '$kegiatan', 
                tempat = '$tempat' ,  tgl_kegiatan = '$tgl_kegiatan', upload = '$nama' WHERE id_surattugas = '$_GET[id]'");
            }
            else
            {
                $koneksi->query("UPDATE tbl_surattugas SET no_surat = '$no_surat', tgl_surat = '$tgl_surat', kegiatan = '$kegiatan', 
                tempat = '$tempat' ,  tgl_kegiatan = '$tgl_kegiatan' WHERE id_surattugas = '$_GET[id]'");
            }
            echo "<script type='text/javascript'>alert('Data telah diupdate');</script>";
            echo "<script>location='?halaman=suratTugas';</script>";
                      
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
