-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 09. Feb 2012 um 23:13
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
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `bike`
--

INSERT INTO `bike` (`uid`, `pid`, `hersteller`, `modell`, `preis`, `erstellt`, `geaendert`) VALUES
(1, 2, 'Retrovelo', 'Paul mit Bildern', 1300, '2011-12-31 23:00:00', '2012-01-03 23:00:00'),
(2, 2, 'Retrovelo', 'Paul', 1400, '2012-01-27 23:00:00', '2012-01-29 22:49:54');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `geaendert` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reihenfolge` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `images`
--

INSERT INTO `images` (`uid`, `pid`, `name`, `extension`, `erstellt`, `geaendert`, `reihenfolge`) VALUES
(4, 1, '1327953659', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(5, 2, '1328354124', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(6, 1, '1328467373', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(7, 1, '1328467384', 'jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `notepad`
--

CREATE TABLE IF NOT EXISTS `notepad` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `remark` text COLLATE latin1_german1_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_german1_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `notepad`
--

INSERT INTO `notepad` (`uid`, `pid`, `id`, `remark`) VALUES
(1, 2, 1, '');

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
  `postcode` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `latLng` varchar(255) DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`uid`, `hash`, `username`, `password`, `email`, `postcode`, `city`, `latLng`, `lat`, `lng`) VALUES
(2, '5d0f965ba01c7fe26b6fd1f1c68c2b1f', 'olli2', '917a34072663f9c8beea3b45e8f129c5', 'oliver.christ@web.de', 65232, 'Seitzenhahn', '(50.1250784, 8.11974639999994)', '', ''),
(7, '57f140135e877cff0f5e868a9f22a760', 'olli3', '917a34072663f9c8beea3b45e8f129c5', 'oliver.christ@web.de', 65232, 'bleidenstadt', '(50.1421054, 8.139868200000024)', '', ''),
(8, '82211324543230cc2fdc680c8cceab22', 'olli1', '917a34072663f9c8beea3b45e8f129c5', 'test@test.de', 65232, 'taunusstein hahn', '(50.142187, 8.158012999999983)', '', ''),
(9, '607342a7347b8bac986db3e31579be00', 'olli4', '917a34072663f9c8beea3b45e8f129c5', 'test@test4.de', 65232, 'wehen', '(50.154485, 8.185211999999979)', '', '');

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
  `postcode` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `latLng` varchar(255) DEFAULT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL,
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;