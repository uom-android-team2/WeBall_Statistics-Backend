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
  `surname`varchar(32) NOT NULL
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

CREATE TABLE championship.`player_live_statistics`(
  `player_id` int(144) UNSIGNED NOT NULL,
  `match_id`int(12) UNSIGNED NOT NULL,
  `successful_effort` int  UNSIGNED NOT NULL,
  `total_effort`int UNSIGNED NOT NULL,
  `successful_freethrow`int UNSIGNED NOT NULL,
  `total_freethrow` int UNSIGNED NOT NULL,
  `successful_twopointer` int UNSIGNED NOT NULL,
  `total_twopointer` int UNSIGNED NOT NULL,
  `successful_threepointer` int UNSIGNED NOT NULL,
  `total_threepointer` int UNSIGNED NOT NULL,
  `steel` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `block` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL,
  `minutes`datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `playerstatschampionship`
--

CREATE TABLE championship.`player_championship_statistics`(
  `player_id` int UNSIGNED NOT NULL,
  `matches_played`int UNSIGNED NOT NULL,
  `successful_effort` int UNSIGNED NOT NULL,
  `total_freethrow`int UNSIGNED NOT NULL,
  `successful_twopointer` int UNSIGNED NOT NULL,
  `total_twopointer` int UNSIGNED NOT NULL,
  `successful_threepointer` int UNSIGNED NOT NULL,
  `total_threepointer` int UNSIGNED NOT NULL,
  `steel` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `block` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL,
  `minutes`datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `teamstatslive`
--

CREATE TABLE championship.`team_live_statistics`(
  `match_id` int(6) UNSIGNED NOT NULL,
  `team_id`int(12) UNSIGNED NOT NULL,
  `successful_effort` int UNSIGNED NOT NULL,
  `total_effort`int UNSIGNED NOT NULL,
  `successful_freethrow`int UNSIGNED NOT NULL,
  `total_freethrow` int UNSIGNED NOT NULL,
  `succesful_twopointer` int UNSIGNED NOT NULL,
  `total_twopointer` int UNSIGNED NOT NULL,
  `succesful_threepointer` int UNSIGNED NOT NULL,
  `total_threepointer` int UNSIGNED NOT NULL,
  `steel` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `block` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure: `teamstatschampionship`
--

CREATE TABLE championship.`team_championship_statistics`(
  `team_id` int(12) UNSIGNED NOT NULL,
  `total_matches`int(24) UNSIGNED NOT NULL,
  `win` int UNSIGNED NOT NULL,
  `lose` int UNSIGNED NOT NULL,
  `succesful_effort` int UNSIGNED NOT NULL,
  `total_effort` int UNSIGNED NOT NULL,
  `successful_freethrow`int UNSIGNED NOT NULL,
  `total_freethrow` int UNSIGNED NOT NULL,
  `succesful_twopointer` int UNSIGNED NOT NULL,
  `total_twopointer` int UNSIGNED NOT NULL,
  `succesful_threepointer` int UNSIGNED NOT NULL,
  `total_threepointer` int UNSIGNED NOT NULL,
  `steel` int UNSIGNED NOT NULL,
  `assist` int UNSIGNED NOT NULL,
  `block` int UNSIGNED NOT NULL,
  `rebound` int UNSIGNED NOT NULL,
  `foul` int UNSIGNED NOT NULL,
  `turnover`int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;