<?php
/*
	Game siÃªu thá»‹ báº¡n bÃ¨ Ä‘Æ°á»£c phÃ¡t triá»ƒn bá»Ÿi GoHooH.CoM
	Vui lÃ²ng giá»¯ báº£n quyá»n Viá»‡t hÃ³a cá»§a GoHooH.Com
	CÃ¡m Æ¡n báº¡n Ä‘Ã£ sá»­ dá»¥ng sáº£n pháº©m cá»§a GoHooH.CoM
*/
include_once(S_ROOT.'./source/function_cp.php');
include_once('./common.php');
include_once(S_ROOT.'./components/shared/function_common.php');
include_once(S_ROOT.'./components/slave/language.php');
include_once(S_ROOT.'./components/slave/function.php');
include_once(S_ROOT.'./components/slave/config.php');

if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if(empty($_SGLOBAL['supe_uid'])) {
        showmessage('to_login');
}



//»ñµÃÓïÑÔ
function _comlang($key, $vars=array()) {
	global $_SGLOBAL;

	if(isset($key)) {
		$result = comlang_replace($key, $vars);
	} else {
		$result = $key;
	}
	return $result;
}

//¼ì²éÒ»ÌìÄÚÊêÉíÇé¿ö£¬Èç¹û×Ô¼ºÊêÉí£¬Ò»ÌìÄÚ²»ÔÙ±»ÂòÂô
function checkransomperday( $uid )
{
		global $SConfig;
		global $_SGLOBAL;
		$sotday = $_SGLOBAL['today'];
		$eotday = $_SGLOBAL['today'] + 86400;
		$query = "SELECT * FROM ".tname( "com_slave_history" )." WHERE cat=9 AND uid=".$uid.( " AND created BETWEEN ".$sotday." AND {$eotday}" );
		$query = $_SGLOBAL['db']->query( $query );
		while ( $value = $_SGLOBAL['db']->fetch_array( $query ) )
		{
				++$count;
		}
		return $count;
}



//Ìí¼Ó´°¿Ú
//window_set("Å«Á¥ÓÎÏ·", "sieuthigoer.php?com=slave", "image/icon/slave.gif");

//$icon = 'slave';
//$title_template = '{actor} ÕıÔÚÍæ<a href="sieuthigoer.php?com=slave">Å«Á¥ÂòÂôÓÎÏ·</a>';
//feed_add($icon, $title_template);

$id = $_GET['id'];
$uid = $_GET['uid'];
$username = $_GET['user'];
$op = $_GET['op'];
$ac = $_GET['ac'];
$catid = $_GET['catid'];
$cat = $_GET['cat'];
$sort = $_GET['sort'];
$range = $_GET['range'];
$sex = $_GET['sex'];

//¼¤»î±êÇ©
if(!empty($op)){
	$active[$op] = "class=active";
} else {
	$active['main'] = "class=active";
} 

if(!empty($sort)){
	$active[$sort] = "class=active";
}

//ÓÃ»§»ù±¾×ÊÁÏ
$myinfo = comSlaveGetUserInfo($space[uid],1);

//½ñÌìÊ±¼ä¿ªÊ¼Ïß
$_SGLOBAL['today'] = strtotime(date('Y-m-d'));

$invite_amount = number_format($SConfig[invite_amount]);

//-------------------»ı·Ö¶Ò»»----------------
if($op=="credits"){

	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸	

if($_POST[submitcredits]){
	$code=$_POST['code']; //ÂòÈë»òÂô³ö
	$tradenum=intval(trim($_POST['tradenum'])); //ÓÃ»§ÊäÈëÊıÖµ

	if (!$tradenum||empty($_POST['tradenum'])|| $_POST['tradenum']<1 ||strlen($_POST['tradenum'])>8) showmessage(_comlang($tradenum_err));

if ($code=='buycoin') { 

     $link = "cp.php?ac=task";//ÑûÇëÁ´½Ó

	if($space['credit']< intval($tradenum)) 
		
	showmessage(_comlang($buycoin_err,array($space['credit'],$tradenum,$link)));

     $_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit=credit-".$tradenum." WHERE uid='$_SGLOBAL[supe_uid]'");
    
     $_SGLOBAL['db']->query("UPDATE ".tname('com_slave_main')." SET cash=cash+".$tradenum*intval($SConfig['credits'])." WHERE uid='$_SGLOBAL[supe_uid]'");
   
	showmessage(_comlang($buycoin_successful,array($tradenum,$tradenum*intval($SConfig['credits']))), "sieuthigoer.php?com=slave&op=credits", 3);

}elseif($code=='sellcoin') {
 
     $link = "sieuthigoer.php?com=invite&app=slave";//ÑûÇëÁ´½Ó

    if($tradenum%intval($SConfig[credits])!=0) 
	showmessage(comlang('tradenum_round_err',array($SConfig[credits]))); //ÒªÇóÊäÈëÕûÊı

	
	if($tradenum<intval($myinfo[cash]))

    showmessage(_comlang($sellcoin_err,array($space['credit'],$tradenum,$link)));

	 $_SGLOBAL['db']->query("UPDATE ".tname('com_slave_main')." SET cash=cash-".$tradenum." WHERE uid='$_SGLOBAL[supe_uid]'");
     
	 $_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit=credit+".$tradenum/intval($SConfig['credits'])." WHERE uid='$_SGLOBAL[supe_uid]'");
       
	showmessage(comlang('sellcoin_successful',array($tradenum,$tradenum/intval($SConfig['credits']))), "sieuthigoer.php?com=slave&op=credits", 3);



	}


}

	
}


//-------------------°ïÖúÒ³Ãæ----------------
if($op=="help"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸
}

//-------------------°ïÖúÒ³Ãæ----------------
if($op=="setup"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸

	if($_POST[submitsetup]){

		$catarr = array('memail', 'mfeed', 'mnotice', 'semail', 'sfeed', 'snotice', 'friend');
		foreach ($catarr as $cat) {
			$$cat = $_POST[$cat];
			if($$cat){
				$$cat = 1;
			} else {
				$$cat = 0;	
			}
			$catstr .= "$cat = ". $$cat.", ";
		}
		$catstr = substr($catstr, 0, -2);

		$query = "UPDATE ".tname('com_slave_main')." SET $catstr WHERE uid=".$space[uid];
		$_SGLOBAL['db']->query($query);
		
		$statusmsg = comlang('update_successful');
	}
	$user = comSlaveGetUserInfo($space[uid]);
}

//-------------------´òÕÛ³öÊÛÅ«Á¥Ò³Ãæ----------------
if($op=="discount"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸
	$userinfo = comSlaveGetUserInfo($uid);
	$discount = $SConfig[discount_rate]*10;
	$userinfo[discount] = round($userinfo[pvalue]*((100-$discount)/100));
	$userinfo[discounttotal] = round($userinfo[pvalue] * ($discount/100));
}

//-------------------´_¶¨´òÕÛ³öÊÛÅ«Á¥----------------
if($op=="confirmdiscount"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸
	$userinfo = comSlaveGetUserInfo($uid);
	$mastername = comSlaveUserLink($space[uid], $space[username]);
	$username = comSlaveUserLink($userinfo[uid], $userinfo[username]);

	//¼ì²éÅ«Á¥Ò»ÌìƒÈ±»ÂôÁË¼¸´Î
	$discountPerDay = comSlaveCheckSlaveDiscountPerDay($userinfo[uid]);
	if($discountPerDay >= $SConfig[slave_discount_limit]){
		showmessage(comlang('maxslave_discount_limit', array($SConfig[slave_discount_limit], $username)));
	} 

	$discount = $SConfig[discount_rate]*10;
	$userinfo[discount] = round($userinfo[pvalue]*((100-$discount)/100));
	$userinfo[discounttotal] = round($userinfo[pvalue] * ($discount/100));

	//µ±Å«Á¥µÄÉí¼ÛµÍÓÚ¿ÉÒÔ±»´òÕÛµÄ×îµÍÉí¼Û
	if($userinfo[discounttotal] < $SConfig[slave_lowest_discount]){
		showmessage(comlang('slave_discount_minimum', array($username)));
	}

	//¸üĞÂÅ«Á¥Êı¾İ
	$SETstr = "SET `pvalue` = '".$userinfo[discounttotal]."', `discount` = 1";
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$userinfo[uid];
	$_SGLOBAL['db']->query($query);

	$msgarr = array($mastername, $username, $SConfig[discount_rate], comSlaveds(number_format($userinfo[discount])));
	$mmessage = comlang('discount_msg', $msgarr);

	// ¸üĞÂÖ÷ÈËÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($space[uid], 0, 0,$mmessage);

	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($uid, 0, 4, $mmessage);

	showmessage($mmessage, "sieuthigoer.php?com=slave", 3);
}

//-------------------¹ºÂòÅ«Á¥Ò³Ãæ----------------
if($op=="buy"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸
	$userinfo = comSlaveGetUserInfo($uid,1);
}

//-------------------ÎÒÒªÊêÉíÒ³Ãæ----------------
if($op=="ransom"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸
	$userinfo = comSlaveGetUserInfo($uid,1);
}

//-------------------Å«Á¥¶¯×÷Ò³Ãæ----------------
if($op=="action"){
	$sidebar = 1; //´ò¿ªÓÒ²àÀ¸

	$isSlave = comSlaveCheckIsSlave($uid);
	if($isSlave){
		//ÏÔÊ¾·ÖÀàÄ¿Â¼
		$linkarr = array(
			'com' => 'slave',
			'catid' => $catid,
			'op' => $op,
			'uid' => $uid,
		);
		$comcatlist = comShowCategory('com_slave_taskcat', $linkarr);
		
		$tasklist = comSlaveListTask($catid);
	}
}

//-------------------Ö´ĞĞÅ«Á¥¶¯×÷----------------
if($_POST['op']=="submitaction"){
	$taskid = $_POST['taskid'];
	$authoruid = $_POST['authoruid'];
	$uid = $_POST['uid'];
	$status = comSlaveDoTask($uid, $taskid);
	if($status[limit]){
		showmessage(comlang('daily_limit_error', array($status[limit])));
	} elseif($status[actionlimit]) {
		showmessage(comlang('action_limit_error', array($SConfig[action_hour],$SConfig[action_period])));
	} else {
		$statusmsg = $status[msg];
	}
}

//-------------------È·ÈÏÎÒÒªÊêÉí----------------------
if($op=="confirmransom"){	

	$user = comSlaveGetUserInfo($uid);
	$master = comSlaveGetUserInfo($space[uid]);
	$oldmaster = comSlaveGetUserInfo($user[uplineuid]);
	$username = comSlaveUserLink($user[uid], $user[username]);
	$newmastername = comSlaveUserLink($master[uid], $master[username]);
	$usernamebb = comSlaveUserLink($user[uid], $user[username], 1);
	$newmasternamebb = comSlaveUserLink($master[uid], $master[username], 1);
	$oldmasternamebb = comSlaveUserLink($oldmaster[uid], $oldmaster[username], 1);
    $oldmastername = comSlaveUserLink($oldmaster[uid], $oldmaster[username]);
	





		//¼ì²éÓÃ»§ÏÖ½ğ
	if($master[cash]<$user[total]){
		$link = "sieuthigoer.php?com=invite&app=slave";//ÑûÇëÁ´½Ó
		showmessage(comlang('ransom_not_enough', array($user[total],$master[cash],$username, $link, comSlaveds(number_format($SConfig[invite_amount])))));
	}

	//¸üĞÂ¾ÉÖ÷ÈËÊı¾İ
	if(!empty($user[uplineuid])){
	    $commission = round($user[services_charge]*((100 - $SConfig[slave_percentage])/100));
		//$commission = round($user[services_charge]*($SConfig[slave_percentage]/100));		
		$commission += $user[added];
		$total = $user[pvalue] + $commission;
		$SETstr = "SET `slave` = `slave`-1, `cash` = `cash`+".$total;
		$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$user[uplineuid];
		$_SGLOBAL['db']->query($query);
	}


	// ¸üĞÂÅ«Á¥Êı¾İ
	//$commission = round($user[services_charge]*($SConfig[slave_percentage]/100));		
	$total = $user[total] - $user[added];
	$SETstr = "SET `nickname`='',`pvalue` = ".$total.", `uplineuid` = 0,  `discount` = 0, `updatetime` = ".$_SGLOBAL['timestamp'];
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$uid;
	$_SGLOBAL['db']->query($query);



	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼ 
	$msgarr = array($user[username], $oldmastername, comSlaveds(number_format($user[total])), comSlaveds(number_format($commission)));
	$message = comlang('bouhgtmsg_ransom', $msgarr);
	comSlaveAddHistory($uid, 0, 3,$message);



	// ¸üĞÂĞÂÖ÷ÈËÊı¾İ(ÊêÉíÕß×Ô¼º)
	$SETstr = "SET cash = cash-".$user[total];
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$space[uid];
	$_SGLOBAL['db']->query($query);


	// ¸üĞÂÅ«Á¥¸öÈË¶¯Ì¬
	if($master[mfeed]==1){
		$feedmessage = "<B>[<a href=sieuthigoer.php?com=slave>".$SConfig[gamename]."</a>]</B> ";
		$message = $feedmessage.$newmastername.": ".$message;
		feed_add('thread', $message);
	}




	comUpdateTime(); // ¸üĞÂÓÃ»§Ê±¼ä
	showmessage(comlang('ransom_successful'), "sieuthigoer.php?com=slave&uid=$uid", 3);
}



//-------------------´_¶¨¹ºÂòÅ«Á¥----------------
if($op=="confirmbuy"){
	$uid = $_POST[uid];

	$ustatus = comSlaveCheckUserActivation($uid);

	$user = comSlaveGetUserInfo($uid);
	$master = comSlaveGetUserInfo($space[uid]);
	$oldmaster = comSlaveGetUserInfo($user[uplineuid]);
	$username = comSlaveUserLink($user[uid], $user[username]);
	$newmastername = comSlaveUserLink($master[uid], $master[username]);
	$usernamebb = comSlaveUserLink($user[uid], $user[username], 1);
	$newmasternamebb = comSlaveUserLink($master[uid], $master[username], 1);
	$oldmasternamebb = comSlaveUserLink($oldmaster[uid], $oldmaster[username], 1);

	if(empty($ustatus)){
		// ½¨Á¢ĞÂÓÃ»§
		comSlaveAddNewUser($uid, 0);

		// »ñÈ¡ÍøÕ¾ĞÅÏ¢
		$site = comGetSiteConfig();
		
		$msgarr = array($user[username], $newmastername, comSlaveds(number_format($user[total])), comSlaveds(number_format($commission)));

		$message = comlang('email_slave_message', array($user[username], $master[username], $site[siteallurl]));
		$subject = comlang('email_slave_subject', array($master[username]));
		comSendmail($uid, $subject, $message);
	}

	if($master[uplineuid] == $user[uid]){
		showmessage(comlang('buy_master_error', array($username)));
	}

     //¼ì²éÊêÉíÒ»ÌìÄÚ²»ÄÜÔÙ¹ºÂò
	$sellPerDay = checkransomperday($user[uid]);
	if($sellPerDay >= 1){
		showmessage(comlang('ransom_perday_limit', array($username)));
	}


	//¼ì²éÅ«Á¥Ò»ÌìƒÈ±»ÂôÁË¼¸´Î
	$sellPerDay = comSlaveCheckSlaveSellPerDay($user[uid]);
	if($sellPerDay >= $SConfig[slave_sell_limit]){
		showmessage(comlang('maxslave_perday_limit', array($SConfig[slave_sell_limit], $username)));
	}

	//Èç¹ûÓÃ»§ÓµÓĞµÄÅ«Á¥Êı³¬¹ıÔ¤ÉèÖµ£¬ÌáÊ¾´íÎó
	if($master[totalslave] >= $SConfig['maxslave']){
		showmessage(comlang('maxslave_error', array($SConfig['maxslave'])));
	}


	 if($user[friend]==1){
		global $_SGLOBAL;
		$link = "cp.php?ac=friend&op=add&uid=$user[uid]";
		$query = "SELECT * FROM ".tname( "friend" )." WHERE fuid=".$user[uid]." AND uid=".$space[uid];
		$value = $_SGLOBAL['db']->query( $query );
		if(mysql_num_rows($value) == 0){
               showmessage(comlang('friend_err', array($username,$link))); 
	     }
	 }

	//Èç¹ûÓÃ»§ÊÇ´ó²ÆÖ÷£¬ÌáÊ¾´íÎó
	$username = comSlaveUserLink($user[uid], $user[username]);
	if($user[level]==1){
		showmessage(comlang('millionaire_reject', array($username)));
	}

	//¼ì²éÓÃ»§ÏÖ½ğ
	if($master[cash]<$user[total]){
		$link = "sieuthigoer.php?com=invite&app=slave";
		showmessage(comlang('cash_not_enough', array($username, $link, comSlaveds(number_format($SConfig[invite_amount])))));
	}

	//¸üĞÂ¾ÉÖ÷ÈËÊı¾İ
	if(!empty($user[uplineuid])){
		$commission = round($user[services_charge]*((100 - $SConfig[slave_percentage])/100));
		$commission += $user[added];
		$total = $user[pvalue] + $commission;
		$SETstr = "SET `slave` = `slave`-1, `cash` = `cash`+".$total;
		$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$user[uplineuid];
		$_SGLOBAL['db']->query($query);
	}

	// ¸üĞÂ¾ÉÖ÷ÈËÀúÊ·¼ÇÂ¼
	$msgarr = array($newmastername, comSlaveds(number_format($user[total])), $username, comSlaveds(number_format($commission)));
	$message = comlang('bouhgtmsg_oldmaster', $msgarr);
	comSlaveAddHistory($user[uplineuid], 0, 0,$message);

	// Í¨Öª¾ÉÖ÷ÈË
	if($oldmaster[snotice]==1){
		$msgarr = array($newmasternamebb, comSlaveds(number_format($user[total])), $usernamebb, comSlaveds(number_format($commission)));
		$message = comlang('bouhgtmsg_oldmaster', $msgarr);

		include_once S_ROOT.'./uc_client/client.php';
		$pmid = empty($_GET['pmid'])?0:floatval($_GET['pmid']);
		uc_pm_send($master[uid], $oldmaster[uid], comlang('buyslave_notice'), $message, 1, $pmid, 0);
	}


	// ·¢ÓÊ¼şÍ¨Öª¾ÉÖ÷ÈËÆäÅ«Á¥±»ÂòÁË
	if($oldmaster[semail]==1){
		$msgarr = array($master[username], comSlaveds(number_format($user[total])), $user[username], comSlaveds(number_format($commission)));
		$message = comlang('bouhgtmsg_oldmaster', $msgarr);
		$subject = comlang('email_slave_subject', array($master[username]));
		comSendmail($oldmaster[uid], comlang('buyslave_notice'), $message);
	}

	// ¸üĞÂÅ«Á¥Êı¾İ
	$commission = round($user[services_charge]*($SConfig[slave_percentage]/100));
	$total = $user[total] - $user[added];
	$SETstr = "SET `pvalue` = ".$total.", `uplineuid` = ".$space[uid].", `cash` = `cash`+$commission, `discount` = 0, `updatetime` = ".$_SGLOBAL['timestamp'];
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$uid;
	$_SGLOBAL['db']->query($query);

	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼
	$msgarr = array($user[username], $newmastername, comSlaveds(number_format($user[total])), comSlaveds(number_format($commission)));
	$message = comlang('bouhgtmsg_slave', $msgarr);
	comSlaveAddHistory($uid, 0, 3,$message);

	// Í¨ÖªÅ«Á¥±»ÂòÁË
	if($user[mnotice]==1){
		$msgarr = array(comlang('you'), $newmasternamebb, comSlaveds(number_format($user[total])), comSlaveds(number_format($commission)));
		$message = comlang('bouhgtmsg_slave', $msgarr);

		include_once S_ROOT.'./uc_client/client.php';
		$pmid = empty($_GET['pmid'])?0:floatval($_GET['pmid']);
		uc_pm_send($master[uid], $user[uid], comlang('email_slave_subject', array($master[username])), $message, 1, $pmid, 0);
	}

	// Í¨ÖªÅ«Á¥±»ÂòÁË
	if($user[memail]==1){
		$message = comlang('memail_slave_message', array($user[username], $master[username], $site[siteallurl]));
		$subject = comlang('email_slave_subject', array($master[username]));
		comSendmail($user[uid], $subject, $message);
	}

	// ¸üĞÂĞÂÖ÷ÈËÊı¾İ
	$SETstr = "SET cash = cash-".$user[total];
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$space[uid];
	$_SGLOBAL['db']->query($query);

	// ¸üĞÂĞÂÖ÷ÈËÀúÊ·¼ÇÂ¼
	$msgarr = array(comSlaveds(number_format($user[total])), $username);
	$message = comlang('bouhgtmsg_newmaster', $msgarr);
	comSlaveAddHistory($space[uid], 0, 0, $message);

	// ¸üĞÂÅ«Á¥¸öÈË¶¯Ì¬
	if($master[mfeed]==1){
		$feedmessage = "<B>[<a href=sieuthigoer.php?com=slave>".$SConfig[gamename]."</a>]</B> ";
		$message = $feedmessage.$newmastername.": ".$message;
		feed_add('slave', $message);
	}

	comUpdateTime(); // ¸üĞÂÓÃ»§Ê±¼ä
	showmessage(comlang('bought_successful'), "sieuthigoer.php?com=slave&uid=$uid", 3);
}

//-------------------¸øÅ«Á¥Æğ»¨Ãû----------------
if($op=="changenick"){
	$sidebar = 1;
	if($_POST[submitnick]){
		$uid = $_POST[uid];
		$nickname = $_POST[nickname];
		$query = "UPDATE ".tname('com_slave_main')." SET nickname='$nickname' WHERE uid=".$uid;
		$_SGLOBAL['db']->query($query);

		showmessage(comlang('changenick_successful'), "sieuthigoer.php?com=slave&uid=$uid", 3);
	}
	$user = comSlaveGetUserInfo($uid);
	$username = comSlaveUserLink($user[uid], $user[username]);
	if($user[uplineuid]!=$space[uid]){
		showmessage(comlang('changenick_error', array($username)));
	}
}

//-------------------¸ü¸Ä¸öÈËËµÃ÷----------------
if($op=="editaboutme"){
	$sidebar = 1;
	if($_POST[submitabout]){
		$aboutme = $_POST[aboutme];
		$aboutme = addslashes(sstripslashes($aboutme));
		$query = "UPDATE ".tname('com_slave_main')." SET aboutme='$aboutme' WHERE uid=".$space[uid];
		$_SGLOBAL['db']->query($query);

		showmessage(comlang('changeabout_successful'), "sieuthigoer.php?com=slave&uid=$uid", 3);
	}
	$user = comSlaveGetUserInfo($space[uid]);
}

//-------------------ÊÍ·ÅÅ«Á¥----------------
if($op=="release"){
	$sidebar = 1;
	$user = comSlaveGetUserInfo($uid);
	$username = comSlaveUserLink($user[uid], $user[username]);
	if($user[uplineuid]!=$space[uid]){
		showmessage(comlang("release_error", array($username)));
	}
	$user[grandtotal] = round($user[pvalue]/3);
	$user[pvalue] = number_format($user[pvalue]);
	$user[grandtotal] = number_format($user[grandtotal]);
}

//-------------------´_¶¨ÊÍ·ÅÅ«Á¥----------------
if($op=="confirmrelease"){
	$sidebar = 1;
	$user = comSlaveGetUserInfo($uid);
	$mastername = comSlaveUserLink($space[uid], $space[username]);
	$username = comSlaveUserLink($user[uid], $user[username]);
	if($user[uplineuid]!=$space[uid]){
		showmessage(comlang("release_error", array($username)));
	}

	$user[grandtotal] = round($user[pvalue]/3);


	//¸üĞÂÖ÷ÈËÊı¾İ
	if(!empty($user[uplineuid])){
		$SETstr = "SET `slave` = `slave`-1, `cash` = `cash`+".$user[grandtotal];
		$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$user[uplineuid];
		$_SGLOBAL['db']->query($query);
	}

	// ¸üĞÂÖ÷ÈËÀúÊ·¼ÇÂ¼
	$msgarr = array($mastername, $username, comSlaveds(number_format($user[grandtotal])));
	$mmessage = comlang('release_mastermsg', $msgarr);
	comSlaveAddHistory($user[uplineuid], 0, 0,$mmessage);

	// ¸üĞÂÅ«Á¥Êı¾İ
	$SETstr = "SET `uplineuid` = 0";
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$uid;
	$_SGLOBAL['db']->query($query);

	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼
	$msgarr = array($username, $mastername);
	$smessage = comlang('release_slavemsg', $msgarr);
	comSlaveAddHistory($uid, 0, 0,$smessage);

	showmessage($mmessage, "sieuthigoer.php?com=slave", 3);
}
//-------------------ÊÕ²ØÅ«Á¥----------------
if($op=="collect"){
	$sidebar = 1;
	$user = comSlaveGetUserInfo($uid);
}

//-------------------´_¶¨ÊÕ²ØÅ«Á¥----------------
if($op=="confirmcollect"){
	$sidebar = 1;
	$SConfig = comSlaveGetUserInfo($uid);
	$master = comSlaveGetUserInfo($space[uid]);
	$mastername = comSlaveUserLink($space[uid], $space[username]);
	$username = comSlaveUserLink($SConfig[uid], $SConfig[username]);

	$collectionarr = explode(",",$master[collection]);
	if(in_array($uid,$collectionarr)){
		showmessage(comlang('collect_error', array($username)));
	}

	if(!empty($master[collection])){
		$master[collection] = $master[collection] . ",".$SConfig[uid];
	} else {
		$master[collection] = $uid;
	}

	//¸üĞÂÖ÷ÈËÊı¾İ
	$SETstr = "SET `collection` = '".$master[collection]."'";
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$master[uid];
	$_SGLOBAL['db']->query($query);

	$msgarr = array($mastername, $username);
	$mmessage = comlang('collect_msg', $msgarr);

	// ¸üĞÂÖ÷ÈËÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($master[uid], 0, 0,$mmessage);

	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($uid, 0, 0,$mmessage);

	showmessage($mmessage, "sieuthigoer.php?com=slave", 3);
}

//-------------------È¡ÏûÊÕ²Ø----------------
if($op=="removecollect"){
	$sidebar = 1;
	$user = comSlaveGetUserInfo($uid);
}

//-------------------´_¶¨È¡ÏûÊÕ²Ø----------------
if($op=="confirmremovecollect"){
	$sidebar = 1;
	$SConfig = comSlaveGetUserInfo($uid);
	$master = comSlaveGetUserInfo($space[uid]);
	$mastername = comSlaveUserLink($space[uid], $space[username]);
	$username = comSlaveUserLink($SConfig[uid], $SConfig[username]);

	$collectionarr = explode(",",$master[collection]);
	if(!in_array($uid,$collectionarr)){
		showmessage(comlang('removecollect_error', array($username)));
	}

	foreach($collectionarr as $cvalue){
		if($cvalue != $uid){
			$newcollection .= $cvalue . ",";
		}
	}

	$newcollection = substr($newcollection, 0, -1);

	//¸üĞÂÖ÷ÈËÊı¾İ
	$SETstr = "SET `collection` = '".$newcollection."'";
	$query = "UPDATE ".tname('com_slave_main')." $SETstr WHERE uid=".$master[uid];
	$_SGLOBAL['db']->query($query);

	$msgarr = array($mastername, $username);
	$mmessage = comlang('removecollect_msg', $msgarr);

	// ¸üĞÂÖ÷ÈËÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($master[uid], 0, 0,$mmessage);

	// ¸üĞÂÅ«Á¥ÀúÊ·¼ÇÂ¼
	comSlaveAddHistory($uid, 0, 0,$mmessage);

	showmessage($mmessage, "sieuthigoer.php?com=slave", 3);
}

//-------------------Å«Á¥ÊĞ³¡----------------
if($op=="market"){

	if($_POST[submitsearchuser]){
		$searchuser = $_POST[username];
	}

	if(empty($cat)){
		$allactive = "class=active";
		$cat = "all";
	} else {
		$key = $cat."active";
		$$key = "class=active";
	}

	if(empty($sort)){
		$expensiveactive = "class=active";
		$sort = "expensive";
	} else {
		$sortkey = $sort."active";
		$$sortkey = "class=active";
	}

	if(empty($range)){
		$rallactive = "class=active";
		$range = "all";
	} else {
		$rangekey = "r".$range."active";
		$$rangekey = "class=active";
	}

	if(empty($sex)){
		$sex0active = "class=active";
		$sex = 0;
	} else {
		$sexkey = "sex".$sex."active";
		$$sexkey = "class=active";
	}

	//·ÖÒ³
	$start = empty($_GET['start'])?0:intval($_GET['start']);
	ckstart($start, $SConfig[list_perpage]);
	$limit = "LIMIT $start, ".$SConfig[list_perpage];

	$sidebar = 1;
	$listusers = comSlaveListAllUsers($start, $SConfig[list_perpage]);

	if(is_array($listusers)){
		$lastlist = end($listusers);
	}

	//·ÖÒ³
	$multi = smulti($start, $SConfig[list_perpage], $lastlist[count], "?com=slave&op=$op&cat=$cat&sort=$sort&range=$range&sort=$sort&sex=$sex");
}


//-------------------ÅÅĞĞ°ñ----------------
if($op=="rank"){

	if(empty($cat)){
		$allactive = "class=active";
		$cat = "all";
	} else {
		$key = $cat."active";
		$$key = "class=active";
	}

	if(empty($sort)){
		$assetactive = "class=active";
		$sort = "asset";
	} else {
		$sortkey = $sort."active";
		$$sortkey = "class=active";
	}

	if(empty($sex)){
		$sex0active = "class=active";
		$sex = 0;
	} else {
		$sexkey = "sex".$sex."active";
		$$sexkey = "class=active";
	}

	//·ÖÒ³
	$start = empty($_GET['start'])?0:intval($_GET['start']);
	ckstart($start, $SConfig[list_perpage]);
	$limit = "LIMIT $start, ".$SConfig[list_perpage];

	$sidebar = 1;
	$listusers = comSlaveListRanking($start, $SConfig[list_perpage]);

	if(is_array($listusers)){
		$lastlist = end($listusers);
	}

	//·ÖÒ³
	$multi = smulti($start, $SConfig[list_perpage], $lastlist[count], "?com=slave&op=$op&cat=$cat&sort=$sort&range=$range&sort=$sort&sex=$sex");
}

//----------------------Ê×Ò³--------------------
if(empty($op)){
	$ustatus = comSlaveCheckUserActivation($space[uid]);

	if($ustatus!=2){
		$sidebar = 1;
	} else {
		if(empty($uid)){
			$uid = $space[uid];
		}

		if($uid==$space[uid]){
			$statusmsg = comSlaveDoLuck();
		}
		$userinfo = comSlaveGetUserInfo($uid,1);

		// »ñÈ¡Å«Á¥×ÊÁÏ
		$SConfiglist = comSlaveGetSlaveList($uid);
		// »ñÈ¡ÊÕ²Ø×ÊÁÏ
		$collectionlist = comSlaveGetCollectionList($userinfo[collection],$uid);

		$userasset = str_replace(",", "", $userinfo[asset]);

		// ¼ì²éÓÃ»§ÊÇ·ñÓĞ×Ê¸ñ³ÉÎª´ó²ÆÖ÷
		if($userasset > $SConfig['millionaire'] && $userinfo[level]!=1 && $userinfo[uid]==$space[uid]){
			$username = comSlaveUserLink($userinfo[uid], $userinfo[username]);

			if($userinfo[uplineuid]!=0){
				comSlaveAddHistory($userinfo[uplineuid], 0, 0, comlang('millionaire_slave_msg', array($username)));
			}

			$mainquery = "UPDATE ".tname('com_slave_main')." SET uplineuid = 0, nickname = '', level = 1 WHERE uid=".$userinfo[uid];
			$_SGLOBAL['db']->query($mainquery);

			$statusmsg = comlang('millionaire_master_msg', array(comSlaveds(number_format($SConfig['millionaire']))));

			comSlaveAddHistory($userinfo[uid],0, 0, $statusmsg);
			$userinfo[uplineuid] = "";
		}
		
		if($userinfo[uplineuid]){
			$uplineinfo = comSlaveGetUserInfo($userinfo[uplineuid]);
			$uplineinfo[pvalue] = number_format($uplineinfo[pvalue]);
			$uplineinfo[added] = number_format($uplineinfo[added]);
			$uplineinfo[cash] = number_format($uplineinfo[cash]);
			$uplineinfo[asset] = number_format($uplineinfo[asset]);
		}
		$historylist = comSlaveGetHistoryList($uid);
		//ÉèÖÃÒ»ÄêµÄ cookies£¬¼ì²éÓÃ»§ÊÇ·ñ×÷±×ÑûÇëÅóÓÑ
		$cookiename = "invitoruid";
		$cookievalue = $space[uid];
		setcookie($cookiename, $cookievalue, time()+31104000); 
	}
}

//-----------------Æô¶¯ÓÎÏ·----------------

if($op == 'activate'){
	global $_SGLOBAL;

	$avatar = UC_API."/data/avatar/".comGetAvatar($space[uid], $size);

	// Èç¹ûÊÇ±»ÑûÇëÓÃ»§
	if($_COOKIE[slaveinvite])
	{
		if($_COOKIE[invitoruid] == $_COOKIE[slaveinvite]){
			//Èç¹ûÓÃ»§×÷±×
			comSlaveUpdateInvitorCash($_COOKIE[slaveinvite], "-");
			$invitor = comSlaveGetUserInfo($_COOKIE[slaveinvite]);

			$username = comSlaveUserLink($space[uid], $space[username]);
			$mastername = comSlaveUserLink($invitor[uid], $invitor[username]);
			$usernamebb = comSlaveUserLink($space[uid], $space[username],1);
			$masternamebb = comSlaveUserLink($invitor[uid], $invitor[username],1);

			$inviteamount = comSlaveds(number_format($SConfig[invite_amount]));
			$message = comlang('invite_illegal', array($mastername, $username, $inviteamount));
			$messagebb = comlang('invite_illegal', array($masternamebb, $usernamebb, $inviteamount));

			comSlaveAddHistory($_COOKIE[slaveinvite],0,0,$message);

			//Í¨Öª¹ÜÀíÔ±ÓĞÈË×÷±×
			include_once S_ROOT.'./uc_client/client.php';
			$pmid = empty($_GET['pmid'])?0:floatval($_GET['pmid']);
			uc_pm_send($master[uid], $SConfig[adminuid], comlang('invite_illegal_subject', array($master[username])), $messagebb, 1, $pmid, 0);			

			showmessage($message);
		} else {
			//¼ì²éÓÃ»§ÑûÇëÁË¼¸¸öÓÃ»§
			$username = comSlaveUserLink($space[uid], $space[username]);
			$invitetotal = comSlaveCheckInviteCount($_COOKIE[slaveinvite], 1);
			$invitetoday = comSlaveCheckInviteCount($_COOKIE[slaveinvite]);

			if($invitetotal >= $SConfig[max_invite_total]){
				comSlaveAddHistory($_COOKIE[slaveinvite],0,0,comlang('invite_success_limit_total', array($username)));
			} elseif($invitetoday >= $SConfig[max_invite_perday]){
				comSlaveAddHistory($_COOKIE[slaveinvite],0,0,comlang('invite_success_limit_pday', array($username)));
			} else {
				comSlaveUpdateInvitorCash($_COOKIE[slaveinvite]);
				$username = comSlaveUserLink($space[uid], $space[username]);
				$inviteamount = comSlaveds(number_format($SConfig[invite_amount]));
				comSlaveAddHistory($_COOKIE[slaveinvite],0,5,comlang('invite_success', array($username, $inviteamount)));
			}
		}
	}

	if($ustatus == 0){
		comSlaveAddNewUser($space[uid]);
	} else {
		updatetable('com_slave_main', array('created'=>$_SGLOBAL['timestamp']), array('uid'=>$space[uid]));
	}
	$username = comSlaveUserLink($space[uid], $space[username]);
	comSlaveAddHistory($space[uid],0,0,comlang('activation_success'));
	$feedmessage = "<B>[<a href=sieuthigoer.php?com=slave>".$SConfig[gamename]."</a>]</B> $username,   ".comlang('activation_success');
	feed_add('slave', $feedmessage);
	comUpdateTime(); // ¸üĞÂÓÃ»§Ê±¼ä
	showmessage(comlang('activation_success'), "sieuthigoer.php?com=slave", 3);
}
//-------------------»ı·Ö¶Ò»»----------------
if($op=="credit"){

$sidebar = 1; //´ò¿ªÓÒ²àÀ¸ 

if($_POST[submitcredit]){
$code=$_POST['code']; //ÂòÈë»òÂô³ö
$credit=intval(trim($_POST['credit'])); //ÓÃ»§ÊäÈëÊıÖµ
    $credits = $credit*$SConfig[changecredits];
$creditss = $credit/$SConfig[changecredits];

if (!$credit||empty($_POST['credit'])|| $_POST['credit']<1 ||strlen($_POST['credit'])>8) showmessage(comlang('credit_err'));


if ($code=='xianjin') { 
$execc="select * from ".tname('space')." where uid=".$space[uid];
$resultc=mysql_query($execc);
$rs=mysql_fetch_array($resultc);
$usercreditt = $rs[credit];
if ($usercreditt < $credit) showmessage("ÄúµÄ»ı·Ö²»¹»£¡");

//Ôö¼Ó½ğÇ®
$query = "UPDATE ".tname('com_slave_main')." SET cash = cash+".$credits." WHERE uid=".$space[uid];
$_SGLOBAL['db']->query($query);
//¼õÉÙ»ı·Ö
$query = "UPDATE ".tname('space')." SET credit = credit-".$credit." where uid =".$space[uid];
$_SGLOBAL['db']->query($query);
showmessage(comlang('xianjin_successful'), "sieuthigoer.php?com=slave&op=credit", 3);

}elseif($code=='jifen') {

$execc="select * from ".tname('com_slave_main')." where uid=".$space[uid];
$resultc=mysql_query($execc);
$rs=mysql_fetch_array($resultc);
$usercreditt = $rs[cash];
if ($usercreditt < $credit) showmessage("ÄúµÄÏÖ½ğ²»¹»£¡");
//¼õÉÙ½ğÇ®
if(intval($creditss)==0) showmessage(comlang('tradenum_round_err',array($SConfig[credit]))); //ÒªÇóÊäÈëÕûÊı
	
$query = "UPDATE ".tname('com_slave_main')." SET cash = cash-".$credit." WHERE uid=".$space[uid];
$_SGLOBAL['db']->query($query);
//Ôö¼Ó»ı·Ö
$query = "UPDATE ".tname('space')." SET credit = credit+".intval($creditss)." where uid =".$space[uid];
$_SGLOBAL['db']->query($query);
showmessage(comlang('jifen_successful'), "sieuthigoer.php?com=slave&op=credit",3);
}
} 
}
include template('com_slave');

?>