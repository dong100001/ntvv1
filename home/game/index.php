<?php
//WWW.GoHooH.CoM - Discuz! Vi·ªát - Ucenter Home Vi·ªát

if ( !defined( "IN_UCHOME" ) ) exit( "Access Denied" );

//∏¸–¬ªÓ∂Øsession
if($_SGLOBAL['supe_uid']) {
        getmember(); //ªÒ»°µ±«∞”√ªß–≈œ¢
		realname_set($_SGLOBAL['supe_uid'], $_SGLOBAL['supe_username']);
        updatetable('session', array('lastactivity' => $_SGLOBAL['timestamp']), array('uid'=>$_SGLOBAL['supe_uid']));
}

//ªÒ»°≈≈––∫Õ◊Ó∏ﬂ∑÷
$query = $_SGLOBAL['db']->query("SELECT uid,score FROM ".tname('app_game')." WHERE game_id=".$fgid." ORDER BY score DESC,gtime ASC");//œ‘ æ◊Ó–¬∂ØÃ¨
$allrk = 0;$myrk = 0;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	$allrk++;
	realname_set($value['uid'], $value['username']);
	if($myrk == 0) $myrk = ($uid==$value['uid'])?$allrk:0;
	if($uid==$value['uid']) $score = $value['score'];
	
}

//WWW.GoHooH.CoM - Discuz! Vi·ªát - Ucenter Home Vi·ªát
//ªÒ»°24–° ±≈≈––TOP10
$dayrktopArr = array();
$tmptime = $_SGLOBAL['timestamp']-(86400*1);

$query = $_SGLOBAL['db']->query("SELECT w.uid,w.score,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid and gtime>".$tmptime."  AND w.game_id=".$fgid." ORDER BY score DESC,gtime ASC LIMIT 0 , 10");
$i=1;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'], $value['username']);
	$dayrktopArr[$i] = $value;
	$i++;
}


//ªÒ»°±æ÷‹≈≈––TOP10
$weekrktopArr = array();
$tmptime = $_SGLOBAL['timestamp']-(86400*7);

$query = $_SGLOBAL['db']->query("SELECT w.uid,w.score,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid and gtime>".$tmptime." AND w.game_id=".$fgid." ORDER BY score DESC,gtime ASC LIMIT 0 , 10");
$i=1;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'], $value['username']);
	$weekrktopArr[$i] = $value;
	$i++;
}

//---end  


//ªÒ»°±æ‘¬≈≈––TOP10
$mrktopArr = array();
$tmptime = $_SGLOBAL['timestamp']-(86400*30);

$query = $_SGLOBAL['db']->query("SELECT w.uid,w.score,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid and gtime>".$tmptime." AND w.game_id=".$fgid." ORDER BY score DESC,gtime ASC LIMIT 0 , 10");
$i=1;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'], $value['username']);
	$mrktopArr[$i] = $value;
	$i++;
}

//»´≤ø≈≈––TOP10
$aarktopArr = array();
$query = $_SGLOBAL['db']->query("SELECT w.uid,w.score,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid AND w.game_id=".$fgid." ORDER BY score DESC,gtime ASC LIMIT 0 , 3");
$i=1;
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'], $value['username']);
	$aarktopArr[$i] = $value;
	$i++;
}

//◊ÓΩ¸ÕÊπ˝µƒÕÊº“
$reArr = array();
//echo "SELECT w.uid,u.username FROM ".tname('app_game')." as w,".tname('feed')." as u WHERE u.uid=w.uid ORDER BY gtime ASC LIMIT 0 , 21";
$query = $_SGLOBAL['db']->query("SELECT w.uid,u.username FROM ".tname('app_game')." as w,".tname('space')." as u WHERE u.uid=w.uid AND w.game_id=".$fgid." ORDER BY gtime DESC LIMIT 0 , 21");
while ($value = $_SGLOBAL['db']->fetch_array($query)) {
	realname_set($value['uid'],$value['nsername']);
	$value['avatar'] = avatar($value['uid'], $size='small');
	$reArr[] = $value;
}

if(empty($_GET['back']))
{
	//Õ≠›ìFEED
	$icon = 'game';
	$title_template = '{actor} ch∆°i game <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> r·∫•t th√∫ v·ªã. B·∫°n c√≥ mu·ªën ch∆°i?';
	$title_data	= '<a href="gohoohgame.php?fgid='.$fgid.'"><img src="./game/img/game_'.$fgid.'.gif" alt="'.$gamename.'" class="summaryimg"/></a> <div class="detail">{actor} m·ªùi b·∫°n c√πng ch∆°i game <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> ·ªü <a href="http://www.gohooh.com/nhatui/" target="_blank">Nh√† Tui</a></span></div>';
	feed_add($icon, $title_template, '',$title_data);
	
}

include_once(template("game/view/index"));

?>

