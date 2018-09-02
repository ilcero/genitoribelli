-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 02, 2018 alle 07:16
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
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `descrizione` text,
  `insegnante_id` int(11) DEFAULT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`id`, `nome`, `descrizione`, `insegnante_id`, `data_inizio`, `data_fine`, `note`) VALUES
(1, 'wefw', 'fwefwef', 13, '2018-09-01', '2018-09-30', NULL),
(2, 'wefw', 'fwefwef', 13, '2018-09-01', '2018-09-30', NULL),
(3, 'Arte', 'arte desc', 10, '2018-09-01', '2018-12-19', NULL),
(4, 's', 's', 13, '2018-09-01', '2018-09-02', 'note');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso_elemento`
--

CREATE TABLE `corso_elemento` (
  `id` int(11) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `insegnante_id` int(11) DEFAULT NULL,
  `prezzo` decimal(10,0) DEFAULT NULL,
  `orario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `corso_iscrizione`
--

CREATE TABLE `corso_iscrizione` (
  `id` int(11) NOT NULL,
  `socio_id` int(11) DEFAULT NULL,
  `note` text,
  `pagato` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 1, 'Lisa', 'Visintini', 'VSNLIS81E34W678U', 'lisa.visintini@gmail.com', '12345', '1981-06-30', 'hhkijhkfrtsxtrearweasresy'),
(2, 2, 'Giacomo', 'Petrolo', 'MTISCH56Y78Y234R', '', '', '2018-08-21', ''),
(6, 3, 'Nina', 'Cerottini', 'MTISCH56Y78Y234R', '', '', '2018-08-29', ''),
(9, 4, 'tommaso', 'petrolo', 'MTISCH56Y78Y234R', '', '', '2018-02-01', ''),
(10, 5, 'Andrea', 'Cerottini', 'CRTNDR78T18A794M', 'andrea.cerottini@gmail.com', '3929849292', '2018-08-18', ''),
(11, 6, 'Sebastiano', 'Schiavi', 'SCHSSB890T76EH', 'seba.schiavi@sixs.it', '', '2018-08-02', ''),
(12, 7, 'Martino', 'Schiavi', 'MTISCH56Y78Y234R', '', '', '2018-07-10', ''),
(13, 8, 'pissis', 'baubau', 'jijjihihiui', 'hiuhuih', 'hihih', '2018-09-11', 'mammam psisisiis');

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
(9, 9, 1, 'MADRE'),
(10, 12, 11, 'PADRE');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `corso_elemento`
--
ALTER TABLE `corso_elemento`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `corso_iscrizione`
--
ALTER TABLE `corso_iscrizione`
  ADD PRIMARY KEY (`id`,`pagato`);

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
-- AUTO_INCREMENT per la tabella `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `corso_elemento`
--
ALTER TABLE `corso_elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `corso_iscrizione`
--
ALTER TABLE `corso_iscrizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `socio`
--
ALTER TABLE `socio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `socio_parentela`
--
ALTER TABLE `socio_parentela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
