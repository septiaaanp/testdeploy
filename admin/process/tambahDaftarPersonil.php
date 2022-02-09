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
        <li>Daftar Personil</li>
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
              <h3 class="box-title">Tambah daftar personil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" autocomplete="off" method="POST" enctype="multipart/form-data">
                <div class="form-group float-label-control" id="profile-preview">
                  <p><strong>Upload Foto Personil</strong></p>
                  <label>Upload Foto Personil</label>
                    <img class="img-thumbnail" width="200" src="../admin/process/FotoPersonil/profile.png" alt="User profile picture"><br><br>
                  <div class="btn btn-primary btn-file btn-md">
                    <i class="glyphicon glyphicon-floppy-open" aria-hidden="true"></i>
                    <input id="preview-img" name="foto" type="file" onchange="readURL(this);" value="">
                  </div>
                  <button type="button" class="btn btn-danger btn-md btn-remove">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </button>
                  <div class="caption">
                    <small>Types : .jpg, .jpeg, .png</small><br>
                    <small>Max File Size : 1MB</small>
                  </div>
                </div> 
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Penempatan Personil</strong></p>
                  <label>Penempatan Personil</label>
                    <select class="form-control" id="perusahaan" name="penempatan" onchange='changeValue(this.value)' required>
                      <option value="" class="text-muted">-- PILIH NAMA PERUSAHAAN / CLIENT --</option>

                      <?php                                 
                        // $query=$koneksi->query("SELECT * FROM tbl_kontrakclient
                        // WHERE status='Terkontrak' order by id_kontrak asc;"); 

                        $query=$koneksi->query("SELECT tbl_presentasiclient.nama_perusahaan, tbl_kontrakclient.status 
                        FROM tbl_presentasiclient, tbl_kontrakclient WHERE 
                        tbl_presentasiclient.id_presentasi = tbl_kontrakclient.id_presentasi"); 

                        $jsArray = "var prdName = new Array();\n";
                        while ($row = $query->fetch_array()) {  
                        echo '<option value="' . $row['nama_perusahaan'] . '">' . $row['nama_perusahaan'] . '</option>';     
                        $jsArray .= "prdName['" . $row['nama_perusahaan'] . "'] = { status:'" . addslashes($row['status']) . "'};\n";      
                        }
                      ?>

                    </select>
                </div>
                <!-- select -->
                
                <div class="form-group float-label-control">
                  <p><strong>Jabatan Personil</strong></p>
                  <label>Jabatan Personil</label>
                    <select class="form-control" id="jabatan" name="jabatan" required>
                      <option value="" class="text-muted">-- PILIH JABATAN --</option>
                    
                      <!-- <option >KOMANDAN REGU (DANRU)</option>
                      <option >ANGGOTA</option> -->
                    </select>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Status Personil</strong></p>
                  <label for="">Status</label>
                  <input type="text" class="form-control" name="status" placeholder="Status Personil..." id="status" readonly required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Nama Personil</strong></p>
                  <label for="">Nama Personil</label>
                  <input type="text" class="form-control" name="nama" placeholder="Nama Personil ..." required>
                </div>
                <div class="form-group float-label-control">
                  <p><strong>NIK Personil</strong></p>
                  <label for="">NIK Personil</label>
                  <input type="text" class="form-control" name="nik" placeholder="NIK Personil ..." required>
                </div>
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Agama</strong></p>
                  <label>Agama</label>
                    <select class="form-control" name="agama" required>
                      <option value="" class="text-muted">-- PILIH AGAMA --</option>
                      <option >ISLAM</option>
                      <option >KRISTEN</option>
                      <option >KATOLIK</option>
                      <option >HINDU</option>
                      <option >BUDHA</option>
                      <option >KHONGHUCU</option>
                      <option >LAINNYA</option>
                    </select>
                </div>
                <!-- select -->
                <div class="form-group float-label-control">
                  <p><strong>Status Pribadi Personil</strong></p>
                  <label>Status Pribadi Personil</label>
                    <select class="form-control" name="pribadi" required>
                      <option value="" class="text-muted">-- PILIH STATUS --</option>
                      <option >BERKELUARGA</option>
                      <option >LAJANG</option>
                    </select>
                </div>  
                <div class="form-group float-label-control">
                  <p><strong>Alamat Personil</strong></p>
                  <label>Alamat Personil</label>
                  <textarea class="form-control" rows="1" name="alamat" placeholder="Alamat Personil ..." required></textarea>               
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Telp Personil</strong></p>
                  <label>Telp Perusahaan</label>
                  <input type="number" class="form-control" name="telp" placeholder="Telp Personil ..." required>
                </div> 
                <div class="form-group float-label-control">
                  <p><strong>Email Personil</strong> <small class="text-danger">*jika memiliki</small></p>
                  <label>Email Personil</label>
                  <input type="email" class="form-control" name="email" placeholder="Email Personil ..." >
                </div>
                <div class="form-group float-label-control">
                  <p><strong>Upload File Sertifikat Keterampilan</strong> <small class="text-danger">*jika memiliki</small></p>
                  <label>Upload File Sertifikat Keterampilant</label>
                  <input type="file" class="form-control" name="upload">
                </div> 
                <div class="box-footer">
                  <button class = "btn btn-primary btn-sm" name= "simpan">Simpan</button> 
                  <a class="btn btn-warning btn-sm" href="?halaman=daftarPersonil" role="button">Batal</a>
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
          // if(!empty($_FILES["foto"]["tmp_name"])){

              // $uploads_dir = realpath(dirname(__FILE__)."/../admin/media");
              $namafoto = $_FILES['foto']['name'];
              $lokasifoto = $_FILES['foto']['tmp_name'];
              $namafiks = date("YmdHis").$namafoto;
              // $path = realpath(dirname(__FILE__)."/../admin/process/FotoPersonil") .'/';
              //jk foto dirubah
              $penempatan = mysql_real_escape_string($_POST['penempatan']);
              $jabatan = mysql_real_escape_string($_POST['jabatan']);
              $status = mysql_real_escape_string($_POST['status']);
              $nama = mysql_real_escape_string($_POST['nama']);
              $nik = mysql_real_escape_string($_POST['nik']);
              $agama = mysql_real_escape_string($_POST['agama']);
              $pribadi = mysql_real_escape_string($_POST['pribadi']);
              $alamat = mysql_real_escape_string($_POST['alamat']);
              $telp = mysql_real_escape_string($_POST['telp']);
              $email = mysql_real_escape_string($_POST['email']);
              $upload = $_FILES['upload']['name'];
              $lokasi = $_FILES['upload']['tmp_name'];

              $ambil2= $koneksi->query ("SELECT * FROM tbl_presentasiclient where nama_perusahaan = '$penempatan'");
              $hasil2 = $ambil2->fetch_array();
              $id_presentasi = $hasil2['id_presentasi'];

              $ambil3= $koneksi->query ("SELECT * FROM tbl_biayagaji where jabatan = '$jabatan' and id_presentasi = '$id_presentasi'");
              $hasil3 = $ambil3->fetch_array();
              $id_nilai = $hasil3['id_nilai'];
        
              $ambil= $koneksi->query ("SELECT * FROM tbl_kontrakclient where id_presentasi = '$id_presentasi'");
              $hasil = $ambil->fetch_array();
              $id_kontrak = $hasil['id_kontrak'];
              $max_personil = $hasil['minta_personil'];

              $cek_personil = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where id_kontrak = '$id_kontrak'");
              $personil = $cek_personil->num_rows;
                if($personil >= $max_personil){
                  echo "<script type='text/javascript'>alert('Jumlah Personil Sudah Melebih Batas');</script>";
                  echo "<script>location='index.php?halaman=daftarPersonil';</script>";
                }else{

                  $cek_upload = $koneksi->query ("SELECT * FROM tbl_daftarpersonil where foto ='$namafiks'");
                  $num_row = $cek_upload->num_rows;
                  
                  if ($num_row == 0){
                    move_uploaded_file ($lokasifoto, "../admin/process/FotoPersonil/$namafiks");
                    move_uploaded_file ($lokasi, "../admin/process/SertifPersonil/$upload");
  
                    $koneksi->query ("INSERT INTO tbl_daftarpersonil
                    (id_nilai, id_presentasi, id_kontrak, foto, jabatan, status, nama, nik, agama, status_diri, alamat, telp, email, sertifikat)
                    VALUES('$id_nilai','$id_presentasi', '$id_kontrak','$namafiks','$jabatan','$status','$nama', '$nik', '$agama',
                    '$pribadi','$alamat','$telp','$email','$upload')");
  
                    echo "<script type='text/javascript'>alert('Data telah disimpan');</script>";
                    echo "<script>location='index.php?halaman=daftarPersonil';</script>";
                  }else{
                    echo "<script type='text/javascript'>alert('Foto dan Scan Sertifikat tidak boleh sama');</script>";
                    echo "<script>location='?halaman=tambahDaftarPersonil';</script>";
                  }
                }
          // }else{
          //   echo "<script type='text/javascript'>alert('Silahkan pilih foto dahulu');</script>";
          // }
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

<script>
$(document).ready(function() {
	$('#perusahaan').change(function() { // Jika Select Box id provinsi dipilih
		var perusahaan = $(this).val(); // Ciptakan variabel provinsi
		$.ajax({
			type: 'POST', // Metode pengiriman data menggunakan POST
			url: '../admin/process/jabatan_personil.php', // File yang akan memproses data
			data: 'nama_perusahaan=' + perusahaan, // Data yang akan dikirim ke file pemroses
			success: function(response) { // Jika berhasil
				$('#jabatan').html(response); // Berikan hasil ke id kota
			}
		});
    });
});
</script>

<script> 
<?php echo $jsArray; ?>
function changeValue(nama_perusahaan){
      if (nama_perusahaan == 0) {
        document.getElementById('status').value = "";
      } else {
        document.getElementById('status').value = prdName[nama_perusahaan].status;
      }
    
};
</script>


<script type="text/javascript">
	$('#preview-img').on('change',function(){
		$('#profile-preview').find('img').removeAttr('style');
	});
	$(".btn-remove").click(function() {
        var formimage = document.getElementById('preview-img');
        formimage.value = '';
        $('#profile-preview > img').removeAttr("src");
        $('#profile-preview > img').attr('src', '../admin/process/FotoPersonil/profile.png');
		$('#profile-preview').find('img');
    });
	
	//Upload Profile Image
    function readURL(input) {
        var fileInput = document.getElementById('preview-img');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(filePath)) {
            alert('File type not allowed!!');
            fileInput.value = '';
            return false;
        } else {
            if (input.files && input.files[0]) {
				var filex = input.files[0].size;
				var sizex = (filex/1024).toFixed(2);
				//1000000 MB = 1 MB
				//2000000 MB = 2 MB
				if(filex >= 1000000 ) {
					alert('File size too large!!');
					fileInput.value = '';
					return false;
				}
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-preview > img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    }
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
