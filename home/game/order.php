<?php 
//WWW.GoHooH.CoM - Discuz! Việt - Ucenter Home Việt


if ( !defined( "IN_UCHOME" ) ) exit( "Access Denied" );
$page = (isset($_GET['page']) && intval($_GET['page']) > 0 ) ? intval($_GET['page']) : 1;
$perpage = 8;
$start = ($page - 1 ) * $perpage;
$theurl = "gohoohgame.php?ac={$ac}&fgid=".$fgid;

$arktopArr = array();
$query = $_SGLOBAL['db']->query("SELECT w.uid,w.score,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid AND w.game_id='".$fgid."' ORDER BY score DESC,gtime ASC LIMIT $start , $perpage");

$i=$start+1;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'], $value['username']);
	$arktopArr[$i] = $value;
	$i++;
}
$query = $_SGLOBAL['db']->query("SELECT count(*) as num FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid AND w.game_id='".$fgid."'");
$query = $_SGLOBAL['db']->fetch_array($query);
$page = multi($query['num'], $perpage, $page, $theurl);

include_once( template( "game/view/order" ) );







?>