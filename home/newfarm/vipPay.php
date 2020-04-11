﻿﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
</body>
</html>
<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
include_once( "../common.php" );
include_once( "../json.php" );
include_once( "vip.php" );
if ( empty( $_SGLOBAL['supe_uid'] ) )
{
	showmessage( "Vui lòng đăng nhập", "../do.php?ac=login" );
}
echo "<html><head><title>Nâng cấp lên Vip - Nông trại vui vẻ - Mạng xã hội Nhà Tui GoHooH.CoM</title></head><body>";
$queryVip = $_SGLOBAL['db']->query("SELECT uid,coalesce(vipstatus,0) as vipstatus,coalesce(validtime,0) as validtime,coalesce(jointime,0) as jointime,coalesce(vippoint,0) as vippoint,coalesce(level,1) as level,coalesce(endtime,0) as endtime,coalesce(rsign,0) as rsign FROM ".tname( "plug_newfarm_vip" )." WHERE uid = ".$_SGLOBAL['supe_uid'] );
while ( $valueVip = $_SGLOBAL['db']->fetch_array( $queryVip ) )
{
	$listVip[] = $valueVip;
}
$rs=split(",",verifyVip($_SGLOBAL['db'],$_SGLOBAL['timestamp'],$listVip[0]));
$dt=date('Y'.'z');
//$fbPMonthÿ�����20FB
$fbPMonth=20;
if(!isset($_POST['payMonth'])){
	if(count($listVip)==0){
		echo "Bạn không đủ Gee để tham gia nhóm VIP</br>";
	}elseif($rs[0]){
		if($listVip[0][rsign]<$dt ){
			getVipGift($rs[1],$_SGLOBAL['supe_uid'],$dt,$_SGLOBAL['db']);
			echo "<font color=\"#FF0000\">Vào nông trại của bạn và kiểm tra quà</font></br>";
		}else{
			echo "<font color=\"#FF0000\">Hôm nay bạn đã nhận quà VIP</font></br>";
		}
		$days=ceil(($listVip[0][validtime]-$_SGLOBAL['timestamp'])/86400);
		echo "Chúc mừng bạn gia hạn Vip ".$days." ngày</br>";
		if($rs[1]==7){
			echo "Bạn ở nhóm VIP</br>";
		}else{
			echo "Bạn cần ".$rs[2]." điểm và ".$rs[3]." ngày để có thể nâng cấp lên VIP ".($rs[1]+1)." </br>";
		}
	}else{
		$days=ceil(($_SGLOBAL['timestamp']-$listVip[0][validtime])/86400);
		echo "Nhóm Vip của bạn đã hết hạn ".$days." ngày, hãy mau chóng khôi phục VIP</br>";
		if($rs[1]==7){
			echo "Bạn ở nhóm VIP</br>";
		}else{
			echo "Bạn cần ".$rs[2]." điểm và ".$rs[3]."ngày để có thể nâng cấp lên VIP".($rs[1]+1)." </br>";
		}
	}
	echo "<form id=\"form1\" name=\"form1\" method=\"post\" action=\"vipPay.php\">
		  <label>Lựa chọn số tháng <select name=\"payMonth\">";
	for($i=1;$i<13;$i++){
		echo "<option value=\"".$i."\"";
		if($i==1)echo " selected=\"selected\"";
		echo ">".$i." tháng</option>";
	}
	echo "</select></label><input type=\"submit\" class=\"button\" value=\"Nâng cấp\"/><input type=\"hidden\" name=\"flag\" id=\"flag\" value=\"".count($listVip)."\"/><input type=\"hidden\" name=\"vipstatus\" id=\"vipstatus\" value=\"".$rs[0]."\"/><input type=\"hidden\" name=\"lv\" id=\"lv\" value=\"".$rs[1]."\"/><input type=\"hidden\" name=\"vippoint\" id=\"vippoint\" value=\"".$rs[2]."\"/><input type=\"hidden\" name=\"vdtime\" id=\"vdtime\" value=\"".$rs[4]."\"/></form>";
}else{
	$payMonth=$_POST['payMonth'];
	$flag=$_POST['flag'];
	$vipstatus=$_POST['vipstatus'];
	$lv=$_POST['lv'];
	$vippoint=$_POST['vippoint'];
	$vdtime=$_POST['vdtime'];
	$fb = $_SGLOBAL['db']->query( "SELECT fb FROM ".tname( "plug_newfarm" )." where uid=".$_SGLOBAL['supe_uid'] );
	while ( $value = $_SGLOBAL['db']->fetch_array( $fb ) )
	{
		$list[] = $value;
	}
	$fb = $list[0][fb] ;
	if($fb<$fbPMonth*$payMonth){
		echo "Bạn không đủ Gee";
		exit();
	}
	if(!$flag){
		$_SGLOBAL['db']->query("UPDATE ".tname( "plug_newfarm" )." set fb=fb-".($fbPMonth*$payMonth)." where uid=".$_SGLOBAL['supe_uid']);		
		list($year,$month,$day,$hour,$min,$second)=split ("-",date("Y-m-d-h-i-s",mktime(date("h"),date("i"),date("s"),date("m")+$payMonth,date("d"),date("Y"))));
		$vt=mktime($hour,$min,$second,$month,$day,$year);
		$_SGLOBAL['db']->query( "INSERT INTO ".tname( "plug_newfarm_vip" )." (uid,vipstatus,validtime,jointime,level) VALUES(".$_SGLOBAL['supe_uid'].",1,".$vt.",".$_SGLOBAL['timestamp'].",1)" );
		echo "Nâng cấp lên Vip thành công, bạn đang ở Vip 1 và cần 30 ngày để nâng cấp lên VIP2".date("Y��m��d��",mktime(0,0,0,date("m")+$payMonth,date("d"),date("Y")));
	}else{
		$_SGLOBAL['db']->query("UPDATE ".tname( "plug_newfarm" )." set fb=fb-".($fbPMonth*$payMonth)." where uid=".$_SGLOBAL['supe_uid']);
		if($vipstatus){
			list($year,$month,$day,$hour,$min,$second)=split ("-",date("Y-m-d-h-i-s",$_POST['vdtime']));
			$vt=mktime($hour,$min,$second,$month+$payMonth,$day,$year);
			$_SGLOBAL['db']->query("UPDATE ".tname( "plug_newfarm_vip" )." set validtime=".$vt." where uid=".$_SGLOBAL['supe_uid']);
			echo "Bạn đang ở VIP".$lv.", thời hạn của bạn là ".date("Y��m��d��",$vt);
		}else{
			list($year,$month,$day,$hour,$min,$second)=split ("-",date("Y-m-d-h-i-s",mktime(date("h"),date("i"),date("s"),date("m")+$payMonth,date("d"),date("Y"))));
			$vt=mktime($hour,$min,$second,$month,$day,$year);
			$_SGLOBAL['db']->query("UPDATE ".tname( "plug_newfarm_vip" )." set validtime=".$vt.",vipstatus=1,jointime=".$_SGLOBAL['timestamp']." where uid=".$_SGLOBAL['supe_uid']);
			echo "Bạn đang ở VIP ".$lv.", thời hạn của bạn là".date("Y��m��d��",$vt);
		}
	}
}
echo "</body></html>";
?>

