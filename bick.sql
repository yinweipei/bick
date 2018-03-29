-- phpMyAdmin SQL Dump
-- version 4.4.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2018-03-29 22:55:17
-- 服务器版本： 5.6.28
-- PHP Version: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bick`
--

-- --------------------------------------------------------

--
-- 表的结构 `bk_admin`
--

CREATE TABLE IF NOT EXISTS `bk_admin` (
  `id` mediumint(9) NOT NULL COMMENT '管理员id',
  `name` varchar(30) NOT NULL COMMENT '管理员名称',
  `password` char(32) NOT NULL COMMENT '管理员密码'
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_admin`
--

INSERT INTO `bk_admin` (`id`, `name`, `password`) VALUES
(1, 'admin00', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- 表的结构 `bk_article`
--

CREATE TABLE IF NOT EXISTS `bk_article` (
  `id` mediumint(9) NOT NULL COMMENT '文章id',
  `title` varchar(60) NOT NULL COMMENT '文章标题',
  `keywords` varchar(100) NOT NULL COMMENT '关键词',
  `desc` varchar(255) NOT NULL COMMENT '描述',
  `author` varchar(30) NOT NULL COMMENT '作者',
  `thumb` varchar(160) NOT NULL,
  `content` text NOT NULL COMMENT '内容',
  `click` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点击数',
  `zan` mediumint(9) NOT NULL DEFAULT '0' COMMENT '点赞数',
  `time` int(11) NOT NULL COMMENT '发布时间',
  `cateid` mediumint(9) NOT NULL COMMENT '所属栏目'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_article`
--

INSERT INTO `bk_article` (`id`, `title`, `keywords`, `desc`, `author`, `thumb`, `content`, `click`, `zan`, `time`, `cateid`) VALUES
(2, '当前发顺', '大王，打书', '大王打书', '大王', '/bick/public\\uploads/20180319\\6c2f6fd0ffcdb904e56df157810e0736.png', '<p>大王打书！！！<br/></p>', 0, 0, 1521443168, 10),
(3, '修复BUG', '也是我', '还是我', '我', '/bick/public\\uploads/20171203\\b5537e27d8a06ae7809fc3c9572f18b1.jpg', '<p>1111111111111111113213123132111111111111112231231<br/></p>', 0, 0, 1512288441, 10);

-- --------------------------------------------------------

--
-- 表的结构 `bk_auth_group`
--

CREATE TABLE IF NOT EXISTS `bk_auth_group` (
  `id` mediumint(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_auth_group`
--

INSERT INTO `bk_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(1, '超级管理员', 1, '4,5,6,7'),
(2, '管理员', 1, '4,5,6');

-- --------------------------------------------------------

--
-- 表的结构 `bk_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `bk_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_auth_group_access`
--

INSERT INTO `bk_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(9, 1);

-- --------------------------------------------------------

--
-- 表的结构 `bk_auth_rule`
--

CREATE TABLE IF NOT EXISTS `bk_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` mediumint(9) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '0',
  `sort` int(5) NOT NULL DEFAULT '50'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_auth_rule`
--

INSERT INTO `bk_auth_rule` (`id`, `name`, `title`, `type`, `status`, `condition`, `pid`, `level`, `sort`) VALUES
(6, 'link/add', '添加链接', 1, 1, '', 5, 2, 50),
(5, 'link/lst', '链接列表', 1, 1, '', 4, 1, 50),
(7, 'link/edit', '修改链接', 1, 1, '', 5, 2, 50),
(4, 'link', '友情链接', 1, 1, '', 0, 0, 50);

-- --------------------------------------------------------

--
-- 表的结构 `bk_cate`
--

CREATE TABLE IF NOT EXISTS `bk_cate` (
  `id` mediumint(9) NOT NULL COMMENT '栏目id',
  `catename` varchar(30) NOT NULL COMMENT '栏目名称',
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:列表栏目 2:单页栏目3:图片列表',
  `pid` mediumint(9) NOT NULL DEFAULT '0' COMMENT '上级栏目id',
  `sort` mediumint(9) NOT NULL DEFAULT '50',
  `keywords` varchar(255) NOT NULL COMMENT '栏目关键字',
  `desc` varchar(255) NOT NULL COMMENT '栏目描述',
  `content` text NOT NULL COMMENT '栏目内容'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_cate`
--

INSERT INTO `bk_cate` (`id`, `catename`, `type`, `pid`, `sort`, `keywords`, `desc`, `content`) VALUES
(8, '华盛顿', 1, 2, 4, '', '', ''),
(2, '美国', 2, 0, 3, '', '', ''),
(9, '中国', 3, 0, 1, '', '', ''),
(10, '河南', 1, 9, 2, '河南，牡丹花，字画', '河南是个好地方', '<p>111111111111111<br/></p>');

-- --------------------------------------------------------

--
-- 表的结构 `bk_conf`
--

CREATE TABLE IF NOT EXISTS `bk_conf` (
  `id` mediumint(9) NOT NULL COMMENT '配置项id',
  `cnname` varchar(50) NOT NULL COMMENT '配置中文名称',
  `enname` varchar(50) NOT NULL COMMENT '英文名称',
  `type` tinyint(1) NOT NULL DEFAULT '1' COMMENT '配置类型1：单行文章框2：文本域3：单选按钮4：复选按钮5：下拉菜单',
  `value` varchar(255) NOT NULL DEFAULT '' COMMENT '配置值',
  `values` varchar(255) NOT NULL COMMENT '配置可选值',
  `sort` smallint(6) NOT NULL DEFAULT '50' COMMENT '排序'
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_conf`
--

INSERT INTO `bk_conf` (`id`, `cnname`, `enname`, `type`, `value`, `values`, `sort`) VALUES
(1, '中国', 'china', 1, '中国人', '111222', 54),
(5, '擦火车', 'car', 1, '哈哈哈', '奥,迪', 50),
(3, '站点描述', 'desc', 2, '  1111111                                                                                                                                                                                                                                                      ', 'ada', 52),
(4, '站点关键字', 'keywords', 4, '', '', 51),
(6, '开启缓存', 'cache', 3, '是', '是,否', 50);

-- --------------------------------------------------------

--
-- 表的结构 `bk_link`
--

CREATE TABLE IF NOT EXISTS `bk_link` (
  `id` int(11) NOT NULL COMMENT '链接id',
  `title` varchar(60) NOT NULL COMMENT '链接标题',
  `desc` varchar(255) NOT NULL COMMENT '链接描述',
  `url` varchar(160) NOT NULL COMMENT '链接地址',
  `sort` mediumint(9) NOT NULL DEFAULT '50' COMMENT '链接排序'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bk_link`
--

INSERT INTO `bk_link` (`id`, `title`, `desc`, `url`, `sort`) VALUES
(2, '搜狐', 'erww', 'http://www.shouhu.com', 2),
(3, '慕课网', '最大的IT教育网站', 'http://www.imooc.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bk_admin`
--
ALTER TABLE `bk_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_article`
--
ALTER TABLE `bk_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_auth_group`
--
ALTER TABLE `bk_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_auth_group_access`
--
ALTER TABLE `bk_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `bk_auth_rule`
--
ALTER TABLE `bk_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_cate`
--
ALTER TABLE `bk_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_conf`
--
ALTER TABLE `bk_conf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bk_link`
--
ALTER TABLE `bk_link`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bk_admin`
--
ALTER TABLE `bk_admin`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '管理员id',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bk_article`
--
ALTER TABLE `bk_article`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '文章id',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `bk_auth_group`
--
ALTER TABLE `bk_auth_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bk_auth_rule`
--
ALTER TABLE `bk_auth_rule`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `bk_cate`
--
ALTER TABLE `bk_cate`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '栏目id',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `bk_conf`
--
ALTER TABLE `bk_conf`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT COMMENT '配置项id',AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `bk_link`
--
ALTER TABLE `bk_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '链接id',AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
