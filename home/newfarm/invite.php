<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*********************/
/*  GoHooH.Com       */
/*  Version : 1.0.0  */
//QQ 181682233
/*********************/



if($_GET[act]=='invite'){
	$uid=$_SGLOBAL['supe_uid'];
	$fuid=$_POST['fuid'];
	//echo join('<br>',$fuid);
	$count=count($_POST['fuid']);
	//echo "uid".$uid;
	$inviteuid=$_POST['inviteuid'];
	//echo "inviteuid".$inviteuid;

	include('./source/function_cp.php');
	foreach($fuid as $value){
		$note ="M峄漣 b岷 b猫 <a href='newfarm.php?inviteuid=".$inviteuid."' target='_top'>tham gia Trang tr岷</a>";

		notification_add($value, 'farm', $note);
	}
	showmessage('G峄璱 l峄漣 m峄漣 th脿nh c么ng', 'newfarm.php?ac=invite');
}else{
	include('./DB.class.php');
	include_once ('./config.php');
	include_once('./common.php');
	include_once('./source/function_common.php');




	$uid=$_SGLOBAL['supe_uid'];

	function getfriend($uid) {
		$db = new DBAccess();
		$sql="SELECT fuid FROM uchome_friend where status=1 and uid=$uid";
		$friend=$db->fetch_all($sql);
		$friends = array();
		foreach($friend as $fuid){
			array_push($friends, $fuid[0]);		
		}
		return $friends;
	}

	function getuserinfo($v){
		$array=array();
		if(is_array($v)){
			$array=$v;
		}else{
			array_push($array,$v);
		}
		$db = new DBAccess();
		$friendInfo = array();

		foreach($array as $i=>$value){
			$sql="SELECT * FROM uchome_space where uid=$value";
			$userinfo=$db->fetch_first($sql);
			$name=empty($userinfo[name])?$userinfo[username]:$userinfo[name];
			//---------------------------------------------
			//UTF-8版本请注释本行  16BOX  2009-10-28
			//$name = iconv( "UTF-8", "GBK", $name );
			//--------------------------------------------
			$friendInfo[$i]['uid']=$userinfo['uid'];
			$friendInfo[$i]['name']=$name;
			//echo  $friendInfo[$i]['name'];
			//此处路径需要根据自己的网站UC路径修改
			$friendInfo[$i]['pic_thumb']="localhost/ucenter/avatar.php?uid=".$userinfo['uid']."&size=small&type=virtual";
			$friendInfo[$i]['pic_small']="localhost/ucenter/avatar.php?uid=".$userinfo['uid']."&size=middle&type=virtual";
			$friendInfo[$i]['pic']="localhost/ucenter/avatar.php?uid=".$userinfo['uid']."&size=big&type=virtual";
		}
		return $friendInfo;
	}

	$invitearr = array();
	$friends = getfriend($uid);
	
	foreach ($friends as $key=>$value) {
	  if (in_array($value,$gameuid)) {
		unset($friends[$key]);
	  }
	}
	$friends=array_values($friends);

	$page = empty($_GET['page'])?1:intval($_GET['page']);
	if($page<1) $page=1;
	$perpage = 15;
	$start = ($page-1)*$perpage;
	ckstart($start, $perpage);
	$count = count($friends);
	
	$friends =array_slice($friends,$start,$perpage);
	
	foreach($friends as $key=>$v){
		$friendInfo=getuserinfo($v);
		
		foreach($friendInfo as $i=>$value){
			$invitearr[$key]=$friendInfo[$i];
		}
	}
	//分页
	$multi = multi($count, $perpage, $page, "newfarm.php?ac=invite");


	include_once(template("farm_invite"));
}
?>
