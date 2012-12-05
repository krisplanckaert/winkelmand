/*
Navicat MySQL Data Transfer

Source Server         : localhost_8889
Source Server Version : 50524
Source Host           : localhost:8889
Source Database       : Winkelmand

Target Server Type    : MYSQL
Target Server Version : 50524
File Encoding         : 65001

Date: 2012-12-05 18:22:08
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `bestellingen`
-- ----------------------------
DROP TABLE IF EXISTS `bestellingen`;
CREATE TABLE `bestellingen` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` varchar(255) COLLATE utf8_bin NOT NULL,
  `Product` varchar(255) COLLATE utf8_bin NOT NULL,
  `Prijs` decimal(11,2) NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of bestellingen
-- ----------------------------
INSERT INTO `bestellingen` VALUES ('1', '1', 'test', '1.00', '1');
INSERT INTO `bestellingen` VALUES ('2', '0', 'test1', '1.00', '1');
INSERT INTO `bestellingen` VALUES ('3', '0', 'test2', '2.00', '5');
INSERT INTO `bestellingen` VALUES ('4', 'lf242toh4gslh04b8g8vfrd9k1', 'test1', '1.00', '1');
INSERT INTO `bestellingen` VALUES ('5', 'lf242toh4gslh04b8g8vfrd9k1', 'test2', '2.00', '2');

-- ----------------------------
-- Table structure for `producten`
-- ----------------------------
DROP TABLE IF EXISTS `producten`;
CREATE TABLE `producten` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Naam` varchar(255) COLLATE utf8_bin NOT NULL,
  `Prijs` decimal(11,2) NOT NULL,
  `Image` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of producten
-- ----------------------------
INSERT INTO `producten` VALUES ('1', 'test1', '1.00', '1');
INSERT INTO `producten` VALUES ('2', 'test2', '2.00', '2');
INSERT INTO `producten` VALUES ('3', 'test3', '3.00', '3');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` varchar(255) COLLATE utf8_bin NOT NULL,
  `Voornaam` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `Login` varchar(255) COLLATE utf8_bin NOT NULL,
  `Wachtwoord` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Login` (`Login`,`Wachtwoord`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('f5ov42jd5emfvucvtot27bvdb2', 'kris', 'kris', 'kris', 'kris');
INSERT INTO `users` VALUES ('fnbudl4i37m5b1hfdniupiu1g3', 'testtest', 'testtest', 'testtest', 'testtest');
INSERT INTO `users` VALUES ('skr55unhj8sknd15s6d9h4gr13', 'test', 'test', 'test', 'test');

-- ----------------------------
-- Table structure for `winkelmanden`
-- ----------------------------
DROP TABLE IF EXISTS `winkelmanden`;
CREATE TABLE `winkelmanden` (
  `ID` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ProductID` int(11) NOT NULL,
  `Aantal` int(11) NOT NULL,
  PRIMARY KEY (`ID`,`ProductID`),
  UNIQUE KEY `ID` (`ID`,`ProductID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of winkelmanden
-- ----------------------------
INSERT INTO `winkelmanden` VALUES ('test', '1', '1');
