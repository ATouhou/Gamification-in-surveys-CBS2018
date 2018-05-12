-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Vært: localhost:3306
-- Genereringstid: 12. 05 2018 kl. 13:37:38
-- Serverversion: 10.1.33-MariaDB
-- PHP-version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adamtouh_gamification`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `bs_entries`
--

CREATE TABLE `bs_entries` (
  `id` bigint(20) NOT NULL,
  `uuid` text NOT NULL,
  `useragent` longtext NOT NULL,
  `ip` text NOT NULL,
  `email` text NOT NULL,
  `name` text NOT NULL,
  `firstroute` text NOT NULL COMMENT '1 == gamified. 2 == standard',
  `gamified_start` datetime NOT NULL,
  `gamified_finished` datetime NOT NULL,
  `standard_start` datetime NOT NULL,
  `standard_finished` datetime NOT NULL,
  `g_q1` text NOT NULL,
  `g_q2` text NOT NULL,
  `g_q3` text NOT NULL,
  `g_q4` text NOT NULL,
  `g_q5` text NOT NULL,
  `g_q6` text NOT NULL,
  `g_q7` text NOT NULL,
  `g_q8` text NOT NULL,
  `g_q9` text NOT NULL,
  `g_q10` text NOT NULL,
  `g_q11` text NOT NULL,
  `g_q12` text NOT NULL,
  `g_q13` text NOT NULL,
  `g_q14` text NOT NULL,
  `g_q15` text NOT NULL,
  `g_q16` text NOT NULL,
  `g_q17` text NOT NULL,
  `s_q1` text NOT NULL,
  `s_q2` text NOT NULL,
  `s_q3` text NOT NULL,
  `s_q4` text NOT NULL,
  `s_q5` text NOT NULL,
  `s_q6` text NOT NULL,
  `s_q7` text NOT NULL,
  `s_q8` text NOT NULL,
  `s_q9` text NOT NULL,
  `s_q10` text NOT NULL,
  `s_q11` text NOT NULL,
  `s_q12` text NOT NULL,
  `s_q13` text NOT NULL,
  `s_q14` text NOT NULL,
  `s_q15` text NOT NULL,
  `s_q16` text NOT NULL,
  `s_q17` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Begrænsninger for dumpede tabeller
--

--
-- Indeks for tabel `bs_entries`
--
ALTER TABLE `bs_entries`
  ADD PRIMARY KEY (`id`);

--
-- Brug ikke AUTO_INCREMENT for slettede tabeller
--

--
-- Tilføj AUTO_INCREMENT i tabel `bs_entries`
--
ALTER TABLE `bs_entries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
