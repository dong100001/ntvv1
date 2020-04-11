<?php
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}

include_once('./common.php');
include_once './park/ClassParkInfo.php';
$op = empty($_GET['op'])?'':$_GET['op'];
$uid = empty($_GET['uid'])?0:intval($_GET['uid']);
$sid = empty($_GET['sid'])?'0':$_GET['sid'];
if($op=='changebgend'){
   $StageID=intval($_POST['StageID']);
   $ID=intval($_POST['ID']);   
   $parkStage=new Cparkstage($StageID);
   $arrStage=$parkStage->arrStage;
   $bgdesc="'s".substr($arrStage[StageName],0,4);
   $parkCfg=new CParkCfg();
   $cfgbg=$parkCfg->cfgBg;
   $P_bg=$cfgbg[$StageID][0];
   $P_bgcredit=$cfgbg[$StageID][1];
   $arrMyuse=$parkStage->getMyStageByID($ID);
   
   $permit=setMyuse($arrMyuse,$arrStage);
   if($permit==1){
	   $sql="update ".tname('park_member')." set P_bgdesc='$bgdesc',P_bg='park/images/".$P_bg."',P_stageID=".$StageID." where uid=".$_SGLOBAL['supe_uid'];
	   $_SGLOBAL['db']->query($sql);
	   $icon='stick';
	   $title="{actor} thay đổi cảnh bãi đỗ  <a href='parkApp.php?ac=index&fId='".$_SGLOBAL['supe_uid']."'>".substr($arrStage[StageName],0,4)."</a>, bãi đậu xe trong cảnh này kiếm được ".$P_bgcredit." vàng mỗi phút";
	   sendMessage($icon,$title,'StageFeed');   
	   showmessage("Thẻ được sử dụng thành công","parkApp.php?ac=stage&op=my",1);
   }else{
      showmessage("Thẻ không hợp lệ hoặc đã quá hạn sử dụng","parkApp.php?ac=stage&op=my",1);
   }
   
 
}
//»»±³¾°µÀ¾ß
if($op=='changebg'){
  $StageID=$_GET['stageid'];
  $ID=$_GET['ID'];
  $parkstage=new Cparkstage($StageID);
  $stageinfo=$parkstage->arrStage;
  
}
//ÄäÃû¾Ù±¨½áÊø
if($op=='nonamewarnend'){
   $StageID=intval($_POST['StageID']);
   $ID=intval($_POST['ID']);  
   $parkStage=new Cparkstage($StageID);
   $arrStage=$parkStage->arrStage;
   $arrMyuse=$parkStage->getMyStageByID($ID);
   $permit=setMyuse($arrMyuse,$arrStage);
   if($permit==1){  
	   $sql="update ".tname('park_record')." set ParkWarned=ParkWarned+1 where ParkUid in (select fuid from ".tname('friend')." where uid=".$_SGLOBAL['supe_uid'].") and ParkStatus=1";
	   $_SGLOBAL['db']->query($sql);
	   showmessage("Thẻ được sử dụng thành công","parkApp.php?ac=stage&op=my",1);      
   }else{
	   showmessage("Thẻ đã quá hạn","parkApp.php?ac=stage&op=my",1);   
   }
 
}
//ÄäÃû¾Ù±¨
if($op=='nonamewarn'){

  $StageID=$_GET['stageid'];
  $ID=$_GET['ID'];
  $parkstage=new Cparkstage($StageID);
  $stageinfo=$parkstage->arrStage;
  
}
//³ä¹«½áÊø
if($op=='forfeitend'){
  $StageID=$_POST['stageid'];
  $ID=$_POST['ID'];
  $myID=$_POST['myID'];
  $parkstage=new Cparkstage($StageID);
  $stageinfo=$parkstage->arrStage;
  $arrMyuse=$parkstage->getMyStageByID($ID);
  $permit=setMyuse($arrMyuse,$stageinfo);
  $sql="select * from ".tname('park_mycar')." where ID=".$myID;
  $mycarinfo=getSqlResult($sql);  
  $intNum=$_SGLOBAL['db']->result($_SGLOBAL['db']->query("select count(*) from ".tname('park_mystage')." where StageID=5 and uid=".$mycarinfo[uid]),0);
  if($intNum<>0){
    $permit==0;
	$_SGLOBAL['db']->query("delete from ".tname('park_mycar')." where ID=".$ID);
	showmessage("Bạn đã bị tịch tu thẻ, không thể sử dụng ","parkApp.php?ac=stage&op=my",1);
	
  }
  if($permit==1){  
       $myspace=getspace($arrMyuse[uid]);
       $username=$myspace[username];
	   $sql="select * from ".tname('park_mycar')." where ID=".$myID;
	   $mycarinfo=getSqlResult($sql);
	   $myspace=getspace($mycarinfo[uid]);
	   $username=$myspace[username];  
	   $parkcarinfo=new CparkcarInfo($mycarinfo[CarID]);
	   $carinfo=$parkcarinfo->arrCar;	   	   	   
	   $_SGLOBAL['db']->query("delete from ".tname('park_mycar')." where ID=".$myID);
	   $icon='stick';
	   $title="{actor} sử dụng thẻ để tịch thu <a href='parkApp.php?ac=index&fId=".$mycarinfo[uid]."'> của ".$username."</a> ".$carinfo[CarDesc];
   	   $notetitle=" bạn đã bị tịch thu thẻ ".$carinfo[CarDesc];
	   sendMessage($icon,$title,'StageFeed');      
	   sendMessage($icon,$notetitle,'StageNote',$mycarinfo[uid]);      
	   showmessage("Thẻ được sử dụng thành công","parkApp.php?ac=stage&op=my",1);
   }else{
	   showmessage("Thẻ đã quá hạn sử dụng","parkApp.php?ac=stage&op=my",1);   
   }

}
//³ä¹«
if($op=='forfeit'){

  $StageID=$_GET['stageid'];
  $ID=$_GET['ID'];
  $parkstage=new Cparkstage($StageID);
  $stageinfo=$parkstage->arrStage;
  $sql="select * from ".tname('park_mycar')." m,".tname('park_carinfo')." c where m.carid=c.carid  and c.carprice<200000 and m.uid in (select fuid from ".tname('friend')." where uid=".$_SGLOBAL['supe_uid'].") and ParkLot=0 order by rand() limit 0,1";
  $mycarinfo=getSqlResult($sql);
  $myspace=getspace($mycarinfo[uid]);
  $username=$myspace[username];  
  $myID=$mycarinfo[ID];
  $parkcarinfo=new CparkcarInfo($mycarinfo[CarID]);
  $carinfo=$parkcarinfo->arrCar;
  
}
include_once( template( "park/view/cp_stage" ) );



?>
