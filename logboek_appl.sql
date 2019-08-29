-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 29 aug 2019 om 11:10
-- Serverversie: 10.1.37-MariaDB
-- PHP-versie: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logboek_appl`
--
CREATE DATABASE IF NOT EXISTS `logboek_appl` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `logboek_appl`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cohort`
--

CREATE TABLE `cohort` (
  `Cohort_ID` int(11) NOT NULL,
  `Cohort` varchar(25) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `cohort`
--

INSERT INTO `cohort` (`Cohort_ID`, `Cohort`) VALUES
(1, '2017');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groepen`
--

CREATE TABLE `groepen` (
  `Groep` int(11) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `groepen`
--

INSERT INTO `groepen` (`Groep`, `Level`) VALUES
(17, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingen`
--

CREATE TABLE `leerlingen` (
  `leerling_ID` int(11) NOT NULL,
  `voornaam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tussenvoegsel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `achternaam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Cohort` int(11) NOT NULL,
  `Groep_id` int(11) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `leerlingen`
--

INSERT INTO `leerlingen` (`leerling_ID`, `voornaam`, `tussenvoegsel`, `achternaam`, `Cohort`, `Groep_id`, `Level`) VALUES
(5, 'Joel', 'van', 'Eeveren', 1, 17, 9),
(6, 'Vladik', '', 'Packo', 1, 17, 9),
(7, 'Thijmen', 'van der', 'Avoort', 1, 17, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `level`
--

CREATE TABLE `level` (
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `level`
--

INSERT INTO `level` (`Level`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `logs_ID` int(11) NOT NULL,
  `bericht` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL,
  `voor_leerling` int(11) DEFAULT NULL,
  `voor_groep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `logs`
--

INSERT INTO `logs` (`logs_ID`, `bericht`, `datum`, `user_id`, `voor_leerling`, `voor_groep`) VALUES
(13, 'Joel you can do it', '2019-08-28 12:57:42', NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `wachtwoord` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`user_ID`, `user`, `wachtwoord`) VALUES
(1, 'Henk', 'henk123');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `cohort`
--
ALTER TABLE `cohort`
  ADD PRIMARY KEY (`Cohort_ID`);

--
-- Indexen voor tabel `groepen`
--
ALTER TABLE `groepen`
  ADD PRIMARY KEY (`Groep`),
  ADD KEY `Level` (`Level`);

--
-- Indexen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD PRIMARY KEY (`leerling_ID`),
  ADD KEY `Groep_id` (`Groep_id`),
  ADD KEY `Level` (`Level`),
  ADD KEY `Cohort` (`Cohort`);

--
-- Indexen voor tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`Level`);

--
-- Indexen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs_ID`),
  ADD KEY `voor_groep` (`voor_groep`),
  ADD KEY `voor_leerling` (`voor_leerling`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `cohort`
--
ALTER TABLE `cohort`
  MODIFY `Cohort_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `groepen`
--
ALTER TABLE `groepen`
  MODIFY `Groep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT voor een tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  MODIFY `leerling_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT voor een tabel `level`
--
ALTER TABLE `level`
  MODIFY `Level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `logs_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `groepen`
--
ALTER TABLE `groepen`
  ADD CONSTRAINT `groepen_ibfk_1` FOREIGN KEY (`Level`) REFERENCES `level` (`Level`);

--
-- Beperkingen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD CONSTRAINT `leerlingen_ibfk_1` FOREIGN KEY (`Groep_id`) REFERENCES `groepen` (`Groep`),
  ADD CONSTRAINT `leerlingen_ibfk_2` FOREIGN KEY (`Level`) REFERENCES `level` (`Level`),
  ADD CONSTRAINT `leerlingen_ibfk_3` FOREIGN KEY (`Cohort`) REFERENCES `cohort` (`Cohort_ID`);

--
-- Beperkingen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`voor_groep`) REFERENCES `groepen` (`Groep`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`voor_leerling`) REFERENCES `leerlingen` (`leerling_ID`),
  ADD CONSTRAINT `logs_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
