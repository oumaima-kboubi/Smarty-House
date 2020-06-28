-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2020 at 03:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domoyamo`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20200619210859', '2020-06-19 23:22:24', 1733),
('DoctrineMigrations\\Version20200620215431', '2020-06-20 23:55:21', 13501);

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `birthdate` date NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `birthdate`, `path`, `firstname`, `lastname`, `gender`, `cin`) VALUES
(1, 'ok', 'ok', 'ok@ok.com', 'ok@ok.com', 1, 'uG7dJ1NormjOucSqGgtnnF6mBKHphq56vj0OlvmwzSQ', '$2y$13$bJCvwZSYxFKlYtJH4p4sG.01Y0rTklZEWx/d8OKUGNLa905/sFv1K', '2020-06-26 18:59:14', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_OWNER\";}\r\n', '1999-01-14', NULL, 'ouma', 'kbkb', 'F', 123),
(3, 'aziza', 'aziza', 'aziza@aziza.com', 'aziza@aziza.com', 1, 'uNq3hCohxZHrE3LOpyz2e8egcl3MOaLlrMfQj.DLFQg', '$2y$13$TMAtTN4D0OF.A.0ZceVO0eamDufQUZuXjBW1u8kGFZbSDexaZodGe', '2020-06-27 03:29:41', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}\r\n', '0000-00-00', NULL, '', '', '', 789),
(7, 'admin', 'admin', 'admin@admin.com', 'admin@admin.com', 1, 'QolektUKi9jPZseiKyEWgNzc23lkseylJZ6dWLss2/s', '$2y$13$XyFINZtLgV0z/rMaDsfWPudYlYY4YdqRtzObUGZvL5EM5qNPZ2HXW', '2020-06-24 13:41:51', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '0000-00-00', NULL, '', '', '', 258),
(12, 'oumak', 'oumak', 'kaboubioumaima2@gmail.com', 'kaboubioumaima2@gmail.com', 1, 'W3dvSJWGQKhPm/koPHSYFFjXBSZoJM5apbQAUdQFwto', '$2y$13$b0gMiRMqWXgEfc2Cr35l8uGohJUf/LDndXOSIjoucUb5K/G3Qcw9m', '2020-06-28 13:57:52', NULL, NULL, 'a:2:{i:0;s:13:\"ROLE_RESIDENT\";i:1;s:10:\"ROLE_OWNER\";}', '1900-01-01', 'C:\\xampp\\tmp\\php4227.tmp', 'oumaima', 'kboubi', 'M', 101001),
(13, 'yosra', 'yosra', 'kaboubioumaima4@gmail.com', 'kaboubioumaima4@gmail.com', 1, 'ZaDXN65jLiFHXt3XC4D2WQ4OBX1H2hgEjB/GKQ7o1fk', '$2y$13$kGQN4Ls5LUg.wKkShtD0hOAZzoII8E5f0iFZyp6s5vDA9K6RxD9ui', '2020-06-26 14:00:37', NULL, NULL, 'a:2:{i:0;s:13:\"ROLE_RESIDENT\";i:1;s:10:\"ROLE_OWNER\";}', '1900-01-01', 'C:\\xampp\\tmp\\phpD9C5.tmp', 'yo', 'sra', 'F', 1545413),
(14, 'oo', 'oo', 'o@o.o', 'o@o.o', 0, 'T21gzjcMsziXkqerM4s5o0sQT5IOa3w7PhCTBMxUszA', '$2y$13$ujn/2RK3hbaA8zLvUYNAd.Bj.dcA4WtCBafazGYGynV7UVyTyUPMG', NULL, 'FQX-_P419BqBHjjkg6AQoDSiRnHnRkIb47RL8GWneLM', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'oo', 'oo', 'F', 71477),
(15, 'oo6', 'oo6', 'okk@ok.vg', 'okk@ok.vg', 0, '.l8WNaiCEcG12gFcQ4CZghg2QpnZ.j70RR0/6gdZmxQ', '$2y$13$0sm1sZSyeEMRILQ3mmfRIuF67VAfarWzLyFFtlKbVfCUxrY0VzWWu', NULL, 's-eyE5a7B9xnmzqn_rurb_iFy4KSNDEvPKTatzvtUN4', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'o', 'oo', 'F', 455613),
(16, 'rr', 'rr', 'r@r.com', 'r@r.com', 0, 'Y8I7WcRVxlQePUo6nc08vG02zcWCChyA548uAWqH7Fc', '$2y$13$XUhcgFJWyPn2vdSM462nCeKTmHuLIlG8ii.ExAjGQXvOu19uQzGY2', NULL, 'whYebfK9n4sbM7FX1bYCgletszWNy6kH2DUmhnUkeZw', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'r', 'r', 'F', 456453),
(17, 'tt', 'tt', 't@t.t', 't@t.t', 0, 'cUjEsVrp0xi6CkLFhRqgp4l7U.a/YId254l8Dyq5RZc', '$2y$13$tnv7uTOhW2u9efa9LN301uUXuo9s3f6rji.5lSQZHfMZZeuKzCp1e', NULL, 'cXyDaJjHGCIsnfXc8oWGUupQ5UFtRM4i1wFkelmx_FE', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 't', 't', 'F', 47252),
(18, 'zz', 'zz', 'z@z.z', 'z@z.z', 0, 'JjYJbGjVQhfJch8Ix0kKbhZOX3gXDH/M3ZgJhC9yCIo', '$2y$13$1vKGtdPmibAOQ4V.WhGYAOPJWduLjjFI88Owwl/yT6W1lGUI6G/D2', NULL, 'gNTgM0xXPCcgCVLFFc85WWnZejrQuZgP0PyfQa_yDUw', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'z', 'z', 'F', 5212),
(19, 'zzzz', 'zzzz', 'zzz@z.z', 'zzz@z.z', 0, 'CRSio9gwyWnfJ0fVA9el2ZeotvtH.FkwYGXZvsIEpBE', '$2y$13$AHYGSlqG1eSTVgKrtTrwoOWJeII6JMevdFoaXjfNwKSpyW1nVGfw6', NULL, '-m_l20b1NkYtWEj_b7l0081rwrH32gJge1pJoWK-7R0', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'z', 'z', 'F', 5212),
(20, 'uuu', 'uuu', 'u@uuu.u', 'u@uuu.u', 0, 'IMsBC3wOzIpOtiiVcZLcJ.DVB90OSBC1EIWP0Hd3MBA', '$2y$13$pcBV0O6vxtXDCvR73reVeeF/R.qunjPzRJGyX4Yw19o/5s4R8tjxC', NULL, 'dCojsLB1UB4xhbnJzimgBrGlhiiyrkdRgM0CAAWDj60', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'u', 'u', 'F', 962),
(21, 'zzzzdd', 'zzzzdd', 'zzz@zzz.zzzzzz', 'zzz@zzz.zzzzzz', 0, 'n9Ve5KPkvlEkrD.UPZX7CRY65etEaEiiGZYIs6786Lc', '$2y$13$FK08Y7AHwGviOxxVmDihcevfiE0hutY61fdscOpT3UcsEjvDK1jV2', NULL, '9zv6mhq_0LjFdsGzcQ1pqC4cyXarW1p1R-_NVryV4BE', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'zzzz', 'zzzzzz', 'M', 84644),
(22, 'fesfes', 'fesfes', 'fes@fes.com', 'fes@fes.com', 0, 'LLyG07u5y40ZWaZok/2mqMRjHirqWdyHtqVmoR5ItqU', '$2y$13$ejAMVVosAprl7ZjS9mm0sueOGfhxBs/BCtDLQJbqL6Ibl65s.NjP6', NULL, 'Ab4eseQOTAotg7PoFGev-dJ_hgSWRXYqqk-r5HvJXDM', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'zzzz', 'zzzzzz', 'M', 84644);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
