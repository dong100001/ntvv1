<?php
/*
	Game siÃªu thá»‹ báº¡n bÃ¨ Ä‘Æ°á»£c phÃ¡t triá»ƒn bá»Ÿi GoHooH.CoM
	Vui lÃ²ng giá»¯ báº£n quyá»n Viá»‡t hÃ³a cá»§a GoHooH.Com
	CÃ¡m Æ¡n báº¡n Ä‘Ã£ sá»­ dá»¥ng sáº£n pháº©m cá»§a GoHooH.CoM
*/

function comGetCategoryList($tblname){
	global $_SGLOBAL;
	$catsql = "SELECT * FROM ".tname($tblname)." ORDER BY seqno";
	$catsql = $_SGLOBAL['db']->query($catsql);

	while ($value = $_SGLOBAL['db']->fetch_array($catsql)) {
		$catlist[] = $value;
	}
	return $catlist;
}

//·ÖÀàÄ¿Â¼
function comShowCategory($tblname, $link){
	global $_SGLOBAL;
	//·ÖÀà
	$catsql = "SELECT * FROM ".tname($tblname)." ORDER BY seqno";
	$catsql = $_SGLOBAL['db']->query($catsql);


	foreach($link AS $key=>$value){
		if($key!="com" AND $key!="catid"){
			$linkget .= "&$key=$value";			
		}
	}

	$comcatlist[0][link] = "sieuthigoer.php?com=".$link[com]."&catid=".$linkget;
	$comcatlist[0][catname] = comlang('all_category');
	if(empty($link[catid])){
		$comcatlist[0][active] = " class='active' ";
	}

	while ($value = $_SGLOBAL['db']->fetch_array($catsql)) {
		if($link[catid] == $value[id]){
			$value[active]= "class=active";
		}
		$catlink = "sieuthigoer.php?com=".$link[com]."&catid=".$value[id].$linkget;
		$value[link] = $catlink;
		$comcatlist[] = $value;
	}

	return $comcatlist;
}

function getCommentData($tblname, $wheresql="", $orderby="", $limit=""){
	global $_SGLOBAL;
	//¶ÁÈ¡Í¶Æ±Êý¾Ý
	$query = "SELECT * FROM ".tname($tblname)." $wheresql $orderby $limit";
	$query = $_SGLOBAL['db']->query($query);

	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$subcommentlist = "";
		$countreply=0;

		$subquery = "SELECT * FROM ".tname($tblname)." WHERE replyid='".$value[id]."' AND replyid!=0";
		$subquery = $_SGLOBAL['db']->query($subquery);

		while ($subvalue = $_SGLOBAL['db']->fetch_array($subquery)) {
			$countreply++;
			$subvalue[count] = $countreply;
			$subvalue[message] = comReplaceSmiley($subvalue[message]);
			$subcommentlist[] = $subvalue;
		}

		$count++;
		$value[count] = $count;
		$value[message] = comReplaceSmiley($value[message]);
		$value[countreply] = $countreply;
		$value[subcomment] = $subcommentlist;
		$commentlist[] = $value;
	}
	return $commentlist;
}

function getCommentCount($tblname, $wheresql="", $orderby="", $limit=""){
	global $_SGLOBAL;
	//¶ÁÈ¡Í¶Æ±Êý¾Ý
	$query = "SELECT count(id) AS count FROM ".tname($tblname)." $wheresql $orderby $limit";
	$query = $_SGLOBAL['db']->query($query);
	$value = $_SGLOBAL['db']->fetch_array($query);
	return $value[count];
}


function comFunctionList($query){
	global $_SGLOBAL, $listctrl;

	//¶ÁÈ¡Êý¾Ý
	$query = $_SGLOBAL['db']->query($query);

	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$count++;
		$value[titlelink] = $listctrl[titlelink]."&$listctrl[linkid]=".$value[$listctrl[linkid]];
		$value[toggleid] = $listctrl[togglename]."_".$count;
		$value[count] = $count;
		$comlist[] = $value;
	}
	return $comlist;
}

// Smiley Replace Function
function comReplaceSmiley($string){

	$smileyarr = array(
		":)" => "smile",	
		":(" => "sad",	
		":D" => "biggrin",	
		":'(" => "cry",	
		":@" => "huffy",	
		":o" => "shocked",	
		":P" => "tongue",	
		":$" => "shy",	
		";P" => "titter",	
		":L" => "sweat",	
		":Q" => "mad",	
		":lol" => "lol",	
		":hug:" => "hug",	
		":victory:" => "victory",	
		":time:" => "time",	
		":kiss:" => "kiss",	
		":handshake" => "handshake",	
		":call:" => "call",	
		":loveliness:" => "loveliness",	
		":funk:" => "funk"	
	);

	foreach($smileyarr as $key => $value){
		$string = str_replace($key, "<img src='components/smiley/$value.gif'>", $string);
	}
	return $string;
}

//»ñµÃÓïÑÔ
function comlang($key, $vars=array()) {
	global $_SGLOBAL;

	if(isset($_SGLOBAL['comlang'][$key])) {
		$result = comlang_replace($_SGLOBAL['comlang'][$key], $vars);
	} else {
		$result = $key;
	}
	return $result;
}

//ÓïÑÔÌæ»»
function comlang_replace($text, $vars) {
	if($vars) {
		foreach ($vars as $k => $v) {
			$rk = $k + 1;
			$text = str_replace('\\'.$rk, $v, $text);
		}
	}
	return $text;
}

// ¸ù¾ÝÓÃ»§µÄ uid µÃµ½ avatar/home Ä¿Â¼
function comGetAvatar($uid, $size = 'middle') {
	$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
	$uid = abs(intval($uid));
	$uid = sprintf("%09d", $uid);
	$dir1 = substr($uid, 0, 3);
	$dir2 = substr($uid, 3, 2);
	$dir3 = substr($uid, 5, 2);
	return $dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2)."_avatar_$size.jpg";
}

//¼ì²éÓÃ»§¸öÈË×ÊÁÏ
function getUserSpaceField($uid){
	global $_SGLOBAL;
	$query = "SELECT * FROM ".tname('spacefield')." WHERE uid=$uid";
	$query = $_SGLOBAL['db']->query($query);
	$value = $_SGLOBAL['db']->fetch_array($query);
	return $value;
}

//»ñÈ¡ÓÃ»§¸öÈË×ÊÁÏ
function comGetUserInfo($uid){
	global $_SGLOBAL;
	$query = "SELECT * FROM ".tname('space')." WHERE uid=$uid";
	$query = $_SGLOBAL['db']->query($query);
	$value = $_SGLOBAL['db']->fetch_array($query);
	return $value;
}

function comSendmail($touid, $subject, $message, $fromuid=0){
	include_once(S_ROOT.'./source/function_sendmail.php');
	global $_SGLOBAL, $space, $SITE;

	$site = comGetSiteConfig();

	$tosql = "SELECT space.username AS username, space.name AS name, sfield.email AS email FROM ".tname('space')." AS space, " .tname('spacefield')." AS sfield WHERE space.uid = sfield.uid AND space.uid=$touid";
	$query = $_SGLOBAL['db']->query($tosql);
	$touser = $_SGLOBAL['db']->fetch_array($query);

	if($fromuid!=0){
		$fromsql = "SELECT space.username AS username, space.name AS name, sfield.email AS email FROM ".tname('space')." AS space, " .tname('spacefield')." AS sfield WHERE space.uid = sfield.uid AND   space.uid=$fromuid";
		$query = $_SGLOBAL['db']->query($fromsql);
		$fromuser = $_SGLOBAL['db']->fetch_array($query);
	} else {
		$fromuser[username] = $site[sitename];
		$fromuser[email] = $site[adminemail];
	}

	$mailarr = array();
	$tmp['email'] = $touser[email];
	$mailarr[] = $tmp['email'];

	$username = $space[username];
	$email = $space[email];
	$spacename = $space[name];
	
	$message .= "\n\n".$site[sitename]."\n".$site[siteallurl];

	$from = $fromuser[username]."<".$fromuser[email].">";
	sendmail($mailarr, $subject, $message, $from);
}

function comGetSiteConfig(){
	global $_SGLOBAL;
	$sitesql = "SELECT * FROM ".tname('config');
	$query = $_SGLOBAL['db']->query($sitesql);
	WHILE($value = $_SGLOBAL['db']->fetch_array($query)){
		$var = $value['var'];
		$site[$var] = $value['datavalue'];
	}
	return $site;
}

function comUpdateTime($uid=0){
	global $_SGLOBAL;
	if($uid==0){
		$uid = $_SGLOBAL[supe_uid];
	} 
	//¸üÐÂ×îºó·¢²¼Ê±¼ä
	$_SGLOBAL['db']->query("UPDATE ".tname('space')." SET updatetime='$_SGLOBAL[timestamp]' WHERE uid='$uid'");
}

function comCheckLicenseKey($keyname){
	global $_SGLOBAL;
	$licensekey = "SELECT * FROM ".tname('com_licenses');
	$query = $_SGLOBAL['db']->query($licensekey);
	WHILE($value = $_SGLOBAL['db']->fetch_array($query)){
		$name = $value['name'];
		if($keyname == $name) {
			$flag = 1;
		}
	}
	return $flag;
}
?>