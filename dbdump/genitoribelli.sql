-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 05, 2018 at 05:41 PM
-- Server version: 5.5.46
-- PHP Version: 5.4.45

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `genitoribelli`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getNuovoNumeroTessera`() RETURNS int(11)
BEGIN
  
  DECLARE num INT(11);
 
  SELECT MAX(numero_tessera)+1 INTO num FROM socio;

  
  
  RETURN num;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `admin`, `nome`, `cognome`) VALUES
(1, 'root', '63A9F0EA7BB98050796B649E85481845', 1, 'Lisa', 'Visintini');

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE IF NOT EXISTS `corso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text,
  `insegnante_id` int(11) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `corso_elemento`
--

CREATE TABLE IF NOT EXISTS `corso_elemento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `prezzo` decimal(10,0) DEFAULT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `giorni_settimana` varchar(45) DEFAULT NULL,
  `note` text,
  `nome` varchar(255) DEFAULT NULL,
  `corso_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_corso_idx` (`corso_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `corso_iscrizione`
--

CREATE TABLE IF NOT EXISTS `corso_iscrizione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `socio_id` int(11) DEFAULT NULL,
  `note` text,
  `pagato` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`pagato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `socio`
--

CREATE TABLE IF NOT EXISTS `socio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_tessera` int(11) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `cognome` varchar(150) DEFAULT NULL,
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `socio`
--

INSERT INTO `socio` (`id`, `numero_tessera`, `nome`, `cognome`, `codice_fiscale`, `email`, `tel`, `data_nascita`, `note`) VALUES
(1, 1, 'Lisa', 'Visintini', 'VSNLIS81E34W678U', 'lisa.visintini@gmail.com', '12345', '1981-06-30', 'hhkijhkfrtsxtrearweasresy'),
(2, 2, 'Giacomo', 'Petrolo', 'MTISCH56Y78Y234R', '', '', '2018-08-21', ''),
(6, 3, 'Nina', 'Cerottini', 'MTISCH56Y78Y234R', '', '', '2018-08-29', ''),
(9, 4, 'tommaso', 'petrolo', 'MTISCH56Y78Y234R', '', '', '2018-02-01', ''),
(10, 5, 'Andrea', 'Cerottini', 'CRTNDR78T18A794M', 'andrea.cerottini@gmail.com', '3929849292', '2018-08-18', ''),
(11, 6, 'Sebastiano', 'Schiavi', 'SCHSSB890T76EH', 'seba.schiavi@sixs.it', '', '2018-08-02', ''),
(12, 7, 'Martino', 'Schiavi', 'MTISCH56Y78Y234R', '', '', '2018-07-10', ''),
(13, 8, 'pissis', 'baubau', 'jijjihihiui', 'hiuhuih', 'hihih', '2018-09-11', 'mammam psisisiis'),
(14, 9, 'dads', 'asdasd', 'adadsa', '', '', '2018-09-01', '');

-- --------------------------------------------------------

--
-- Table structure for table `socio_parentela`
--

CREATE TABLE IF NOT EXISTS `socio_parentela` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `socio_id` int(11) DEFAULT NULL,
  `parente_id` int(11) DEFAULT NULL,
  `parentela` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `socio_parentela`
--

INSERT INTO `socio_parentela` (`id`, `socio_id`, `parente_id`, `parentela`) VALUES
(1, 6, 1, 'MADRE'),
(2, 6, 10, 'PADRE'),
(3, 6, 2, 'FRATELLO'),
(4, 6, 9, 'FRATELLO'),
(5, 2, 1, 'MADRE'),
(6, 2, 10, 'PADRE'),
(7, 2, 9, 'FRATELLO'),
(8, 9, 10, 'PADRE'),
(9, 9, 1, 'MADRE'),
(10, 12, 11, 'PADRE');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `corso_elemento`
--
ALTER TABLE `corso_elemento`
  ADD CONSTRAINT `fk_corso` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
