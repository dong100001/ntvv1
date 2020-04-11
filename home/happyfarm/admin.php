<?php
/*************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com

include_once("common.php");
header("Content-Type:text/html; charset=" . FARM_ENCODE);

function FarmMSG($msg) {
	$referer = $_SERVER['HTTP_REFERER'] ? $_SERVER['HTTP_REFERER'] : 'admin.php?do=home';
	echo <<<HTML
	{$msg} <a href="{$referer}">Quay lại</a>
HTML;
	exit();
}

//检查权限
if($farmdeny_msg = farmdeny(1)) {
	die('0|&|'.$farmdeny_msg);
}
if(!checkperm('managead')) {
	die('0|&|Bạn không có quyền vào đây..');
}

//顶部菜单参数
$showMenu = true;
$act = 'admin';

//获取动作
$do = in_array($_GET['do'], array(
		'home','list','edit','delete','weeb','bed','exchange'
	)) ? $_GET['do'] : 'home';

include_once(FARM_ROOT ."/admin/{$do}.php");

?>
