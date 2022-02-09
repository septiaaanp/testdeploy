
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
        <li>Lihat Jaga</li>
        <li class="Active">Tambah Data Penjagaan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements disabled -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Data Penjagaan Personil</h3>
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
                    <p><strong>Input Jumlah Jaga</strong></p>
                    <label for="">Input Jumlah Jaga</label>
                    <input type="text" class="form-control" name="jaga" placeholder="Input Jumlah Jaga" required>
                </div>
                <div class="row">
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Bulan</label>
                            <select class="form-control" name="bulan2">
                                <option value="" class="text-muted">Pilih Bulan</option>
                                <option value="01">01 - Januari</option>
                                <option value="02">02 - Februari</option>
                                <option value="03">03 - Maret</option>
                                <option value="04">04 - April</option>
                                <option value="05">05 - Mei</option>
                                <option value="06">06 - Juni</option>
                                <option value="07">07 - Juli</option>
                                <option value="08">08 - Agustus</option>
                                <option value="09">09 - September</option>
                                <option value="10">10 - Oktober</option>
                                <option value="11">11 - November</option>
                                <option value="12">12 - Desember</option>	
                            </select>
                        </div>
                    <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tahun</label>
                            <select class="form-control" name="tahun">
                                <?php for ( $i = 2000; $i <= date('Y'); $i ++) { ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                        </div>
                        <!-- /.form-group -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name="simpan">Simpan</button> 
                  <a href="?halaman=lihatJaga&id=<?php echo $_GET['id']?>" class="btn btn-warning btn-sm" role="button">Batal</a>
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
          $jaga = $_POST['jaga'];
          $bulan = $_POST['bulan2'];
          $tahun = $_POST['tahun'];
          // $tanggal = $_POST['tanggal'];
          // $tgl_jaga= date('Y-m-d',strtotime($tanggal));
          // $bulan= date('m',strtotime($tanggal));
          // $tahun= date('Y',strtotime($tanggal));

          $sql_get = $koneksi->query("SELECT * FROM tbl_jagapersonil where id_personil = '$id_personil' 
          and substr(tgl_jaga,6,2) = '$bulan' and substr(tgl_jaga,1,4) = '$tahun'");
          $num_row = $sql_get->num_rows;

          if ($num_row == 0){
            $koneksi->query ("INSERT INTO tbl_jagapersonil 
            (id_personil, jaga, tgl_jaga) 
            VALUES('$id_personil','$jaga','$tahun-$bulan-01')");
  
            echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
            echo "<script>location='index.php?halaman=lihatJaga&id=$id_personil';</script>";
          }
          else{
            echo "<script type='text/javascript'>alert('Data sudah ada!');</script>";
            echo "<script>location='?halaman=lihatJaga&id=$id_personil';</script>";
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
