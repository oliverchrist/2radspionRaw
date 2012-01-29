-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 29. Jan 2012 um 16:22
-- Server Version: 5.1.58
-- PHP-Version: 5.3.6-13ubuntu3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `bike`
--

INSERT INTO `bike` (`uid`, `pid`, `hersteller`, `modell`, `preis`, `erstellt`, `geaendert`) VALUES
(1, 2, 'Retrovelo', 'Paul', 1300, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 'Retrovelo', 'Paul', 1300, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 'Stevens', '105', 1000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `hash`, `username`, `password`, `email`) VALUES
(2, '5d0f965ba01c7fe26b6fd1f1c68c2b1f', 'olli2', '917a34072663f9c8beea3b45e8f129c5', 'oliver.christ@web.de');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `userunconfirmed`
--

CREATE TABLE IF NOT EXISTS `userunconfirmed` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Daten für Tabelle `userunconfirmed`
--

INSERT INTO `userunconfirmed` (`uid`, `hash`, `username`, `password`, `email`) VALUES
(13, 'f9cdc36553b743a6740ee688258e31a4', 'olli3', '917a34072663f9c8beea3b45e8f129c5', 'oliver.christ@web.de');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
