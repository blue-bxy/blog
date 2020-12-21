/*
 Navicat Premium Data Transfer

 Source Server         : bxy
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : tp_blog

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 17/01/2020 10:27:24
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tp_admin
-- ----------------------------
DROP TABLE IF EXISTS `tp_admin`;
CREATE TABLE `tp_admin`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '昵称',
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '0禁用1启用',
  `is_super` enum('0','1') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '0普通管理员1超级管理员',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_admin
-- ----------------------------
INSERT INTO `tp_admin` VALUES (1, 'admin', '123456', '海若有因', '2694645542@qq.com', '1', '1', 1575291349, 1575530927, NULL);
INSERT INTO `tp_admin` VALUES (2, 'user', '123456', '海里寻因', '2694645542@qq.com', '0', '0', 1575021381, 1575021381, NULL);
INSERT INTO `tp_admin` VALUES (3, 'bxy', '1234567', '无枝可依', 'b2694645542@163.com', '0', '0', 1575045926, 1575531159, NULL);

-- ----------------------------
-- Table structure for tp_article
-- ----------------------------
DROP TABLE IF EXISTS `tp_article`;
CREATE TABLE `tp_article`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '概要',
  `tags` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签',
  `content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `is_top` enum('1','0') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '0不推荐1推荐',
  `cate_id` int(11) NOT NULL COMMENT '所属导航id',
  `click` int(20) NULL DEFAULT 0 COMMENT '点击量',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_article
-- ----------------------------
INSERT INTO `tp_article` VALUES (1, '赏金', '如何学习php', 'php是编辑网站的首选语言', 'php|学习php方法', '<p>php是一门简单易学，容易掌握的语言<strong>，好好学</strong><br/></p>', '1', 2, 1, 1575280998, 1575535565, NULL);
INSERT INTO `tp_article` VALUES (2, '赏金', '如何学习java', 'java是做后端的首选语言', 'java|学习java方法', '<p>java是一门简单易学，容易掌握的语言<br/></p>', '1', 3, 2, 1575281069, 1575287205, NULL);
INSERT INTO `tp_article` VALUES (3, '赏金', '如何学习javaEE', 'javaEE很适合做前端', 'javaEE|学习javaEE方法', '<p><span style=\"font-family: 微软雅黑, &quot;Microsoft YaHei&quot;;\"><em>javaEE是java中很重要的一部分<img src=\"http://img.baidu.com/hi/ldw/w_0003.gif\"/></em><br/></span></p>', '1', 1, 41, 1575289064, 1575289175, NULL);
INSERT INTO `tp_article` VALUES (4, '小智', '如何学习C语言', 'C语言很有用处', 'C|C语言学习', '<p><em>C语言是所有语言中排行前几 的语言，学习难度大，但很实用，</em><em><span style=\"border: 1px solid rgb(0, 0, 0);\">建议学习，</span></em><br/></p><p><em><img src=\"/ueditor/php/upload/image/20191206/1575642303.jpg\" title=\"1575642303.jpg\" alt=\"0.jpg\"/></em></p>', '1', 4, 12, 1575642313, 1575642626, NULL);

-- ----------------------------
-- Table structure for tp_cate
-- ----------------------------
DROP TABLE IF EXISTS `tp_cate`;
CREATE TABLE `tp_cate`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catename` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '导航名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_cate
-- ----------------------------
INSERT INTO `tp_cate` VALUES (1, 'JavaEE', 1, 1575169866, 1575289175, NULL);
INSERT INTO `tp_cate` VALUES (2, 'PHP', 2, 1575171130, 1575273255, NULL);
INSERT INTO `tp_cate` VALUES (3, 'Java', 3, 1575273949, 1575273949, NULL);
INSERT INTO `tp_cate` VALUES (4, 'C', 4, 1575273963, 1575274010, NULL);

-- ----------------------------
-- Table structure for tp_comment
-- ----------------------------
DROP TABLE IF EXISTS `tp_comment`;
CREATE TABLE `tp_comment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '评论内容',
  `article_id` int(11) NOT NULL COMMENT '评论文章id',
  `member_id` int(11) NOT NULL COMMENT '用户id',
  `create_time` int(11) NOT NULL COMMENT '评论时间',
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_comment
-- ----------------------------
INSERT INTO `tp_comment` VALUES (1, '很好看', 1, 1, 1575045926, 1575535566, NULL);
INSERT INTO `tp_comment` VALUES (2, '不错', 2, 1, 1575045926, 1575535566, NULL);
INSERT INTO `tp_comment` VALUES (3, '建议看', 3, 1, 1575045926, 1575535566, NULL);
INSERT INTO `tp_comment` VALUES (4, '讲的很好，感谢！', 3, 1, 1575640866, 1575640866, NULL);
INSERT INTO `tp_comment` VALUES (5, '感谢博主的分享！', 3, 1, 1575641392, 1575641392, NULL);
INSERT INTO `tp_comment` VALUES (6, '好好学！', 4, 1, 1575642668, 1575642668, NULL);

-- ----------------------------
-- Table structure for tp_member
-- ----------------------------
DROP TABLE IF EXISTS `tp_member`;
CREATE TABLE `tp_member`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '会员账号',
  `password` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '昵称',
  `email` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_member
-- ----------------------------
INSERT INTO `tp_member` VALUES (1, '孤芳自赏', '1234567', '小可爱', '2694645542@qq.com', 1575291349, 1575533727, NULL);
INSERT INTO `tp_member` VALUES (2, '无枝可依', '123456', '一曲相思愁', 'b2694645542@163.com', 1575635505, 1575635505, NULL);

-- ----------------------------
-- Table structure for tp_system
-- ----------------------------
DROP TABLE IF EXISTS `tp_system`;
CREATE TABLE `tp_system`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `webname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站名称',
  `copyright` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '版权信息',
  `create_time` int(11) NOT NULL COMMENT '设置时间',
  `update_time` int(11) NOT NULL,
  `delete_time` int(11) NULL DEFAULT NULL COMMENT '软删除',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tp_system
-- ----------------------------
INSERT INTO `tp_system` VALUES (1, '我的博客', 'tpblog.cn', 1575535565, 1575537783, NULL);

SET FOREIGN_KEY_CHECKS = 1;
