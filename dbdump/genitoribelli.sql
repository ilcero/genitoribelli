-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Ago 30, 2018 alle 15:49
-- Versione del server: 5.5.61
-- Versione PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `genitoribelli`
--

DELIMITER $$
--
-- Funzioni
--
CREATE DEFINER=`root`@`localhost` FUNCTION `getNuovoNumeroTessera` () RETURNS INT(11) BEGIN
  
  DECLARE num INT(11);
 
  SELECT MAX(numero_tessera)+1 INTO num FROM socio;

  
  
  RETURN num;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `admin`, `nome`, `cognome`) VALUES
(1, 'root', '63A9F0EA7BB98050796B649E85481845', 1, 'Lisa', 'Visintini');

-- --------------------------------------------------------

--
-- Struttura della tabella `socio`
--

CREATE TABLE `socio` (
  `id` int(11) NOT NULL,
  `numero_tessera` int(11) DEFAULT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `cognome` varchar(150) DEFAULT NULL,
  `codice_fiscale` varchar(16) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `data_nascita` date DEFAULT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `socio`
--

INSERT INTO `socio` (`id`, `numero_tessera`, `nome`, `cognome`, `codice_fiscale`, `email`, `tel`, `data_nascita`, `note`) VALUES
(1, 1, 'Lisa', 'Visintini', 'VSNLIS81E34W678U', 'lisa.visintini@gmail.com', '12345', '1981-06-30', ''),
(2, 2, 'Giacomo', 'Petrolo', '', '', '', '2018-08-21', ''),
(6, 3, 'Nina', 'Cerottini', '', '', '', '2018-08-29', ''),
(9, 4, 'Tommaso', 'Petrolo', '', '', '', '2018-02-01', ''),
(10, 5, 'Andrea', 'Cerottini', 'CRTNDR78T18A794M', 'andrea.cerottini@gmail.com', '3929849292', '2018-08-18', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `socio_parentela`
--

CREATE TABLE `socio_parentela` (
  `id` int(11) NOT NULL,
  `socio_id` int(11) DEFAULT NULL,
  `parente_id` int(11) DEFAULT NULL,
  `parentela` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `socio_parentela`
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
(9, 9, 1, 'MADRE');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `socio_parentela`
--
ALTER TABLE `socio_parentela`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `socio`
--
ALTER TABLE `socio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `socio_parentela`
--
ALTER TABLE `socio_parentela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
