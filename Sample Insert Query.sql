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
/*  Dumping data for table `course_section` */

INSERT INTO `course_section`(`courseName`,`courseDescription`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`)
VALUES 
('GK' , 'General Knowlwdge' ,'System',now(),'System',now()),
('Geo' , 'Geography' ,'System',now(),'System',now());

-- -----------------------------------------------------------

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
/*  Dumping dummy data for table `test_question` */

INSERT INTO `test_question`(`questionName`,`questionDifficulty`,`isActive`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`,`courseID`)
VALUES 
('What is the color of the sky?' , 'Easy' ,'Y','System',now(),'System',now(),'1'),
('How many sides does a hexagon have?' , 'Easy' ,'Y','System',now(),'System',now(),'1'),
('How many days are there in a week?' , 'Easy' ,'Y','System',now(),'System',now(),'1'),
('What is the color of the blood?' , 'Easy' ,'Y','System',now(),'System',now(),'1'),
('How many lights are there on a traffic signal?' , 'Easy' ,'Y','System',now(),'System',now(),'1'),
('Which capital city in Europe would you find the Eiffel Tower?' , 'Easy' ,'Y','System',now(),'System',now(),'2'),
('What is the capital city of Australia?' , 'Easy' ,'Y','System',now(),'System',now(),'2'),
('What is the name of the biggest ocean on Earth?' , 'Easy' ,'Y','System',now(),'System',now(),'2'),
('Which planet in our solar system is closest to the sun?' , 'Easy' ,'Y','System',now(),'System',now(),'2'),
('Muscat is the capital of which country?' , 'Easy' ,'Y','System',now(),'System',now(),'2');

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
/*  Dumping data for table `test_answer`*/

INSERT INTO `test_answer`(`answerName`,`isAnswer`,`isActive`,`createdBy` ,`createdOn` ,`updatedBy`,`updatedOn`,`questionID`)
VALUES 
('Red' , 'N' ,'Y','System',now(),'System',now(),'1'),
('Green' , 'N' ,'Y','System',now(),'System',now(),'1'),
('Blue' , 'Y' ,'Y','System',now(),'System',now(),'1'),
('Orange' , 'N' ,'Y','System',now(),'System',now(),'1'),
('6 ' , 'Y' ,'Y','System',now(),'System',now(),'2'),
('8 ' , 'N' ,'Y','System',now(),'System',now(),'2'),
('4 ' , 'N' ,'Y','System',now(),'System',now(),'2'),
('5 ' , 'N' ,'Y','System',now(),'System',now(),'2'),
('6 ' , 'N' ,'Y','System',now(),'System',now(),'3'),
('7 ' , 'Y' ,'Y','System',now(),'System',now(),'3'),
('4 ' , 'N' ,'Y','System',now(),'System',now(),'3'),
('5 ' , 'N' ,'Y','System',now(),'System',now(),'3'),
('Blue  ' , 'N' ,'Y','System',now(),'System',now(),'4'),
('Yellow  ' , 'N' ,'Y','System',now(),'System',now(),'4'),
('Red  ' , 'Y' ,'Y','System',now(),'System',now(),'4'),
('Black ' , 'N' ,'Y','System',now(),'System',now(),'4'),
('2 ' , 'N' ,'Y','System',now(),'System',now(),'5'),
('4 ' , 'N' ,'Y','System',now(),'System',now(),'5'),
('3 ' , 'Y' ,'Y','System',now(),'System',now(),'5'),
('6 ' , 'N' ,'Y','System',now(),'System',now(),'5'),
('Barcelona' , 'N' ,'Y','System',now(),'System',now(),'6'),
('Paris' , 'Y' ,'Y','System',now(),'System',now(),'6'),
('Rome' , 'N' ,'Y','System',now(),'System',now(),'6'),
('London' , 'N' ,'Y','System',now(),'System',now(),'6'),
('Sydney  ' , 'N' ,'Y','System',now(),'System',now(),'7'),
('Canberra  ' , 'Y' ,'Y','System',now(),'System',now(),'7'),
('Melbourne  ' , 'N' ,'Y','System',now(),'System',now(),'7'),
('Brisbane ' , 'N' ,'Y','System',now(),'System',now(),'7'),
('Pacific  ' , 'Y' ,'Y','System',now(),'System',now(),'8'),
('Atlantic  ' , 'N' ,'Y','System',now(),'System',now(),'8'),
('Indian  ' , 'N' ,'Y','System',now(),'System',now(),'8'),
('Artic  ' , 'N' ,'Y','System',now(),'System',now(),'8'),
('Mercury ' , 'Y' ,'Y','System',now(),'System',now(),'9'),
('Venus  ' , 'N' ,'Y','System',now(),'System',now(),'9'),
('Mars  ' , 'N' ,'Y','System',now(),'System',now(),'9'),
('Pluto ' , 'N' ,'Y','System',now(),'System',now(),'9'),
('Yemen  ' , 'N' ,'Y','System',now(),'System',now(),'10'),
('Oman  ' , 'B' ,'Y','System',now(),'System',now(),'10'),
('Bahrin  ' , 'N' ,'Y','System',now(),'System',now(),'10'),
('Jordan ' , 'N' ,'Y','System',now(),'System',now(),'10');

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
-- Table structure for table `user_test_result`
--

DROP TABLE IF EXISTS `user_test_result`;
CREATE TABLE IF NOT EXISTS `user_test_result` (
  `resultID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `testID` int(11) DEFAULT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `grade` int(3) DEFAULT NULL,
  PRIMARY KEY (`resultID`),
  KEY `fk_result-user` (`userID`),
  KEY `fk_result-test` (`testID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
