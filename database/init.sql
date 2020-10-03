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

 Date: 03/10/2020 15:55:36
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
  `status` int(1) NULL DEFAULT 1 COMMENT '상태(1:정상, 0:삭제)',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_admin
-- ----------------------------
INSERT INTO `tb_admin` VALUES (1, 'admin', 'a', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API입력' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_input
-- ----------------------------
INSERT INTO `tb_api_input` VALUES (1, 1, 'id', 'String', '', '필수', '식별자', 0, '');
INSERT INTO `tb_api_input` VALUES (2, 1, 'pwd', 'String', '', '필수', '비밀번호', 0, '');
INSERT INTO `tb_api_input` VALUES (3, 1, 'push_token', 'String', '', '필수', 'Push Token', 0, '');
INSERT INTO `tb_api_input` VALUES (4, 8, 'uploadfile', 'File', '', '필수', '화일', 0, '');
INSERT INTO `tb_api_input` VALUES (5, 3, 'access_token', 'String', '', '필수', 'Login Token', 0, '');
INSERT INTO `tb_api_input` VALUES (6, 2, 'id', 'String', '', '필수', '식별자(Email)', 0, '');
INSERT INTO `tb_api_input` VALUES (7, 2, 'pwd', 'String', '', '필수', '비밀번호', 0, '');
INSERT INTO `tb_api_input` VALUES (8, 2, 'profile_url', 'String', '', '필수', '회원 사진', 0, '');
INSERT INTO `tb_api_input` VALUES (9, 2, 'name', 'String', '', '필수', '회원 이름', 0, '');
INSERT INTO `tb_api_input` VALUES (10, 1, 'dev_type', 'String', '', '필수', '장치종류(android, web)', 0, '');
INSERT INTO `tb_api_input` VALUES (11, 4, 'access_token', 'String', '', '필수', '접근 token', 0, '');
INSERT INTO `tb_api_input` VALUES (12, 6, 'access_token', 'String', '', '필수', '접근Token', 0, '');
INSERT INTO `tb_api_input` VALUES (13, 6, 'page', 'String', '', '필수', '페지 번호(0부터)', 0, '');

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
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API리스트' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_list
-- ----------------------------
INSERT INTO `tb_api_list` VALUES (1, 'user/login', '회원 Login', 'user/login', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (2, 'user/signup', '회원 가입', 'user/signup', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (3, 'user/logout', '회원 Logout', 'user/logout', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (4, 'user/signout', '회원 탈퇴', 'user/signout', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (5, 'common/appinfo', '공통 정보 얻기', 'common/appinfo', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (6, 'push/list', 'Push Notification List', 'push/list', 'POST', 1, '', '', 1);
INSERT INTO `tb_api_list` VALUES (8, 'common/upload', 'File Upload', 'common/upload', 'POST', 1, '', '', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci COMMENT = 'API출력' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_api_output
-- ----------------------------
INSERT INTO `tb_api_output` VALUES (1, 1, 'access_token', 'String', '', '필수', '사용자접근 token', 0, '');
INSERT INTO `tb_api_output` VALUES (2, 1, 'id', 'String', '', '필수', '사용자 식별자(email)', 0, '');
INSERT INTO `tb_api_output` VALUES (3, 1, 'name', 'String', '', '필수', '사용자 이름', 0, '');
INSERT INTO `tb_api_output` VALUES (4, 8, 'file_name', 'String', '', '필수', '화일이름', 0, '');
INSERT INTO `tb_api_output` VALUES (5, 8, 'file_url', 'String', '', '필수', '화일 URL', 0, '');
INSERT INTO `tb_api_output` VALUES (6, 1, 'reg_time', 'String', '', '필수', '등록시간(YYYY-MM-DD hh:mm:ss)', 0, '');
INSERT INTO `tb_api_output` VALUES (7, 1, 'profile_url', 'String', '', '필수', '회원 사진 URL', 0, '');
INSERT INTO `tb_api_output` VALUES (8, 1, 'profile_url_check', 'String', '', '필수', '회원 사진 검수 상태(2:검사중, 1:승인됨, 0: 부결됨)', 0, '');
INSERT INTO `tb_api_output` VALUES (9, 1, 'status', 'String', '', '필수', '회원상태(1:정상, 2:정지, 3:탈퇴, 0:삭제)', 0, '');
INSERT INTO `tb_api_output` VALUES (10, 5, 'api_ver', 'String', '', '필수', 'API Version', 0, '');
INSERT INTO `tb_api_output` VALUES (11, 6, 'total_count', 'Integer', '', '필수', '전체 개수', 0, '');
INSERT INTO `tb_api_output` VALUES (12, 6, 'total_page', 'String', '', '필수', '전체 페지수', 0, '');
INSERT INTO `tb_api_output` VALUES (13, 6, 'is_last', 'boolean', '', '필수', '마지막 페지(true:맞음, false:아님)', 0, '');
INSERT INTO `tb_api_output` VALUES (14, 6, 'list', 'Object Arr', '', '필수', '\"sender_uid\": 보낸 AppServer 사용자 아이디\n\"receiver_uid\": 받은 App 사용자 아이디\n\"type\": Push Type\n\"title\": Push 제목\n\"message\": Push 내용\n\"reg_time\": Push 보낸 시간\n\"data\": Push 부가 자료', 0, '');

-- ----------------------------
-- Table structure for tb_push_his
-- ----------------------------
DROP TABLE IF EXISTS `tb_push_his`;
CREATE TABLE `tb_push_his`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '아이디',
  `status` int(1) NULL DEFAULT 1 COMMENT '1 정상, 0:삭제',
  `reg_time` datetime(0) NULL DEFAULT current_timestamp(0) COMMENT '등록시간',
  `sender_uid` int(11) NULL DEFAULT NULL COMMENT '보낸 사용자 식별자',
  `receiver_uid` int(11) NULL DEFAULT NULL COMMENT '받은 사용자 식별자, null인경우 전체',
  `sender_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT 'user' COMMENT '보낸 사용자종류(user, admin)',
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push종류(수값일수 있음)',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '알림 제목',
  `message` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '알림 내용',
  `data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL COMMENT 'json추가 자료',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tb_setting
-- ----------------------------
DROP TABLE IF EXISTS `tb_setting`;
CREATE TABLE `tb_setting`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '설정 uid',
  `gotify_app_key` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push App key',
  `status` int(1) NULL DEFAULT 1 COMMENT '1:정상, 0:삭제',
  `gotify_user_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push User id',
  `gotify_user_pwd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'Push User pwd',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tb_setting
-- ----------------------------
INSERT INTO `tb_setting` VALUES (1, 'AoeOKOJHNfBvcJv', 1, 'mario', 'mario');

-- ----------------------------
-- Table structure for tb_user
-- ----------------------------
DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user`  (
  `uid` int(11) NOT NULL AUTO_INCREMENT COMMENT '회원 uid',
  `reg_time` datetime(0) NOT NULL DEFAULT current_timestamp(0) COMMENT '가입날자',
  `id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'ID(email)',
  `pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '비밀번호',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '이름',
  `profile_url` varchar(2083) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '회원 사진URL',
  `profile_url_check` int(1) NULL DEFAULT 2 COMMENT '0:삭제, 1:승인, 2:검수중',
  `access_token` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT '회원 accessToken',
  `dev_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL COMMENT 'android, web',
  `push_token` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT '' COMMENT 'PushToken',
  `login_time` datetime(0) NULL DEFAULT NULL COMMENT 'Login시간',
  `logout` int(1) NULL DEFAULT 1 COMMENT 'Login 0, Logout 1',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '상태(1:정상, 0:삭제, 2:일시정지, 3:탈퇴)',
  PRIMARY KEY (`uid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
