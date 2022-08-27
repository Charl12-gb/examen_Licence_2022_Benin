-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 août 2022 à 19:54
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tresor`
--

-- --------------------------------------------------------

--
-- Structure de la table `artistes`
--

CREATE TABLE `artistes` (
  `idArtiste` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `telephone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `artistes`
--

INSERT INTO `artistes` (`idArtiste`, `nom`, `prenom`, `telephone`) VALUES
(1, 'TOKOUDAGBA', 'Cyprien', 62980987),
(2, 'PEDE', 'Apollinaire', 98254387);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `idCategorie` int(11) NOT NULL,
  `nomCategorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`idCategorie`, `nomCategorie`) VALUES
(1, 'Trésors Royaux'),
(2, 'Arts contemporains');

-- --------------------------------------------------------

--
-- Structure de la table `oeuvres`
--

CREATE TABLE `oeuvres` (
  `idOeuvre` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `annee` varchar(10) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCategorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `oeuvres`
--

INSERT INTO `oeuvres` (`idOeuvre`, `nom`, `description`, `annee`, `idArtiste`, `idCategorie`) VALUES
(1, 'Tr&ocirc;ne d&#039;apparat du Roi GHEZO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorum cupiditate rerum non amet fugit quas maiores totam tempore provident earum, atque veritatis fugiat nam, alias eaque, laborum voluptatum assumenda molestiae! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut ipsam explicabo at veritatis voluptatem cumque porro fugit praesentium labore? Nisi autem facere, a similique saepe modi ea ipsum inventore sit?', '1234', 1, 2),
(2, 'Ekélodjouoti', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Dolorum cupiditate rerum non amet fugit quas maiores totam tempore provident earum, atque veritatis fugiat nam, alias eaque, laborum voluptatum assumenda molestiae! Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut ipsam explicabo at veritatis voluptatem cumque porro fugit praesentium labore? Nisi autem facere, a similique saepe modi ea ipsum inventore sit?', '2018', 2, 2),
(13, 'UAC', 'DESCRIPTION', '1960', 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `artistes`
--
ALTER TABLE `artistes`
  ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  ADD PRIMARY KEY (`idOeuvre`),
  ADD KEY `idArtiste` (`idArtiste`),
  ADD KEY `idCategorie` (`idCategorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artistes`
--
ALTER TABLE `artistes`
  MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  MODIFY `idOeuvre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `oeuvres`
--
ALTER TABLE `oeuvres`
  ADD CONSTRAINT `oeuvres_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `artistes` (`idArtiste`),
  ADD CONSTRAINT `oeuvres_ibfk_2` FOREIGN KEY (`idCategorie`) REFERENCES `categories` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
