<?php
//巡警任务
	
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}
include_once('./common.php');
$arrXj=array('1'=>'Optimus','2'=>'Terminator','3'=>'Leonidas','4'=>'Illidan',5=>'TANK');	
$sql="select * from uchome_park_record where ParkStatus=1 order by ParkWarned desc limit 0,100";
global $_SGLOBAL; 
$query =$_SGLOBAL['db']->query($sql);
$list=array();
$i=0;
$k=0;
while($valuerec =$_SGLOBAL['db']->fetch_array($query)){
  $list[]=$valuerec;
  $startXj=0;
  if(intval($valuerec[ParkWarned])>3){
    $startXj=1;
  };
  $mytime=$valuerec[ParkStartTime];
  $long=getTimeDifference($mytime);
  if($long>720){
    $startXj=1;   
  }
  $intNum=$_SGLOBAL['db']->result($_SGLOBAL['db']->query("select count(*) from ".tname('park_mystage')." where StageID=8 and uid=".$valuerec[ParkUid]),0);
  if($intNum<>0){
    $k=rand(1,10);
	if($k==4){
	  $startXj=1; 
	}else{
	  $startXj=0; 
	  $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where uid=".$valuerec[ParkUid]." limit 1");
	}
  }
  if($startXj){ 
    $uid=$valuerec[ParkWhoUid];
	$lot=$valuerec[Parklot];
    $space=getspace($uid);
	$myname=$space[username];	 
	$carID=$valuerec[CarID];
	$ParkUid=$valuerec[ParkUid];
	$ParkSpace=getspace($ParkUid);
	$username=$ParkSpace[username];
	$sql="update ".tname('park_member')." set P_lot_".$lot."=0 where uid=".$uid;
	$_SGLOBAL['db']->query($sql);
	$nowtime=date("Y-m-d H:i:s");
	$sql="update ".tname('park_record')." set ParkStartTime='$nowtime',ParkEndTime='$nowtime',ParkCredit=0,ParkStatus=0 where RID='$valuerec[RID]'";
	$_SGLOBAL['db']->query($sql);
	$sql="update ".tname('park_mycar')." set ParkWhoUid=0,ParkLot=0,BuyTime='$nowtime' where uid=".$ParkUid." and CarID='$carID'";
	$_SGLOBAL['db']->query($sql);
	$fs = array();
	$fs['icon'] ="stick";
	$i=rand(1,5);
	$xjName=$arrXj[$i]; 	  
	$fs['title_template'] = "<b>Officer ".$xjName."</b> gave a ticket to <a href='space.php?uid=".$ParkUid."'>".$username."</a>'s car which is parking at <a href='parkApp.php?ac=index&fId=$uid'>".$myname."</a> No.".$lot." port";
	$fs['note_template'] = "Officer ".$xjName." gave a ticket to your car which is parking at <a href='parkApp.php?ac=index&fId=$uid'>".$myname."</a> No.".$lot." port";
	include_once(S_ROOT.'./source/function_cp.php');
	feed_add($fs['icon'], $fs['title_template']);
	notification_add($ParkUid, app, $fs['note_template']);

  }
}

function getTimeDifference($dateParkStartTime){
  $nowtime=date("Y-m-d H:i:s"); 
  $addtime=abs(strtotime($nowtime)-strtotime($dateParkStartTime));	  
  if($addtime>216000){//超过六十个小时
	$intMinute=3600;
  }else{
	$intMinute=floor($addtime/60);
  }
  return $intMinute;

}

?>