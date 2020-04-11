<?php
include_once 'ClassParkInfo.php'; 
//±¨¾¯
$uid=intval($_POST['fId']);
$carID=intval($_POST['carId']);
$carpos=intval($_POST['carpos']);
$ParkMember= new CParkMember($uid);
$fusername=$ParkMember->P_username;
$arrlot=$ParkMember->P_arrlot;
$P_username=$arrlot[$carpos-1][stopuser];
$P_uid=$arrlot[$carpos-1][stopuid];
$P_photo=$arrlot[$carpos-1][caruserphoto];
$carname=$arrlot[$carpos-1][carImgDescript];
$policemanTip="We will check your report ASAP";
$_SGLOBAL[db]->query("update ".tname('park_record')." set ParkWarned=ParkWarned+1 where RID=".$ParkMember->P_lot[$carpos-1]);
$nowtime=date("Y-m-d H:i:s");
//¾Ù±¨ÏÞÖÆÊ±¼ä
$sql="select WarnTime from ".tname('park_warn')." where RID=".$ParkMember->P_lot[$carpos-1];
$lasttime=$_SGLOBAL['db']->result($_SGLOBAL['db']->query($sql));
$intLasttime=getTimeofstage($lasttime);
$parkCfg=new CparkCfg(); //ÉèÖÃÀà
$cfgStopLimit=$parkCfg->cfgStopLimit;//ÏµÍ³ÉèÖÃ
$limitTime=$cfgStopLimit[stop];	   //¶à³¤Ê±¼äÄÚ²»ÄÜÔÙ´Î¾Ù±¨
$WarnNum=$cfgStopLimit[WarnNum];	//¾Ù±¨Í¬Ò»³µµÄ´ÎÊý
$permitWarn=1;
if($intLasttime<intval($limitTime)){
  $permitWarn=0;
  $subtime=intval($limitTime)-intval($intLasttime);  
  $policemanTip="Vượt quá giới hạn, hãy liên hệ BQT để biết thêm chi tiết. ".$subtime." mins";   
}

$sql="select count(*) from ".tname('park_warn')." where RID=".$ParkMember->P_lot[$carpos-1];
$mywarnNum=$_SGLOBAL['db']->result($_SGLOBAL['db']->query($sql));
if($mywarnNum>$WarnNum-2){
  $permitWarn=0;
  $policemanTip="Bạn đã đỗ xe quá mức, hãy mau đỗ xe ở nơi khác. ".$mywarnNum." times";  
}

if($permitWarn==1){
	$arrWarn=array(
	  "RID"=>$ParkMember->P_lot[$carpos-1],
	  "uid"=>$_SGLOBAL['supe_uid'],
	  "WarnTime"=>$nowtime
	);
	
	inserttable("park_warn",$arrWarn);
	
	$fs = array();
	$fs['icon'] ="stick";
	$fs['title_template'] = "{actor} báo cáo cho cảnh sát ".$carname." về <a href='parkApp.php?ac=index&fId=".$uid."'>".$P_username."</a> đã <a href='parkApp.php?ac=index&fId=$uid'>".$fusername."</a> park";
	$fs['note_template'] = " đậu xe trái phép ".$carname."tại bãi đỗ <a href='parkApp.php?ac=index&ac=index&fId=$uid'>".$fusername."</a> hãy mau ra khỏi đó!";
	sendMessage($fs['icon'],$fs['title_template'],'MessFeed',$uid);
	sendMessage($fs['icon'],$fs['note_template'],'MessNote',$P_uid);
}else{
	$fs = array();
	$fs['icon'] ="stick";
	$fs['title_template'] = "{actor} hãy báo cáo với cảnh sát về việc đâu xe  ".$carname." phạm phạm bởi  <a href='parkApp.php?ac=index&fId=".$uid."'>".$P_username."</a> tại bãi đỗ <a href='parkApp.php?ac=index&fId=$uid'>".$fusername."</a>, nhưng báo cáo thất bại";
	$fs['note_template'] = " báo cáo với cảnh sát về chiếc xe ".$carname." đã đậu xe trái phép tại bãi đỗ<a href='parkApp.php?ac=index&ac=index&fId=$uid'>".$fusername."</a>, nhanh lên trước khi nó ra khỏi bãi đỗ.";
	sendMessage($fs['icon'],$fs['title_template'],'MessFeed',$uid);
	sendMessage($fs['icon'],$fs['note_template'],'MessNote',$P_uid);
  
}
echo '<?xml version="1.0" encoding="utf-8" ?> ';
echo "<root>";
echo "<who>";
echo "<whoUser>".$P_username."</whoUser>"; 
echo "<whoUserImg>".$P_photo."</whoUserImg>";
echo "</who>"; 
echo "<policemanTip>".$policemanTip."</policemanTip>";
echo "</root>";

//ob_start();
//var_dump($_REQUEST);
//$content=ob_get_contents();
//ob_end_clean();
//$p=$P_username;
//$test=$ParkMember->P_lot[$carpos];
//$_SGLOBAL['db']->query("insert into test (test) value ('$test')"); 

?>
