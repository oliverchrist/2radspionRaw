-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 27. Januar 2012 um 18:17
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
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(11) NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
