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
//检查输入的start是否合法
ckstart($start, $perpage);


$ac=empty($_GET[ac])?"rank":$_GET[ac];
if($ac=='rank'){
    if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}

   $ordersql=empty($_GET['order'])?' order by carprice desc ':" order by ".$_GET['order']." desc"; 
   $wheresql=empty($_GET['name'])?'':" and s.username like '%".$_GET['name']."%'" ;
   $urlRegorder=empty($_GET['order'])?'&order=carprice':"&order=".$_GET['order']; 
   $urlRegname=empty($_GET['name'])?'':"&name=".$_GET['name'];    
   $theurl = "parkApp.php?ac=rank".$urlRegorder.$urlRegname;

   
   $intNum = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM ".tname('park_member')." p,".tname('space')." s  where p.uid=s.uid ".$wheresql), 0);	
   $query = $_SGLOBAL['db']->query("SELECT *,(select sum(c.carprice) from ".tname('park_carinfo')." c,".tname('park_mycar')." m where c.carid=m.carid and  m.uid=p.uid group by m.uid) as carprice,(select count(*) from ".tname('park_mycar')." where uid=s.uid) as carnum  FROM ".tname('space')." s ,".tname('park_member')." p WHERE s.uid=p.uid ".$wheresql.$ordersql." LIMIT $start,$perpage");
   $i=0;
   $arrMycar=array();
   while ($value = $_SGLOBAL['db']->fetch_array($query)) {
		$friends[]= $value;
		$myCar=new CmyCar($value[uid]);
		$arrMycar[$i]=$myCar->arrMyCar;
		$i++;
	}
	$multi = array();
	$multi['html'] = multi($intNum, $perpage, $page, $theurl);
	
	//黑榜
	$query=$_SGLOBAL['db']->query("SELECT s.uid, s.username, r.warnnum FROM (SELECT parkuid, sum( parkwarned) AS warnnum FROM ".tname('park_record')." where parkstatus=1 GROUP BY parkuid) AS r,".tname('space')."  AS s WHERE s.uid = r.parkuid ORDER BY r.warnnum DESC limit 0,12");
	$arrBlack=array();
	while($value=$_SGLOBAL['db']->fetch_array($query)){
	  $arrBlack[]=$value;
	}
	//红榜
	$query=$_SGLOBAL['db']->query("SELECT s.uid, s.username, r.warnnum FROM (SELECT uid, count(*) AS warnnum FROM ".tname('park_warn')."   GROUP BY uid) AS r,".tname('space')."  AS s WHERE s.uid = r.uid ORDER BY r.warnnum DESC limit 0,12");
	$arrRed=array();
	while($value=$_SGLOBAL['db']->fetch_array($query)){
	  $arrRed[]=$value;
	}
	//热门车场	
	$query=$_SGLOBAL['db']->query("SELECT s.uid, s.username, r.parknum FROM (SELECT distinct(parkwhouid) as uid, count(*) AS parknum FROM ".tname('park_record')."   GROUP BY parkwhouid) AS r,".tname('space')."  AS s WHERE s.uid = r.uid ORDER BY r.parknum DESC limit 0,12");
	$arrHot=array();
	while($value=$_SGLOBAL['db']->fetch_array($query)){
	  $arrHot[]=$value;
	}
	//停车达人	
	$query=$_SGLOBAL['db']->query("SELECT s.uid, s.username, r.parknum FROM (SELECT distinct(parkuid) as uid, count(*) AS parknum FROM ".tname('park_record')."   GROUP BY parkuid) AS r,".tname('space')."  AS s WHERE s.uid = r.uid ORDER BY r.parknum DESC limit 0,12");
	$arrMost=array();
	while($value=$_SGLOBAL['db']->fetch_array($query)){
	  $arrMost[]=$value;
	}	
	
}	
include_once( template( "park/view/park_rank" ));
?>