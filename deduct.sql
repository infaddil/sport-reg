-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 04:55 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendaftaran_acara`
--

-- --------------------------------------------------------

--
-- Table structure for table `acara`
--

CREATE TABLE `acara` (
  `id_acara` int(2) NOT NULL,
  `nama_acara` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acara`
--

INSERT INTO `acara` (`id_acara`, `nama_acara`) VALUES
(1, '100m'),
(2, '200m'),
(3, '400m'),
(4, '800m'),
(5, 'Lompat Jauh'),
(6, 'Lompat Kijang'),
(7, 'Lompat Tinggi'),
(8, 'Rejam Lembing'),
(9, 'Lempar Cakera'),
(10, 'Lontar Peluru');

-- --------------------------------------------------------

--
-- Table structure for table `acara_ahli`
--

CREATE TABLE `acara_ahli` (
  `nokp_murid` varchar(12) NOT NULL,
  `id_acara` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acara_ahli`
--

INSERT INTO `acara_ahli` (`nokp_murid`, `id_acara`) VALUES
('040302010203', 3),
('040302010203', 4),
('040302010203', 5),
('050731010331', 2),
('050731010331', 9),
('050731010331', 10),
('060104010831', 1),
('060201020102', 2),
('060201020102', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ahli`
--

CREATE TABLE `ahli` (
  `nokp_murid` varchar(12) NOT NULL,
  `nama_murid` varchar(60) DEFAULT NULL,
  `id_kelas` int(2) DEFAULT NULL,
  `id_kategori` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ahli`
--

INSERT INTO `ahli` (`nokp_murid`, `nama_murid`, `id_kelas`, `id_kategori`) VALUES
('040302010203', 'Amrul Bin fadlee', 1, 1),
('050731010331', 'musa bin man', 1, 1),
('060104010831', 'AHMAD ASHRAF BIN ABDUL AZIZ', 1, 1),
('060201020102', 'siti', 4, 4),
('060417011093', 'AHMAD SHAFIQ BIN SUHAILIZAM', 2, 1),
('060420011369', 'AHMAD IKMAL BIN AZIZ', 2, 1),
('060620011371', 'AHMAD HAIKAL BIN MD ZAINAL', 2, 1),
('060912010151', 'AHMAD DANIEAL BIN ISHAK', 1, 1),
('061128011171', 'AHMAD SYAHMI HAKIMI BIN SAHROLAZMAN', 3, 1),
('061130011277', 'AHMAD KHAIRINAJMI BIN BAHARUDDIN', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL,
  `jenis_kategori` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `jenis_kategori`) VALUES
(1, 'L15'),
(2, 'L18'),
(3, 'P15'),
(4, 'P18');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `ting` varchar(3) DEFAULT NULL,
  `nama_kelas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `ting`, `nama_kelas`) VALUES
(1, '1', 'Aman'),
(2, '1', 'Bersih'),
(3, '2', 'Aman'),
(4, '2', 'Bersih'),
(5, '3', 'Aman'),
(6, '3', 'Bersih'),
(7, '4', 'Aman'),
(8, '4', 'Bersih'),
(9, '5', 'Aman'),
(10, '6', 'Bersih');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `nokp` varchar(12) NOT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `katalaluan` varchar(30) DEFAULT NULL,
  `tahap` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`nokp`, `nama`, `katalaluan`, `tahap`) VALUES
('111111111111', 'sulaiman', 'MTIz', 'tidak'),
('123', 'Amir Mat Ali', 'MTIz', 'admin'),
('123123123124', 'nur zahra imani binti', 'MTIz', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acara`
--
ALTER TABLE `acara`
  ADD PRIMARY KEY (`id_acara`);

--
-- Indexes for table `acara_ahli`
--
ALTER TABLE `acara_ahli`
  ADD PRIMARY KEY (`nokp_murid`,`id_acara`),
  ADD KEY `id_acara` (`id_acara`);

--
-- Indexes for table `ahli`
--
ALTER TABLE `ahli`
  ADD PRIMARY KEY (`nokp_murid`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`nokp`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acara`
--
ALTER TABLE `acara`
  MODIFY `id_acara` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `acara_ahli`
--
ALTER TABLE `acara_ahli`
  ADD CONSTRAINT `acara_ahli_ibfk_1` FOREIGN KEY (`id_acara`) REFERENCES `acara` (`id_acara`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `acara_ahli_ibfk_2` FOREIGN KEY (`nokp_murid`) REFERENCES `ahli` (`nokp_murid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ahli`
--
ALTER TABLE `ahli`
  ADD CONSTRAINT `ahli_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ahli_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
