<?php
include_once 'ClassParkInfo.php'; 
//flash»ù´¡Êý¾Ý
$uid=intval($_POST['fId']);
$fid=intval($_POST['fid']);
$lot=intval($_POST['stationId']);
if(strlen($fid)>10){
   $intPos=strpos($fid,"b285686d8bb3de0ab796d02fad9629f1");
   $fid=substr($fid,0,$intPos);
}
if(strlen($lot)>10){
   $intPos=strpos($lot,"b285686d8bb3de0ab796d02fad9629f1");
   $lot=substr($lot,0,$intPos);
}

$mestype=empty($_POST['mestype'])?"":$_POST['mestype'];
$meuid=$_POST['fid'];
$uid=empty($uid)?$_SGLOBAL['supe_uid']:$uid;
$ParkMember= new CParkMember($uid);
$P_username=$ParkMember->P_username;

if($mestype=="stopMes"){
   setMessage($fid,$lot);
}

echo '<?xml version="1.0" encoding="utf-8" ?> ';
echo "<root>";
echo "<name>".$ParkMember->P_username."</name>";
echo "<fid>".$ParkMember->P_friendstr."</fid>";
echo "<currentfuid>".$uid."</currentfuid>";
echo "<uid>".$ParkMember->P_loginuid."</uid>";
echo "<picdescript>".$ParkMember->P_fidphoto."</picdescript>";
echo "<spacedescript>".$ParkMember->P_bg."</spacedescript>";
echo "<descript>".$ParkMember->P_bgdesc."</descript>";
echo "<loginUser>".$ParkMember->P_username."</loginUser>";
echo "<userIcon>".$ParkMember->P_photo."</userIcon>";
echo "<friendCarUrl>".$ParkMember->P_friendCarUrl."</friendCarUrl>";
echo "<creditadd>".$ParkMember->P_CreditAdd."</creditadd>";
echo "<carstop>";

for($i=0;$i<4;$i++){
echo "<car>";
echo "<cartype>".$ParkMember->P_arrlot[$i]['cartype']."</cartype>";
echo "<parkcolor>".$ParkMember->P_arrlot[$i]['parkcolor']."</parkcolor>";
echo "<stop>".$ParkMember->P_arrlot[$i]['stop']."</stop>";
echo "<caroperation>".$ParkMember->P_arrlot[$i]['caroperation']."</caroperation>";
echo "<stopPostionId>".$ParkMember->P_arrlot[$i]['stopPostionId']."</stopPostionId>";
echo "<stopuser>".$ParkMember->P_arrlot[$i]['stopuser']."</stopuser>";
echo "<stopgold>".$ParkMember->P_arrlot[$i]['stopgold']."</stopgold>";
echo "<carimg>".$ParkMember->P_arrlot[$i]['carimg']."</carimg>";
echo "<carid>".$ParkMember->P_arrlot[$i]['carid']."</carid>";
echo "<stopuserLink>".$ParkMember->P_arrlot[$i]['stopuserLink']."</stopuserLink>";
echo "<caruserphoto>".$ParkMember->P_arrlot[$i]['caruserphoto']."</caruserphoto>";
echo "<carImgDescript>".$ParkMember->P_arrlot[$i]['carSignalName']."</carImgDescript>";
echo "<carPrice>".$ParkMember->P_arrlot[$i]['carPrice']."</carPrice>";
echo "<carSignalName>".$ParkMember->P_arrlot[$i]['carImgDescript']."</carSignalName>";
echo "</car>";
}
echo "</carstop>";
echo "</root>";


//ob_start();
//var_dump($_REQUEST);
//$content=ob_get_contents();
//ob_end_clean();
//$p=$content;
//$test=$p;
//$_SGLOBAL['db']->query("insert into test (test) value ('$test')"); 
?> 


