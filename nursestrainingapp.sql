-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2018 at 07:16 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nursestrainingapp`
--
DROP DATABASE IF EXISTS NursesTrainingApp;
CREATE DATABASE IF NOT EXISTS NursesTrainingApp;

use `NursesTrainingApp`;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `schoolID` int(11) NOT NULL AUTO_INCREMENT,
  `schoolName` varchar(255) NOT NULL,
  `schoolState` varchar(255) DEFAULT 'CT',
  `schoolCountry` varchar(255) DEFAULT 'USA',
  PRIMARY KEY (`schoolID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolName`) VALUES
('Albertus Magnus College'),
('Asnuntuck Community College'),
('Capital Community College'),
('Central Connecticut State University'),
('Connecticut College'),
('Eastern Connecticut State University'),
('Fairfield University'),
('Gateway Community College'),
('Goodwin College'),
('Holy Apostles College and Seminary'),
('Housatonic Community College'),
('Lincoln College of New England Hartford'),
('Lincoln College of New England Southington'),
('Lincoln College of New England Suffield'),
('Lyme Academy College of Fine Arts'),
('Manchester Community College'),
('Middlesex Community College'),
('Mitchell College'),
('Naugatuck Valley Community College'),
('Northwestern Connecticut Community College'),
('Norwalk Community College'),
('Paier College of Art Inc'),
('Post University'),
('Quinebaug Valley Community College'),
('Quinnipiac University'),
('Sacred Heart University'),
('Saint Joseph College'),
('Sanford Brown College Farmington'),
('Southern Connecticut State University'),
("St Vincent's College"),
('Three Rivers Community College'),
('Trinity College'),
('Tunxis Community College'),
('United States Coast Guard Academy'),
('University of Bridgeport'),
('University of Connecticut'),
('University of Connecticut Avery Point'),
('University of Connecticut Stamford'),
('University of Connecticut Tri Campus'),
('University of Hartford'),
('University of New Haven'),
('University of Phoenix Fairfield County Campus'),
('Wesleyan University'),
('Western Connecticut State University'),
('Yale University'),
('other');
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `securityQuestion` varchar(255) NOT NULL,
  `securityAnswer` varchar(255) NOT NULL,
  `graduationYear` int(4) NOT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `universityFlag` char(1) NOT NULL,
  `otherUniversity` varchar(255) DEFAULT NULL,
  `schoolID` int(11) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user-school` (`schoolID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `course_section`
--

DROP TABLE IF EXISTS `course_section`;
CREATE TABLE IF NOT EXISTS `course_section` (
  `courseID` int(11) NOT NULL AUTO_INCREMENT,
  `courseName` varchar(255) DEFAULT NULL,
  `courseDescription` varchar(255) DEFAULT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_question`
--

DROP TABLE IF EXISTS `test_question`;
CREATE TABLE IF NOT EXISTS `test_question` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `questionName` varchar(255) DEFAULT NULL,
  `questionDifficulty` varchar(255) DEFAULT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `courseID` int(11) DEFAULT NULL,
  PRIMARY KEY (`questionID`),
  KEY `fk_question-course` (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_answer`
--

DROP TABLE IF EXISTS `test_answer`;
CREATE TABLE IF NOT EXISTS `test_answer` (
  `answerID` int(11) NOT NULL AUTO_INCREMENT,
  `answerName` varchar(255) DEFAULT NULL,
  `isAnswer` varchar(1) DEFAULT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `questionID` int(11) DEFAULT NULL,
  PRIMARY KEY (`answerID`),
  KEY `fk_answer-question` (`questionID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_test`
--

DROP TABLE IF EXISTS `user_test`;
CREATE TABLE IF NOT EXISTS `user_test` (
  `testID` int(11) NOT NULL AUTO_INCREMENT,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `questionID` int(11) DEFAULT NULL,
  `answerID` int(11) DEFAULT NULL,
  `isCorrect` varchar(1) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`testID`),
  KEY `fk_usertest-question` (`questionID`),
  KEY `fk_usertest-answer` (`answerID`),
  KEY `fk_usertest-user` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adminID` int(11) NOT NULL AUTO_INCREMENT,
  `fname`  varchar(255) NOT NULL,
  `lname`  varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPassword` varchar(255) NOT NULL,
  `isActive` varchar(1) NOT NULL,
  `createdBy` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedBy` varchar(255) DEFAULT NULL,
  `updatedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
--
-- Table structure for table `user_test_result`
--

DROP TABLE IF EXISTS `user_test_result`;
CREATE TABLE IF NOT EXISTS `user_test_result` (
  `resultID` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(255) NOT NULL,
  `courseID` `courseID` int(11) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` int(3) DEFAULT NULL,
  PRIMARY KEY (`resultID`),
  KEY `fk_result-user` (`userID`),
  KEY `fk_result-test` (`testID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `documentID` int(11) NOT NULL AUTO_INCREMENT,
  `documentFile` varchar(255) DEFAULT NULL,
  `courseID` int(11) DEFAULT NULL,
  PRIMARY KEY (`documentID`),
  KEY `fk_document-course` (`courseID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
