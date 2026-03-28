-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 28, 2026 at 04:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbt25`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(1028) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `level` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`id`, `username`, `password`, `nama`, `level`) VALUES
(1, 'K01030098', '243778a3e45875976f29ec9d19450bb2', 'Administrator', 'admin'),
(2, 'K01030098-AKL', '30c87aa2df2fd8fc61079ffc1f10e6cc', 'ADMINISTRATOR AKL', 'adminakl'),
(3, 'K01030098-PM', '30c87aa2df2fd8fc61079ffc1f10e6cc', 'ADMINISTRATOR PM', 'adminbdp'),
(4, 'K01030098-MPLB', '30c87aa2df2fd8fc61079ffc1f10e6cc', 'ADMINISTRATOR MPLB', 'adminotkp'),
(5, 'K01030098-TJKT', '30c87aa2df2fd8fc61079ffc1f10e6cc', 'ADMINISTRATOR TJKT', 'admintkj'),
(6, 'K01030098-DKV', '30c87aa2df2fd8fc61079ffc1f10e6cc', 'ADMINISTRATOR DKV', 'admindkv');

-- --------------------------------------------------------

--
-- Table structure for table `a_jadwal`
--

CREATE TABLE `a_jadwal` (
  `id_jadwal` bigint(24) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `waktu_mulai` time NOT NULL,
  `waktu_selesai` time NOT NULL,
  `durasi` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_jurusan`
--

CREATE TABLE `a_jurusan` (
  `id` int(11) NOT NULL,
  `kode` varchar(8) NOT NULL,
  `jurusan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_jurusan`
--

INSERT INTO `a_jurusan` (`id`, `kode`, `jurusan`) VALUES
(101, 'AKL', 'AKUTANSI KEUANGAN LEMBAGA'),
(202, 'PM', 'PEMASARAN'),
(303, 'MPLB', 'MANAJEMEN PERKANTORAN DAN LAYANAN BISNIS'),
(404, 'TJKT', 'TEKNIK JARINGAN KOMPUTER DAN TELEKOMUNIKASI'),
(505, 'DKV', 'DESAIN KOMUNIKASI VISUAL');

-- --------------------------------------------------------

--
-- Table structure for table `a_kelas`
--

CREATE TABLE `a_kelas` (
  `id` int(11) NOT NULL,
  `kode` varchar(8) NOT NULL,
  `kelas` varchar(128) NOT NULL,
  `slug` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_mapel`
--

CREATE TABLE `a_mapel` (
  `id_mapel` bigint(240) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nama_mapel` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `a_siswa`
--

CREATE TABLE `a_siswa` (
  `id` int(11) NOT NULL,
  `no_peserta` varchar(128) NOT NULL,
  `nama_siswa` varchar(512) NOT NULL,
  `kelas` varchar(250) NOT NULL,
  `jurusan` varchar(8) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `level` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id_bank_soal` int(11) NOT NULL,
  `nama_bank_soal` text NOT NULL,
  `jurusan` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_soal`
--

CREATE TABLE `jadwal_soal` (
  `id_jadwal_soal` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `id_bank_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id_session` int(11) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `ipaddress` varchar(45) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_jawab`
--

CREATE TABLE `siswa_jawab` (
  `id_siswa_jawab` int(11) NOT NULL,
  `id_mapel` int(240) NOT NULL,
  `username` varchar(32) NOT NULL,
  `soal_id` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_login`
--

CREATE TABLE `siswa_login` (
  `id` int(11) NOT NULL,
  `username` varchar(128) DEFAULT NULL,
  `login_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa_status`
--

CREATE TABLE `siswa_status` (
  `id_status_peserta` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `username` text NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id_soal` int(200) NOT NULL,
  `id_bank_soal` int(200) NOT NULL,
  `soal` text NOT NULL,
  `pilA` text NOT NULL,
  `pilB` text NOT NULL,
  `pilC` text NOT NULL,
  `pilD` text NOT NULL,
  `pilE` text NOT NULL,
  `kunci` text NOT NULL,
  `gambar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `token_keluar`
--

CREATE TABLE `token_keluar` (
  `id` int(11) NOT NULL,
  `token_keluar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token_keluar`
--

INSERT INTO `token_keluar` (`id`, `token_keluar`) VALUES
(1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `token_masuk`
--

CREATE TABLE `token_masuk` (
  `id` int(11) NOT NULL,
  `token_masuk` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `token_masuk`
--

INSERT INTO `token_masuk` (`id`, `token_masuk`) VALUES
(1, 'CBT5420');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `a_jadwal`
--
ALTER TABLE `a_jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `a_jurusan`
--
ALTER TABLE `a_jurusan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `a_kelas`
--
ALTER TABLE `a_kelas`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `a_mapel`
--
ALTER TABLE `a_mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `a_siswa`
--
ALTER TABLE `a_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id_bank_soal`);

--
-- Indexes for table `jadwal_soal`
--
ALTER TABLE `jadwal_soal`
  ADD PRIMARY KEY (`id_jadwal_soal`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id_session`),
  ADD UNIQUE KEY `session_id` (`session_id`),
  ADD KEY `idx_session_id` (`session_id`),
  ADD KEY `idx_username` (`username`);

--
-- Indexes for table `siswa_jawab`
--
ALTER TABLE `siswa_jawab`
  ADD PRIMARY KEY (`id_siswa_jawab`);

--
-- Indexes for table `siswa_login`
--
ALTER TABLE `siswa_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `siswa_status`
--
ALTER TABLE `siswa_status`
  ADD PRIMARY KEY (`id_status_peserta`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id_soal`);

--
-- Indexes for table `token_keluar`
--
ALTER TABLE `token_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token_masuk`
--
ALTER TABLE `token_masuk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `a_jurusan`
--
ALTER TABLE `a_jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `a_kelas`
--
ALTER TABLE `a_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1032332626;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa_jawab`
--
ALTER TABLE `siswa_jawab`
  MODIFY `id_siswa_jawab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `siswa_login`
--
ALTER TABLE `siswa_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `siswa_status`
--
ALTER TABLE `siswa_status`
  MODIFY `id_status_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `token_keluar`
--
ALTER TABLE `token_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `token_masuk`
--
ALTER TABLE `token_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
