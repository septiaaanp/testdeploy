-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 02:33 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `foto_profile` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `token` varchar(100) NOT NULL,
  `tokenExpire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `email`, `telp`, `foto_profile`, `jenis_kelamin`, `password`, `token`, `tokenExpire`) VALUES
(2, 'sopi', 'sopigp', 'sopi@gmail.com', '', '', 'Wanita', 'sugutamu', '', '0000-00-00 00:00:00'),
(3, 'PT. GSW', 'admin01', 'admin@gmail.com', '', '', 'Pria', 'sugutamu', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` int(11) NOT NULL,
  `id_personil` int(11) NOT NULL,
  `kehadiran` varchar(11) NOT NULL,
  `waktu_masuk` time NOT NULL,
  `waktu_keluar` time NOT NULL,
  `tgl_absensi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_personil`, `kehadiran`, `waktu_masuk`, `waktu_keluar`, `tgl_absensi`) VALUES
(1, 5, 'Alpha', '09:00:00', '21:28:00', '2019-08-22'),
(2, 5, 'Hadir', '08:15:00', '03:00:00', '0000-00-00'),
(3, 5, 'Hadir', '09:00:00', '21:34:00', '1970-01-01'),
(4, 5, 'Hadir', '09:00:00', '21:35:00', '2019-08-31'),
(5, 5, 'Sakit', '09:00:00', '21:39:00', '1970-01-01'),
(6, 5, 'Sakit', '09:00:00', '21:40:00', '1970-01-01'),
(7, 5, 'Alpha', '09:00:00', '21:43:00', '2019-01-08'),
(8, 5, 'Izin', '09:00:00', '21:45:00', '2019-02-02'),
(9, 5, 'Hadir', '09:00:00', '21:55:00', '2019-08-13'),
(10, 5, 'Sakit', '09:00:00', '22:01:00', '2019-08-13'),
(11, 6, 'Cuti', '09:00:00', '22:11:00', '2019-08-13'),
(12, 6, 'Izin', '09:00:00', '22:11:00', '2019-08-30'),
(13, 5, 'Hadir', '09:00:00', '22:25:00', '2019-08-08'),
(14, 5, 'Alpha', '09:00:00', '22:26:00', '2019-08-30'),
(15, 5, 'Cuti', '11:00:00', '23:07:00', '2019-09-07'),
(16, 2, 'Alpha', '09:00:00', '21:29:00', '1970-01-01'),
(17, 7, 'Hadir', '09:00:00', '13:35:00', '2019-08-01'),
(18, 7, 'Hadir', '09:00:00', '13:35:00', '2019-08-02'),
(19, 7, 'Sakit', '09:00:00', '13:35:00', '2019-08-03'),
(20, 7, 'Hadir', '09:00:00', '13:35:00', '2019-08-04'),
(21, 7, 'Hadir', '09:00:00', '13:37:00', '2019-08-05'),
(22, 7, 'Cuti', '09:00:00', '13:37:00', '2019-08-06'),
(23, 7, 'Hadir', '09:00:00', '13:38:00', '2019-08-07'),
(24, 7, 'Hadir', '09:00:00', '13:38:00', '2019-08-08'),
(25, 7, 'Izin', '09:00:00', '13:38:00', '2019-08-10'),
(26, 7, 'Alpha', '09:00:00', '13:38:00', '2019-08-09'),
(27, 7, 'Hadir', '09:00:00', '13:41:00', '2019-08-12'),
(28, 7, 'Hadir', '09:00:00', '13:41:00', '2019-08-11'),
(29, 7, 'Hadir', '09:00:00', '13:41:00', '2019-08-13'),
(30, 7, 'Hadir', '09:00:00', '13:41:00', '2019-08-14'),
(31, 7, 'Hadir', '09:00:00', '13:42:00', '2019-08-15'),
(32, 7, 'Alpha', '09:00:00', '13:45:00', '2019-08-16'),
(33, 7, 'Hadir', '09:00:00', '13:45:00', '2019-08-17'),
(34, 7, 'Hadir', '09:00:00', '13:45:00', '2019-08-18'),
(35, 7, 'Hadir', '09:00:00', '13:45:00', '2019-08-19'),
(36, 7, 'Hadir', '09:00:00', '13:46:00', '2019-08-20'),
(37, 7, 'Hadir', '09:00:00', '13:46:00', '2019-08-21'),
(38, 7, 'Hadir', '09:00:00', '13:47:00', '2019-08-22'),
(39, 7, 'Hadir', '09:00:00', '13:47:00', '2019-08-23'),
(40, 7, 'Hadir', '09:00:00', '13:47:00', '2019-08-25'),
(41, 7, 'Hadir', '09:00:00', '13:47:00', '2019-08-26'),
(42, 7, 'Hadir', '09:00:00', '13:47:00', '2019-08-29'),
(43, 7, 'Hadir', '09:00:00', '13:48:00', '2019-08-27'),
(44, 7, 'Hadir', '09:00:00', '13:48:00', '2019-08-28'),
(45, 7, 'Hadir', '09:00:00', '13:48:00', '2019-08-30'),
(46, 7, 'Hadir', '09:00:00', '13:48:00', '2019-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biayagaji`
--

CREATE TABLE `tbl_biayagaji` (
  `id_nilai` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `jumlah_personil` varchar(11) NOT NULL,
  `gaji_pokok` varchar(20) NOT NULL,
  `tunj_jabatan` varchar(20) NOT NULL,
  `bpjs_kerja` varchar(20) NOT NULL,
  `bpjs` varchar(20) NOT NULL,
  `tunjangan` varchar(20) NOT NULL,
  `jumlah_pkd` varchar(11) NOT NULL,
  `tunj_pkd` varchar(20) NOT NULL,
  `nilai_gaji` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_biayagaji`
--

INSERT INTO `tbl_biayagaji` (`id_nilai`, `id_kontrak`, `id_presentasi`, `jabatan`, `jumlah_personil`, `gaji_pokok`, `tunj_jabatan`, `bpjs_kerja`, `bpjs`, `tunjangan`, `jumlah_pkd`, `tunj_pkd`, `nilai_gaji`) VALUES
(210, 91, 35, 'Chief / Supervisor', '1', '3200000', '500000', '223685.28', '75000', '266666.667', '', '', '4265352'),
(211, 91, 35, 'Komandan Regu (DANRU)', '3', '3200000', '200000', '223685.28', '75000', '266666.667', '', '', '11896056'),
(212, 91, 35, 'Anggota', '18', '3100000', '0', '223685.28', '75000', '258333.333', '6', '600000', '65826335'),
(227, 93, 37, 'Anggota', '3', '3', '3', '0.19', '3', '0.25', '3', '30000', '28'),
(229, 93, 37, 'Komandan Regu (DANRU)', '2', '3', '2', '0.12', '2', '0.167', '', '', '15'),
(238, 97, 33, 'Anggota', '3', '10', '10', '0.62', '10', '0.833', '10', '2000', '94'),
(242, 93, 37, 'Chief / Supervisor', '1', '1', '1', '0.06', '1', '0.083', '', '', '3'),
(268, 113, 34, 'Chief / Supervisor', '1', '3940973', '300000', '245916.72', '51500', '328414.417', '', '', '4866804'),
(269, 113, 34, 'Komandan Regu (DANRU)', '3', '3940973', '200000', '245916.72', '51500', '328414.417', '', '', '14300412'),
(270, 113, 34, 'Anggota', '14', '3940973', '0', '245916.72', '51500', '328414.417', '', '0', '63935258'),
(271, 97, 33, 'Komandan Regu (DANRU)', '2', '20', '20', '1.25', '20', '1.667', '', '', '126'),
(272, 97, 33, 'Anggota', '3', '30', '30', '1.87', '30', '2.5', '10', '2000', '283');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_biayapendukung`
--

CREATE TABLE `tbl_biayapendukung` (
  `id_biaya` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `kategori` varchar(30) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `total` varchar(5) NOT NULL,
  `harga` varchar(20) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `jumlah_libur` varchar(5) NOT NULL,
  `nilai_pendukung` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_biayapendukung`
--

INSERT INTO `tbl_biayapendukung` (`id_biaya`, `id_kontrak`, `id_presentasi`, `kategori`, `keterangan`, `total`, `harga`, `qty`, `jumlah_libur`, `nilai_pendukung`) VALUES
(56, 91, 35, 'Hari Libur Nasional', '15 hari', '17', '120000', '12', '15', '2550000'),
(58, 93, 37, '1', '1', '1', '1', '1', '', '1'),
(64, 97, 33, 'Seragam', 'SSS', '4', '4', '4', '', '4'),
(65, 97, 33, 'Hari Libur Nasional', 'oke', '3', '30', '3', '5', '150'),
(68, 93, 37, 'Seragam', 'S', '5', '5', '5', '', '5'),
(69, 93, 37, 'Hari Libur Nasional', 'oke', '6', '6', '6', '5', '30'),
(89, 91, 35, 'Peralatan Komunikasi', 'HT', '5', '1100000', '12', '', '458333'),
(92, 91, 35, 'Seragam', 'Baju', '4', '4', '4', '', '4'),
(93, 91, 35, 'Seragam', 'Celana', '3', '3', '3', '', '3'),
(94, 108, 34, 'Seragam', 'celana', '2', '2', '2', '', '2'),
(95, 108, 34, 'Seragam ', 'Baju', '3', '3', '3', '', '3'),
(96, 108, 34, 'Perlengkapan', 'HT', '4', '4', '4', '', '4'),
(97, 108, 34, 'Hari Libur Nasional', '15 hari', '3', '3', '3', '10', '30'),
(99, 113, 34, 'Seragam', 'Seragam', '18', '1200000', '12', '', '1800000'),
(100, 113, 34, 'Peralatan Komunikasi', 'Radio', '6', '1200000', '24', '', '300000'),
(101, 113, 34, 'Persediaan', 'ATK', '1', '200000', '1', '', '200000'),
(102, 113, 34, 'Pelatihan', 'Pelatihan Rutin', '18', '15000', '1', '', '270000'),
(103, 97, 33, 'zzzz', 'zzzzz', '5', '5', '5', '', '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_daftarpersonil`
--

CREATE TABLE `tbl_daftarpersonil` (
  `id_personil` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nik` varchar(30) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status_diri` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sertifikat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_daftarpersonil`
--

INSERT INTO `tbl_daftarpersonil` (`id_personil`, `id_nilai`, `id_presentasi`, `id_kontrak`, `foto`, `jabatan`, `status`, `nama`, `nik`, `agama`, `status_diri`, `alamat`, `telp`, `email`, `sertifikat`) VALUES
(5, 210, 35, 91, '20190809172656WhatsApp Image 2019-07-28 at 21.10.28.jpeg', 'Chief / Supervisor', 'Terkontrak', 'Asep', '1234', 'KRISTEN', 'LAJANG', 'Jakarta', '124', '', ''),
(6, 211, 35, 91, '20190809172757WhatsApp Image 2019-07-28 at 21.10.28.jpeg', 'Komandan Regu (DANRU)', 'Terkontrak', 'Jajang', '1234', 'KRISTEN', 'BERKELUARGA', 'Po', '124', '', ''),
(7, 212, 35, 91, '20190817083454', 'Anggota', 'Terkontrak', 'zzzzzzzz', '213123', 'ISLAM', 'BERKELUARGA', 'oke', '1234', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kaskeluar`
--

CREATE TABLE `tbl_kaskeluar` (
  `id_kaskeluar` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` varchar(20) NOT NULL,
  `total` varchar(10) NOT NULL,
  `total_harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kaskeluar`
--

INSERT INTO `tbl_kaskeluar` (`id_kaskeluar`, `keterangan`, `tanggal`, `harga`, `total`, `total_harga`) VALUES
(1, 'Baju', '2019-08-14', '20000', '10', '200000'),
(4, 'Rompi', '2019-09-12', '13500', '10', '135000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasmasuk`
--

CREATE TABLE `tbl_kasmasuk` (
  `id_kasmasuk` int(11) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `harga` varchar(20) NOT NULL,
  `total` varchar(10) NOT NULL,
  `total_harga` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kasmasuk`
--

INSERT INTO `tbl_kasmasuk` (`id_kasmasuk`, `keterangan`, `tanggal`, `harga`, `total`, `total_harga`) VALUES
(2, 'celana2', '2019-08-07', '20000', '40', '800000'),
(3, 'Baju', '2019-08-06', '20000', '10', '200000'),
(4, 'Rompi', '2019-08-08', '1220', '12', '14640'),
(5, 'sepatu', '2019-08-05', '10000', '13', '130000'),
(6, 'Baju', '2019-07-09', '10000', '20', '200000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontrakclient`
--

CREATE TABLE `tbl_kontrakclient` (
  `id_kontrak` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `mulai_kontrak` date NOT NULL,
  `akhir_kontrak` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `nilai_kontrak` varchar(255) NOT NULL,
  `minta_personil` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kontrakclient`
--

INSERT INTO `tbl_kontrakclient` (`id_kontrak`, `id_presentasi`, `mulai_kontrak`, `akhir_kontrak`, `status`, `nilai_kontrak`, `minta_personil`) VALUES
(91, 35, '2019-08-05', '2019-09-04', 'Terkontrak', '94155691', '22'),
(93, 37, '2019-08-06', '2019-09-06', 'Terkontrak', '33090', '6'),
(97, 33, '2019-08-07', '2019-09-03', 'Terkontrak', '5641', '8'),
(113, 34, '2019-07-30', '2019-09-05', 'Terkontrak', '103663693', '18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kontrakhabis`
--

CREATE TABLE `tbl_kontrakhabis` (
  `id_kontrak` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `mulai_kontrak` date NOT NULL,
  `akhir_kontrak` date NOT NULL,
  `status` varchar(100) NOT NULL,
  `nilai_kontrak` varchar(255) NOT NULL,
  `minta_personil` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_kontrakhabis`
--

INSERT INTO `tbl_kontrakhabis` (`id_kontrak`, `id_presentasi`, `mulai_kontrak`, `akhir_kontrak`, `status`, `nilai_kontrak`, `minta_personil`) VALUES
(108, 34, '2019-07-29', '2019-07-01', 'Tidak Terkontrak', '66216', '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_personiloff`
--

CREATE TABLE `tbl_personiloff` (
  `id_personil` int(11) NOT NULL,
  `id_nilai` int(11) NOT NULL,
  `id_presentasi` int(11) NOT NULL,
  `id_kontrak` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jabatan` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `agama` varchar(20) NOT NULL,
  `status_diri` varchar(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sertifikat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_presentasiclient`
--

CREATE TABLE `tbl_presentasiclient` (
  `id_presentasi` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `pemilik_perusahaan` varchar(100) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `telp_perusahaan` varchar(20) NOT NULL,
  `email_perusahaan` varchar(255) NOT NULL,
  `tgl_presentasi` date NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_presentasiclient`
--

INSERT INTO `tbl_presentasiclient` (`id_presentasi`, `nama_perusahaan`, `pemilik_perusahaan`, `alamat_perusahaan`, `telp_perusahaan`, `email_perusahaan`, `tgl_presentasi`, `status`) VALUES
(33, 'PT. Taruna Mandiri', 'Senjoyo', 'Tangerang - Indonesia', '123456789', 'perusahaan@gmail.com', '2019-06-05', 'Berhasil'),
(34, 'PT. Taman Melati', 'Sentosa', 'Margonda - Indonesia', '123456789', 'perusahaan@gmail.com', '2019-06-06', 'Berhasil'),
(35, 'PT. Mayapada', 'Tomas', 'Jakarta - Indonesia', '123456789', 'perusahaan@gmail.com', '2019-06-11', 'Berhasil'),
(37, 'Rumah Sakit Permata Pamulang', 'Alex', 'Pamulang - Tangerang Selatan', '123456789', 'perusahaan@gmail.com', '0000-00-00', 'Berhasil'),
(38, 'oke', '2', '22', '2', '2@gmail.com', '0000-00-00', 'Berhasil'),
(40, '2', '2', '2', '2', '2@gmail.com', '0000-00-00', 'Berhasil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suratkeluar`
--

CREATE TABLE `tbl_suratkeluar` (
  `id_suratkeluar` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suratkeluar`
--

INSERT INTO `tbl_suratkeluar` (`id_suratkeluar`, `no_surat`, `tgl_surat`, `perihal`, `tujuan`, `alamat`, `upload`) VALUES
(3, '12', '2019-07-31', '12', '12', '12', 'Daftar Personil - PT. Taruna Mandiri (1).pdf'),
(4, '3', '2019-07-31', '3', '3', '3', '4 No HP PPSPPT Karawaci 17 juli 2019.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suratmasuk`
--

CREATE TABLE `tbl_suratmasuk` (
  `id_suratmasuk` int(11) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_surat` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suratmasuk`
--

INSERT INTO `tbl_suratmasuk` (`id_suratmasuk`, `no_surat`, `perihal`, `pengirim`, `tgl_masuk`, `tgl_surat`, `alamat`, `upload`) VALUES
(12, '1', '123', '123', '2019-07-17', '2019-08-01', '123', 'customized_pdf_file_name (1).pdf'),
(13, '3', '3', '3', '2019-07-27', '2019-07-27', '3', 'IMG-20160830-WA0024.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surattugas`
--

CREATE TABLE `tbl_surattugas` (
  `id_surattugas` int(11) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `tgl_surat` date NOT NULL,
  `kegiatan` varchar(100) NOT NULL,
  `tempat` varchar(100) NOT NULL,
  `tgl_kegiatan` date NOT NULL,
  `upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `tbl_biayagaji`
--
ALTER TABLE `tbl_biayagaji`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_presentasi` (`id_presentasi`);

--
-- Indexes for table `tbl_biayapendukung`
--
ALTER TABLE `tbl_biayapendukung`
  ADD PRIMARY KEY (`id_biaya`),
  ADD KEY `id_presentasi` (`id_presentasi`);

--
-- Indexes for table `tbl_daftarpersonil`
--
ALTER TABLE `tbl_daftarpersonil`
  ADD PRIMARY KEY (`id_personil`),
  ADD KEY `id_nilai` (`id_nilai`),
  ADD KEY `id_presentasi` (`id_presentasi`),
  ADD KEY `id_kontrak` (`id_kontrak`);

--
-- Indexes for table `tbl_kaskeluar`
--
ALTER TABLE `tbl_kaskeluar`
  ADD PRIMARY KEY (`id_kaskeluar`);

--
-- Indexes for table `tbl_kasmasuk`
--
ALTER TABLE `tbl_kasmasuk`
  ADD PRIMARY KEY (`id_kasmasuk`);

--
-- Indexes for table `tbl_kontrakclient`
--
ALTER TABLE `tbl_kontrakclient`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `id_presentasi` (`id_presentasi`);

--
-- Indexes for table `tbl_kontrakhabis`
--
ALTER TABLE `tbl_kontrakhabis`
  ADD PRIMARY KEY (`id_kontrak`),
  ADD KEY `id_presentasi` (`id_presentasi`);

--
-- Indexes for table `tbl_personiloff`
--
ALTER TABLE `tbl_personiloff`
  ADD PRIMARY KEY (`id_personil`),
  ADD KEY `id_kontrak` (`id_kontrak`),
  ADD KEY `id_nilai` (`id_nilai`),
  ADD KEY `id_presentasi` (`id_presentasi`);

--
-- Indexes for table `tbl_presentasiclient`
--
ALTER TABLE `tbl_presentasiclient`
  ADD PRIMARY KEY (`id_presentasi`);

--
-- Indexes for table `tbl_suratkeluar`
--
ALTER TABLE `tbl_suratkeluar`
  ADD PRIMARY KEY (`id_suratkeluar`);

--
-- Indexes for table `tbl_suratmasuk`
--
ALTER TABLE `tbl_suratmasuk`
  ADD PRIMARY KEY (`id_suratmasuk`);

--
-- Indexes for table `tbl_surattugas`
--
ALTER TABLE `tbl_surattugas`
  ADD PRIMARY KEY (`id_surattugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_biayagaji`
--
ALTER TABLE `tbl_biayagaji`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;

--
-- AUTO_INCREMENT for table `tbl_biayapendukung`
--
ALTER TABLE `tbl_biayapendukung`
  MODIFY `id_biaya` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_daftarpersonil`
--
ALTER TABLE `tbl_daftarpersonil`
  MODIFY `id_personil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kaskeluar`
--
ALTER TABLE `tbl_kaskeluar`
  MODIFY `id_kaskeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_kasmasuk`
--
ALTER TABLE `tbl_kasmasuk`
  MODIFY `id_kasmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_kontrakclient`
--
ALTER TABLE `tbl_kontrakclient`
  MODIFY `id_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `tbl_kontrakhabis`
--
ALTER TABLE `tbl_kontrakhabis`
  MODIFY `id_kontrak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `tbl_personiloff`
--
ALTER TABLE `tbl_personiloff`
  MODIFY `id_personil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_presentasiclient`
--
ALTER TABLE `tbl_presentasiclient`
  MODIFY `id_presentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_suratkeluar`
--
ALTER TABLE `tbl_suratkeluar`
  MODIFY `id_suratkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_suratmasuk`
--
ALTER TABLE `tbl_suratmasuk`
  MODIFY `id_suratmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_surattugas`
--
ALTER TABLE `tbl_surattugas`
  MODIFY `id_surattugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_biayagaji`
--
ALTER TABLE `tbl_biayagaji`
  ADD CONSTRAINT `tbl_biayagaji_ibfk_2` FOREIGN KEY (`id_presentasi`) REFERENCES `tbl_presentasiclient` (`id_presentasi`);

--
-- Constraints for table `tbl_biayapendukung`
--
ALTER TABLE `tbl_biayapendukung`
  ADD CONSTRAINT `tbl_biayapendukung_ibfk_2` FOREIGN KEY (`id_presentasi`) REFERENCES `tbl_presentasiclient` (`id_presentasi`);

--
-- Constraints for table `tbl_daftarpersonil`
--
ALTER TABLE `tbl_daftarpersonil`
  ADD CONSTRAINT `tbl_daftarpersonil_ibfk_1` FOREIGN KEY (`id_nilai`) REFERENCES `tbl_biayagaji` (`id_nilai`),
  ADD CONSTRAINT `tbl_daftarpersonil_ibfk_2` FOREIGN KEY (`id_presentasi`) REFERENCES `tbl_presentasiclient` (`id_presentasi`),
  ADD CONSTRAINT `tbl_daftarpersonil_ibfk_3` FOREIGN KEY (`id_kontrak`) REFERENCES `tbl_kontrakclient` (`id_kontrak`);

--
-- Constraints for table `tbl_kontrakclient`
--
ALTER TABLE `tbl_kontrakclient`
  ADD CONSTRAINT `tbl_kontrakclient_ibfk_1` FOREIGN KEY (`id_presentasi`) REFERENCES `tbl_presentasiclient` (`id_presentasi`);

--
-- Constraints for table `tbl_personiloff`
--
ALTER TABLE `tbl_personiloff`
  ADD CONSTRAINT `tbl_personiloff_ibfk_1` FOREIGN KEY (`id_kontrak`) REFERENCES `tbl_kontrakhabis` (`id_kontrak`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
