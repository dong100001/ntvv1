<?php
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

if(!submitcheck("giftsubmit")){
	exit;
}

	$gid = (int)$_POST['giftitem'];
	$fusername = saddslashes(trim($_POST['username_gift']));
	$toInfo = @getspace($fusername,'username');
	$type = (int)$_POST['gifttype'];
	$message = saddslashes(trim($_POST['message']));
	if(empty($toInfo['uid'])){
		showmessage("Tên thành viên không tồn tại!",$_SGLOBAL['refer']);
	}
	if(empty($gid)){
		showmessage("Chọn 1 món quà để gửi chứ!",$_SGLOBAL['refer']);
	}
	if(!in_array($type,array("0","1","2"))){
		showmessage("Yêu cầu không hợp lệ!",$_SGLOBAL['refer']);
	}
	if(strlen($message) > 200){
		showmessage("Thông điệp quá dài, tối đa 200 ký tự à, sửa lại đi! ",$_SGLOBAL['refer']);
	}
	
	$myGift = getGiftListById($gid);
	if(!$myGift){
		showmessage("Món quà không tồn tại",$_SGLOBAL['refer']);
	}
	if($space['credit'] < $myGift['cost']){
		showmessage("Oops! Không đủ tiền để gửi quà, vui lòng viết blog, thực hiện nhiệm vụ...để kiếm tiền!",$_SGLOBAL['refer']);
	}
	
	$data = array(
		'uid' => $_SGLOBAL['supe_uid'],
		'username' => $_SGLOBAL['supe_username'],
		'touid' => $toInfo['uid'],
		'tousername' => $toInfo['username'],
		'gift' => $myGift['src'],
		'dateline' => date("U")
	 );
	if(!empty($message)){
		$data['message'] = $message;
	}
	if($type == "2"){
		$data['uid'] = '0';
		$data['username'] = '0';
	}
	
	inserttable('app_tw_gift', $data);
	$_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit=credit-".$myGift['cost']." WHERE uid='$_SGLOBAL[supe_uid]'");
	//$_SGLOBAL['db']->query("UPDATE ".tname('session')." SET credit=credit-".$myGift['cost']." WHERE uid='$_SGLOBAL[supe_uid]'");
	include_once(S_ROOT.'./source/function_cp.php');
	//feed
	if($type == "0"){
		$fs = array();
		$fs['icon'] = 'share';
		$fs['title_template'] = "{actor} sent <a href=\"space.php?uid={$toInfo['uid']}\">".$toInfo['username']."</a> a <a href=\"gift.php\">gift!</a><br><a href=\"gift.php\"><img src=\"./gift/gift_model/image/{$myGift['src']}\"></a>";
		$fs['title_data'] = array();
		$fs['body_template'] = '';
		$fs['body_data'] = array();
		feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], 0);
	}
	//֪ͨ
	if($type == "2"){
		$message = "GoHooH.CoM: Ai đó tặng bạn <a href=\"gift.php?do=view\">món quà</a><br><img src=\"./gift/gift_model/image/{$myGift['src']}\">";
	}else{
		$message = "tặng bạn <a href=\"gift.php?do=view\">món quà</a><br><img src=\"./gift/gift_model/image/{$myGift['src']}\">";
	}
	if($data['message']){$message .="<br>Thông điệp: ".$data['message'];}
	if($type != "2"){
		$message .= "<br><a href=\"gift.php?uid={$_SGLOBAL['supe_uid']}\">Tặng quà lại</a>";
		notification_add($toInfo['uid'], "app", $message );
	}else{
		$sql = "INSERT INTO ".tname("notification")." (uid,type,new,authorid,author,note,dateline) VALUES('{$toInfo['uid']}','app','1','','','{$message}','{$data['dateline']}')";
		$_SGLOBAL['db']->query($sql);
	}
	
	
	showmessage("Quà này đã được tặng!","gift.php");

?>