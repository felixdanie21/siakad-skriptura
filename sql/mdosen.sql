-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2023 at 05:19 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsiakad`
--

-- --------------------------------------------------------

--
-- Table structure for table `mdosen`
--

CREATE TABLE `mdosen` (
  `iddosen` varchar(15) NOT NULL COMMENT 'id dosen internal',
  `idprodidosen` varchar(15) NOT NULL COMMENT 'id program studi',
  `namadosen` varchar(50) NOT NULL COMMENT 'nama dosen tanpa gelar',
  `gelardepan` varchar(5) NOT NULL COMMENT 'gelar depan',
  `gelarbelakang` varchar(10) NOT NULL COMMENT 'gelar belakang',
  `namalengkap` varchar(50) NOT NULL COMMENT 'nama lengkap dengan gelar',
  `tgllhrdosen` date NOT NULL COMMENT 'tanggal lahir dosen',
  `tptlhrdosen` varchar(50) NOT NULL COMMENT 'tempat lahir',
  `jnsklmdsn` varchar(1) NOT NULL COMMENT 'jenis kelamin',
  `nomorwa` varchar(20) NOT NULL COMMENT 'nomor hp/wa',
  `emailpt` varchar(40) NOT NULL COMMENT 'email Pt',
  `emailpribadi` varchar(40) NOT NULL COMMENT 'email pribadi',
  `alamattinggal` varchar(100) NOT NULL COMMENT 'alamat tinggal',
  `nikdosen` varchar(16) NOT NULL COMMENT 'nomor nik/ktp',
  `nomornidn` varchar(20) NOT NULL COMMENT 'nomor nidn',
  `ikatankerja` varchar(20) NOT NULL COMMENT 'ikatan kerja',
  `jbtakad` varchar(20) NOT NULL COMMENT 'jabatan akademik',
  `gelartinggi` varchar(20) NOT NULL COMMENT 'pendidikan tertinggi',
  `aktaajar` varchar(1) NOT NULL COMMENT 'akta mengajar (y/t)',
  `ijinajar` varchar(1) NOT NULL COMMENT 'surat ijin mengajar (y/t)',
  `aktifitas` varchar(20) NOT NULL COMMENT 'aktifitas mengajar dosen',
  `fotodosen` varchar(200) NOT NULL COMMENT 'foto dosen',
  `stataktdsn` varchar(1) NOT NULL COMMENT 'status aktif dosen (a,n,cuti,tugas-belajar)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='biodata dosen';

--
-- Dumping data for table `mdosen`
--

INSERT INTO `mdosen` (`iddosen`, `idprodidosen`, `namadosen`, `gelardepan`, `gelarbelakang`, `namalengkap`, `tgllhrdosen`, `tptlhrdosen`, `jnsklmdsn`, `nomorwa`, `emailpt`, `emailpribadi`, `alamattinggal`, `nikdosen`, `nomornidn`, `ikatankerja`, `jbtakad`, `gelartinggi`, `aktaajar`, `ijinajar`, `aktifitas`, `fotodosen`, `stataktdsn`) VALUES
('23313700003', '77201', 'Lestyowati E. Widyantari', '', 'M.Si', 'Lestyowati E. Widyantari M.Si', '1967-09-07', 'Jakarta', 'P', '', '', '', '', '14789', '', 'Dosen Tetap', 'Tenaga Pengajar', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700006', '77201', 'Maxie Marthen Rumagitt', 'Pdt.', 'M.Th.', 'Pdt. Maxie Marthen Rumagitt M.Th.', '1965-03-24', 'Manado', 'L', '', '', '', '', '3174012403650004', '2324036501', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700007', '77201', 'Dr. Kordin Sagala', 'Pdt.', 'M.Th.', 'Pdt. Dr. Kordin Sagala M.Th.', '1971-01-03', 'Bandar Manik', 'L', '', '', '', '', '3203010301710005', '2303017101', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700008', '77201', 'Kusnadi Wiguna', '', 'M.Th.', 'Kusnadi Wiguna M.Th.', '1971-07-01', 'Bogor', 'L', '', '', '', '', '3271010107710538', '', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700009', '77201', 'Robertus Sela', 'Pdt.', 'M.Th.', 'Pdt. Robertus Sela M.Th.', '1974-04-25', 'Pontianak', 'L', '', '', '', '', '3271022504740007', '2325047401', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700010', '77201', 'Romy Steyfen Palit', 'Pdt.', 'M.Th.', 'Pdt. Romy Steyfen Palit M.Th.', '1972-09-09', 'Manado', 'L', '', '', '', '', '3276010909720009', '2309097201', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700011', '77201', 'Jefry Pomantow', 'Pdt.', 'M.Th.', 'Pdt. Jefry Pomantow M.Th.', '1968-01-28', 'Manado', 'L', '', '', '', '', '327601280168004', '', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700012', '77201', 'Lidya Wowiling', 'Pdt.', 'S.Th.', 'Pdt. Lidya Wowiling S.Th.', '1973-08-19', 'Manado', 'P', '', '', '', '', '327601590873005', '', 'Dosen Tetap', 'Asisten Ahli', 'S1', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700013', '77201', 'Meidy Jemmy Rumagit', 'Pdt.', 'M.Th', 'Pdt. Meidy Jemmy Rumagit M.Th', '1973-05-19', 'Manado', 'L', '', '', '', '', '3276051905730009', '2319057301', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700014', '77201', 'James Ricky Burnama', 'Pdt.', 'M.Th.', 'Pdt. James Ricky Burnama M.Th.', '1962-04-18', 'Ambon', 'L', '', '', '', '', '3276061804620004', '', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700015', '77201', 'Arrhenius Petwien Gunde', '', 'M.Th.', 'Arrhenius Petwien Gunde M.Th.', '1979-08-24', 'Manado', 'L', '', '', '', '', '3671112408790008', '', 'Dosen Tetap', 'Asisten Ahli', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700019', '77201', 'Devison Sanhari', '', 'M.Th.', 'Devison Sanhari M.Th.', '1983-03-19', 'Bengkulu', 'L', '', '', '', '', '3173081903830001', '', 'Doses Honorer', 'Tenaga Pengajar', 'S1', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700020', '77201', 'Sopar Sinaga', 'Pdt.', 'M.Th.', 'Pdt. Sopar Sinaga M.Th.', '1971-08-29', 'Sigalingging', 'L', '', '', '', '', '3172022908710010', '2329087101', 'Dosen Tetap', 'Tenaga Pengajar', 'S2', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700021', '77201', 'Dicky Suwarta', '', 'S.Th.', 'Dicky Suwarta S.Th.', '1968-08-20', 'Bandung', 'L', '', '', '', '', '3277032008680018', '', 'Dosen Tetap', 'Tenaga Pengajar', 'S1', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700022', '77201', 'Antonius Paparang', 'Pdt.', 'S.Th.', 'Pdt. Antonius Paparang S.Th.', '1972-04-10', 'Manado', 'L', '', '', '', '', '7104061004720002', '', 'Doses Honorer', 'Tenaga Pengajar', 'S1', 'Y', 'Y', 'Aktif Mengajar', '', 'A'),
('23313700023', '77201', 'Mardjono', 'Ir.', 'S.Th', 'Ir. Mardjono S.Th', '1960-04-27', 'Solo', 'L', '', '', '', '', '3276052704600005', '', 'Doses Honorer', 'Tenaga Pengajar', 'S1', 'Y', 'Y', 'Aktif Mengajar', '', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mdosen`
--
ALTER TABLE `mdosen`
  ADD PRIMARY KEY (`iddosen`),
  ADD KEY `mdosen01` (`iddosen`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
