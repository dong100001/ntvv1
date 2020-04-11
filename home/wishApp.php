<?php
/*
  $ 2009-4-19下午06:57:46 tomyguan $
 */

include_once('./common.php');
include_once(S_ROOT.'./source/function_cp.php');

//是否关闭站点
checkclose();

//是否登录
checklogin();

//用户头像
//ckavatar($_SGLOBAL['supe_uid']);

//空间信息
$space=getspace($_SGLOBAL['supe_uid']);

//允许动作
$dos = array('index', 'wish');
$acs = array('install', 'delete');


//获取变量
$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos)) ? $_GET['do'] : 'index';
$ac = (!empty($_GET['ac']) && in_array($_GET['ac'], $acs)) ? $_GET['ac'] : '';
$view = empty($_GET['view']) ? 'index' : $_GET['view'];


//选中的样式
if(empty($_GET['view'])){
    $actives[$do] = ' class=active'; 
}else{
    $actives[$view] = ' class=active';
}


if($ac=='install'){   
   $sql="select count(*) from ".tname('wish_member')." where uid=".$_SGLOBAL['supe_uid'];
   $query=$_SGLOBAL['db']->query($sql);
   $intNum = $_SGLOBAL['db']->result($query,0);
   if($intNum==0){
      $nowtime=date("Y-m-d H:i:s"); 
      $arrMember = array(
      	  "uid" => $_SGLOBAL['supe_uid'],
   		  "dateline" =>$nowtime
      );
      inserttable( "wish_member", $arrMember );	
	  //事件feed
	  $fs = array();
	  $fs['icon'] = "wish";
      $fs['title_template'] = "{actor} 膽茫 gh茅 th膬m <a href='wishApp.php?do=index'>v瓢峄漬 瓢峄沜 nguy峄噉</a> c峄 GoHooH.CoM";	
	  $fs['title_data'] = array();
	  $fs['body_template'] = '';
	  $fs['body_data'] = array();	
	  include_once(S_ROOT.'./source/function_cp.php');
	  feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);	
 	  showmessage('Th脿nh c么ng r峄搃, chuy峄僴 膽岷縩 v瓢峄漬 瓢峄沜 nguy峄噉','wishApp.php?do=index');	
   }
   
}

isOpenWish($_SGLOBAL['supe_uid']);

if($ac == 'delete'){
    include_once(S_ROOT."./wish/cp_wish.php");
}else{
    include_once(S_ROOT."./wish/wish_{$do}.php");
}

function isOpenWish($uid){
  global $_SGLOBAL;
  $sql="select count(*) from ".tname('wish_member')." where uid=".$_SGLOBAL['supe_uid'];
  $query=$_SGLOBAL['db']->query($sql);
  $intNum = $_SGLOBAL['db']->result($query,0);
  if($intNum==0){
     showmessage('V瓢峄漬 瓢峄沜 nguy峄噉 v岷玭 ch瓢a 膽瓢峄 b岷 k铆ch ho岷! B岷 c贸 mu峄憂 k铆ch ho岷 n贸 kh么ng?<br /><br /><a href="wishApp.php?ac=install" class="submit">C贸</a>');    
  }
}
?>