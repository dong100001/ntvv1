﻿<?php
/*
  $ 2009-4-19����06:57:46 tomyguan $
 */

include_once('./common.php');
include_once(S_ROOT.'./source/function_cp.php');

//�Ƿ�ر�վ��
checkclose();

//�Ƿ��¼
checklogin();

//�û�ͷ��
//ckavatar($_SGLOBAL['supe_uid']);

//�ռ���Ϣ
$space=getspace($_SGLOBAL['supe_uid']);

//������
$dos = array('index', 'wish');
$acs = array('install', 'delete');


//��ȡ����
$do = (!empty($_GET['do']) && in_array($_GET['do'], $dos)) ? $_GET['do'] : 'index';
$ac = (!empty($_GET['ac']) && in_array($_GET['ac'], $acs)) ? $_GET['ac'] : '';
$view = empty($_GET['view']) ? 'index' : $_GET['view'];


//ѡ�е���ʽ
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
	  //�¼�feed
	  $fs = array();
	  $fs['icon'] = "wish";
      $fs['title_template'] = "{actor} đã ghé thăm <a href='wishApp.php?do=index'>vườn ước nguyện</a> của GoHooH.CoM";	
	  $fs['title_data'] = array();
	  $fs['body_template'] = '';
	  $fs['body_data'] = array();	
	  include_once(S_ROOT.'./source/function_cp.php');
	  feed_add($fs['icon'], $fs['title_template'], $fs['title_data'], $fs['body_template'], $fs['body_data'], $fs['body_general'],$fs['images'], $fs['image_links'], $fs['target_ids'], $fs['friend']);	
 	  showmessage('Thành công rồi, chuyển đến vườn ước nguyện','wishApp.php?do=index');	
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
     showmessage('Vườn ước nguyện vẫn chưa được bạn kích hoạt! Bạn có muốn kích hoạt nó không?<br /><br /><a href="wishApp.php?ac=install" class="submit">Có</a>');    
  }
}
?>