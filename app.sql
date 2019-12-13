-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 07:29 AM
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
-- Database: `app`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_pendaftaran`
--

CREATE TABLE `log_pendaftaran` (
  `pendaftaran_id` int(5) NOT NULL,
  `pst_npm` int(7) NOT NULL,
  `unit_id` int(5) NOT NULL,
  `pendaftaran_status` enum('?','DITERIMA','TIDAK DITERIMA') NOT NULL DEFAULT '?',
  `pendaftaran_tahun` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('82ac3d7f2d65d9f8e1873b16c12a14aa', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 1564032184, 'a:2:{s:9:\"user_data\";s:0:\"\";s:12:\"pst_password\";s:32:\"fcea920f7412b5da7be0cf42b8c93759\";}');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `admin_id` int(5) NOT NULL,
  `admin_username` varchar(20) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`admin_id`, `admin_username`, `admin_password`, `admin_nama`) VALUES
(1, 'jeri', '098f6bcd4621d373cade4e832627b4f6', 'Jeri Ramadhan');

-- --------------------------------------------------------

--
-- Table structure for table `t_deadline`
--

CREATE TABLE `t_deadline` (
  `deadline_id` int(5) NOT NULL,
  `deadline_tgl` date NOT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_kelas`
--

CREATE TABLE `t_kelas` (
  `kelas_id` int(11) NOT NULL,
  `kelas_nama` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_kelas`
--

INSERT INTO `t_kelas` (`kelas_id`, `kelas_nama`) VALUES
(1, '1A');

-- --------------------------------------------------------

--
-- Table structure for table `t_unit`
--

CREATE TABLE `t_unit` (
  `unit_id` int(5) NOT NULL,
  `unit_nama` varchar(30) NOT NULL,
  `unit_desk` text NOT NULL,
  `unit_logo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_unit`
--

INSERT INTO `t_unit` (`unit_id`, `unit_nama`, `unit_desk`, `unit_logo`) VALUES
(1, 'Gedung G UNJ Mahasiswa', 'Sertfikasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_pendaftaran`
--

CREATE TABLE `t_pendaftaran` (
  `pendaftaran_id` int(5) NOT NULL,
  `pst_npm` int(7) NOT NULL,
  `unit_id` int(5) NOT NULL,
  `pendaftaran_status` enum('?','DITERIMA','TIDAK DITERIMA') NOT NULL DEFAULT '?',
  `pendaftaran_tahun` int(10) NOT NULL,
  `batas_akhir` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `t_pendaftaran`
--
DELIMITER $$
CREATE TRIGGER `trigger2` AFTER UPDATE ON `t_pendaftaran` FOR EACH ROW BEGIN
	INSERT INTO log_pendaftaran (pst_npm, unit_id, pendaftaran_status, pendaftaran_tahun) VALUES (new.pst_npm, new.unit_id, new.pendaftaran_status, new.pendaftaran_tahun);
    END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_pengelola`
--

CREATE TABLE `t_pengelola` (
  `pengelola_id` int(5) NOT NULL,
  `pengelola_username` varchar(20) NOT NULL,
  `pengelola_password` varchar(50) NOT NULL,
  `unit_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pengelola`
--

INSERT INTO `t_pengelola` (`pengelola_id`, `pengelola_username`, `pengelola_password`, `unit_id`) VALUES
(1, 'pengelola', '098f6bcd4621d373cade4e832627b4f6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_peserta`
--

CREATE TABLE `t_peserta` (
  `pst_npm` varchar(7) NOT NULL,
  `pst_password` varchar(100) NOT NULL,
  `pst_nama` varchar(30) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `prodi_id` int(5) NOT NULL,
  `pst_tahun_masuk` year(4) NOT NULL,
  `pst_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_peserta`
--

INSERT INTO `t_peserta` (`pst_npm`, `pst_password`, `pst_nama`, `kelas_id`, `prodi_id`, `pst_tahun_masuk`, `pst_foto`) VALUES
('12345', 'fcea920f7412b5da7be0cf42b8c93759', 'Test User', 3, 1, 2019, '');

-- --------------------------------------------------------

--
-- Table structure for table `t_prodi`
--

CREATE TABLE `t_prodi` (
  `prodi_id` int(5) NOT NULL,
  `prodi_nama` varchar(25) NOT NULL,
  `prodi_desk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_prodi`
--

INSERT INTO `t_prodi` (`prodi_id`, `prodi_nama`, `prodi_desk`) VALUES
(1, 'PTIK', 'PTIK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_pendaftaran`
--
ALTER TABLE `log_pendaftaran`
  ADD PRIMARY KEY (`pendaftaran_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `t_deadline`
--
ALTER TABLE `t_deadline`
  ADD PRIMARY KEY (`deadline_id`);

--
-- Indexes for table `t_kelas`
--
ALTER TABLE `t_kelas`
  ADD PRIMARY KEY (`kelas_id`);

--
-- Indexes for table `t_unit`
--
ALTER TABLE `t_unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `t_pendaftaran`
--
ALTER TABLE `t_pendaftaran`
  ADD PRIMARY KEY (`pendaftaran_id`);

--
-- Indexes for table `t_pengelola`
--
ALTER TABLE `t_pengelola`
  ADD PRIMARY KEY (`pengelola_id`);

--
-- Indexes for table `t_peserta`
--
ALTER TABLE `t_peserta`
  ADD PRIMARY KEY (`pst_npm`);

--
-- Indexes for table `t_prodi`
--
ALTER TABLE `t_prodi`
  ADD PRIMARY KEY (`prodi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_pendaftaran`
--
ALTER TABLE `log_pendaftaran`
  MODIFY `pendaftaran_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_admin`
--
ALTER TABLE `t_admin`
  MODIFY `admin_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_deadline`
--
ALTER TABLE `t_deadline`
  MODIFY `deadline_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_kelas`
--
ALTER TABLE `t_kelas`
  MODIFY `kelas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_unit`
--
ALTER TABLE `t_unit`
  MODIFY `unit_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_pendaftaran`
--
ALTER TABLE `t_pendaftaran`
  MODIFY `pendaftaran_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_pengelola`
--
ALTER TABLE `t_pengelola`
  MODIFY `pengelola_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_prodi`
--
ALTER TABLE `t_prodi`
  MODIFY `prodi_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
