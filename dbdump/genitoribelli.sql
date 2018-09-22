-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Set 08, 2018 alle 20:07
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
 
  SELECT COALESCE(MAX(numero_tessera)+1,1) INTO num FROM socio;

  
  
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

--
-- Dump dei dati per la tabella `classe`
--

INSERT INTO `classe` (`id`, `nome`) VALUES
(1, '1 A'),
(2, '1 B');

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
(3, 'Arte', 'arte desc', 12, '2018-09-01', '2018-12-19', 'fsdfsfsfsd');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso_elemento`
--

CREATE TABLE `corso_elemento` (
  `id` int(11) NOT NULL,
  `data_inizio` date DEFAULT NULL,
  `data_fine` date DEFAULT NULL,
  `prezzo` decimal(10,0) DEFAULT NULL,
  `ora_inizio` time DEFAULT NULL,
  `ora_fine` time DEFAULT NULL,
  `giorni_settimana` varchar(45) DEFAULT NULL,
  `note` text,
  `nome` varchar(255) DEFAULT NULL,
  `corso_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso_elemento`
--

INSERT INTO `corso_elemento` (`id`, `data_inizio`, `data_fine`, `prezzo`, `ora_inizio`, `ora_fine`, `giorni_settimana`, `note`, `nome`, `corso_id`) VALUES
(2, '2018-09-06', '2018-09-16', '44', '21:00:00', '22:00:00', '3', '', 'dsds', 3),
(3, '2018-09-06', '2018-09-16', '44', '21:00:00', '22:00:00', '2', '', 'dsds', 3),
(4, '2018-09-06', '2018-09-16', '44', '21:00:00', '22:00:00', '1', '', 'dsds', 3),
(5, '2018-09-06', '2018-09-16', '44', '21:00:00', '22:00:00', '0|1|2|3', '', 'dsds', 3),
(6, '2018-09-06', '2018-09-16', '44', '21:00:00', '22:00:00', '0|1|2|3', '', 'dsds', 3),
(7, '2018-09-01', '2018-09-16', '3', '16:00:00', '18:00:00', '0|2|4', '', 'edi1', 3),
(8, '2018-09-01', '2018-09-09', '0', '00:00:00', '00:00:00', '0', '', 'tetetetet', 3),
(10, '2018-09-01', '2018-09-30', '3', '15:00:00', '15:00:00', '0', '', 'edi', 1),
(11, '2018-08-31', '2018-09-23', '3', '13:00:00', '17:00:00', '2|3', '', '3', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `corso_iscrizione`
--

CREATE TABLE `corso_iscrizione` (
  `id` int(11) NOT NULL,
  `socio_id` int(11) DEFAULT NULL,
  `classe_id` int(11) NOT NULL,
  `note` text,
  `pagato` tinyint(1) NOT NULL DEFAULT '0',
  `corso_id` int(11) NOT NULL,
  `data_iscrizione` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso_iscrizione`
--

INSERT INTO `corso_iscrizione` (`id`, `socio_id`, `classe_id`, `note`, `pagato`, `corso_id`, `data_iscrizione`) VALUES
(1, 14, 1, '', 0, 2, '0000-00-00 00:00:00'),
(2, 14, 1, '', 1, 2, '0000-00-00 00:00:00'),
(3, 14, 1, '', 1, 2, '0000-00-00 00:00:00'),
(4, 14, 1, '', 1, 2, '0000-00-00 00:00:00'),
(5, 10, 1, '', 1, 2, '0000-00-00 00:00:00'),
(6, 11, 2, '', 1, 2, '0000-00-00 00:00:00'),
(7, 14, 1, '', 1, 2, '2018-09-08 00:00:00'),
(8, 14, 1, '', 0, 2, '2018-09-08 07:09:42'),
(9, 9, 1, '', 0, 2, '2018-09-08 07:09:26'),
(10, 13, 1, '', 0, 2, '2018-09-08 07:09:28'),
(11, 13, 1, '', 0, 2, '2018-09-08 07:09:25'),
(12, 12, 1, '', 1, 2, '2018-09-08 07:09:34'),
(13, 1, 1, '', 0, 2, '2018-09-08 07:09:45');

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
(13, 8, 'pissis', 'baubau', 'jijjihihiui', 'hiuhuih', 'hihih', '2018-09-11', 'mammam psisisiis'),
(14, 9, 'dads', 'asdasd', 'adadsa', '', '', '2018-09-01', '');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_corso_idx` (`corso_id`);

--
-- Indici per le tabelle `corso_iscrizione`
--
ALTER TABLE `corso_iscrizione`
  ADD PRIMARY KEY (`id`,`pagato`),
  ADD KEY `fk_socio_iscri_idx` (`socio_id`),
  ADD KEY `fk_classe_iscr_idx` (`classe_id`),
  ADD KEY `fk_corso_elem_iscr_idx` (`corso_id`);

--
-- Indici per le tabelle `socio`
--
ALTER TABLE `socio`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `socio_parentela`
--
ALTER TABLE `socio_parentela`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_socio_parent_idx` (`socio_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `corso_elemento`
--
ALTER TABLE `corso_elemento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT per la tabella `corso_iscrizione`
--
ALTER TABLE `corso_iscrizione`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `socio`
--
ALTER TABLE `socio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `socio_parentela`
--
ALTER TABLE `socio_parentela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corso_elemento`
--
ALTER TABLE `corso_elemento`
  ADD CONSTRAINT `fk_corso` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `corso_iscrizione`
--
ALTER TABLE `corso_iscrizione`
  ADD CONSTRAINT `fk_socio_iscri` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_classe_iscr` FOREIGN KEY (`classe_id`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_corso_elem_iscr` FOREIGN KEY (`corso_id`) REFERENCES `corso_elemento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `socio_parentela`
--
ALTER TABLE `socio_parentela`
  ADD CONSTRAINT `fk_socio_parent` FOREIGN KEY (`socio_id`) REFERENCES `socio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
