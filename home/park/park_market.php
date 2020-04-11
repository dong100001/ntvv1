<?php
include_once './park/ClassParkInfo.php';
//实名
realname_get();
//获取当前用户的空间信息
$space = getspace($_SGLOBAL['supe_uid']);
//列表变量
$list = array();
//数量
$count = 0;
//每页显示个数
$perpage = 20;
//分页开始
$start = empty($_GET['start'])?0:intval($_GET['start']);
$fuid=empty($_GET['fuid'])?$_SGLOBAL['supe_uid']:$_GET['fuid'];
$type = empty($_GET['type'])?0:intval($_GET['type']);
$level = empty($_GET['level'])?0:intval($_GET['level']);
//检查输入的start是否合法
ckstart($start, $perpage);

$parkCfg=new CParkCfg();
$cfgColor = $parkCfg->cfgColor;
$cfgCarType = $parkCfg->cfgCarType;
$cfgCarLevel = $parkCfg->cfgCarLevel;
$stageid=empty($_GET['stageid'])?0:$_GET['stageid'];
$ID=empty($_GET['ID'])?0:$_GET['ID'];	

$parkMember=new CparkMember($_SGLOBAL['supe_uid']);
$myCredit=$parkMember->P_credit;

$ac=empty($_GET[ac])?"market":$_GET[ac];
if($ac=='market'){
	if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}
	if($stageid!=0){
	   $urlReq='&stageid='.$stageid."&ID=".$ID;
	}	
	//检查开始数
	
	ckstart($start, $perpage);
	$wheresql='';
	if($type!=0) $wheresql=" and CarType='$type'";
	if($level!=0) $wheresql=" and CarLevel='$level'";	
	$theurl = "parkApp.php?ac=market".$urlReq.$wheresql;
	$sql="select count(distinct(CarSID)) from ".tname('park_carinfo')." where CarImgMid<>'' ".$wheresql;
    $query =$_SGLOBAL['db']->query($sql);	
	$intNum = $_SGLOBAL['db']->result($query,0);
	$sql="select distinct(CarSID),CarImgMid,CarDesc,CarPrice,CarSign from ".tname('park_carinfo')." where CarImgMid<>'' ".$wheresql." group by CarSID  order by CarPrice LIMIT $start,$perpage";
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
include_once( template( "park/view/park_market" ));
?>