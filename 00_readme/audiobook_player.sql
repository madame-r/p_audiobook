-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 04 jan. 2025 à 15:46
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `audiobook_player`
--

-- --------------------------------------------------------

--
-- Structure de la table `audiobooks`
--

DROP TABLE IF EXISTS `audiobooks`;
CREATE TABLE IF NOT EXISTS `audiobooks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authors_id` int NOT NULL,
  `genre_id` int DEFAULT NULL,
  `image_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_size` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_588F46D56DE2013A` (`authors_id`),
  KEY `IDX_588F46D54296D31F` (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `audiobooks`
--

INSERT INTO `audiobooks` (`id`, `title`, `authors_id`, `genre_id`, `image_name`, `image_size`, `updated_at`) VALUES
(1, 'Persuasion', 1, 1, 'marguerite-gerard-liseuse-6779429cef990860987154.jpg', 66288, '2025-01-04 14:15:57'),
(2, 'Emma', 1, 1, 'marguerite-gerard-cadeau-677942c7ef16a840489317.jpg', 423959, '2025-01-04 14:16:39'),
(3, 'Sense and Sensibility', 1, 1, 'marguerite-gerard-bonne-nouvelle-677942e824ab7515257222.jpg', 171621, '2025-01-04 14:17:12'),
(4, 'Letters from a cat', 2, 2, 'kawanabe-kyosai-sleeping-cat-6779431249227151606906.jpg', 527726, '2025-01-04 14:17:54'),
(5, 'Ramona', 2, 3, 'rinehart-matty-tom-6779432d285f1348564911.jpg', 126572, '2025-01-04 14:18:21');

-- --------------------------------------------------------

--
-- Structure de la table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`) VALUES
(1, 'Jane', 'Austen'),
(2, 'Helen', 'Hunt Jackson');

-- --------------------------------------------------------

--
-- Structure de la table `chapters`
--

DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chapter_order` int NOT NULL,
  `duration` int NOT NULL,
  `audiobooks_id` int NOT NULL,
  `audio_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_C721437136274481` (`audiobooks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chapters`
--

INSERT INTO `chapters` (`id`, `title`, `chapter_order`, `duration`, `audiobooks_id`, `audio_filename`, `updated_at`) VALUES
(1, 'Chapter One', 1, 984, 1, 'persuasion-01-677951078cdd0179801405.mp3', '2025-01-04 15:17:27'),
(2, 'Chapter Two', 2, 704, 1, 'persuasion-02-677951a9bdade284607279.mp3', '2025-01-04 15:20:10'),
(3, 'Chapter Three', 3, 1036, 1, 'persuasion-03-677951ecf1a31414824612.mp3', '2025-01-04 15:21:17'),
(4, 'Chapter One', 1, 1297, 2, 'emma-01-01-6779536140b3a786733401.mp3', '2025-01-04 15:27:29'),
(5, 'Chapter Two', 2, 714, 2, 'emma-01-02-6779539c6f748581194515.mp3', '2025-01-04 15:28:28'),
(6, 'Chapter Three', 3, 767, 2, 'emma-01-03-677953ddd94e2050638676.mp3', '2025-01-04 15:29:33'),
(7, 'Chapter One', 1, 692, 3, 'sense-and-sensibility-01-677954a632980516514830.mp3', '2025-01-04 15:32:54'),
(8, 'Chapter Two', 2, 835, 3, 'sense-and-sensibility-02-677955009b9c2318000345.mp3', '2025-01-04 15:34:24'),
(9, 'Chapter Three', 3, 658, 3, 'sense-and-sensibility-03-67795536d44ff429174833.mp3', '2025-01-04 15:35:18'),
(10, 'Introduction', 1, 948, 4, 'lettersfromacat-00-67795607e91d8570840017.mp3', '2025-01-04 15:38:47'),
(11, 'Chapter One to Three', 2, 779, 4, 'lettersfromacat-01-6779564d5fff0177719303.mp3', '2025-01-04 15:39:57'),
(12, 'Chapter One', 1, 1748, 5, 'ramona-01-6779574976875497567927.mp3', '2025-01-04 15:44:09');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20241222143149', '2025-01-04 13:56:12', 2931),
('DoctrineMigrations\\Version20241222150056', '2025-01-04 13:56:15', 3680),
('DoctrineMigrations\\Version20241222150622', '2025-01-04 13:56:19', 5175),
('DoctrineMigrations\\Version20241223134442', '2025-01-04 13:56:24', 297),
('DoctrineMigrations\\Version20241223152111', '2025-01-04 13:56:25', 298),
('DoctrineMigrations\\Version20241224102200', '2025-01-04 13:56:25', 570),
('DoctrineMigrations\\Version20241224114115', '2025-01-04 13:56:26', 1284),
('DoctrineMigrations\\Version20241228163538', '2025-01-04 13:56:27', 1935);

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(1, 'Family'),
(2, 'Children'),
(3, 'Adventure');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(1, 'admin@admin.com', '[]', '$2y$13$Tuh9T2ztRXyF8kqNRuMg6OgJFddheoQNrryspVe256xBKMKlVRqZK');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `audiobooks`
--
ALTER TABLE `audiobooks`
  ADD CONSTRAINT `FK_588F46D54296D31F` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`),
  ADD CONSTRAINT `FK_588F46D56DE2013A` FOREIGN KEY (`authors_id`) REFERENCES `authors` (`id`);

--
-- Contraintes pour la table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `FK_C721437136274481` FOREIGN KEY (`audiobooks_id`) REFERENCES `audiobooks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
