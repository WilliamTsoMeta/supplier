/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80029
 Source Host           : localhost:3306
 Source Schema         : supplier

 Target Server Type    : MySQL
 Target Server Version : 80029
 File Encoding         : 65001

 Date: 22/05/2022 23:35:48
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `code` char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
  `t_status` enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of supplier
-- ----------------------------
BEGIN;
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (2, 'name1', '01', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (3, 'name2', '02', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (4, 'name3', '03', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (5, 'name4', '04', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (6, 'name5', '05', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (7, 'name6', '06', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (8, 'name7', '07', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (9, 'name8', '08', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (10, 'name9', '09', 'ok');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (11, 'name10', '10', 'hold');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (12, 'name11', '11', 'hold');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (13, 'name12', '12', 'hold');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (14, 'name13', '13', 'hold');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (15, 'name14', '14', 'hold');
INSERT INTO `supplier` (`id`, `name`, `code`, `t_status`) VALUES (16, 'name15', '15', 'hold');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
