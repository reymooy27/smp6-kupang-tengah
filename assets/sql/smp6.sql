-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2023 at 10:47 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sma6`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nama_guru` varchar(250) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL DEFAULT current_timestamp(),
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Kristen','Katolik','Islam','Hindu','Budha') NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `nip` bigint(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nama_guru`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `jabatan`, `alamat`, `no_telp`, `id_mapel`, `id_kelas`, `nip`) VALUES
(8, 'KAREL ABRAHAM', 'Jakarta', '2023-01-01', 'Laki-Laki', 'Islam', '', '', '', 5, 35, 823242387628637486),
(13, 'SILVAni', '', '0000-00-00', '', '', '', '', '', 4, 34, 987293847982374239);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(50) NOT NULL,
  `waktu_mulai` time NOT NULL DEFAULT current_timestamp(),
  `waktu_selesai` time NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `waktu_mulai`, `waktu_selesai`, `id_mapel`, `id_kelas`, `id_guru`) VALUES
(4, 'Selasa', '23:38:00', '02:37:00', 3, 35, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `thn_semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `thn_semester`) VALUES
(34, 'IPA 1', ''),
(35, 'IPS 1', ''),
(36, 'IPA II', ''),
(37, 'XI IPA I', ''),
(38, 'X IPS I', '');

-- --------------------------------------------------------

--
-- Table structure for table `mapel`
--

CREATE TABLE `mapel` (
  `id_mapel` int(11) NOT NULL,
  `nama_mapel` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mapel`
--

INSERT INTO `mapel` (`id_mapel`, `nama_mapel`) VALUES
(3, 'Matematika'),
(4, 'Fisika');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `nilai` int(100) NOT NULL,
  `ulangan` int(20) NOT NULL,
  `thn_semseter` varchar(20) NOT NULL,
  `uts` int(100) NOT NULL,
  `uas` int(100) NOT NULL,
  `id_mapel` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `nilai`, `ulangan`, `thn_semseter`, `uts`, `uas`, `id_mapel`, `id_siswa`, `approved`) VALUES
(2, 10, 80, '', 80, 80, 3, 51, 0),
(3, 80, 80, '80', 88, 80, 4, 51, 1),
(7, 70, 34, '', 50, 60, 4, 52, 0),
(8, 0, 20, '', 0, 0, 4, 54, 0),
(9, 0, 34, '', 0, 0, 4, 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nis` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(250) NOT NULL,
  `tanggal_lahir` date NOT NULL DEFAULT current_timestamp(),
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `agama` enum('Kristen','Katolik','Islam','Hindu','Budha') NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `nama_ayah` varchar(250) NOT NULL,
  `nama_ibu` varchar(250) NOT NULL,
  `pekerjaan_ayah` varchar(50) NOT NULL,
  `pekerjaan_ibu` varchar(50) NOT NULL,
  `thn_semester` varchar(10) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `kelasId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nis`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `alamat`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `thn_semester`, `no_telp`, `kelasId`) VALUES
(50, '', 'DWD', '', '0000-00-00', 'Laki-Laki', '', '', '', '', '', '', '', '', 35),
(51, '88237486', 'RA MI RAN NA', 'Kupang', '2023-02-01', 'Perempuan', 'Katolik', 'Jln Semangkan', 'Ayub Saka', 'Melina Bual', 'Pilot', 'Pramugari', '', '083274348732', 34),
(52, '8783947982', 'IRA SELINA', 'Soe', '2023-01-01', 'Perempuan', 'Katolik', 'Jln Tidur', 'Ferdinand', 'Anisa', 'PNS', 'Guru', '', '082234475758', 34),
(53, '897298374', 'SINTA', '', '0000-00-00', '', '', '', '', '', '', '', '', '', 38),
(54, '8738792874', 'SELENA GOMEZ', 'Jakarta Utara', '2023-01-01', 'Perempuan', '', 'Jln Sedang', '', '', '', '', '', '', 34);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `role` enum('Guru','Kepsek','Admin','Siswa') NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `isAdmin`, `role`, `id_guru`, `id_siswa`) VALUES
(8, 'Admin', 'admin', 'admin', 1, 'Admin', 0, 0),
(10, 'Ayu', 'user', 'user', 0, '', 0, 0),
(13, 'SILVA', 'silva', 'password', 0, 'Guru', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wali_kelas`
--

CREATE TABLE `wali_kelas` (
  `id_wakel` int(11) NOT NULL,
  `id_guru` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`id_mapel`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`),
  ADD UNIQUE KEY `id` (`id_siswa`),
  ADD KEY `kelasId` (`kelasId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  ADD PRIMARY KEY (`id_wakel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `mapel`
--
ALTER TABLE `mapel`
  MODIFY `id_mapel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wali_kelas`
--
ALTER TABLE `wali_kelas`
  MODIFY `id_wakel` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kelasId`) REFERENCES `kelas` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
