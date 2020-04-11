<?php
if(!defined('IN_UCHOME')) {
	exit('Access Denied');
}
include_once('./common.php');
include_once './park/ClassParkInfo.php';
$op = empty($_GET['op'])?'':$_GET['op'];
$uid = empty($_GET['uid'])?0:intval($_GET['uid']);
$sid = empty($_GET['sid'])?'0':$_GET['sid'];

//¹ºÂò½áÊø
if($op=='buyend'){
	//ÅÐ¶ÏÊÇ·ñ·¢²¼Ì«¿ì
	$waittime = interval_check('post');
	if($waittime > 0) {
		showmessage('operating_too_fast','',1,array($waittime));
	}
   if(!empty($_POST['carid'])){
       $permitBuy=1;
	   $CarID=intval($_POST['carid']);   
	   $nowtime=date("Y-m-d H:i:s");
	   $parkCarInfo=new CparkcarInfo($CarID);
	   $BuyCredit=intval($parkCarInfo->CarPrice);
	   $parkMember=new CParkMember($_SGLOBAL['supe_uid']);
	   $myCredit=intval($parkMember->P_credit);
	   $stageid=empty($_POST['stageid'])?0:$_POST['stageid'];
	   $ID=empty($_POST['ID'])?0:$_POST['ID'];

	   if($myCredit<$BuyCredit){
	     $permitBuy=0;
		 showmessage("Bạn không có đủ vàng để mua chiếc xe này","parkApp.php?ac=market",1);	 
	   }
	   $myCar=new CmyCar($_SGLOBAL['supe_uid']);
	   $intCarCount=intval($myCar->CarCount);
	   $parkCfg=new CParkCfg();
	   $cfgStopLimit=$parkCfg->cfgStopLimit;
	   $limitCount=intval($cfgStopLimit[CarLimit]);

	   if($intCarCount>=$limitCount){
	     $permitBuy=0;
		 showmessage("xe của bạn đã đạt đến giới hạn","parkApp.php?ac=market",1);
	   }
	   $myCar->isExitOfCar($CarID,$_SGLOBAL['supe_uid']); 
	   if($myCar->isExitCar!=0){
	     $permitBuy=0;
		 showmessage("Bạn đã sở hữu chiếc xe này, không thể mua một lần nữa","parkApp.php?ac=market",1);   
	   }
	   if($stageid!=0){
	     $query=$_SGLOBAL['db']->query("select count(*) from ".tname('park_mystage')." where ID=".$ID);
		 $intNum=$_SGLOBAL['db']->result($query,0);
		 $parkStage=new Cparkstage($stageid);
		 $arrStage=$parkStage->arrStage;
		 $arrMyuse=$parkStage->getMyStageByID($ID);
		 $permitBuy=setMyuse($arrMyuse,$arrStage);
   	     if($intNum!=0&&$permitBuy==1){
	       $BuyCredit=floor($BuyCredit*0.9);
		   $BuyDesc='Use discount card';
		   }else{
		     showmessage('The card is invalid',"parkApp.php?ac=market",1);
		   }
	   }	   
	   if($permitBuy==1){
		   $arrMycar=array(
			 uid=>$_SGLOBAL['supe_uid'],
			 CarID=>$CarID,
			 BuyTime=>$nowtime,
			 BuyCredit=>$BuyCredit, 
		   );

		   inserttable("park_mycar",$arrMycar);
		   $_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit-".$BuyCredit." where uid=".$_SGLOBAL['supe_uid']);
		   $icon='stick';
		   $title='{actor} chi tiêu '.$BuyCredit.' vàng để mua một'.$parkCarInfo->CarDesc.' tại <a href="parkApp.php?ac=market">market</a> with '.$BuyDesc;
		   sendMessage($icon,$title,'BuyFeed');
		   showmessage("Bought the ".$parkCarInfo->CarDesc." successfully","parkApp.php?ac=market",1);
	   }
   }else{
	   showmessage("Không thể chọn, xin vui lòng chọn lại","parkApp.php?ac=market",1);   
   }

	 
}
//¹ºÂò
if($op=='buy'){
	$sql="select * from ".tname('park_carinfo')." where CarSID=".$sid;
    $query =$_SGLOBAL['db']->query($sql);
	$listcar=array();
    while($value =$_SGLOBAL['db']->fetch_array( $query )){
	  $listcar[]=$value;
	}
	$carname=$listcar[0][CarDesc];
	$stageid=empty($_GET['stageid'])?0:$_GET['stageid'];
	$ID=empty($_GET['ID'])?0:$_GET['ID'];
}
//¹ºÂòµÀ¾ß½áÊø
if($op=='buystageend'){
  $StageID=intval($_POST['StageID']);
  $permitBuy=1;
   $parkStage=new Cparkstage($StageID);
   $arrStage=$parkStage->arrStage;
   $BuyCredit=intval($arrStage[StagePrice]);
   $parkMember=new CParkMember($_SGLOBAL['supe_uid']);
   $myCredit=intval($parkMember->P_credit);
   if($myCredit<$BuyCredit){
	 $permitBuy=0;
	 showmessage("Bạn không có đủ vàng để mua nó","parkApp.php?ac=stage",1);	 
   }
   $price=intval($arrStage[StagePrice]);
   $name=$arrStage[StageName];
   $nowtime=date("Y-m-d H:i:s"); 
   if($permitBuy==1){  
	   $arrStage=array(
		 uid=>$_SGLOBAL['supe_uid'],
		 StageID=>$StageID,
		 BuyTime=>$nowtime,
	   );
		 		
	   inserttable("park_mystage",$arrStage);
	   $_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit-".$price." where uid=".$_SGLOBAL['supe_uid']);
	   
	   $icon='stick';
	   $title='{actor} chi tiêu '.$price.' vàng để mua một '.$name.' tại <a href="parkApp.php?ac=stage">Thẻ sự kiện</a>';
	   sendMessage($icon,$title,'StageFeed');
	   showmessage("Purchased successfully".$StageID,"parkApp.php?ac=stage",1);
   }
}
//ÂòµÀ¾ß
if($op=='buystage'){
  $StageID=$_GET['stageid'];
  $parkstage=new Cparkstage($StageID);
  $stageinfo=$parkstage->arrStage;
  
}
//ÔùËÍºÃÓÑ³µ½áÊø
if($op=='sendfriendend'){
  $CarID=$_POST['CarID'];
  $username=$_POST['username'];
  $sql="select uid from ".tname('space')." where username='".$username."'";
  $uid=$_SGLOBAL['db']->result($_SGLOBAL['db']->query($sql),0);
  if(empty($uid)){  
    $permitSend=0;
	showmessage("Người này không có trong danh sách bạn bè của bạn","parkApp.php?ac=index",1);	
  }
  $arrmyCar=getMyCar($_SGLOBAL['supe_uid'],$CarID);
  $permitSend=1;
  if($arrmyCar[ParkLot]!=0){
    $permitSend=0;
	showmessage("Không thể gửi chiếc xe này cho bạn bè","parkApp.php?ac=index",1);	
  } 
   $myCar=new CmyCar($uid);
   $myCar->isExitOfCar($CarID,$uid); 
   if($myCar->isExitCar!=0){
	 $permitSend=0;
	 showmessage("Bạn của bạn có một chiếc xe giống như này","parkApp.php?ac=index",1);   
   }
  $parkCfg=new CParkCfg();
  $cfgStopLimit=$parkCfg->cfgStopLimit;
  $limitCount=intval($cfgStopLimit[CarLimit]);      
  if($myCa->CarCount>$limitCount-1){
	 $permitSend=0;
	 showmessage("Bạn của bạn có quá nhiều xe ô tô, không thể lấy xe nữa","parkApp.php?ac=index",1);   

  }
  $nowtime=date("Y-m-d H:i:s");
  if($permitSend==1){
	   $arrCar=array(
		 uid=>$uid,
		 CarID=>$CarID,
		 BuyTime=>$nowtime,
	   );
	   inserttable("park_mycar",$arrCar);
	   $_SGLOBAL['db']->query("delete FROM ".tname('park_mycar')." where uid=".$_SGLOBAL['supe_uid']." and CarID='$CarID'");
       $carParkcarInfo=new CparkcarInfo($CarID);
       $carname=$carParkcarInfo->CarDesc;	   
	   $icon='stick';
	   $title='{actor} đã cho '.$carname." tới <a href='parkApp.php?fId=$uid'>".$username."</a>như một món quà";
	   $notetitle=' đã tặng '.$carname." một món quà cho bạn";
       sendMessage($icon,$title,'BuyFeed');	   
       sendMessage($icon,$notetitle,'BuyNote',$uid);	   	   
	   showmessage("Gửi tặng thành công","parkApp.php?ac=index",1);
   }
}
//ÔùËÍºÃÓÑ³µ
if($op=='sendfriend'){

    $CarID=$_GET['carid'];
    $parkcarInfo=new CparkcarInfo($CarID);
    $carinfo=$parkcarInfo->arrCar;    
	$query = $_SGLOBAL['db']->query("SELECT f.fusername, s.name, s.namestatus FROM ".tname('friend')." f,
		".tname('space')." s, ".tname(park_member)." m WHERE m.uid=s.uid and s.uid=f.uid and f.uid=$_SGLOBAL[supe_uid] AND f.status='1' ORDER BY f.num DESC, f.dateline DESC LIMIT 0,100");
	while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$fusername = $value['fusername'];
		$friends[] = addslashes($fusername);
	}
	$friendstr = implode(',', $friends);
	$username = empty($_GET['key'])?'':$_GET['key'];
	if(!empty($username)){
		$query = $_SGLOBAL['db']->query("SELECT uid FROM ".tname('space')." where username='".$username."'");
		$value = $_SGLOBAL['db']->fetch_array($query);
		$uid = $value[uid];
	}

}
//ÎåÕÛÊÛ
if($op=='saleout' || $op=='sale'){
        $CarID=empty($_GET['carid'])?0:$_GET['carid'];
        $myCar=new CmyCar($_SGLOBAL['supe_uid']);
        $myCar->isExitOfCar($CarID,$_SGLOBAL['supe_uid']);
        if($myCar->isExitCar==0){
                showmessage("Bạn không có chiếc xe này","parkApp.php?ac=index",1);   
        }
}
if($op=='saleout'){
    $CarID=empty($_GET['carid'])?0:$_GET['carid'];
	$parkcarInfo=new CparkcarInfo($CarID);
	$arrCar=$parkcarInfo->arrCar;
	$carname=$arrCar[CarDesc];
	$arrCar[CarPriceNew]=floor($arrCar[CarPrice]*0.5);
}
//ÎåÕÛÊÛ½áÊø
if($op=='saleoutend'){
    $CarID=empty($_POST['carid'])?0:$_POST['carid'];
    $arrmyCar=getMyCar($_SGLOBAL['supe_uid'],$CarID);
    $permitSend=1;
    if($arrmyCar[ParkLot]!=0){
      $permitSend=0;
	  showmessage("Không thể bán chiếc xe này","parkApp.php?ac=index",1);	
     } 	
	if($permitSend==1){ 
		$parkcarInfo=new CparkcarInfo($CarID);
		$arrCar=$parkcarInfo->arrCar;
		$BuyCredit=floor($arrCar[CarPrice]*0.5);
		$_SGLOBAL['db']->query("delete from  ".tname('park_mycar')." where uid=".$_SGLOBAL['supe_uid']." and CarID=".$CarID);
		$_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit+".$BuyCredit." where uid=".$_SGLOBAL['supe_uid']);
		$icon='stick';
		$title='{actor} bán một '.$arrCar[CarDesc].' với '.$BuyCredit.' vàng(half price)';
		sendMessage($icon,$title,'BuyFeed');	
		showmessage("Chiếc xe đã được bán","parkApp.php?ac=index",1);
	}
}

//ÕÛÊÛ
if($op=='sale'){
    $CarID=empty($_GET['carid'])?0:$_GET['carid'];
	$parkcarInfo=new CparkcarInfo($CarID);
	$arrCar=$parkcarInfo->arrCar;
	$carname=$arrCar[CarDesc];
	$arrCar[CarPriceNew]=floor($arrCar[CarPrice]*0.6);
}
//ÕÛÊÛ½áÊø
if($op=='saleend'){
    $CarID=empty($_POST['carid'])?0:$_POST['carid'];
    $arrmyCar=getMyCar($_SGLOBAL['supe_uid'],$CarID);
    $permitSend=1;
    if($arrmyCar[ParkLot]!=0){
      $permitSend=0;
	  showmessage("Không thể bán chiếc xe này","parkApp.php?ac=index",1);	
     } 	
	if($permitSend==1){ 
		$parkcarInfo=new CparkcarInfo($CarID);
		$arrCar=$parkcarInfo->arrCar;
		$BuyCredit=floor($arrCar[CarPrice]*0.6);
		$_SGLOBAL['db']->query("update ".tname('park_mycar')." set isSale=1,BuyCredit=".$BuyCredit." where uid=".$_SGLOBAL['supe_uid']." and CarID=".$CarID);
		$icon='stick';
		$title='{actor} bán một <b>'.$arrCar[CarDesc].'</b> tại <a href="parkApp.php?ac=oldmarket">chợ buôn xe</a> với '.$BuyCredit.' (40% discount)vàng';
		sendMessage($icon,$title,'BuyFeed');	
		showmessage("Chiếc xe này là đã ở chợ buôn xe để bán ngay bây giờ","parkApp.php?ac=index",1);
	}
}
//Í£Ö¹ÏúÊÛ
if($op=='stopsale'){
    $CarID=empty($_GET['carid'])?0:$_GET['carid'];
	$parkcarInfo=new CparkcarInfo($CarID);
	$arrCar=$parkcarInfo->arrCar;
	$carname=$arrCar[CarDesc];
	$arrCar[CarPriceNew]=floor($arrCar[CarPrice]*0.6);
}
//Í£Ö¹ÏúÊÛ½áÊø
if($op=='stopsaleend'){
    $CarID=empty($_POST['carid'])?0:$_POST['carid'];
    $arrmyCar=getMyCar($_SGLOBAL['supe_uid'],$CarID);
    $permitSend=1;
	if($permitSend==1){ 
		$parkcarInfo=new CparkcarInfo($CarID);
		$arrCar=$parkcarInfo->arrCar;
		$BuyCredit=floor($arrCar[CarPrice]);
		$_SGLOBAL['db']->query("update ".tname('park_mycar')." set isSale=0,BuyCredit=".$BuyCredit." where uid=".$_SGLOBAL['supe_uid']." and CarID=".$CarID);
		$icon='stick';
		$title='{actor} took the <b>'.$arrCar[CarDesc].'</b> back from the <a href="parkApp.php?ac=oldmarket">flea market</a>';
		sendMessage($icon,$title,'BuyFeed');	
		showmessage("Chiếc xe này đã được đưa trở lại","parkApp.php?ac=index",1);
	}
}

//¹ºÂò¾É³µ
if($op=='buyold'){
    $myID=empty($_GET['myID'])?0:$_GET['myID'];
	$query=$_SGLOBAL['db']->query("select CarID from ".tname('park_mycar')." where ID=".$myID);
	$CarID=$_SGLOBAL['db']->result($query,0);
	$parkcarInfo=new CparkcarInfo($CarID);
	$arrCar=$parkcarInfo->arrCar;
	$carname=$arrCar[CarDesc];
	$arrCar[CarPriceNew]=floor($arrCar[CarPrice]*0.6);
	$stageid=empty($_GET['stageid'])?0:$_GET['stageid'];
	$ID=empty($_GET['ID'])?0:$_GET['ID'];

}
//¹ºÂò¾É³µ½áÊø
if($op=='buyoldend'){
   $myID=empty($_POST['myID'])?0:$_POST['myID'];
   $query=$_SGLOBAL['db']->query("select * from ".tname('park_mycar')." where ID=".$myID);
   $value = $_SGLOBAL['db']->fetch_array($query);
   $CarID=$value[CarID];
   $uid=$value[uid];
   $permitBuy=1;
   $CarID=intval($CarID);   
   $nowtime=date("Y-m-d H:i:s");
   $parkCarInfo=new CparkcarInfo($CarID);   
   $BuyCredit=intval($parkCarInfo->CarPrice);
   $BuyCredit=floor($BuyCredit*0.6);
   $parkMember=new CParkMember($_SGLOBAL['supe_uid']);
   $myCredit=intval($parkMember->P_credit);
   $stageid=empty($_POST['stageid'])?0:$_POST['stageid'];
   $ID=empty($_POST['ID'])?0:$_POST['ID'];	 
   
   if($value[ParkLot]!=0){
	 $permitBuy=0;
	 showmessage("Không thể mua chiếc xe này","parkApp.php?ac=oldmarket",1);	 
   }
   if($myCredit<$BuyCredit){
	 $permitBuy=0;
	 showmessage("Bạn không đủ vàng để mua chiếc xe này","parkApp.php?ac=oldmarket",1);	 
   }
   if($uid==$_SGLOBAL['supe_uid']){
	 $permitBuy=0;
	 showmessage("Chiếc xe này là của bạn, bạn không thể tự mua nó","parkApp.php?ac=oldmarket",1);	 
   
   }

   $myCar=new CmyCar($_SGLOBAL['supe_uid']);
   $intCarCount=intval($myCar->CarCount);
   $parkCfg=new CParkCfg();
   $cfgStopLimit=$parkCfg->cfgStopLimit;
   $limitCount=intval($cfgStopLimit[CarLimit]);

   if($intCarCount>=$limitCount){
	 $permitBuy=0;
	 showmessage("Your cars have reached the limit","parkApp.php?ac=oldmarket",1);
   }
   $myCar->isExitOfCar($CarID,$_SGLOBAL['supe_uid']); 
   if($myCar->isExitCar!=0){
	 $permitBuy=0;
	 showmessage("Bạn đã có một chiếc xe giống thế này, không thể mua thêm chiếc nữa","parkApp.php?ac=oldmarket",1);   
   }
   if($stageid!=0){
	 $query=$_SGLOBAL['db']->query("select count(*) from ".tname('park_mystage')." where ID=".$ID);
	 $intNum=$_SGLOBAL['db']->result($query,0);
	 $parkStage=new Cparkstage($stageid);
	 $arrStage=$parkStage->arrStage;
	 $arrMyuse=$parkStage->getMyStageByID($ID);
	 $permitBuy=setMyuse($arrMyuse,$arrStage);
	 if($intNum!=0&&$permitBuy==1){
	   $BuyCredit=floor($BuyCredit*0.9);
	   $BuyDesc='Sử dụng thẻ ưu đãi';
	   }else{
		 showmessage('Thẻ không hợp lệ',"parkApp.php?ac=oldmarket",1);
	   }
   }	   

   if($permitBuy==1){
	   $arrMycar=array(
		 uid=>$_SGLOBAL['supe_uid'],
		 CarID=>$CarID,
		 BuyTime=>$nowtime,
		 BuyCredit=>$BuyCredit, 
	   );
	   inserttable("park_mycar",$arrMycar);
       $_SGLOBAL['db']->query("delete from ".tname('park_mycar')." where ID=".$myID);
	   $_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit-".$BuyCredit." where uid=".$_SGLOBAL['supe_uid']);
	   $_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit+".$BuyCredit." where uid=".$uid);
	   $icon='stick';
	   $title='{actor} chi tiêu '.$BuyCredit.' vàng để mua một '.$parkCarInfo->CarDesc.' tại <a href="parkApp.php?ac=oldmarket">chợ buôn xe</a> với '.$BuyDesc;
   	   $notetitle='{actor} chi tiêu '.$BuyCredit.' để mua '.$parkCarInfo->CarDesc.' của bạn tại <a href="parkApp.php?ac=oldmarket">chợ buôn xe</a> với '.$BuyDesc;

	   sendMessage($icon,$title,'BuyFeed');
	   sendMessage($icon,$notetitle,'BuyNote');
	   if($ID!=0)  $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where ID=".$ID);		   
	   showmessage($parkCarInfo->CarDesc."Mua THành công","parkApp.php?ac=oldmarket",1);
	 }  
}


include_once( template( "park/view/cp_park" ) );

?>