<!--More template, game, mod, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/-->
<!--Code Ucenter Home GoHooH Full - Full mod - full game - full skin hack by GoHooH.CoM-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cài đặt Ucenter Home 2.0 full mod by GoHooH.CoM</title>
</head>
<body>
<h1><a href="http://www.gohooh.com/" target="_blank">Cài đặt Ucenter Home 2.0 full mod by GoHooH.CoM</a></h1>
<?php
include_once('../common.php');
$tablepre = $_SC['tablepre'];
$charset = $_SC['charset'];//str_replace('-', '', $_SC['charset']);
if($charset=="utf-8" OR $charset=="UTF-8"){
	$charset = "utf8";
}
$type = mysql_get_server_info() > '4.1' ? " ENGINE=MYISAM".(empty($charset)?'':" DEFAULT CHARSET=$charset" ): " TYPE=MYISAM";
$sql=array();
$sql[]="DROP TABLE IF EXISTS `".$tablepre."plug_newfarm`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."plug_newfarm` (
`uid` mediumint(8) unsigned NOT NULL default '0',
  `username` varchar(20) NOT NULL,
  `farmlandstatus` text NOT NULL,
  `animal` text NOT NULL,
  `taskid` int(2) NOT NULL default '1',
  `charm` int(10) NOT NULL default '0',
  `money` int(10) NOT NULL default '0',
  `fb` int(10) NOT NULL default '0',
  `exp` int(10) NOT NULL default '0',
  `mc_exp` int(10) NOT NULL default '0',
  `reclaim` smallint(2) NOT NULL default '6',
  `package` text NOT NULL,
  `mc_package` text NOT NULL,
  `fertilizer` text NOT NULL,
  `decorative` text NOT NULL,
  `fruit` text NOT NULL,
  `dog` text NOT NULL,
  `nosegay` text NOT NULL,
  `message` text NOT NULL,
  `mc_taskid` int(2) NOT NULL default '0',
  `wenzi` text NOT NULL,
  `bad` int(10) NOT NULL default '0',
  `mc_chat` text NOT NULL,
  `repertory` text NOT NULL,
  `parade` text NOT NULL,
  `dabian` tinyint(3) NOT NULL default '0',
  `badtime` int(11) NOT NULL default '0',
  `sfeedleft` int(10) NOT NULL default '0',
  `levelup` int(10) NOT NULL default '200',
  `activity` int(2) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."plug_newfarm_logs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."plug_newfarm_logs` (
`id` int(11) NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `count` tinyint(4) NOT NULL,
  `fromid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `cropid` int(11) NOT NULL,
  `isread` int(11) NOT NULL,
  `counts` text NOT NULL,
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."plug_newfarm_mclogs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."plug_newfarm_mclogs` (
  `id` int(11) NOT NULL auto_increment,
  `type` tinyint(4) NOT NULL,
  `uid` int(11) NOT NULL,
  `fromid` int(11) NOT NULL,
  `count` text character set utf8 NOT NULL,
  `iid` text character set utf8 NOT NULL,
  `money` text character set utf8 NOT NULL,
  `isread` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."plug_newfarm_vip`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."plug_newfarm_vip` (
  `uid` int(10) unsigned NOT NULL auto_increment,
  `level` tinyint(3) unsigned NOT NULL default '1',
  `vipstatus` tinyint(3) unsigned NOT NULL default '0',
  `validtime` int(10) unsigned NOT NULL default '0',
  `jointime` int(10) unsigned NOT NULL default '0',
  `vippoint` int(10) unsigned NOT NULL default '0',
  `endtime` int(10) unsigned NOT NULL default '0',
  `rsign` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."happyfarm_nc`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."happyfarm_nc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `Status` text NOT NULL,
  `reclaim` int(11) NOT NULL DEFAULT '6',
  `exp` int(11) NOT NULL DEFAULT '0',
  `taskid` int(11) NOT NULL DEFAULT '0',
  `package` text,
  `fruit` text,
  `tools` text,
  `decorative` text,
  `dog` text,
  `Weed` text,
  `pest` text,
  `water` text,
  `badnum` int(11) NOT NULL DEFAULT '50',
  `activeItem` int(11) NOT NULL DEFAULT '90001',
  `repertory` text NOT NULL,
  `log` text NOT NULL,
  `healthmode` text NOT NULL,
  `chris` INT NOT NULL DEFAULT '0',
  `zong` INT3 NOT NULL DEFAULT '0',
  `mc_a` tinyint(3) unsigned NOT NULL default '0',
  `nc_d` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."happyfarm_mc`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."happyfarm_mc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `Status` text NOT NULL,
  `exp` int(11) DEFAULT '0',
  `taskid` int(11) NOT NULL,
  `package` text NOT NULL,
  `tools` text NOT NULL,
  `decorative` text NOT NULL,
  `bad` text NOT NULL,
  `badnum` int(11) NOT NULL,
  `badtime` int(11) NOT NULL DEFAULT '0',
  `parade` text NOT NULL,
  `repertory` text NOT NULL,
  `dabian` tinyint(4) NOT NULL,
  `sfeedleft` INT NOT NULL DEFAULT '30',
  `zong` INT3 NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."happyfarm_config`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."happyfarm_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `username` varchar(20) NOT NULL,
  `money` int(11) DEFAULT '0',
  `YB` int(11) DEFAULT '0',
  `JB` int(11) DEFAULT '0',
  `Message` text NOT NULL,
  `setting1` text NOT NULL,
  `setting2` text NOT NULL,
  `setting3` text NOT NULL,
  `setting4` text NOT NULL,
  `setting5` text NOT NULL,
  `setting6` text NOT NULL,
  `pf` int(11) DEFAULT '0',
  `vip` int(11) DEFAULT '1',
  `tianqi` INT( 11 ) NOT NULL DEFAULT '1',
  `exchange` text NOT NULL,
  PRIMARY KEY (`id`) 
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."happyfarm_mclogs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."happyfarm_mclogs` (
 `id` int(11) NOT NULL AUTO_INCREMENT,          
 `type` tinyint(4) NOT NULL,                         
 `uid` int(11) NOT NULL,                             
 `fromid` int(11) NOT NULL,                          
 `count` text NOT NULL,           
 `iid` text NOT NULL,             
 `money` text NOT NULL,           
 `isread` int(11) NOT NULL,                          
 `time` int(11) NOT NULL,                            
  PRIMARY KEY (`id`)      
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."cron`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."cron` (
  `cronid` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) NOT NULL DEFAULT '0',
  `type` enum('user','system') NOT NULL DEFAULT 'user',
  `name` char(50) NOT NULL DEFAULT '',
  `filename` char(50) NOT NULL DEFAULT '',
  `lastrun` int(10) unsigned NOT NULL DEFAULT '0',
  `nextrun` int(10) unsigned NOT NULL DEFAULT '0',
  `weekday` tinyint(1) NOT NULL DEFAULT '0',
  `day` tinyint(2) NOT NULL DEFAULT '0',
  `hour` tinyint(2) NOT NULL DEFAULT '0',
  `minute` char(36) NOT NULL DEFAULT '',
  PRIMARY KEY (`cronid`),
  KEY `nextrun` (`available`,`nextrun`)    
) ".$type.";";
$sql[] = "
INSERT INTO `".$tablepre."cron` (`cronid`, `available`, `type`, `name`, `filename`, `lastrun`, `nextrun`, `weekday`, `day`, `hour`, `minute`) VALUES
(1, 1, 'system', 'Cập nhật số liệu thống kê', 'log.php', 1288174804, 1288175100, -1, -1, -1, '0	5	10	15	20	25	30	35	40	45	50	55'),
(2, 1, 'system', 'Xóa feed', 'cleanfeed.php', 1288174807, 1288206240, -1, -1, 3, '4'),
(3, 1, 'system', 'Xóa thông báo cá nhân', 'cleannotification.php', 1288175242, 1288213560, -1, -1, 5, '6'),
(4, 1, 'system', 'Nhận feed', 'getfeed.php', 1288174730, 1288174730, -1, -1, -1, '2	7	12	17	22	27	32	37	42	47	52'),
(5, 1, 'system', 'Xóa dấu vết truy cập mới nhất', 'cleantrace.php', 1288174730, 1288174730, -1, -1, 2, '3'),
(6, 1, 'user', 'Nhiệm vụ hàng ngày', 'nhiemvuhangngay.php', 1288174756, 1288177200, -1, -1, -1, '0'),
(7, 1, 'user', 'Nông trại vui vẻ', 'nongtraivuive.php', 1288016529, 1289232000, -1, 9, -1, '0'),
(8, 1, 'user', 'Nắng', 'nang.php', 1288016551, 1289059200, -1, 7, -1, '0'),
(9, 1, 'user', 'Mưa', 'mua.php', 1288016572, 1288195200, 4, -1, -1, '0')
";	
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_market`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_market` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` mediumint(8) NOT NULL DEFAULT '0',
  `cname` text NOT NULL,
  `cnumber` mediumint(8) NOT NULL DEFAULT '0',
  `cprice` int(10) NOT NULL DEFAULT '0',
  `mclass` smallint(4) NOT NULL DEFAULT '0',
  `selluid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)     
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_mc`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_mc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `status` text NOT NULL,
  `exp` int(11) DEFAULT '0',
  `taskid` tinyint(2) NOT NULL DEFAULT '0',
  `goods` text NOT NULL,
  `package` text NOT NULL,
  `tools` text NOT NULL,
  `feed` text NOT NULL,
  `decorative` text NOT NULL,
  `bad` text NOT NULL,
  `badnum` int(11) NOT NULL,
  `badtime` int(11) NOT NULL DEFAULT '0',
  `parade` text NOT NULL,
  `repertory` text NOT NULL,
  `dabian` tinyint(4) NOT NULL,
  `sfeedleft` int(11) NOT NULL DEFAULT '30',
  `mclock` text NOT NULL,
  `zong` mediumint(9) NOT NULL DEFAULT '0',
  `randtime` int(11) DEFAULT '0',
  `enemy` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)    
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_mclogs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_mclogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `fromid` int(11) NOT NULL,
  `count` text NOT NULL,
  `iid` text NOT NULL,
  `money` text NOT NULL,
  `isread` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_message`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `toid` int(11) NOT NULL,
  `toname` varchar(50) DEFAULT '',
  `fromid` int(11) NOT NULL,
  `fromname` varchar(50) DEFAULT '',
  `msg` text NOT NULL,
  `time` int(11) NOT NULL,
  `isreply` tinyint(2) DEFAULT '0',
  `isread` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_nc`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_nc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `status` text NOT NULL,
  `reclaim` tinyint(2) NOT NULL DEFAULT '6',
  `redland` tinyint(2) NOT NULL DEFAULT '0',
  `exp` int(11) NOT NULL DEFAULT '0',
  `taskid` tinyint(2) NOT NULL DEFAULT '0',
  `package` text,
  `flower` text NOT NULL,
  `fruit` text,
  `tools` text,
  `decorative` text,
  `dog` text,
  `weed` text,
  `pest` text,
  `badnum` tinyint(2) NOT NULL DEFAULT '50',
  `activeItem` int(6) NOT NULL DEFAULT '90001',
  `repertory` text NOT NULL,
  `tips` text NOT NULL,
  `healthmode` text NOT NULL,
  `chris` int(11) NOT NULL DEFAULT '0',
  `zong` mediumint(9) NOT NULL DEFAULT '0',
  `nc_e` tinyint(1) NOT NULL DEFAULT '1',
  `levelup` int(11) NOT NULL DEFAULT '200',
  `randtime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_nclogs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_nclogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `count` int(11) NOT NULL,
  `fromid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `cropid` int(11) NOT NULL,
  `isread` int(11) NOT NULL,
  `counts` text NOT NULL,
  `money` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."qqfarm_user`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."qqfarm_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL DEFAULT '0',
  `password` char(32) NOT NULL,
  `regname` char(18) NOT NULL,
  `username` char(24) NOT NULL,
  `money` int(11) DEFAULT '0',
  `yb` int(11) DEFAULT '0',
  `vip` text NOT NULL,
  `pf` tinyint(1) DEFAULT '0',
  `tianqi` tinyint(1) NOT NULL DEFAULT '1',
  `visittime` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."fish_ui`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."fish_ui` (
	uid int(11) NOT NULL default '0',
	password char(20) not null,
	regname char(20) not null,
	username char(20) not null,
	exp int(11) NOT NULL default '0',
	money int(11) NOT NULL default '0',
	yb int(11) NOT NULL default '0',
	bstatus text NOT NULL,
	reclaim int(2) default '6',
	decorative text NOT NULL,
	fruit text NOT NULL,
	package text NOT NULL,
	tools text NOT NULL,
	repertory text NOT NULL,
	lucktime int(11) NOT NULL default '0',
	dog text NOT NULL,
	fr text NOT NULL,
	putk text NOT NULL,
	putr text NOT NULL,
	tips text NOT NULL,
	randtime int(11) NOT NULL default '0',
	visittime int(11) NOT NULL default '0',
	PRIMARY KEY  (uid)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."fish_logs`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."fish_logs` (
	id int(11) NOT NULL auto_increment,
	uid int(11) NOT NULL,
	type tinyint(4) NOT NULL,
	count int(11) NOT NULL,
	fromid int(11) NOT NULL,
	time int(11) NOT NULL,
	cropid int(11) NOT NULL,
	isread int(11) NOT NULL, 
	counts text NOT NULL,
	money text NOT NULL,
	PRIMARY KEY  (id) 
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."app_game`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."app_game` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `type` enum('single','double') NOT NULL default 'single',
  `uid` int(11) NOT NULL,
  `score` int(8) NOT NULL,
  `gtime` int(10) NOT NULL,
  `game_id` smallint(4) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `game_id` (`game_id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_licenses`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_licenses` (
  `id` tinyint(3) NOT NULL auto_increment,
  `name` varchar(80) NOT NULL default '',
  `key` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_slave_history`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_history` (
  `id` int(10) NOT NULL auto_increment,
  `cat` tinyint(1) NOT NULL default '0',
  `taskid` mediumint(8) NOT NULL default '0',
  `uid` mediumint(8) NOT NULL default '0',
  `muid` mediumint(8) NOT NULL default '0',
  `message` text character set utf8 NOT NULL,
  `created` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_slave_main`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_main` (
  `id` int(10) NOT NULL auto_increment,
  `uid` mediumint(8) NOT NULL default '0',
  `username` varchar(15) character set utf8 NOT NULL default '',
  `nickname` varchar(50) character set utf8 NOT NULL default '',
  `aboutme` tinytext character set utf8 NOT NULL,
  `level` tinyint(2) NOT NULL default '0',
  `pvalue` int(10) NOT NULL default '0',
  `cash` int(10) NOT NULL default '0',
  `slave` mediumint(4) NOT NULL default '0',
  `collection` text character set utf8 NOT NULL,
  `uplineuid` mediumint(8) NOT NULL default '0',
  `health` tinyint(3) NOT NULL default '0',
  `education` tinyint(3) NOT NULL default '0',
  `experience` tinyint(3) NOT NULL default '0',
  `loyalty` tinyint(3) NOT NULL default '0',
  `mood` tinyint(3) NOT NULL default '0',
  `created` int(10) NOT NULL default '0',
  `updatetime` int(10) NOT NULL default '0',
  `discount` tinyint(1) NOT NULL default '0',
  `memail` tinyint(1) NOT NULL default '0',
  `mfeed` tinyint(1) NOT NULL default '1',
  `mnotice` tinyint(1) NOT NULL default '1',
  `semail` tinyint(1) NOT NULL default '0',
  `sfeed` tinyint(1) NOT NULL default '0',
  `snotice` tinyint(1) NOT NULL default '1',
  `friend` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_slave_luck`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_luck` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` mediumtext character set utf8 NOT NULL,
  `amount` varchar(8) character set utf8 NOT NULL default '',
  `range` mediumint(8) NOT NULL default '0',
  `percent` tinyint(3) NOT NULL default '0',
  `perday` tinyint(2) NOT NULL default '0',
  `education` char(3) NOT NULL default '',
  `experience` char(3) NOT NULL default '',
  `health` char(3) NOT NULL default '',
  `loyalty` char(3) NOT NULL default '',
  `mood` char(3) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[] = "
INSERT INTO `".$tablepre."com_slave_luck` (`id`, `name`, `amount`, `range`, `percent`, `perday`, `education`, `experience`, `health`, `loyalty`, `mood`) VALUES
(1, 'Ban nhặt được [money] đồng', '100', 50, 5, 1, '0', '0', '0', '0', '3'),
(2, 'An ninh không tốt, kẻ trộm vào nhà là cướp [money] đồng của bạn', '-3000', 2000, 1, 1, '0', '0', '0', '0', '-5'),
(3, 'Hôm nay bạn ghé tham siêu thị Goer và được thưởng [money] đồng', '500', 0, 100, 1, '1', '1', '1', '1', '1'),
(4, 'Xin chúc mừng, bạn đã trúng số với giải thưởng là [money] đồng', '10000', 5000, 1, 1, '0', '0', '0', '0', '10'),
(5, 'Vi phạm luật và bị cảnh sát phạt [money] đồng', '-500', 300, 2, 1, '0', '0', '0', '0', '-5'),
(6, 'Hôm nay NHÀ TUI thưởng cho bạn [money] đồng', '3000', 2000, 1, 1, '0', '10', '0', '5', '10'),
(7, 'Phạt không đóng tiền bảo hiểm [money] đồng', '-300', 200, 2, 1, '0', '0', '0', '0', '-3'),
(8, 'Bạn nhặt được điện thoại và trả lại cho chủ nên được thưởng [money] đồng', '300', 200, 2, 1, '0', '0', '0', '8', '5'),
(9, 'Hôm nay, bạn làm thêm kiếm được [money] đồng', '500', 300, 2, 1, '0', '5', '0', '0', '3'),
(10, 'Bạn cùng ăn tối với 1 người bạn lâu ngày không gặp và tốn [money] đồng', '-300', 180, 1, 1, '0', '0', '0', '0', '-3')
";	
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_slave_taskcat`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_taskcat` (
  `id` int(11) NOT NULL auto_increment,
  `seqno` tinyint(2) NOT NULL default '0',
  `catname` varchar(60) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) ".$type.";";
$sql[] = "
INSERT INTO `".$tablepre."com_slave_taskcat` (`id`, `seqno`, `catname`) VALUES
(1, 0, 'Học tập'),
(2, 1, 'Làm việc'),
(3, 2, 'Giải trí'),
(4, 3, 'Thưởng'),
(5, 4, 'Ưu đãi'),
(6, 5, 'Trừng phạt'),
(7, 6, 'Khác')
";	
$sql[]="DROP TABLE IF EXISTS `".$tablepre."com_slave_task`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_task` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` mediumtext character set utf8 NOT NULL,
  `mastertext` varchar(255) character set utf8 NOT NULL default '',
  `slavetext` varchar(255) character set utf8 NOT NULL default '',
  `mcash` mediumint(8) NOT NULL default '0',
  `catid` tinyint(2) NOT NULL default '0',
  `range` mediumint(8) NOT NULL default '0',
  `percent` tinyint(3) NOT NULL default '0',
  `perday` tinyint(2) NOT NULL default '0',
  `scash` mediumint(8) NOT NULL default '0',
  `education` tinyint(3) NOT NULL default '0',
  `experience` tinyint(3) NOT NULL default '0',
  `health` tinyint(3) NOT NULL default '0',
  `loyalty` tinyint(3) NOT NULL default '0',
  `mood` tinyint(3) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ".$type.";";
$sql[] = "
INSERT INTO `".$tablepre."com_slave_task` (`id`, `name`, `mastertext`, `slavetext`, `mcash`, `catid`, `range`, `percent`, `perday`, `scash`, `education`, `experience`, `health`, `loyalty`, `mood`) VALUES
(1, 'Gửi trang web', '[master] gửi [slave] đến siêu thị Goer. [slave] kiếm cho [master] [money] đồng', '', 200, 2, 99, 0, 1, 0, 0, 3, -5, -2, -2),
(2, 'Đi đến GoHooH', '[slave] đi theo [master]. [slave] kiếm cho [master] [money] đồng', '[slave] đi theo [master]. [slave] kiếm cho [master] [money] đồng', 500, 2, 499, 0, 1, 500, 0, 3, -3, -4, -3),
(3, 'Hát karaoke', '[master] dùng [money] đồng dẫn [slave] đi hát karaoke', '', -300, 3, 200, 0, 1, 0, 0, 0, 6, 2, 3),
(4, 'Buôn bán Goer', '[master] đi bán [slave] tốn 1 ngày', '', 0, 4, 0, 0, 1, 0, 0, 0, 2, 1, 1),
(5, 'Gửi đi học', '[master] dùng [money] đồng để gửi [slave] đi học điều dưỡng', '', -300, 1, 200, 0, 1, 0, 8, 0, 0, 3, 0),
(6, 'Trang phục đẹp', '[master] dùng [money] đồng mua quần áo cho [slave]', '', -200, 5, 99, 0, 1, 0, 0, 0, 0, 5, 3),
(7, 'Gửi đến nhà hát', '[master] gửi [slave] đến nhà hát. Nhưng [slave] làm cho khán giả sợ nên [master] bị phạt [money] đồng', '', -200, 2, 100, 0, 1, 0, 0, -1, -1, 0, -3),
(8, 'Học nấu ăn', '[master] gửi [slave] đi học nấu ăn', '', 0, 1, 0, 0, 1, 0, 2, 1, -1, 1, 0),
(9, 'Nấu ăn', '[master] yêu cầu [slave] nấu ăn', '', 0, 5, 0, 0, 1, 0, 0, 0, 2, 3, 3),
(10, 'Học giảng dạy nấu ăn', '[master] dùng [money] để [slave] học giảng dạy nấu ăn', '', -300, 1, 200, 0, 1, 0, 8, 3, -4, 0, 0),
(11, 'Học massage', '[master] dùng [money] đồng để cho [slave] học massage', '', -500, 1, 300, 0, 1, 0, 10, 8, -6, 0, 0),
(12, 'Học Quản trị tài chính', '[master] dùng [money] đồng để cho [slave] học quản trị tài chính', '', -400, 1, 200, 0, 1, 0, 8, 5, -2, 0, 0),
(13, 'Hướng dẫn', '[master] hướng dẫn [slave]', '', 0, 1, 0, 0, 1, 0, 3, 2, 0, 0, 0),
(14, 'Quét dọn', '[master] gửi [slave] đi quét dọn nhà hàng xóm để kiếm tiền. Kết quả là [slave] bị trộm tiền', '', 0, 2, 0, 0, 1, 0, 0, -5, 0, -3, -5),
(15, 'Làm ở Cty Vệ sinh', '[master] gửi [slave] đi làm trong cộng ty vệ sinh môi trường. [slave] kiếm cho [master] [money] đồng', '', 300, 2, 100, 0, 1, 0, 0, 4, -3, -5, -2),
(16, 'Xem phim', '[master] dùng [money] đồng cho [slave] đi xem phim', '', -200, 3, 100, 0, 1, 0, 0, 0, 4, 2, 3),
(17, 'Đi bar', '[master] dùng [money] đồng để cho [slave] đi bar', '', -300, 3, 200, 0, 1, 0, 0, 0, 6, 3, 5),
(18, 'Đánh cầu lông', '[master] cùng [slave] đánh cầu lông', '', 0, 3, 0, 0, 1, 0, 0, 0, 2, 0, 3),
(19, 'Tự do', '[master] cho [slave] được đi chơi tư do 1 ngày', '', 0, 4, 0, 0, 1, 0, 0, 0, 5, 3, 3),
(20, 'Ăn sáng', '[master] mời [slave] ăn sáng', '', 0, 4, 0, 0, 1, 0, 0, 0, 3, 3, 5),
(21, 'Ngủ trưa', '[master] cho [slave] ngủ trưa 1 tiếng', '', 0, 4, 0, 0, 0, 0, 0, 0, 6, 3, 4),
(22, 'Xem TV', '[master] cho [slave] xem TV 2 tiếng', '', 0, 4, 0, 0, 1, 0, 0, 0, 5, 3, 4),
(23, 'Phần thưởng', '[slave] làm việc hiệu quả nên được [master] thưởng 1 con gà', '', 0, 5, 0, 0, 1, 0, 0, 0, 0, 5, 3),
(24, 'Tâm trạng tốt', '[master] có tâm trạng tốt nên thưởng [money] đồng cho [slave]', '', -100, 5, 50, 0, 0, 50, 0, 0, 0, 10, 8),
(25, 'Phạt tiền', '[slave] bị [master] trừ [money] đồng', '', 100, 6, 50, 0, 1, -100, 0, 0, 0, -5, -8),
(26, 'Không cần quét dọn', '[slave] không cần quét don hôm nay. [master] đã tự làm', '', 0, 6, 0, 0, 1, 0, 0, 0, 0, -3, -5),
(27, 'Học tập', '[master] yêu cầu [slave] học tập chăm chỉ', '', 0, 6, 0, 0, 1, 0, 0, 0, 0, -3, -5),
(28, 'Cấm nói', '[slave] nhiều chuyện nên bị [master] phạt cấm nói 3 ngày', '', 0, 6, 0, 0, 0, 0, 0, 0, 0, -3, -5),
(29, 'Chủ sở hữu', '[master] gửi [slave] cho chủ sở hữu', '', 0, 6, 0, 0, 0, 0, 0, 0, 0, -5, -3),
(30, 'Mất trộm', '[slave] ăn trộm tiền và [master] phải nuôi chó để canh gác', '', 0, 6, 0, 0, 0, 0, 0, 0, 0, -5, -8),
(31, 'Khóa lương', '[slave] làm mất đồng hồ quí của [master] nên bị trừ [money] đồng tiền lương', '', 500, 6, 300, 0, 1, -500, 0, 0, 0, -10, -20),
(32, 'Tình nguyện viên', '[master] gửi [slave] đi làm tình nguyện viên cho GoHooH.CoM', '', 0, 7, 0, 0, 0, 0, 0, 0, 0, 2, 5),
(33, 'Thi hoa hậu', '[master] dùng [money] đồng để cho [slave] đi thi hoa hậu', '', -500, 7, 200, 0, 1, 0, 0, 0, 0, -1, -5)
";	
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_carinfo`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_carinfo` (
  `CarID` int(10) NOT NULL auto_increment,
  `CarDesc` varchar(50) NOT NULL default '',
  `CarImg` varchar(255)  NOT NULL default '',
  `CarImgBig` varchar(255) NOT NULL default '',
  `CarColor` tinyint(2) NOT NULL default '0',
  `CarPrice` int(10) NOT NULL default '0',
  `CarNum` smallint(4) NOT NULL default '0',
  `CarType` tinyint(2) NOT NULL default '0',
  `CarMaxSpeed` smallint(4) NOT NULL default '0',
  `CarLevel` tinyint(2) NOT NULL default '0',
  `CarCredit` int(10) NOT NULL default '0',
  `CarSign` varchar(255)  NOT NULL default '',
  `CarSID` smallint(4) NOT NULL default '0',
  `CarImgMid` varchar(255) default NULL,
  PRIMARY KEY  (`CarID`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_member`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_member` (
  `uid` int(10) NOT NULL,
  `P_bg` varchar(255) NOT NULL,
  `P_bgdesc` varchar(10) NOT NULL,
  `P_credit` int(10) NOT NULL,
  `P_lot_free` tinyint(1) NOT NULL,
  `P_lot_color` tinyint(1) NOT NULL,
  `P_lot_1` int(10) NOT NULL,
  `P_lot_2` int(10) NOT NULL,
  `P_lot_3` int(10) NOT NULL,
  `P_lot_4` int(10) NOT NULL,
  `LimitType` tinyint(1) NOT NULL,
  `P_lot_type` smallint(4) NOT NULL,
  `P_lot_level` smallint(4) NOT NULL,
  `P_logintime` varchar(10) NOT NULL,
  `P_stageID` int(10) NOT NULL,
	PRIMARY KEY  (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_memberset`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_memberset` (
  `uid` int(10) NOT NULL,
  `StopFeed` tinyint(1) NOT NULL default '1',
  `StopNote` tinyint(1) NOT NULL default '1',
  `WarnFeed` tinyint(1) NOT NULL default '1',
  `WarnNote` tinyint(1) NOT NULL default '1',
  `MessFeed` tinyint(1) NOT NULL default '1',
  `MessNote` tinyint(1) NOT NULL default '1',
  `StageFeed` tinyint(1) NOT NULL default '1',
  `StageNote` tinyint(1) NOT NULL default '1',
  `BuyFeed` tinyint(1) NOT NULL default '1',
  `BuyNote` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_mycar`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_mycar` (
  `ID` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `CarID` int(4) NOT NULL,
  `BuyTime` datetime NOT NULL,
  `BuyCredit` int(10) NOT NULL,
  `ParkWhoUid` int(10) NOT NULL,
  `ParkLot` tinyint(1) NOT NULL,
  `isSale` tinyint(1) NOT NULL,
  PRIMARY KEY  (`ID`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_mystage`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_mystage` (
  `ID` int(10) NOT NULL auto_increment,
  `uid` int(10) NOT NULL,
  `StageID` int(10) NOT NULL,
  `MyUse` int(10) NOT NULL,
  `BuyTime` datetime NOT NULL,
  PRIMARY KEY  (`ID`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_record`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_record` (
  `RID` int(10) NOT NULL auto_increment,
  `CarID` int(4) NOT NULL,
  `ParkUid` int(10) NOT NULL,
  `ParkWhoUid` int(10) NOT NULL,
  `Parklot` tinyint(1) NOT NULL,
  `ParkStartTime` datetime NOT NULL,
  `ParkEndTime` datetime NOT NULL,
  `ParkCredit` int(10) NOT NULL,
  `ParkStatus` tinyint(1) NOT NULL,
  `ParkWarned` tinyint(1) NOT NULL,
  `ParkMess` tinyint(1) NOT NULL,
  `ParkPunish` int(1) NOT NULL,
  PRIMARY KEY  (`RID`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_stage`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_stage` (
  `StageID` int(4) NOT NULL auto_increment,
  `StageName` varchar(50)  NOT NULL,
  `StageImg` varchar(255)  NOT NULL,
  `StagePrice` bigint(10) NOT NULL,
  `StageIntr` varchar(255)  NOT NULL,
  `StageScript` varchar(255)  NOT NULL,
  `StageType` tinyint(1) NOT NULL,
  `StageUse` int(10) NOT NULL,
  `noAjax` tinyint(1) NOT NULL,
  `noOpen` tinyint(1) NOT NULL,
  PRIMARY KEY  (`StageID`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."park_warn`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."park_warn` (
  `ID` int(10) NOT NULL auto_increment,
  `RID` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `WarnTime` datetime NOT NULL,
  PRIMARY KEY  (`ID`),
  KEY `RID` (`RID`),
  KEY `uid` (`uid`)
) ".$type.";";
$sql[] = "
INSERT INTO `".$tablepre."park_carinfo` (`CarID`, `CarDesc`, `CarImg`, `CarImgBig`, `CarColor`, `CarPrice`, `CarNum`, `CarType`, `CarMaxSpeed`, `CarLevel`, `CarCredit`, `CarSign`, `CarSID`, `CarImgMid`) VALUES
(1, 'Alto', 'park/carimg/1224864425CarImg.swf', 'park/carimg/1224990834CarImgbig.gif', 4, 16000, 100, 1, 120, 1, 2, 'park/carimg/1223649966CarSign.gif', 100, ''),
(6, 'Jeep Compass', 'park/carimg/1223622500CarImg.swf', 'park/carimg/1223622500CarImgbig.gif', 7, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622500CarSign.gif', 208, 'park/carimg/1224657749CarImgMid.gif'),
(7, 'Jeep Compass', 'park/carimg/1223622620CarImg.swf', 'park/carimg/1223622620CarImgbig.gif', 4, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622620CarSign.gif', 208, NULL),
(8, 'Jeep Compass', 'park/carimg/1223622659CarImg.swf', 'park/carimg/1223622659CarImgbig.gif', 4, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622659CarSign.gif', 208, NULL),
(9, 'Jeep Compass', 'park/carimg/1223622710CarImg.swf', 'park/carimg/1223622710CarImgbig.gif', 4, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622710CarSign.gif', 208, NULL),
(10, 'Jeep Compass', 'park/carimg/1223622771CarImg.swf', 'park/carimg/1223622771CarImgbig.gif', 5, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622771CarSign.gif', 208, NULL),
(11, 'Jeep Compass', 'park/carimg/1223622823CarImg.swf', 'park/carimg/1223622823CarImgbig.gif', 3, 290000, 0, 3, 220, 3, 4, 'park/carimg/1223622823CarSign.gif', 208, NULL),
(12, 'Mini-Cooper', 'park/carimg/1223623120CarImg.swf', 'park/carimg/1223623120CarImgbig.gif', 2, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623120CarSign.gif', 103, NULL),
(13, 'Mini-Cooper', 'park/carimg/1223623181CarImg.swf', 'park/carimg/1223623181CarImgbig.gif', 4, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623181CarSign.gif', 103, NULL),
(14, 'Mini-Cooper', 'park/carimg/1223623211CarImg.swf', 'park/carimg/1223623211CarImgbig.gif', 1, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623211CarSign.gif', 103, NULL),
(15, 'Mini-Cooper', 'park/carimg/1223623239CarImg.swf', 'park/carimg/1223623239CarImgbig.gif', 6, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623239CarSign.gif', 103, 'park/carimg/1224655893CarImgMid.gif'),
(16, 'Mini-Cooper', 'park/carimg/1223623275CarImg.swf', 'park/carimg/1223623275CarImgbig.gif', 5, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623275CarSign.gif', 103, NULL),
(17, 'Mini-Cooper', 'park/carimg/1223623305CarImg.swf', 'park/carimg/1223623305CarImgbig.gif', 3, 32000, 0, 1, 140, 1, 2, 'park/carimg/1223623305CarSign.gif', 103, NULL),
(18, 'POLO', 'park/carimg/1223623677CarImg.swf', 'park/carimg/1223623677CarImgbig.gif', 2, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623677CarSign.gif', 112, NULL),
(19, 'POLO', 'park/carimg/1223623727CarImg.swf', 'park/carimg/1223623727CarImgbig.gif', 4, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623727CarSign.gif', 112, 'park/carimg/1224656200CarImgMid.gif'),
(20, 'POLO', 'park/carimg/1223623769CarImg.swf', 'park/carimg/1223623769CarImgbig.gif', 1, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623769CarSign.gif', 112, NULL),
(21, 'POLO', 'park/carimg/1223623864CarImg.swf', 'park/carimg/1223623864CarImgbig.gif', 6, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623864CarSign.gif', 112, NULL),
(22, 'POLO', 'park/carimg/1223623901CarImg.swf', 'park/carimg/1223623901CarImgbig.gif', 5, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623901CarSign.gif', 112, NULL),
(23, 'POLO', 'park/carimg/1223623932CarImg.swf', 'park/carimg/1223623932CarImgbig.gif', 3, 91000, 0, 1, 200, 1, 2, 'park/carimg/1223623932CarSign.gif', 112, NULL),
(24, 'PTCruiser', 'park/carimg/1223624071CarImg.swf', 'park/carimg/1223624071CarImgbig.gif', 2, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624071CarSign.gif', 204, NULL),
(25, 'PTCruiser', 'park/carimg/1223624114CarImg.swf', 'park/carimg/1223624114CarImgbig.gif', 4, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624114CarSign.gif', 204, NULL),
(26, 'PTCruiser', 'park/carimg/1223624147CarImg.swf', 'park/carimg/1223624147CarImgbig.gif', 1, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624147CarSign.gif', 204, 'park/carimg/1224657609CarImgMid.gif'),
(27, 'PTCruiser', 'park/carimg/1223624188CarImg.swf', 'park/carimg/1223624188CarImgbig.gif', 6, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624188CarSign.gif', 204, NULL),
(28, 'PTCruiser', 'park/carimg/1223624241CarImg.swf', 'park/carimg/1223624241CarImgbig.gif', 5, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624241CarSign.gif', 204, NULL),
(29, 'PTCruiser', 'park/carimg/1223624281CarImg.swf', 'park/carimg/1223624281CarImgbig.gif', 3, 239900, 0, 3, 220, 3, 4, 'park/carimg/1223624281CarSign.gif', 204, NULL),
(30, 'RIMOR', 'park/carimg/1223625715CarImg.swf', 'park/carimg/1223625715CarImgbig.gif', 2, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625716CarSign.gif', 1005, NULL),
(31, 'RIMOR', 'park/carimg/1223625749CarImg.swf', 'park/carimg/1223625749CarImgbig.gif', 4, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625749CarSign.gif', 1005, NULL),
(32, 'RIMOR', 'park/carimg/1223625787CarImg.swf', 'park/carimg/1223625787CarImgbig.gif', 1, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625787CarSign.gif', 1005, NULL),
(33, 'RIMOR', 'park/carimg/1223625821CarImg.swf', 'park/carimg/1223625821CarImgbig.gif', 6, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625821CarSign.gif', 1005, 'park/carimg/1224658279CarImgMid.gif'),
(34, 'RIMOR', 'park/carimg/1223625884CarImg.swf', 'park/carimg/1223625884CarImgbig.gif', 5, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625884CarSign.gif', 1005, NULL),
(35, 'RIMOR', 'park/carimg/1223625920CarImg.swf', 'park/carimg/1223625920CarImgbig.gif', 3, 1500000, 0, 5, 260, 10, 10, 'park/carimg/1223625920CarSign.gif', 1005, NULL),
(36, 'S-MAX', 'park/carimg/1223626107CarImg.swf', 'park/carimg/1223626107CarImgbig.gif', 2, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626107CarSign.gif', 200, NULL),
(37, 'S-MAX', 'park/carimg/1223626191CarImg.swf', 'park/carimg/1223626191CarImgbig.gif', 4, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626191CarSign.gif', 200, NULL),
(38, 'S-MAX', 'park/carimg/1223626237CarImg.swf', 'park/carimg/1223626237CarImgbig.gif', 1, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626237CarSign.gif', 200, NULL),
(39, 'S-MAX', 'park/carimg/1223626275CarImg.swf', 'park/carimg/1223626275CarImgbig.gif', 6, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626275CarSign.gif', 200, NULL),
(40, 'S-MAX', 'park/carimg/1223626326CarImg.swf', 'park/carimg/1223626326CarImgbig.gif', 5, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626326CarSign.gif', 200, NULL),
(41, 'S-MAX', 'park/carimg/1223626375CarImg.swf', 'park/carimg/1223626375CarImgbig.gif', 3, 219800, 0, 3, 220, 3, 4, 'park/carimg/1223626375CarSign.gif', 200, 'park/carimg/1224657151CarImgMid.gif'),
(42, 'SPARK', 'park/carimg/1223628273CarImg.swf', 'park/carimg/1223628273CarImgbig.gif', 2, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628273CarSign.gif', 401, NULL),
(43, 'SPARK', 'park/carimg/1223628451CarImg.swf', 'park/carimg/1223628451CarImgbig.gif', 4, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628451CarSign.gif', 401, NULL),
(44, 'SPARK', 'park/carimg/1223628488CarImg.swf', 'park/carimg/1223628488CarImgbig.gif', 1, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628488CarSign.gif', 401, NULL),
(45, 'SPARK', 'park/carimg/1223628542CarImg.swf', 'park/carimg/1223628542CarImgbig.gif', 6, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628542CarSign.gif', 401, NULL),
(46, 'SPARK', 'park/carimg/1223628565CarImg.swf', 'park/carimg/1223628565CarImgbig.gif', 5, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628565CarSign.gif', 401, 'park/carimg/1224657860CarImgMid.gif'),
(47, 'SPARK', 'park/carimg/1223628592CarImg.swf', 'park/carimg/1223628592CarImgbig.gif', 3, 458000, 0, 0, 260, 4, 5, 'park/carimg/1223628592CarSign.gif', 401, NULL),
(48, 'Audi A4', 'park/carimg/1223628677CarImg.swf', 'park/carimg/1223628677CarImgbig.gif', 2, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223628677CarSign.gif', 207, NULL),
(49, 'Audi A4', 'park/carimg/1223628716CarImg.swf', 'park/carimg/1223628716CarImgbig.gif', 4, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223628716CarSign.gif', 207, NULL),
(51, 'Audi A4', 'park/carimg/1223628911CarImg.swf', 'park/carimg/1223628911CarImgbig.gif', 1, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223628911CarSign.gif', 207, NULL),
(52, 'Audi A4', 'park/carimg/1223629015CarImg.swf', 'park/carimg/1223629015CarImgbig.gif', 6, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223629015CarSign.gif', 207, NULL),
(53, 'Audi A4', 'park/carimg/1223629103CarImg.swf', 'park/carimg/1223629103CarImgbig.gif', 5, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223629103CarSign.gif', 207, NULL),
(54, 'Audi A4', 'park/carimg/1223629129CarImg.swf', 'park/carimg/1223629129CarImgbig.gif', 3, 280000, 0, 0, 260, 2, 3, 'park/carimg/1223629129CarSign.gif', 207, 'park/carimg/1224657723CarImgMid.gif'),
(55, 'Audi A6', 'park/carimg/1223629256CarImg.swf', 'park/carimg/1223629256CarImgbig.gif', 2, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629256CarSign.gif', 601, NULL),
(56, 'Audi A6', 'park/carimg/1223629298CarImg.swf', 'park/carimg/1223629298CarImgbig.gif', 4, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629298CarSign.gif', 601, 'park/carimg/1224657940CarImgMid.gif'),
(57, 'Audi A6', 'park/carimg/1223629345CarImg.swf', 'park/carimg/1223629345CarImgbig.gif', 1, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629345CarSign.gif', 601, NULL),
(58, 'Audi A6', 'park/carimg/1223629404CarImg.swf', 'park/carimg/1223629404CarImgbig.gif', 6, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629404CarSign.gif', 601, NULL),
(59, 'Audi A6', 'park/carimg/1223629493CarImg.swf', 'park/carimg/1223629493CarImgbig.gif', 5, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629493CarSign.gif', 601, NULL),
(440, 'Audi Q7', 'park/carimg/1224990790CarImg.swf', 'park/carimg/1224990790CarImgbig.gif', 4, 1232000, 0, 4, 280, 10, 13, 'park/carimg/1224990790CarSign.gif', 1201, 'park/carimg/1224990790CarImgMid.gif'),
(61, 'Audi A6', 'park/carimg/1223629531CarImg.swf', 'park/carimg/1223629531CarImgbig.gif', 3, 620000, 0, 0, 280, 6, 7, 'park/carimg/1223629531CarSign.gif', 601, NULL),
(62, 'Audi Q7', 'park/carimg/1223629610CarImg.swf', 'park/carimg/1223629610CarImgbig.gif', 2, 1232000, 0, 0, 280, 12, 13, 'park/carimg/1223629610CarSign.gif', 1201, NULL),
(63, 'Audi Q7', 'park/carimg/1223629677CarImg.swf', 'park/carimg/1223629677CarImgbig.gif', 1, 1232000, 0, 0, 280, 12, 13, 'park/carimg/1223629677CarSign.gif', 1201, NULL),
(64, 'Audi Q7', 'park/carimg/1223629696CarImg.swf', 'park/carimg/1223629696CarImgbig.gif', 6, 1232000, 0, 0, 280, 12, 13, 'park/carimg/1223629696CarSign.gif', 1201, NULL),
(65, 'Audi Q7', 'park/carimg/1223629712CarImg.swf', 'park/carimg/1224990524CarImgbig.gif', 5, 1232000, 0, 0, 280, 0, 13, 'park/carimg/1223629712CarSign.gif', 1201, ''),
(66, 'Audi Q7', 'park/carimg/1223629906CarImg.swf', 'park/carimg/1223629906CarImgbig.gif', 3, 1232000, 0, 4, 280, 10, 13, 'park/carimg/1223629906CarSign.gif', 1201, 'park/carimg/1224658102CarImgMid.gif'),
(67, 'Audi R8', 'park/carimg/1223630040CarImg.swf', 'park/carimg/1223630040CarImgbig.gif', 2, 1599000, 0, 0, 300, 15, 16, 'park/carimg/1223630040CarSign.gif', 1501, NULL),
(68, 'Audi R8', 'park/carimg/1223630081CarImg.swf', 'park/carimg/1223630081CarImgbig.gif', 4, 1599000, 0, 0, 300, 15, 16, 'park/carimg/1223630081CarSign.gif', 1501, NULL),
(69, 'Audi R8', 'park/carimg/1223630109CarImg.swf', 'park/carimg/1223630109CarImgbig.gif', 1, 1599000, 0, 0, 300, 15, 16, 'park/carimg/1223630109CarSign.gif', 1501, NULL),
(70, 'Audi R8', 'park/carimg/1223630132CarImg.swf', 'park/carimg/1223630132CarImgbig.gif', 6, 1599000, 0, 0, 300, 15, 16, 'park/carimg/1223630132CarSign.gif', 1501, NULL),
(71, 'Audi R8', 'park/carimg/1223630160CarImg.swf', 'park/carimg/1223630160CarImgbig.gif', 5, 1599000, 0, 0, 300, 15, 16, 'park/carimg/1223630160CarSign.gif', 1501, NULL),
(72, 'Audi R8', 'park/carimg/1223630180CarImg.swf', 'park/carimg/1223630180CarImgbig.gif', 3, 1599000, 0, 0, 300, 0, 16, 'park/carimg/1223630180CarSign.gif', 1501, 'park/carimg/1224658386CarImgMid.gif'),
(73, 'Audi TT', 'park/carimg/1223630305CarImg.swf', 'park/carimg/1223630305CarImgbig.gif', 2, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630305CarSign.gif', 602, 'park/carimg/1224657961CarImgMid.gif'),
(74, 'Audi TT', 'park/carimg/1223630328CarImg.swf', 'park/carimg/1223630328CarImgbig.gif', 4, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630328CarSign.gif', 602, NULL),
(75, 'Audi TT', 'park/carimg/1223630349CarImg.swf', 'park/carimg/1223630349CarImgbig.gif', 1, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630349CarSign.gif', 602, NULL),
(76, 'Audi TT', 'park/carimg/1223630376CarImg.swf', 'park/carimg/1223630376CarImgbig.gif', 6, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630376CarSign.gif', 602, NULL),
(77, 'Audi TT', 'park/carimg/1223630402CarImg.swf', 'park/carimg/1223630402CarImgbig.gif', 5, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630402CarSign.gif', 602, NULL),
(78, 'Audi TT', 'park/carimg/1223630432CarImg.swf', 'park/carimg/1223630432CarImgbig.gif', 3, 645000, 0, 0, 240, 6, 7, 'park/carimg/1223630432CarSign.gif', 602, NULL),
(79, 'Alto SC7081B', 'park/carimg/1223630514CarImg.swf', 'park/carimg/1223630514CarImgbig.gif', 2, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630514CarSign.gif', 101, NULL),
(80, 'Alto SC7081B', 'park/carimg/1223630542CarImg.swf', 'park/carimg/1223630542CarImgbig.gif', 4, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630542CarSign.gif', 101, NULL),
(81, 'Alto SC7081B', 'park/carimg/1223630559CarImg.swf', 'park/carimg/1223630559CarImgbig.gif', 1, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630559CarSign.gif', 101, 'park/carimg/1224655779CarImgMid.gif'),
(82, 'Alto SC7081B', 'park/carimg/1223630584CarImg.swf', 'park/carimg/1223630584CarImgbig.gif', 6, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630584CarSign.gif', 101, NULL),
(83, 'Alto SC7081B', 'park/carimg/1223630669CarImg.swf', 'park/carimg/1223630669CarImgbig.gif', 5, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630669CarSign.gif', 101, NULL),
(84, 'Alto SC7081B', 'park/carimg/1223630689CarImg.swf', 'park/carimg/1223630689CarImgbig.gif', 3, 20000, 0, 1, 140, 2, 3, 'park/carimg/1223630689CarSign.gif', 101, NULL),
(85, 'BORA', 'park/carimg/1223630755CarImg.swf', 'park/carimg/1223630755CarImgbig.gif', 2, 116000, 0, 0, 160, 1, 2, 'park/carimg/1223630755CarSign.gif', 116, NULL),
(87, 'BORA', 'park/carimg/1223630828CarImg.swf', 'park/carimg/1223630828CarImgbig.gif', 4, 116000, 0, 0, 160, 1, 2, 'park/carimg/1223630828CarSign.gif', 116, NULL),
(88, 'BORA', 'park/carimg/1223630850CarImg.swf', 'park/carimg/1223630850CarImgbig.gif', 1, 116000, 0, 0, 160, 1, 2, 'park/carimg/1223630850CarSign.gif', 116, NULL),
(89, 'BORA', 'park/carimg/1223630872CarImg.swf', 'park/carimg/1223630872CarImgbig.gif', 6, 116000, 0, 0, 160, 1, 2, 'park/carimg/1223630872CarSign.gif', 116, NULL),
(90, 'BORA', 'park/carimg/1223630892CarImg.swf', 'park/carimg/1223630892CarImgbig.gif', 5, 116000, 0, 0, 160, 1, 2, 'park/carimg/1223630892CarSign.gif', 116, 'park/carimg/1224656374CarImgMid.gif'),
(91, 'BORA', 'park/carimg/1223630911CarImg.swf', 'park/carimg/1223630911CarImgbig.gif', 3, 116000, 0, 1, 160, 1, 2, 'park/carimg/1223630911CarSign.gif', 116, NULL),
(92, 'BMW 320', 'park/carimg/1223631003CarImg.swf', 'park/carimg/1223631003CarImgbig.gif', 2, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631003CarSign.gif', 302, NULL),
(93, 'BMW 320', 'park/carimg/1223631025CarImg.swf', 'park/carimg/1223631025CarImgbig.gif', 4, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631025CarSign.gif', 302, NULL),
(94, 'BMW 320', 'park/carimg/1223631145CarImg.swf', 'park/carimg/1223631145CarImgbig.gif', 1, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631145CarSign.gif', 302, 'park/carimg/1224657811CarImgMid.gif'),
(95, 'BMW 320', 'park/carimg/1223631167CarImg.swf', 'park/carimg/1223631167CarImgbig.gif', 6, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631167CarSign.gif', 302, NULL),
(96, 'BMW 320', 'park/carimg/1223631265CarImg.swf', 'park/carimg/1223631265CarImgbig.gif', 5, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631265CarSign.gif', 302, NULL),
(97, 'BMW 320', 'park/carimg/1223631283CarImg.swf', 'park/carimg/1223631283CarImgbig.gif', 3, 330000, 0, 0, 240, 3, 4, 'park/carimg/1223631283CarSign.gif', 302, NULL),
(98, 'BMW 730', 'park/carimg/1223631353CarImg.swf', 'park/carimg/1223631353CarImgbig.gif', 2, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631353CarSign.gif', 1001, NULL),
(99, 'BMW 730', 'park/carimg/1223631380CarImg.swf', 'park/carimg/1223631380CarImgbig.gif', 4, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631380CarSign.gif', 1001, NULL),
(100, 'BMW 730', 'park/carimg/1223631401CarImg.swf', 'park/carimg/1223631401CarImgbig.gif', 1, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631401CarSign.gif', 1001, NULL),
(101, 'BMW 730', 'park/carimg/1223631435CarImg.swf', 'park/carimg/1223631435CarImgbig.gif', 6, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631435CarSign.gif', 1001, NULL),
(102, 'BMW 730', 'park/carimg/1223631455CarImg.swf', 'park/carimg/1223631455CarImgbig.gif', 5, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631455CarSign.gif', 1001, 'park/carimg/1224658059CarImgMid.gif'),
(103, 'BMW 730', 'park/carimg/1223631480CarImg.swf', 'park/carimg/1223631480CarImgbig.gif', 3, 1080000, 0, 0, 300, 10, 11, 'park/carimg/1223631480CarSign.gif', 1001, NULL),
(104, 'BMW X5', 'park/carimg/1223631581CarImg.swf', 'park/carimg/1223631581CarImgbig.gif', 4, 1336000, 0, 0, 300, 0, 14, 'park/carimg/1223631581CarSign.gif', 1302, 'park/carimg/1224658198CarImgMid.gif'),
(105, 'BMW X5', 'park/carimg/1223631597CarImg.swf', 'park/carimg/1223631597CarImgbig.gif', 1, 1336000, 0, 0, 300, 13, 14, 'park/carimg/1223631597CarSign.gif', 1302, NULL),
(106, 'BMW X5', 'park/carimg/1223631619CarImg.swf', 'park/carimg/1223631619CarImgbig.gif', 6, 1336000, 0, 0, 300, 13, 14, 'park/carimg/1223631619CarSign.gif', 1302, NULL),
(107, 'BMW X5', 'park/carimg/1223631635CarImg.swf', 'park/carimg/1223631635CarImgbig.gif', 5, 1336000, 0, 0, 300, 13, 14, 'park/carimg/1223631635CarSign.gif', 1302, NULL),
(108, 'BMW X5', 'park/carimg/1223631655CarImg.swf', 'park/carimg/1223631655CarImgbig.gif', 3, 1336000, 0, 0, 300, 13, 14, 'park/carimg/1223631655CarSign.gif', 1302, NULL),
(109, 'BMW Z4', 'park/carimg/1224990407CarImg.swf', 'park/carimg/1224990118CarImgbig.gif', 3, 568000, 0, 0, 280, 5, 6, 'park/carimg/1223631757CarSign.gif', 502, ''),
(110, 'BMW Z4', 'park/carimg/1224990239CarImg.swf', 'park/carimg/1223633856CarImgbig.gif', 2, 568000, 0, 0, 260, 5, 6, 'park/carimg/1223633856CarSign.gif', 502, ''),
(111, 'BMW Z4', 'park/carimg/1223633879CarImg.swf', 'park/carimg/1223633879CarImgbig.gif', 4, 568000, 0, 0, 260, 5, 6, 'park/carimg/1223633879CarSign.gif', 502, NULL),
(112, 'BMW Z4', 'park/carimg/1223633896CarImg.swf', 'park/carimg/1223633896CarImgbig.gif', 1, 568000, 0, 0, 260, 5, 6, 'park/carimg/1223633896CarSign.gif', 502, 'park/carimg/1224657911CarImgMid.gif'),
(113, 'BMW Z4', 'park/carimg/1223633918CarImg.swf', 'park/carimg/1223633918CarImgbig.gif', 6, 568000, 0, 0, 260, 5, 6, 'park/carimg/1223633918CarSign.gif', 502, NULL),
(114, 'BMW Z4', 'park/carimg/1223633934CarImg.swf', 'park/carimg/1223633934CarImgbig.gif', 5, 568000, 0, 0, 260, 5, 6, 'park/carimg/1223633934CarSign.gif', 502, NULL),
(115, 'Porsche 911', 'park/carimg/1223634031CarImg.swf', 'park/carimg/1223634031CarImgbig.gif', 2, 1500000, 0, 0, 300, 15, 16, 'park/carimg/1223634031CarSign.gif', 1503, NULL),
(116, 'Porsche 911', 'park/carimg/1223634048CarImg.swf', 'park/carimg/1223634048CarImgbig.gif', 4, 1500000, 0, 0, 300, 15, 16, 'park/carimg/1223634048CarSign.gif', 1503, NULL),
(117, 'Porsche 911', 'park/carimg/1223634068CarImg.swf', 'park/carimg/1223634068CarImgbig.gif', 1, 1500000, 0, 0, 300, 15, 16, 'park/carimg/1223634068CarSign.gif', 1503, NULL),
(118, 'Porsche 911', 'park/carimg/1223634085CarImg.swf', 'park/carimg/1223634085CarImgbig.gif', 6, 1500000, 0, 0, 300, 0, 16, 'park/carimg/1223634085CarSign.gif', 1503, 'park/carimg/1224658308CarImgMid.gif'),
(119, 'Porsche 911', 'park/carimg/1223634112CarImg.swf', 'park/carimg/1223634112CarImgbig.gif', 5, 1500000, 0, 0, 300, 15, 16, 'park/carimg/1223634112CarSign.gif', 1503, NULL),
(120, 'Porsche 911', 'park/carimg/1223634127CarImg.swf', 'park/carimg/1223634127CarImgbig.gif', 3, 1500000, 0, 0, 300, 15, 16, 'park/carimg/1223634127CarSign.gif', 1503, NULL),
(121, 'Cayenne', 'park/carimg/1223634179CarImg.swf', 'park/carimg/1223634179CarImgbig.gif', 2, 1520000, 0, 0, 300, 15, 16, 'park/carimg/1223634179CarSign.gif', 1504, NULL),
(122, 'Cayenne', 'park/carimg/1223634237CarImg.swf', 'park/carimg/1223634237CarImgbig.gif', 4, 1520000, 0, 0, 300, 15, 16, 'park/carimg/1223634237CarSign.gif', 1504, NULL),
(123, 'Cayenne', 'park/carimg/1223634288CarImg.swf', 'park/carimg/1223634288CarImgbig.gif', 1, 1520000, 0, 0, 300, 15, 16, 'park/carimg/1223634288CarSign.gif', 1504, NULL),
(124, 'Cayenne', 'park/carimg/1223634307CarImg.swf', 'park/carimg/1223634307CarImgbig.gif', 6, 1520000, 0, 0, 300, 15, 16, 'park/carimg/1223634307CarSign.gif', 1504, NULL),
(125, 'Cayenne', 'park/carimg/1223634323CarImg.swf', 'park/carimg/1223634323CarImgbig.gif', 5, 1520000, 0, 0, 300, 0, 16, 'park/carimg/1223634323CarSign.gif', 1504, 'park/carimg/1224658326CarImgMid.gif'),
(126, 'Cayenne', 'park/carimg/1223634343CarImg.swf', 'park/carimg/1223634343CarImgbig.gif', 3, 1520000, 0, 0, 300, 15, 16, 'park/carimg/1223634343CarSign.gif', 1504, NULL),
(127, 'Benz S600', 'park/carimg/1223634415CarImg.swf', 'park/carimg/1223634415CarImgbig.gif', 2, 2000000, 0, 0, 300, 20, 21, 'park/carimg/1223634415CarSign.gif', 2001, NULL),
(128, 'Benz S600', 'park/carimg/1223634442CarImg.swf', 'park/carimg/1223634442CarImgbig.gif', 4, 2000000, 0, 0, 300, 0, 21, 'park/carimg/1223634442CarSign.gif', 2001, 'park/carimg/1224658441CarImgMid.gif'),
(129, 'Benz S600', 'park/carimg/1223634456CarImg.swf', 'park/carimg/1223634456CarImgbig.gif', 1, 2000000, 0, 0, 300, 20, 21, 'park/carimg/1223634456CarSign.gif', 2001, NULL),
(130, 'Benz S600', 'park/carimg/1223634468CarImg.swf', 'park/carimg/1223634468CarImgbig.gif', 6, 2000000, 0, 0, 300, 20, 21, 'park/carimg/1223634468CarSign.gif', 2001, NULL),
(131, 'Benz S600', 'park/carimg/1223634483CarImg.swf', 'park/carimg/1223634483CarImgbig.gif', 5, 2000000, 0, 0, 300, 20, 21, 'park/carimg/1223634483CarSign.gif', 2001, NULL),
(132, 'Benz S600', 'park/carimg/1223634500CarImg.swf', 'park/carimg/1223634500CarImgbig.gif', 3, 2000000, 0, 0, 300, 20, 21, 'park/carimg/1223634500CarSign.gif', 2001, NULL),
(133, 'Benz Bus', 'park/carimg/1223634894CarImg.swf', 'park/carimg/1223634894CarImgbig.gif', 2, 2500000, 0, 0, 300, 25, 26, 'park/carimg/1223634894CarSign.gif', 2501, NULL),
(134, 'Benz Bus', 'park/carimg/1223634930CarImg.swf', 'park/carimg/1223634930CarImgbig.gif', 4, 2500000, 0, 0, 300, 25, 26, 'park/carimg/1223634930CarSign.gif', 2501, NULL),
(135, 'Benz Bus', 'park/carimg/1223634947CarImg.swf', 'park/carimg/1223634947CarImgbig.gif', 1, 2500000, 0, 0, 300, 25, 26, 'park/carimg/1223634947CarSign.gif', 2501, NULL),
(136, 'Benz Bus', 'park/carimg/1223634970CarImg.swf', 'park/carimg/1223634970CarImgbig.gif', 6, 2500000, 0, 0, 300, 25, 26, 'park/carimg/1223634970CarSign.gif', 2501, NULL),
(137, 'Benz Bus', 'park/carimg/1223634990CarImg.swf', 'park/carimg/1223634990CarImgbig.gif', 5, 2500000, 0, 0, 300, 0, 26, 'park/carimg/1223634990CarSign.gif', 2501, 'park/carimg/1224658502CarImgMid.gif'),
(138, 'Benz Bus', 'park/carimg/1223635006CarImg.swf', 'park/carimg/1223635006CarImgbig.gif', 3, 2500000, 0, 0, 300, 25, 26, 'park/carimg/1223635006CarSign.gif', 2501, NULL),
(139, 'Honda CIVIC', 'park/carimg/1223647001CarImg.swf', 'park/carimg/1223647001CarImgbig.gif', 2, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647001CarSign.gif', 123, NULL),
(140, 'Honda CIVIC', 'park/carimg/1223647025CarImg.swf', 'park/carimg/1223647025CarImgbig.gif', 4, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647025CarSign.gif', 123, NULL),
(141, 'Honda CIVIC', 'park/carimg/1223647072CarImg.swf', 'park/carimg/1223647072CarImgbig.gif', 1, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647072CarSign.gif', 123, NULL),
(142, 'Honda CIVIC', 'park/carimg/1223647104CarImg.swf', 'park/carimg/1223647104CarImgbig.gif', 6, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647104CarSign.gif', 123, 'park/carimg/1224656808CarImgMid.gif'),
(143, 'Honda CIVIC', 'park/carimg/1223647126CarImg.swf', 'park/carimg/1223647126CarImgbig.gif', 5, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647126CarSign.gif', 123, NULL),
(144, 'Honda CIVIC', 'park/carimg/1223647158CarImg.swf', 'park/carimg/1223647158CarImgbig.gif', 3, 140000, 0, 1, 140, 1, 2, 'park/carimg/1223647158CarSign.gif', 123, NULL),
(145, 'Peugeot 206', 'park/carimg/1223647707CarImg.swf', 'park/carimg/1223647707CarImgbig.gif', 4, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223647707CarSign.gif', 107, NULL),
(146, 'Peugeot 206', 'park/carimg/1223647954CarImg.swf', 'park/carimg/1223647954CarImgbig.gif', 2, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223647954CarSign.gif', 107, NULL),
(147, 'Peugeot 206', 'park/carimg/1223648025CarImg.swf', 'park/carimg/1223648025CarImgbig.gif', 1, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223648025CarSign.gif', 107, 'park/carimg/1224656099CarImgMid.gif'),
(149, 'Peugeot 206', 'park/carimg/1223648091CarImg.swf', 'park/carimg/1223648091CarImgbig.gif', 6, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223648091CarSign.gif', 107, NULL),
(150, 'Peugeot 206', 'park/carimg/1223648107CarImg.swf', 'park/carimg/1223648107CarImgbig.gif', 5, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223648107CarSign.gif', 107, NULL),
(151, 'Peugeot 206', 'park/carimg/1223648125CarImg.swf', 'park/carimg/1223648125CarImgbig.gif', 3, 78000, 0, 1, 160, 1, 8, 'park/carimg/1223648125CarSign.gif', 107, NULL),
(152, 'Honda CRV', 'park/carimg/1223648811CarImg.swf', 'park/carimg/1223648811CarImgbig.gif', 4, 2398000, 0, 4, 300, 10, 10, 'park/carimg/1223648811CarSign.gif', 2002, NULL),
(153, 'Honda CRV', 'park/carimg/1223648834CarImg.swf', 'park/carimg/1223648834CarImgbig.gif', 4, 2398000, 0, 4, 300, 10, 10, 'park/carimg/1223648835CarSign.gif', 2002, 'park/carimg/1224658473CarImgMid.gif'),
(154, 'Honda CRV', 'park/carimg/1223649042CarImg.swf', 'park/carimg/1223649042CarImgbig.gif', 6, 2398000, 0, 4, 300, 10, 10, 'park/carimg/1223649042CarSign.gif', 2002, NULL),
(155, 'Honda CRV', 'park/carimg/1223649064CarImg.swf', 'park/carimg/1223649064CarImgbig.gif', 5, 2398000, 0, 4, 300, 10, 10, 'park/carimg/1223649064CarSign.gif', 2002, NULL),
(156, 'Honda CRV', 'park/carimg/1223649092CarImg.swf', 'park/carimg/1223649092CarImgbig.gif', 3, 2398000, 0, 4, 300, 10, 10, 'park/carimg/1223649092CarSign.gif', 2002, NULL),
(157, 'Peugeot307', 'park/carimg/1223649193CarImg.swf', 'park/carimg/1223649193CarImgbig.gif', 2, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649193CarSign.gif', 115, NULL),
(158, 'Peugeot307', 'park/carimg/1223649228CarImg.swf', 'park/carimg/1223649228CarImgbig.gif', 4, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649228CarSign.gif', 115, NULL),
(159, 'Peugeot307', 'park/carimg/1223649258CarImg.swf', 'park/carimg/1223649258CarImgbig.gif', 1, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649258CarSign.gif', 115, NULL),
(160, 'Peugeot307', 'park/carimg/1223649282CarImg.swf', 'park/carimg/1223649282CarImgbig.gif', 6, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649282CarSign.gif', 115, NULL),
(161, 'Peugeot307', 'park/carimg/1223649303CarImg.swf', 'park/carimg/1223649303CarImgbig.gif', 5, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649303CarSign.gif', 115, NULL),
(162, 'Peugeot307', 'park/carimg/1223649337CarImg.swf', 'park/carimg/1223649337CarImgbig.gif', 3, 110000, 0, 1, 180, 2, 2, 'park/carimg/1223649337CarSign.gif', 115, 'park/carimg/1224656286CarImgMid.gif'),
(163, 'Buick', 'park/carimg/1223649389CarImg.swf', 'park/carimg/1223649389CarImgbig.gif', 2, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649389CarSign.gif', 114, NULL),
(164, 'Buick', 'park/carimg/1223649482CarImg.swf', 'park/carimg/1223649482CarImgbig.gif', 4, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649482CarSign.gif', 114, NULL),
(165, 'Buick', 'park/carimg/1223649515CarImg.swf', 'park/carimg/1223649515CarImgbig.gif', 1, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649515CarSign.gif', 114, NULL),
(166, 'Buick', 'park/carimg/1223649537CarImg.swf', 'park/carimg/1223649537CarImgbig.gif', 6, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649537CarSign.gif', 114, NULL),
(167, 'Buick', 'park/carimg/1223649557CarImg.swf', 'park/carimg/1223649557CarImgbig.gif', 5, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649557CarSign.gif', 114, NULL),
(168, 'Buick', 'park/carimg/1223649577CarImg.swf', 'park/carimg/1223649577CarImgbig.gif', 3, 105000, 0, 1, 160, 2, 2, 'park/carimg/1223649577CarSign.gif', 114, 'park/carimg/1224656263CarImgMid.gif'),
(169, 'Galibier', 'park/carimg/1223649674CarImg.swf', 'park/carimg/1223649674CarImgbig.gif', 2, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649674CarSign.gif', 8002, NULL),
(170, 'Galibier', 'park/carimg/1223649708CarImg.swf', 'park/carimg/1223649708CarImgbig.gif', 4, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649708CarSign.gif', 8002, NULL),
(171, 'Galibier', 'park/carimg/1223649727CarImg.swf', 'park/carimg/1223649727CarImgbig.gif', 1, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649727CarSign.gif', 8002, 'park/carimg/1224659100CarImgMid.gif'),
(172, 'Galibier', 'park/carimg/1223649749CarImg.swf', 'park/carimg/1223649749CarImgbig.gif', 6, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649749CarSign.gif', 8002, NULL),
(173, 'Galibier', 'park/carimg/1223649766CarImg.swf', 'park/carimg/1223649766CarImgbig.gif', 5, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649766CarSign.gif', 8002, NULL),
(174, 'Galibier', 'park/carimg/1223649791CarImg.swf', 'park/carimg/1223649791CarImgbig.gif', 3, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649791CarSign.gif', 8002, NULL),
(175, 'Veyron', 'park/carimg/1223649830CarImg.swf', 'park/carimg/1223649830CarImgbig.gif', 2, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649830CarSign.gif', 8004, NULL),
(176, 'Veyron', 'park/carimg/1223649847CarImg.swf', 'park/carimg/1223649847CarImgbig.gif', 4, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649847CarSign.gif', 8004, NULL),
(177, 'Veyron', 'park/carimg/1223649882CarImg.swf', 'park/carimg/1223649882CarImgbig.gif', 1, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649882CarSign.gif', 8004, NULL),
(178, 'Veyron', 'park/carimg/1223649908CarImg.swf', 'park/carimg/1223649908CarImgbig.gif', 6, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649908CarSign.gif', 8004, NULL),
(179, 'Veyron', 'park/carimg/1223649925CarImg.swf', 'park/carimg/1223649925CarImgbig.gif', 5, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649925CarSign.gif', 8004, 'park/carimg/1224659123CarImgMid.gif'),
(180, 'Veyron', 'park/carimg/1223649944CarImg.swf', 'park/carimg/1223649944CarImgbig.gif', 3, 8388607, 0, 3, 300, 10, 10, 'park/carimg/1223649944CarSign.gif', 8004, NULL),
(181, 'Old Alto', 'park/carimg/1224865393CarImg.swf', 'park/carimg/1223650059CarImgbig.gif', 2, 16000, 0, 1, 120, 2, 2, 'park/carimg/1223650059CarSign.gif', 100, ''),
(182, 'Old Alto', 'park/carimg/1223650202CarImg.swf', 'park/carimg/1223650202CarImgbig.gif', 1, 16000, 0, 1, 120, 1, 2, 'park/carimg/1223650202CarSign.gif', 100, 'park/carimg/1224655507CarImgMid.gif'),
(183, 'Old Alto', 'park/carimg/1223650226CarImg.swf', 'park/carimg/1223650226CarImgbig.gif', 6, 16000, 0, 1, 120, 1, 2, 'park/carimg/1223650226CarSign.gif', 100, NULL),
(184, 'Old Alto', 'park/carimg/1224900571CarImg.swf', 'park/carimg/1223650246CarImgbig.gif', 5, 16000, 0, 1, 120, 1, 2, 'park/carimg/1223650246CarSign.gif', 100, ''),
(185, 'Old Alto', 'park/carimg/1223650268CarImg.swf', 'park/carimg/1223650268CarImgbig.gif', 3, 16000, 0, 1, 120, 1, 2, 'park/carimg/1223650268CarSign.gif', 100, NULL),
(186, 'Ferrari F430', 'park/carimg/1223650441CarImg.swf', 'park/carimg/1223650441CarImgbig.gif', 2, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650441CarSign.gif', 3004, NULL),
(187, 'Ferrari F430', 'park/carimg/1223650476CarImg.swf', 'park/carimg/1223650476CarImgbig.gif', 4, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650476CarSign.gif', 3004, NULL),
(188, 'Ferrari F430', 'park/carimg/1223650495CarImg.swf', 'park/carimg/1223650495CarImgbig.gif', 1, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650495CarSign.gif', 3004, 'park/carimg/1224658529CarImgMid.gif'),
(189, 'Ferrari F430', 'park/carimg/1223650516CarImg.swf', 'park/carimg/1223650516CarImgbig.gif', 6, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650516CarSign.gif', 3004, NULL),
(190, 'Ferrari F430', 'park/carimg/1223650531CarImg.swf', 'park/carimg/1223650531CarImgbig.gif', 5, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650531CarSign.gif', 3004, NULL),
(191, 'Ferrari F430', 'park/carimg/1223650553CarImg.swf', 'park/carimg/1223650553CarImgbig.gif', 3, 3200000, 0, 1, 300, 10, 10, 'park/carimg/1223650553CarSign.gif', 3004, NULL),
(192, 'Fit', 'park/carimg/1223650657CarImg.swf', 'park/carimg/1223650657CarImgbig.gif', 2, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650657CarSign.gif', 119, NULL),
(193, 'Fit', 'park/carimg/1223650678CarImg.swf', 'park/carimg/1223650678CarImgbig.gif', 4, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650678CarSign.gif', 119, NULL),
(194, 'Fit', 'park/carimg/1223650722CarImg.swf', 'park/carimg/1223650722CarImgbig.gif', 1, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650722CarSign.gif', 119, NULL),
(195, 'Fit', 'park/carimg/1223650811CarImg.swf', 'park/carimg/1223650811CarImgbig.gif', 6, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650811CarSign.gif', 119, 'park/carimg/1224656677CarImgMid.gif'),
(196, 'Fit', 'park/carimg/1223650850CarImg.swf', 'park/carimg/1223650850CarImgbig.gif', 5, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650850CarSign.gif', 119, NULL),
(197, 'Fit', 'park/carimg/1223650869CarImg.swf', 'park/carimg/1223650869CarImgbig.gif', 3, 129800, 0, 1, 140, 2, 2, 'park/carimg/1223650869CarSign.gif', 119, NULL),
(198, 'Ford Focus', 'park/carimg/1223650919CarImg.swf', 'park/carimg/1223650919CarImgbig.gif', 2, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223650919CarSign.gif', 118, NULL),
(199, 'Ford Focus', 'park/carimg/1223650941CarImg.swf', 'park/carimg/1223650941CarImgbig.gif', 4, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223650941CarSign.gif', 118, NULL),
(200, 'Ford Focus', 'park/carimg/1223651076CarImg.swf', 'park/carimg/1223651076CarImgbig.gif', 1, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223651076CarSign.gif', 118, NULL),
(201, 'Ford Focus', 'park/carimg/1223651094CarImg.swf', 'park/carimg/1223651094CarImgbig.gif', 6, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223651094CarSign.gif', 118, 'park/carimg/1224656638CarImgMid.gif'),
(202, 'Ford Focus', 'park/carimg/1223651110CarImg.swf', 'park/carimg/1223651110CarImgbig.gif', 5, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223651110CarSign.gif', 118, NULL),
(203, 'Ford Focus', 'park/carimg/1223651125CarImg.swf', 'park/carimg/1223651125CarImgbig.gif', 3, 128000, 0, 1, 160, 2, 2, 'park/carimg/1223651125CarSign.gif', 118, NULL),
(204, 'Foton', 'park/carimg/1223651193CarImg.swf', 'park/carimg/1223651193CarImgbig.gif', 2, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651193CarSign.gif', 113, ''),
(205, 'Foton', 'park/carimg/1223651216CarImg.swf', 'park/carimg/1223651216CarImgbig.gif', 4, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651216CarSign.gif', 113, ''),
(206, 'Foton', 'park/carimg/1223651245CarImg.swf', 'park/carimg/1223651245CarImgbig.gif', 1, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651245CarSign.gif', 113, 'park/carimg/1224656232CarImgMid.gif'),
(207, 'Foton', 'park/carimg/1223651266CarImg.swf', 'park/carimg/1223651266CarImgbig.gif', 6, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651266CarSign.gif', 113, ''),
(208, 'Foton', 'park/carimg/1223651283CarImg.swf', 'park/carimg/1223651283CarImgbig.gif', 5, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651283CarSign.gif', 113, ''),
(209, 'Foton', 'park/carimg/1223651302CarImg.swf', 'park/carimg/1223651302CarImgbig.gif', 3, 98800, 0, 6, 160, 1, 2, 'park/carimg/1223651302CarSign.gif', 113, ''),
(210, 'Citroen', 'park/carimg/1223651348CarImg.swf', 'park/carimg/1223651348CarImgbig.gif', 2, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651348CarSign.gif', 109, 'park/carimg/1224656025CarImgMid.gif'),
(211, 'Citroen', 'park/carimg/1223651369CarImg.swf', 'park/carimg/1223651369CarImgbig.gif', 4, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651369CarSign.gif', 109, NULL),
(212, 'Citroen', 'park/carimg/1223651391CarImg.swf', 'park/carimg/1223651391CarImgbig.gif', 1, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651391CarSign.gif', 109, NULL),
(213, 'Citroen', 'park/carimg/1223651410CarImg.swf', 'park/carimg/1223651410CarImgbig.gif', 6, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651410CarSign.gif', 109, NULL),
(214, 'Citroen', 'park/carimg/1223651432CarImg.swf', 'park/carimg/1223651432CarImgbig.gif', 5, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651432CarSign.gif', 109, NULL),
(215, 'Citroen', 'park/carimg/1223651446CarImg.swf', 'park/carimg/1223651446CarImgbig.gif', 3, 62000, 0, 1, 120, 1, 2, 'park/carimg/1223651446CarSign.gif', 109, NULL),
(216, 'Golf', 'park/carimg/1223651583CarImg.swf', 'park/carimg/1223651583CarImgbig.gif', 2, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651583CarSign.gif', 122, NULL),
(217, 'Golf', 'park/carimg/1223651600CarImg.swf', 'park/carimg/1223651600CarImgbig.gif', 4, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651600CarSign.gif', 122, NULL),
(218, 'Golf', 'park/carimg/1223651624CarImg.swf', 'park/carimg/1223651624CarImgbig.gif', 1, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651624CarSign.gif', 122, NULL),
(219, 'Golf', 'park/carimg/1223651644CarImg.swf', 'park/carimg/1223651644CarImgbig.gif', 6, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651644CarSign.gif', 122, NULL),
(220, 'Golf', 'park/carimg/1223651691CarImg.swf', 'park/carimg/1223651691CarImgbig.gif', 5, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651691CarSign.gif', 122, 'park/carimg/1224656762CarImgMid.gif'),
(221, 'Golf', 'park/carimg/1223651709CarImg.swf', 'park/carimg/1223651709CarImgbig.gif', 3, 139000, 0, 1, 160, 2, 2, 'park/carimg/1223651709CarSign.gif', 122, NULL),
(222, 'Harley', 'park/carimg/1223651780CarImg.swf', 'park/carimg/1223651780CarImgbig.gif', 2, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223651780CarSign.gif', 303, NULL),
(223, 'Harley', 'park/carimg/1223651895CarImg.swf', 'park/carimg/1223651895CarImgbig.gif', 4, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223651895CarSign.gif', 303, NULL),
(224, 'Harley', 'park/carimg/1223651911CarImg.swf', 'park/carimg/1223651911CarImgbig.gif', 1, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223651911CarSign.gif', 303, 'park/carimg/1224657769CarImgMid.gif'),
(225, 'Harley', 'park/carimg/1223651930CarImg.swf', 'park/carimg/1223651930CarImgbig.gif', 6, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223651930CarSign.gif', 303, NULL),
(226, 'Harley', 'park/carimg/1223651967CarImg.swf', 'park/carimg/1223651967CarImgbig.gif', 5, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223651967CarSign.gif', 303, NULL),
(227, 'Harley', 'park/carimg/1223652001CarImg.swf', 'park/carimg/1223652001CarImgbig.gif', 3, 300000, 0, 8, 200, 3, 4, 'park/carimg/1223652001CarSign.gif', 303, NULL),
(228, 'Hummer', 'park/carimg/1223652092CarImg.swf', 'park/carimg/1223652092CarImgbig.gif', 2, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652092CarSign.gif', 801, NULL),
(229, 'Hummer', 'park/carimg/1223652147CarImg.swf', 'park/carimg/1223652147CarImgbig.gif', 4, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652147CarSign.gif', 801, NULL),
(230, 'Hummer', 'park/carimg/1223652163CarImg.swf', 'park/carimg/1223652163CarImgbig.gif', 1, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652163CarSign.gif', 801, 'park/carimg/1224657991CarImgMid.gif'),
(231, 'Hummer', 'park/carimg/1223652181CarImg.swf', 'park/carimg/1223652181CarImgbig.gif', 6, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652181CarSign.gif', 801, NULL),
(232, 'Hummer', 'park/carimg/1223652197CarImg.swf', 'park/carimg/1223652197CarImgbig.gif', 5, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652197CarSign.gif', 801, NULL),
(233, 'Hummer', 'park/carimg/1223652217CarImg.swf', 'park/carimg/1223652217CarImgbig.gif', 3, 800000, 0, 2, 240, 8, 9, 'park/carimg/1223652217CarSign.gif', 801, NULL),
(234, 'GEELY', 'park/carimg/1223652292CarImg.swf', 'park/carimg/1223652292CarImgbig.gif', 2, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652292CarSign.gif', 105, NULL),
(235, 'GEELY', 'park/carimg/1223652467CarImg.swf', 'park/carimg/1223652467CarImgbig.gif', 4, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652467CarSign.gif', 105, NULL),
(236, 'GEELY', 'park/carimg/1223652488CarImg.swf', 'park/carimg/1223652488CarImgbig.gif', 1, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652488CarSign.gif', 105, 'park/carimg/1224655995CarImgMid.gif'),
(237, 'GEELY', 'park/carimg/1223652510CarImg.swf', 'park/carimg/1223652510CarImgbig.gif', 6, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652510CarSign.gif', 105, NULL),
(238, 'GEELY', 'park/carimg/1223652532CarImg.swf', 'park/carimg/1223652532CarImgbig.gif', 5, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652532CarSign.gif', 105, NULL),
(239, 'GEELY', 'park/carimg/1223652556CarImg.swf', 'park/carimg/1223652556CarImgbig.gif', 3, 48000, 0, 1, 120, 1, 2, 'park/carimg/1223652556CarSign.gif', 105, NULL),
(240, 'VW beetle', 'park/carimg/1223652658CarImg.swf', 'park/carimg/1223652658CarImgbig.gif', 2, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652658CarSign.gif', 206, NULL),
(241, 'VW beetle', 'park/carimg/1223652690CarImg.swf', 'park/carimg/1223652690CarImgbig.gif', 4, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652690CarSign.gif', 206, NULL),
(242, 'VW beetle', 'park/carimg/1223652712CarImg.swf', 'park/carimg/1223652712CarImgbig.gif', 1, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652712CarSign.gif', 206, NULL),
(243, 'VW beetle', 'park/carimg/1223652737CarImg.swf', 'park/carimg/1223652737CarImgbig.gif', 6, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652737CarSign.gif', 206, 'park/carimg/1224657703CarImgMid.gif'),
(244, 'VW beetle', 'park/carimg/1223652754CarImg.swf', 'park/carimg/1223652754CarImgbig.gif', 5, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652754CarSign.gif', 206, NULL),
(245, 'VW beetle', 'park/carimg/1223652780CarImg.swf', 'park/carimg/1223652780CarImgbig.gif', 3, 250000, 0, 3, 160, 3, 3, 'park/carimg/1223652780CarSign.gif', 206, NULL),
(246, 'Carola', 'park/carimg/1223652850CarImg.swf', 'park/carimg/1223652850CarImgbig.gif', 2, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652850CarSign.gif', 121, NULL),
(247, 'Carola', 'park/carimg/1223652869CarImg.swf', 'park/carimg/1223652869CarImgbig.gif', 4, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652869CarSign.gif', 121, 'park/carimg/1224656741CarImgMid.gif'),
(248, 'Carola', 'park/carimg/1223652886CarImg.swf', 'park/carimg/1223652886CarImgbig.gif', 1, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652886CarSign.gif', 121, NULL),
(249, 'Carola', 'park/carimg/1223652906CarImg.swf', 'park/carimg/1223652906CarImgbig.gif', 6, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652906CarSign.gif', 121, NULL),
(250, 'Carola', 'park/carimg/1223652922CarImg.swf', 'park/carimg/1223652922CarImgbig.gif', 5, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652922CarSign.gif', 121, NULL),
(251, 'Carola', 'park/carimg/1223652938CarImg.swf', 'park/carimg/1223652938CarImgbig.gif', 3, 132000, 0, 1, 160, 2, 2, 'park/carimg/1223652938CarSign.gif', 121, NULL),
(252, 'Cadillac', 'park/carimg/1223653039CarImg.swf', 'park/carimg/1223653039CarImgbig.gif', 2, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653039CarSign.gif', 808, NULL),
(253, 'Cadillac', 'park/carimg/1223653069CarImg.swf', 'park/carimg/1223653069CarImgbig.gif', 4, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653069CarSign.gif', 808, 'park/carimg/1224658029CarImgMid.gif'),
(254, 'Cadillac', 'park/carimg/1223653086CarImg.swf', 'park/carimg/1223653086CarImgbig.gif', 1, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653086CarSign.gif', 808, NULL),
(255, 'Cadillac', 'park/carimg/1223653104CarImg.swf', 'park/carimg/1223653104CarImgbig.gif', 6, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653104CarSign.gif', 808, NULL),
(256, 'Cadillac', 'park/carimg/1223653151CarImg.swf', 'park/carimg/1223653151CarImgbig.gif', 5, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653151CarSign.gif', 808, NULL),
(257, 'Cadillac', 'park/carimg/1223653170CarImg.swf', 'park/carimg/1223653170CarImgbig.gif', 3, 878000, 0, 1, 240, 9, 9, 'park/carimg/1223653170CarSign.gif', 808, NULL),
(258, 'Gallardo', 'park/carimg/1223653241CarImg.swf', 'park/carimg/1223653241CarImgbig.gif', 2, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653241CarSign.gif', 3003, NULL),
(259, 'Gallardo', 'park/carimg/1223653263CarImg.swf', 'park/carimg/1223653263CarImgbig.gif', 4, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653263CarSign.gif', 3003, NULL),
(260, 'Gallardo', 'park/carimg/1223653281CarImg.swf', 'park/carimg/1223653281CarImgbig.gif', 1, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653281CarSign.gif', 3003, NULL),
(261, 'Gallardo', 'park/carimg/1223653296CarImg.swf', 'park/carimg/1223653296CarImgbig.gif', 6, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653296CarSign.gif', 3003, 'park/carimg/1224658551CarImgMid.gif'),
(262, 'Gallardo', 'park/carimg/1223653314CarImg.swf', 'park/carimg/1223653314CarImgbig.gif', 5, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653314CarSign.gif', 3003, NULL),
(263, 'Gallardo', 'park/carimg/1223653330CarImg.swf', 'park/carimg/1223653330CarImgbig.gif', 3, 3980000, 0, 4, 300, 10, 10, 'park/carimg/1223653330CarSign.gif', 3003, NULL),
(264, 'LAVIDA', 'park/carimg/1223653398CarImg.swf', 'park/carimg/1223653398CarImgbig.gif', 2, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653398CarSign.gif', 124, NULL),
(265, 'LAVIDA', 'park/carimg/1223653446CarImg.swf', 'park/carimg/1223653446CarImgbig.gif', 4, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653446CarSign.gif', 124, NULL),
(266, 'LAVIDA', 'park/carimg/1223653462CarImg.swf', 'park/carimg/1223653462CarImgbig.gif', 1, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653462CarSign.gif', 124, NULL),
(267, 'LAVIDA', 'park/carimg/1223653483CarImg.swf', 'park/carimg/1223653483CarImgbig.gif', 6, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653483CarSign.gif', 124, NULL),
(268, 'LAVIDA', 'park/carimg/1223653499CarImg.swf', 'park/carimg/1223653499CarImgbig.gif', 5, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653499CarSign.gif', 124, NULL),
(269, 'LAVIDA', 'park/carimg/1223653514CarImg.swf', 'park/carimg/1223653514CarImgbig.gif', 3, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223653514CarSign.gif', 124, 'park/carimg/1224656843CarImgMid.gif'),
(270, 'Royce', 'park/carimg/1223653617CarImg.swf', 'park/carimg/1223653617CarImgbig.gif', 2, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653617CarSign.gif', 6001, NULL),
(271, 'Royce', 'park/carimg/1223653635CarImg.swf', 'park/carimg/1223653635CarImgbig.gif', 4, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653635CarSign.gif', 6001, 'park/carimg/1224658733CarImgMid.gif'),
(272, 'Royce', 'park/carimg/1223653654CarImg.swf', 'park/carimg/1223653654CarImgbig.gif', 1, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653654CarSign.gif', 6001, NULL),
(273, 'Royce', 'park/carimg/1223653672CarImg.swf', 'park/carimg/1223653672CarImgbig.gif', 6, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653672CarSign.gif', 6001, NULL),
(274, 'Royce', 'park/carimg/1223653688CarImg.swf', 'park/carimg/1223653688CarImgbig.gif', 5, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653688CarSign.gif', 6001, NULL),
(275, 'Royce', 'park/carimg/1223653707CarImg.swf', 'park/carimg/1223653707CarImgbig.gif', 3, 6200000, 0, 4, 300, 10, 10, 'park/carimg/1223653707CarSign.gif', 6001, NULL),
(276, 'Lexus', 'park/carimg/1223653794CarImg.swf', 'park/carimg/1223653794CarImgbig.gif', 2, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653794CarSign.gif', 1006, NULL),
(277, 'Lexus', 'park/carimg/1223653813CarImg.swf', 'park/carimg/1223653813CarImgbig.gif', 4, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653813CarSign.gif', 1006, 'park/carimg/1224658367CarImgMid.gif'),
(278, 'Lexus', 'park/carimg/1223653837CarImg.swf', 'park/carimg/1223653837CarImgbig.gif', 1, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653837CarSign.gif', 1006, NULL),
(279, 'Lexus', 'park/carimg/1223653854CarImg.swf', 'park/carimg/1223653854CarImgbig.gif', 6, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653854CarSign.gif', 1006, NULL),
(280, 'Lexus', 'park/carimg/1223653871CarImg.swf', 'park/carimg/1223653871CarImgbig.gif', 5, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653871CarSign.gif', 1006, NULL),
(281, 'Lexus', 'park/carimg/1223653888CarImg.swf', 'park/carimg/1223653888CarImgbig.gif', 3, 1598000, 0, 4, 300, 10, 10, 'park/carimg/1223653888CarSign.gif', 1006, NULL),
(282, 'Lincoln', 'park/carimg/1223653944CarImg.swf', 'park/carimg/1223653944CarImgbig.gif', 2, 1380000, 0, 5, 300, 10, 10, 'park/carimg/1223653944CarSign.gif', 1004, NULL),
(283, 'Lincoln', 'park/carimg/1223653968CarImg.swf', 'park/carimg/1223653968CarImgbig.gif', 4, 1380000, 0, 5, 300, 10, 10, 'park/carimg/1223653968CarSign.gif', 1004, 'park/carimg/1224658256CarImgMid.gif'),
(284, 'Lincoln', 'park/carimg/1223653986CarImg.swf', 'park/carimg/1223653986CarImgbig.gif', 1, 1380000, 0, 5, 300, 10, 10, 'park/carimg/1223653986CarSign.gif', 1004, NULL),
(285, 'Rover', 'park/carimg/1223654025CarImg.swf', 'park/carimg/1223654025CarImgbig.gif', 2, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654025CarSign.gif', 1003, 'park/carimg/1224658166CarImgMid.gif'),
(286, 'Rover', 'park/carimg/1224991173CarImg.swf', 'park/carimg/1223654039CarImgbig.gif', 4, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654039CarSign.gif', 1003, ''),
(287, 'Rover', 'park/carimg/1223654055CarImg.swf', 'park/carimg/1223654055CarImgbig.gif', 1, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654055CarSign.gif', 1003, NULL),
(288, 'Rover', 'park/carimg/1223654073CarImg.swf', 'park/carimg/1223654073CarImgbig.gif', 6, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654073CarSign.gif', 1003, NULL),
(289, 'Rover', 'park/carimg/1223654089CarImg.swf', 'park/carimg/1223654089CarImgbig.gif', 5, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654089CarSign.gif', 1003, NULL),
(290, 'Rover', 'park/carimg/1223654107CarImg.swf', 'park/carimg/1223654107CarImgbig.gif', 3, 1280000, 0, 2, 300, 10, 10, 'park/carimg/1223654107CarSign.gif', 1003, NULL),
(291, 'Mz6', 'park/carimg/1223654171CarImg.swf', 'park/carimg/1223654171CarImgbig.gif', 2, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654171CarSign.gif', 127, NULL),
(292, 'Mz6', 'park/carimg/1223654334CarImg.swf', 'park/carimg/1223654334CarImgbig.gif', 4, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654334CarSign.gif', 127, NULL),
(293, 'Mz6', 'park/carimg/1223654373CarImg.swf', 'park/carimg/1223654373CarImgbig.gif', 1, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654373CarSign.gif', 127, NULL),
(294, 'Mz6', 'park/carimg/1223654396CarImg.swf', 'park/carimg/1223654396CarImgbig.gif', 6, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654396CarSign.gif', 127, NULL),
(295, 'Mz6', 'park/carimg/1223654414CarImg.swf', 'park/carimg/1223654414CarImgbig.gif', 5, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654414CarSign.gif', 127, 'park/carimg/1224656922CarImgMid.gif'),
(296, 'Mz6', 'park/carimg/1223654433CarImg.swf', 'park/carimg/1223654433CarImgbig.gif', 3, 178000, 0, 1, 180, 2, 2, 'park/carimg/1223654433CarSign.gif', 127, NULL),
(442, 'COUPE', 'park/carimg/1224992116CarImg.swf', 'park/carimg/1224992116CarImgbig.gif', 6, 190000, 0, 1, 180, 2, 2, 'park/carimg/1224992116CarSign.gif', 129, 'park/carimg/1224992116CarImgMid.gif'),
(441, 'COUPE', 'park/carimg/1224991985CarImg.swf', 'park/carimg/1224991985CarImgbig.gif', 5, 190000, 0, 1, 180, 2, 2, 'park/carimg/1224991985CarSign.gif', 129, 'park/carimg/1224991985CarImgMid.gif'),
(303, 'Maybach', 'park/carimg/1223654851CarImg.swf', 'park/carimg/1223654851CarImgbig.gif', 2, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654851CarSign.gif', 6006, NULL),
(304, 'Maybach', 'park/carimg/1223654865CarImg.swf', 'park/carimg/1223654865CarImgbig.gif', 4, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654865CarSign.gif', 6006, NULL),
(305, 'Maybach', 'park/carimg/1223654883CarImg.swf', 'park/carimg/1223654883CarImgbig.gif', 1, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654883CarSign.gif', 6006, NULL),
(306, 'Maybach', 'park/carimg/1223654898CarImg.swf', 'park/carimg/1223654898CarImgbig.gif', 6, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654898CarSign.gif', 6006, NULL),
(307, 'Maybach', 'park/carimg/1223654914CarImg.swf', 'park/carimg/1223654914CarImgbig.gif', 5, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654914CarSign.gif', 6006, NULL),
(308, 'Maybach', 'park/carimg/1223654931CarImg.swf', 'park/carimg/1223654931CarImgbig.gif', 3, 6180000, 0, 4, 300, 10, 10, 'park/carimg/1223654931CarSign.gif', 6006, 'park/carimg/1224658703CarImgMid.gif'),
(309, 'Magotan', 'park/carimg/1223654999CarImg.swf', 'park/carimg/1223654999CarImgbig.gif', 2, 6180000, 0, 4, 280, 10, 7, 'park/carimg/1223654999CarSign.gif', 6002, NULL),
(310, 'Magotan', 'park/carimg/1223655014CarImg.swf', 'park/carimg/1223655014CarImgbig.gif', 4, 6180000, 0, 4, 280, 10, 7, 'park/carimg/1223655014CarSign.gif', 6002, NULL),
(311, 'Magotan', 'park/carimg/1223655030CarImg.swf', 'park/carimg/1223655030CarImgbig.gif', 1, 6180000, 0, 4, 280, 10, 7, 'park/carimg/1223655030CarSign.gif', 6002, NULL),
(312, 'Magotan', 'park/carimg/1223655044CarImg.swf', 'park/carimg/1223655044CarImgbig.gif', 6, 6180000, 0, 4, 280, 10, 7, 'park/carimg/1223655044CarSign.gif', 6002, NULL),
(313, 'Magotan', 'park/carimg/1223655058CarImg.swf', 'park/carimg/1223655058CarImgbig.gif', 5, 6180000, 0, 4, 280, 10, 7, 'park/carimg/1223655058CarSign.gif', 6002, 'park/carimg/1224658664CarImgMid.gif'),
(314, 'Magotan', 'park/carimg/1223655072CarImg.swf', 'park/carimg/1223655072CarImgbig.gif', 3, 6180000, 0, 4, 280, 2, 7, 'park/carimg/1223655072CarSign.gif', 6002, NULL),
(315, 'Fake Cop', 'park/carimg/1223655122CarImg.swf', 'park/carimg/1223655122CarImgbig.gif', 2, 130000, 0, 10, 140, 2, 2, 'park/carimg/1223655122CarSign.gif', 120, 'park/carimg/1224656693CarImgMid.gif'),
(316, 'Mondeo', 'park/carimg/1223655167CarImg.swf', 'park/carimg/1223655167CarImgbig.gif', 2, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655167CarSign.gif', 202, NULL),
(317, 'Mondeo', 'park/carimg/1223655202CarImg.swf', 'park/carimg/1223655202CarImgbig.gif', 4, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655202CarSign.gif', 202, NULL),
(318, 'Mondeo', 'park/carimg/1223655217CarImg.swf', 'park/carimg/1223655217CarImgbig.gif', 1, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655217CarSign.gif', 202, NULL),
(319, 'Mondeo', 'park/carimg/1223655233CarImg.swf', 'park/carimg/1223655233CarImgbig.gif', 6, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655233CarSign.gif', 202, NULL),
(320, 'Mondeo', 'park/carimg/1223655247CarImg.swf', 'park/carimg/1223655247CarImgbig.gif', 5, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655247CarSign.gif', 202, NULL),
(321, 'Mondeo', 'park/carimg/1223655261CarImg.swf', 'park/carimg/1223655261CarImgbig.gif', 3, 239800, 0, 1, 180, 3, 3, 'park/carimg/1223655261CarSign.gif', 202, 'park/carimg/1224657303CarImgMid.gif'),
(322, 'MG 3SW', 'park/carimg/1223655310CarImg.swf', 'park/carimg/1223655310CarImgbig.gif', 2, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655310CarSign.gif', 110, NULL),
(323, 'MG 3SW', 'park/carimg/1223655327CarImg.swf', 'park/carimg/1223655327CarImgbig.gif', 4, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655327CarSign.gif', 110, NULL),
(324, 'MG 3SW', 'park/carimg/1223655342CarImg.swf', 'park/carimg/1223655342CarImgbig.gif', 1, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655342CarSign.gif', 110, 'park/carimg/1224656155CarImgMid.gif'),
(325, 'MG 3SW', 'park/carimg/1223655375CarImg.swf', 'park/carimg/1223655375CarImgbig.gif', 6, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655375CarSign.gif', 110, NULL),
(326, 'MG 3SW', 'park/carimg/1223655404CarImg.swf', 'park/carimg/1223655404CarImgbig.gif', 5, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655404CarSign.gif', 110, NULL),
(327, 'MG 3SW', 'park/carimg/1223655422CarImg.swf', 'park/carimg/1223655422CarImgbig.gif', 3, 79800, 0, 1, 140, 1, 2, 'park/carimg/1223655422CarSign.gif', 110, NULL),
(328, 'Wrangler', 'park/carimg/1223655718CarImg.swf', 'park/carimg/1223655718CarImgbig.gif', 2, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655718CarSign.gif', 505, NULL),
(329, 'Wrangler', 'park/carimg/1223655736CarImg.swf', 'park/carimg/1223655736CarImgbig.gif', 4, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655736CarSign.gif', 505, NULL),
(330, 'Wrangler', 'park/carimg/1223655753CarImg.swf', 'park/carimg/1223655753CarImgbig.gif', 1, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655753CarSign.gif', 505, NULL),
(331, 'Wrangler', 'park/carimg/1223655771CarImg.swf', 'park/carimg/1223655771CarImgbig.gif', 6, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655771CarSign.gif', 505, 'park/carimg/1224657883CarImgMid.gif'),
(332, 'Wrangler', 'park/carimg/1223655786CarImg.swf', 'park/carimg/1223655786CarImgbig.gif', 5, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655786CarSign.gif', 505, NULL),
(333, 'Wrangler', 'park/carimg/1223655800CarImg.swf', 'park/carimg/1223655800CarImgbig.gif', 3, 525000, 0, 2, 240, 6, 6, 'park/carimg/1223655800CarSign.gif', 505, NULL),
(334, 'Pagani', 'park/carimg/1223655932CarImg.swf', 'park/carimg/1223655932CarImgbig.gif', 2, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223655932CarSign.gif', 8001, ''),
(335, 'Pagani', 'park/carimg/1223655951CarImg.swf', 'park/carimg/1223655951CarImgbig.gif', 4, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223655951CarSign.gif', 8001, NULL),
(336, 'Pagani', 'park/carimg/1223655969CarImg.swf', 'park/carimg/1223655969CarImgbig.gif', 1, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223655969CarSign.gif', 8001, NULL),
(337, 'Pagani', 'park/carimg/1223655990CarImg.swf', 'park/carimg/1223655990CarImgbig.gif', 6, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223655990CarSign.gif', 8001, NULL),
(338, 'Pagani', 'park/carimg/1223656005CarImg.swf', 'park/carimg/1223656005CarImgbig.gif', 5, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223656005CarSign.gif', 8001, NULL),
(339, 'Pagani', 'park/carimg/1223656023CarImg.swf', 'park/carimg/1223656023CarImgbig.gif', 3, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223656023CarSign.gif', 8001, 'park/carimg/1224658823CarImgMid.gif'),
(340, 'Passat', 'park/carimg/1223656089CarImg.swf', 'park/carimg/1223656089CarImgbig.gif', 2, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656089CarSign.gif', 128, NULL),
(341, 'Passat', 'park/carimg/1223656103CarImg.swf', 'park/carimg/1223656103CarImgbig.gif', 4, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656103CarSign.gif', 128, 'park/carimg/1224656940CarImgMid.gif'),
(342, 'Passat', 'park/carimg/1223656116CarImg.swf', 'park/carimg/1223656116CarImgbig.gif', 1, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656116CarSign.gif', 128, NULL),
(343, 'Passat', 'park/carimg/1223656137CarImg.swf', 'park/carimg/1223656137CarImgbig.gif', 6, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656137CarSign.gif', 128, NULL),
(344, 'Passat', 'park/carimg/1223656151CarImg.swf', 'park/carimg/1223656151CarImgbig.gif', 5, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656151CarSign.gif', 128, NULL),
(345, 'Passat', 'park/carimg/1223656166CarImg.swf', 'park/carimg/1223656166CarImgbig.gif', 3, 186000, 0, 1, 200, 2, 2, 'park/carimg/1223656166CarSign.gif', 128, NULL),
(346, 'Chery', 'park/carimg/1223656212CarImg.swf', 'park/carimg/1223656212CarImgbig.gif', 2, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656212CarSign.gif', 104, NULL),
(347, 'Chery', 'park/carimg/1223656225CarImg.swf', 'park/carimg/1223656225CarImgbig.gif', 4, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656225CarSign.gif', 104, NULL),
(348, 'Chery', 'park/carimg/1223656239CarImg.swf', 'park/carimg/1223656239CarImgbig.gif', 1, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656239CarSign.gif', 104, NULL),
(349, 'Chery', 'park/carimg/1223656252CarImg.swf', 'park/carimg/1223656252CarImgbig.gif', 6, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656252CarSign.gif', 104, 'park/carimg/1224655957CarImgMid.gif'),
(350, 'Chery', 'park/carimg/1223656275CarImg.swf', 'park/carimg/1223656275CarImgbig.gif', 5, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656275CarSign.gif', 104, NULL),
(351, 'Chery', 'park/carimg/1223656293CarImg.swf', 'park/carimg/1223656293CarImgbig.gif', 3, 36000, 0, 1, 120, 1, 2, 'park/carimg/1223656293CarSign.gif', 104, NULL),
(352, 'Tiida', 'park/carimg/1223656472CarImg.swf', 'park/carimg/1223656472CarImgbig.gif', 2, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656472CarSign.gif', 125, NULL),
(353, 'Tiida', 'park/carimg/1223656487CarImg.swf', 'park/carimg/1223656487CarImgbig.gif', 4, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656487CarSign.gif', 125, NULL),
(354, 'Tiida', 'park/carimg/1223656504CarImg.swf', 'park/carimg/1223656504CarImgbig.gif', 1, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656504CarSign.gif', 125, NULL),
(355, 'Tiida', 'park/carimg/1223656519CarImg.swf', 'park/carimg/1223656519CarImgbig.gif', 6, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656519CarSign.gif', 125, 'park/carimg/1224656862CarImgMid.gif'),
(356, 'Tiida', 'park/carimg/1223656536CarImg.swf', 'park/carimg/1223656536CarImgbig.gif', 5, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656536CarSign.gif', 125, NULL),
(357, 'Tiida', 'park/carimg/1223656553CarImg.swf', 'park/carimg/1223656553CarImgbig.gif', 3, 149800, 0, 1, 160, 2, 2, 'park/carimg/1223656553CarSign.gif', 125, NULL),
(358, 'JEEP', 'park/carimg/1223656624CarImg.swf', 'park/carimg/1223656624CarImgbig.gif', 2, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656624CarSign.gif', 404, NULL),
(359, 'JEEP', 'park/carimg/1223656639CarImg.swf', 'park/carimg/1223656639CarImgbig.gif', 4, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656639CarSign.gif', 404, NULL),
(360, 'JEEP', 'park/carimg/1223656653CarImg.swf', 'park/carimg/1223656653CarImgbig.gif', 1, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656653CarSign.gif', 404, 'park/carimg/1224657840CarImgMid.gif'),
(361, 'JEEP', 'park/carimg/1223656669CarImg.swf', 'park/carimg/1223656669CarImgbig.gif', 6, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656669CarSign.gif', 404, NULL),
(362, 'JEEP', 'park/carimg/1223656681CarImg.swf', 'park/carimg/1223656681CarImgbig.gif', 5, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656681CarSign.gif', 404, NULL),
(363, 'JEEP', 'park/carimg/1223656693CarImg.swf', 'park/carimg/1223656693CarImgbig.gif', 3, 420000, 0, 2, 240, 5, 5, 'park/carimg/1223656693CarSign.gif', 404, NULL),
(364, 'Cerato', 'park/carimg/1223656744CarImg.swf', 'park/carimg/1223656744CarImgbig.gif', 2, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656744CarSign.gif', 117, NULL),
(365, 'Cerato', 'park/carimg/1223656762CarImg.swf', 'park/carimg/1223656762CarImgbig.gif', 4, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656762CarSign.gif', 117, NULL),
(366, 'Cerato', 'park/carimg/1223656776CarImg.swf', 'park/carimg/1223656776CarImgbig.gif', 1, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656776CarSign.gif', 117, NULL),
(367, 'Cerato', 'park/carimg/1223656790CarImg.swf', 'park/carimg/1223656790CarImgbig.gif', 6, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656790CarSign.gif', 117, 'park/carimg/1224656402CarImgMid.gif'),
(368, 'Cerato', 'park/carimg/1223656804CarImg.swf', 'park/carimg/1223656804CarImgbig.gif', 5, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656804CarSign.gif', 117, NULL),
(369, 'Cerato', 'park/carimg/1223656817CarImg.swf', 'park/carimg/1223656817CarImgbig.gif', 3, 127800, 0, 1, 160, 2, 2, 'park/carimg/1223656817CarSign.gif', 117, NULL),
(370, 'Santana', 'park/carimg/1223656861CarImg.swf', 'park/carimg/1223656861CarImgbig.gif', 2, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656861CarSign.gif', 111, NULL),
(371, 'Santana', 'park/carimg/1223656875CarImg.swf', 'park/carimg/1223656875CarImgbig.gif', 4, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656875CarSign.gif', 111, 'park/carimg/1224656179CarImgMid.gif'),
(372, 'Santana', 'park/carimg/1223656888CarImg.swf', 'park/carimg/1223656888CarImgbig.gif', 1, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656888CarSign.gif', 110, NULL),
(373, 'Santana', 'park/carimg/1223656904CarImg.swf', 'park/carimg/1223656904CarImgbig.gif', 6, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656904CarSign.gif', 111, NULL),
(374, 'Santana', 'park/carimg/1223656917CarImg.swf', 'park/carimg/1223656917CarImgbig.gif', 5, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656917CarSign.gif', 111, NULL),
(375, 'Santana', 'park/carimg/1223656931CarImg.swf', 'park/carimg/1223656931CarImgbig.gif', 3, 80000, 0, 1, 160, 1, 2, 'park/carimg/1223656931CarSign.gif', 111, NULL),
(376, 'Impreza', 'park/carimg/1223656981CarImg.swf', 'park/carimg/1223656981CarImgbig.gif', 3, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223656981CarSign.gif', 201, NULL),
(377, 'Impreza', 'park/carimg/1223657017CarImg.swf', 'park/carimg/1223657017CarImgbig.gif', 4, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223657017CarSign.gif', 201, NULL),
(378, 'Impreza', 'park/carimg/1223657032CarImg.swf', 'park/carimg/1223657032CarImgbig.gif', 1, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223657032CarSign.gif', 201, NULL),
(379, 'Impreza', 'park/carimg/1223657049CarImg.swf', 'park/carimg/1223657049CarImgbig.gif', 6, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223657049CarSign.gif', 201, NULL),
(380, 'Impreza', 'park/carimg/1223657062CarImg.swf', 'park/carimg/1223657062CarImgbig.gif', 5, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223657063CarSign.gif', 201, 'park/carimg/1224657240CarImgMid.gif'),
(381, 'Impreza', 'park/carimg/1223657080CarImg.swf', 'park/carimg/1223657080CarImgbig.gif', 3, 239800, 0, 1, 160, 3, 3, 'park/carimg/1223657080CarSign.gif', 201, NULL),
(382, 'SAGITAR', 'park/carimg/1223657120CarImg.swf', 'park/carimg/1223657120CarImgbig.gif', 2, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657120CarSign.gif', 203, NULL),
(383, 'SAGITAR', 'park/carimg/1223657133CarImg.swf', 'park/carimg/1223657133CarImgbig.gif', 4, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657133CarSign.gif', 203, NULL),
(384, 'SAGITAR', 'park/carimg/1223657146CarImg.swf', 'park/carimg/1223657146CarImgbig.gif', 1, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657146CarSign.gif', 203, 'park/carimg/1224657591CarImgMid.gif'),
(385, 'SAGITAR', 'park/carimg/1223657159CarImg.swf', 'park/carimg/1223657159CarImgbig.gif', 6, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657159CarSign.gif', 203, NULL),
(386, 'SAGITAR', 'park/carimg/1223657173CarImg.swf', 'park/carimg/1223657173CarImgbig.gif', 5, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657173CarSign.gif', 203, 'park/carimg/1224657219CarImgMid.gif'),
(387, 'SAGITAR', 'park/carimg/1223657189CarImg.swf', 'park/carimg/1223657189CarImgbig.gif', 3, 239800, 0, 1, 160, 2, 2, 'park/carimg/1223657189CarSign.gif', 203, ''),
(388, 'Tucan', 'park/carimg/1223657243CarImg.swf', 'park/carimg/1223657243CarImgbig.gif', 2, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657243CarSign.gif', 205, NULL),
(389, 'Tucan', 'park/carimg/1223657255CarImg.swf', 'park/carimg/1223657255CarImgbig.gif', 4, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657255CarSign.gif', 205, NULL),
(390, 'Tucan', 'park/carimg/1223657269CarImg.swf', 'park/carimg/1223657269CarImgbig.gif', 1, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657269CarSign.gif', 205, NULL),
(391, 'Tucan', 'park/carimg/1223657283CarImg.swf', 'park/carimg/1223657283CarImgbig.gif', 6, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657283CarSign.gif', 205, NULL),
(392, 'Tucan', 'park/carimg/1223657297CarImg.swf', 'park/carimg/1223657297CarImgbig.gif', 5, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657297CarSign.gif', 205, 'park/carimg/1224657665CarImgMid.gif'),
(393, 'Tucan', 'park/carimg/1223657310CarImg.swf', 'park/carimg/1223657310CarImgbig.gif', 3, 241800, 0, 1, 180, 3, 3, 'park/carimg/1223657310CarSign.gif', 205, NULL),
(394, 'VolvoXC90', 'park/carimg/1223657371CarImg.swf', 'park/carimg/1223657371CarImgbig.gif', 2, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657371CarSign.gif', 1002, NULL),
(395, 'VolvoXC90', 'park/carimg/1223657383CarImg.swf', 'park/carimg/1223657383CarImgbig.gif', 4, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657383CarSign.gif', 1002, 'park/carimg/1224658084CarImgMid.gif'),
(396, 'VolvoXC90', 'park/carimg/1223657396CarImg.swf', 'park/carimg/1223657396CarImgbig.gif', 1, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657396CarSign.gif', 1003, NULL),
(397, 'VolvoXC90', 'park/carimg/1223657410CarImg.swf', 'park/carimg/1223657410CarImgbig.gif', 6, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657410CarSign.gif', 1002, NULL),
(398, 'VolvoXC90', 'park/carimg/1223657423CarImg.swf', 'park/carimg/1223657423CarImgbig.gif', 5, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657423CarSign.gif', 1002, NULL),
(399, 'VolvoXC90', 'park/carimg/1223657435CarImg.swf', 'park/carimg/1223657435CarImgbig.gif', 3, 1138000, 0, 4, 300, 10, 10, 'park/carimg/1223657435CarSign.gif', 1002, NULL),
(400, 'Charade', 'park/carimg/1223657487CarImg.swf', 'park/carimg/1223657487CarImgbig.gif', 2, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657487CarSign.gif', 102, NULL),
(401, 'Charade', 'park/carimg/1223657499CarImg.swf', 'park/carimg/1223657499CarImgbig.gif', 4, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657499CarSign.gif', 102, NULL),
(402, 'Charade', 'park/carimg/1223657512CarImg.swf', 'park/carimg/1223657512CarImgbig.gif', 1, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657512CarSign.gif', 102, NULL),
(403, 'Charade', 'park/carimg/1223657525CarImg.swf', 'park/carimg/1223657525CarImgbig.gif', 6, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657525CarSign.gif', 102, NULL),
(404, 'Charade', 'park/carimg/1223657540CarImg.swf', 'park/carimg/1223657540CarImgbig.gif', 5, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657540CarSign.gif', 102, NULL),
(405, 'Charade', 'park/carimg/1223657553CarImg.swf', 'park/carimg/1223657553CarImgbig.gif', 3, 32000, 0, 1, 160, 1, 2, 'park/carimg/1223657553CarSign.gif', 102, 'park/carimg/1224655813CarImgMid.gif'),
(406, 'Hyundai', 'park/carimg/1223658640CarImg.swf', 'park/carimg/1223658640CarImgbig.gif', 2, 190000, 0, 1, 180, 2, 2, 'park/carimg/1223658640CarSign.gif', 129, 'park/carimg/1224657088CarImgMid.gif'),
(407, 'Hyundai', 'park/carimg/1223658692CarImg.swf', 'park/carimg/1223658692CarImgbig.gif', 4, 190000, 0, 1, 180, 2, 2, 'park/carimg/1223658692CarSign.gif', 129, NULL),
(408, 'Hyundai', 'park/carimg/1223658730CarImg.swf', 'park/carimg/1223658730CarImgbig.gif', 4, 190000, 0, 1, 180, 2, 2, 'park/carimg/1223658730CarSign.gif', 129, NULL),
(409, 'Hyundai', 'park/carimg/1223659266CarImg.swf', 'park/carimg/1223659266CarImgbig.gif', 3, 190000, 0, 1, 180, 2, 2, 'park/carimg/1223659266CarSign.gif', 129, NULL),
(410, 'Picasso', 'park/carimg/1223659312CarImg.swf', 'park/carimg/1223659312CarImgbig.gif', 2, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659312CarSign.gif', 126, NULL),
(411, 'Picasso', 'park/carimg/1223659325CarImg.swf', 'park/carimg/1223659325CarImgbig.gif', 4, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659325CarSign.gif', 126, NULL),
(412, 'Picasso', 'park/carimg/1223659342CarImg.swf', 'park/carimg/1223659342CarImgbig.gif', 1, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659342CarSign.gif', 126, NULL),
(413, 'Picasso', 'park/carimg/1223659360CarImg.swf', 'park/carimg/1223659360CarImgbig.gif', 6, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659360CarSign.gif', 126, 'park/carimg/1224656882CarImgMid.gif'),
(414, 'Picasso', 'park/carimg/1223659377CarImg.swf', 'park/carimg/1223659377CarImgbig.png', 5, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659377CarSign.gif', 126, NULL),
(415, 'Picasso', 'park/carimg/1223659389CarImg.swf', 'park/carimg/1223659389CarImgbig.gif', 3, 157800, 0, 1, 180, 2, 2, 'park/carimg/1223659389CarSign.gif', 127, NULL),
(416, 'CitroenC2', 'park/carimg/1223659496CarImg.swf', 'park/carimg/1223659496CarImgbig.gif', 2, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659496CarSign.gif', 108, NULL),
(417, 'CitroenC2', 'park/carimg/1223659509CarImg.swf', 'park/carimg/1223659509CarImgbig.gif', 4, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659509CarSign.gif', 108, NULL),
(418, 'CitroenC2', 'park/carimg/1223659521CarImg.swf', 'park/carimg/1223659521CarImgbig.gif', 1, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659521CarSign.gif', 108, 'park/carimg/1224656132CarImgMid.gif'),
(419, 'CitroenC2', 'park/carimg/1223659538CarImg.swf', 'park/carimg/1223659538CarImgbig.png', 6, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659538CarSign.gif', 108, NULL),
(420, 'CitroenC2', 'park/carimg/1223659552CarImg.swf', 'park/carimg/1223659552CarImgbig.gif', 5, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659552CarSign.gif', 101, NULL),
(421, 'CitroenC2', 'park/carimg/1223659563CarImg.swf', 'park/carimg/1223659563CarImgbig.gif', 3, 79000, 0, 1, 160, 1, 2, 'park/carimg/1223659563CarSign.gif', 101, NULL),
(422, 'Accord', 'park/carimg/1223659613CarImg.swf', 'park/carimg/1223659613CarImgbig.gif', 2, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659613CarSign.gif', 130, 'park/carimg/1224657116CarImgMid.gif'),
(423, 'Accord', 'park/carimg/1223659624CarImg.swf', 'park/carimg/1223659624CarImgbig.gif', 4, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659624CarSign.gif', 130, NULL),
(424, 'Accord', 'park/carimg/1223659639CarImg.swf', 'park/carimg/1223659639CarImgbig.gif', 1, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659639CarSign.gif', 130, NULL),
(425, 'Accord', 'park/carimg/1223659653CarImg.swf', 'park/carimg/1223659653CarImgbig.gif', 6, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659653CarSign.gif', 130, NULL),
(426, 'Accord', 'park/carimg/1223659667CarImg.swf', 'park/carimg/1223659667CarImgbig.gif', 5, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659667CarSign.gif', 130, NULL),
(427, 'Accord', 'park/carimg/1223659678CarImg.swf', 'park/carimg/1223659678CarImgbig.gif', 3, 199000, 0, 1, 200, 2, 2, 'park/carimg/1223659678CarSign.gif', 130, NULL),
(428, 'Arnage728', 'park/carimg/1223659745CarImg.swf', 'park/carimg/1223659745CarImgbig.gif', 2, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659745CarSign.gif', 8003, NULL),
(429, 'Arnage728', 'park/carimg/1223659758CarImg.swf', 'park/carimg/1223659758CarImgbig.gif', 4, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659758CarSign.gif', 8003, 'park/carimg/1224659158CarImgMid.gif'),
(430, 'Arnage728', 'park/carimg/1223659770CarImg.swf', 'park/carimg/1223659770CarImgbig.gif', 1, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659770CarSign.gif', 8003, NULL),
(431, 'Arnage728', 'park/carimg/1223659785CarImg.swf', 'park/carimg/1223659785CarImgbig.gif', 6, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659785CarSign.gif', 8003, NULL),
(432, 'Arnage728', 'park/carimg/1223659799CarImg.swf', 'park/carimg/1223659799CarImgbig.gif', 5, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659799CarSign.gif', 8003, NULL),
(433, 'Arnage728', 'park/carimg/1223659812CarImg.swf', 'park/carimg/1223659812CarImgbig.gif', 3, 8388607, 0, 4, 300, 10, 10, 'park/carimg/1223659812CarSign.gif', 8003, NULL),
(434, 'SWIFT', 'park/carimg/1223659874CarImg.swf', 'park/carimg/1223659874CarImgbig.gif', 2, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659874CarSign.gif', 106, NULL),
(435, 'SWIFT', 'park/carimg/1223659886CarImg.swf', 'park/carimg/1223659885CarImgbig.gif', 4, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659886CarSign.gif', 106, NULL),
(436, 'SWIFT', 'park/carimg/1223659902CarImg.swf', 'park/carimg/1223659902CarImgbig.gif', 1, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659902CarSign.gif', 106, 'park/carimg/1224656066CarImgMid.gif'),
(437, 'SWIFT', 'park/carimg/1223659914CarImg.swf', 'park/carimg/1223659914CarImgbig.gif', 6, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659914CarSign.gif', 106, NULL),
(438, 'SWIFT', 'park/carimg/1223659930CarImg.swf', 'park/carimg/1223659930CarImgbig.gif', 5, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659930CarSign.gif', 106, NULL),
(439, 'SWIFT', 'park/carimg/1223659942CarImg.swf', 'park/carimg/1223659942CarImgbig.gif', 3, 69000, 0, 1, 140, 1, 2, 'park/carimg/1223659942CarSign.gif', 106, NULL)
	";	
$sql[] = "
INSERT INTO `".$tablepre."park_stage` (`StageID`, `StageName`, `StageImg`, `StagePrice`, `StageIntr`, `StageScript`, `StageType`, `StageUse`, `noAjax`, `noOpen`) VALUES
(1, 'Shopping', 'park/carimg/1223722203StageImg.gif', 10000, 'Get 10 percent discount for buying a new car', 'parkApp.php?ac=market', 1, 1, 1, 1),
(2, 'Confiscate', 'park/carimg/1223722599StageImg.gif', 200000, 'Confiscate a random car from your friend list', 'cpPark.php?ac=stage&op=forfeit', 1, 1, 0, 0),
(3, 'Villa', 'park/carimg/1223722878StageImg.gif', 2600000, 'Upgrade your park to villa, the income will increase 5 gold per minute', 'cpPark.php?ac=stage&op=changebg', 1, 1, 0, 0),
(4, 'Villa-EX', 'park/carimg/1223722963StageImg.gif', 3200000, 'Upgrade your park to villa EX, the income will increase 6 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(5, 'Anti-confiscate', 'park/carimg/1224225555StageImg.gif', 200000, 'Prevent your car from being confiscated', '', 1, 1, 0, 0),
(6, 'Castle', 'park/carimg/1223723063StageImg.gif', 6600000, 'Upgrade your park to Castle, the income will increase 9 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(7, 'Beach', 'park/carimg/1223723109StageImg.gif', 1200000, 'Upgrade your park to beach, the income will increase 4 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(8, 'Bribe', 'park/carimg/1223723166StageImg.gif', 90000, 'Bribe the cop to decrease the odds of receiving their ticket', '', 1, 1, 0, 0),
(9, 'Bar', 'park/carimg/1223723202StageImg.gif', 1000000, 'Upgrade your park to a bar, the income will increase 3 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(10, 'Discount', 'park/carimg/1223723265StageImg.gif', 10000, 'Get 50 percent discount for buying a 2nd-hand car', 'parkApp.php?ac=oldmarket', 1, 1, 1, 0),
(11, 'Cabin', 'park/carimg/1223723317StageImg.gif', 500000, 'Upgrade your park to a cabin, the income will increase 1 gold per minute', 'cpPark.php?ac=stage&op=changebg', 1, 1, 0, 0),
(12, 'Cabin-EX', 'park/carimg/1223723356StageImg.gif', 800000, 'Upgrade your park to cabin EX, the income will increase 2 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(13, 'Anonymous', 'park/carimg/1223723433StageImg.gif', 10000, 'Report illegalparking to cop with anonymous', 'cpPark.php?ac=stage&op=nonamewarn', 1, 1, 0, 0),
(14, 'Courtyard', 'park/carimg/1223723483StageImg.gif', 4800000, 'Upgrade your park to Courtyard, the income will increase 7 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(15, 'Courtyard-EX', 'park/carimg/1223723535StageImg.gif', 5600000, 'Upgrade your park to Courtyard EX, the income will increase 8 gold per minute', 'cpPark.php?ac=stage&op=changebg', 0, 0, 0, 0),
(16, 'Castle-EX', 'park/carimg/1224122242StageImg.gif', 8800000, 'Upgrade your park to Castle EX, the income will increase 10 gold per minute', '', 0, 0, 0, 0)
";	
$sql[] = "update `".$tablepre."park_record` set carid=81 where carid=2";
$sql[] = "update `".$tablepre."park_mycar` set carid=81 where carid=2";
$sql[] = "UPDATE `".$tablepre."config` SET `datavalue` = 'gohooh' WHERE `".$tablepre."config`.`var` = 'template'";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."wish_content`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."wish_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `username` varchar(50) DEFAULT NULL,
  `sender` varchar(50) DEFAULT NULL,
  `sendname` varchar(50) DEFAULT '',
  `receiver_uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `receiver` varchar(50) DEFAULT NULL,
  `color` varchar(10) DEFAULT '',
  `img` varchar(10) DEFAULT NULL,
  `content` varchar(150) DEFAULT NULL,
  `notice_uid` mediumint(9) NOT NULL DEFAULT '0',
  `ip` varchar(20) DEFAULT NULL,
  `sendTime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ".$type." AUTO_INCREMENT=0;";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."wish_member`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."wish_member` (
  `uid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `dateline` datetime DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."app_tw_gift`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."app_tw_gift` (
  `id` int(11) NOT NULL auto_increment,
  `uid` mediumint(8) default NULL,
  `username` varchar(50) default NULL,
  `touid` mediumint(8) NOT NULL,
  `tousername` varchar(50) NOT NULL,
  `message` varchar(250) default NULL,
  `gift` varchar(100) NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `touid` (`touid`),
  KEY `touid2` (`touid`,`dateline`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."app_ask`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."app_ask` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `typeid` smallint(4) NOT NULL default '0',
  `uid` int(11) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `content` text,
  `tag` varchar(250) default NULL,
  `dateline` int(11) NOT NULL default '0',
  `score` smallint(4) NOT NULL default '0',
  `view_count` int(11) NOT NULL default '0',
  `reply_count` int(11) NOT NULL default '0',
  `status` smallint(1) NOT NULL default '0',
  `msg` text,
  PRIMARY KEY  (`id`),
  KEY `typeid` (`typeid`)
) ".$type.";";
$sql[]="DROP TABLE IF EXISTS `".$tablepre."app_ask_reply`";
$sql[] = "
CREATE TABLE IF NOT EXISTS `".$tablepre."app_ask_reply` (
  `id` int(11) NOT NULL auto_increment,
  `ask_id` int(11) NOT NULL default '0',
  `content` text NOT NULL,
  `uid` int(11) NOT NULL default '0',
  `username` varchar(50) NOT NULL default '',
  `score` smallint(4) NOT NULL default '0',
  `dateline` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `ask_id` (`ask_id`)
) ".$type.";";
for($i=0; $i<COUNT($sql); $i++){	
	$_SGLOBAL['db']->query($sql[$i]);
	$complete=intval($i+1)."/".intval(COUNT($sql))." ... hoàn thành <br>";
	echo $complete;
}
	echo ('<br><br><font color="red">Chúc mừng! Bạn đã cài đặt hoàn tất <font color="blue">UCenter Home GoHooH Full</font> (full mod, full game, full skin) - hack bởi <a href="http://www.gohooh.com/" target="_blank">GoHooH.CoM</a> - Trang web hỗ trợ chính thức của Ucenter Home tại Việt Nam.</font>
		<br>Để bảo mật dữ liệu của bạn, xin vui lòng truy cập vào host và xóa thư mục "install"<br><br>
		Thông tin về quản trị viên đã được tạo, tiếp theo bạn có thể:<br>
		<br><a href="http://link.gohooh.com/f1223c" target="_blank">Xem hướng dẫn về gói Ucenter Home GoHooH Full</a> | <a href="http://www.gohooh.com/forum/index.php?gid=172" target="_blank">Skin, mod, game, plugins Ucenter home</a>
		<br>Ghé thăm trang web chính thức hỗ trợ Ucenter Home tại Việt Nam: <a href="http://www.gohooh.com/forum/" target="_blank">GoHooH.CoM</a>
		<br>Xem demo về mạng xã hội chuẩn: <a href="http://www.gohooh.com/nhatui/" target="_blank">GoHooH Nhà Tui</a>
		<br><br>Các thông tin của bạn:
		<br><a href="../space.php" target="_blank">Truy cập vào không gian</a>
		<br><a href="../admincp.php" target="_blank">Quản lý Ucenter home</a>');
@unlink("gohooh.com.php");
?>
</body>
</html>