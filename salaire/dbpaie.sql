-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 06 Mai 2020 à 08:45
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `dbpaie`
--

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

CREATE TABLE IF NOT EXISTS `payement` (
  `annee` smallint(6) NOT NULL,
  `mois` smallint(6) NOT NULL,
  `jour` smallint(6) NOT NULL,
  `idsal` varchar(20) NOT NULL,
  `m_percu` int(11) NOT NULL,
  PRIMARY KEY (`annee`,`mois`,`jour`,`idsal`),
  KEY `fk1` (`idsal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `payement`
--

INSERT INTO `payement` (`annee`, `mois`, `jour`, `idsal`, `m_percu`) VALUES
(2020, 1, 15, 'A2', 179000),
(2020, 1, 15, 'A3', 195000),
(2020, 1, 15, 'A4', 215000),
(2020, 1, 15, 'A5', 217000),
(2020, 1, 28, 'A2', 115000),
(2020, 2, 19, 'A2', 345000),
(2020, 2, 26, 'A3', 265000),
(2020, 2, 30, 'A2', 27000),
(2020, 3, 10, 'A1', 215000),
(2020, 3, 25, 'A1', 285000),
(2020, 3, 30, 'A1', 115000);

-- --------------------------------------------------------

--
-- Structure de la table `salaires`
--

CREATE TABLE IF NOT EXISTS `salaires` (
  `matricule` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `t_mensuel` int(11) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `salaires`
--

INSERT INTO `salaires` (`matricule`, `nom`, `prenom`, `t_mensuel`) VALUES
('A1', 'SERGE', 'ARNAUD', 985000),
('A2', 'HAROUN', 'ALI', 378000),
('A3', 'ALLASRA', 'FERMAUT', 423000),
('A4', 'KOULAMEL', 'IRENE', 326000),
('A5', 'DJIMBAYE', 'ELVIS', 775000),
('A6', 'MARIE', 'ANNE', 524000);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `payement`
--
ALTER TABLE `payement`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`idsal`) REFERENCES `salaires` (`matricule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
