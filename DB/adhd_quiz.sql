-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Gegenereerd op: 22 mrt 2024 om 12:21
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
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `adhd_responses`
--

INSERT INTO `adhd_responses` (`id`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`, `fullname`, `email`, `Mogelijk_adhd`) VALUES
(58, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 'Frog', 'ribbit@gmail.com', 0),
(26, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'mr. poopiebutthole', 'ooowwiiee@gmail.nl', 0),
(28, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 'john doe', 'anonymous@gmail', 0),
(29, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'tester001', 'crilledgheese1@gmail.com', 1),
(36, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 'Shiba-inu', 'Doge@gmail.wow', 1),
(37, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 'tester 5', 'superEarth@malevolentbay.com', 1),
(38, 0, 1, 0, 1, 1, 0, 1, 0, 0, 1, 'Henry Howard Holmes', 'HHHChicago@gmail.com', 1),
(41, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 'Ed Gein', 'LeatherFace1906@gmial.com', 1),
(42, 1, 0, 1, 0, 0, 0, 1, 1, 0, 1, 'Fred Krueger', 'Sweaterman1938@gmail.com', 0),
(59, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Dovakhiin', 'FusRoDah@gmail.com', 0),
(57, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 'quandale dingle', 'burnaschool@gmail.com', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'Justin', '$2y$10$UZl23EL904LObUHMRECgguO21wFkXlejgmWA/W8kNxIem1bR4uKsK'),
(3, 'Wassim', '$2y$10$i2gzS65nf6s7.63EBBL2A.Y0Dz7LBjQ9dUFw9qnlTaOEacJFEMtPe');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) NOT NULL,
  `event_desc` text NOT NULL,
  `event_location` varchar(255) NOT NULL,
  `event_date` datetime NOT NULL,
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Gegevens worden geëxporteerd voor tabel `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_desc`, `event_location`, `event_date`) VALUES
(1, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 13:11:00'),
(2, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 13:11:00'),
(3, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 13:11:00'),
(4, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 13:11:00'),
(5, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 13:11:00'),
(6, 'test', 'dit is een test', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2452.8499890083185!2d5.099612576471904!3d52.06425507194524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c665948a2073bf%3A0xb8405acd63a12ee1!2sMBO%20Utrecht!5e0!3m2!1sen!2snl!4v1707385511798!5m', '2024-04-01 03:19:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
