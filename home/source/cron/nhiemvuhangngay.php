<?php

//每天(0点)要初始化的字段：

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set badnum=50");//放草、虫子
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set zong=0 ");//限制150次杀草、虫子
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set sfeedleft=30");//喂养30个萝卜
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set zong=0 ");//限制打100只蚊子
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_mc')." set badnum=0");//放蚊子25只
$_SGLOBAL['db']->query("UPDATE ".tname('happyfarm_nc')." set nc_d=1");//每天礼包

?>
