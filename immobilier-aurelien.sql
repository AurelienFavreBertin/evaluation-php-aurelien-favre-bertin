-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 26 juin 2019 à 14:06
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `immobilier-aurelien`
--
CREATE DATABASE IF NOT EXISTS `immobilier-aurelien` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `immobilier-aurelien`;

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(3) UNSIGNED NOT NULL,
  `titre` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ville` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `cp` int(5) UNSIGNED ZEROFILL NOT NULL,
  `surface` int(5) UNSIGNED NOT NULL,
  `prix` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(1, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 120, 500000, 'mySql7039.png', 'location', 'test 1'),
(2, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 78, 78, 'sf.pn2719.png', 'location', 'test int'),
(3, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 78, 78, 'sf.pn1815.png', 'location', 'test int'),
(4, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 75, 75, 'mySql596.png', 'vente', 'try'),
(5, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 85, 85, 'sf.pn8336.png', 'vente', 'test numeric'),
(6, 'test format', '3 rue du la République', 'Lyon', 69003, 78, 7888, 'sf.pn4690.png', 'location', 'try'),
(7, '78', '3 rue du la République', 'Lyon', 69003, 78, 78, 'sf.pn467.png', 'location', '78'),
(8, '78', '3 rue du la République', 'Lyon', 69003, 78, 78, 'sf.pn4448.png', 'location', '78'),
(9, '78', '3 rue du la République', 'Lyon', 69003, 78, 78, 'sf.pn198.png', 'location', '78'),
(10, 'Bel appartement', '3 rue du la République', 'Lyon', 69003, 45, 4555, 'mySql5209.png', 'location', 'id test'),
(11, 'sans photo', '3 rue du la République', 'Lyon', 69003, 25, 25555, 'default.jpg', 'location', ''),
(12, 'sans photo', '3 rue du la République', 'Lyon', 69003, 25, 25555, 'default.jpg', 'location', ''),
(13, 'test d\'une description trop longue', '3 rue du la République', 'Lyon', 69003, 78, 7888, 'default.jpg', 'vente', 'Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long Texte beaucoup trop long ');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
