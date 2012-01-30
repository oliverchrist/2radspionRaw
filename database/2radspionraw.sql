-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Januar 2012 um 16:39
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `2radspionraw`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bike`
--

CREATE TABLE IF NOT EXISTS `bike` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `hersteller` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `modell` varchar(255) COLLATE latin1_german1_ci NOT NULL,
  `preis` float NOT NULL,
  `erstellt` timestamp NULL DEFAULT NULL,
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `bike`
--

INSERT INTO `bike` (`uid`, `pid`, `hersteller`, `modell`, `preis`, `erstellt`, `geaendert`) VALUES
(1, 2, 'Retrovelo', 'Paul', 1300, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Retrovelo', 'Paul', 1300, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Stevens', '105', 1000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'Wheeler', 'e-operator', 3001, '0000-00-00 00:00:00', '2012-01-30 13:39:56');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reihenfolge` int(11) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`uid`, `pid`, `name`, `extension`, `erstellt`, `geaendert`, `reihenfolge`) VALUES
(3, 4, '1327934248', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `hash`, `username`, `password`, `email`) VALUES
(0, '39c71ab7f03724db244c08a849c9cd2b', 'olli2', 'e22389783ad773f31ace79a78fe28adc', 'christ@mediaman.de'),
(0, '917a34072663f9c8beea3b45e8f129c5', '', 'e22389783ad773f31ace79a78fe28adc', '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userunconfirmed`
--

CREATE TABLE IF NOT EXISTS `userunconfirmed` (
  `uid` int(11) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `userunconfirmed`
--

