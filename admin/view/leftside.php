 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../admin/media/<?php if($pecah['foto_profile']== null){ echo 'profile.png'; } else { echo $pecah['foto_profile']; } ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $pecah ['nama'];?></p>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li >
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>     
          </a>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-folder-open-o"></i> <span>Arsip Surat</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?halaman=suratMasuk"><i class="fa fa-circle-o"></i> Surat Masuk </a></li>
            <li><a href="?halaman=suratKeluar"><i class="fa fa-circle-o"></i> Surat Keluar </a></li>
            <li><a href="?halaman=suratTugas"><i class="fa fa-circle-o"></i> Surat Tugas </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-building"></i> <span>Data Client</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?halaman=kontrakBerakhir"><i class="fa fa-circle-o"></i> Kontrak Berakhir </a></li>
            <li><a href="?halaman=kontrakClient"><i class="fa fa-circle-o"></i> Kontrak Client </a></li>
            <li><a href="?halaman=presentasiClient"><i class="fa fa-circle-o"></i> Presentasi Client </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-users"></i> <span>Data Personil</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#"><i class="fa fa-circle-o"></i> Absensi
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="?halaman=jagaPersonil"><i class="fa fa-circle-o"></i>Jaga Personil </a></li>
                <li><a href="?halaman=absensiPersonil"><i class="fa fa-circle-o"></i>Rekap Personil </a></li>
                <li><a href="?halaman=absensiPerusahaan"><i class="fa fa-circle-o"></i>Rekap Perusahaan </a></li>
              </ul>
            </li>
            <li><a href="?halaman=daftarPersonil"><i class="fa fa-circle-o"></i> Daftar Personil Aktif </a></li>
            <li><a href="?halaman=personilOff"><i class="fa fa-circle-o"></i> Daftar Personil Off </a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="">
            <i class="fa fa-calculator"></i> <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="?halaman=gajiPersonil"><i class="fa fa-circle-o"></i> Gaji Personil </a></li>
            <li><a href="?halaman=kasMasuk"><i class="fa fa-circle-o"></i> Kas Masuk </a></li>
            <li><a href="?halaman=kasKeluar"><i class="fa fa-circle-o"></i> Kas Keluar </a></li>
            <li><a href="?halaman=invoiceKuitansi"><i class="fa fa-circle-o"></i> Invoice dan Kuitansi </a></li>               
            <!-- <li><a href="?halaman=neracaSaldo"><i class="fa fa-circle-o"></i> Neraca Saldo </a></li> -->
          </ul>
        </li>
        <!-- <li class="treeview">
          <a href="">
            <i class="fa fa-envelope"></i> <span>Email</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?halaman=mailbox"><i class="fa fa-circle-o"></i> Inbox </a></li>
          </ul>
        </li> -->
        <li class="header">KELUAR PROGRAM</li>
        <li>
          <a href="?halaman=logout" onclick="javascript: return confirm('Apakah anda yakin keluar dari sistem?')">
            <i class="fa fa-sign-out"></i> <span>Keluar</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
