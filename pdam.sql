-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2019 at 09:59 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdam`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_menu`
--

CREATE TABLE `m_menu` (
  `kode` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tautan` varchar(100) NOT NULL,
  `ikon` varchar(15) NOT NULL,
  `toggle` varchar(25) NOT NULL,
  `induk` int(11) NOT NULL,
  `urutan` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_menu`
--

INSERT INTO `m_menu` (`kode`, `nama`, `tautan`, `ikon`, `toggle`, `induk`, `urutan`, `status`) VALUES
(1, 'dashboard', 'home', 'view-dashboard', 'home', 0, 1, 0),
(2, 'pelanggan', 'pelanggan', 'account', 'pelanggan', 0, 2, 1),
(3, 'Watermeter', 'watermeter', 'gradient', 'watermeter', 0, 3, 1),
(6, 'Keluar', 'home/logout', 'run', '', 0, 5, 1),
(7, 'Pergantian Meter', 'change', 'swap', 'change', 0, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_menu_role`
--

CREATE TABLE `m_menu_role` (
  `kode_role` int(11) NOT NULL,
  `menu` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `izin` char(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_menu_role`
--

INSERT INTO `m_menu_role` (`kode_role`, `menu`, `role`, `izin`) VALUES
(1, 1, 1, '1111'),
(2, 2, 1, '1111'),
(3, 3, 1, '1111'),
(6, 6, 1, '1111'),
(7, 7, 1, '1111');

-- --------------------------------------------------------

--
-- Table structure for table `t_meter_change`
--

CREATE TABLE `t_meter_change` (
  `kode_pergantian` int(11) NOT NULL,
  `tanggal_pergantian` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `kode_pelanggan` int(11) NOT NULL,
  `angka_awal` float NOT NULL,
  `angka_baru` float NOT NULL,
  `foto_awal` varchar(200) NOT NULL,
  `foto_baru` varchar(200) NOT NULL,
  `watermeter_awal` int(11) NOT NULL,
  `watermeter_baru` int(11) NOT NULL,
  `verifikasi_pergantian` tinyint(1) NOT NULL,
  `verifikasi_pemasangan` tinyint(1) NOT NULL,
  `verifikasi_selesai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_meter_change`
--

INSERT INTO `t_meter_change` (`kode_pergantian`, `tanggal_pergantian`, `kode_pelanggan`, `angka_awal`, `angka_baru`, `foto_awal`, `foto_baru`, `watermeter_awal`, `watermeter_baru`, `verifikasi_pergantian`, `verifikasi_pemasangan`, `verifikasi_selesai`) VALUES
(1, '2019-02-15 04:23:26', 1, 400, 0, 'dokumentasi/20190215155754.jpg', 'dokumentasi/20190215155754.jpg', 1, 2, 1, 1, 0),
(2, '2019-02-15 04:23:41', 3, 387, 0, 'dokumentasi/gambar2.jpg', 'dokumentasi/gambar4.jpg', 5, 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_pelanggan`
--

CREATE TABLE `t_pelanggan` (
  `kode_pelanggan` int(11) NOT NULL,
  `ktp` varchar(16) NOT NULL,
  `nama_depan` varchar(100) NOT NULL,
  `nama_belakang` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_pelanggan`
--

INSERT INTO `t_pelanggan` (`kode_pelanggan`, `ktp`, `nama_depan`, `nama_belakang`, `alamat`, `telepon`) VALUES
(1, '3217080610970006', 'Ilham', 'Fadil', 'Jln.Nurul Huda 3 No 135, Kebon Kopi, Cibeureum, Kec. Cimahi Selatan, Kota Cimahi						', '081313060200'),
(2, '3217082508720009', 'Aep', 'Darmawan', 'Graha Bukit Raya 3 Blok B no 8', '089009887776'),
(3, '3217082508720020', 'Bagas', 'Dewonggono', '							Bandung																			', '081989992238'),
(7, '3217082508720088', 'Haerul', 'Yuyung', 'Bandung													', '08999273749');

-- --------------------------------------------------------

--
-- Table structure for table `t_role`
--

CREATE TABLE `t_role` (
  `kode_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_role`
--

INSERT INTO `t_role` (`kode_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Operator'),
(3, 'User'),
(4, 'Pengawas'),
(5, 'Verifikator');

-- --------------------------------------------------------

--
-- Table structure for table `t_user`
--

CREATE TABLE `t_user` (
  `kode_user` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_user`
--

INSERT INTO `t_user` (`kode_user`, `username`, `password`, `status`, `role`) VALUES
(1, 'admin', 'c93ccd78b2076528346216b3b2f701e6', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_watermeter`
--

CREATE TABLE `t_watermeter` (
  `kode_watermeter` int(11) NOT NULL,
  `nickname` char(5) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_watermeter`
--

INSERT INTO `t_watermeter` (`kode_watermeter`, `nickname`, `name`) VALUES
(1, 'ITR', 'ITRON'),
(2, 'BAR', 'BARINDO'),
(3, 'AQ', 'AQUINDO'),
(4, 'LIN', 'LINFLOW'),
(5, 'AA', 'AA');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vmenu`
-- (See below for the actual view)
--
CREATE TABLE `vmenu` (
`kode_role` int(11)
,`kode` int(11)
,`nama` varchar(25)
,`tautan` varchar(100)
,`ikon` varchar(15)
,`toggle` varchar(25)
,`induk` int(11)
,`urutan` int(11)
,`status` tinyint(1)
,`role` int(11)
,`izin` char(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vpergantian`
-- (See below for the actual view)
--
CREATE TABLE `vpergantian` (
`kode_pergantian` int(11)
,`kode_pelanggan` int(11)
,`watermeter_awal` int(11)
,`watermeter_baru` int(11)
,`nama_pelanggan` varchar(201)
,`alamat` text
,`telepon` varchar(16)
,`angka_awal` float
,`angka_baru` float
,`foto_awal` varchar(200)
,`foto_baru` varchar(200)
,`brand_watermeter_awal` varchar(100)
,`brand_watermeter_baru` varchar(100)
,`verifikasi_pergantian` tinyint(1)
,`verifikasi_pemasangan` tinyint(1)
,`verifikasi_selesai` tinyint(1)
);

-- --------------------------------------------------------

--
-- Structure for view `vmenu`
--
DROP TABLE IF EXISTS `vmenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vmenu`  AS  select `mmr`.`kode_role` AS `kode_role`,`mm`.`kode` AS `kode`,`mm`.`nama` AS `nama`,`mm`.`tautan` AS `tautan`,`mm`.`ikon` AS `ikon`,`mm`.`toggle` AS `toggle`,`mm`.`induk` AS `induk`,`mm`.`urutan` AS `urutan`,`mm`.`status` AS `status`,`mmr`.`role` AS `role`,`mmr`.`izin` AS `izin` from (`m_menu_role` `mmr` join `m_menu` `mm` on((`mmr`.`menu` = `mm`.`kode`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vpergantian`
--
DROP TABLE IF EXISTS `vpergantian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vpergantian`  AS  select `m`.`kode_pergantian` AS `kode_pergantian`,`m`.`kode_pelanggan` AS `kode_pelanggan`,`m`.`watermeter_awal` AS `watermeter_awal`,`m`.`watermeter_baru` AS `watermeter_baru`,concat(`p`.`nama_depan`,' ',`p`.`nama_belakang`) AS `nama_pelanggan`,`p`.`alamat` AS `alamat`,`p`.`telepon` AS `telepon`,`m`.`angka_awal` AS `angka_awal`,`m`.`angka_baru` AS `angka_baru`,`m`.`foto_awal` AS `foto_awal`,`m`.`foto_baru` AS `foto_baru`,`w1`.`name` AS `brand_watermeter_awal`,`w2`.`name` AS `brand_watermeter_baru`,`m`.`verifikasi_pergantian` AS `verifikasi_pergantian`,`m`.`verifikasi_pemasangan` AS `verifikasi_pemasangan`,`m`.`verifikasi_selesai` AS `verifikasi_selesai` from (((`t_meter_change` `m` join `t_pelanggan` `p` on((`m`.`kode_pelanggan` = `p`.`kode_pelanggan`))) left join `t_watermeter` `w1` on((`m`.`watermeter_awal` = `w1`.`kode_watermeter`))) left join `t_watermeter` `w2` on((`m`.`watermeter_baru` = `w2`.`kode_watermeter`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_menu`
--
ALTER TABLE `m_menu`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `m_menu_role`
--
ALTER TABLE `m_menu_role`
  ADD PRIMARY KEY (`kode_role`),
  ADD KEY `menu` (`menu`);

--
-- Indexes for table `t_meter_change`
--
ALTER TABLE `t_meter_change`
  ADD PRIMARY KEY (`kode_pergantian`);

--
-- Indexes for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`),
  ADD UNIQUE KEY `ktp` (`ktp`);

--
-- Indexes for table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`kode_role`);

--
-- Indexes for table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`kode_user`);

--
-- Indexes for table `t_watermeter`
--
ALTER TABLE `t_watermeter`
  ADD PRIMARY KEY (`kode_watermeter`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_menu`
--
ALTER TABLE `m_menu`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_menu_role`
--
ALTER TABLE `m_menu_role`
  MODIFY `kode_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_meter_change`
--
ALTER TABLE `t_meter_change`
  MODIFY `kode_pergantian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t_pelanggan`
--
ALTER TABLE `t_pelanggan`
  MODIFY `kode_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `kode_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `kode_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_watermeter`
--
ALTER TABLE `t_watermeter`
  MODIFY `kode_watermeter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
