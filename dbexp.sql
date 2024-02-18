-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 23 Octobre 2020 à 12:26
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dbexp`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `codeprod` varchar(50) NOT NULL,
  `datexp` date NOT NULL,
  `nbre` int(11) NOT NULL,
  PRIMARY KEY (`codeprod`,`datexp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`codeprod`, `datexp`, `nbre`) VALUES
('carton_sardine', '2020-08-10', 6),
('carton_sardine', '2021-11-15', 100),
('carton_sardine', '2022-10-16', 276),
('corn_beef', '2019-12-09', 35),
('corn_beef', '2023-11-30', 690),
('lait_conserve_bm', '2023-06-21', 568),
('lait_poudre_bm', '2021-05-19', 432),
('lait_poudre_bm', '2022-12-29', 286),
('nescafe_pb', '2020-09-23', 29),
('nescafe_pb', '2022-07-17', 120);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
