-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 24, 2024 at 08:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pixelwar`
--

-- --------------------------------------------------------

--
-- Table structure for table `grille`
--

CREATE TABLE `grille` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grille`
--

INSERT INTO `grille` (`id`, `nom`, `user_id`) VALUES
(15, 'grille_1', 5),
(18, 'grille_2', 12),
(19, 'grille_3', 15),
(27, 'grille_4', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pixel`
--

CREATE TABLE `pixel` (
  `id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `couleur` varchar(8) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grille_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `mdp` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mail`, `mdp`) VALUES
(5, 'hicham', 'hicham@esirem.fr', 'd29164185bd87e31419d0ccbc4d1727bd813ef9d5d6ae7cd738ce5b8b7de2f35'),
(8, 'evan', 'evan@esirem.fr', 'ae74f72d212fb9871302a2459aeaf7b20bc2f792e4852be648a7d4e63967d9b1'),
(11, 'coline', 'coline@esirem.fr', '938477de64d86ed380f8437f88c0e1f9c4045626a0896cbb070f479eae229ad9'),
(12, 'maxine', 'maxine@esirem.fr', '5487d9e0d16f14a978c829697818b14aacc911ed4ee81bcc32b4c5a0bebcd578'),
(14, 'olivier', 'olivier@esirem.fr', '152fc4dddcedc0be83ea10cd2667d9e4218b00439c65cb352f4a048e409203b2'),
(15, 'charles', 'charles@esirem.fr', '10fe82adb964fa73c3c60be251181c421193f56ae01ba671974d82365a08a410');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grille`
--
ALTER TABLE `grille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pixel`
--
ALTER TABLE `pixel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `grille_id` (`grille_id`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grille`
--
ALTER TABLE `grille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pixel`
--
ALTER TABLE `pixel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grille`
--
ALTER TABLE `grille`
  ADD CONSTRAINT `grille_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pixel`
--
ALTER TABLE `pixel`
  ADD CONSTRAINT `pixel_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pixel_ibfk_2` FOREIGN KEY (`grille_id`) REFERENCES `grille` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
