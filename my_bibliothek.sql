-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Dez 2024 um 12:48
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
-- Datenbank: `my_bibliothek`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `name` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL DEFAULT uuid(),
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `github_url` varchar(255) DEFAULT NULL,
  `category_uuid` varchar(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `project_tech`
--

CREATE TABLE `project_tech` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL,
  `project_uuid` varchar(36) NOT NULL,
  `tech_uuid` varchar(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tech`
--

CREATE TABLE `tech` (
  `id` int(11) NOT NULL,
  `uuid` char(36) NOT NULL DEFAULT uuid(),
  `name` varchar(50) NOT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD UNIQUE KEY `url` (`url`);

--
-- Indizes für die Tabelle `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`),
  ADD KEY `fk_cat_uuid` (`category_uuid`);

--
-- Indizes für die Tabelle `project_tech`
--
ALTER TABLE `project_tech`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_project_uuid` (`project_uuid`),
  ADD KEY `fk_tech_uuid` (`tech_uuid`);

--
-- Indizes für die Tabelle `tech`
--
ALTER TABLE `tech`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT für Tabelle `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT für Tabelle `project_tech`
--
ALTER TABLE `project_tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `tech`
--
ALTER TABLE `tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `fk_cat_uuid` FOREIGN KEY (`category_uuid`) REFERENCES `categories` (`uuid`);

--
-- Constraints der Tabelle `project_tech`
--
ALTER TABLE `project_tech`
  ADD CONSTRAINT `fk_project_uuid` FOREIGN KEY (`project_uuid`) REFERENCES `projects` (`uuid`),
  ADD CONSTRAINT `fk_tech_uuid` FOREIGN KEY (`tech_uuid`) REFERENCES `tech` (`uuid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
