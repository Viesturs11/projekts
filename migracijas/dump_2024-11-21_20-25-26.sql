-- Database dump of widget_corp
-- Generated on 2024-11-21 20:25:26



-- Table: pages
CREATE TABLE `pages` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `subject_id` int NOT NULL,
  `menu_name` varchar(30) NOT NULL,
  `position` int NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO `pages` VALUES ('1', '1', 'History', '1', '1', 'This is the company history..');
INSERT INTO `pages` VALUES ('2', '1', 'Our Mission', '2', '1', 'Our corporate mission statement is..');
INSERT INTO `pages` VALUES ('3', '2', 'About Widget Corp', '1', '1', 'The Widget 2000 is a great product. ');


-- Table: subjects
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(30) NOT NULL,
  `position` int NOT NULL,
  `visiable` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO `subjects` VALUES ('1', 'About Widget Corp', '1', '1');
INSERT INTO `subjects` VALUES ('2', 'Products', '2', '1');
INSERT INTO `subjects` VALUES ('3', 'Services', '3', '1');


-- Table: users
CREATE TABLE `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(256) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO `users` VALUES ('1', 'test', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08');
INSERT INTO `users` VALUES ('2', 'test', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855');
