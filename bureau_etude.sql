-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 02 nov. 2024 à 12:59
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bureau_etude`
--

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

CREATE TABLE `composant` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cout` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `composant`
--

INSERT INTO `composant` (`id`, `libelle`, `description`, `cout`) VALUES
(1, 'Carte mère', 'Carte mère avec chipset avancé.', 150.00),
(2, 'Batterie', 'Batterie lithium-ion de 3000 mAh.', 30.00),
(3, 'Écran OLED', 'Écran OLED de 6,5 pouces.', 80.00),
(4, 'Processeur', 'Processeur Intel i7.', 250.00),
(5, 'Boîtier', 'Boîtier en aluminium.', 50.00),
(6, 'Haut-parleur', 'Haut-parleur stéréo.', 20.00),
(7, 'Capteur de santé', 'Capteur de fréquence cardiaque.', 15.00),
(11, 'ram', 'volatile', 13.00);

-- --------------------------------------------------------

--
-- Structure de la table `nomenclature`
--

CREATE TABLE `nomenclature` (
  `id_produit` int(11) NOT NULL,
  `id_composant` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `nomenclature`
--

INSERT INTO `nomenclature` (`id_produit`, `id_composant`, `nombre`) VALUES
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(2, 11, 17),
(3, 1, 1),
(3, 4, 1),
(3, 5, 1),
(4, 6, 2),
(4, 7, 1),
(5, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `libelle`, `description`) VALUES
(2, 'Tablette ', 'Tablette légère avec une grande autonomie.'),
(3, 'Ordinateur portable Z3d', 'Ordinateur portable avec processeur i7.'),
(4, 'Montre connectée A4', 'Montre connectée avec suivi de santé.'),
(5, 'Écouteurs sans fil B5', 'Écouteurs Bluetooth avec réduction de bruit.'),
(8, 'Smartphone X1', 'Smartphone haut de gamme avec écran OLED.');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `composant`
--
ALTER TABLE `composant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nomenclature`
--
ALTER TABLE `nomenclature`
  ADD PRIMARY KEY (`id_produit`,`id_composant`),
  ADD KEY `id_composant` (`id_composant`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `composant`
--
ALTER TABLE `composant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `nomenclature`
--
ALTER TABLE `nomenclature`
  ADD CONSTRAINT `nomenclature_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nomenclature_ibfk_2` FOREIGN KEY (`id_composant`) REFERENCES `composant` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
