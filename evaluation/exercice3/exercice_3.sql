-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 05 fév. 2018 à 15:56
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movies` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `actors` varchar(300) NOT NULL,
  `director` varchar(50) NOT NULL,
  `producer` varchar(50) NOT NULL,
  `video` varchar(250) NOT NULL,
  `storyline` text NOT NULL,
  `year_of_prod` year(4) NOT NULL,
  `language` varchar(25) NOT NULL,
  `category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movies`, `title`, `actors`, `director`, `producer`, `video`, `storyline`, `year_of_prod`, `language`, `category`) VALUES
(4, 'Jurassik Park', 'Sam Neill, Laura Dern, Jeff Goldblum, Richard Attenborough', 'Steven Spielberg', 'Universal Pictures, Amblin Entertainment', 'https://www.youtube.com/watch?v=ZEY7iMX_oZs', 'John Parker Hammond, le PDG de la puissante compagnie InGen, parvient à donner vie à des dinosaures grâce à la génétique et décide de les utiliser dans le cadre d’un parc d\'attractions qu’il compte ouvrir sur une île au large du Costa Rica. Avant l\'ouverture, il fait visiter le parc à un groupe d\'experts pour obtenir leur aval. Pendant la visite, une tempête éclate et un informaticien corrompu par une entreprise rivale en profite pour couper les systèmes de sécurité afin de voler des embryons de dinosaures. En l\'absence de tout système de sécurité pendant plusieurs heures, les dinosaures s\'échappent sans mal, mais le cauchemar des visiteurs ne fait que commencer...', 1993, 'anglais', 'action'),
(5, 'Scream', 'David Arquette, Neve Campbell, Courteney Cox, Matthew Lillard, Rose McGowan', 'Wes Craven', 'Dimension Films, Woods Entertainment', 'www.allocine.fr/video/player_gen_cmedia=19551132&cfilm=11091.html', 'La petite ville californienne de Woodsboro, d\'ordinaire très tranquille, est secouée par les meurtres de deux étudiants. La police enquête tandis que le tueur frappe à nouveau, s\'inspirant des films d\'horreur des années 1970 et 1980. Qui sera la prochaine victime ? Qui se cache derrière le masque de l\'assassin ? L\'enquête commence tandis que le tueur vise plus particulièrement Sidney Prescott.', 1996, 'anglais', 'horreur');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movies`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
