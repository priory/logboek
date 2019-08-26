-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 26 aug 2019 om 11:06
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
-- Tabelstructuur voor tabel `groepen`
--

CREATE TABLE `groepen` (
  `Groep` int(11) NOT NULL,
  `Level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leerlingen`
--

CREATE TABLE `leerlingen` (
  `leerling_ID` int(11) NOT NULL,
  `voornaam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tussenvoegsel` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `achternaam` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Cohort` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Groep_id` int(11) NOT NULL,
  `Level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `logs`
--

CREATE TABLE `logs` (
  `logs_ID` int(11) NOT NULL,
  `bericht` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL,
  `voor_leerling` int(11) DEFAULT NULL,
  `voor_groep` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `groepen`
--
ALTER TABLE `groepen`
  ADD PRIMARY KEY (`Groep`);

--
-- Indexen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD PRIMARY KEY (`leerling_ID`),
  ADD KEY `Groep_id` (`Groep_id`);

--
-- Indexen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logs_ID`),
  ADD KEY `voor_groep` (`voor_groep`),
  ADD KEY `voor_leerling` (`voor_leerling`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `groepen`
--
ALTER TABLE `groepen`
  MODIFY `Groep` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  MODIFY `leerling_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `logs`
--
ALTER TABLE `logs`
  MODIFY `logs_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `leerlingen`
--
ALTER TABLE `leerlingen`
  ADD CONSTRAINT `leerlingen_ibfk_1` FOREIGN KEY (`Groep_id`) REFERENCES `groepen` (`Groep`);

--
-- Beperkingen voor tabel `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`voor_groep`) REFERENCES `groepen` (`Groep`),
  ADD CONSTRAINT `logs_ibfk_2` FOREIGN KEY (`voor_leerling`) REFERENCES `leerlingen` (`leerling_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
