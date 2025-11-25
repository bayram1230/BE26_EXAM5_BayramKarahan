-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 25. Nov 2025 um 07:41
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
-- Datenbank: `be26_exam5_bayramkarahan_pethero`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pets`
--

CREATE TABLE `pets` (
  `id` int(11) NOT NULL,
  `breed` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` int(11) NOT NULL,
  `vaccine` varchar(5) NOT NULL,
  `size` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `neutered` varchar(5) NOT NULL,
  `picture` varchar(50) NOT NULL,
  `short_description` varchar(300) NOT NULL,
  `status` enum('Available','Adopted') NOT NULL DEFAULT 'Available',
  `location` varchar(255) NOT NULL DEFAULT 'Unknown'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `pets`
--

INSERT INTO `pets` (`id`, `breed`, `gender`, `age`, `vaccine`, `size`, `name`, `neutered`, `picture`, `short_description`, `status`, `location`) VALUES
(3, 'cat', 'male', 8, 'yes', 'medium', 'Flecky', 'yes', '../img/flecky.cat.jpg', 'Flecky is a playful, nosy cat who always wants to know what everyone is doing and loves squeezing into strange corners to observe humans.', 'Available', 'Mariahilfer Straße 88'),
(4, 'dog', 'male', 8, 'yes', 'large', 'Hunter', 'yes', '../img/hunter.dog.jpg', 'Hunter is an elegant, athletic dog with a calm confidence, independent outside but deeply loyal and soft-hearted with his family.', 'Available', 'Landstraße 17'),
(5, 'cat', 'male', 9, 'yes', 'medium', 'Jonny', 'yes', '../img/jonny.cat.jpg', 'Jonny is a professional napper with a slightly grumpy face, but he’s secretly very affectionate and loves slow, lazy cuddle sessions.', 'Available', 'Kettenbrückengasse 5'),
(6, 'parrot', 'female', 3, 'no', 'large', 'Kenny', 'no', '../img/kenny.parrot.jpg', 'Kenny is a loud, dramatic parrot who demands attention, copies every sound he hears, and acts like the colourful boss of the whole house.', 'Available', 'Schönbrunner Straße 201'),
(7, 'hamster', 'female', 1, 'no', 'small', 'Rolly', 'no', '../img/rolly.hamster.jpg', 'Rolly is an energetic night owl who runs endless laps in his wheel and hoards food in secret stashes like a tiny furry collector.', 'Available', 'Gumpendorfer Straße 91'),
(9, 'dog', 'male', 10, 'yes', 'large', 'Silas', 'no', '../img/silas.dog.jpg', 'Silas is a cheerful, confident corgi with endless energy, a big smile for everyone, and a stubborn streak when he doesn’t get his way.', 'Available', 'Opernring 4'),
(10, 'rabbit', 'male', 8, 'yes', 'medium', 'Brownie', 'no', '../img/brownie.rabbit.png', 'The rabbit displays a peaceful and gentle nature. While nibbling on grass, its large ears and twitching nose remain vigilant — typical for a prey animal that constantly monitors its environment. Rabbits are social, calm, and soft-tempered animals with a strong need for safety.\r\n\r\n', 'Available', 'Taborstraße 31'),
(11, 'rabbit', 'female', 9, 'yes', 'medium', 'Ronny', 'no', '../img/ronny.rabbit.jpg', 'This rabbit appears gentle and curious, peeking through tall grass with bright, alert eyes. Its upright ears show attentiveness, while its soft expression reflects a calm and cautious nature. ', 'Available', 'Alser Straße 40');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `pets`
--
ALTER TABLE `pets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
