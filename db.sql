-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 18 nov. 2022 à 21:25
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `nutrifit`
--

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE `plat` (
  `id_plat` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  `energie` float NOT NULL,
  `lipides` float NOT NULL,
  `glucides` float NOT NULL,
  `proteines` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`id_plat`, `nom`, `energie`, `lipides`, `glucides`, `proteines`) VALUES
(3, '200g fromage blanc', 100, 1, 8, 15),
(4, '120g tranches dinde', 122, 1.5, 0.6, 26),
(5, '1 carré frais 0%', 19, 0.1, 0.5, 4.4);

-- --------------------------------------------------------

--
-- Structure de la table `prise`
--

CREATE TABLE `prise` (
  `id_prise` int(11) NOT NULL,
  `date_prise` datetime NOT NULL,
  `plat` int(11) NOT NULL,
  `multiplicateurPoids` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `prise`
--

INSERT INTO `prise` (`id_prise`, `date_prise`, `plat`, `multiplicateurPoids`) VALUES
(61, '2022-11-15 20:16:45', 5, 1),
(62, '2022-11-15 20:16:49', 3, 1),
(63, '2022-11-15 20:16:50', 3, 1),
(64, '2022-11-15 20:16:51', 3, 1),
(65, '2022-11-15 20:16:51', 3, 1),
(68, '2022-11-16 10:33:48', 4, 1),
(104, '2022-11-16 20:21:38', 3, 1),
(140, '2022-11-17 20:46:05', 4, 1),
(142, '2022-11-17 21:05:21', 3, 1),
(143, '2022-11-17 21:05:23', 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `oj_energie` int(11) NOT NULL,
  `oj_lipides` int(11) NOT NULL,
  `oj_glucides` int(11) NOT NULL,
  `oj_proteines` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `pseudo`, `oj_energie`, `oj_lipides`, `oj_glucides`, `oj_proteines`) VALUES
(1, 'Théo', 1850, 60, 180, 135);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `plat`
--
ALTER TABLE `plat`
  ADD PRIMARY KEY (`id_plat`);

--
-- Index pour la table `prise`
--
ALTER TABLE `prise`
  ADD PRIMARY KEY (`id_prise`) USING BTREE,
  ADD KEY `fk_idPlat` (`plat`) USING BTREE;

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `plat`
--
ALTER TABLE `plat`
  MODIFY `id_plat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `prise`
--
ALTER TABLE `prise`
  MODIFY `id_prise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `prise`
--
ALTER TABLE `prise`
  ADD CONSTRAINT `fk_idAliment` FOREIGN KEY (`plat`) REFERENCES `plat` (`id_plat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
