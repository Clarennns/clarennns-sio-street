-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 31 mars 2026 à 23:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `restaurant_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `choix_du_plat_dans_le_menu`
--

CREATE TABLE `choix_du_plat_dans_le_menu` (
  `IDMenu` int(11) NOT NULL,
  `IDPlat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `choix_du_plat_dans_le_menu`
--

INSERT INTO `choix_du_plat_dans_le_menu` (`IDMenu`, `IDPlat`) VALUES
(1, 1),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `Id` int(11) NOT NULL,
  `MoyenDePaiement` varchar(50) DEFAULT NULL,
  `CarteDeFidélité` varchar(50) DEFAULT NULL,
  `TotalPayé` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`Id`, `MoyenDePaiement`, `CarteDeFidélité`, `TotalPayé`) VALUES
(1, 'Carte bancaire', 'Non', 150),
(2, 'Paypal', 'Non', 200.5),
(3, 'Especes', 'Oui', 75.2),
(4, 'Carte bancaire', 'Oui', 95),
(5, 'Cheque', 'Non', 50),
(6, 'Carte bancaire', 'Non', 150),
(7, 'Paypal', 'Non', 200.5),
(8, 'Especes', 'Oui', 75.2),
(9, 'Carte bancaire', 'Oui7', 95),
(10, 'Cheque', 'Non', 50),
(11, 'Carte bancaire', 'Non', 150),
(12, 'Paypal', 'Non', 200.5),
(13, 'Especes', 'Oui', 75.2),
(14, 'Carte bancaire', 'Oui', 95),
(15, 'Cheque', 'Non', 50),
(16, 'Carte bancaire', 'Non', 150),
(17, 'Paypal', 'Non', 200.5),
(18, 'Especes', 'Oui', 75.2),
(19, 'Carte bancaire', 'Oui', 95),
(20, 'Cheque', 'Non', 50),
(21, 'Carte bancaire', 'Non', 150),
(22, 'Paypal', 'Non', 200.5),
(23, 'Especes', 'Oui', 75.2),
(24, 'Carte bancaire', 'Oui', 95),
(25, 'Cheque', 'Non', 50),
(26, 'Carte bancaire', 'Non', 150),
(27, 'Paypal', 'Non', 200.5),
(28, 'Especes', 'Oui', 75.2),
(29, 'Carte bancaire', 'Oui', 95),
(30, 'Cheque', 'Non', 50),
(31, 'Carte bancaire', 'Non', 150),
(32, 'Paypal', 'Non', 200.5),
(33, 'Especes', 'Oui', 75.2),
(34, 'Carte bancaire', 'Oui', 95),
(35, 'Cheque', 'Non', 50),
(36, 'Carte bancaire', 'Non', 150),
(37, 'Paypal', 'Non', 200.5),
(38, 'Especes', 'Oui', 75.2),
(39, 'Carte bancaire', 'Oui', 95),
(40, 'Cheque', 'Non', 50),
(41, 'Carte bancaire', 'Non', 150),
(42, 'Paypal', 'Non', 200.5),
(43, 'Especes', 'Oui', 75.2),
(44, 'Carte bancaire', 'Oui', 95),
(45, 'Cheque', 'Non', 50),
(46, 'Carte bancaire', 'Non', 150),
(47, 'Paypal', 'Non', 200.5),
(48, 'Especes', 'Oui', 75.2),
(49, 'Carte bancaire', 'Oui7', 95),
(50, 'Cheque', 'Non', 50),
(51, 'Carte bancaire', 'Non', 150),
(52, 'Paypal', 'Non', 200.5),
(53, 'Especes', 'Oui', 75.2),
(54, 'Carte bancaire', 'Oui', 95),
(55, 'Cheque', 'Non', 50),
(56, 'Carte bancaire', 'Non', 150),
(57, 'Paypal', 'Non', 200.5),
(58, 'Especes', 'Oui', 75.2),
(59, 'Carte bancaire', 'Oui', 95),
(60, 'Cheque', 'Non', 50),
(61, 'Carte bancaire', 'Non', 150),
(62, 'Paypal', 'Non', 200.5),
(63, 'Especes', 'Oui', 75.2),
(64, 'Carte bancaire', 'Oui', 95),
(65, 'Cheque', 'Non', 50),
(66, 'Carte bancaire', 'Non', 150),
(67, 'Paypal', 'Non', 200.5),
(68, 'Especes', 'Oui', 75.2),
(69, 'Carte bancaire', 'Oui', 95),
(70, 'Cheque', 'Non', 50),
(71, 'Carte bancaire', 'Non', 150),
(72, 'Paypal', 'Non', 200.5),
(73, 'Especes', 'Oui', 75.2),
(74, 'Carte bancaire', 'Oui', 95),
(75, 'Cheque', 'Non', 50),
(76, 'Carte bancaire', 'Non', 150),
(77, 'Paypal', 'Non', 200.5),
(78, 'Especes', 'Oui', 75.2),
(79, 'Carte bancaire', 'Oui', 95),
(80, 'Cheque', 'Non', 50),
(81, 'Paypal', 'Non', 200.5),
(82, 'Especes', 'Non', 75.2),
(83, 'Carte bancaire', 'Non', 95),
(84, 'Cheque', 'Non', 50);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `NumCommande` int(11) NOT NULL,
  `NomVendeur` varchar(50) DEFAULT NULL,
  `TotalHT` float DEFAULT NULL,
  `EtatCommande` varchar(50) DEFAULT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`NumCommande`, `NomVendeur`, `TotalHT`, `EtatCommande`, `Id`) VALUES
(1, 'Godin', 12.5, 'Bon état', 1),
(2, 'Lemoine', 10, 'Très bon état', 2),
(3, 'Boulanger', 10, 'Très bon état', 3),
(4, 'Guérin', 11.5, 'Mauvaise état', 4),
(5, 'Carlier', 11.5, 'Bon état', 5),
(6, 'Ménard', 11, 'Très bon état', 6),
(7, 'Pichon', 11, 'Très bon état', 7),
(8, 'Vidal', 11, 'Mauvaise état', 8),
(9, 'Godin', 12, 'Bon état', 9),
(10, 'Lemoine', 11.5, 'Très bon état', 10),
(11, 'Boulanger', 12, 'Très bon état', 11),
(12, 'Guérin', 10.5, 'Mauvaise état', 12),
(13, 'Carlier', 12, 'Bon état', 13),
(14, 'Ménard', 12, 'Très bon état', 14),
(15, 'Pichon', 12, 'Très bon état', 15),
(16, 'Vidal', 12, 'Mauvaise état', 16),
(17, 'Godin', 11.5, 'Bon état', 17),
(18, 'Lemoine', 11.5, 'Très bon état', 18),
(19, 'Boulanger', 13.5, 'Très bon état', 19),
(20, 'Guérin', 11.5, 'Mauvaise état', 20),
(21, 'Godin', 12.5, 'Bon état', 21),
(22, 'Lemoine', 10, 'Très bon état', 22),
(23, 'Boulanger', 10, 'Très bon état', 23),
(24, 'Guérin', 11.5, 'Mauvaise état', 24),
(25, 'Carlier', 11.5, 'Bon état', 25),
(26, 'Ménard', 11, 'Très bon état', 26),
(27, 'Pichon', 11, 'Très bon état', 27),
(28, 'Vidal', 11, 'Mauvaise état', 28),
(29, 'Godin', 12, 'Bon état', 29),
(30, 'Lemoine', 11.5, 'Très bon état', 30),
(31, 'Boulanger', 12, 'Très bon état', 31),
(32, 'Guérin', 10.5, 'Mauvaise état', 32),
(33, 'Carlier', 12, 'Bon état', 33),
(34, 'Ménard', 12, 'Très bon état', 34),
(35, 'Pichon', 12, 'Très bon état', 35),
(36, 'Vidal', 12, 'Mauvaise état', 36),
(37, 'Godin', 11.5, 'Bon état', 37),
(38, 'Lemoine', 11.5, 'Très bon état', 38),
(39, 'Boulanger', 13.5, 'Très bon état', 39),
(40, 'Guérin', 11.5, 'Mauvaise état', 40),
(41, 'Godin', 12.5, 'Bon état', 41),
(42, 'Lemoine', 10, 'Très bon état', 42),
(43, 'Boulanger', 10, 'Très bon état', 43),
(44, 'Guérin', 11.5, 'Mauvaise état', 44),
(45, 'Carlier', 11.5, 'Bon état', 45),
(46, 'Ménard', 11, 'Très bon état', 46),
(47, 'Pichon', 11, 'Très bon état', 47),
(48, 'Vidal', 11, 'Mauvaise état', 48),
(49, 'Godin', 12, 'Bon état', 49),
(50, 'Lemoine', 11.5, 'Très bon état', 50),
(51, 'Boulanger', 12, 'Très bon état', 51),
(52, 'Guérin', 10.5, 'Mauvaise état', 52),
(53, 'Carlier', 12, 'Bon état', 53),
(54, 'Ménard', 12, 'Très bon état', 54),
(55, 'Pichon', 12, 'Très bon état', 55),
(56, 'Vidal', 12, 'Mauvaise état', 56),
(57, 'Godin', 11.5, 'Bon état', 57),
(58, 'Lemoine', 11.5, 'Très bon état', 58),
(59, 'Boulanger', 13.5, 'Très bon état', 59),
(60, 'Guérin', 11.5, 'Mauvaise état', 60),
(61, 'Godin', 12.5, 'Bon état', 61),
(62, 'Lemoine', 10, 'Très bon état', 62),
(63, 'Boulanger', 10, 'Très bon état', 63),
(64, 'Guérin', 11.5, 'Mauvaise état', 64),
(65, 'Carlier', 11.5, 'Bon état', 65),
(66, 'Ménard', 11, 'Très bon état', 66),
(67, 'Pichon', 11, 'Très bon état', 67),
(68, 'Vidal', 11, 'Mauvaise état', 68),
(69, 'Godin', 12, 'Bon état', 69),
(70, 'Lemoine', 11.5, 'Très bon état', 70),
(71, 'Boulanger', 12, 'Très bon état', 71),
(72, 'Guérin', 10.5, 'Mauvaise état', 72),
(73, 'Carlier', 12, 'Bon état', 73),
(74, 'Ménard', 12, 'Très bon état', 74),
(75, 'Pichon', 12, 'Très bon état', 75),
(76, 'Vidal', 12, 'Mauvaise état', 76),
(77, 'Godin', 11.5, 'Bon état', 77),
(78, 'Lemoine', 11.5, 'Très bon état', 78),
(79, 'Boulanger', 13.5, 'Très bon état', 79),
(80, 'Guérin', 11.5, 'Mauvaise état', 80),
(81, 'Godin', 12.5, 'Bon état', 81),
(82, 'Lemoine', 10, 'Très bon état', 82),
(83, 'Boulanger', 10, 'Très bon état', 83),
(84, 'Guérin', 11.5, 'Mauvaise état', 84);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `plat_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'en attente',
  `date_commande` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `client_id`, `plat_id`, `status`, `date_commande`) VALUES
(1, 1, 1, 'en préparation', '2026-03-31 23:06:08'),
(3, 3, 3, 'prêt à livrer', '2026-03-31 23:06:08'),
(4, 4, 4, 'en attente', '2026-03-31 23:06:08'),
(5, 5, 5, 'en préparation', '2026-03-31 23:06:08'),
(6, 6, 6, 'prêt à livrer', '2026-03-31 23:06:08'),
(7, 7, 7, 'prêt à livrer', '2026-03-31 23:06:08'),
(8, 8, 8, 'en attente', '2026-03-31 23:06:08'),
(9, 9, 9, 'en préparation', '2026-03-31 23:06:08'),
(10, 10, 10, 'prêt à livrer', '2026-03-31 23:06:08'),
(11, 11, 11, 'prêt à livrer', '2026-03-31 23:06:08'),
(12, 12, 12, 'en attente', '2026-03-31 23:06:08'),
(13, 13, 13, 'en préparation', '2026-03-31 23:06:08'),
(14, 14, 14, 'prêt à livrer', '2026-03-31 23:06:08'),
(15, 15, 15, 'prêt à livrer', '2026-03-31 23:06:08'),
(16, 16, 16, 'en attente', '2026-03-31 23:06:08'),
(17, 17, 17, 'en préparation', '2026-03-31 23:06:08'),
(18, 18, 18, 'prêt à livrer', '2026-03-31 23:06:08'),
(19, 19, 19, 'prêt à livrer', '2026-03-31 23:06:08'),
(20, 20, 20, 'en attente', '2026-03-31 23:06:08'),
(21, 21, 1, 'en préparation', '2026-03-31 23:06:08'),
(23, 23, 3, 'prêt à livrer', '2026-03-31 23:06:08'),
(24, 24, 4, 'en attente', '2026-03-31 23:06:08'),
(25, 25, 5, 'en préparation', '2026-03-31 23:06:08'),
(26, 26, 6, 'prêt à livrer', '2026-03-31 23:06:08'),
(27, 27, 7, 'prêt à livrer', '2026-03-31 23:06:08'),
(28, 28, 8, 'en attente', '2026-03-31 23:06:08'),
(29, 29, 9, 'en préparation', '2026-03-31 23:06:08'),
(30, 30, 10, 'prêt à livrer', '2026-03-31 23:06:08'),
(31, 31, 11, 'prêt à livrer', '2026-03-31 23:06:08'),
(32, 32, 12, 'en attente', '2026-03-31 23:06:08'),
(33, 33, 13, 'en préparation', '2026-03-31 23:06:08'),
(34, 34, 14, 'prêt à livrer', '2026-03-31 23:06:08'),
(35, 35, 15, 'prêt à livrer', '2026-03-31 23:06:08'),
(36, 36, 16, 'en attente', '2026-03-31 23:06:08'),
(37, 37, 17, 'en préparation', '2026-03-31 23:06:08'),
(38, 38, 18, 'prêt à livrer', '2026-03-31 23:06:08'),
(39, 39, 19, 'prêt à livrer', '2026-03-31 23:06:08'),
(40, 40, 20, 'en attente', '2026-03-31 23:06:08'),
(41, 41, 1, 'en préparation', '2026-03-31 23:06:08'),
(43, 43, 3, 'prêt à livrer', '2026-03-31 23:06:08'),
(44, 44, 4, 'en attente', '2026-03-31 23:06:08'),
(45, 45, 5, 'en préparation', '2026-03-31 23:06:08'),
(46, 46, 6, 'prêt à livrer', '2026-03-31 23:06:08'),
(47, 47, 7, 'prêt à livrer', '2026-03-31 23:06:08'),
(48, 48, 8, 'en attente', '2026-03-31 23:06:08'),
(49, 49, 9, 'en préparation', '2026-03-31 23:06:08'),
(50, 50, 10, 'prêt à livrer', '2026-03-31 23:06:08'),
(51, 51, 11, 'prêt à livrer', '2026-03-31 23:06:08'),
(52, 52, 12, 'en attente', '2026-03-31 23:06:08'),
(53, 53, 13, 'en préparation', '2026-03-31 23:06:08'),
(54, 54, 14, 'prêt à livrer', '2026-03-31 23:06:08'),
(55, 55, 15, 'prêt à livrer', '2026-03-31 23:06:08'),
(56, 56, 16, 'en attente', '2026-03-31 23:06:08'),
(57, 57, 17, 'en préparation', '2026-03-31 23:06:08'),
(58, 58, 18, 'prêt à livrer', '2026-03-31 23:06:08'),
(59, 59, 19, 'prêt à livrer', '2026-03-31 23:06:08'),
(60, 60, 20, 'en attente', '2026-03-31 23:06:08'),
(61, 61, 1, 'en préparation', '2026-03-31 23:06:08'),
(63, 63, 3, 'prêt à livrer', '2026-03-31 23:06:08'),
(64, 64, 4, 'en attente', '2026-03-31 23:06:08'),
(65, 65, 5, 'en préparation', '2026-03-31 23:06:08'),
(66, 66, 6, 'prêt à livrer', '2026-03-31 23:06:08'),
(67, 67, 7, 'prêt à livrer', '2026-03-31 23:06:08'),
(68, 68, 8, 'en attente', '2026-03-31 23:06:08'),
(69, 69, 9, 'en préparation', '2026-03-31 23:06:08'),
(70, 70, 10, 'prêt à livrer', '2026-03-31 23:06:08'),
(71, 71, 11, 'prêt à livrer', '2026-03-31 23:06:08'),
(72, 72, 12, 'en attente', '2026-03-31 23:06:08'),
(73, 73, 13, 'en préparation', '2026-03-31 23:06:08'),
(74, 74, 14, 'prêt à livrer', '2026-03-31 23:06:08'),
(75, 75, 15, 'prêt à livrer', '2026-03-31 23:06:08'),
(76, 76, 16, 'en attente', '2026-03-31 23:06:08'),
(77, 77, 17, 'en préparation', '2026-03-31 23:06:08'),
(78, 78, 18, 'prêt à livrer', '2026-03-31 23:06:08'),
(79, 79, 19, 'prêt à livrer', '2026-03-31 23:06:08'),
(80, 80, 20, 'en attente', '2026-03-31 23:06:08'),
(81, 81, 1, 'en préparation', '2026-03-31 23:06:08'),
(83, 83, 3, 'prêt à livrer', '2026-03-31 23:06:08'),
(84, 84, 4, 'en attente', '2026-03-31 23:06:08');

-- --------------------------------------------------------

--
-- Structure de la table `commande_du_menu`
--

CREATE TABLE `commande_du_menu` (
  `NumCommande` int(11) NOT NULL,
  `IDMenu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_du_menu`
--

INSERT INTO `commande_du_menu` (`NumCommande`, `IDMenu`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(21, 1),
(22, 2),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 8),
(29, 9),
(30, 10),
(31, 11),
(32, 12),
(33, 13),
(34, 14),
(35, 15),
(36, 16),
(37, 17),
(38, 18),
(39, 19),
(41, 1),
(42, 2),
(43, 3),
(44, 4),
(45, 5),
(46, 6),
(47, 7),
(48, 8),
(49, 9),
(50, 10),
(51, 11),
(52, 12),
(53, 13),
(54, 14),
(55, 15),
(56, 16),
(57, 17),
(58, 18),
(59, 19),
(61, 1),
(62, 2),
(63, 3),
(64, 4),
(65, 5),
(66, 6),
(67, 7),
(68, 8),
(69, 9),
(70, 10),
(71, 11),
(72, 12),
(73, 13),
(74, 14),
(75, 15),
(76, 16),
(77, 17),
(78, 18),
(79, 19),
(81, 1),
(82, 2),
(83, 3),
(84, 4);

-- --------------------------------------------------------

--
-- Structure de la table `commande_du_plat`
--

CREATE TABLE `commande_du_plat` (
  `NumCommande` int(11) NOT NULL,
  `IDPlat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commande_du_plat`
--

INSERT INTO `commande_du_plat` (`NumCommande`, `IDPlat`) VALUES
(1, 1),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20),
(21, 1),
(23, 3),
(24, 4),
(25, 5),
(26, 6),
(27, 7),
(28, 8),
(29, 9),
(30, 10),
(31, 11),
(32, 12),
(33, 13),
(34, 14),
(35, 15),
(36, 16),
(37, 17),
(38, 18),
(39, 19),
(40, 20),
(41, 1),
(43, 3),
(44, 4),
(45, 5),
(46, 6),
(47, 7),
(48, 8),
(49, 9),
(50, 10),
(51, 11),
(52, 12),
(53, 13),
(54, 14),
(55, 15),
(56, 16),
(57, 17),
(58, 18),
(59, 19),
(60, 20),
(61, 1),
(63, 3),
(64, 4),
(65, 5),
(66, 6),
(67, 7),
(68, 8),
(69, 9),
(70, 10),
(71, 11),
(72, 12),
(73, 13),
(74, 14),
(75, 15),
(76, 16),
(77, 17),
(78, 18),
(79, 19),
(80, 20),
(81, 1),
(83, 3),
(84, 4);

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE `contacts` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Numero` varchar(20) DEFAULT NULL,
  `Message` text NOT NULL,
  `Created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contacts`
--

INSERT INTO `contacts` (`Id`, `Nom`, `Email`, `Numero`, `Message`, `Created_at`) VALUES
(1, 'Siosupport', 'siosupport@gmail.com', '07 14 15 92 94', 'Support client pour aider avec les commandes et résoudre les problèmes.', '2026-03-31 23:06:07');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `IDMenu` int(11) NOT NULL,
  `NomMenu` varchar(50) NOT NULL,
  `PrixMenu` float DEFAULT NULL,
  `ImageMenu` varchar(255) DEFAULT NULL,
  `IDRestaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`IDMenu`, `NomMenu`, `PrixMenu`, `ImageMenu`, `IDRestaurant`) VALUES
(0, 'Naan Italien', 11.5, NULL, 1),
(1, 'Naan Dynamite', 12.5, 'images/Naan_Dynamite.png', 1),
(2, 'Naan Tenders', 10, '/site_restaurant_mvc_v2_correct/images/Naan_Tenders.png', 1),
(3, 'Naan Steak', 10, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png', 1),
(4, 'Naan Tenders Steak', 11.5, 'images/Naan_Dynamite.png', 1),
(5, 'Naan Imperial', 11.5, '/site_restaurant_mvc_v2_correct/images/Naan_Imperial.png', 1),
(6, 'Naan Thaï', 11, '/site_restaurant_mvc_v2_correct/images/Naan_Thai.png', 1),
(7, 'Naan Curry', 11, '/site_restaurant_mvc_v2_correct/images/Naan_Curry.png', 1),
(8, 'Naan Farmer', 11, '/site_restaurant_mvc_v2_correct/images/Naan_Farmer.png', 1),
(9, 'Naan Radikal', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Radikal.png', 1),
(10, 'Naan Mix', 11.5, '/site_restaurant_mvc_v2_correct/images/Naan_Mix.png', 1),
(11, 'Naan Suprem', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Suprem.png', 1),
(12, 'Naan Tikka', 10.5, '/site_restaurant_mvc_v2_correct/images/Naan_Tikka.png', 1),
(13, 'Naan South Chicago', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png', 1),
(14, 'Naan East Harlem', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png', 1),
(15, 'Naan North Detroit', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png', 1),
(16, 'Naan West Atlanta', 12, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png', 1),
(17, 'Naan Mexicain', 11, '/site_restaurant_mvc_v2_correct/images/Naan_Mexicain.png', 1),
(18, 'Naan Allemand', 11.5, '/site_restaurant_mvc_v2_correct/images/Naan_Allemand.png', 1),
(19, 'Naan Ivoirien', 13.5, '/site_restaurant_mvc_v2_correct/images/Naan_Ivoirien.png', 1);

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE `personne` (
  `Id` int(11) NOT NULL,
  `Nom` varchar(50) DEFAULT NULL,
  `Prenom` varchar(50) DEFAULT NULL,
  `DateDeNaissance` date DEFAULT NULL,
  `Adresse` varchar(50) DEFAULT NULL,
  `Ville` varchar(50) DEFAULT NULL,
  `CodePostal` int(11) DEFAULT NULL,
  `NuméroTéléphone` varchar(20) DEFAULT NULL,
  `Adressemail` varchar(50) DEFAULT NULL,
  `Role` varchar(20) DEFAULT 'client',
  `motdepasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personne`
--

INSERT INTO `personne` (`Id`, `Nom`, `Prenom`, `DateDeNaissance`, `Adresse`, `Ville`, `CodePostal`, `NuméroTéléphone`, `Adressemail`, `Role`, `motdepasse`) VALUES
(1, 'Boucif', 'Lina', '2005-07-07', '14 Rue JoliePichon', 'Aubervilliers', 93300, '07 18 36 47 42', 'bouciflina@gmail.com', 'client', 'G4d$eJ#8dL'),
(2, 'Durand', 'Pierre', '1998-02-15', '5 Avenue Victor Hugo', 'Paris', 75016, '06 22 14 85 69', 'pierredurand@gmail.com', 'client', 'LpM4kR$eJ8'),
(3, 'Morel', 'Sophie', '2000-11-30', '22 Boulevard Haussmann', 'Paris', 75009, '07 45 23 98 41', 'sophie.morel@yahoo.fr', 'client', 'R$eK4NlM9p'),
(4, 'Bernard', 'Lucas', '1995-05-22', '8 Rue du Château', 'Neuilly-sur-Seine', 92200, '06 79 54 32 18', 'lucasbernard@hotmail.com', 'client', 'J8dLpM4$eK'),
(5, 'Leroy', 'Emma', '2003-09-10', '12 Rue de la République', 'Boulogne-Billancourt', 92100, '07 12 89 74 55', 'emma.leroy@gmail.com', 'client', 'M4$eJ8dLp'),
(6, 'Rousseau', 'Thomas', '1992-06-25', '3 Rue de Paris', 'Saint-Denis', 93200, '06 99 41 63 85', 'thomas.rousseau@outlook.fr', 'client', 'pM4$eK8dL'),
(7, 'Fournier', 'Laura', '1989-12-05', '7 Rue des Champs', 'Versailles', 78000, '07 33 20 10 98', 'laura.fournier@yahoo.com', 'client', 'K8dLpM$eJ4'),
(8, 'Dumont', 'Nicolas', '2001-04-18', '25 Rue des Rosiers', 'Montreuil', 93100, '06 58 42 75 36', 'nicolas.dumont@gmail.com', 'client', 'eJ8dL4pM$'),
(9, 'Garcia', 'Julie', '1997-08-09', '18 Rue du Général Leclerc', 'Antony', 92160, '07 77 84 69 21', 'julie.garcia@free.fr', 'client', 'L4$eK8dMp'),
(10, 'Robin', 'Maxime', '1990-03-12', '10 Rue de l\'Église', 'Clamart', 92140, '06 36 90 47 85', 'maxime.robin@laposte.net', 'client', 'dLpM$eJ8K4'),
(11, 'Martinez', 'Camille', '1999-07-14', '20 Rue de la Liberté', 'Courbevoie', 92400, '07 82 69 31 47', 'camille.martinez@gmail.com', 'client', '8dLpM4$eK'),
(12, 'Lemoine', 'Alexandre', '1996-02-03', '15 Rue Pasteur', 'Levallois-Perret', 92300, '06 58 74 95 32', 'alexandre.lemoine@hotmail.com', 'client', 'M$eJ8dL4p'),
(13, 'Gonzalez', 'Sabrina', '2004-10-25', '30 Rue de la Paix', 'Saint-Ouen', 93400, '07 49 58 67 21', 'sabrina.gonzalez@outlook.fr', 'client', 'J8dL4pM$e'),
(14, 'Richard', 'Yanis', '2000-05-18', '5 Rue des Lilas', 'Clichy', 92110, '06 74 85 21 36', 'yanis.richard@yahoo.fr', 'client', 'K$eJ8dLpM'),
(15, 'Blanc', 'Nora', '1993-09-07', '12 Rue de l\'Avenir', 'Vitry-sur-Seine', 94400, '07 25 36 47 85', 'nora.blanc@gmail.com', 'client', 'pM$eK8dL4'),
(16, 'David', 'Sofiane', '1998-12-11', '9 Boulevard des Fleurs', 'Ivry-sur-Seine', 94200, '06 98 47 52 39', 'sofiane.david@free.fr', 'client', 'L$eK8dMp4'),
(17, 'Guillaume', 'Elisa', '2002-03-20', '23 Rue du Port', 'Pantin', 93500, '07 85 46 32 78', 'elisa.guillaume@gmail.com', 'client', 'M4$eJ8dLp'),
(18, 'Charpentier', 'Rayan', '2001-08-29', '17 Rue de la Gare', 'Colombes', 92700, '06 74 52 85 96', 'rayan.charpentier@hotmail.fr', 'client', '8dK$eJ4pM'),
(19, 'Perrot', 'Inès', '1997-01-10', '3 Rue du Marché', 'Argenteuil', 95100, '07 96 58 21 45', 'ines.perrot@orange.fr', 'client', 'eK8dLpM4$'),
(20, 'Masson', 'Hakim', '1994-11-05', '11 Avenue de la République', 'Asnières-sur-Seine', 92600, '06 52 41 78 36', 'hakim.masson@gmail.com', 'client', 'J4pM$eK8d'),
(21, 'Barbier', 'Mélanie', '2003-06-15', '26 Rue Voltaire', 'Paris', 75011, '07 36 45 25 89', 'melanie.barbier@yahoo.com', 'client', 'L4$eK8dMp'),
(22, 'Lopez', 'Adam', '1995-09-30', '10 Rue du Faubourg Saint-Antoine', 'Paris', 75012, '06 85 47 23 69', 'adam.lopez@hotmail.fr', 'client', 'K8dM$eJ4p'),
(23, 'Gillet', 'Chloé', '2000-04-08', '8 Rue Lafayette', 'Paris', 75009, '07 25 89 74 36', 'chloe.gillet@free.fr', 'client', 'pM4$eK8dL'),
(24, 'Pires', 'Nassim', '1992-10-22', '33 Rue de Belleville', 'Paris', 75020, '06 98 74 32 58', 'nassim.pires@gmail.com', 'client', 'M$eJ8dL4p'),
(25, 'Raymond', 'Amina', '1999-12-18', '14 Rue du Chemin Vert', 'Paris', 75011, '07 52 96 31 47', 'amina.raymond@hotmail.com', 'client', '8dLpM$eJ4'),
(26, 'Lemoine', 'Tarek', '1996-07-07', '5 Rue Ordener', 'Paris', 75018, '06 74 58 23 96', 'tarek.lemoine@gmail.com', 'client', 'eJ8dL4pM$'),
(27, 'Besson', 'Sarah', '2005-05-29', '9 Rue Vavin', 'Paris', 75006, '07 36 25 41 85', 'sarah.besson@yahoo.com', 'client', 'L$eK8dMp4'),
(28, 'Chevalier', 'Bilel', '1993-02-14', '18 Rue Saint-Honoré', 'Paris', 75001, '06 74 98 52 41', 'bilel.chevalier@gmail.com', 'client', 'K$eJ8dLpM'),
(29, 'Duhamel', 'Leïla', '1997-08-12', '3 Rue de Montreuil', 'Paris', 75011, '07 25 69 85 36', 'leila.duhamel@free.fr', 'client', 'M4$eJ8dLp'),
(30, 'Faure', 'Youssef', '2001-09-03', '15 Rue de Rennes', 'Paris', 75006, '06 98 47 52 63', 'youssef.faure@gmail.com', 'client', 'J8dL4pM$e'),
(31, 'Dubois', 'Mehdi', '1998-04-05', '7 Rue de Paris', 'Bobigny', 93000, '07 45 63 85 21', 'mehdi.dubois@gmail.com', 'client', 'pM$eK8dL4'),
(32, 'Lefevre', 'Céline', '1996-11-14', '18 Rue du Temple', 'Paris', 75004, '06 98 74 36 25', 'celine.lefevre@outlook.fr', 'client', 'eK8dLpM4$'),
(33, 'Collet', 'Jérôme', '2000-01-22', '9 Boulevard Saint-Michel', 'Paris', 75005, '07 52 63 98 41', 'jerome.collet@hotmail.com', 'client', 'L4$eK8dMp'),
(34, 'Germain', 'Mounir', '1993-07-30', '10 Rue de la Convention', 'Paris', 75015, '06 74 85 23 69', 'mounir.germain@gmail.com', 'client', 'M$eJ8dL4p'),
(35, 'Renaud', 'Fatima', '1997-05-09', '4 Rue Nationale', 'Aubervilliers', 93300, '07 36 52 41 96', 'fatima.renaud@yahoo.fr', 'client', '8dLpM$eJ4'),
(36, 'Delacroix', 'Olivier', '1995-09-27', '2 Rue de la Chapelle', 'Saint-Denis', 93200, '06 98 74 52 36', 'olivier.delacroix@gmail.com', 'client', 'K$eJ8dLpM'),
(37, 'Brun', 'Salma', '2002-06-11', '15 Rue Paul Bert', 'Issy-les-Moulineaux', 92130, '07 25 96 41 85', 'salma.brun@free.fr', 'client', 'pM$eK8dL4'),
(38, 'Noël', 'Bilal', '1994-12-08', '8 Rue du Mont-Cenis', 'Paris', 75018, '06 74 98 52 36', 'bilal.noel@gmail.com', 'client', 'eJ$dLpM4K8'),
(39, 'Moreau', 'Aicha', '2001-02-23', '22 Rue Jules Ferry', 'Pantin', 93500, '07 85 36 25 41', 'aicha.moreau@laposte.net', 'client', 'L$eK8dMp4'),
(40, 'Baron', 'Karim', '1999-08-17', '3 Rue Anatole France', 'Ivry-sur-Seine', 94200, '06 98 74 52 36', 'karim.baron@gmail.com', 'client', 'M$eJ8dL4p'),
(41, 'Dufresne', 'Yacine', '1998-05-13', '12 Rue Victor Hugo', 'Courbevoie', 92400, '07 85 69 41 23', 'yacine.dufresne@gmail.com', 'client', '8dK$eJ4pM'),
(42, 'Marchand', 'Sabrina', '1996-03-08', '5 Rue du Bac', 'Levallois-Perret', 92300, '06 98 74 25 36', 'sabrina.marchand@hotmail.com', 'client', 'J4pM$eK8d'),
(43, 'Picard', 'Hugo', '2000-07-19', '17 Avenue Charles de Gaulle', 'Nanterre', 92000, '07 52 36 98 41', 'hugo.picard@gmail.com', 'client', 'K$eJ8dLpM'),
(44, 'Leclerc', 'Nadia', '1995-10-21', '8 Boulevard Voltaire', 'Paris', 75011, '06 74 52 98 36', 'nadia.leclerc@yahoo.fr', 'client', 'pM$eK8dL4'),
(45, 'Renard', 'Imane', '2003-12-29', '10 Rue de la Fontaine', 'Saint-Ouen', 93400, '07 25 96 41 85', 'imane.renard@gmail.com', 'client', 'eK8dLpM4$'),
(46, 'Gros', 'Jamal', '1994-06-14', '22 Rue de la République', 'Vitry-sur-Seine', 94400, '06 98 74 52 63', 'jamal.gros@free.fr', 'client', 'L$eK8dMp4'),
(47, 'Poulain', 'Myriam', '1997-08-03', '5 Rue des Martyrs', 'Paris', 75009, '07 36 25 85 41', 'myriam.poulain@outlook.fr', 'client', 'M$eJ8dL4p'),
(48, 'Laporte', 'Ilyes', '2002-02-16', '14 Rue du Chemin Vert', 'Paris', 75011, '06 74 98 52 63', 'ilyes.laporte@gmail.com', 'client', '8dLpM$eJ4'),
(49, 'Regnier', 'Sofiane', '1999-09-05', '18 Rue de Montreuil', 'Paris', 75011, '07 25 96 41 85', 'sofiane.regnier@yahoo.fr', 'client', 'K$eJ8dLpM'),
(50, 'Vasseur', 'Lina', '1998-11-09', '5 Rue de Rennes', 'Paris', 75006, '06 98 74 52 63', 'lina.vasseur@gmail.com', 'client', 'pM$eK8dL4'),
(51, 'Prevost', 'Aymen', '1997-02-12', '9 Rue de Paris', 'Bobigny', 93000, '07 85 63 21 98', 'aymen.prevost@gmail.com', 'client', 'eJ$dLpM4K8'),
(52, 'Charrier', 'Lea', '1999-06-23', '15 Rue du Faubourg', 'Montreuil', 93100, '06 98 74 25 36', 'lea.charrier@hotmail.fr', 'client', 'L4$eK8dMp'),
(53, 'Descamps', 'Mourad', '1998-08-05', '3 Boulevard Haussmann', 'Paris', 75009, '07 52 63 98 41', 'mourad.descamps@gmail.com', 'client', 'M$eJ8dL4p'),
(54, 'Benard', 'Sarah', '2000-09-17', '10 Avenue de la République', 'Paris', 75011, '06 74 85 23 69', 'sarah.benard@yahoo.fr', 'client', 'J4pM$eK8d'),
(55, 'Mallet', 'Ismail', '1995-12-30', '14 Rue Nationale', 'Saint-Denis', 93200, '07 36 52 41 96', 'ismail.mallet@gmail.com', 'client', 'K$eJ8dLpM'),
(56, 'Boutin', 'Nora', '2003-11-22', '7 Rue du Temple', 'Paris', 75004, '06 98 74 52 36', 'nora.boutin@outlook.fr', 'client', 'pM$eK8dL4'),
(57, 'Maurice', 'Yanis', '1996-05-09', '5 Rue de la Fontaine', 'Aubervilliers', 93300, '07 25 96 41 85', 'yanis.maurice@free.fr', 'client', 'eK8dLpM4$'),
(58, 'Paul', 'Inès', '2002-03-14', '22 Rue du Port', 'Pantin', 93500, '06 74 98 52 36', 'ines.paul@gmail.com', 'client', 'L$eK8dMp4'),
(59, 'Adam', 'Tarek', '1994-07-19', '18 Rue Anatole France', 'Ivry-sur-Seine', 94200, '07 85 36 25 41', 'tarek.adam@yahoo.fr', 'client', 'M$eJ8dL4p'),
(60, 'Gosselin', 'Hind', '1999-01-01', '12 Rue des Rosiers', 'Paris', 75004, '06 98 74 25 36', 'hind.gosselin@gmail.com', 'client', '8dLpM$eJ4'),
(61, 'Lamy', 'Bilal', '2001-10-31', '17 Rue Lafayette', 'Paris', 75009, '07 52 63 98 41', 'bilal.lamy@outlook.fr', 'client', 'K$eJ8dLpM'),
(62, 'Denis', 'Kenza', '1997-09-15', '8 Rue du Mont-Cenis', 'Paris', 75018, '06 74 52 98 36', 'kenza.denis@gmail.com', 'client', 'pM$eK8dL4'),
(63, 'Couturier', 'Sofiane', '1995-04-27', '10 Rue de Belleville', 'Paris', 75020, '07 25 96 41 85', 'sofiane.couturier@yahoo.fr', 'client', 'eJ$dLpM4K8'),
(64, 'Maillot', 'Nabil', '2000-02-18', '14 Rue de la Gare', 'Colombes', 92700, '06 74 98 52 63', 'nabil.maillot@free.fr', 'client', 'L4$eK8dMp'),
(65, 'Jourdan', 'Lina', '1998-06-12', '5 Rue de Rennes', 'Paris', 75006, '07 36 25 85 41', 'lina.jourdan@gmail.com', 'client', 'M$eJ8dL4p'),
(66, 'Lejeune', 'Samir', '1996-08-29', '12 Rue de l Avenir', 'Vitry-sur-Seine', 94400, '06 98 74 52 36', 'samir.lejeune@gmail.com', 'client', 'J8dL4pM$e'),
(67, 'Duhamel', 'Amina', '2003-12-05', '7 Rue du Château', 'Neuilly-sur-Seine', 92200, '07 85 36 25 41', 'amina.duhamel@outlook.fr', 'client', 'K$eJ8dLpM'),
(68, 'Parent', 'Younes', '1994-05-17', '10 Rue de la Convention', 'Paris', 75015, '06 74 52 98 36', 'younes.parent@gmail.com', 'client', 'pM$eK8dL4'),
(69, 'Lombard', 'Fatima', '1999-09-08', '18 Rue du Chemin Vert', 'Paris', 75011, '07 25 96 70 44', 'fatima.lombard@yahoo.fr', 'client', 'eK8dLpM4$'),
(70, 'Leclercq', 'Hichem', '2001-07-22', '3 Rue Ordener', 'Paris', 75018, '06 98 74 25 36', 'hichem.leclercq@free.fr', 'client', 'L$eK8dMp4'),
(71, 'Besson', 'Youssef', '1997-02-14', '5 Rue de la République', 'Boulogne-Billancourt', 92100, '07 52 63 98 41', 'youssef.besson@yahoo.fr', 'client', 'M$eJ8dL4p'),
(72, 'Verdier', 'Imane', '2000-06-21', '15 Rue du Marché', 'Argenteuil', 95100, '06 74 85 23 69', 'imane.verdier@gmail.com', 'client', '8dLpM$eJ4'),
(73, 'Devaux', 'Karim', '1995-10-30', '12 Boulevard des Fleurs', 'Ivry-sur-Seine', 94200, '07 36 52 41 96', 'karim.devaux@free.fr', 'client', 'K$eJ8dLpM'),
(74, 'Hoarau', 'Leila', '1999-12-18', '7 Avenue Charles de Gaulle', 'Nanterre', 92000, '06 98 74 52 36', 'leila.hoarau@gmail.com', 'client', 'pM$eK8dL4'),
(75, 'Carpentier', 'Rayan', '1998-04-25', '8 Rue Jules Ferry', 'Pantin', 93500, '07 25 96 41 85', 'rayan.carpentier@yahoo.fr', 'client', 'eJ$dLpM4K8'),
(76, 'Boulanger', 'Sara', '2002-09-13', '5 Rue de la Liberté', 'Courbevoie', 92400, '06 74 98 52 36', 'sara.boulanger@outlook.fr', 'client', 'L4$eK8dMp'),
(77, 'Albert', 'Nassim', '1994-11-09', '17 Rue Pasteur', 'Levallois-Perret', 92300, '07 85 36 25 41', 'nassim.albert@gmail.com', 'client', 'M$eJ8dL4p'),
(78, 'Schmitt', 'Amina', '1996-01-23', '10 Rue de la Paix', 'Saint-Ouen', 93400, '06 98 74 25 36', 'amina.schmitt@hotmail.fr', 'client', 'J8dL4pM$e'),
(79, 'Dupre', 'Hakim', '2000-03-31', '14 Rue Anatole France', 'Asnières-sur-Seine', 92600, '07 52 63 98 41', 'hakim.dupre@free.fr', 'client', 'K$eJ8dLpM'),
(80, 'Guillet', 'Omar', '2003-05-10', '18 Rue des Champs', 'Versailles', 78000, '06 74 52 98 36', 'omar.guillet@gmail.com', 'client', 'pM$eK8dL4'),
(81, 'Peltier', 'Mehdi', '1998-02-15', '9 Rue des Lilas', 'Paris', 75019, '07 85 63 21 98', 'mehdi.peltier@gmail.com', 'client', 'eK8dLpM4$'),
(82, 'Rodriguez', 'Sofia', '2001-07-23', '15 Rue du Général Leclerc', 'Antony', 92160, '06 98 74 25 36', 'sofia.rodriguez@hotmail.com', 'client', 'L$eK8dMp4'),
(83, 'Vaillant', 'Nassim', '1997-04-07', '3 Boulevard Voltaire', 'Paris', 75011, '07 52 63 98 41', 'nassim.vaillant@gmail.com', 'client', 'M$eJ8dL4p'),
(84, 'Delaunay', 'Lina', '1999-09-12', '10 Avenue Foch', 'Paris', 75016, '06 74 85 23 69', 'lina.delaunay@yahoo.fr', 'client', '8dLpM$eJ4'),
(85, 'Gervais', 'Rayan', '2000-05-19', '18 Rue de la Fontaine', 'Neuilly-sur-Seine', 92200, '07 36 52 41 96', 'rayan.gervais@gmail.com', 'client', 'K$eJ8dLpM'),
(86, 'Boucher', 'Imane', '1994-11-03', '7 Rue des Martyrs', 'Paris', 75009, '06 98 74 52 36', 'imane.boucher@outlook.fr', 'client', 'pM$eK8dL4'),
(87, 'Paris', 'Sofiane', '2003-03-14', '5 Rue Saint-Honoré', 'Paris', 75001, '07 25 96 41 85', 'sofiane.paris@gmail.com', 'client', 'eJ$dLpM4K8'),
(88, 'Grosjean', 'Nadia', '1996-08-21', '22 Rue du Chemin Vert', 'Paris', 75011, '06 74 98 52 63', 'nadia.grosjean@yahoo.fr', 'client', 'L4$eK8dMp'),
(89, 'Legrand', 'Bilal', '1995-12-29', '14 Rue de Montreuil', 'Paris', 75011, '07 85 36 25 41', 'bilal.legrand@free.fr', 'client', 'M$eJ8dL4p'),
(90, 'Langlois', 'Amina', '1998-06-30', '10 Rue Lafayette', 'Paris', 75009, '06 98 74 25 36', 'amina.langlois@gmail.com', 'client', 'J8dL4pM$e'),
(91, 'Delattre', 'Omar', '2003-07-11', '13 Rue Lafayette', 'Paris', 75009, '07 85 96 41 25', 'omar.delattre@gmail.com', 'client', 'K$eJ8dLpM'),
(92, 'Briand', 'Kenza', '1997-06-22', '19 Avenue Foch', 'Paris', 75016, '06 74 98 52 41', 'kenza.briand@outlook.fr', 'client', 'pM$eK8dL4'),
(93, 'Godin', 'Hichem', '1994-03-31', '8 Rue des Acacias', 'Paris', 75017, '07 52 63 98 41', 'hichem.godin@gmail.com', 'client', 'eK8dLpM4$'),
(94, 'Lemoine', 'Sara', '1999-01-17', '5 Rue des Rosiers', 'Paris', 75004, '06 98 74 25 36', 'sara.lemoine@gmail.com', 'client', 'L$eK8dMp4'),
(95, 'Boulanger', 'Nabil', '1995-09-28', '15 Boulevard Saint-Germain', 'Paris', 75005, '07 25 96 41 85', 'nabil.boulanger@hotmail.com', 'client', 'M$eJ8dL4p'),
(96, 'Guérin', 'Amel', '2000-02-14', '3 Rue de la Convention', 'Paris', 75015, '06 74 52 98 63', 'amel.guerin@yahoo.fr', 'client', '8dLpM$eJ4'),
(97, 'Carlier', 'Rayan', '2002-10-07', '10 Rue de la Chapelle', 'Saint-Denis', 93200, '07 85 36 41 25', 'rayan.carlier@free.fr', 'client', 'K$eJ8dLpM'),
(98, 'Ménard', 'Lila', '1996-04-23', '7 Rue de la Gare', 'Colombes', 92700, '06 98 74 52 36', 'lila.menard@gmail.com', 'client', 'pM$eK8dL4'),
(99, 'Pichon', 'Karim', '1998-08-05', '12 Rue Nationale', 'Aubervilliers', 93300, '07 36 25 85 41', 'karim.pichon@hotmail.com', 'client', 'eJ$dLpM4K8'),
(100, 'Vidal', 'Samira', '2001-12-19', '18 Rue du Port', 'Pantin', 93500, '06 74 98 52 63', 'samira.vidal@gmail.com', 'client', 'L4$eK8dMp'),
(101, 'Ali', 'Clarens', '2006-09-07', '64 Boulevard Brune', 'Paris', 75014, '07 44 54 92 60', 'clarensalipro@gmail.com', 'admin', '$2b$12$dtxY.8RP/Kq39YAy4pXPP.poOh/YoGLQ6jinn8O2eTYQH5AExyLq'),
(103, 'Ali', 'Clarens', '2026-03-14', '449 449 brighton road bn15 8lb lancing', 'Brigjton', 0, '744548969', 'admin@gmail.com', 'admin', '$2y$10$HvbHgkLwvIA4Il5HRX6mNOn2LtmJ6MfJCpiDmdqZq6BIy6IOrUMju'),
(104, 'Client', 'Client', '2026-03-04', '11 Avenue du Client', 'Client-Sur-Marne', 75000, '07 46 77 83 24', 'client@gmail.com', 'client', '$2y$10$yRXpkmfFtzq/m04RyK/xAO1hoK3JUXXcO65GEw32m5gywtIRuzNmq');

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `IDPlat` int(11) NOT NULL,
  `NomPlat` varchar(50) NOT NULL,
  `PrixPlat` float DEFAULT NULL,
  `ImagePlat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`IDPlat`, `NomPlat`, `PrixPlat`, `ImagePlat`) VALUES
(0, 'Naan Tenders', 7, NULL),
(1, 'Naan Dynamite', 8.5, 'images/Naan_Dynamite.png'),
(3, 'Naan Steak', 6, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png'),
(4, 'Naan Tenders Steak', 7.5, 'images/Naan_Dynamite.png'),
(5, 'Naan Imperial', 7.5, '/site_restaurant_mvc_v2_correct/images/Naan_Imperial.png'),
(6, 'Naan Thaï', 7, '/site_restaurant_mvc_v2_correct/images/Naan_Thai.png'),
(7, 'Naan Curry', 7, '/site_restaurant_mvc_v2_correct/images/Naan_Curry.png'),
(8, 'Naan Farmer', 7, '/site_restaurant_mvc_v2_correct/images/Naan_Farmer.png'),
(9, 'Naan Radikal', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Radikal.png'),
(10, 'Naan Mix', 7.5, '/site_restaurant_mvc_v2_correct/images/Naan_Mix.png'),
(11, 'Naan Suprem', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Suprem.png'),
(12, 'Naan Tikka', 6.5, '/site_restaurant_mvc_v2_correct/images/Naan_Tikka.png'),
(13, 'Naan South Chicago', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png'),
(14, 'Naan East Harlem', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png'),
(15, 'Naan North Detroit', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png'),
(16, 'Naan West Atlanta', 8, '/site_restaurant_mvc_v2_correct/images/Naan_Steak.png'),
(17, 'Naan Mexicain', 7.5, '/site_restaurant_mvc_v2_correct/images/Naan_Mexicain.png'),
(18, 'Naan Allemand', 7.5, '/site_restaurant_mvc_v2_correct/images/Naan_Allemand.png'),
(19, 'Naan Ivoirien', 9.5, '/site_restaurant_mvc_v2_correct/images/Naan_Ivoirien.png'),
(20, 'Naan Italien', 7.5, '/site_restaurant_mvc_v2_correct/images/Naan_Italien.png'),
(21, 'Frites', 3.5, '/site_restaurant_mvc_v2_correct/images/Frites.png'),
(22, 'Frites cheddar', 7.5, '/site_restaurant_mvc_v2_correct/images/Frites_cheddar.png'),
(23, 'Tenders', 7.5, '/site_restaurant_mvc_v2_correct/images/Tenders.png'),
(24, 'Wings', 7.5, '/site_restaurant_mvc_v2_correct/images/Wings.png'),
(25, 'Nuggets', 7.5, '/site_restaurant_mvc_v2_correct/images/Nuggets.png'),
(26, 'Oignon rings', 7.5, '/site_restaurant_mvc_v2_correct/images/Oignon_rings.png'),
(27, 'Cheese', 7.5, '/site_restaurant_mvc_v2_correct/images/Cheese.png'),
(28, 'Double Cheese', 7.5, '/site_restaurant_mvc_v2_correct/images/Double_cheese.png'),
(29, 'Burger Naan Dynamite', 7.5, '/site_restaurant_mvc_v2_correct/images/Burger_Naan_Dynamite.png'),
(30, 'Burger Naan Ivoirien', 7.5, '/site_restaurant_mvc_v2_correct/images/Burger_Naan_Dynamite.png');

-- --------------------------------------------------------

--
-- Structure de la table `restaurant`
--

CREATE TABLE `restaurant` (
  `IDRestaurant` int(11) NOT NULL,
  `NomRestaurant` varchar(50) DEFAULT NULL,
  `VilleRestaurant` varchar(50) DEFAULT NULL,
  `AdresseRestaurant` varchar(50) DEFAULT NULL,
  `CodePostaleRestaurant` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurant`
--

INSERT INTO `restaurant` (`IDRestaurant`, `NomRestaurant`, `VilleRestaurant`, `AdresseRestaurant`, `CodePostaleRestaurant`) VALUES
(0, 'Sio Street Aubervilliers', 'Aubervilliers', '65 Avenue Jean Jaures', 93300),
(1, 'Sio Street Paris', 'Paris', '71 Avenue du Général Leclerc', 75014),
(2, 'Sio Street Evry', 'Evry', '2 Boulevard de l\'Europe-Valéry Giscard d\'Estaing', 91000),
(3, 'Sio Street Asnières', 'Asnières', '32 Rue Teddy Rinner', 92600),
(4, 'Sio Street Aubervilliers', 'Aubervilliers', '65 Avenue Jean Jaures', 93300);

-- --------------------------------------------------------

--
-- Structure de la table `restaurateur`
--

CREATE TABLE `restaurateur` (
  `Id` int(11) NOT NULL,
  `NombreDeCommandePréparée` int(11) DEFAULT NULL,
  `SalairePerçue` float DEFAULT NULL,
  `IDRestaurant` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `restaurateur`
--

INSERT INTO `restaurateur` (`Id`, `NombreDeCommandePréparée`, `SalairePerçue`, `IDRestaurant`) VALUES
(85, 11, 2000, 1),
(86, 11, 1800.5, 2),
(87, 11, 1700.75, 3),
(89, 10, 2000, 1),
(90, 10, 1800.5, 2),
(91, 10, 1700.75, 3);

-- --------------------------------------------------------

--
-- Structure de la table `réception_de_commande`
--

CREATE TABLE `réception_de_commande` (
  `NumCommande` int(11) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `réception_de_commande`
--

INSERT INTO `réception_de_commande` (`NumCommande`, `Id`) VALUES
(1, 85),
(2, 86),
(3, 87),
(5, 89),
(6, 90),
(7, 91),
(9, 85),
(10, 86),
(11, 87),
(13, 89),
(14, 90),
(15, 91),
(17, 85),
(18, 86),
(19, 87),
(21, 89),
(22, 90),
(23, 91),
(25, 85),
(26, 86),
(27, 87),
(29, 89),
(30, 90),
(31, 91),
(33, 85),
(34, 86),
(35, 87),
(37, 89),
(38, 90),
(39, 91),
(41, 85),
(42, 86),
(43, 87),
(45, 89),
(46, 90),
(47, 91),
(49, 85),
(50, 86),
(51, 87),
(53, 89),
(54, 90),
(55, 91),
(57, 85),
(58, 86),
(59, 87),
(61, 89),
(62, 90),
(63, 91),
(65, 85),
(66, 86),
(67, 87),
(69, 89),
(70, 90),
(71, 91),
(73, 85),
(74, 86),
(75, 87),
(77, 89),
(78, 90),
(79, 91),
(81, 85),
(82, 86),
(83, 87);

-- --------------------------------------------------------

--
-- Structure de la table `transfert_de_la_commande`
--

CREATE TABLE `transfert_de_la_commande` (
  `NumCommande` int(11) NOT NULL,
  `Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transfert_de_la_commande`
--

INSERT INTO `transfert_de_la_commande` (`NumCommande`, `Id`) VALUES
(1, 93),
(2, 94),
(3, 95),
(4, 96),
(5, 97),
(6, 98),
(7, 99),
(8, 100),
(9, 93),
(10, 94),
(11, 95),
(12, 96),
(13, 97),
(14, 98),
(15, 99),
(16, 100),
(17, 93),
(18, 94),
(19, 95),
(20, 96),
(21, 97),
(22, 98),
(23, 99),
(24, 100),
(25, 93),
(26, 94),
(27, 95),
(28, 96),
(29, 97),
(30, 98),
(31, 99),
(32, 100),
(33, 93),
(34, 94),
(35, 95),
(36, 96),
(37, 97),
(38, 98),
(39, 99),
(40, 100),
(41, 93),
(42, 94),
(43, 95),
(44, 96),
(45, 97),
(46, 98),
(47, 99),
(48, 100),
(49, 93),
(50, 94),
(51, 95),
(52, 96),
(53, 97),
(54, 98),
(55, 99),
(56, 100),
(57, 93),
(58, 94),
(59, 95),
(60, 96),
(61, 97),
(62, 98),
(63, 99),
(64, 100),
(65, 93),
(66, 94),
(67, 95),
(68, 96),
(69, 97),
(70, 98),
(71, 99),
(72, 100),
(73, 93),
(74, 94),
(75, 95),
(76, 96),
(77, 97),
(78, 98),
(79, 99),
(80, 100),
(81, 93),
(82, 94),
(83, 95),
(84, 96);

--
-- Structure de la table `vendeur`
--

CREATE TABLE `vendeur` (
  `Id` int(11) NOT NULL,
  `PourboirePerçu` float DEFAULT NULL,
  `NombreDeCommandeDistribuée` int(11) DEFAULT NULL,
  `SalairePerçue` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`Id`, `PourboirePerçu`, `NombreDeCommandeDistribuée`, `SalairePerçue`) VALUES
(93, 3, 11, 2000),
(94, 0, 11, 1800.5),
(95, 0, 11, 1700.75),
(96, 1, 11, 1600),
(97, 15, 10, 2000),
(98, 8, 10, 1800.5),
(99, 0, 10, 1700.75),
(100, 0, 10, 1600);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `choix_du_plat_dans_le_menu`
--
ALTER TABLE `choix_du_plat_dans_le_menu`
  ADD PRIMARY KEY (`IDMenu`,`IDPlat`),
  ADD KEY `IDPlat` (`IDPlat`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`NumCommande`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commandes_client` (`client_id`),
  ADD KEY `fk_commandes_plat` (`plat_id`);

--
-- Index pour la table `commande_du_menu`
--
ALTER TABLE `commande_du_menu`
  ADD PRIMARY KEY (`NumCommande`,`IDMenu`),
  ADD KEY `IDMenu` (`IDMenu`);

--
-- Index pour la table `commande_du_plat`
--
ALTER TABLE `commande_du_plat`
  ADD PRIMARY KEY (`NumCommande`,`IDPlat`),
  ADD KEY `IDPlat` (`IDPlat`);

--
-- Index pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IDMenu`);

--
-- Index pour la table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`IDPlat`);

--
-- Index pour la table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`IDRestaurant`);

--
-- Index pour la table `restaurateur`
--
ALTER TABLE `restaurateur`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IDRestaurant` (`IDRestaurant`);

--
-- Index pour la table `réception_de_commande`
--
ALTER TABLE `réception_de_commande`
  ADD PRIMARY KEY (`NumCommande`,`Id`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `transfert_de_la_commande`
--
ALTER TABLE `transfert_de_la_commande`
  ADD PRIMARY KEY (`NumCommande`,`Id`),
  ADD KEY `Id` (`Id`);

--
-- Index pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT pour la table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `IDMenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `personne`
--
ALTER TABLE `personne`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `IDPlat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choix_du_plat_dans_le_menu`
--
ALTER TABLE `choix_du_plat_dans_le_menu`
  ADD CONSTRAINT `choix_du_plat_dans_le_menu_ibfk_1` FOREIGN KEY (`IDMenu`) REFERENCES `menu` (`IDMenu`),
  ADD CONSTRAINT `choix_du_plat_dans_le_menu_ibfk_2` FOREIGN KEY (`IDPlat`) REFERENCES `plat` (`IDPlat`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `client` (`Id`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `fk_commandes_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`Id`),
  ADD CONSTRAINT `fk_commandes_plat` FOREIGN KEY (`plat_id`) REFERENCES `plat` (`IDPlat`);

--
-- Contraintes pour la table `commande_du_menu`
--
ALTER TABLE `commande_du_menu`
  ADD CONSTRAINT `commande_du_menu_ibfk_1` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`),
  ADD CONSTRAINT `commande_du_menu_ibfk_2` FOREIGN KEY (`IDMenu`) REFERENCES `menu` (`IDMenu`);

--
-- Contraintes pour la table `commande_du_plat`
--
ALTER TABLE `commande_du_plat`
  ADD CONSTRAINT `commande_du_plat_ibfk_1` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`),
  ADD CONSTRAINT `commande_du_plat_ibfk_2` FOREIGN KEY (`IDPlat`) REFERENCES `plat` (`IDPlat`);

--
-- Contraintes pour la table `restaurateur`
--
ALTER TABLE `restaurateur`
  ADD CONSTRAINT `restaurateur_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`),
  ADD CONSTRAINT `restaurateur_ibfk_2` FOREIGN KEY (`IDRestaurant`) REFERENCES `restaurant` (`IDRestaurant`);

--
-- Contraintes pour la table `réception_de_commande`
--
ALTER TABLE `réception_de_commande`
  ADD CONSTRAINT `réception_de_commande_ibfk_1` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`),
  ADD CONSTRAINT `réception_de_commande_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `restaurateur` (`Id`);

--
-- Contraintes pour la table `transfert_de_la_commande`
--
ALTER TABLE `transfert_de_la_commande`
  ADD CONSTRAINT `transfert_de_la_commande_ibfk_1` FOREIGN KEY (`NumCommande`) REFERENCES `commande` (`NumCommande`),
  ADD CONSTRAINT `transfert_de_la_commande_ibfk_2` FOREIGN KEY (`Id`) REFERENCES `vendeur` (`Id`);

--
-- Contraintes pour la table `vendeur`
--
ALTER TABLE `vendeur`
  ADD CONSTRAINT `vendeur_ibfk_1` FOREIGN KEY (`Id`) REFERENCES `personne` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
