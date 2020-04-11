<?php
/*
	Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
	Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
	Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
*/
include_once('../common.php');

$tablepre = $_SC['tablepre'];
$charset = $_SC['charset'];

if($charset=="utf-8" OR $charset=="UTF-8"){
	$charset = "utf8";
}

$sql_1 = "

CREATE TABLE IF NOT EXISTS `".$tablepre."com_licenses` (
  `id` tinyint(3) NOT NULL auto_increment,
  `name` varchar(80) NOT NULL default '',
  `key` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=1 ;

";

$sql_2 = "

CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_history` (
  `id` int(10) NOT NULL auto_increment,
  `cat` tinyint(1) NOT NULL default '0',
  `taskid` mediumint(8) NOT NULL default '0',
  `uid` mediumint(8) NOT NULL default '0',
  `muid` mediumint(8) NOT NULL default '0',
  `message` text character set $charset NOT NULL,
  `created` int(10) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=1 ;

";

$sql_3 = "

CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_main` (
  `id` int(10) NOT NULL auto_increment,
  `uid` mediumint(8) NOT NULL default '0',
  `username` varchar(15) character set $charset NOT NULL default '',
  `nickname` varchar(50) character set $charset NOT NULL default '',
  `aboutme` tinytext character set $charset NOT NULL,
  `level` tinyint(2) NOT NULL default '0',
  `pvalue` int(10) NOT NULL default '0',
  `cash` int(10) NOT NULL default '0',
  `slave` mediumint(4) NOT NULL default '0',
  `collection` text character set $charset NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=1 ;

";

$sql_4 = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_luck` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` mediumtext character set $charset NOT NULL,
  `amount` varchar(8) character set $charset NOT NULL default '',
  `range` mediumint(8) NOT NULL default '0',
  `percent` tinyint(3) NOT NULL default '0',
  `perday` tinyint(2) NOT NULL default '0',
  `education` char(3) NOT NULL default '',
  `experience` char(3) NOT NULL default '',
  `health` char(3) NOT NULL default '',
  `loyalty` char(3) NOT NULL default '',
  `mood` char(3) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=11 ;

";

$sql_5 = "

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
(10, 'Bạn cùng ăn tối với 1 người bạn lâu ngày không gặp và tốn [money] đồng', '-300', 180, 1, 1, '0', '0', '0', '0', '-3');

";

$sql_6 = "

CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_taskcat` (
  `id` int(11) NOT NULL auto_increment,
  `seqno` tinyint(2) NOT NULL default '0',
  `catname` varchar(60) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=8 ;

";

$sql_7 = "

INSERT INTO `".$tablepre."com_slave_taskcat` (`id`, `seqno`, `catname`) VALUES
(1, 0, 'Học tập'),
(2, 1, 'Làm việc'),
(3, 2, 'Giải trí'),
(4, 3, 'Thưởng'),
(5, 4, 'Ưu đãi'),
(6, 5, 'Trừng phạt'),
(7, 6, 'Khác');

";

$sql_8 = "
CREATE TABLE IF NOT EXISTS `".$tablepre."com_slave_task` (
  `id` mediumint(8) NOT NULL auto_increment,
  `name` mediumtext character set $charset NOT NULL,
  `mastertext` varchar(255) character set $charset NOT NULL default '',
  `slavetext` varchar(255) character set $charset NOT NULL default '',
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
) ENGINE=MyISAM  DEFAULT CHARSET=$charset AUTO_INCREMENT=34 ;

";

$sql_9 = "

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
(33, 'Thi hoa hậu', '[master] dùng [money] đồng để cho [slave] đi thi hoa hậu', '', -500, 7, 200, 0, 1, 0, 0, 0, 0, -1, -5);

";

for($i=1; $i<10; $i++){
	$tsql = "sql_$i";
	$_SGLOBAL['db']->query($$tsql);
}

echo "
<html>
	<head>
		<meta http-equiv=\"content-type\" content=\"text/html; charset=".$_SC['charset']."\" />
	</head>
	<body>
		GoHooH.CoM: Cài đặt thành công. Vui lòng xóa file cài đặt.
	</body>
</html>";
?>