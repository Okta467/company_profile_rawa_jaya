-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2024 at 03:14 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `company_profile_rawa_jaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bantuan_sosial`
--

CREATE TABLE `tbl_bantuan_sosial` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `tipe_bantuan` enum('PKH','BLT','pendidikan') NOT NULL,
  `status_bantuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_bantuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen_kk`
--

CREATE TABLE `tbl_dokumen_kk` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jk` enum('l','p') NOT NULL,
  `tmp_lahir` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `warga_negara` enum('WNI','WNA') NOT NULL,
  `agama` enum('islam','kristen_protestan','kristen_katolik','hindu','buddha','konghucu','lainnya') NOT NULL,
  `pekerjaan` varchar(128) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen_ktp`
--

CREATE TABLE `tbl_dokumen_ktp` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jabatan`
--

CREATE TABLE `tbl_jabatan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jabatan`
--

INSERT INTO `tbl_jabatan` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Kepala Sekolah', '2024-05-20 12:45:34', NULL),
(2, 'Wakil Kepala Sekolah', '2024-05-20 12:45:34', NULL),
(3, 'Bendahara', '2024-05-20 12:45:34', NULL),
(4, 'Tata Usaha/Administrasi', '2024-05-20 12:45:34', NULL),
(5, 'Wali Kelas', '2024-05-20 12:45:34', NULL),
(6, 'Piket', '2024-05-20 12:45:34', NULL),
(7, 'Bimbingan Konseling', '2024-05-20 12:45:34', NULL),
(8, 'Penjaga Sekolah', '2024-05-20 12:45:34', NULL),
(9, 'Kebersihan', '2024-05-20 12:45:34', '2024-05-20 12:53:45'),
(10, 'Tenaga Administrasi Sekolah', '2024-05-20 12:45:34', NULL),
(11, 'Perpustakaan', '2024-05-20 12:45:34', NULL),
(12, 'Operator', '2024-05-20 12:45:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurusan_pendidikan`
--

CREATE TABLE `tbl_jurusan_pendidikan` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_pendidikan` int(10) UNSIGNED DEFAULT NULL,
  `nama_jurusan` varchar(128) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jurusan_pendidikan`
--

INSERT INTO `tbl_jurusan_pendidikan` (`id`, `id_pendidikan`, `nama_jurusan`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Tidak Ada', '2024-05-11 19:22:50', NULL),
(2, 4, 'IPA', '2024-05-11 19:22:50', '2024-05-13 14:09:23'),
(3, 4, 'IPS', '2024-05-11 19:22:50', '2024-05-13 14:09:34'),
(4, 9, 'Sistem Informasi', '2024-05-11 19:22:50', '2024-05-13 14:09:58'),
(5, 9, 'Psikologi', '2024-05-11 19:22:50', '2024-05-13 14:10:04'),
(8, 4, 'Lainnya', '2024-05-13 14:13:00', NULL),
(9, 5, 'Lainnya', '2024-05-13 14:13:01', NULL),
(10, 6, 'Lainnya', '2024-05-13 14:13:01', NULL),
(11, 7, 'Lainnya', '2024-05-13 14:13:01', NULL),
(12, 8, 'Lainnya', '2024-05-13 14:13:01', NULL),
(13, 9, 'Lainnya', '2024-05-13 14:13:01', NULL),
(14, 10, 'Lainnya', '2024-05-13 14:13:01', NULL),
(15, 11, 'Lainnya', '2024-05-13 14:13:01', NULL),
(16, 9, 'Teknik Elektro', '2024-05-13 16:37:09', NULL),
(28, 8, 'Some \\&quot;\'  string &amp;amp; to Sanitize &amp;lt; !$@%', '2024-05-13 18:05:45', '2024-05-13 18:12:16'),
(29, 9, 'Pendidikan Agama Islam', '2024-05-17 05:11:41', NULL),
(30, 9, 'Hukum', '2024-05-19 18:35:55', NULL),
(32, 9, 'Psikologi', '2024-05-23 04:32:24', NULL),
(33, 9, 'Bahasa Indonesia', '2024-05-23 10:55:19', NULL),
(34, 9, 'Fisika', '2024-05-23 16:27:45', NULL),
(35, 9, 'Matematika', '2024-05-25 17:35:34', NULL),
(36, 9, 'Geografi', '2024-05-26 09:59:36', NULL),
(37, 10, 'Sistem Informasi', '2024-06-10 15:56:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kartu_keluarga`
--

CREATE TABLE `tbl_kartu_keluarga` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `nik_kepala_keluarga` varchar(16) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kepala_desa`
--

CREATE TABLE `tbl_kepala_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pengguna` int(10) UNSIGNED DEFAULT NULL,
  `id_jabatan` int(10) UNSIGNED DEFAULT NULL,
  `id_pangkat_golongan` int(10) UNSIGNED DEFAULT NULL,
  `id_pendidikan` int(10) UNSIGNED DEFAULT NULL,
  `id_jurusan_pendidikan` int(10) UNSIGNED DEFAULT NULL,
  `nip` varchar(18) NOT NULL,
  `nama_kepala_desa` varchar(128) NOT NULL,
  `jk` enum('l','p') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tmp_lahir` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tahun_ijazah` year(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kepala_desa`
--

INSERT INTO `tbl_kepala_desa` (`id`, `id_pengguna`, `id_jabatan`, `id_pangkat_golongan`, `id_pendidikan`, `id_jurusan_pendidikan`, `nip`, `nama_kepala_desa`, `jk`, `alamat`, `tmp_lahir`, `tgl_lahir`, `tahun_ijazah`, `created_at`, `updated_at`) VALUES
(1, 25, 1, 1, 9, 4, '196506121990022003', 'Sukarti', 'l', 'Palembang', 'Palembang', '2024-05-01', 2009, '2024-05-23 08:29:39', '2024-06-27 18:20:41'),
(4, NULL, 5, 9, 9, 4, '199204202015031006', 'Della Rizky Andini', 'l', 'Plaju', 'Palembang', '2024-05-06', 2014, '2024-05-25 17:52:18', '2024-06-24 12:14:30'),
(5, NULL, 5, 9, 9, 4, '198912252019022005', 'Sudaryani', 'p', 'Plaju', 'Prabumulih', '2020-04-30', 2011, '2024-05-25 17:53:27', '2024-06-24 12:11:48'),
(6, NULL, 5, 9, 9, 4, '1988103020201901', 'Sulastinah', 'p', 'Plaju', 'Prabumulih', '2024-05-05', 2010, '2024-05-26 09:59:45', '2024-06-24 12:11:48'),
(7, NULL, 4, 5, 10, 37, '1234567890123456', 'Abdul Kadir, M.Kom.', 'l', 'Depok', 'Depok', '2024-04-30', 2010, '2024-06-10 15:46:11', '2024-06-24 12:14:30'),
(8, NULL, 5, 5, 9, 33, '9999999999888777', 'Nur Widyasti', 'p', 'Palembang', 'Palembang', '2024-03-31', 2010, '2024-06-10 18:02:33', '2024-06-24 12:14:30'),
(9, NULL, 5, 4, 9, 34, '1979762520140320', 'Susmayasari', 'p', 'Palembang', 'Palembang', '2024-05-26', 2014, '2024-06-10 19:01:29', '2024-06-24 12:14:30'),
(10, 35, 5, 4, 9, 4, '1989986520190220', 'Nunsianah', 'p', 'Plaju', 'Palembang', '2024-05-26', 2010, '2024-06-10 19:02:12', '2024-06-27 14:46:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pangkat_golongan`
--

CREATE TABLE `tbl_pangkat_golongan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_pangkat_golongan` varchar(128) NOT NULL,
  `tipe` enum('pns','pppk','gtt','honor') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pangkat_golongan`
--

INSERT INTO `tbl_pangkat_golongan` (`id`, `nama_pangkat_golongan`, `tipe`, `created_at`, `updated_at`) VALUES
(1, 'Golongan Ia (Juru Muda)', 'pns', '2024-05-15 17:21:54', NULL),
(2, 'Golongan Ib (Juru Muda Tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(3, 'Golongan Ic (Juru)', 'pns', '2024-05-15 17:21:54', NULL),
(4, 'Golongan Id (Juru Tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(5, 'Golongan IIa (Pengatur muda)', 'pns', '2024-05-15 17:21:54', NULL),
(6, 'Golongan IIb (Pengatur Muda Tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(7, 'Golongan IIc (Pengatur)', 'pns', '2024-05-15 17:21:54', NULL),
(8, 'Golongan IId (Pengatur tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(9, 'Golongan IIIa (Penata Muda)', 'pns', '2024-05-15 17:21:54', NULL),
(10, 'Golongan IIIb (Penata Muda Tingkat 1)', 'pns', '2024-05-15 17:21:54', NULL),
(11, 'Golongan IIIc (Penata)', 'pns', '2024-05-15 17:21:54', NULL),
(12, 'Golongan IIId (Penata Tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(13, 'Golongan IVa (Pembina)', 'pns', '2024-05-15 17:21:54', NULL),
(14, 'Golongan IVb (Pembina Tingkat I)', 'pns', '2024-05-15 17:21:54', NULL),
(15, 'Golongan IVc (Pembina Muda)', 'pns', '2024-05-15 17:21:54', NULL),
(16, 'Golongan IVd (Pembina Madya)', 'pns', '2024-05-15 17:21:54', NULL),
(17, 'Golongan IVe (Pembina Utama)', 'pns', '2024-05-15 17:21:54', NULL),
(18, 'Tidak ada', NULL, '2024-05-15 18:23:14', '2024-05-20 11:50:30'),
(19, 'PPPK', 'pppk', '2024-05-20 11:36:07', NULL),
(20, 'GTT', 'gtt', '2024-05-20 11:36:07', NULL),
(21, 'Honor', 'honor', '2024-05-20 11:49:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pendidikan`
--

CREATE TABLE `tbl_pendidikan` (
  `id` int(11) UNSIGNED NOT NULL,
  `nama_pendidikan` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pendidikan`
--

INSERT INTO `tbl_pendidikan` (`id`, `nama_pendidikan`, `created_at`, `updated_at`) VALUES
(1, 'tidak_sekolah', '2024-05-11 19:21:02', '2024-05-13 16:25:34'),
(2, 'SD', '2024-05-11 19:21:03', NULL),
(3, 'SMP', '2024-05-11 19:21:03', NULL),
(4, 'SLTA', '2024-05-11 19:21:03', NULL),
(5, 'DI', '2024-05-11 19:21:03', NULL),
(6, 'DII', '2024-05-11 19:21:03', NULL),
(7, 'DIII', '2024-05-11 19:21:03', NULL),
(8, 'DIV', '2024-05-11 19:21:03', NULL),
(9, 'S1', '2024-05-11 19:21:03', NULL),
(10, 'S2', '2024-05-11 19:21:03', NULL),
(11, 'S3', '2024-05-11 19:21:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penduduk`
--

CREATE TABLE `tbl_penduduk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kartu_keluarga` int(10) UNSIGNED NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jk` enum('l','p') NOT NULL,
  `tmp_lahir` varchar(64) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `warga_negara` enum('WNI','WNA') NOT NULL,
  `agama` enum('islam','kristen_protestan','kristen_katolik','hindu','buddha','konghucu','lainnya') NOT NULL,
  `pekerjaan` varchar(128) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(128) NOT NULL,
  `hak_akses` enum('admin','masyarakat','kepala_desa') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pengguna`
--

INSERT INTO `tbl_pengguna` (`id`, `username`, `password`, `hak_akses`, `created_at`, `last_login`) VALUES
(9, 'admin', '$2y$10$r6i9ouw57cTTevcboVpfxuaaeGE.LqvH0ivtFunGnpjhus3jtxu1q', 'admin', '2024-06-10 14:42:24', '2024-07-07 19:30:00'),
(25, '196506121990022003', '$2y$10$r6i9ouw57cTTevcboVpfxuaaeGE.LqvH0ivtFunGnpjhus3jtxu1q', 'kepala_desa', '2024-06-24 18:29:06', '2024-06-27 13:22:34'),
(35, '1989986520190220', '$2y$10$lCU0QfYKZc03cQL4H4xsa.NjTOG/XWEbf5enHT.DP.dlJLsya7tjO', 'kepala_desa', '2024-06-27 14:46:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proyek`
--

CREATE TABLE `tbl_proyek` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_proyek` varchar(128) NOT NULL,
  `tujuan` varchar(1000) NOT NULL,
  `manfaat` varchar(1000) NOT NULL,
  `tahapan` varchar(1000) NOT NULL,
  `detail` varchar(5000) NOT NULL,
  `status_proyek` varchar(128) NOT NULL,
  `tgl_proyek` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_proyek`
--

INSERT INTO `tbl_proyek` (`id`, `nama_proyek`, `tujuan`, `manfaat`, `tahapan`, `detail`, `status_proyek`, `tgl_proyek`, `created_at`, `updated_at`) VALUES
(1, 'Perbaikan Jalan X', 'Memperbaiki jalan rusak di alamat X', 'Akses jalan utama warga dapat kembali digunakan', '1. Tahapan ke-1\r\n2. Tahapan ke-2\r\n3. Tahapan ke-3\r\n4. Tahapan ke-4', '### Anggaran\r\nRpxx.000.000.000\r\n\r\n### Detail ke-1\r\nteks detail ke-1\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.\r\n\r\n### Detail ke-2\r\nteks detail ke-2\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.\r\n\r\n### Detail ke-3\r\nteks detail ke-3\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.', 'sedang_dikerjakan', '2018-02-07', '2024-07-07 23:12:55', '2024-07-07 23:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saran_dan_masukan`
--

CREATE TABLE `tbl_saran_dan_masukan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `pesan` varchar(1000) NOT NULL,
  `status_dibaca` smallint(6) NOT NULL DEFAULT 0 COMMENT '1 = dibaca, 0 = belum dibaca',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_saran_dan_masukan`
--

INSERT INTO `tbl_saran_dan_masukan` (`id`, `nama_lengkap`, `email`, `perihal`, `pesan`, `status_dibaca`, `created_at`, `updated_at`) VALUES
(1, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-06 23:45:11', NULL),
(2, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:30:03', NULL),
(3, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:42:24', NULL),
(4, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:52:38', NULL),
(5, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 1, '2024-07-07 00:54:13', '2024-07-08 01:14:21'),
(6, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 1, '2024-07-07 00:55:53', '2024-07-08 01:14:23'),
(7, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'Test Perihal Pimpinan', 'test', 0, '2024-07-07 23:50:57', '2024-07-08 01:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_domisili`
--

CREATE TABLE `tbl_surat_domisili` (
  `id` int(10) UNSIGNED NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keramaian`
--

CREATE TABLE `tbl_surat_keramaian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bantuan_sosial`
--
ALTER TABLE `tbl_bantuan_sosial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_dokumen_kk`
--
ALTER TABLE `tbl_dokumen_kk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dokumen_ktp`
--
ALTER TABLE `tbl_dokumen_ktp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jurusan_pendidikan`
--
ALTER TABLE `tbl_jurusan_pendidikan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pendidikan` (`id_pendidikan`);

--
-- Indexes for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik_kepala_keluarga` (`nik_kepala_keluarga`);

--
-- Indexes for table `tbl_kepala_desa`
--
ALTER TABLE `tbl_kepala_desa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nip` (`nip`),
  ADD KEY `id_jurusan_pendidikan` (`id_jurusan_pendidikan`),
  ADD KEY `id_pangkat_golongan` (`id_pangkat_golongan`),
  ADD KEY `id_pendidikan` (`id_pendidikan`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- Indexes for table `tbl_pangkat_golongan`
--
ALTER TABLE `tbl_pangkat_golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_saran_dan_masukan`
--
ALTER TABLE `tbl_saran_dan_masukan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_domisili`
--
ALTER TABLE `tbl_surat_domisili`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_keramaian`
--
ALTER TABLE `tbl_surat_keramaian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bantuan_sosial`
--
ALTER TABLE `tbl_bantuan_sosial`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dokumen_kk`
--
ALTER TABLE `tbl_dokumen_kk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_dokumen_ktp`
--
ALTER TABLE `tbl_dokumen_ktp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jabatan`
--
ALTER TABLE `tbl_jabatan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_jurusan_pendidikan`
--
ALTER TABLE `tbl_jurusan_pendidikan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_kepala_desa`
--
ALTER TABLE `tbl_kepala_desa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_pangkat_golongan`
--
ALTER TABLE `tbl_pangkat_golongan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_pendidikan`
--
ALTER TABLE `tbl_pendidikan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_saran_dan_masukan`
--
ALTER TABLE `tbl_saran_dan_masukan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_surat_domisili`
--
ALTER TABLE `tbl_surat_domisili`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_surat_keramaian`
--
ALTER TABLE `tbl_surat_keramaian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bantuan_sosial`
--
ALTER TABLE `tbl_bantuan_sosial`
  ADD CONSTRAINT `tbl_bantuan_sosial_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_dokumen_ktp`
--
ALTER TABLE `tbl_dokumen_ktp`
  ADD CONSTRAINT `tbl_dokumen_ktp_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_jurusan_pendidikan`
--
ALTER TABLE `tbl_jurusan_pendidikan`
  ADD CONSTRAINT `tbl_jurusan_pendidikan_ibfk_1` FOREIGN KEY (`id_pendidikan`) REFERENCES `tbl_pendidikan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
  ADD CONSTRAINT `tbl_kartu_keluarga_ibfk_1` FOREIGN KEY (`nik_kepala_keluarga`) REFERENCES `tbl_penduduk` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kepala_desa`
--
ALTER TABLE `tbl_kepala_desa`
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tbl_jabatan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_2` FOREIGN KEY (`id_pangkat_golongan`) REFERENCES `tbl_pangkat_golongan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_3` FOREIGN KEY (`id_pendidikan`) REFERENCES `tbl_pendidikan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_4` FOREIGN KEY (`id_jurusan_pendidikan`) REFERENCES `tbl_jurusan_pendidikan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_5` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_surat_keramaian`
--
ALTER TABLE `tbl_surat_keramaian`
  ADD CONSTRAINT `tbl_surat_keramaian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
