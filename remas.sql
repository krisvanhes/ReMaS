-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 09 feb 2021 om 10:55
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `remas`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `apparaten`
--

CREATE TABLE `apparaten` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(30) NOT NULL,
  `Omschrijving` varchar(200) NOT NULL,
  `Vergoeding` float NOT NULL,
  `GewichtGram` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `innameapparaat`
--

CREATE TABLE `innameapparaat` (
  `ID` int(11) NOT NULL,
  `Inname_ID` int(11) NOT NULL,
  `Apparaat_ID` int(11) NOT NULL,
  `Ontleed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `innames`
--

CREATE TABLE `innames` (
  `ID` int(11) NOT NULL,
  `Medewerker_ID` int(11) NOT NULL,
  `Datum` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medewerkers`
--

CREATE TABLE `medewerkers` (
  `ID` int(11) NOT NULL,
  `Rol_ID` int(11) NOT NULL,
  `Naam` varchar(40) NOT NULL,
  `Wachtwoord` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Gegevens worden geëxporteerd voor tabel `medewerkers`
--

INSERT INTO `medewerkers` (`ID`, `Rol_ID`, `Naam`, `Wachtwoord`, `Email`) VALUES
(1, 5, 'Admin', '$2y$10$e0UJWOE5asLDxlXtNHpl8ODbdFtiKP76YvJxS3iETnrC7lOmQizle', 'admin@remas.nl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderdeelapparaat`
--

CREATE TABLE `onderdeelapparaat` (
  `ID` int(11) NOT NULL,
  `Onderdeel_ID` int(11) NOT NULL,
  `Apparaat_ID` int(11) NOT NULL,
  `Percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `onderdelen`
--

CREATE TABLE `onderdelen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(40) NOT NULL,
  `Omschrijving` varchar(100) NOT NULL,
  `PrijsPerKg` float NOT NULL,
  `VoorraadKg` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rollen`
--

CREATE TABLE `rollen` (
  `ID` int(11) NOT NULL,
  `Naam` varchar(30) NOT NULL,
  `Omschrijving` varchar(200) NOT NULL,
  `Waarde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Gegevens worden geëxporteerd voor tabel `rollen`
--

INSERT INTO `rollen` (`ID`, `Naam`, `Omschrijving`, `Waarde`) VALUES
(1, 'Algemene Medewerker', 'Een medewerker met beperkte toegang tot alleen de rapportage', 1),
(2, 'Medewerker Inname', 'Heeft toegang tot Inname en Rapportage', 2),
(3, 'Medewerker Verwerking', 'Heeft toegang tot Verwerking en Rapportage', 3),
(4, 'Medewerker Uitgifte', 'Heeft toegang tot Uitgifte en Rapportage', 4),
(5, 'Applicatiebeheerder', 'Heeft toegang tot Inname, Verwerking, Uitgifte, Rapportage en Onderhoud', 5),
(6, 'Administrator', 'Heeft toegang tot Onderhoud en Gebruiksbeheer', 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uitgiftes`
--

CREATE TABLE `uitgiftes` (
  `ID` int(11) NOT NULL,
  `Medewerker_ID` int(11) NOT NULL,
  `Onderdeel_ID` int(11) NOT NULL,
  `Datum` datetime NOT NULL DEFAULT current_timestamp(),
  `GewichtKg` int(11) NOT NULL,
  `Prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `apparaten`
--
ALTER TABLE `apparaten`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Inname_ID` (`Inname_ID`),
  ADD KEY `Innameapparaat -> apparaat` (`Apparaat_ID`);

--
-- Indexen voor tabel `innames`
--
ALTER TABLE `innames`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Medewerker_ID` (`Medewerker_ID`);

--
-- Indexen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Rol_ID` (`Rol_ID`);

--
-- Indexen voor tabel `onderdeelapparaat`
--
ALTER TABLE `onderdeelapparaat`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Onderdeel_ID` (`Onderdeel_ID`),
  ADD KEY `Apparaat_ID` (`Apparaat_ID`);

--
-- Indexen voor tabel `onderdelen`
--
ALTER TABLE `onderdelen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `rollen`
--
ALTER TABLE `rollen`
  ADD PRIMARY KEY (`ID`);

--
-- Indexen voor tabel `uitgiftes`
--
ALTER TABLE `uitgiftes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Medewerker_ID` (`Medewerker_ID`),
  ADD KEY `Onderdeel_ID` (`Onderdeel_ID`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `apparaten`
--
ALTER TABLE `apparaten`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `innames`
--
ALTER TABLE `innames`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `onderdeelapparaat`
--
ALTER TABLE `onderdeelapparaat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `onderdelen`
--
ALTER TABLE `onderdelen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rollen`
--
ALTER TABLE `rollen`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `uitgiftes`
--
ALTER TABLE `uitgiftes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `innameapparaat`
--
ALTER TABLE `innameapparaat`
  ADD CONSTRAINT `Innameapparaat -> apparaat` FOREIGN KEY (`Apparaat_ID`) REFERENCES `apparaten` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Innameapparaat -> inname` FOREIGN KEY (`Inname_ID`) REFERENCES `innames` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `medewerkers`
--
ALTER TABLE `medewerkers`
  ADD CONSTRAINT `Medewerker -> Rol` FOREIGN KEY (`Rol_ID`) REFERENCES `rollen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `onderdeelapparaat`
--
ALTER TABLE `onderdeelapparaat`
  ADD CONSTRAINT `onderdeelapparaat -> apparaat` FOREIGN KEY (`Apparaat_ID`) REFERENCES `apparaten` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `onderdeelapparaat -> onderdeel` FOREIGN KEY (`Onderdeel_ID`) REFERENCES `onderdelen` (`ID`);

--
-- Beperkingen voor tabel `uitgiftes`
--
ALTER TABLE `uitgiftes`
  ADD CONSTRAINT `uitgiftes -> medewerker` FOREIGN KEY (`Medewerker_ID`) REFERENCES `medewerkers` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `uitgiftes-> onderdelen` FOREIGN KEY (`Onderdeel_ID`) REFERENCES `onderdelen` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
