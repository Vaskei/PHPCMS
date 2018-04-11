-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 11, 2018 at 06:20 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpcms`
--
CREATE DATABASE IF NOT EXISTS `phpcms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `phpcms`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `cat_title` varchar(255) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(3, 'PC Komponente'),
(4, 'PC Periferija'),
(5, 'Mobilni uređaji'),
(6, 'Igre'),
(7, 'Ostalo'),
(20, 'ghghk'),
(22, 'test'),
(23, 'tyest23'),
(28, 'tests'),
(29, 'test11');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`) VALUES
(1, 3, 'MSI GTX 1080 Ti Lightning Z - Šaroliki gorostas', 'Goran Ferenc', '2018-02-06 05:18:11', 'msi-gtx-1080-ti-lightning-z-saroliki-gorostas_zatTj2.jpg', 'Gotovo beskompromisna serija Lightning MSI grafičkih kartica već se godinama proteže kroz Nvidijine i AMD-ove GPU-ove pa tako niti aktualna Pascalova arhitektura zelenog tima nije bila iznimka. Sada izgleda “nabrijanije” nego ikad, ali koliko zapravo opravdava svoje postojanje pored već popularne Gaming, a odnedavno i nove serije Gaming X Trio?', 'gpu, msi, gtx1080ti, nvidia, geforce', 0),
(2, 3, 'Kingston KC1000 480 GB - Brzi malac', 'Goran Ferenc', '2018-02-06 05:34:33', 'kingston-kc1000-480-gb-brzi-malac_glJUmr.jpg', 'KC1000 je Kingstonov prvi NVMe M.2 SSD. Donosi visoke brzine transfera, a I/O performanse jamče zadovoljstvo profesionalnih korisnika. Baziran je na Phisonovom kontroleru i Toshibinom NAND-u', 'kingston, ssd, m.2, nvme, 480gb', 0),
(3, 1, 'Test 1', 'Goran', '2018-04-10 18:28:42', 'cpu.png', 'Ovo je clanak o procesorima', 'cpu', 4),
(4, 2, 'Test 2', 'Pero', '2018-04-10 18:31:09', 'maxresdefault.jpg', 'Clanak o kucama i kucistima...', 'kucista, kuca', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
