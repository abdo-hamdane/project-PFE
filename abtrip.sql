-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 21 juin 2026 à 11:26
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
-- Base de données : `abtrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `activity`
--

CREATE TABLE `activity` (
  `id_activite` int(11) NOT NULL,
  `type_activite` varchar(100) NOT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `duree` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `Localisation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activity`
--

INSERT INTO `activity` (`id_activite`, `type_activite`, `prix`, `duree`, `description`, `image`, `Localisation`) VALUES
(10, 'quad', 11.00, '1', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1781126864_IMG-20250907-WA0010.jpg', 'Agafay'),
(11, 'Quad', 22.00, '1', 'Partez à l’aventure en quad et explorez des terrains exceptionnels pour une expérience inoubliable pleine d’émotions.', '1781173611_IMG-20250907-WA0008.jpg', 'Agafay'),
(12, 'Excursion Quad Buggy ', 22.00, '1', 'Vivez une aventure inoubliable en quad ou en buggy à travers le désert et la palmeraie. Sensations fortes, paysages magnifiques et découverte de la culture locale vous attendent.', '1781214523_IMG-20250907-WA0005.jpg', 'Agafay');

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE `administrateur` (
  `id_admin` int(11) NOT NULL,
  `Email` varchar(80) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `Email`, `mot_de_passe`) VALUES
(1, 'abdohamdane490@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `email`, `telephone`) VALUES
(1, 'Abdessamad', 'abdohamdane500@gmail.com', '0767591510'),
(2, 'Abdssamad Hamdan', 'abdohamdane490@gmail.com', '0767591510'),
(4, 'Abdssamad Hamdan', 'mohmadhamdane55@gmail.com', '0767591510'),
(6, 'khalid hamdane', 'khalid@gmail.com', '0767591510'),
(7, 'mohamed ', 'mohamed@gmail.com', '0767591510'),
(8, 'abdo ham', 'hammabb999@gmail.com', '0767591510'),
(9, 'najia hamdane ', 'najiahamdane000@gmail.com', '0767591510'),
(11, 'adil hamdane ', 'adilhamdane000@gmail.com', '0640848915'),
(12, 'Loubna hamdane', 'kinehamdane97@gmail.com', '0638657655');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` int(11) NOT NULL,
  `date_reservation` date DEFAULT NULL,
  `nb_personnes` int(11) NOT NULL,
  `pickup` varchar(80) DEFAULT NULL,
  `transport` varchar(50) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  `id_activite` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'En attente',
  `date_activite` varchar(70) DEFAULT NULL,
  `prix_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `date_reservation`, `nb_personnes`, `pickup`, `transport`, `id_client`, `id_activite`, `id_admin`, `statut`, `date_activite`, `prix_total`) VALUES
(7, '2026-06-14', 4, 'marrakech sidi mimoun', 'Avec transport', 2, 12, 1, 'Confirmée', '2026-06-18', NULL),
(8, '2026-06-14', 4, 'marrakech sidi mimoun', 'Avec transport', 2, 12, 1, 'En attente', '2026-06-18', 0.00),
(9, '2026-06-14', 5, 'marrakech sidi mimoun', 'Avec transport', 2, 11, 1, 'En attente', '2026-06-21', 0.00),
(10, '2026-06-15', 5, 'marrakech sidi mimoun', 'Avec transport', 2, 11, 1, 'En attente', '2026-06-21', 0.00),
(11, '2026-06-15', 5, 'marrakech sidi mimoun', 'Avec transport', 2, 11, 1, 'En attente', '2026-06-21', 110.00),
(12, '2026-06-15', 9, 'marrakech sidi mimoun', 'Avec transport', 2, 10, 1, 'Confirmée', '2026-06-20', 99.00),
(13, '2026-06-17', 4, 'marrakech', 'Avec transport', 6, 12, 1, 'En attente', '2026-06-19', 168.00),
(14, '2026-06-17', 6, 'marrakech', 'Avec transport', 7, 12, 1, 'En attente', '2026-06-19', 252.00),
(15, '2026-06-17', 5, 'marrakech', 'Avec transport', 8, 10, 1, 'En attente', '2026-06-20', 155.00),
(16, '2026-06-17', 2, 'marrakech sidi mimoun', 'Avec transport', 9, 12, 1, 'Confirmée', '2026-06-20', 84.00),
(17, '2026-06-18', 2, 'koutobia', 'Avec transport', 11, 11, 1, 'Confirmée', '2026-06-20', 84.00),
(18, '2026-06-19', 2, 'marrakech sidi mimoun', 'Avec transport', 2, 11, 1, 'En attente', '2026-06-21', 84.00),
(19, '2026-06-20', 1, 'Mhamid', 'Avec transport', 12, 11, 1, 'Confirmée', '2026-06-30', 42.00);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_transport`
--

CREATE TABLE `reservation_transport` (
  `id_reservation_transport` int(11) NOT NULL,
  `id_client` int(11) DEFAULT NULL,
  `Id_transport` int(11) DEFAULT NULL,
  `date_transport` date DEFAULT NULL,
  `nb_personnes` int(11) DEFAULT NULL,
  `pickup` varchar(100) DEFAULT NULL,
  `prix_total` decimal(10,2) DEFAULT NULL,
  `statut` varchar(50) DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reservation_transport`
--

INSERT INTO `reservation_transport` (`id_reservation_transport`, `id_client`, `Id_transport`, `date_transport`, `nb_personnes`, `pickup`, `prix_total`, `statut`) VALUES
(23, 8, 10, '2026-06-28', 3, 'koutobia', 0.00, 'En Attent'),
(24, 8, 10, '2026-06-28', 1, 'koutobia', 400.00, 'En Attent'),
(25, 8, 10, '2026-06-21', 1, 'koutobia', 400.00, 'Confirmée');

-- --------------------------------------------------------

--
-- Structure de la table `transport`
--

CREATE TABLE `transport` (
  `Id_transport` int(11) NOT NULL,
  `type_transport` varchar(100) NOT NULL,
  `capacite` int(11) NOT NULL,
  `prix_transport` decimal(10,2) DEFAULT NULL,
  `disponibilite` tinyint(1) DEFAULT 1,
  `pickup` varchar(50) DEFAULT NULL,
  `Destination` varchar(50) DEFAULT NULL,
  `Image_Voiture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transport`
--

INSERT INTO `transport` (`Id_transport`, `type_transport`, `capacite`, `prix_transport`, `disponibilite`, `pickup`, `Destination`, `Image_Voiture`) VALUES
(10, 'Bus', 40, 400.00, 1, 'marrakech', 'casablanca', '1780508530_trans.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activite`);

--
-- Index pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `id_client` (`id_client`),
  ADD KEY `id_activite` (`id_activite`),
  ADD KEY `fk_admin` (`id_admin`);

--
-- Index pour la table `reservation_transport`
--
ALTER TABLE `reservation_transport`
  ADD PRIMARY KEY (`id_reservation_transport`),
  ADD KEY `fk_reservation_transport_client` (`id_client`),
  ADD KEY `fk_reservation_transport_transport` (`Id_transport`);

--
-- Index pour la table `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`Id_transport`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `administrateur`
--
ALTER TABLE `administrateur`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id_reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `reservation_transport`
--
ALTER TABLE `reservation_transport`
  MODIFY `id_reservation_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `transport`
--
ALTER TABLE `transport`
  MODIFY `Id_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_admin` FOREIGN KEY (`id_admin`) REFERENCES `administrateur` (`id_admin`),
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`id_activite`) REFERENCES `activity` (`id_activite`);

--
-- Contraintes pour la table `reservation_transport`
--
ALTER TABLE `reservation_transport`
  ADD CONSTRAINT `fk_reservation_transport_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_transport_transport` FOREIGN KEY (`Id_transport`) REFERENCES `transport` (`id_transport`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
