-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 02:18 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwms`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(10) UNSIGNED NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `lname`, `mname`, `fname`, `account_type`, `username`, `position`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(25, 'Delacruz', 'Melissa', 'Juan', 'MIS', 'superadministrator', 'MIS.', '$2y$10$2naIlukXzmi5HndigLmHFO6WQwDRTpWYlZLFgAtywSmmCxhCpsity', '2021-10-27 07:11:55', '2021-10-25 23:32:28', NULL),
(27, 'Delacruz', 'SanFernando', 'Juan', 'Administrator', 'admin1234', 'Head', '$2y$10$Lmkpr2w3B.LrR5kZgk/bbukgfXHZsFRx8gGF8fGtuOlKJivN3x6S.', '2021-10-27 07:12:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_account_type`
--

CREATE TABLE `admin_account_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `account_name` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_account_type`
--

INSERT INTO `admin_account_type` (`id`, `account_name`) VALUES
(1, 'MIS'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_table`
--

CREATE TABLE `calendar_table` (
  `id` int(11) NOT NULL,
  `D1` int(11) DEFAULT NULL,
  `D2` int(11) DEFAULT NULL,
  `D3` int(11) DEFAULT NULL,
  `D4` int(11) DEFAULT NULL,
  `D5` int(11) DEFAULT NULL,
  `D6` int(11) DEFAULT NULL,
  `D7` int(11) DEFAULT NULL,
  `D8` int(11) DEFAULT NULL,
  `D9` int(11) DEFAULT NULL,
  `D10` int(11) DEFAULT NULL,
  `D11` int(11) DEFAULT NULL,
  `D12` int(11) DEFAULT NULL,
  `D13` int(11) DEFAULT NULL,
  `D14` int(11) DEFAULT NULL,
  `D15` int(11) DEFAULT NULL,
  `D16` int(11) DEFAULT NULL,
  `D17` int(11) DEFAULT NULL,
  `D18` int(11) DEFAULT NULL,
  `D19` int(11) DEFAULT NULL,
  `D20` int(11) DEFAULT NULL,
  `D21` int(11) DEFAULT NULL,
  `D22` int(11) DEFAULT NULL,
  `D23` int(11) DEFAULT NULL,
  `D24` int(11) DEFAULT NULL,
  `D25` int(11) DEFAULT NULL,
  `D26` int(11) DEFAULT NULL,
  `D27` int(11) DEFAULT NULL,
  `D28` int(11) DEFAULT NULL,
  `D29` int(11) DEFAULT NULL,
  `D30` int(11) DEFAULT NULL,
  `D31` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar_table`
--

INSERT INTO `calendar_table` (`id`, `D1`, `D2`, `D3`, `D4`, `D5`, `D6`, `D7`, `D8`, `D9`, `D10`, `D11`, `D12`, `D13`, `D14`, `D15`, `D16`, `D17`, `D18`, `D19`, `D20`, `D21`, `D22`, `D23`, `D24`, `D25`, `D26`, `D27`, `D28`, `D29`, `D30`, `D31`) VALUES
(1, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 14, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);

-- --------------------------------------------------------

--
-- Table structure for table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(11) UNSIGNED NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `suffix` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `jo` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `signatures`
--

INSERT INTO `signatures` (`id`, `fname`, `lname`, `mname`, `suffix`, `position`, `status`, `jo`, `created_at`) VALUES
(2, 'Bernard', 'Cabison', 'L', '', 'Head, WMD', '3', 0, '2021-09-19 04:59:14'),
(3, 'Antonio', 'Esteves', 'C', 'Jr', 'Foreman, Hauling Operation', '2', 0, '2021-09-19 06:04:06'),
(4, 'Cecille', 'Esguerra', 'F', '', 'Member, Technical Working Group', '1', 0, '2021-09-19 06:17:08'),
(5, 'Gloria', 'Cornel', '', '', 'Job Order', '1', 1, '2021-09-19 06:17:49'),
(6, 'Jay', 'Aguinaldo', 'R', '', 'Job Order', '1', 1, '2021-09-19 06:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `account_type` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_no` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `account_type`, `email`, `phone_no`, `username`, `password`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(53, 'Bacayao Norte', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bacayaonorte', '$2y$10$TiJpmREgkxlILyGEIC5rIeuyTCe2RLGAYJor7IfFby0Kdf6KizR.C', 0, '2021-09-14 04:32:34', NULL, NULL),
(54, 'Bacayao Sur', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bacayaosur', '$2y$10$GRzq5Udfg2D07uEHNF08uOqPJt04tOD9A.li1Achf5kEzsALmRSlK', 0, '2021-09-14 04:33:06', NULL, NULL),
(55, 'Barangay I (T.Bugallon)', 'Barangay', 'sample@gmail.com', '09123456789', 'user_barangay1', '$2y$10$Q5y4faVuWMZ9BUUezLHjUeDrO85/JgkcQdxmCEuvJydePWEfCZNH.', 0, '2021-09-14 04:33:58', NULL, NULL),
(56, 'Barangay II (Nueva)', 'Barangay', 'sample@gmail.com', '09123456789', 'user_barangay2', '$2y$10$qBJasL5oqV3dvZJkEkHJ7u3BooK/sM1aT4Mi8koADJ8HNFTt3OuFe', 0, '2021-09-14 04:34:48', NULL, NULL),
(57, 'Barangay IV (Zamora)', 'Barangay', 'sample@gmail.com', '09123456789', 'user_barangay4', '$2y$10$LACeSQSDSloRqHMpY.Fw4eHccQDEfsBgursqN6u.pFbsRxs082w2u', 0, '2021-09-14 04:52:19', NULL, NULL),
(58, 'Bolosan', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bolosan', '$2y$10$daBTONJE6fKrxhmQ9ysRneHQPfAL/uz2sRh7.KX49JQ8oVEA5VHLy', 0, '2021-09-14 04:38:59', NULL, NULL),
(59, 'Bonuan Binloc', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bonuanbinloc', '$2y$10$8bGxTgDkN7Pem9PWLe.T3OmqGxcrrUS1zv2P3HHbs9EkkneD6oPQy', 0, '2021-09-14 04:40:58', NULL, NULL),
(60, 'Bonuan Boquig', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bonuanboquig', '$2y$10$RPjHQh0HTCP0bh7gX1D0OehtYvzsXYvtYd2VqoxI3mYOa5P8Fdtgm', 0, '2021-09-14 04:42:14', NULL, NULL),
(61, 'Bonuan Gueset', 'Barangay', 'sample@gmail.com', '09123456789', 'user_bonuangueset', '$2y$10$t6HHFRanVo4lITwNynGM2e5yCRzG0WGdFbyrZTc6f/VMDACUfFjmu', 0, '2021-09-14 04:42:44', NULL, NULL),
(62, 'Calmay', 'Barangay', 'sample@gmail.com', '09123456789', 'user_calmay', '$2y$10$4FwvOTcI8GOEsUOVrkWDPuTLClPkv3kzSYbNSGl4Lh8bKB09RZPcK', 0, '2021-09-14 04:43:21', NULL, NULL),
(63, 'Carael', 'Barangay', 'sample@gmail.com', '09123456789', 'user_carael', '$2y$10$DFrxjDLtjGcxCzK3pERCQO1jvUJinzrJWS3jOoTZPPISUB7hYPW0O', 0, '2021-09-14 04:44:00', NULL, NULL),
(64, 'Caranglaan', 'Barangay', 'sample@gmail.com', '09123456789', 'user_caranglaan', '$2y$10$BY8CSaxAXt5nxQ4pjfcpOesk7A13Gu90ly0GawR6eSI9xCEqdCXey', 0, '2021-09-14 04:48:13', NULL, NULL),
(65, 'Herrero', 'Barangay', 'sample@gmail.com', '09123456789', 'user_herrero', '$2y$10$22laDC/GVR9FbKqIKCKmZuQrlV98lWgMJaYMkBupqp5TxMVij0Ewa', 0, '2021-09-14 04:48:46', NULL, NULL),
(66, 'Lasip Chico', 'Barangay', 'sample@gmail.com', '09123456789', 'user_lasipchico', '$2y$10$50I9.UVmBLNPRu9t8JUA8ecN3YrY0wufg0zWz7zQbVylo4aUHFc/W', 0, '2021-09-14 04:51:54', NULL, NULL),
(67, 'Lasip Grande', 'Barangay', 'sample@gmail.com', '09123456789', 'user_lasipgrande', '$2y$10$VynjLs4Arji/weGbF.bUb.XhS8QmqlvCSX5Iee.twJXMQ2MtiPuqe', 0, '2021-09-14 04:54:46', NULL, NULL),
(68, 'Lomboy', 'Barangay', 'sample@gmail.com', '09123456789', 'user_lomboy', '$2y$10$SkKhV4I4A.H89wj55F05f.duQbXjVYFkVnLLvSm9nfSfIQ6Ox8Ox.', 0, '2021-09-14 04:57:27', NULL, NULL),
(69, 'Lucao', 'Barangay', 'sample@gmail.com', '09123456789', 'user_lucao', '$2y$10$qevN5pBp5Rj1PFYebNLeIuIWXdeycFkiz4.JOtVhaPYKUjNwvDH5K', 0, '2021-09-14 04:58:54', NULL, NULL),
(70, 'Malued', 'Barangay', 'sample@gmail.com', '09123456789', 'user_malued', '$2y$10$tkgCQ79pdAnS2/yrAa6Av.H5hHOGbMSDSlh86obey7srzq7sK0yem', 0, '2021-09-14 05:00:32', NULL, NULL),
(71, 'Mamalingling', 'Barangay', 'sample@gmail.com', '09123456789', 'user_mamalingling', '$2y$10$S53sk4fgJASIenui58e5.u8bcVqsevpZ2.ZoHo9iJtkmSyu8j80h2', 0, '2021-09-14 05:01:15', NULL, NULL),
(72, 'Mangin', 'Barangay', 'sample@gmail.com', '09123456789', 'user_mangin', '$2y$10$M0qOUGh2ovFZGmFe468UQOGzUO2Whn/QejQU5iu/k/rdwNnVPWo6q', 0, '2021-09-14 05:01:43', NULL, NULL),
(73, 'Mayombo', 'Barangay', 'sample@gmail.com', '09123456789', 'user_mayombo', '$2y$10$AjYpyknCU1JgkFbo3a3dzey0aFPPZAZFD14hp0A2x0x.ycdFHO6nG', 0, '2021-09-14 05:03:02', NULL, NULL),
(74, 'Pantal', 'Barangay', 'sample@gmail.com', '09123456789', 'user_pantal', '$2y$10$HIqs7Z6gMqA4jWpe6oFC..rMpT/tp0GMTW5aEsusU6ZiggQUh8AN2', 0, '2021-09-14 05:03:26', NULL, NULL),
(75, 'Poblacion Oeste', 'Barangay', 'sample@gmail.com', '09123456789', 'user_poblacionoeste', '$2y$10$BUqbOn.vJfqgm.2EnBZDAOPW.JHnkGmSz/jBldh1wxEmmyCH9luEC', 0, '2021-09-14 05:11:32', NULL, NULL),
(76, 'Pogo Chico', 'Barangay', 'sample@gmail.com', '09123456789', 'user_pogochico', '$2y$10$AjWL3pHlX54T3MbRKS1WK.6/nesiPlLg9nSQF9bUw.M3yeLfYUBYe', 0, '2021-09-14 05:05:07', NULL, NULL),
(77, 'Pogo Grande', 'Barangay', 'sample@gmail.com', '09123456789', 'user_pogogrande', '$2y$10$qbvOh9WoXdCgOSZNTkr/KOFJ0UU9Nm.TC9PCG1A1QGsF4T1EJMw2m', 0, '2021-09-14 05:05:37', NULL, NULL),
(78, 'Pugaro Suit', 'Barangay', 'sample@gmail.com', '09123456789', 'user_pugaro', '$2y$10$HccIbMcUzS9NXmRcbTalM.w0vo/zwVC1SyXYi9IdcEaRwhbuk7Mo.', 0, '2021-09-14 05:06:23', NULL, NULL),
(79, 'Salapingao', 'Barangay', 'sample@gmail.com', '09123456789', 'user_salapingao', '$2y$10$Kg40rzN1NrhSN.FxHG6bReWmgeQ5trjzcJmk4lENyg7iu/WIh4VAS', 0, '2021-09-14 05:07:01', NULL, NULL),
(80, 'Salisay', 'Barangay', 'sample@gmail.com', '09123456789', 'user_salisay', '$2y$10$mKFwxmkE1SNeJHdbTB5pd.YTPSBos.J22HtN4PvZ5ZNeybElAiGPy', 0, '2021-09-14 05:07:52', NULL, NULL),
(81, 'Tambac', 'Barangay', 'sample@gmail.com', '09123456789', 'user_tambac', '$2y$10$1ohwibYdlJRUxmK7oyiFaeyfRbWBlYVbu/fOIEz3a2TAiCOBIb6Zi', 0, '2021-09-14 05:09:36', NULL, NULL),
(82, 'Tapuac', 'Barangay', 'sample@gmail.com', '09123456789', 'user_tapuac', '$2y$10$7JgktZ6MmIB2D51Xez1PVOlqiBiIg88sxsO6Qk4batnCACqaf8gYO', 0, '2021-09-14 05:10:21', NULL, NULL),
(83, 'Tebeng', 'Barangay', 'sample@gmail.com', '09123456789', 'user_tebeng', '$2y$10$uWfDX/RBfXIDJiHBHsyDLexmq1zL3CPsIpToekugXDd.v.R527xPu', 0, '2021-09-14 05:11:06', NULL, NULL),
(84, 'Dumpsite Dummy 1', 'Dumpsite', 'DDM@gmail.com', '09123678910', 'DDM', '$2y$10$4u4sNJKKpdRpzbdHvvva.O1S.R8JOGY0NfhpJWqsau6PPlM0bGCCO', 0, '2021-09-17 04:54:09', NULL, NULL),
(85, 'Dumpsite Dummy 2', 'Dumpsite', 'DDM2@gmail.com', '09091910123', 'DDM2', '$2y$10$WZQtrUzD2tf/bLZ5hk.aW.3UirewvDPUMIOEDnQ0a8gRHrPgDocbm', 0, '2021-11-09 00:55:49', NULL, NULL),
(87, 'dumpsite1', 'Dumpsite', 'DDM2@gmail.com', '09484728457', 'dumpsite1', '$2y$10$JaHc4rud3RZ6sDajVSh9h.3aRCRBFA.lkZH5xthM.SLqFSjgGGo9G', 0, '2021-11-09 00:56:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `superadmin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_brgy`
--

CREATE TABLE `user_brgy` (
  `brgy_id` int(11) UNSIGNED NOT NULL,
  `barangay_name` varchar(250) DEFAULT NULL,
  `phone_no` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `superadmin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_brgy`
--

INSERT INTO `user_brgy` (`brgy_id`, `barangay_name`, `phone_no`, `email`, `username`, `password`, `superadmin_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(19, 'A', '1233513514', 'helo@gmail.com', 'calone@gmail.com', '$2y$10$G/yV48pb3aFQ10kWQ6VP.OPQI627o694NGCnGSpP6eh', NULL, NULL, NULL, NULL),
(20, 'B', '09091901901', 'hello@gmail.com', 'calonge@gmail.com', '$2y$10$giFaghhwc0Y8zfLwNmqxQeQfa7y9gNLLCBpISI7NcXF', NULL, NULL, NULL, NULL),
(22, 'C', '09091901901', 'aa@gmail.com', 'qwqws', '$2y$10$L0.7LG9.uA.9UIqvn5j9JukLy.XUdiEKZ.UfgszSXWh', NULL, NULL, NULL, NULL),
(24, 'D', '09091901901', 'hello@gmail.com', 'qwqw', '$2y$10$2kd2lcaSb8LSqJWUoQDYnOV2Sg/aK4SnM3O6Cumnapz', NULL, NULL, NULL, NULL),
(25, NULL, NULL, 'aa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_superadmin`
--

CREATE TABLE `user_superadmin` (
  `id` int(10) UNSIGNED NOT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_superadmin`
--

INSERT INTO `user_superadmin` (`id`, `lname`, `mname`, `fname`, `username`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'hallo', NULL, NULL, 'ali@gmail.com', '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq', '2021-08-14 05:55:07', NULL, NULL),
(18, 'Christian', NULL, NULL, 'calonge@gmail.com', '$2y$10$G/XSsOb0i5QU4bREckEIleulqUeMs/ruTTfeJcRqlrfLxTyMfibLa', '2021-08-14 06:18:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waste_brgy`
--

CREATE TABLE `waste_brgy` (
  `id` int(11) UNSIGNED NOT NULL,
  `volume` float UNSIGNED DEFAULT NULL,
  `waste_type` varchar(50) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `collection_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `attempt` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brgy_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waste_brgy`
--

INSERT INTO `waste_brgy` (`id`, `volume`, `waste_type`, `brgy_name`, `collection_date`, `created_at`, `attempt`, `deleted_at`, `updated_at`, `brgy_id`, `status`) VALUES
(342, 1, 'Biodegradable', 'Bacayao Norte', '2021-09-26 10:40:07', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(343, 2, 'Non-Biodegradable', 'Bacayao Norte', '2021-09-26 10:40:07', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(344, 1.2, 'Infectious', 'Bacayao Norte', '2021-09-26 10:40:07', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(345, 0.9, 'Biodegradable', 'Bacayao Sur', '2021-09-27 10:40:22', '2021-10-03 10:53:00', 3, NULL, NULL, 54, 0),
(346, 0.8, 'Non-Biodegradable', 'Bacayao Sur', '2021-09-27 10:40:22', '2021-10-03 10:53:00', 3, NULL, NULL, 54, 0),
(347, 0.7, 'Infectious', 'Bacayao Sur', '2021-09-27 10:40:22', '2021-10-03 10:53:00', 3, NULL, NULL, 54, 0),
(348, 1.2, 'Biodegradable', 'Barangay I (T.Bugallon)', '2021-09-27 10:41:43', '2021-10-03 10:53:00', 3, NULL, NULL, 55, 0),
(349, 1.9, 'Non-Biodegradable', 'Barangay I (T.Bugallon)', '2021-09-27 10:41:43', '2021-10-03 10:53:00', 3, NULL, NULL, 55, 0),
(350, 0.9, 'Infectious', 'Barangay I (T.Bugallon)', '2021-09-27 10:41:43', '2021-10-03 10:53:00', 3, NULL, NULL, 55, 0),
(351, 1, 'Biodegradable', 'Barangay II (Nueva)', '2021-09-27 10:41:59', '2021-10-03 10:53:00', 3, NULL, NULL, 56, 0),
(352, 1.8, 'Non-Biodegradable', 'Barangay II (Nueva)', '2021-09-27 10:41:59', '2021-10-03 10:53:00', 3, NULL, NULL, 56, 0),
(353, 0.9, 'Infectious', 'Barangay II (Nueva)', '2021-09-27 10:41:59', '2021-10-03 10:53:00', 3, NULL, NULL, 56, 0),
(354, 2.3, 'Biodegradable', 'Barangay IV (Zamora)', '2021-09-27 10:42:17', '2021-10-03 10:53:00', 3, NULL, NULL, 57, 0),
(355, 1.9, 'Non-Biodegradable', 'Barangay IV (Zamora)', '2021-09-27 10:42:17', '2021-10-03 10:53:00', 3, NULL, NULL, 57, 0),
(356, 0.9, 'Infectious', 'Barangay IV (Zamora)', '2021-09-27 10:42:17', '2021-10-03 10:53:00', 3, NULL, NULL, 57, 0),
(357, 1.2, 'Biodegradable', 'Bolosan', '2021-09-27 10:47:12', '2021-10-03 10:53:00', 3, NULL, NULL, 58, 0),
(358, 1.2, 'Non-Biodegradable', 'Bolosan', '2021-09-27 10:47:12', '2021-10-03 10:53:00', 3, NULL, NULL, 58, 0),
(359, 0.1, 'Infectious', 'Bolosan', '2021-09-27 10:47:12', '2021-10-03 10:53:00', 3, NULL, NULL, 58, 0),
(360, 1.2, 'Biodegradable', 'Bonuan Binloc', '2021-09-27 11:41:48', '2021-10-03 10:53:00', 3, NULL, NULL, 59, 0),
(361, 0.9, 'Non-Biodegradable', 'Bonuan Binloc', '2021-09-27 11:41:48', '2021-10-03 10:53:00', 3, NULL, NULL, 59, 0),
(362, 1.2, 'Infectious', 'Bonuan Binloc', '2021-09-27 11:41:48', '2021-10-03 10:53:00', 3, NULL, NULL, 59, 0),
(363, 0.2, 'Biodegradable', 'Bonuan Boquig', '2021-09-27 11:45:14', '2021-10-03 10:53:00', 3, NULL, NULL, 60, 0),
(364, 0.8, 'Non-Biodegradable', 'Bonuan Boquig', '2021-09-27 11:45:14', '2021-10-03 10:53:00', 3, NULL, NULL, 60, 0),
(365, 0.8, 'Infectious', 'Bonuan Boquig', '2021-09-27 11:45:14', '2021-10-03 10:53:00', 3, NULL, NULL, 60, 0),
(366, 1.2, 'Biodegradable', 'Bonuan Gueset', '2021-09-27 11:48:48', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(367, 0.9, 'Non-Biodegradable', 'Bonuan Gueset', '2021-09-27 11:48:48', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(368, 0.7, 'Infectious', 'Bonuan Gueset', '2021-09-27 11:48:48', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(369, 1.2, 'Biodegradable', 'Calmay', '2021-09-27 12:02:09', '2021-10-03 10:53:00', 3, NULL, NULL, 62, 0),
(370, 0.9, 'Non-Biodegradable', 'Calmay', '2021-09-27 12:02:09', '2021-10-03 10:53:00', 3, NULL, NULL, 62, 0),
(371, 0.8, 'Infectious', 'Calmay', '2021-09-27 12:02:09', '2021-10-03 10:53:00', 3, NULL, NULL, 62, 0),
(372, 0.4, 'Biodegradable', 'Caranglaan', '2021-09-27 12:51:30', '2021-10-03 10:53:00', 3, NULL, NULL, 64, 0),
(373, 0.8, 'Non-Biodegradable', 'Caranglaan', '2021-09-27 12:51:30', '2021-10-03 10:53:00', 3, NULL, NULL, 64, 0),
(374, 1.9, 'Infectious', 'Caranglaan', '2021-09-27 12:51:30', '2021-10-03 10:53:00', 3, NULL, NULL, 64, 0),
(375, 1, 'Biodegradable', 'Herrero', '2021-09-27 12:52:51', '2021-10-03 10:53:00', 3, NULL, NULL, 65, 0),
(376, 0.2, 'Non-Biodegradable', 'Herrero', '2021-09-27 12:52:51', '2021-10-03 10:53:00', 3, NULL, NULL, 65, 0),
(377, 0.9, 'Infectious', 'Herrero', '2021-09-27 12:52:51', '2021-10-03 10:50:45', 3, NULL, NULL, 65, 0),
(378, 1.2, 'Biodegradable', 'Lasip Grande', '2021-09-27 12:53:49', '2021-10-03 10:53:00', 3, NULL, NULL, 67, 0),
(379, 0.9, 'Non-Biodegradable', 'Lasip Grande', '2021-09-27 12:53:49', '2021-10-03 10:50:46', 3, NULL, NULL, 67, 0),
(380, 1.4, 'Infectious', 'Lasip Grande', '2021-09-27 12:53:49', '2021-10-03 10:53:00', 3, NULL, NULL, 67, 0),
(381, 1.2, 'Biodegradable', 'Lomboy', '2021-09-27 12:58:03', '2021-10-03 10:53:00', 3, NULL, NULL, 68, 0),
(382, 0.9, 'Non-Biodegradable', 'Lomboy', '2021-09-27 12:58:03', '2021-10-03 10:53:00', 3, NULL, NULL, 68, 0),
(383, 0.8, 'Infectious', 'Lomboy', '2021-09-27 12:58:03', '2021-10-03 10:53:00', 3, NULL, NULL, 68, 0),
(384, 0.8, 'Biodegradable', 'Lucao', '2021-09-27 12:59:43', '2021-10-03 10:53:00', 3, NULL, NULL, 69, 0),
(385, 0.8, 'Non-Biodegradable', 'Lucao', '2021-09-27 12:59:43', '2021-10-03 10:53:00', 3, NULL, NULL, 69, 0),
(386, 0.5, 'Infectious', 'Lucao', '2021-09-27 12:59:43', '2021-10-03 10:53:00', 3, NULL, NULL, 69, 0),
(387, 1.2, 'Biodegradable', 'Pantal', '2021-09-27 13:00:38', '2021-10-03 10:53:00', 3, NULL, NULL, 74, 0),
(388, 0.1, 'Non-Biodegradable', 'Pantal', '2021-09-27 13:00:38', '2021-10-03 10:53:00', 3, NULL, NULL, 74, 0),
(389, 0.9, 'Infectious', 'Pantal', '2021-09-27 13:00:38', '2021-10-03 10:53:00', 3, NULL, NULL, 74, 0),
(390, 1.2, 'Biodegradable', 'Tapuac', '2021-09-28 00:27:30', '2021-10-03 10:53:00', 3, NULL, NULL, 82, 0),
(391, 1.2, 'Non-Biodegradable', 'Tapuac', '2021-09-28 00:27:30', '2021-10-03 10:53:00', 3, NULL, NULL, 82, 0),
(392, 1.4, 'Infectious', 'Tapuac', '2021-09-28 00:27:30', '2021-10-03 10:53:00', 3, NULL, NULL, 82, 0),
(393, 1.2, 'Biodegradable', 'Bacayao Norte', '2021-09-28 00:28:24', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(394, 0.9, 'Non-Biodegradable', 'Bacayao Norte', '2021-09-28 00:28:24', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(395, 0.8, 'Infectious', 'Bacayao Norte', '2021-09-28 00:28:24', '2021-10-03 10:53:00', 3, NULL, NULL, 53, 0),
(396, 1.2, 'Biodegradable', 'Bonuan Gueset', '2021-09-28 00:37:00', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(397, 1.4, 'Non-Biodegradable', 'Bonuan Gueset', '2021-09-28 00:37:00', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(398, 1.2, 'Infectious', 'Bonuan Gueset', '2021-09-28 00:37:00', '2021-10-03 10:53:00', 3, NULL, NULL, 61, 0),
(399, 1.2, 'Biodegradable', 'Mayombo', '2021-09-28 01:21:39', '2021-10-03 10:53:00', 3, NULL, NULL, 73, 0),
(400, 1.4, 'Non-Biodegradable', 'Mayombo', '2021-09-28 01:21:39', '2021-10-03 10:53:00', 3, NULL, NULL, 73, 0),
(401, 1.3, 'Infectious', 'Mayombo', '2021-09-28 01:21:39', '2021-10-03 10:53:00', 3, NULL, NULL, 73, 0),
(402, 1.9, 'Biodegradable', 'Tapuac', '2021-10-03 10:17:13', '2021-10-03 10:58:59', 0, NULL, '2021-10-03 10:58:59', 82, 0),
(403, 1.5, 'Non-Biodegradable', 'Tapuac', '2021-10-03 10:17:13', '2021-10-03 10:54:56', 2, NULL, '2021-10-03 10:54:56', 82, 0),
(404, 1.8, 'Infectious', 'Tapuac', '2021-10-03 10:17:13', '2021-10-03 10:53:00', 3, NULL, NULL, 82, 0),
(405, 1.9, 'Biodegradable', 'Tapuac', '2021-10-04 02:43:17', '2021-10-24 03:57:57', 0, NULL, '2021-10-04 03:09:27', 82, 0),
(406, 0.9, 'Non-Biodegradable', 'Tapuac', '2021-10-04 02:43:17', '2021-10-24 03:57:57', 0, NULL, '2021-10-04 03:10:22', 82, 0),
(407, 1.5, 'Infectious', 'Tapuac', '2021-10-04 02:43:17', '2021-10-24 03:57:57', 2, NULL, '2021-10-04 02:50:27', 82, 0),
(411, 1.8, 'Biodegradable', 'Bacayao Norte', '2021-10-24 03:27:22', '2021-10-24 03:57:57', 0, NULL, '2021-10-24 03:44:32', 53, 0),
(412, 2.5, 'Non-Biodegradable', 'Bacayao Norte', '2021-10-24 03:27:22', '2021-10-24 03:57:57', 2, NULL, '2021-10-24 03:42:58', 53, 0),
(413, 2.8, 'Infectious', 'Bacayao Norte', '2021-10-24 03:27:22', '2021-10-24 03:57:57', 2, NULL, '2021-10-24 03:44:27', 53, 0),
(417, 1.1, 'Biodegradable', 'Bacayao Norte', '2021-10-22 16:00:00', '2021-10-24 03:57:57', 2, NULL, '2021-10-24 03:56:08', 53, 0),
(418, 1.7, 'Non-Biodegradable', 'Bacayao Norte', '2021-10-22 16:00:00', '2021-10-24 03:59:13', 2, NULL, '2021-10-24 03:59:13', 53, 0),
(419, 1.5, 'Infectious', 'Bacayao Norte', '2021-10-22 16:00:00', '2021-10-24 03:57:57', 3, NULL, NULL, 53, 0),
(420, 1.2, 'Biodegradable', 'Tapuac', '2021-10-27 01:01:10', '2021-10-27 06:25:14', 3, NULL, NULL, 82, 0),
(421, 1.2, 'Non-Biodegradable', 'Tapuac', '2021-10-27 01:01:10', '2021-10-27 06:25:14', 3, NULL, NULL, 82, 0),
(422, 1.9, 'Infectious', 'Tapuac', '2021-10-27 01:01:10', '2021-10-27 06:25:14', 3, NULL, NULL, 82, 0),
(423, 5, 'Biodegradable', 'Tebeng', '2021-11-09 05:17:09', '2021-11-09 05:17:09', 3, NULL, NULL, 83, 1),
(424, 1.4, 'Non-Biodegradable', 'Tebeng', '2021-11-09 05:17:09', '2021-11-09 05:17:09', 3, NULL, NULL, 83, 1),
(425, 0.1, 'Infectious', 'Tebeng', '2021-11-09 05:17:09', '2021-11-09 05:17:09', 3, NULL, NULL, 83, 1);

-- --------------------------------------------------------

--
-- Table structure for table `waste_collection`
--

CREATE TABLE `waste_collection` (
  `id` int(11) UNSIGNED NOT NULL,
  `volume` int(10) UNSIGNED DEFAULT NULL,
  `bio` int(10) UNSIGNED DEFAULT NULL,
  `nonBio` int(10) UNSIGNED DEFAULT NULL,
  `infect` int(10) UNSIGNED DEFAULT NULL,
  `waste_type` varchar(50) DEFAULT NULL,
  `dump_name` varchar(50) DEFAULT NULL,
  `brgy_name` varchar(50) DEFAULT NULL,
  `collection_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `waste_collection`
--

INSERT INTO `waste_collection` (`id`, `volume`, `bio`, `nonBio`, `infect`, `waste_type`, `dump_name`, `brgy_name`, `collection_date`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, NULL, 0, 0, 0, NULL, NULL, NULL, '2021-08-18 10:53:56', NULL, '2021-08-18 10:53:56', NULL, NULL),
(15, NULL, 11, 1, 1, NULL, NULL, NULL, '2021-08-18 10:54:05', NULL, '2021-08-18 10:54:05', NULL, NULL),
(16, NULL, 0, 0, 0, NULL, NULL, NULL, '2021-08-19 01:02:30', NULL, '2021-08-19 01:02:30', NULL, NULL),
(17, NULL, 12, 23, 1, NULL, NULL, NULL, '2021-08-19 01:03:00', NULL, '2021-08-19 01:03:00', NULL, NULL),
(18, NULL, 1, 2, 2, NULL, NULL, NULL, '2021-08-19 01:08:53', NULL, '2021-08-19 01:08:53', NULL, NULL),
(19, NULL, 1, 1, 1, NULL, NULL, NULL, '2021-08-22 06:04:53', NULL, '2021-08-22 06:04:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waste_dump`
--

CREATE TABLE `waste_dump` (
  `id` int(11) UNSIGNED NOT NULL,
  `volume` float UNSIGNED DEFAULT NULL,
  `waste_type` varchar(50) DEFAULT NULL,
  `dump_name` varchar(50) DEFAULT NULL,
  `numberoftruck` varchar(50) DEFAULT NULL,
  `dump_id` int(11) DEFAULT NULL,
  `collection_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `waste_dump`
--

INSERT INTO `waste_dump` (`id`, `volume`, `waste_type`, `dump_name`, `numberoftruck`, `dump_id`, `collection_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(36, 20.9, 'Non-Biodegradable', 'Dumpsite Dummy 1', NULL, 84, '2021-09-17 22:44:17', '2021-09-18 11:44:17', NULL, NULL),
(37, 29.8, 'Non-Biodegradable', 'Dumpsite Dummy 2', NULL, 85, '2021-09-17 22:44:34', '2021-09-18 11:44:34', NULL, NULL),
(38, 5.9, 'Non-Biodegradable', 'Dumpsite Dummy 1', NULL, 84, '2021-09-26 21:43:33', '2021-09-27 10:43:33', NULL, NULL),
(39, 29.9, 'Non-Biodegradable', 'Dumpsite Dummy 1', NULL, 84, '2021-10-26 16:52:12', '2021-10-27 05:52:12', NULL, NULL),
(40, 80.1, 'Non-Biodegradable', 'dumpsite1', NULL, 87, '2021-11-08 10:57:39', '2021-11-09 00:57:39', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `waste_type`
--

CREATE TABLE `waste_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `waste` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `waste_type`
--

INSERT INTO `waste_type` (`id`, `waste`, `created_at`, `status`) VALUES
(3, 'Biodegradable', '2021-08-27 06:44:23', 0),
(4, 'Non-Biodegradable', '2021-08-27 06:46:06', 1),
(5, 'Infectious', '2021-08-27 07:35:11', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `admin_account_type`
--
ALTER TABLE `admin_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendar_table`
--
ALTER TABLE `calendar_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `user_brgy`
--
ALTER TABLE `user_brgy`
  ADD PRIMARY KEY (`brgy_id`) USING BTREE;

--
-- Indexes for table `user_superadmin`
--
ALTER TABLE `user_superadmin`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `waste_brgy`
--
ALTER TABLE `waste_brgy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waste_collection`
--
ALTER TABLE `waste_collection`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `waste_dump`
--
ALTER TABLE `waste_dump`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `waste_type`
--
ALTER TABLE `waste_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `calendar_table`
--
ALTER TABLE `calendar_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_brgy`
--
ALTER TABLE `user_brgy`
  MODIFY `brgy_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_superadmin`
--
ALTER TABLE `user_superadmin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `waste_brgy`
--
ALTER TABLE `waste_brgy`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT for table `waste_collection`
--
ALTER TABLE `waste_collection`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `waste_dump`
--
ALTER TABLE `waste_dump`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `waste_type`
--
ALTER TABLE `waste_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
