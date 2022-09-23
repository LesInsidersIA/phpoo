-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 juil. 2022 à 15:26
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `oo_entreprise`
--
CREATE DATABASE IF NOT EXISTS `oo_entreprise` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `oo_entreprise`;

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `idEmploye` int(4) NOT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `sexe` enum('m','f') NOT NULL,
  `service` varchar(30) DEFAULT NULL,
  `dateEmbauche` date DEFAULT NULL,
  `salaire` float DEFAULT NULL,
  `idSecteur` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`idEmploye`, `prenom`, `nom`, `sexe`, `service`, `dateEmbauche`, `salaire`, `idSecteur`) VALUES
(7369, 'julien', 'cottet', 'm', 'secretariat', '2007-01-18', 1250, 10),
(7521, 'elodie', 'fellier', 'f', 'secretariat', '2002-02-22', 1250, 10),
(7654, 'damien', 'durand', 'm', 'commercial', '2005-09-28', 1250, 30),
(7698, 'thomas', 'winter', 'm', 'commercial', '1998-05-03', 2550, 20),
(7782, 'laura', 'blanchet', 'f', 'direction', '1998-06-09', 3050, 10),
(7788, 'jean-pierre', 'laborde', 'm', 'direction', '1997-12-09', 5000, 10),
(7839, 'thierry', 'desprez', 'm', 'standardiste', '2009-11-17', 1100, 10),
(7844, 'emilie', 'sennard', 'f', 'commercial', '1999-09-11', 1800, 40),
(7845, 'celino', 'perrin', 'f', 'commercial', '2006-09-10', 1500, 10),
(7846, 'melanie', 'collier', 'f', 'commercial', '2000-09-08', 1900, 30),
(7847, 'chloe', 'dubar', 'f', 'commercial', '2001-09-05', 2100, 30),
(7848, 'guillaume', 'miller', 'm', 'commercial', '2006-07-02', 1700, 20),
(7876, 'nathalie', 'martin', 'f', 'juridique', '2012-01-12', 3200, 10),
(7900, 'benoit', 'lagarde', 'm', 'chef de projet', '1999-01-03', 2050, 10),
(7902, 'mathieu', 'vignal', 'm', 'informatique', '2008-12-03', 1800, 10),
(7934, 'amandine', 'thoyer', 'f', 'charge de communication', '2010-01-23', 1500, 40);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`idEmploye`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `idEmploye` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7947;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
