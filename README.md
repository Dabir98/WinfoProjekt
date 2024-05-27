# WinfoProjekt
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Mai 2024 um 15:19
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `mietwagen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrzeugliste`
--

CREATE TABLE `fahrzeugliste` (
  `id` int(11) NOT NULL,
  `fahrzeugname` varchar(50) NOT NULL,
  `kategorie` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `fahrzeugliste`
--

INSERT INTO `fahrzeugliste` (`id`, `fahrzeugname`, `kategorie`) VALUES
(1, 'BMW 3er', 'Full Size Premium'),
(2, 'Audi A4', 'Intermediate Standard'),
(3, 'Mercedes C-Klasse', 'Full Size Premium'),
(4, 'VW Golf', 'Mini Economy'),
(5, 'Opel Astra', 'Intermediate Standard'),
(6, 'BMW 3er', 'Full Size Premium'),
(7, 'Audi A4', 'Intermediate Standard'),
(8, 'Mercedes C-Klasse', 'Full Size Premium'),
(9, 'VW Golf', 'Mini Economy'),
(10, 'Opel Astra', 'Intermediate Standard');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schadensfaelle`
--

CREATE TABLE `schadensfaelle` (
  `id` int(11) NOT NULL,
  `fahrzeug` varchar(50) NOT NULL,
  `beschreibung` text NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `schadensliste`
--

CREATE TABLE `schadensliste` (
  `id` int(11) NOT NULL,
  `fahrzeug` varchar(50) NOT NULL,
  `bereich` varchar(50) NOT NULL,
  `element` varchar(50) NOT NULL,
  `schadenart` varchar(50) NOT NULL,
  `mini_econom` decimal(10,2) NOT NULL,
  `intermediate_standa` decimal(10,2) NOT NULL,
  `full_size_premiun` decimal(10,2) NOT NULL,
  `datum` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fahrzeugliste`
--
ALTER TABLE `fahrzeugliste`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `schadensfaelle`
--
ALTER TABLE `schadensfaelle`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `schadensliste`
--
ALTER TABLE `schadensliste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fahrzeugliste`
--
ALTER TABLE `fahrzeugliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT für Tabelle `schadensfaelle`
--
ALTER TABLE `schadensfaelle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `schadensliste`
--
ALTER TABLE `schadensliste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
