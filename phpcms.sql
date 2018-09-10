-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 10, 2018 at 09:53 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

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
  `cat_title` varchar(50) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(38, 'PHP'),
(39, 'HTML'),
(40, 'JavaScript'),
(41, 'Bootstrap'),
(42, 'CSS');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(50) NOT NULL,
  `post_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`) VALUES
(11, 38, 'PHP', 'Goran', '2018-09-10 03:40:13', 'php-00441489844a0103eae71ba2fe15244c.png', 'PHP (rekurzivni akronim i backronim za &bdquo;PHP: Hypertext Preprocessor&ldquo;, prije &bdquo;Personal Home Page Tools&ldquo;) je jedan programski jezik koji se orijentira po C i Perl sintaksi, namijenjen prvenstveno programiranju dinamičnih web stranica.[1] PHP je kao slobodni softver distribuiran pod PHP licencnim uvjetima. PHP se ističe &scaron;irokom podr&scaron;kom raznih baza podataka i internet protokola kao i raspoloživosti brojnih programerskih knjižnica[2]. \r\nPrve verzije su se zvale PHP/FI (Personal Home Page Tools/Forms Interpreter) i bile su skup perl skripti, koje je razvio Rasmus Lerdorf za brojanje posjeta na svojoj privatnoj web stranici. To je bilo negdje oko 1995. godine.\r\n\r\nPoslije, kada je nastala potreba za vi&scaron;e funkcija razvio je novu verziju u programskom jeziku C, koja je mogla raditi s bazama podataka i omogućila je korisnicima programirati jednostavne dinamične web stranice. Rasmus je odlučio objaviti PHP kao slobodni softver, tako da ga svatko može pobolj&scaron;ati.\r\n\r\nDanas je PHP jedan od najzastupljenijih programskih jezika za programiranje web aplikacija. Vrline su mu jer je jako sličan C-u, lako se pamti, i lako se pamti svi većina kodova. \r\n1997. godine PHP/FI 2.0 (druga inačica) bila je kult za nekoliko tisuća korisnika &scaron;irom svijeta. Oko 50.000 webstranica imalo je potpis instalacije \'PHP/FI 2.0\', &scaron;to znači da je onda 1% svih web stranica na internetu koristilo PHP. Iako su i drugi korisnici doprinijeli izvornom kodu, bio je to projekt jedne jedine osobe.\r\n\r\nUkratko nakon službenog izdanja \'PHP/FI 2.0\'-a u studenom `97, bio je zamijenjen prvom alfa verzijom PHP-a 3 (PHP3).', 'php', 4),
(12, 39, 'HTML', 'Goran', '2018-09-10 03:42:09', 'html.jpg', 'HTML je kratica za HyperText Markup Language, &scaron;to znači prezentacijski jezik za izradu web stranica. Hipertekst dokument stvara se pomoću HTML jezika. HTML jezikom oblikuje se sadržaj i stvaraju se hiperveze hipertext dokumenta. HTML je jednostavan za uporabu i lako se uči, &scaron;to je jedan od razloga njegove opće prihvaćenosti i popularnosti. Svoju ra&scaron;irenost zahvaljuje jednostavnosti i tome &scaron;to je od početka bio zami&scaron;ljen kao besplatan i tako dostupan svima. Prikaz hipertekst dokumenta omogućuje web preglednik. Temeljna zadaća HTML jezika jest uputiti web preglednik kako prikazati hipertext dokument. Pri tome se nastoji da taj dokument izgleda jednako bez obzira o kojemu je web pregledniku, računalu i operacijskom sustavu riječ. HTML nije programski jezik niti su ljudi koji ga koriste programeri. Njime ne možemo izvr&scaron;iti nikakvu zadaću, pa čak ni najjednostavniju operaciju zbrajanja ili oduzimanja dvaju cijelih brojeva. On služi samo za opis na&scaron;ih hipertekstualnih dokumenata. Html datoteke su zapravo obične tekstualne datoteke, ekstenzija im je .html ili .htm. Osnovni građevni element svake stranice su znakovi (tags) koji opisuju kako će se ne&scaron;to prikazati u web pregledniku. Povezice unutar HTML dokumenata povezuju dokumente u uređenu hijerarhijsku strukturu i time određuju način na koji posjetitelj doživljava sadržaj stranica.', 'html', 4),
(13, 40, 'JavaScript', 'Goran', '2018-09-10 03:43:06', 'javascript.jpg', 'JavaScript je skriptni programski jezik, koji se izvr&scaron;ava u web pregledniku na strani korisnika. Napravljen je da bude sličan Javi, zbog lak&scaron;ega kori&scaron;tenja, ali nije objektno orijentiran kao Java, već se temelji na prototipu i tu prestaje svaka povezanost s programskim jezikom Java. Izvorno ga je razvila tvrtka Netscape (www.netscape.com). JavaScript je primjena ECMAScript standarda.\r\n\r\nJavaScript s AJAX (Asynchronous JavaScript and XML) tehnikom omogućuje web stranicama komunikaciju sa serverskim programom, &scaron;to čini web aplikaciju interaktivnijom i lak&scaron;om za kori&scaron;tenje.', 'javascript, js', 4),
(14, 41, 'Bootstrap', 'Goran', '2018-09-10 03:44:18', 'bootstrap-stack.png', 'Bootstrap is a free and open-source front-end framework for designing websites and web applications. It contains HTML- and CSS-based design templates for typography, forms, buttons, navigation and other interface components, as well as optional JavaScript extensions. Unlike many earlier web frameworks, it concerns itself with front-end development only.\r\n\r\nBootstrap is the second most-starred project on GitHub, with more than 126,000 stars.[2]', 'bootstrap, css, js', 4),
(15, 42, 'CSS', 'Goran', '2018-09-10 03:46:14', 'css-code.jpg', 'CSS je kratica od (eng.) Cascading Style Sheets. Radi se stilskom jeziku, koji se rabi za opis prezentacije dokumenta napisanog pomoću markup (HTML) jezika.[1]\r\n\r\nKako se web razvijao, prvotno su u HTML ubacivani elementi za definiciju prezentacije (npr. tag &lt;font&gt;), ali je dovoljno brzo uočena potreba za stilskim jezikom koji će HTML osloboditi potrebe prikazivanja sadržaja (&scaron;to je prvenstvena namjena HTML-a) i njegovog oblikovanja (čemu danas služi CSS). Drugim riječima, stil definira kako prikazati HTML elemente. CSS-om se uređuje sam izgled i raspored stranice.', 'css', 4);

-- --------------------------------------------------------

--
-- Table structure for table `site_options`
--

DROP TABLE IF EXISTS `site_options`;
CREATE TABLE IF NOT EXISTS `site_options` (
  `option_id` int(2) NOT NULL AUTO_INCREMENT,
  `site_title` varchar(50) NOT NULL,
  `navbar_title` varchar(50) NOT NULL,
  `info_text` varchar(255) NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site_options`
--

INSERT INTO `site_options` (`option_id`, `site_title`, `navbar_title`, `info_text`) VALUES
(1, 'WebDev', 'WebDev', 'Stranica gdje svi Web developeri mogu pročitati informacije o granama WebDev tehnologije.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_nickname` varchar(50) NOT NULL,
  `user_role` varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_password`, `user_nickname`, `user_role`) VALUES
(1, 'administrator', 'b3aca92c793ee0e9b1a9b0a5f5fc044e05140df3', 'Admin', 'admin'),
(2, 'gogogo', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'Gogo', 'user'),
(3, 'testni', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'Test', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
