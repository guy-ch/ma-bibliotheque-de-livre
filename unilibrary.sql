-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 10 jan. 2026 à 14:50
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
-- Base de données : `unilibrary`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `email`, `mot_de_passe`) VALUES
(2, 'Admin', 'admin@unilibrary.com', '$2y$10$.it.ZpGqv8FJBZQb3xFl2uQ/tj/sJ/2vWK0n7zOTQGA20SfrZ/op.');

-- --------------------------------------------------------

--
-- Structure de la table `cathegorie`
--

CREATE TABLE `cathegorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `cathegorie`
--

INSERT INTO `cathegorie` (`id`, `nom`) VALUES
(1, 'aventure'),
(2, 'litterature'),
(3, 'roman'),
(4, 'sciencefiction');

-- --------------------------------------------------------

--
-- Structure de la table `lecteurs`
--

CREATE TABLE `lecteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lecteurs`
--

INSERT INTO `lecteurs` (`id`, `nom`, `prenom`, `email`) VALUES
(2, 'aziada', 'koffi guy', 'guyaziada21@gmail.com'),
(4, 'aziada', 'guy', 'guyaziada22@gmail.com'),
(5, 'guyaziada', 'guy', 'guyazida23@gmail.com'),
(6, 'koffi', 'yao', 'exemple@gmail.com'),
(7, 'rsagujsa', 'tysujs', 'vguvuhiab@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `liste_lecture`
--

CREATE TABLE `liste_lecture` (
  `id_livre` int(11) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_emprunt` date DEFAULT NULL,
  `date_retour` date DEFAULT NULL,
  `statut` enum('à lire','lu') DEFAULT 'à lire',
  `lu` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `liste_lecture`
--

INSERT INTO `liste_lecture` (`id_livre`, `id_lecteur`, `date_emprunt`, `date_retour`, `statut`, `lu`) VALUES
(15, 1, NULL, NULL, 'à lire', 0),
(12, 1, '2026-01-05', NULL, 'lu', 0),
(13, 1, '2026-01-05', NULL, 'à lire', 0),
(17, 1, '2026-01-05', NULL, 'à lire', 0),
(10, 4, '2026-01-05', NULL, 'à lire', 1),
(16, 4, '2026-01-05', NULL, 'à lire', 0),
(6, 4, '2026-01-05', NULL, 'à lire', 0),
(2, 4, '2026-01-05', NULL, 'à lire', 0),
(1, 5, '2026-01-05', NULL, 'à lire', 0),
(15, 7, '2026-01-06', NULL, 'à lire', 1);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE `livre` (
  `id` int(11) NOT NULL,
  `titre` varchar(100) DEFAULT NULL,
  `auteur` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `maison_edition` varchar(100) DEFAULT NULL,
  `nombre_exemplair` int(11) DEFAULT NULL,
  `cathegorie_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `fichier_pdf` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `description`, `maison_edition`, `nombre_exemplair`, `cathegorie_id`, `image`, `fichier_pdf`) VALUES
(1, 'Candide', 'Voltaire', 'livre aventure', 'Flammarion', 150000000, 1, 'candide.jpg', 'candide.pdf'),
(2, 'Amitié amoureuse', ' Hermine Oudinot', 'livre aventure', 'Calmann-Lévy', 20000, 1, 'amitie amoureuse.jpg', 'amitie amoureuse.pdf'),
(3, 'Les trois mousquetaires', ' Dumas Alexandre', 'livre aventure', 'Baudry', 200000, 1, 'les trois mousquetaires.jpg', 'les trois mousquetaires.pdf'),
(4, 'Maman Léo', ' Féval Paul', 'livre aventure', 'tredition', 80000, 1, 'maman leo.jpg', 'maman leo.pdf'),
(5, 'A rebours', ' Huysmans', 'livre de litterature', ' Charpentie', 2000, 2, 'a rebours.jpg', 'a rebours.pdf'),
(6, 'La Comédie humaine', ' Balzac Honoré ', 'livre de litterature', ' Furne', 200000000, 2, 'comedie humaine.jpg', 'comedie humaine.pdf'),
(7, 'homme Qui Rit', ' Victor Hugo ', 'livre de litterature', 'Flammarion', 60000000, 2, 'homme qui rit.jpg', 'homme qui rit.pdf'),
(8, 'Madame Bovary', 'Flaubert Gustave', 'livre de litterature', 'Charpentier', 80000000, 2, 'madame bovary.jpg', 'madame bovary.pdf'),
(9, 'Les crimes de l\'amour', 'Sade marquis', 'Roman', 'Massé', 15000000, 3, 'crime de amour.jpg', 'crime de amour.pdf'),
(10, 'Les misérables Tome I: Fantine', 'victor Hugo', 'Roman', 'A. Lacroix', 8000000, 3, 'les miserables tome1.jpg', 'les miserables tome1.pdf'),
(11, 'Les misérables Tome II: Fantine', 'victor Hugo', 'Roman', 'A. Lacroix', 8000000, 3, 'les miserables tome2.jpg', 'les miserables tome2.pdf'),
(12, 'Lourdes', 'Emile Zola', 'Roman', 'Charpentier', 5000000, 3, 'lourdes.jpg', 'lourdes.pdf'),
(13, 'Autour de la lune', 'Jules Verne', 'science fiction', 'Hetzel', 1000000, 4, 'autour de la lune.jpg', 'autour de la lune.pdf'),
(14, 'île mystérieuse', 'Jules Verne', 'science fiction', 'Hetzel', 1500000, 4, 'île mystérieuse.jpg', 'île mystérieuse.pdf'),
(15, 'La Fin Des Livres', 'Uzanne Octave', 'science fiction', 'Manucius', 5000, 4, 'la fin des livres.jpg', 'la fin des livres.pdf'),
(17, 'Voyage au Centre de la Terre', 'Jules Verne', 'science fiction', ': Hetzel', 20000000, 4, 'voyage au centre de la terre.jpg', 'voyage au centre de la terre.pdf'),
(136, 'Le Vingtième Siècle: La Vie Électrique', 'Robida Albert', 'science fiction', ': Georges Decaux', 20000, 4, 'le vingtieme siecle.jpg', 'le vingtieme siecle.pdf'),
(142, 'une vie d\'adolescent', 'Amoussou Ayetché', 'Résumé : La jeunesse de l\'auteur a été marquée par les histoires d\'amour. Après avoir fait des choix de filles et de stratégies peu recommandables, il fait la connaissance d\'une qu\'il croyait être la bonne. Il n\'arrivera pas non plus à conserver cette relation. Auteur(s) : Je suis électrotechnicien de formation mais un amoureux des lettres. Depuis mon enfance, j\'ai été fasciné par les livres alors je me suis mis à écrire. C\'est mon premier livre.\r\n', '', 2000, 1, 'une vie d\'adolescent.jpg', 'une vie d\'adolescent.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `messages_contact`
--

CREATE TABLE `messages_contact` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `date_envoi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages_contact`
--

INSERT INTO `messages_contact` (`id`, `nom`, `email`, `message`, `date_envoi`) VALUES
(1, 'pepe', 'guyazida21@gmail.com', 'bonjour', '2026-01-05 06:47:23');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `cathegorie`
--
ALTER TABLE `cathegorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cathegorie` (`cathegorie_id`);

--
-- Index pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cathegorie`
--
ALTER TABLE `cathegorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `messages_contact`
--
ALTER TABLE `messages_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `fk_cathegorie` FOREIGN KEY (`cathegorie_id`) REFERENCES `cathegorie` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
