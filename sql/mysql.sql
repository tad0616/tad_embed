CREATE TABLE `tad_embed` (
  `ebsn` smallint(6) unsigned NOT NULL auto_increment COMMENT '流水號',
  `blockid` smallint(6) unsigned NOT NULL COMMENT '區塊編號',
  `width` varchar(255) NOT NULL COMMENT '寬度',
  `height` varchar(255) NOT NULL COMMENT '高度',
  `border` enum('1','0') NOT NULL COMMENT '框線',
  `note` text NOT NULL COMMENT '備註',
  `title` varchar(255) NOT NULL COMMENT '標題',
  `options` text NOT NULL COMMENT '區塊設定',
  `scrolling` ENUM( 'no', 'yes', 'auto' ) NOT NULL COMMENT '秀出捲軸',
  `uid` mediumint(8) unsigned NOT NULL COMMENT '建立者',
  `update_date` datetime NOT NULL COMMENT '最後使用日期',
  `http_referer` VARCHAR( 255 ) NOT NULL COMMENT '最後來源',
  `counter` mediumint(9) unsigned NOT NULL COMMENT '計數',
PRIMARY KEY (`ebsn`)
) ENGINE=MyISAM;
