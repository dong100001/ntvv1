<?php 
//WWW.GoHooH.CoM - Discuz! Việt - Ucenter Home Việt
//Y!M: quannguyenphat
include_once('./common.php');
require_once './source/function_common.php';
include_once(S_ROOT.'./source/function_cp.php');
if(function_exists('xcache_set')){
	include_once(S_ROOT . '/source/class.cache_xcache.php');
}else{
	include_once(S_ROOT . '/source/class_cache.php');
}

//��ȡ��ǰ�û��Ŀռ���Ϣ
$space = getspace($_SGLOBAL['supe_uid']);
$fgid = isset($_GET['fgid']) ? intval($_GET['fgid']) : 0;

//������Ϸ
include_once(S_ROOT . './game/game_config.php');

//�Ƿ�ر�վ��
checkclose();
$uid = $_SGLOBAL['member']['uid'];
realname_get();
checklogin();
//����ķ���
$acs = array('home','index','discuss','share','help','order','save','friendorder');
$ac = (!empty($_GET['ac']) && in_array($_GET['ac'], $acs)) ? $_GET['ac'] : 'index';
foreach($acs as $v){
	$actives[$v] = '';
}

$actives[$ac] = ' class=active';
//��Ӵ���


$gamename = $fgame[$fgid]['gamename'];
$gameoperation = $fgame[$fgid]['operation'];
$flashurl =  $fgame[$fgid]['swf'];


include_once(S_ROOT."./game/{$ac}.php");
?>