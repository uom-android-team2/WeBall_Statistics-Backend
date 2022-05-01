-- phpMyAdmin SQL Dump


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admins`
--
-- CREATE DATABASE IF NOT EXISTS `admins` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `admins`;

-- -- --------------------------------------------------------

-- --
-- -- Table structure : `admin`
-- --

-- CREATE TABLE admins.`admin`(
--   `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
--   `username` varchar(32) NOT NULL, 
--   `password` varchar(32) NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Database: `championship`
--
CREATE DATABASE IF NOT EXISTS `championship`DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `championship`;

-- --------------------------------------------------------

--
-- Table structure: `team`
--

CREATE TABLE championship.`team`(
  `id` int(12) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name`varchar(32) NOT NULL,
  `city`varchar(32) NOT NULL,
  `badge` VARBINARY(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `player`
--

CREATE TABLE championship.`player`(
  `id` int(12) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `firstname`varchar(32) NOT NULL,
  `surename`varchar(32) NOT NULL,
  `position`varchar(32) NOT NULL,
  `team`varchar(32) NOT NULL,
  `image`VARBINARY(100) NOT NULL,
  `number` int(12) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `coach`
--

CREATE TABLE championship.`coach`(
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `teamid`int(12) NOT NULL,
  `firstname`varchar(32) NOT NULL,
  `surname`varchar(32) NOT NULL,
  `headcoach` BIT(1) NOT NULL,
  `image` VARBINARY(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `referee`
--

CREATE TABLE championship.`referee`(
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `firstname`varchar(32) NOT NULL,
  `surename`varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `match`
--

CREATE TABLE championship.`match`(
  `id` int UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `team1id`int(12) UNSIGNED NOT NULL,
  `team2id`int(12) UNSIGNED NOT NULL,
  `date`date NOT NULL,
  `progress`BIT(1) NOT NULL,
  `completed`BIT(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `playerstatslive`
--

CREATE TABLE championship.`playerstatslive`(
  `idplayer` int(144) UNSIGNED NOT NULL,
  `idmatch`int(6) UNSIGNED NOT NULL,
  `successfulefforts` int  UNSIGNED NOT NULL,
  `totaleforts`int UNSIGNED NOT NULL,
  `successfulfreethrows`int UNSIGNED NOT NULL,
  `totalfreethrows` int UNSIGNED NOT NULL,
  `succesfultwopointsshot` int UNSIGNED NOT NULL,
  `totaltwopointsshot` int UNSIGNED NOT NULL,
  `succesfulthreepointsshot` int UNSIGNED NOT NULL,
  `totalthreepointsshot` int UNSIGNED NOT NULL,
  `steels` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `blocks` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int(5) UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL,
  `minutes`datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `playerstatschampionship`
--

CREATE TABLE championship.`playerstatschampionship`(
  `idplayer` int(144) UNSIGNED NOT NULL,
  `matchesplayed`int UNSIGNED NOT NULL,
  `successfulefforts` int UNSIGNED NOT NULL,
  `totalfreethrows`int UNSIGNED NOT NULL,
  `succesfultwopointsshot` int UNSIGNED NOT NULL,
  `totaltwopointsshot` int UNSIGNED NOT NULL,
  `succesfulthreepointsshot` int UNSIGNED NOT NULL,
  `totalthreepointsshot` int UNSIGNED NOT NULL,
  `steels` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `blocks` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int(5) UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL,
  `minutes`datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `teamstatslive`
--

CREATE TABLE championship.`teamstatslive`(
  `idmatch` int(6) UNSIGNED NOT NULL,
  `idteam`int(12) UNSIGNED NOT NULL,
  `successfulefforts` int UNSIGNED NOT NULL,
  `totaleforts`int UNSIGNED NOT NULL,
  `successfulfreethrows`int UNSIGNED NOT NULL,
  `totalfreethrows` int UNSIGNED NOT NULL,
  `succesfultwopointsshot` int UNSIGNED NOT NULL,
  `totaltwopointsshot` int UNSIGNED NOT NULL,
  `succesfulthreepointsshot` int UNSIGNED NOT NULL,
  `totalthreepointsshot` int UNSIGNED NOT NULL,
  `steels` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `blocks` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `teamstatschampionship`
--

CREATE TABLE championship.`teamstatschampionship`(
  `idteam` int(12) UNSIGNED NOT NULL,
  `totalmatches`int(24) UNSIGNED NOT NULL,
  `wins` int UNSIGNED NOT NULL,
  `looses` int UNSIGNED NOT NULL,
  `succesfulefforts` int UNSIGNED NOT NULL,
  `totalefforts` int UNSIGNED NOT NULL,
  `successfulfreethrows`int UNSIGNED NOT NULL,
  `totalfreethrows` int UNSIGNED NOT NULL,
  `succesfultwopointsshot` int UNSIGNED NOT NULL,
  `totaltwopointsshot` int UNSIGNED NOT NULL,
  `succesfulthreepointsshot` int UNSIGNED NOT NULL,
  `totalthreepointsshot` int UNSIGNED NOT NULL,
  `steels` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `blocks` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;