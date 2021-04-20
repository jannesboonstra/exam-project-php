-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 05 feb 2021 om 12:18
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pubquiz`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `email`
--

CREATE TABLE `email` (
  `email` varchar(64) NOT NULL,
  `lidnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `email`
--

INSERT INTO `email` (`email`, `lidnummer`) VALUES
('michael@dundermifflin.us', 1),
('jim@dundermifflin.us', 2),
('dwight@dundermifflin.us', 3),
('jake@nypd.us', 4),
('terry@nypd.us', 5),
('amy@nypd.us', 6),
('leslie@parcsandrec.us', 7),
('ron@parcsandrec.us', 8),
('april@parcsandrec.us', 9),
('jonah@cloud9.us', 10),
('dinah@cloud9.us', 11),
('cheyenne@cloud9.us', 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `lid`
--

CREATE TABLE `lid` (
  `lidnummer` int(11) NOT NULL,
  `achternaam` varchar(32) DEFAULT NULL,
  `voornaam` varchar(32) DEFAULT NULL,
  `postcode` varchar(7) DEFAULT NULL,
  `huisnummer` varchar(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `lid`
--

INSERT INTO `lid` (`lidnummer`, `achternaam`, `voornaam`, `postcode`, `huisnummer`) VALUES
(1, 'Scott', 'Michael', '99955AZ', '1'),
(2, 'Halpert', 'Jim', '99955AR', '45'),
(3, 'Schrute', 'Dwight', '99944RT', '12'),
(4, 'Peralta', 'Jake', '98765', '1'),
(5, 'Jeffords', 'Terry', '98765RT', '69'),
(6, 'Santiago', 'Amy', '98765YU', '31'),
(7, 'Knope', 'Leslie', '45678RT', '12'),
(8, 'Swanson', 'Ron', '45678IO', '1'),
(9, 'Ludgate', 'April', '45678FU', '50'),
(10, 'Field', 'Jonah', '74125RT', '85'),
(11, 'Ash', 'Dinah', '74125EF', '56a'),
(12, 'Sakurah', 'Cheyenne', '74125UH', '9');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `postcode`
--

CREATE TABLE `postcode` (
  `postcode` varchar(7) NOT NULL,
  `straat` varchar(64) NOT NULL,
  `woonplaats` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `postcode`
--

INSERT INTO `postcode` (`postcode`, `straat`, `woonplaats`) VALUES
('45678FU', 'For real street', 'Pawnee'),
('45678IO', 'Frown street', 'Pawnee'),
('45678RT', 'Park street', 'Pawnee'),
('74125EF', 'Isle', 'Store'),
('74125RT', 'Union street', 'Store'),
('74125UH', 'Make up street', 'Store'),
('98765', 'Blockstreet', 'New York'),
('98765RT', 'Push street', 'New York'),
('98765YU', 'Clean street', 'New York'),
('99555AX', 'Sales street', 'Scranton'),
('99555AZ', 'boss street', 'Scranton'),
('99944RT', 'Beetsfarm', 'Scranton'),
('99955AR', 'Sales street', 'Scranton'),
('99955AZ', 'Boss street', 'Scranton');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teamlid`
--

CREATE TABLE `teamlid` (
  `teamlid_id` int(11) NOT NULL,
  `teamnaam` varchar(32) DEFAULT NULL,
  `lidnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `teamlid`
--

INSERT INTO `teamlid` (`teamlid_id`, `teamnaam`, `lidnummer`) VALUES
(1, 'Dunder Mifflin', 1),
(2, 'Dunder Mifflin', 2),
(3, 'Dunder Mifflin', 3),
(4, 'The 99', 4),
(5, 'The 99', 5),
(6, 'The 99', 6),
(7, 'Parks and recreation', 7),
(8, 'Parks and recreation', 8),
(9, 'Parks and recreation', 9),
(10, 'Cloud 9', 10),
(11, 'Cloud 9', 11),
(12, 'Cloud 9', 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teams`
--

CREATE TABLE `teams` (
  `teamnaam` varchar(32) NOT NULL,
  `omschrijving` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `teams`
--

INSERT INTO `teams` (`teamnaam`, `omschrijving`) VALUES
('Cloud 9', 'As diverse as they can be, together they are a tough team to beat'),
('Dunder Mifflin', 'Guided by the best boss in the world, this team makes a good chance to be a winner'),
('Parks and recreation', 'Organizing is the great strength of this team and it helps answering difficult questions'),
('The 99', 'Solving crime like no other, The 99 will solve the pubquiz like never before');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `telefoonnummers`
--

CREATE TABLE `telefoonnummers` (
  `telefoonnummer` varchar(11) NOT NULL,
  `lidnummer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `telefoonnummers`
--

INSERT INTO `telefoonnummers` (`telefoonnummer`, `lidnummer`) VALUES
('050-5551234', 1),
('050-5554567', 2),
('050-5557894', 3),
('050-0501234', 4),
('050-0501239', 5),
('050-0509876', 6),
('050-7771234', 7),
('050-7779876', 8),
('050-7778523', 9),
('050-1231234', 10),
('050-1234567', 11),
('05012346547', 12);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`forename`, `surname`, `username`, `password`) VALUES
('Jan', 'Park', 'Docent', '$2y$10$HstF1hdWFlsvlrKG7Al4IOq86i9wcqC6gl4a9Sz6DGW5UP528zz/C');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`email`),
  ADD KEY `lidnummer` (`lidnummer`);

--
-- Indexen voor tabel `lid`
--
ALTER TABLE `lid`
  ADD PRIMARY KEY (`lidnummer`),
  ADD KEY `achternaam` (`achternaam`),
  ADD KEY `voornaam` (`voornaam`),
  ADD KEY `postcode` (`postcode`);

--
-- Indexen voor tabel `postcode`
--
ALTER TABLE `postcode`
  ADD PRIMARY KEY (`postcode`),
  ADD KEY `woonplaats` (`woonplaats`);

--
-- Indexen voor tabel `teamlid`
--
ALTER TABLE `teamlid`
  ADD PRIMARY KEY (`teamlid_id`),
  ADD KEY `teamnaam` (`teamnaam`),
  ADD KEY `lidnummer` (`lidnummer`);

--
-- Indexen voor tabel `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`teamnaam`);

--
-- Indexen voor tabel `telefoonnummers`
--
ALTER TABLE `telefoonnummers`
  ADD PRIMARY KEY (`telefoonnummer`),
  ADD KEY `lidnummer` (`lidnummer`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `lid`
--
ALTER TABLE `lid`
  MODIFY `lidnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `teamlid`
--
ALTER TABLE `teamlid`
  MODIFY `teamlid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
