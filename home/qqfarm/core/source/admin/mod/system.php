<?php

# 系统配置

if($_GET['submit'] == 1) {
	//系统配置参数
	$_QSC['friendType'] = (int)$_POST['friendType'];
	$_QSC['closefarm'] = (int)$_POST['closefarm'];
	$_QSC['vip'] = (int)$_POST['vip'];
	$_QSC['avatarStatic'] = (int)$_POST['avatarStatic'];
	$_QSC['closeinfo'] = $_POST['closeinfo'];
	$_QSC['missionName'] = $_POST['missionName'];
	$_QSC['view']['player'] = (int)$_POST['view_player'];
	$_QSC['adminer'] = explode(',', $_POST['adminer']);
	//用户初始化参数
	$_INIT['money'] = (int)$_POST['init_money'];
	$_INIT['yb'] = (int)$_POST['init_yb'];
	$_INIT['nc_exp'] = (int)$_POST['init_nc_exp'];
	$_INIT['mc_exp'] = (int)$_POST['init_mc_exp'];
	//隐藏种子和装饰
	$_HIDE['seed'] = explode(',', $_POST['hide_seed']);
	$_HIDE['item'] = explode(',', $_POST['hide_item']);
	//验证参数有效性
	qf_getCache('cropstype', '/nc/');
	$crop = array_keys($cropstype);
	$noCrop = array_diff($_HIDE['seed'], array_intersect($_HIDE['seed'], $crop));
	if($noCrop) {
		die('0|&|修改失败: '.implode(',', $noCrop).'不是有效的种子ID.');
	}
	qf_getCache('itemtype', '/nc/');
	$item = array_keys($itemtype);
	$noItem = array_diff($_HIDE['item'], array_intersect($_HIDE['item'], $item));
	if($noItem) {
		die('0|&|修改失败: '.implode(',', $noItem).'不是有效的装饰ID.');
	}
	//保存系统配置
	if(qf_putCache('_QSC', $_QSC) && qf_putCache('_INIT', $_INIT) && qf_putCache('_HIDE', $_HIDE)) {
		die('1|&|修改成功|&|refresh');
	}
	die('0|&|修改失败');
}

qf_getCache('_INIT');
qf_getCache('_HIDE');
qf_getView("admin/system");

?>