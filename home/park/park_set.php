<?php
include_once './park/ClassParkInfo.php';
//实名
realname_get();
//获取当前用户的空间信息
$space = getspace($_SGLOBAL['supe_uid']);

$parkCfg=new CParkCfg();
$cfgColor = $parkCfg->cfgColor;
$cfgCarType = $parkCfg->cfgCarType;
$cfgCarLevel = $parkCfg->cfgCarLevel;
$cfgBg=$parkCfg->cfgBgfree;
$cfgStopLimit=$parkCfg->cfgStopLimit;

$ac=empty($_GET[ac])?"set":$_GET[ac];
//设置
if($ac=='set'){

  $parkMember=new CparkMember($_SGLOBAL['supe_uid']);
  $memberinfo=$parkMember->P_arrMember;
  $arrLot=array(1=>'No.1 Port',2=>'No.2 Port',3=>'No.3 Port',4=>'No.4 Port');
  $arrLimittype=array(1=>'color',2=>'type',3=>'lvl');
  $parkMember->getMemberset($_SGLOBAL['supe_uid']); 
  $arrMemberset=$parkMember->P_arrMemberset;
  $stopfeed=$arrMemberset[StopFeed]?'checked="checked"':'';
  $stopnote=$arrMemberset[StopNote]?'checked="checked"':'';
  $messfeed=$arrMemberset[MessFeed]?'checked="checked"':'';
  $messnote=$arrMemberset[MessNote]?'checked="checked"':'';
  $warnfeed=$arrMemberset[WarnFeed]?'checked="checked"':'';  
  $warnnote=$arrMemberset[WarnNote]?'checked="checked"':'';
  $stagefeed=$arrMemberset[StageFeed]?'checked="checked"':'';
  $stagenote=$arrMemberset[StageNote]?'checked="checked"':'';
  $buyfeed=$arrMemberset[BuyFeed]?'checked="checked"':'';
  $buynote=$arrMemberset[BuyNote]?'checked="checked"':'';  
  
}
//兑入
if (submitcheck('setinsubmit')){
  if($cfgStopLimit[ExchangeOpen]==1){
    $ExchangePercent=intval($cfgStopLimit[ExchangePercent]);
    $space=getspace($_SGLOBAL[supe_uid]);
    $uchcredit=intval($space[credit]);
	$point1=intval($_POST['creditin']);
	if($point1>$uchcredit){
	  showmessage("Sorry, your credits is not enough to exchange");
	}
    $_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit = credit-'$point1' WHERE uid = '$_SGLOBAL[supe_uid]'");
	$point=floor($_POST['creditin'])*$ExchangePercent;
    $_SGLOBAL['db']->query("UPDATE ".tname('park_member')." SET P_credit=P_credit+'$point' WHERE uid = '$_SGLOBAL[supe_uid]'");

	//事件feed
	$fs = array();
	$fs['icon'] = 'app';
	$fs['title_template'] = "<b>{actor} successfully got ".$point." parking gold by exchanging</b>";

	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template']);	      
	showmessage('You have exchanged '.$point1.' credits to '.$point.' parking gold, forwarding to your park now...','parkApp.php?ac=index',1);	
	
  }else{
    showmessage("Exchange is disable");
  }
}
//兑出
if (submitcheck('setoutsubmit')){
  if($cfgStopLimit[ExchangeOpen]==1){
    $ExchangePercent=intval($cfgStopLimit[ExchangePercent]);
	$parkMember=new CParkMember($_SGLOBAL[supe_uid]);
    $P_credit=$parkMember->P_credit;
	$point=intval($_POST['creditout']);
	if($point>$P_credit){
	  showmessage("Sorry, ".$P_credit." parking gold is not enough to exchange ".$point." credits");
	}
	
	$limit=$ExchangePercent;
	if($point<$limit){
	  showmessage("Sorry, you parking gold is less than ".$limit.", can not continue the exchanging");
	}
	$point1=floor($_POST['creditout']/$ExchangePercent);
    $_SGLOBAL['db']->query("UPDATE ".tname('space')." SET credit = credit+'$point1' WHERE uid = '$_SGLOBAL[supe_uid]'");
	$point=$point1*$ExchangePercent;
    $_SGLOBAL['db']->query("UPDATE ".tname('park_member')." SET P_credit = P_credit-'$point' WHERE uid = '$_SGLOBAL[supe_uid]'");

	//事件feed
	$fs = array();
	$fs['icon'] = 'app';
	$fs['title_template'] = "<b>{actor} successfully exchanged ".$point1." credits</b>";

	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template']);	      
	showmessage('You successfully exchanged '.$point.' parking gold to '.$point1.' credits, forwarding to your space...','parkApp.php?ac=index',1);	
	
  }else{
    showmessage("Credits exchange is disable");
  }
}
//提交设置
if (submitcheck('setsubmit')){
   $lotfree=intval($_POST['lotfree']);
   $carcolor=intval($_POST['CarColor']);
   $bg="park/images/".$_POST['bg'];
   $bgdesc='的'.$cfgBg[$_POST['bg']];
   $limittype=$_POST['limittype'];
   $cartype=intval($_POST['CarType']);
   $carlevel=intval($_POST['CarLevel']);
   if(empty($_POST['bg'])){
     $arrSet=array('P_lot_free'=>$lotfree,'P_lot_color'=>$carcolor,'LimitType'=>$limittype,'P_lot_type'=>$cartype,'P_lot_level'=>$carlevel);
   }else{
     $arrSet=array('P_lot_free'=>$lotfree,'P_lot_color'=>$carcolor,'P_bg'=>$bg,'P_bgdesc'=>$bgdesc,'LimitType'=>$limittype,'P_lot_type'=>$cartype,'P_lot_level'=>$carlevel,'P_stageID'=>0);   
   }
   updatetable( "park_member",$arrSet,array('uid'=>$_SGLOBAL['supe_uid']));	
   
   $stopfeed=intval($_POST['stopfeed']);
   $stopnote=intval($_POST['stopnote']);
   $warnfeed=intval($_POST['warnfeed']);
   $warnnote=intval($_POST['warnnote']);
   $messnote=intval($_POST['messnote']);
   $messfeed=intval($_POST['messfeed']);
   $stagefeed=intval($_POST['stagefeed']);
   $stagenote=intval($_POST['stagenote']);
   $buyfeed=intval($_POST['buyfeed']);
   $buynote=intval($_POST['buynote']);
   $arrSetf=array('StopFeed'=>$stopfeed,'StopNote'=>$stopnote,'WarnFeed'=>$warnfeed,'WarnNote'=>$warnnote,'MessFeed'=>$messfeed,'MessNote'=>$messnote,'StageFeed'=>$stagefeed,'StageNote'=>$stagenote,'BuyFeed'=>$buyfeed,'BuyNote'=>$buynote);
   updatetable("park_memberset",$arrSetf,array('uid'=>$_SGLOBAL['supe_uid']));
   
   
   			 
   showmessage("Update Successfully","parkApp.php?ac=index",1);  
}	
include_once( template( "park/view/park_set" ));
?>