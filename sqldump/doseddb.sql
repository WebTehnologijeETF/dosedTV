-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2015 at 11:21 PM
-- Server version: 5.6.24-0ubuntu2
-- PHP Version: 5.6.4-4ubuntu6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `doseddb`
--
CREATE DATABASE IF NOT EXISTS `doseddb` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `doseddb`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
`id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `title` varchar(100) CHARACTER SET latin1 NOT NULL,
  `author` varchar(25) CHARACTER SET latin1 NOT NULL,
  `headline` text CHARACTER SET latin1 NOT NULL,
  `article` text CHARACTER SET latin1 NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `date`, `title`, `author`, `headline`, `article`, `url`) VALUES
(1, '2015-05-28 20:50:57', 'OVO JE NEKI PRIMJER NOVOSTI', 'Vedran Ljubovic', 'Sada ?u napisati neki osnovni tekst. Ovaj osnovni tekst se nalazi u više redova. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'Ovdje sada slijedi detaljniji tekst novosti. \nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\n', 'pictures/tv-thumbnail.jpg'),
(4, '2015-05-28 20:48:16', 'OVO JE NEKI PRIMJER NOVOSTI', 'Vedran Ljubovic', 'Sada ?u napisati neki osnovni tekst. Ovaj osnovni tekst se nalazi u više redova. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'Ovdje sada slijedi detaljniji tekst novosti. \nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\n', 'pictures/tv-thumbnail.jpg'),
(5, '2015-05-28 20:50:44', 'OVO JE NEKI PRIMJER NOVOSTI', 'Vedran Ljubovic', 'Sada ?u napisati neki osnovni tekst. Ovaj osnovni tekst se nalazi u više redova. Lorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.', 'Ovdje sada slijedi detaljniji tekst novosti. \nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\nLorem ipsum dolor sit amet i tako dalje mrsko mi je da kopiram.\n', 'pictures/tv-thumbnail.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `author` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `date`, `author`, `email`, `comment`) VALUES
(23, 1, '2015-05-28 12:22:54', 'p', 'fqpnfj', 'šagjpgja'),
(24, 1, '2015-05-28 12:23:10', 'pgpagj', 'gšajgošq', 'kqngpqg'),
(25, 1, '2015-05-28 19:52:14', 'p', 'fqpnfj', 'šagjpgja'),
(26, 1, '2015-05-28 20:10:43', 'HA HA', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(27, 1, '2015-05-28 19:58:06', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(28, 1, '2015-05-28 19:58:11', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(29, 1, '2015-05-28 19:58:12', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(30, 1, '2015-05-28 19:58:13', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(31, 1, '2015-05-28 19:58:30', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(33, 1, '2015-05-28 20:01:15', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(35, 1, '2015-05-28 20:02:29', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment '),
(36, 1, '2015-05-28 20:02:45', 'Adnan Muslija', 'amuslija1@etf.unsa.ba', 'Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment Comment ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `birthdate`, `gender`, `country`) VALUES
(1, 'admin', '$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG', 'admin@adminstuff.com', 'Admin Statorovic', '2015-05-22', 'male', 'Bosnia and Herzegovina'),
(4, 'admina66', '$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG', 'admin@adminstuff.com', 'Admin Statorovic', '0000-00-00', 'male', 'Bosnia and Herzegovina'),
(6, 'admina4', '$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG', 'admin@adminstuff.com', 'Admin Statorovic', '2015-05-22', 'male', 'Bosnia and Herzegovina'),
(7, 'admina22', '$2a$15$Ku2hb./9aA71tPo/E015h.dVudv3XXu6m92Dkv6MNgXMV5jzHPteG', 'admin@adminstuff.com', 'Admin Statorovic', '0000-00-00', 'male', 'Bosnia and Herzegovina');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `article_id` (`article_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `fk_article_id` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
