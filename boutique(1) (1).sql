-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 06 mars 2018 à 14:14
-- Version du serveur :  10.1.26-MariaDB
-- Version de PHP :  7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `montant` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL,
  `etat` enum('en cours de traitement','envoyé','livré') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `montant`, `date_enregistrement`, `etat`) VALUES
(1, 6, 80, '2018-03-05 11:59:00', 'envoyé'),
(3, 6, 1455, '2018-03-05 12:10:29', 'en cours de traitement'),
(4, 6, 1455, '2018-03-05 12:11:22', 'en cours de traitement'),
(5, 6, 1455, '2018-03-05 12:11:24', 'en cours de traitement'),
(6, 6, 2346, '2018-03-05 12:23:26', 'en cours de traitement'),
(7, 6, 225, '2018-03-05 12:30:46', 'en cours de traitement'),
(8, 6, 1070, '2018-03-05 12:34:40', 'en cours de traitement'),
(9, 6, 40, '2018-03-05 13:03:17', 'en cours de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `details_commande`
--

CREATE TABLE `details_commande` (
  `id_details_commande` int(3) NOT NULL,
  `id_commande` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `quantite` int(3) NOT NULL,
  `prix` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `details_commande`
--

INSERT INTO `details_commande` (`id_details_commande`, `id_commande`, `id_produit`, `quantite`, `prix`) VALUES
(1, 4, 13, 4, 20),
(2, 4, 10, 3, 450),
(3, 4, 8, 5, 5),
(4, 5, 13, 4, 20),
(5, 5, 10, 3, 450),
(6, 5, 8, 5, 5),
(7, 6, 10, 5, 450),
(8, 6, 12, 3, 12),
(9, 6, 13, 3, 20),
(10, 7, 11, 5, 45),
(11, 8, 13, 1, 20),
(12, 8, 12, 5, 12),
(13, 8, 10, 2, 450),
(14, 8, 11, 2, 45),
(15, 9, 13, 2, 20);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(150) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` enum('m','f') NOT NULL,
  `ville` varchar(20) NOT NULL,
  `code_postal` int(5) UNSIGNED ZEROFILL NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `ville`, `code_postal`, `adresse`, `status`) VALUES
(6, 'daddouche', '$2y$10$fv6u/ZlDOCXfOyJ.cH4GEOHMsG0HOID3Lqu7veggQWwOdQ9SsRMFy', 'CHEMLA', 'Jonathan', 'jonathanchemla55@gmail.com', 'f', 'PANTIN', 93500, '1 6 rue jules Auffret', 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(3) NOT NULL,
  `reference` varchar(20) NOT NULL,
  `categorie` varchar(20) DEFAULT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `description` text,
  `couleur` varchar(20) DEFAULT NULL,
  `taille` varchar(5) DEFAULT NULL,
  `public` enum('m','f','mixte') NOT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `prix` int(3) NOT NULL,
  `stock` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `reference`, `categorie`, `titre`, `description`, `couleur`, `taille`, `public`, `photo`, `prix`, `stock`) VALUES
(3, '4578', 'sdfdsaaa', 'roule ma poule', 'fsdfgsdfgvsdfg', '', 'L', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/4578-pic-3.jpg', 14254, 78),
(4, '78', 'dgfhdfg', 'dfgd', 'fgdffg', '', 'S', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/78-pic-3.jpg', 54, 668),
(8, '54645fgdg', 'dfgdf', 'fgdf', 'dfgd', 'fdgdf', 'S', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/54645fgdg-pic-2.jpg', 5, 56),
(9, 'th45r4ty', 'ghfhe', 'fghfghe', 'gregorye', 'bleue', 'M', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/th45r4ty-pic-1.jpg', 450, 450),
(10, '12-az-45', 'eee', 'eee', 'eee', '', 'S', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/12-az-45-pic-2.jpg', 450, 448),
(11, '12-az-46', 'probleme', 'probleme', 'dsf', 'dd', 'M', 'mixte', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/12-az-46-pic-3.jpg', 45, 8),
(12, '12-az-47', 'roule ma poule', 'roule ma poule', 'roule ma poule', '', 'L', 'mixte', '', 12, 56),
(13, '12-az-49', 'ETE', 'chemise longue', 'ma description', 'bleu', 'L', 'm', 'http://localhost/formateur/ma-formation/PHP/boutique/photo/12-az-49-chemise_bleue.jpg', 20, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`);

--
-- Index pour la table `details_commande`
--
ALTER TABLE `details_commande`
  ADD PRIMARY KEY (`id_details_commande`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`),
  ADD UNIQUE KEY `reference` (`reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `details_commande`
--
ALTER TABLE `details_commande`
  MODIFY `id_details_commande` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
