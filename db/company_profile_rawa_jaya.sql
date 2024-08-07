-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 12:53 PM
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
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bantuan_sosial`
--

INSERT INTO `tbl_bantuan_sosial` (`id`, `id_penduduk`, `tipe_bantuan`, `status_pengajuan`, `keterangan_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 7, 'pendidikan', 'belum_diproses', '', '2024-07-10 00:26:50', NULL),
(2, 7, 'PKH', 'belum_diproses', '', '2024-07-10 00:29:05', NULL),
(3, 8, 'BLT', 'belum_diproses', '', '2024-07-10 00:29:16', NULL),
(5, 11, 'BLT', 'sudah_diproses', 'Acc', '2024-07-10 23:32:57', NULL),
(9, 14, 'pendidikan', 'sudah_diproses', 'ACC', '2024-08-03 09:04:43', '2024-08-03 09:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen_kk`
--

CREATE TABLE `tbl_dokumen_kk` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_kartu_keluarga` int(10) UNSIGNED NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dokumen_kk`
--

INSERT INTO `tbl_dokumen_kk` (`id`, `id_kartu_keluarga`, `status_pengajuan`, `keterangan_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 1, 'belum_diproses', '', '2024-07-09 22:13:52', '2024-07-10 22:55:29');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dokumen_ktp`
--

CREATE TABLE `tbl_dokumen_ktp` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL DEFAULT 'belum_diproses',
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_dokumen_ktp`
--

INSERT INTO `tbl_dokumen_ktp` (`id`, `id_penduduk`, `status_pengajuan`, `keterangan_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 7, 'belum_diproses', '', '2024-07-09 09:10:40', NULL),
(2, 7, 'sudah_diproses', '', '2024-07-09 09:24:10', NULL);

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
  `nik_kepala_keluarga` varchar(16) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kartu_keluarga`
--

INSERT INTO `tbl_kartu_keluarga` (`id`, `nomor_kk`, `nik_kepala_keluarga`, `created_at`, `updated_at`) VALUES
(1, '1814068529145487', '1671029837882233', '2024-07-09 21:32:47', NULL),
(7, '1814067189145487', '1234567890267354', '2024-08-03 09:23:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kepala_desa`
--

CREATE TABLE `tbl_kepala_desa` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_pengguna` int(10) UNSIGNED DEFAULT NULL,
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

INSERT INTO `tbl_kepala_desa` (`id`, `id_pengguna`, `id_pangkat_golongan`, `id_pendidikan`, `id_jurusan_pendidikan`, `nip`, `nama_kepala_desa`, `jk`, `alamat`, `tmp_lahir`, `tgl_lahir`, `tahun_ijazah`, `created_at`, `updated_at`) VALUES
(1, 25, 1, 9, 4, '196506121990022003', 'Sukarti', 'l', 'Palembang', 'Palembang', '2024-05-01', 2009, '2024-05-23 08:29:39', '2024-06-27 18:20:41'),
(4, 48, 9, 9, 4, '199204202015031006', 'Della Rizky Andini', 'l', 'Plaju', 'Palembang', '2024-05-06', 2014, '2024-05-25 17:52:18', '2024-08-03 09:21:22'),
(5, NULL, 9, 9, 4, '198912252019022005', 'Sudaryani', 'p', 'Plaju', 'Prabumulih', '2020-04-30', 2011, '2024-05-25 17:53:27', '2024-06-24 12:11:48'),
(6, NULL, 9, 9, 4, '1988103020201901', 'Sulastinah', 'p', 'Plaju', 'Prabumulih', '2024-05-05', 2010, '2024-05-26 09:59:45', '2024-06-24 12:11:48'),
(7, NULL, 5, 10, 37, '1234567890123456', 'Abdul Kadir, M.Kom.', 'l', 'Depok', 'Depok', '2024-04-30', 2010, '2024-06-10 15:46:11', '2024-06-24 12:14:30'),
(8, NULL, 5, 9, 33, '9999999999888777', 'Nur Widyasti', 'p', 'Palembang', 'Palembang', '2024-03-31', 2010, '2024-06-10 18:02:33', '2024-06-24 12:14:30'),
(9, NULL, 4, 9, 34, '1979762520140320', 'Susmayasari', 'p', 'Palembang', 'Palembang', '2024-05-26', 2014, '2024-06-10 19:01:29', '2024-06-24 12:14:30'),
(10, 35, 4, 9, 4, '1989986520190220', 'Nunsianah', 'p', 'Plaju', 'Palembang', '2024-05-26', 2010, '2024-06-10 19:02:12', '2024-06-27 14:46:25');

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
  `id_kartu_keluarga` int(10) UNSIGNED DEFAULT NULL,
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
  `status_validasi` enum('belum_divalidasi','sudah_divalidasi') NOT NULL,
  `keterangan_validasi` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_penduduk`
--

INSERT INTO `tbl_penduduk` (`id`, `id_kartu_keluarga`, `nik`, `nama_lengkap`, `jk`, `tmp_lahir`, `tgl_lahir`, `warga_negara`, `agama`, `pekerjaan`, `alamat`, `email`, `status_validasi`, `keterangan_validasi`, `created_at`, `updated_at`) VALUES
(7, 1, '1671029837882233', 'Okta Alfiansyah', 'l', 'Palembang', '1990-10-10', 'WNI', 'islam', 'Web Developer', 'kertapati', 'oktaalfiansyah@gmail.com', 'sudah_divalidasi', 'acc', '2024-07-09 02:02:23', '2024-07-10 01:59:45'),
(8, NULL, '1671762837882233', 'Bima Satria', 'l', 'Palembang', '1999-08-28', 'WNI', 'islam', 'Gudang Shopee', 'Palembang', 'bimasatria@gmail.com', 'belum_divalidasi', '', '2024-07-09 09:23:22', '2024-07-10 01:25:52'),
(10, 1, '6575149193547929', 'Carl Johnson', 'l', 'Palembang', '2001-01-01', 'WNI', 'islam', 'Criminal', 'Los Santos', 'carljohnson@gmail.com', 'belum_divalidasi', '', '2024-07-10 01:32:57', NULL),
(11, NULL, '343497831960926', 'Razor', 'l', 'Tennese', '1990-03-01', 'WNI', 'islam', 'Expert Driver', 'Tennese', 'Razor@gmail.com', 'belum_divalidasi', 'aaaa', '2024-07-10 08:02:25', '2024-07-11 11:32:34'),
(14, NULL, '1234567890267354', 'Test Penduduk Baru', 'l', 'Palembang', '2024-08-14', 'WNI', 'islam', 'Buruh', 'kertapati', 'test_penduduk_baru@gmail.com', 'sudah_divalidasi', '', '2024-08-03 09:03:37', '2024-08-03 09:24:20');

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
(9, 'admin', '$2y$10$r6i9ouw57cTTevcboVpfxuaaeGE.LqvH0ivtFunGnpjhus3jtxu1q', 'admin', '2024-06-10 14:42:24', '2024-08-03 05:52:30'),
(25, '196506121990022003', '$2y$10$r6i9ouw57cTTevcboVpfxuaaeGE.LqvH0ivtFunGnpjhus3jtxu1q', 'kepala_desa', '2024-06-24 18:29:06', '2024-08-03 05:52:34'),
(35, '1989986520190220', '$2y$10$LrNrbSt9hTDGlwWP8vEpj.axs3qGn0aWFd4UYcjL.w5q79LY3Ouiy', 'kepala_desa', '2024-06-27 14:46:25', '2024-07-11 06:41:06'),
(48, '199204202015031006', '$2y$10$tdolvI.ZurKGCU7RUbyg2.p4mW1A7xkGq.W8ftvxbh5ptdIjtqkma', 'kepala_desa', '2024-08-03 09:21:22', NULL);

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
(1, 'Perbaikan Jalan X', 'Memperbaiki jalan rusak di alamat X', 'Akses jalan utama warga dapat kembali digunakan', '1. Tahapan ke-1\r\n2. Tahapan ke-2\r\n3. Tahapan ke-3\r\n4. Tahapan ke-4', '#### Anggaran\r\nRpxx.000.000.000\r\n\r\n#### Detail ke-1\r\nteks detail ke-1\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.\r\n\r\n#### Detail ke-2\r\nteks detail ke-2\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.\r\n\r\n#### Detail ke-3\r\nteks detail ke-3\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Illum reprehenderit repellendus ea officia quidem exercitationem, quia et explicabo alias, autem sapiente odit quasi, tenetur corporis necessitatibus laborum sequi temporibus quos.', 'sedang_dikerjakan', '2018-02-07', '2024-07-07 23:12:55', '2024-07-08 05:11:00'),
(3, 'Pembangunan Parit di Jalan Y', 'Membebaskan desa dari masalah banjir tahunan', 'Mencegah banjir, menjaga lingkungan agar tetap bersih', 'Adapun tahapan dalam realisasi parit di jalan Y di antaranya sebagai berikut:\r\n1. Abcdefgh\r\n2. Ijklmnopqrstu\r\n3. Vwxyz', '#### Anggaran\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ullam at enim quisquam praesentium vel illo, quod eum harum unde impedit omnis veniam dolor nihil maxime molestias a aspernatur molestiae?\r\n\r\n#### Ketua Pelaksana\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ullam at enim quisquam praesentium vel illo, quod eum harum unde impedit omnis veniam dolor nihil maxime molestias a aspernatur molestiae?\r\n\r\n#### Penanggung Jawab\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ullam at enim quisquam praesentium vel illo, quod eum harum unde impedit omnis veniam dolor nihil maxime molestias a aspernatur molestiae?\r\n\r\n#### Daftar Pekerja\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ullam at enim quisquam praesentium vel illo, quod eum harum unde impedit omnis veniam dolor nihil maxime molestias a aspernatur molestiae?\r\n1. kjnjnknk\r\n2. kjjknkjnkjn\r\n3. nknkjnjknj\r\n\r\n#### Lokasi\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo ullam at enim quisquam praesentium vel illo, quod eum harum unde impedit omnis veniam dolor nihil maxime molestias a aspernatur molestiae?', 'akan_dikerjakan', '2020-05-01', '2024-07-08 05:17:57', '2024-07-08 05:19:57'),
(4, 'Test Proyek Baru', 'Mengenalkan Proyek Baru', 'Mengetahui Proyek Baru', '### Ini Judul Proyek\r\nIni adalah paragraf proyek. Untuk menambahkan baris baru, cukup tambahkan frasa  \\`<br />\\` seperti ini\r\nini adalah baris selanjutnya dari baris pertama.\r\n\r\n### Ini Judul Proyek Kedua\r\nlasdklasdkalsdjsalkj', '#### Langkah Pengerjaan\r\n1. Cara pertama\r\n2. Cara kedua\r\n3. Cara ketiga\r\n4. ...\r\n5. Cara ke-n', 'sedang_dikerjakan', '2024-08-03', '2024-08-03 09:28:01', '2024-08-03 09:50:29');

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
(1, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-06 23:45:11', '2024-07-08 05:27:07'),
(2, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:30:03', NULL),
(3, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:42:24', NULL),
(4, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 0, '2024-07-07 00:52:38', NULL),
(5, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 1, '2024-07-07 00:54:13', '2024-07-08 01:14:21'),
(6, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test pesan', 1, '2024-07-07 00:55:53', '2024-07-08 05:26:52'),
(7, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'Test Perihal Pimpinan', 'test', 0, '2024-07-07 23:50:57', '2024-07-08 01:13:26'),
(9, 'Carl Johnson', 'carl@johnson.com', 'Perbaikan jalan X', 'Mohon perbaikan jalannya dipercepat, Pak!', 0, '2024-07-08 01:30:16', '2024-07-10 08:59:11'),
(10, 'Okta Alfiansyah', 'oktaalfiansyah@gmail.com', 'test perihal', 'test', 0, '2024-07-11 11:23:31', '2024-08-03 09:24:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_domisili`
--

CREATE TABLE `tbl_surat_domisili` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL,
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_surat_domisili`
--

INSERT INTO `tbl_surat_domisili` (`id`, `id_penduduk`, `status_pengajuan`, `keterangan_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 7, 'belum_diproses', 'acc', '2024-07-09 21:24:33', '2024-07-10 08:18:49'),
(3, 8, 'belum_diproses', '', '2024-07-10 08:43:58', NULL),
(4, 14, 'sudah_diproses', 'Acc', '2024-08-03 09:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keramaian`
--

CREATE TABLE `tbl_surat_keramaian` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_penduduk` int(10) UNSIGNED NOT NULL,
  `perihal` varchar(128) NOT NULL,
  `status_pengajuan` enum('belum_diproses','sudah_diproses') NOT NULL DEFAULT 'belum_diproses',
  `keterangan_pengajuan` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_surat_keramaian`
--

INSERT INTO `tbl_surat_keramaian` (`id`, `id_penduduk`, `perihal`, `status_pengajuan`, `keterangan_pengajuan`, `created_at`, `updated_at`) VALUES
(1, 7, 'test', 'belum_diproses', '', '2024-07-09 05:38:32', NULL),
(2, 8, 'Test perihal Bima', 'belum_diproses', '', '2024-07-09 20:41:02', NULL),
(3, 8, 'Test perihal Bima kedua', 'belum_diproses', 'Pengajuan sedang diproses, harap tunggu.', '2024-07-09 20:41:23', '2024-07-09 20:48:32'),
(5, 14, 'Test Perihal dari Penduduk Baru', 'belum_diproses', '', '2024-08-03 09:04:06', NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kartu_keluarga` (`id_kartu_keluarga`);

--
-- Indexes for table `tbl_dokumen_ktp`
--
ALTER TABLE `tbl_dokumen_ktp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penduduk` (`id_penduduk`);

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
  ADD UNIQUE KEY `nomor_kk` (`nomor_kk`),
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
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `id_kartu_keluarga` (`id_kartu_keluarga`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penduduk` (`id_penduduk`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_dokumen_kk`
--
ALTER TABLE `tbl_dokumen_kk`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_dokumen_ktp`
--
ALTER TABLE `tbl_dokumen_ktp`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jurusan_pendidikan`
--
ALTER TABLE `tbl_jurusan_pendidikan`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_kartu_keluarga`
--
ALTER TABLE `tbl_kartu_keluarga`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tbl_proyek`
--
ALTER TABLE `tbl_proyek`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_saran_dan_masukan`
--
ALTER TABLE `tbl_saran_dan_masukan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_surat_domisili`
--
ALTER TABLE `tbl_surat_domisili`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_surat_keramaian`
--
ALTER TABLE `tbl_surat_keramaian`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bantuan_sosial`
--
ALTER TABLE `tbl_bantuan_sosial`
  ADD CONSTRAINT `tbl_bantuan_sosial_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_dokumen_kk`
--
ALTER TABLE `tbl_dokumen_kk`
  ADD CONSTRAINT `tbl_dokumen_kk_ibfk_1` FOREIGN KEY (`id_kartu_keluarga`) REFERENCES `tbl_kartu_keluarga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `tbl_kartu_keluarga_ibfk_1` FOREIGN KEY (`nik_kepala_keluarga`) REFERENCES `tbl_penduduk` (`nik`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_kepala_desa`
--
ALTER TABLE `tbl_kepala_desa`
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_2` FOREIGN KEY (`id_pangkat_golongan`) REFERENCES `tbl_pangkat_golongan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_3` FOREIGN KEY (`id_pendidikan`) REFERENCES `tbl_pendidikan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_4` FOREIGN KEY (`id_jurusan_pendidikan`) REFERENCES `tbl_jurusan_pendidikan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_kepala_desa_ibfk_5` FOREIGN KEY (`id_pengguna`) REFERENCES `tbl_pengguna` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_penduduk`
--
ALTER TABLE `tbl_penduduk`
  ADD CONSTRAINT `tbl_penduduk_ibfk_1` FOREIGN KEY (`id_kartu_keluarga`) REFERENCES `tbl_kartu_keluarga` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `tbl_surat_domisili`
--
ALTER TABLE `tbl_surat_domisili`
  ADD CONSTRAINT `tbl_surat_domisili_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_surat_keramaian`
--
ALTER TABLE `tbl_surat_keramaian`
  ADD CONSTRAINT `tbl_surat_keramaian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `tbl_penduduk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
