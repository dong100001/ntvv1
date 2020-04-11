<?php
/*
	悬赏问答插件 for UCH 1.5 正式版
	版权所有： www.TechWeb.com.cn
	由"毛琳"改版 http://www.discuz.net/space.php?uid=1040662 
*/

//类别
$gEumsType = array(2=>'Tổng hợp', 3=>'Học tập', 4=>'Love', 5=>'Vui chơi', 6=>'Ăn uống', 7=>'Mua sắm', 8=>'IT', 9=>'Cuộc sống', 1 => 'Kinh doanh' );
//最大分值
$gMaxScore = 200;
//系统管理员ID，请修改成管理员ID，这样能删除所有人发布的问答
define("ADMIN_ID","1");	

include_once('./common.php');

//是否关闭站点
checkclose();
//获取当前用户的空间信息
$space = getspace($_SGLOBAL['supe_uid']);
//添加菜单
window_set('GoHooH Hỏi & Đáp', "gohoohhoidap.php"); 

//允许动作
$dos = array('ask', 'cp');
//允许的方法
$acs = array(
'ask' => array('index', 'post', 'view', 'cp'),
'cp' => array('post', 'update', 'del')
);


$gEumsStatus = array(1 => 'Chưa giải quyết', 2 => 'Đã giải quyết' );

//更新活动session
if($_SGLOBAL['supe_uid']) {
        getmember(); //获取当前用户信息
        updatetable('session', array('lastactivity' => $_SGLOBAL['timestamp']), array('uid'=>$_SGLOBAL['supe_uid']));
}

//添加窗口
window_set("GoHooH Hỏi & Đáp", 'gohoohhoidap.php');


//获取变量
$isinvite = 0;

$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos))? $_GET['do'] : 'ask';
$ac = (!empty($_GET['ac']) && in_array($_GET['ac'], $acs[$do])) ? $_GET['ac'] : 'index';
if (empty($do)) {
	showmessage('no_app_do' );
}

if( @file_exists(S_ROOT."./ask/ask_install.php") ) {
	$ac = "install";
}

//是否公开
checklogin();//需要登录

//获取空间
if(empty($_SGLOBAL['supe_uid'])) {
	ssetcookie('_refer', rawurlencode($_SERVER['REQUEST_URI']));
	showmessage('to_login', 'do.php?ac=login', 0);
}
$uid = $_SGLOBAL['supe_uid'];
 

function updatecredit($uid, $credit, $method='+')
{
	global $_SGLOBAL;
	$credit = intval($credit);
	if (empty($credit)) {
		return;
	}
	$sqlcredit = ($credit > 0) ? " {$method} {$credit} " : " {$method} {$credit} ";
	$newcredit = $num * $credit;
	$_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit=credit {$sqlcredit} WHERE uid = $uid ");
	//$_SGLOBAL['db']->query("UPDATE ".tname('session')." SET credit=credit {$sqlcredit} WHERE uid = $uid ");
}

//处理
include_once(S_ROOT."./ask/{$do}_{$ac}.php");
?>