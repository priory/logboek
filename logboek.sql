-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 31 aug 2019 om 14:28
-- Serverversie: 10.3.16-MariaDB
-- PHP-versie: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logboek`
--
CREATE DATABASE IF NOT EXISTS `logboek` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `logboek`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cohorts`
--

CREATE TABLE `cohorts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cohorts`
--

INSERT INTO `cohorts` (`id`, `name`) VALUES
(1, 'Cohort 2017'),
(2, 'Cohort 2018'),
(3, 'Cohort 2019');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cubicles`
--

CREATE TABLE `cubicles` (
  `id` int(11) NOT NULL,
  `number` int(3) NOT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cubicles`
--

INSERT INTO `cubicles` (`id`, `number`, `group_id`) VALUES
(1, 1, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 7, NULL),
(8, 8, NULL),
(9, 9, NULL),
(10, 10, NULL),
(11, 11, NULL),
(12, 12, NULL),
(13, 13, NULL),
(14, 14, NULL),
(15, 15, NULL),
(16, 16, NULL),
(17, 17, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `cubicle_id` int(11) DEFAULT NULL,
  `year_id` int(11) NOT NULL,
  `trimester_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `groups`
--

INSERT INTO `groups` (`id`, `cubicle_id`, `year_id`, `trimester_id`, `name`) VALUES
(1, 17, 1, 3, 'Idk'),
(13, NULL, 1, 1, 'Test');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `group_student`
--

CREATE TABLE `group_student` (
  `group_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `group_student`
--

INSERT INTO `group_student` (`group_id`, `student_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `level` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `levels`
--

INSERT INTO `levels` (`id`, `level`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `logs`
--

INSERT INTO `logs` (`id`, `content`, `date`, `user_id`, `student_id`, `group_id`) VALUES
(9, 'Dit is Joël', '2019-08-30 23:54:09', 1, 1, 1),
(10, 'Test voor werkplek 17', '2019-08-30 23:54:58', 1, NULL, 1),
(11, 'Test', '2019-08-31 12:27:41', 1, NULL, 1),
(12, 'Test', '2019-08-31 12:27:47', 1, 1, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `periods`
--

CREATE TABLE `periods` (
  `id` int(11) NOT NULL,
  `period` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `periods`
--

INSERT INTO `periods` (`id`, `period`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `cohort_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `students`
--

INSERT INTO `students` (`id`, `name`, `surname`, `group_id`, `cohort_id`, `level_id`) VALUES
(1, 'Joël', 'Eeveren, van', 1, 1, 9),
(2, 'Vladik', 'Packo', 1, 1, 9),
(3, 'Thijmen', 'Avoort, van de', 1, 1, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `trimesters`
--

CREATE TABLE `trimesters` (
  `id` int(11) NOT NULL,
  `trimester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `trimesters`
--

INSERT INTO `trimesters` (`id`, `trimester`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1, 'admin', '$2y$10$09nM8SArZRiKnAUZBWRGBOsO495A7QhWp.S4n6aX.IkYGie86IsOS');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `years`
--

CREATE TABLE `years` (
  `id` int(11) NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `years`
--

INSERT INTO `years` (`id`, `year`) VALUES
(1, 2019),
(2, 2020);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cohorts`
--
ALTER TABLE `cohorts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `cubicles`
--
ALTER TABLE `cubicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cubicles_group_id_foreign` (`group_id`);

--
-- Indexen voor tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_cubicle_id_year_id_period_id_unique` (`cubicle_id`,`year_id`,`trimester_id`) USING BTREE,
  ADD KEY `groups_year_id_foreign` (`year_id`),
  ADD KEY `groups_period_id_foreign` (`trimester_id`);

--
-- Indexen voor tabel `group_student`
--
ALTER TABLE `group_student`
  ADD PRIMARY KEY (`group_id`,`student_id`),
  ADD KEY `group_student_student_id_foreign` (`student_id`);

--
-- Indexen voor tabel `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_group_id_foreign` (`group_id`),
  ADD KEY `logs_student_id_foreign` (`student_id`);

--
-- Indexen voor tabel `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_group_id_foreign` (`group_id`),
  ADD KEY `studnets_cohort_id_foreign` (`cohort_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexen voor tabel `trimesters`
--
ALTER TABLE `trimesters`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cohorts`
--
ALTER TABLE `cohorts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `cubicles`
--
ALTER TABLE `cubicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT voor een tabel `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `periods`
--
ALTER TABLE `periods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `trimesters`
--
ALTER TABLE `trimesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `years`
--
ALTER TABLE `years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cubicles`
--
ALTER TABLE `cubicles`
  ADD CONSTRAINT `cubicles_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Beperkingen voor tabel `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_cubicle_id_foreign` FOREIGN KEY (`cubicle_id`) REFERENCES `cubicles` (`id`),
  ADD CONSTRAINT `groups_trimest_id_foreign` FOREIGN KEY (`trimester_id`) REFERENCES `trimesters` (`id`),
  ADD CONSTRAINT `groups_year_id_foreign` FOREIGN KEY (`year_id`) REFERENCES `years` (`id`);

--
-- Beperkingen voor tabel `group_student`
--
ALTER TABLE `group_student`
  ADD CONSTRAINT `group_student_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `group_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `logs_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Beperkingen voor tabel `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`),
  ADD CONSTRAINT `studnets_cohort_id_foreign` FOREIGN KEY (`cohort_id`) REFERENCES `cohorts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
