-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 13 nov. 2021 à 17:19
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `motif`
--

-- --------------------------------------------------------

--
-- Structure de la table `item_objet`
--

DROP TABLE IF EXISTS `item_objet`;
CREATE TABLE IF NOT EXISTS `item_objet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `A` tinyint(1) NOT NULL,
  `B` tinyint(1) NOT NULL,
  `C` tinyint(1) NOT NULL,
  `D` tinyint(1) NOT NULL,
  `E` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item_objet`
--

INSERT INTO `item_objet` (`id`, `A`, `B`, `C`, `D`, `E`) VALUES
(1, 1, 0, 1, 1, 0),
(2, 0, 1, 1, 0, 1),
(3, 1, 1, 1, 0, 1),
(4, 0, 1, 0, 0, 1),
(5, 1, 1, 1, 0, 1),
(6, 0, 1, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `item_objet2`
--

DROP TABLE IF EXISTS `item_objet2`;
CREATE TABLE IF NOT EXISTS `item_objet2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `A` tinyint(1) NOT NULL,
  `B` tinyint(1) NOT NULL,
  `C` tinyint(1) NOT NULL,
  `D` tinyint(1) NOT NULL,
  `E` tinyint(1) NOT NULL,
  `F` tinyint(1) NOT NULL,
  `G` tinyint(1) NOT NULL,
  `H` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item_objet2`
--

INSERT INTO `item_objet2` (`id`, `A`, `B`, `C`, `D`, `E`, `F`, `G`, `H`) VALUES
(1, 1, 1, 1, 1, 0, 0, 0, 0),
(2, 1, 0, 1, 1, 1, 1, 0, 0),
(3, 1, 0, 1, 1, 0, 1, 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
