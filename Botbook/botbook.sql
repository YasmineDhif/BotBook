-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 jan. 2024 à 16:03
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `botbook`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password1` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `lastname`, `firstname`, `username`, `email`, `password1`, `question`, `answer`) VALUES
(1, 'laith turner', 'Ulysses', 'jelohaca', 'memakeci@mailinator.com', '0b95cbaf801a0423ff262cab60f561', '68053af2923e00204c3ca7c6a3150cf7', '68053af2923e00204c3ca7c6a3150c'),
(2, 'kyle wood', 'Aiko', 'kysog', 'ys@mailinator.com', '3d195980d01d29f467be8fa82a29be', '68053af2923e00204c3ca7c6a3150cf7', '68053af2923e00204c3ca7c6a3150c'),
(3, 'rama baird', 'April', 'jagys', 'adb@mailinator.com', '1c188087b46024d7dc01c77c1a92bf', '3fdf7ff211eec1dde75bbdba2e8b5bde', '3fdf7ff211eec1dde75bbdba2e8b5b'),
(4, 'zeus baker', 'zaezaz', 'jul', 'jul@mailinator.com', 'ecd8223f16af92b4cb73ab0390fa76', 'f05c8652de134d5c50729fa1b31d355b', 'f05c8652de134d5c50729fa1b31d35'),
(5, 'zeus baker', 'zaezaz', 'jul', 'jul@mailinator.com', 'ecd8223f16af92b4cb73ab0390fa76', 'f05c8652de134d5c50729fa1b31d355b', 'f05c8652de134d5c50729fa1b31d35'),
(6, 'sheila parsons', 'Jessamine', 'var', 'var@mailinator.com', 'b2145aac704ce76dbe1ac7adac535b', 'Quel est votre couleur préféré?', 'Accusamus rem aut mi'),
(7, 'wing lancaster', 'Tamara', 'dum', 'dum@mailinator.com', 'f36178feffc1db4b9b724cecc7aff5', 'Quel est le meilleur voyage que vous avez fait?', 'Nemo officia ut dolo'),
(8, 'dana gibbs', 'Lisandra', 'halivo', 'ropus@mailinator.com', 'ab4f63f9ac65152575886860dde480', 'Quel est le meilleur voyage que vous avez fait?', 'Quod voluptatem Dol'),
(9, 'maryam sims', 'Tamekah', 'azerty', 'azer@mailinator.com', '68053af2923e00204c3ca7c6a3150cf7', 'Quel est votre film préféré?', 'Quia maiores officii'),
(10, 'craft', 'Stacy', 'lara', 'lara@mailinator.com', '250cf8b51c773f3f8dc8b4be867a9a02', 'Quel est le meilleur voyage que vous avez fait?', 'Aut quis officiis au'),
(11, 'dotson', 'Quyn', 'yasmine', 'ydhif@mailinator.com', '68053af2923e00204c3ca7c6a3150cf7', 'Quel est votre film préféré?', 'tree of life'),
(12, 'sloan', 'Candice', 'aude', 'aude@mailinator.com', '5c83b920b7451a5d9206f40f58e289b8', 'Quel est votre film préféré?', 'lotr');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
