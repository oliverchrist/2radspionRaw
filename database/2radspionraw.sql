-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.3
-- Erstellungszeit: 25. März 2012 um 23:11
-- Server Version: 5.1.60
-- PHP-Version: 4.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Datenbank: `db114896_2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bike`
--

DROP TABLE IF EXISTS `bike`;
CREATE TABLE `bike` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `radtyp` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `geschlecht` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `zustand` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `laufleistung` int(11) NOT NULL,
  `radgroesse` int(11) NOT NULL,
  `rahmenhoehe` int(11) NOT NULL,
  `marke` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `modell` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `farbe` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `bremssystem` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `schaltungstyp` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `rahmenmaterial` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `beleuchtungsart` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `einsatzbereich` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `preis` float NOT NULL,
  `beschreibung` varchar(1000) COLLATE latin1_german1_ci NOT NULL,
  `aktiv` tinyint(1) NOT NULL DEFAULT '1',
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `bike`
--

INSERT INTO `bike` (`uid`, `pid`, `radtyp`, `geschlecht`, `zustand`, `laufleistung`, `radgroesse`, `rahmenhoehe`, `marke`, `modell`, `farbe`, `bremssystem`, `schaltungstyp`, `rahmenmaterial`, `beleuchtungsart`, `einsatzbereich`, `preis`, `beschreibung`, `aktiv`, `erstellt`, `geaendert`) VALUES
(1, 0, 'Cruiser', 'MÃ¤nner', 'Gebraucht bis 3 Jahre', 1000, 28, 56, 'Retrovelo', 'Paul', 'Schwarz', 'Trommelbremse', 'Nabenschaltung', 'Stahl', 'Nabendynamo', '-', 1300, '', 1, '2012-02-03 16:06:30', '2012-02-15 20:35:25'),
(3, 0, 'Crossrad hardtail', 'MÃ¤nner', 'Gebraucht bis 3 Jahre', 8000, 28, 56, 'Stevens', 'Cyclocross 105', 'Silber', 'Felgenbremse', 'Kettenschaltung', 'Aluminium', 'keine', 'Cross-Country', 1200, '', 1, '2012-02-03 16:06:41', '2012-02-18 19:12:47'),
(4, 0, 'Pedelec', 'MÃ¤nner', 'Gebraucht bis 1 Jahr', 3500, 28, 54, 'Wheeler', 'e-operator', 'Schwarz', 'Scheibenbremse', 'Kettenschaltung', 'Aluminium', 'Akku', 'gemÃ¤ÃŸigtes GelÃ¤nde', 3001, 'Lorem ipsum', 1, '0000-00-00 00:00:00', '2012-02-22 19:27:43'),
(5, 2, 'Laufrad', 'MÃ¤nner', 'Gebraucht bis 4 Jahre', 5000, 28, 55, 'Rocky Mountain', 'XKR-S', 'Rot', 'RÃ¼cktritt', 'Tretlagerschaltung', 'Titan', 'Akku', 'StraÃŸe', 129500, '', 1, '2012-02-03 16:04:13', '2012-02-22 21:28:00'),
(9, 2, '18', '0', '0', 0, 0, 0, '17', 'TRC', '0', '0', '0', '0', '0', '0', 1000, '', 1, '2012-02-13 22:28:31', '2012-02-13 22:28:31'),
(10, 2, '18', '0', '0', 0, 0, 0, '17', 'TCX', '0', '0', '0', '0', '0', '0', 1000, '', 1, '2012-02-13 22:28:44', '2012-02-13 22:28:44'),
(11, 2, 'Beachcruiser', 'Unisex', 'Gebraucht bis 1 Jahr', 300, 28, 55, 'Bergamont', '1234', 'Beige', 'Felgenbremse', 'Kettenschaltung', 'Karbon', 'Akku', 'All Mountain', 150, '', 1, '2012-02-16 21:42:04', '2012-02-16 21:42:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reihenfolge` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`uid`, `pid`, `name`, `extension`, `erstellt`, `geaendert`, `reihenfolge`) VALUES
(3, 4, '1327934248', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(4, 5, '1328259825', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 1, '1328281626', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 3, '1328281715', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 4, '1329167336', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(8, 4, '1329167345', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(9, 11, '1329425510', 'png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notepad`
--

DROP TABLE IF EXISTS `notepad`;
CREATE TABLE `notepad` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `remark` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `notepad`
--

INSERT INTO `notepad` (`uid`, `pid`, `id`, `remark`) VALUES
(2, 0, 1, ''),
(3, 3, 0, ''),
(4, 3, 1, ''),
(5, 2, 4, ''),
(6, 2, 1, ''),
(7, 2, 4, ''),
(8, 2, 4, ''),
(9, 0, 5, ''),
(10, 2, 1, ''),
(11, 3, 1, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `anbieter` varchar(255) NOT NULL,
  `anrede` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `firma` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `datenschutz` tinyint(1) NOT NULL,
  `agb` tinyint(1) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `hash`, `anbieter`, `anrede`, `name`, `vorname`, `firma`, `password`, `email`, `postcode`, `city`, `lat`, `lng`, `datenschutz`, `agb`, `erstellt`, `geaendert`) VALUES
(0, '39c71ab7f03724db244c08a849c9cd2b', 'privat', 'frau', 'Christ', 'Oliver', 'mediaman', '917a34072663f9c8beea3b45e8f129c5', 'oliver.christ@web.de', 65232, 'Seitzenhahn', 50.1541817, 8.16596649999997, 0, 0, '0000-00-00 00:00:00', '2012-03-17 10:21:30'),
(2, 'a113b0d13464d336866727c50625e28d', 'haendler', 'herr', 'thorsten', 'renkel', 'RaddhÃ¤ndler', '511e91fbdf7ce0bd5259e2db014d5907', 't.renkel@mac.com', 55128, 'Mainz', 49.9783406, 8.23908299999994, 0, 0, '0000-00-00 00:00:00', '2012-03-04 18:52:53'),
(3, '981abefeab53c58d93e763490501bb39', '', '', '', '', '', '39b4fb4846c99c1d41a4e015da0b60bc', 'eva.gieche@gmx.de', 0, '', 50.1250784, 8.11974639999994, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '85a105ec4593a06736ba44451cf1dcb5', '', '', '', '', '', 'ccc8c600cc2beda53de8328617fc6855', 'dierenkels@mac.com', 55128, 'Mainz', 49.9783406, 8.23908299999994, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, '450ce577166c1bd130b043f9333d69ab', 'privat', 'herr', 'Bachmann', 'Matthias', 'webcocktails.biz', '5a105e8b9d40e1329780d62ea2265d8a', 'matthiasbachmann@online.de', 55116, '', 44.9095374, -93.1679257, 1, 1, '2012-03-16 10:41:12', '2012-03-16 10:59:04');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userunconfirmed`
--

DROP TABLE IF EXISTS `userunconfirmed`;
CREATE TABLE `userunconfirmed` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `anbieter` varchar(255) NOT NULL,
  `anrede` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vorname` varchar(255) NOT NULL,
  `firma` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `postcode` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `datenschutz` tinyint(1) NOT NULL,
  `agb` tinyint(1) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `userunconfirmed`
--


