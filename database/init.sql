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

 Date: 02/10/2020 16:10:33
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
  `status` int(1) NULL DEFAULT NULL COMMENT '상태(1:정상, 0:삭제)',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES (1, 'admin', 'a', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API입력' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_input
-- ----------------------------
INSERT INTO `tb_api_input` VALUES (1, 1, 'id', 'String', '', '필수', '식별자', 0, '');
INSERT INTO `tb_api_input` VALUES (2, 1, 'pwd', 'String', '', '필수', '비밀번호', 0, '');
INSERT INTO `tb_api_input` VALUES (3, 1, 'push_token', 'String', '', '필수', 'Push Token', 0, '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API리스트' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_list
-- ----------------------------
INSERT INTO `tb_api_list` VALUES (1, 'user/login', '회원 Login', 'user/login', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (2, 'user/signup', '회원 가입', 'user/signup', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (3, 'user/logout', '회원 Logout', 'user/logout', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (4, 'user/signout', '회원 탈퇴', 'user/signout', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (5, 'common/appinfo', '공통 정보 얻기', 'common/appinfo', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (6, 'push/list', 'Push Notification List', 'push/list', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (7, 'push/send', 'Push Notification 전송', 'push/send', 'POST', 1, '', '', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API출력' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_output
-- ----------------------------
INSERT INTO `tb_api_output` VALUES (1, 1, 'access_token', 'String', '', '필수', '사용자접근 token', 0, '');
INSERT INTO `tb_api_output` VALUES (2, 1, 'id', 'String', '', '필수', '사용자 식별자(email)', 0, '');
INSERT INTO `tb_api_output` VALUES (3, 1, 'name', 'String', '', '필수', '사용자 이름', 0, '');

-- ----------------------------
-- Table structure for tb_push_his
-- ----------------------------
DROP TABLE IF EXISTS `tb_push_his`;
CREATE TABLE `tb_push_his`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `status` int(1) NULL DEFAULT 1 COMMENT '1 정상, 0:삭제',
  `reg_time` datetime(0) NULL DEFAULT current_timestamp(0) COMMENT '등록시간',
  `sender_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '관리자 admin, 앱 U',
  `sender_uid` int(11) NULL DEFAULT NULL COMMENT '보낸 유저 아이디',
  `receiver_type` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '앱 U, null인경우 전체',
  `receiver_uid` int(11) NULL DEFAULT NULL COMMENT '받은 유저 아이디, null인경우 전체',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push종류(수값일수 있음)',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '알림 제목',
  `content` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '알림 내용',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'json추가 자료',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '설정 uid',
  `push_app_key` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push App key',
  `status` int(1) NULL DEFAULT 1 COMMENT '1:정상, 0:삭제',
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
  `photo_url` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '회원 사진URL',
  `photo_check` int(1) NULL DEFAULT 2 COMMENT '0:삭제, 1:승인, 2:검수중',
  `access_token` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '회원 accessToken',
  `push_token` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'PushToken',
  `login_time` datetime(0) NULL DEFAULT NULL COMMENT 'Login시간',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '상태(1:정상, 0:삭제, 2:일시정지, 3:탈퇴)',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
