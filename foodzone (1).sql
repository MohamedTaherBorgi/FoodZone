-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 02:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'avatar.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `prenom`, `telephone`, `email`, `password`, `role`, `image`) VALUES
(1, 'taher', 's', '1524545', 's@s.s', '$2y$10$MyVV72srVsO1MDW20C8Uh.cqhfUV2PACt9P2NROh9Kuk/Qvb.woVe', 'admin', ''),
(3, 't', 't', '', 't@t.t', '$2y$10$u.SaIuwW1q4P8C4WsMxaXe0EwnxDzA0ktaTiRpMMyaYMDLIZWYbhi', 'client', ''),
(4, 'ssa', 'ssa', '', 'ssa@ssa.ssa', '$2y$10$WyY57Q3K7zoCqK.V3Wkg5.dXj1ZQikcUCnjQTrRIdT9QQxbbW1ocK', 'client', ''),
(5, 'wwW', 'w', '', 'w@w.w', '$2y$10$wnDAyCtSxOrLuwh/mZArlup8jrt0ACGFsVlJHazCt8RqWn7K4Nk6W', 'client', ''),
(6, 'wwWss', 'w', '', 'w@w.ws', '$2y$10$9HSLl47Lc/ytthEMQrI.D.TfwUYrcjNkoQaFHoMiPgdtxPFVy9Y/W', 'client', ''),
(7, 'f', 'f', '', 'ffff@f.f', '$2y$10$zoE8AT.EjcvcuvJV.AY7eugRlxPu4wHKocMi1Zv./p7b/FbzXun16', 'client', ''),
(8, 'a', 'a', '', 'aaa@a.a', '$2y$10$.F6bc2jytfg/ajoDFUrSU.eE8TsQjduEgTHsDHngK8Z9Gz3kNGtxe', 'admin', ''),
(9, 'o', 'o', '', 'o@o.o', '$2y$10$8oQMMufgBfR5WlYb9Rw4oeSTTUMi/ijAorjKqin1lbIiT31s9nPYK', 'client', ''),
(10, 'f', 'f', '', 'f@fff.f', '$2y$10$XOFVpl/9ej3WspXKYJlSc.fcTEKfXUWkwkx8R7bpP6QoePnu2KHsK', 'client', ''),
(11, 'tt', 'tt', '', 'tt@tt.tt', '$2y$10$.xEOnsZLDLkemLPU.VS4rOt9v5IDP/gfZcD39.XlCOLNKT6dwrVCe', 'client', ''),
(12, 'tt', 'tt', '', 'tt@tt.tte', '$2y$10$lc0NIp5xbPkOKG4cNE1fIOGeGgpl7HjKoNZUXVc80lftF.3vym5Na', 'client', ''),
(13, 'a', 'a', '', 'r@r.r', '$2y$10$Ci.CTJGMabSaugSb2dK5DeFEQRNf2deLtn5EreGNFut9TaK2obH5a', 'admin', ''),
(14, 'i', 'i', '', 'i@i.i', '$2y$10$1Q2Zk.e3v4HvrxhylQcIXesbVXUOfrMeqwPnhMI/B8w3gq0ZkMNwy', 'client', ''),
(15, 'azea', 'aze', '', 'aze@e.ae', '$2y$10$t1iGeMgqHKqoOnOEIN5l5eyrF7lkwPKVku8NKRx5D5INCophPwg32', 'client', ''),
(27, 'b', 'b', '25491851', 'b@b.b', '$2y$10$89zGYkdUBP16rR/8eDvNJeiOYeysg2HQWKem1k3eJzU2MPsFNKSKS', 'client', ''),
(30, 'r', 'r', 'r', 'rr@r.r', '$2y$10$0izMxoN0O4d1bRjkpJb2lusNTC76mTGYvOHudnrRt.J.Gf8E8Sc.C', 'admin', 'avatar.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
