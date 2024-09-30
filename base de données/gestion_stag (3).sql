-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 13 mars 2024 à 15:58
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_stag`
--

-- --------------------------------------------------------

--
-- Structure de la table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `idDepartment` int NOT NULL AUTO_INCREMENT,
  `nomDepartment` varchar(50) DEFAULT NULL,
  `Responsable` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`idDepartment`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `department`
--

INSERT INTO `department` (`idDepartment`, `nomDepartment`, `Responsable`) VALUES
(35, 'research', 'MIHED'),
(33, 'Marketing', 'MONGI BOUSAID'),
(21, 'Research and developpment', 'Sonia Chaaben'),
(29, 'RH', 'Kawther Wasslati'),
(32, 'Informatique', 'SIHEM MRAD');

-- --------------------------------------------------------

--
-- Structure de la table `employer`
--

DROP TABLE IF EXISTS `employer`;
CREATE TABLE IF NOT EXISTS `employer` (
  `IdEmp` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `dateN` date NOT NULL,
  `cne` int NOT NULL,
  `mobile` int NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `dateEmbauche` date NOT NULL,
  `photo` varchar(100) NOT NULL,
  `idDepartment` int NOT NULL,
  PRIMARY KEY (`IdEmp`),
  KEY `idDepartment` (`idDepartment`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `employer`
--

INSERT INTO `employer` (`IdEmp`, `fullname`, `gender`, `dateN`, `cne`, `mobile`, `adresse`, `dateEmbauche`, `photo`, `idDepartment`) VALUES
(23, 'Amal Romdhane', 'F', '1997-09-27', 14523611, 56995215, 'Bizerte Ras jbal Metline', '2024-02-14', 'img4.jpg', 6),
(1, 'Mohamed Ali Mhamdi', 'M', '1996-06-12', 14523600, 52147896, 'tunis', '2023-02-10', '', 6),
(16, 'Mihed Aloui', 'F', '1997-06-22', 14785236, 58693214, 'Bizerte Centre', '2024-02-05', 'img1.jpg', 6),
(28, 'huih', 'F', '2024-03-27', 14523698, 5879632, '58742', '2024-03-13', 'img5.jpg', 35),
(29, 'siwar moujahed', 'F', '2024-03-01', 1123654, 52896315, 'Bizerte Ras jbal Metline', '2024-03-30', 'img6.jpg', 35),
(27, 'rahma', 'F', '2024-03-16', 12345678, 1458723, 'bizert', '2024-03-07', 'img6.jpg', 33),
(30, 'Sima mhamdi', 'F', '2024-03-22', 51654848, 56994213, 'Bizerte ', '2024-03-30', 'img5.jpg', 32);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(42, 1, 1, 'coco'),
(63, 50, 1, 'cv'),
(62, 50, 1, 'bonsoir'),
(43, 1, 1, 'hhhhhhh'),
(44, 1, 48, 'huhiujninjhguyguh'),
(45, 1, 48, 'yes'),
(46, 48, 48, 'b'),
(47, 50, 1, 'coco'),
(48, 50, 1, 'hkrkbhpokn'),
(49, 50, 1, 'bonjour'),
(50, 49, 1, 'bonjour,c\'est Amal'),
(61, 1, 50, 'bonsoir Admin!'),
(60, 49, 50, 'Bonsoir Mihed!'),
(59, 48, 50, 'bonsoir mohamed'),
(58, 1, 50, 'coco'),
(57, 50, 1, 'mamia'),
(56, 0, 1, 'msr'),
(55, 0, 1, 'voila Amal'),
(54, 0, 48, 'bonsoir'),
(53, 0, 48, 'coco'),
(52, 0, 1, 'rrr'),
(51, 48, 1, 'a'),
(64, 50, 1, 'est ce que tu\'est bien'),
(65, 50, 1, 'je peut poser une question'),
(66, 50, 1, 'conserne '),
(67, 49, 1, 'hhhhhh'),
(68, 50, 1, 'what\'s up!'),
(69, 1, 48, 'bonsoir Admin!'),
(70, 48, 1, 'Bonsoir Mohamed!'),
(71, 48, 1, 'Comme tu le sais!'),
(72, 50, 1, 'coco!'),
(73, 49, 1, 'oui'),
(74, 49, 1, 'coco'),
(75, 1, 55, 'ffff');

-- --------------------------------------------------------

--
-- Structure de la table `salaire`
--

DROP TABLE IF EXISTS `salaire`;
CREATE TABLE IF NOT EXISTS `salaire` (
  `IdEmp` int NOT NULL,
  `idDepartment` int NOT NULL,
  `montant` int NOT NULL,
  KEY `idDepartment` (`idDepartment`),
  KEY `IdEmp` (`IdEmp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `salaire`
--

INSERT INTO `salaire` (`IdEmp`, `idDepartment`, `montant`) VALUES
(1, 6, 0),
(4, 4, 1750),
(5, 3, 1800),
(8, 3, 3000),
(0, 0, 2300),
(0, 0, 2300),
(16, 6, 3100),
(18, 29, 2400),
(17, 21, 2700),
(16, 6, 3100),
(19, 21, 2600),
(23, 6, 2300),
(1, 6, 2300),
(26, 33, 1200),
(28, 35, 4500),
(27, 33, 3200),
(30, 32, 1800);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `login` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  `etat` int DEFAULT NULL,
  `pwd` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` enum('online','offline') DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`iduser`, `login`, `email`, `role`, `etat`, `pwd`, `img`, `status`) VALUES
(1, 'admin', 'amalrom@gmail.com', 'ADMIN', 1, '202cb962ac59075b964b07152d234b70', '../images/img1', 'online'),
(57, 'Sima mhamdi', 'sima@gmail.com', 'VISITEUR', 1, 'e10adc3949ba59abbe56e057f20f883e', '../images/img6.jpg', NULL),
(56, 'rahma', 'rahma@gmail.com', 'VISITEUR', 1, 'e10adc3949ba59abbe56e057f20f883e', '../images/img5.jpg', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
