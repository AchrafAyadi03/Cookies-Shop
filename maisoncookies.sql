-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2026 at 11:05 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maisoncookies`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text,
  `prix` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantite` int DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `nom`, `description`, `prix`, `image`, `quantite`) VALUES
(1, 'Chocolat Noisette', 'Cookie gourmand au chocolat et noisettes croquantes', '4.50', 'Cookie-ChocoNoisettes-Modifier.jpg', 20),
(2, 'Double Chocola', 'Riche en chocolat noir et pépites fondantes', '5.00', 'DOUBLE CHOCOLATE COOKIES_108755_1120_1460.jpg', 15),
(3, 'Caramel Beurre Salé', 'Cookie fondant avec caramel au beurre salé, équilibre parfait sucré-salé.', '5.50', 'Cookie Caramel Beurre Salé.jpg', 50),
(4, 'Pistache Chocolat Blanc', 'Cookie raffiné avec pistaches croquantes et chocolat blanc fondant.', '6.00', 'pistache.jpg', 50),
(5, 'Red Velvet', 'Cookie au cacao rouge intense avec des touches de chocolat blanc.', '6.50', 'red.jpg', 50),
(6, 'Café Noix', 'Saveur intense de café associée au croquant des noix.', '5.80', 'cafe.jpg', 50),
(7, 'Framboise Chocolat Noir', 'Alliance fruitée et chocolatée avec une touche acidulée.', '6.20', 'framboise.jpg', 50),
(8, 'Noix de Coco', 'Cookie doux et exotique à la noix de coco râpée.', '5.30', 'Cookie-Noix-de-Coco.jpg', 50),
(9, 'Peanut Butter', 'Cookie riche et moelleux au beurre de cacahuète.', '5.90', 'cookie2.jpg', 50),
(10, 'Orange Chocolat', 'Mélange frais d’orange et intensité du chocolat noir.', '6.10', 'Cookie-Orange-Chocolat.jpg', 50);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int NOT NULL,
  `ingredient` varchar(255) NOT NULL,
  `cookiesId` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `ingredient`, `cookiesId`) VALUES
(32, 'Farine de blé', 1),
(33, 'Beurre doux', 1),
(34, 'Sucre roux', 1),
(35, 'Sucre blanc', 1),
(36, 'Œufs frais', 1),
(37, 'Chocolat noir', 1),
(38, 'Noisettes torréfiées', 1),
(39, 'Levure chimique', 1),
(40, 'Vanille naturelle', 1),
(41, 'Sel', 1),
(42, 'Farine de blé', 2),
(43, 'Beurre doux', 2),
(44, 'Sucre roux', 2),
(45, 'Sucre blanc', 2),
(46, 'Œufs frais', 2),
(47, 'Cacao en poudre', 2),
(48, 'Chocolat noir', 2),
(49, 'Pépites de chocolat', 2),
(50, 'Levure chimique', 2),
(51, 'Vanille naturelle', 2),
(52, 'Sel', 2),
(62, 'Farine de blé', 3),
(63, 'Beurre doux', 3),
(64, 'Sucre roux', 3),
(65, 'Sucre blanc', 3),
(66, 'Œufs frais', 3),
(67, 'Caramel beurre salé', 3),
(68, 'Vanille naturelle', 3),
(69, 'Levure chimique', 3),
(70, 'Sel', 3),
(71, 'Farine de blé', 4),
(72, 'Beurre doux', 4),
(73, 'Sucre roux', 4),
(74, 'Sucre blanc', 4),
(75, 'Œufs frais', 4),
(76, 'Chocolat blanc', 4),
(77, 'Pistaches', 4),
(78, 'Vanille naturelle', 4),
(79, 'Levure chimique', 4),
(80, 'Sel', 4),
(81, 'Farine de blé', 5),
(82, 'Beurre doux', 5),
(83, 'Sucre roux', 5),
(84, 'Sucre blanc', 5),
(85, 'Œufs frais', 5),
(86, 'Cacao en poudre', 5),
(87, 'Colorant rouge', 5),
(88, 'Chocolat blanc', 5),
(89, 'Levure chimique', 5),
(90, 'Vanille naturelle', 5),
(91, 'Farine de blé', 6),
(92, 'Beurre doux', 6),
(93, 'Sucre roux', 6),
(94, 'Œufs frais', 6),
(95, 'Café soluble', 6),
(96, 'Noix', 6),
(97, 'Vanille naturelle', 6),
(98, 'Levure chimique', 6),
(99, 'Sel', 6),
(100, 'Farine de blé', 7),
(101, 'Beurre doux', 7),
(102, 'Sucre roux', 7),
(103, 'Œufs frais', 7),
(104, 'Chocolat noir', 7),
(105, 'Framboises séchées', 7),
(106, 'Vanille naturelle', 7),
(107, 'Levure chimique', 7),
(108, 'Sel', 7),
(109, 'Farine de blé', 8),
(110, 'Beurre doux', 8),
(111, 'Sucre blanc', 8),
(112, 'Sucre roux', 8),
(113, 'Œufs frais', 8),
(114, 'Noix de coco râpée', 8),
(115, 'Vanille naturelle', 8),
(116, 'Levure chimique', 8),
(117, 'Sel', 8),
(118, 'Farine de blé', 9),
(119, 'Beurre doux', 9),
(120, 'Sucre roux', 9),
(121, 'Œufs frais', 9),
(122, 'Beurre de cacahuète', 9),
(123, 'Vanille naturelle', 9),
(124, 'Levure chimique', 9),
(125, 'Sel', 9),
(126, 'Farine de blé', 10),
(127, 'Beurre doux', 10),
(128, 'Sucre roux', 10),
(129, 'Sucre blanc', 10),
(130, 'Œufs frais', 10),
(131, 'Chocolat noir', 10),
(132, 'Zeste d’orange', 10),
(133, 'Vanille naturelle', 10),
(134, 'Levure chimique', 10),
(135, 'Sel', 10);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `telephone` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` enum('admin','client') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `telephone`, `email`, `password`, `role`) VALUES
(1, 'achraf', 'ayadi', 52408150, 'achraf@gmail.com', 'achraf123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cookiesId` (`cookiesId`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`cookiesId`) REFERENCES `cookies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
