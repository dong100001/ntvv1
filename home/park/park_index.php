<?php
include_once './park/ClassParkInfo.php';
//ÊµÃû
realname_get();

//feed

$fId=empty($_GET[fId])?$_SGLOBAL['supe_uid']:$_GET[fId];
$fspace=getspace($fId);
$fusername=$fspace[username];
$ac=empty($_GET[ac])?"index":$_GET[ac];
if($ac=='index'){
	$myParkInfo=new CmyCar($fId);
	$myCarInfo=$myParkInfo->arrMyCar;

	//¸öÈË¶¯Ì¬
	$feedlist = array();
	$query = $_SGLOBAL['db']->query("SELECT * FROM ".tname('feed')." WHERE uid=".$fId." and (icon='park' or icon='drive')  ORDER BY dateline DESC LIMIT 0,10");
		while ($value = $_SGLOBAL['db']->fetch_array($query)) {
			if(ckfriend($value)) {
				realname_set($value['uid'], $value['username']);
				$feedlist[] = $value;
			}
		}
		$feednum = count($feedlist);
	foreach ($feedlist as $key => $value) {
		$feedlist[$key] = mkfeed($value);
	}	

	$ParkMember= new CParkMember($_SGLOBAL['supe_uid']);
	$P_Credit=$ParkMember->P_credit;	
	$friendList=$ParkMember->arrFriend;
	$logintime=$ParkMember->P_logintime;
	$nowshort=date("Y-m-d");
	if($logintime!=$nowshort){
	    $sql="update ".tname('park_member')." set P_logintime='$nowshort',P_credit=P_credit+500 where uid=".$_SGLOBAL['supe_uid'];
	    $_SGLOBAL['db']->query($sql);
		$fs['icon'] = 'park';
		$fs['title_template'] = "{actor} Đăng nhập vào <a href='parkApp.php?ac=index'>Cuộc chiến bãi đỗ xe</a> Hôm nay, bạn được thưởng 500 vàng";
		include_once(S_ROOT.'./source/function_cp.php');
		feed_add($fs['icon'], $fs['title_template']);
		showmessage($_SGLOBAL['supe_username']." Bạn đã đăng nhập thành công vào Cuộc chiến đỗ xe và nhận được 500 vàng","parkApp.php?ac=index",1);
	}

		
}


include_once( template( "park/view/park_index" ) );


?>