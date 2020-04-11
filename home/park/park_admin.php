<?php
include_once './park/ClassParkInfo.php';
//ÊµÃû
realname_get();
if($_SGLOBAL['supe_uid'] != ADMIN_UID) 
    showmessage('Cuộc chiến đỗ ô tô', 'parkApp.php?ac=index', 1);
$ac=empty($_GET[ac])?"admin":$_GET[ac];
$arrop = array('opcar', 'opstage', 'opfeed','opcredit', 'addcar', 'addstage', 'sysset','editcar','editstage','delcar');
foreach($arrop as $key){
	$actives[$key] = ' ';
}
$op = (!empty($_GET['op']) && in_array($_GET['op'], $arrop)) ? $_GET['op'] : 'opcar';
$actives[$op] = ' class=active';

$parkCfg=new CParkCfg();
$cfgColor = $parkCfg->cfgColor;
$cfgCarType = $parkCfg->cfgCarType;
$cfgCarLevel = $parkCfg->cfgCarLevel;
$cfgStageType=array('1'=>'Đồng ý','2'=>'Hủy');

$type = empty($_GET['type'])?0:intval($_GET['type']);
$level = empty($_GET['level'])?0:intval($_GET['level']);
$name = empty($_GET['strname'])?'':$_GET['strname'];


//»ñÈ¡µ±Ç°ÓÃ»§µÄ¿Õ¼äÐÅÏ¢
$space = getspace($_SGLOBAL['supe_uid']);
//ÁÐ±í±äÁ¿
$list = array();
//ÊýÁ¿
$count = 0;
//Ã¿Ò³ÏÔÊ¾¸öÊý
$perpage = 20;
//·ÖÒ³¿ªÊ¼
$start = empty($_GET['start'])?0:intval($_GET['start']);

//¼ì²éÊäÈëµÄstartÊÇ·ñºÏ·¨
ckstart($start, $perpage);


//¹ÜÀí³µÁ¾
if($op=='opcar'){
	if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}
	//¼ì²é¿ªÊ¼Êý
	ckstart($start, $perpage);
	$wheresql='';
	if($type!=0) $wheresql=" where CarType='$type'";
	if($level!=0) $wheresql=" where CarLevel='$level'";	
	if($name!='') $wheresql=" where CarDesc like '%".$name."%'";
	$theurl = "parkApp.php?ac=admin&op=opcar".$wheresql;
	
	$sql="select count(*) from ".tname('park_carinfo').$wheresql;
    $query =$_SGLOBAL['db']->query($sql);	
	$intNum = $_SGLOBAL['db']->result($query,0);
	$sql="select * from ".tname('park_carinfo').$wheresql." order by CarPrice,CarSID LIMIT $start,$perpage";
    $query =$_SGLOBAL['db']->query($sql);
	$list=array();
	$count=0;
    while($value =$_SGLOBAL['db']->fetch_array( $query )){
	  $list[]=$value;
	  $count++;
	}
	$multi = array();
	$multi['html'] = multi($intNum, $perpage, $page, $theurl);

}
//±à¼­³µÁ¾
if($op=='editcar'){
  $CarID=empty($_GET['carid'])?0:$_GET['carid'];
  $CparkInfo=new CparkcarInfo($CarID);
  $carinfo=$CparkInfo->arrCar;

  
}
if($op=='delcar'){
  $CarID=empty($_GET['carid'])?0:$_GET['carid'];
	$sql="delete from ".tname('park_carinfo')." where CarId=".$CarID;
    $query =$_SGLOBAL['db']->query($sql);
	showmessage("³É¹¦É¾³ý´Ë³µ",'parkApp.php?ac=admin&op=opcar');

  
}
//±à¼­µÀ¾ß
if($op=='editstage'){
  $StageID=empty($_GET['stageid'])?0:$_GET['stageid'];
  $Cstage=new CparkStage($StageID);
  $stageinfo=$Cstage->arrStage;
  $noAjax=$stageinfo[noAjax];
  if($noAjax==1){
    $checked='checked="checked"';
  } 
  if($noOpen==1){
    $openchecked='checked="checked"';
  }     

  
}
//Ôö¼Ó³µÁ¾
if (submitcheck('carsubmit')){
  $CarImgBig=checkAndUpFile('CarImgbig');
  $CarImg=checkAndUpFile('CarImg');
  $CarImgMid=checkAndUpFile('CarImgMid');  
  $CarSign=checkAndUpFile('CarSign'); 
  $CarDesc=$_POST['CarDesc'];
  $CarColor=intval($_POST['CarColor']);
  $CarPrice=intval($_POST['CarPrice']);
  $carnum=intval($_POST['carnum']);
  $CarType=intval($_POST['CarType']);
  $CarLevel=intval($_POST['CarLevel']);
  $CarMaxSpeed=intval($_POST['CarMaxSpeed']);
  $CarCredit=intval($_POST['CarCredit']);
  $CarSID=intval($_POST['CarSID']);
  $arrCarInfo=array(
      CarSID=>$CarSID,
	  CarImgBig=>$CarImgBig,
	  CarImg=>$CarImg,
	  CarImgMid=>$CarImgMid,	  
	  CarSign=>$CarSign,
	  CarDesc=>$CarDesc,
	  CarColor=>$CarColor,
	  CarPrice=>$CarPrice,
	  CarPrice=>$CarPrice,
	  CarType=>$CarType,
	  CarLevel=>$CarLevel,
	  CarMaxSpeed=>$CarMaxSpeed,
	  CarCredit=>$CarCredit,
  );
   inserttable( "park_carinfo", $arrCarInfo);				 
   showmessage("Æû³µÌí¼Ó³É¹¦","parkApp.php?ac=admin&op=opcar",1);
  
}
//±à¼­³µÁ¾
if (submitcheck('careditsubmit')){
  $CarID=intval($_POST['CarID']); 
  $parkcarInfo=new CparkcarInfo($CarID);
  $arrCarInfo=$parkcarInfo->arrCar;
  if(is_uploaded_file($_FILES['CarImgbig'][tmp_name])){
    $CarImgBig=checkAndUpFile('CarImgbig');  
  }else{
    $CarImgBig=$arrCarInfo[CarImgBig];   
  }
  if(is_uploaded_file($_FILES['CarImg'][tmp_name])){
    $CarImg=checkAndUpFile('CarImg');  
  }else{
    $CarImg=$arrCarInfo[CarImg];   
  }
  if(is_uploaded_file($_FILES['CarImgMid'][tmp_name])){
    $CarImgMid=checkAndUpFile('CarImgMid');  
  }else{
    $CarImgMid=$arrCarInfo[CarImgMid];   
  }

  if(is_uploaded_file($_FILES['CarSign'][tmp_name])){
    $CarSign=checkAndUpFile('CarSign');  
  }else{
    $CarSign=$arrCarInfo[CarSign];   
  }
  
  $CarDesc=$_POST['CarDesc'];
  $CarColor=intval($_POST['CarColor']);
  $CarPrice=intval($_POST['CarPrice']);
  $carnum=intval($_POST['carnum']);
  $CarType=intval($_POST['CarType']);
  $CarLevel=intval($_POST['CarLevel']);
  $CarMaxSpeed=intval($_POST['CarMaxSpeed']);
  $CarCredit=intval($_POST['CarCredit']);
  $CarSID=intval($_POST['CarSID']);
  $arrCarInfo=array(
      CarID=>$CarID,
      CarSID=>$CarSID,
	  CarImgBig=>$CarImgBig,
	  CarImg=>$CarImg,
	  CarImgMid=>$CarImgMid,	  
	  CarSign=>$CarSign,
	  CarDesc=>$CarDesc,
	  CarColor=>$CarColor,
	  CarPrice=>$CarPrice,
	  CarPrice=>$CarPrice,
	  CarType=>$CarType,
	  CarLevel=>$CarLevel,
	  CarMaxSpeed=>$CarMaxSpeed,
	  CarCredit=>$CarCredit,
  );

   updatetable('park_carinfo', $arrCarInfo, array('CarID'=>$CarID));   				 
   showmessage("Æû³µÐÞ¸Ä³É¹¦","parkApp.php?ac=admin&op=opcar",1);
  
}
//¹ÜÀíµÀ¾ß

if($op=='opstage'){
     $perpage = 10;
	if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}
	//¼ì²é¿ªÊ¼Êý
	ckstart($start, $perpage);
	$theurl = "parkApp.php?ac=admin&op=opstage";
	$sql="select count(*) from ".tname('park_stage');
    $query =$_SGLOBAL['db']->query($sql);	
	$intNum = $_SGLOBAL['db']->result($query,0);
	$sql="select * from ".tname('park_stage')." order by StagePrice LIMIT $start,$perpage";
    $query =$_SGLOBAL['db']->query($sql);
	$list=array();
	$count=0;
    while($value =$_SGLOBAL['db']->fetch_array( $query )){
	  $list[]=$value;
	  $count++;
	}
	$multi = array();
	$multi['html'] = multi($intNum, $perpage, $page, $theurl);	

}
//Ôö¼ÓµÀ¾ß
if (submitcheck('stagesubmit')){
  $StageImg=checkAndUpFile('StageImg');
  $StageName=$_POST['StageName'];
  $StagePrice=intval($_POST['StagePrice']);
  $StageIntr=$_POST['StageIntr'];
  $StageScript=$_POST['StageSCript'];
  $noAjax=intval($_POST['noajax']);
  $noOpen=intval($_POST['noopen']);  
  $arrStageInfo=array(
	  StageImg=>$StageImg,
	  StageName=>$StageName,
	  StagePrice=>$StagePrice,	  
	  StageIntr=>$StageIntr,
	  StageScript=>$CarDesc,
	  noAjax=>$noAjax,
	  noOpen=>$noOpen,	  
  	  StageType=>$StageType,
	  StageUse=>$StageUse,	  
	  
  );
   inserttable('park_stage', $arrStageInfo);   				 
   showmessage("µÀ¾ßÌí¼Ó³É¹¦","parkApp.php?ac=admin&op=opstage",1);
  
}

//±à¼­µÀ¾ß
if (submitcheck('stageeditsubmit')){
  $StageID=intval($_POST['StageID']); 
  $parkStage=new CparkStage($StageID);
  $arrStageInfo=$parkStage->arrStage;
  if(is_uploaded_file($_FILES['StageImg'][tmp_name])){
    $StageImg=checkAndUpFile('StageImg');  
  }else{
    $StageImg=$arrStageInfo[StageImg];   
  }  
  $StageName=$_POST['StageName'];
  $StagePrice=intval($_POST['StagePrice']);
  $StageIntr=$_POST['StageIntr'];
  $StageScript=$_POST['StageScript'];
  $noAjax=intval($_POST['noajax']);  
  $noOpen=intval($_POST['noopen']);    

  
  $arrStageInfo=array(
	  StageImg=>$StageImg,
	  StageName=>$StageName,
	  StagePrice=>$StagePrice,
	  StageIntr=>$StageIntr,
	  StageScript=>$StageScript,
	  noAjax=>$noAjax,	  
	  noOpen=>$noOpen,	  	  
  	  StageType=>$StageType,
	  StageUse=>$StageUse,	  
  );
   updatetable( "park_Stage", $arrStageInfo,array('StageID'=>$StageID));				 
   showmessage("µÀ¾ßÐÞ¸Ä³É¹¦","parkApp.php?ac=admin&op=opstage",1);
  
}

include_once( template( "park/view/park_admin" ) );
//ÉÏ´«Í¼Æ¬
function checkAndUpFile($upfile){
	$uptypes=array('image/jpg','image/jpeg','image/x-png','image/gif','image/pjpeg','application/x-shockwave-flash');
	$max_file_size=5000000;    
	$destination_folder="park/carimg/";
	if (!is_uploaded_file($_FILES[$upfile][tmp_name])){ 
	   showmessage($upfile."ÎÄ¼þ²»´æÔÚ");
	}
	$file = $_FILES[$upfile];
	if($max_file_size < $file["size"]){
	   showmessage("ÎÄ¼þÌ«´ó");
    }
	if(!in_array($file["type"], $uptypes)){
	   showmessage($file["type"]."ÎÄ¼þÀàÐÍ²»¶Ô");
	}
	if(!file_exists($destination_folder))
	mkdir($destination_folder);
	$filename=$file["tmp_name"];
	$image_size = getimagesize($filename); 
	$pinfo=pathinfo($file["name"]);
	$ftype=$pinfo[extension];
	$destination =$destination_folder.time().$upfile.".".$ftype;
	if(!move_uploaded_file ($filename, $destination)){
	   showmessage("ÎÄ¼þ´«Êä´íÎó");
    }
	$pinfo=pathinfo($destination);
	$fname=$pinfo[basename];
	$regStr=$destination_folder.$fname;
	return $regStr;
}
?>