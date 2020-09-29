/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : my_template

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 24/07/2020 21:20:05
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tb_admin
-- ----------------------------
DROP TABLE IF EXISTS `tb_admin`;
CREATE TABLE `tb_admin`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '관리자 uid',
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '관리자ID',
  `pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '관리자비밀번호',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES (1, 'admin', 'a');

-- ----------------------------
-- Table structure for tb_api_input
-- ----------------------------
DROP TABLE IF EXISTS `tb_api_input`;
CREATE TABLE `tb_api_input`  (
  `ai_idx` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'API입력UID',
  `api_idx` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'API UID',
  `ai_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이름',
  `ai_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '형식',
  `ai_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '값',
  `ai_ness` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '필수여부',
  `ai_exp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '설명',
  `ai_sort` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '정렬',
  `ai_bigo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '비고',
  PRIMARY KEY (`ai_idx`) USING BTREE,
  INDEX `IX_api_input`(`api_idx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API입력' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_api_list
-- ----------------------------
DROP TABLE IF EXISTS `tb_api_list`;
CREATE TABLE `tb_api_list`  (
  `api_idx` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'API UID',
  `api_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이름',
  `api_exp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '설명',
  `api_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'URL',
  `api_method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '호출방식',
  `api_use` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '사용여부',
  `api_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '상태',
  `api_bigo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '비고',
  `api_ver` int(11) NULL DEFAULT 1 COMMENT '버전',
  PRIMARY KEY (`api_idx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API리스트' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_api_output
-- ----------------------------
DROP TABLE IF EXISTS `tb_api_output`;
CREATE TABLE `tb_api_output`  (
  `ai_idx` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'API출력UID',
  `api_idx` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'API UID',
  `ai_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '이름',
  `ai_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '형식',
  `ai_value` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '값',
  `ai_ness` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '필수여부',
  `ai_exp` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '설명',
  `ai_sort` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '정렬',
  `ai_bigo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT '비고',
  PRIMARY KEY (`ai_idx`) USING BTREE,
  INDEX `IX_api_output`(`api_idx`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API출력' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tb_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '설정 uid',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원 uid',
  `reg_time` datetime(0) NOT NULL DEFAULT current_timestamp(0) COMMENT '가입날자',
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ID(email)',
  `pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '비밀번호',
  `login_time` datetime(0) NULL DEFAULT NULL COMMENT 'Login시간',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '상태(1:정상, 0:삭제, 2:일시정지, 3:탈퇴)',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
