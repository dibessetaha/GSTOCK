-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 09, 2022 at 02:25 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_de_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats`
--

CREATE TABLE `achats` (
  `idAchat` int(11) NOT NULL,
  `qteAchat` double NOT NULL,
  `idPrd_Produit` int(11) NOT NULL,
  `idAppro_approvi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'dibessetaha@gmail.com', 'g-stock123-');

-- --------------------------------------------------------

--
-- Table structure for table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `idAppro` int(11) NOT NULL,
  `dateAchat` date NOT NULL,
  `idFrns_Frns` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `idCat` int(11) NOT NULL,
  `designation` text NOT NULL,
  `discription` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`idCat`, `designation`, `discription`) VALUES
(7, 'Categorie 1', 'Accessoires et habillage'),
(10, 'Categorie 4', 'Vetments'),
(11, 'Categorie 2', 'Materielle informatique'),
(12, 'Categorie 3', 'Alimentaire');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `idCli` int(11) NOT NULL,
  `nomCli` varchar(100) NOT NULL,
  `emailCli` varchar(200) NOT NULL,
  `adresseCli` varchar(300) NOT NULL,
  `numTelCli` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`idCli`, `nomCli`, `emailCli`, `adresseCli`, `numTelCli`) VALUES
(1, 'Taha DIBESSE', 'dibessetaha@gmail.com', '                                   Sidi Abdelkrim Safi MAROC ', '0681260136'),
(2, 'Abdelwahed Najim', 'abdeNajim@gmail.com', 'Casablanca 900000', '0656786102'),
(3, 'Alami Nouh', 'alamiNouh1@gmail.com', 'SAfi MAroc Wed el bacha 460000', '0621457811'),
(4, 'Wail Saadaoui', 'nouhSiuuu1@gmail.com', 'Rabat MAROC 781000', '0671789112');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE `commande` (
  `idCmd` int(11) NOT NULL,
  `dateCmd` date DEFAULT NULL,
  `idCli_Client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idFrns` int(11) NOT NULL,
  `nomFrns` varchar(50) NOT NULL,
  `emailFrns` varchar(256) NOT NULL,
  `adresseFrns` varchar(256) NOT NULL,
  `numTeleFrns` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fournisseur`
--

INSERT INTO `fournisseur` (`idFrns`, `nomFrns`, `emailFrns`, `adresseFrns`, `numTeleFrns`) VALUES
(1, 'Alami Sifeddine', 'fournisseur@alami.gov.fr', '                                    El jadida Sidi bouzid 910000, MAROC                                    ', '0681717101'),
(3, 'Ouahib Ahmad', 'OuahibEntreprise@men.gov.ma', '                                    El bir jdid 700000                                    ', '0601457112'),
(4, 'Mohammed Ali ', 'siMohammed1@gmail.com', 'ESSAOUIRA 9021000', '0612014578');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `idPdr` int(11) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `nom_produit` varchar(50) DEFAULT NULL,
  `qte` int(11) NOT NULL,
  `prixAchat` double NOT NULL,
  `prixVente` double NOT NULL,
  `screenshot` text NOT NULL,
  `idCat_categorie` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`idPdr`, `reference`, `nom_produit`, `qte`, `prixAchat`, `prixVente`, `screenshot`, `idCat_categorie`) VALUES
(45, '124578', 'Montre', 30, 120, 350, 'uploads/447971.jpg', 7),
(50, '5638392', 'spadri', 7, 220, 400, 'uploads/182885.jpg', 7),
(51, '124578', 'Chaussettes', 27, 20, 40, 'uploads/336784.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `vente`
--

CREATE TABLE `vente` (
  `qteVente` double NOT NULL,
  `idPrd_Produit` int(11) NOT NULL,
  `idCmd_Commande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats`
--
ALTER TABLE `achats`
  ADD PRIMARY KEY (`idAchat`),
  ADD KEY `idPrd_Produit` (`idPrd_Produit`,`idAppro_approvi`),
  ADD KEY `idAchat_approvi` (`idAppro_approvi`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`idAppro`),
  ADD KEY `idFrns_Frns` (`idFrns_Frns`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCat`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idCli`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCmd`),
  ADD KEY `idCli_Client` (`idCli_Client`);

--
-- Indexes for table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idFrns`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idPdr`),
  ADD KEY `idCat_categorie` (`idCat_categorie`);

--
-- Indexes for table `vente`
--
ALTER TABLE `vente`
  ADD KEY `idCmd_Commande` (`idCmd_Commande`),
  ADD KEY `idPrd_Produit` (`idPrd_Produit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats`
--
ALTER TABLE `achats`
  MODIFY `idAchat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  MODIFY `idAppro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `idCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCmd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `idFrns` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `idPdr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `vente`
--
ALTER TABLE `vente`
  MODIFY `idPrd_Produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achats`
--
ALTER TABLE `achats`
  ADD CONSTRAINT `achats_ibfk_1` FOREIGN KEY (`idPrd_Produit`) REFERENCES `produit` (`idPdr`),
  ADD CONSTRAINT `achats_ibfk_2` FOREIGN KEY (`idAppro_approvi`) REFERENCES `approvisionnement` (`idAppro`);

--
-- Constraints for table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD CONSTRAINT `approvisionnement_ibfk_1` FOREIGN KEY (`idFrns_Frns`) REFERENCES `fournisseur` (`idFrns`);

--
-- Constraints for table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idCli_Client`) REFERENCES `client` (`idCli`);

--
-- Constraints for table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCat_categorie`) REFERENCES `categorie` (`idCat`);

--
-- Constraints for table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `vente_ibfk_1` FOREIGN KEY (`idCmd_Commande`) REFERENCES `commande` (`idCmd`),
  ADD CONSTRAINT `vente_ibfk_2` FOREIGN KEY (`idPrd_Produit`) REFERENCES `produit` (`idPdr`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
