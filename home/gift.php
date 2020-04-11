<?php

//显示设置
$_PERPAGE = 18; //礼品列表每页显示的条数
$_VPERPAGE = 10; //个人收到礼品的每页显示条数

include_once('./common.php');
include_once(S_ROOT.'./gift/source/common.php');
//是否关闭站点
checkclose();

//处理rewrite
if($_SCONFIG['allowrewrite'] && isset($_GET['rewrite'])) {
	$rws = explode('-', $_GET['rewrite']);
	if($rw_uid = intval($rws[0])) {
		$_GET['uid'] = $rw_uid;
	} else {
		$_GET['do'] = $rws[0];
	}
	if(isset($rws[1])) {
		$rw_count = count($rws);
		for ($rw_i=1; $rw_i<$rw_count; $rw_i=$rw_i+2) {
			$_GET[$rws[$rw_i]] = empty($rws[$rw_i+1])?'':$rws[$rw_i+1];
		}
	}
	unset($_GET['rewrite']);
}

//允许动作
$dos = array('index','list','send','view');

//获取变量
$isinvite = 0;
$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))?$_GET['do']:'index';

if( @file_exists(S_ROOT."./gift/gift_install.php") ) {
	$do = "install";
}

//是否公开
if(empty($isinvite) && empty($_SCONFIG['networkpublic'])) {
	checklogin();//需要登录
}

//获取空间
if(empty($_SGLOBAL['supe_uid'])) {
	ssetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	showmessage('to_login', 'do.php?ac=login', 0);
} else {
	$space = getspace($_SGLOBAL['supe_uid']);
}


//更新活动session
if($_SGLOBAL['supe_uid']) {
	updatetable('session', array('lastactivity' => $_SGLOBAL['timestamp']), array('uid'=>$_SGLOBAL['supe_uid']));
}


//处理
include_once(S_ROOT."./gift/gift_{$do}.php");

?>