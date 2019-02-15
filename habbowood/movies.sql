/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306b
Source Server Version : 50133
Source Host           : localhost:3306
Source Database       : habbowood2007

Target Server Type    : MYSQL
Target Server Version : 50133
File Encoding         : 65001

Date: 2013-02-28 10:53:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `movies`
-- ----------------------------
DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of movies
-- ----------------------------
