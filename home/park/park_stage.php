<?php
include_once './park/ClassParkInfo.php';
//ʵ��
realname_get();
//��ȡ��ǰ�û��Ŀռ���Ϣ
$space = getspace($_SGLOBAL['supe_uid']);
//�б����
$list = array();
//����
$count = 0;
//ÿҳ��ʾ����
$perpage = 10;
//��ҳ��ʼ
$op='shop';
$start = empty($_GET['start'])?0:intval($_GET['start']);
$op = empty($_GET['op'])?'shop':$_GET['op'];

//��������start�Ƿ�Ϸ�
ckstart($start, $perpage);
$ac=empty($_GET[ac])?"stage":$_GET[ac];
//�����̵�
if($op=="shop"){
	if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}
	//��鿪ʼ��
	ckstart($start, $perpage);
	$theurl = "parkApp.php?ac=stage";
	$sql="select count(*) from ".tname('park_stage')." where noOpen=0";
    $query =$_SGLOBAL['db']->query($sql);	
	$intNum = $_SGLOBAL['db']->result($query,0);
	$sql="select * from ".tname('park_stage')." where noOpen=0 order by StagePrice LIMIT $start,$perpage";
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
//�ҵĵ���	
if($op=='my'){
	if(empty($start)) {
		$page = empty($_GET['page'])?1:intval($_GET['page']);
		if($page<1) $page = 1;
		$start = ($page-1)*$perpage;
	}
	//��鿪ʼ��
	ckstart($start, $perpage);
	$theurl = "parkApp.php?ac=stage&op=my";
	$sql="select count(*) from ".tname('park_mystage'." where uid=".$_SGLOBAL['supe_uid']);
    $query =$_SGLOBAL['db']->query($sql);	
	$intNum = $_SGLOBAL['db']->result($query,0);
	$sql="select * from ".tname('park_mystage')." m,".tname('park_stage')." s where m.StageID=s.StageID and  m.uid=".$_SGLOBAL['supe_uid']." order by StagePrice LIMIT $start,$perpage";
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

include_once( template( "park/view/park_stage" ));
?>