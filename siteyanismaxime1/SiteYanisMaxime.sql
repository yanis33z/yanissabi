-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : ven. 26 avr. 2024 à 16:43
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `O'Montro.`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `pseudo`, `email`, `motdepasse`) VALUES
(33, 'Yanis', 'yanis@admin.com', 'mdp#123');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `email` varchar(100) NOT NULL,
  `motdepasse` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`email`, `motdepasse`, `nom`, `prenom`) VALUES
('yanissabi@gmail.com', '1234', 'Sabi', 'Yanis'),
('oui@ahoui.com', '123', 'Sabi', 'Yanis');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prix` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantite` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `image`, `nom`, `prix`, `description`, `quantite`) VALUES
(1, 'https://latelierdutemps.com/cdn/shop/files/L1200441_1946x.jpg?v=1702477072', 'Rolex Submariner', 25000, 'Lancée en 1953, la Submariner est la première montre-bracelet de plongée étanche à 100 mètres de profondeur – aujourd’hui 300 mètres. Dès sa création, ses caractéristiques majeures, comme la lunette tournante graduée, l’affichage luminescent et les larges aiguilles et index, en ont fait l’inspiratrice de la longue lignée des montres de plongée Rolex.\r\nIcône du genre, sa réputation a dépassé les limites de son univers professionnel d’origine. La Submariner, une référence.', 10),
(4, 'https://manvstime.fr/wp-content/uploads/2023/06/ROLEX-GMT-MASTER-16710-1.jpg', 'Rolex GMT-MASTER II', 12000, 'Héritière du modèle présenté en 1955 et adopté par les pilotes de ligne, la GMT‑Master II est devenue la montre cosmopolite par excellence. Grâce à son aiguille additionnelle 24 heures et sa lunette rotative bicolore graduée, elle affiche un second fuseau horaire. Elle permet ainsi à chaque porteur de renforcer le lien professionnel ou affectif qu’il entretient avec son « ailleurs » – un ensemble de souvenirs et de destinations rêvées, de retours et de futurs départs.', 10),
(5, 'https://cdn2.chrono24.com/images/uhren/31497041-jol8wvzowbh9oi3b5j4qs4hm-ExtraLarge.jpg', 'Audemar Piguet Skeleton', 100000, 'La Royal Oak Double balancier Squelette résout les problèmes de stabilisation en intégrant un deuxième ensemble balancier-spiral sur le même axe.', 10),
(6, 'https://www.casio.com/content/dam/casio/product-info/locales/fr/fr/timepiece/product/watch/M/MT/MTP/mtp-1302pd-2a2v/assets/MTP-1302PD-2A2V_theme1.jpg.transform/main-visual-pc/image.jpg', 'Casio Timeless', 69, 'Les montres pour femmes ainsi que les montres pour hommes de l’assortiment CASIO TIMELESS COLLECTION sont les représentants d’une technologie de montres modernes d’un design agréable. Elles séduisent grâce à leurs fonctions bien pensées et à la diversité des modèles, couleurs, matériaux et styles. \r\n', 10),
(7, 'https://medias.collectorsquare.com/images/products/403936/00pp-montre-cartier-must-21-en-acier-vers-1990.jpg', 'Cartier Must 21', 1300, ' Originale et sportive par son cadran mêlant acier et détails dorés, elle peut être une alternative aux modèles plus classiques et simples des modèles en or.', 10),
(18, 'https://www.cartier.com/content/images/cms/ycm/resource/blob/552072/75d18122deba2093402ef1cd549c51e3/insert-panthere-watches-lifestyle-1-picture-data.jpg/w1280.jpg', 'Cartier Panthère', 3000, 'Imaginée dans les années 1980, la montre Panthère de Cartier tire son nom de son bracelet. Extra-souple, il suggère la manière dont l’animal emblématique de la Maison se déplace.', 7),
(20, 'https://lsmodding.be/cdn/shop/files/s-l1600.jpg?v=1689342633', 'Seiko Santos', 196, 'Montre bracelet Cartier Santos en acier. Boitier carré en acier, fond vissé, lunette vissée en acier, couronne sertie d\'un cabochon saphir.', 10);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
