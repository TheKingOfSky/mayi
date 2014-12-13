-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2014 年 12 月 02 日 03:39
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 数据库: `mayi`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `action`
-- 

CREATE TABLE `action` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` int(11) NOT NULL COMMENT '用户ID',
  `action` varchar(16) NOT NULL COMMENT '行为',
  `object_id` int(11) NOT NULL COMMENT '对象id',
  `object_type` varchar(16) NOT NULL COMMENT '对象类型',
  `action_time` int(11) NOT NULL COMMENT '动态时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='动态表、用户行为表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `action`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `comments`
-- 

CREATE TABLE `comments` (
  `cmt_id` int(11) NOT NULL auto_increment,
  `u_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `zan` int(11) NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY  (`cmt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻评论表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `comments`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `favorite`
-- 

CREATE TABLE `favorite` (
  `id` int(11) NOT NULL auto_increment,
  `object_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `favorite_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `object_id` (`object_id`,`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='收藏表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `favorite`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `mood`
-- 

CREATE TABLE `mood` (
  `mood_id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL COMMENT '心情名',
  `description` varchar(256) NOT NULL COMMENT '描述',
  `hot` int(11) NOT NULL COMMENT '标签热度',
  PRIMARY KEY  (`mood_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='心情表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `mood`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `news`
-- 

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(256) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `u_id` int(11) NOT NULL COMMENT '作者ID',
  `reply` int(11) NOT NULL COMMENT '评论条数',
  `favorite` int(11) NOT NULL COMMENT '收藏数',
  `share` int(11) NOT NULL COMMENT '分享次数',
  `pv` int(11) NOT NULL COMMENT '阅读次数',
  `face` varchar(128) NOT NULL COMMENT '标签',
  `createtime` int(11) NOT NULL COMMENT '展示图',
  `status` tinyint(1) NOT NULL COMMENT '创建时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻表(Important)' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `news`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `notice`
-- 

CREATE TABLE `notice` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `zan` int(11) NOT NULL,
  `comments` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `u_id` (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `notice`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `notice_comments`
-- 

CREATE TABLE `notice_comments` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `u_id` (`u_id`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='帖子评论表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `notice_comments`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `recommand`
-- 

CREATE TABLE `recommand` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(256) NOT NULL COMMENT '标题',
  `description` varchar(256) NOT NULL COMMENT '描述',
  `object_id` int(11) NOT NULL COMMENT '对象ID,跳转用',
  `object_type` int(11) NOT NULL COMMENT '类型',
  `position` varchar(32) NOT NULL COMMENT '推荐位置',
  `u_id` int(11) NOT NULL COMMENT '推荐人,管理员ID',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `start_time` int(11) NOT NULL COMMENT '开始时间',
  `end_time` int(11) NOT NULL COMMENT '失效时间',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='推荐表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `recommand`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `rewards`
-- 

CREATE TABLE `rewards` (
  `id` int(11) NOT NULL auto_increment,
  `u_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `goods_id` int(11) NOT NULL,
  `rewards_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `u_id` (`u_id`,`object_id`,`goods_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='打赏表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `rewards`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `subscribe`
-- 

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL auto_increment,
  `object_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `subscribe_time` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `object_id` (`object_id`,`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='订阅表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `subscribe`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tags`
-- 

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL auto_increment COMMENT '标签ID',
  `name` int(11) NOT NULL COMMENT '标签名',
  `description` varchar(128) NOT NULL COMMENT '描述',
  `hot` int(11) NOT NULL COMMENT '标签热度',
  `mood_id` int(11) NOT NULL COMMENT '心情ID',
  PRIMARY KEY  (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标签表' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `tags`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `tags_news`
-- 

CREATE TABLE `tags_news` (
  `tag_id` int(11) NOT NULL COMMENT '标签ID',
  `news_id` int(11) NOT NULL COMMENT '新闻ID',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='新闻、标签关联表';

-- 
-- 导出表中的数据 `tags_news`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `user`
-- 

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(64) NOT NULL COMMENT '用户名',
  `password` varchar(32) NOT NULL COMMENT '密码',
  `nickname` varchar(64) NOT NULL COMMENT '昵称',
  `mobile` varchar(11) NOT NULL COMMENT '手机',
  `email` varchar(64) NOT NULL COMMENT '邮箱',
  `avatar` varchar(64) NOT NULL COMMENT '头像',
  `score` int(11) NOT NULL COMMENT '积分',
  `we_media` tinyint(1) NOT NULL COMMENT '是否是自媒体人',
  `create_ip` varchar(16) NOT NULL COMMENT '创建IP',
  `last_ip` varchar(16) NOT NULL COMMENT '最后一次登录IP',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `last_time` int(11) NOT NULL COMMENT '最后一次登录时间',
  `permission` int(11) NOT NULL default '0' COMMENT '权限',
  `status` int(11) NOT NULL default '0' COMMENT '状态',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表((Important))' AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `user`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `user_profile`
-- 

CREATE TABLE `user_profile` (
  `u_id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mobile` varchar(16) NOT NULL,
  `country` int(11) NOT NULL,
  `province` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` varchar(256) NOT NULL,
  `idcard` varchar(16) NOT NULL,
  `idcard_image` varchar(64) NOT NULL,
  `profile` text NOT NULL COMMENT '简介',
  PRIMARY KEY  (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户详情表';

-- 
-- 导出表中的数据 `user_profile`
-- 

