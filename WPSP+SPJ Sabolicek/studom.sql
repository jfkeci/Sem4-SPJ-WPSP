-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 03, 2020 at 09:34 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studom`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
CREATE TABLE IF NOT EXISTS `administrator` (
  `admin_id` int(11) NOT NULL,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_id_UNIQUE` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `ime`, `prezime`, `username`, `password`) VALUES
(1, 'Josip', 'Josipović', 'jjosipovic', 'test123'),
(2, 'Ivan', 'Jovanović', 'ijovanovic', 'test123');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
CREATE TABLE IF NOT EXISTS `komentar` (
  `komentar_id` int(11) NOT NULL AUTO_INCREMENT,
  `osoba_id` int(11) NOT NULL,
  `titula` int(11) NOT NULL,
  `soba_id` int(11) NOT NULL,
  `datum_vrijeme` datetime NOT NULL DEFAULT current_timestamp(),
  `sadrzaj` varchar(500) NOT NULL,
  PRIMARY KEY (`komentar_id`),
  KEY `fk_Komentar_Soba1_idx` (`soba_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3020 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`komentar_id`, `osoba_id`, `titula`, `soba_id`, `datum_vrijeme`, `sadrzaj`) VALUES
(3001, 105, 2, 1203, '2020-06-06 00:00:00', 'Ova soba je baš dobra. fasfsdfasfwrwerwrqrwefafdasysvyxvyxvxycvsfgasdfasfweefafads'),
(3002, 100, 2, 1203, '2020-06-06 10:00:00', 'Ima puno prostora'),
(3003, 105, 2, 1214, '2020-06-20 11:07:19', 'ewqrqwrqerewq'),
(3004, 105, 2, 3107, '2020-06-20 11:28:50', 'wdadwa'),
(3005, 105, 2, 3107, '2020-06-20 11:29:43', 'dwasdwasdwa'),
(3006, 100, 2, 3101, '2020-06-20 11:31:13', 'fjdskfčafasdfsa'),
(3007, 100, 2, 3101, '2020-06-20 11:33:09', 'fsdafas'),
(3008, 100, 2, 3100, '2020-06-20 11:36:24', 'fsdafsa'),
(3009, 106, 2, 3105, '2020-06-20 12:00:14', 'fsafsadfdasfds'),
(3010, 100, 2, 1204, '2020-06-23 19:35:36', 'rewr'),
(3011, 100, 2, 1204, '2020-06-23 19:40:56', 'gsdgsd'),
(3013, 100, 2, 1204, '2020-06-24 11:49:06', 'Dost dobra soba'),
(3014, 106, 2, 1204, '2020-06-24 11:49:53', 'Kreveti su udobni'),
(3015, 100, 2, 1204, '2020-06-25 09:16:11', 'grfsafasfasf'),
(3016, 100, 2, 1204, '2020-06-26 15:02:55', 'fsafsa'),
(3017, 112, 2, 3100, '2020-06-30 14:03:41', 'Dobra soba'),
(3018, 100, 2, 1209, '2020-06-30 14:04:46', 'fkaldfkad'),
(3019, 1, 1, 3100, '2020-06-30 14:05:57', 'komentar\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `racun`
--

DROP TABLE IF EXISTS `racun`;
CREATE TABLE IF NOT EXISTS `racun` (
  `broj_racuna` int(11) NOT NULL AUTO_INCREMENT,
  `soba_id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `datum_vrijeme` datetime NOT NULL DEFAULT current_timestamp(),
  `svota` int(11) NOT NULL DEFAULT 400,
  `placeno` varchar(2) NOT NULL DEFAULT 'NE',
  PRIMARY KEY (`broj_racuna`),
  UNIQUE KEY `broj_racuna_UNIQUE` (`broj_racuna`),
  UNIQUE KEY `broj_racuna` (`broj_racuna`),
  UNIQUE KEY `broj_racuna_2` (`broj_racuna`),
  KEY `fk_Racun_Soba1_idx` (`soba_id`),
  KEY `fk_Racun_Student1_idx` (`student`)
) ENGINE=InnoDB AUTO_INCREMENT=1160 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `racun`
--

INSERT INTO `racun` (`broj_racuna`, `soba_id`, `student`, `datum_vrijeme`, `svota`, `placeno`) VALUES
(1101, 1204, 111222333, '2020-05-29 12:00:00', 400, 'DA'),
(1102, 1204, 111222333, '2020-06-26 13:13:18', 400, 'DA'),
(1103, 1203, 123324112, '2020-06-26 14:13:25', 400, 'DA'),
(1142, 1203, 123324112, '2020-06-30 13:53:45', 400, 'NE'),
(1143, 1204, 111222333, '2020-06-30 13:53:45', 400, 'NE');

-- --------------------------------------------------------

--
-- Table structure for table `soba`
--

DROP TABLE IF EXISTS `soba`;
CREATE TABLE IF NOT EXISTS `soba` (
  `soba_id` int(11) NOT NULL,
  `broj_sobe` int(11) NOT NULL,
  `kat` int(11) NOT NULL,
  `tip_sobe` varchar(45) NOT NULL,
  `opis` varchar(45) NOT NULL,
  `zauzeto` int(11) NOT NULL,
  PRIMARY KEY (`soba_id`),
  UNIQUE KEY `soba_id_UNIQUE` (`soba_id`),
  UNIQUE KEY `broj_sobe_UNIQUE` (`broj_sobe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soba`
--

INSERT INTO `soba` (`soba_id`, `broj_sobe`, `kat`, `tip_sobe`, `opis`, `zauzeto`) VALUES
(1201, 201, 1, 'Dvokrevetna', 'Zasebna kupaonica', 1),
(1202, 202, 1, 'Dvokrevetna', 'Zasebna kupaonica', 0),
(1203, 203, 1, 'Dvokrevetna', 'Zasebna kupaonica', 0),
(1204, 204, 1, 'Dvokrevetna', 'Zasebna kupaonica', 1),
(1205, 205, 1, 'Dvokrevetna', 'Zasebna kupaonica', 0),
(1206, 206, 1, 'Dvokrevetna', 'Zasebna kupaonica', 0),
(1207, 207, 1, 'Jednokrevetna', 'Zasebna kupaonica', 1),
(1208, 208, 1, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(1209, 209, 1, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(1210, 210, 1, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(1211, 211, 1, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(1212, 212, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1213, 213, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1214, 214, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1215, 215, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1216, 216, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1217, 217, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1218, 218, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1219, 219, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1220, 220, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1221, 221, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1222, 222, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(1223, 223, 1, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2301, 301, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2302, 302, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2303, 303, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 1),
(2304, 304, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2305, 305, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2306, 306, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2307, 307, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2308, 308, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2309, 309, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2310, 310, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2311, 311, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2312, 312, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2313, 313, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2314, 314, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2315, 315, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2316, 316, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2317, 317, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(2318, 318, 2, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3100, 100, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3101, 101, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3102, 102, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3103, 103, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3104, 104, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3105, 105, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3106, 106, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3107, 107, 3, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(3108, 108, 3, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(3109, 109, 3, 'Jednokrevetna', 'Zasebna kupaonica', 0),
(3110, 110, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3111, 111, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3112, 112, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3113, 113, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3114, 114, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3115, 115, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3116, 116, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3117, 117, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3118, 118, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3119, 119, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3120, 120, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0),
(3121, 121, 3, 'Dvokrevetna', 'Dijeljena kupaonica', 0);

-- --------------------------------------------------------

--
-- Table structure for table `soba_student`
--

DROP TABLE IF EXISTS `soba_student`;
CREATE TABLE IF NOT EXISTS `soba_student` (
  `soba_id` int(11) NOT NULL,
  `student_jmbag` int(11) NOT NULL,
  PRIMARY KEY (`soba_id`,`student_jmbag`),
  UNIQUE KEY `student_jmbag` (`student_jmbag`),
  UNIQUE KEY `student_jmbag_2` (`student_jmbag`),
  KEY `fk_Soba_has_Student_Student1_idx` (`student_jmbag`),
  KEY `fk_Soba_has_Student_Soba1_idx` (`soba_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `soba_student`
--

INSERT INTO `soba_student` (`soba_id`, `student_jmbag`) VALUES
(1201, 11223333),
(1204, 111222333),
(1207, 33221144);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(25) NOT NULL,
  `prezime` varchar(25) NOT NULL,
  `jmbag` int(11) NOT NULL,
  `korisnicko_ime` varchar(45) NOT NULL,
  `zaporka` varchar(45) NOT NULL,
  `adresa` varchar(45) NOT NULL,
  `postanski_broj` int(11) NOT NULL,
  `grad` varchar(45) NOT NULL,
  `smjer` varchar(45) NOT NULL,
  `godina_studiranja` int(11) NOT NULL,
  `ostvareno_ects` int(11) NOT NULL,
  `prosjek_ocjena` float NOT NULL,
  PRIMARY KEY (`jmbag`),
  UNIQUE KEY `jmbag_UNIQUE` (`jmbag`),
  UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  UNIQUE KEY `jmbag` (`jmbag`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `ime`, `prezime`, `jmbag`, `korisnicko_ime`, `zaporka`, `adresa`, `postanski_broj`, `grad`, `smjer`, `godina_studiranja`, `ostvareno_ects`, `prosjek_ocjena`) VALUES
(108, 'Emanuela', 'Emanue', 11223333, 'eemanuelovic', 'test123', 'Emunovci Emanovećki 22', 22331, 'Emunovci', 'Menadžment - Informatički menadžment', 1, 45, 4.5),
(105, 'Ivanka', 'Jović', 11997755, 'ijovic', 'test123', 'Bjelovarska 33', 31000, 'Peteranec', 'Menadžment - Informatički menadžment', 1, 6, 4.3),
(104, 'Ivan', 'Ivanović', 33221144, 'iivanovic', 'test123', 'zagreb33', 10000, 'Zagreb', 'Menadžment - Informatički menadžment', 3, 44, 3.7),
(111, 'Rajko', 'Emanuelović', 42141244, 'remanuelovic1', 'test123', 'Radiceva 22', 43111, 'Radicanec', 'Menadžment - Informatički menadžment', 1, 60, 4.3),
(106, 'Rajko', 'Rajkovic', 65436523, 'rrajkovic', 'test123', 'Rajnica22', 69420, 'Rajkovica', 'Menadžment - Informatički menadžment', 1, 44, 3.7),
(100, 'Jakov', 'Saboliček', 111222333, 'jsabolicek', 'test123', 'Stjepana Radića 45', 48331, 'Gotalovo', 'Računalstvo - Programsko Inženjerstvo', 2, 60, 3.4),
(101, 'Karlo', 'Karlovic', 121233222, 'kkarlovic', 'test123', 'Domaji 23', 23323, 'Domaji', 'Računalstvo - Programsko Inženjerstvo', 2, 60, 3.1),
(102, 'Marko', 'Markovic', 123324112, 'mmarkovic', 'test123', 'Slatina 44', 44444, 'Slatina', 'Računalstvo - Programsko Inženjerstvo', 2, 60, 3.3);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_Komentar_Soba1` FOREIGN KEY (`soba_id`) REFERENCES `soba` (`soba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `racun`
--
ALTER TABLE `racun`
  ADD CONSTRAINT `fk_Racun_Soba1` FOREIGN KEY (`soba_id`) REFERENCES `soba` (`soba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Racun_Student1` FOREIGN KEY (`student`) REFERENCES `student` (`jmbag`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `soba_student`
--
ALTER TABLE `soba_student`
  ADD CONSTRAINT `fk_Soba_has_Student_Soba1` FOREIGN KEY (`soba_id`) REFERENCES `soba` (`soba_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Soba_has_Student_Student1` FOREIGN KEY (`student_jmbag`) REFERENCES `student` (`jmbag`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
