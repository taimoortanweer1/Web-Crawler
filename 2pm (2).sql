-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2014 at 06:14 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `2pm`
--
CREATE DATABASE IF NOT EXISTS `2pm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `2pm`;

-- --------------------------------------------------------

--
-- Table structure for table `crawls`
--

CREATE TABLE IF NOT EXISTS `crawls` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `search_key` varchar(100) NOT NULL,
  `p_url_1` varchar(200) NOT NULL,
  `depth` varchar(100) NOT NULL,
  `title` varchar(500) NOT NULL,
  `link` varchar(200) NOT NULL,
  `score` varchar(50) DEFAULT NULL,
  `senti_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forbidden_urls`
--

CREATE TABLE IF NOT EXISTS `forbidden_urls` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forbidden_urls`
--

INSERT INTO `forbidden_urls` (`id`, `link`) VALUES
(1, 'https://www.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(200) NOT NULL,
  `title` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  `snippet` varchar(300) NOT NULL,
  `senti_score` float DEFAULT NULL,
  `senti_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `info`
--

INSERT INTO `info` (`id`, `item`, `title`, `link`, `snippet`, `senti_score`, `senti_type`) VALUES
(1, '', '<b>Happy</b> Wheels Full Version', 'http://www.totaljerkface.com/happy_wheels.php', '', 0.266575, 'positive'),
(2, '', 'Pharrell Williams - <b>Happy</b> (Official Music Video) - YouTube', 'http://www.youtube.com/watch?v=y6Sxv-sUYtM', '', -0.404853, 'negative'),
(3, '', '<b>Happy</b> Harry', 'http://www.walgreens.com/topic/page/happy-harrys.jsp', '', 0, 'positive'),
(4, '', '| The <b>Happy</b> Movie', 'http://www.thehappymovie.com/', '', 0.368106, 'positive'),
(5, '', '<b>Happy</b>: The Parser Generator for Haskell', 'http://www.haskell.org/happy/', '', 0.244274, 'positive'),
(6, '', '<b>Happy</b>: Pharrell Williams', 'http://24hoursofhappy.com/', '', 0.183737, 'positive'),
(7, '', '<b>Happier</b>', 'https://www.happier.com/', '', 0.243488, 'positive'),
(8, '', '<b>Happy</b> (2011) - IMDb', 'http://www.imdb.com/title/tt1613092/', '', 0.200346, 'positive'),
(9, '', '<b>Happy</b>: Simple Steps to Get the Most Out of Life: Ian K. Smith <b>...</b>', 'http://www.amazon.com/Happy-Simple-Steps-Most-Life/dp/B0048EL7VU', '', 0.145277, 'positive'),
(10, '', 'Amazon.com: <b>Happy</b>: Ed Diener, Richard Davidson, Sonja <b>...</b>', 'http://www.amazon.com/Happy-Ed-Diener/dp/B007BECIVC', '', 0.125829, 'positive');

-- --------------------------------------------------------

--
-- Table structure for table `seed`
--

CREATE TABLE IF NOT EXISTS `seed` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `link` varchar(1000) NOT NULL,
  `s_key` varchar(100) NOT NULL,
  `senti_type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=207 ;

--
-- Dumping data for table `seed`
--

INSERT INTO `seed` (`id`, `link`, `s_key`, `senti_type`) VALUES
(206, 'http://www.totaljerkface.com/happy_wheels.php', 'happy', 'positive');

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `user` varchar(100) NOT NULL,
  `tweet` varchar(600) NOT NULL,
  `senti_type` varchar(20) NOT NULL,
  `senti_score` float DEFAULT NULL,
  `keyword` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`user`, `tweet`, `senti_type`, `senti_score`, `keyword`) VALUES
('Sheis_Undefined', 'â€œ@laylowbang: @Sheis_Undefined beefâ€why bruh lol', 'positive', NULL, 'undefined'),
('_Undefined_x3', 'RT @WW1DAlerts: If these are peoples reactions to the story of my life music video what''s going to be ours??! http://t.co/G0zG3yn55S', 'neutral', NULL, 'undefined'),
('1Deep_Undefined', 'RT @HustleConstant: Motherfuckers made me the way I am.', 'neutral', NULL, 'undefined'),
('_MarciaaaxO', '@_Undefined_x3 aw I wish I could go today but I can''t since I didn''t go to school, good luck though!', 'positive', NULL, 'undefined'),
('Undefined_Britt', 'Then wanted 2 talk afterwards... um noo goodbye! !!!!!', 'neutral', NULL, 'undefined'),
('Ryannnnn___', 'RT @Rezon_DaDawn: s/o to @undefined_roses , &amp; @Ryannnnn___  . #ADORE', 'positive', NULL, 'undefined'),
('Undefined_Britt', 'Killed my vibe!!!', 'negative', NULL, 'undefined'),
('HumanitiesAll', 'Oppose cuts to NEH! Send a message to Congress today!\nhttp://t.co/LXKiHZsTDM', 'negative', NULL, 'undefined'),
('_Undefined_x3', 'RT @stylesagram: HARRY CRIED BECAUSE IT WAS THE LAST TAKE ME HOME TOUR CONCERT NOW I''M CRYING http://t.co/IGk6v2K4Vz', 'negative', NULL, 'undefined'),
('Undefined_Britt', 'My moms st8 pissed me off! !!', 'negative', NULL, 'undefined'),
('FriendOfABadMan', 'Photo: youngjusticer: Lobo is an interstellar mercenary. He possesses extraordinary strength of undefined... http://t.co/7eZsfLYvKW', 'negative', NULL, 'undefined'),
('_Undefined_x3', 'RT @_MarciaaaxO: @_Undefined_x3 aw today is your last volleyball game', 'negative', NULL, 'undefined'),
('u_s_f_m_e_p', 'RT @WomenforWomen: Did you know: 10 Facts About Girl''s Education. @GirlRising http://t.co/Tstvgl30mq', 'neutral', NULL, 'undefined'),
('_Undefined_x3', '@_MarciaaaxO Yes unfortunately :(', 'negative', NULL, 'undefined'),
('_Undefined_x3', 'RT @Ranked_Random: waiting for the music video to come out with @_Undefined_x3 and @Nicole_G_xox   I can''t wait any longer!!', 'neutral', NULL, 'undefined'),
('undefined__Xo', '@jchildssss okayy babe î˜', 'neutral', NULL, 'undefined'),
('Undefined_Odera', '@F_ckThatHoe now. when i talk to you later. and ask you that question. i best have a answer bestfriend.!', 'positive', NULL, 'undefined'),
('74_SHENKO', '@Sheis_Undefined FOOL NOT FINNA DO NOTHING TO YU BIG BOOTY .', 'negative', NULL, 'undefined'),
('TheNHattonBand', 'undefined has a new Fan Questions Widget. Ask a question now! http://t.co/QaIK6tn22d via @FanBridge', 'negative', NULL, 'undefined'),
('liljaarn', 'RT @WomenforWomen: Did you know: 10 Facts About Girl''s Education. @GirlRising http://t.co/Tstvgl30mq', 'neutral', NULL, 'undefined');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
