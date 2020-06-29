-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2020 at 12:01 PM
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
-- Table structure for table `actuator`
--

CREATE TABLE `actuator` (
  `id` int(11) NOT NULL,
  `phenomene_physique_utilise` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `principe_mis_en_oeuvre` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_energie_utilisee` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribut`
--

CREATE TABLE `attribut` (
  `id` int(11) NOT NULL,
  `actuator_id` int(11) DEFAULT NULL,
  `sensor_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `on_label` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `off_lable` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min` double DEFAULT NULL,
  `max` double DEFAULT NULL,
  `unit` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `camera`
--

CREATE TABLE `camera` (
  `id` int(11) NOT NULL,
  `house_id_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desription` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `room_id_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `attributs_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('DoctrineMigrations\\Version20200629094932', '2020-06-29 11:57:56', 715);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `cin` int(11) NOT NULL,
  `house_id_id` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `birthdate`, `path`, `firstname`, `lastname`, `gender`, `cin`, `house_id_id`, `country`) VALUES
(1, 'ok', 'ok', 'ok@ok.com', 'ok@ok.com', 1, 'uG7dJ1NormjOucSqGgtnnF6mBKHphq56vj0OlvmwzSQ', '$2y$13$bJCvwZSYxFKlYtJH4p4sG.01Y0rTklZEWx/d8OKUGNLa905/sFv1K', '2020-06-26 18:59:14', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_OWNER\";}\r\n', '1999-01-14', NULL, 'ouma', 'kbkb', 'F', 123, NULL, NULL),
(3, 'aziza', 'aziza', 'aziza@aziza.com', 'aziza@aziza.com', 1, 'uNq3hCohxZHrE3LOpyz2e8egcl3MOaLlrMfQj.DLFQg', '$2y$13$TMAtTN4D0OF.A.0ZceVO0eamDufQUZuXjBW1u8kGFZbSDexaZodGe', '2020-06-29 02:22:15', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}\r\n', '0000-00-00', NULL, '', '', '', 789, NULL, NULL),
(7, 'admin', 'admin', 'admin@admin.com', 'admin@admin.com', 1, 'QolektUKi9jPZseiKyEWgNzc23lkseylJZ6dWLss2/s', '$2y$13$XyFINZtLgV0z/rMaDsfWPudYlYY4YdqRtzObUGZvL5EM5qNPZ2HXW', '2020-06-24 13:41:51', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}', '0000-00-00', NULL, '', '', '', 258, NULL, NULL),
(12, 'okk', 'okk', 'kaboubioumaima2@gmail.com', 'kaboubioumaima2@gmail.com', 1, 'MVxkGIS.ntOCtac4d.lKks3QmBuhlXShWg11VwbhnaI', '$2y$13$0vmUeakkteP5ifD/vQTVp.ush2o9BxM2viH.hZQhAEUc18lMnUebK', '2020-06-29 02:26:53', NULL, NULL, 'a:2:{i:0;s:13:\"ROLE_RESIDENT\";i:1;s:10:\"ROLE_OWNER\";}', '1900-01-01', 'assets/uploads/39598adfd9da533a9c9eda5f2778f238person_4.jpg', 'oumaima', 'kboubiiiiii', 'F', 101001, NULL, 'EG'),
(13, 'yosra', 'yosra', 'kaboubioumaima4@gmail.com', 'kaboubioumaima4@gmail.com', 1, 'ZaDXN65jLiFHXt3XC4D2WQ4OBX1H2hgEjB/GKQ7o1fk', '$2y$13$kGQN4Ls5LUg.wKkShtD0hOAZzoII8E5f0iFZyp6s5vDA9K6RxD9ui', '2020-06-26 14:00:37', NULL, NULL, 'a:2:{i:0;s:13:\"ROLE_RESIDENT\";i:1;s:10:\"ROLE_OWNER\";}', '1900-01-01', 'C:\\xampp\\tmp\\phpD9C5.tmp', 'yo', 'sra', 'F', 1545413, NULL, NULL),
(14, 'oo', 'oo', 'o@o.o', 'o@o.o', 0, 'T21gzjcMsziXkqerM4s5o0sQT5IOa3w7PhCTBMxUszA', '$2y$13$ujn/2RK3hbaA8zLvUYNAd.Bj.dcA4WtCBafazGYGynV7UVyTyUPMG', NULL, 'FQX-_P419BqBHjjkg6AQoDSiRnHnRkIb47RL8GWneLM', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'oo', 'oo', 'F', 71477, NULL, NULL),
(15, 'oo6', 'oo6', 'okk@ok.vg', 'okk@ok.vg', 0, '.l8WNaiCEcG12gFcQ4CZghg2QpnZ.j70RR0/6gdZmxQ', '$2y$13$0sm1sZSyeEMRILQ3mmfRIuF67VAfarWzLyFFtlKbVfCUxrY0VzWWu', NULL, 's-eyE5a7B9xnmzqn_rurb_iFy4KSNDEvPKTatzvtUN4', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'o', 'oo', 'F', 455613, NULL, NULL),
(16, 'rr', 'rr', 'r@r.com', 'r@r.com', 0, 'Y8I7WcRVxlQePUo6nc08vG02zcWCChyA548uAWqH7Fc', '$2y$13$XUhcgFJWyPn2vdSM462nCeKTmHuLIlG8ii.ExAjGQXvOu19uQzGY2', NULL, 'whYebfK9n4sbM7FX1bYCgletszWNy6kH2DUmhnUkeZw', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'r', 'r', 'F', 456453, NULL, NULL),
(17, 'tt', 'tt', 't@t.t', 't@t.t', 0, 'cUjEsVrp0xi6CkLFhRqgp4l7U.a/YId254l8Dyq5RZc', '$2y$13$tnv7uTOhW2u9efa9LN301uUXuo9s3f6rji.5lSQZHfMZZeuKzCp1e', NULL, 'cXyDaJjHGCIsnfXc8oWGUupQ5UFtRM4i1wFkelmx_FE', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 't', 't', 'F', 47252, NULL, NULL),
(18, 'zz', 'zz', 'z@z.z', 'z@z.z', 0, 'JjYJbGjVQhfJch8Ix0kKbhZOX3gXDH/M3ZgJhC9yCIo', '$2y$13$1vKGtdPmibAOQ4V.WhGYAOPJWduLjjFI88Owwl/yT6W1lGUI6G/D2', NULL, 'gNTgM0xXPCcgCVLFFc85WWnZejrQuZgP0PyfQa_yDUw', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'z', 'z', 'F', 5212, NULL, NULL),
(19, 'zzzz', 'zzzz', 'zzz@z.z', 'zzz@z.z', 0, 'CRSio9gwyWnfJ0fVA9el2ZeotvtH.FkwYGXZvsIEpBE', '$2y$13$AHYGSlqG1eSTVgKrtTrwoOWJeII6JMevdFoaXjfNwKSpyW1nVGfw6', NULL, '-m_l20b1NkYtWEj_b7l0081rwrH32gJge1pJoWK-7R0', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'z', 'z', 'F', 521277, NULL, NULL),
(20, 'uuu', 'uuu', 'u@uuu.u', 'u@uuu.u', 0, 'IMsBC3wOzIpOtiiVcZLcJ.DVB90OSBC1EIWP0Hd3MBA', '$2y$13$pcBV0O6vxtXDCvR73reVeeF/R.qunjPzRJGyX4Yw19o/5s4R8tjxC', NULL, 'dCojsLB1UB4xhbnJzimgBrGlhiiyrkdRgM0CAAWDj60', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'u', 'u', 'F', 962, NULL, NULL),
(21, 'zzzzdd', 'zzzzdd', 'zzz@zzz.zzzzzz', 'zzz@zzz.zzzzzz', 0, 'n9Ve5KPkvlEkrD.UPZX7CRY65etEaEiiGZYIs6786Lc', '$2y$13$FK08Y7AHwGviOxxVmDihcevfiE0hutY61fdscOpT3UcsEjvDK1jV2', NULL, '9zv6mhq_0LjFdsGzcQ1pqC4cyXarW1p1R-_NVryV4BE', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'zzzz', 'zzzzzz', 'M', 84644515, NULL, NULL),
(22, 'fesfes', 'fesfes', 'fes@fes.com', 'fes@fes.com', 0, 'LLyG07u5y40ZWaZok/2mqMRjHirqWdyHtqVmoR5ItqU', '$2y$13$ejAMVVosAprl7ZjS9mm0sueOGfhxBs/BCtDLQJbqL6Ibl65s.NjP6', NULL, 'Ab4eseQOTAotg7PoFGev-dJ_hgSWRXYqqk-r5HvJXDM', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'zzzz', 'zzzzzz', 'M', 84644, NULL, NULL),
(23, 'hey', 'hey', 'hey@you.bye', 'hey@you.bye', 0, 'Njytca4jF4NGY9pwDwgM8LqD4VfPybHaRk46r/xpPvI', '$2y$13$rgdZoeUj.YtzCT/XxMxaNehliJcXnrXOGsjegJaDyWv9arUlIxz9i', NULL, 'tmUkTabvRZUAg9lSzBB0Dng87tEHYwgZtIiaO7R_JsI', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'how', 'ya doing', 'F', 2147483647, NULL, 'TR'),
(24, 'heyhvhjvj', 'heyhvhjvj', 'hedy@you.bye', 'hedy@you.bye', 0, 'pLgqwm1F7ddI2rdsq3oRe9gpKOB9wP0H2/W8onxnILw', '$2y$13$7PhZEjV4WV6aYP31L2w7COLNHBjzJUG4lvKgOx0QauGpejUSwAjpm', NULL, 'tdSkbjwAy2STIvH1F2bFOUGSYArYq-MbQ1iBGyVdBhc', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'how', 'ya doing', 'F', 214640007, NULL, 'TR'),
(25, 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaa', 'aaaaaaaaaaaaaa@aaaaaaaaaaaaaaa.aaaaaaaaaaaaa', 'aaaaaaaaaaaaaa@aaaaaaaaaaaaaaa.aaaaaaaaaaaaa', 0, 'WmQ6ndCzZViQNpxzYJ6ToHy46JFqoWNVUFZdJweqLGk', '$2y$13$bb0KuZmNrnsOXf3.7fEoN.rfQMQFRikVJm4nF1/TnLNWJDXzhV8dG', NULL, 'OlejTr2TsY0K2fmlQ6aFCiVt7rgS94UF6xFV-Gcy4Nw', NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1900-01-01', NULL, 'aaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaa', 'M', 123456879, NULL, 'AF'),
(26, 'oumay', 'oumay', 'done@done.tn', 'done@done.tn', 1, '4H4Cwrv0V3LD9Bprs8X3tVoy8N8OIUcCeTYjRKusuvA', '$2y$13$FmdX2zPMe3la2fOadwztfemWXekpOG7N68aRjpBbNCVGnCsJBqcE6', '2020-06-29 02:07:19', NULL, NULL, 'a:1:{i:0;s:13:\"ROLE_RESIDENT\";}', '1999-01-14', 'images/avatar.jpeg', 'oumay', 'kbouu', 'F', 123987456, NULL, 'TR');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `metric`
--

CREATE TABLE `metric` (
  `id` int(11) NOT NULL,
  `attribut_id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preset`
--

CREATE TABLE `preset` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preset_attribut`
--

CREATE TABLE `preset_attribut` (
  `id` int(11) NOT NULL,
  `attribut_id` int(11) DEFAULT NULL,
  `preset_id` int(11) DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `house_id_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scenario`
--

CREATE TABLE `scenario` (
  `id` int(11) NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `apport_energitique` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seuil_declenchement` double NOT NULL,
  `type_detection` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_sortie` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `smart_house`
--

CREATE TABLE `smart_house` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `smart_house`
--

INSERT INTO `smart_house` (`id`, `name`, `address`) VALUES
(1, 'Rafraf', 'Bizerte'),
(2, 'helloworld', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actuator`
--
ALTER TABLE `actuator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribut`
--
ALTER TABLE `attribut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7AB8E85D77D4D665` (`actuator_id`),
  ADD KEY `IDX_7AB8E85DA247991F` (`sensor_id`);

--
-- Indexes for table `camera`
--
ALTER TABLE `camera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3B1CEE05A4A739AF` (`house_id_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_92FB68E35F83FFC` (`room_id_id`),
  ADD KEY `IDX_92FB68EC39426B9` (`attributs_id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_957A6479ABE530DA` (`cin`),
  ADD UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`),
  ADD KEY `IDX_957A6479A4A739AF` (`house_id_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metric`
--
ALTER TABLE `metric`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_87D62EE351383AF3` (`attribut_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preset`
--
ALTER TABLE `preset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preset_attribut`
--
ALTER TABLE `preset_attribut`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F6D632E151383AF3` (`attribut_id`),
  ADD KEY `IDX_F6D632E180688E6F` (`preset_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_729F519BA4A739AF` (`house_id_id`);

--
-- Indexes for table `scenario`
--
ALTER TABLE `scenario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smart_house`
--
ALTER TABLE `smart_house`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actuator`
--
ALTER TABLE `actuator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attribut`
--
ALTER TABLE `attribut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `camera`
--
ALTER TABLE `camera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fos_user`
--
ALTER TABLE `fos_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `metric`
--
ALTER TABLE `metric`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preset`
--
ALTER TABLE `preset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preset_attribut`
--
ALTER TABLE `preset_attribut`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scenario`
--
ALTER TABLE `scenario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `smart_house`
--
ALTER TABLE `smart_house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribut`
--
ALTER TABLE `attribut`
  ADD CONSTRAINT `FK_7AB8E85D77D4D665` FOREIGN KEY (`actuator_id`) REFERENCES `actuator` (`id`),
  ADD CONSTRAINT `FK_7AB8E85DA247991F` FOREIGN KEY (`sensor_id`) REFERENCES `sensor` (`id`);

--
-- Constraints for table `camera`
--
ALTER TABLE `camera`
  ADD CONSTRAINT `FK_3B1CEE05A4A739AF` FOREIGN KEY (`house_id_id`) REFERENCES `smart_house` (`id`);

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `FK_92FB68E35F83FFC` FOREIGN KEY (`room_id_id`) REFERENCES `room` (`id`),
  ADD CONSTRAINT `FK_92FB68EC39426B9` FOREIGN KEY (`attributs_id`) REFERENCES `attribut` (`id`);

--
-- Constraints for table `fos_user`
--
ALTER TABLE `fos_user`
  ADD CONSTRAINT `FK_957A6479A4A739AF` FOREIGN KEY (`house_id_id`) REFERENCES `smart_house` (`id`);

--
-- Constraints for table `metric`
--
ALTER TABLE `metric`
  ADD CONSTRAINT `FK_87D62EE351383AF3` FOREIGN KEY (`attribut_id`) REFERENCES `attribut` (`id`);

--
-- Constraints for table `preset_attribut`
--
ALTER TABLE `preset_attribut`
  ADD CONSTRAINT `FK_F6D632E151383AF3` FOREIGN KEY (`attribut_id`) REFERENCES `attribut` (`id`),
  ADD CONSTRAINT `FK_F6D632E180688E6F` FOREIGN KEY (`preset_id`) REFERENCES `preset` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_729F519BA4A739AF` FOREIGN KEY (`house_id_id`) REFERENCES `smart_house` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
