-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 07 mrt 2024 om 10:05
-- Serverversie: 8.0.31
-- PHP-versie: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adhd_quiz`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `adhd_responses`
--

DROP TABLE IF EXISTS `adhd_responses`;
CREATE TABLE IF NOT EXISTS `adhd_responses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `q1` tinyint(1) DEFAULT NULL,
  `q2` tinyint(1) DEFAULT NULL,
  `q3` tinyint(1) DEFAULT NULL,
  `q4` tinyint(1) DEFAULT NULL,
  `q5` tinyint(1) DEFAULT NULL,
  `q6` tinyint(1) DEFAULT NULL,
  `q7` tinyint(1) DEFAULT NULL,
  `q8` tinyint(1) DEFAULT NULL,
  `q9` tinyint(1) DEFAULT NULL,
  `q10` tinyint(1) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `Mogelijk_adhd` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `adhd_responses`
--

INSERT INTO `adhd_responses` (`id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `fullname`, `email`, `Mogelijk_adhd`) VALUES
(27, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'john doe', 'anonymous@gmail', 0),
(26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'mr. poopiebutthole', 'ooowwiiee@gmail.nl', 0),
(28, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 'john doe', 'anonymous@gmail', 0),
(29, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'tester001', 'crilledgheese1@gmail.com', 1),
(36, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 'Shiba-inu', 'Doge@gmail.wow', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'Justin', '$2y$10$TxFehbXivT.rzThSz813zu09oSWmqxJgC8Z1DDSDmI/ahj/EkF/Iu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
