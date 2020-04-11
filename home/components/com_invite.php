<?php
/*
	Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
	Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
	Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
*/

include_once('./common.php');
include_once('shared/function_common.php');

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$appname = $_GET[app];

if(empty($_GET[uid])){
	$uid = $space[uid];
} else {
	$uid = $_GET[uid];
}

$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&uid=$uid";

$user = comGetUserInfo($uid);

if($user[name]){
	$username = $user[username]."(".$user[name].")";
}else{
	$username = $user[username];
}

$apps = array(

		'slave'	=> array(
							'name'			=> "Siêu thị Goer",
							'title'			=> $username." mời bạn tham gia siêu thị Goer",
							'com'			=> "slave",
							'image'			=> "",
							'success_msg'	=> "Mời bạn bè tham gia vào siêu thị Goer bạn sẽ đươc tiền thưởng<BR><BR><font color=red>Chú ý: chúng tôi kiểm tra bằng tay các lời mời của bạn. Nếu bạn gian lận thì sẽ bị xóa hết tất cả tài khoản, kể cả tài khoản đang dùng.</font>",
							'description'	=> "Bạn của bạn ".$username." mời bạn tham gia vào game Siêu thị bạn bè. ( http://www.gohooh.com/nhatui ).Trò chơi rất thú vị giúp thu hẹp khoảng cách và tăng khả năng đầu tư của bạn "
						),
);

$comp = $apps[slave];

//����һ���µ� cookies
$cookiename = $_GET[app]."invite";
$cookievalue = $_GET[uid];
setcookie($cookiename, $cookievalue, time()+2592000); 

include template('com_invite');

?>