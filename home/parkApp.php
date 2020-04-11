<?php
require_once './common.php';
include_once './park/ClassParkInfo.php';
include_once(S_ROOT.'./source/function_cp.php');
checkclose();//�Ƿ�ر�վ��
checklogin();//�Ƿ��¼
ckavatar($_SGLOBAL['supe_uid']);
$space=getspace($_SGLOBAL['supe_uid']);
//window_set('����λ','parkApp.php?ac=index');
define(ADMIN_UID, 1);
$parkCfg=new CParkCfg();
$cfgBgfree = $parkCfg->cfgBgfree;
$cfgSys=$parkCfg->cfgStopLimit;

$arrOpencar=array(
  '1'=>1,
  '2'=>182,
  '3'=>183,
  '4'=>184,
  '5'=>185,
);
$randCar=rand(1,5);
$carID=$arrOpencar[$randCar];
$i=rand(1,8);
$P_bg='bb'.$i.'.jpg';
$P_bgdesc="\'s ".$cfgBgfree[$P_bg];
$P_bg='park/images/'.$P_bg;

$space=getspace($_SGLOBAL['supe_uid']);
$arrac = array('index', 'market', 'stage','rank', 'invite', 'help', 'admin','install','debug','set','oldmarket');
foreach($arrac as $key){
	$actives[$key] = ' ';
}
$ac = (empty($_GET['ac']) && !in_array($_GET['ac'], $arrac)) ? 'index':$_GET['ac'] ;
$actives[$ac] = ' class=active';
$parkicon="park";
if($ac=='install'){
   $nowtime=date("Y-m-d H:i:s"); 
   $arrMember = array(
		"uid" => $_SGLOBAL['supe_uid'],
		"P_bg" =>$P_bg,
		"P_credit" => $cfgSys[OpenCredit],
		"P_lot_free" => rand(1,4),
		"P_lot_color" => rand(1,10),
		"P_lot_type" => rand(1,10),
		"P_lot_level" => rand(1,10),		
		"LimitType" =>rand(1,3),		
		"P_bgdesc" => $P_bgdesc,
	);
  $sql="select count(*) from ".tname('park_member')." where uid=".$_SGLOBAL['supe_uid'];
  $query=$_SGLOBAL['db']->query($sql);
  $intNum = $_SGLOBAL['db']->result($query,0);
	  if($intNum==0){	
		inserttable( "park_member", $arrMember );	
		$arrMemberset=array(
		  'uid'=>$_SGLOBAL['supe_uid']
		);  
		inserttable("park_memberset",$arrMemberset);
	   $arrMycar = array(
			"uid" => $_SGLOBAL['supe_uid'],
			"CarID" =>$carID,
			"BuyTime" => $nowtime,
			"BuyCredit" => 0,
	
		);
	}
	inserttable( "park_mycar", $arrMycar );	
	//�¼�feed
	$fs = array();
	$fs['icon'] =$parkicon;
    $fs['title_template'] = "{actor} tham gia <a href='parkApp.php?ac=index'>cuộc chiến đỗ xe</a> và nhận <b>tiền thuởng</b> ".$cfgSys[OpenCredit]." vàng tại <a target='blank' href='http://www.gohooh.com/nhatui/'>Nhà Tui</a>";	
	$fs['title_data'] = array();
	$fs['body_template'] = '';
	$fs['body_data'] = array();	
	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);	
 	showmessage('Vui lòng đăng nhập!','parkApp.php?ac=index');		
    showmessage($ac);
   
}
isOpenPark($_SGLOBAL['supe_uid']);
include_once(S_ROOT."./park/park_{$ac}.php");
function isOpenPark($uid){
  global $_SGLOBAL;
  $sql="select count(*) from ".tname('park_member')." where uid=".$_SGLOBAL['supe_uid'];
  $query=$_SGLOBAL['db']->query($sql);
  $intNum = $_SGLOBAL['db']->result($query,0);
  if($intNum==0){
     showmessage('Bạn chưa kích hoạt game cuộc chiến đỗ xe! <br><a href="parkApp.php?ac=install" class="submit">Kích hoạt ngay</a>.');    
  }
}
?>