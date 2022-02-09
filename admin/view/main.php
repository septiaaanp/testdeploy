  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php
      if (isset($_GET['halaman']))
      {
        if ($_GET['halaman']=="profileAdmin")
        { 
          include 'process/profileAdmin.php';
        }
        //bagian kontrak client
        elseif ($_GET['halaman']=="kontrakBerakhir")
        { 
          include 'process/kontrakBerakhir.php';
        }
        elseif ($_GET['halaman']=="kontrakClient")
        { 
          include 'process/kontrakClient.php';
        }
        elseif ($_GET['halaman']=="tambahKontrak")
        { 
          include 'process/tambahKontrak.php';
        }

        //tambah kontrak lanjutan
        elseif ($_GET['halaman']=="selanjutnya")
        { 
          include 'process/tambahkontraklanjut.php';
        }
        elseif ($_GET['halaman']=="selanjutnya2")
        { 
          include 'process/tambahkontraklanjut2.php';
        }

        elseif ($_GET['halaman']=="ubahkontrakclient")
        { 
          include 'process/ubahkontrakclient.php';
        }

        // bagian ubah hapus nilai gaji & pendukung
        elseif ($_GET['halaman']=="ubahnilaigaji")
        { 
          include 'process/ubahnilaigaji.php';
        }
        elseif ($_GET['halaman']=="ubahnilaipendukung")
        { 
          include 'process/ubahnilaipendukung.php';
        }
        //lanjut - update
        elseif ($_GET['halaman']=="selanjutnyaupdate")
        { 
          include 'process/selanjutnyaupdate.php';
        }
        elseif ($_GET['halaman']=="selanjutnyaupdate2")
        { 
          include 'process/selanjutnyaupdate2.php';
        }
        //hapus nilai gaji & pendukung
        elseif ($_GET['halaman']=="hapusnilaigaji")
        { 
          include 'process/hapusnilaigaji.php';
        }
        elseif ($_GET['halaman']=="hapusnilaipendukung")
        { 
          include 'process/hapusnilaipendukung.php';
        }
        
        elseif ($_GET['halaman']=="hapuskontrakclient")
        { 
          include 'process/hapuskontrakclient.php';
        }
        elseif ($_GET['halaman']=="hapuskontrakhabis")
        { 
          include 'process/hapuskontrakhabis.php';
        }
        
        //bagian presentasi client
        elseif ($_GET['halaman']=="presentasiClient")
        { 
          include 'process/presentasiClient.php';
        }
        elseif ($_GET['halaman']=="tambahPresentasiClient")
        { 
          include 'process/tambahPresentasiClient.php';
        }
        elseif ($_GET['halaman']=="ubahpresentasiclient")
        { 
          include 'process/ubahpresentasiclient.php';
        }
        elseif ($_GET['halaman']=="hapuspresentasiclient")
        { 
          include 'process/hapuspresentasiclient.php';
        }
        //bagian personil
        elseif ($_GET['halaman']=="daftarPersonil")
        { 
          include 'process/daftarPersonil.php';
        }
        elseif ($_GET['halaman']=="listPersonil")
        { 
          include 'process/listpersonil.php';
        }
        elseif ($_GET['halaman']=="personilOff")
        { 
          include 'process/personilOff.php';
        }
        elseif ($_GET['halaman']=="listPersonilOff")
        { 
          include 'process/listpersoniloff.php';
        }
        elseif ($_GET['halaman']=="tambahDaftarPersonil")
        { 
          include 'process/tambahDaftarPersonil.php';
        }
        elseif ($_GET['halaman']=="ubahdaftarpersonil")
        { 
          include 'process/ubahdaftarpersonil.php';
        }
        elseif ($_GET['halaman']=="hapusdaftarpersonil")
        { 
          include 'process/hapusdaftarpersonil.php';
        }
        elseif ($_GET['halaman']=="hapusPersonilOff")
        { 
          include 'process/hapuspersoniloff.php';
        }
        // jaga personil
        elseif ($_GET['halaman']=="jagaPersonil")
        { 
          include 'process/jagapersonil.php';
        }
        elseif ($_GET['halaman']=="lihatJaga")
        { 
          include 'process/lihatjaga.php';
        }
        elseif ($_GET['halaman']=="tambahJaga")
        { 
          include 'process/tambahjaga.php';
        }
        elseif ($_GET['halaman']=="ubahJaga")
        { 
          include 'process/ubahjaga.php';
        }
        elseif ($_GET['halaman']=="hapusJaga")
        { 
          include 'process/hapusjaga.php';
        }
        // ABSENSI PERSONIL
        elseif ($_GET['halaman']=="absensiPersonil")
        { 
          include 'process/absensipersonil.php';
        }
        elseif ($_GET['halaman']=="lihatAbsensi")
        { 
          include 'process/lihatabsensi.php';
        }
        elseif ($_GET['halaman']=="tambahAbsensi")
        { 
          include 'process/tambahabsensi.php';
        }
        elseif ($_GET['halaman']=="ubahAbsensi")
        { 
          include 'process/ubahabsensi.php';
        }
        elseif ($_GET['halaman']=="hapusabsensi")
        { 
          include 'process/hapusabsensi.php';
        }
        // ABSENSI PERUSAHAAN
        elseif ($_GET['halaman']=="absensiPerusahaan")
        { 
          include 'process/absensiperusahaan.php';
        }
        elseif ($_GET['halaman']=="lihatRekapAbsensi")
        { 
          include 'process/lihatrekapabsensi.php';
        }
        // elseif ($_GET['halaman']=="StrukGaji")
        // { 
        //   include 'process/strukgaji.php';
        // }
        //bagian surat masuk
        elseif ($_GET['halaman']=="suratMasuk")
        { 
          include 'process/suratMasuk.php';
        }
        elseif ($_GET['halaman']=="tambahsuratMasuk")
        { 
          include 'process/tambahsuratmasuk.php';
        }
        elseif ($_GET['halaman']=="hapusSuratMasuk")
        { 
          include 'process/hapussuratmasuk.php';
        }
        elseif ($_GET['halaman']=="ubahSuratMasuk")
        { 
          include 'process/ubahsuratmasuk.php';
        }
        //bagian surat keluar
        elseif ($_GET['halaman']=="suratKeluar")
        { 
          include 'process/suratKeluar.php';
        }
        elseif ($_GET['halaman']=="tambahsuratKeluar")
        { 
          include 'process/tambahsuratkeluar.php';
        }
        elseif ($_GET['halaman']=="ubahSuratKeluar")
        { 
          include 'process/ubahsuratkeluar.php';
        }
        elseif ($_GET['halaman']=="hapusSuratKeluar")
        { 
          include 'process/hapussuratkeluar.php';
        }
        //bagian surat tugas
        elseif ($_GET['halaman']=="suratTugas")
        { 
          include 'process/suratTugas.php';
        }
        elseif ($_GET['halaman']=="tambahsuratTugas")
        { 
          include 'process/tambahsurattugas.php';
        }
        elseif ($_GET['halaman']=="ubahSuratTugas")
        { 
          include 'process/ubahsurattugas.php';
        }
        elseif ($_GET['halaman']=="hapusSuratTugas")
        { 
          include 'process/hapussurattugas.php';
        }
        //bagian arus kas
        elseif ($_GET['halaman']=="kasMasuk")
        { 
          include 'process/kasMasuk.php';
        }
        elseif ($_GET['halaman']=="tambahKasMasuk")
        { 
          include 'process/tambahkasmasuk.php';
        }
        elseif ($_GET['halaman']=="ubahKasMasuk")
        { 
          include 'process/ubahkasmasuk.php';
        }
        elseif ($_GET['halaman']=="hapusKasMasuk")
        { 
          include 'process/hapuskasmasuk.php';
        }
        // kas keluar
        elseif ($_GET['halaman']=="kasKeluar")
        { 
          include 'process/kasKeluar.php';
        }
        elseif ($_GET['halaman']=="tambahKasKeluar")
        { 
          include 'process/tambahkaskeluar.php';
        }
        elseif ($_GET['halaman']=="ubahKasKeluar")
        { 
          include 'process/ubahkaskeluar.php';
        }
        elseif ($_GET['halaman']=="hapusKasKeluar")
        { 
          include 'process/hapuskaskeluar.php';
        }
        // invoice 
        elseif ($_GET['halaman']=="invoiceKuitansi")
        { 
          include 'process/invoicekuitansi.php';
        }        
        elseif ($_GET['halaman']=="Invoice")
        { 
          include 'process/invoice.php';
        }
        elseif ($_GET['halaman']=="Kuitansi")
        { 
          include 'process/kuitansi.php';
        }
        // gaji personil
        elseif ($_GET['halaman']=="gajiPersonil")
        { 
          include 'process/gajipersonil.php';
        }
        elseif ($_GET['halaman']=="lihatgajiPersonil")
        { 
          include 'process/lihatgajipersonil.php';
        }
        elseif ($_GET['halaman']=="lihatGaji")
        { 
          include 'process/lihatgaji.php';
        }
        // neraca saldo
        // elseif ($_GET['halaman']=="neracaSaldo")
        // { 
        //   include 'process/neracasaldo.php';
        // }
        //bagian email   
        elseif ($_GET['halaman']=="mailbox")
        {
          include 'email/mailbox.php';
        }
        elseif ($_GET['halaman']=="read-mail")
        {
          include 'email/read-mail.php';
        }
        elseif ($_GET['halaman']=="logout")
        {
          include 'logout.php';
        }
      }
      else
      {
        include 'process/home.php';
      }
    ?>
  </div>
 <!-- /.content-wrapper -->