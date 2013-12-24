/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : eshop

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-12-24 23:02:39
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `esp_category`
-- ----------------------------
DROP TABLE IF EXISTS `esp_category`;
CREATE TABLE `esp_category` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `parent_id` int(5) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `full_url` varchar(255) DEFAULT NULL,
  `content` text,
  `title_menu` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `sort` int(5) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_category
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_delivery`
-- ----------------------------
DROP TABLE IF EXISTS `esp_delivery`;
CREATE TABLE `esp_delivery` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `cost` float DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_delivery
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_discount`
-- ----------------------------
DROP TABLE IF EXISTS `esp_discount`;
CREATE TABLE `esp_discount` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_discount
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_order`
-- ----------------------------
DROP TABLE IF EXISTS `esp_order`;
CREATE TABLE `esp_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_content` text,
  `summ` float DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `delivery_id` int(3) DEFAULT NULL,
  `delivery_cost` float DEFAULT NULL,
  `payment_id` int(3) DEFAULT NULL,
  `status_id` int(3) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `closing_date` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `comment` text,
  `legal_info` varchar(255) DEFAULT NULL,
  `confirm` tinyint(1) DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_order
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_order_status`
-- ----------------------------
DROP TABLE IF EXISTS `esp_order_status`;
CREATE TABLE `esp_order_status` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_order_status
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_page`
-- ----------------------------
DROP TABLE IF EXISTS `esp_page`;
CREATE TABLE `esp_page` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `parent_id` int(5) DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `full_url` varchar(255) DEFAULT NULL,
  `content` text,
  `title_menu` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `sort` int(5) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of esp_page
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_payment`
-- ----------------------------
DROP TABLE IF EXISTS `esp_payment`;
CREATE TABLE `esp_payment` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `param_array` varchar(255) DEFAULT NULL,
  `url_array` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_payment
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_product`
-- ----------------------------
DROP TABLE IF EXISTS `esp_product`;
CREATE TABLE `esp_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(5) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `full_url` varchar(255) DEFAULT NULL,
  `description` text,
  `article` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT '-1',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `old_price` float DEFAULT '0',
  `recommended` tinyint(1) DEFAULT '0',
  `novelty` tinyint(1) DEFAULT '0',
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_product
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_role`
-- ----------------------------
DROP TABLE IF EXISTS `esp_role`;
CREATE TABLE `esp_role` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_role
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_setting`
-- ----------------------------
DROP TABLE IF EXISTS `esp_setting`;
CREATE TABLE `esp_setting` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_setting
-- ----------------------------

-- ----------------------------
-- Table structure for `esp_user`
-- ----------------------------
DROP TABLE IF EXISTS `esp_user`;
CREATE TABLE `esp_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(3) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `created` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of esp_user
-- ----------------------------
