-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 01:20 PM
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
-- Database: `db_kampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `mhsnim` varchar(100) NOT NULL,
  `mhsnama` varchar(100) DEFAULT NULL,
  `mhstempatlahir` varchar(100) DEFAULT NULL,
  `mhstgllahir` varchar(100) DEFAULT NULL,
  `mhsjk` varchar(100) DEFAULT NULL,
  `mhsalamat` varchar(100) DEFAULT NULL,
  `mhskota` varchar(100) DEFAULT NULL,
  `mhshp` varchar(100) DEFAULT NULL,
  `mhsjurusan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mhsnim`, `mhsnama`, `mhstempatlahir`, `mhstgllahir`, `mhsjk`, `mhsalamat`, `mhskota`, `mhshp`, `mhsjurusan`) VALUES
('213123', 'adf', 'Sidoarjo', '2020-05-14', 'Laki-Laki', 'Surabyaa', 'surabaya', '0897', 'Informatika'),
('2801', 'Superman', 'Surabaya', '2020-05-30', 'Laki-Laki', 'Mojoagung', 'Jombang', '0897', 'Pertanian');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
