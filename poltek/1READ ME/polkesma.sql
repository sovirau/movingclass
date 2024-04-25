-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2018 at 10:52 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `polkesma`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jadwaltemp`
--

CREATE TABLE IF NOT EXISTS `tb_jadwaltemp` (
  `id_jtemp` int(15) NOT NULL AUTO_INCREMENT,
  `tgl_temp` varchar(30) NOT NULL,
  `id_matkul` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_tingkat` int(5) NOT NULL,
  `id_jam` varchar(5) NOT NULL,
  `id_jam2` varchar(5) NOT NULL,
  PRIMARY KEY (`id_jtemp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_jadwaltemp`
--

INSERT INTO `tb_jadwaltemp` (`id_jtemp`, `tgl_temp`, `id_matkul`, `id_kelas`, `id_tingkat`, `id_jam`, `id_jam2`) VALUES
(1, 'Sabtu,01/September/2018', 1, 1, 1, '12:05', '13:05'),
(2, 'Jumat,05/Oktober/2018', 1, 1, 2, '10:00', '13:05'),
(3, 'Senin,29/Oktober/2018', 1, 1, 2, '13:01', '15:15'),
(4, 'Senin,12/November/2018', 1, 2, 1, '12:00', '15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jam`
--

CREATE TABLE IF NOT EXISTS `tb_jam` (
  `id_jam` int(5) NOT NULL AUTO_INCREMENT,
  `jam` varchar(20) NOT NULL,
  `jam2` varchar(10) NOT NULL,
  PRIMARY KEY (`id_jam`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_jam`
--

INSERT INTO `tb_jam` (`id_jam`, `jam`, `jam2`) VALUES
(1, '01:05', '03:08'),
(2, '07:00', '08:45');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `id_jur` int(5) NOT NULL AUTO_INCREMENT,
  `nama_jur` varchar(100) NOT NULL,
  `kode_jur` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`id_jur`, `nama_jur`, `kode_jur`) VALUES
(1, 'Jurusan Kesehatan Terapan', 'JKT'),
(2, 'Gizi', 'Gizi'),
(3, 'Kebidanan', 'Kebidanan'),
(4, 'Keperawatan', 'Keperawatan'),
(5, 'Kesehatan', 'Kesehatan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE IF NOT EXISTS `tb_kelas` (
  `id_kelas` int(5) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(5) NOT NULL,
  `id_posisi` int(5) NOT NULL,
  `kapasitas` int(5) NOT NULL,
  PRIMARY KEY (`id_kelas`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `id_posisi`, `kapasitas`) VALUES
(1, 'A', 2, 45),
(2, 'B', 4, 40),
(3, 'C', 3, 70);

-- --------------------------------------------------------

--
-- Table structure for table `tb_matkul`
--

CREATE TABLE IF NOT EXISTS `tb_matkul` (
  `id_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `nama_matkul` varchar(150) NOT NULL,
  `kode_matkul` varchar(25) NOT NULL,
  PRIMARY KEY (`id_matkul`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_matkul`
--

INSERT INTO `tb_matkul` (`id_matkul`, `nama_matkul`, `kode_matkul`) VALUES
(1, 'EKONOMI', 'EKO'),
(2, 'FARMASI', 'FAR');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjadwalan`
--

CREATE TABLE IF NOT EXISTS `tb_penjadwalan` (
  `id_trans` int(30) NOT NULL AUTO_INCREMENT,
  `id_kelas` int(5) NOT NULL,
  `id_tingkat` int(5) NOT NULL,
  `id_matkul` int(5) NOT NULL,
  `id_jam` varchar(20) NOT NULL,
  `id_jamakhir` varchar(20) NOT NULL,
  `hari` varchar(8) NOT NULL,
  PRIMARY KEY (`id_trans`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_penjadwalan`
--

INSERT INTO `tb_penjadwalan` (`id_trans`, `id_kelas`, `id_tingkat`, `id_matkul`, `id_jam`, `id_jamakhir`, `hari`) VALUES
(2, 1, 2, 1, '12:05', '14:10', 'Rabu');

-- --------------------------------------------------------

--
-- Table structure for table `tb_posisi`
--

CREATE TABLE IF NOT EXISTS `tb_posisi` (
  `id_posisi` int(5) NOT NULL AUTO_INCREMENT,
  `posisi` varchar(50) NOT NULL,
  PRIMARY KEY (`id_posisi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tb_posisi`
--

INSERT INTO `tb_posisi` (`id_posisi`, `posisi`) VALUES
(2, 'Gedung Rektorat'),
(3, 'Gizi'),
(4, 'Kebidanan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE IF NOT EXISTS `tb_prodi` (
  `id_prodi` int(5) NOT NULL AUTO_INCREMENT,
  `id_jur` varchar(5) NOT NULL,
  `nama_prodi` varchar(30) NOT NULL,
  PRIMARY KEY (`id_prodi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `id_jur`, `nama_prodi`) VALUES
(1, '1', 'ASKES'),
(2, '', ''),
(3, '3', 'DIV');

-- --------------------------------------------------------

--
-- Table structure for table `tb_tingkat`
--

CREATE TABLE IF NOT EXISTS `tb_tingkat` (
  `id_tingkat` int(5) NOT NULL AUTO_INCREMENT,
  `id_prodi` int(5) NOT NULL,
  `nama_tingkat` varchar(15) NOT NULL,
  `jumlah_mhs` int(5) NOT NULL,
  PRIMARY KEY (`id_tingkat`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tb_tingkat`
--

INSERT INTO `tb_tingkat` (`id_tingkat`, `id_prodi`, `nama_tingkat`, `jumlah_mhs`) VALUES
(1, 1, 'IA', 31),
(2, 3, 'II', 35);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
