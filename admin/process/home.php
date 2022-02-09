<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
  <!-- Custom CSS -->
  <link href="assets/css/fullcalendar.css" rel="stylesheet">
  </head>

<body>

<section class="content-header">  
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    <!-- </section> -->
  
    <!-- <div class="jumbotron jumbotron-fluid bg-primary">
      <div class="container">
        <h3 class="display-4 text-center">S</h3>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
      </div>
    </div> -->
    <div class="box-body">
      <div class="callout callout-info">
        <h4 class="text-center">Sistem Informasi Manajemen PT. Garuda Sakti Waspada</h4>
        <p class="text-justify">Sistem ini merupakan sistem internal perusahaan PT. Garuda Sakti Waspada yang berfungsi 
          untuk pengolahan data client, data personil, penghitungan gaji personil, pembuatan invoice, 
          pembuatan kuitansi serta pembuatan laporan kas masuk dan kas keluar yang hanya dapat dilakukan 
          oleh admin yang terdaftar didalam sistem.
        </p>
    </div>
    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
            <?php
              $ambil = $koneksi->query(" SELECT * FROM tbl_kontrakclient ");
              $jumlah= $ambil->num_rows; 
            ?>
              <h3><?php echo $jumlah; ?></h3>

              <p>Total Client</p>
            </div>
            <div class="icon">
              <i class="ion ion-briefcase"></i>
            </div>
            <a href="?halaman=kontrakClient" class="small-box-footer">Lihat data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
            <?php
              $ambil2 = $koneksi->query(" SELECT * FROM tbl_daftarpersonil ");
              $jumlah2= $ambil2->num_rows; 
            ?>
              <h3><?php echo $jumlah2; ?></h3>

              <p>Total Personil</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="?halaman=daftarPersonil" class="small-box-footer">Lihat data <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
            <?php
             $ambil3= $koneksi->query ("SELECT SUM(total_harga) AS total FROM tbl_kasmasuk");
             $hasil3 = $ambil3->fetch_array();
             $total_harga = $hasil3['total'];
            ?>
              <h3>Rp. <?php echo number_format($total_harga, 0 ,'.','.') ?></h3>

              <p>Kas Masuk</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="?halaman=kasMasuk" class="small-box-footer">Lihat Kas Masuk <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php
              $ambil4= $koneksi->query ("SELECT SUM(total_harga) AS total FROM tbl_kaskeluar");
              $hasil4 = $ambil4->fetch_array();
              $total_harga2 = $hasil4['total'];
              ?>
              <h3>Rp. <?php echo number_format($total_harga2, 0 ,'.','.') ?></h3>

              <p>Kas Keluar</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="?halaman=kasKeluar" class="small-box-footer">Lihat Kas Keluar <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">

          <!-- quick email widget -->
          <!-- <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Quick Email</h3> -->
              <!-- tools box -->
              <!-- <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div> -->
              <!-- /. tools -->
            <!-- </div>
            <div class="box-body">
              <form action="" autocomplete="off" enctype="multipart/form-data" method="post">
                <div class="form-group">
                  <input type="email" class="form-control" name="userEmail" placeholder="Email to:">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                </div>
                <div>
                  <textarea name="content" class="textarea" placeholder="Message"
                            style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
                <div>
                  <label>Lampiran</label><br/>
                  <input type="file" name="attachmentFile" id="attachmentFile" class="demoInputBox" multiple>
                </div>
                <div class="box-footer clearfix">
                  <button name="submit" type="submit" class="pull-right btn btn-default" id="sendEmail">Send
                  <i class="fa fa-arrow-circle-right"></i></button>
                </div> -->
                
                  <!-- Start PHP MAiller-->
                <?php 
                    // if (isset($_POST["submit"])){
                    // require 'PHPMailer/PHPMailerAutoload.php';
                    
                    // $mail = new PHPMailer;
                    // $mail ->SMTPOptions = array(
                    //   'ssl' => array (
                    //     'verify_peer' => false,
                    //     'verify_peer_name' => false,
                    //     'allow_self_signed' => true
                    //   )
                    //   );
                    // $mail->isSMTP();                                      // Set mailer to use SMTP
                    // $mail->SMTPDebug = 0;
                    // $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    // $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    // $mail->Port = 587;                                    // TCP port to connect to
                    // $mail->Username = 'tumbascoffee@gmail.com';                 // SMTP username
                    // $mail->Password = 'sugutamu261902';                           // SMTP password
                    // $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
              //       $mail->setFrom("tumbascoffee@gmail.com", "ADMIN PT. GARUDA SAKTI WASPADA");
              //       $mail->AddReplyTo ("tumbascoffee@gmail.com", "ADMIN PT. GARUDA SAKTI WASPADA");
              //       $mail -> addAddress ($_POST["userEmail"]);
              //       $mail->Subject = $_POST["subject"];
              //       $mail->WordWrap   = 80;
              //       $mail->MsgHTML($_POST["content"]);
              //       $mail->isHTML(true);

              //       $nama = $_FILES['attachmentFile']['name'];
              //       $lokasi = $_FILES['attachmentFile']['tmp_name'];
                    
              //       if(is_array($_FILES)) {
              //         $mail->AddAttachment($lokasi,$nama);
              //         }
                      
                    
              //       if($mail->send())
              //         {
              //           echo "<script type='text/javascript'>alert('Email Terkirim');</script>";
                        
              //         }else{
              //           echo "<script type='text/javascript'>alert('Gagal Mengirim Email');</script>";
              //         }
              //       }
                    
                
              // ?>
              <!-- End PHP -->
              <!-- </form>
            </div> -->
            
          <!-- </div> -->

        </section>
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-6 connectedSortable">
        
          <!-- Calendar -->
          <div class="box box-solid bg-blue-gradient">
            <div class="box-header">
              <i class="fa fa-calendar"></i>

              <h3 class="box-title">Calendar</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <!-- button with a dropdown -->
                <div class="btn-group">
                  <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bars"></i></button>
                  <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Add new event</a></li>
                    <li><a href="#">Clear events</a></li>
                    <li class="divider"></li>
                    <li><a href="#">View calendar</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                </button>
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding ">
              <!--The calendar -->
              <div id="calendar1" class="bg-primary" style="width: 100%"></div>
            </div>
          </div>
          <!-- /.box -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

<script>
 $(document).ready(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  var calendar = $('#calendar1').fullCalendar({
   editable: true,
   header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay'
    
   },
   

   events: "index.php",
   eventRender: function(event, element, view) {
    if (event.allDay === 'true') {
     event.allDay = true;
    } else {
     event.allDay = false;
    }
   },

   
  });
 });
</script>

<script type="text/javascript">
$('.file-upload').file_upload();
</script>


</body>
</html>

