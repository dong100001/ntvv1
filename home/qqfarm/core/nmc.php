<?php
//前台入口

include('common.php');
header('Content-Type:text/html; charset=utf-8');

//检查登录状态
if($auth = qf_checkauth()) {
	die($auth);
}


//获取参数
$type = in_array($_GET['type'], array('nc', 'mc', 'kn', 'mill')) ? $_GET['type'] : 'nc';

//NPC任务参数
if($_QSC['missionName']) {
	include("source/nc/mission/{$_QSC['missionName']}_vars.php");
}

//加载模板
qf_getView('nmc');

?>