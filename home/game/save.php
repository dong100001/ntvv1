<?php 
//WWW.GoHooH.CoM - Discuz! Việt - Ucenter Home Việt

//���»session
if($_SGLOBAL['supe_uid']) {
        getmember(); //��ȡ��ǰ�û���Ϣ
		realname_set($_SGLOBAL['supe_uid'], $_SGLOBAL['supe_username']);
       updatetable('session', array('lastactivity' => $_SGLOBAL['timestamp']), array('uid'=>$_SGLOBAL['supe_uid']));
}

$uid = $_SGLOBAL['member']['uid'];
$score = intval($_POST['gscore']);

$type = $_POST['gtype'];
$gtime = $_SGLOBAL['timestamp'];

if(empty($score) || $score <= 0)
	showmessage('Bạn chưa có điểm để lưu, hãy quay lại chơi tiếp nhé!',"gohoohgame.php?back=1&fgid=$fgid");
	
	
$tys = array('single','double');

if(empty($type) && in_array($type,$tys))
	showmessage('Hãy quay lại chơi '.$gamename.' tiếp nhé!','gohoohgame.php?back=1&fgid='.$fgid);

$sql = "SELECT score FROM ".tname("app_game")." WHERE game_id='".$fgid."' and uid=".$uid;
$query = $_SGLOBAL['db']->query( $sql );
$query = $_SGLOBAL['db']->fetch_array($query);

$tmpArr = is_array($query)?$query['score']:0;

if(is_array($query)) {
	//����FEED
	$icon = 'game';
	$title_template = '{actor} chơi game  <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> rất thú vị. Bạn có muốn thử sức?';
	$body_template	= '<a href="gohoohgame.php?fgid='.$fgid.'"><img src="./game/img/game_'.$fgid.'.gif" alt="'.$gamename.'" class="summaryimg"/></a> <div class="detail">{actor} mời bạn cùng chơi game <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> ở <a href="http://www.gohooh.com/nhatui/" target="_blank">Nhà Tui</a></span></div>';
	feed_add($icon, $title_template, $body_template,$body_template);
	
	if($score<$tmpArr) {
		showmessage('Điểm của bạn chưa chưa hơn điểm lần chơi trước, hãy cố gắng nhé!','gohoohgame.php?back=1&fgid='.$fgid);
	} else {
		$_SGLOBAL['db']->query("UPDATE ".tname("app_game")." SET `score` = '".$score."',`gtime` = '".$gtime."' WHERE uid =".$uid." AND game_id='".$fgid."'");
		showmessage('Bạn đã phá kỷ lục rồi, xin chúc mừng.','gohoohgame.php?back=1&fgid='.$fgid); 
	}	
} else {
	//����FEED
	$icon = 'game';
	$title_template = '{actor} phá kỷ lục game <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> với số điểm là '.$score.' điểm. Bạn có muốn thử sức?';
	$title_data = array($score);
	$title_data	= '<a href="gohoohgame.php?fgid='.$fgid.'"><img src="./game/img/game_'.$fgid.'.gif" alt="'.$gamename.'" class="summaryimg"/></a> <div class="quote"><span class="q">{actor} mời bạn cùng chơi game <a href="gohoohgame.php?fgid='.$fgid.'">'.$gamename.'</a> ở <a href="http://www.gohooh.com/nhatui/" target="_blank">Nhà Tui</a></span></div>';
	feed_add($icon, $title_template, '',$title_data);
	
	$_SGLOBAL['db']->query("INSERT INTO ".tname("app_game")." (`id`, `type`, `uid`, `score`, `gtime`, `game_id`) VALUES (NULL, '".$type."', '".$uid."', '".$score."', '".$gtime."', '".$fgid."')");
	showmessage('Điểm của bạn đã được lưu, hãy tiếp tục chơi nhé!','gohoohgame.php?back=1&fgid='.$fgid); 
}


?>