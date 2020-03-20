/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50529
 Source Host           : localhost:3306
 Source Schema         : pwd

 Target Server Type    : MySQL
 Target Server Version : 50529
 File Encoding         : 65001

 Date: 04/01/2020 02:04:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for passwd
-- ----------------------------
DROP TABLE IF EXISTS `passwd`;
CREATE TABLE `passwd`  (
  `uid` int(3) NOT NULL DEFAULT 0,
  `account` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `password` blob NULL,
  `type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `importance` int(2) NOT NULL DEFAULT 4,
  PRIMARY KEY (`uid`, `account`, `type`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of passwd
-- ----------------------------
INSERT INTO `passwd` VALUES (2, 'aaa123456', 0xCF91DBBA3863D41B29814B873C7E6AF5, 'LOL', '', 4);
INSERT INTO `passwd` VALUES (2, 'luwenji2407618@163.com', 0x6E7E78DCABAA536AA565ECB1B4D859C3, '百度云', '使用微博登录，7天时长', 4);
INSERT INTO `passwd` VALUES (2, 'qizhi198701@163.com', 0xA065BD49770487E10512DE7A3AC2CD99, '百度云', '使用微博登录，7天时长', 6);
INSERT INTO `passwd` VALUES (2, '84543610881@qt076.cc', 0x8EBD63DB5C77B11D1AB12170173CFE73, '百度云', '使用微博登录，1个月时长', 8);
INSERT INTO `passwd` VALUES (2, 'aaa12345678', 0x8B799B6AF4C76F2D14D525ABE8821D25, 'LOL', NULL, 4);
INSERT INTO `passwd` VALUES (2, 'qq12345', NULL, '', NULL, 4);
INSERT INTO `passwd` VALUES (2, 'aaa4169251', 0xBC34ED5B3E40AE6899E26D77BBEB4725, 'LOL', '123456', 4);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `user_account` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_pwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_phonenum` bigint(11) NOT NULL,
  `uid` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`uid`, `user_account`) USING BTREE,
  UNIQUE INDEX `账号`(`user_account`) USING BTREE COMMENT '唯一性',
  INDEX `uid`(`uid`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 37 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('lmy', '202cb962ac59075b964b07152d234b70', 17603592778, 2);
INSERT INTO `user` VALUES ('123', '202cb962ac59075b964b07152d234b70', 12345, 23);
INSERT INTO `user` VALUES ('lcq', '202cb962ac59075b964b07152d234b70', 17603592777, 3);
INSERT INTO `user` VALUES ('lcq2', '202cb962ac59075b964b07152d234b70', 17603592777, 4);
INSERT INTO `user` VALUES ('aa123', '202cb962ac59075b964b07152d234b70', 17603592777, 6);

SET FOREIGN_KEY_CHECKS = 1;
