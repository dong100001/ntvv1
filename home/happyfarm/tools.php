<?php
/****************************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com

include_once("common.php");
header("Content-Type:text/html; charset=" . FARM_ENCODE);

farmdeny();

$query = $_SGLOBAL['db']->query("select yb,money  FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
while($value = $_SGLOBAL['db']->fetch_array($query)) {
	$yb1 = $value[yb]; 
	$money = $value[money]; 
}


//是否显示菜单
$showMenu = true;

$act = $_GET['act'] ? $_GET['act'] : 'setting';

if($act == "setting") {
	$query = $_SGLOBAL['db']->query("select setting1,setting2,setting3,setting4,setting5,setting6,yb FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
	while($value = $_SGLOBAL['db']->fetch_array($query)) {
		$list[] = $value;
	}
	if(FARM_ENCODE == "UTF-8") {
		$Tips_water_b = json_decode('"'.$list[0][setting6].'"');
		$Tips_weed_b = json_decode('"'.$list[0][setting1].'"');
		$Tips_pest_b = json_decode('"'.$list[0][setting2].'"');
		$Tips_weed_a = json_decode('"'.$list[0][setting3].'"');
		$Tips_pest_a = json_decode('"'.$list[0][setting4].'"');
	}
	else {
		$Tips_water_b = iconv("UTF-8", "GBK", json_decode("\"".str_replace("\\\u", "\\u", $list[0][setting6])."\""));
		$Tips_weed_b = iconv("UTF-8", "GBK", json_decode("\"".str_replace("\\\u", "\\u", $list[0][setting1])."\""));
		$Tips_pest_b = iconv("UTF-8", "GBK", json_decode("\"".str_replace("\\\u", "\\u", $list[0][setting2])."\""));
		$Tips_weed_a = iconv("UTF-8", "GBK", json_decode("\"".str_replace("\\\u", "\\u", $list[0][setting3])."\""));
		$Tips_pest_a = iconv("UTF-8", "GBK", json_decode("\"".str_replace("\\\u", "\\u", $list[0][setting4])."\""));
	}
	include(template("happyfarm/view/tools/setting"));
}

elseif($_REQUEST["act"] == "fertilizer") {
	$query = $_SGLOBAL['db']->query("select package FROM ".tname("happyfarm_mc")." where uid=".intval($_SGLOBAL['supe_uid']));
	while($value = $_SGLOBAL['db']->fetch_array($query)) {
		$packagelist = $value[package]; 
	}
	$packagelist1 = json_decode($packagelist);
	$i = 1506;
	$bb = $packagelist1->$i;
	if(!$bb) {$bb = 0;}
	$query = $_SGLOBAL['db']->query("select fruit  FROM ".tname("happyfarm_nc")." where uid=".intval($_SGLOBAL['supe_uid']));
	while($value = $_SGLOBAL['db']->fetch_array($query)) {
		$fruitlist = $value[fruit]; 
	}
	$fruitlist1 = json_decode($fruitlist);
	$j = 2;
	$blb = $fruitlist1->$j;
	if(!$blb) {$blb = 0;}
	include(template("happyfarm/view/tools/fertilizer"));
}

elseif($_REQUEST["act"] == "exchange") {
	include(template("happyfarm/view/tools/exchange"));
}

elseif($_REQUEST["act"] == "vip") {
	$query = $_SGLOBAL['db']->query("select vip  FROM ".tname("happyfarm_config")." where uid=".intval($_SGLOBAL['supe_uid']));
	while($value = $_SGLOBAL['db']->fetch_array($query)) {
		$vipNow = $value[vip]; 
	}
	$vipNext = $vipNow + 1;
	switch($vipNext) {
		case 1: $vipYB = 0; break;
		case 2: $vipYB = 50; break;
		case 3: $vipYB = 100; break;
		case 4: $vipYB = 200; break;
		case 5: $vipYB = 400; break;
		case 6: $vipYB = 1000; break;
		case 7: $vipYB = 1500; break;
	}
	include(template("happyfarm/view/tools/vip"));
}

else exit("Tham số lỗi");

?>